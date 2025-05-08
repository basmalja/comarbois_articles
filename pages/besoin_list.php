<?php
include '../connexion/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idbesoin = $_POST['idbesoin'] ?? '';
    $date = $_POST['date'] ?? '';
    $origine = $_POST['origine'] ?? '';
    $client = $_POST['client'] ?? '';
    $objet = $_POST['objet'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des besoins - Comarbois</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/besoin.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-custom {
            background: #fff;
            border-radius: 8px;
            border: 2px solid #dc3545;
            box-shadow: 0 0 12px rgba(220, 53, 69, 0.2);
            padding: 2rem;
        }

        h1 {
            font-weight: 600;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .table thead th {
            background-color: #f5c6cb;
            color: #721c24;
        }

        input, select {
            font-size: 0.9rem;
        }

        .filter-row input, .filter-row select {
            max-width: 100%;
        }

        .filter-row button {
            border: none;
            background: transparent;
        }

        .form-section {
            margin-top: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container mt-4 container-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="text-danger">Liste des besoins</h1>
            <button onclick="window.location='details_list.php';" class="btn btn-danger">Ajouter</button>
        </div>

        <div class="row g-3 align-items-center mb-4">
            <div class="col-auto">
                <label for="date_debut" class="col-form-label">À partir de</label>
            </div>
            <div class="col-auto">
                <input type="date" class="form-control" id="date_debut" name="date_debut">
            </div>
            <div class="col-auto">
                <label for="date_fin" class="col-form-label">jusqu'au</label>
            </div>
            <div class="col-auto">
                <input type="date" class="form-control" id="date_fin" name="date_fin">
            </div>
        </div>

        <div class="table-responsive form-section">
            <table class="table table-bordered table-sm align-middle">
                <thead>
                    <tr>
                        <th>Num Besoin</th>
                        <th>Date</th>
                        <th>Origine</th>
                        <th>Client</th>
                        <th>Objet</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <tr class="filter-row">
                        <td>
                            <input type="number" class="form-control" id="idbesoin" name="idbesoin"
                                value="<?= $_GET['idModif'] ?? '' ?>">
                        </td>
                        <td></td>
                        <td>
                            <select class="form-select" id="origine" name="origine">
                                <option value=""></option>
                                <option value="stock" <?= ($_GET['origine'] ?? '') == "stock" ? "selected" : "" ?>>Stock</option>
                                <option value="vente" <?= ($_GET['origine'] ?? '') == "vente" ? "selected" : "" ?>>Vente</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" id="client" name="client">
                                
                                <?php
                                $sql_nbre = "SELECT DISTINCT client FROM besoin";
                                $res_prdt = mysqli_query($conn, $sql_nbre);
                                while ($res = mysqli_fetch_object($res_prdt)) {
                                ?>
                                    <option value="<?= $res->client ?>" <?= ($_GET['client'] ?? '') == $res->client ? "selected" : "" ?>><?= $res->client ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="objet" name="objet"
                                value="<?= $_GET['objet'] ?? '' ?>">
                        </td>
                        <td>
                            <select class="form-select" id="status" name="status">
                                <option value=""></option>
                                <option value="en cours" <?= ($_GET['status'] ?? '') == "en cours" ? "selected" : "" ?>>En cours</option>
                                <option value="transformé" <?= ($_GET['status'] ?? '') == "transformé" ? "selected" : "" ?>>Transformé</option>
                            </select>
                        </td>
                        <td>
                            <button id="btn-chercher">
                                <img src="../images/loop.png" alt="Rechercher" width="30" height="30">
                            </button>
                        </td>
                    </tr>
                </thead>
                <tbody id="lesdonnees">
                    <!-- Données insérées ici dynamiquement -->
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
