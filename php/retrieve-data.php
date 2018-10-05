<?php

$servername = "";
$username = "";
$password = "";
$dbname = ""

$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    die("Connection failed");
}

$query = "SELECT lat, lng, name, url , status , host , location , description  FROM mark";
mysqli_set_charset($link, "utf8");
$results = mysqli_query($link, $query);

?>