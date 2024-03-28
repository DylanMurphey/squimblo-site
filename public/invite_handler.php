<?php
    session_start();
    require_once("../private/Dao.php");

    function leave($page = 'invites.php') {
        $THIS_DOMAIN = getenv('THIS_DOMAIN');
        header("Location: {$THIS_DOMAIN}/{$page}");
        exit();
    }

    $dao = new Dao();

    $THIS_DOMAIN = getenv("THIS_DOMAIN");

    if (isset($_GET['id'])){
        $invite_id = $_GET['id'];
        $accept = !(isset($_GET['reject']) && filter_var($_GET['reject'], FILTER_VALIDATE_BOOL));

        $inv = $dao->getInvite($invite_id);

        if ($_SESSION['user_id'] == $inv['recipient_id']) {
            if ($accept && $dao->checkUserInTable($_SESSION['user_id'],$inv['ladder_id'])) {
                $dao->addUserToLadder($inv['recipient_id'],$inv['ladder_id']);
            }
            $dao->deleteInvite($invite_id);
            leave("ladders.php?view_ladder={$inv['ladder_id']}");
        }
    }
    leave();