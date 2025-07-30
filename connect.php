<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "blockchain_site"; // ← ชื่อตรงกับฐานข้อมูลใน phpMyAdmin

// สร้างการเชื่อมต่อ
$conn = new mysqli($host, $user, $pass, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("❌ การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// ตั้งค่าภาษาให้รองรับ UTF-8
$conn->set_charset("utf8");
?>  