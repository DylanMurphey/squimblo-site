<?php $pagename = "Invites"; include_once("../private/header.php"); ?>

<table id="invites">
  <thead>
    <tr>
      <th>Invited by</th>
      <th>Ladder</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $dao = new Dao();
        $invites = $dao->getInvites($_SESSION['user_id']);

        foreach ($invites as $i) {
            echo "<tr><td>{$i['sender_name']}</td><td>{$i['ladder_name']}</td><td><a href='/invite_handler.php?id={$i['invite_id']}'>Accept</a></td><td><a href='/invite_handler.php?id={$i['invite_id']}&reject=true'>Reject</a></td></tr>";
        }
    ?>
  </tbody>
</table>

<?php include_once("../private/footer.php");?>