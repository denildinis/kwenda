<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../functions/sessions/session.php';
verifySession();

require_once __DIR__ . '/../controller/serviceController.php';

$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (!$data || !is_array($data)) {
  echo json_encode([
    'success' => false,
    'message' => 'Preencha todos os campos obrigatórios'
  ]);
  exit;
}

echo json_encode(registerService($data));

