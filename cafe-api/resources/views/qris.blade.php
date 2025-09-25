<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran via QRIS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            padding: 50px;
        }
        .qris-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        .qris-container img {
            width: 250px;
            margin: 20px 0;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .qris-container h2 {
            color: #333;
            margin-bottom: 15px;
        }
        .qris-container p {
            font-size: 16px;
            color: #555;
        }
        .back-button {
            margin-top: 20px;
            display: inline-block;
            background-color: #ff9800;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 10px;
        }
        .back-button:hover {
            background-color: #e68900;
        }
    </style>
</head>
<body>
    <div class="qris-container">
        <h2>Scan untuk Membayar</h2>
        <p>Gunakan aplikasi DANA, OVO, GoPay, atau dompet digital lainnya.</p>
        
        <!-- Ganti dengan QR statis dari DANA kamu -->
        <img src="{{ asset('assets/qris.png') }}" alt="QRIS Payment">

        <p>Setelah melakukan pembayaran, tunjukkan bukti pembayaran ke kasir.</p>

        <a href="{{ url('/menu') }}" class="back-button">Kembali ke Menu</a>
    </div>
</body>
</html>
