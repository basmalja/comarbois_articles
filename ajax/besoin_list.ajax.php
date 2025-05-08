<?php
include '../connexion/db.php';
extract($_POST);
$lignes = '';

$chaine = '';
if ($idBesoin) $chaine .= "AND idBesoin='$idBesoin'";
if ($origine) $chaine .= "AND origine='$origine'";
if ($client) $chaine .= "AND client='$client'";
if ($date_debut) $chaine .= "AND date >= '$date_debut'";
if ($date_fin) $chaine .= "AND date <= '$date_fin'";
if ($status) $chaine .= "AND status='$status'";
if ($objet) $chaine .= "AND objet LIKE '%$objet%'";

$sql_select = "SELECT * FROM besoin WHERE 1 $chaine";
$result = mysqli_query($conn, $sql_select);

while ($row = mysqli_fetch_assoc($result)) {
    $lignes .= "<tr>
        <td>{$row['idBesoin']}</td>
        <td>{$row['date']}</td>
        <td>{$row['origine']}</td>
        <td>{$row['client']}</td>
        <td>{$row['objet']}</td>
        <td>{$row['status']}</td>
        <td>
            <a href='../pages/details_list.php?idModif={$row['idBesoin']}&disabled=1' class='consulter-btn'>
                <img src='../images/crayon.png' height='20px' width='20px' alt='Edit'>
            </a>
        </td>
    </tr>";
}

// If no results, show message row
if (empty($lignes)) {
    $lignes = "<tr><td colspan='7' style='text-align:center; color: red; font-weight: bold;'>Aucun résultat trouvé.</td></tr>";
}

echo json_encode(["lignes" => $lignes]);
