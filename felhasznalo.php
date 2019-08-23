<?php
session_start();

$user_id = $_SESSION["felhasznalo"]["id"];
if (file_exists("users/" . $user_id . ".txt")) {
	$user_file = fopen("users/" . $user_id . ".txt", "r");
} else {
	die("Fájl nem létezik!");
}

while (!feof($user_file)) {
	$str = chop(fgets($user_file));
	switch ($str) {
		case "cim":
			$_SESSION["felhasznalo"]["cim"] = chop(fgets($user_file));
			break;
		case "nev":
			$_SESSION["felhasznalo"]["nev"] = chop(fgets($user_file));
			break;
	}
}

fclose($user_file);

$mezok = array(
	array("id"=>"nev", "cimke"=>"Név"),
	array("id"=>"cim", "cimke"=>"Cím"),
	array("id"=>"email", "cimke"=>"E-mail")
	);

if (isset($_POST["modosit"])) {
	foreach ($mezok as $mezo) {
		if (isset($_POST[$mezo["id"]]) && (strlen($_POST[$mezo["id"]]) > 0)) {
			$_SESSION["felhasznalo"][$mezo["id"]] = $_POST[$mezo["id"]];
		}
	}
}

if (isset($_POST["edit"])) {
	unset($_SESSION["felhasznalo"][$_POST["edit"]]);
}

$user_file = fopen("users/" . $user_id . ".txt", "w");

foreach ($mezok as $mezo) {
	if (isset($_SESSION["felhasznalo"][$mezo["id"]])) {
		fputs($user_file, $mezo["id"] . "\r\n");
		fputs($user_file, $_SESSION["felhasznalo"][$mezo["id"]] . "\r\n");
	}
}
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title>Pizzéria</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="form.css">
</head>

<style>
button.edit {
	float: right;
	margin-right: 350px;
}
</style>

<body>

<?php include "header.php"; ?>

<form method="post">
<?php	if (isset($_SESSION["felhasznalo"]["nev"])) { ?>

		<h3>Üdvözöljük, <?php echo $_SESSION["felhasznalo"]["nev"]; ?></h3>
		
<?php	} else { ?>

		<h2>Üdvözöljük, <?php echo $_SESSION["felhasznalo"]["id"]; ?></h2>
		
<?php	} ?>

	<p>Itt kitöltheti, illetve módosíthatja adatait!</p>

	<ul>
<?php	foreach ($mezok as $mezo) { ?>
		<li>
			<label><?php echo $mezo["cimke"]; ?></label>
			
<?php 		if (isset($_SESSION["felhasznalo"][$mezo["id"]])) {
	
				echo $_SESSION["felhasznalo"][$mezo["id"]]; ?>
				
				<button class="edit" name="edit" 
						value="<?php echo $mezo["id"]; ?>">
					Szerkesztés
				</button>
				
<?php		} else { ?>

			<input type="text" name="<?php echo $mezo["id"]; ?>">
			
<?php		} ?>
		</li>
<?php	} ?>
	</ul>
	<button type="submit" name="modosit">Módosít</button>
</form>
</body>

<html>