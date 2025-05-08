<?php
include '../connexion/db.php';


if (isset($_GET['idDemande'])) {
    $idDemande = $_GET['idDemande'];

    // Requête SQL CORRIGÉE (à exécuter avec PDO ou MySQLi)
    $sql = "SELECT * FROM demande_achat WHERE idDemande = '$idDemande' ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    } else {
        $row = mysqli_fetch_assoc($result);
        $origine = $row['origine'];
        $client = $row['client'];
        $date = $row['date'];
        $idBesoin = $row['idBesoin'];
        $objet = $row['objet'];
    }
    // Exécution de la requête (exemple avec MySQLi)
    // $result = mysqli_query($conn, $sql);

} else {
    $idDemande = null;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits de la demande-form - Comarbois</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="../js/demande_produit.js"></script>

    <script src="../js/delete_demande_produit.js"></script>
    <script src="../js/edit_demande_produit.js"></script>
</head>
<small>

    <body>

        <div class="container mt-4 border border-danger">
            <div class="btn-container d-flex justify-content-end">
                <input onclick="window.location='demande_list.php';" type="button" class="btn btn-danger" id="Fermer"
                    value="Fermer">
            </div>
            <div class="form-container demande-form row g-1">


                <h4 class="mb-2 text-danger text-start">Ajout Demande</h4>


                <div class="col-md-2">
                    <label for="idDemande" class="form-label">ID Demande</label>
                    <input type="text" class="form-control" id="idDemande" name="idDemande" required disabled
                        value="<?= $_GET['idDemande'] ?? '' ?>">
                </div>

                <div class="col-md-2">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required
                        value="<?= $date ?>">
                </div>

                <div class="col-md-3">
                    <label for="origine" class="form-label ">Origine</label>
                    <select class="form-select" id="origine" name="origine" style="width:95%" <?= $disabled ?>
                        value="<?= $_GET['origine'] ?? '' ?>">
                        <option value="">&nbsp;</option>
                        <option value="stock" <?= (isset($origine) && $origine == "stock") ? "selected" : "" ?>>Stock</option>
                        <option value="vente" <?= (isset($origine) && $origine == "vente") ? "selected" : "" ?>>Vente</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="client" class="form-label ">Client</label>
                    <select class="form-select" id="client" name="client" style="width:95%" <?= $disabled ?>
                        value="<?= $client ?>">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct client   FROM vue_client";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                            ?>
                            <option value="<?= $res->client ?>" <?= (isset($client) && $client == $res->client) ? "selected" : "" ?>><?= $res->client ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="idBesoin" class="form-label ">IdBesoin</label>
                    <input type="text" class="form-control" id="idBesoin" name="idBesoin" required disabled
                        value="<?= $idBesoin ?? '' ?>">
                </div>
                <div class="col-md-6">
                        <label for="objet" class="form-label entete">Objet</label>
                        <input type="text" class="form-control" id="objet" name="objet" style="width:95%"
                            value="<?= (isset($objet)) ? $objet: '' ?>">
                    </div>
                <div class="btn-container d-flex justify-content-end gap-2">
                    <input name="add_demande" type="button" class="btn btn-danger add_demande" id="add_demande"
                        value="Ajout_Demande"></input>

                    <button type="button" onclick="generateTBGLink()" class="btn btn-danger">
                        Bon Commande TBG
                    </button>
                </div>

                <script>
                    function generateTBGLink() {
                        // Get values from form fields
                        const idDemande = document.getElementById('idDemande').value;
                        const idBesoin = document.getElementById('idBesoin').value;
                        const date = document.getElementById('date').value;
                        const origine = document.getElementById('origine').value;
                        const client = document.getElementById('client').value;

                        // Construct URL
                        const url = `../pages/commande_TBG.php?idDemande=${idDemande}&idBesoin=${idBesoin}&origine=${origine}&date=${date}&client=${client}&disabled=1`;

                        // Redirect to the URL
                        window.location.href = url;
                    }
                </script>


            </div>
        </div>

        <div class="container mt-4 border border-danger">
            <div class="form-container demande-produit-form row g-1"">
                <h4 class="mb-2 text-danger text-start">Ajout produit</h4>
                <input type="hidden" id="idDemande" name="idDemande" value="">
                <input type="hidden" id="id_demande_produit" name="id_demande_produit" value="">
                <div class="col-md-6">
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
                            <option value="<?= $res->designation ?>"><?= $res->designation ?>
                            </option>
                           
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="unite" class="form-label">uniteé</label>
                    <select name="unite" id="unite" class="form-select">
                        <option value="">&nbsp;</option>
                        <option value="m">mètre  (m)</option>
                        <option value="m²">mètre carré (m²)</option>
                        <option value="m³">mètre cube (m³)</option>
                        <option value="pièce">pièce</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" name="quantite" id="quantite" class="form-control"
                        placeholder="Entrez la quantité" min="0" step="any" required>
                </div>
                <div class="btn-container d-flex justify-content-end">
                    <input name="add_produit" type="button" class="btn btn-danger add_produit" id="add_produit"
                        value="Ajout_Produit"></input>
                    

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

        <div class="row mt-4">
            <div class="col-md-1"></div>
            <div class="col-md-10  border border-danger ">
                <h4 class="mb-2 text-danger text-start">Produits</h4>
                <table style="width:100%;" class="table table-bordered">
                    <thead>
                        <tr>

                            <th style="width:40% ;">Désignation</th>
                            <th style="width:40%;">Produit</th>
                            <th style="width:10%;">Unité</th>
                            <th style="width:10%;">Quantite</th>
                            <th colspan="2" style="width:5%;"></th>

                        </tr>
                    </thead>
                    <tbody id="lesdonnees">

                    </tbody>
                </table>
            </div>
        </div>
        </div>


    </body>

</html>