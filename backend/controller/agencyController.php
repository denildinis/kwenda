<?php
require_once __DIR__ . '/../model/agency/Agency.php';
require_once __DIR__ . '/../functions/validations/agencyValidation.php';

function registerAgency($data)
{
  $validation = validateAgencyData($data);

  if ($validation !== true) {
    return [
      'success' => false,
      'message' => $validation
    ];
  }

  $agency = new Agency();
  $created = $agency->create($data);

  if (!$created) {
    return [
      'success' => false,
      'message' => 'Erro ao cadastrar agência'
    ];
  }

  return [
    'success' => true,
    'message' => 'Agência cadastrada com sucesso'
  ];
}
