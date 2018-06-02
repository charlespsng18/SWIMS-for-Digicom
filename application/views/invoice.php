<!DOCTYPE html>
<html>
	<head>
        <title> Invoice</title>
        <h1 id="n" style="display: none;"><?php echo $_GET["order"]; ?></h1>
        <link rel="icon" href="/assets/media/logo.jpg">
		<link rel = "stylesheet"
			type = "text/css"
			href = "/assets/css/invoice.css" />
        <script src = "/assets/js/jquery.js"></script>
        <script src="/assets/js/invoice.js"></script>
	</head>
	<body>
        <a href="orders">Back to Orders</a>
		<button onclick="printFunction()" id="printButton">Print this receipt</button>
		<div id="companydetails">
		<img src="/assets/media/applet_splash.png"><br>
            Digital Network Communication & Computers Inc. <br>
            Main Office<br>
            30/F Antel Global Corporate Center, Julia Vargas Ave., and Jade Drive<br>
            Ortigas Center, Brgy. San Antonio, Pasig City<br>
            Tel. Nos: 12346789<br>
            TIN: 123-456-789<br>
		</div>
		<div id="invoicedetail">
			<span id="invoicetitle">INVOICE</span>
			<table>
				<tr>
					<td>Date</td>
					<td id="date-c">11/10/2018</td>
				</tr>
                <tr>
                    <td>Required Ship Date</td>
                    <td id="shipd">12345</td>
                </tr>
				<tr>
					<td>Invoice #</td>
					<td id="inv-n">12345</td>
				</tr>
			</table>
		</div>
		<div id="billtodetails">
			<table id="billtotable">
				<tr>
					<th colspan="2">BILL TO</th>
				</tr>
				<tr>
					<td class="tdlabel">Name</td>
					<td id="customer"></td>
				</tr>
				<tr>
					<td>Company Name</td>
					<td id="business"></td>
				</tr>
				<tr>
					<td>Address</td>
					<td id="address"></td>
				</tr>
                <tr>
                    <td>Method of Payment</td>
                    <td id="terms">12345</td>
                </tr>
			</table>
		</div>
		<div>
			<table id="context">
				<tr>
					<th id="qty">QTY.</th>
					<th>DESCRIPTION</th>
					<th class="medium">AMOUNT</th>
				</tr>

			</table>
		</div>
		<div id="othercomments">
			Other Comment<br>
			<textarea rows="7" cols="50">
			</textarea>
		</div>
		<div id="AllTotalandTax">
			<table id="totaltable">

				<tr>
					<td>Total</td>
					<td align="right" id="total">2,000,000</td>
				</tr>
			</table>
		</div>

	</body>
</html>