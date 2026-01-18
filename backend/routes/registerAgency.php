<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../controller/agencyController.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !is_array($data)) {
  echo json_encode([
    'success' => false,
    'message' => 'Dados inválidos'
  ]);
  exit;
}

echo json_encode(registerAgency($data));
