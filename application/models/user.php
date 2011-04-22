<?php
class User extends CI_Model {

  public function __construct(){
    parent::__construct();
  }

  public function reset_db(){
    
    $this->db->query("DROP TABLE IF EXISTS gametrack");
    $this->db->query("CREATE TABLE gametrack(
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      session
                      )");

  }


}

?>
