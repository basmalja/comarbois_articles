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

    // Define and execute the query to populate the $result variable
    $sql = "SELECT * FROM details "; // Example query, replace with your actual query
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    }
}
if(isset($_GET['disabled']))$disabled='disabled';
else $disabled='';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits - Comarbois</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
    <script src="../js/details.js"></script>
    <script src="../js/deletenew.js"></script>
    <script src="../js/edit_details.js"></script>
    <script src="../js/besoin.js"></script>
</head>
<small>
    <body>
        <div class="container mt-4 border border-danger">
            <div class="form-container ">
                <h4 class="mb-2 text-danger text-start">Besoin</h4>
                <div id="besoinForm" class="row g-1" method="POST">
                    <div class="col-md-3">
                        <label for="idbesoin" class="form-label entete">IdBesoin</label>
                        <input type="number" value="<?= (isset($_GET['idModif'])) ? $_GET['idModif'] : '' ?>"
                            class="form-control" id="idbesoin" name="idbesoin" style="width:95%" disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="date" class="form-label entete">Date</label>
                        <input <?=$disabled?> type="date" class="form-control" id="date" name="date" style="width:95%" value="<?= (isset($_GET['date']) && strtotime($_GET['date'])) ? date('Y-m-d', strtotime($_GET['date'])) : '' ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="origine" class="form-label entete">Origine</label>
                        <select <?=$disabled?>  class="form-select" id="origine" name="origine" style="width:95%" value="<?= (isset($_GET['origine'])) ? $_GET['origine'] : '' ?>">
                            <option value="" >&nbsp;</option>
                            <option value="stock" <?= (isset($_GET['origine']) && $_GET['origine'] == "stock") ? "selected" : "" ?>>Stock</option>
                            <option value="vente" <?= (isset($_GET['origine']) && $_GET['origine'] == "vente") ? "selected" : "" ?>>Vente</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="client" class="form-label entete">Client</label>
                        <select  <?=$disabled?>  class="form-select" id="client" name="client" style="width:95%" value="<?= (isset($_GET['client '])) ? $_GET['client'] : '' ?>">
                            <option value="">&nbsp;</option>
                            <?php
                            $sql_nbre = "SELECT distinct client   FROM vue_client";
                            $res_prdt = mysqli_query($conn, $sql_nbre);
                            if (!$res_prdt) {
                                echo "Error: " . mysqli_error($conn);
                            }
                            while ($res = mysqli_fetch_object($res_prdt)) {
                                ?>
                                <option value="<?= $res->client ?>" <?= (isset($_GET['client']) && $_GET['client'] == $res->client ) ? "selected" : "" ?>><?= $res->client ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="objet" class="form-label entete">Objet</label>
                        <input type="text" class="form-control" id="objet" name="objet" style="width:95%" value="<?= (isset($_GET['objet'])) ? $_GET['objet'] : '' ?>">
                    </div>

                    <div class="btn-container d-flex justify-content-end">
                        <input type="button" class="btn btn-danger" id="btnEnregistrer" value="enregistrer">
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            let origineSelect = document.getElementById("origine");
                            let clientInput = document.getElementById("client");

                            origineSelect.addEventListener("change", function () {
                                if (origineSelect.value === "stock") {
                                    clientInput.disabled = true;
                                    clientInput.value = ""; // Réinitialiser la valeur du champ
                                } else {
                                    clientInput.disabled = false;
                                }
                            });

                        });
                        
                    </script>
                </div>
            </div>
        </div>
        <div class="container mt-4  border border-danger">
            <div class="form-container">
                <h4 class="mb-2 text-danger text-start"> Ajout Details</h4>
                <div id="detailsForm" class="row g-1" method="POST">
                    <input type="hidden" id="idbesoin" name="idbesoin" value="">
                    <input type="hidden" id="id_detail" name="id_detail" value="">
                    <div class="col-md-12">
                        <label for="designation" class="form-label">Désignation</label>
                        <input type="text" class="form-control" id="designation" name="designation" value="" disabled
                            style="width:95%">
                    </div>
                    <div class="col-md-3">
                        <label for="fournisseur" class="form-label">Fournisseur</label>
                        <select class="form-select concat" id="fournisseur" name="fournisseur" style="width:95%">
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
                        <select class="form-select concat" id="categorie" name="categorie" style="width:95%">
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
                        <select class="form-select concat" id="sous_categorie" name="sous_categorie" style="width:95%">
                            <option value="">&nbsp;</option>
                            <?php
                            $sql_nbre = "SELECT distinct id_categorie3 as sous_categorie FROM produits";
                            $res_prdt = mysqli_query($conn, $sql_nbre);
                            if (!$res_prdt) {
                                echo "Error: " . mysqli_error($conn);
                            }
                            while ($res = mysqli_fetch_object($res_prdt)) {
                                ?>
                                <option value="<?= $res->sous_categorie ?>"><?= $res->sous_categorie ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="qualite" class="form-label">Qualité</label>
                        <select class="form-select concat" id="qualite" name="qualite" style="width:95%">
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
                        <select class="form-select concat" id="largeur" name="largeur" style="width:95%">
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
                        <select class="form-select concat " id="longueur" name="longueur" style="width:95%">
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
                        <label for="epaisseur " class="form-label">Épaisseur</label>
                        <select class="form-select concat" id="epaisseur" name="epaisseur" style="width:95%">
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
                        <select class="form-select" id="unite" name="unite" style="width:95%"  >
                            <option value="">&nbsp;</option>
                            <option value="ML">ML</option>
                            <option value="m2">M2</option>
                            <option value="m3">M3</option>
                            <option value="piece">Piece</option>
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="quantite" class="form-label">Quantité</label>
                        <input type="number" class="form-control" id="quantite" name="quantite" style="width:95%">
                    </div>
                    <div class="btn-container d-flex justify-content-end">
                        <input name="btnSoumettre" type="button" class="btn btn-danger btnSoumettre" id="btnSoumettre"
                            value="soumettre"></input>
                        <input name="btnSave" type="button" class="btn btn-danger btnSave" id="btnSave"
                            value="Save" hidden></input>
                    </div>
                   
                </div>
            </div>



        </div>
        <div class="row mt-4">                        
        <div class="col-md-1"></div>
        <div class="col-md-10  border border-danger ">
        <h4 class="mb-2 text-danger text-start">Details</h4>
            <table style="width:100%;"  class="table table-bordered">
                <thead>
                    <tr>

                        <th style="width:10%;">Fournisseur</th>
                        <th style="width:10%;">Catégorie</th>
                        <th style="width:10%;">sous_categorie</th>
                        <th style="width:10%;">Qualité</th>
                        <th style="width:5%;">Longueur</th>
                        <th style="width:5%;">Largeur</th>
                        <th style="width:5%;">Épaisseur</th>
                        <th style="width:5%;">unite</th>
                        <th style="width:5%;">quantite</th>
                        <th style="width:35%;">designation</th>
                        <th colspan="2" style="width:5%;"></th>

                    </tr>
                </thead>
                <tbody id="lesdonnees">

                </tbody>
            </table>
        </div>
     
    </div>                       
    </body>
</small>

</html>