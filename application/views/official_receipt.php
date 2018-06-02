<html>
	<head>
		<link rel = "stylesheet"
			type = "text/css"
			href = "/assets/css/official_receipt.css" />
        <title> Official Receipt</title>
		<script src = "/assets/js/jquery.js"></script>
        <script src="/assets/js/official_receipt.js"></script>
        <style> * {font-family: Sans-serif;}
                .r {text-align: right;}
        </style>
	</head>
	<body>
        <h1 id="rec" style="display:none;"><?php echo $_GET["ORoff"]; ?></h1>
        <h1 id="ord" style="display:none;"><?php echo $_GET["oror"]; ?></h1>

        <a href="orders" id="backlink">Go back</a>
		<button onclick="printFunction()" id="printButton">Print this receipt</button>
		
		<div id="settletable">
			<table>
				<colgroup span="2"></colgroup>
				<tr>
					<td colspan="2" >In Settlement of the following</td>
				</tr>
				<tr>
					<th>Invoice No. <span id="invoice"></span></th>
					<th>Amount</th>
				</tr>
				<tr>
					<td>Total Sales (VAT Inclusive)</td>
					<td id='totalwvat' class="r">123,456</td>
				</tr>
				<tr>
					<td>Less: VAT</td>
					<td id='vat' class="r">123</td>
				</tr>
				<tr>
					<td>Total</td>
					<td id='total' class="r">123,456,789</td>
				</tr>
				<tr>
					<td>Less SC/PWD Discount</td>
					<td class="r"></td>
				</tr>
				<tr>
					<td>Total</td>
					<td id='tt' class="r"></td>
				</tr>
				<tr>
					<td>Less:W;Holding</td>
					<td class="r"></td>
				</tr>
				<tr>
					<td>Total Amount Due</td>
					<td id='ttad' class="r"></td>
				</tr>
				<tr>
					<td>VATable</td>
					<td class="r"></td>
				</tr>
				<tr>
					<td>VAT-Exempt</td>
					<td class="r"></td>
				</tr>
				<tr>
					<td>VAT-Zero Rated Scale</td>
					<td class="r"></td>
				</tr>
				<tr>
					<td>VAT Amount</td>
					<td class="r"></td>
				</tr>
				<tr>
					<td>Total Sales</td>
					<td id='totalsales' class="r"></td>
				</tr>
				<tr>
					<td colspan="2" >Form of Payment:</td>
				</tr>
				<tr>
					<td colspan="2" ><input id='cash' type="checkbox" name="vehicle" value="Bike">Cash  <input id='check' type="checkbox" name="check" value="Check">Check</td>
				</tr>
			</table>
		</div>
		<div id="info">
			
			<img src="/assets/media/applet_splash.png">
			<hr>
			<div id="companydetails">
			Digital Network Communication & Computers Inc. <br>
			Main Office<br>
			30/F Antel Global Corporate Center, Julia Vargas Ave., and Jade Drive<br>
			Ortigas Center, Brgy. San Antonio, Pasig City<br>
			Tel. Nos: 12346789<br>
			TIN: 123-456-789<br>
			</div>
			<div id="ORnumber">No. 34551</div>
			<div id="contentpayment">
			<h1> Official Receipt</h1>
                <p>Date: <b><span id="date"></span></b></p>
                <p>Received from: <b><span id="customer"></span></b> </p>
			<p>with TIN </p>
                <p>with address at <b><span id="address"></span></b></p>
			<p> The sum of pesos <b>P <span id="amount-due"></span></b>, </p>
			<p>In partial/full payment of </p>
			<div id="scpwd">
			<br>
			<table>
				<tr>
					<td colspan="2" class="writefield">Sr. Citizen TIN</td>
				</tr>
				<tr>
					<td id="pwdandsig" class="writefield">OSCA/PWD ID No.</td>
					<td id="pwdandsig" class="writefield">Signature</td>
				</tr>
			</table>
			</div>
			<br> <br>
			<div id="sign">
				Digital Network Communications &  Computers, Inc.
				<br>
				By:________________________________<br>
				Cashier/Authorized Representative
			</div>
		
		</div>
		<script>
		function printFunction() {
			var printbutton = document.getElementById('printButton');
			var backlink = document.getElementById('backlink');
			printbutton.style.display = 'none';
			backlink.style.display = 'none';
			$("body").css("width", "100%");
			window.print();
			$("body").css("width", "75%");
			printbutton.style.display = 'block';
			backlink.style.display = 'block';
		}
		</script>
	</body>
</html>