<?php
require_once __DIR__ . "/../model/bank/Bank.php";
require_once __DIR__ . "/../functions/validations/bankValidation.php";;

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

