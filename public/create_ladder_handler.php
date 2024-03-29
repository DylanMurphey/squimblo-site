<?php
echo print_r($_POST);
    session_start();
    require_once("../private/Dao.php");
    
    function leave($page = 'create_ladder.php') {
        $THIS_DOMAIN = getenv('THIS_DOMAIN');
        header("Location: {$THIS_DOMAIN}/{$page}");
        exit();
    }
    
    if(!$_SESSION['authenticated']) leave('login.php');

    if(!isset($_POST['new_ladder_name']) || !preg_match('/^[a-zA-Z0-9 ]{4,32}+$/', $_POST['new_ladder_name'])) {
        $_SESSION['warning']['newladder'] = 'Ladder name must be 4-32 (a-Z, 0-9, spaces) characters long.';
        leave();
    }

    if(!isset($_SESSION['user_id'])) {
        $_SESSION['warning']['newladder'] = 'Unknown error occurred. Please try again later.';
        leave();
    }

    $dao = new Dao();

    if(!$dao->checkLadderExists($_SESSION['user_id'], $_POST['new_ladder_name'])) {
        $_SESSION['warning']['newladder'] = 'You already have a ladder with that name!';
        leave();
    }

    //finally the good stuff
    $id = $dao->createLadder($_SESSION['user_id'], $_POST['new_ladder_name']);
    if($id != false) {
        $dao->addUserToLadder($_SESSION['user_id'], $id);
        leave("ladders.php?view_ladder={$id}");
    } else {
        $_SESSION['warning']['newladder'] = 'Unknown error occurred. Please try again later.';
        leave();
    }
