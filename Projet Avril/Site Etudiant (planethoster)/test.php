<?php
	function Test(){
		echo("
			function Test(selection){
				var listeFiliere = [];
				var listeGroupe = [];
				var req = new XMLHttpRequest();
				req.open(\"GET\",\"API/filiere.json\",false);
			    req.send(null);
			    var reponse = req.responseText;
			    var meteoJson = JSON.parse(reponse);
			    var k = 0;
			    for (const i in meteoJson){
			    	listeFiliere.push(i);
			    	listeGroupe.push(meteoJson[i]);
			    	k++;
			    }"
				
				
			."}
			");
	}
?>

<script type="text/javascript">
	function Test(selection){
		var listeFiliere = [];
		var listeGroupe = [];
		var req = new XMLHttpRequest();
		req.open("GET","API/filiere.json",false);
	    req.send(null);
	    var reponse = req.responseText;
	    var meteoJson = JSON.parse(reponse);
	    var k = 0;
	    for (const i in meteoJson){
	    	listeFiliere.push(i);
	    	listeGroupe.push(meteoJson[i]);
	    	k++;
	    }
		
		if (selection === "MIPI") {

		}
	}

	Test("MIPI");
</script>