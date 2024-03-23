<?php 
  function errorOut(string $h = 'Either this ladder does not exist or you do not have permission to access it.') {
    echo "<div id='ladderspage'><h1>{$h}</h1></div>";
    require_once("../private/footer.php");
    exit();
  }

  session_start();
  require_once("../private/Dao.php");
  $dao = new Dao;
  $authenticated = isset($_SESSION['authenticated']) && $_SESSION['authenticated'];
  $pagename = "Ladders";

  if ($authenticated) {
    $ladders = $dao->getLadders($_SESSION['user_id']);
    if (isset($_GET['view_ladder'])) {
      $view_ladder = $_GET['view_ladder'];
    }
    if (isset($view_ladder)) {
      // check if in table
      foreach($ladders as $l) {
        if ($l['ladder_id'] == $view_ladder) {
          $pagename = $l['ladder_title'];
          $allowed = true;
        }
      }
    }
  }

  require_once("../private/header.php") ;

  if ($authenticated) {
    if (count($ladders) > 0) {
      echo "<div class='sidenav'>";
      foreach ($ladders as $l) {
        $title = $l['ladder_title'];
        $id    = $l['ladder_id'];
        echo "<a href='?view_ladder={$id}'>{$title}</a>";
      }
      echo "</div>";
    } else if (isset($view_ladder)) {
      errorOut();
    } else {
      errorOut("You're not in any ladders :(");
    }

    if (isset($view_ladder)) {
      // check if in table
      if ($allowed) {
        $placements = $dao->getLadderTable($view_ladder);
  
        echo "<table id='ladders'><thead><tr><th>Rank</th><th>Player</th><th>W</th><th>D</th><th>L</th></tr></thead><tbody>";

        foreach($placements as $p) {
          echo "<tr><td>{$p['rank']}</td><td>{$p['username']}</td><td>{$p['wins']}</td><td>{$p['draws']}</td><td>{$p['losses']}</td></tr>";
        }

        echo "</tbody></table>";
      } else {
        errorOut();
      }
    }
  } else {
    errorOut('Please sign in to access your ladders.');
  }
?>

<?php include_once("../private/footer.php") ?>