function confirm_delete_member(username){
    var ans = confirm("ต้องการลบผุ้ใช้ " + username + " ใช่หรือไม่");
    if(ans == true)
    {
        document.location = "Delete_Member.php?username=" +username;
    }
}

function view_more(username){
    console.log("Going to user_order_detail.php for user: " + username);
    document.location = "user_order_detail.php?username=" + username;
}
