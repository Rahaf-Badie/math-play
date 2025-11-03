<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة الجمع - {{ $lesson_game->lesson->name }}</title>
    <style>
        /* ===== التنسيقات الأساسية ===== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            direction: rtl;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* ===== رأس اللعبة ===== */
        .game-header {
            margin-bottom: 30px;
        }

        .lesson-info {
            font-size: 1.1em;
            color: #666;
            margin-bottom: 10px;
        }

        h1 {
            color: #4a6fa5;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .instructions {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .range-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* ===== منطقة السلال ===== */
        .baskets-section {
            margin: 30px 0;
        }

        .baskets-container {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            gap: 25px;
            align-items: stretch;
        }

        @media (max-width: 768px) {
            .baskets-container {
                flex-direction: column;
                gap: 20px;
            }
        }

        .basket {
            flex: 1;
            background: #f8f9fa;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            min-height: 350px;
            display: flex;
            flex-direction: column;
            border: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .basket:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .basket1 {
            border-color: #ffb300;
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
        }

        .basket2 {
            border-color: #74b9ff;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        }

        .basket-header {
            font-size: 1.6rem;
            font-weight: bold;
            color: #2d3436;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid;
            position: relative;
        }

        .basket1 .basket-header {
            border-color: #ffb300;
            color: #e65100;
        }

        .basket2 .basket-header {
            border-color: #74b9ff;
            color: #0984e3;
        }

        .basket-count {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            background: currentColor;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .items-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            align-items: flex-start;
            flex-grow: 1;
            padding: 15px;
        }

        .item-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 8px;
            transition: all 0.3s ease;
        }

        .item-group:hover {
            transform: scale(1.05);
        }

        .items-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .item {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
        }

        .basket1 .item {
            background: linear-gradient(145deg, #ffb300, #ff8f00);
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .basket2 .item {
            background: linear-gradient(145deg, #74b9ff, #0984e3);
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .group-label {
            font-size: 0.9rem;
            color: #666;
            margin-top: 8px;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.8);
            padding: 4px 8px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* ===== منطقة الجمع ===== */
        .addition-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 20px;
            margin: 30px 0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #74b9ff;
        }

        .addition-expression {
            font-size: 2.8rem;
            font-weight: bold;
            margin: 20px 0;
            color: #2d3436;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .number-display {
            padding: 15px 25px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            min-width: 150px;
        }

        .basket1-number {
            border: 3px solid #ffb300;
            color: #e65100;
        }

        .basket2-number {
            border: 3px solid #74b9ff;
            color: #0984e3;
        }

        .operator {
            font-size: 3rem;
            color: #e91e63;
            margin: 0 10px;
            font-weight: 900;
        }

        .equals {
            font-size: 3rem;
            color: #00b894;
            margin: 0 10px;
            font-weight: 900;
        }

        .result-input {
            width: 200px;
            height: 80px;
            border: 4px solid #4a6fa5;
            border-radius: 15px;
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin: 0 10px;
            padding: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        .result-input:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 4px rgba(233, 30, 99, 0.3);
            transform: scale(1.05);
        }

        .result-input.correct {
            border-color: #00b894;
            background-color: #e8f5e9;
            color: #00b894;
        }

        .result-input.incorrect {
            border-color: #ff7675;
            background-color: #ffebee;
            color: #e84393;
        }

        /* ===== تفكيك القيمة المنزلية ===== */
        .breakdown-section {
            margin: 25px 0;
        }

        .place-value-breakdown {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .place-value {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            min-width: 140px;
            border: 2px solid;
            transition: all 0.3s ease;
        }

        .place-value:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .place-value.thousands { border-color: #e84393; }
        .place-value.hundreds { border-color: #fd79a8; }
        .place-value.tens { border-color: #74b9ff; }
        .place-value.ones { border-color: #81ecec; }

        .place-label {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .place-calculation {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2d3436;
            line-height: 1.5;
        }

        /* ===== التغذية الراجعة ===== */
        .feedback {
            font-size: 1.8rem;
            margin: 25px 0;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease;
            padding: 15px 30px;
            border-radius: 50px;
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        .feedback.success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            animation: celebrate 0.5s ease;
        }

        .feedback.error {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
            animation: shake 0.5s ease;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        /* ===== عناصر التحكم ===== */
        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .control-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            border: none;
            padding: 18px 35px;
            font-size: 1.2rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            min-width: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .control-btn:active {
            transform: translateY(1px);
        }

        .control-btn.success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
        }

        .control-btn.warning {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
        }

        /* ===== لوحة النقاط ===== */
        .score-board {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 3px dashed #74b9ff;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            background: #f8f9fa;
            min-width: 140px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 2px solid #74b9ff;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: bold;
            color: #0984e3;
            display: block;
            margin-top: 8px;
        }

        .stat-label {
            color: #666;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* ===== الرسوم المتحركة ===== */
        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* ===== التصميم المتجاوب ===== */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .addition-expression {
                font-size: 2.2rem;
                flex-direction: column;
                gap: 10px;
            }

            .result-input {
                width: 180px;
                height: 70px;
                font-size: 2.2rem;
            }

            .item {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }

            .controls {
                gap: 15px;
            }

            .control-btn {
                padding: 15px 25px;
                font-size: 1.1rem;
                min-width: 140px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .addition-expression {
                font-size: 1.8rem;
            }

            .result-input {
                width: 150px;
                height: 60px;
                font-size: 1.8rem;
            }

            .item {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .stats {
                flex-direction: column;
                gap: 15px;
            }

            .stat-item {
                min-width: 120px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- رأس اللعبة -->
        <div class="game-header">
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
            <h1>🧺 سلة الجمع</h1>
            <div class="instructions">احسب العدد الإجمالي للعناصر في السلتين</div>
            <div class="range-info">المدى: {{ $min_range }} إلى {{ $max_range }}</div>
        </div>

        <!-- منطقة السلال -->
        <div class="baskets-section">
            <div class="baskets-container">
                <!-- السلة الأولى -->
                <div class="basket basket1">
                    <div class="basket-header">
                        السلة الأولى
                        <div class="basket-count" id="basket1-count">0</div>
                    </div>
                    <div class="items-container" id="basket1-items">
                        <!-- سيتم إضافة العناصر هنا بالجافاسكريبت -->
                    </div>
                </div>

                <!-- السلة الثانية -->
                <div class="basket basket2">
                    <div class="basket-header">
                        السلة الثانية
                        <div class="basket-count" id="basket2-count">0</div>
                    </div>
                    <div class="items-container" id="basket2-items">
                        <!-- سيتم إضافة العناصر هنا بالجافاسكريبت -->
                    </div>
                </div>
            </div>
        </div>

        <!-- منطقة الجمع -->
        <div class="addition-section">
            <div class="addition-expression">
                <div class="number-display basket1-number" id="number1-display">0</div>
                <div class="operator">+</div>
                <div class="number-display basket2-number" id="number2-display">0</div>
                <div class="equals">=</div>
                <input type="number" class="result-input" id="result-input" placeholder="المجموع">
            </div>
        </div>

        <!-- تفكيك القيمة المنزلية -->
        <div class="breakdown-section">
            <div class="place-value-breakdown" id="place-value-breakdown">
                <!-- سيتم عرض تفكيك القيمة المنزلية هنا -->
            </div>
        </div>

        <!-- التغذية الراجعة -->
        <div class="feedback info" id="feedback">أدخل ناتج جمع العددين في المربع أعلاه</div>

        <!-- عناصر التحكم -->
        <div class="controls">
            <button id="check-btn" class="control-btn success">✓ تحقق من الإجابة</button>
            <button id="show-calculation-btn" class="control-btn warning">🔍 إظهار الحساب</button>
            <button id="next-btn" class="control-btn">🔄 سؤال جديد</button>
        </div>

        <!-- لوحة النقاط -->
        <div class="score-board">
            <div class="stats">
                <div class="stat-item">
                    <span class="stat-label">النقاط</span>
                    <span id="score-value" class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">الإجابات الصحيحة</span>
                    <span id="correct-answers" class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">المستوى</span>
                    <span id="level" class="stat-value">1</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">المسائل</span>
                    <span id="total-questions" class="stat-value">0</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ===== تهيئة المتغيرات =====
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};

        let number1 = 0;
        let number2 = 0;
        let correctResult = 0;
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let currentLevel = 1;
        let calculationShown = false;

        // ===== العناصر =====
        const basket1ItemsElement = document.getElementById('basket1-items');
        const basket2ItemsElement = document.getElementById('basket2-items');
        const basket1CountElement = document.getElementById('basket1-count');
        const basket2CountElement = document.getElementById('basket2-count');
        const number1DisplayElement = document.getElementById('number1-display');
        const number2DisplayElement = document.getElementById('number2-display');
        const placeValueBreakdownElement = document.getElementById('place-value-breakdown');
        const resultInput = document.getElementById('result-input');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const showCalculationButton = document.getElementById('show-calculation-btn');
        const nextButton = document.getElementById('next-btn');
        const scoreValueElement = document.getElementById('score-value');
        const correctAnswersElement = document.getElementById('correct-answers');
        const levelElement = document.getElementById('level');
        const totalQuestionsElement = document.getElementById('total-questions');

        // ===== الدوال الأساسية =====

        // إنشاء لعبة جديدة
        function createNewGame() {
            // توليد عددين عشوائيين ضمن المدى المحدد ودون حمل
            do {
                number1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                number2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            } while (hasCarry(number1, number2));

            correctResult = number1 + number2;

            // تحديث الواجهة
            updateDisplay();
            resetGameState();

            totalQuestions++;
            totalQuestionsElement.textContent = totalQuestions;

            // التركيز على حقل الإدخال
            setTimeout(() => resultInput.focus(), 100);
        }

        // التحقق من وجود حمل
        function hasCarry(num1, num2) {
            let n1 = num1;
            let n2 = num2;

            for (let i = 0; i < 4; i++) {
                const digit1 = n1 % 10;
                const digit2 = n2 % 10;

                if (digit1 + digit2 >= 10) {
                    return true; // يوجد حمل
                }

                n1 = Math.floor(n1 / 10);
                n2 = Math.floor(n2 / 10);
            }

            return false; // لا يوجد حمل
        }

        // تحديث العرض
        function updateDisplay() {
            // تحديث أرقام السلال
            basket1CountElement.textContent = number1;
            basket2CountElement.textContent = number2;
            number1DisplayElement.textContent = number1;
            number2DisplayElement.textContent = number2;

            // عرض العناصر في السلتين
            displayBasketItems();
        }

        // عرض العناصر في السلتين
        function displayBasketItems() {
            basket1ItemsElement.innerHTML = '';
            basket2ItemsElement.innerHTML = '';

            // تفكيك العدد الأول إلى مجموعات
            displayNumberInBasket(number1, basket1ItemsElement, 'basket1');

            // تفكيك العدد الثاني إلى مجموعات
            displayNumberInBasket(number2, basket2ItemsElement, 'basket2');
        }

        // عرض العدد في السلة كمجموعات
        function displayNumberInBasket(number, container, basketClass) {
            const thousands = Math.floor(number / 1000);
            const hundreds = Math.floor((number % 1000) / 100);
            const tens = Math.floor((number % 100) / 10);
            const ones = number % 10;

            // عرض الآلاف
            if (thousands > 0) {
                createItemGroup(container, thousands, '1000', `${thousands} × 1000`, basketClass);
            }

            // عرض المئات
            if (hundreds > 0) {
                createItemGroup(container, hundreds, '100', `${hundreds} × 100`, basketClass);
            }

            // عرض العشرات
            if (tens > 0) {
                createItemGroup(container, tens, '10', `${tens} × 10`, basketClass);
            }

            // عرض الآحاد
            if (ones > 0) {
                createItemGroup(container, ones, '1', `${ones} × 1`, basketClass);
            }
        }

        // إنشاء مجموعة عناصر
        function createItemGroup(container, count, value, label, basketClass) {
            const group = document.createElement('div');
            group.className = 'item-group';

            const itemsRow = document.createElement('div');
            itemsRow.className = 'items-row';

            // إنشاء العناصر الفردية (بحد أقصى 5 في الصف)
            const itemsPerRow = 5;
            const totalRows = Math.ceil(count / itemsPerRow);

            for (let row = 0; row < totalRows; row++) {
                const rowStart = row * itemsPerRow;
                const rowEnd = Math.min(rowStart + itemsPerRow, count);

                for (let i = rowStart; i < rowEnd; i++) {
                    const item = document.createElement('div');
                    item.className = `item ${basketClass}`;
                    item.textContent = value;
                    itemsRow.appendChild(item);
                }
            }

            group.appendChild(itemsRow);

            const labelElement = document.createElement('div');
            labelElement.className = 'group-label';
            labelElement.textContent = label;
            group.appendChild(labelElement);

            container.appendChild(group);
        }

        // إعادة تعيين حالة اللعبة
        function resetGameState() {
            resultInput.value = '';
            resultInput.className = 'result-input';
            placeValueBreakdownElement.innerHTML = '';
            feedbackElement.textContent = 'أدخل ناتج جمع العددين في المربع أعلاه';
            feedbackElement.className = 'feedback info';
            calculationShown = false;
        }

        // إظهار الحساب المفصل
        function showCalculation() {
            if (calculationShown) return;

            const thousands1 = Math.floor(number1 / 1000);
            const hundreds1 = Math.floor((number1 % 1000) / 100);
            const tens1 = Math.floor((number1 % 100) / 10);
            const ones1 = number1 % 10;

            const thousands2 = Math.floor(number2 / 1000);
            const hundreds2 = Math.floor((number2 % 1000) / 100);
            const tens2 = Math.floor((number2 % 100) / 10);
            const ones2 = number2 % 10;

            placeValueBreakdownElement.innerHTML = `
                <div class="place-value thousands">
                    <div class="place-label">الآلاف</div>
                    <div class="place-calculation">${thousands1} + ${thousands2} = ${thousands1 + thousands2}</div>
                </div>
                <div class="place-value hundreds">
                    <div class="place-label">المئات</div>
                    <div class="place-calculation">${hundreds1} + ${hundreds2} = ${hundreds1 + hundreds2}</div>
                </div>
                <div class="place-value tens">
                    <div class="place-label">العشرات</div>
                    <div class="place-calculation">${tens1} + ${tens2} = ${tens1 + tens2}</div>
                </div>
                <div class="place-value ones">
                    <div class="place-label">الآحاد</div>
                    <div class="place-calculation">${ones1} + ${ones2} = ${ones1 + ones2}</div>
                </div>
            `;

            calculationShown = true;
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseInt(resultInput.value);

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = 'يرجى إدخال الإجابة!';
                feedbackElement.className = 'feedback error';
                return;
            }

            if (userAnswer === correctResult) {
                // إجابة صحيحة
                feedbackElement.textContent = 'أحسنت! 🎉 الإجابة صحيحة';
                feedbackElement.className = 'feedback success';
                resultInput.className = 'result-input correct';

                score += currentLevel * 10;
                correctAnswers++;

                // تحديث المستوى
                if (correctAnswers % 5 === 0) {
                    currentLevel++;
                    levelElement.textContent = currentLevel;
                    feedbackElement.textContent += ` 🚀 تقدمت للمستوى ${currentLevel}!`;
                }

                // تحديث الإحصائيات
                updateStats();
            } else {
                // إجابة خاطئة
                feedbackElement.textContent = 'ليس صحيحاً! حاول مرة أخرى';
                feedbackElement.className = 'feedback error';
                resultInput.className = 'result-input incorrect';

                // إظهار التلميح تلقائياً بعد خطأ
                if (!calculationShown) {
                    showCalculation();
                }
            }
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreValueElement.textContent = score;
            correctAnswersElement.textContent = correctAnswers;
        }

        // ===== تهيئة الأحداث =====
        checkButton.addEventListener('click', checkAnswer);
        showCalculationButton.addEventListener('click', showCalculation);
        nextButton.addEventListener('click', createNewGame);

        // السماح بالتحقق باستخدام زر Enter
        resultInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                checkAnswer();
            }
        });

        // بدء اللعبة الأولى
        window.addEventListener('load', createNewGame);
    </script>
</body>
</html>
