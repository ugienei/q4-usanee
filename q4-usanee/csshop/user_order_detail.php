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
        <h1>Order ของ <?=$_GET['username']?></h1>
        <div class="setcenter">
            <?php
                $stmt2 = $pdo->prepare("SELECT orders.ord_id AS 'รหัสคำสั่งซื้อ',product.pname AS 'pname',quantity,(product.price * item.quantity) AS 'ราคารวม' FROM orders JOIN item ON orders.ord_id = item.ord_id JOIN product ON item.pid = product.pid WHERE orders.username = ? ");
                $stmt2->bindParam(1,$_GET['username']);
                $stmt2->execute();
                echo "<table class='order-table'>";
                echo "<tr>";
                echo "<th>รหัสคำสั่งซื้อ</th>";
                echo "<th>ชื่อสินค้า</th>";
                echo "<th>จำนวน</th>";
                echo "<th>ราคารวม(บาท)</th>";
                echo "</tr>";
                while ($order = $stmt2->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $order ["รหัสคำสั่งซื้อ"] . "</td>";
                    echo "<td>" . $order ["pname"] . "</td>";
                    echo "<td>" . $order ["quantity"] . "</td>";
                    echo "<td>" . $order ["ราคารวม"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            ?>
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