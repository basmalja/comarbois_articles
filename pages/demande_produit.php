<?php
// Include database connection
include "../connexion/db.php"; // Assurez-vous d'inclure votre connexion à la base de données

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des champs spécifiques dans l'ordre voulu
    $idDemande = $_POST['idDemande'] ?? '';
    $idbesoin = $_POST['idbesoin'] ?? '';
    $date = $_POST['date'] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits - Comarbois</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="../js/details.js"></script>
    <script src="../js/demande_produit.js"></script>
</head>
<small>

    <body>
        <div class="container mt-4 border border-danger">
            <div class="form-container demande-form">
                <form method="POST" action="demande_list.php">
                    <div class="mb-3">
                        <label for="idDemande" class="form-label">ID Demande</label>
                        <input type="text" class="form-control" id="idDemande" name="idDemande" required>
                    </div>
                    <div class="mb-3">
                        <label for="idbesoin" class="form-label">ID Besoin</label>
                        <input type="text" class="form-control" id="idbesoin" name="idbesoin" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="btn-container d-flex justify-content-end">
                    <input name="add_demande" type="button" class="btn btn-danger add_demande" id="add_demande"
                        value="ajout_demande"></input>

                </div>
                </form>
            </div>
        </div>

        <div class="container mt-4 border border-danger">
            <div class="form-container demande-produit-form">
                <div class="mb-3">
                    <label for="produit" class="form-label">Produit</label>
                    <select name="produit" id="produit" class="form-select">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT designation   FROM produits";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                            ?>
                            <option value="<?= $res->designation ?>" <?= isset($_GET['designation']) && $_GET['designation'] == $res->designation ?>><?= $res->designation ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="unite" class="form-label">uniteé</label>
                    <select name="unite" id="unite" class="form-select">
                        <option value="">&nbsp;</option>
                        <option value="m">mètre (m)</option>
                        <option value="m²">mètre carré (m²)</option>
                        <option value="m³">mètre cube (m³)</option>
                        <option value="pièce">pièce</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" name="quantite" id="quantite" class="form-control"
                        placeholder="Entrez la quantité" min="0" step="any" required>
                </div>
                <div class="btn-container d-flex justify-content-end">
                    <input name="add_produit" type="button" class="btn btn-danger add_produit" id="add_produit"
                        value="ajout_produit"></input>

                </div>

    </body>

</html>