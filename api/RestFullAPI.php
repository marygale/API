<?php
echo 'test';
include_once('../config.php');

require_once 'utils/API.php';
error_reporting(E_ALL ^ E_STRICT);

class RestFullAPI extends API{

    protected $oToken         = null;
    protected $iCurrentUserId = 0;

    const TTT_VERSION = 'v1';

    public function __construct($request, $origin) {
        parent::__construct ( $request );
        echo 'galecons';

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Request-Headers: X-Requested-With, accept, content-type");
        header("Access-Control-Allow-Headers:Content-Type, Accept, Authorization, X-Requested-With");
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header("Content-Type: application/json");

    }
}

if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new RestFullAPI ($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}




