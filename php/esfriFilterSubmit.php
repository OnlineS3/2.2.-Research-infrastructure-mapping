<?php

include "esfri_filtering.php";

$forms = array('domain','type','coordinating_country','esfri_type');
$filters = array();
foreach ($forms as $formType){
    $capitalizedName = ucfirst($formType);
    $subvalues = array();
    $values = json_decode($_POST['selected'.$capitalizedName]);
    foreach ($values as $value){
        array_push($subvalues,$value);
    }
    $filters[$formType] = $subvalues;
}


$query = getQuery($filters,'esfris');  //gets the query
// echo $query;
$results = executeQuery($query,'');

$locations = array();
while ($row = mysqli_fetch_row($results)) {
	$location = array("$row[0]", "$row[1]", "$row[2]" , "$row[3]" , "$row[4]" , "$row[5]" ,"$row[6]", "$row[7]", "$row[8]", "$row[9]","$row[10]","$row[11]","$row[12]","$row[13]","$row[14]", "$row[15]","$row[16]", "$row[17]","$row[18]","$row[19]","$row[20]");
	array_push($locations, $location);
}
echo json_encode($locations);