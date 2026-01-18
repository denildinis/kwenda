<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/conection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
  echo json_encode(null);
  exit;
}

$stmt = $pdo->prepare("
  SELECT id, nome, sigla, email, logo
  FROM bancos
  WHERE id = ?
");

$stmt->execute([$id]);
$bank = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($bank);
