<?php
echo 'gale';
include_once('config.php');
require_once 'utils/API.php';
require_once 'api/RestFullAPI.php';
try {
    $API = new RestFullAPI ($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
/*try{
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
}*/
