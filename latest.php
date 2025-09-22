<?php
header('Content-Type: application/json');
require __DIR__.'/db.php';

$row = $pdo->query("SELECT ts, value_raw AS raw, value_v AS volts
                    FROM pot_samples ORDER BY id DESC LIMIT 1")->fetch();
echo json_encode($row ?: []);
