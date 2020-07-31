<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Pizzéria</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include("header.php"); ?>

<?php
include("pizza_list_functions.php");
$pizzak = array();

read_pizzas("pizzak.txt", $pizzak);

if (isset($_POST["action"])) {
	switch ($_POST["action"]) {
		case "add":
			$datas[0] = $_POST["name_add"];
			$datas[1] = $_POST["price"];
			
			if ($datas[0] != "" && $datas[1] != "") {
				$datasOK = true;
			} else {
				echo "Tölts ki minden mezőt!";
				break;
			}
			
			$img_dir = "img/";
			$img_name = basename($_FILES["img"]["name"]);
			$img_fullname = $img_dir . $img_name;
			$img_ext = strtolower(pathinfo($img_fullname, PATHINFO_EXTENSION));
			$pictureOK = true;
			
			if ($img_name == "") {
				echo "Tölts fel egy képet!";
				break;
			}
			if ($img_ext != "jpg" && $img_ext != "png"
					&& $img_ext != "bmp") {
				echo "Csak .jpg .png .bmp formátum tölthető fel!";
				break;
			}
			
			move_uploaded_file($_FILES["img"]["tmp_name"], $img_fullname);
			$datas[2] = $img_fullname;
			
			if ($datasOK && $pictureOK) {
				put_pizza($pizzak, $datas);
				echo $datas[0] . " pizza sikeresen hozzáadva!";
			}
			break;
		case "remove":
			$pizza = $_POST["name_remove"];
			if ($pizza != "") {
				if (isset($pizzak[$pizza])) {
					unset($pizzak[$pizza]);
					echo $pizza . " pizza sikeresen törölve!";
				} else {
					echo $pizza . " nincs a listában!";
				}
			} else {
				echo "Add meg a törlendő pizzát!";
			}
			break;
	}
}

save_pizzas($pizzak, "pizzak.txt");
?>

</body>
</html>