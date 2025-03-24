<?php
include '../connexion/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des champs spécifiques dans l'ordre voulu
    $categorie = $_POST['categorie'] ?? '';
    $sous_categorie = $_POST['sous_categorie'] ?? '';
    $fournisseur = $_POST['fournisseur'] ?? '';
    $qualite = $_POST['qualite'] ?? '';
    $long = $_POST['long'] ?? '';
    $larg = $_POST['larg'] ?? '';
    $epaiss = $_POST['epaiss'] ?? '';

   
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits - Comarbois</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
<body>
    <div class="container mt-4 border border-danger">
        <div class="form-container ">
            <h4 class="mb-2 text-danger text-center">besoin</h4>
            <div id="besoinForm" class="row g-1" method="POST">
                <div class="col-md-3">
                    <label for="idbesoin" class="form-label">idbesoin</label>
                    <input type="number" class="form-control" id="idbesoin" name="idbesoin">
                </div>
                <div class="col-md-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="col-md-3">
                    <label for="origine" class="form-label">Origine</label>
                    <select  class="form-select" id="origine" name="origine">
                        <option value="">&nbsp;</option>
                        <option value="stock">stock</option>
                        <option value="vente">vente</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="client" class="form-label">Client</label>
                    <select class="form-select" id="client" name="client">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct client   FROM vue_client";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                        ?>
                            <option value="<?= $res->client ?>"><?= $res->client?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="btn-container d-flex justify-content-end">
                   <input type="button" class="btn btn-danger" id="btnEnregistrer" value="enregistrer">
                </div>   
                

            </div>
        </div>
    </div>
    <div class="container mt-4  border border-danger">
        <div class="form-container">
            <h4 class="mb-2 text-danger text-center">details</h4>
            <div id="detailsForm" class="row g-1" method="POST">
                <input type="hidden" id="idbesoin" name="idbesoin" value="">
                <div class="col-md-12">
                    <label for="designation" class="form-label">Désignation</label>
                    <input type="text" class="form-control" id="designation" name="designation">
                </div>
                <div class="col-md-3">
                    <label for="fournisseur" class="form-label">Fournisseur</label>
                    <select class="form-select" id="fournisseur" name="fournisseur">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct champ4 as fournisseur FROM produits";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                        ?>
                            <option value="<?= $res->fournisseur ?>"><?= $res->fournisseur ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <select class="form-select" id="categorie" name="categorie">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct id_categorie2 as categorie FROM produits";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                        ?>
                            <option value="<?= $res->categorie ?>"><?= $res->categorie ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sous_categorie" class="form-label">Sous-catégorie</label>
                    <select class="form-select" id="sous_categorie" name="sous_categorie">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct id_categorie3 as Souscatégorie FROM produits";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                        ?>
                            <option value="<?= $res->Souscatégorie ?>"><?= $res->Souscatégorie ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="qualite" class="form-label">Qualité</label>
                    <select class="form-select" id="qualite" name="qualite">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct champ3 as qualite FROM produits";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                        ?>
                            <option value="<?= $res->qualite ?>"><?= $res->qualite ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="largeur" class="form-label">Largeur</label>
                    <select class="form-select" id="largeur" name="largeur">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct largeur FROM produits";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                        ?>
                            <option value="<?= $res->largeur ?>"><?= $res->largeur ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="longueur" class="form-label">Longueur</label>
                    <select class="form-select" id="longueur" name="longueur">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct longueur FROM produits";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                        ?>
                            <option value="<?= $res->longueur ?>"><?= $res->longueur ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="epaisseur" class="form-label">Épaisseur</label>
                    <select class="form-select" id="epaisseur" name="epaisseur">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct epaisseur FROM produits";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                        ?>
                            <option value="<?= $res->epaisseur ?>"><?= $res->epaisseur ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="unite" class="form-label">Unité</label>
                    <select class="form-select" id="unite" name="unite">
                        <option value="">&nbsp;</option>
                        <option value="ML">ML</option>
                        <option value="m2">m2</option>
                        <option value="m3">m3</option>
                        <option value="piece">piece</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" class="form-control" id="quantite" name="quantite">
                </div>
                <div class="btn-container d-flex justify-content-end">
                    <button type="btnSoumettre" class="btn btn-danger">soumettre</button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-container mt-4">
            <h2>Liste des Produits</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Catégorie</th>
                        <th>Sous-Catégorie</th>
                        <th>Fournisseur</th>
                        <th>Qualité</th>
                        <th>Longueur</th>
                        <th>Largeur</th>
                        <th>Épaisseur</th>
                        <th>designation</th>

                    </tr>
                </thead>
                <tbody id="produitTable">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['categorie']) ?></td>
                            <td><?= htmlspecialchars($row['sous_categorie']) ?></td>
                            <td><?= htmlspecialchars($row['fournisseur']) ?></td>
                            <td><?= htmlspecialchars($row['qualite']) ?></td>
                            <td><?= htmlspecialchars($row['longueur']) ?></td>
                            <td><?= htmlspecialchars($row['largeur']) ?></td>
                            <td><?= htmlspecialchars($row['epaisseur']) ?></td>
                            <td></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
