<?php
require_once __DIR__ . '/../model/client/Client.php';
require_once __DIR__ . '/../model/schedule/Schedule.php';

class ScheduleController
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  private function generatePassword()
  {
    return strtoupper(substr(uniqid(), -6));
  }

  public function store($data)
  {
    if (
      empty($data['bank']) ||
      empty($data['agency']) ||
      empty($data['service']) ||
      empty($data['date']) ||
      empty($data['name'])
    ) {
      return ['success' => false, 'message' => 'Campos inválidos'];
    }

    $this->pdo->beginTransaction();

    try {
      $client = new Client($this->pdo);
      $schedule = new Schedule($this->pdo);

      $clienteId = $client->create($data['name']);
      $senha = $this->generatePassword();

      $schedule->create([
        'cliente_id' => $clienteId,
        'bank' => $data['bank'],
        'agency' => $data['agency'],
        'service' => $data['service'],
        'date' => $data['date'],
        'senha' => $senha
      ]);

      $scheduleId = $this->pdo->lastInsertId();

      $this->pdo->commit();

      return [
        'success' => true,
        'schedule_id' => $scheduleId
      ];
    } catch (Exception $e) {
      $this->pdo->rollBack();
      return ['success' => false, 'message' => 'Erro ao agendar'];
    }
  }
}
