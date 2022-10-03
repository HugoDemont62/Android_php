<?php
session_start();

try {
    $pdo = new PDO('mysql:host=host;port=port;dbname=dbname', 'login', 'mdp');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
    echo "Erreur : ".$e->getMessage()."<br />";
}