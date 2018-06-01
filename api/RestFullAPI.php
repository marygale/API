<?php
include_once('../config.php');

require_once '../utils/API.php';
require_once 'Message.php';
error_reporting(E_ALL ^ E_STRICT);


class RestFullAPI extends API{

    protected $oToken         = null;
    protected $iCurrentUserId = 0;
    protected $con = null;

    const TTT_VERSION = 'v1';

    public function __construct($request, $origin) {
        parent::__construct ( $request );


        if ($this->verb != '') {
            error_log("Checking token --> " . $this->verb);
            $this->oToken = 'ADHLLKLBLLLNLKNHOYOWQOJHRWOPU)@%)@(*%)POJGSDLKLKSDLGHDSLGHSLDHGOSg';
            if ($this->oToken != null) {
                $this->iCurrentUserId = 1;
                error_log("Token is valid!!! -> UserId is 1");
            }
        }
        try{
            $this->con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }catch (PDOException $e) {
            print_r($stmt->errorInfo());
            print_r('<script>alert("Error '.$stmt->errorCode().' has occurred. Please contact support@gale.com and try again later.")</script>');
        }

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Request-Headers: X-Requested-With, accept, content-type");
        header("Access-Control-Allow-Headers:Content-Type, Accept, Authorization, X-Requested-With");
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header("Content-Type: application/json");

    }

    protected function postRegister(){
        if($this->method('POST')){
            $aResult = ['status' => 'failed'];
            $fname = isset($_POST['first_name']) ? $_POST['first_name'] : "";
            $lname = isset($_POST['last_name']) ? $_POST['last_name'] : "";
            $email = isset($_POST['email_address']) ? $_POST['email_address'] : "";
            $address = isset($_POST['address']) ? $_POST['address'] : "";
            $password = isset($_POST['password']) ? md5(htmlentities($_POST['password'])) : "";
            $sql = "INSERT into users (first_name,last_name,address,email_address, password) VALUES (:Sfname, :Slname, :Saddress, :Semail, :Spass)";
            $stmt = $this->con->prepare( $sql );
            $stmt->bindParam(':Sfname', $fname, PDO::PARAM_STR);
            $stmt->bindParam(':Slname', $lname, PDO::PARAM_STR);
            $stmt->bindParam(':Saddress', $address, PDO::PARAM_STR);
            $stmt->bindParam(':Semail', $email, PDO::PARAM_STR);
            $stmt->bindParam(':Spass', $password, PDO::PARAM_STR);
            $bSave = $stmt->execute() > 0 ? TRUE : FALSE;
            if($bSave){
                $aResult['status'] = 'ok';
                $aResult['msg'] = 'New record added';
            }

            return $aResult;
        }
    }

    /*https://mgsurvey.herokuapp.com/api/getUsers/*/
    protected function getUsers(){
        if($this->method('GET')){
            $sql = "Select * FROM users";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    protected function getSurveyList(){
        if($this->method('GET')){
            $sql = "Select * FROM surveys";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
    protected function getAllQuestionsWithDimension(){
        if($this->method('GET')){
            $sql = "SELECT dimension.name as dimension_name, dimension.id as dimension_id, questions.* FROM dimension, questions WHERE dimension.id = questions.dimension;";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
    protected function getQuestionsWithDimension(){
        if($this->method('POST')){
            $selected_dimen = [1,3, 4];
            $sql = "SELECT dimension.name as dimension_name, dimension.id as dimension_id, questions.* FROM dimension, questions WHERE dimension.id = questions.dimension AND dimension.id IN(".$selected_dimen.");";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    /** PASS PARAM is SURVEY_ID */
    protected function getQuestionsBySurvey(){
        if($this->method('POST')){
            $id = isset($_POST['survey_id']) ? $_POST['survey_id'] : 0;
            $id = str_replace("\"", "", $id);
            $sql = "Select dimension_id FROM survey_dimension WHERE survey_id = $id";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $dimensions = $query->fetchAll(PDO::FETCH_COLUMN);
            return $this->getQuestionsByDimension($dimensions, $id);

        }
    }
    public function getQuestionsByDimension($dimensions, $id){
        $dim = implode("','",$dimensions);
        $dim = str_replace("'", "", $dim);
        $sql = "SELECT surveys.id as survey_id, dimension.name as dimension_name, dimension.id as dimension_id, questions.* FROM surveys, dimension, questions WHERE dimension.id = questions.dimension AND dimension.id IN(".$dim.") AND surveys.id = $id;";
        /*$sql = "SELECT dimension.name as dimension_name, dimension.id as dimension_id, questions.* FROM dimension, questions WHERE dimension.id = questions.dimension AND dimension.id IN(".$dim.") questions.dimension IN(".$dim.");";*/
        $query = $this->con->prepare( $sql );
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    protected function getDimensions(){
        if($this->method('GET')){
            $sql = "Select * FROM dimension";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    protected function postSurvey(){
        if($this->method("POST")){
            $survey_id = "";
            $aResult = ['survey_id' => 0];
            $name = isset($_POST['name']) ? $_POST['name'] : "";
            $description = isset($_POST['description']) ? $_POST['description'] : "";
            $password = isset($_POST['password']) ? $_POST['password'] : "";
            $emailOn = isset($_POST['emailOn']) ? $_POST['emailOn'] : "";
            $emailOff = isset($_POST['emailOff']) ? $_POST['emailOff'] : "";
            $verification = ($emailOn) ? 1 : 0;
            $user = isset($_POST['user_id']) ? $_POST['user_id'] : 1;
            $sql = "INSERT into surveys (name, description, password, email_verification_on, user_id, created, modified) VALUES (:Sname, :Sdesc, :Spass, :Ion, :Iid, NOW(), NOW())";
            $stmt = $this->con->prepare( $sql );
            $stmt->bindParam(':Sname', $name, PDO::PARAM_STR);
            $stmt->bindParam(':Sdesc', $description, PDO::PARAM_STR);
            $stmt->bindParam(':Spass', $password, PDO::PARAM_STR);
            $stmt->bindParam(':Ion', $verification, PDO::PARAM_INT);
            $stmt->bindParam(':Iid', $user, PDO::PARAM_INT);
            $bSave = $stmt->execute() > 0 ? TRUE : FALSE;
            if($bSave){
               $survey_id = $this->con->lastInsertId();
               $dimensions = isset($_POST['dimensions']) ? $_POST['dimensions'] : [];
               $dim_id = "";
               foreach ($dimensions as $dim){
                   if($dim == "Leadership") $dim_id = 1;
                   if($dim == "Relationship") $dim_id = 2;
                   if($dim == "Management") $dim_id = 3;
                   if($dim == "Vision") $dim_id = 4;
                   if($dim == "Knowledge") $dim_id = 5;
                   /*$sql = "INSERT into survey_dimension (name, survey_id, dimension_id) VALUES (?, ?, ?);";*/
                   $sql = "INSERT into survey_dimension (name, survey_id, dimension_id) VALUES ('$dim', $survey_id, $dim_id);";
                   $stmt = $this->con->prepare( $sql );
                   /*$stmt->bind_param("sii", $dim, $survey_id, $dim_id);*/
                   $stmt->execute();
               }
                $groups = isset($_POST['groups']) ? $_POST['groups'] : [];
                foreach ($groups as $group){
                    if($group == "Teachers") $group_id = 1;
                    if($group == "Support Staff") $group_id = 2;
                    if($group == "Building and District Admin") $group_id = 3;
                    if($group == "Parent") $group_id = 4;
                    $sql_grp = "INSERT into survey_groups (survey_id, name, group_id) VALUES ($survey_id, '$group', $group_id);";
                    $stmt = $this->con->prepare( $sql_grp );
                    /*$stmt->bind_param("is", $survey_id, $group);*/
                    $stmt->execute();
                }
                $aResult['survey_id'] = $survey_id;
            }
            /*return $aResult;*/
            return $survey_id;

        }
    }

    protected function getSurveyById(){
        if($this->method('GET')){ return var_dump($_GET);
            $id = isset($_GET["survey_id"]) ? $_GET["survey_id"] : "";
            $sql = "Select * FROM surveys WHERE id = $id";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }else{
            $m = new MessageRestFull(array(), MessageRestFull::TYPE_ERROR, 'Only accepts POST request', 'Only accepts POST request');
            return $m->toArray();
        }
    }

    protected function updateSurveyStatus(){
        if($this->method('POST')){
            $id = isset($_POST["survey_id"]) ? $_POST["survey_id"] : "";
            $sql = "Select status FROM surveys WHERE id = $id";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $status = $query->fetchColumn();
            $update = ($status == 0) ? "UPDATE surveys set status = 1 WHERE id = $id" : "UPDATE surveys set status = 0 WHERE id = $id";
            $queryUpdate = $this->con->prepare( $update );
            $queryUpdate->execute();
            $queryUpdate->fetchAll(PDO::FETCH_ASSOC);
            $getAllQry = $this->con->prepare( "Select * FROM surveys WHERE id = $id" );
            $getAllQry->execute();
            return $getAllQry->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $m = new MessageRestFull(array(), MessageRestFull::TYPE_ERROR, 'Only accepts POST request', 'Only accepts POST request');
            return $m->toArray();
        }
    }

    protected function postSurveyQuestions(){
        if($this->method('POST')){
            $bResult = false;
            $aRequest = isset($_POST['questions']) ? $_POST['questions'] : [];
            foreach ($aRequest as $rq){
                $data = str_replace("{", "", $rq);
                $data = str_replace("}", "", $data);
                $data = str_replace("surveyId=", "", $data);
                $data = str_replace(", name=", ":", $data);
                $data = str_replace(", id=", ":", $data);
                $arData = explode(":", $data);
                $surveyId = isset($arData[0]) ? $arData[0] : null;
                $qId = isset($arData[2]) ? $arData[2] : null;
                $name = isset($arData[1]) ? $arData[1] : "";
                $sql = "INSERT INTO survey_questions (survey_id, question_id, name) VALUES ($surveyId, $qId, '$name');";
                $stmt = $this->con->prepare( $sql);
                $bResult = $stmt->execute();
            }
            return $bResult;
       }
    }

    protected function postLogin(){
        if($this->method('POST')){
            $aResult['status'] = 'failed';
            $email = isset($_POST['email']) ? $_POST['email'] : "";
            $pass = isset($_POST['password']) ? $_POST['password'] : "";
            $hashPass = md5(htmlentities($pass));
            $sql = "Select roles.name as role_name, users.* FROM roles, users WHERE users.email_address = '$email' AND users.password = '$hashPass' AND users.role_id = roles.role_id;";
            $query = $this->con->prepare( $sql );
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            if(count($results) > 0){
                $aResult['status'] = 'ok';
                $aResult['result'] = $results;
            }
            $aResult['sql'] = $sql;
            return $aResult;//4b42201ceb7acca0295fdb0d8b7cac8a -gale
        }
    }//d41d8cd98f00b204e9800998ecf8427e gale

    protected function getHash(){
        if($this->method('GET')){
            $pass = isset($_POST['password']) ? $_POST['password'] : "";
            /*$salt = 'XyZzy12*_';*/
            return md5(htmlentities($pass));
            /*return hash('md5',$salt . htmlentities($pass));*/
        }
    }
    protected function test(){
        return 'gale test';
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




///https://www.javacodegeeks.com/2013/10/android-json-tutorial-create-and-parse-json-data.html