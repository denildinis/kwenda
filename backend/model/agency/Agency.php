<?php
require_once __DIR__ . '/../../config/conection.php';

class Agency
{
  private $pdo;

  public function __construct()
  {
    global $pdo;
    $this->pdo = $pdo;
  }

  public function create($data)
  {
    try {
      $this->pdo->beginTransaction();

      $bank_id = $_SESSION['bank_id'];

      // Endereço
      $stmtAddress = $this->pdo->prepare("
        INSERT INTO enderecos (provincia, municipio, bairro, rua)
        VALUES (:provincia, :municipio, :bairro, :rua)
      ");

      $stmtAddress->execute([
        ':provincia' => trim($data['province']),
        ':municipio' => trim($data['municipality']),
        ':bairro' => trim($data['neighborhood']),
        ':rua' => trim($data['street']),
      ]);

      $endereco_id = $this->pdo->lastInsertId();

      // Agência
      $stmtAgency = $this->pdo->prepare("
        INSERT INTO agencias (banco_id, nome, endereco_id)
        VALUES (:banco_id, :nome, :endereco_id)
      ");

      $stmtAgency->execute([
        ':banco_id' => $bank_id,
        ':nome' => trim($data['agency_name']),
        ':endereco_id' => $endereco_id
      ]);

      $this->pdo->commit();
      return true;

    } catch (PDOException $e) {
      $this->pdo->rollBack();
      error_log($e->getMessage());
      return false;
    }
  }
}
