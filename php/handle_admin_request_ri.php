<?php	
	include ('confdb.php');
	$pdo = new PDO('mysql:host='.$dbconf['host'].';dbname='.$dbconf['db_name'], $dbconf['user'], $dbconf['pass']);
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$accept = isset($_POST['accept']) ? $_POST['accept'] : '';

	$query1 = "SELECT * FROM intermediate_mark WHERE identifier=:id";
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
		$query2 = "INSERT INTO mark(name, url, host, lat, lng, location, coordcountry, contact,
		status, domain, ric, rik, type, description) VALUES (:name,:url,:host,:lat,:lng,
		:location,:coordcountry,:contact,:status,:domain,:ric,:rik,:type,:description)";
		$result2 = $pdo->prepare($query2);
		$result2->bindParam(':name',$row['name']);
		$result2->bindParam(':url',$row['url']);
		$result2->bindParam(':host',$row['host']);
		$result2->bindParam(':lat',$row['lat']);
		$result2->bindParam(':lng',$row['lng']);
		$result2->bindParam(':location',$row['location']);
		$result2->bindParam(':coordcountry',$row['coordcountry']);
		$result2->bindParam(':contact',$row['contact']);
		$result2->bindParam(':status',$row['status']);
		$result2->bindParam(':domain',$row['domain']);
		$result2->bindParam(':ric',$row['ric']);
		$result2->bindParam(':rik',$row['rik']);
		$result2->bindParam(':type',$row['type']);
		$result2->bindParam(':description',$row['description']);
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
	
	$query3 = "DELETE FROM intermediate_mark WHERE identifier=:id";
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