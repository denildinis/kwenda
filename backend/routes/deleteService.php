<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../controller/serviceController.php';

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

// VALIDAÇÃO FORTE
if (!$data || !isset($data['id'])) {
  echo json_encode([
    'success' => false,
    'message' => 'ID do serviço não informado'
  ]);
  exit;
}

echo deleteService($data);
exit;
