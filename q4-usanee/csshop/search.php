<?php
    include "connect.php";

    $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
    $stmt->bindParam(1,$_GET["keyword"]);
    $stmt->execute();
    $row = $stmt->fetch();
    if(!empty($row)){
        echo "<a href='Member_detail.php?username=" . $row["username"] . "'>";
        if (!empty($row["profile"])) {
            $Profile = base64_encode($row["profile"]);
            echo "<img src='data:image/jpeg;base64," . $Profile . "' width='100'><br>";
        } else {
            echo "No image available.<br>"; 
        }
        echo "</a>";
        echo "<label>ชื่อสมาชิก: " . $row ["name"] . "</label><br>";
        echo "<label>ที่อยู่: " . $row ["address"] . "</label><br>";
        echo "<label>อีเมล์: " . $row ["email"] . "</label><br>";
        echo "<div class='edit-delete-bt'>";
        echo "<a href='Edit_Member_form.php?username=" . $row["username"] . "' class='edit-bt'>แก้ไข</a>";
        echo "<a href='#' onclick=\"confirm_delete_member('{$row["username"]}')\" class='delete-bt'>ลบ</a>";
        echo "</div>";
        echo "<hr>\n";
    }else{
        echo "ไม่พบข้อมูลสมาชิก " . $_GET["keyword"];
    }