<?php 
  $pagename = "Ladders";
  require_once("../private/header.php") ;
  require_once("../private/Dao.php");
  $dao = new Dao;

  $ladders = $dao->getLadders($_SESSION['user_id']);

  echo(print_r($ladders));
  echo(count($ladders));
  echo "<br/>";
  echo print_r($_GET);

  if (count($ladders) > 0) {
    echo "<div class='sidenav'>";
    foreach ($ladders as $l) {
      $title = $l['ladder_title'];
      $id    = $l['ladder_id'];
      echo "<a href='?view_ladder={$id}'>{$title}</a>";
    }
    echo "</div>";
  }

?>

    <table id="ladders">
        <thead>
          <tr>
            <th>Rank</th>
            <th>Participant</th>
            <th>W</th>
            <th>D</th>
            <th>L</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Jamel Cameron</td>
            <td>4</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Claudia Owen</td>
            <td>4</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Julius Pearson</td>
            <td>3</td>
            <td>1</td>
            <td>0</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Courtney Love</td>
            <td>3</td>
            <td>1</td>
            <td>0</td>
          </tr>
          <tr>
            <td>5</td>
            <td>Dylan</td>
            <td>3</td>
            <td>0</td>
            <td>1</td>
          </tr>
          <tr>
            <td>6</td>
            <td>Lesley Keller</td>
            <td>2</td>
            <td>0</td>
            <td>2</td>
          </tr>
          <tr>
            <td>7</td>
            <td>Rodney Horne</td>
            <td>1</td>
            <td>0</td>
            <td>3</td>
          </tr>
          <tr>
            <td>8</td>
            <td>Milan Huynh</td>
            <td>1</td>
            <td>0</td>
            <td>3</td>
          </tr>
          <tr>
            <td>9</td>
            <td>Mack Ortiz</td>
            <td>1</td>
            <td>0</td>
            <td>3</td>
          </tr>
          <tr>
            <td>10</td>
            <td>Giovanni Buckley</td>
            <td>0</td>
            <td>0</td>
            <td>4</td>
          </tr>
          <tr>
            <td>11</td>
            <td>Tami Curry</td>
            <td>0</td>
            <td>0</td>
            <td>4</td>
          </tr>
          <tr>
            <td>12</td>
            <td>Leanne Hebert</td>
            <td>0</td>
            <td>0</td>
            <td>4</td>
          </tr>
        </tbody>
    </table>

<?php include_once("../private/footer.php") ?>