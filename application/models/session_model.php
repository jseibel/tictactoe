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

  public function inputSurveyInfo($survey_string){
    $data = array('survey_info' => $survey_string);
		$this->db->where('session_id', $this->session->userdata('session_id'));
    $this->db->update('session_rec',$data);

  }

  public function checkSurvey($id){
    $this->db->select('survey_info')->from('session_rec')->where('session_id',$id)->where('survey_info',null);
    $result = $this->db->get();
    if ($result->num_rows() == 0){
      return true;
    }else{
      return false;
    }

  }

}


?>
