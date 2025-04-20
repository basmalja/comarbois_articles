<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données

$lignes = '';

$sql_select = "SELECT * FROM details where idbesoin='" . $_POST['idBesoin'] . "' ";
$result = mysqli_query($conn, $sql_select);
while ($row = mysqli_fetch_assoc($result)) {
  $lignes .= "<tr >
               
                <td>{$row['fournisseur']}</td>
                <td>{$row['categorie']}</td>
                <td>{$row['sous_categorie']}</td>
                <td>{$row['qualite']}</td>
                <td>{$row['longueur']}</td>
                <td>{$row['largeur']}</td>
                <td>{$row['epaisseur']}</td>
                <td>{$row['unite']}</td>
                <td id='tableau-qte' >{$row['quantite']}</td>
                <td id='tableau-designation'>{$row['designation']}</td>
               
                <td>  
                   <a href='' class='edit-btn' data-id={$row['id']}>
                  <img src='../images/crayon.png' height='20px' width='20px' alt='edit'>
                  </a>
                </td>
                 <td>
                  <a href='' class='delete-btn' data-id={$row['id']}>
                  <img src='../images/corbeille.png' height='20px' width='20px' alt='delete'>
                  </a>
                </td> 
              </tr>";
}

echo json_encode(value: ["lignes" => $lignes, "message" => "kkkkkk"]);



?>