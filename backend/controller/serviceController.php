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

function deleteService($data)
{
  if (empty($data['id'])) {
    return json_encode([
      'success' => false,
      'message' => 'ID do serviço não informado'
    ]);
  }

  $service= new Service();
  $id = (int) $data['id'];

  if (!$service->exists($id)) {
    return json_encode([
      'success' => false,
      'message' => 'Serviço não encontrado'
    ]);
  }

  $deleted = $service->delete($id);

  return json_encode([
    'success' => $deleted,
    'message' => $deleted
      ? 'Serviço eliminado com sucesso'
      : 'Erro ao eliminar serviço'
  ]);
}
