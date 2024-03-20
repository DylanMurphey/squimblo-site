<!-- header.php -->
<!DOCTYPE html>
<html>
    <head>
    <title><?php if (isset($pagename)) {echo "Squimblo - ", $pagename;}
                 else {echo "Squimblo";} ?></title>

        <link rel="stylesheet" href="styles.css">

        <!-- Google font stuff so we can use Comic Neue as a fallback-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    </head>
<body>
    <ul class="nav">
        <a href="/" class="no-decoration"><img src="logo.svg" height="50px" class="logo"> <div class="wordmark">Squimblo!</div></a>
        <li id="button"><a href="/index.php">Home</a></li>
        <li id="button"><a href="/ladders.php">Ladders</a></li>
        <li id="button"><a href="/matches.php">Matches</a></li>
        <li id="button"><a onclick="alert('No new messages :\)')">Inbox (0)</a></li>
        <li id="button"><a href="/login.php">Sign in</a></li>
    </ul>
<!-- end header.php -->