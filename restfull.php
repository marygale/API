<?php
include_once('config.php');

require_once 'utils/API.php';
error_reporting(E_ALL ^ E_STRICT);

class restfull extends API{
    protected $oToken  = null;
    protected $iCurrentUserId = 0;
    protected $con = null;

    const TTT_VERSION = 'v1';

    public function __construct()
    {
        $this->con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    }

    protected function getUsers(){
        if($this->method('GET')){
            $sql = "Select * FROM users";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
    /*public function __construct($request, $origin) {
        parent::__construct ( $request );
        if ($this->verb != '') {
            error_log("Checking token --> " . $this->verb);
            $this->oToken = UserTokensHandler::getByToken( $this->verb );
            if ($this->oToken != null) {
                $this->iCurrentUserId = $this->oToken->getUserId();
                error_log("Token is valid!!! -> UserId is " . $this->iCurrentUserId);
            }
        }
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Request-Headers: X-Requested-With, accept, content-type");
        header("Access-Control-Allow-Headers:Content-Type, Accept, Authorization, X-Requested-With");
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header("Content-Type: application/json");
    }*/
}
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


