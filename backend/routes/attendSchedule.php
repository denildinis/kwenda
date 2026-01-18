<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/conection.php';
require_once __DIR__ . '/../controller/ScheduleController.php';
require_once __DIR__ . '/../functions/sessions/session.php';

// Verifica se o usuário está logado
verifySession();

// Recebe o ID do agendamento do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);
$scheduleId = $data['id'] ?? null;

if (!$scheduleId) {
  echo json_encode([
    'success' => false,
    'message' => 'ID do agendamento não informado'
  ]);
  exit;
}

// Cria instância do controller
$controller = new ScheduleController($pdo);

// Marca o agendamento como atendido
$result = $controller->attend($scheduleId);

if ($result['success']) {
  // Busca a senha do agendamento
  $stmt = $pdo->prepare("SELECT senha FROM agendamentos WHERE id = ?");
  $stmt->execute([$scheduleId]);
  $senha = $stmt->fetchColumn();

  $result['senha'] = $senha; // adiciona a senha no resultado
}

// Retorna JSON para o frontend
echo json_encode($result);
