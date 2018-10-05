<?php
include_once('confdb.php');
$pdo = new PDO('mysql:host='.$dbconf['host'].';dbname='.$dbconf['db_name'], $dbconf['user'], $dbconf['pass']);
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$host = isset($_POST['host']) ? trim($_POST['host']) : '';
$coordcountry = isset($_POST['coordcountry']) ? trim($_POST['coordcountry']) : '';
$contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';
$status = isset($_POST['status']) ? trim($_POST['status']) : '';
$location = isset($_POST['location']) ? trim($_POST['location']) : '';
$lng = isset($_POST['lng']) ? trim($_POST['lng']) : '';
$lat = isset($_POST['lat']) ? trim($_POST['lat']) : '';
$domain = isset($_POST['domain']) ? trim($_POST['domain']) : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
$ric = isset($_POST['ric']) ? trim($_POST['ric']) : '';
$rik = isset($_POST['rik']) ? trim($_POST['rik']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$submit = isset($_POST['submit']) ? $_POST['submit'] : '';

$flag = 0;
if($submit){

  if($url && !filter_var($url, FILTER_VALIDATE_URL)){
    //echo "Invalid url format";
    $flag = 1;
  }

  if($name && !preg_match("/^[a-zA-Z ]*$/",$name)) {
    //echo "Only letters and white space allowed";
    $flag = 2;
  }

  $description = filter_var($description, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if($flag === 0){
    $description = urlencode($description);
    $query = "INSERT INTO intermediate_mark (name,url,host,lat,lng,location,coordcountry,contact,
      status,domain,ric,rik,type,description) VALUES (:name,:url,:host,:lat,:lng,
      :location,:coordcountry,:contact,:status,:domain,:ric,:rik,:type,:description)";
    $result = $pdo->prepare($query);
    $result->bindParam(':name',$name);
    $result->bindParam(':url',$url);
    $result->bindParam(':host',$host);
    $result->bindParam(':lat',$lat);
    $result->bindParam(':lng',$lng);
    $result->bindParam(':location',$location);
    $result->bindParam(':coordcountry',$coordcountry);
    $result->bindParam(':contact',$contact);
    $result->bindParam(':status',$status);
    $result->bindParam(':domain',$domain);
    $result->bindParam(':ric',$ric);
    $result->bindParam(':rik',$rik);
    $result->bindParam(':type',$type);
    $result->bindParam(':description',$description);
    $result->execute();

    if(!$result){
      echo "Error: Our query failed to execute and here is why: \n";
      echo "Query: " . $query . "\n";
      echo "Errno: " . $pdo->errno . "\n";
      echo "Error: " . $pdo->error . "\n";
      exit;
    }
    $result->closeCursor();
  }
}

if ($flag != 0)
  header('Location: /app_2_2/add_non_esfri_main.php?err='.$flag);
else
  header('Location: /app_2_2/add_non_esfri_main.php?success=true');
?>
