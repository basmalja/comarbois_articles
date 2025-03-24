<?php

$host = 'localhost'; // Nom du serveur
$dbname = 'comarbois'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur
$password = ''; // Mot de passe (vide par défaut)

// Création de la connexion
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérifier la connexion
if (mysqli_connect_error()) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}
?>
