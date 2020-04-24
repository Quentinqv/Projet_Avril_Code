<?php
	$json = file_get_contents("admin/jsonAPI.json");
	header("Content-type: application/json");
	echo($json);
?>