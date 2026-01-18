<?php
require_once __DIR__ . '/../../config/conection.php';

class Bank
{
  private $pdo;

  public function __construct()
  {
    global $pdo;
    $this->pdo = $pdo;
  }

  public function create($data)
  {
    try {
      $this->pdo->beginTransaction();

      // Criar banco
      $stmtBank = $this->pdo->prepare("
        INSERT INTO bancos (nome, sigla, email, logo)
        VALUES (?, ?, ?, ?)
      ");

      $stmtBank->execute([
        $data['name'],
        $data['acronym'],
        $data['email'],
        $data['logo']
      ]);

      $bancoId = $this->pdo->lastInsertId();

      // Criar usuário do banco
      $stmtUser = $this->pdo->prepare("
        INSERT INTO usuarios (email, senha, role, banco_id)
        VALUES (?, ?, 'banco', ?)
      ");

      $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

      $stmtUser->execute([
        $data['email'],
        $hashedPassword,
        $bancoId
      ]);

      $this->pdo->commit();
      return true;

    } catch (Exception $e) {
      $this->pdo->rollBack();
      return false;
    }
  }

  public function uploadLogo($file)
  {
    $folder = __DIR__ . "/../../../frontend/assets/uploads/banks/";

    if (!is_dir($folder)) {
      mkdir($folder, 0777, true);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $name = uniqid() . '.' . $ext;

    if (move_uploaded_file($file['tmp_name'], $folder . $name)) {
      return $name;
    }

    return 'placeholder.png';
  }
  public function delete($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM bancos WHERE id = ?");
    return $stmt->execute([$id]);
  }

  public function exists($id)
  {
    $stmt = $this->pdo->prepare("SELECT id FROM bancos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() ? true : false;
  }

  public function find($id)
  {
    $stmt = $this->pdo->prepare("
    SELECT id, nome, sigla, email, logo
    FROM bancos
    WHERE id = ?
  ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($id, $data)
  {
    $sql = "UPDATE bancos SET nome = ?, sigla = ?, email = ?";
    $params = [$data['name'], $data['acronym'], $data['email']];

    if (!empty($data['logo'])) {
      $sql .= ", logo = ?";
      $params[] = $data['logo'];
    }

    if (!empty($data['password'])) {
      $sql .= ", password = ?";
      $params[] = $data['password'];
    }

    $sql .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($params);
  }

}
