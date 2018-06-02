<html>
<head>
    <link rel="icon" href="/assets/media/logo.jpg">
    <link rel="stylesheet" href="/assets/css/packages.css">
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/navigation.js"> </script>
    <script>
        $(document).ready(function(){
            $("#cctv-header").click(function(){
                $("#cctv").slideToggle();
            });
            $("#pbx-header").click(function(){
                $("#pbx").slideToggle();
            });
            $("#networking-header").click(function(){
                $("#networking").slideToggle();
            });
            $("#construction-header").click(function(){
                $("#construction").slideToggle();
            });
        });
    </script>
</head>
<body>

<!-- SIDEBAR START -->
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
    <p id="redirect-section-caption"> Sections: </p>
    <div id="redirect-section">
        <a href="#cctv-header">	CCTV </a>
        <a href="#pbx-header"> PBX </a>
        <a href="#networking-header"> NETWORKING </a>
        <a href="#construction-header"> CONSTRUCTION </a>
    </div>
</div>
<!-- SIDEBAR END -->

<div id="right">
    <div id="page-identifier">
        <img src="/assets/media/package.png" id="page-identifier-pic">
        <p id="page-identifier-caption">PACKAGES</p>
    </div>

    <div id="packages">
        <div id="cctv-header" class="package-header">
            <p> CCTV </p>
        </div>
        <div id="cctv" class="products">
            <table id="cctv-products" class="products-table">
                <tr>
                    <th> Name </td>
                    <th> Description </td>
                </tr>
                <tr>
                    <td> DS-7608NI-E2/8P </td>
                    <td> 80Mbps Bit Rate Input Max (up to 8-ch IP video), 2 SATA interfaces, 8 independent PoE network interfaces,  380 1U case </td>
                </tr>
                <tr>
                    <td> DS-2CD2642FWD </td>
                    <td> 1/3" Progressive CMOS, ICR, 0.01lux/F1.2,  2688x1520:20fps, 2.8~12mm VF lens, IP66, H.264/MJPEG, dual-stream, IP66, DC12V & PoE, 120dB WDR, 3D DNR, BLC, IR: up to 30m, support on-board storage up to 64GB </td>
                </tr>
                <tr>
                    <td> DS-2CD2742FWD </td>
                    <td> 1/3" Progressive CMOS, ICR, 0lux with IR,  2688x1520:20fps, 2.8~12mm VF lens, IP66, H.264/MJPEG, dual-stream, IP66, DC12V & PoE, 120dB WDR, 3D DNR, BLC, IR: up to 30m, support on-board storage up to 128GB  </td>
                </tr>
            </table>
        </div>

        <div id="pbx-header" class="package-header">
            <p> PBX </p>
        </div>
        <div id="pbx" class="products">
            <table id="pbx-products" class="products-table">
                <tr>
                    <th> Name </td>
                    <th> Description </td>
                </tr>
                <tr>
                    <td> IPS UNIV PIMMJ(UA) </td>
                    <td> PORT INTERFACE MODULE (PIM) FOR UNIVERGE IPS </td>
                </tr>
                <tr>
                    <td> ICS VS BASE-C(UA) </td>
                    <td> BASEU/TOP COVER FOR IPS </td>
                </tr>
                <tr>
                    <td> ICS VS BASE-DC(UA) </td>
                    <td> BASEU/TOP COVER FOR IPS DC -48V INPUT SYSTEM </td>
                </tr>
            </table>
        </div>

        <div id="networking-header" class="package-header">
            <p> NETWORKING </p>
        </div>
        <div id="networking" class="products">
            <table id="networking-products" class="products-table">
                <tr>
                    <th> Name </td>
                    <th> Description </td>
                </tr>
                <tr>
                    <td> Router </td>
                    <td> idk how to describe a router. it's for net? lol </td>
                </tr>
                <tr>
                    <td> Ethernet Cable </td>
                    <td> it's a damn ethernet cable! </td>
                </tr>
                <tr>
                    <td> Switch </td>
                    <td> what is this supposed to be? a damn light switch? lmao </td>
                </tr>
            </table>
        </div>

        <div id="construction-header" class="package-header">
            <p> CONSTRUCTION </p>
        </div>
        <div id="construction" class="products">
            <table id="construction-products" class="products-table">
                <tr>
                    <th> Name </td>
                    <th> Description </td>
                </tr>
                <tr>
                    <td> Form bar 10mm </td>
                    <td> the hell's a form bar??? </td>
                </tr>
                <tr>
                    <td> Marine flywood 1/2 </td>
                    <td> plywood that became fly af bro B) nigga also likes marine shit</td>
                </tr>
                <tr>
                    <td> reflector vest - net </td>
                    <td> when you wanna look sexy in a fishnet but forgot you're supposed to be a construction worker </td>
                </tr>
            </table>
        </div>

    </div>
</div>

</body>
</html>