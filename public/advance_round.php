<?php
    session_start();
    require_once("../private/Dao.php");

    function leave($page = 'ladders.php') {
        $THIS_DOMAIN = getenv('THIS_DOMAIN');
        header("Location: {$THIS_DOMAIN}/{$page}");
        exit();
    }

    function getPlacementById ($placements, $id) {
      foreach ($placements as $p) {
        if ($p['user_id'] == $id) {
          return $p;
        }
      }
      return null;
    }

    function swap(&$x, &$y) {
        $tmp=$x;
        $x=$y;
        $y=$tmp;
    };

    if(!$_SESSION['authenticated']) leave('ladders.php');

    $dao = new Dao();
    $matches = $dao->getLadderMatches($_SESSION['user_id'], true);

    if (isset($_POST['ladder-id'])){
        $ladder = $dao->getLadderMetadata($_POST['ladder-id']);
        if ($_SESSION['user_id'] != $ladder['owner_id']) leave();
        if ($_POST['ladder-round'] != $ladder['current_round']) leave("ladders.php?view_ladder={$ladder['id']}");

        $standings = $dao->getLadderTable($ladder['id']);
        
        $matches = $dao->getLadderMatches($ladder['id']);
        echo print_r($matches);
        
        echo "<br/><br/>";

        // resolving incomplete previous round matches   
        if ($ladder['current_round'] > 0) {     
            foreach ($matches as $m) {
                if (!$m['completed']) {
                    // assumption at this point is both players tied, nothing changes except added draws
                    $p1 = getPlacementById($standings, $m['player1_id']);
                    $p2 = getPlacementById($standings, $m['player2_id']);

                    $dao->updatePlacement($p1['user_id'], $ladder['id'], 2, $p1['rank']);
                    $dao->updatePlacement($p2['user_id'], $ladder['id'], 2, $p2['rank']);

                    $dao->updateMatch($m['match_id'],0,0,0);
                }
            }
        }
        
        // scheduling next round matches
        $dao->incrementLadderRound($ladder['id']);
        $ladder = $dao->getLadderMetadata($_POST['ladder-id']);
        //NOTE: because draws currently do not affect standing, there is no need to refresh that value.

        $skip = false;
        $handling_p1 = true;
        if (count($standings) % 2 == 1) {
            if ($ladder['current_round'] % 2 == 1) {
                $skip = true;
            }
        }

        foreach(array_reverse($standings) as $s) {
            if (!$skip) {
                if ($handling_p1) {
                    $p1 = $s;
                } else {
                    $p2 = $s;

                    $dao->createMatch($p2['user_id'],$p1['user_id'],$ladder['id'],$ladder['current_round']);
                }
                $handling_p1 = !$handling_p1;
            } else {
                $skip = false;
            }
        }
        leave("ladders.php?view_ladder={$ladder['id']}");
    }
    leave();