<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données

// Vérifier si la requête est bien en POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $idbesoin = $_POST['idbesoin'] ?? '';
    $date = $_POST['date'] ?? '';
    $origine = $_POST['origine'] ?? '';
    $client = $_POST['client'] ?? '';
    $objet = $_POST['objet'] ?? ''; 
    $status = $_POST['status'] ?? ''; 


    // Préparer la requête SQL pour éviter les injections SQL
    $sql = "INSERT INTO besoin (idbesoin, date, origine, client , objet , status) VALUES ('$idbesoin', '$date', '$origine', '$client','$objet' , '$status')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn); // Récupérer l'ID inséré
        echo json_encode(["status" => "success", "idModif" => $last_id, "message" => "Insertion réussie", "idbesoin" => $last_id]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erreur : " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Requête invalide"]);
}
?>