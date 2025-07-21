<?php
session_start(); // เริ่ม session

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
$isLoggedIn = isset($_SESSION['username']);
$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? 'user'; // ค่าเริ่มต้นเป็น user

    $userPhone = '';
        if ($isLoggedIn) {
            require_once 'config.php';
        $stmt = $conn->prepare("SELECT phonenum FROM member_cm WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($userPhone);
        $stmt->fetch();
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Think Cafe - Pre-Wedding</title>
    <link rel="stylesheet" href="css/wedding.css"> 
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
                <li><a href="reserveT.php">Reserve</a></li>
                <li><a href="<?php echo ($role === 'admin') ? 'Admin_menu.php' : 'user_menu.php'; ?>">menu</a></li>
                <li><a href="event.php" class="active">Event</a></li>
             <li class="dropdown">
                <a href="#" class="dropbtn">More ▼</a>
                <div class="dropdown-content">
                    <a href="wedding.php" class="active">Wedding</a>
                    <a href="studios.php">Studios</a>
                    <a href="meeting.php">Meeting</a>
                    <a href="Pmeeting.php">Private-meeting</a>
                </div>
              </li>
        </nav>
    </header>
    <main class="animate-up delay-2">
        <img src="img/weddingpackage.jpg"><br>
        <p class="animate-up delay-3">ทีมงาน BLOC EVENT ของพนักงานที่ทุ่มเทมุ่งมั่นที่จะทำให้เกินความคาดหมายทั้งหมดของคุณเมื่อถึงเวลาสร้างวันที่สมบูรณ์แบบของคุณ
            BLOC เป็นสถานที่ที่สมบูรณ์แบบในการจัดงานแต่งงานและกิจกรรมต่างๆ พื้นที่มีการออกแบบที่ไม่ซ้ำใครมากมายในพื้นที่ส่วนตัวอันงดงามรอบๆ พื้นที่ เพิ่มอาร์เรย์การออกแบบที่เป็นเอกลักษณ์ของคอนเทนเนอร์และต้นไม้ที่คุณรับประกันว่าจะทำให้แขกของคุณต้องว้าว
            งานแต่งงานและกิจกรรมของ BLOC เป็นมากกว่าการวางแผนงานแต่งงานและงานอีเวนต์ ทีมของเราจะให้การสนับสนุนอย่างเต็มที่แก่คุณและแขกของคุณ ช่วยเหลือด้วยคำแนะนำในการออกแบบและอาหารและสิ่งอื่นใดที่คุณจะต้องทำให้คุณจัดงานแต่งงานที่ทุกคนจะพูดถึงในอีกหลายปีข้างหน้า
            
            สำรองที่นั่ง : 085-370-6367, 086-555-8789
        </p>

            <button id="openReserveModal" class="animate-up delay-4">จองวัน (Wedding)</button>

            <!-- Modal Structure -->
            <div id="reserveModal" class="modal" style="display:none;">
                <div class="modal-content">
                    <span class="close" id="closeReserveModal" style="float:right;cursor:pointer;font-size:24px;">&times;</span>
                    <form class="reserve-form animate-up delay-2" id="EventForm" method="POST">
                        <label for="event">กิจกรรมที่จะจอง หรือจัด</label>
                        <select id="event" name="event">
                            <option value="Wedding space">Wedding space</option>
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
                    <div name="modal_note" class="modal_note" id="modal_note">
                    <p name="modal-note" class="modal-note" id="modal-note">หมายเหตู: สามารถจองได้เฉพาะผู้ที่เป็นสมาชิกเท่านั้น ต้องการสมัครสมาชิกสามารถคลิกที่ตรงนี้</p>
                    <a name="modal-register" class="modal-register" id="modal-register" href="register.php">สมัครสมาชิก</a>
                    </div>
                </div>
            </div>

            <style>
                .modal { 
                    position: fixed; 
                    z-index: 999; 
                    left: 0; 
                    top: 0; 
                    width: 100%; 
                    height: 100%; 
                    overflow: auto; 
                    background: rgba(0,0,0,0.4);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .modal-content { 
                    background: #fff; 
                    padding: 30px 20px;
                    border-radius: 8px; 
                    width: 90%; 
                    max-width: 600px;
                    max-height: 700px; 
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    box-shadow: 0 4px 24px rgba(0,0,0,0.18);
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    text-align: center;
                }
                .reserve-form {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    max-width: 300px;
                    margin: 0 auto;
                }
                .reserve-form label {
                    margin-top: 10px;
                    font-size: 16px;
                }
                .reserve-form select, 
                .reserve-form input {
                    margin-top: 5px;
                    padding: 5px;
                    width: 100%;
                    font-size: 16px;
                    border-radius: 5px;
                    border: 1px solid #ccc;
                }
                .reserve-form button {
                    margin-top: 20px;
                    margin-bottom: 10px;
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: black;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
                .reserve-form button:hover {
                    background-color: #333;
                }
                .modal-note {
                    padding-top: 2px;
                    padding-bottom: 2px;
                    margin-top: 0;
                    margin-bottom: 2px;
                    font-size: 14px;
                }

                .modal-register {
                    margin-top: 5px;
                    font-size: 14px;
                }

                /* Responsive Design */
                @media (max-width: 768px) {
                    .modal-content { 
                        padding: 16px 8px;
                        border-radius: 8px; 
                        width: 98vw; 
                        max-width: 350px;
                        max-height: 90vh; 
                        margin-top: 60px;
                    }
                    .reserve-form {
                        max-width: 250px;
                    }
                    .reserve-form label {
                        font-size: 15px;
                    }
                    .reserve-form select, 
                    .reserve-form input {
                        font-size: 15px;
                        padding: 4px;
                    }
                    .reserve-form button {
                        font-size: 15px;
                        padding: 8px 12px;
                    }
                    .modal-note, .modal-register {
                        font-size: 13px;
                    }
                }

                @media (max-width: 480px) {
                    .modal-content { 
                        padding: 16px 8px;
                        border-radius: 8px; 
                        width: 98vw; 
                        max-width: 350px;
                        max-height: 90vh; 
                        margin-top: 60px;
                    }
                    .reserve-form {
                        max-width: 250px;
                    }
                    .reserve-form label {
                        font-size: 15px;
                    }
                    .reserve-form select, 
                    .reserve-form input {
                        font-size: 15px;
                        padding: 4px;
                    }
                    .reserve-form button {
                        font-size: 15px;
                        padding: 8px 12px;
                    }
                    .modal-note, .modal-register {
                        font-size: 13px;
                    }
                }
            </style>

            <script>
                document.getElementById('openReserveModal').onclick = function() {
                    document.getElementById('reserveModal').style.display = 'block';
                };
                document.getElementById('closeReserveModal').onclick = function() {
                    document.getElementById('reserveModal').style.display = 'none';
                };
                window.onclick = function(event) {
                    if (event.target == document.getElementById('reserveModal')) {
                        document.getElementById('reserveModal').style.display = 'none';
                    }
                };
            </script>

            <?php
                $loginAlert = '';
                if ($_SERVER["REQUEST_METHOD"] == "POST" && !$isLoggedIn) {
                    $loginAlert = '<div class="alert" style="color: black; text-align: center; margin: 30px 0;">กรุณาลงชื่อเข้าใช้ก่อนทำการจอง</div>';
                }
                echo $loginAlert;

                if ($_SERVER["REQUEST_METHOD"] == "POST" && $isLoggedIn) {
                    require_once 'config.php';
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $event = $_POST['event'];
                    $name = $_POST['name'];
                    $phonenum = $_POST['phonenum'];
                    $guests = $_POST['guests'];
                    $date = $_POST['date'];
                    $time = $_POST['time'];

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

                    $countStmt = $conn->prepare("SELECT COUNT(*) FROM event_cm WHERE date = ?");
                    $countStmt->bind_param("s", $date);
                    $countStmt->execute();
                    $countStmt->bind_result($bookingCount);
                    $countStmt->fetch();
                    $countStmt->close();

                    if ($bookingCount >= 5) {
                        echo '<div class="alert" style="color: red; text-align: center; margin: 30px 0;">วันดังกล่าวมีการจองครบ 5 รายการแล้ว กรุณาเลือกวันอื่น</div>';
                        $conn->close();
                        exit();
                    }

                    $stmt = $conn->prepare("INSERT INTO event_cm ( event, username, phonenum, guests, date, time) VALUES ( ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssss", $event, $name, $phonenum, $guests, $date, $time);

                    if ($stmt->execute()) {
                        echo "<script>window.location.href='checkTables.php';</script>";
                        exit();
                    } else {
                        echo "เกิดข้อผิดพลาด: " . $stmt->error;
                    }

                    $stmt->close();
                    $conn->close();
                }

                // ดึงวันที่ที่ถูกจองแล้วจาก table_cm และ event_cm
                require_once 'config.php';
                $bookedDates = [];
                $dateCounts = [];
                $result1 = $conn->query("SELECT date, COUNT(*) as cnt FROM table_cm GROUP BY date");
                while ($row = $result1->fetch_assoc()) {
                    $dateCounts[$row['date']] = $row['cnt'];
                }
                $result2 = $conn->query("SELECT date FROM event_cm");
                while ($row = $result2->fetch_assoc()) {
                    if (isset($dateCounts[$row['date']])) {
                        $dateCounts[$row['date']] += 1;
                    } else {
                        $dateCounts[$row['date']] = 1;
                    }
                }
                $conn->close();
            ?>

            <script>
                const dateCounts = <?php echo json_encode($dateCounts); ?>;
                document.addEventListener('DOMContentLoaded', function() {
                    const dateInput = document.getElementById('date');
                    if (!dateInput) return;
                    dateInput.addEventListener('input', function() {
                        if (dateCounts[this.value] >= 5) {
                            alert('วันดังกล่าวมีการจองครบ 5 รายการแล้ว กรุณาเลือกวันอื่น');
                            this.value = '';
                        }
                    });
                    dateInput.addEventListener('keydown', function(e) {
                        e.preventDefault();
                    });
                    dateInput.addEventListener('change', function() {
                        if (dateCounts[this.value] >= 5) {
                            alert('วันดังกล่าวมีการจองครบ 5 รายการแล้ว กรุณาเลือกวันอื่น');
                            this.value = '';
                        }
                    });
                    dateInput.addEventListener('click', function() {
                        this.setAttribute('min', new Date().toISOString().split('T')[0]);
                    });
                });
            </script>
    </main>
</body>
</html>