<?php
    session_start();
    if(isset($_SESSION['authenticated'])) {
        header("Location: {$d}/ladders.php");
    } else {
        header("Location: {$d}/about.php");
    }
    exit();