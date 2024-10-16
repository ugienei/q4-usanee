<?php include "connect.php";
  session_start();
  // ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
  if (empty($_SESSION["username"]) ) { 
      header("location: login.php");
  }
?>
<?php
        $stmt = $pdo->prepare("SELECT * FROM product WHERE pid = ?");
        $stmt->bindParam(1, $_GET["pid"]);
        $stmt->execute();
        $row = $stmt->fetch();
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
    <script src="product.js"></script>
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
        <h1>รายละเอียดสินค้า</h1>
        <div class="product-list">
            <div class="product-image">
                <?php
                    if (!empty($row["pd_img"])) {
                        $imageData = base64_encode($row["pd_img"]);
                        echo "<img src='data:image/jpeg;base64," . $imageData . "' width='100'><br>";
                    } else {
                        echo "<p>No image available.</p><br>"; 
                    }
                ?>
            </div>
            <div class="product-more-detail">
                <?php
                    echo "<div class='product-detail'>";
                    echo "<label>รหัสสินค้า: </label>" . $row["pid"] . "<br>";
                    echo "<label>ชื่อสินค้า: </label>" . $row["pname"] . "<br>";
                    echo "<label style='height: 100px;'>รายละเอียดสินค้า: </label>" . $row["pdetail"] . "<br>";
                    echo "<label>ราคา: </label>" . $row["price"] . "บาท<br>";
                    echo "<div class='buy-back-bt'>";
                    echo "<form method='post' action='cart.php?action=add&pid=" . $row['pid']. "&pname=" . $row['pname']. "&price=".$row['price'] . "'>";
                    echo "<input type='number' name='qty' value='1' min='1' max='". $row['pstock'] ."' class='item-amount-bt'>";
                    echo "<input type='submit' value='ซื้อสินค้า' class='bt'>";
                    echo "</form>";
                    echo "<a href='All_Product.php' class='bt'>ย้อนกลับ</a>";
                    echo "<a href='Edit_Product_form.php?pid=". $row["pid"] . "' class='bt edit-bt2'>แก้ไข</a>";
                    echo "<a href='#' onclick=\"confirm_delete_product('{$row["pid"]}')\" class='bt delete-bt2'>ลบ</a>";
                    echo "</div>";
                ?>
            </div>
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