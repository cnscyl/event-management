<?php
session_start();

$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbase = "webito";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$email || !$password) {
        echo "<script>alert('Kullanıcı adı ve şifre boş bırakılamaz.'); window.location.href = 'index.php';</script>";
        exit;
    }

    $dbc = mysqli_connect($host, $dbuser, $dbpass, $dbase) or die("Bağlantı kurulamadı.");

    $stmt = mysqli_prepare($dbc, "SELECT id, email, pass, isaccess FROM admin WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($password === $row['pass']) {
            $_SESSION['Aname'] = $row['email'];
            $_SESSION['Aid'] = $row['id'];
            $_SESSION['Aaccess'] = $row['isaccess'] ?? 0;
            header("Location: home.php");
            exit;
        }
    }

    echo "<script>alert('Hatalı giriş! Bilgileri kontrol et.'); window.location.href = 'index.php';</script>";
    mysqli_close($dbc);
}
?>
