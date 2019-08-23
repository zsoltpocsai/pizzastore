<?php
session_start();
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
input[type=file] {
	
}
</style>

<body>

<?php include "header.php"; ?>

<form method="post" enctype="multipart/form-data" action="pizza_list_edit.php?page=s1">
	<h2>Pizza felvétele</h2>
	<ul>
		<li>
			<label>Név</label>
			<input type="text" name="name_add">
		</li>
		<li>
			<label>Ár</label>
			<input type="number" name="price">
		</li>
		<li>
			<label>Kép</label>
			<input type="file" name="img">
		</li>
	</ul>
	<button type="submit" name="action" value="add">Hozzáad</button><br>
	<h2>Pizza törlése</h2>
	<ul>
		<li>
			<label>Név</label>
			<input type="text" name="name_remove">
		</li>
	</ul>
	<button type="submit" name="action" value="remove">Töröl</button>
</form>

</body>
</html>