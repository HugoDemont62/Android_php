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
            if ($query->rowCount() == 1) {

                $time = date('r');
                $to = "contact@hugodemont.fr";
                $subject = "Mail From website";
                $headers = "From: contact@hugodemont.fr" . "\r\n";

                if ($email != NULL) {
                    mail($to, $subject, "Le nouvel utilisateur  $login le\r$time\ravec le mail : $email\n\r\n\r\n", $headers);
                    mail($email . "\r\n", "Votre enregistrement à été effectué avec succes" . "\r\n", "Message envoyé sur le site hugodemont.fr à $time\r\nCe message est automatique ne pas répondre \n\r\n\r\n\r\n Vous vous êtes enregisté sur hugodemont.fr\n\r\n\r\n\r\nSi vous n'êtes pas à l'origine de ce message n'en prenez pas compte. \n\r Hugo Demont service de communnication de hugodemont.fr ", $headers);
                }
                header("Location:index.php");
            }
        }
    } else {
        echo '
                 <a href="html/regi.html">Retour à la page de connexion compte déjà enregistré ! </a>
            ';


    }
} else {
    echo '
                 <a href="html/regi.html">Retour a la page de connexion : Mail incorrect </a>
            ';
}


echo json_encode($response);
