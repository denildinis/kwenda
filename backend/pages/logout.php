<?php
session_start();

// Limpa todas as variáveis da sessão
$_SESSION = [];

// Destroi a sessão
session_destroy();

// Redireciona para login
header('Location: /kwenda/frontend/pages/entrar/index.php');
exit;
