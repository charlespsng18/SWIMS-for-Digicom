<!DOCTYPE html>
<html>
    <head>
        <title> Home - Admin</title>
        <link rel="stylesheet" href="/assets/css/admin.css">
        <link rel="icon" href="/assets/media/logo.jpg">
        <script src="/assets/js/jquery.js"> </script>
        <script src="/assets/js/admin.js"> </script>
    </head>

    <body>
    <a href="logout"> <img id="logout" src="/assets/media/logout.png"> </a>
        <p id="session_un" style="display: none;"><?php echo $this->session->username ?></p>
        <h2 id="greet">  </h2>

        <div id="container1" class="cntr">
            <a href="orders">
                <div class="main-menu-options" id="orders">

                    <img class="icons" src="/assets/media/order.png">
                    <h2 class="option-name"> Orders</h2>
                </div>
            </a>

            <a href="inventory">
                <div class="main-menu-options" id="inventory">
                    <img class="icons" src="/assets/media/inventory.png">
                    <h2 class="option-name"> Inventory</h2>
                </div>
            </a>

            <a href="packages">
                <div class="main-menu-options" id="packages">
                    <img class="icons" src="/assets/media/package.png">
                    <h2 class="option-name"> Packages</h2>
                </div>
            </a>

        </div>

        <div id ="container2" class="cntr">

            <a href="user">
                <div class="main-menu-options" id="users">
                    <img class="icons" src="/assets/media/user.png">

                    <h2 class="option-name"> Users</h2>
                </div>
            </a>

            <a href="products">
                <div class="main-menu-options" id="products">
                    <img class="icons" src="/assets/media/product.svg">
                    <h2 class="option-name"> Products</h2>
                </div>
            </a>

            <div class="main-menu-options" id="documents">
                <img class="icons" src="/assets/media/document.png">
                <h2 class="option-name"> Documents</h2>
            </div>
        </div>
    </body>
</html>