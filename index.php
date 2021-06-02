<?php

//Config
require_once("inc/config.inc.php");

//Entities
require_once("inc/Entities/Employee.class.php");

//Utility Classes
require_once("inc/Utility/RestClient.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Page.class.php");

LoginManager::verifyLogin();

if(isset($_SESSION["loggedin"])) {
    /*if(!empty($_POST)){
        $user = $_POST['userName'];
        $pass = $_POST['pass'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $cNum = $_POST['cNum'];
        $gender = $_POST['gender'];
        $date = date('Y-m-d');
        $updateData = [$fName, $lName, $phone, $email, $cNum, $gender, $date, $user, $pass];
        $query = query('updateUser', $updateData, $_SESSION["userID"]);
        $crud->execute($query);
    }*/
} else {
    unset($_SESSION);
    session_destroy();
    header('Location: login.php');
}

if (!empty($_GET))  {
    if(isset($_GET["action"])){
        if ($_GET["action"] == "delete")    {
            // Make a REST call out to the WS
            // RestClient::call("DELETE", array('isbn' => $_GET['isbn']));
        }
    }
}

//Process any post data
if (!empty($_POST)) {
    // RestClient::call("POST", $_POST);
}

/*

// Get user information
$result = RestClient::call("GET", array('user' => $_SESSION["loggedin"]->getEmpID()));

// De-serialize the result of the Rest Call
$juser = json_decode($result);

// Store them in a new array as proper "User" objects
$users = array();

$nu = new Employee();
$nu->setEmpID($juser->EmpID);
$nu->setName($juser->Name);
$nu->setPhone($juser->Phone);
$nu->setEmail($juser->Email);
$nu->setUser($juser->User);
$nu->setPass($juser->Pass);
$nu->setPosition($juser->Position);

$users[] = $nu;

*/

Page::$title = "Home";
Page::$menu = true;
Page::header();
Page::homepage();
//Page::listUser($users);
Page::footer();

?>