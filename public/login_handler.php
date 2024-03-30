<?php
  session_start();
  require_once("../private/Dao.php");
  $dao = new Dao();

  $THIS_DOMAIN = getenv("THIS_DOMAIN");

  $username = $_POST['username'];
  $password = $_POST['password'];

  $vp = $dao->verifyPassword($username, $password);
   
  if ($vp['correct']) {
    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = $vp['username'];
    $_SESSION['user_id'] = $vp['user_id'];
    header("Location: {$THIS_DOMAIN}/ladders.php");
    exit();
  } else {
    $_SESSION['prefill'] = ['login_username'=>$username];
    $_SESSION['warning']['login'] = 'Username or password incorrect';
    header("Location: {$THIS_DOMAIN}/login.php");
    exit();
  }
