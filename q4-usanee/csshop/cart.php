<?php

session_start();
if (empty($_SESSION["username"]) ) { 
	header("location: login.php");
}

// เพิ่มสินค้า
if ($_GET["action"]=="add") {

	$pid = $_GET['pid'];

	$cart_item = array(
 		'pid' => $pid,
		'pname' => $_GET['pname'],
		'price' => $_GET['price'],
		'qty' => $_POST['qty']
	);

	// ถ้ายังไม่มีสินค้าใดๆในรถเข็น
	if(empty($_SESSION['cart']))
    	$_SESSION['cart'] = array();
 
	// ถ้ามีสินค้านั้นอยู่แล้วให้บวกเพิ่ม
	if(array_key_exists($pid, $_SESSION['cart']))
		$_SESSION['cart'][$pid]['qty'] += $_POST['qty'];
 
	// หากยังไม่เคยเลือกสินค้นนั้นจะ
	else
	    $_SESSION['cart'][$pid] = $cart_item;

// ปรับปรุงจำนวนสินค้า
} else if ($_GET["action"]=="update") {
	$pid = $_GET["pid"];     
	$qty = $_GET["qty"];
	$_SESSION['cart'][$pid]['qty'] = $qty;

// ลบสินค้า
} else if ($_GET["action"]=="delete") {
	
	$pid = $_GET['pid'];
	unset($_SESSION['cart'][$pid]);
}
?>
<?php

?>

<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="mpage.js"></script>
    <script src="member.js"></script>
	<script>
		// ใช้สำหรับปรับปรุงจำนวนสินค้า
		function update(pid) {
			var qty = document.getElementById(pid).value;
			// ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
			document.location = "cart.php?action=update&pid=" + pid + "&qty=" + qty; 
		}
	</script>
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
        <h1>ตะกร้าสินค้าของ <?=$_SESSION["fullname"]?></h1>
        <div class="setcenter">
			<form>
				<table class="cart">
					<tr>
						<th>ชื่อสินค้า</th>
						<th>ราคา(บาท)</th>
						<th>จำนวน</th>
					</tr>
					<?php 
						$sum = 0;
						foreach ($_SESSION["cart"] as $item) {
							$sum += $item["price"] * $item["qty"];
					?>
						<tr>
							<td><?= $item["pname"] ?></td>
							<td><?php echo $item["price"]; ?></td>
							<td>			
								<div class="edit-delete-bt setcenter cart-bt">
									<input type="number" id="<?=$item["pid"]?>" value="<?=$item["qty"]?>" min="1" max="9" class="item-amount-bt">
									<a href="#" class="edit-bt" onclick="update(<?=$item["pid"]?>)">แก้ไข</a>
									<a class="delete-bt" href="?action=delete&pid=<?=$item["pid"]?>">ลบ</a>
								</div>
							</td>
						</tr>
					<?php } ?>
					<tr><td colspan="3" align="right"><b>รวม <?=$sum?> บาท</b></td></tr>
				</table>
			</form>
        </div>
		<div class="setcenter" style="margin-top: 3%;">
			<a href="All_Product.php" class="bt">เลือกสินค้าต่อ</a>
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