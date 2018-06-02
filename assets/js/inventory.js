$(document).ready(function(){


    function generateList(table, data, i) {
        var counter = 0;
            if (parseInt(data[i].reorder_level) >= parseInt(data[i].quantity_in_stock)) {
                table.append("<tr style='background-color: #ed5449;'> " +
                    "<td>" + data[i].product_name + "</td>" +
                    "<td>" + data[i].category_name + "</td>" +
                    "<td style='font-weight: 900;'>" + data[i].quantity_in_stock + "</td>" +
                    "<td>" + data[i].reorder_level + "</td>" +
                    "<td>" + data[i].buy_price + "</td>" +
                    "<td>" + data[i].supplier_name + "</td>" +
                    "</tr>");

                counter++;
            }
            else {
                table.append("<tr> " +
                    "<td>" + data[i].product_name + "</td>" +
                    "<td>" + data[i].category_name + "</td>" +
                    "<td>" + data[i].quantity_in_stock + "</td>" +
                    "<td>" + data[i].reorder_level + "</td>" +
                    "<td>" + data[i].buy_price + "</td>" +
                    "<td>" + data[i].supplier_name + "</td>" +
                    "</tr>");

            }
        return counter;
    }

    function displayprods() {
        $.ajax({
            url: "get_warehouses",
            dataType: "json",
            success: function (data) {
                var div = $("div#for-products");
                for (var i = 0; i < data.length; i++) {
                    div.append("<div class='warehouse-div'>" +
                        "<p class='warehouse-name'>" + data[i].warehouse_name + " </p>" +
                        "</div>")
                }

                $("div.warehouse-div").each(function (i) {
                    $(this).addClass("wh" + (i + 1));
                });

                createTable();
            }
        });
    }

    function listproducts() {
        $.ajax({
            url: "display_products",
            dataType: "json",
            success: function (data) {
                var wh;
                var count = 0;
                for (var i = 0; i < data.length; i++) {
                    if (data[i].package_id == 0) {
                        wh = data[i].warehouse_id;

                        if (wh == 1) {
                            count += generateList($("table.ware1"), data, i);
                        }
                        else if (wh == 2) {
                            count += generateList($("table.ware2"), data, i);
                        }
                        else if (wh == 3) {
                            count += generateList($("table.ware3"), data, i);
                        }
                        else {
                            count += generateList($("table.ware4"), data, i);
                        }
                    }
                }

                if (count > 0) {
                    $("div#lowstock").show();
                }
            },
            error: function() {
            }
        });
    }

    function createTable() {

        $("div.wh1").append("<table class ='ware1 tableware'> " +
            "<th> Product Name</th>"+
            "<th> Category</th>"+
            "<th> Qty</th>"+
            "<th> Reorder Level</th>"+
            "<th> Price</th>"+
            "<th> Supplier</th>"+
            "</table>");

        $("div.wh2").append("<table class ='ware2 tableware'> " +
            "<th> Product Name</th>"+
            "<th> Category</th>"+
            "<th> Qty</th>"+
            "<th> Reorder Level</th>"+
            "<th> Price</th>"+
            "<th> Supplier</th>"+
            "</table>");

        $("div.wh3").append("<table class ='ware3 tableware'> " +
            "<th> Product Name</th>"+
            "<th> Category</th>"+
            "<th> Qty</th>"+
            "<th> Reorder Level</th>"+
            "<th> Price</th>"+
            "<th> Supplier</th>"+
            "</table>");

        $("div.wh4").append("<table class ='ware4 tableware'> " +
            "<th> Product Name</th>"+
            "<th> Category</th>"+
            "<th> Qty</th>"+
            "<th> Reorder Level</th>"+
            "<th> Price</th>"+
            "<th> Supplier</th>"+
            "</table>");

    }

    displayprods();
    listproducts();

    $("button.bundles").on("click", function(){
        $(this).css("background-color", "cadetblue");
        $("button.products").css("background-color", "inherit");
        $("div#for-products").hide();
        $("div#for-packages").show();
    });

    $("button.products").on("click", function(){
        $(this).css("background-color", "cadetblue");
        $("button.bundles").css("background-color", "inherit");
        $("div#for-packages").hide();
        $("div#for-products").show();
    });
		$("#receive-inventory").click(function(){ //changed
		$("div#restock").fadeIn();

	});
	$.ajax({
			url:"get_prod_low",
			dataType: "json",
			success: function(data){
				console.log(data);
				generate_list_prod_low($("table#restocktable"), data);
			},
			error: function (xhr, status, errorThrown){
				console.log(status);
			}
	});
	function generate_list_prod_low(table, product_list){   //changed
		for(var i=0; i<product_list.length; i++){
			table.append("<tr style='background-color: #ed5449;'> " +
					"<td class='prod_id'>" + product_list[i].product_id + "</td>" +
                    "<td>" + product_list[i].product_name + "</td>" +
                    "<td style='font-weight: 900;'>" + product_list[i].quantity_in_stock + "</td>" +
                    "<td>" + product_list[i].reorder_level + "</td>" +
                    "<td class='supplier_name'>" + product_list[i].supplier_name + "</td>" +
					"<td class='amt'><input type=text class='qty'></td>" +
					"<td><button class='notifysupplier'>Notify Supplier</button></td>"+
                    "</tr>");
		}
	}
	$(document).on("click", "button.notifysupplier", function(){  //changed
		var prod_id = $(this).parent().siblings("td.prod_id").html();
		var qty = parseInt($(this).parent().siblings("td.amt").children(".qty").val());
		var supplier = $(this).parent().siblings("td.supplier_name").html();
		
		console.log(qty);
		$.ajax({
			url: "notify_supplier",
			type: "POST",
			data: {
				product_id: prod_id,
				quantity: qty,
				supplier_name: supplier
			},
			success: function() {
				console.log("Success");
            },	
			error: function(data) {
               console.log(data.responseText);
            }
		});
		$(this).replaceWith("<p style='color: darkgreen'> Notified </p>");
	});
	$(document).on("click", "button#back",function(){
		$("div#restock").fadeOut();
	});
});