<?php $pagename = "Sign In"; include_once("../private/header.php"); ?>

<div class="login-wrapper">
    <div class="login-container" id="login-field">
        <label for="uname"><b>Existing user</b><br /></label>
        <input type="text" placeholder="Username" name="uname" required><br />
        <input type="password" placeholder="Password / SSN" name="psw" required><br />

        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
        <button type="submit">Login</button>
    </div>

    <div class="login-container" id="signup-field">
        <label for="uname"><b>New user</b><br /></label>
        <input type="text" placeholder="Email" name="psw" required><br />
        <input type="text" placeholder="Username" name="uname" required><br />
        <input type="password" placeholder="Password / SSN" name="psw" required><br />
        <input type="password" placeholder="Confirm Password / SSN" name="psw" required><br />

        <button type="submit">Sign up</button>
    </div>
</div>

<?php include_once("../private/footer.php") ?>