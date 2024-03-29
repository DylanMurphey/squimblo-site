<?php $pagename = "Invites"; include_once("../private/header.php"); ?>

<?php
    if (!isset($_SESSION['authenticated'])) {
      header ('Location: /login.php');
    }
    $dao = new Dao();
    $invites = $dao->getInvites($_SESSION['user_id']);

    if (count($invites) > 0) {
      echo '<table id="invites"><thead><tr><th>Invited by</th><th>Ladder</th></tr></thead><tbody>';
          foreach ($invites as $i) {
              echo "<tr><td>{$i['sender_name']}</td><td>{$i['ladder_name']}</td><td><a href='/invite_respond.php?id={$i['invite_id']}'>Accept</a></td><td><a href='/invite_respond.php?id={$i['invite_id']}&reject=true'>Reject</a></td></tr>";
          }
      echo '</tbody></table>';
    } else {
      echo '<br/><h1>No new invites, go <a href="https://craigslist.org">make friends!</h1>';
    }
?>

<?php include_once("../private/footer.php");?>