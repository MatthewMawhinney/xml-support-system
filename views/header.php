<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Refactor</title>
    <link rel="stylesheet" href="stylesheet/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <div class="page-wrapper">
        <div>
          <a href="#"><i class="fas fa-laptop"></i></a>
          <h2 id="title">Refactor</h2>
        </div>
        <div id="settings">
          <a href="userLogin.php" id="login">
            <?php
              if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
                echo "Hello, " . $_SESSION["userName"] . "</a>";
                echo "<a href='logout.php' id='logout'>Log Out</a>";
              }
              else {
                echo "Login" . "</a>";
              }
            ?>
        </div>
      </div>
    </header>
