$(document).ready(function(){

    function generateTable(data, table) {

        for (var i=0; i < data.length; i++) {
            table.append("<tr>" +
                "<td class='prodnamecell'>"+data[i].product_name+"</td>" +
                "<td class='catidcell invi'>"+data[i].category_id+"</td>" +
                "<td class='suppidcell invi'>"+data[i].supplier_id+"</td>" +
                "<td class='packidcell invi'>"+data[i].package_id+"</td>" +
                "<td class='wareidcell invi'>"+data[i].warehouse_id+"</td>" +
                "<td class='proddesccell'>"+data[i].product_description+"</td>" +
                "<td class='categorycell'>"+data[i].category_name+"</td>" +
                "<td class='pricecell'>"+data[i].buy_price+"</td>" +
                "<td class='reordercell'>"+data[i].reorder_level+"</td>" +
                "<td class='packagecell'>"+data[i].package_name+"</td>" +
                "<td class='warehousecell'>"+data[i].warehouse_name+"</td>" +
                "<td class='suppliercell'>"+data[i].supplier_name+"</td>" +
                "<td class='edit-product'><img class='user-actions' src='/assets/media/edit.png'></td>" +
                "<td class='delete-product'><img class='user-actions' src='/assets/media/delete.png'></td>" +
                "</tr>");
        }
    }

    $.ajax({
        url: "display_products",
        dataType: "json",
        success: function(data) {
            generateTable(data,$("table#list-product"));
        }
    });

    $("div#add-product").on("click", function(){
        $("div.all").css("filter","blur(7px)");
        $("div.addproduct").fadeIn();
    });

    $.ajax({
        url: "get_categories",
        success: function(data) {
            var form = $("select#categories");
            for (var i=0 ; i<data.length; i++) {
                form.append("<option>"+data[i].category_name+"</option>");
            }
        },
        dataType: "json"
    });

    $.ajax({
        url: "get_packages",
        success: function(data) {
            var form = $("select#zxc");
            for (var i=0 ; i<data.length; i++) {
                form.append("<option>"+data[i].package_name+"</option>");
            }
        },
        dataType: "json"
    });

    $.ajax({
        url: "get_warehouses",
        success: function(data) {
            var form = $("select#warehouses");
            for (var i=0 ; i<data.length; i++) {
                form.append("<option>"+data[i].warehouse_name+"</option>");
            }
        },
        dataType: "json"
    });

    $.ajax({
        url: "get_suppliers",
        success: function(data) {
            var form = $("select#suppliers");
            for (var i=0 ; i<data.length; i++) {
                form.append("<option>"+data[i].supplier_name+"</option>");
            }
        },
        dataType: "json"
    });

    $("button#add-button").on("click", function(){
        var name = $("#productname").val();
        var desc = $("#product-description").val();
        var category = $("#categories").val();
        var catno = getCategoryNumber(category);
        var price = $("#price").val();
        var reorder = $("#reorder").val();
        var pack = $("#zxc").val();
        var packageno = getPackageID(pack);
        var supplier = $("#suppliers").val();
        var suppno = getSupplierID(supplier);
        var warehouse = $("#warehouses").val();
        var warehouseno = getWarehouseID(warehouse);
        console.log(packageno);

        var inputs =[name, desc, price, reorder];
        var counter =0;

        for (var i=0; i < inputs.length; i++) {
            if (!$.trim(inputs[i])) {
                counter++;
            }
        }

        if (counter > 0) {
            $("p.adding").show();
            $("p.adding").html("Please fill up all fields");
        }
        else {
            $.ajax({
                url: "add_product",
                type: "POST",
                data: {
                    name: name,
                    desc: desc,
                    category: catno,
                    price: price,
                    reorder: reorder
                },
                success: function() {
                    $.ajax({
                        url: "get_last_product",
                        dataType: "json",
                        success: function(data) {
                            var lastproduct = data[0].lastproduct;

                            $.ajax({
                                url: "add_product_to",
                                type: "POST",
                                data: {
                                    warehouse: warehouseno,
                                    pack: packageno,
                                    supplier: suppno,
                                    product_id: lastproduct
                                },
                                success: function(){
                                    location.reload();
                                },
                                error: function(data) {
                                    console.log("no" +data.responseText);
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

    $("#add-product-form").children("span.close").on("click",function(){
        $(this).parent().parent().fadeOut();
        $("div.all").css("filter","none");
    });
});

//hardcode TODO

function getCategoryNumber(category) {

    switch(category) {

        case "Power": return 1;
        case "Software": return 2;
        case "Circuit Card": return 3;
        case "Brackets": return 5;
        case "Line Capacity Software": return 6;
        case "Switch": return 4;
        case "IP Port Software": return 7;
        case "Application Software": return 8;
        case "Camera": return 9;
        case "Programming": return 10;
        case "Computer Parts": return 11;
        case "UPS": return 12;
        case "Battery": return 13;

    }
}

function getSupplierID(supplier) {

    switch(supplier) {

        case "NEC": return 1;
        case "Nexans": return 2;
        case "Ruckus Wireless": return 3;
        case "Toppan": return 4;
        case "Dell": return 5;
        case "GeoVision": return 6;
        case "Converged Solutions": return 7;
        case "JuruData Services": return 8;
        case "Cansoc Systems LTD": return 9;
        case "HDL Companies": return 10;
        case "Spok": return 11;
        case "Brickom": return 12;
        case "HP": return 13;
        case "Cisco": return 14;
        case "Digiview": return 15;
    }
}

function getWarehouseID (warehouse) {

    switch(warehouse) {
        case "Warehouse A": return 1;
        case "Warehouse B": return 2;
        case "Warehouse C": return 3;
        case "Warehouse D": return 4;
    }
}

function getPackageID(package) {

    switch(package) {
        case "No Package": return 0;
        case "PBX": return 1;
        case "CCTV": return 2;
        case "Networking": return 3;
        case "Construction": return 4;
    }
}
