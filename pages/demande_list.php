<?php
include '../connexion/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des champs spécifiques dans l'ordre voulu
    $idDemande = $_POST['idDemande'] ?? '';
    $date = $_POST['date'] ?? '';
    $origine = $_POST['origine'] ?? '';
    $client = $_POST['client'] ?? '';
    $idDemande = $_POST['idDemande'] ?? '';

    $date_debut = $_POST['date_debut'] ?? '';
    $date_fin = $_POST['date_fin'] ?? '';


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Demande - Comarbois</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/demande_list.js"></script>







</head>
<small>

    <body>
        <div class="container mt-4 border border-danger">
            <div class="header d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-danger">Liste des Demande</h1>
            </div>
            <div class="d-flex gap-3 mt-2  d-flex justify-content-start">
                À partir de <input type="date" class="form-control date" style="width: 130px;" id="date_debut"
                    name="date_debut" value="">
                jusqu'au <input type="date" class="form-control date" style="width: 130px;" id="date_fin"
                    name="date_fin" value="">
            </div>
            <div class="btn-container d-flex justify-content-end">
                <input onclick="window.location='demande_produit.php';" type="button" class="btn btn-danger"
                    id="btnAjouter" value="Ajouter">
            </div>

            <div class="form-container">

                <table class="table table-bordered besoin">
                    <thead>
                        <tr with="100%">
                            <th>Num Demande</th>
                            <th>Date</th>
                            <th>Origine</th>
                            <th>Client</th>
                            <th>Objet
                            </th>
                            <th>

                            </th>

                        </tr>

                        <tr>
                            <td> <input type="number"
                                    value="<?= (isset($_GET['idDemande'])) ? $_GET['idDemande'] : '' ?>"
                                    class="form-control" id="idDemande" name="idDemande" style="width:95%">
                            </td>
                            <td></td>
                            <td><select class="form-select" id="origine" name="origine" style="width:95%"
                                    value="<?= (isset($_GET['origine'])) ? $_GET['origine'] : '' ?>">
                                    <option value="">&nbsp;</option>
                                    <option value="stock" <?= (isset($_GET['origine']) && $_GET['origine'] == "stock") ? "selected" : "" ?>>Stock</option>
                                    <option value="vente" <?= (isset($_GET['origine']) && $_GET['origine'] == "vente") ? "selected" : "" ?>>Vente</option>
                                </select></td>
                            <td><select class="form-select" id="client" name="client" style="width:95%"
                                    value="<?= (isset($_GET['client '])) ? $_GET['client'] : '' ?>">
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
                                </select></td>
                            <td><input type="text" class="form-control" id="objet" name="objet" style="width:95%"
                                    value="<?= (isset($_GET['objet'])) ? $_GET['objet'] : '' ?>">
                            </td>
                            <td>
                                <div class="btn-container d-flex justify-content-end">
                                    <button id="btn-chercher" class="btn border-0 p-0 bg-transparent"><img
                                            src="../images/loop.png" height='30px' width='30px' alt='chercher'></button>
                                </div>
                            </td>
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