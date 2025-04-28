<?php
include '../connexion/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Define and execute the query to populate the $result variable
    $sql = "SELECT * FROM demande_produit "; // Example query, replace with your actual query
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    }
}
if (isset($_GET['disabled']))
    $disabled = 'disabled';
else
    $disabled = '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BC__TBG </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/commande.js"></script>

</head>
<small>

    <body>
        <div class="container mt-4 border border-danger">
            <div class="form-container demande-form row g-1">


                <h4 class="mb-2 text-danger text-start">Demande Achat </h4>

                <div class="col-md-3">
                    <label for="idDemande" class="form-label">ID Demande</label>
                    <input type="text" class="form-control" id="idDemande" name="idDemande" required disabled
                        value="<?= $_GET['idDemande'] ?? '' ?>">
                </div>

                <div class="col-md-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required
                        value="<?= $_GET['date'] ?? '' ?>">
                </div>

                <div class="col-md-3">
                    <label for="origine" class="form-label ">Origine</label>
                    <select class="form-select" id="origine" name="origine" style="width:95%" <?= $disabled ?>
                        value="<?= $_GET['origine'] ?? '' ?>">
                        <option value="">&nbsp;</option>
                        <option value="stock" <?= (isset($_GET['origine']) && $_GET['origine'] == "stock") ? "selected" : "" ?>>Stock</option>
                        <option value="vente" <?= (isset($_GET['origine']) && $_GET['origine'] == "vente") ? "selected" : "" ?>>Vente</option>
                    </select>
                </div>


                <div class="col-md-3">
                    <label for="client" class="form-label ">Client</label>
                    <select class="form-select" id="client" name="client" style="width:95%" <?= $disabled ?>
                        value="<?= $_GET['client'] ?? '' ?>">
                        <option value="">&nbsp;</option>
                        <?php
                        $sql_nbre = "SELECT distinct client   FROM vue_client";
                        $res_prdt = mysqli_query($conn, $sql_nbre);
                        if (!$res_prdt) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        while ($res = mysqli_fetch_object($res_prdt)) {
                            ?>
                            <option value="<?= $res->client ?>" <?= (isset($_GET['client']) && $_GET['client'] == $res->client) ? "selected" : "" ?>><?= $res->client ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="btn-container d-flex justify-content-end">

                    <a href='../pages/Bon_de_Commande.php'>
                        <img src="../images/imprimer.png" height='30px' width='30px' alt='imprimer'>
                    </a>

                </div>

            </div>
        </div>


        <div class="row mt-4">
            <div class="col-md-1"></div>
            <div class="col-md-10  border border-danger ">
                <h4 class="mb-2 text-danger text-start">Produits</h4>
                <table style="width:100%;" class="table table-bordered">
                    <thead>
                        <tr>

                            <th style="width:1%;"></th>
                            <th style="width:2%;">produit</th>
                            <th style="width:2%;">unite</th>
                            <th style="width:2%;">quantite</th>
                            <th style="width:2%;">prix unitaire</th>



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