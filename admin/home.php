<?php
session_start();
$page_title = "Kontrol Paneli";

if (!isset($_SESSION['Aname'])) {
    header('location:index.php');
    exit();
}

$dbc = mysqli_connect("localhost", "root", "", "webito") or die("Unable to connect");


$q3 = "SELECT COUNT(eid) AS e FROM events";
$exe3 = mysqli_query($dbc, $q3);
$eventCount = mysqli_fetch_assoc($exe3)['e'] ?? 0;

$q4 = "SELECT COUNT(id) AS a FROM admin";
$exe4 = mysqli_query($dbc, $q4);
$adminCount = mysqli_fetch_assoc($exe4)['a'] ?? 0;
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Webito | <?= htmlspecialchars($page_title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
</head>

<body>
<?php include_once('./templates/sidebar.php'); ?>

<section class="home-section">
    <?php include_once('./templates/topbar.php'); ?>

    <div class="home-content">
        <div class="container-fluid py-5">
            <div class="row g-4">

                
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm text-center border-0">
                        <div class="card-body">
                            <i class='bx bxs-calendar bx-tada bx-lg text-primary mb-3'></i>
                            <h5 class="card-title">Toplam Etkinlik</h5>
                            <h2 class="card-text"><?= htmlspecialchars($eventCount) ?></h2>
                            <span class="text-muted">✓ Güncel</span>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm text-center border-0">
                        <div class="card-body">
                            <i class='bx bxs-user-rectangle bx-fade-left bx-lg text-success mb-3'></i>
                            <h5 class="card-title">Toplam Admin</h5>
                            <h2 class="card-text"><?= htmlspecialchars($adminCount) ?></h2>
                            <span class="text-muted">✓ Güncel</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php include_once('./templates/sidebar-toggle.php'); ?>
</body>
</html>
