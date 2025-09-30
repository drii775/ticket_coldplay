-- Buat database
CREATE DATABASE IF NOT EXISTS db_coldplay;
USE db_coldplay;

-- CREATE TABLE tiket (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     nama VARCHAR(100),
--     email VARCHAR(100),
--     telepon VARCHAR(20),
--     kategori VARCHAR(50),
--     kursi VARCHAR(10),
--     tanggal DATE,
--     harga DECIMAL(10,2),
--     kode VARCHAR(20)
-- );

-- Tabel kategori tiket
CREATE TABLE kategori_tiket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL,
    harga INT NOT NULL
);

-- Isi data kategori tiket
INSERT INTO kategori_tiket (nama_kategori, harga) VALUES
('Festival', 1500000),
('Silver', 3500000),
('Gold', 5500000),
('VIP', 8500000);

-- Tabel kursi
CREATE TABLE kursi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_kursi VARCHAR(5) NOT NULL,
    status ENUM('tersedia', 'terisi') DEFAULT 'tersedia',
    kategori_id INT,
    FOREIGN KEY (kategori_id) REFERENCES kategori_tiket(id)
);

-- Generate contoh kursi (A1–H8) untuk kategori Festival
-- (opsional, bisa tambahin script generate dengan loop di backend)
INSERT INTO kursi (nomor_kursi, kategori_id) VALUES
('A1', 1), ('A2', 1), ('A3', 1), ('A4', 1), ('A5', 1), ('A6', 1), ('A7', 1), ('A8', 1),
('B1', 1), ('B2', 1), ('B3', 1), ('B4', 1), ('B5', 1), ('B6', 1), ('B7', 1), ('B8', 1),
('C1', 1), ('C2', 1), ('C3', 1), ('C4', 1), ('C5', 1), ('C6', 1), ('C7', 1), ('C8', 1),
('D1', 1), ('D2', 1), ('D3', 1), ('D4', 1), ('D5', 1), ('D6', 1), ('D7', 1), ('D8', 1),
('E1', 1), ('E2', 1), ('E3', 1), ('E4', 1), ('E5', 1), ('E6', 1), ('E7', 1), ('E8', 1),
('F1', 1), ('F2', 1), ('F3', 1), ('F4', 1), ('F5', 1), ('F6', 1), ('F7', 1), ('F8', 1),
('G1', 1), ('G2', 1), ('G3', 1), ('G4', 1), ('G5', 1), ('G6', 1), ('G7', 1), ('G8', 1),
('H1', 1), ('H2', 1), ('H3', 1), ('H4', 1), ('H5', 1), ('H6', 1), ('H7', 1), ('H8', 1);

-- Tabel pembeli
CREATE TABLE pembeli (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telepon VARCHAR(20) NOT NULL
);

-- Tabel tiket
ALTER TABLE tiket 
  CHANGE kursi_id kursi VARCHAR(20),
  CHANGE kategori_id kategori VARCHAR(50);
