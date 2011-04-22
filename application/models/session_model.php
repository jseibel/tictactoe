<?php
class Session_model extends CI_Model {

  public function __construct(){
    parent::__construct();
    $this->db->query("CREATE TABLE IF NOT EXISTS session_rec(
                      session_id varchar(40) DEFAULT '0' NOT NULL,
                      PRIMARY KEY(session_id),
                      survey_info varchar(40),
                      last_activity int(10) unsigned DEFAULT '0' NOT NULL
                    )");
 
  }

}


?>
