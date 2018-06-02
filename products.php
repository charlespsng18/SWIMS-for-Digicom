<!DOCTYPE html>
<html>
    <head>
        <title> Products</title>
        <link rel="icon" href="/assets/media/logo.jpg">
        <link rel="stylesheet" href="/assets/css/nav.css">
        <link rel="stylesheet" href="/assets/css/products.css">
        <script src="/assets/js/jquery.js"> </script>
        <script src="/assets/js/navigation.js"> </script>
        <script src="/assets/js/products.js"> </script>
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
                    <img src="/assets/media/product.svg">
                    <h1 id="title"> PRODUCTS</h1>
                </div>

                <div id="add-product">
                    <table>
                        <tr>
                            <td> <img src="/assets/media/add.png"> </td>
                            <td id="addsymbol"> ADD PRODUCT</td>
                        </tr>
                    </table>
                </div>

                <div id="products-table">
                    <table id="list-product" border="1">
                        <tr>
                            <th>Product Name</th>
                            <th class="desc">Product Description</th>
                            <th>Category</th>
                            <th>Quantity in Stock</th>
                            <th>Price</th>
                            <th>Reorder Level</th>
                            <th>Package</th>
                            <th>Warehouse</th>
                            <th>Supplier</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </body>

    <div class="overlay addproduct">
        <div id="add-product-form">
            <span class="close"> x</span>
            <h1> <img src="/assets/media/product.svg" align="center" height="30px"> ADD PRODUCT</h1>
            <input type="text" id="productname" placeholder="Product Name">
            <textarea id="product-description" placeholder="Product Description"></textarea>
            <p class="poslabel"> Category</p>
            <select id="categories"></select>
            <input type="number" id="quantity" placeholder="Quantity in Stock">
            <input type="number" id="price" placeholder="Buy Price">
            <input type="number" id="reorder" placeholder="Reorder Level">
            <p class="poslabel"> Package</p>
            <select id="zxc">
                <option>No Package</option>
                <option>PBX</option>
                <option>CCTV</option>
                <option>Networking</option>
                <option>Construction</option>
            </select>
            <p class="poslabel"> Supplier</p>
            <select id="suppliers"></select>
            <p class="poslabel"> Warehouse</p>
            <select id="warehouses"></select>
            <div align="center">
                <button id="add-button"> SUBMIT </button>
            </div>

            <p class="error adding"> Error</p>
        </div>
    </div>
</html>