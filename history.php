<?php
header('Content-Type: application/json');
require __DIR__.'/db.php';

$minutes = isset($_GET['minutes']) ? max(1, (int)$_GET['minutes']) : 5;

$sql = "SELECT 
          FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(ts)/1)*1) AS ts,
          AVG(value_v) AS volts,
          AVG(value_raw) AS raw
        FROM pot_samples
        WHERE ts >= NOW() - INTERVAL :m MINUTE
        GROUP BY FLOOR(UNIX_TIMESTAMP(ts)/1)
        ORDER BY ts";
$stmt = $pdo->prepare($sql);
$stmt->execute([':m'=>$minutes]);
echo json_encode($stmt->fetchAll());
