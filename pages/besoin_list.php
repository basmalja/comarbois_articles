<?php
include '../connexion/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des champs spécifiques dans l'ordre voulu
    $idbesoin = $_POST['idbesoin'] ?? '';
    $date = $_POST['date'] ?? '';
    $origine = $_POST['origine'] ?? '';
    $client = $_POST['client'] ?? '';
    $objet = $_POST['objet'] ?? '';



}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des besoin - Comarbois</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/besoin.js"></script>



</head>
<small>

    <body>
        <div class="container mt-4 border border-danger">
            <div class="header d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-danger">Liste des besoins</h1>
            </div>
            <div class="btn-container d-flex justify-content-end">
                <input onclick="window.location='details_list.php';" type="button" class="btn btn-danger"
                    id="btnAjouter" value="ajouter">
            </div>

            <div class="form-container">

                <table class="table table-bordered besoin">
                    <thead>
                        <tr>
                            <th>IdBesoin<br> <input type="number"
                                    value="<?= (isset($_GET['idModif'])) ? $_GET['idModif'] : '' ?>"
                                    class="form-control" id="idbesoin" name="idbesoin" style="width:95%">
                            </th>
                            <th> Date
                            <div class="d-flex gap-2 mt-1">
                                <input type="date" class="form-control date" style="width: 130px;" id="date_debut"
                                    name="date_debut" value="...">
                                <input type="date" class="form-control date" style="width: 130px;" id="date_fin"
                                    name="date_fin" value="...">
                            </div>
                            </th>
                            <th>Origine<br> <select class="form-select" id="origine" name="origine" style="width:95%"
                                    value="<?= (isset($_GET['origine'])) ? $_GET['origine'] : '' ?>">
                                    <option value="">&nbsp;</option>
                                    <option value="stock" <?= (isset($_GET['origine']) && $_GET['origine'] == "stock") ? "selected" : "" ?>>Stock</option>
                                    <option value="vente" <?= (isset($_GET['origine']) && $_GET['origine'] == "vente") ? "selected" : "" ?>>Vente</option>
                                </select></th>
                            <th>Client<br> <select class="form-select" id="client" name="client" style="width:95%"
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
                                </select></th>
                            <th>Objet<br><input type="text" class="form-control" id="objet" name="objet"
                                    style="width:95%" value="<?= (isset($_GET['objet'])) ? $_GET['objet'] : '' ?>">
                            </th>
                            <th colspan="2"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_select = "SELECT * FROM besoin";
                        $result = mysqli_query($conn, $sql_select);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['idBesoin']}</td>
                                <td>{$row['date']}</td>
                                <td>{$row['origine']}</td>
                                <td>{$row['client']}</td>
                                 <td>{$row['objet']}</td>
                                <td>
                                    <a href='../pages/details_list.php?idModif={$row['idBesoin']}&origine={$row['origine']}&date={$row['date']}&client={$row['client']}&disabled=1' class='consulter-btn' }>
                                        <img src='../images/crayon.png' height='20px' width='20px' alt='Edit'>
                                    </a>
                                    
                                
                              </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</small>

</html>