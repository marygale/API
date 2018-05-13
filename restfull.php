<?php
echo 'gale';
include_once('config.php');

try{
    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "Select * FROM users";
    $query = $con->prepare( $sql );
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    var_dump($results);
}catch (PDOException $e) {
    print_r($stmt->errorInfo());
    print_r('<script>alert("Error '.$stmt->errorCode().' has occurred. Please contact support@gale.com and try again later.")</script>');
}


