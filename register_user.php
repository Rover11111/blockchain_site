<?php
require 'connect.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// ตรวจสอบ Username ซ้ำ
$stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username=?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if(mysqli_stmt_num_rows($stmt) > 0){
    echo "ชื่อผู้ใช้นี้ถูกใช้แล้ว";
}else{
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);
    if(mysqli_stmt_execute($stmt)){
        header("Location: login.html");
        exit();
    }else{
        echo "เกิดข้อผิดพลาด: ".mysqli_error($conn);
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
