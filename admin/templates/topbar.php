<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="topbar">
    <div class="sidebar-button">
        <i class='bx bx-menu' id="sidebarBtn" style="cursor:pointer; font-size: 28px;"></i>
        <span class="dashboard">
            <?= isset($page_title) ? htmlspecialchars($page_title) : 'Panel'; ?>
        </span>
    </div>
    <div class="profile-details">
        <img src="https://t4.ftcdn.net/jpg/00/97/00/09/360_F_97000908_wwH2goIihwrMoeV9QF3BW6HtpsVFaNVM.jpg" alt="profile">
        <span class="admin_name">
            <?= isset($_SESSION["Aname"]) ? htmlspecialchars($_SESSION["Aname"]) : "Admin"; ?>
        </span>
        <i class='bx bx-chevron-down'></i>
    </div>
</nav>

<script>
    const sidebar = document.querySelector(".sidebar");
    const sidebarBtn = document.getElementById("sidebarBtn");

    if (sidebar && sidebarBtn) {
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("active");
            document.querySelector(".home-section").classList.toggle("active");

            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        });
    }
</script>
