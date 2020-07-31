<?php
function read_users($users_file_name, &$dest_array) {
	$users_file = fopen($users_file_name, "r");
	
	$i = 0;
	while (!feof($users_file)) {
		$str = chop(fgets($users_file));
		switch ($i) {
			case 0:
				$user["id"] = $str;
				break;
			case 1:
				$user["jelszo"] = $str;
				break;
		}
		$i++;
		if ($i == 2) {
				$dest_array[$user["id"]] = array
				("id"=>$user["id"], "jelszo"=>$user["jelszo"]);
			$i = 0;
		}
	}

	fclose($users_file);
}

function save_users(&$src_array, $dest_file_name) {
	$users_file = fopen($dest_file_name, "w");
	
	foreach($src_array as $user) {
		fputs($users_file, $user["id"]. "\r\n");
		fputs($users_file, $user["jelszo"] . "\r\n");
	}
	
	fclose($users_file);
}
?>