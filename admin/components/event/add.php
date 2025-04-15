<?php
$dbc = mysqli_connect("localhost", "root", "", "webito") or die("Veritabanına bağlanılamadı.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $img = $_POST['img'];
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;

    // Hazırlıklı (prepared) sorgu
    $stmt = mysqli_prepare($dbc, "INSERT INTO events (name, description, type, location, time, date, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssssssi", $name, $desc, $type, $location, $time, $date, $img, $status);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../../events.php');
        exit();
    } else {
        $fmsg = "Etkinlik eklenemedi.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Etkinlik Ekle | Webito</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../home.css">
</head>

<body>
<?php
$page_title = "Yeni Etkinlik Ekle";
include_once("../../templates/sidebar.php");
?>

<section class="home-section">
    <?php include_once("../../templates/topbar.php"); ?>

    <div class="home-content">
        <div class="container py-5 d-flex justify-content-center">
            <div class="col-lg-10 col-md-12">

                <?php if (isset($fmsg)) { ?>
                    <div class="alert alert-danger"><?php echo $fmsg; ?></div>
                <?php } ?>

                <h2 class="mb-4 text-center">Yeni Etkinlik Ekle</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label>İsim</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Açıklama</label>
                        <textarea class="form-control" name="desc" rows="3" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Kategori</label>
                        <select class="form-control" name="type">
                            <option value="technical">Teknik</option>
                            <option value="non-technical">Teknik Dışı</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Konum</label>
                        <input type="text" class="form-control" name="location" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Tarih</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Saat</label>
                        <input type="time" class="form-control" name="time" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Görsel Linki</label>
                        <input type="url" class="form-control" name="img">
                    </div>
                    <div class="form-group mb-4">
                        <label>Durum</label>
                        <select class="form-control" name="status">
                            <option value="1" selected>Aktif</option>
                            <option value="0">Pasif</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <input type="submit" class="btn btn-primary" value="Etkinlik Ekle">
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<!-- Sidebar aç/kapat için script -->
<script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");

    if (sidebar && sidebarBtn) {
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
        };
    }
</script>

</body>
</html>
