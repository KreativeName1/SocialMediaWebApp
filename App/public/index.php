<?php
  namespace App;
  session_start();
  require_once '../models/Connection.php';
  require_once '../models/Model.php';
  require_once '../models/User.php';
  require_once '../controllers/UserController.php';

  if (isset($_SESSION['user'])) {
    $login = true;
    $User =  unserialize($_SESSION['user']);
    $User->SetCon();
  } else {
    $login = false;
    $User = null;
  }
  $view = $_GET['v'] ?? 'home';
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
    <form action="?v=search">
      <input type="search" name="search" id="search" placeholder="Search">
      <button type="submit">Search</button>
    </form>
    <div>
      <?php if (!$login): ?>
      <div class="sign-opt">
        <a class="signup-btn" href="?v=signup">Sign up</a>
        <a class="signin-btn" href="?v=signin">Sign in</a>
      </div>
      <?php endif; ?>
      <img id="profile-img" class="profile-img" src="<?=$login?"/uploads/profile/".$User->getImage():'/public/img/guest.png';?>" alt="profile" />
    </div>
  </header>
  <aside>
    <nav>
      <div>
        <button id="aside-close">X</button>
        <h1>Feed</h1>
        <ul>
          <li><a href="?v=posts&t=home">Home</a></li>
          <li><a href="?v=posts&t=popular">Popular</a></li>
          <li><a href="?v=posts&t=new">New</a></li>
          <li><a href="?v=posts&t=following">Following</a></li>
        </ul>
      </div>
      <div>
        <h1>Profile</h1>
        <ul>
          <li><a href="?v=profile&u=<?=$login?$User->getUsername():"signin";?>">Profile</a></li>
          <li><a href="?v=Messages">Messages</a></li>
          <li><a href="?v=notifications">Notifications</a></li>
          <li><a href="?v=settings">Settings</a></li>
          <li><a href="?v=logout">Logout</a></li>
        </ul>
      </div>
    </nav>
  </aside>
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