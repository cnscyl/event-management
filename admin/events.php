<?php
session_start();
if (!isset($_SESSION['Aname'])) {
    header('location: index.php');
    exit();
}

$dbc = mysqli_connect("localhost", "root", "", "webito") or die("Veritabanı bağlantısı sağlanamadı.");
$query1 = "SELECT * FROM events";
$exe1 = mysqli_query($dbc, $query1);
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Webito | Etkinlik Listesi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <style>
        @media (max-width: 767.98px) {
            .table-wrapper { overflow-x: visible; }
            .desktop-table { display: none; }
            .mobile-cards { display: block; }
            .event-card {
                margin-bottom: 1rem;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            }
            .event-card .btn { margin: 2px; }
        }
        @media (min-width: 768px) {
            .desktop-table { display: table; }
            .mobile-cards { display: none; }
        }
    </style>
</head>

<body>
<?php
$page_title = "Etkinlik Listesi";
include_once('./templates/sidebar.php');
?>

<section class="home-section">
    <?php include_once('./templates/topbar.php'); ?>

    <div class="home-content">
        <div class="container-fluid py-5">
            <div class="row mb-3">
                <div class="col text-end">
                    <a href="./components/event/add.php" class="btn btn-primary">
                        <i class='bx bx-plus-circle me-1'></i> Yeni Etkinlik Ekle
                    </a>
                </div>
            </div>

            <div class="table-wrapper">
                
                <table class="table table-bordered align-middle text-center desktop-table">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>İsim</th>
                            <th>Açıklama</th>
                            <th>Tür</th>
                            <th>Konum</th>
                            <th>Tarih</th>
                            <th>Zaman</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($exe1)) {
                            $p_id = (int)$row['eid'];
                            $name = htmlspecialchars($row['name']);
                            $desc = htmlspecialchars(mb_strimwidth($row['description'], 0, 50, "..."));
                            $type = $row['type'] === 'technical' ? 'Teknik' : 'Teknik Dışı';
                            $location = htmlspecialchars($row['location']);
                            $date = htmlspecialchars($row['date']);
                            $time = htmlspecialchars($row['time']);
                            $status = (int)$row['status'];

                            $statusBtn = $status 
                                ? "<a href='./components/event/toggle_status.php?id=$p_id&status=0' class='btn btn-warning btn-sm'>Pasifleştir</a>"
                                : "<a href='./components/event/toggle_status.php?id=$p_id&status=1' class='btn btn-success btn-sm'>Aktifleştir</a>";

                            echo "
                            <tr>
                                <td>$p_id</td>
                                <td>$name</td>
                                <td>$desc</td>
                                <td>$type</td>
                                <td>$location</td>
                                <td>$date</td>
                                <td>$time</td>
                                <td>$statusBtn</td>
                                <td>
                                    <a href='./components/event/update.php?id=$p_id' class='btn btn-info btn-sm text-white'>
                                        <i class='bx bx-edit-alt'></i> Düzenle
                                    </a>
                                    <a href='./components/event/delete.php?id=$p_id' class='btn btn-danger btn-sm' onclick=\"return confirm('Bu etkinliği silmek istediğinizden emin misiniz?');\">
                                        <i class='bx bx-trash'></i> Sil
                                    </a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>

                

                <div class="mobile-cards">
                    <?php
                    mysqli_data_seek($exe1, 0);
                    while ($row = mysqli_fetch_array($exe1)) {
                        $p_id = (int)$row['eid'];
                        $name = htmlspecialchars($row['name']);
                        $desc = htmlspecialchars(mb_strimwidth($row['description'], 0, 100, "..."));
                        $type = $row['type'] === 'technical' ? 'Teknik' : 'Teknik Dışı';
                        $location = htmlspecialchars($row['location']);
                        $date = htmlspecialchars($row['date']);
                        $time = htmlspecialchars($row['time']);
                        $image = !empty($row['image']) ? htmlspecialchars($row['image']) : 'https://via.placeholder.com/600x300?text=Etkinlik+G%C3%B6rseli';
                        $status = (int)$row['status'];

                        $statusBtn = $status 
                            ? "<a href='./components/event/toggle_status.php?id=$p_id&status=0' class='btn btn-warning btn-sm'>Pasifleştir</a>"
                            : "<a href='./components/event/toggle_status.php?id=$p_id&status=1' class='btn btn-success btn-sm'>Aktifleştir</a>";

                        echo "
                        <div class='card event-card p-3 mb-3'>
                            <img src='$image' class='card-img-top mb-3' alt='Etkinlik Görseli'>
                            <h5 class='card-title'>$name</h5>
                            <p class='card-text mb-2'>$desc</p>
                            <p><strong>Tür:</strong> $type</p>
                            <p><strong>Konum:</strong> $location</p>
                            <p><strong>Tarih:</strong> $date | <strong>Saat:</strong> $time</p>
                            <div class='d-flex justify-content-between flex-wrap'>
                                <div>$statusBtn</div>
                                <div>
                                    <a href='./components/event/update.php?id=$p_id' class='btn btn-info btn-sm text-white me-2'>
                                        <i class='bx bx-edit-alt'></i> Düzenle
                                    </a>
                                    <a href='./components/event/delete.php?id=$p_id' class='btn btn-danger btn-sm' onclick=\"return confirm('Bu etkinliği silmek istediğinizden emin misiniz?');\">
                                        <i class='bx bx-trash'></i> Sil
                                    </a>
                                </div>
                            </div>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once('./templates/sidebar-toggle.php'); ?>
</body>
</html>
