<html>
	<head>
		<script src="/assets/js/jquery.js"> </script>
		<script src="/assets/js/navigation.js"> </script>
		<link rel="stylesheet" href="/assets/css/supplier.css">
	</head>
	<body>
		<a href="http://localhost/index.php/main/logout"> <img id="logout" src="/assets/media/logout.png"> </a>
		<div class="errormsg">
			Sample text
		</div>
		<div id="transfer-product-form">
		<table id="listprods">
			<?php foreach($supplies as $supply){
				echo "<tr>";
				echo "<td class='pn'>".$supply["product_name"]."</td>";
				echo "<td class='am'>".$supply["quantity"]."</td>";
				echo "<td><button class='transfer-supply'> Transfer Supply </button></td>";
				echo "</tr>";
			}
			?>
		</table>
		</div>
	</body>
	<script>
		$(document).ready(function(){   //change
			$(".transfer-supply").click(function(){
				var supplier_name = "<?php echo $username;?>";
				var prodname = $(this).parent().siblings("td.pn").html();
				$.ajax({
					url: "http://localhost/index.php/main/confirm_transfer",
					type: "POST",
					data: {
						prodname: prodname,
						supplier_name: supplier_name
					},
					success: function() {
						location.reload();
					},	
					error: function(data) {
					   console.log(data.responseText);
					}
				});
			});
		});
		
	</script>
</html>