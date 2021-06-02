
<?php

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

class Employee  {

    private $EmpID;
    private $Name;
    private $Phone;
    private $Email;
    private $User;
    private $Pass;
    private $Position;
    private $Active;

    //Getters
    function getEmpID() : int     {
        return $this->EmpID;
    }

    function getName() : string   {
        return $this->Name;
    }

    function getPhone() : string {
        return $this->Phone;
    }

    function getEmail() : string {
        return $this->Email;
    }

    function getUser() : string {
        return $this->User;
    }

    function getPass() : string {
        return $this->Pass;
    }

    function getPosition() : string {
        return $this->Position;
    }

    function getActive() : int     {
        return $this->Active;
    }

    //Setters
    function setEmpID(int $newEmpID)  {
        $this->EmpID = $newEmpID;
    }

    function setName(string $newName)   {
        $this->Name = $newName;
    }

    function setPhone(string $newPhone) {
        $this->Phone = $newPhone;
    }

    function setEmail(string $newEmail)   {
        $this->Email = $newEmail;
    }

    function setUser(string $newUser)   {
        $this->User = $newUser;
    }

    function setPass(string $newPass) {
        //Hash password
        $hash = password_hash($newPass, PASSWORD_DEFAULT);
        //Write the password
        $this->Pass = $hash;
    }

    function setPosition(string $newPosition)   {
        $this->Position = $newPosition;
    }

    function setActive(int $newActive)  {
        $this->Active = $newActive;
    }

    //Verify password
    public function verifyPassword($verifyPassword) : bool {
        //check password_verify
        return password_verify($verifyPassword, $this->Pass);
    }

    // Function addition serialize 
    function jsonSerialize() {
        // $vars = get_object_vars($this);
        // return $vars;

        // Make a standard class
        $obj = new StdClass;
        $obj->EmpID = $this->getEmpID();
        $obj->Name = $this->getName();
        $obj->Phone = $this->getPhone();
        $obj->Email = $this->getEmail();
        $obj->User = $this->getUser();
        $obj->Pass = $this->getPass();
        $obj->Position = $this->getPosition();
        $obj->Active = $this->getActive();

        // Return the standard class
        return $obj;
    }
}

?>