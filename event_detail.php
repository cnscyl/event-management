<?php 
$dbc = mysqli_connect("localhost", "root", "", "webito")
    or die("Veritabanına bağlanılamadı.");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Etkinlik bulunamadı.";
    exit;
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare($dbc, "SELECT * FROM events WHERE eid = ? AND status = 1");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    echo "Etkinlik bulunamadı veya pasif durumda.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($event['name']) ?> | Detay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Stil Dosyaları -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }
        .top-bar {
            background: linear-gradient(to right, #7b46b0, #93c5fd);
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .top-bar .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .top-bar .navbar-brand i {
            font-size: 28px;
        }
        .event-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 20px;
            margin-top: 40px;
        }
        .event-image {
            border-radius: 8px;
            max-height: 400px;
            object-fit: cover;
            width: 100%;
        }
        .btn-back {
            margin-top: 20px;
        }
        .event-title {
            color: #7b46b0;
            font-weight: 600;
        }
    </style>
</head>
<body>

<!-- Üst Bar -->
<div class="top-bar">
    <div class="navbar-brand">
        <i class='bx bxl-c-plus-plus'></i> Webito
    </div>
    <a href="admin/index.php" class="btn btn-light" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 15px;">Admin Girişi</a>
</div>

<!-- Etkinlik İçeriği -->
<div class="container">
    <div class="event-card mt-4">
        <h1 class="mb-4 event-title"><?= htmlspecialchars($event['name']) ?></h1>
        <img src="<?= htmlspecialchars($event['image']) ?>" 
             class="event-image mb-4" 
             alt="Etkinlik Görseli" 
             onerror="this.src='https://via.placeholder.com/800x400?text=G%C3%B6rsel+Yok';">

        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Tarih:</strong> <?= htmlspecialchars($event['date']) ?></p>
                <p><strong>Saat:</strong> <?= htmlspecialchars($event['time']) ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Konum:</strong> <?= htmlspecialchars($event['location']) ?></p>
                <p><strong>Tip:</strong> <?= ucfirst(htmlspecialchars($event['type'])) ?></p>
            </div>
        </div>

        <div>
            <h5><strong>Açıklama:</strong></h5>
            <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
        </div>

        <a href="index.php" class="btn btn-secondary btn-back">← Geri Dön</a>
    </div>
</div>

</body>
</html>
