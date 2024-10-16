<body>
    <?php include "connect.php";
    session_start();
    // ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
    if (empty($_SESSION["username"])) {
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
        <title>โรงพยาบาลเอกชนในกรุงเทพ</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="mpage.js"></script>
        <script src="member.js"></script>
        <script>
        async function getDataFromAPI() {
            try {
                // ดึงข้อมูลจาก URL ที่กำหนด
                let response = await fetch('http://202.44.40.193/~aws/JSON/priv_hos.json');

                // ตรวจสอบสถานะการตอบกลับ
                if (!response.ok) {
                    console.error("Error: Cannot fetch data from API");
                    return;
                }

                // อ่านข้อมูล JSON
                let rawData = await response.text();
                let objectData = JSON.parse(rawData);

                // สร้าง arrays เพื่อแยกโรงพยาบาลตามขนาด
                let largeHospitals = [];
                let mediumHospitals = [];
                let smallHospitals = [];

                // วนลูปผ่านข้อมูลที่ดึงมาและแยกประเภทโรงพยาบาลตามจำนวนเตียง
                for (let i = 0; i < objectData.features.length; i++) {
                    let hospital = objectData.features[i].properties;
                    let numBed = hospital.num_bed;

                    if (numBed > 90) {
                        largeHospitals.push(hospital);
                    } else if (numBed >= 31) {
                        mediumHospitals.push(hospital);
                    } else {
                        smallHospitals.push(hospital);
                    }
                }

                // สร้างฟังก์ชันแสดงรายการโรงพยาบาลตามประเภท
                function displayHospitals(hospitals, category) {
                    // เข้าถึง <ul> ที่มี id="result"
                    let result = document.getElementById('result');

                    // สร้างหัวข้อสำหรับประเภทโรงพยาบาล พร้อมแสดงจำนวน
                    let header = document.createElement('h2');
                    header.textContent = `${category} (${hospitals.length} แห่ง)`;
                    result.appendChild(header);

                    // สร้าง <ol> สำหรับโรงพยาบาลในแต่ละประเภท
                    let list = document.createElement('ol');

                    // วนลูปผ่านข้อมูลโรงพยาบาลแต่ละประเภท
                    hospitals.forEach((hospital, index) => {
                        let numBed = hospital.num_bed;
                        let content = `ชื่อโรงพยาบาล: ${hospital.name} (${numBed} เตียง)`;
                        let li = document.createElement('li');
                        li.textContent = content;
                        list.appendChild(li);
                    });

                    // เพิ่มรายการลงในผลลัพธ์
                    result.appendChild(list);
                }

                // เรียกฟังก์ชันเพื่อแสดงโรงพยาบาลตามประเภทต่างๆ พร้อมแสดงจำนวน
                displayHospitals(largeHospitals, "โรงพยาบาลขนาดใหญ่");
                displayHospitals(mediumHospitals, "โรงพยาบาลขนาดกลาง");
                displayHospitals(smallHospitals, "โรงพยาบาลขนาดเล็ก");

            } catch (error) {
                console.error("Error: " + error.message);
            }
        }

        // เรียกฟังก์ชันเพื่อดึงข้อมูลจาก API
        getDataFromAPI();
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
                if (empty($_SESSION["username"])) {
                    echo "href='login.php' class='login-bt'> login";
                } else {
                    echo "href='logout.php' class='logout-bt'>" . $_SESSION["username"];
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
                <h1>โรงพยาบาลเอกชนใน กทม.</h1>
                <div id="result"></div>
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
</body>

</html>