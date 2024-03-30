<?php
    session_start();
    require_once("../private/Dao.php");
    $dao = new Dao();
    
    $THIS_DOMAIN = getenv("THIS_DOMAIN");

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $prefill = ['reg_username'=>$username, 'reg_email'=>$email];

    function updateWarning ($which, $s) {
        if(isset($_SESSION['warning']['reg'])) {
            $_SESSION['warning'][$which] = $_SESSION['warning']['reg']."<br/><br/>".$s;
        } else {
            $_SESSION['warning'][$which] = $s;
        }
    }

    if ($username && $password && $email && $password_confirm) {
        // sanitize
        if (!(preg_match('/^[a-z0-9_]{3,16}$/', $username))) {
            updateWarning('reg', 'Username must be 3-16 characters<br/>(a-Z, 0-9, _ )');
        }

        if ($password !== $password_confirm || !(strlen($password) >= 6 && strlen($password) <= 32)) {
            updateWarning('reg', 'Password must be 6-32 characters and must match');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            unset($prefill['reg_email']);
            updateWarning('reg', 'Please enter a valid email');
            header("Location: {$THIS_DOMAIN}/login.php");
            exit();
        }

        if(isset($_SESSION['warning']['reg'])) {
            $_SESSION['prefill'] = $prefill;
            header("Location: {$THIS_DOMAIN}/login.php");
            exit();
        }

        // submit
        $status = $dao->createUser($username,$password,$email);
        switch ($status) {
            case QueryResult::FAILED_EMAIL_NOT_UNIQUE:
                // echo("FAILED_EMAIL_NOT_UNIQUE");
                unset($prefill['reg_email']);
                $_SESSION['prefill'] = $prefill;
                $_SESSION['warning']['reg'] = 'That email is already in use. Email me squimbler@squimblo.com if you need help';
                header("Location: {$THIS_DOMAIN}/login.php");
                exit();
                break;
            case QueryResult::FAILED_USER_NOT_UNIQUE:
                // echo("FAILED_USER_NOT_UNIQUE");
                unset($prefill['reg_username']);
                $_SESSION['prefill'] = $prefill;
                $_SESSION['warning']['reg'] = 'That username is already in use';
                header("Location: {$THIS_DOMAIN}/login.php");
                break;
            case QueryResult::FAILED_UNKNOWN:
                // echo("FAILED_UNKNOWN");
                $_SESSION['warning']['reg'] = 'Failed to create user. Service might be down?';
                header("Location: {$THIS_DOMAIN}/login.php");
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
