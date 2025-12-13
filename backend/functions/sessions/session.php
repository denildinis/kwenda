<?php
//inclua esse arquivo em suas páginas protegidas...
session_start();

//$userId = $_SESSION['id'] ?? null;
$userRole = $_SESSION['role'] ?? null;

$currentPage = basename($_SERVER['SCRIPT_NAME'], '.php');

//redirecionar usuário não logado para a página de login...
if (!$userRole) {
  header('Location: ./login.php');
  exit;
}

//se tiver na página de login e tiver um usuário logado, lhe redirecionar para a sua página com base no tipo de usuário...
if ($currentPage === 'login') {

  if ($userRole == 'Escola') {
    header('Location: ./adminPage.php');
  } else {
    header('Location: ./companyPage.php');
  }
  exit;
}
