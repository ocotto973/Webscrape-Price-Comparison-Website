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
		margin-left: 100px;
		margin-right: 50px;
		vertical-align: top;
	}
	h1{
		text-align: center;
	}
	h3{
		text-align: center;
	}
</style>
</head>
<body>
	<h1>Oscar's Electronic Shop</h1>
	<h3>To see our electronics and accessories, please check our items below!</h3>
	<?php
        	$cnx = new mysqli('localhost','oscarcotto','abc','tryBase');
        	if($cnx->connect_error){
                	die('Connection Failed: ' . $cnx->connect_error);
        	}
        	$query = 'SELECT * FROM dropshipTable';
        	$cursor = $cnx->query($query);
		$counter = 0;
        	while($row = $cursor->fetch_assoc()){
			echo '<div class=outter>';
			echo '<a href="comparison.php?id=' . urlencode($row['id']). '">';
			echo '<img src=" ' . $row['imageURL'] . '"/></a>';
                	echo '<p>' . $row['productName'] . '</p>';
			echo '</div>';
			$counter +=1;
			if($counter >= 3){
				echo'<br>';
				$counter = 0;
			}
		}
        	$cnx->close();
	?>
</body>
</html>
