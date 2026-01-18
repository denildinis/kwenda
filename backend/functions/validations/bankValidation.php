<?php

require_once __DIR__ . "/credentials.php";
require_once __DIR__ . "/../../config/conection.php";

function validateBankData($data, $files)
{
  global $pdo; // pega a conexão PDO

  // Verificar campos obrigatórios
  if (
    empty($data['name']) ||
    empty($data['acronym']) ||
    empty($data['email']) ||
    empty($data['password'])
  ) {
    return 'Preencha todos os campos obrigatórios';
  }

  // Validar e-mail usando a função do credentials.php
  if (!check_email($data['email'])) {
    return 'E-mail inválido';
  }

  // Validar senha usando a função do credentials.php
  if (!check_password($data['password'])) {
    return 'A senha deve atender aos critérios de validação';
  }

  // Verificar se o email já existe
  $stmt = $pdo->prepare("SELECT id FROM bancos WHERE email = ?");
  $stmt->execute([$data['email']]);
  if ($stmt->rowCount() > 0) {
    return 'Este e-mail já está cadastrado';
  }

  // Validar foto (se fornecida)
  if (!empty($files['photo']) && $files['photo']['error'] === 0) {
    $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

    if (!in_array($files['photo']['type'], $allowedTypes)) {
      return 'A foto deve ser PNG ou JPEG';
    }
  }

  return true;
}
