$(document).ready(function(){

    var order = $("h1#ord").html();

    $("div#ORnumber").html($("h1#rec").html());

    $.ajax({
        url: "get_ORs",
        dataType: "json",
        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                if (order == data[i].order_no) {
                    $("span#date").html(data[i].date_generated);

                    $.ajax({
                        url: "get_full_orders",
                        dataType: "json",
                        success: function(data) {
                            var total = 0;
                            for (var i = 0; i < data.length; i++) {
                                if (order == data[i].order_no) {
                                    console.log(data[i]);
                                    $("span#customer").html(data[i].customer_name);
                                    $("span#address").html(data[i].ship_to);
                                    $("span#invoice").html(data[i].invoice_no);
                                    total+=parseInt(data[i].quantity * data[i].buy_price);

                                    if (data[i].terms == "Cash") {
                                        $("#cash").attr("checked", "true");
                                    }
                                    else {
                                        $("#check").attr("checked", "true");
                                    }
                                }
                                $("span#amount-due").html(total);

                                $("td#totalwvat").html(total);
                                var vat = total * 0.12;
                                $("#vat").html(vat);

                                $("#total").html(total - vat);
                                $("#tt").html(total - vat);
                                $("#ttad").html(total - vat);
                                $("#totalsales").html(total - vat);
                            }
                        }
                    });
                }
            }
        }
    });
});