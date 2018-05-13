<?php
include_once('config.php');

$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$sql = "Select * FROM users";
$query = $con->prepare( $sql );
$query->execute();
return $query->fetchAll(PDO::FETCH_ASSOC);

var_dump(results);