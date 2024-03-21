<?php
  namespace App\views;
  use App\controllers\UserController;
?>
<script src="../public/js/signup.js"></script>
<form class="form grid-register" action="?v=signup" method="post" enctype="multipart/form-data">
  <h1>Sign-Up</h1>
  <div class="split">
    <input type="text" name="firstname" placeholder="Firstname" required>
    <input type="text" name="lastname" placeholder="Lastname" required>
  </div>
  <input type="text" name="username" placeholder="Username" required>
  <input type="email" name="email" placeholder="Email" required>
  <div class="password-div">
  <input type="password" id="password" name="password" placeholder="Password" required>
  <p id="result"></p>
  </div>
  <div class="password-div">
  <div class="split">
    <label for="birthdate">Birthdate</label>
    <input type="date" name="birthdate" id="dob" required>
    <p id="age"></p>
  </div>
  </div>
  <div class="split">
    <label for="gender">Gender</label>
    <select name="gender" required>
      <option value="M">Male</option>
      <option value="F">Female </option>
      <option value="O">Other</option>
    </select>
  </div>
  <div class="split">
    <label for="image">Profile Image</label>
    <input type="file" name="image" required>
  </div>
  <input type="submit" id="submit" value="Sign-Up" disabled>
</form>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userController = new UserController();
    $userController->register($_POST, $_FILES);
  }
?>