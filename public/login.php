<?php
    $pagename = "Sign In";
    require_once("../private/header.php");
    require_once("../private/load_env.php");

    // kick users back who sneakily revisit login page
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
        $d = getenv('THIS_DOMAIN');
        header("Location: {$d}/index.php");
        exit();
    }
?>

<?php echo print_r($_SESSION); //TODO: remove :)
?> 

<div class="login-wrapper">
    <div class="login-container" id="login-field">
        <form method="post" action="login_handler.php">
            <label for="username"><b>Existing user</b><br /></label>
            <?php
                if(isset($_SESSION['warning']) && isset($_SESSION['warning']['login'])){
                    echo "<p class='warning'>{$_SESSION['warning']['login']}</p>";
                }
            ?>
            <input type="text" placeholder="Username" name="username"
                <?php if(isset($_SESSION['prefill']) && isset($_SESSION['prefill']['login_username'])){ echo "value='{$_SESSION['prefill']['login_username']}'"; } ?>
                required><br />
            <input type="password" placeholder="Password" name="password" required><br />
            <button type="submit" value="Login">Login</button>
        </form>
    </div>

    <div class="login-container" id="signup-field">
        <form method="post" action="registration_handler.php">
            <label for="username"><b>New user</b><br /></label>
            <?php
                if(isset($_SESSION['warning']) && isset($_SESSION['warning']['reg'])){
                    echo "<p class='warning'>{$_SESSION['warning']['reg']}</p>";
                }
            ?>
            <input type="text" placeholder="Username" name="username"
                <?php if(isset($_SESSION['prefill']) && isset($_SESSION['prefill']['reg_username'])){ echo "value='{$_SESSION['prefill']['reg_username']}'"; } ?>
                required><br />
            <input type="text" placeholder="Email Address" name="email" 
                <?php if(isset($_SESSION['prefill']) && isset($_SESSION['prefill']['reg_email'])){ echo "value='{$_SESSION['prefill']['reg_email']}'"; } ?>
                required><br />
            <input type="password" placeholder="Password" name="password" required><br />
            <input type="password" placeholder="Confirm Password" name="password_confirm" required><br />
            <button type="submit">Sign up</button>
        </form>
    </div>
</div>

<?php 
    unset($_SESSION['prefill']);
    unset($_SESSION['warning']);
    include_once("../private/footer.php");
?>