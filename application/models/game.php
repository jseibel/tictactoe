<?php
class Game extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->db->query("CREATE TABLE IF NOT EXISTS gametrack(
                            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                            PRIMARY KEY(id),
                            moves VARCHAR(100),
                            players VARCHAR(100),
                            colX INT,
                            colO INT,
                            complete BOOLEAN,
                            winner INT
                        )");

                            
    }

    public function reset_db(){
        $this->db->query("DROP TABLE IF EXISTS gametrack");
        $this->db->query("CREATE TABLE gametrack(
                            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                            PRIMARY KEY(id),
                            moves VARCHAR(100),
                            players VARCHAR(100),
                            colX INT,
                            colO INT,
                            complete BOOLEAN,
                            winner INT
                        )");
        $this->db->query("INSERT INTO gametrack VALUES(
                            1,
                            '21:12',
                            '506-201',
                            0,
                            1,
                            FALSE,
                            0
                        )");
        $this->db->query("INSERT INTO gametrack VALUES(
                            25,
                            '21:15:24',
                            '201:506:172',
                            2,
                            3,
                            FALSE,
                            0
                        )");

    }


    public function getGameData($game_id){
        $this->db->from('gametrack');
        $this->db->where('id',$game_id);
        $query = $this->db->get();

        if ($query->num_rows() <= 0){
            return false;
        }

        $row = $query->row_array();
        $game_data['colX'] = $row['colX'];
        $game_data['colO'] = $row['colO'];
        $game_data['complete'] = $row['complete'];
        $game_data['winner'] = $row['winner'];

        $moves = $row['moves'];

        $board = $this->get_board($moves);
        $game_data['board'] = $board;

        $curr_player = $this->getCurrPlayer($moves);
        $game_data['curr_player'] = $curr_player;
        
        return $game_data;
    }

    public function make_play($game_id,$space){
        $this->db->from('gametrack');
        $this->db->where('id',$game_id);
        $query = $this->db->get();

        if ($query->num_rows() <= 0){
            return false;
        }
        $location = 0;
        if ($space[0] == 'a'){
            $location = (int)$space[1];
        }elseif ($space[0] == 'b'){
            $location = (int)$space[1]+3;
        }else{
            $location = (int)$space[1]+6;
        }


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


        //check if game is complete
        if($return = $this->isGameComplete($updated_moves)){
            $data['complete'] = 1;
            $data['winner'] = $return;
        }

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

    private function getCurrPlayer($moves){
        $move_list = explode(":",$moves);

        $last_move = end($move_list);
        $curr_player = 2;
        if ((int)$last_move[0] == 2){
            $curr_player = 1;
        }
        return $curr_player;

    }


    private function isGameComplete($moves){
        $board = $this->get_board($moves);
        //check for 3 in a row/col 
        for ($i = 0; $i < 3; $i+=1){

            //check rows
            $j = $i*3;
            if ($board[$j] != 0){
                if ($board[$j] == $board[$j+1] && $board[$j+1] == $board[$j+2]){
                    return $board[$j];
                }
            }
            //check cols
            $j = $i;
            if ($board[$j] != 0){
                if ($board[$j] == $board[$j+3] && $board[$j+3] == $board[$j+6]){
                    return $board[$j];
                }
            }
        }
        //check diags
        if ($board[0] != 0 || $board[2] != 0){
            if ($board[0] == $board[4] && $board[4] == $board[8]){
                return $board[0];
            }elseif($board[2] == $board[4] && $board[4] == $board[6]){
                return $board[2];
            }
        }

        $move_list = explode(":", $moves);
        if (count($move_list) == 9){
            return 3;
        }

        return false;
    }

    public function createNewGame(){
      $id = rand(0,4294967295);
      $query = $this->db->query("SELECT *
                                 FROM gametrack
                                 WHERE id=$id");
      while ($query->num_rows() != 0){
        $id = rand(0,4294967295);
        $query = $this->db->query("SELECT *
                                   FROM gametrack
                                   WHERE id=$id");
      }
      $colX = rand(0,4);
      $colO = rand(0,4);
      while ($colO == $colX){
        $colO = rand(0,4);
      }

      $first_move = ((string)rand(1,2)).((string)rand(0,8));

      $data['id'] = $id;
      $data['moves'] = $first_move;
      $data['players'] = "";
      $data['colX'] = $colX;
      $data['colO'] = $colO;
      $data['complete'] = '0';
      $data['winner'] = '0';

      $this->db->insert('gametrack',$data);
 
      return $id;
 
    }
}
?>
