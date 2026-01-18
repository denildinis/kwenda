<?php
require_once __DIR__ . '/../config/conection.php';
require_once __DIR__ . '/../lib/fpdf/fpdf.php';

/* Evita qualquer saída antes do PDF */
ob_start();

/* ================= VALIDAR ID ================= */
$id = $_GET['id'] ?? null;
if (!$id) {
  die('Agendamento inválido');
}

/* ================= BUSCAR DADOS ================= */
$sql = "
SELECT
  a.data_agendamento,
  a.senha,
  c.nome AS cliente,
  b.nome AS banco,
  ag.nome AS agencia,
  s.nome AS servico
FROM agendamentos a
JOIN clientes c ON c.id = a.cliente_id
JOIN bancos b ON b.id = a.banco_id
JOIN agencias ag ON ag.id = a.agencia_id
JOIN servicos s ON s.id = a.servico_id
WHERE a.id = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
  die('Agendamento não encontrado');
}

ob_end_clean();

$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image(__DIR__ . '/../../frontend/assets/images/logo-2.png', 10, 10, 30);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('Comprovativo de agendamento'), 0, 1, 'C');

$pdf->Ln(5);
$pdf->Line(10, 35, 200, 35);
$pdf->Ln(10);

function row($label, $value, $pdf)
{
  $pdf->SetFont('Arial', 'B', 11);
  $pdf->Cell(40, 8, utf8_decode($label . ':'), 0, 0);

  $pdf->SetFont('Arial', '', 11);
  $pdf->Cell(0, 8, utf8_decode($value), 0, 1);
}

row('Cliente', $data['cliente'], $pdf);
row('Banco', $data['banco'], $pdf);
row('Agência', $data['agencia'], $pdf);
row('Serviço', $data['servico'], $pdf);
row(
  'Data',
  date('d/m/Y', strtotime($data['data_agendamento'])),
  $pdf
);

$pdf->Ln(10);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, utf8_decode('SENHA'), 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 28);
$pdf->Cell(0, 15, utf8_decode($data['senha']), 0, 1, 'C');

$pdf->Ln(10);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 8, utf8_decode('Emitido em: ' . date('d/m/Y H:i')), 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('Kwenda - Sistema de Agendamento Bancário'), 0, 1, 'C');

$pdf->Output('I', 'comprovativo.pdf');
exit;
