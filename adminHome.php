<?php
session_start();
if((!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "") || $_SESSION['role'] == "client") {
  header('Location: userLogin.php');
}

require_once 'models/Tickets.php';
require_once "views/header.php";
$t = new Ticket();

$displayTick = $t->getTicketsAdmin();

?>

<!-- USER SUBMIT(CREATE) SUPPORT TICKETS -->
  <main>
    <div class="container">
      <h3>Welcome back, <?php echo $_SESSION['userName'] ?>!</h3>
      <h1>Answer Open Support Tickets</h1>
      <?php echo $displayTick; ?>
    </div>
  </main>
</body>
</html>
