<html>
<head>
    <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'http:\/\/www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
    <title>TicTacToe</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $base.$css."game.css";?>" media="screen" />
    <script src="http://localhost/js/jquery.min.js" type="text/javascript" ></script>
    <script src="http://localhost/js/tictactoe.js" type="text/javascript" ></script>
    <!-- <script src="http://localhost/js/prototype.js" type="text/javascript" ></script> -->
</head>
<body>
    <h1><?php if ($complete){
                if ($winner == 1){
                    echo "X WINS!!!";
                }elseif($winner == 2){
                    echo "O WINS!!!";
                }else{
                    echo "DRAW";
                }
              }else{
                  if ($curr_player == 1){
                    echo "X";
                  }else{
                    echo "O";
                  }
              }       
        ?></h1>
    <center>
    <table class="gameboard" game_id="<?=$game_id?>" curr="<?=$curr_player?>" colX="<?=$colX?>" colO="<?=$colO?>" complete="<?=$complete?>">
        <?php $count = 0;?>
        <?php foreach ($board as $tile){
            $col = $count % 3;
            if ($col == 0){
                echo "<tr>";
            }

            if ($count/3 <1){
                $row = "a";
            }elseif ($count/3 < 2){
                $row = "b";
            }else{
                $row = "c";
            }

            echo "<td id=\"".$row.$col."\" class=\"";

            if ($tile == 0){
                echo "empty\" >";
                echo img("img/empty.png");
            }elseif($tile == 1){
                echo "x\" >";
                echo img("img/x_".$colX.".png");
            }else{
                echo "o\" >";
                echo img("img/o_".$colO.".png");
            }

            echo "</td>";

            if ($count % 3 == 2){
                echo "</tr>";
            }
            $count += 1;
        }
        ?>
    </table>
    </center>
    <div class="JS_output"></div>
</body>
</html>

