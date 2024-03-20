<?php
    $pagename = "Sign In";
    require_once("../private/header.php");
    require_once("../private/Dao.php");
    $dao = new Dao("comments.log");
?>

<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Display Name</th>
        </tr>
    </thead>
    <?php
        $lines = $dao->getUsers();
        foreach ($lines as $user) {
            echo "<tr><td>{$user['username']}</td><td>{$user['display_name']}</td></tr>";
        }
    ?>
</table>

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