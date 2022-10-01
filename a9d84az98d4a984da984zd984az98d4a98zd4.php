<?php
include "database.php";

$useremail = $_POST["useremail"];
$password = $_POST["password"];
$password = sha1($password);

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) and isset($_POST['password'])) {
        $email = $_POST['email'];
        $mdp = sha1($_POST['password']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM `user` WHERE email = :email AND mdp = :mdp";
            $query = $pdo->prepare($sql);
            $query->execute(array(
                "mdp" => $password,
                "email" => $useremail
            ));
            $line = $query->fetch();
            if ($line['login'] != null and $line['mdp'] != null and $line['email'] != null) {
                if ($query->rowCount() == 1) {
                    $response = array();
                    $response["success"] = $line;
                }
            } else {
                $response = array();
                $response["success"] = "Retry you don't have an account with this information(s)";
            }
        } else {
            $response = array();
            $response["success"] = "Retry you don't have an account with this information(s)";
        }

    } else {
        $response = array();
        $response["success"] = "Retry you don't have an account with this information(s)";
    }
}






