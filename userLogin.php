<?php
session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "true" && $_SESSION['role'] == 'support') {
  header('Location: adminHome.php');
}
elseif (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "true" && $_SESSION['role'] == 'client') {
  header('Location: userHome.php');
}

require_once 'models/validation.php';
require_once 'models/Users.php';
require_once "views/header.php";
$v = new Validate();
$u = new User();

$userInput = "";
$passInput = "";
$userError = "";
$passError = "";
$flag = true;

if(isset($_POST['login'])) {

  $userInput = $_POST['user'];
  $passInput = $_POST['pass'];

  if($v->emptyString($userInput)) {
    $userError = 'Please enter your Username';
    $flag = false;
  }
  if($v->emptyString($passInput)) {
    $passError = 'Please enter your Password';
    $flag = false;
  }

  if($flag) {
    $u->loginUser($userInput, $passInput);

      if ($_SESSION['role'] == 'client') {
          header('Location: userHome.php');
      }
      elseif ($_SESSION['role'] == 'support') {
          header('Location: adminHome.php');
      }
      else {
         $userError = "Invalid Username/Password";
      }
    }
}

?>
    <main>
      <div class="container">
        <h1>Login</h1>
        <form action="" method="POST" name="loginForm">
          <div>
            <label for="user">Username:</label>
            <input type="text" name="user" value="<?= htmlspecialchars($userInput); ?>">
            <div>
              <label class="error"><?= htmlspecialchars($userError); ?></label>
            </div>
          </div>
          <div>
            <label for="pass">Password:</label>
            <input type="password" name="pass" value="<?= htmlspecialchars($passInput); ?>">
            <div>
              <label class="error"><?= htmlspecialchars($passError); ?></label>
            </div>
          </div>
          <input id="sub" type="submit" name="login" value="Login"/>
        </form>
      </div>
    </main>
  </body>
</html>
