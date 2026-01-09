<?php
require_once __DIR__ . "/session.php";

verifySession();

header('Content-Type: application/json');
echo json_encode([
  'success' => true,
  'role' => $_SESSION['role']
]);

