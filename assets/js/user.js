$(document).ready(function(){

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


    $.ajax({
        url: "get_users",
        dataType: "json",
        success: function(data) {
            generateTable(data, $("div#users-table").children("table"));
        }
    });

    function generateTable(data, table) {

        for (var i =0; i < data.length; i++) {
            table.append("<tr>" +
                "<td class='usernamecell'>"+data[i].username+"</td>" +
                "<td class='lastcell'>"+data[i].last_name+"</td>" +
                "<td class='firstcell'>"+data[i].first_name+"</td>" +
                "<td class='emailcell'>"+data[i].email_address+"</td>" +
                "<td class='posnocell'>"+data[i].position_no+"</td>" +
                "<td class='poscell'>"+data[i].position+"</td>" +
                "<td id='edit-user'> <img  class='user-actions' src='/assets/media/edit.png'></td>" +
                "<td id='delete-user'> <img class='user-actions' src='/assets/media/delete.png'></td>" +
                "</tr>");
        }
    }

    $(document).on("click","td#edit-user", function(){
        $("div.all").css("filter","blur(7px)");
        $("div.edituser").fadeIn();

        var reference = $(this);

        $("input#eusername").val(reference.siblings("td.usernamecell").html());
        $("input#efirstname").val(reference.siblings("td.firstcell").html());
        $("input#elastname").val(reference.siblings("td.lastcell").html());
        $("input#eemail").val(reference.siblings("td.emailcell").html());
        $("select#epos").val(reference.siblings("td.poscell").html());
        $("input#epassword").val("");
        $("input#ecpassword").val("");
        $("p.editing").html("");

        $(document).on("click", "button#edit-button", function(){

            var username = $("input#eusername").val();
            var password = $("input#epassword").val();
            var cpassword = $("input#ecpassword").val();
            var firstname = $("input#efirstname").val();
            var lastname = $("input#elastname").val();
            var email = $("input#eemail").val();
            var position = $("select#epos").val();

            if (!$.trim(username) || !$.trim(password) || !$.trim(cpassword)
                || !$.trim(firstname) || !$.trim(lastname) || !$.trim(email)) {

                $("p.editing").show();
                $("p.editing").html("Please fill up all fields");
            }

            else if (username.length < 6 || username.length > 25) {
                $("p.editing").show();
                $("p.editing").html("Username should be 6 - 25 characters long");
            }

            else if (password != cpassword) {
                $("p.editing").show();
                $("p.editing").html("Password do not match");
            }

            else {
                $("p.editing").hide();

                $.ajax({
                    url: "edit_user",
                    type: "POST",
                    data: {
                        username: username,
                        password: password,
                        firstname: firstname,
                        lastname: lastname,
                        email: email,
                        position: position
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                });
            }
        });


    });

    $("div#add-user").on("click", function(){
        $("div.all").css("filter","blur(7px)");
        $("div.adduser").fadeIn();

        $("div#add-user-form").children("input").each(function(){
            $(this).val("");
        });


    });

    $("button#add-button").on("click", function(){

        var username = $("input#username").val();
        var firstname = $("input#firstname").val();
        var lastname = $("input#lastname").val();
        var password = $("input#password").val();
        var cpassword = $("input#cpassword").val();
        var email = $("input#email").val();
        var position = $("select#pos").val();

        if (!$.trim(username) || !$.trim(firstname) || !$.trim(lastname)
            || !$.trim(password) || !$.trim(cpassword) || !$.trim(email)) {
            $("p.adding").show();
            $("p.adding").html("Please fill up all fields");
        }

        else if (username.length < 1 || username.length > 25) {
            $("p.adding").show();
            $("p.adding").html("Username should be 6 - 25 characters long");
        }

        else if (password != cpassword) {
            $("p.adding").show();
            $("p.adding").html("Password do not match");
        }

        else {
            $("p.adding").hide();

            $.ajax({
                url: "add_user",
                type: "post",
                data: {
                    username : username,
                    firstname: firstname,
                    lastname : lastname,
                    password: password,
                    position: position,
                    email: email
                },
                success: function() {
                    $("div.adduser").fadeOut();
                    $("div.all").css("filter","none");

                    var posno;

                    switch(position) {
                        case "Admin": posno = 1; break;
                        case "Project Head": posno = 2; break;
                        case "Sales Head": posno = 3; break;
                        case "Financial Officer": posno = 4; break;
                        case "Inventory Manager": posno = 5; break;
                        case "Shipper": posno = 6; break;
						case "Supplier": posno = 7; break; 
                    }

                    $("table#list-user").append("<tr>" +
                        "<td class='usernamecell'>"+username+"</td>" +
                        "<td class='lastcell'>"+lastname+"</td>" +
                        "<td class='firstcell'>"+firstname+"</td>" +
                        "<td class='emailcell'>"+email+"</td>" +
                        "<td class='posnocell'>"+posno+"</td>" +
                        "<td class='poscell'>"+position+"</td>" +
                        "<td id='edit-user'> <img  class='user-actions' src='/assets/media/edit.png'></td>" +
                        "<td id='delete-user'> <img class='user-actions' src='/assets/media/delete.png'></td>"+
                        "</tr>");
                },
                error: function(d) {
                    $("p.error").html("Username exists!");
                    $("p.error").css("color", "red");
                    $("p.error").show();
                    console.log(d.responseText);
                }
            });
        }
    })

    $("#add-user-form").children("span.close").on("click",function(){
        $(this).parent().parent().fadeOut();
        $("div.all").css("filter","none");
    });

    $("#edit-user-form").children("span.close").on("click",function(){
        $(this).parent().parent().fadeOut();
        $("div.all").css("filter","none");
    });

    function callBack() {
        setTimeout(function(){
            $("p.msg").fadeOut();
        }, 2000);
    }


    $(document).on("click", "td#delete-user", function(){
        var user = $(this).siblings("td.usernamecell").html();

        if (user == $("#session_un").html()) {

            setTimeout(function() {
                $("p.msg").html("You cannot delete your own account!");
                $("p.msg").fadeIn();
                callBack();

            }, 0.1);

        }
        else {

            $("div.all").css("filter", "blur(5px)");
            $("div.deleteuser").fadeIn();

            $(document).on("click", "button#deleteno", function () {
                $("div.overlay").fadeOut();
                $("div.all").css("filter", "none");
            });

            $(document).on("click", "button#deleteyes", function () {

                $.ajax({
                    type: "post",
                    url: "delete_user",
                    data: {
                        username: user
                    },
                    success: function () {
                        $("div.overlay").fadeOut();
                        $("div.all").css("filter", "none");

                        location.reload();
                    },
                    error: function (data) {
                        console.log(data.responseText);
                    }
                });
            });
        }
    });

});
