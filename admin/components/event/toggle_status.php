<?php
session_start();
if (!isset($_SESSION['Aname'])) {
    header('location: ../../index.php');
    exit();
}

$dbc = mysqli_connect("localhost", "root", "", "webito") or die("Bağlantı hatası");

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || !isset($_GET['status'])) {
    echo "Geçersiz veri.";
    exit();
}

$id = intval($_GET['id']);
$newStatus = intval($_GET['status']);

$stmt = mysqli_prepare($dbc, "UPDATE events SET status = ? WHERE eid = ?");
mysqli_stmt_bind_param($stmt, "ii", $newStatus, $id);
mysqli_stmt_execute($stmt);

header('location: ../../events.php');
exit();
?>
