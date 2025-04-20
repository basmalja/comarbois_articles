<?php
include '../connexion/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Cas : Ajout d'un produit (avec ou sans infos de demande)
    if (isset($_POST['produit'])) {
        $produit = $_POST['produit'] ?? '';
        $unite = $_POST['unite'] ?? '';
        $quantite = $_POST['quantite'] ?? '';
        $idDemande = $_POST['idDemande'] ?? '';
        $idbesoin = $_POST['idbesoin'] ?? '';
        $date = $_POST['date'] ?? '';
       
        // Vérifier si unité manquante avec quantité
        if (empty($unite) && !empty($quantite)) {
            echo json_encode(["status" => "error", "message" => "Veuillez définir l'unité"]);
            exit;
        }

        // Vérifier les champs obligatoires pour une demande
        if (empty($idDemande) || empty($idbesoin) || empty($date)) {
            echo json_encode(["status" => "error", "message" => "Champs obligatoires manquants pour la demande"]);
            exit;
        }

        // Requête d'insertion
        $sql = "INSERT INTO demande_produit (produit, unite, quantite, idDemande, idbesoin, date) 
                VALUES ('$produit', '$unite', '$quantite', '$idDemande', '$idbesoin', '$date')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            echo json_encode([
                "status" => "success",
                "message" => "Produit ajouté avec succès",
                "insert_id" => $last_id
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Erreur: " . mysqli_error($conn)
            ]);
        }
        mysqli_close($conn);
        exit;
    }

    // Cas : juste une demande principale (sans produit)
    if (isset($_POST['idDemande']) && isset($_POST['idbesoin']) && isset($_POST['date'])) {
        $idDemande = $_POST['idDemande'];
        $idbesoin = $_POST['idbesoin'];
        $date = $_POST['date'];

        $sql = "INSERT INTO demande_produit (idDemande, idbesoin, date) 
                VALUES ('$idDemande', '$idbesoin', '$date')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            echo json_encode([
                "status" => "success",
                "message" => "Demande ajoutée avec succès",
                "insert_id" => $last_id
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Erreur: " . mysqli_error($conn)
            ]);
        }
        mysqli_close($conn);
        exit;
    }

    // Cas non reconnu
    echo json_encode(["status" => "error", "message" => "Données POST insuffisantes"]);
} else {
    echo json_encode(["status" => "error", "message" => "Requête invalide"]);
}
?>
