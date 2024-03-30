<?php
    function swap(&$x, &$y) {
        $tmp=$x;
        $x=$y;
        $y=$tmp;
    };

    function getPlacementById ($placements, $id) {
      foreach ($placements as $p) {
        if ($p['user_id'] == $id) {
          return $p;
        }
      }
      return null;
    }

    session_start();
    require_once('../private/Dao.php');

    if (!isset($_POST['match_id']) || !isset($_POST['p1s']) || !isset($_POST['p2s'])) {
        header ('Location: /matches.php');
        exit();
    }

    $dao = new Dao();
    $m = $dao->getMatchById($_POST['match_id']);
    $ladder = $dao->getLadderMetadata($m['ladder_id']);
    $standings = $dao->getLadderTable($m['ladder_id']);
    $p1s = $_POST['p1s'];
    $p2s = $_POST['p2s'];

    if (!($_SESSION['user_id'] == $m['player1_id'] || $_SESSION['user_id'] == $m['player2_id'])) {
        echo print_r($m);
        echo $_SESSION['user_id'].'<br/>'.$m['player1_id'].'<br/>'.$m['player2_id'];
        exit();
        header ('Location: /matches.php');
        exit();
    }

    if (!$m['completed']) {
        $p1 = getPlacementById($standings, $m['player1_id']);
        $p2 = getPlacementById($standings, $m['player2_id']);
        $winner = 0; //0=draw, 1=p1, 2=p2

        if ($p1s != $p2s) {
            $winner = 1;
            if ($p2s > $p1s) {
                swap($p1,$p2);
                $winner=2;
            }

            $highRank = $p1['rank'];
            $lowRank  = $p2['rank'];

            if ($lowRank < $highRank) {
                swap($lowRank, $highRank);
            }

            // assumption at this point is p1 is the winner, p2 is the loser
            $dao->updatePlacement($p1['user_id'], $ladder['id'], 0, $highRank);
            $dao->updatePlacement($p2['user_id'], $ladder['id'], 1, $lowRank);
        } else {
            // assumption at this point is both players tied, nothing changes except added draws
            $dao->updatePlacement($p1['user_id'], $ladder['id'], 2, $p1['rank']);
            $dao->updatePlacement($p2['user_id'], $ladder['id'], 2, $p2['rank']);
        }

        $dao->updateMatch($m['match_id'], $p1s, $p2s, $winner);
    }
    header ("Location: /ladders.php?view_ladder={$m['ladder_id']}");
    exit();