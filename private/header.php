<!-- header.php -->
<!DOCTYPE html>
<html>
    <head>
    <title><?php if (isset($pagename)) {echo $pagename, " - Squimblo";}
                 else {echo "Squimblo";} ?></title>

        <link rel="stylesheet" href="styles.css">

        <!-- Google font stuff so we can use Comic Neue as a fallback-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    </head>
<body>
    <?php if(!isset($_SESSION)) session_start(); ?>
    <div id="nav">
    <ul class="nav">
        <a href="/" class="no-decoration"><img src="logo.svg" height="50px" class="logo"> <div class="wordmark">Squimblo!</div></a>
        <li id="button"><a href="/index.php">Home</a></li>

        <?php
        if(isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
            require_once('../private/Dao.php');
            $username = $_SESSION['username'];
            $dao = new Dao();
            $numInvitesStr = '';
            $numMatchesStr = '';
            if ($numInvites = $dao->numInvites($_SESSION['user_id']))
                $numInvitesStr = " ({$numInvites})";

            $matches = $dao->getUserMatches($_SESSION['user_id'], true);
            if ($numMatches = count($matches))
                $numMatchesStr = " ({$numMatches})";
            echo "<li id='button'><a href='/ladders.php'>Ladders</a></li>";
            echo "<li id='button'><a href='/matches.php'>Matches{$numMatchesStr}</a></li>";
            echo "<li id='button'><a href='/invites.php'>Invites{$numInvitesStr}</a></li>";
            echo "<li id='button'><a href='/logout.php'>Sign out as <b>{$username}</b></a></li>";
        } else {
            echo "<li id='button'><a href='/login.php'>Sign in</a></li>";
        }
        ?>
    </ul>
    </div>
    <div id='body-container'>
<!-- end header.php -->