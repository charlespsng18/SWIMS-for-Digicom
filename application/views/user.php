<!DOCTYPE html>
<html>
    <head>
        <title> Users </title>
        <link rel="icon" href="/assets/media/logo.jpg">
        <link rel="stylesheet" href="/assets/css/user.css">
        <link rel="stylesheet" href="/assets/css/nav.css">
        <script src="/assets/js/jquery.js"> </script>
        <script src="/assets/js/user.js"> </script>
        <script src="/assets/js/navigation.js"> </script>
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
                <img src="/assets/media/user.png">
                <h1 id="title"> USERS</h1>
            </div>

            <div id="add-user">
                <table>
                    <tr>
                        <td> <img src="/assets/media/add.png"> </td>
                        <td id="addsymbol"> ADD USER</td>
                    </tr>
                </table>
            </div>
            <p class="msg" align="center"> Hello</p>
            <div id="users-table">
                <table id="list-user" border="1">
                    <tr>
                        <th>Username</th>
                        <th>Last Name </th>
                        <th>First Name </th>
                        <th>Email Address</th>
                        <th>Position No.</th>
                        <th>Position</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </body>

    <div class="overlay deleteuser">
        <div id="delete-user-confirm">
            <p> Are you sure you want to delete this user?</p>
            <div align="center">
                <button id="deleteyes"> YES</button>
                <button id="deleteno"> NO</button>
            </div>
        </div>
    </div>

    <div class="overlay adduser">
        <div id="add-user-form">
            <span class="close"> x</span>
            <h1> <img src="/assets/media/user.png" align="center" height="30px"> ADD USER</h1>
            <input type="text" id="username" placeholder="Username">
            <input type="text" id="firstname" placeholder="First Name">
            <input type="text" id="lastname" placeholder="Last Name">
            <input type="password" id="password" placeholder="Password">
            <input type="password" id="cpassword" placeholder="Confirm Password">
            <input type="text" id="email" placeholder="Email">
            <p class="poslabel"> Position</p>
            <select id="pos">
                <option> Admin</option>
                <option> Financial Officer</option>
                <option> Inventory Manager</option>
                <option> Project Head</option>
                <option> Sales Head</option>
                <option> Shipper</option>
                <option> Warehouse Manager</option>
				<option> Supplier</option>
            </select>
            <div align="center">
                <button id="add-button"> SUBMIT </button>
            </div>

            <p class="error adding"> Error</p>
        </div>
    </div>

    <div class="overlay edituser">
        <div id="edit-user-form">
            <span class="close"> x</span>
            <h1> <img src="/assets/media/user.png" align="center" height="30px"> EDIT USER</h1>
            <input type="text" id="eusername" placeholder="Username" readonly>
            <input type="text" id="efirstname" placeholder="First Name">
            <input type="text" id="elastname" placeholder="Last Name">
            <input type="password" id="epassword" placeholder="Password">
            <input type="password" id="ecpassword" placeholder="Confirm Password">
            <input type="text" id="eemail" placeholder="Email">
            <p class="poslabel"> Position</p>
            <select id="epos">
                <option> Admin</option>
                <option> Financial Officer</option>
                <option> Inventory Manager</option>
                <option> Project Head</option>
                <option> Sales Head</option>
                <option> Shipper</option>
                <option> Warehouse Manager</option>
            </select>
            <div align="center">
                <button id="edit-button"> SUBMIT </button>
            </div>

            <p class="error editing"> Error</p>
        </div>
    </div>
</html>