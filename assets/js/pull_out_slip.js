$(document).ready(function(){

    var order = $("h1#order-no").html();
    var warehouse = $("h1#whn").html();
    var date = $("h1#d8").html();
    var pullno = $("h1#pullno").html();

    $("span#waren").html(warehouse);
    $("span#or-n").html(order);
    $("span#ponumber").html(pullno);
    $("span#dc").html(date);

    $.ajax({
        url: "pull_out_order",
        dataType: "json",
        type: "get",
        data: {
            order: order,
            warehouse: warehouse
        },
        success: function(data) {
            $("span#wareh").html(data[0].warehouse_name);
            $("span#address").html(data[0].address);

            for (var i = 0; i < data.length; i++) {
                $("table#cart").append("<tr> " +
                    "<td>"+data[i].quantity+"</td>" +
                    "<td>"+data[i].product_name+"</td>" +
                    "</tr>");
            }
        }
    });
});