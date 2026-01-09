<?php
require_once __DIR__ . "/../../config/conection.php";


function validateServiceData(array $data)
{
  global $pdo;

  // Pega banco_id da sessão
  $bank_id = $_SESSION['bank_id'] ?? null;
  if (!$bank_id) {
    return 'Banco não identificado. Faça login novamente';
  }

  $code = trim($data['service_code']);
  $name = trim($data['service_name']);

  // Verifica campos obrigatórios
  if (empty($code) || empty($name)) {
    return 'Preencha todos os campos obrigatórios';
  }
  // Verifica se já existe serviço com mesmo código ou nome no mesmo banco
  $stmt = $pdo->prepare(
    "SELECT id
         FROM servicos
         WHERE banco_id = :banco_id
           AND (codigo = :codigo OR nome = :nome)
         LIMIT 1"
  );
  $stmt->execute([
    ':banco_id' => $bank_id,
    ':codigo' => $code,
    ':nome' => $name
  ]);

  if ($stmt->fetch()) {
    return 'Já existe um serviço com esse código ou nome neste banco';
  }

  return true;
}
