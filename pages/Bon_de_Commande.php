<?php
require_once('../connexion/db.php'); // Connexion à ta base
require_once __DIR__ . '/../vendor/autoload.php'; // si vendor est dans le dossier racine




// 🔄 Récupérer l’ID de la demande (sécurisé)
$idDemande = isset($_POST['idDemande']) ? mysqli_real_escape_string($conn, $_POST['idDemande']) : null;

// ⚙️ Données client simulées (tu peux les récupérer depuis la DB aussi)
$client = "Société Exemple";
$date = date("d/m/Y");

// 🔍 Requête pour les produits
$produits = [];
if ($idDemande) {
    $query = "SELECT produit, quantite, prix_unitaire FROM commande WHERE idDemande = '$idDemande'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $produits[] = $row;
    }
} else {
    die("❌ ID de demande manquant.");
}

// 💰 Calcul du total
$total_general = 0;
foreach ($produits as &$item) {
    $item["total"] = $item["quantite"] * $item["prix_unitaire"];
    $total_general += $item["total"];
}

// 📝 Création PDF
$pdf = new TCPDF();
$pdf->AddPage();

$html = "
<h1 style='text-align:center;'>Bon de Commande</h1>
<p><strong>Date:</strong> {$date}</p>
<p><strong>Client:</strong> {$client}</p>
<br>
<table border='1' cellpadding='5'>
  <thead>
    <tr style='background-color:#f0f0f0;'>
      <th>Produit</th>
      <th>Quantité</th>
      <th>Prix Unitaire</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>";

foreach ($produits as $item) {
    $html .= "
    <tr>
      <td>{$item['produit']}</td>
      <td>{$item['quantite']}</td>
      <td>{$item['prix_unitaire']} MAD</td>
      <td>{$item['total']} MAD</td>
    </tr>";
}

$html .= "
  </tbody>
</table>
<br>
<p><strong>Total Général:</strong> {$total_general} MAD</p>
";

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output("bon_commande.pdf", "D"); // D => téléchargement direct
