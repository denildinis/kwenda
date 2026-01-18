<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/conection.php';
require_once __DIR__ . '/../functions/sessions/session.php';

verifySession();

if ($_SESSION['role'] !== 'banco') {
  echo json_encode([]);
  exit;
}

$bank_id = $_SESSION['bank_id'] ?? null;
if (!$bank_id) {
  echo json_encode([]);
  exit;
}

$stmt = $pdo->prepare("
    SELECT
        a.id,
        a.nome,
        e.provincia,
        e.municipio,
        e.bairro
    FROM agencias a
    LEFT JOIN enderecos e ON a.endereco_id = e.id
    WHERE a.banco_id = :bank_id
    ORDER BY a.nome ASC
");

$stmt->execute([':bank_id' => $bank_id]);
$agencies = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($agencies);
