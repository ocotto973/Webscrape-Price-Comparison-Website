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
		$cnx = new mysqli('localhost','oscarcotto','abc','tryBase');
        	if($cnx->connect_error){
                	die('Connection Failed: ' . $cnx->connect_error);
        	}
		$id = urldecode($_GET['id']);
		$comparionID = 0;
		if ($id <=25){
			$comparisonID = $id + 25;
		}
		else{
			$comparisonID = $id-25;
		}
		$query1 = 'SELECT * FROM dropshipTable WHERE id = '. $id;
		$query2 = 'SELECT * FROM dropshipTable WHERE id = '. $comparisonID;
		$cursor = $cnx->query($query1);
		$cursor2 = $cnx->query($query2);
		$row1 = $cursor->fetch_assoc();
		$row2 = $cursor2->fetch_assoc();
		$price1 = number_format($row1['price'] + (.05 * $row1['price']),2);
		$price2 = number_format($row2['price'] + (.05 * $row2['price']),2);

		echo '<a href="transaction.php?id=' . urlencode($row1['id']). '">';
		echo '<div class="outter">';
		if($price1 < $price2){ echo '<div style="border: 2px solid yellow;" >';}
		else{	echo '<div>';}
		echo '<img src="'. $row1['imageURL'] . '"/>';
		echo '<p>' . $row1['productName'] . '</p>';
		echo '<p> Product Description: ' . $row1['description'] . '</p>';
		echo '<p> Price: $' . $price1 . '</p>';
		echo '<p> Review Score: ' . $row1['reviewScore'] . '</p>';
		echo '</div>';
		echo '</div>';
		echo '</a>';

		echo '<a href="transaction.php?id=' . urlencode($row2['id']). '">';
		echo '<div class="outter">';
		if($price2<$price1){ echo '<div style="border: 2px solid yellow;padding: 10px;" >';}
                else{   echo '<div>';}
		echo '<img src="'. $row2['imageURL'] . '"/>';
                echo '<p>' . $row2['productName'] . '</p>';
                echo '<p> Product Description: ' . $row2['description'] . '</p>';
                echo '<p> Price: $' . $price2 . '</p>';
                echo '<p> Review Score: ' . $row2['reviewScore'] . '</p>';
		echo '</div>';
		echo '</div>';
		echo '</a>';
	?>
</body>
</html>
