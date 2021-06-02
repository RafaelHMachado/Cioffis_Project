<?php

/*
Create - POST
Read - GET
Update - PUT
Delete - DELETE
*/

require_once("inc/config.inc.php");
require_once("inc/Entities/Employee.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/EmployeeMapper.class.php");

EmployeeMapper::initialize("Employee");

// Pull the request data from the input stream
parse_str(file_get_contents("php://input"), $requestData);

switch($_SERVER["REQUEST_METHOD"]) {
    // Its a GET request, time to read!
    case "GET":
        if (isset($requestData['user'])) {
        //if(isset($_SESSION["loggedin"])){
            $user = EmployeeMapper::getUserbyID($requestData['user']);
            
            $juser = $user->jsonSerialize();

            header('Content-Type: application/json');
            echo json_encode($juser);
        } else {
            // Get all the users
            $users = EmployeeMapper::getUsers();

            // Initialize an array to hold the serialized books
            $serializedUsers = array();

            // Go through all the books and add them to the serialized array
            foreach ($users as $user) {
                $serializedUsers[] = $user->jsonSerialize();
            }

            // Set the header
            header('Content-Type: application/json');

            // Return all the books
            echo json_encode($serializedUsers);
        }
        break;
    // Do the insert thing...
    case "POST":
        // New User
        $nu = new Employee();
        $nu->setName($requestData['name']);
        $nu->setPhone($requestData['phone']);
        $nu->setEmail($requestData['email']);
        $nu->setUser($requestData['user']);
        $nu->setPass($requestData['pass']);
        $nu->setPosition($requestData['position']);

        // Add user to DB
        $result = EmployeeMapper::createUser($nu);

        // Return result
        header('Content-Type: application/json');
        // Return the result
        echo json_encode($result);
        break;
    // Delete things...
    case "DELETE":
        $result = EmployeeMapper::deleteUser($requestData['empid']);

        header('Content-Type: application/json');
        echo json_encode($result);
        break;
    case "PUT":
        // New User
        $nu = new Employee();
        $nu->setEmpID($requestData['empid']);
        $nu->setName($requestData['name']);
        $nu->setPhone($requestData['phone']);
        $nu->setEmail($requestData['email']);
        $nu->setUser($requestData['user']);
        $nu->setPosition($requestData['position']);

        // Edit user on DB
        $result = EmployeeMapper::editUser($nu);

        // Return result
        header('Content-Type: application/json');
        // Return the result
        echo json_encode($result);
        break;
    // Default things to do...
    default:
        echo json_encode(array("message" => "Voce fala HTTP?"));
        break;
}

?>