<?php
	function TrierFiliere(){
		$json = file_get_contents("API/filiere.json");
		#$json = json_decode($json, true);
		return $json;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<script src="script.js" type="text/javascript"></script>
</head>
<body>
	<script type="text/javascript">
		var json = <?php echo(TrierFiliere()) ?>;
		let groupes = Object.keys(json["ECO"]);
		console.log(groupes[1]);
	</script>
</body>
</html>