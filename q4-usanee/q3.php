<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกโรงพยาบาลขนาดใหญ่</title>
</head>
<body>
    <h1>เลือกโรงพยาบาลขนาดใหญ่</h1>

    <label for="hospital-select">ชื่อโรงพยาบาล:</label>
    <select id="hospital-select">
        <option value="">-- กรุณาเลือกโรงพยาบาล --</option>
    </select>

    <script>
        // ฟังก์ชันดึงข้อมูลโรงพยาบาลขนาดใหญ่จาก JSON
        function loadLargeHospitals() {
            fetch('priv_hos.json') // URL ของไฟล์ JSON ของคุณ
                .then(response => response.json())
                .then(data => {
                    const hospitalSelect = document.getElementById('hospital-select');
                    const largeHospitals = data.features.filter(hospital => hospital.properties.num_bed > 90);

                    // เพิ่มโรงพยาบาลขนาดใหญ่ใน Drop-Down List
                    largeHospitals.forEach(hospital => {
                        const option = document.createElement('option');
                        option.value = hospital.properties.name;
                        option.textContent = hospital.properties.name;
                        hospitalSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // เรียกฟังก์ชันเมื่อหน้าโหลดเสร็จ
        window.onload = loadLargeHospitals;
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกโรงพยาบาลขนาดใหญ่</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>เลือกโรงพยาบาลขนาดใหญ่</h1>

    <label for="hospital-select">ชื่อโรงพยาบาล:</label>
    <select id="hospital-select">
        <option value="">-- กรุณาเลือกโรงพยาบาล --</option>
    </select>

    <!-- ตารางแสดงข้อมูลโรงพยาบาล -->
    <table id="hospital-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>ชื่อโรงพยาบาล</th>
                <th>จำนวนเตียง</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3">กรุณาเลือกโรงพยาบาลจาก Drop-Down</td>
            </tr>
        </tbody>
    </table>

    <script>
        let largeHospitals = [];

        // ฟังก์ชันดึงข้อมูลโรงพยาบาลขนาดใหญ่จาก JSON
        function loadLargeHospitals() {
            fetch('priv_hos.json') // URL ของไฟล์ JSON ของคุณ
                .then(response => response.json())
                .then(data => {
                    const hospitalSelect = document.getElementById('hospital-select');
                    largeHospitals = data.features.filter(hospital => hospital.properties.num_bed > 90);

                    // เพิ่มโรงพยาบาลขนาดใหญ่ใน Drop-Down List
                    largeHospitals.forEach((hospital, index) => {
                        const option = document.createElement('option');
                        option.value = index;  // เก็บ index เพื่อง่ายต่อการใช้งาน
                        option.textContent = hospital.properties.name;
                        hospitalSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // ฟังก์ชันแสดงข้อมูลโรงพยาบาลในตาราง
        function showHospitalInTable(index) {
            const hospitalTableBody = document.querySelector("#hospital-table tbody");

            // ล้างข้อมูลตารางเก่า
            hospitalTableBody.innerHTML = '';

            // ตรวจสอบว่ามีการเลือกโรงพยาบาลหรือไม่
            if (index === "") {
                const row = document.createElement('tr');
                const cell = document.createElement('td');
                cell.colSpan = 3;
                cell.textContent = 'กรุณาเลือกโรงพยาบาลจาก Drop-Down';
                row.appendChild(cell);
                hospitalTableBody.appendChild(row);
            } else {
                // ดึงข้อมูลโรงพยาบาลที่เลือกจาก largeHospitals
                const selectedHospital = largeHospitals[index].properties;

                // สร้างแถวข้อมูล
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${parseInt(index) + 1}</td>
                    <td>${selectedHospital.name}</td>
                    <td>${selectedHospital.num_bed}</td>
                `;

                // เพิ่มแถวลงในตาราง
                hospitalTableBody.appendChild(row);
            }
        }

        // เรียกฟังก์ชันเมื่อหน้าโหลดเสร็จ
        window.onload = () => {
            loadLargeHospitals();

            // ตรวจสอบการเลือกโรงพยาบาล
            const hospitalSelect = document.getElementById('hospital-select');
            hospitalSelect.addEventListener('change', function() {
                showHospitalInTable(this.value);
            });
        };
    </script>
</body>
</html>



<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตารางโรงพยาบาลขนาดใหญ่</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>โรงพยาบาลขนาดใหญ่</h1>

    <!-- Drop-Down สำหรับเลือกโรงพยาบาล -->
    <label for="hospital-select">เลือกโรงพยาบาล:</label>
    <select id="hospital-select">
        <option value="">-- กรุณาเลือกโรงพยาบาล --</option>
    </select>

    <!-- ตารางแสดงข้อมูลโรงพยาบาล -->
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>ชื่อโรงพยาบาล</th>
                <th>จำนวนเตียง</th>
            </tr>
        </thead>
        <tbody id="hospital-list">
            <!-- ตารางโรงพยาบาลจะถูกสร้างที่นี่ -->
        </tbody>
    </table>

    <script>
        let largeHospitals = [];

        // ฟังก์ชันดึงข้อมูลโรงพยาบาลขนาดใหญ่จาก JSON
        function loadLargeHospitals() {
            fetch('priv_hos.json') // URL ของไฟล์ JSON
                .then(response => response.json())
                .then(data => {
                    largeHospitals = data.features.filter(hospital => hospital.properties.num_bed > 90);

                    // เพิ่มรายชื่อโรงพยาบาลใน Drop-Down
                    const hospitalSelect = document.getElementById('hospital-select');
                    largeHospitals.forEach((hospital, index) => {
                        const option = document.createElement('option');
                        option.value = index;
                        option.textContent = hospital.properties.name;
                        hospitalSelect.appendChild(option);
                    });

                    // สร้างตารางข้อมูลโรงพยาบาลทันทีหลังจากดึงข้อมูลมา
                    displayHospitalsInTable();
                })
                .catch(error => console.error('Error:', error));
        }

        // ฟังก์ชันแสดงข้อมูลโรงพยาบาลในตาราง
        function displayHospitalsInTable() {
            const hospitalList = document.getElementById('hospital-list');
            hospitalList.innerHTML = ''; // เคลียร์ข้อมูลเก่า

            // วนลูปสร้างแถวในตารางสำหรับโรงพยาบาลขนาดใหญ่
            largeHospitals.forEach((hospital, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${hospital.properties.name}</td>
                    <td>${hospital.properties.num_bed}</td>
                `;
                hospitalList.appendChild(row);
            });
        }

        // เรียกฟังก์ชันเมื่อหน้าโหลดเสร็จ
        window.onload = () => {
            loadLargeHospitals();
        };
    </script>
</body>
</html>
