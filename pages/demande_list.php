<?php
// Include database connection
include "../connexion/db.php"; // Assurez-vous d'inclure votre connexion à la base de données

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
    <title>Liste des Demandes d'Achat</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/demande_produit.js"></script>
    <script src="../js/demande_list.js"></script>
</head>
<body>
    <div class="container mt-4 border border-danger">
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-danger">Liste des Demandes d'Achat</h1>
        </div>
        <div class="btn-container d-flex justify-content-end">
            <input onclick="window.location='demande_produit.php';" type="button" class="btn btn-danger"
                id="btnAjouter" value="Ajouter">
        </div>

        <div class="form-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Demande</th>
                        <th>ID Besoin</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_select = "SELECT * FROM demande_achat";
                    $result = mysqli_query($conn, $sql_select);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $idDemande = isset($row['idDemande']) ? $row['idDemande'] : '';
                            $idBesoin = isset($row['idBesoin']) ? $row['idBesoin'] : '';
                            $date = isset($row['date']) ? $row['date'] : '';
                            echo "<tr>
                                    <td>{$idDemande}</td>
                                    <td>{$idBesoin}</td>
                                    <td>{$date}</td>
                                    <td>
                                        <button class='btn btn-primary' onclick=\"window.location.href='besoin_list.php?id={$idDemande}'\">Voir Détails</button>
                                        <button class='btn btn-danger delete-btn' data-id='{$idDemande}'>Supprimer</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Aucune demande trouvée.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
