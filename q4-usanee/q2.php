<!-- use ajax -->
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จำแนกประเภทโรงพยาบาล</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>รายชื่อโรงพยาบาลเอกชน</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>ชื่อโรงพยาบาล</th>
                <th>ขนาดใหญ่</th>
                <th>ขนาดกลาง</th>
                <th>ขนาดเล็ก</th>
            </tr>
        </thead>
        <tbody id="hospital-list">
            <!-- ตารางโรงพยาบาลจะถูกสร้างที่นี่ -->
        </tbody>
    </table>

    <script>
        const hospitalData = [
            { name: 'โรงพยาบาล A', num_bed: 100 },
            { name: 'โรงพยาบาล B', num_bed: 50 },
            { name: 'โรงพยาบาล C', num_bed: 20 }
        ];

        const hospitalList = document.getElementById('hospital-list');

        hospitalData.forEach((hospital, index) => {
            const tr = document.createElement('tr');
            
            const tdIndex = document.createElement('td');
            tdIndex.textContent = index + 1;

            const tdName = document.createElement('td');
            tdName.textContent = hospital.name;

            const tdLarge = document.createElement('td');
            const tdMedium = document.createElement('td');
            const tdSmall = document.createElement('td');

            if (hospital.num_bed > 90) {
                tdLarge.textContent = '✔';
            } else if (hospital.num_bed >= 31) {
                tdMedium.textContent = '✔';
            } else {
                tdSmall.textContent = '✔';
            }

            tr.appendChild(tdIndex);
            tr.appendChild(tdName);
            tr.appendChild(tdLarge);
            tr.appendChild(tdMedium);
            tr.appendChild(tdSmall);

            hospitalList.appendChild(tr);
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จำแนกประเภทโรงพยาบาล (AJAX)</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>รายชื่อโรงพยาบาลเอกชน</h1>

    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>ชื่อโรงพยาบาล</th>
                <th>ขนาดใหญ่</th>
                <th>ขนาดกลาง</th>
                <th>ขนาดเล็ก</th>
            </tr>
        </thead>
        <tbody id="hospital-list">
            <!-- ตารางโรงพยาบาลจะถูกสร้างที่นี่ -->
        </tbody>
    </table>

    <script>
        function loadHospitalData() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'priv_hos.json', true);

            xhr.onload = function() {
                if (this.status === 200) {
                    const hospitalData = JSON.parse(this.responseText);
                    const hospitalList = document.getElementById('hospital-list');

                    hospitalData.forEach((hospital, index) => {
                        const tr = document.createElement('tr');

                        const tdIndex = document.createElement('td');
                        tdIndex.textContent = index + 1;

                        const tdName = document.createElement('td');
                        tdName.textContent = hospital.name;

                        const tdLarge = document.createElement('td');
                        const tdMedium = document.createElement('td');
                        const tdSmall = document.createElement('td');

                        if (hospital.num_bed > 90) {
                            tdLarge.textContent = '✔';
                        } else if (hospital.num_bed >= 31) {
                            tdMedium.textContent = '✔';
                        } else {
                            tdSmall.textContent = '✔';
                        }

                        tr.appendChild(tdIndex);
                        tr.appendChild(tdName);
                        tr.appendChild(tdLarge);
                        tr.appendChild(tdMedium);
                        tr.appendChild(tdSmall);

                        hospitalList.appendChild(tr);
                    });
                }
            };

            xhr.send();
        }

        window.onload = loadHospitalData;
    </script>
</body>
</html>

