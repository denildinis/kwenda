<?php
require_once("../config/conection.php");
header("content-type: application/json");
class UserAutenticator
{

  private $email;
  private $password;

  public function authenticateUser($email, $password)
  {

    global $pdo;

    $this->email = $email;
    $this->password = $password;

    $stmt = $pdo->prepare("SELECT tipo_usuario.nome as role, usuarios.senha, usuarios.email FROM usuarios JOIN tipo_usuario on usuarios.id_tipo_usuario = tipo_usuario.id WHERE usuarios.email = ?");
    $stmt->execute([$this->email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      if (password_verify($this->password, $user['senha'])) {
        session_start();

        //$_SESSION['id']   = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'Escola') {
          //retorna o usuário logado para a tela de admnistrador...
          return ['success' => true, 'role' => $user['role'], 'message' => 'Login realizado com sucesso!', 'redirect' => './adminPage.php'];
        }
        //retorna o usuário logado para a tela de empresas...
        return ['success' => true, 'role' => $user['role'], 'message' => 'Login realizado com sucesso!', 'redirect' => './companyPage.php'];
      }
      //retonra a mensagem de erro dizendo que a senha está incorreta...
      return ['success' => false, 'message' => 'Senha incorreta, tente novamente!'];
    }
    //retorna mensagem de erro dizendo que este usuário não existe...
    return ['success' => false, 'message' => 'Erro, este usuário não existe'];
  }
}
