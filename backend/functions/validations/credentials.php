<?php
/*
strlen:string length
count:array length
str_contains: like the JS "includes" function
filter_var($var,filter_type): validar/sanitizar variáveis
*/
function check_email($email)
{
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $email_length = strlen($email);
  $min_length = 8;
  $max_length = 30;

  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    return false;

  if ($email_length < $min_length || $email_length > $max_length)
    return false;

  return true;
}

function check_password($password)
{
  $password = trim($password);
  $password = filter_var($password, FILTER_SANITIZE_EMAIL);
  $min_length = 8;
  $max_length = 20;
  $pass_length = strlen($password);

  if ($pass_length < $min_length || $pass_length > $max_length)
    return false;

  if (str_contains($password, " "))
    return false;

  return true;
}

//função de verificação principal para login:
function check_credentials($email, $password)
{
  return check_password($password) && check_email($email) ?
    ["success" => true, "message" => "Credenciais verificadas com sucesso"] :
    ["success" => false, "message" => "Verifique as suas credenciais"];
}
