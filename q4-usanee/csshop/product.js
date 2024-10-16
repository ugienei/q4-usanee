function ProductDetail(pid){
    document.location = "Product_detail.php?pid=" +pid;
}

function confirm_delete_product(pid){
    var ans = confirm("ต้องการลบสินค้ารหัส " + pid + " ใช่หรือไม่");
    if(ans == true)
    {
        document.location = "Delete_Product.php?pid=" +pid;
    }
}