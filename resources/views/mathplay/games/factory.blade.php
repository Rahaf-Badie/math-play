<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصنع الأعداد الذكي - {{ $lesson_game->lesson->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            direction: rtl;
            text-align: center;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 900px;
            border: 3px solid #f39c12;
        }

        .lesson-info {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        h1 {
            color: #f39c12;
            margin-bottom: 15px;
            border-bottom: 3px solid #f39c12;
            padding-bottom: 10px;
        }

        .instructions {
            background: linear-gradient(135deg, #fef9e7 0%, #fcf3cf 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #f39c12;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #fffaf0 0%, #fff5e6 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #f39c12;
        }

        .factory-display {
            font-size: 4em;
            margin: 20px 0;
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .number-parts {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .number-part {
            font-size: 2em;
            padding: 15px 25px;
            background: #3498db;
            color: white;
            border-radius: 10px;
            cursor: move;
            user-select: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .number-part:hover {
            transform: scale(1.1);
        }

        .target-area {
            min-height: 120px;
            border: 3px dashed #27ae60;
            border-radius: 15px;
            margin: 25px 0;
            padding: 20px;
            background: #f8fff9;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .constructed-number {
            font-size: 2.5em;
            font-weight: bold;
            color: #2c3e50;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 30px;
            font-size: 1.2em;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        #check-btn {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.4em;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.5em;
            color: #f39c12;
            font-weight: bold;
        }

        .digit-place {
            font-size: 1.2em;
            color: #7f8c8d;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .number-part {
                font-size: 1.6em;
                padding: 12px 20px;
            }

            .constructed-number {
                font-size: 2em;
            }

            .factory-display {
                font-size: 3em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>🏭 مصنع الأعداد الذكي</h1>

        <div class="instructions">
            <p>🔢 رتب الأرقام لبناء العدد الصحيح</p>
            <p>🎯 اسحب الأرقام إلى المنطقة المستهدفة لإنشاء العدد المطلوب</p>
        </div>

        <div class="game-area">
            <div class="factory-display">🏭</div>

            <div id="question-text" class="instructions">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="number-parts" id="number-parts">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="target-area" id="target-area">
                <div class="constructed-number" id="constructed-number">
                    اسحب الأرقام هنا
                </div>
            </div>

            <div class="digit-place" id="digit-place">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="controls">
                <button id="check-btn">✅ تحقق</button>
                <button id="reset-btn">🔄 إعادة</button>
                <button id="hint-btn">💡 تلميح</button>
            </div>

            <div class="feedback" id="feedback">
                ابدأ ببناء العدد!
            </div>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>الإجابات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript للعبة مصنع الأعداد الذكي ===
        const minRange = {{ $min_range ?? 100000 }};
        const maxRange = {{ $max_range ?? 999999999 }};

        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let targetNumber = 0;
        let currentDigits = [];
        let constructedNumber = [];

        function formatNumber(num) {
            return new Intl.NumberFormat('ar-EG').format(num);
        }

        function generateTargetNumber() {
            const isSmallRange = Math.random() < 0.5;
            const range = isSmallRange ?
                { min: 100000, max: 999999 } :
                { min: 1000000, max: 999999999 };

            targetNumber = Math.floor(Math.random() * (range.max - range.min + 1)) + range.min;
            return targetNumber;
        }

        function createNumberParts(number) {
            const digits = number.toString().split('');
            // خلط الأرقام عشوائياً
            return digits.sort(() => Math.random() - 0.5);
        }

        function setupGame() {
            targetNumber = generateTargetNumber();
            currentDigits = createNumberParts(targetNumber);
            constructedNumber = [];

            // تحديث واجهة المستخدم
            document.getElementById('question-text').innerHTML =
                `🏗️ ابنِ العدد: <strong>${formatNumber(targetNumber)}</strong>`;

            // عرض الأرقام القابلة للسحب
            const numberParts = document.getElementById('number-parts');
            numberParts.innerHTML = '';

            currentDigits.forEach((digit, index) => {
                const part = document.createElement('div');
                part.className = 'number-part';
                part.textContent = digit;
                part.draggable = true;
                part.id = `digit-${index}`;

                part.addEventListener('dragstart', (e) => {
                    e.dataTransfer.setData('text/plain', digit);
                });

                numberParts.appendChild(part);
            });

            // إعداد منطقة الهدف
            const targetArea = document.getElementById('target-area');
            targetArea.innerHTML = '<div class="constructed-number" id="constructed-number">اسحب الأرقام هنا</div>';

            targetArea.addEventListener('dragover', (e) => {
                e.preventDefault();
            });

            targetArea.addEventListener('drop', (e) => {
                e.preventDefault();
                const digit = e.dataTransfer.getData('text/plain');
                addDigitToConstruction(digit);
            });

            document.getElementById('feedback').textContent = 'اسحب الأرقام لبناء العدد';
            document.getElementById('feedback').style.background = '#f8f9fa';

            totalQuestions++;
            document.getElementById('total-count').textContent = totalQuestions;
        }

        function addDigitToConstruction(digit) {
            constructedNumber.push(digit);
            updateConstructionDisplay();
        }

        function updateConstructionDisplay() {
            const display = document.getElementById('constructed-number');
            if (constructedNumber.length === 0) {
                display.textContent = 'اسحب الأرقام هنا';
                display.style.color = '#7f8c8d';
            } else {
                display.textContent = constructedNumber.join('');
                display.style.color = '#2c3e50';

                // تحديث معلومات المنازل
                updateDigitPlaceInfo();
            }
        }

        function updateDigitPlaceInfo() {
            const places = ['آحاد', 'عشرات', 'مئات', 'آلاف', 'عشرات الآلاف', 'مئات الآلاف', 'ملايين', 'عشرات الملايين', 'مئات الملايين'];
            const currentLength = constructedNumber.length;
            const placeInfo = currentLength > 0 ?
                `الرقم الحالي في منزلة: ${places[currentLength - 1]}` : '';

            document.getElementById('digit-place').textContent = placeInfo;
        }

        function checkConstruction() {
            const userNumber = parseInt(constructedNumber.join(''));
            const isCorrect = userNumber === targetNumber;

            if (isCorrect) {
                document.getElementById('feedback').innerHTML =
                    `🎉 أحسنت! العدد ${formatNumber(targetNumber)} مبنى بشكل صحيح`;
                document.getElementById('feedback').style.background = '#d4edda';
                score += 15;
                correctAnswers++;
            } else {
                document.getElementById('feedback').innerHTML =
                    `❌ ليس صحيحاً! حاول مرة أخرى<br><small>العدد المطلوب: ${formatNumber(targetNumber)}</small>`;
                document.getElementById('feedback').style.background = '#f8d7da';
                score = Math.max(0, score - 5);
            }

            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
        }

        function showHint() {
            const hint = `💡 تلميح: العدد المطلوب ${formatNumber(targetNumber)} يتكون من ${targetNumber.toString().length} رقم`;
            document.getElementById('feedback').innerHTML = hint;
            document.getElementById('feedback').style.background = '#d1ecf1';
        }

        // إعداد event listeners
        document.getElementById('check-btn').addEventListener('click', checkConstruction);
        document.getElementById('reset-btn').addEventListener('click', setupGame);
        document.getElementById('hint-btn').addEventListener('click', showHint);

        // بدء اللعبة
        setupGame();
    </script>
</body>
</html>
