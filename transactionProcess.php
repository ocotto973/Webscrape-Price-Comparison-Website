<?php
	$cnx = new mysqli('localhost','oscarcotto','abc', 'tryBase');
	if($cnx->connect_error){
		die('Connection Failed' . $cnx->connect_error);
	}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$customerName = $_POST['customerName'];
		$customerAddress = $_POST['customerAddress'];
		$creditCard = $_POST['creditCard'];
		$productName = $_POST['productName'];
		$query = "INSERT INTO transactionTable (customerName,customerAddress,creditCard, productName) VALUES('$customerName','$customerAddress','$creditCard','$productName')";
		if($cnx->query($query) === TRUE){
			echo "Thank you for shopping with us!";
		}
		else{
			echo "Error " . $query ."<br>" . $cnx->error;
		}
	}
	$cnx->close();
?>
