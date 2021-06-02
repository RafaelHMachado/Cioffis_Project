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

Page::$title = "Customers";
Page::$menu = true;
Page::header();
Page::maintenance();
Page::footer();

?>