<?php
include('../../config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

  if ($conn->connect_error) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
  } else {
    // Fetch units that are occupied (status = 0)
    $stmt = $conn->prepare("SELECT units.id, unitname, unitno, unitposition, unitprice, unittype, users.username
                            FROM units
                            LEFT JOIN users ON units.acquired_by = users.id
                            WHERE units.status = 0");
    $stmt->execute();

    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    header("Content-Type: application/json");
    echo json_encode($result);

    $stmt->close();
    $conn->close();
  }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = json_decode(file_get_contents('php://input'), true);

  if (isset($input['action']) && $input['action'] === 'recover' && isset($input['id'])) {
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
      http_response_code(500);
      header("Content-Type: application/json");
      echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    } else {
      // Update the unit's status to 'available' (1) and set acquired_by to NULL
      $stmt = $conn->prepare("UPDATE units SET status = 1, acquired_by = NULL WHERE id = ?");
      $stmt->bind_param('i', $input['id']);
      $stmt->execute();

      header("Content-Type: application/json");
      echo json_encode(['message' => 'Unit recovered successfully', 'id' => $input['id']]);

      $stmt->close();
      $conn->close();
    }
  } else {
    http_response_code(400);
    header("Content-Type: application/json");
    echo json_encode(['error' => 'Invalid request']);
  }
}
