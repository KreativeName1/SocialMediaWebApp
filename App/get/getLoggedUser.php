<?php
session_start();
use App\Models\Gender;
require_once '../models/Connection.php';
require_once '../models/Model.php';
require_once '../models/User.php';
$user = unserialize($_SESSION['user']);
if (isset($_SESSION['user']))
$arr =  [
  "id" =>  $user->getId(),
  "firstname" => $user->getFirstname(),
  "lastname" => $user->getLastname(),
  "email" => $user->getEmail(),
  "birthdate" => $user->getBirthdate()->format('Y-m-d'),
  "created_at" => $user->getCreatedAt()->format('Y-m-d H:i:s'),
  "updated_at" => $user->getUpdatedAt()->format('Y-m-d H:i:s'),
  "gender" => match ($user->getGender()) {
    Gender::M => 1,
    Gender::F => 2,
    Gender::O => 3
  },
  "image" => $user->getImage()
];
else $arr = [];

echo json_encode($arr);
