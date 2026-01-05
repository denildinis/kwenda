<?php
require_once __DIR__ . "/../model/service/Service.php";
require_once __DIR__ . "/../functions/validations/serviceValidation.php";
function registerService($data)
{
  $validation = validateServiceData($data);

  if ($validation !== true) {
    return [
      'success' => false,
      'message' => $validation
    ];
  }

  $service = new Service();

  $created = $service->create($data);
  return [
    'success' => $created
  ];
}

