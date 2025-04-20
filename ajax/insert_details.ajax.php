<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $idbesoin = $_POST['idbesoin'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $fournisseur = $_POST['fournisseur'] ?? '';
    $categorie = $_POST['categorie'] ?? '';
    $sous_categorie = $_POST['sous_categorie'] ?? '';
    $qualite = $_POST['qualite'] ?? '';
    $largeur = $_POST['largeur'] ?? '';
    $longueur = $_POST['longueur'] ?? '';
    $epaisseur = $_POST['epaisseur'] ?? '';
    $unite = $_POST['unite'] ?? '';
    $quantite = $_POST['quantite'] ?? '';

    // Préparer la requête SQL pour éviter les injections SQL
    $sql = "INSERT INTO details (idbesoin, designation, fournisseur, categorie, sous_categorie, qualite, largeur, longueur, epaisseur, unite, quantite) 
        VALUES ('$idbesoin', '$designation', '$fournisseur', '$categorie', '$sous_categorie', '$qualite', '$largeur', '$longueur', '$epaisseur', '$unite', '$quantite')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn); // Récupérer l'ID inséré
        echo json_encode(["status" => "success", "message" => "Insertion réussie", "idbesoin" => $last_id]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erreur : " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Requête invalide"]);
}

?>