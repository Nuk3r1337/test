<?php
require_once $_SERVER["DOCUMENT_ROOT"] ."/skomager_john/classes/database.php";


class Authentication
{

    public function login($username, $password){

        $database = new Database();

        $user = $database->query("SELECT id, username, password FROM users WHERE username = :username", ['username' => $username])->fetchAssoc();

        if(!isset($user) || empty($user)){
            return "Brugernavn eller kodeord er forkert.";
        }

        $user = $user[0];

        if(!password_verify($password, $user["password"])){
            return "Brugernavn eller kodeord er forkert.";
        }

        // $_SESSION["test"] = true;

        $_SESSION["USER_ID"] = $user["id"];
        $_SESSION["USERNAME"] = $user["username"];
        $_SESSION["LOGIN_STATUS"] = true;

        return true;
    }
}
