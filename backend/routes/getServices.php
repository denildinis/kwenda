<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/conection.php';
require_once __DIR__ . '/../functions/sessions/session.php';

verifySession();

// Só banco pode acessar
if ($_SESSION['role'] !== 'banco') {
  echo json_encode([]);
  exit;
}

$bank_id = $_SESSION['bank_id'] ?? null;
if (!$bank_id) {
  echo json_encode([]);
  exit;
}

// Seleciona apenas serviços ativos
$stmt = $pdo->prepare("
  SELECT id, codigo, nome
  FROM servicos
  WHERE banco_id = :bank_id
    AND ativo = 1
  ORDER BY nome ASC
");

$stmt->execute([':bank_id' => $bank_id]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
