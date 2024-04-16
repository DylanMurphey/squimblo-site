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

<div class="login-wrapper">
    <div class="login-container" id="signup-field">
        <form method="post" action="registration_handler.php">
            <b>New user</b><br />
            <?php
                if(isset($_SESSION['warning']) && isset($_SESSION['warning']['reg'])){
                    echo "<p class='warning'>{$_SESSION['warning']['reg']}</p>";
                }
            ?>
            <label for="regun">Username</label>
            <input type="text" placeholder="Username" name="username" id="regun"
                <?php if(isset($_SESSION['prefill']) && isset($_SESSION['prefill']['reg_username'])){ echo "value='{$_SESSION['prefill']['reg_username']}'"; } ?>
                required><br />
            <label for="regem">Email</label>
            <input type="text" placeholder="Email Address" name="email" id="regem"
                <?php if(isset($_SESSION['prefill']) && isset($_SESSION['prefill']['reg_email'])){ echo "value='{$_SESSION['prefill']['reg_email']}'"; } ?>
                required><br />
            <label for="regpw">Password</label>
            <input type="password" placeholder="Password" name="password" id="regpw" required><br />
            <label for="conpw">Confirm Password</label>
            <input type="password" placeholder="Confirm Password" name="password_confirm" id="conpw" required><br />
            <button type="submit">Sign up</button>
        </form>
    </div>
    
    <div class="login-container" id="login-field">
        <form method="post" action="login_handler.php">
            <b>Existing user</b><br />
            <label for="un">Username</label>
            <?php
                if(isset($_SESSION['warning']) && isset($_SESSION['warning']['login'])){
                    echo "<p class='warning'>{$_SESSION['warning']['login']}</p>";
                }
            ?>
            <input type="text" placeholder="Username" name="username" id="un"
                <?php if(isset($_SESSION['prefill']) && isset($_SESSION['prefill']['login_username'])){ echo "value='{$_SESSION['prefill']['login_username']}'"; } ?>
                required><br />
            <label for="pw">Password</label>
            <input type="password" placeholder="Password" name="password" id="pw" required><br />
            <button type="submit" value="Login">Login</button>
        </form>
    </div>
</div>

<?php 
    unset($_SESSION['prefill']);
    unset($_SESSION['warning']);
    include_once("../private/footer.php");
?>
