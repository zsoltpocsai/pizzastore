<?php
function read_pizzas($source_file_name, &$dest_array) {
	$data_file = fopen($source_file_name, "r");

	$i = 0;
	while (! feof($data_file)) {
		$str = chop(fgets($data_file));	
		$datas[$i] = $str;
		$i++;
		if ($i == 3) {
			put_pizza($dest_array, $datas);
			$i = 0;
		}
	}

	fclose($data_file);
}

function put_pizza(&$dest_array, $datas) {
	$dest_array[$datas[0]] = array("name"=>$datas[0], "price"=>$datas[1], "img"=>$datas[2]);
	
}

function save_pizzas($source_array, $dest_file_name) {
	$data_file = fopen($dest_file_name, "w");
	
	foreach ($source_array as $pizza) {
		fputs($data_file, $pizza["name"] . "\r\n");
		fputs($data_file, $pizza["price"] . "\r\n");
		fputs($data_file, $pizza["img"] . "\r\n");
	}
	
	fclose($data_file);
}
?>