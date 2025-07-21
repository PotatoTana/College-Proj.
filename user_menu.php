<?php
// user_menu.php (Top Section)

if (isset($_GET['table'])) {
    session_start();
    $_SESSION['table_id'] = htmlspecialchars($_GET['table']);
} else {
    session_start();
}
$_SESSION['is_member'] = true;

$isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Think Cafe - Menu</title>
    <link rel="stylesheet" href="css/user_menu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>
<body>

<header>
    <div class="logo">Think Cafe</div>
    <nav>
        <div class="menu-dropdown">
            <i class="bi bi-list" id="menuToggle" style="font-size: 28px; cursor: pointer;"></i>
            <div class="dropdown-content" id="dropdownMenu" style="display: none;">
                <?php if ($isLoggedIn): ?>
                    <div class="dropdown-user">
                        <i class="bi bi-person-circle"></i>
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </div>
                    <a href="home.php"><i class="bi bi-house"></i> หน้าหลัก</a>
                    <a href="checkTables.php"><i class="bi bi-calendar-check"></i> ดูตารางการจอง</a>
                    <a href="reserveT.php"><i class="bi bi-calendar-plus"></i> จองโต๊ะ</a>
                    <a href="event.php"><i class="bi bi-megaphone"></i> กิจกรรม</a>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="Admin_order.php"><i class="bi bi-clipboard-data"></i> รายการออเดอร์</a>
                        <a href="Admin_report.php"><i class="bi bi-bar-chart-line"></i> รายงาน</a>
                    <?php endif; ?>
                    <a href="logout.php"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</a>
                <?php else: ?>
                    <a href="register.php"><i class="bi bi-person-plus"></i> สมัครสมาชิก</a>
                    <a href="login.php"><i class="bi bi-box-arrow-in-right"></i> เข้าสู่ระบบ</a>
                    <a href="home.php"><i class="bi bi-house"></i> หน้าหลัก</a>
                    <a href="checkTables.php"><i class="bi bi-calendar-check"></i> ดูตารางการจอง</a>
                    <a href="reserveT.php"><i class="bi bi-calendar-plus"></i> จองโต๊ะ</a>
                    <a href="event.php"><i class="bi bi-megaphone"></i> กิจกรรม</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>


<main>
    <div class="floating-btns">
        <button class="icon-button" id="openOrderBtn" title="Cart"><i class="bi bi-basket"></i></button>
        <button class="icon-button history-btn" id="orderHistoryBtn" title="Order History"><i class="bi bi-clock-history"></i></button>
    </div>
    <div id="toast"></div>

    <section>
        <div class="category-tabs animate-up delay-2">
            <button class="tab-button active" data-main="recommend">เมนูแนะนำ</button>
            <button class="tab-button" data-main="food">อาหาร</button>
            <button class="tab-button" data-main="drink">เครื่องดื่ม</button>
            <button class="tab-button" data-main="dessert">ของหวาน</button>
            <button class="tab-button" data-main="special">เครื่องดื่มพิเศษ</button>
        </div>

        <div class="subcategory-tabs animate-up delay-3" id="subcategoryTabs"></div>

        <div id="menuContainer" class="animate-up delay-4">
            </div>

    </section>
</main>

<div id="orderModal" class="modal">
  <div class="order-modal-content">
    <span class="close-order">&times;</span>
    <h2>ออเดอร์ของคุณ</h2>
        <?php if (isset($_SESSION['table_id'])): ?>
            <div style="text-align:center; font-weight:bold; margin-top:10px; margin-bottom:10px; color: #333;">
                TB : <?= htmlspecialchars($_SESSION['table_id']) ?>
            </div>
        <?php endif; ?>
    <div class="order-scroll-container">
      <div id="orderContent" class="order-list"></div>
    </div>
  </div>
</div>

<div id="historyModal" class="modal">
  <div class="order-modal-content" style="position: relative;">
    <span class="close-history">&times;</span>
    <h2>ประวัติการสั่งซื้อ</h2>
    <div class="order-scroll-container">
      <div id="historyContent"></div>
    </div>
  </div>
</div>


<script>
    window.TABLE_ID = "<?php echo isset($_SESSION['table_id']) ? htmlspecialchars($_SESSION['table_id'], ENT_QUOTES) : ''; ?>";
    window.CURRENT_USERNAME = "<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username'], ENT_QUOTES) : 'Guest'; ?>";
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("menuToggle");
        const dropdown = document.getElementById("dropdownMenu");

        if (toggleBtn && dropdown) {
            toggleBtn.addEventListener("click", function (e) {
                e.stopPropagation();
                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", function (e) {
                if (!dropdown.contains(e.target) && e.target !== toggleBtn) {
                    dropdown.style.display = "none";
                }
            });
        }
    });
</script>
<script src="js/toast.js"></script>
<script src="js/user_menu.js"></script> 
</body>
</html>