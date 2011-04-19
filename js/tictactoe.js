$(document).ready(function() {

  
  $("td.empty").hover(function() {
    $(this).find('img').attr("src", "http://localhost/img/x.png");
  },
  function(){
    $(this).find('img').attr("src", "http://localhost/img/empty.png");
  });
  $("td.empty").click(function(event) {
    $(this).find('img').attr("src", "http://localhost/img/o.png");
    //$(this).find
    var space = $(this).attr("id");
    var base = "http://localhost/index.php/startgame/play/";
    var url = base.concat(space,"/");

    $.ajax({
        method: "get",
        url: url,
        beforeSend: function(){
                window.location.reload(true);
            }
    });
    
    event.preventDefault();
  });
});
