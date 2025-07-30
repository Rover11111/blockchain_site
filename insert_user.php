<?php
require 'connect.php';

$username = "user1";
$password = password_hash("pass1234", PASSWORD_DEFAULT); // เก็บรหัสแบบเข้ารหัส
$email = "user1@example.com";

$sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);

if (mysqli_stmt_execute($stmt)) {
    echo "เพิ่มข้อมูลสำเร็จ!";
} else {
    echo "ผิดพลาด: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
