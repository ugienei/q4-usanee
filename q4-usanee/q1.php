<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blueshop Promotions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        #product-list {
            margin-top: 20px;
        }

        #discount-info {
            margin-top: 20px;
            font-weight: bold;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
    <script>
        // Mock data สินค้า (ควรดึงจากฐานข้อมูลจริงผ่าน API)
        const products = [{
                id: 1,
                name: 'Product A',
                price: 300
            },
            {
                id: 2,
                name: 'Product B',
                price: 200
            },
            {
                id: 3,
                name: 'Product C',
                price: 150
            }
        ];

        const membershipSelect = document.getElementById('membership-status');
        const productList = document.getElementById('product-list');
        const discountInfo = document.getElementById('discount-info');
        const checkoutButton = document.getElementById('checkout-button');

        // แสดงสินค้าในหน้าเว็บ
        function displayProducts() {
            productList.innerHTML = '';
            products.forEach(product => {
                productList.innerHTML += `
            <div>
                <input type="checkbox" class="product-checkbox" data-id="${product.id}" data-price="${product.price}">
                ${product.name} - ราคา ${product.price} บาท
            </div>
        `;
            });
        }

        // คำนวณส่วนลด
        function calculateDiscount() {
            const selectedProducts = Array.from(document.querySelectorAll('.product-checkbox:checked'));
            const totalPrice = selectedProducts.reduce((sum, product) => sum + parseInt(product.dataset.price), 0);

            if (membershipSelect.value === 'member') {
                if (selectedProducts.length >= 1) {
                    discountInfo.textContent = 'สมาชิก: คุณสามารถเลือกสินค้าที่มีราคาเท่ากับหรือน้อยกว่าได้ฟรี 1 ชิ้น';
                } else {
                    discountInfo.textContent = '';
                }
            } else {
                if (totalPrice >= 500) {
                    discountInfo.textContent = 'ไม่เป็นสมาชิก: คุณสามารถเลือกสินค้าที่มีราคาเท่ากับหรือน้อยกว่าได้ฟรี 1 ชิ้น';
                } else {
                    discountInfo.textContent = 'ยอดซื้อไม่ถึง 500 บาท ไม่มีสิทธิ์รับสินค้าฟรี';
                }
            }
        }

        // เริ่มต้น
        membershipSelect.addEventListener('change', calculateDiscount);
        productList.addEventListener('change', calculateDiscount);
        checkoutButton.addEventListener('click', () => {
            alert('ดำเนินการสั่งซื้อเรียบร้อย');
        });

        displayProducts();
    </script>
</head>

<body>
    <h1>เลือกสินค้าของคุณ</h1>

    <label for="membership-status">สถานะสมาชิก:</label>
    <select id="membership-status">
        <option value="member">สมาชิก</option>
        <option value="non-member">ไม่เป็นสมาชิก</option>
    </select>

    <div id="product-list">
        <!-- รายการสินค้าจะถูกแสดงที่นี่ -->
    </div>

    <button id="checkout-button">ดำเนินการสั่งซื้อ</button>

    <div id="discount-info"></div>

    <script src="scripts.js"></script>
</body>

</html>

<!-- SELECT id, name, price FROM products;

SELECT membership_status FROM customers WHERE id = [customer_id]; -->
