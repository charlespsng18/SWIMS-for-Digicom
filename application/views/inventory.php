<!DOCTYPE html>
<html>
<head>
    <title> Inventory</title>
    <link rel="icon" href="/assets/media/logo.jpg">
    <link rel="stylesheet" href="/assets/css/nav.css">
    <link rel="stylesheet" href="/assets/css/inventory.css">
    <script src="/assets/js/jquery.js"> </script>
    <script src="/assets/js/navigation.js"> </script>
    <script src="/assets/js/inventory.js"> </script>
</head>

<body>
    <div class="all">
        <p id="session_un" style="display: none;"><?php echo $this->session->username ?></p>

        <div id="left">
            <h2 id="greet">  </h2>

            <table id="nav" border="0">

                <tr id="home">
                    <td class="icon"><img src="/assets/media/home.png"> </td>
                    <td class="ops">HOME </td>
                </tr>

                <tr id="orders">
                    <td class="icon"><img src="/assets/media/order.png"> </td>
                    <td class="ops">ORDERS </td>
                </tr>

                <tr id="inventory">
                    <td class="icon"><img src="/assets/media/inventory.png"> </td>
                    <td class="ops">INVENTORY </td>
                </tr>

                <tr id="packages">
                    <td class="icon"><img src="/assets/media/package.png"> </td>
                    <td class="ops">PACKAGES </td>
                </tr>

                <tr id="users">
                    <td class="icon"><img src="/assets/media/user.png"> </td>
                    <td class="ops">USERS </td>
                </tr>

                <tr id="products">
                    <td class="icon"> <img src="/assets/media/product.svg"></td>
                    <td class="ops">PRODUCTS </td>
                </tr>

                <tr id="documents">
                    <td class="icon"> <img src="/assets/media/document.png"></td>
                    <td class="ops">DOCUMENTS </td>
                </tr>
            </table>

        </div>

        <div id="right">
            <div class="headline">
                <a href="admin"> <img id="home" src="/assets/media/home.png"> </a>
                <a href="logout"> <img id="logout" src="/assets/media/logout.png"> </a>
                <img src="/assets/media/inventory.png">
                <h1 id="title"> INVENTORY</h1>
            </div>

			<div>
                <button id="receive-inventory">RECEIVE INVENTORY</button>
			</div>
			<div id="restock">
				<button id="back">Done</button>
				<table id="restocktable">
					<tr>
						<th>Product ID </th>
						<th>Product Name </th>
						<th>Quantity in Stock</th>
						<th>Reorder Level</th>
						<th>Supplier</th>
						<th>Quantity for restock</th>
						<th>Notify Button</th>
					</tr>
				</table>

			</div>


            <div id="lowstock">
                Warning! You currently have low supplies. Please contact your suppliers
                immediately to replenish your inventory.
            </div>

            <div id="for-table">
                <button class="products tab"> PRODUCTS not in a package</button>
                <button class="bundles tab"> PRODUCTS in a package</button>
                <div id="for-products">

                </div>

                <div id="for-packages">

                    items here 2
                </div>


            </div>
        </div>
    </div>

</body>

</html>