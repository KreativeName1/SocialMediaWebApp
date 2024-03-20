<?php
namespace App\Models;
use PDO;
class Connection {
    private string $host;
    private string $dbname;
    private string $user;
    private string $password;
    private string $charset;
    private int $port;
    private ?PDO $pdo;

    public function getConnection(): PDO {
        return $this->pdo;
    }

    public function __construct() {
        $config = require '../Config/database.php';
        $this->host = strval($config['default']['host']);
        $this->dbname =  strval($config['default']['dbname']);
        $this->user =  strval($config['default']['user']);
        $this->password =  strval($config['default']['password']);
        $this->port =  $config['default']['port'];
        $this->charset = 'utf8mb4';
        $this->connect();
    }

    private function connect(): void {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset;port=$this->port";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
    }
    public function disconnect(): void {
        $this->pdo = null;
    }

    public function query(string $sql, array $params) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }


    public function select($table, $id = ''): array {
        if ($id == '') {
            $stmt = $this->pdo->query("SELECT * FROM $table");
            return $stmt->fetchAll();
        } else {
            $stmt = $this->pdo->query("SELECT * FROM $table WHERE id = $id");
            return $stmt->fetch();
        }
    }

    public function insert($table, $data): void {
        $keys = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $stmt = $this->pdo->prepare("INSERT INTO $table ($keys) VALUES ('$values')");
        $stmt->execute();
    }

    public function update($table, $data, $where): void {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $stmt = $this->pdo->prepare("UPDATE $table SET $set WHERE $where");
        $stmt->execute();
    }

    public function delete($table, $where): void {
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE $where");
        $stmt->execute();
    }
}