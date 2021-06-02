<?php
class LoginManager  {
    static function verifyLogin()   {
        session_start();
        $session = $_SESSION['loggedin'];
        if (empty($session)) {
            unset($_SESSION);
            session_destroy();
            header('Location: login.php');
            return false;
        } else {
            return true;
        }
    }
}

?>