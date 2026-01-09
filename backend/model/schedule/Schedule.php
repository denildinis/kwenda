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
}
