<!DOCTYPE html>
<html>
<head>
    <title> Orders</title>
    <link rel="icon" href="/assets/media/logo.jpg">
    <link rel="stylesheet" href="/assets/css/nav.css">
    <link rel="stylesheet" href="/assets/css/orders.css">
    <script src="/assets/js/jquery.js"> </script>
    <script src="/assets/js/navigation.js"> </script>
    <script src="/assets/js/orders.js"> </script>
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
        </div>

        <div id="right">
            <div class="headline">
                <a href="admin"> <img id="home" src="/assets/media/home.png"> </a>
                <a href="logout"> <img id="logout" src="/assets/media/logout.png"> </a>
                <img src="/assets/media/order.png">
                <h1 id="title"> ORDERS</h1>
            </div>

            <button id="add-order"> ADD ORDER </button>

            <div id="for-orders">
                <table id="order-table" border="1">

                </table>
            </div>
        </div>
    </div>

    <div class="overlay addorder">
        <div id="add-order-form">
            <h1> Choose order type</h1>
            <button id="type1" class="order-type">
                INDIVIDUAL PRODUCTS
            </button>
            <p> OR </p>
            <button id="type2" class="order-type">
                PACKAGE
            </button>
        </div>
    </div>

    <div id="choose-package-form">
        <h1> Choose Package </h1>
        <button id="package1" class="order-type">
            CCTV
        </button>
        <button id="package2" class="order-type">
            PBX
        </button>
        <button id="package3" class="order-type">
            NETWORKING
        </button>
    </div>

    <!-- NETWORK PACKAGE UIs START-->

    <div id="networking-package-form">
        <h1> Input </h1>
        <p> Total distance of area: </p>
        <input id="total-distance" type="number" min="1">
        <p> Number of ports: </p>
        <input id="port-num" type="number" min="1" max="100"><br>
        <button id="np-to-confirm" class="next-button-style"> NEXT</button>
    </div>

    <div id="networking-package-confirm">
        <h1> Package Details </h1>
        <p>This package will include: </p>
        <table>
            <tr>
                <th> Product Name </th>
                <th> Quantity</th>
                <th> Amount</th>
            </tr>

            <tr>
                <td> Router (6 Ports)</td>
                <td> 1</td>
                <td> 5000</td>
            </tr>

            <tr>
                <td> Cable </td>
                <td> 4 * 440 meters</td>
                <td> 5000</td>
            </tr>

            <tr>
                <td> Switch </td>
                <td> 4</td>
                <td> 5000</td>
            </tr>

            <tr>
                <td> Bag of Connectors (50pcs) </td>
                <td> 1</td>
                <td> 1000</td>
            </tr>

            <tr>
                <td> Consumables </td>
                <td> xxx</td>
                <td> xxx</td>
            </tr>

            <tr>
                <td> Labor Fee </td>
                <td> xxx</td>
                <td> xxx</td>
            </tr>

            <tr>
                <td> Instsallation Fee </td>
                <td> xxx</td>
                <td> xxx</td>
            </tr>

            <tr>
                <td> Programming Fee </td>
                <td> xxx</td>
                <td> xxx</td>
            </tr>

            <tr>
                <td> TOTAL </td>
                <td> xxx</td>
                <td> xxx</td>
            </tr>
        </table>
        <button id="np-to-customerdetails" class="next-button-style"> NEXT </button>
    </div>

    <div id="np-finalize-order">
        <h1> Confirm Order </h1>
        <div align="center">
            <button id="np-confirm-order" class="next-button-style"> CONFIRM</button>
        </div>
    </div>

    <div id="select-products">
        <h1> Select products</h1>
        <div id="for-products">
            <table id="listprods">

            </table>
        </div>
        <button id="to-details"> NEXT</button>
    </div>

    <div class="errormsg">
        Sample text
    </div>

    <div class="successmsg">
        Sample text
    </div>

    <div id="input-customer-details">
        <h1> Input Customer Details</h1>
        <p> Ship to (Name): </p>
        <input id="shipto" type="text">
        <p> Business Name / Style </p>
        <input id="bizname" type="text">
        <p> Address </p>
        <textarea id="address"></textarea>
        <p> Payment Method</p>
        <select id="pay">
            <option>Cash</option>
            <option>Check</option>
        </select>

        <div align="center">
            <button id="to-confirm"> NEXT</button>
        </div>
    </div>

    <div id="confirm-window">
        <h1> Confirm Order</h1>
        <div class="forcust">
            <p>Customer Name: <span id="cname" class="de"> </span></p>
            <p>Business Name / Style: <span id="bname" class="de"> </span></p>
            <p>Address: <span id="addr" class="de"> </span></p>
            <p>Order created at: <span class='de' id="dateCreated"> </span></p>
            <p>Order to be shipped on: <span class="de" id="dateShip"> </span></p>
        </div>

        <div id="fortable">
            <table id="pr" border="1">
                <tr>
                    <th> Product</th>
                    <th> Price</th>
                    <th> Quantity</th>
                    <th> Amount</th>
                </tr>
            </table>
        </div>

        <p id="totalamount"> Total: P <span id="totalprice"> </span></p>

        <div align="center">
            <button id="confirm-order"> CONFIRM</button>
        </div>
    </div>

    <div class="overlay view-order">
        <form action="invoice" method="get">
        <h1 align="center"> Order Details</h1>
        <p>Order No. <span id="orderno"> </span></p>
            <input id="o" name="order" type="hidden">
        <p>Ship to: <span id="cust"> </span></p>
            <p>Address: <span id="addre"></span></p>
        <p>Payment Method: <span id="trm"> </span></p>
            <p>User: <span id="user"> </span></p>
            <p>Status: <span id="stat"></span></p>

        <div id="for-cart">
            <table id="itemscart">

            </table>

            <p id="total_"></p>

        </div>
            <input type="submit" value="Invoice">
        </form>

        <button id="pull-out"> Generate Pull Out Slip</button>
        <button id='view-dr' style="display: none;"> Generate Delivery Receipt</button>
        <button id="view-or" style="display: none;"> Receive Payment</button>

    </div>

    <div id="pullout">
        <p>Number of pull-out slips generated: <span id="no-po"></span></p>
        <div id="slips">

        </div>
        <button id='back2order'> Back to Orders</button>
    </div>

    <div id="dr">
        <p class="message"></p>

        <button id='back2order'> Back to Orders</button>
    </div>

    <div id="or">
        <p class="message"></p>

        <button id='back2order'> Back to Orders</button>
    </div>



</body>
</html>