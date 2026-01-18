<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/conection.php';

$bank_id = $_GET['bank_id'] ?? null;

if (!$bank_id) {
  echo json_encode([]);
  exit;
}

$stmt = $pdo->prepare("
  SELECT id, nome
  FROM servicos
  WHERE banco_id = :bank_id
    AND ativo = 1
  ORDER BY nome ASC
");
$stmt->execute([':bank_id' => $bank_id]);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($services);
