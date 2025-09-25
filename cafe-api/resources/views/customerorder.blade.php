<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Order</title>
    
    <!-- Load CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('css/customerorder.css') }}">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <script>
        function updateTotal() {
            const price = parseFloat(document.getElementById('price').value);
            const qty = parseInt(document.getElementById('qty').value);
            const total = price * qty;
            document.getElementById('total').innerText = 'Total: ' + total + 'k';
        }

        // ✅ Redirect ke halaman QRIS setelah klik bayar
        function redirectToQRIS() {
            window.location.href = "{{ url('/qris') }}";
        }
    </script>
</head>
<body>
    <div class="order-container">
        <h2>Pesanan Anda</h2>
        
        <img src="{{ asset($image) }}" alt="Menu Image">
        
        <p><strong>Menu:</strong> {{ $menu }}</p>
        <p><strong>Harga:</strong> <span id="price-display">{{ $price }}k</span></p>
        <input type="hidden" id="price" value="{{ $price }}">

        <label for="qty">Jumlah:</label>
        <input type="number" id="qty" name="qty" value="1" min="1" onchange="updateTotal()">

        <p class="total-price" id="total">Total: {{ $price }}k</p>

        <!-- Tombol Bayar redirect ke halaman QRIS -->
        <button class="pay-button" onclick="redirectToQRIS()">Bayar</button>
    </div>
</body>
</html>
