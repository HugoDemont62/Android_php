<?php
session_start();

try {
    $pdo = new PDO('mysql:host=hugodey62.mysql.db;port=port;dbname=hugodey62', 'hugodey62', 'Camille6262');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
    echo "Erreur : ".$e->getMessage()."<br />";
}