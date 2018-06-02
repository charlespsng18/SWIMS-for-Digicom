$(document).ready(function(){
    $("tr#home").on("click", function(){
        window.location.replace("admin");
    });

    $("tr#users").on("click", function(){
        window.location.replace("user");
    });

    $("tr#products").on("click", function(){
        window.location.replace("products");
    });

    $("tr#packages").on("click", function(){
        window.location.replace("packages");
    });

    $("tr#inventory").on("click", function(){
        window.location.replace("inventory");
    });

    $("tr#orders").on("click", function(){
        window.location.replace("orders");
    });

    $.ajax({
        url: "get_users",
        dataType: "json",
        success: function(data) {

        var username = $("p#session_un").text();

    for (var i=0; i < data.length; i++) {
        if (username == data[i].username) {
            $("h2#greet").html("Hello, " + data[i].first_name + "!");
        }
    }
}
    });
});