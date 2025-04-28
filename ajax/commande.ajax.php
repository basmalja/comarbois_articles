<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données

$lignes = '';

$sql_select = "SELECT produit ,unite ,quantite  FROM  demande_produit where idDemande='" . $_POST['idDemande'] . "' ";


$result = mysqli_query($conn, $sql_select);
while ($row = mysqli_fetch_assoc($result)) {
    $quantite = htmlspecialchars($row['quantite']);
    $produit = htmlspecialchars($row['produit']);
    $unite = htmlspecialchars($row['unite']);
   
   
    $lignes .= "<tr>
                  <td><input type='checkbox' value=''</td>
                  <td>$produit</td>
                  <td>$unite</td>
                  <td><input type='text' value='$quantite' /></td>
                  <td><input type='text' value='' /></td>
                  
                </tr>";
  }


echo json_encode(value: ["lignes" => $lignes, "message" => "kkkkkk"]);



?>