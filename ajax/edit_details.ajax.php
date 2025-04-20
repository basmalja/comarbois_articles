<?php
// Include database connection
include '../connexion/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $id = isset($_POST['id_detail']) ? intval($_POST['id_detail']) : 0;
    $designation = isset($_POST['designation']) ? $_POST['designation'] : '';
    $fournisseur = isset($_POST['fournisseur']) ? $_POST['fournisseur'] : '';
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
    $sous_categorie = isset($_POST['sous_categorie']) ? $_POST['sous_categorie'] : '';
    $qualite = isset($_POST['qualite']) ? $_POST['qualite'] : '';
    $largeur = isset($_POST['largeur']) ? $_POST['largeur'] : '';
    $longueur = isset($_POST['longueur']) ? $_POST['longueur'] : '';
    $epaisseur = isset($_POST['epaisseur']) ? $_POST['epaisseur'] : '';
    $unite = isset($_POST['unite']) ? $_POST['unite'] : '';
    $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : '';

    // Check if the ID is valid
    if ($id > 0) {
        // Prepare the SQL statement to update the record
        $query = "UPDATE details SET 
                    designation = '$designation', 
                    fournisseur = '$fournisseur',
                    categorie = '$categorie',
                    sous_categorie = '$sous_categorie',
                    qualite = '$qualite',
                    largeur = '$largeur',
                    longueur = '$longueur',
                    epaisseur = '$epaisseur',
                    unite = '$unite',
                    quantite = '$quantite'
                  WHERE id = $id";

        if ($conn->query($query) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Record updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update the record.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid ID provided.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

// Close the database connection
$conn->close();
?>
