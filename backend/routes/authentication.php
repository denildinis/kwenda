<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../controller/userAuthenticator.php';

$user = json_decode(file_get_contents("php://input"), true);

if (!$user || !isset($user["email"], $user["password"])) {
  echo json_encode([
    "success" => false,
    "message" => "Dados de login inválidos."
  ]);
  exit;
}

echo authenticateUser($user["email"], $user["password"]);
