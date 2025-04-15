<?php
$scriptDir = explode("/", trim($_SERVER['SCRIPT_NAME'], "/"));
$base = "/" . $scriptDir[0] . "/admin";
?>

<div class="sidebar">
    <div class="logo-details">
        <i class='bx bxl-c-plus-plus'></i>
        <span class="logo_name">Webito</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="<?= $base ?>/home.php">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Kontrol Paneli</span>
            </a>
        </li>
        <li>
            <a href="<?= $base ?>/components/event/add.php">
                <i class='bx bx-plus-circle'></i>
                <span class="links_name">Etkinlik Ekle</span>
            </a>
        </li>
        <li>
            <a href="<?= $base ?>/events.php">
                <i class='bx bx-list-ul'></i>
                <span class="links_name">Etkinlik Listesi</span>
            </a>
        </li>
        <li class="log_out">
            <a href="<?= $base ?>/logout.php">
                <i class='bx bx-log-out'></i>
                <span class="links_name">Log out</span>
            </a>
        </li>
    </ul>
</div>
