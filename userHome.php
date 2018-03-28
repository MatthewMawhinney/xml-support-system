<?php
session_start();
if((!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "") || $_SESSION['role'] == "support") {
  header('Location: userLogin.php');
}
require_once 'models/validation.php';
require_once 'models/Users.php';
require_once 'models/Tickets.php';
require_once "views/header.php";
$v = new Validate();
$u = new User();
$t = new Ticket();

$catInput = "";
$msgInput = "";
$catError = "";
$msgError = "";
$flag = true;

//populating category dropdown
function dropPop(){
  $catDropDown = ["General", "Payment", "Shipping", "Returns", "Account"];
  foreach($catDropDown as $c) {
    echo "<option>" . $c . "</option>";
  }
}

$displayTick = $t->getTicketsUser();

//when form is submitted
if(isset($_POST['add'])) {

  $catInput = $_POST['category'];
  $msgInput = $_POST['msg'];

  //validation for inputs needing to be filled, no format validation
  if($v->emptyString($msgInput)) {
    $msgError = 'Please enter a description';
    $flag = false;
  }

  if($flag) {
    $u->userAddTicket($catInput, $msgInput);
    $displayTick = $t->getTicketsUser();
  }
}
?>

<!-- USER SUBMIT(CREATE) SUPPORT TICKETS -->
  <main>
    <div class="container">
      <h3>Welcome back, <?php echo $_SESSION['userName'] ?>!</h3>
      <h1>Submit a Support Ticket</h1>
      <form action="#" method="POST" name="supportForm">
        <div>
          <label for="category">Category:</label>
          <select name="category">
            <?php dropPop(); ?>
          </select>
          <label><?= htmlspecialchars($catError); ?></label>
        </div>
        <div>
          <label for="msg">Message:</label>
          <input type="text" name="msg" value="<?= htmlspecialchars($msgInput); ?>">
          <label><?= htmlspecialchars($msgError); ?></label>
        </div>
        <input id="sub" type="submit" name="add" value="Submit Ticket"/>
      </form>
      <?php echo $displayTick; ?>
    </div>
  </main>
</body>
</html>
