<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Gender;
use DateTime;
use Exception;

class UserController
{
  public function register($data, $files)
  {
    $user = new User();
    $user->setFirstname($data['firstname']);
    $user->setLastname($data['lastname']);
    $user->setEmail($data['email']);
    $user->setPassword(password_hash($data['password'], PASSWORD_DEFAULT));
    $user->setBirthdate(new DateTime($data['birthdate']));
    $user->setGender(
      match ($data['gender']) {
        'M' => Gender::M,
        'F' => Gender::F,
        'O' => Gender::O
      }
    );
    $user->save();
    $user = User::find($user->getId());
    $target_dir = "../uploads/profile";
    $file_name =  $user->getId() . '.' . pathinfo($files['image']['name'], PATHINFO_EXTENSION);
    $target_file = $target_dir . '/' . $file_name;
    move_uploaded_file($files['image']['tmp_name'], $target_file);
    $user->setImage($file_name);
    $user->update();
    echo "<script> location.href='?View=signin'; </script>";
  }

  public function login($data) {
    $user = new User();
    $user = User::findWithEmail($data['email']);
    if (!$user) throw new Exception("E-mail or Password is incorrect!");
    if ($user && password_verify($data['password'], $user->getPassword())) {
      $user->UnsetCon();
      $_SESSION['user'] = serialize($user);
      echo "<script> location.href='?View=home'; </script>";
    }
    else throw new Exception("E-mail or Password is incorrect!");
  }
}