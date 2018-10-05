<?php
	include ('confdb.php');
	$pdo = new PDO('mysql:host='.$dbconf['host'].';dbname='.$dbconf['db_name'], $dbconf['user'], $dbconf['pass']);
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$accept = isset($_POST['accept']) ? $_POST['accept'] : '';

	$query1 = "SELECT * FROM intermediate_esfris WHERE identifier=:id";
	$result1 = $pdo->prepare($query1);
	$result1->bindParam(':id',$id);
	$result1->execute();

    if(!$result1){
      echo "Error: Our query failed to execute and here is why: \n";
      echo "Query: " . $query1 . "\n";
      echo "Errno: " . $pdo->errno . "\n";
      echo "Error: " . $pdo->error . "\n";
      exit;
    }
	
	$row = $result1->fetch(PDO::FETCH_ASSOC);// it may come in handy inside $accept if-statement
    $result1->closeCursor();
	
	if($accept == "true"){
		$query2 = "INSERT INTO esfris ( name, domain, type, coordinating_country, members, partners, roadmap_entry, 
		operation_start, preparation_cost, construction_cost, operation_cost, headquarters, website, location, latitude, longitude, 
		description, background, steps, activity, impact, esfri_type) VALUES (:name,:domain,:type,:coordinating_country,:members,:partners,
		:roadmap_entry,:operation_start,:preparation_cost,:construction_cost,:operation_cost,:headquarters,:website,:location,:latitude,:longtitude,
		:description,:background,:steps,:activity,:impact,:esfri_type)";
		$result2 = $pdo->prepare($query2);
		$result2->bindParam(':name',$row['name']);
		$result2->bindParam(':domain',$row['domain']);
		$result2->bindParam(':type',$row['type']);
		$result2->bindParam(':coordinating_country',$row['coordinating_country']);
		$result2->bindParam(':members',$row['members']);
		$result2->bindParam(':partners',$row['partners']);
		$result2->bindParam(':roadmap_entry',$row['roadmap_entry']);
		$result2->bindParam(':operation_start',$row['operation_start']);
		$result2->bindParam(':preparation_cost',$row['preparation_cost']);
		$result2->bindParam(':construction_cost',$row['construction_cost']);
		$result2->bindParam(':operation_cost',$row['operation_cost']);
		$result2->bindParam(':headquarters',$row['headquarters']);
		$result2->bindParam(':website',$row['website']);
		$result2->bindParam(':location',$row['location']);
		$result2->bindParam(':latitude',$row['latitude']);
		$result2->bindParam(':longtitude',$row['longtitude']);
		$result2->bindParam(':description',$row['description']);
		$result2->bindParam(':background',$row['background']);
		$result2->bindParam(':steps',$row['steps']);
		$result2->bindParam(':activity',$row['activity']);
		$result2->bindParam(':impact',$row['impact']);
		$result2->bindParam(':esfri_type',$row['esfri_type']);
		$result2->execute();

		if(!$result2){
			echo "Error: Our query failed to execute and here is why: \n";
			echo "Query: " . $query2 . "\n";
			echo "Errno: " . $pdo->errno . "\n";
			echo "Error: " . $pdo->error . "\n";
			exit;
		}
		$result2->closeCursor();
	}
	
	$query3 = "DELETE FROM intermediate_esfris WHERE identifier=:id";
	$result3 = $pdo->prepare($query3);
	$result3->bindParam(':id',$id);
	$result3->execute();

    if(!$result3){
      echo "Error: Our query failed to execute and here is why: \n";
      echo "Query: " . $query3 . "\n";
      echo "Errno: " . $pdo->errno . "\n";
      echo "Error: " . $pdo->error . "\n";
      exit;
    }
    $result3->closeCursor();
?>