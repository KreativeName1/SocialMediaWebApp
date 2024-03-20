<?php
namespace App\Models;
class Model {
   protected ?Connection $db;
    function __construct() {
      $this->db = new Connection();
    }
    public function UnsetCon() {
      $this->db = null;
    }
    public function SetCon() {
      $this->db = new Connection();
    }
    public function __destruct() {
      if ($this->db != null) $this->db->disconnect();
    }

}