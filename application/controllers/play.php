<?php
class Play extends CI_Controller {

    var $base;
    var $css;
    var $color_array;

    public function __construct(){
        parent::__constuct();
        $this->base = $this->config->item('base_url');
        $this->css = $this->config->item('css');
        $this->load->model('game');
        //$this->load->model('session_model');

        $this->color_array = array("black","red","blue","green","yellow");

    }

    public function index(){
//      if ($this->session->userdata('survey_info'){
//      }

    }


    public function newgame(){
      $game_id = $this->game->createNewGame();
      //$game_id = 1;
      $this->load->helper('url');
      //echo "test";
        
      redirect("/play/view/$game_id");
    
    }

    public function view($game_id){
        $this->load->helper('html');
        $data = $this->game->getGameData($game_id);
        if (!$data['board']){
            $data['error'] = true;
        }else{
            $data['error'] = false;
        }
        //$data['board'] = $game_data['board'];
        
        $data['colX'] = $this->getColorNumToString((int)$data['colX']);
        $data['colO'] = $this->getColorNumToString((int)$data['colO']);

        $data['base'] = $this->base;
        $data['css'] = $this->css;
        $data['game_id'] = $game_id;
        $this->load->view('game',$data);
    }

    public function makePlay($game_id,$space){
        $this->game->make_play($game_id,$space);
    }

    public function reset(){
        $this->game->reset_db();
        echo "DB RESET";
    }

    private function getColorNumToString($color_num){
        return $this->color_array[$color_num];
    }
  
}

?>
