<?php
// Include database connection
include '../connexion/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $produit = isset($_POST['produit']) ? $_POST['produit'] : '';
    $unite = isset($_POST['unite']) ? $_POST['unite'] : '';
    $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : '';

    // Check if the ID is valid
    if ($id > 0) {
        // Prepare the SQL statement to update the record
        $query = "UPDATE demande_produit SET 
                    produit = '$produit',
                    unite = '$unite',
                    quantite = '$quantite'
                  WHERE id_demande_produit = $id";

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
