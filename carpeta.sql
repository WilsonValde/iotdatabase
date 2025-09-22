-- Crea la base de datos
CREATE DATABASE IF NOT EXISTS iotdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE iotdb;

-- Tabla para muestras del potenciómetro
CREATE TABLE IF NOT EXISTS pot_samples (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  ts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  value_raw INT NOT NULL,           -- 0..4095 (ESP32 12 bits)
  value_v   DECIMAL(6,3) NOT NULL,  -- voltaje estimado (0..3.300)
  PRIMARY KEY (id),
  KEY idx_ts (ts)
);
