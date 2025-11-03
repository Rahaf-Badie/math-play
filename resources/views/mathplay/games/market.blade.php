<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سوق الكسور العشرية - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2d3436;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .lesson-info {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 1.3em;
        }

        .market-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 968px) {
            .market-layout {
                grid-template-columns: 1fr;
            }
        }

        .shop-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .shop-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .product-card {
            background: white;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .product-card.selected {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .product-icon {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.3em;
            font-weight: bold;
            color: #00b894;
            margin: 10px 0;
        }

        .cart-section {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .cart-display {
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 20px;
            min-height: 200px;
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .cart-total {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            text-align: center;
            font-size: 1.3em;
            font-weight: bold;
        }

        .money-input {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .input-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .input-label {
            font-weight: bold;
            color: #2d3436;
        }

        .money-input-field {
            width: 120px;
            height: 50px;
            border: 2px solid #ddd;
            border-radius: 8px;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .money-input-field:focus {
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
            outline: none;
        }

        .change-display {
            background: #d4edda;
            border: 2px solid #c3e6cb;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
            display: none;
        }

        .change-display.show {
            display: block;
            animation: slideDown 0.5s ease;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        #calculate-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #pay-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        #clear-cart-btn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        #new-customer-btn {
            background: linear-gradient(135deg, #a29bfe, #6c5ce7);
            color: white;
        }

        .back-btn {
            background: linear-gradient(135deg, #fd79a8, #e84393);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            font-size: 1.2em;
        }

        .success {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            animation: celebrate 0.5s ease;
        }

        .error {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        .info {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .money-bills {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .money-bill {
            background: #e8f4fd;
            border: 2px solid #74b9ff;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: bold;
            color: #0984e3;
        }

        .customer-message {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            text-align: center;
            font-style: italic;
            color: #666;
        }

        .fraction-price {
            font-size: 0.9em;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛒 سوق الكسور العشرية</h1>
            <p>تدرب على العمليات الحسابية مع الكسور العشرية في متجرنا!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="market-layout">
            <div class="shop-section">
                <h3 class="shop-title">🏪 متجرنا الممتع</h3>
                
                <div class="customer-message" id="customer-message">
                    مرحباً! أريد شراء بعض المنتجات. هل يمكنك مساعدتي في حساب المبلغ؟
                </div>
                
                <div class="products-grid" id="products-grid">
                    <!-- المنتجات ستظهر هنا -->
                </div>
            </div>
            
            <div class="cart-section">
                <h3 style="text-align: center; margin-bottom: 20px;">🛒 عربة التسوق</h3>
                
                <div class="cart-display" id="cart-display">
                    <!-- محتويات العربة ستظهر هنا -->
                </div>
                
                <div class="cart-total">
                    المجموع: <span id="total-amount">0.00</span> ريال
                </div>

                <div class="money-input">
                    <h4>💵 الدفع</h4>
                    <div class="input-group">
                        <span class="input-label">المبلغ المدفوع:</span>
                        <input type="number" step="0.01" id="paid-amount" class="money-input-field" placeholder="0.00">
                        <span style="font-weight: bold;">ريال</span>
                    </div>
                </div>

                <div class="change-display" id="change-display">
                    <!-- الباقي سيظهر هنا -->
                </div>

                <div class="controls">
                    <button id="calculate-btn">🧮 احسب الباقي</button>
                    <button id="pay-btn">💳 تأكيد الدفع</button>
                    <button id="clear-cart-btn">🗑️ تفريغ العربة</button>
                    <button id="new-customer-btn">👋 عميل جديد</button>
                    <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-btn">⬅️ العودة للدرس</a>
                </div>
                
                <div class="feedback" id="feedback">
                    اختر المنتجات ثم أدخل المبلغ المدفوع!
                </div>
            </div>
        </div>
        
        <div class="score-board">
            العملاء: <span id="customers-served">0</span> | 
            المبيعات: <span id="sales-count">0</span> |
            الأرباح: <span id="profit">0.00</span> ريال
        </div>
    </div>

    <script>
        // بيانات اللعبة
        const gameData = {
            customersServed: 0,
            salesCount: 0,
            profit: 0,
            cart: [],
            currentCustomer: null,
            products: [
                { id: 1, name: "تفاح", icon: "🍎", price: 2.5, fraction: "2.5 = 2 و 5/10" },
                { id: 2, name: "موز", icon: "🍌", price: 3.7, fraction: "3.7 = 3 و 7/10" },
                { id: 3, name: "برتقال", icon: "🍊", price: 4.2, fraction: "4.2 = 4 و 2/10" },
                { id: 4, name: "فراولة", icon: "🍓", price: 6.8, fraction: "6.8 = 6 و 8/10" },
                { id: 5, name: "عنب", icon: "🍇", price: 5.5, fraction: "5.5 = 5 و 5/10" },
                { id: 6, name: "بطيخ", icon: "🍉", price: 12.9, fraction: "12.9 = 12 و 9/10" }
            ]
        };

        // عناصر DOM
        const customerMessageElement = document.getElementById('customer-message');
        const productsGridElement = document.getElementById('products-grid');
        const cartDisplayElement = document.getElementById('cart-display');
        const totalAmountElement = document.getElementById('total-amount');
        const paidAmountInput = document.getElementById('paid-amount');
        const changeDisplayElement = document.getElementById('change-display');
        const customersServedElement = document.getElementById('customers-served');
        const salesCountElement = document.getElementById('sales-count');
        const profitElement = document.getElementById('profit');
        const feedbackElement = document.getElementById('feedback');
        const calculateBtn = document.getElementById('calculate-btn');
        const payBtn = document.getElementById('pay-btn');
        const clearCartBtn = document.getElementById('clear-cart-btn');
        const newCustomerBtn = document.getElementById('new-customer-btn');

        // تهيئة اللعبة
        function initGame() {
            setupProducts();
            generateCustomer();
            updateUI();
        }

        // إعداد المنتجات
        function setupProducts() {
            productsGridElement.innerHTML = '';
            
            gameData.products.forEach(product => {
                const productElement = document.createElement('div');
                productElement.className = 'product-card';
                productElement.innerHTML = `
                    <div class="product-icon">${product.icon}</div>
                    <div class="product-name">${product.name}</div>
                    <div class="product-price">${product.price.toFixed(1)} ريال</div>
                    <div class="fraction-price">${product.fraction}</div>
                `;
                productElement.addEventListener('click', () => addToCart(product));
                productsGridElement.appendChild(productElement);
            });
        }

        // توليد عميل جديد
        function generateCustomer() {
            const customerTypes = [
                {
                    message: "أريد شراء بعض الفواكه لتحضير سلطة فواكه!",
                    products: getRandomProducts(2)
                },
                {
                    message: "ابني يحب الفواكه، سأشتري له أنواع مختلفة!",
                    products: getRandomProducts(3)
                },
                {
                    message: "أحتاج فواكه لعمل عصير طازج!",
                    products: getRandomProducts(2)
                },
                {
                    message: "سأزور أصدقائي وأريد أخذ هدايا من الفواكه!",
                    products: getRandomProducts(4)
                }
            ];
            
            gameData.currentCustomer = customerTypes[Math.floor(Math.random() * customerTypes.length)];
            customerMessageElement.textContent = gameData.currentCustomer.message;
            
            // إضافة منتجات العميل تلقائياً للسلة
            gameData.cart = [...gameData.currentCustomer.products];
            updateCart();
        }

        // الحصول على منتجات عشوائية
        function getRandomProducts(count) {
            const shuffled = [...gameData.products].sort(() => 0.5 - Math.random());
            return shuffled.slice(0, count);
        }

        // إضافة منتج للسلة
        function addToCart(product) {
            gameData.cart.push(product);
            updateCart();
            showFeedback(`✅ تم إضافة ${product.name} إلى السلة`, 'success');
        }

        // تحديث عربة التسوق
        function updateCart() {
            cartDisplayElement.innerHTML = '';
            
            if (gameData.cart.length === 0) {
                cartDisplayElement.innerHTML = '<div style="text-align: center; color: #666; margin-top: 50px;">السلة فارغة</div>';
                totalAmountElement.textContent = '0.0';
                return;
            }
            
            let total = 0;
            
            gameData.cart.forEach((product, index) => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <div>
                        <span style="font-weight: bold;">${product.icon} ${product.name}</span>
                        <div style="font-size: 0.8em; color: #666;">${product.fraction}</div>
                    </div>
                    <div>
                        <span style="color: #00b894; font-weight: bold;">${product.price.toFixed(1)} ريال</span>
                    </div>
                `;
                cartDisplayElement.appendChild(cartItem);
                total += product.price;
            });
            
            totalAmountElement.textContent = total.toFixed(1);
        }

        // حساب الباقي
        function calculateChange() {
            const total = parseFloat(totalAmountElement.textContent);
            const paid = parseFloat(paidAmountInput.value);
            
            if (isNaN(paid) || paid < total) {
                showFeedback('❌ المبلغ المدفوع غير كافي!', 'error');
                return;
            }
            
            const change = paid - total;
            
            changeDisplayElement.innerHTML = `
                <h4>💰 الباقي: ${change.toFixed(1)} ريال</h4>
                <div style="margin-top: 10px;">
                    <strong>طريقة إعادة الباقي:</strong>
                </div>
                <div class="money-bills">
                    ${calculateMoneyBills(change)}
                </div>
            `;
            
            changeDisplayElement.classList.add('show');
            payBtn.disabled = false;
            
            showFeedback(`✅ الباقي ${change.toFixed(1)} ريال - جاهز للتأكيد`, 'success');
        }

        // حساب فئات النقود
        function calculateMoneyBills(amount) {
            const bills = [10, 5, 1, 0.5];
            let remaining = amount;
            let result = [];
            
            bills.forEach(bill => {
                if (remaining >= bill) {
                    const count = Math.floor(remaining / bill);
                    remaining = parseFloat((remaining - count * bill).toFixed(1));
                    if (count > 0) {
                        result.push(`<div class="money-bill">${count} × ${bill} ريال</div>`);
                    }
                }
            });
            
            return result.join('');
        }

        // تأكيد الدفع
        function confirmPayment() {
            const total = parseFloat(totalAmountElement.textContent);
            
            gameData.salesCount++;
            gameData.profit += total;
            gameData.customersServed++;
            
            showFeedback('🎉 تمت العملية بنجاح! شكراً لك', 'success');
            
            // تعطيل الأزرار مؤقتاً
            payBtn.disabled = true;
            calculateBtn.disabled = true;
            
            updateUI();
        }

        // تفريغ العربة
        function clearCart() {
            gameData.cart = [];
            updateCart();
            paidAmountInput.value = '';
            changeDisplayElement.classList.remove('show');
            showFeedback('🗑️ تم تفريغ العربة', 'info');
        }

        // عميل جديد
        function newCustomer() {
            gameData.cart = [];
            generateCustomer();
            paidAmountInput.value = '';
            changeDisplayElement.classList.remove('show');
            calculateBtn.disabled = false;
            showFeedback('👋 مرحباً بعميل جديد!', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            customersServedElement.textContent = gameData.customersServed;
            salesCountElement.textContent = gameData.salesCount;
            profitElement.textContent = gameData.profit.toFixed(1);
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        calculateBtn.addEventListener('click', calculateChange);
        payBtn.addEventListener('click', confirmPayment);
        clearCartBtn.addEventListener('click', clearCart);
        newCustomerBtn.addEventListener('click', newCustomer);

        // السماح بالضغط على Enter لحساب الباقي
        paidAmountInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') calculateChange();
        });

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>