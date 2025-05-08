<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $idDemande = $_POST['idDemande'] ?? '';
  
    $produit = $_POST['produit'] ??'';
    $unite = $_POST['unite'] ?? '';
    $quantite = $_POST['quantite'] ?? '';

    // Préparer la requête SQL pour éviter les injections SQL
    $sql = "INSERT INTO demande_produit (idDemande, produit,  unite, quantite) 
        VALUES ('$idDemande', '$produit',  '$unite', '$quantite')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn); // Récupérer l'ID inséré
        echo json_encode(["status" => "success", "message" => "Insertion réussie", "idDemande" => $last_id]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erreur : " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Requête invalide"]);
}

?>