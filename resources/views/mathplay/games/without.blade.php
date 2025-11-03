<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الطرح السهل - {{ $lesson_game->lesson->name }}</title>
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

        .result-input {
            width: 220px;
            height: 90px;
            border: 4px solid #4a6fa5;
            border-radius: 15px;
            font-size: 2.8rem;
            font-weight: bold;
            text-align: center;
            margin: 0 10px;
            padding: 20px;
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

        /* ===== الكتل المرئية ===== */
        .visual-blocks {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .number-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .block {
            width: 140px;
            height: 140px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.8rem;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .block::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
        }

        .minuend-block {
            background: linear-gradient(145deg, #ffb300, #ff8f00);
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: float 3s infinite ease-in-out;
        }

        .subtrahend-block {
            background: linear-gradient(145deg, #74b9ff, #0984e3);
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: float 3s infinite ease-in-out 0.5s;
        }

        .block-label {
            font-size: 1.1rem;
            color: #666;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 15px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        /* ===== منطقة المنازل ===== */
        .place-value-section {
            background: #e3f2fd;
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            border: 2px solid #74b9ff;
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
            min-width: 150px;
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
            font-size: 1.4rem;
            font-weight: bold;
            color: #2d3436;
            line-height: 1.5;
        }

        /* ===== منطقة الأرقام المفصلة ===== */
        .digits-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            border: 2px solid #ffb300;
        }

        .digits-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .digit-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .digit-row {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .digit {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .minuend-digit {
            background: linear-gradient(145deg, #ffb300, #ff8f00);
            color: white;
        }

        .subtrahend-digit {
            background: linear-gradient(145deg, #74b9ff, #0984e3);
            color: white;
        }

        .digit-operator {
            font-size: 1.5rem;
            color: #e91e63;
            font-weight: bold;
        }

        .digit-equals {
            font-size: 1.5rem;
            color: #00b894;
            font-weight: bold;
        }

        .digit-input {
            width: 60px;
            height: 60px;
            border: 3px solid #4a6fa5;
            border-radius: 12px;
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            background: white;
            transition: all 0.3s ease;
        }

        .digit-input:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.3);
            transform: scale(1.05);
        }

        .digit-input.correct {
            border-color: #00b894;
            background-color: #e8f5e9;
            color: #00b894;
        }

        .digit-input.incorrect {
            border-color: #ff7675;
            background-color: #ffebee;
            color: #e84393;
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
            padding: 20px 35px;
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

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
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

            .number-display {
                min-width: 140px;
                padding: 15px 20px;
            }

            .result-input {
                width: 180px;
                height: 80px;
                font-size: 2.2rem;
            }

            .block {
                width: 120px;
                height: 120px;
                font-size: 2.2rem;
            }

            .digit, .digit-input {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
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

            .problem-display {
                font-size: 1.8rem;
            }

            .result-input {
                width: 150px;
                height: 70px;
                font-size: 1.8rem;
            }

            .block {
                width: 100px;
                height: 100px;
                font-size: 1.8rem;
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
            <h1>🎯 الطرح السهل <span class="level-badge" id="level-badge">المستوى 1</span></h1>
            <div class="instructions">اطرح عددين دون استلاف</div>
            <div class="range-info">المدى: {{ $min_range }} إلى {{ $max_range }}</div>
        </div>

        <!-- المسألة الرئيسية -->
        <div class="main-problem">
            <div class="problem-display">
                <div class="number-display minuend-display" id="minuend-display">0</div>
                <div class="operator">-</div>
                <div class="number-display subtrahend-display" id="subtrahend-display">0</div>
                <div class="equals">=</div>
                <input type="number" class="result-input" id="result-input" placeholder="الناتج">
            </div>

            <!-- الكتل المرئية -->
            <div class="visual-blocks">
                <div class="number-block">
                    <div class="block minuend-block" id="minuend-block">0</div>
                    <div class="block-label">المطروح منه</div>
                </div>

                <div class="number-block">
                    <div class="block subtrahend-block" id="subtrahend-block">0</div>
                    <div class="block-label">المطروح</div>
                </div>
            </div>
        </div>

        <!-- تفكيك القيمة المنزلية -->
        <div class="place-value-section">
            <h3 style="color: #0984e3; margin-bottom: 20px;">الطرح حسب المنازل</h3>
            <div class="place-value-breakdown" id="place-value-breakdown">
                <!-- سيتم عرض تفكيك القيمة المنزلية هنا -->
            </div>
        </div>

        <!-- الأرقام المفصلة -->
        <div class="digits-section">
            <h3 style="color: #e65100; margin-bottom: 20px;">الطرح خطوة بخطوة</h3>
            <div class="digits-container" id="digits-container">
                <!-- سيتم عرض الأرقام حسب المنازل هنا -->
            </div>
        </div>

        <!-- التغذية الراجعة -->
        <div class="feedback info" id="feedback">أدخل ناتج الطرح في المربع أعلاه</div>

        <!-- عناصر التحكم -->
        <div class="controls">
            <button id="check-btn" class="control-btn success">✓ تحقق من الإجابة</button>
            <button id="hint-btn" class="control-btn warning">💡 عرض التلميح</button>
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

        let minuend = 0;
        let subtrahend = 0;
        let correctResult = 0;
        let digitInputs = [];
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let currentLevel = 1;
        let maxDigits = maxRange <= 9999 ? 4 : 5; // تحديد عدد المنازل حسب المدى

        // ===== العناصر =====
        const minuendDisplayElement = document.getElementById('minuend-display');
        const subtrahendDisplayElement = document.getElementById('subtrahend-display');
        const minuendBlockElement = document.getElementById('minuend-block');
        const subtrahendBlockElement = document.getElementById('subtrahend-block');
        const resultInput = document.getElementById('result-input');
        const placeValueBreakdownElement = document.getElementById('place-value-breakdown');
        const digitsContainer = document.getElementById('digits-container');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
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
            // توليد عددين عشوائيين ضمن المدى المحدد ودون استلاف
            do {
                minuend = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                // التأكد من أن المطروح أصغر من أو يساوي المطروح منه
                const maxSubtrahend = Math.min(minuend - 1, maxRange);
                subtrahend = Math.floor(Math.random() * (maxSubtrahend - minRange + 1)) + minRange;
            } while (requiresBorrowing(minuend, subtrahend));

            correctResult = minuend - subtrahend;

            // تحديث الواجهة
            updateDisplay();
            resetGameState();

            totalQuestions++;
            totalQuestionsElement.textContent = totalQuestions;

            // التركيز على حقل الإدخال
            setTimeout(() => resultInput.focus(), 100);
        }

        // التحقق من الحاجة إلى استلاف
        function requiresBorrowing(num1, num2) {
            let n1 = num1;
            let n2 = num2;

            for (let i = 0; i < maxDigits; i++) {
                const digit1 = n1 % 10;
                const digit2 = n2 % 10;

                if (digit1 < digit2) {
                    return true; // يحتاج استلاف
                }

                n1 = Math.floor(n1 / 10);
                n2 = Math.floor(n2 / 10);
            }

            return false; // لا يحتاج استلاف
        }

        // تحديث العرض
        function updateDisplay() {
            // تحديث العروض
            minuendDisplayElement.textContent = minuend;
            subtrahendDisplayElement.textContent = subtrahend;
            minuendBlockElement.textContent = minuend;
            subtrahendBlockElement.textContent = subtrahend;

            // عرض تفكيك القيمة المنزلية
            displayPlaceValueBreakdown();

            // عرض الأرقام حسب المنازل
            displayDigitsByPlace();
        }

        // عرض تفكيك القيمة المنزلية
        function displayPlaceValueBreakdown() {
            const digitsMinuend = getDigits(minuend);
            const digitsSubtrahend = getDigits(subtrahend);

            let html = '';
            const placeNames = maxDigits === 4 ?
                ['آحاد', 'عشرات', 'مئات', 'آلاف'] :
                ['آحاد', 'عشرات', 'مئات', 'آلاف', 'عشرات الآلاف'];

            for (let i = maxDigits - 1; i >= 0; i--) {
                const placeName = placeNames[i];
                const calculation = `${digitsMinuend[i]} - ${digitsSubtrahend[i]} = ${digitsMinuend[i] - digitsSubtrahend[i]}`;
                const placeClass = ['ones', 'tens', 'hundreds', 'thousands', 'ten-thousands'][i];

                html += `
                    <div class="place-value ${placeClass}">
                        <div class="place-label">${placeName}</div>
                        <div class="place-calculation">${calculation}</div>
                    </div>
                `;
            }

            placeValueBreakdownElement.innerHTML = html;
        }

        // عرض الأرقام حسب المنازل
        function displayDigitsByPlace() {
            const digitsMinuend = getDigits(minuend);
            const digitsSubtrahend = getDigits(subtrahend);
            const digitsResult = getDigits(correctResult);

            digitsContainer.innerHTML = '';
            digitInputs = [];

            const placeNames = maxDigits === 4 ?
                ['آحاد', 'عشرات', 'مئات', 'آلاف'] :
                ['آحاد', 'عشرات', 'مئات', 'آلاف', 'عشرات الآلاف'];

            for (let i = maxDigits - 1; i >= 0; i--) {
                const placeName = placeNames[i];

                const digitGroup = document.createElement('div');
                digitGroup.className = 'digit-group';

                digitGroup.innerHTML = `
                    <div class="place-label">${placeName}</div>
                    <div class="digit-row">
                        <div class="digit minuend-digit">${digitsMinuend[i]}</div>
                        <div class="digit-operator">-</div>
                        <div class="digit subtrahend-digit">${digitsSubtrahend[i]}</div>
                        <div class="digit-equals">=</div>
                        <input type="number" class="digit-input" id="digit-input-${i}" placeholder="?" maxlength="1" min="0" max="9">
                    </div>
                `;

                digitsContainer.appendChild(digitGroup);

                // حفظ عنصر الإدخال
                const digitInput = document.getElementById(`digit-input-${i}`);
                digitInputs.push(digitInput);

                // إضافة مستمع الحدث
                digitInput.addEventListener('input', function() {
                    if (this.value.length > 1) {
                        this.value = this.value.slice(0, 1);
                    }
                    validateDigitInput(i);
                });
            }
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
            resultInput.value = '';
            resultInput.className = 'result-input';
            feedbackElement.textContent = 'أدخل ناتج الطرح في المربع أعلاه';
            feedbackElement.className = 'feedback info';

            // إعادة تعيين مدخلات الأرقام
            digitInputs.forEach(input => {
                input.value = '';
                input.className = 'digit-input';
            });
        }

        // التحقق من صحة إدخال الرقم
        function validateDigitInput(placeIndex) {
            const digitsResult = getDigits(correctResult);
            const input = digitInputs[placeIndex];
            const userValue = parseInt(input.value) || 0;
            const correctValue = digitsResult[maxDigits - 1 - placeIndex];

            if (userValue === correctValue) {
                input.className = 'digit-input correct';
                return true;
            } else if (input.value !== '') {
                input.className = 'digit-input incorrect';
                return false;
            }

            return null; // لم يتم إدخال قيمة بعد
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseInt(resultInput.value);

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = 'يرجى إدخال الإجابة!';
                feedbackElement.className = 'feedback error';
                return;
            }

            // التحقق من الأرقام المفردة أولاً
            let allDigitsCorrect = true;
            for (let i = 0; i < maxDigits; i++) {
                const isValid = validateDigitInput(i);
                if (isValid === false) {
                    allDigitsCorrect = false;
                }
            }

            if (userAnswer === correctResult && allDigitsCorrect) {
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
                    levelBadgeElement.textContent = `المستوى ${currentLevel}`;
                    feedbackElement.textContent += ` 🚀 تقدمت للمستوى ${currentLevel}!`;
                }

                // تحديث الإحصائيات
                updateStats();

                // عرض احتفال
                showCelebration();
            } else {
                // إجابة خاطئة
                feedbackElement.textContent = 'ليس صحيحاً! حاول مرة أخرى';
                feedbackElement.className = 'feedback error';
                resultInput.className = 'result-input incorrect';

                // إظهار التلميح تلقائياً بعد خطأ
                showHint();
            }
        }

        // عرض التلميح
        function showHint() {
            const digitsMinuend = getDigits(minuend);
            const digitsSubtrahend = getDigits(subtrahend);

            let hint = "<strong>تلميح:</strong><br>اطرح كل منزلة على حدة:<br>";

            const placeNames = maxDigits === 4 ?
                ['الآحاد', 'العشرات', 'المئات', 'الآلاف'] :
                ['الآحاد', 'العشرات', 'المئات', 'الآلاف', 'عشرات الآلاف'];

            for (let i = maxDigits - 1; i >= 0; i--) {
                const placeName = placeNames[i];
                hint += `${placeName}: ${digitsMinuend[i]} - ${digitsSubtrahend[i]} = ${digitsMinuend[i] - digitsSubtrahend[i]}<br>`;
            }

            hint += `<br><em>تذكر: لا يوجد استلاف في هذه المسألة!</em>`;

            feedbackElement.innerHTML = hint;
            feedbackElement.className = 'feedback info';
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
