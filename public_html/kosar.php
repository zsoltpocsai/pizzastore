<?php
session_start();

if (!isset($_SESSION["kosar"])) {
	$_SESSION["kosar"] = array();
}

if (isset($_POST["delete"])) {
	unset($_SESSION["kosar"][$_POST["delete"]]);
}

if (isset($_POST["rendeles"])) {
	
	if (strlen($_POST["nev"]) == 0) {
		$error = "Név nincs kitöltve!";
	} elseif (strlen($_POST["cim"]) == 0) {
		$error = "Cím nincs kitöltve!";
	} elseif (strlen($_POST["fizetes"]) == 0) {
		$error = "Fizetési mód nincs megadva!";
	} elseif (strlen($_POST["email"]) == 0) {
		$error = "E-mail cím nincs kitöltve!";
	} elseif (count($_SESSION["kosar"]) == 0) {
		$error = "A kosarad üres!";
	} else {
		$error = null;
	}
	
	if ($error == null) {
		$_SESSION["rendeles"] = array
			("nev"=>$_POST["nev"], "cim"=>$_POST["cim"], 
			"email"=>$_POST["email"], "fizetes"=>$_POST["fizetes"]);
		header("Location: rendeles.php");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Pizzéria</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/form.css">
</head>

<style>
.tetel {
	height: 40px;
	margin-right: 20px;
	overflow: hidden;
}
.tetel span {
	float: left;
	width: 80px;
	line-height: 40px;
}
.tetel .ures {
	width: 120px;
}
.osszesen {
	border-top: 1px solid;
}
.tetel button {
	background-color: white;
	border: 1px solid;
	float:right;
	height: 30px;
	margin: 5px 20px;
	transition: 0.3s;
	cursor: pointer;
}
.tetel button:hover {
	background-color: black;
	color: white;
}
</style>

<body>

<?php
include("header.php");
?>

<form class="kosar" method="post">
	<h2>Kosár</h2>
	<ul class="tetelek">
	<?php
	$price_all = 0;
	foreach ($_SESSION["kosar"] as $pizza) { 
		$price_all += $pizza["price"] ?>
		<li class="tetel">
			<span class="nev"><?php echo $pizza["nev"]; ?></span>
			<span class="ar"><?php echo $pizza["price"] . " Ft"; ?></span>
			<span class="darab"><?php echo $pizza["darab"]; ?> db</span>
			<button type="submit" name="delete" 
			value="<?php echo $pizza["nev"]; ?>">Törlés</button>
		</li>
	<?php
	}
	if (count($_SESSION["kosar"]) == 0) { ?>
		<li class="tetel">
			<span class="ures">A kosár üres</span>
		</li>
	<?php
	} else { ?>
		<li class="tetel osszesen">
			<span>Összesen</span>
			<span><?php echo $price_all . " Ft"; ?></span>
		</li>
	<?php } ?>
	</ul>
</form>

<form class="rendeles" method="post">
	<h2>Rendelés</h2>
	<ul>
		<li>
			<label for="nev">Név</label>
			<input id="nev" type="text" name="nev"
			<?php if (isset($_SESSION["felhasznalo"]["nev"])) { ?>
			value="<?php echo $_SESSION["felhasznalo"]["nev"]; ?>">
			<?php } ?>
		</li>
		<li>
			<label for="cim">Cím</label>
			<input id="cim" type="text" name="cim"
			<?php if (isset($_SESSION["felhasznalo"]["cim"])) { ?>
			value="<?php echo $_SESSION["felhasznalo"]["cim"]; ?>">
			<?php } ?>
		</li>
		<li>
			<label for="email">E-mail</label>
			<input id="email" type="email" name="email"
			<?php if (isset($_SESSION["felhasznalo"]["email"])) { ?>
			value="<?php echo $_SESSION["felhasznalo"]["email"]; ?>">
			<?php } ?>
		</li>
		<li>
			Fizetési mód <br>
			<label for="cash">Készpénz</label>
			<input id="cash" type="radio" name="fizetes" value="keszpenz">
			<label for="card">Kártya</label>
			<input id="card" type="radio" name="fizetes" value="kartya">
		</li>
	</ul>
	<button type="submit" name="rendeles">Rendelés</button>
	<?php
	if (isset($error) && $error != null) { ?>
	<div class="error">
		<?php echo $error; ?>
	</div>
	<?php
	}
	?>
</form>

</body>
</html>