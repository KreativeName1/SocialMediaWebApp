<?php 
  namespace App\views;
  use App\Models\User;
  $user = User::find($_GET['id']);
?>
<div class="profile-header">
  <div>
    <img src="../uploads/profile/<?=$user->getImage();?>" alt="profile" />
    <h1><?=$user->getFirstname()?> <?=$user->getLastname()?></h1>
  </div>
</div>
<div class="profile-content">
<div class="profile-info">
<div>
  
</div>