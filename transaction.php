<html>
<head>
	<title>Oscar's Electronic Shop</title>
<style type= text/css>
	img{
		width: 200px;
		height: 300px;
	}
	img:hover{
		cursor: pointer;
	}
	p{
		width: 200px;
		font-size: 10px;
	}
	.outter{
		display: inline-block;
		margin-left: 220px;
		margin-right: 100px;
		vertical-align: top;
	}
	h1{
		text-align: center;
	}
</style>

</head>

<body>
	<h1>Oscar's Electronic Shop</h1>
	<?php
		$cnx = new mysqli('localhost','oscarcotto','abc', 'tryBase');
		if($cnx->connect_error){
			die('Connection Failed' . $cnx->connect_error);
		}
		$id = urldecode($_GET['id']);
		$query1 = 'SELECT * FROM dropshipTable WHERE id = '. $id;
		$cursor = $cnx->query($query1);
		$row1 = $cursor->fetch_assoc();
		$productName = $row1['productName'];
	?>
	<form action="transactionProcess.php" method="post">
		<label for="productName">Product Name:</label>
		<input type="text" name="productName" value="<?php echo $productName;?>" readonly required/>
		<br>
		<label for="customerName">Enter Your Name:</label>
		<input type="text" name="customerName" required/>
		<br>
		<label for="customerAddress">Enter Your Full Address:</label>
                <input type="text" name="customerAddress" required/>
		<br>
		<label for="creditCard">Enter Your Debit/Credit Card Number:</label>
                <input type="text" name="creditCard" required/>
		<br>
		<input type="submit" value="Submit"/>
	</form>
	<?php $cnx->close();?>
</body>

</html>
