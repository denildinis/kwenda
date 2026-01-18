<?php

session_start();

function redirectIfLogged()
{
  if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] === 'admin') {
      header('Location: /kwenda/frontend/pages/cadastrar-banco/index.php');
      exit;
    }

    if ($_SESSION['role'] === 'banco') {
      header('Location: /kwenda/frontend/pages/listar-agendamentos/index.php');
      exit;
    }
  }
}
function verifySession()
{
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('Location: /kwenda/frontend/pages/entrar/index.php');
    exit;
  }
}

