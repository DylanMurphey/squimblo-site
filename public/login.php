<?php
    $pagename = "Sign In";
    require_once("../private/header.php");
    require_once("../private/Dao.php");
    $dao = new Dao("comments.log");

    // kick users back who sneakily revisit login page
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
        header("Location: {$THIS_DOMAIN}/index.php");
        exit();
    }
?>

<div class="login-wrapper">
    <div class="login-container" id="login-field">
        <form method="post" action="login_handler.php">
            <label for="username"><b>Existing user</b><br /></label>
            <input type="text" placeholder="Username" name="username" required><br />
            <input type="password" placeholder="Password" name="password" required><br />
            <button type="submit" value="Login">Login</button>
        </form>
    </div>

    <div class="login-container" id="signup-field">
        <form method="post" action="registration_handler.php">
            <label for="username"><b>New user</b><br /></label>
            <input type="text" placeholder="Username" name="username" required><br />
            <input type="text" placeholder="Email Address" name="email" required><br />
            <input type="password" placeholder="Password" name="password" required><br />
            <input type="password" placeholder="Confirm Password" name="password_confirm" required><br />
            <button type="submit">Sign up</button>
        </form>
    </div>
</div>

<?php include_once("../private/footer.php") ?>