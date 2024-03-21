<?php
    session_start();
    session_destroy();
    header("Location: {$THIS_DOMAIN}/login.php");
    exit();
