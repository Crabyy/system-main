<?php

include('../../config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $requestData = json_decode(file_get_contents('php://input'), true);

  $unitno = $requestData['unitno'];
  $unitname = $requestData['unitname'];
  $unitstatus = $requestData['unitstatus'];
  $unitposition = $requestData['unitposition'];
  $unitprice = $requestData['unitprice'];
  $unittype = $requestData['unittype'];


  $sql = "INSERT INTO units (unitno, unitname, unitstatus, unitposition, unitprice, unittype) VALUES ('$unitno', '$unitname', '$unitstatus', '$unitposition', '$unitprice', '$unittype')";

  if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'message' => 'Error creating unit: ' . $conn->error]);
  }
}

$conn->close();
