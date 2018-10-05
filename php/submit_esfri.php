<?php
include_once('confdb.php');
$pdo = new PDO('mysql:host='.$dbconf['host'].';dbname='.$dbconf['db_name'], $dbconf['user'], $dbconf['pass']);
$name = isset($_POST['nameESFRI']) ? trim($_POST['nameESFRI']) : '';
$website = isset($_POST['websiteESFRI']) ? $_POST['websiteESFRI'] : '';
$coordcountry = isset($_POST['coordcountryESFRI']) ? trim($_POST['coordcountryESFRI']) : '';
$location = isset($_POST['locationESFRI']) ? trim($_POST['locationESFRI']) : '';
$lng = isset($_POST['lngESFRI']) ? trim($_POST['lngESFRI']) : '';
$lat = isset($_POST['latESFRI']) ? trim($_POST['latESFRI']) : '';
$domain = isset($_POST['domainESFRI']) ? trim($_POST['domainESFRI']) : '';
$type = isset($_POST['typeESFRI']) ? $_POST['typeESFRI'] : '';
$description = isset($_POST['descriptionESFRI']) ? trim($_POST['descriptionESFRI']) : '';
$headquarters = isset($_POST['hqESFRI']) ? trim($_POST['hqESFRI']) : '';
$members = isset($_POST['membersESFRI']) ? trim($_POST['membersESFRI']) : '';
$partners = isset($_POST['partnersESFRI']) ? trim($_POST['partnersESFRI']) : '';
$roadmap = isset($_POST['roadmapESFRI']) ? trim($_POST['roadmapESFRI']) : '';
$opStart = isset($_POST['opStartESFRI']) ? trim($_POST['opStartESFRI']) : '';
$prepCost = isset($_POST['prepCostESFRI']) ? trim($_POST['prepCostESFRI']) : '';
$constCost = isset($_POST['constCostESFRI']) ? trim($_POST['constCostESFRI']) : '';
$opCost = isset($_POST['opCostESFRI']) ? trim($_POST['opCostESFRI']) : '';
$esfriType = isset($_POST['typeESFRItype']) ? $_POST['typeESFRItype'] : '';
$background = isset($_POST['backgroundESFRI']) ? trim($_POST['backgroundESFRI']) : '';
$steps = isset($_POST['stepsESFRI']) ? trim($_POST['stepsESFRI']) : '';
$activity = isset($_POST['activityESFRI']) ? trim($_POST['activityESFRI']) : '';
$impact = isset($_POST['impactESFRI']) ? trim($_POST['impactESFRI']) : '';

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

  //for 1900-2099
  if($roadmap && !preg_match("/^(19|20)\d{2}$/",$roadmap)){
    //echo "Roadmap Entry date is not in range 1900-2099";
    $flag = 3;
  }

  if($opStart && !preg_match("/^(19|20)\d{2}$/",$opStart)){
    //echo "Operation Start date is not in range 1900-2099";
    $flag = 4;
  }

  $description = filter_var($description, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $background = filter_var($background, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $steps = filter_var($steps, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $activity = filter_var($activity, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $impact = filter_var($impact, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if($flag === 0){
    $description = urlencode($description);
    $background = urlencode($background);
    $steps = urlencode($steps);
    $activity = urlencode($activity);
    $impact = urlencode($impact);

    $query = "INSERT INTO intermediate_esfris (name,domain,type,coordinating_country,members,partners,roadmap_entry,
operation_start,preparation_cost,construction_cost,operation_cost,headquarters,website,location,latitude,longitude,
description,background,steps,activity,impact,esfri_type) VALUES (:name,:domain,:type,:coordinating_country,:members,:partners,
	:roadmap_entry,:operation_start,:preparation_cost,:construction_cost,:operation_cost,:headquarters,:website,:location,:latitude,:longtitude,
	:description,:background,:steps,:activity,:impact,:esfri_type)";
    $result = $pdo->prepare($query);
    $result->bindParam(':name',$name);
    $result->bindParam(':domain',$domain);
    $result->bindParam(':type',$type);
    $result->bindParam(':coordinating_country',$coordcountry);
    $result->bindParam(':members',$members);
    $result->bindParam(':partners',$partners);
    $result->bindParam(':roadmap_entry',$roadmap);
    $result->bindParam(':operation_start',$opStart);
    $result->bindParam(':preparation_cost',$prepCost);
    $result->bindParam(':construction_cost',$constCost);
    $result->bindParam(':operation_cost',$opCost);
    $result->bindParam(':headquarters',$headquarters);
    $result->bindParam(':website',$website);
    $result->bindParam(':location',$location);
    $result->bindParam(':latitude',$lat);
    $result->bindParam(':longtitude',$lng);
    $result->bindParam(':description',$description);
    $result->bindParam(':background',$background);
    $result->bindParam(':steps',$steps);
    $result->bindParam(':activity',$activity);
    $result->bindParam(':impact',$impact);
    $result->bindParam(':esfri_type',$esfriType);
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
  header('Location: /app_2_2/add_esfri_main.php?err='.$flag);
else
  header('Location: /app_2_2/add_esfri_main.php?success=true');
?>
