<?php
session_start();
if (isset($_SESSION["Aname"])) {
    header('location: home.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Webito | Admin Giriş</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font ve Boxicons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #7b46b0 0%, #93c5fd 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-box {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .logo-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .logo-header i {
            font-size: 28px;
            color: #7b46b0;
            margin-right: 8px;
        }
        .logo-header span {
            font-size: 24px;
            font-weight: 600;
            color: #7b46b0;
        }
        
        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 16px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            font-size: 14px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #7b46b0;
            color: #fff;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        input[type="submit"]:hover {
            background-color: #5f3793;
        }

    </style>
</head>
<body>
    <form class="login-box" method="POST" action="login.php" autocomplete="off">
        <div class="logo-header">
            <i class='bx bxl-c-plus-plus'></i>
            <span>Webito</span>
        </div>
        <h2>Admin Panel Giriş</h2>
        <div class="form-group">
            <label for="username">Kullanıcı Adı</label>
            <input type="email" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Şifre</label>
            <input type="password" name="password" id="password" required>
        </div>
        <input type="submit" name="submit" value="Giriş Yap">
    </form>
</body>
</html>
