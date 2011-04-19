<?php
class Startgame extends CI_Controller {

    var $base;
    var $css;

    public function __construct(){
        parent::__construct();
        $this->base = $this->config->item('base_url');
        $this->css = $this->config->item('css');
        $this->load->model('game');

    }

    public function index(){
        $this->load->library('menu');
        $mymenu = $this->menu->show_menu();
        $data['menu'] = $mymenu;
        $this->load->view('start',$data);

    
    }

    public function hello($name = 'Guest'){
        $data['css'] = $this->css;
        $data['base'] = $this->base;
        $data['myTitle'] = 'Welcome to the site';
        $data['text'] = "Hello, $name, now were cooking with gas!";
        $this->load->view('testview',$data);
        
    }

    public function newgame(){
        $query = $this->db->get('gametrack');
        $data['query'] = $query;
        
        $this->load->view('testdb', $data);
    
    }

    public function view($game_id){
        $this->load->helper('html');
        $data = $this->game->get_board_moves($game_id);
        if (!$data['board']){
            $data['error'] = true;
        }else{
            $data['error'] = false;
        }
        //$data['board'] = $game_data['board'];

        $data['base'] = $this->base;
        $data['css'] = $this->css;
        $data['game_id'] = $game_id;
        $this->load->view('game',$data);
    }

    public function play($game_id,$space){
        $this->game->make_play($game_id,$space);
        echo "TESTTESTTEST";
        return "<html>Success!</html>";
    }

    public function reset(){
        $this->game->reset_db();
        echo "DB RESET";
    }

}

?>
