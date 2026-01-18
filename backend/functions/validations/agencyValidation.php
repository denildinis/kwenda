<?php
require_once __DIR__ . "/../../config/conection.php";

function validateAgencyData(array $data)
{
  // Sessão
  $bank_id = $_SESSION['bank_id'] ?? null;
  if (!$bank_id) {
    return 'Banco não identificado. Faça login novamente';
  }

  // Agência
  if (empty($data['agency_name'])) {
    return 'O nome da agência é obrigatório';
  }

  // Endereço
  $required = ['province', 'municipality', 'neighborhood', 'street'];
  foreach ($required as $field) {
    if (empty($data[$field])) {
      return 'Preencha todos os campos do endereço';
    }
  }

  return true;
}
