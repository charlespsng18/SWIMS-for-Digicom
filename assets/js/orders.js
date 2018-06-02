$(document).ready(function(){

    var error = $("div.errormsg");
    var suc =  $("div.successmsg");
    var cart = [];

    $.ajax({
        url: "get_orders",
        dataType: "json",
        success: function(data) {
            if (data.length!=0)
                showOrders(data, $("table#order-table"));
            else {
                $("div#for-orders").append("<p class='empty'> There" +
                    " are no orders at the moment </p>");
            }
        }
    });

    function showOrders(data, table) {
        table.append("<tr> " +
            "<th> Order No.</th>"+
            "<th> Customer Name</th>"+
            "<th> Business Name</th>"+
            "<th> Address</th>"+
            "<th> Order Created </th>"+
            "<th> Required Date </th>"+
            "<th> Status </th>"+
            "</tr>");

        for (var i = 0; i < data.length; i++) {
            table.append("<tr class='view-details'>" +
                "<td class='oi'>"+data[i].order_no+"</td>"+
                "<td>"+data[i].customer_name+"</td>"+
                "<td>"+data[i].business_name+"</td>"+
                "<td>"+data[i].ship_to+"</td>"+
                "<td>"+data[i].date_created+"</td>"+
                "<td>"+data[i].required_date+"</td>"+
                "<td>"+data[i].status+"</td>"+
                "</tr>");
        }
    }

    $("button#add-order").on("click",function(){
        $("div.all").css("filter" , "blur(20px)");
        $("div#right").css("filter" , "blur(7px)");
        $("div.addorder").fadeIn();
    });

    $("button#type1").on("click", function(){
        $("div#add-order-form").fadeOut();
        $("div#select-products").fadeIn();
    });

    $.ajax({
        url: "get_individual_products",
        success: function(data) {
            if (data.length == 0) {
                $("#for-products").append("<h1> There are no individual products yet </h1>");
            }
            else {
                listProducts(data, $("table#listprods"));
            }
        },
        dataType: "json"
    });

    function listProducts(data, table) {
        table.append("<tr> " +
            "<th style='display: none;'>Product ID</th>"+
            "<th>Category </th>" +
            "<th>Product Name </th>" +
            "<th>Quantity in Stock </th>" +
            "<th>Price </th>" +
            "<th>Quantity </th>" +
            "</tr>");

        for (var i =0; i< data.length; i++) {
            table.append("<tr>" +
                "<td style='display: none;' class='prod'>"+data[i].product_id+"</td>" +
                "<td>"+data[i].category_name+"</td>" +
                "<td class='pn'>"+data[i].product_name+"</td>" +
                "<td class='qs'>"+parseInt(data[i].quantity_in_stock)+"</td>" +
                "<td class='bpr'>"+data[i].buy_price+"</td>" +
                "<td class='am'><input class='qty' min='1' type='number'></td>" +
                "<td> <button class='add-to-cart'> ADD TO CART</button></td>" +
                "</tr>");

        }
    }

    $("button#to-details").on("click", function(){

        if (cart.length == 0) {
            setTimeout(function() {
                error.html("Cart is still empty. Please add products");
                error.slideDown();
                callBack();

            }, 0.1);
        }
        else {
            $("div#select-products").fadeOut();
            $("div#input-customer-details").fadeIn();
        }
    });

    function callBack() {
        setTimeout(function(){
            error.slideUp();
        }, 2000);
    }

    $(document).on("click","button.add-to-cart", function(){

        var quan = parseInt($(this).parent().siblings("td.am").children(".qty").val());
        var qStock = $(this).parent().siblings("td.qs").html();
        var kyu = $(this).parent().siblings("td.am").children(".qty");

        if (!quan || quan <= 0 ) {
            setTimeout(function() {
                error.html("Please enter a valid quantity");
                error.slideDown();
                callBack();

            }, 0.1);

            kyu.val("");
        }
        else if (quan > qStock) {
            setTimeout(function() {
                error.html("Not enough supplies. Contact supplier to replenish inventory");
                error.slideDown();
                callBack();

            }, 0.1);

            kyu.val("");
        }
        else {
            var order = $(this).parent().siblings("td.prod").html();
            var pname = $(this).parent().siblings("td.pn").html();
            var bpri = $(this).parent().siblings("td.bpr").html();

            cart.push({
                id: order,
                product_name: pname,
                price: bpri,
                quantity: quan
            });

            $(this).replaceWith("<p style='color: darkgreen'> Added to cart </p>");
            kyu.attr("disabled","true");
        }
    })


    $("button#to-confirm").on("click", function(){
        var customer = $("input#shipto").val();
        var business = $("#bizname").val();
        var loc = $("#address").val();

        if (!$.trim(customer) || !$.trim(business) || !$.trim(loc)) {
            setTimeout(function() {
                error.html("Please fill up all fields");
                error.slideDown();
                callBack();

            }, 0.1);
        }
        else {
            $.ajax({
                url: "get_date",
                dataType: "json",
                success: function(data) {
                    $("#dateCreated").html(data.order_created);
                    $("#dateShip").html(data.order_deliver);
                }
            });

            $("div#input-customer-details").fadeOut();
            $("div#confirm-window").fadeIn();

            $("span#cname").html(customer);
            $("span#bname").html(business);
            $("span#addr").html(loc);

            var total = generateOrdersTable(cart, $("#pr"));

            $("#totalprice").html(total);
             
        }
    });

    function generateInvoiceID() {
        return Math.floor((Math.random() * 100000)+ 1);
    }

    function checkPOS(data) {
        var same = false;
        do {
            var newID = generateInvoiceID();
            for (var i = 0; i < data.length; i++) {
                if (data[i].pull_out_slip_no == newID) {
                    same = true;
                }
                else {
                    same = false;
                }
            }
        }while (same);

        return newID;
    }

    function checkID(data) {
        var same = false;
        do {
            var newID = generateInvoiceID();
            for (var i = 0; i < data.length; i++) {
                if (data[i].invoice_no == newID) {
                    same = true;
                }
                else {
                    same = false;
                }
            }
        }while (same);

        return newID;
    }

    function generateOrdersTable(cart, table) {
        var total = 0;
        for (var i = 0; i < cart.length; i++) {
            table.append("<tr>" +
                "<td>"+cart[i].product_name+"</td>"+
                "<td>"+parseFloat(cart[i].price)+"</td>"+
                "<td>"+parseFloat(cart[i].quantity)+"</td>"+
                "<td>"+(cart[i].price * cart[i].quantity)+"</td>"+
                "</tr>");

            total+=(cart[i].price * cart[i].quantity);
        }

        return total;
    }

    $("button#confirm-order").on("click", function(){

        $.ajax({
            url: "get_orders",
            dataType: "json",
            success: function (data) {
                var order = [];
                order.push({
                    invoice: checkID(data),
                    required_date: $("span#dateShip").html(),
                    create_date: $("span#dateCreated").html(),
                    cart: cart,
                    customer: $("span#cname").html(),
                    business_name: $("span#bname").html(),
                    address: $("span#addr").html(),
                    username: $("p#session_un").html(),
                    terms: $("select#pay").val()
                });

                $.ajax({
                    url: "add_order",
                    type: "POST",
                    data: {
                        order: order
                    },
                    success: function() {
                        $.ajax({
                            url: "get_last_order",
                            success: function(s) {
                                var order = s[0].lastorder;

                                $.ajax({
                                    url: "add_order_details",
                                    type: "post",
                                    data: {
                                        cart: cart,
                                        order: order
                                    },
                                    success: function() {
                                        for (var i = 0; i < cart.length; i++) {
                                            $.ajax({
                                                url: "get_product",
                                                type: "POST",
                                                data: {
                                                    product: cart[i].id,
                                                    quantity_O: cart[i].quantity
                                                },
                                                dataType: "json",
                                                success: function(data) {
                                                    var quan = parseInt(data[0][0].quantity_in_stock);
                                                    quan-=data[1];
                                                    $.ajax({
                                                        url: "update_inventory",
                                                        type: "post",
                                                        data: {
                                                            product: data[0][0].product_id,
                                                            quantity: quan
                                                        },
                                                        success: function(data) {
                                                            location.reload();
                                                        },
                                                        error: function(d) {
                                                            console.log(d.responseText);
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    },
                                    error: function(data) {
                                        console.log(data.responseText);
                                    }
                                });
                            }
                        });
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                });
            }
        });
    });

    $("button#type2").on("click", function() {
        $("div#add-order-form").fadeOut();
        $("div#choose-package-form").fadeIn();
    });

    $("button#package3").on("click", function() {
        $("div#choose-package-form").fadeOut();
        $("div#networking-package-form").fadeIn();
    });

    $("button#np-to-confirm").on("click", function() {
        var totaldist = $("#total-distance").val();
        var numport = $("#port-num").val();

        if (!$.trim(totaldist) || !$.trim(numport) || totaldist < 1 || numport < 1) {
            setTimeout(function() {
                error.html("Please input valid numbers");
                error.slideDown();
                callBack();

            }, 0.1);
        }
        else {
            $("div#networking-package-form").fadeOut();
            $("div#networking-package-confirm").fadeIn();
        }
    });

    $("button#np-to-customerdetails").on("click", function() {
        $("div#networking-package-confirm").fadeOut();
        $("div#input-customer-details").fadeIn();

        $("button#to-confirm").hide();
        $("button#np-to-finalize").show();
    });

    $("button#np-to-finalize").on("click", function() {
        $("div#input-customer-details").fadeOut();
        $("div#np-finalize-order").fadeIn();
    });

    $(document).on("click", "tr.view-details", function(){

        var order = $(this).children("td.oi").html();

        $("div.all").css("filter" , "blur(20px)");
        $("div#right").css("filter" , "blur(7px)");
        $("div.view-order").fadeIn();

        $.ajax({
            url: "get_full_orders",
            dataType: "json",
            success: function(data) {
                viewOrders(data, order, $("table#itemscart"));
                $("span#orderno").html(order);
                $("input#o").val(order);

                for (var i = 0; i < data.length; i++) {
                    if (order == data[i].order_no) {
                        $("span#cust").html(data[i].customer_name);
                        $("span#trm").html(data[i].terms);
                        $("span#user").html(data[i].username);
                        $("span#stat").html(data[i].status);
                        $("span#addre").html(data[i].ship_to);
                    }
                }

                $.ajax({
                    url: "checkPOS",
                    dataType: "json",
                    type: "POST",
                    data: {
                        order: order
                    },
                    success: function(data) {
                        if (data.length > 0) {

                            $("button#view-dr").show();

                            $.ajax({
                                url: "get_orders",
                                dataType: "json",
                                success: function(data) {
                                    for (var i = 0; i < data.length; i++) {
                                        if (order == data[i].order_no) {
                                            if (data[i].delivery_receipt_no != null) {
                                                $("button#view-or").show();
                                            }
                                            else {

                                            }
                                        }
                                    }
                                }
                            });
                        }
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                });
            }
        });
    });

    function viewOrders(data, order, table) {

        table.append("<tr>" +
            "<th> Product Name</th>" +
            "<th> Quantity</th>" +
            "<th> Price</th>" +
            "<th> Amount</th>" +
            " </tr>");

        var total = 0;
        for (var i =0; i< data.length; i++) {

            if (order == data[i].order_no) {
                table.append("<tr> " +
                    "<td>"+data[i].product_name+"</td>"+
                    "<td>"+data[i].quantity+"</td>"+
                    "<td>"+data[i].buy_price+"</td>"+
                    "<td>"+(data[i].quantity*data[i].buy_price)+"</td>"+
                    "</tr>");

                total+=(data[i].quantity * data[i].buy_price);
            }
        }
        $("p#total_").html("Total: " +total);
    }

    $("button#pull-out").on("click", function(){
        $("div.view-order").fadeOut();
        $("div#pullout").fadeIn();

        var order = $("input#o").val();

        $.ajax({
            url: "get_full_order",
            type: "POST",
            data: {
                order: order
            },
            dataType: "json",
            success: function(data) {

                $.ajax({
                    url: "get_pullouts",
                    dataType: "json",
                    success: function(d) {
                        var count =0;
                        var wares = [];
                        wares.push(data[0].warehouse_id);

                        for (var i = 1; i < data.length; i++) {
                            if (!checkIfContains(data[i].warehouse_id, wares)) {
                                wares.push(data[i].warehouse_id);
                            }
                        }
                        $("span#no-po").html(wares.length);

                        if (d.length == 0) {
                            createPOSlip(wares, order);
                            update_order(order);


                        }
                        else {
                            for (var i = 0; i < d.length; i++) {
                                if (order == d[i].order_no) {
                                    count++;
                                }
                            }

                            if (count > 0) {

                                $("div#pullout").prepend("<p> Pull out slip/s has/have aleady been generated</p>");
                                for (var i = 0; i < wares.length; i++) {
                                    $("div#slips").append("<form action='pull_out' method='get'>" +
                                        "<input class='ins' name='wh' type='text'>" +
                                        "<input class='order-no' name='ord' type='text'>" +
                                        "<input class='date-c' name='datec' type='text'>" +
                                        "<input class='pulls' name='pono' type='text'>" +
                                        "<input class='inspo' type='submit'>" +
                                        " </form>");
                                }

                                $("input.ins").each(function(index){
                                    $(this).addClass("w"+wares[index]);
                                    $(this).val(wares[index]);
                                });

                                $("input.inspo").each(function(index) {
                                    $(this).val("Pull-out slip "+wares[index]);
                                })

                                $("input.order-no").each(function(){
                                    $(this).val(order);
                                });

                                $.ajax({
                                    url: "get_pullouts",
                                    dataType: "json",
                                    success: function(data) {
                                        for (var i = 0; i < data.length; i++) {
                                            if (order == data[i].order_no) {
                                                $("input.pulls").each(function(){
                                                    $(this).val(data[i].pull_out_slip_no);
                                                });

                                                $("input.date-c").each(function(){
                                                    $(this).val(data[i].create_date);
                                                });
                                            }
                                        }
                                    }
                                });
                            }
                            else {
                                var wares = [];
                                wares.push(data[0].warehouse_id);


                                for (var i = 1; i < data.length; i++) {
                                    if (!checkIfContains(data[i].warehouse_id, wares)) {
                                        wares.push(data[i].warehouse_id);
                                    }
                                }
                                $("span#no-po").html(wares.length);

                                createPOSlip(wares, order);
                                update_order(order);
                            }
                        }
                    },

                });

            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    function checkIfContains(element, array) {

        for (var i = 0; i < array.length; i++) {
            if (array[i] == element) {
                return true;
            }
        }
    }

    function createPOSlip(wares, order) {
        var date_c;
        for (var i = 0; i < wares.length; i++) {
            $("div#slips").append("<form action='pull_out' method='get'>" +
                "<input class='ins' name='wh' type='text'>" +
                "<input class='order-no' name='ord' type='text'>" +
                "<input class='date-c' name='datec' type='text'>" +
                "<input class='pulls' name='pono' type='text'>" +
                "<input class='inspo' type='submit'>" +
                " </form>");
        }

        $("input.ins").each(function(index){
            $(this).addClass("w"+wares[index]);
            $(this).val(wares[index]);
        });

        $("input.inspo").each(function(index) {
            $(this).val("Pull-out slip "+wares[index]);
        })

        $("input.order-no").each(function(){
            $(this).val(order);
        });

        $.ajax({
            url: "get_date",
            dataType: "json",
            success: function(date) {
                date_c = date.order_created;

                $.ajax({
                    url: "get_pullouts",
                    dataType: "json",
                    success: function (pos) {
                        $("input.pulls").each(function(){
                            $(this).val("PS-"+checkPOS(pos));
                        });

                        $("input.date-c").each(function(){
                            $(this).val(date_c);
                        });

                        $("input.pulls").each(function(){
                            $.ajax({
                                url: "add_pullout",
                                type: "post",
                                data: {
                                    order: order,
                                    pon: $(this).val(),
                                    date: date_c
                                },
                                success: function() {

                                },
                                error: function(data) {
                                    console.log(data.responseText);
                                }

                            });
                        });
                    }
                });
            }
        });
    }

    function update_order(order) {
        $.ajax({
            url: "get_products_order",
            dataType: "json",
            type: "post",
            data: {
                order: order
            },
            success: function(data) { // data is order details
                $.ajax({
                    url: "update_status",
                    type: "post",
                    data: {
                        order: order,
                        status: "Items out from warehouse"
                    },
                    success: function() {
                        console.log("i changed");
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                });
            }
        });
    }

    $("button#back2order").on("click", function(){
        location.reload();
    });

    function createDR(order) {

        $("div#dr").append("<form action='delivery_receipt' method='get'> " +
            "<input id='drn' name='dr' class='dreceipt'>" +
            "<input id='onx' name='ordern' class='dreceipt'>" +
            "<input type='submit' value='Delivery Receipt'> "  +
            "</form>");

        $.ajax({
            url: "get_orders",
            dataType: "json",
            success: function(data) {
                $("input#drn").val(checkDR(data));
                $("input#onx").val(order);

                var date;

                $.ajax({
                    url: "get_date",
                    dataType: "json",
                    success: function(data) {

                        date = data.order_created;

                        $.ajax({
                            url: "deliver",
                            type: "post",
                            data: {
                                order: order,
                                drno: $("input#drn").val(),
                                date: date
                            },
                            success: function() {
                                console.log("added");
                            }
                        });
                    }
                })


            }
        });
    }

    function checkDR(data) {
        var same = false;
        do {
            var newID = generateInvoiceID();
            for (var i = 0; i < data.length; i++) {
                if (data[i].delivery_receipt_no == newID) {
                    same = true;
                }
                else {
                    same = false;
                }
            }
        }while (same);

        return "DR-"+newID;
    }


    $("#view-dr").on("click", function(){
        var order = $(this).siblings("form").children("input#o").val();

        $("div.view-order").hide();
        $("div#dr").fadeIn();

        $.ajax({
            url: "get_orders",
            dataType: "json",
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    if (data[i].order_no == order) {
                       if (data[i].delivery_receipt_no == null) {
                           createDR(order);
                       }
                       else {
                           console.log("not null??");
                           $("div#dr").append("<form action='delivery_receipt' method='get'> " +
                               "<input id='drn' name='dr' class='dreceipt'>" +
                               "<input id='onx' name='ordern' class='dreceipt'>" +
                               "<input type='submit' value='Delivery Receipt'> "  +
                               "</form>");


                           $.ajax({
                               url: "get_orders",
                               dataType: "json",
                               success: function (data) {
                                   for (var i =0; i < data.length; i++) {
                                       if (data[i].order_no == order) {
                                           $("input#onx").val(order);
                                           $("input#drn").val(data[i].delivery_receipt_no);
                                       }
                                   }
                               }
                           });
                       }
                    }

                }
            }
        });

    });

    $("button#view-or").on("click", function(){
        var order = $(this).siblings("form").children("input#o").val();

        $("div.view-order").hide();
        $("div#or").fadeIn();

        $.ajax({
            url: "get_ORs",
            dataType: "json",
            success: function(data) {
                var count = 0;
                for (var i = 0; i < data.length; i++) {
                    if (data[i].order_no == order) {
                        count++;
                    }
                }

                if (count == 0) {
                    createOR(order);
                }
                else {
                    $("div#or").append("<form action='official_receipt' method='get'> " +
                        "<input type='text' class='ORor' name='oror'>"+
                        "<input type='text' class='ORoff' name='ORoff'>"+
                        "<input type='submit' value='Official Receipt'>"+
                        "</form>");

                    $.ajax({
                        url: "get_ORs",
                        dataType: "json",
                        success: function(data) {
                            for (var i = 0; i < data.length; i++) {
                                if (data[i].order_no == order) {
                                    $("input.ORor").val(order);
                                    $("input.ORoff").val(data[i].official_receipt_no);
                                }
                            }
                        }
                    });
                }
            }
        });

    });

    function createOR(order) {

        $("div#or").append("<form action='official_receipt' method='get'> " +
            "<input type='text' class='ORor' name='oror'>"+
            "<input type='text' class='ORoff' name='ORoff'>"+
            "<input type='submit' value='Official Receipt'>"+
            "</form>");


        $.ajax({
            url: "get_ORs",
            dataType: "json",
            success: function(data) {
                $("input.ORoff").val(checkOR(data));
                $("input.ORor").val(order);

                var date;

                $.ajax({
                    url: "get_date",
                    dataType: "json",
                    success: function(data) {
                        date = data.order_created;

                        $.ajax({
                            url: "receive_payment",
                            type: "post",
                            data: {
                                date: date,
                                receipt: $("input.ORoff").val(),
                                order: order
                            },
                            success: function() {
                                console.log("i love you baby jm!");
                            },
                            error: function(data) {
                                console.log(data.responseText);
                            }
                        });
                    }
                })


            }
        });
    }

    function checkOR(data) {
        var same = false;
        do {
            var newID = generateInvoiceID();
            for (var i = 0; i < data.length; i++) {
                if (data[i].official_receipt_no == newID) {
                    same = true;
                }
                else {
                    same = false;
                }
            }
        }while (same);

        return "OR-"+newID;
    }
});