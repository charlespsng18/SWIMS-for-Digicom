$(document).ready(function(){

    $.ajax({
        url: "get_full_order",
        type: "POST",
        data: {
            order: $("h1#n").html()
        },
        success: function(data) {
            console.log(data);
            $("td#date-c").html(data[0].date_created);
            $("td#inv-n").html(data[0].invoice_no);
            $("td#customer").html(data[0].customer_name);
            $("td#business").html(data[0].business_name);
            $("td#address").html(data[0].ship_to);
            $("td#shipd").html(data[0].required_date);
            $("td#terms").html(data[0].terms);

            $("td#total").html(generateOrders(data)+".00");
        },
        error: function(data) {
            console.log(data.responseText);
        }

    });

    function generateOrders(data) {
        var total=0;
        for (var i = 0; i < data.length; i++) {
            $("table#context").append(
                "<tr>" +
                "<td>"+data[i].quantity+"</td>"+
                "<td>"+data[i].product_name+"</td>"+
                "<td class='price'>"+data[i].buy_price+"</td>"+
                "</tr>");

            total+=(data[i].quantity*data[i].buy_price);
        }

        return total;
    }
});