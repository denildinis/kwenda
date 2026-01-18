<?php
class Client
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function create($name)
  {
    $stmt = $this->pdo->prepare(
      "INSERT INTO clientes (nome) VALUES (?)"
    );
    $stmt->execute([$name]);

    return $this->pdo->lastInsertId();
  }
}
