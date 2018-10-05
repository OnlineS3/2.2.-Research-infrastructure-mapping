<?php
	include ('confdb.php');
	$pdo = new PDO('mysql:host='.$dbconf['host'].';dbname='.$dbconf['db_name'], $dbconf['user'], $dbconf['pass']);
	
	$query = "SELECT * FROM intermediate_mark";
	
	$result = $pdo->query($query);
	
	while ($row = $result->fetch(PDO::FETCH_ASSOC) ) {
		echo "<p class='results' id='ri_".$row['identifier']."'>";
		foreach($row as $name => $value){
			echo $name.": ".$value."<br>";
		}
		echo "<input type='button' class='button btn-primary acceptButton' name='acceptButton' value='accept'>";
		echo "<input type='button' class='button btn-primary-alt denyButton' name='denyButton' value='deny'>";
		echo "</p>";
	}
	
	$result->closeCursor();
?>