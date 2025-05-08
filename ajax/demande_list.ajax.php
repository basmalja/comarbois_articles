<?php
include '../connexion/db.php'; // adapte le chemin si nécessaire

header('Content-Type: application/json');

// 1. Récupération sécurisée des filtres
$idDemande   = $_POST['idDemande'] ?? '';
$origine     = $_POST['origine'] ?? '';
$client      = $_POST['client'] ?? '';
$date_debut  = $_POST['date_debut'] ?? '';
$date_fin    = $_POST['date_fin'] ?? '';

// 2. Construction dynamique de la clause WHERE
$conditions = "WHERE 1=1";

if ($idDemande)  $conditions .= " AND idDemande = '" . mysqli_real_escape_string($conn, $idDemande) . "'";
if ($origine)    $conditions .= " AND origine = '" . mysqli_real_escape_string($conn, $origine) . "'";
if ($client)     $conditions .= " AND client = '" . mysqli_real_escape_string($conn, $client) . "'";
if ($date_debut) $conditions .= " AND date >= '" . mysqli_real_escape_string($conn, $date_debut) . "'";
if ($date_fin)   $conditions .= " AND date <= '" . mysqli_real_escape_string($conn, $date_fin) . "'";

// 3. Exécution de la requête
$sql = "SELECT * FROM demande_achat $conditions ORDER BY idDemande DESC";
$result = mysqli_query($conn, $sql);

// 4. Vérification d'erreur SQL
if (!$result) {
    echo json_encode(['lignes' => "<tr><td colspan='9' class='text-danger'>Erreur SQL: " . mysqli_error($conn) . "</td></tr>"]);
    exit;
}

// 5. Construction des lignes HTML
$lignes = "";

while ($row = mysqli_fetch_assoc($result)) {
    $lignes .= "<tr>";
    $lignes .= "<td>" . htmlspecialchars($row['idDemande']) . "</td>";
    $lignes .= "<td>" . htmlspecialchars($row['date']) . "</td>";
    $lignes .= "<td>" . htmlspecialchars($row['origine']) . "</td>";
    $lignes .= "<td>" . htmlspecialchars($row['client']) . "</td>";
    $lignes .= "<td>" . htmlspecialchars($row['objet']) . "</td>";
    $lignes .= "<td><a href='../pages/demande_produit.php?idDemande=" . htmlspecialchars($row['idDemande']) . 
               "&disabled=1' class='consulter-btn'>" .
               "<img src='../images/crayon.png' height='20px' width='20px' alt='Edit'></a></td>";
    $lignes .= "</tr>";
}

// 6. Envoi du résultat au client JS
echo json_encode(['lignes' => $lignes]);
exit;