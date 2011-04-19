$(document).ready(function() {

  
  $("td.empty").hover(function() {
    $(this).find('img').attr("src", "http://localhost/img/x.png");
  },
  function(){
    $(this).find('img').attr("src", "http://localhost/img/empty.png");
  });
  $("td.empty").click(function() {
    $(this).find('img').attr("src", "http://localhost/img/o.png");
    //$(this).find
    var space = $(this).attr("id");
    var base = "http://localhost/index.php/startgame/play/";
    var game_id = $("table.gameboard").attr("game_id");
    var url = base.concat(game_id,"/",space);
 //   var output = ("<p>").concat(url,"</p>");

 //   $(".JSoutput")


    $.ajax({
        method: "get",
        url: url,
        success: function(html){
                window.location.reload(true);
            }
    });
    
  });
});
