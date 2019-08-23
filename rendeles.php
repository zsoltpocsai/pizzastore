<?php
session_start();

$rendeles_szam_file = fopen("rendelesek/rendeles_szam.txt", "r");
$rendeles_szam = fgets($rendeles_szam_file);
fclose($rendeles_szam_file);

$rendeles_szam_file = fopen("rendelesek/rendeles_szam.txt", "w");

if (strlen($rendeles_szam) == 0) {
	$rendeles_szam = 1;
} else {
	$rendeles_szam++;
}

fputs($rendeles_szam_file, $rendeles_szam);
fclose($rendeles_szam_file);

$rendeles_file = fopen("rendelesek/" . $rendeles_szam . ".txt", "w");

$rendeles = 
	"Rendelés szám: " . $rendeles_szam . "\r\n" .
	"Név: " . $_SESSION["rendeles"]["nev"] . "\r\n" .
	"Szállítási cím: " . $_SESSION["rendeles"]["cim"] . "\r\n" .
	"E-mail: " . $_SESSION["rendeles"]["email"] . "\r\n" .
	"Fizetési mód: " . $_SESSION["rendeles"]["fizetes"] . "\r\n" .
	"---------------------------\r\n";
	
foreach ($_SESSION["kosar"] as $pizza) {
	$rendeles .= $pizza["nev"] . ", " . $pizza["price"] . " Ft, " . $pizza["darab"] . " db\r\n";
}
	
fputs($rendeles_file, $rendeles);
fclose($rendeles_file);

unset($_SESSION["kosar"]);
?>
<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Pizzéria</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "header.php";
?>

<h3>Megrendelésedet fogadtam!</h3>
<p>
<?php echo str_replace("\r\n", "<br>", $rendeles); ?>
</p>
</body>

</html>