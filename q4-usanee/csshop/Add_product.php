<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ามีการส่งข้อมูล
    if (!empty($_POST["pname"]) && !empty($_POST["pdetail"]) && !empty($_POST["price"]) && !empty($_POST["qty"]) && isset($_FILES['image_upload'])) {
        // ตรวจสอบการอัพโหลดไฟล์
        if ($_FILES['image_upload']['error'] == 0) {
            $ImageFile = file_get_contents($_FILES['image_upload']['tmp_name']);
            
            // เตรียมคำสั่ง SQL เพื่อเพิ่มข้อมูล
            $stmt = $pdo->prepare("INSERT INTO product (pname, pdetail, price, pd_img, pstock) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $_POST["pname"]);
            $stmt->bindParam(2, $_POST["pdetail"]);
            $stmt->bindParam(3, $_POST["price"]);
            $stmt->bindParam(4, $ImageFile, PDO::PARAM_LOB);
            $stmt->bindParam(5, $_POST["qty"]);
            
            // Execute statement
            if ($stmt->execute()) {
                header("location:All_Product.php");
                exit();
            } else {
                echo "เกิดข้อผิดพลาดในการเพิ่มสินค้า";
            }
        } else {
            echo "เกิดข้อผิดพลาดในการอัพโหลดไฟล์: " . $_FILES['image_upload']['error'];
        }
    } else {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน";
    }
}
?>
