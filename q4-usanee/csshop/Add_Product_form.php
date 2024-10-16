<?php include "connect.php";
  session_start();
  // ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
  if (empty($_SESSION["username"]) ) { 
      header("location: login.php");
  }
?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script src="mpage.js"></script>
  </head>
  <body>

    <header>
      <div class="logo">
        <img src="cslogo.jpg" width="200" alt="Site Logo">
      </div>
      <div class="search">
        <form>
          <input type="search" placeholder="Search the site...">
          <button>Search</button>
        </form>
      </div>
      <div class="login-box">
        <?php
            echo "<a ";
            if (empty($_SESSION["username"]) ) { 
              echo "href='login.php' class='login-bt'> login";
            }
            else{
              echo "href='logout.php' class='logout-bt'>".$_SESSION["username"];
            }
            echo "</a>";
        ?>
      </div>
    </header>

    <div class="mobile_bar">
      <a href="#"><img src="responsive-demo-home.gif" alt="Home"></a>
      <a href="#" onClick='toggle_visibility("menu"); return false;'><img src="responsive-demo-menu.gif" alt="Menu"></a>
    </div>

    <main>
      <article>
        <h1>เพิ่มสินค้า</h1>
          <div class="setcenter">
              <form action="Add_product.php" method="post" enctype="multipart/form-data" class="Product-edit-add-form">
                <label for="" class="label-form">ชื่อสินค้า</label>
                <input type="text" name="pname" required class="input-form"><br>
                <label for="" class="label-form">รายละเอียดสินค้า</label>
                <textarea name="pdetail" rows="3" cols="40" required class="input-form"></textarea><br>
                <label for="" class="label-form">ราคาสินค้า</label>
                <input type="number" name="price" required class="input-form"><br>
                <label for="" class="label-form">จำนวนสินค้า</label>
                <input type="number" name="qty" required class="input-form"><br>
                <label for="" class="label-form" class="input-form">รูปภาพสินค้า</label>
                <input type="file" accept=".jpg" name="image_upload" required><br>
                <div>
                  <button type="submit" name="submit" class="bt">เพิ่มสินค้า</button>
                  <a href="All_Product.php" class="cancel">ยกเลิก</a>
                </div>
              </form>
          </div>
      </article>
      <nav id="menu">
        <h2>Menu</h2>
        <ul class="menu">
          <li class="dead"><a href="mpage.php">Home</a></li>
          <li><a href="All_Product.php">All Products</a></li>
          <li><a href="Product_Table_list.php">Table of All Products</a></li>
          <li><a href="All_Member.php">All Member</a></li>
          <li><a href="Add_Product_form.php">Add Product</a></li>
          <li><a href="Add_Member_form.php">Add Member</a></li>
          <li><a href="hospital.php">Namelist Hospital</a></li>
          <li><a href="cart.php">Cart</a></li>
        </ul>
      </nav>
    </main>
    <footer>
      <a href="#">Sitemap</a>
      <a href="#">Contact</a>
      <a href="#">Privacy</a>
    </footer>
  </body>
</html>