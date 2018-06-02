$(document).ready(function(){

    var order = $("h1#ord").html();
    var dr = $("h1#dr").html();

    $.ajax({
        url: "get_full_orders",
        dataType: "json",
        success: function(data) {

            for (var i = 0; i < data.length; i++) {
                if (order == data[i].order_no) {

                    console.log(data[i]);

                    $("span#cust").html(data[i].customer_name);
                    $("span#address").html(data[i].ship_to);
                    $("span#bname").html(data[i].business_name);
                    $("td#terms").html(data[i].terms);
                    $("td#drno").html(dr);
                    $("td#inv").html(data[i].invoice_no);
                    $("td#via").html("Truck");

                    $("table#deliveryitems").append("<tr>" +
                        "<td>"+data[i].quantity+"</td>"  +
                        "<td>"+data[i].product_name+"</td>"  +
                        "</tr>");
                }
            }

            $.ajax({
                url: "get_date",
                success: function(data) {
                    $("td#dated").html(data.order_created);
                },
                dataType: "json"
            });
        }
    });
});