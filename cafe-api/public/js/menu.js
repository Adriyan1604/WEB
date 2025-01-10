function filterMenu(category) {
    const items = document.querySelectorAll('.menu-item');
    items.forEach(item => {
        if (category === 'all' || item.classList.contains(category)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
    document.querySelectorAll('.menu-button').forEach(button => {
        button.classList.remove('active');
    });
    document.querySelector(`[onclick="filterMenu('${category}')"]`).classList.add('active');
  }
  
  function orderItem(itemName) {
    // Encode item name to safely include it in the URL
    const encodedItemName = encodeURIComponent(itemName);
    // Navigate to order page with the item name as a query parameter
    window.location.href = `order.html?item=${encodedItemName}`;
  }

  function orderItem(itemName) {
    const quantity = 1; // Misalnya jumlah pesanan 1
    const price = 10;   // Harga item, misalnya 10k
    
    // Membuat data pesanan
    const orderData = {
        item_name: itemName,
        quantity: quantity,
        price: price
    };
    
    // Melakukan POST request ke API untuk menambahkan pesanan
    fetch('http://localhost/api/orders', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Order created:', data);
        alert('Order berhasil dibuat!');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal membuat order');
    });
}
    