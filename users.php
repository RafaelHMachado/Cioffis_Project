<?php

//Config
require_once("inc/config.inc.php");

//Entities
require_once("inc/Entities/Employee.class.php");

//Utility Classes
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/RestClient.class.php");
include_once("inc/Utility/EmployeeMapper.class.php");
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
            // RestClient::call("DELETE", array('empid' => $_GET['empid']));
            EmployeeMapper::initialize('Employee');
            EmployeeMapper::deleteUser($_GET["empid"]);
            header('Location: users.php');
        }
    }
}

//Process any post data
if (!empty($_POST)) {
    if(isset($_POST["empid"])){
        RestClient::call("PUT", $_POST);
    } else {
        RestClient::call("POST", $_POST);
    }
}

if(!empty($_GET)){
    if(isset($_GET["action"])){
        if($_GET["action"] == "edit"){
            // Get user information
            $result = RestClient::call("GET", array('user' => $_GET["empid"]));

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

            Page::$title = "User Edit";
            Page::$menu = true;
            Page::header();
            Page::editUser($users);
        } else if($_GET["action"] == "newUser") {
            Page::$title = "New User";
            Page::$menu = true;
            Page::header();
            Page::newUser();
        }
    }
} else {
    // Get user information
    $result = RestClient::call("GET", array());

    // De-serialize the result of the Rest Call
    $juser = json_decode($result);

    // Store them in a new array as proper "User" objects
    $users = array();

    foreach ($juser as $u) {
        // Assemble a new book class
        $nu = new Employee();
        $nu->setEmpID($u->EmpID);
        $nu->setName($u->Name);
        $nu->setPhone($u->Phone);
        $nu->setEmail($u->Email);
        $nu->setUser($u->User);
        $nu->setPass($u->Pass);
        $nu->setPosition($u->Position);

        $users[] = $nu;
    }
    Page::$title = "Users List";
    Page::$menu = true;
    Page::header();
    Page::listUser($users);
}

Page::footer();