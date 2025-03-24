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
    <title>Liste des besoin - Comarbois</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
<body>
<div class="container mt-4 border border-danger">
        <div class="btn-container d-flex justify-content-end">
          <input type="button" class="btn btn-danger" id="btnAjouter" value="ajouter">
        </div>   
    
        <div class="form-container">
           
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>idbesoin</th>
                        <th>date</th>
                        <th>origine</th>
                        <th>client</th>
                        <th></th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql_select = "SELECT * FROM besoin";
                    $result = mysqli_query($conn, $sql_select);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['idbesoin']}</td>
                                <td>{$row['date']}</td>
                                <td>{$row['origine']}</td>
                                <td>{$row['client']}</td>
                               
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>