<?php
include '../connexion/db.php'; // Connexion à la BDD

$lignes = '';

$sql_select = "SELECT * FROM demande_produit WHERE idDemande = '" . $_POST['idDemande'] . "'";
$result = mysqli_query($conn, $sql_select);

while ($row = mysqli_fetch_assoc($result)) {
    $produit = htmlspecialchars($row['produit']); // Sécuriser
    $unite = htmlspecialchars($row['unite']); // Sécuriser
    $quantite = htmlspecialchars($row['quantite']); // Sécuriser
    
    // Préparer le menu déroulant avec les produits
    $selectProduit = "<select style='width:80%' name='produit' class='produit-select'>";
    $selectProduit .= "<option value=''></option>";

    $sql_nbre = "SELECT designation FROM produits";
    $res_prdt = mysqli_query($conn, $sql_nbre);

    while ($res = mysqli_fetch_object($res_prdt)) {
        $designation = htmlspecialchars($res->designation); // Sécuriser
        if ($produit == $designation) {
            $selected="selected";
        }else $selected="";
        $selectProduit .= "<option $selected value='$designation'>$designation</option>";
    }

    $selectProduit .= "</select>";
    
    // Préparer le menu déroulant pour unite avec options spécifiques
    $selectUnite = "<select style='width:80%' name='unite' class='unite-select'>";
    $selectUnite .= "<option value=''>&nbsp;</option>";
    
    // Options spécifiques pour unite
    $unites = [
        "" => "&nbsp;",
        "ML" => "ML",
        "M2" => " M2",
        "M3" => " M3",
        "Pièce" => "Pièce"
    ];
    //die($unite);
    foreach ($unites as $value => $label) {
        $selected = ($unite == $value) ? "selected" : "";
        $selectUnite .= "<option $selected value='$value'>$label</option>";
    }
    
    $selectUnite .= "</select>";
    
    // Champ de saisie pour quantité
    $inputQuantite = "<input type='number' name='quantite' class='quantite-input' style='width:80%' value='$quantite'>";

    // Construire les lignes du tableau
    $lignes .= "<tr>
        <td>" . htmlspecialchars($row['designation']) . "</td>
        <td>$selectProduit</td>
        <td>$selectUnite</td>
        <td>$inputQuantite</td>
        <td>
            <a href='#' class='edit-btn' data-id='{$row['id_demande_produit']}'>
                <img src='../images/save.png' height='20px' width='20px' alt='edit'>
            </a>
        </td>
        <td>
            <a href='#' class='delete-btn' data-id='{$row['id_demande_produit']}'>
                <img src='../images/corbeille.png' height='20px' width='20px' alt='delete'>
            </a>
        </td>
    </tr>";
}

echo json_encode([
    "lignes" => $lignes,
    "message" => "✅ Lignes générées avec succès"
]);
?>