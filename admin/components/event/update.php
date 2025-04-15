<?php
session_start();
if (!isset($_SESSION['Aname'])) {
    header('location: ../../index.php');
    exit();
}

$dbc = mysqli_connect("localhost", "root", "", "webito") or die("Unable to connect to database");

$id = intval($_GET['id']);

// Etkinlik verisini çek
$stmt = mysqli_prepare($dbc, "SELECT * FROM events WHERE eid = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$r = mysqli_fetch_assoc($result);

if (!$r) {
    echo "Etkinlik bulunamadı.";
    exit();
}

// Güncelleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['desc'];
    $category = $_POST['type'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $img = $_POST['img'];
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;

    $query = "UPDATE events SET 
                name = ?, 
                description = ?, 
                type = ?, 
                location = ?, 
                date = ?, 
                time = ?, 
                image = ?, 
                status = ?
              WHERE eid = ?";
    
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "sssssssii", $name, $description, $category, $location, $date, $time, $img, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../../events.php');
        exit();
    } else {
        $fmsg = "Veri güncellenemedi.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Etkinlik Güncelle | Webito</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../home.css">
</head>

<body>
<?php include_once("../../templates/sidebar.php"); ?>

<section class="home-section">
    <?php include_once("../../templates/topbar.php"); ?>

    <div class="home-content">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php if (isset($fmsg)) { ?>
                        <div class="alert alert-danger" role="alert"><?php echo $fmsg; ?></div>
                    <?php } ?>

                    <h2 class="mb-4 text-center">Etkinlik Güncelle</h2>
                    <form method="post">
                        <div class="form-group mb-3">
                            <label>İsim</label>
                            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($r['name']) ?>" required />
                        </div>
                        <div class="form-group mb-3">
                            <label>Açıklama</label>
                            <input type="text" class="form-control" name="desc" value="<?= htmlspecialchars($r['description']) ?>" required />
                        </div>
                        <div class="form-group mb-3">
                            <label>Kategori</label>
                            <select class="form-select" name="type">
                                <option value="technical" <?= $r['type'] == 'technical' ? 'selected' : '' ?>>Teknik</option>
                                <option value="non-technical" <?= $r['type'] == 'non-technical' ? 'selected' : '' ?>>Teknik Dışı</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Konum</label>
                            <input type="text" class="form-control" name="location" value="<?= htmlspecialchars($r['location']) ?>" required />
                        </div>
                        <div class="form-group mb-3">
                            <label>Tarih</label>
                            <input type="date" class="form-control" name="date" value="<?= $r['date'] ?>" />
                        </div>
                        <div class="form-group mb-3">
                            <label>Saat</label>
                            <input type="time" class="form-control" name="time" value="<?= $r['time'] ?>" />
                        </div>
                        <div class="form-group mb-3">
                            <label>Görsel Bağlantısı</label>
                            <input type="url" class="form-control" name="img" value="<?= $r['image'] ?>" />
                        </div>
                        <div class="form-group mb-4">
                            <label>Durum</label>
                            <select class="form-control" name="status">
                                <option value="1" <?= $r['status'] == 1 ? 'selected' : '' ?>>Aktif</option>
                                <option value="0" <?= $r['status'] == 0 ? 'selected' : '' ?>>Pasif</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <input type="submit" class="btn btn-primary" value="Güncelle" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
