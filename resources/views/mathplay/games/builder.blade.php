<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لعبة باني الوحدات المربعة - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #333;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 1000px;
            padding: 30px;
            text-align: center;
        }

        .lesson-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .instructions {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-right: 5px solid #74b9ff;
        }

        .instructions h3 {
            color: #0984e3;
            margin-bottom: 10px;
        }

        .instructions p {
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .game-area {
            padding: 25px;
            background: linear-gradient(135deg, #e8f9e8 0%, #d1f7d1 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #27ae60;
        }

        .game-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .game-stats {
            display: flex;
            gap: 20px;
        }

        .stat-item {
            background: white;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #27ae60;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .game-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: start;
        }

        @media (max-width: 768px) {
            .game-content {
                grid-template-columns: 1fr;
            }
        }

        .grid-section {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .grid-title {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .grid-container {
            width: 100%;
            aspect-ratio: 1;
            margin: 0 auto;
            border: 3px solid #2ecc71;
            display: grid;
            gap: 2px;
            background-color: #bdc3c7;
            border-radius: 8px;
            overflow: hidden;
        }

        .grid-cell {
            background-color: #ecf0f1;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #7f8c8d;
        }

        .grid-cell.colored {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            border: 1px solid #d35400;
            color: white;
            animation: cellPulse 2s infinite;
        }

        .grid-cell.highlight {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border: 1px solid #2471a3;
            color: white;
        }

        .info-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: right;
        }

        .shape-info {
            margin-bottom: 20px;
        }

        .shape-name {
            font-size: 1.4rem;
            color: #e67e22;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .shape-description {
            font-size: 1.1rem;
            color: #7f8c8d;
            line-height: 1.5;
        }

        .calculation-area {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
        }

        .formula-display {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .input-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .input-label {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .input-box {
            width: 120px;
            height: 60px;
            font-size: 1.5rem;
            text-align: center;
            border: 3px solid #3498db;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s;
            font-weight: bold;
        }

        .input-box:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 10px rgba(116, 185, 255, 0.5);
            transform: scale(1.05);
        }

        .unit-label {
            font-size: 1.3rem;
            font-weight: bold;
            color: #27ae60;
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
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #count-btn {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: translateY(0);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback {
            min-height: 80px;
            padding: 15px;
            border-radius: 12px;
            margin: 20px 0;
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s;
        }

        .feedback.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback.incorrect {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .score-container {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .progress {
            margin-top: 15px;
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            width: 0%;
            transition: width 0.5s;
        }

        .celebration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 100;
            display: none;
        }

        .counting-help {
            background: #fff9e6;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-right: 4px solid #f39c12;
        }

        .help-title {
            font-weight: bold;
            color: #e67e22;
            margin-bottom: 10px;
        }

        .counting-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 10px;
        }

        .method {
            background: white;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .method-name {
            font-weight: bold;
            color: #3498db;
            margin-bottom: 5px;
        }

        .method-desc {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        @keyframes cellPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes confetti-fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .bounce {
            animation: bounce 0.5s ease infinite;
        }

        .completion-message {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00b894;
            margin: 20px 0;
            animation: pulse 2s infinite;
        }

        .dimension-display {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 15px 0;
            flex-wrap: wrap;
        }

        .dimension {
            background: #3498db;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>لعبة باني الوحدات المربعة 🧱</h3>
            <p>🎯 احسب مساحة الأشكال عن طريق عد الوحدات المربعة</p>
            <p>💡 استخدم طرق العد المختلفة: صفاً صفاً أو عموداً عموداً</p>
            <p>✨ تذكر: المساحة = عدد الوحدات المربعة التي يغطيها الشكل</p>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- رأس اللعبة -->
            <div class="game-header">
                <div class="game-stats">
                    <div class="stat-item">
                        <div class="stat-value" id="score">0</div>
                        <div class="stat-label">النقاط</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="correct-answers">0</div>
                        <div class="stat-label">إجابات صحيحة</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="current-streak">0</div>
                        <div class="stat-label">التتابع الحالي</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="progress-display">0/10</div>
                    <div class="stat-label">التقدم</div>
                </div>
            </div>

            <!-- محتوى اللعبة -->
            <div class="game-content">
                <!-- قسم الشبكة -->
                <div class="grid-section">
                    <div class="grid-title">الشكل المراد حساب مساحته</div>
                    <div id="grid-container" class="grid-container">
                        <!-- سيتم تعبئتها ديناميكياً -->
                    </div>

                    <!-- أبعاد الشكل -->
                    <div class="dimension-display">
                        <div class="dimension" id="width-display">العرض: ؟ وحدات</div>
                        <div class="dimension" id="height-display">الطول: ؟ وحدات</div>
                    </div>
                </div>

                <!-- قسم المعلومات -->
                <div class="info-section">
                    <div class="shape-info">
                        <div class="shape-name" id="shape-name">شكل مستطيل</div>
                        <div class="shape-description" id="shape-description">احسب المساحة بعد الوحدات المربعة</div>
                    </div>

                    <!-- مساعدة العد -->
                    <div class="counting-help">
                        <div class="help-title">💡 طرق مساعدة في العد:</div>
                        <div class="counting-methods">
                            <div class="method">
                                <div class="method-name">العد بالصفوف</div>
                                <div class="method-desc">احسب الوحدات في كل صف ثم اجمع</div>
                            </div>
                            <div class="method">
                                <div class="method-name">العد بالأعمدة</div>
                                <div class="method-desc">احسب الوحدات في كل عمود ثم اجمع</div>
                            </div>
                        </div>
                    </div>

                    <!-- منطقة الحساب -->
                    <div class="calculation-area">
                        <div class="formula-display">المساحة = عدد الوحدات المربعة</div>

                        <div class="input-group">
                            <span class="input-label">المساحة =</span>
                            <input type="number" id="user-input" class="input-box" placeholder="؟" min="1" max="100">
                            <span class="unit-label">وحدة مربعة</span>
                        </div>
                    </div>

                    <!-- عناصر التحكم -->
                    <div class="controls">
                        <button id="check-btn">تحقق</button>
                        <button id="count-btn">عد الوحدات</button>
                        <button id="hint-btn">مساعدة</button>
                        <button id="reset-btn">سؤال جديد</button>
                    </div>

                    <!-- التغذية الراجعة -->
                    <div class="feedback" id="feedback">ابدأ بعد الوحدات المربعة!</div>
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // بيانات الأشكال
        const SHAPES = [
            {
                id: 1,
                name: "مستطيل كبير",
                description: "شكل مستطيل منتظم",
                rows: 6, cols: 6, area: 12,
                pattern: [
                    [0, 0, 0, 0, 0, 0],
                    [0, 1, 1, 1, 1, 0],
                    [0, 1, 1, 1, 1, 0],
                    [0, 1, 1, 1, 1, 0],
                    [0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0]
                ],
                formula: "الطول × العرض = 4 × 3 = 12"
            },
            {
                id: 2,
                name: "شكل حرف L",
                description: "شكل غير منتظم يشبه الحرف L",
                rows: 6, cols: 6, area: 7,
                pattern: [
                    [0, 0, 0, 0, 0, 0],
                    [0, 1, 1, 1, 0, 0],
                    [0, 1, 0, 0, 0, 0],
                    [0, 1, 0, 0, 0, 0],
                    [0, 1, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0]
                ],
                formula: "عد الوحدات: 4 (عمودي) + 3 (أفقي) = 7"
            },
            {
                id: 3,
                name: "مستطيل أفقي",
                description: "مستطيل ممتد أفقيًا",
                rows: 6, cols: 6, area: 10,
                pattern: [
                    [0, 0, 0, 0, 0, 0],
                    [1, 1, 1, 1, 1, 1],
                    [1, 1, 1, 1, 1, 1],
                    [0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0]
                ],
                formula: "الطول × العرض = 5 × 2 = 10"
            },
            {
                id: 4,
                name: "شكل السلم",
                description: "شكل متدرج يشبه السلم",
                rows: 6, cols: 6, area: 9,
                pattern: [
                    [0, 0, 0, 0, 0, 0],
                    [0, 0, 1, 0, 0, 0],
                    [0, 1, 1, 0, 0, 0],
                    [1, 1, 1, 0, 0, 0],
                    [1, 1, 1, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0]
                ],
                formula: "عد الصفوف: 1 + 2 + 3 + 3 = 9"
            },
            {
                id: 5,
                name: "مربع صغير",
                description: "مربع في المنتصف",
                rows: 6, cols: 6, area: 4,
                pattern: [
                    [0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0],
                    [0, 0, 1, 1, 0, 0],
                    [0, 0, 1, 1, 0, 0],
                    [0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0]
                ],
                formula: "الطول × العرض = 2 × 2 = 4"
            },
            {
                id: 6,
                name: "شكل متعرج",
                description: "شكل متعرج غير منتظم",
                rows: 6, cols: 6, area: 8,
                pattern: [
                    [0, 0, 0, 0, 0, 0],
                    [0, 1, 1, 0, 0, 0],
                    [0, 0, 1, 1, 0, 0],
                    [0, 0, 0, 1, 1, 0],
                    [0, 0, 0, 0, 1, 1],
                    [0, 0, 0, 0, 0, 0]
                ],
                formula: "عد الوحدات: 2 + 2 + 2 + 2 = 8"
            }
        ];

        // المتغيرات الأساسية
        let currentShape = null;
        let score = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalQuestions = 10;
        let currentQuestion = 0;
        let gameStarted = false;
        let hintsUsed = 0;
        let isCountingMode = false;

        // عناصر DOM
        const gridContainerElement = document.getElementById('grid-container');
        const shapeNameElement = document.getElementById('shape-name');
        const shapeDescriptionElement = document.getElementById('shape-description');
        const userInputElement = document.getElementById('user-input');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const countButton = document.getElementById('count-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const progressDisplayElement = document.getElementById('progress-display');
        const progressBarElement = document.getElementById('progress-bar');
        const widthDisplayElement = document.getElementById('width-display');
        const heightDisplayElement = document.getElementById('height-display');
        const celebrationElement = document.getElementById('celebration');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            checkButton.addEventListener('click', checkAnswer);
            countButton.addEventListener('click', toggleCountingMode);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', resetGame);

            userInputElement.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    checkAnswer();
                }
            });
        }

        // بدء اللعبة
        function startGame() {
            gameStarted = true;
            generateNewProblem();
        }

        // إنشاء مسألة جديدة
        function generateNewProblem() {
            if (currentQuestion >= totalQuestions) {
                endGame();
                return;
            }

            currentQuestion++;
            updateProgress();

            // اختيار شكل عشوائي
            const index = Math.floor(Math.random() * SHAPES.length);
            currentShape = SHAPES[index];

            // تحديث واجهة المستخدم
            updateShapeDisplay();
            renderGrid();
            resetFeedback();
        }

        // تحديث عرض الشكل
        function updateShapeDisplay() {
            shapeNameElement.textContent = currentShape.name;
            shapeDescriptionElement.textContent = currentShape.description;

            // حساب الأبعاد
            const dimensions = calculateDimensions();
            widthDisplayElement.textContent = `العرض: ${dimensions.width} وحدات`;
            heightDisplayElement.textContent = `الطول: ${dimensions.height} وحدات`;

            userInputElement.value = '';
            userInputElement.disabled = false;
            userInputElement.focus();
        }

        // حساب أبعاد الشكل
        function calculateDimensions() {
            let minRow = currentShape.rows, maxRow = 0;
            let minCol = currentShape.cols, maxCol = 0;

            for (let r = 0; r < currentShape.rows; r++) {
                for (let c = 0; c < currentShape.cols; c++) {
                    if (currentShape.pattern[r][c] === 1) {
                        minRow = Math.min(minRow, r);
                        maxRow = Math.max(maxRow, r);
                        minCol = Math.min(minCol, c);
                        maxCol = Math.max(maxCol, c);
                    }
                }
            }

            return {
                width: maxCol - minCol + 1,
                height: maxRow - minRow + 1
            };
        }

        // عرض الشبكة
        function renderGrid() {
            gridContainerElement.innerHTML = '';
            gridContainerElement.style.gridTemplateRows = `repeat(${currentShape.rows}, 1fr)`;
            gridContainerElement.style.gridTemplateColumns = `repeat(${currentShape.cols}, 1fr)`;

            for (let r = 0; r < currentShape.rows; r++) {
                for (let c = 0; c < currentShape.cols; c++) {
                    const cell = document.createElement('div');
                    cell.className = 'grid-cell';
                    cell.dataset.row = r;
                    cell.dataset.col = c;

                    if (currentShape.pattern[r][c] === 1) {
                        cell.classList.add('colored');
                    }

                    // إضافة تفاعل العد
                    cell.addEventListener('click', function() {
                        if (isCountingMode) {
                            this.classList.toggle('highlight');
                        }
                    });

                    gridContainerElement.appendChild(cell);
                }
            }
        }

        // تبديل وضع العد
        function toggleCountingMode() {
            isCountingMode = !isCountingMode;
            const cells = document.querySelectorAll('.grid-cell');

            if (isCountingMode) {
                countButton.textContent = 'إنهاء العد';
                countButton.style.background = 'linear-gradient(135deg, #e74c3c 0%, #c0392b 100%)';
                feedbackElement.textContent = '💡 انقر على الوحدات المربعة لعدها!';
                feedbackElement.className = 'feedback info';

                cells.forEach(cell => {
                    if (cell.classList.contains('colored')) {
                        cell.style.cursor = 'pointer';
                    }
                });
            } else {
                countButton.textContent = 'عد الوحدات';
                countButton.style.background = 'linear-gradient(135deg, #ffb300 0%, #ff8f00 100%)';
                feedbackElement.textContent = 'اكتب المساحة التي حسبتها';
                feedbackElement.className = 'feedback info';

                cells.forEach(cell => {
                    cell.classList.remove('highlight');
                    cell.style.cursor = 'default';
                });
            }
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseInt(userInputElement.value);

            if (isNaN(userAnswer) || userAnswer < 1) {
                feedbackElement.textContent = '⚠️ الرجاء إدخال عدد صحيح موجب!';
                feedbackElement.className = 'feedback incorrect';
                return;
            }

            if (userAnswer === currentShape.area) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            score += 100;
            correctAnswers++;
            currentStreak++;
            updateStats();

            feedbackElement.textContent = `🎉 أحسنت! المساحة هي ${currentShape.area} وحدة مربعة`;
            feedbackElement.className = 'feedback correct';

            // تأثير التتابع
            if (currentStreak >= 3) {
                celebrate();
            }

            userInputElement.disabled = true;

            // الانتقال إلى السؤال التالي بعد تأخير
            setTimeout(generateNewProblem, 2000);
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            score = Math.max(0, score - 50);
            currentStreak = 0;
            updateStats();

            feedbackElement.textContent = `❌ ليست صحيحة! حاول مرة أخرى`;
            feedbackElement.className = 'feedback incorrect';

            userInputElement.focus();
        }

        // عرض مساعدة
        function showHint() {
            if (hintsUsed >= 3) {
                feedbackElement.textContent = '⚠️ لقد استخدمت جميع المساعدات المتاحة!';
                feedbackElement.className = 'feedback info';
                return;
            }

            hintsUsed++;
            score = Math.max(0, score - 25);
            updateStats();

            const dimensions = calculateDimensions();
            let hintMessage = '';

            if (currentShape.id === 1 || currentShape.id === 3 || currentShape.id === 5) {
                hintMessage = `💡 هذا شكل منتظم! استخدم: الطول × العرض = ${dimensions.height} × ${dimensions.width}`;
            } else {
                hintMessage = `💡 جرب العد صفاً صفاً أو استخدم طريقة التجميع`;
            }

            feedbackElement.textContent = hintMessage;
            feedbackElement.className = 'feedback info';
        }

        // نهاية اللعبة
        function endGame() {
            gameStarted = false;
            checkButton.disabled = true;
            hintButton.disabled = true;
            countButton.disabled = true;

            const percentage = (correctAnswers / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أنت خبير في حساب المساحة! ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 أحسنت! مهاراتك في حساب المساحة ممتازة ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 جيد! واصل التدرب على حساب المساحة ${correctAnswers}/${totalQuestions}`;
            } else {
                message = `📚 راجع طرق حساب المساحة! ${correctAnswers}/${totalQuestions}`;
            }

            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback correct';

            celebrate();
        }

        // إعادة تعيين اللعبة
        function resetGame() {
            score = 0;
            correctAnswers = 0;
            currentStreak = 0;
            currentQuestion = 0;
            hintsUsed = 0;
            isCountingMode = false;
            gameStarted = true;

            updateStats();
            updateProgress();
            checkButton.disabled = false;
            hintButton.disabled = false;
            countButton.disabled = false;
            countButton.textContent = 'عد الوحدات';
            countButton.style.background = 'linear-gradient(135deg, #ffb300 0%, #ff8f00 100%)';

            generateNewProblem();
        }

        // إعادة تعيين التغذية الراجعة
        function resetFeedback() {
            feedbackElement.textContent = 'ابدأ بعد الوحدات المربعة!';
            feedbackElement.className = 'feedback info';
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            correctAnswersElement.textContent = correctAnswers;
            currentStreakElement.textContent = currentStreak;

            // تلوين التتابع
            if (currentStreak >= 5) {
                currentStreakElement.style.color = '#00b894';
            } else if (currentStreak >= 3) {
                currentStreakElement.style.color = '#ffb300';
            } else {
                currentStreakElement.style.color = '#0984e3';
            }
        }

        // تحديث التقدم
        function updateProgress() {
            const progress = (currentQuestion / totalQuestions) * 100;
            progressBarElement.style.width = `${progress}%`;
            progressDisplayElement.textContent = `${currentQuestion}/${totalQuestions}`;
        }

        // تأثير الاحتفال
        function celebrate() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            for (let i = 0; i < 60; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.width = '15px';
                confetti.style.height = '15px';
                confetti.style.background = getRandomColor();
                confetti.style.borderRadius = '50%';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s linear forwards`;
                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 3000);
        }

        // الحصول على لون عشوائي
        function getRandomColor() {
            const colors = [
                '#ff7675', '#74b9ff', '#55efc4', '#ffeaa7',
                '#a29bfe', '#fd79a8', '#fdcb6e', '#00b894'
            ];
            return colors[Math.floor(Math.random() * colors.length)];
        }

        // بدء اللعبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', initGame);
    </script>
</body>
</html>
