<html>
	<head>
		<link rel = "stylesheet"
			type = "text/css"
			href = "/assets/css/delivery_receipt.css" />
        <title>Delivery Receipt</title>
        <script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/delivery_receipt.js"></script>
	</head>
	<body>
        <h1 id="dr" style="display: none;"><?php echo $_GET["dr"]; ?></h1>
        <h1 id="ord" style="display: none;"><?php echo $_GET["ordern"]; ?></h1>
		<a href="orders" id="backlink">Go back</a><br>
		<button onclick="printFunction()" id="printButton">Print this receipt</button>
		<div id="logoandinfo">
			<img src="/assets/media/applet_splash.png">
			<hr>
			Digital Network Communication & Computers Inc. <br>
			Main Office<br>
			30/F Antel Global Corporate Center, Julia Vargas Ave., and Jade Drive<br>
			Ortigas Center, Brgy. San Antonio, Pasig City<br>
			Tel. Nos: 12346789<br>
			TIN: 123-456-789<br>
		</div>
		<div id="shipto">
			<table border=1>
				<tr>
					<td>Ship To: <span id="cust"></span></td>
				</tr>
				<tr>
					<td>Address: <span id="address"></span>
                        <br>Business Style/Name: <span id="bname"></span></td>
				</tr>
			</table>
		</div>
		<div id="deliveryInfo">
			<div id="deliverytitle"> DELIVERY RECEIPT </div>
			<table border=1 id="deliverydatetermsdr">
				<tr>
					<th>Date</th>
					<th>Terms</th>
					<th>DR#</th>
				</tr>
				<tr>
					<td id="dated">09/11/9110</td>
					<td id="terms"blah</td>
					<td id="drno">12345</td>
				</tr>
			</table>
		</div>
		<br>
		<br>
		<table id="poinvoiceshipproject" border=1>
			<tr>
				<th class="small">Invoice #</th>
				<th class="small">Via</th>
			</tr>
			<tr>
				<td id="inv">12629</td>
				<td id="via">1262943</td>
			</tr>
		</table>
		<table id="deliveryitems" frame=box>
			<tr>
				<th class="smaller">Qty.</th>
				<th>ARTICLES</th>
			</tr>

		</table>
		<div id="signatures">
		ISSUED BY:__________________________<br>
		APPROVED BY:________________________<br>
		RELEASED BY:________________________<br>
		DELIVERED BY:_______________________<br>
		</div>
		<div id="receivepart">
			Received the above articles in order and condition.<br><br>
			By:_________________________________<br>
			Signature Over Printed Name
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