<?php

require_once __DIR__ . '/../backend/config/Database.php';
$database = new Database();
$db = $database->getConnection();
if($db) {
    echo "SUCCES : Connexion à la base de données 'my_cinema' reussie.";
} else {
    echo "ECHEC : Impossible de se connecter à la base de données 'my_cinema'.";
}   