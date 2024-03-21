<?php
  namespace App\views;
  use App\controllers\UserController;
  use Exception;
?>
<form class="form grid-register" action="?v=signin" method="post">
  <h1>Sign-In</h1>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="submit" value="Sign-In">
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
      $userController = new UserController();
      $userController->login($_POST);
    } catch (Exception $e) {
      echo "<p class='error'>{$e->getMessage()}</p>";
    }
  }
?>
</form>