<?php
header('Content-Type: application/json');
require __DIR__.'/db.php';

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (!$data || !isset($data['raw'])) {
  http_response_code(400);
  echo json_encode(['ok'=>false,'error'=>'JSON {"raw": <0..4095>} requerido']);
  exit;
}

$raw = (int)$data['raw'];
if ($raw < 0) $raw = 0;
if ($raw > 4095) $raw = 4095;

// VREF: ajusta si calibras tu ADC
$vref = 3.30;
$volts = round(($raw / 4095.0) * $vref, 3);

$stmt = $pdo->prepare("INSERT INTO pot_samples (value_raw, value_v) VALUES (?, ?)");
$stmt->execute([$raw, $volts]);

echo json_encode(['ok'=>true, 'raw'=>$raw, 'volts'=>$volts]);
