<?php
session_start();
if (!isset($_SESSION['Aname'])) {
    header('location: ../../index.php');
    exit();
}

$dbc = mysqli_connect("localhost", "root", "", "webito")
    or die("Unable to connect to database");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Geçersiz ID.";
    exit();
}

$id = intval($_GET['id']); 


$stmt = mysqli_prepare($dbc, "DELETE FROM events WHERE eid = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header('Location: ../../events.php');
    exit();
} else {
    echo "Etkinlik silinemedi.";
}
?>
