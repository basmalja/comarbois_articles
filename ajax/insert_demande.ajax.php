<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données

// Vérifier si la requête est bien en POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $idDemande = $_POST['idDemande'] ?? '';
    $date = $_POST['date'] ?? '';
    $origine = $_POST['origine'] ?? '';
    $client = $_POST['client'] ?? '';
    

    // Préparer la requête SQL pour éviter les injections SQL
    $sql = "INSERT INTO demande_achat (idDemande, date, origine, client ) VALUES ('$idDemande', '$date', '$origine', '$client')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn); // Récupérer l'ID inséré
        echo json_encode(["status" => "success", "idDemande" => $last_id, "message" => "Insertion réussie", ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erreur : " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Requête invalide"]);
}
?>