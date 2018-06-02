<html>
	<head>
        <title> Pull Out Slip</title>
		<link rel = "stylesheet"
			type = "text/css"
			href = "/assets/css/pull-out-slip.css" />
		<script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/pull_out_slip.js"></script>
	</head>
	<body>
        <h1 id="order-no" style="display: none;"><?php echo $_GET["ord"]; ?></h1>
        <h1 id="whn" style="display: none;"><?php echo $_GET["wh"]; ?></h1>
        <h1 id="d8" style="display: none;"><?php echo $_GET["datec"]; ?></h1>
        <h1 id="pullno" style="display: none;"><?php echo $_GET["pono"]; ?></h1>
		<a href="orders" id="backlink">Go back</a><br>
		<button onclick="printFunction()" id="printButton">Print this receipt</button>
		<div id="warehouse">
            <p>Warehouse No. <span id="waren"></span> </p>
            <p>Order No: <span id="or-n"></span></p>

		</div>
		<div id="logoandinfo">
			<img src="/assets/media/applet_splash.png">
			<hr>
			Digital Network Communication & Computers Inc. <br>
			<span id="pulloutslip">PULL-OUT SLIP <br> </span>
		</div>
		<div id="pulloutnumber">
			No. <span id="ponumber">12345 </span><br>
		</div>
		<div id="recandadd">
			RECEIVED FROM:  <span id="wareh"></span><br>
			ADDRESS: <span id="address"></span>
		</div>
		<div id="date">
			Date: <span id="dc"></span>
		</div>
		<br>
		<br>
		<div>
			<table id='cart' border=1>
				<tr id="tableheader">
					<th id="qty"> Quantity </th>
					<th> Description </th>
				</tr>
			</table>
		</div>
		<div id="conditionandconfirm">
			Condition of Item/s  <br>
			__________________________________________<br>
			__________________________________________<br>
			__________________________________________<br>
			<br>
		</div>
		<div id="approveandreceive">
			<div id="approve">
			_____________________________________<br>
			Approved by:  <br>
			</div>
			<div id="receive">
			_____________________________________<br>
			Received by: 
			</div>
		</div>
		
		<script>
		function printFunction() {
			var printbutton = document.getElementById('printButton');
			var backlink = document.getElementById('backlink');
			printbutton.style.display = 'none';
			backlink.style.display = 'none';
			window.print();
			printbutton.style.display = 'block';
			backlink.style.display = 'block';
		}
		</script>
	</body>
</html>