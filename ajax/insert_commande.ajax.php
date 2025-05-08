<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données
extract($_POST);
// Vérifier si la requête est bien en POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $idDemande = $_POST['idDemande'] ?? '';
    $idBesoin =$_POST['idBesoin'] ?? '';
   
    $produit = $_POST['produit'] ??'';
    $unite = $_POST['unite'] ?? '';
    $quantite = $_POST['quantite'] ?? '';
    $prix_unitaire = $_POST['prix_unitaire'] ?? '';

 foreach($produitsChecked as $prdt){
    $sql_select="SELECT * FROM commande WHERE id = '$prdt'";
    mysqli_query($conn, $sql_select);
    while ($row = mysqli_fetch_assoc($result)) {
        
    }
 }   
 // Préparer la requête SQL pour éviter les injections SQL
 $sql = "INSERT INTO commande (idDemande, idBesoin, produit, unite, quantite, prix_unitaire) 
        VALUES ('$idDemande', '$idBesoin', '$produit', '$unite', '$quantite', '$prix_unitaire')";
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