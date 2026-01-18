<?php
require_once __DIR__ . "/../model/bank/Bank.php";
require_once __DIR__ . "/../functions/validations/bankValidation.php";
;

function registerBank($data, $files)
{
  $validation = validateBankData($data, $files);

  if ($validation !== true) {
    return json_encode([
      'success' => false,
      'message' => $validation
    ]);
  }

  $bank = new Bank();

  $logo = 'placeholder.png';

  if (!empty($files['photo']) && $files['photo']['error'] === 0) {
    $logo = $bank->uploadLogo($files['photo']);
  }

  $created = $bank->create([
    'name' => $data['name'],
    'acronym' => $data['acronym'],
    'email' => $data['email'],
    'password' => $data['password'],
    'logo' => $logo
  ]);

  return json_encode([
    'success' => $created
  ]);
}

function deleteBank($data)
{
  if (empty($data['id'])) {
    return json_encode([
      'success' => false,
      'message' => 'ID do banco não informado'
    ]);
  }

  $bank = new Bank();
  $id = (int) $data['id'];

  if (!$bank->exists($id)) {
    return json_encode([
      'success' => false,
      'message' => 'Banco não encontrado'
    ]);
  }

  $deleted = $bank->delete($id);

  return json_encode([
    'success' => $deleted,
    'message' => $deleted
      ? 'Banco eliminado com sucesso'
      : 'Erro ao eliminar banco'
  ]);
}

function getBank($id)
{
  if (empty($id)) {
    return json_encode([
      'success' => false,
      'message' => 'ID do banco não informado'
    ]);
  }

  $bank = new Bank();
  $data = $bank->find((int) $id);

  if (!$data) {
    return json_encode([
      'success' => false,
      'message' => 'Banco não encontrado'
    ]);
  }

  return json_encode([
    'success' => true,
    'data' => $data
  ]);
}
function updateBank($data, $files)
{
  if (empty($data['id'])) {
    return json_encode([
      'success' => false,
      'message' => 'ID do banco não informado'
    ]);
  }

  $bank = new Bank();
  $id = (int) $data['id'];

  if (!$bank->exists($id)) {
    return json_encode([
      'success' => false,
      'message' => 'Banco não encontrado'
    ]);
  }

  // Logo padrão (atual ou placeholder)
  $logo = $data['current_logo'] ?? 'placeholder.png';
  if (!empty($files['photo']) && $files['photo']['error'] === 0) {
    $logo = $bank->uploadLogo($files['photo']);
  }

  // Monta array de atualização
  $updateData = [
    'name' => $data['name'],
    'acronym' => $data['acronym'],
    'email' => $data['email'],
    'logo' => $logo
  ];

  $updated = $bank->update($id, $updateData);

  if ($updated) {
    global $pdo;
    // Atualiza usuário
    $updateUser = ["email = ?"];
    $params = [$data['email']];
    if (!empty($data['password'])) {
      $updateUser[] = "senha = ?";
      $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
    }
    $params[] = $id;
    $stmt = $pdo->prepare("UPDATE usuarios SET " . implode(', ', $updateUser) . " WHERE banco_id = ?");
    $stmt->execute($params);
  }

  return json_encode([
    'success' => $updated,
    'message' => $updated
      ? 'Banco atualizado com sucesso'
      : 'Erro ao atualizar banco'
  ]);
}
