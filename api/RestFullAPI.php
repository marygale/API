<?php
include_once('../config.php');

require_once '../utils/API.php';
error_reporting(E_ALL ^ E_STRICT);


class RestFullAPI extends API{

    protected $oToken         = null;
    protected $iCurrentUserId = 0;
    protected $con = null;

    const TTT_VERSION = 'v1';

    public function __construct($request, $origin) {
        parent::__construct ( $request );

        $this->con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Request-Headers: X-Requested-With, accept, content-type");
        header("Access-Control-Allow-Headers:Content-Type, Accept, Authorization, X-Requested-With");
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header("Content-Type: application/json");

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

    protected function test(){
        if($this->method('POST')){
            $res = 'this is a test';
            return $res;
        }
    }

}


if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new RestFullAPI ($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {echo 'catch ';die;
    echo json_encode(array('error' => $e->getMessage()));
}




