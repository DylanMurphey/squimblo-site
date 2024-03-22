<?php
    session_start();
    require_once("../private/Dao.php");
    $dao = new Dao();
    
    $THIS_DOMAIN = getenv("THIS_DOMAIN");

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($username && $password && $email && $password_confirm) {
        // sanitize
        if ($password !== $password_confirm) {
            header("Location: http://localhost/login.php");
            exit();
        }

        // submit
        $status = $dao->createUser($username,$password,$email);
        switch ($status) {
            case QueryResult::FAILED_EMAIL_NOT_UNIQUE:
                echo("FAILED_EMAIL_NOT_UNIQUE");
                exit();
                break;
            case QueryResult::FAILED_USER_NOT_UNIQUE:
                echo("FAILED_USER_NOT_UNIQUE");
                exit();
                break;
            case QueryResult::FAILED_UNKNOWN:
                echo("FAILED_UNKNOWN");
                exit();
                break;
        }

        $vp = $dao->verifyPassword($username, $password);
         
        if ($vp['correct']) {
          $_SESSION['authenticated'] = true;
          $_SESSION['username'] = $vp['username'];
          $_SESSION['user_id'] = $vp['user_id'];
            header("Location: {$THIS_DOMAIN}/index.php");
            exit();
        } else {
            header("Location: {$THIS_DOMAIN}/login.php");
            exit();
        }
        

    } else {
        header("Location: {$THIS_DOMAIN}/login.php");
        exit();
    }
