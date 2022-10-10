<?php
include "database.php";

if (isset($_POST['login'], $_POST['email'], $_POST['password'])) {
    $email = $_POST["useremail"];
    $login = $_POST["username"];
    $password = $_POST["password"];
    $hashPassword = sha1($password);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM `user` WHERE email = :email AND mdp = :mdp AND login = :login";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            "mdp" => $hashPassword,
            "email" => $email,
            "login" => $login
        ));
        $line = $query->fetch();
        if ($line['login'] == null and $line['email'] == null) {
            $sql = "INSERT INTO `user` (email,login,mdp)  VALUES (:email,:login,:mdp)";
            $query = $pdo->prepare($sql);
            $query->execute(array(
                ':login' => $login,
                ':email' => $email,
                ':mdp' => $hashPassword,
            ));
            $response = array();
            $response["success"] = $line;
            }
        }
    } else {
    $response = array();
    $response["success"] = "This information is incorrect";
}


echo json_encode($response);
