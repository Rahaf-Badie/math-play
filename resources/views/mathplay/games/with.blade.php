<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الطرح مع الاستلاف - {{ $lesson_game->lesson->name }}</title>
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

        .level-badge {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: bold;
            margin-left: 10px;
        }

        /* ===== منطقة المسألة الرئيسية ===== */
        .main-problem {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 20px;
            margin: 30px 0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #74b9ff;
        }

        .problem-display {
            font-size: 2.8rem;
            font-weight: bold;
            margin: 20px 0;
            color: #2d3436;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .number-display {
            padding: 20px 30px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            border: 3px solid;
            transition: all 0.3s ease;
        }

        .minuend-display {
            border-color: #ffb300;
            color: #e65100;
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
        }

        .subtrahend-display {
            border-color: #74b9ff;
            color: #0984e3;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        }

        .operator {
            font-size: 3.5rem;
            color: #e91e63;
            margin: 0 15px;
            font-weight: 900;
        }

        .equals {
            font-size: 3rem;
            color: #00b894;
            margin: 0 15px;
            font-weight: 900;
        }

        /* ===== الطرح العمودي ===== */
        .vertical-subtraction-container {
            margin: 30px 0;
            padding: 25px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border: 2px solid #e3f2fd;
        }

        .vertical-subtraction {
            display: inline-block;
            text-align: left;
            direction: ltr;
            font-family: 'Courier New', monospace;
            font-size: 2.2rem;
            margin: 20px 0;
            padding: 25px;
            background: white;
            border-radius: 12px;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-width: 400px;
        }

        .subtraction-row {
            display: flex;
            justify-content: flex-end;
            margin: 12px 0;
            position: relative;
            min-height: 70px;
        }

        .digit-cell {
            width: 65px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 6px;
            font-weight: bold;
            position: relative;
            transition: all 0.3s ease;
        }

        .minuend-row {
            border-bottom: 3px solid #4a6fa5;
            padding-bottom: 12px;
        }

        .subtrahend-row {
            padding-bottom: 8px;
        }

        .minus-sign {
            margin-right: 20px;
            color: #e91e63;
            font-weight: bold;
            font-size: 2.5rem;
        }

        .result-row {
            border-top: 3px solid #4a6fa5;
            padding-top: 12px;
            margin-top: 12px;
        }

        /* ===== مؤشرات الاستلاف ===== */
        .borrow-section {
            margin: 20px 0;
        }

        .borrow-indicators {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
            padding: 0 20px;
        }

        .borrow-indicator {
            width: 65px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 6px;
            position: relative;
        }

        .borrow-input {
            width: 50px;
            height: 50px;
            border: 3px dashed #ff5722;
            border-radius: 50%;
            font-size: 1.4rem;
            font-weight: bold;
            text-align: center;
            background: #fff3e0;
            transition: all 0.3s ease;
        }

        .borrow-input:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.3);
            background: #ffecb3;
        }

        .borrow-input.correct {
            border-color: #00b894;
            background-color: #e8f5e9;
            border-style: solid;
        }

        /* ===== خانات الإدخال ===== */
        .input-cell {
            width: 65px;
            height: 75px;
            border: 3px solid #4a6fa5;
            border-radius: 10px;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            background: white;
            margin: 0 6px;
            transition: all 0.3s ease;
        }

        .input-cell:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.3);
            transform: scale(1.05);
        }

        .input-cell.correct {
            border-color: #00b894;
            background-color: #e8f5e9;
            color: #00b894;
        }

        .input-cell.incorrect {
            border-color: #ff7675;
            background-color: #ffebee;
            color: #e84393;
        }

        /* ===== تسميات المنازل ===== */
        .place-labels {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            margin: 15px 0;
            padding: 0 20px;
        }

        .place-label {
            width: 65px;
            text-align: center;
            font-size: 1rem;
            color: #666;
            font-weight: bold;
            background: #e3f2fd;
            padding: 8px 5px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* ===== خطوات الحل ===== */
        .steps-section {
            background: #e3f2fd;
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            border: 2px solid #74b9ff;
        }

        .steps-container {
            text-align: right;
        }

        .step {
            margin: 20px 0;
            font-size: 1.2rem;
            display: none;
            padding: 20px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-right: 5px solid #74b9ff;
            transition: all 0.3s ease;
        }

        .step.active {
            display: block;
            animation: fadeIn 0.5s ease;
            border-right-color: #e91e63;
        }

        .step-number {
            display: inline-block;
            width: 35px;
            height: 35px;
            background: #4a6fa5;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 35px;
            margin-left: 15px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* ===== التفسير المرئي ===== */
        .visual-explanation {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px dashed #74b9ff;
        }

        .number-box {
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 1.4rem;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
            min-width: 80px;
            text-align: center;
        }

        .minuend-box {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        .subtrahend-box {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        .result-box {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        .borrow-box {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        .operation {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e91e63;
        }

        /* ===== التغذية الراجعة ===== */
        .feedback {
            font-size: 1.8rem;
            margin: 25px 0;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease;
            padding: 25px 40px;
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
            min-width: 180px;
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

        .control-btn.danger {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
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
            min-width: 150px;
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

        /* ===== الكونفيتي ===== */
        .celebration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
        }

        .confetti {
            position: absolute;
            width: 12px;
            height: 12px;
            opacity: 0;
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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* ===== التصميم المتجاوب ===== */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .problem-display {
                font-size: 2.2rem;
                flex-direction: column;
                gap: 15px;
            }

            .vertical-subtraction {
                font-size: 1.8rem;
                min-width: 300px;
                padding: 20px;
            }

            .digit-cell, .input-cell {
                width: 50px;
                height: 60px;
                font-size: 1.6rem;
            }

            .borrow-indicator {
                width: 50px;
            }

            .borrow-input {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .place-label {
                width: 50px;
            }

            .controls {
                gap: 15px;
            }

            .control-btn {
                padding: 15px 25px;
                font-size: 1.1rem;
                min-width: 160px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .vertical-subtraction {
                font-size: 1.5rem;
                min-width: 250px;
                padding: 15px;
            }

            .digit-cell, .input-cell {
                width: 40px;
                height: 50px;
                font-size: 1.4rem;
                margin: 0 3px;
            }

            .borrow-indicator {
                width: 40px;
            }

            .borrow-input {
                width: 35px;
                height: 35px;
                font-size: 1.1rem;
            }

            .stats {
                flex-direction: column;
                gap: 15px;
            }

            .stat-item {
                min-width: 130px;
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
            <h1>➖ الطرح مع الاستلاف <span class="level-badge" id="level-badge">المستوى 1</span></h1>
            <div class="instructions">أكمل عملية الطرح مع مراعاة الاستلاف</div>
            <div class="range-info">المدى: {{ $min_range }} إلى {{ $max_range }}</div>
        </div>

        <!-- المسألة الرئيسية -->
        <div class="main-problem">
            <div class="problem-display">
                <div class="number-display minuend-display" id="minuend-display">0</div>
                <div class="operator">-</div>
                <div class="number-display subtrahend-display" id="subtrahend-display">0</div>
                <div class="equals">=</div>
                <div class="number-display" id="result-display">?</div>
            </div>

            <!-- الطرح العمودي -->
            <div class="vertical-subtraction-container">
                <div class="vertical-subtraction" id="vertical-subtraction">
                    <!-- سيتم إنشاء عملية الطرح هنا -->
                </div>

                <!-- مؤشرات الاستلاف -->
                <div class="borrow-section">
                    <div class="borrow-indicators" id="borrow-indicators">
                        <!-- سيتم إنشاء مؤشرات الاستلاف هنا -->
                    </div>
                </div>

                <!-- تسميات المنازل -->
                <div class="place-labels" id="place-labels">
                    <!-- سيتم إنشاء تسميات المنازل هنا -->
                </div>
            </div>
        </div>

        <!-- خطوات الحل -->
        <div class="steps-section">
            <h3 style="color: #0984e3; margin-bottom: 20px;">خطوات الحل</h3>
            <div class="steps-container">
                <div class="step" id="step1">
                    <span class="step-number">1</span>
                    ابدأ من منزلة الآحاد (أقصى اليمين)
                </div>
                <div class="step" id="step2">
                    <span class="step-number">2</span>
                    إذا كان الرقم في المطروح منه أصغر من الرقم في المطروح، استلف من المنزلة الأعلى
                </div>
                <div class="step" id="step3">
                    <span class="step-number">3</span>
                    اطرح مع مراعاة الاستلاف (أضف 10 إلى الرقم الحالي واطرح 1 من المنزلة الأعلى)
                </div>
                <div class="step" id="step4">
                    <span class="step-number">4</span>
                    انتقل إلى المنزلة التالية وكرر العملية مع مراعاة أي استلاف سابق
                </div>
            </div>
        </div>

        <!-- التفسير المرئي -->
        <div id="visual-explanation-container">
            <!-- سيتم عرض التفسير المرئي هنا -->
        </div>

        <!-- التغذية الراجعة -->
        <div class="feedback info" id="feedback">أكمل عملية الطرح في الخانات أعلاه مع مراعاة الاستلاف</div>

        <!-- عناصر التحكم -->
        <div class="controls">
            <button id="check-btn" class="control-btn success">✓ تحقق من الإجابة</button>
            <button id="hint-btn" class="control-btn warning">💡 عرض التلميح</button>
            <button id="solve-btn" class="control-btn danger">🎯 عرض الحل</button>
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

    <div class="celebration" id="celebration"></div>

    <script>
        // ===== تهيئة المتغيرات =====
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        const operationType = '{{ $operation_type }}'; // subtraction

        let minuend = 0;    // المطروح منه
        let subtrahend = 0; // المطروح
        let correctResult = 0;
        let inputCells = [];
        let borrowInputs = [];
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let currentLevel = 1;
        let currentStep = 0;
        let maxDigits = maxRange <= 9999 ? 4 : 5; // تحديد عدد المنازل حسب المدى

        // ===== العناصر =====
        const minuendDisplayElement = document.getElementById('minuend-display');
        const subtrahendDisplayElement = document.getElementById('subtrahend-display');
        const resultDisplayElement = document.getElementById('result-display');
        const verticalSubtractionElement = document.getElementById('vertical-subtraction');
        const borrowIndicatorsElement = document.getElementById('borrow-indicators');
        const placeLabelsElement = document.getElementById('place-labels');
        const visualExplanationContainer = document.getElementById('visual-explanation-container');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const solveButton = document.getElementById('solve-btn');
        const nextButton = document.getElementById('next-btn');
        const scoreValueElement = document.getElementById('score-value');
        const correctAnswersElement = document.getElementById('correct-answers');
        const levelElement = document.getElementById('level');
        const levelBadgeElement = document.getElementById('level-badge');
        const totalQuestionsElement = document.getElementById('total-questions');
        const celebrationElement = document.getElementById('celebration');

        // ===== الدوال الأساسية =====

        // إنشاء لعبة جديدة
        function createNewGame() {
            // توليد عددين عشوائيين ضمن المدى المحدد مع استلاف
            do {
                minuend = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                // التأكد من أن المطروح أصغر من المطروح منه ويسبب استلافاً
                const maxSubtrahend = Math.min(minuend - 1, maxRange);
                subtrahend = Math.floor(Math.random() * (maxSubtrahend - minRange + 1)) + minRange;
            } while (!requiresBorrowing(minuend, subtrahend));

            correctResult = minuend - subtrahend;

            // تحديث الواجهة
            updateDisplay();
            resetGameState();

            totalQuestions++;
            totalQuestionsElement.textContent = totalQuestions;
            currentStep = 0;
            resetSteps();
        }

        // التحقق من الحاجة إلى استلاف
        function requiresBorrowing(num1, num2) {
            let n1 = num1;
            let n2 = num2;
            let requiresBorrow = false;

            for (let i = 0; i < maxDigits; i++) {
                const digit1 = n1 % 10;
                const digit2 = n2 % 10;

                if (digit1 < digit2) {
                    requiresBorrow = true;
                    break;
                }

                n1 = Math.floor(n1 / 10);
                n2 = Math.floor(n2 / 10);
            }

            return requiresBorrow;
        }

        // تحديث العرض
        function updateDisplay() {
            // تحديث العروض الرئيسية
            minuendDisplayElement.textContent = minuend;
            subtrahendDisplayElement.textContent = subtrahend;
            resultDisplayElement.textContent = '?';

            // عرض الطرح العمودي
            displayVerticalSubtraction();

            // إنشاء تسميات المنازل
            createPlaceLabels();
        }

        // عرض الطرح العمودي
        function displayVerticalSubtraction() {
            const digitsMinuend = getDigits(minuend);
            const digitsSubtrahend = getDigits(subtrahend);

            let html = `
                <div class="subtraction-row minuend-row">
                    <div class="digit-cell">${digitsMinuend[maxDigits-1]}</div>
            `;

            // إضافة باقي الأرقام للمطروح منه
            for (let i = maxDigits-2; i >= 0; i--) {
                html += `<div class="digit-cell">${digitsMinuend[i]}</div>`;
            }

            html += `</div><div class="subtraction-row subtrahend-row"><div class="digit-cell minus-sign">-</div>`;

            // إضافة أرقام المطروح
            for (let i = maxDigits-1; i >= 0; i--) {
                html += `<div class="digit-cell">${digitsSubtrahend[i]}</div>`;
            }

            html += `</div><div class="subtraction-row result-row" id="result-row">`;

            // إضافة خانات النتيجة
            for (let i = 0; i < maxDigits + 1; i++) {
                html += `<div class="digit-cell"></div>`;
            }

            html += `</div>`;

            verticalSubtractionElement.innerHTML = html;

            // إنشاء خانات الإدخال ومؤشرات الاستلاف
            createInputsAndBorrows();
        }

        // إنشاء تسميات المنازل
        function createPlaceLabels() {
            const placeNames = maxDigits === 4 ?
                ['آحاد', 'عشرات', 'مئات', 'آلاف'] :
                ['آحاد', 'عشرات', 'مئات', 'آلاف', 'عشرات الآلاف'];

            let html = '';
            for (let i = maxDigits - 1; i >= 0; i--) {
                html += `<div class="place-label">${placeNames[i]}</div>`;
            }
            // خانة إضافية للاستلاف النهائي
            html += `<div class="place-label">استلاف</div>`;

            placeLabelsElement.innerHTML = html;
        }

        // إنشاء خانات الإدخال ومؤشرات الاستلاف
        function createInputsAndBorrows() {
            const resultRow = document.getElementById('result-row');

            // إعادة تهيئة المصفوفات
            inputCells = [];
            borrowInputs = [];

            // إزالة أي عناصر موجودة مسبقاً
            resultRow.innerHTML = '';
            borrowIndicatorsElement.innerHTML = '';

            // إنشاء مؤشرات الاستلاف
            for (let i = 0; i < maxDigits; i++) {
                const borrowInput = document.createElement('input');
                borrowInput.type = 'number';
                borrowInput.className = 'borrow-input';
                borrowInput.maxLength = 1;
                borrowInput.placeholder = '0';
                borrowInput.min = 0;
                borrowInput.max = 1;
                borrowInput.addEventListener('input', function() {
                    if (this.value.length > 1) {
                        this.value = this.value.slice(0, 1);
                    }
                    if (this.value !== '0' && this.value !== '1') {
                        this.value = '';
                    }
                });

                const borrowIndicator = document.createElement('div');
                borrowIndicator.className = 'borrow-indicator';
                borrowIndicator.appendChild(borrowInput);
                borrowIndicatorsElement.appendChild(borrowIndicator);
                borrowInputs.push(borrowInput);
            }

            // خانة إضافية للاستلاف النهائي
            const finalBorrowInput = document.createElement('input');
            finalBorrowInput.type = 'number';
            finalBorrowInput.className = 'borrow-input';
            finalBorrowInput.maxLength = 1;
            finalBorrowInput.placeholder = '0';
            finalBorrowInput.min = 0;
            finalBorrowInput.max = 1;

            const finalBorrowIndicator = document.createElement('div');
            finalBorrowIndicator.className = 'borrow-indicator';
            finalBorrowIndicator.appendChild(finalBorrowInput);
            borrowIndicatorsElement.appendChild(finalBorrowIndicator);
            borrowInputs.push(finalBorrowInput);

            // إنشاء خانات النتيجة
            for (let i = 0; i < maxDigits + 1; i++) {
                const input = document.createElement('input');
                input.type = 'number';
                input.className = 'input-cell';
                input.maxLength = 1;
                input.placeholder = '_';
                input.min = 0;
                input.max = 9;
                input.addEventListener('input', function() {
                    if (this.value.length > 1) {
                        this.value = this.value.slice(0, 1);
                    }
                });

                const digitCell = document.createElement('div');
                digitCell.className = 'digit-cell';
                digitCell.appendChild(input);
                resultRow.appendChild(digitCell);
                inputCells.push(input);
            }

            // التركيز على الخانة الأولى
            setTimeout(() => inputCells[0].focus(), 100);
        }

        // الحصول على أرقام العدد
        function getDigits(number) {
            const digits = new Array(maxDigits).fill(0);
            let n = number;

            for (let i = 0; i < maxDigits; i++) {
                digits[i] = n % 10;
                n = Math.floor(n / 10);
            }

            return digits;
        }

        // إعادة تعيين حالة اللعبة
        function resetGameState() {
            feedbackElement.textContent = 'أكمل عملية الطرح في الخانات أعلاه مع مراعاة الاستلاف';
            feedbackElement.className = 'feedback info';

            // إعادة تعيين المدخلات
            inputCells.forEach(cell => {
                cell.value = '';
                cell.className = 'input-cell';
            });

            borrowInputs.forEach(borrow => {
                borrow.value = '';
                borrow.className = 'borrow-input';
            });

            visualExplanationContainer.innerHTML = '';
        }

        // إعادة تعيين خطوات الحل
        function resetSteps() {
            const steps = document.querySelectorAll('.step');
            steps.forEach(step => {
                step.classList.remove('active');
            });
        }

        // ===== التحقق من الإجابات =====

        // التحقق من الإجابة
        function checkAnswer() {
            // التحقق من اكتمال جميع الحقول
            let allFilled = true;

            for (let i = 0; i < inputCells.length; i++) {
                if (inputCells[i].value === '') {
                    allFilled = false;
                    break;
                }
            }

            if (!allFilled) {
                feedbackElement.textContent = 'يرجى ملء جميع خانات النتيجة!';
                feedbackElement.className = 'feedback error';
                return;
            }

            // جمع الإجابة من الخانات
            let userAnswer = '';
            for (let i = inputCells.length - 1; i >= 0; i--) {
                userAnswer += inputCells[i].value;
            }
            const userResult = parseInt(userAnswer);

            // التحقق من صحة الاستلافات
            const borrowsCorrect = validateBorrows();

            if (userResult === correctResult && borrowsCorrect) {
                // إجابة صحيحة
                handleCorrectAnswer();
            } else {
                // إجابة خاطئة
                handleIncorrectAnswer();
            }
        }

        // التحقق من صحة الاستلافات
        function validateBorrows() {
            const digitsMinuend = getDigits(minuend);
            const digitsSubtrahend = getDigits(subtrahend);
            const calculatedBorrows = calculateBorrows();

            for (let i = 0; i < borrowInputs.length; i++) {
                const userBorrow = parseInt(borrowInputs[i].value) || 0;
                const correctBorrow = calculatedBorrows[i];

                if (userBorrow !== correctBorrow) {
                    return false;
                }
            }

            return true;
        }

        // حساب الاستلافات الصحيحة
        function calculateBorrows() {
            const digitsMinuend = getDigits(minuend);
            const digitsSubtrahend = getDigits(subtrahend);
            const borrows = new Array(maxDigits + 1).fill(0);
            let currentBorrow = 0;

            for (let i = 0; i < maxDigits; i++) {
                let currentMinuend = digitsMinuend[i] - currentBorrow;

                if (currentMinuend < digitsSubtrahend[i]) {
                    borrows[i] = 1;
                    currentBorrow = 1;
                } else {
                    borrows[i] = 0;
                    currentBorrow = 0;
                }
            }

            // الاستلاف النهائي
            borrows[maxDigits] = currentBorrow;

            return borrows;
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            feedbackElement.textContent = 'أحسنت! 🎉 الإجابة صحيحة مع الاستلافات المناسبة';
            feedbackElement.className = 'feedback success';

            // تلوين الخانات بالإجابة الصحيحة
            inputCells.forEach(cell => {
                cell.className = 'input-cell correct';
            });

            borrowInputs.forEach(borrow => {
                borrow.className = 'borrow-input correct';
            });

            score += currentLevel * 15;
            correctAnswers++;

            // تحديث المستوى
            if (correctAnswers % 5 === 0) {
                currentLevel++;
                levelElement.textContent = currentLevel;
                levelBadgeElement.textContent = `المستوى ${currentLevel}`;
                feedbackElement.textContent += ` 🚀 تقدمت للمستوى ${currentLevel}!`;
            }

            // تحديث الإحصائيات
            updateStats();

            // عرض احتفال
            showCelebration();
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            feedbackElement.textContent = 'ليس صحيحاً! تحقق من الاستلافات وحاول مرة أخرى';
            feedbackElement.className = 'feedback error';

            // إظهار التلميح تلقائياً بعد خطأ
            showHint();
        }

        // ===== نظام التلميحات والحلول =====

        // عرض التلميح
        function showHint() {
            resetSteps();

            if (currentStep < 4) {
                currentStep++;
            } else {
                currentStep = 1;
            }

            const currentStepElement = document.getElementById(`step${currentStep}`);
            currentStepElement.classList.add('active');

            // عرض تفاصيل الخطوة الحالية
            showStepDetails(currentStep);
        }

        // عرض تفاصيل الخطوة
        function showStepDetails(step) {
            const digitsMinuend = getDigits(minuend);
            const digitsSubtrahend = getDigits(subtrahend);
            const calculatedBorrows = calculateBorrows();

            let message = '';
            let visualHTML = '';

            switch(step) {
                case 1:
                    message = "ابدأ من منزلة الآحاد (أقصى اليمين)";
                    visualHTML = `
                        <div class="visual-explanation">
                            <div class="number-box minuend-box">${digitsMinuend[0]}</div>
                            <div class="operation">-</div>
                            <div class="number-box subtrahend-box">${digitsSubtrahend[0]}</div>
                            <div class="operation">=</div>
                            <div class="number-box result-box">?</div>
                        </div>
                    `;
                    break;
                case 2:
                    if (digitsMinuend[0] < digitsSubtrahend[0]) {
                        message = `الآحاد: ${digitsMinuend[0]} أصغر من ${digitsSubtrahend[0]}، إذن نستلف من منزلة العشرات`;
                        visualHTML = `
                            <div class="visual-explanation">
                                <div class="number-box minuend-box">${digitsMinuend[0]}</div>
                                <div class="operation">&lt;</div>
                                <div class="number-box subtrahend-box">${digitsSubtrahend[0]}</div>
                                <div class="operation">←</div>
                                <div class="number-box borrow-box">استلف 1 من العشرات</div>
                            </div>
                        `;
                    } else {
                        message = `الآحاد: ${digitsMinuend[0]} - ${digitsSubtrahend[0]} = ${digitsMinuend[0] - digitsSubtrahend[0]}`;
                    }
                    break;
                case 3:
                    // حساب الاستلاف والطرح للآحاد
                    let onesResult = digitsMinuend[0];
                    let onesBorrow = 0;

                    if (digitsMinuend[0] < digitsSubtrahend[0]) {
                        onesResult = digitsMinuend[0] + 10;
                        onesBorrow = 1;
                        message = `الآحاد بعد الاستلاف: ${digitsMinuend[0]} + 10 = ${onesResult}, ثم ${onesResult} - ${digitsSubtrahend[0]} = ${onesResult - digitsSubtrahend[0]}`;
                        visualHTML = `
                            <div class="visual-explanation">
                                <div class="number-box minuend-box">${digitsMinuend[0]}</div>
                                <div class="operation">+</div>
                                <div class="number-box borrow-box">10</div>
                                <div class="operation">=</div>
                                <div class="number-box result-box">${onesResult}</div>
                                <div class="operation">-</div>
                                <div class="number-box subtrahend-box">${digitsSubtrahend[0]}</div>
                                <div class="operation">=</div>
                                <div class="number-box result-box">${onesResult - digitsSubtrahend[0]}</div>
                            </div>
                        `;
                    } else {
                        message = `الآحاد: ${digitsMinuend[0]} - ${digitsSubtrahend[0]} = ${digitsMinuend[0] - digitsSubtrahend[0]}`;
                    }
                    break;
                case 4:
                    message = "انتقل إلى المنزلة التالية وتذكر الاستلاف إن وجد";
                    // عرض حالة المنزلة التالية
                    const nextPlace = calculatedBorrows[0] === 1 ? 1 : 0;
                    if (nextPlace < maxDigits) {
                        const placeNames = maxDigits === 4 ?
                            ['آحاد', 'عشرات', 'مئات', 'آلاف'] :
                            ['آحاد', 'عشرات', 'مئات', 'آلاف', 'عشرات الآلاف'];
                        message += `<br>الآن في منزلة ${placeNames[nextPlace]} مع استلاف ${calculatedBorrows[0]}`;
                    }
                    break;
            }

            visualExplanationContainer.innerHTML = visualHTML;
            feedbackElement.innerHTML = message;
            feedbackElement.className = 'feedback info';
        }

        // عرض الحل الكامل
        function showSolution() {
            const digitsMinuend = getDigits(minuend);
            const digitsSubtrahend = getDigits(subtrahend);
            const calculatedBorrows = calculateBorrows();
            const calculatedResults = calculateResults();

            let solutionHTML = `
                <div class="steps-section">
                    <h3 style="color: #e91e63; margin-bottom: 20px;">الحل الكامل خطوة بخطوة:</h3>
            `;

            // محاكاة عملية الطرح مع الاستلاف
            let currentBorrow = 0;
            const placeNames = maxDigits === 4 ?
                ['الآحاد', 'العشرات', 'المئات', 'آلاف'] :
                ['الآحاد', 'العشرات', 'المئات', 'آلاف', 'عشرات الآلاف'];

            for (let i = 0; i < maxDigits; i++) {
                let currentMinuend = digitsMinuend[i] - currentBorrow;
                currentBorrow = 0;

                if (currentMinuend < digitsSubtrahend[i]) {
                    currentMinuend += 10;
                    currentBorrow = 1;
                    solutionHTML += `
                        <div class="step active">
                            <span class="step-number">${i+1}</span>
                            <strong>${placeNames[i]}:</strong><br>
                            ${digitsMinuend[i]} أصغر من ${digitsSubtrahend[i]}، نستلف من المنزلة الأعلى<br>
                            ${digitsMinuend[i]} + 10 = ${currentMinuend} (بعد الاستلاف)<br>
                            ${currentMinuend} - ${digitsSubtrahend[i]} = ${currentMinuend - digitsSubtrahend[i]}<br>
                            <em>الاستلاف: ${calculatedBorrows[i]}</em>
                        </div>
                    `;
                } else {
                    solutionHTML += `
                        <div class="step active">
                            <span class="step-number">${i+1}</span>
                            <strong>${placeNames[i]}:</strong><br>
                            ${digitsMinuend[i]} - ${digitsSubtrahend[i]} = ${digitsMinuend[i] - digitsSubtrahend[i]}<br>
                            <em>الاستلاف: ${calculatedBorrows[i]}</em>
                        </div>
                    `;
                }
            }

            // إذا بقي استلاف في النهاية
            if (currentBorrow > 0) {
                solutionHTML += `
                    <div class="step active">
                        <span class="step-number">${maxDigits+1}</span>
                        <strong>الاستلاف النهائي:</strong><br>
                        بقي استلاف ${currentBorrow} في النهاية<br>
                        <em>الاستلاف النهائي: ${calculatedBorrows[maxDigits]}</em>
                    </div>
                `;
            }

            solutionHTML += `
                    <div style="margin: 20px 0; padding: 20px; background: linear-gradient(135deg, #00b894 0%, #00a085 100%); color: white; border-radius: 12px; font-weight: bold; font-size: 1.4rem;">
                        النتيجة النهائية: ${minuend} - ${subtrahend} = ${correctResult}
                    </div>
                </div>
            `;

            visualExplanationContainer.innerHTML = solutionHTML;
            feedbackElement.textContent = 'هذا هو الحل الكامل للمسألة';
            feedbackElement.className = 'feedback info';

            // تعبئة الإجابات الصحيحة
            showCorrectAnswer();
        }

        // حساب النتائج الصحيحة
        function calculateResults() {
            const digitsMinuend = getDigits(minuend);
            const digitsSubtrahend = getDigits(subtrahend);
            const calculatedBorrows = calculateBorrows();
            const results = [];
            let currentBorrow = 0;

            for (let i = 0; i < maxDigits; i++) {
                let currentMinuend = digitsMinuend[i] - currentBorrow;
                currentBorrow = calculatedBorrows[i];

                if (currentMinuend < digitsSubtrahend[i]) {
                    currentMinuend += 10;
                }

                results.push(currentMinuend - digitsSubtrahend[i]);
            }

            // إذا بقي استلاف في النهاية
            if (currentBorrow > 0) {
                results.push(currentBorrow);
            }

            return results;
        }

        // عرض الإجابة الصحيحة
        function showCorrectAnswer() {
            const correctDigits = calculateResults();
            const correctBorrows = calculateBorrows();

            // تعبئة خانات النتيجة
            for (let i = 0; i < correctDigits.length; i++) {
                inputCells[i].value = correctDigits[i];
                inputCells[i].className = 'input-cell correct';
            }

            // تعبئة خانات الاستلاف
            for (let i = 0; i < correctBorrows.length; i++) {
                borrowInputs[i].value = correctBorrows[i];
                borrowInputs[i].className = 'borrow-input correct';
            }
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreValueElement.textContent = score;
            correctAnswersElement.textContent = correctAnswers;
        }

        // عرض احتفال
        function showCelebration() {
            celebrationElement.innerHTML = '';

            for (let i = 0; i < 80; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';

                // ألوان عشوائية
                const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff', '#ffb300', '#74b9ff'];
                const color = colors[Math.floor(Math.random() * colors.length)];

                confetti.style.backgroundColor = color;
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.opacity = '1';

                celebrationElement.appendChild(confetti);

                // إزالة الكونفيتي بعد الانتهاء
                setTimeout(() => {
                    if (confetti.parentNode) {
                        confetti.remove();
                    }
                }, 5000);
            }
        }

        // ===== تهيئة الأحداث =====
        checkButton.addEventListener('click', checkAnswer);
        hintButton.addEventListener('click', showHint);
        solveButton.addEventListener('click', showSolution);
        nextButton.addEventListener('click', createNewGame);

        // السماح بالتحقق باستخدام زر Enter
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                checkAnswer();
            }
        });

        // بدء اللعبة الأولى
        window.addEventListener('load', createNewGame);
    </script>
</body>
</html>
