<?php
class Game extends CI_Model {
    public function __construct(){
        parent::__construct();

                            
    }

    private function reset_db(){
        $this->db->query("DROP TABLE IF EXISTS gametrack");
        $this->db->query("CREATE TABLE gametrack(
                            id INT NOT NULL AUTO_INCREMENT,
                            PRIMARY KEY(id),
                            moves VARCHAR(20),
                            players VARCHAR(100),
                            colX INT,
                            colO INT
                        )");
        $this->db->query("INSERT INTO gametrack VALUES(
                            1,
                            '21:12',
                            '506-201',
                            0,
                            1
                        )");
        $this->db->query("INSERT INTO gametrack VALUES(
                            25,
                            '21:15:24',
                            '201:506:172',
                            2,
                            3
                        )");

    }


    public function get_board_moves($game_id){
        $this->db->from('gametrack');
        $this->db->where('id',$game_id);
        $query = $this->db->get();

        if ($query->num_rows() <= 0){
            return false;
        }

        $board = array(0,0,0,0,0,0,0,0,0);
        $row = $query->row_array();
        $moves = $row['moves'];
        $game_data['colX'] = $row['colX'];
        $game_data['colO'] = $row['colO'];
        $move_list = explode(":",$moves);
        foreach ($move_list as $move){
            $tile = (int)$move[0];
            $space = (int)$move[1];
            $board[$space]=$tile;
        }
        $game_data['board'] = $board;
        
        return $game_data;
    }
}
?>
