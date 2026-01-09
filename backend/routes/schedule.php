<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/conection.php';
require_once __DIR__ . '/../controller/scheduleController.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
  echo json_encode([
    'success' => false,
    'message' => 'Campos inválidos'
  ]);
  exit;
}

$controller = new ScheduleController($pdo);
$response = $controller->store($data);

if ($response['success']) {
  $_SESSION['schedule_id'] = $response['schedule_id'];

  echo json_encode([
    'success' => true,
    'id' => $response['schedule_id']
  ]);
} else {
  echo json_encode($response);
}
