<?php
session_start(); // เริ่ม session

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
$isLoggedIn = isset($_SESSION['username']);
$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? 'user';

$userPhone = '';
if ($isLoggedIn) {
    require_once 'config.php';
    $stmt = $conn->prepare("SELECT phonenum FROM member_cm WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userPhone);
    $stmt->fetch();
    $stmt->close();
    // $conn->close(); // อย่าปิด connection ตรงนี้ เพราะใช้ต่อด้านล่าง
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Think Cafe - Reserve event</title>
    <link rel="stylesheet" href="css/reserve.css">
</head>
<body>
    <header class="animate-up delay-1">
        <div class="logo">Think Cafe</div>
        <nav>
            <ul>
                <?php if ($isLoggedIn): ?>
                    <li><span><?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                    <li><a href="logout.php">Log-out</a></li>
                <?php else: ?>
                    <li><a href="register.php">Sign-up</a></li>
                    <li><a href="login.php">Log-in</a></li>
                <?php endif; ?>
                    <li><a href="checkTables.php">Reservations</a></li>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="reserveT.php" class="active">Reserve</a></li>
                    <li><a href="<?php echo ($role === 'admin') ? 'Admin_menu.php' : 'user_menu.php'; ?>">menu</a></li>
                    <li><a href="event.php">Event</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <form class="reserve-form animate-up delay-2" id="EventForm" method="POST">
            <label for="event">กิจกรรมที่จะจอง หรือจัด</label>
            <select id="event" name="event">
                <option value="Wedding space">Wedding space</option>
                <option value="Shooting photo Studios no.1">Shooting photo Studios no.1</option>
                <option value="Shooting photo Studios no.2">Shooting photo Studios no.2</option>
                <option value="Shooting photo Studios no.3">Shooting photo Studios no.3</option>
                <option value="Meeting room">Meeting room</option>
                <option value="Private-Meeting">Private-Meeting</option>
            </select>

            <label for="name" class="animate-up delay-3">Username</label>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($isLoggedIn ? $username : ''); ?>" 
            <?php if ($isLoggedIn && $username !== 'admin') echo 'readonly'; ?>>

            <label for="phonenum" class="animate-up delay-4">เบอร์โทรศัพท์</label>
            <input type="text" id="phonenum" name="phonenum" required value="<?php echo htmlspecialchars($isLoggedIn ? $userPhone : ''); ?>"
            <?php if ($isLoggedIn && $username !== 'admin') echo 'readonly'; ?>>

            <label for="guests" class="animate-up delay-5">จำนวนผู้เข้ากิจกรรม</label>
            <input type="number" id="guests" name="guests" required>

            <label for="date" class="animate-up delay-6">Date</label>
            <input type="date" id="date" name="date" required>

            <label for="time" class="animate-up delay-7">Time</label>
            <select id="time" name="time" required>
                <option value="6:00 AM - 12:00 AM">6:00 AM - 12:00 AM</option>
                <option value="13:00 AM -18:00 PM">13:00 AM -18:00 PM</option>
                <option value="ทั้งวัน">ทั้งวัน</option>
            </select>

            <button type="submit" class="animate-up delay-8">จอง</button>
        </form>
        <div name="note" class="note" id="note"><p>หมายเหตู: สามารถจองได้เฉพาะผู้ที่เป็นสมาชิกเท่านั้น ต้องการสมัครสมาชิกสามารถคลิกที่ตรงนี้</p><a href="register.php">สมัครสมาชิก</a></div>
    </main>
<?php
    $loginAlert = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$isLoggedIn) {
    $loginAlert = '<div class="alert" style="color: black; text-align: center; margin: 30px 0;">กรุณาลงชื่อเข้าใช้ก่อนทำการจอง</div>';
    }
    echo $loginAlert;
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $isLoggedIn) {
        // เชื่อมต่อฐานข้อมูล
        require_once 'config.php';

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // รับข้อมูลจากฟอร์ม
        $event = $_POST['event'];
        $name = $_POST['name'];
        $phonenum = $_POST['phonenum'];
        $guests = $_POST['guests'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        // ตรวจสอบว่ามีการจองกิจกรรมอยู่แล้วหรือไม่ (ยกเว้น admin)
        if ($username !== 'admin') {
            $checkStmt = $conn->prepare("SELECT id FROM event_cm WHERE username = ?");
            $checkStmt->bind_param("s", $name);
            $checkStmt->execute();
            $checkStmt->store_result();
            if ($checkStmt->num_rows > 0) {
                echo '<div class="alert" style="color: red; text-align: center; margin: 30px 0;">คุณมีการจองกิจกรรมอยู่แล้ว ไม่สามารถจองซ้ำได้</div>';
                $checkStmt->close();
                $conn->close();
                exit();
            }
            $checkStmt->close();
        }

        // เตรียมคำสั่ง SQL
        $stmt = $conn->prepare("INSERT INTO event_cm ( event, username, phonenum, guests, date, time) VALUES ( ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $event, $name, $phonenum, $guests, $date, $time);

        // บันทึกข้อมูล
        if ($stmt->execute()) {
            header("Location: checkTables.php");
            exit();
        } else {
            echo "เกิดข้อผิดพลาด: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
?>

<?php
// ดึงวันที่ที่ถูกจองแล้วจาก table_cm และ event_cm
require_once 'config.php';
$bookedDates = [];
$result1 = $conn->query("SELECT date FROM table_cm");
while ($row = $result1->fetch_assoc()) {
    $bookedDates[] = $row['date'];
}
$result2 = $conn->query("SELECT date FROM event_cm");
while ($row = $result2->fetch_assoc()) {
    $bookedDates[] = $row['date'];
}
$conn->close();
?>
<script>
    // ส่งวันที่ที่ถูกจองไปยัง JS
    const bookedDates = <?php echo json_encode($bookedDates); ?>;
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        dateInput.addEventListener('input', function() {
            if (bookedDates.includes(this.value)) {
                alert('วันดังกล่าวถูกจองแล้ว กรุณาเลือกวันอื่น');
                this.value = '';
            }
        });
        // ปิดวันใน native date input (workaround)
        dateInput.addEventListener('keydown', function(e) {
            e.preventDefault();
        });
        dateInput.addEventListener('change', function() {
            if (bookedDates.includes(this.value)) {
                alert('วันดังกล่าวถูกจองแล้ว กรุณาเลือกวันอื่น');
                this.value = '';
            }
        });
        // ปิดวันในปฏิทิน (สำหรับ browser ที่รองรับ)
        dateInput.addEventListener('click', function() {
            this.setAttribute('min', new Date().toISOString().split('T')[0]);
        });
    });
</script>
</body>
</html>