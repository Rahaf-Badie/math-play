<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 متاهة الضرب السريع - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 900px;
        }

        /* ===== رأس اللعبة ===== */
        .game-header {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .game-header::before {
            content: "🎯";
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
            font-size: 2.8em;
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

        .multiplier-info {
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

        .question-section {
            background: white;
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 4px solid #3498db;
            text-align: center;
        }

        .question-display {
            font-size: 3em;
            font-weight: bold;
            color: #e74c3c;
            margin: 20px 0;
            padding: 25px;
            border: 3px dashed #27ae60;
            border-radius: 15px;
            background: #f8f9fa;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Courier New', monospace;
        }

        .progress-section {
            margin: 20px 0;
            text-align: center;
        }

        .progress-container {
            width: 100%;
            background: #e0e0e0;
            border-radius: 10px;
            margin: 15px 0;
            overflow: hidden;
            height: 16px;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
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

        /* ===== لوحة المتاهة ===== */
        .maze-section {
            background: white;
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #9b59b6;
        }

        .maze-board {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .maze-cell {
            background: white;
            border: 4px solid #3498db;
            border-radius: 15px;
            padding: 25px 15px;
            font-size: 1.8em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .maze-cell::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
        }

        .maze-cell:hover {
            background: #e3f2fd;
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
            z-index: 2;
        }

        .maze-cell.correct {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            border-color: #229954;
            transform: scale(1.08);
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.4);
            animation: cellPop 0.6s ease;
            pointer-events: none;
        }

        .maze-cell.incorrect {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            border-color: #c0392b;
            animation: cellShake 0.6s ease;
            pointer-events: none;
        }

        .maze-cell.completed {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            border-color: #e67e22;
            pointer-events: none;
        }

        @keyframes cellPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.15); }
            100% { transform: scale(1.08); }
        }

        @keyframes cellShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* ===== التغذية الراجعة ===== */
        .feedback {
            min-height: 100px;
            margin: 25px 0;
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
            max-width: 90%;
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
        .score-board {
            background: white;
            padding: 25px;
            border-radius: 20px;
            margin-top: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border: 3px solid #e74c3c;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 20px;
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
            border: 2px solid #e74c3c;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 2.2em;
            font-weight: bold;
            color: #e74c3c;
            display: block;
            margin-top: 8px;
        }

        .stat-label {
            color: #7f8c8d;
            font-weight: bold;
            font-size: 1.1em;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 18px 35px;
            font-size: 1.4em;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            min-width: 200px;
        }

        .btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .btn:active {
            transform: translateY(2px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
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

            .question-display {
                font-size: 2.2em;
                padding: 20px;
            }

            .maze-board {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .maze-cell {
                padding: 20px 10px;
                font-size: 1.5em;
                min-height: 80px;
            }

            .controls {
                gap: 15px;
            }

            .btn {
                padding: 15px 25px;
                font-size: 1.2em;
                min-width: 160px;
            }

            .stats {
                gap: 15px;
            }

            .stat-item {
                min-width: 120px;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .game-area {
                padding: 25px;
            }

            .maze-board {
                grid-template-columns: 1fr;
            }

            .question-display {
                font-size: 1.8em;
            }

            .message {
                font-size: 1.3em;
                padding: 15px 25px;
            }

            .stats {
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
            <h1>🎯 متاهة الضرب السريع</h1>
            <div class="instructions">
                <p>اختر الإجابة الصحيحة لتتقدم في المتاهة وأكمل جميع المستويات!</p>
                <div class="multiplier-info" id="multiplier-info">الضرب في: 2</div>
            </div>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- قسم السؤال -->
            <div class="question-section">
                <div id="question-display" class="question-display">---</div>

                <div class="progress-section">
                    <div>التقدم في المستوى</div>
                    <div class="progress-container">
                        <div id="level-progress" class="progress-bar"></div>
                    </div>
                    <div>التقدم الكلي</div>
                    <div class="progress-container">
                        <div id="total-progress" class="progress-bar"></div>
                    </div>
                </div>
            </div>

            <!-- لوحة المتاهة -->
            <div class="maze-section">
                <h3 style="text-align: center; color: #2c3e50; margin-bottom: 20px;">اختر الإجابة الصحيحة</h3>
                <div id="maze-board" class="maze-board">
                    <!-- سيتم تعبئة المتاهة بالجافاسكريبت -->
                </div>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback">
                <div id="message" class="message info">انقر على "بدء اللعبة" لبدء المتاهة!</div>
            </div>

            <!-- لوحة النقاط -->
            <div class="score-board">
                <div class="stats">
                    <div class="stat-item">
                        <span class="stat-label">النقاط</span>
                        <span id="score" class="stat-value">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">المستوى</span>
                        <span id="level" class="stat-value">1</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">التسلسل</span>
                        <span id="streak" class="stat-value">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">الضرب في</span>
                        <span id="current-multiplier" class="stat-value">2</span>
                    </div>
                </div>

                <div class="controls">
                    <button id="start-btn" class="btn btn-success">🚀 بدء اللعبة</button>
                    <button id="hint-btn" class="btn btn-primary">💡 تلميح</button>
                    <button id="reset-btn" class="btn btn-warning">🔄 إعادة</button>
                </div>
            </div>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // ===== تهيئة المتغيرات =====
        const multipliers = [2, 3, 4, 5, 6, 7, 8, 9];
        let currentMultiplierIndex = 0;
        let score = 0;
        let currentLevel = 1;
        let currentStreak = 0;
        let questionsInLevel = 0;
        let correctInLevel = 0;
        let totalQuestions = 0;
        let totalCorrect = 0;
        let currentQuestion = null;
        let mazeCells = [];

        // ===== العناصر =====
        const questionDisplay = document.getElementById('question-display');
        const mazeBoard = document.getElementById('maze-board');
        const messageElement = document.getElementById('message');
        const scoreElement = document.getElementById('score');
        const levelElement = document.getElementById('level');
        const streakElement = document.getElementById('streak');
        const multiplierInfo = document.getElementById('multiplier-info');
        const currentMultiplierElement = document.getElementById('current-multiplier');
        const levelProgress = document.getElementById('level-progress');
        const totalProgress = document.getElementById('total-progress');
        const celebrationElement = document.getElementById('celebration');

        // ===== الدوال الأساسية =====

        // توليد مسألة ضرب
        function generateMultiplicationProblem() {
            const multiplier = multipliers[currentMultiplierIndex];
            const num = Math.floor(Math.random() * 12) + 1; // من 1 إلى 12
            const answer = multiplier * num;

            return {
                multiplier,
                num,
                answer,
                display: `${multiplier} × ${num} = ?`
            };
        }

        // توليد خيارات خاطئة
        function generateWrongOptions(correctAnswer) {
            const options = new Set();
            options.add(correctAnswer);

            while (options.size < 4) {
                const errorTypes = [
                    correctAnswer + multiplier, // زيادة بمقدار المضاعف
                    correctAnswer - multiplier, // نقصان بمقدار المضاعف
                    correctAnswer + 1,          // زيادة بواحد
                    correctAnswer - 1,          // نقصان بواحد
                    correctAnswer + 10,         // زيادة بعشرة
                    correctAnswer - 10          // نقصان بعشرة
                ];

                const wrongOption = errorTypes[Math.floor(Math.random() * errorTypes.length)];

                if (wrongOption > 0 && wrongOption !== correctAnswer && !options.has(wrongOption)) {
                    options.add(wrongOption);
                }
            }

            return Array.from(options);
        }

        // إعداد لوحة المتاهة
        function setupMazeBoard() {
            currentQuestion = generateMultiplicationProblem();
            const options = generateWrongOptions(currentQuestion.answer);

            // خلط الخيارات
            for (let i = options.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [options[i], options[j]] = [options[j], options[i]];
            }

            // بناء لوحة المتاهة
            mazeBoard.innerHTML = '';
            mazeCells = [];

            options.forEach((option, index) => {
                const cell = document.createElement('div');
                cell.className = 'maze-cell';
                cell.textContent = option;
                cell.dataset.value = option;
                cell.dataset.correct = (option === currentQuestion.answer);

                cell.addEventListener('click', handleCellClick);
                mazeBoard.appendChild(cell);
                mazeCells.push(cell);
            });

            questionDisplay.textContent = currentQuestion.display;
            questionsInLevel++;
            updateProgress();
        }

        // معالجة النقر على الخلية
        function handleCellClick(event) {
            const cell = event.target;
            const isCorrect = cell.dataset.correct === 'true';

            // تعطيل جميع الخلايا
            mazeCells.forEach(c => {
                c.style.pointerEvents = 'none';
                if (c.dataset.correct === 'true') {
                    c.classList.add('correct');
                }
            });

            if (isCorrect) {
                cell.classList.add('correct');
                handleCorrectAnswer();
            } else {
                cell.classList.add('incorrect');
                handleIncorrectAnswer();
            }
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            score += 10;
            currentStreak++;
            correctInLevel++;
            totalCorrect++;

            showMessage(getSuccessMessage(), 'success');
            updateStats();

            if (correctInLevel >= 5) {
                // إكمال المستوى الحالي
                completeLevel();
            } else {
                // الانتقال للسؤال التالي
                setTimeout(setupMazeBoard, 1500);
            }
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            currentStreak = 0;
            showMessage(`خطأ! الإجابة الصحيحة هي ${currentQuestion.answer}`, 'error');
            updateStats();

            setTimeout(setupMazeBoard, 2000);
        }

        // إكمال المستوى
        function completeLevel() {
            score += 50; // مكافأة إكمال المستوى

            if (currentMultiplierIndex < multipliers.length - 1) {
                // الانتقال للمضاعف التالي
                currentMultiplierIndex++;
                currentLevel++;
                correctInLevel = 0;
                questionsInLevel = 0;

                showMessage(`🎉 مبروك! أكملت الضرب في ${multipliers[currentMultiplierIndex - 1]}! تقدم للضرب في ${multipliers[currentMultiplierIndex]}`, 'success');
                createCelebration();
            } else {
                // إكمال جميع المستويات
                showMessage(`🎊 تهانينا! أكملت جميع مستويات الضرب! النقاط النهائية: ${score}`, 'success');
                createCelebration();
            }

            updateStats();
            updateMultiplierInfo();
            setTimeout(setupMazeBoard, 3000);
        }

        // إظهار تلميح
        function showHint() {
            const correctCell = mazeCells.find(cell => cell.dataset.correct === 'true');
            if (correctCell) {
                correctCell.style.backgroundColor = '#fff3cd';
                correctCell.style.borderColor = '#ffc107';

                setTimeout(() => {
                    correctCell.style.backgroundColor = '';
                    correctCell.style.borderColor = '';
                }, 2000);

                showMessage('انظر إلى التلميح في المتاهة!', 'info');
            }
        }

        // بدء لعبة جديدة
        function startNewGame() {
            score = 0;
            currentLevel = 1;
            currentStreak = 0;
            currentMultiplierIndex = 0;
            correctInLevel = 0;
            questionsInLevel = 0;
            totalQuestions = 0;
            totalCorrect = 0;

            updateStats();
            updateMultiplierInfo();
            setupMazeBoard();
            showMessage('ابدأ المتاهة! اختر الإجابة الصحيحة', 'info');
        }

        // إعادة تعيين المستوى الحالي
        function resetLevel() {
            correctInLevel = 0;
            questionsInLevel = 0;
            setupMazeBoard();
            showMessage('أعدت بدء المستوى الحالي', 'info');
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            levelElement.textContent = currentLevel;
            streakElement.textContent = currentStreak;
            currentMultiplierElement.textContent = multipliers[currentMultiplierIndex];
        }

        // تحديث معلومات المضاعف
        function updateMultiplierInfo() {
            multiplierInfo.textContent = `الضرب في: ${multipliers[currentMultiplierIndex]}`;
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const levelProgressValue = (correctInLevel / 5) * 100;
            const totalProgressValue = (currentMultiplierIndex / multipliers.length) * 100;

            levelProgress.style.width = `${levelProgressValue}%`;
            totalProgress.style.width = `${totalProgressValue}%`;
        }

        // الحصول على رسالة نجاح عشوائية
        function getSuccessMessage() {
            const messages = [
                'أحسنت! 🌟',
                'رائع! ⚡',
                'إبداع! 💫',
                'ممتاز! 🎯',
                'برافو! 👏'
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // عرض رسالة
        function showMessage(text, type) {
            messageElement.textContent = text;
            messageElement.className = `message ${type}`;
        }

        // تأثير الاحتفال
        function createCelebration() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            const colors = ['#27ae60', '#3498db', '#e74c3c', '#f39c12', '#9b59b6', '#1abc9c'];

            for (let i = 0; i < 120; i++) {
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
            }, 3500);
        }

        // ===== تهيئة الأحداث =====
        document.getElementById('start-btn').addEventListener('click', startNewGame);
        document.getElementById('hint-btn').addEventListener('click', showHint);
        document.getElementById('reset-btn').addEventListener('click', resetLevel);

        // بدء اللعبة عند تحميل الصفحة
        window.addEventListener('load', () => {
            updateStats();
            updateMultiplierInfo();
            showMessage('انقر على "بدء اللعبة" لبدء المتاهة!', 'info');
        });
    </script>
</body>
</html>
