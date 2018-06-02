$(document).ready(function(){

    //validate login
    $(document).on("click", "#loginbtn", function(){

        var username = $("#username").val();
        var password = $("#password").val();
        var error = $("p.error");

        if (!$.trim(username) || !$.trim(password)) {

            error.html("Please fill up all fields");
            error.css("visibility", "visible");
        }
        else {
            $.ajax({
                url: "validate",
                type: "POST",
                data: {
                    username: username,
                    password: password
                },
                dataType: "json",
                success: function (data) {
                    if (data != 0) {
                        error.html("Login successful!");
                        error.css("color", "green");
                        error.css("visibility", "visible");

                        var position = data[0].position_no;

                        if (position == 1) {
                            window.location.replace("admin");
                        }
                        else if (position == 6) {
                            window.location.replace("shipper");
                        }
						else if (position ==7){
							window.location.replace("supplier/"+username);
						}

                    }
                    else {
                        error.html("Login failed");
                        error.css("color", "red");
                        error.css("visibility", "visible");
                    }
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            });
        }

    });
});