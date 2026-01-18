<?php
class Schedule
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function create($data)
  {
    $stmt = $this->pdo->prepare("
      INSERT INTO agendamentos
      (cliente_id, banco_id, agencia_id, servico_id, data_agendamento, senha, status)
      VALUES (?, ?, ?, ?, ?, ?, 'pendente')
    ");

    return $stmt->execute([
      $data['cliente_id'],
      $data['bank'],
      $data['agency'],
      $data['service'],
      $data['date'],
      $data['senha']
    ]);
  }

  public function findById($id)
  {
    $stmt = $this->pdo->prepare("
      SELECT a.*, c.nome
      FROM agendamentos a
      JOIN clientes c ON c.id = a.cliente_id
      WHERE a.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function attendSchedule($id)
  {
    // Verifica se o agendamento existe
    $stmt = $this->pdo->prepare("SELECT status FROM agendamentos WHERE id = ?");
    $stmt->execute([$id]);
    $schedule = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$schedule) {
      return [
        'success' => false,
        'message' => 'Agendamento não encontrado'
      ];
    }

    if ($schedule['status'] === 'atendido') {
      return [
        'success' => false,
        'message' => 'Agendamento já foi atendido'
      ];
    }

    // Atualiza o status para "atendido"
    $stmt = $this->pdo->prepare("
        UPDATE agendamentos
        SET status = 'atendido'
        WHERE id = ?
    ");

    $updated = $stmt->execute([$id]);

    return [
      'success' => $updated,
      'message' => $updated ? 'Agendamento atendido com sucesso' : 'Erro ao atender agendamento'
    ];
  }

  public function cancelSchedule($id)
  {
    // Verifica se existe o agendamento
    $stmt = $this->pdo->prepare("SELECT id, status FROM agendamentos WHERE id = ?");
    $stmt->execute([$id]);
    $schedule = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$schedule) {
      return ['success' => false, 'message' => 'Agendamento não encontrado'];
    }

    if ($schedule['status'] === 'cancelado') {
      return ['success' => false, 'message' => 'Agendamento já foi cancelado'];
    }

    // Atualiza status para cancelado
    $stmt = $this->pdo->prepare("
            UPDATE agendamentos
            SET status = 'cancelado'
            WHERE id = ?
        ");
    $updated = $stmt->execute([$id]);

    return [
      'success' => $updated,
      'message' => $updated ? 'Agendamento cancelado com sucesso' : 'Erro ao cancelar agendamento'
    ];
  }
}
