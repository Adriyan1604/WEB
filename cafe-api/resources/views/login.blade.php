<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url(assets/bg2.png);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 320px;
            backdrop-filter: blur(10px);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #fff;
        }
        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 16px;
            transition: background 0.3s;
        }
        input::placeholder {
            color: #ddd;
        }
        input:focus {
            background: rgba(255, 255, 255, 0.4);
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px 15px;
            background: #ff9800;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: bold;
            transition: background 0.3s;
        }
        button:hover {
            background: #e68900;
        }
        .error {
            color: #ff5252;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .login-container .decorative {
            height: 4px;
            width: 50px;
            background: #ff9800;
            margin: 0 auto 20px;
            border-radius: 2px;
        }
        @media (max-width: 768px) {
            .login-container {
                width: 90%;
                padding: 30px;
            }
            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Welcome Back</h1>
        <div class="decorative"></div>

        <!-- Menampilkan error jika login gagal -->
        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form login -->
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <input type="text" name="username" placeholder="Enter your username" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>
