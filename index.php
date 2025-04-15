<?php
$dbc = mysqli_connect("localhost", "root", "", "webito") or die("Veritabanına bağlanılamadı.");

$search = '';
if (isset($_GET['search']) && trim($_GET['search']) !== '') {
    $search = trim($_GET['search']);
    $stmt = mysqli_prepare($dbc, "SELECT * FROM events WHERE status = 1 AND (name LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%')) ORDER BY date ASC");
    mysqli_stmt_bind_param($stmt, "ss", $search, $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($dbc, "SELECT * FROM events WHERE status = 1 ORDER BY date ASC");
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Etkinlikler | Webito</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f3f4f6;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background: linear-gradient(to right, #7b46b0, #93c5fd);
        }
        .navbar-brand {
            color: white;
            font-weight: 700;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-brand i {
            font-size: 28px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: none;
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #7b46b0;
        }
        .card-text {
            font-size: 15px;
            font-weight: 400;
            color: #333;
        }
        .card p {
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 6px;
        }
        .card i {
            color: #7b46b0;
            margin-right: 6px;
        }
        .btn-primary {
            background-color: #7b46b0;
            border: none;
        }
        .btn-primary:hover {
            background-color: #5a3593;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark p-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class='bx bxl-c-plus-plus'></i> Webito
        </a>
        <a href="admin/index.php" class="btn btn-light" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 15px;">Admin Girişi</a>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Etkinlikler</h2>

    <form method="GET" class="mb-5">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Etkinlik Ara..." value="<?= htmlspecialchars($search) ?>">
            <button class="btn btn-outline-secondary" type="submit"><i class='bx bx-search'></i></button>
        </div>
    </form>

    <div class="row">
        <?php while ($event = mysqli_fetch_assoc($result)) {
            $image = !empty($event['image']) ? htmlspecialchars($event['image']) : 'https://via.placeholder.com/600x300?text=Etkinlik+G%C3%B6rseli';
        ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= $image ?>" class="card-img-top" alt="Etkinlik Görseli">

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars(mb_substr($event['description'], 0, 100)) ?>...</p>
                        <p><i class='bx bx-calendar'></i> <strong>Tarih:</strong> <?= htmlspecialchars($event['date']) ?></p>
                        <p><i class='bx bx-time'></i> <strong>Saat:</strong> <?= htmlspecialchars($event['time']) ?></p>
                        <p><i class='bx bx-map'></i> <strong>Konum:</strong> <?= htmlspecialchars($event['location']) ?></p>
                        <a href="event_detail.php?id=<?= $event['eid'] ?>" class="btn btn-primary w-100">Detaylar</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
