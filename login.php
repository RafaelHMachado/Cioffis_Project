<?php

// Config
include_once("inc/config.inc.php");

// Entities
include_once("inc/Entities/Employee.class.php");

// Utilities
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/LoginManager.class.php");
include_once("inc/Utility/EmployeeMapper.class.php");
include_once("inc/Utility/Page.class.php");

//If they not continue
//$session = session_start();

if(isset($_GET["logout"])) {
    if($_GET["logout"] == "true") {
        unset($_SESSION);
        session_destroy();
        header('Location: login.php');
    }
}

if(!empty($_SESSION['loggedin'])) {
    header('Location: index.php');
}

$err = false;

if (!empty($_POST) )  {

    //Initialize the user mapper
    EmployeeMapper::initialize('employee');

    //Check the validation

    
    //Get the user by username (because thats all we have in the form)
    $user = EmployeeMapper::getUserbyName($_POST["user"]);

    //Check the mapper returned an object and the object is a user (in case the username is invalid)
    if (!empty($user)) {
        //Verify that users password against the password in the form
        $pass = $user->verifyPassword($_POST["pass"]);
        //If true log them in by starting a session and forwarding them to the main page
        if ($pass) {
            //session_start();
            //Set the logged in to true
            $_SESSION['loggedin'] = $user;
            //Send the user to the user managment page
            //$location = 'Location: index.php?empid=' . $user->getEmpID();
            header('Location: index.php');
        } else {
            $err = true;
        }
    }
}

Page::$title = "Login";
Page::header();
Page::showLoginForm($err);
Page::footer();
?>