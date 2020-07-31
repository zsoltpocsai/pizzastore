<header>
	<h1>Pizzéria</h1>
</header>

<?php
if (isset($_GET["page"])) { ?>
<style> 
<?php
	switch ($_GET["page"]) {
		case "1":
			echo "#li1";
			break;
		case "2":
			echo "#li2";
			break;
		case "3":
			echo "#li3";
			break;
		case "4":
			echo "#li4";
			break;
		case "5":
			echo "#li5";
			break;
		case "s1":
			echo "#s1";
			break;
		default:
			echo "";
			break;
		}
?> a { 
	background-color: black;
	color: white;
}
</style>
<?php
} 
?>

<nav>
	<ul>
		<li class="left" id="li1">
			<a href="index.php?page=1">Kezdőlap</a>
		</li>
		<li class="left" id="li2">
			<a href="pizzak.php?page=2">Pizzák</a>
		</li>
		<li class="left" id="li3">
			<a href="kosar.php?page=3">Kosár</a>
		</li>
		<li class="secret left" id="s1">
<?php 
		if (isset($_SESSION["felhasznalo"]) 
				&& $_SESSION["felhasznalo"]["id"] == "admin") {
?>
			<a href="pizza_list_form.php?page=s1">Pizza hozzáadás/törlés</a>
<?php
		}
?>
		</li>
		<li class="right" id="li4">
<?php 	if (isset($_SESSION["felhasznalo"])) { 
			if (isset($_SESSION["felhasznalo"]["nev"])) { 
?>			<a href="felhasznalo.php?page=4"><?php echo $_SESSION["felhasznalo"]["nev"]; ?></a>
<?php	 	} else {
?>			<a href="felhasznalo.php?page=4"><?php echo $_SESSION["felhasznalo"]["id"]; ?></a>
<?php		} 
		} else { 
?>			<a href="regisztracio.php?page=4">Regisztráció</a>
<?php 	} 
?>		</li>
		<li class="right" id="li5">
<?php 	if (isset($_SESSION["felhasznalo"])) {
?>			<a href="kijelentkezes.php">Kijelentkezés</a>
<?php 	} else { 
?>			<a href="bejelentkezes.php?page=5">Bejelentkezés</a>
<?php	} 
?>		</li>
	</ul>
</nav>