<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚔️ مبارزة البطاقات - {{ $lesson_game->lesson->name }}</title>
    <style>
        /* ===== التنسيقات الأساسية ===== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            direction: rtl;
        }

        .container {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            position: relative;
        }

        /* ===== رأس اللعبة ===== */
        .game-header {
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .game-header::before {
            content: "⚔️";
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 120px;
            opacity: 0.1;
            transform: rotate(25deg);
        }

        .lesson-info {
            font-size: 1.3em;
            margin-bottom: 12px;
            opacity: 0.95;
            font-weight: bold;
        }

        h1 {
            font-size: 3em;
            margin-bottom: 20px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .instructions {
            background: rgba(255, 255, 255, 0.25);
            padding: 15px;
            border-radius: 15px;
            margin-top: 20px;
            font-size: 1.2em;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .range-info {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.4);
        }

        /* ===== منطقة اللعبة ===== */
        .game-area {
            padding: 40px;
            background: #f8f9fa;
            min-height: 500px;
            position: relative;
        }

        .battle-field {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 40px 0;
            position: relative;
            gap: 30px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            width: 240px;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            border: 5px solid #e67e22;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            z-index: 1;
        }

        .card.winner {
            border-color: #27ae60;
            box-shadow: 0 0 40px rgba(39, 174, 96, 0.5);
            transform: scale(1.08);
            animation: winnerGlow 2s infinite;
        }

        @keyframes winnerGlow {
            0%, 100% { box-shadow: 0 0 40px rgba(39, 174, 96, 0.5); }
            50% { box-shadow: 0 0 60px rgba(39, 174, 96, 0.8); }
        }

        .card-label {
            position: absolute;
            top: 15px;
            font-size: 1.3em;
            color: #7f8c8d;
            font-weight: bold;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 15px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .number-display {
            font-size: 3.5em;
            font-weight: bold;
            color: #2c3e50;
            margin: auto 0;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            font-family: 'Courier New', monospace;
        }

        .comparison-area {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .symbol-display {
            font-size: 5em;
            font-weight: 900;
            color: #c0392b;
            background: white;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            border: 4px solid #c0392b;
            transition: all 0.3s ease;
        }

        .symbol-display.correct {
            background: #27ae60;
            color: white;
            border-color: #229954;
            animation: symbolPulse 0.5s ease;
        }

        @keyframes symbolPulse {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.2); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }

        /* ===== عناصر التحكم ===== */
        .controls {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin: 35px 0;
            flex-wrap: wrap;
        }

        .control-btn {
            padding: 20px 35px;
            font-size: 1.5em;
            font-weight: bold;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.4s ease;
            min-width: 180px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .control-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .control-btn:hover::before {
            left: 100%;
        }

        .control-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
        }

        .control-btn:active {
            transform: translateY(2px);
        }

        .greater-btn {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .less-btn {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        .equal-btn {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
        }

        .control-btn.correct {
            animation: buttonCelebrate 0.6s ease;
        }

        @keyframes buttonCelebrate {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.1) rotate(-5deg); }
            75% { transform: scale(1.1) rotate(5deg); }
        }

        /* ===== التغذية الراجعة ===== */
        .feedback {
            min-height: 100px;
            margin: 30px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .message {
            font-size: 1.6em;
            font-weight: bold;
            padding: 20px 35px;
            border-radius: 50px;
            text-align: center;
            transition: all 0.4s ease;
            max-width: 85%;
            backdrop-filter: blur(10px);
        }

        .message.success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            animation: messageBounce 0.6s ease;
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.4);
        }

        .message.error {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            animation: messageShake 0.6s ease;
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
        }

        .message.info {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        @keyframes messageBounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-12px); }
            80% { transform: translateY(-6px); }
        }

        @keyframes messageShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-12px); }
            75% { transform: translateX(12px); }
        }

        /* ===== لوحة النقاط ===== */
        .game-footer {
            background: white;
            padding: 30px;
            border-top: 3px dashed #e67e22;
        }

        .stats-board {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 25px;
        }

        .stat-item {
            text-align: center;
            padding: 25px;
            border-radius: 15px;
            background: #f8f9fa;
            min-width: 160px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
            border: 3px solid #e67e22;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-value {
            font-size: 2.5em;
            font-weight: bold;
            color: #e67e22;
            display: block;
            margin-top: 8px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        .stat-label {
            color: #7f8c8d;
            font-weight: bold;
            font-size: 1.1em;
        }

        .action-controls {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .action-btn {
            padding: 18px 30px;
            font-size: 1.3em;
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 6px 15px rgba(243, 156, 18, 0.3);
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(243, 156, 18, 0.4);
        }

        /* ===== التقدم ===== */
        .progress-section {
            margin: 25px 0;
        }

        .progress-container {
            width: 100%;
            background: #e0e0e0;
            border-radius: 12px;
            margin: 15px 0;
            overflow: hidden;
            height: 16px;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #e67e22 0%, #f39c12 100%);
            width: 0%;
            transition: width 0.6s ease;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
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
            display: none;
        }

        .confetti {
            position: absolute;
            width: 14px;
            height: 14px;
            opacity: 0;
            border-radius: 2px;
        }

        @keyframes confettiFall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* ===== التكيف مع الشاشات الصغيرة ===== */
        @media (max-width: 768px) {
            .container {
                margin: 10px;
            }

            .game-header {
                padding: 20px;
            }

            h1 {
                font-size: 2.2em;
            }

            .battle-field {
                flex-direction: column;
                gap: 25px;
                margin: 30px 0;
            }

            .comparison-area {
                position: relative;
                left: auto;
                top: auto;
                transform: none;
                margin: 15px 0;
            }

            .card {
                width: 200px;
                height: 250px;
            }

            .number-display {
                font-size: 2.8em;
            }

            .symbol-display {
                width: 80px;
                height: 80px;
                font-size: 4em;
            }

            .controls {
                gap: 15px;
            }

            .control-btn {
                padding: 15px 25px;
                font-size: 1.3em;
                min-width: 150px;
            }

            .stats-board {
                gap: 15px;
            }

            .stat-item {
                min-width: 140px;
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .game-area {
                padding: 25px;
            }

            .card {
                width: 160px;
                height: 220px;
            }

            .number-display {
                font-size: 2.2em;
            }

            .control-btn {
                padding: 12px 20px;
                font-size: 1.1em;
                min-width: 120px;
            }

            .message {
                font-size: 1.3em;
                padding: 15px 25px;
            }

            .stats-board {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- رأس اللعبة -->
        <div class="game-header">
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
            <h1>⚔️ مبارزة البطاقات</h1>
            <div class="instructions">
                <p>اختر الرمز الصحيح للمقارنة بين العددين</p>
                <div class="range-info">المدى: {{ $min_range }} إلى {{ $max_range }}</div>
            </div>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <div class="battle-field">
                <!-- البطاقة الأولى -->
                <div class="card" id="card1">
                    <div class="card-label">العدد الأول</div>
                    <div id="number1" class="number-display">---</div>
                </div>

                <!-- منطقة المقارنة -->
                <div class="comparison-area">
                    <div id="comparison-symbol" class="symbol-display">?</div>
                </div>

                <!-- البطاقة الثانية -->
                <div class="card" id="card2">
                    <div class="card-label">العدد الثاني</div>
                    <div id="number2" class="number-display">---</div>
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-section">
                <div class="progress-container">
                    <div id="progress-bar" class="progress-bar"></div>
                </div>
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="greater-btn" class="control-btn greater-btn">> (أكبر من)</button>
                <button id="equal-btn" class="control-btn equal-btn">= (يساوي)</button>
                <button id="less-btn" class="control-btn less-btn">< (أصغر من)</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback">
                <div id="message" class="message info">اختر الرمز المناسب للمقارنة بين العددين!</div>
            </div>
        </div>

        <!-- التذييل -->
        <div class="game-footer">
            <div class="stats-board">
                <div class="stat-item">
                    <span class="stat-label">النقاط</span>
                    <span id="score" class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">الإجابات الصحيحة</span>
                    <span id="correct-answers" class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">التسلسل</span>
                    <span id="streak" class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">المستوى</span>
                    <span id="level" class="stat-value">1</span>
                </div>
            </div>

            <div class="action-controls">
                <button id="reset-btn" class="action-btn">🔄 إعادة المحاولة</button>
                <button id="new-game-btn" class="action-btn">🎮 جولة جديدة</button>
            </div>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // ===== تهيئة المتغيرات =====
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        const operationType = '{{ $operation_type }}'; // comparison

        let num1 = 0;
        let num2 = 0;
        let score = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let currentLevel = 1;
        let totalQuestions = 0;

        // ===== العناصر =====
        const number1Element = document.getElementById('number1');
        const number2Element = document.getElementById('number2');
        const comparisonSymbolElement = document.getElementById('comparison-symbol');
        const card1Element = document.getElementById('card1');
        const card2Element = document.getElementById('card2');
        const messageElement = document.getElementById('message');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const streakElement = document.getElementById('streak');
        const levelElement = document.getElementById('level');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');

        // ===== الدوال الأساسية =====

        // توليد عدد عشوائي ضمن المدى المحدد
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // تنسيق الأرقام بفاصلة
        function formatNumber(number) {
            return number.toLocaleString('ar-EG');
        }

        // إعداد جولة جديدة
        function setupNewRound() {
            // توليد الأعداد مع ضمان التنوع
            do {
                num1 = generateRandomNumber();
                num2 = generateRandomNumber();

                // زيادة فرص ظهور أعداد متساوية في المستويات المتقدمة
                if (currentLevel >= 3 && Math.random() < 0.3) {
                    num2 = num1;
                }
            } while (num1 === num2 && currentLevel < 3); // تجنب التساوي في المستويات الأولى

            // تحديث الواجهة
            updateDisplay();
            resetControls();
            updateProgress();

            totalQuestions++;
        }

        // تحديث العرض
        function updateDisplay() {
            number1Element.textContent = formatNumber(num1);
            number2Element.textContent = formatNumber(num2);
            comparisonSymbolElement.textContent = '?';
            comparisonSymbolElement.classList.remove('correct');

            // إزالة تأثير الفوز من البطاقات
            card1Element.classList.remove('winner');
            card2Element.classList.remove('winner');

            messageElement.textContent = 'اختر الرمز المناسب للمقارنة بين العددين!';
            messageElement.className = 'message info';
        }

        // إعادة تعيين عناصر التحكم
        function resetControls() {
            const buttons = document.querySelectorAll('.control-btn');
            buttons.forEach(btn => {
                btn.disabled = false;
                btn.classList.remove('correct');
            });
        }

        // الحصول على الرمز الصحيح
        function getCorrectSymbol() {
            if (num1 > num2) return '>';
            if (num1 < num2) return '<';
            return '=';
        }

        // التحقق من الإجابة
        function checkAnswer(userChoice) {
            const correctSymbol = getCorrectSymbol();
            const allButtons = document.querySelectorAll('.control-btn');

            // تعطيل جميع الأزرار
            allButtons.forEach(btn => btn.disabled = true);

            // عرض اختيار المستخدم
            comparisonSymbolElement.textContent = userChoice;

            if (userChoice === correctSymbol) {
                // إجابة صحيحة
                handleCorrectAnswer(correctSymbol);
            } else {
                // إجابة خاطئة
                handleIncorrectAnswer(correctSymbol);
            }
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer(correctSymbol) {
            messageElement.textContent = getSuccessMessage();
            messageElement.className = 'message success';
            comparisonSymbolElement.classList.add('correct');

            // تحديث النقاط والتسلسل
            const pointsEarned = currentLevel * 10 + Math.min(currentStreak, 5);
            score += pointsEarned;
            correctAnswers++;
            currentStreak++;

            // إبراز البطاقة الفائزة
            if (correctSymbol === '>') {
                card1Element.classList.add('winner');
            } else if (correctSymbol === '<') {
                card2Element.classList.add('winner');
            } else {
                card1Element.classList.add('winner');
                card2Element.classList.add('winner');
            }

            // زيادة المستوى بعد 3 إجابات صحيحة متتالية
            if (currentStreak >= 3) {
                currentLevel++;
                levelElement.textContent = currentLevel;
                messageElement.textContent += ` 🚀 تقدمت للمستوى ${currentLevel}!`;

                // تأثير احتفال عند الترقية
                if (currentStreak === 3) {
                    createCelebration();
                }
            }

            // تحديث الإحصائيات
            updateStats();

            // الانتقال للجولة التالية
            setTimeout(() => {
                setupNewRound();
            }, 2000);
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer(correctSymbol) {
            messageElement.textContent = `خطأ! 😔 ${formatNumber(num1)} ${correctSymbol} ${formatNumber(num2)}`;
            messageElement.className = 'message error';
            score = Math.max(0, score - 5);
            currentStreak = 0;

            // تحديث الإحصائيات
            updateStats();

            // الانتقال للجولة التالية
            setTimeout(() => {
                setupNewRound();
            }, 2500);
        }

        // الحصول على رسالة نجاح عشوائية
        function getSuccessMessage() {
            const messages = [
                `أحسنت! 🎉 ${formatNumber(num1)} ${getCorrectSymbol()} ${formatNumber(num2)}`,
                `رائع! ⚡ إجابة صحيحة`,
                `مذهل! 🌟 أنت تتقن المقارنة`,
                `إبداع! 💫 استمر في التميز`,
                `برافو! 👏 فهم ممتاز للمقارنة`
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            correctAnswersElement.textContent = correctAnswers;
            streakElement.textContent = currentStreak;
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (currentStreak % 3) * 33.33;
            progressBar.style.width = `${progress}%`;
        }

        // بدء لعبة جديدة
        function startNewGame() {
            score = 0;
            correctAnswers = 0;
            currentStreak = 0;
            currentLevel = 1;
            totalQuestions = 0;

            levelElement.textContent = currentLevel;
            updateStats();
            setupNewRound();
        }

        // تأثير الاحتفال
        function createCelebration() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            const colors = ['#e67e22', '#f39c12', '#e74c3c', '#3498db', '#27ae60', '#9b59b6'];

            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = `${Math.random() * 100}%`;
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `confettiFall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.animationDelay = `${Math.random() * 0.5}s`;

                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 3000);
        }

        // ===== تهيئة الأحداث =====
        document.getElementById('greater-btn').addEventListener('click', () => checkAnswer('>'));
        document.getElementById('less-btn').addEventListener('click', () => checkAnswer('<'));
        document.getElementById('equal-btn').addEventListener('click', () => checkAnswer('='));
        document.getElementById('reset-btn').addEventListener('click', setupNewRound);
        document.getElementById('new-game-btn').addEventListener('click', startNewGame);

        // بدء اللعبة عند تحميل الصفحة
        window.addEventListener('load', startNewGame);
    </script>
</body>
</html>
