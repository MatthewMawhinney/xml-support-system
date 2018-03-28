<?php
session_start();
if((!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "")) {
  header('Location: userLogin.php');
}
require_once 'models/validation.php';
require_once 'models/Tickets.php';
require_once "views/header.php";
$v = new Validate();
$t = new Ticket();

if (isset($_POST['view'])){
  $_SESSION['ticketId'] = $_POST['viewId'];
}

$ticketInfo = $t->getTicketDetails();

$msg = "";
$addMsgError = "";
$flag = true;

if(isset($_POST['updateTicket'])) {
  $msg = $_POST['msg'];

  if($v->emptyString($msg)) {
    $addMsgError = 'Please enter a message';
    $flag = false;
  }

  if($flag) {
    $t->addMessage($msg);
    $ticketInfo = $t->getTicketDetails();
  }
}

if(isset($_POST['close'])) {
    $t->closeTicket();
    header("Location: adminHome.php");
}
 ?>

 <main>
   <div class="container">
     <h1>Ticket Details</h1>
     <a href="userHome.php" id="back">< Back to tickets</a>
     <?php
     if($_SESSION['role'] == "support") {
       echo "<form action='' method='POST'><input type='submit' name='close' id='closeTick' value='Close Ticket'/></form>";
     }
     ?>
     <div><?php echo $ticketInfo; ?></div>
         <div id="postMsg">
           <form action="" method="post" name="addMsg">
             <label for="msg">Post a message</label>
             <input id="reply" type="text" name="msg" placeholder="Reply...">
             <input id="messageBtn" type="submit" name="updateTicket" value="Send"/>
             <p class="error"><?php echo $addMsgError; ?></p>
           </form>
         </div>
       </div>
     </main>
 </body>
 </html>
