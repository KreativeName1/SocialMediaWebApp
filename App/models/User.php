<?php
namespace App\Models;
use Exception;
use DateTime;
use PDO;
enum Gender {
  case M;
  case F;
  case O;

  public function display() {
    return match($this) {
      Gender::M => "Male",
      Gender::F => "Female",
      Gender::O => "Other"
    };
  }
}

class User extends Model 
{
  private int $id;
  private string $firstname;
  private string $lastname;
  private string $username;
  private DateTime $birthdate;
  private Gender $gender;
  private string $email;
  private string $password;
  private DateTime $created_at;
  private DateTime $updated_at;
  private ?string $image;

  public function getId(): int {
    return $this->id;
  }
  public function setFirstname(string $firstname): void {
    $this->firstname = $firstname;
  }
  public function getFirstname(): string {
    return $this->firstname;
  }
  public function setLastname(string $lastname): void {
    $this->lastname = $lastname;
  }
  public function getLastname(): string {
    return $this->lastname;
  }
  public function setUsername(string $username): void {
    $this->username = $username;
  }
  public function getUsername(): string {
    return "@".$this->username;
  }
  public function setBirthdate(DateTime $birthdate): void {
    $this->birthdate = $birthdate;
  }
  public function getBirthdate(): DateTime {
    return $this->birthdate;
  }
  public function setEmail(string $email): void {
    $this->email = $email;
  }
  public function getEmail(): string {
    return $this->email;
  }
  public function setPassword(string $password): void {
    $this->password = $password;
  }
  public function getPassword(): string {
    return $this->password;
  }
  // setGender and getGender methods
  public function setGender(Gender $gender): void {
    $this->gender = $gender;
  }
  public function getGender():Gender {
    return $this->gender;
  }
  public function getCreatedAt(): DateTime {
    return $this->created_at;
  }
  public function getUpdatedAt(): DateTime {
    return $this->updated_at;
  }
  public function setImage(string $image): void {
    $this->image = $image;
  }
  public function getImage(): string {
    return $this->image;
  }
  public function __construct()
  {
      parent::__construct();
  }
  public function __destruct()
  {
      parent::__destruct();
  }
  public function save(): void {
    $data = [
      'firstname' => $this->firstname,
      'lastname' => $this->lastname,
      'username' => $this->username,
      'birthday' => $this->birthdate->format('Y-m-d'),
      'gender' =>  match($this->gender) {
        Gender::M => '1',
        Gender::F => '2',
        Gender::O => '3'
      },
      'email' => $this->email,
      'password' => $this->password,
    ];
    $this->db->insert('user', $data);
    $this->id = (int)$this->db->getConnection()->lastInsertId();
  }
  public function update(): void {
    $data = [
      'firstname' => $this->firstname,
      'lastname' => $this->lastname,
      'birthday' => $this->birthdate->format('Y-m-d'),
      'gender' =>  match($this->gender) {
        Gender::M => '1',
        Gender::F => '2',
        Gender::O => '3'
      },
      'email' => $this->email,
      'password' => $this->password,
      'image' => $this->image
    ];
    $this->db->update('user', $data, "id = $this->id");
  }
  public function FromArray(array $arr) {
    $this->id = $arr['id'];
    $this->firstname = $arr['firstname'];
    $this->lastname = $arr['lastname'];
    $this->username = $arr['username'];
    $this->password = $arr['password'];
    $this->birthdate = DateTime::createFromFormat('Y-m-d', $arr['birthday']);
    $this->email = $arr['email'];
    $this->image = $arr['image'];
    $this->created_at = DateTime::createFromFormat('Y-m-d H:i:s', $arr['created_at']);
    $this->updated_at = DateTime::createFromFormat('Y-m-d H:i:s', $arr['updated_at']);
    $this->gender = match ($arr['gender']) {
      1 => Gender::M,
      2 => Gender::F,
      3 => Gender::O
    };
  }
  public static function find(int $id): User {
    $db = new Connection();
    $arr = $db->select('user', $id);
    $user = new User();
    $user->FromArray($arr);
    return $user;
  }
  public static function findWithEmail(string $email): User {
    $db = new Connection();
    $stmt = $db->query("SELECT * FROM user WHERE email = :em ", [":em" => $email]);
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$arr) throw new Exception("Email does not exist!");
    $user = new User();
    $user->FromArray($arr);
    return $user;
  }
  public static function findWithUsername(string $username) {
    $db = new Connection();
    $username = str_replace('@', '', $username);
    $stmt = $db->query("SELECT * FROM user WHERE username = :un ", [":un" => $username]);
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    $user = new User();
    $user->FromArray($arr);
    return $user;
  }
  public static function all(): array {
    $db = new Connection();
    return $db->select('user');
  }
  public function delete(int $id): void {
    $this->db->delete('user', "id = $id");
  }
}