<?php
session_start();

include "user_list_functions.php";
$error = null;
$users = array();

read_users("data/users/users.txt", $users);

if (isset($_POST["enter"])) {
	if (isset($users[$_POST["id"]])) {
		if ($users[$_POST["id"]]["jelszo"] == $_POST["jelszo"]) {
			$_SESSION["felhasznalo"]["id"] = $_POST["id"];
			header("Location: index.php?page=1");
		} else {
			$error = "Hibás jelszó!";
		}
	} else {
		$error = "A felhasználó nem létezik!";
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

<body>

<?php include "header.php"; ?>

<form method="post">
	<h2>Bejelentkezés</h2>
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
	<button type="submit" name="enter">Bejelentkezés</button>
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