<?php

class EmployeeMapper {

    //Place to store the PDO Agent
    private static $db;

    static function initialize(string $className)   {
        
        self::$db = new PDOAgent($className);

    }

    // mysql> desc employee;
    // +----------+--------------+------+-----+---------+----------------+
    // | Field    | Type         | Null | Key | Default | Extra          |
    // +----------+--------------+------+-----+---------+----------------+
    // | EmpID    | int(11)      | NO   | PRI | NULL    | auto_increment |
    // | Name     | varchar(50)  | NO   |     | NULL    |                |
    // | Phone    | varchar(50)  | NO   |     | NULL    |                |
    // | Email    | varchar(50)  | NO   |     | NULL    |                |
    // | User     | varchar(50)  | NO   |     | NULL    |                |
    // | Pass     | varchar(250) | NO   |     | NULL    |                |
    // | Position | varchar(50)  | NO   |     | NULL    |                |
    // +----------+--------------+------+-----+---------+----------------+
    // 7 rows in set (0.04 sec)
    

    static function createUser(Employee $newUser) : int   {
        $sqlInsert = "INSERT INTO employee (Name, Phone, Email, User, Pass, Position) 
                        VALUES (:name, :phone, :email, :user, :pass, :position)";

        self::$db->query($sqlInsert);

        self::$db->bind(':name', $newUser->getName());
        self::$db->bind(':phone', $newUser->getPhone());
        self::$db->bind(':email', $newUser->getEmail());
        self::$db->bind(':user', $newUser->getUser());
        self::$db->bind(':pass', $newUser->getPass());
        self::$db->bind(':position', $newUser->getPosition());

        self::$db->execute();

        return self::$db->lastInsertId();
    }

    static function editUser(Employee $newUser) : int   {
        $sqlInsert = "UPDATE employee SET Name = :name, Phone = :phone, Email = :email, Position = :position WHERE EmpID = :empid";

        var_dump($sqlInsert);
        self::$db->query($sqlInsert);

        self::$db->bind(':empid', $newUser->getEmpID());
        self::$db->bind(':name', $newUser->getName());
        self::$db->bind(':phone', $newUser->getPhone());
        self::$db->bind(':email', $newUser->getEmail());
        self::$db->bind(':position', $newUser->getPosition());

        self::$db->execute();

        return self::$db->lastInsertId();
    }

    static function getUsers() : Array {
        
        $selectAll = "SELECT * FROM employee WHERE Active = :active";

        self::$db->query($selectAll);
        self::$db->bind(':active', 1);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function getUserbyID(int $user) {
        
        $sqlSelect = "SELECT * FROM employee WHERE EmpID = :user";
        // Query
        self::$db->query($sqlSelect);
        // Bind
        self::$db->bind(':user', $user);
        // Execute
        self::$db->execute();
        // Get single result
        return self::$db->singleResult();
    }

    static function getUserbyName(string $user) {
        
        $sqlSelect = "SELECT * FROM employee WHERE User = :user";
        // Query
        self::$db->query($sqlSelect);
        // Bind
        self::$db->bind(':user', $user);
        // Execute
        self::$db->execute();
        // Get single result
        return self::$db->singleResult();
    }

    static function deleteUser(int $empid) : bool {
        $deleteSQLQuery = "UPDATE Employee SET Active = 0 WHERE EmpID = :empid";

        try {

            self::$db->query($deleteSQLQuery);
            self::$db->bind(':empid', $empid);
            self::$db->execute();

            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting user $empid");
            }
        } catch(Exception $ex) {
            echo $ex->getMessage();
            self::$db->debugDumpParams();
            return false;
            
        }

        return true;

    }

}

?>