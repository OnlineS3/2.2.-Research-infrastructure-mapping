<?php

$servername = "";
$username = "";
$password = "";
$dbname = ""

$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    die("Connection failed");
}

$query = "SELECT latitude, longitude, name, website , coordinating_country, headquarters , domain , location , partners , members , roadmap_entry , operation_start , preparation_cost , construction_cost , operation_cost , description , background , steps , activity , impact , esfri_type  FROM esfris";
mysqli_set_charset($link, "utf8");
$results = mysqli_query($link, $query);

?>