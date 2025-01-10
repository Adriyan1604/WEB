<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Menu</title>
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
        // Fetch Menu from Laravel API
        async function fetchMenu() {
            const response = await fetch('http://localhost:8000/api/api/menus'); // Ganti dengan URL API Laravel
            const data = await response.json();
            const menuList = document.getElementById('menuList');
            menuList.innerHTML = '';
            data.forEach(menu => {
                menuList.innerHTML += `
                    <tr>
                        <td>${menu.name}</td>
                        <td>$${menu.price}</td>
                        <td>${menu.description}</td>
                        <td class="menu-buttons">
                            <button onclick="editMenu(${menu.id}, '${menu.name}', '${menu.description}', ${menu.price})">Edit</button>
                            <button onclick="deleteMenu(${menu.id})">Delete</button>
                        </td>
                    </tr>
                `;
            });
        }

        // Save or Update Menu
        async function saveMenu() {
            const id = document.getElementById('menuId').value;
            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;
            const price = document.getElementById('price').value;

            const endpoint = id ? `menus/${id}` : 'menus'; // Endpoint URL
            const method = id ? 'PUT' : 'POST'; // HTTP Method (PUT for update, POST for new)

            // Send data to API
            await fetch(`http://localhost:8000/api/api/${endpoint}`, {
                method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, description, price }) // Send data in JSON format
            });

            fetchMenu();
            alert(id ? "Menu updated!" : "Menu added!");
            clearForm();
        }

        // Edit Menu Item
        function editMenu(id, name, description, price) {
            document.getElementById('menuId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
            document.getElementById('price').value = price;
        }

        // Delete Menu Item
        async function deleteMenu(id) {
            await fetch(`http://localhost:8000/api/api/menus/${id}`, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
            });

            fetchMenu();
            alert("Menu deleted!");
        }

        // Clear Form Fields
        function clearForm() {
            document.getElementById('menuId').value = '';
            document.getElementById('name').value = '';
            document.getElementById('description').value = '';
            document.getElementById('price').value = '';
        }

        // On Page Load, Fetch Menu Data
        window.onload = fetchMenu;
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/trasp.png" alt="Cafe Logo" class="logo-image">
        </div>
        <nav>
            <ul>
                <li><a href="{{ url('/admin') }}" class="active">Admin</a></li>
                <li><a href="{{ url('/order') }}">Order</a></li>
                <li><a href="{{ url('/login') }}">Login</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <form onsubmit="event.preventDefault(); saveMenu();">
            <input type="hidden" id="menuId">
            <input type="text" id="name" placeholder="Menu Name" required>
            <input type="text" id="description" placeholder="Description" required>
            <input type="number" id="price" placeholder="Price" required>
            <button type="submit">Save Menu</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="menuList"></tbody>
        </table>
    </div>
</body>
</html>
