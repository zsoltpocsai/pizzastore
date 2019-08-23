<?php
include "user_list_functions.php";

$users = array();
read_users("users/users.txt", $users);

if (isset($_POST["regist"])) {

	if (strlen($_POST["id"]) == 0) {
		$error = "Név nincs kitöltve!";
	} elseif (strlen($_POST["jelszo"]) == 0) {
		$error = "Jelszó nincs megadva!";
	} elseif (isset($users[$_POST["id"]])) {
		$error = "A felhasználó már létezik!";
	} else {
		$error = null;
	}
	
	if ($error == null) {
		$users[$_POST["id"]] = array
			("id"=>$_POST["id"], "jelszo"=>$_POST["jelszo"]);
			
		fopen("users/" . $_POST["id"] . ".txt", "w");
			
		save_users($users, "users/users.txt");
		
		header("Location: bejelentkezes.php?page=5");
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

<body>

<?php include "header.php"; ?>

<form method="post">
	<h2>Regisztráció</h2>
	<ul>
		<li>
			<label for="nev">Azonosító</label>
			<input id="nev" type="text" name="id">
		</li>
		<li>
			<label for="jelszo">Jelszó</label>
			<input id="jelszo" type="password" name="jelszo">
		</li>
	</ul>
	<button type="submit" name="regist">Regisztrál</button>
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