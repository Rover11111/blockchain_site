<?php
require 'connect.php';

$sql = "SELECT id, username, email FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // แสดงผลแต่ละแถว
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"]. 
        " - Username: " . $row["username"]. 
        " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "ไม่พบข้อมูล";
}

mysqli_close($conn);
?>