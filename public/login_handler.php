<?php
  session_start();
  require_once("../private/Dao.php");
  $dao = new Dao();

  $THIS_DOMAIN = getenv("THIS_DOMAIN");

  $username = $_POST['username'];
  $password = $_POST['password'];
   
  if ($dao->verifyPassword($username, $password)) {
    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = $username;
    header("Location: {$THIS_DOMAIN}/index.php");
    exit();
  } else {
    header("Location: {$THIS_DOMAIN}/login.php");
    exit();
  }
