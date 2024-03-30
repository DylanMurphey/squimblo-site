<?php
    $pagename = "Report Score";
    include_once("../private/header.php"); 
    if (!isset($_SESSION['authenticated'])) {
      header ('Location: /login.php');
      exit();
    }

    if (!isset($_GET['match_id'])) {
      header ('Location: /matches.php');
      exit();
    }

    $dao = new Dao();
    $m = $dao->getMatchById($_GET['match_id']);

    if (!($_SESSION['user_id'] == $m['player1_id'] || $_SESSION['user_id'] == $m['player2_id'])) {
        header ('Location: /matches.php');
        exit();
    }
?>
    
    <div class="new-ladder-form">
        <form method="post" action="report_score_handler.php">
            <h1>Report Score</h1>
            <label for="p1s">
                <?php
                echo $m['player1_name'];
                ?>
            </label>
            <input type="number" placeholder="Score" name="p1s" id="p1s" min=0 required><br />
            <br/>
            <label for="p2s">
                <?php
                echo $m['player2_name'];
                ?>
            </label>
            <input type="number" placeholder="Score" name="p2s" id="p2s" min=0 required><br />
            <input type="hidden" name="match_id" value='<?php echo $m['match_id']?>'><br />
            <button type="submit" value="submit">Submit</button>
        </form>
    </div>

<?php
    include_once("../private/footer.php");
?>