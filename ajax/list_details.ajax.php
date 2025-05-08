<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données

$response = ["lignes" => '', "message" => ""];

if (isset($_POST['idBesoin']) && !empty($_POST['idBesoin'])) {
    $idBesoin = mysqli_real_escape_string($conn, $_POST['idBesoin']);
    $sql_select = "SELECT * FROM details WHERE idbesoin = '$idBesoin'";
    $result = mysqli_query($conn, $sql_select);

    if ($result) {
        $lignes = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $lignes .= "<tr>
                            <td><input name='produits-checked' type='checkbox' value='" . $row['id'] . "'/></td>
                            <td>" . htmlspecialchars($row['fournisseur']) . "</td>
                            <td>" . htmlspecialchars($row['categorie']) . "</td>
                            <td>" . htmlspecialchars($row['sous_categorie']) . "</td>
                            <td>" . htmlspecialchars($row['qualite']) . "</td>
                            <td>" . htmlspecialchars($row['longueur']) . "</td>
                            <td>" . htmlspecialchars($row['largeur']) . "</td>
                            <td>" . htmlspecialchars($row['epaisseur']) . "</td>
                            <td>" . htmlspecialchars($row['unite']) . "</td>
                            <td class='tableau-qte'>" . htmlspecialchars($row['quantite']) . "</td>
                            <td class='tableau-designation'>" . htmlspecialchars($row['designation']) . "</td>
                            <td>
                                <a href='#' class='edit-btn' data-id='" . $row['id'] . "'>
                                    <img src='../images/crayon.png' height='20px' width='20px' alt='edit'>
                                </a>
                            </td>
                            <td>
                                <a href='#' class='delete-btn' data-id='" . $row['id'] . "'>
                                    <img src='../images/corbeille.png' height='20px' width='20px' alt='delete'>
                                </a>
                            </td>
                        </tr>";
        }
        $response["lignes"] = $lignes;
        $response["message"] = "Données récupérées avec succès.";
    } else {
        $response["message"] = "Erreur lors de la récupération des données : " . mysqli_error($conn);
    }
} else {
    $response["message"] = "L'ID du besoin est manquant.";
}

echo json_encode($response);
?>