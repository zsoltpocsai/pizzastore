<?php
session_start();
?>
<!DOCTYPE html>
<?php
include "pizza_list_functions.php";
$pizzak = array();
read_pizzas("pizzak/pizzak.txt", $pizzak);

if (isset($_POST["pizza"])) {
	
	if (isset($_SESSION["kosar"][$_POST["pizza"]])) {
		
		$_SESSION["kosar"][$_POST["pizza"]]["darab"]++;
		
	} else {
		
		$_SESSION["kosar"][$_POST["pizza"]] = array
			("nev"=>$_POST["pizza"], "darab"=>$_POST["darab"], "price"=>$_POST["price"]);
	}
}
?>

<html>
<head>
<meta charset="utf-8">
<title>Pizzéria</title>
<link rel="stylesheet" href="style.css">
</head>

<style>
.pizza {
	padding: 10px;
	margin: auto;
	width: 300px;
	overflow: hidden;
}
.pizza .title {
	background-color: lightgrey;
	height: 40px;
	width: 100%;
}
.pizza .name {
	padding-left: 10px;
	line-height: 40px;
	float: left;
}
.pizza .price {
	padding-right: 10px;
	line-height: 40px;
	float: right;
}
.pizza img {
	display: block;
	border-top: 1px solid;
	height: 170px;
	width: 100%;
}
.pizza .input {
	height: 40px;
}
.pizza .amount {
	box-sizing: border-box;
	border: 1px solid;
	border-right: none;
	float: left;
	background-color: lightgrey;
	width: 30%;
	height: 100%;
}
input[type=number] {
	box-sizing: border-box;
	margin: 5px;
	padding: 2px;
	width: 50%;
	height: 30px;
}
.pizza button {
	background-color: white;
	border: 1px solid;
	float: right;
	height: 100%;
	width: 70%;
	transition-duration: 0.3s;
	cursor: pointer;
}
.pizza button:hover {
	background-color: green;
	color: white;
	border: none;
}

table {
	position: fixed;
	top: 200px;
	left: 8%;
	border: 2px solid;
	border-radius: 10px;
	padding: 10px;
}
table td {
	padding: 2px 5px;
}
</style>

<body>

<?php
include("header.php");
?>

<table>
	<tr>
		<th>Név</th>
		<th>Ár</th>
	</tr>
<?php
	foreach ($pizzak as $pizza) {
?>	<tr>
		<td><?php echo $pizza["name"]; ?></td>
		<td><?php echo $pizza["price"]; ?></td>
	</tr>
<?php 
	} 
?>
</table>

<?php foreach ($pizzak as $pizza) { ?>
<form class="pizza" method="post">
	<div class="title">
		<span class="name"><?php echo $pizza["name"]; ?></span>
		<span class="price"><?php echo $pizza["price"] . " Ft"; ?></span>
	</div>	
	<img src="<?php echo $pizza["img"]; ?>">
	<div class="input">
		<input type="hidden" name="pizza" value="<?php echo $pizza["name"]; ?>">
		<input type="hidden" name="price" value="<?php echo $pizza["price"]; ?>">
		<div class="amount">
			<input type="number" name="darab" value="1" min="1">
			<span>db</span>
		</div>
		<button type="submit">Kosárba</button>	
	</div>
</form>
<?php } ?>

</body>
</html>