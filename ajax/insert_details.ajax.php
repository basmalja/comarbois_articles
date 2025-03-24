<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comarbois_articles";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$fournisseur = $_POST['fournisseur'];
$categorie = $_POST['categorie'];
$sous_categorie = $_POST['sous_categorie'];
$qualite = $_POST['qualite'];
$longueur = $_POST['longueur'];
$largeur = $_POST['largeur'];
$epaisseur = $_POST['epaisseur'];
$unite = $_POST['unite'];
$quantite = $_POST['quantite'];
$designation = $_POST['designation'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO details (fournisseur, categorie, sous_categorie, qualite, longueur, largeur, epaisseur, unite, quantite, designation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $fournisseur, $categorie, $sous_categorie, $qualite, $longueur, $largeur, $epaisseur, $unite, $quantite, $designation);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>