<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../config/conection.php';
require_once __DIR__ . '/../controller/ScheduleController.php';
require_once __DIR__ . '/../functions/sessions/session.php';

// Recebe ID do agendamento
$data = json_decode(file_get_contents('php://input'), true);
$scheduleId = $data['id'] ?? null;

if (!$scheduleId) {
  echo json_encode([
    'success' => false,
    'message' => 'ID do agendamento não informado'
  ]);
  exit;
}

$controller = new ScheduleController($pdo);
$result = $controller->cancel($scheduleId);

echo json_encode($result);
