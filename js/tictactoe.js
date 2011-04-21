$(document).ready(function() {
  
  if ($("table.gameboard").attr("complete") == "0"){
      $("td.empty").hover(function() {
          if ($("table.gameboard").attr("curr") == "1"){
            $(this).find('img').attr("src", "http://localhost/img/x.png");
          }else{
            $(this).find('img').attr("src", "http://localhost/img/o.png");
          }
      },
      function(){
        $(this).find('img').attr("src", "http://localhost/img/empty.png");
      });
      $("td.empty").click(function() {
          if ($("table.gameboard").attr("curr") == "1"){
            $(this).find('img').attr("src", "http://localhost/img/x.png");
          }else{
            $(this).find('img').attr("src", "http://localhost/img/o.png");
          }
        var space = $(this).attr("id");
        var base = "http://localhost/index.php/startgame/play/";
        var game_id = $("table.gameboard").attr("game_id");
        var url = base.concat(game_id,"/",space);


        $.ajax({
            method: "get",
            url: url,
            success: function(html){
                    window.location.reload(true);
                }
        });
    
    });
  };
});


