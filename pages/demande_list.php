<?php
include '../connexion/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des champs spécifiques dans l'ordre voulu
    $idbesoin = $_POST['idbesoin'] ?? '';
    $date = $_POST['date'] ?? '';
    $origine = $_POST['origine'] ?? '';
    $client = $_POST['client'] ?? '';
   


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
    <script src="../js/demande_produit.js"></script>


   
</head>
<small>

    <body>
        <div class="container mt-4 border border-danger">
            <div class="header d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-danger">Liste des Demande</h1>
            </div>
            <div class="btn-container d-flex justify-content-end">
                <input onclick="window.location='demande_produit.php';" type="button" class="btn btn-danger"
                    id="btnAjouter" value="ajouter">
            </div>
            
            <div class="form-container">

                <table class="table table-bordered besoin">
                    <thead>
                        <tr with="100%">
                            <th>idDemande</th>
                            <th>Date</th>
                            <th>Origine</th>
                            <th>Client</th>
                          
                            <th ></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_select = "SELECT * FROM demande_achat ";
                        $result = mysqli_query($conn, $sql_select);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['idDemande']}</td>
                                <td>{$row['date']}</td>
                                <td>{$row['origine']}</td>
                                <td>{$row['client']}</td>
                               
                                <td>
                                    <a href='../pages/demande_produit.php?idDemande={$row['idDemande']}&origine={$row['origine']}&date={$row['date']}&client={$row['client']}&disabled=1' class='consulter-btn' }>
                                        <img src='../images/crayon.png' height='20px' width='20px' alt='Edit'>
                                    </a>
                                                     
                                  
                                </td>
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