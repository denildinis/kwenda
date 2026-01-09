<?php
require_once __DIR__ . '/../../config/conection.php';

class Service
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

      $bank_id = $_SESSION['bank_id'] ?? null;

      if (!$bank_id) {
        return false;
      }
      $code = trim($data['service_code']);
      $name = trim($data['service_name']);

      $sql = "INSERT INTO servicos (banco_id, codigo, nome)
                    VALUES (:banco_id, :codigo, :nome)";

      $stmt = $this->pdo->prepare($sql);
      return $stmt->execute([
        ':banco_id' => $bank_id,
        ':codigo' => $code,
        ':nome' => $name
      ]);
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    }
  }
}
