<?php
  session_start();
  require_once("../private/Dao.php");
  $dao = new Dao();

  function leave($page = 'ladders.php') {
      $THIS_DOMAIN = getenv('THIS_DOMAIN');
      header("Location: {$THIS_DOMAIN}/{$page}");
      exit();
  }

  if ($_SESSION['authenticated']) {
    if (isset($_POST['recipient-username']) && isset($_POST['recipient-username'])){
        $ladder = $dao->getLadderMetadata($_POST['ladder-id']);
        $recipient = $dao->getUserByUsername($_POST['recipient-username']);

        if (empty($ladder)) leave();
        if (empty($recipient)) {
            $_SESSION['warning']['invite_failed'] = 'That user does not exist';
        }

        if ($_SESSION['user_id'] == $ladder['owner_id']) {
            $success = $dao->createInvite($_SESSION['user_id'], $recipient['id'], $ladder['id']);

            if ($success) {
                $_SESSION['warning']['invite_success'] = 'Invite sent!';
                leave("ladders.php?view_ladder={$ladder['id']}");
            }
        } else {
            $_SESSION['warning']['invite_failed'] = 'You do not have permission to invite users';
            leave();
        }
    } else {
        $_SESSION['warning']['invite_failed'] = 'Unknown error creating invite';
        leave();
    }
  } else {
    leave('index.php');
  }
