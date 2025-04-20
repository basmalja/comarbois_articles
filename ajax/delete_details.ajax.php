<?php
// Include database connection
include '../connexion/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID from the POST request
    $id = isset($_POST['id_detail']) ? intval($_POST['id_detail']) : 0;

    if ($id > 0) {
        // Prepare the SQL statement to delete the record
        $query = "DELETE FROM details WHERE id = $id";

        if ($conn->query($query) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Record deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete the record.']);
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