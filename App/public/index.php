<?php
  namespace App;
  session_start();
  require_once '../models/Connection.php';
  require_once '../models/Model.php';
  require_once '../models/User.php';
  require_once '../controllers/UserController.php';

  if (isset($_SESSION['user'])) {
    $login = true;
    $loggedUser =  unserialize($_SESSION['user']);
    $loggedUser->SetCon();
  } else {
    $login = false;
    $loggedUser = null;
  }
  $view = $_GET['View'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/public/js/main.js"></script>
  <!-- <script src="js/main.js"></script> -->
  <title><?= ucfirst($view); ?></title>
  <link rel="stylesheet" href="/public/css/main.css">
  <!-- <link rel="stylesheet" href="css/main.css"> -->
</head>
<body>
  <header>
    <h1>Simple MVC</h1>
    <div>
      <?php if (!$login): ?>
        <div class="sign-opt">
          <a class="signup-btn" href="?View=signup">Sign up</a>
          <a class="signin-btn" href="?View=signin">Sign in</a>
        </div>
      <?php endif; ?>
      <img id="profile-img" class="profile-img" src="<?php echo $loggedUser != null ? "/uploads/profile/".$loggedUser->getImage() :'/public/img/guest.png';?>" alt="profile" />
    </div>
  </header>
  <main>
    <?php
      if (file_exists("../views/$view.php")) require_once "../views/$view.php";
      else require_once "../views/home.php";
    ?>
  </main>
  <footer>
  </footer>
</body>
</html>