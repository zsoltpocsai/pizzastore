<?php
session_start();

unset($_SESSION["felhasznalo"]);

header("Location: index.php?page=1");
?>