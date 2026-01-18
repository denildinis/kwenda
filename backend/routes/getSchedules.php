<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/conection.php';
require_once __DIR__ . '/../functions/sessions/session.php';

verifySession();

if ($_SESSION['role'] !== 'banco') {
  echo json_encode([]);
  exit;
}

$bank_id = $_SESSION['bank_id'] ?? null;
if (!$bank_id) {
  echo json_encode([]);
  exit;
}

$stmt = $pdo->prepare("
    SELECT
        ag.id,
        ag.cliente_id,
        ag.agencia_id,
        ag.servico_id,
        ag.data_agendamento,
        ag.senha,
        ag.status,
        ag.created_at,
        c.nome AS cliente_nome,
        a.nome AS agencia_nome,
        s.nome AS servico_nome,
        e.provincia,
        e.municipio,
        e.bairro,
        e.rua
    FROM agendamentos ag
    LEFT JOIN clientes c ON ag.cliente_id = c.id
    LEFT JOIN agencias a ON ag.agencia_id = a.id
    LEFT JOIN enderecos e ON a.endereco_id = e.id
    LEFT JOIN servicos s ON ag.servico_id = s.id
    WHERE ag.banco_id = :bank_id AND ag.status = 'pendente'
    ORDER BY ag.created_at ASC
");

$stmt->execute([':bank_id' => $bank_id]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($appointments);
