<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../controller/bankController.php';

$data = json_decode(file_get_contents('php://input'), true);

echo deleteBank($data);
exit;
