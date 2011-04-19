<?php
class Game extends CI_Model {
    public function __construct(){
        parent::__construct();

                            
    }

    public function reset_db(){
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

        $row = $query->row_array();
        $game_data['colX'] = $row['colX'];
        $game_data['colO'] = $row['colO'];

        $moves = $row['moves'];
        $board = $this->get_board($moves);
        /*$move_list = explode(":",$moves);
        foreach ($move_list as $move){
            $tile = (int)$move[0];
            $space = (int)$move[1];
            $board[$space]=$tile;
        }*/
        $game_data['board'] = $board;
        
        return $game_data;
    }

    public function make_play($game_id,$space){
        $this->db->from('gametrack');
        $this->db->where('id',$game_id);
        $query = $this->db->get();

        if ($query->num_rows() <= 0){
            return false;
        }
        $location = ((int)$space[0]) - 97 + ((int)$space[1]) - 1;
        assert ($location == 0);

        $row = $query->row_array();
        $moves = $row['moves'];
        $move_list = explode(":",$moves);
        $pre_move_count = count($move_list);
        $last = end($move_list);
        $next = 0;
        if ((int)$last[0] == 1){
            $next = 2;
        }else{
            $next = 1;
        }
        $updated_moves = $moves.":".$next.$location;
        $post_moves = explode(":",$updated_moves);
        $post_move_count = count($post_moves);
        assert($pre_move_count+1 == $post_move_count); 
        //$sql = "UPDATE gametrack "."SET moves=\"".$updated_moves."\" WHERE id=\"i".$game_id."\"";
        //$this->db->query($sql);

        $data = array('moves' => $updated_moves);

        $this->db->from('gametrack');
        $this->db->where('id',$game_id);
        $this->db->update('gametrack',$data);
    }

    private function get_board($moves){
        $board = array(0,0,0,0,0,0,0,0,0);
        $move_list = explode(":",$moves);
        foreach ($move_list as $move){
            $tile = (int)$move[0];
            $space = (int)$move[1];
            $board[$space]=$tile;
        }
        
        return $board;

    }
}
?>
