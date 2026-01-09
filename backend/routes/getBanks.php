<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/conection.php';

$stmt = $pdo->prepare("SELECT id, nome, sigla, email, logo FROM bancos ORDER BY sigla ASC");
$stmt->execute();

$banks = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($banks);
