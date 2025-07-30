<?php
session_start();
require 'connect.php';

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;

                // ✅ อัปเดตจำนวนผู้เข้าชม (แก้ LIMIT เป็น WHERE id = 1)
                $update = $conn->query("UPDATE stats SET total_visits = total_visits + 1 WHERE id = 1");
                if (!$update) {
                    echo "❌ ไม่สามารถอัปเดตจำนวนผู้เข้าชม: " . $conn->error;
                    exit();
                }

                // ✅ บันทึก log การล็อกอิน
                $logStmt = $conn->prepare("INSERT INTO login_logs (username) VALUES (?)");
                if ($logStmt) {
                    $logStmt->bind_param("s", $username);
                    $logStmt->execute();
                }

                // ✅ เปลี่ยนหน้าไป index.php
                header("Location: index.php");
                exit();
            } else {
                echo "❌ รหัสผ่านไม่ถูกต้อง";
            }
        } else {
            echo "❌ ไม่พบชื่อผู้ใช้นี้";
        }
    } else {
        echo "⚠️ กรุณากรอกข้อมูลให้ครบถ้วน";
    }
} else {
    echo "⚠️ การเรียกใช้งานไม่ถูกต้อง";
}
?>
