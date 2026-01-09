<?php
require_once __DIR__ . '/../../config/conection.php';

session_start();

class UserAuthenticator
{
  public function authenticateUser($email, $password)
  {
    global $pdo;

    $stmt = $pdo->prepare("
            SELECT id, email, senha, role, banco_id
            FROM usuarios
            WHERE email = ?
            LIMIT 1
        ");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
      return ['success' => false, 'message' => 'Erro, este usuário não existe'];
    }

    if (!password_verify($password, $user['senha'])) {
      return ['success' => false, 'message' => 'Senha incorreta'];
    }

    // Define sessão
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];

    // Só define bank_id se o usuário for do tipo banco
    if ($user['role'] === 'banco') {
      $_SESSION['bank_id'] = $user['banco_id'];
    }

    return [
      'success' => true,
      'role' => $user['role'],
      'message' => 'Login realizado com sucesso!'
    ];
  }
}
