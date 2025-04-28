<?php


// Include database connection
include '../connexion/db.php';

$response = [
    'erreur' => '',
    'nbreEnre' => 0,
    'lignes' => ''
];

try {
    $where = [];
    $params = [];

    if (!empty($_POST['idbesoin'])) {
        $where[] = "idbesoin = :idbesoin";
        $params[':idbesoin'] = $_POST['idbesoin'];
    }
    if (!empty($_POST['date'])) {
        $where[] = "date = :date";
        $params[':date'] = $_POST['date'];
    }
    if (!empty($_POST['origine'])) {
        $where[] = "origine = :origine";
        $params[':origine'] = $_POST['origine'];
    }
    if (!empty($_POST['client'])) {
        $where[] = "client LIKE :client";
        $params[':client'] = '%' . $_POST['client'] . '%';
    }
    if (!empty($_POST['objet'])) {
        $where[] = "objet LIKE :objet";
        $params[':objet'] = '%' . $_POST['objet'] . '%';
    }

    $sql = "SELECT * FROM besoins";
    if (!empty($where)) {
        $sql .= " WHERE " . implode(' AND ', $where);
    }
    $sql .= " ORDER BY date DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        $response['erreur'] = "Aucun besoin trouvé.";
    } else {
        foreach ($rows as $row) {
            $response['lignes'] .= "<tr>";
            $response['lignes'] .= "<td>" . htmlspecialchars($row['idbesoin']) . "</td>";
            $response['lignes'] .= "<td>" . htmlspecialchars($row['date']) . "</td>";
            $response['lignes'] .= "<td>" . htmlspecialchars($row['origine']) . "</td>";
            $response['lignes'] .= "<td>" . htmlspecialchars($row['client']) . "</td>";
            $response['lignes'] .= "<td>" . htmlspecialchars($row['objet']) . "</td>";
            $response['lignes'] .= "</tr>";
        }
        $response['nbreEnre'] = count($rows);
    }
} catch (PDOException $e) {
    $response['erreur'] = "Erreur BDD : " . $e->getMessage();
}

echo json_encode($response);
