<?php
    $pagename = "Create Ladder";
    include_once("../private/header.php"); 
    if (!isset($_SESSION['authenticated'])) {
      header ('Location: /login.php');
    }

    $dao = new Dao();
?>
    
    <form method="post" action="create_ladder_handler.php">
        <div class="new-ladder-form">
            <label for="laddername"><h1>New Ladder!</h1></label>
            <?php
                if(isset($_SESSION['warning']) && isset($_SESSION['warning']['newladder'])){
                    echo "<p class='warning'>{$_SESSION['warning']['newladder']}</p>";
                }
            ?>
            <input type="text" placeholder="Ladder Name" name="new_ladder_name" id="laddername" required autocomplete="off"><br />
            <button type="submit" value="Create">Create</button>
        </div>
    </form>

<?php
    unset($_SESSION['warning']);
    include_once("../private/footer.php");
?>