<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données
extract($_POST);
$lignes = '';
$sql_select = "SELECT id_demande_produit, produit ,unite ,quantite  FROM  demande_produit where idDemande='" . $idDemande . "' ";


$result = mysqli_query($conn, $sql_select);
while ($row = mysqli_fetch_assoc($result)) {
  $id_demande_produit= htmlspecialchars($row['id_demande_produit']);
    $quantite = htmlspecialchars($row['quantite']);
    $produit = htmlspecialchars($row['produit']);
    $unite = htmlspecialchars($row['unite']);
   
   
    $lignes .= "<tr>
                  <td><input name='produits-checked'  type='checkbox' value='".$id_demande_produit."'/></td>
                  <td>$produit</td>
                  <td>$unite</td>
                  <td id='tdQte'><input  id='Uquantite' type='text' value='$quantite' /></td>
                  <td id='tdPrix'><input  id='Uprix' type='text' value='' /></td>
                  
                </tr>";
  }


echo json_encode(value: ["lignes" => $lignes, "message" => "kkkkkk"]);



?>