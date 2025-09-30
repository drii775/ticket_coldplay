<?php
// Tambahkan ini di LINE 1
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission langsung dari index.php
    require_once 'simpan.php';
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coldplay Concert Ticket</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0a0e27 0%, #1a1d3f 50%, #2a1b3d 100%);
            color: #ffffff;
            min-height: 100vh;
            padding: 20px;
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            animation: twinkle 3s infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            font-size: 3em;
            margin-bottom: 10px;
            background: linear-gradient(90deg, #ffd700, #87ceeb, #90ee90, #ff69b4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            letter-spacing: 3px;
        }

        .concert-info {
            color: #a0a0a0;
            font-size: 1.1em;
            margin-top: 10px;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        @media (max-width: 968px) {
            .content { grid-template-columns: 1fr; }
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 35px;
        }

        .section-title {
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 25px;
            background: linear-gradient(90deg, #ffd700, #87ceeb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 35px;
        }

        .step {
            flex: 1;
            text-align: center;
        }

        .step-num {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            margin: 0 auto 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #888;
            transition: all 0.3s;
        }

        .step.active .step-num {
            background: linear-gradient(135deg, #87ceeb, #90ee90);
            border-color: #87ceeb;
            color: #0a0e27;
            transform: scale(1.1);
        }

        .step-label {
            color: #888;
            font-size: 0.85em;
            font-weight: 500;
        }

        .step.active .step-label {
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #e0e0e0;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95em;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1.5px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            color: #ffffff;
            font-size: 1em;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #87ceeb;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 0 3px rgba(135, 206, 235, 0.1);
        }

        input::placeholder {
            color: #666;
        }

        .price-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .price-card {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .price-card:hover {
            transform: translateY(-5px);
            border-color: rgba(135, 206, 235, 0.5);
            background: rgba(255, 255, 255, 0.08);
        }

        .price-card.selected {
            border-color: #87ceeb;
            background: rgba(135, 206, 235, 0.15);
            box-shadow: 0 8px 25px rgba(135, 206, 235, 0.25);
        }

        .price-class {
            font-size: 1em;
            font-weight: 700;
            margin-bottom: 8px;
            color: #e0e0e0;
        }

        .price-amount {
            font-size: 1.6em;
            font-weight: 800;
            background: linear-gradient(135deg, #ffd700, #87ceeb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .seat-grid {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 10px;
            margin-top: 15px;
        }

        .seat {
            aspect-ratio: 1;
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.85em;
            cursor: pointer;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.05);
        }

        .seat:hover:not(.occupied) {
            border-color: #87ceeb;
            transform: scale(1.08);
            background: rgba(135, 206, 235, 0.1);
        }

        .seat.selected {
            background: linear-gradient(135deg, #87ceeb, #90ee90);
            border-color: #87ceeb;
            color: #0a0e27;
            font-weight: 700;
        }

        .seat.occupied {
            background: rgba(255, 255, 255, 0.03);
            color: #555;
            cursor: not-allowed;
            opacity: 0.4;
        }

        .legend {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 15px;
            font-size: 0.85em;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .legend-box {
            width: 20px;
            height: 20px;
            border-radius: 5px;
            border: 2px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.05);
        }

        .legend-box.selected {
            background: linear-gradient(135deg, #87ceeb, #90ee90);
            border-color: #87ceeb;
        }

        .legend-box.occupied {
            background: rgba(255, 255, 255, 0.03);
            opacity: 0.4;
        }

        .btn {
            padding: 14px 28px;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, #87ceeb, #90ee90);
            color: #0a0e27;
            width: 100%;
            box-shadow: 0 8px 20px rgba(135, 206, 235, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(135, 206, 235, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            width: 48%;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .btn-print {
            background: linear-gradient(135deg, #ffd700, #ff69b4);
            color: #0a0e27;
            width: 48%;
        }

        .button-group {
            display: flex;
            gap: 4%;
            margin-top: 20px;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
            animation: slideIn 0.4s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-15px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .ticket {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .ticket-header {
            background: linear-gradient(135deg, #1a1d3f, #2a1b3d);
            padding: 35px;
            text-align: center;
            border-bottom: 2px dashed rgba(255, 255, 255, 0.15);
        }

        .ticket-artist {
            font-size: 2.5em;
            font-weight: 800;
            background: linear-gradient(90deg, #ffd700, #87ceeb, #90ee90, #ff69b4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }

        .ticket-code {
            font-size: 1.3em;
            font-weight: 700;
            letter-spacing: 3px;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 10px;
        }

        .ticket-body {
            padding: 30px;
        }

        .ticket-info {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 12px 20px;
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: 600;
            color: #87ceeb;
            font-size: 0.9em;
        }

        .info-value {
            color: #e0e0e0;
            font-weight: 500;
        }

        .divider {
            border: none;
            border-top: 2px dashed rgba(255, 255, 255, 0.15);
            margin: 20px 0;
        }

        .total-box {
            background: rgba(135, 206, 235, 0.1);
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            border: 1px solid rgba(135, 206, 235, 0.2);
        }

        .total-label {
            font-size: 1em;
            font-weight: 600;
            color: #e0e0e0;
        }

        .total-amount {
            font-size: 2.2em;
            font-weight: 800;
            background: linear-gradient(135deg, #ffd700, #87ceeb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: right;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-icon {
            font-size: 4em;
            margin-bottom: 15px;
            opacity: 0.3;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #90ee90, #87ceeb);
            color: #0a0e27;
            padding: 18px 28px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(135, 206, 235, 0.4);
            z-index: 1000;
            font-weight: 600;
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @media print {
            body { background: white; color: black; }
            .card:first-child, header, .btn { display: none; }
            .card { box-shadow: none; border: 1px solid #ddd; }
        }
    </style>
</head>
<body>
    <div class="stars" id="stars"></div>

    <div class="container">
        <header>
            <div class="logo">COLDPLAY</div>
            <div class="concert-info">Music of the Spheres World Tour 2025</div>
            <div class="concert-info">📍 Gelora Bung Karno Stadium, Jakarta</div>
        </header>

        <div class="content">
            <div class="card">
                <h2 class="section-title">Pemesanan Tiket</h2>
                
                <div class="steps">
                    <div class="step active" data-step="1">
                        <div class="step-num">1</div>
                        <div class="step-label">Kategori</div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-num">2</div>
                        <div class="step-label">Kursi</div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-num">3</div>
                        <div class="step-label">Data Diri</div>
                    </div>
                </div>

                <div class="step-content active" id="step1">
                    <label>Pilih Kategori Tiket:</label>
                    <div class="price-grid">
                        <div class="price-card" data-class="Festival" data-price="1500000">
                            <div class="price-class">🎪 Festival</div>
                            <div class="price-amount">1.5Jt</div>
                        </div>
                        <div class="price-card" data-class="Silver" data-price="3500000">
                            <div class="price-class">🥈 Silver</div>
                            <div class="price-amount">3.5Jt</div>
                        </div>
                        <div class="price-card" data-class="Gold" data-price="5500000">
                            <div class="price-class">🥇 Gold</div>
                            <div class="price-amount">5.5Jt</div>
                        </div>
                        <div class="price-card" data-class="VIP" data-price="8500000">
                            <div class="price-class">💎 VIP</div>
                            <div class="price-amount">8.5Jt</div>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="next(1)">Lanjut ke Pemilihan Kursi</button>
                </div>

                <div class="step-content" id="step2">
                    <label>Pilih Nomor Kursi:</label>
                    <div class="seat-grid" id="seatGrid"></div>
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-box"></div>
                            <span>Tersedia</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-box selected"></div>
                            <span>Dipilih</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-box occupied"></div>
                            <span>Terisi</span>
                        </div>
                    </div>
                    <div class="button-group">
                        <button class="btn btn-secondary" onclick="prev(2)">Kembali</button>
                        <button class="btn btn-primary" style="width: 48%;" onclick="next(2)">Lanjut</button>
                    </div>
                </div>

                <div class="step-content" id="step3">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" id="nama" placeholder="Masukkan nama lengkap Anda">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" placeholder="nama@email.com">
                    </div>
                    <div class="form-group">
                        <label>No. Telepon / WhatsApp</label>
                        <input type="tel" id="telepon" placeholder="08xx xxxx xxxx">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Konser</label>
                        <input type="date" id="tanggal" value="2025-11-15">
                    </div>
                    <div class="button-group">
                        <button class="btn btn-secondary" onclick="prev(3)">Kembali</button>
                        <button class="btn btn-primary" style="width: 48%;" onclick="generate()">Buat Tiket</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2 class="section-title">Preview Tiket</h2>
                <div id="preview">
                    <div class="empty-state">
                        <div class="empty-icon">🎫</div>
                        <div>Tiket Anda akan muncul di sini</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const data = { class: '', price: 0, seat: '', nama: '', email: '', telepon: '', tanggal: '', code: '' };
        let step = 1;
        const occupied = ['A3', 'B5', 'C2', 'D7', 'E4', 'F1', 'G6', 'H3'];

        // Generate stars
        const starsEl = document.getElementById('stars');
        for (let i = 0; i < 100; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            star.style.left = Math.random() * 100 + '%';
            star.style.top = Math.random() * 100 + '%';
            star.style.animationDelay = Math.random() * 3 + 's';
            starsEl.appendChild(star);
        }

        // Generate seats
        function initSeats() {
            const grid = document.getElementById('seatGrid');
            grid.innerHTML = '';
            const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
            rows.forEach(r => {
                for (let c = 1; c <= 8; c++) {
                    const num = r + c;
                    const isOcc = occupied.includes(num);
                    const seat = document.createElement('div');
                    seat.className = 'seat' + (isOcc ? ' occupied' : '');
                    seat.textContent = num;
                    seat.onclick = () => !isOcc && selectSeat(num, seat);
                    grid.appendChild(seat);
                }
            });
        }

        function selectSeat(num, el) {
            document.querySelectorAll('.seat').forEach(s => s.classList.remove('selected'));
            el.classList.add('selected');
            data.seat = num;
        }

        // Price selection
        document.querySelectorAll('.price-card').forEach(c => {
            c.onclick = function() {
                document.querySelectorAll('.price-card').forEach(x => x.classList.remove('selected'));
                this.classList.add('selected');
                data.class = this.dataset.class;
                data.price = parseInt(this.dataset.price);
            };
        });

        function updateUI() {
            document.querySelectorAll('.step').forEach((s, i) => {
                s.classList.toggle('active', i + 1 === step);
            });
            document.querySelectorAll('.step-content').forEach((c, i) => {
                c.classList.toggle('active', i + 1 === step);
            });
        }

        function next(s) {
            if (s === 1 && !data.class) return alert('Pilih kategori tiket terlebih dahulu');
            if (s === 2 && !data.seat) return alert('Pilih kursi terlebih dahulu');
            step = s + 1;
            updateUI();
            if (s === 1) initSeats();
        }

        function prev(s) {
            step = s - 1;
            updateUI();
        }

        function generate() {
            data.nama = document.getElementById('nama').value;
            data.email = document.getElementById('email').value;
            data.telepon = document.getElementById('telepon').value;
            data.tanggal = document.getElementById('tanggal').value;

            if (!data.nama || !data.email || !data.telepon || !data.tanggal) {
                return alert('Lengkapi semua data terlebih dahulu');
            }

            // buat kode tiket unik
            data.code = 'COLD' + Math.random().toString(36).substr(2, 6).toUpperCase();

            // format tanggal & harga
            const date = new Date(data.tanggal).toLocaleDateString('id-ID', { 
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' 
            });
            const price = new Intl.NumberFormat('id-ID', {
                style: 'currency', currency: 'IDR', minimumFractionDigits: 0
            }).format(data.price);

            // tampilkan preview tiket
            document.getElementById('preview').innerHTML = `
                <div class="ticket">
                  <div class="ticket-header">
                    <div class="ticket-artist">COLDPLAY</div>
                    <div style="color: #a0a0a0; font-size: 0.95em; margin-top: 5px;">
                      Music of the Spheres World Tour
                    </div>
                    <div class="ticket-code">${data.code}</div>
                  </div>
                  <div class="ticket-body">
                    <div class="ticket-info">
                      <div class="info-label">Nama:</div>
                      <div class="info-value">${data.nama}</div>
                      <div class="info-label">Email:</div>
                      <div class="info-value">${data.email}</div>
                      <div class="info-label">Telepon:</div>
                      <div class="info-value">${data.telepon}</div>
                      <div class="info-label">Tanggal:</div>
                      <div class="info-value">${date}</div>
                    </div>
                    <hr class="divider">
                    <div class="ticket-info">
                      <div class="info-label">Kategori:</div>
                      <div class="info-value">${data.class}</div>
                      <div class="info-label">Kursi:</div>
                      <div class="info-value">${data.seat}</div>
                      <div class="info-label">Venue:</div>
                      <div class="info-value">Gelora Bung Karno Stadium</div>
                    </div>
                    <div class="total-box">
                      <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="total-label">Total Harga:</div>
                        <div class="total-amount">${price}</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="button-group" style="margin-top:20px;">
                  <button type="button" class="btn btn-print" onclick="window.print()" style="width:48%;">Cetak Tiket</button>
                </div>
            `;

            // Kirim data ke server menggunakan fetch API
            const formData = new FormData();
            formData.append('nama', data.nama);
            formData.append('email', data.email);
            formData.append('telepon', data.telepon);
            formData.append('tanggal', data.tanggal);
            formData.append('kategori', data.class);
            formData.append('kursi', data.seat);
            formData.append('harga', data.price);
            formData.append('kode', data.code);

            showNotif('Menyimpan tiket ke database...');

            fetch('simpan.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                console.log('Response dari server:', result);
                showNotif('Tiket berhasil disimpan!');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menyimpan tiket. Cek console (F12) untuk detail error.');
            });
        }

        function showNotif(message) {
            const oldNotif = document.querySelector('.notification');
            if (oldNotif) oldNotif.remove();

            const notif = document.createElement('div');
            notif.className = 'notification';
            notif.textContent = message;
            document.body.appendChild(notif);
            
            setTimeout(() => {
                notif.style.opacity = '0';
                notif.style.transform = 'translateX(100px)';
                notif.style.transition = 'all 0.5s ease';
                setTimeout(() => notif.remove(), 500);
            }, 3000);
        }
    </script>
</body>
</html>