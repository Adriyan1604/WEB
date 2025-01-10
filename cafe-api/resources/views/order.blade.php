<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url(assets/bg2.png);
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #fff;
            overflow-x: hidden;
        }
        header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .logo-image {
            width: 150px;
            height: auto;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
        }
        nav ul li a {
            color: #fff;
            font-family: 'Madimi One', sans-serif;
            text-decoration: none;
            font-size: 18px;
            padding-bottom: 5px;
            transition: color 0.3s ease, border-bottom 0.3s ease;
            margin-left: -250%;
        }
        nav ul li a:hover,
        nav ul li a.active {
            color: #ffd700;
            border-bottom: 2px solid #ffd700;
        }
        h1 {
            text-align: center;
            color: #ffd700;
            font-size: 2.8rem;
            margin-bottom: 30px;
        }

        /* Container for Content */
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        /* Form Styles */
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        form input,
        form button {
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
        }
        form input {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }
        form input::placeholder {
            color: #ddd;
        }
        form input:focus {
            background: rgba(255, 255, 0, 0.4);
            box-shadow: 0 0 8px #ffd700;
            outline: none;
        }
        form button {
            background: #ffd700;
            color: #3e2723;
            font-weight: bold;
            grid-column: span 2;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
        form button:hover {
            background-color: #ffbf00;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 1rem;
            color: #333;
        }
        th {
            background-color: #6f4f2829;
            color: #000000;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #ffe7b0;
        }

        /* Action Buttons */
        .menu-buttons button {
            padding: 8px 12px;
            background-color: #6f4f28;
            color: white;
            font-size: 0.9rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .menu-buttons button:hover {
            background-color: #5a3e1d;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }
            header {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
    <script>
        // Fetch Orders from Laravel API
        async function fetchOrders() {
            const response = await fetch('http://localhost:8000/api/api/orders'); // Ganti dengan URL API Laravel
            const data = await response.json();
            const orderList = document.getElementById('orderList');
            orderList.innerHTML = '';
            data.forEach(order => {
                orderList.innerHTML += `
                    <tr>
                        <td>${order.customer_name}</td>
                        <td>${order.product_name}</td>
                        <td>${order.quantity}</td>
                        <td>$${order.price}</td>
                        <td class="menu-buttons">
                            <button onclick="editOrder(${order.id}, '${order.customer_name}', '${order.product_name}', ${order.quantity}, ${order.price})">Edit</button>
                            <button onclick="deleteOrder(${order.id})">Delete</button>
                        </td>
                    </tr>
                `;
            });
        }

        // Save or Update Order
        async function saveOrder() {
            const id = document.getElementById('orderId').value;
            const customer_name = document.getElementById('customer_name').value;
            const product_name = document.getElementById('product_name').value;
            const quantity = document.getElementById('quantity').value;
            const price = document.getElementById('price').value;

            const endpoint = id ? `orders/${id}` : 'orders'; // Endpoint URL
            const method = id ? 'PUT' : 'POST'; // HTTP Method (PUT for update, POST for new)

            // Send data to API
            await fetch(`http://localhost:8000/api/api/${endpoint}`, {
                method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ customer_name, product_name, quantity, price }) // Send data in JSON format
            });

            fetchOrders();
            alert(id ? "Order updated!" : "Order added!");
            clearForm();
        }

        // Edit Order Item
        function editOrder(id, customer_name, product_name, quantity, price) {
            document.getElementById('orderId').value = id;
            document.getElementById('customer_name').value = customer_name;
            document.getElementById('product_name').value = product_name;
            document.getElementById('quantity').value = quantity;
            document.getElementById('price').value = price;
        }

        // Delete Order Item
        async function deleteOrder(id) {
            await fetch(`http://localhost:8000/api/api/orders/${id}`, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
            });

            fetchOrders();
            alert("Order deleted!");
        }

        // Clear Form Fields
        function clearForm() {
            document.getElementById('orderId').value = '';
            document.getElementById('customer_name').value = '';
            document.getElementById('product_name').value = '';
            document.getElementById('quantity').value = '';
            document.getElementById('price').value = '';
        }

        // On Page Load, Fetch Order Data
        window.onload = fetchOrders;
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/trasp.png" alt="Cafe Logo" class="logo-image">
        </div>
        <nav>
            <ul>
                <li><a href="{{ url('/admin') }}">Admin</a></li>
                <li><a href="{{ url('/order') }}"class="active">Order</a></li>
                <li><a href="{{ url('/login') }}">Login</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Order Management</h1>
        <form onsubmit="event.preventDefault(); saveOrder();">
            <input type="hidden" id="orderId">
            <input type="text" id="customer_name" placeholder="Customer Name" required>
            <input type="text" id="product_name" placeholder="Product Name" required>
            <input type="number" id="quantity" placeholder="Quantity" required>
            <input type="number" id="price" placeholder="Price" required>
            <button type="submit">Save Order</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="orderList">
                <!-- Order data will be populated here dynamically -->
            </tbody>
        </table>
    </div>
</body>
</html>
