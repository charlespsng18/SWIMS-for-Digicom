$(document).ready(function(){


    $.ajax({
       url: "get_users",
       dataType: "json",
       success: function(data) {

           var username = $("p#session_un").text();

           for (var i=0; i < data.length; i++) {
               if (username == data[i].username)
                   $("h2#greet").html("Welcome, "+data[i].first_name+"!");
           }

       }
    })

    $("div.main-menu-options").hover(
        function(){
            $(this).css("background-color", "#436d70    ");
            $(this).children("img").css("visibility", "hidden");
            $(this).children("h2").css("visibility", "visible");
            $(this).css("transition", "0.3s all");

    }
    ,   function() {
            $(this).css("background-color", "cadetblue");
            $(this).children("img").css("visibility", "visible");
            $(this).children("h2").css("visibility", "hidden");
            $(this).css("transition", "0.3s all");
    });


});
