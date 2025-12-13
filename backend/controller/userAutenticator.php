<?php
require_once("../model/auth/UserAutenticator.php");
require_once("../functions/validations/credentials.php");

function authenticateUser($email, $password)
{
  $check = check_credentials($email, $password)["success"];
  if (!$check) {
    return json_encode(["success" => false, "message" => "Verifique as suas credenciais e tente novamente"]);
  }
  $auth = new UserAutenticator();
  $auth_result = $auth->authenticateUser($email, $password);
  if (!$auth_result["success"]) {
    return json_encode($auth_result);
  }
  return json_encode($auth_result);
}
