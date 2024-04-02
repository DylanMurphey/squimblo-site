<?php $pagename = "Matches"; include_once("../private/header.php");

// NOTE: $matches is defined by header. declaration should go here with the
//       typical $dao call if that should change. One less DB query for now

if (!isset($_SESSION['authenticated'])) {
  header ('Location: /login.php');
}

if ($numMatches) {
  echo '<table id="matches"><thead><tr><th>Ladder</th><th>Opponent</th><th></th></tr></thead><tbody>';
  foreach($matches as $m) {
    if ($m['player1_id'] == $_SESSION['user_id']) {
      $opp = $m['player2_name'];
    } else {
      $opp = $m['player1_name'];
    }
    echo "<tr>
          <td>{$m['ladder_name']}</td>
          <td>{$opp}</td>
          <td>";
    
    echo "<form method='get' action='report_score.php'>
            <input type='hidden' name='match_id' value = '{$m['match_id']}' />
            <button type='submit' value='Login'>Report Score</button>
          </form>";
    
    echo  "</td>
          </tr>";
  }
  echo '</tbody></table>';
} else {
  echo '<br/><h1>All caught up for now!</h1>';
}

include_once("../private/footer.php");?>
