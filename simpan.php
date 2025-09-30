<?php
// Koneksi ke database MySQL (db_coldplay)
$conn = new mysqli("127.0.0.1", "root", "", "db_coldplay");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form dengan validasi
$nama     = $conn->real_escape_string($_POST['nama']);
$email    = $conn->real_escape_string($_POST['email']);
$telepon  = $conn->real_escape_string($_POST['telepon']);
$kategori = $conn->real_escape_string($_POST['kategori']);
$kursi    = $conn->real_escape_string($_POST['kursi']);
$tanggal  = $conn->real_escape_string($_POST['tanggal']);
$harga    = $conn->real_escape_string($_POST['harga']);
$kode     = $conn->real_escape_string($_POST['kode']);

// Simpan pembeli
$sql_pembeli = "INSERT INTO pembeli (nama, email, telepon) 
                VALUES ('$nama', '$email', '$telepon')";

if ($conn->query($sql_pembeli) === TRUE) {
    $pembeli_id = $conn->insert_id;
    
    // Simpan tiket
    $sql_tiket = "INSERT INTO tiket (pembeli_id, kursi, kategori, tanggal_konser, kode_tiket)
                  VALUES ($pembeli_id, '$kursi', '$kategori', '$tanggal', '$kode')";
    
    if ($conn->query($sql_tiket) === TRUE) {
        // Update status kursi menjadi terisi
        $conn->query("UPDATE kursi SET status='terisi' WHERE nomor_kursi='$kursi'");
        
        echo "<!DOCTYPE html>
        <html lang='id'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Pemesanan Berhasil</title>
            <style>
                body { 
                    font-family: 'Inter', sans-serif; 
                    background: linear-gradient(135deg, #0a0e27 0%, #1a1d3f 50%, #2a1b3d 100%);
                    color: white;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                    margin: 0;
                }
                .container {
                    background: rgba(255,255,255,0.05);
                    backdrop-filter: blur(10px);
                    border: 1px solid rgba(255,255,255,0.1);
                    border-radius: 20px;
                    padding: 40px;
                    max-width: 500px;
                    text-align: center;
                }
                h2 { 
                    background: linear-gradient(90deg, #ffd700, #87ceeb);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    margin-bottom: 20px;
                }
                .info { 
                    background: rgba(255,255,255,0.05);
                    padding: 20px;
                    border-radius: 10px;
                    margin: 20px 0;
                    text-align: left;
                }
                .info p { margin: 10px 0; }
                .kode { 
                    font-size: 1.5em;
                    font-weight: bold;
                    color: #87ceeb;
                    letter-spacing: 2px;
                }
                a { 
                    display: inline-block;
                    margin-top: 20px;
                    padding: 12px 30px;
                    background: linear-gradient(135deg, #87ceeb, #90ee90);
                    color: #0a0e27;
                    text-decoration: none;
                    border-radius: 10px;
                    font-weight: 600;
                }
                a:hover { transform: scale(1.05); }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>🎉 Tiket Berhasil Dipesan!</h2>
                <div class='info'>
                    <p><strong>Nama:</strong> $nama</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Kategori:</strong> $kategori</p>
                    <p><strong>Kursi:</strong> $kursi</p>
                    <p><strong>Kode Tiket:</strong> <span class='kode'>$kode</span></p>
                </div>
                <a href='index.html'>🎫 Pesan Tiket Lagi</a>
            </div>
        </body>
        </html>";
    } else {
        echo "Error saat menyimpan tiket: " . $conn->error;
    }
} else {
    echo "Error saat menyimpan pembeli: " . $conn->error;
}

$conn->close();
?>