<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 سباق القيمة المنزلية - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #6c5ce7;
            --primary-dark: #5649c2;
            --success: #00b894;
            --success-dark: #00a085;
            --error: #ff7675;
            --error-dark: #e84393;
            --warning: #fdcb6e;
            --warning-dark: #f39c12;
            --info: #74b9ff;
            --info-dark: #0984e3;
            --secondary: #a29bfe;
            --secondary-dark: #8179e0;
            --text: #2d3436;
            --light: #f8f9fa;
            --dark: #2d3436;
            --place-value-bg: linear-gradient(135deg, #e9f5ff, #d4edff);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: var(--place-value-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            color: var(--text);
        }

        .header h1 {
            font-size: 2.8rem;
            margin-bottom: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
        }

        .header h1::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 25%;
            width: 50%;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 2px;
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-weight: bold;
            color: var(--primary-dark);
            backdrop-filter: blur(10px);
            border: 3px solid var(--primary);
            box-shadow: 0 6px 15px rgba(108, 92, 231, 0.2);
            font-size: 1.2rem;
        }

        .range-info {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(116, 185, 255, 0.3);
        }

        .game-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 40px;
            width: 100%;
            transition: transform 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 4px solid var(--primary);
        }

        .game-card::before {
            content: "🎮";
            position: absolute;
            top: -40px;
            right: -40px;
            font-size: 180px;
            color: rgba(108, 92, 231, 0.08);
            z-index: 0;
            font-weight: bold;
        }

        .game-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .place-value-guide {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 25px rgba(116, 185, 255, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .place-value-guide h3 {
            font-size: 1.6rem;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .place-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            margin-top: 20px;
        }

        .place-item {
            background: rgba(255, 255, 255, 0.25);
            padding: 15px 10px;
            border-radius: 12px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.4);
            transition: transform 0.3s ease;
        }

        .place-item:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.35);
        }

        .place-name {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .place-value {
            font-size: 1rem;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.3);
            padding: 5px 10px;
            border-radius: 8px;
        }

        .instructions {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--text);
            padding: 22px;
            border-radius: 20px;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 6px 20px rgba(253, 203, 110, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .instructions p {
            margin: 10px 0;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .number-display-container {
            position: relative;
            z-index: 1;
            margin: 35px 0;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 25px;
            border: 4px solid var(--primary);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
        }

        .number-display {
            font-size: 4.5rem;
            font-weight: bold;
            text-align: center;
            letter-spacing: 20px;
            margin: 25px 0;
            font-family: 'Courier New', monospace;
            direction: ltr;
            padding: 0 20px;
        }

        .digit {
            display: inline-block;
            min-width: 70px;
            text-align: center;
            transition: all 0.4s;
            padding: 15px 5px;
            border-radius: 15px;
            margin: 0 5px;
            position: relative;
        }

        .digit.highlighted {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            transform: scale(1.25);
            box-shadow: 0 10px 25px rgba(108, 92, 231, 0.5);
            animation: pulse 2s infinite;
            z-index: 2;
        }

        .digit.highlighted::before {
            content: "⬇️";
            position: absolute;
            top: -45px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.8rem;
            animation: bounce 1s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1.25);
                box-shadow: 0 10px 25px rgba(108, 92, 231, 0.5);
            }
            50% {
                transform: scale(1.35);
                box-shadow: 0 15px 35px rgba(108, 92, 231, 0.7);
            }
        }

        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-10px); }
        }

        .place-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            padding: 0 15px;
        }

        .place-label {
            font-size: 1.1rem;
            color: var(--primary-dark);
            font-weight: bold;
            text-align: center;
            min-width: 70px;
            background: rgba(108, 92, 231, 0.1);
            padding: 8px 5px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .place-label.active {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .question-text {
            text-align: center;
            font-size: 1.6rem;
            margin: 30px 0;
            color: var(--text);
            font-weight: bold;
            position: relative;
            z-index: 1;
            background: linear-gradient(135deg, var(--light), #e8f4ff);
            padding: 20px;
            border-radius: 15px;
            border: 3px solid var(--secondary);
            box-shadow: 0 6px 15px rgba(162, 155, 254, 0.2);
        }

        .input-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 25px;
            margin: 35px 0;
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
        }

        input[type="number"] {
            font-size: 2.2rem;
            padding: 20px;
            width: 220px;
            text-align: center;
            border: 4px solid var(--primary);
            border-radius: 20px;
            transition: all 0.4s;
            font-family: inherit;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            background: var(--light);
            color: var(--text);
        }

        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 6px rgba(108, 92, 231, 0.25);
            transform: scale(1.08);
            background: white;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin: 35px 0;
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
        }

        .btn {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
            border: none;
            border-radius: 20px;
            padding: 18px 35px;
            font-size: 1.4rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.4s;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            font-family: inherit;
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
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
        }

        .btn:active {
            transform: translateY(3px);
        }

        .btn-reset {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--text);
        }

        .btn-hint {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: white;
        }

        #feedback {
            margin-top: 30px;
            font-size: 1.6rem;
            min-height: 70px;
            text-align: center;
            padding: 22px;
            border-radius: 15px;
            transition: all 0.5s;
            position: relative;
            z-index: 1;
            font-weight: bold;
            backdrop-filter: blur(10px);
        }

        .feedback-correct {
            background: rgba(0, 184, 148, 0.2);
            color: var(--success-dark);
            border: 3px solid var(--success);
            animation: bounce 0.8s ease;
            box-shadow: 0 6px 20px rgba(0, 184, 148, 0.3);
        }

        .feedback-wrong {
            background: rgba(255, 118, 117, 0.2);
            color: var(--error-dark);
            border: 3px solid var(--error);
            animation: shake 0.6s ease;
            box-shadow: 0 6px 20px rgba(255, 118, 117, 0.3);
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--light), #e8f4ff);
            padding: 22px;
            border-radius: 20px;
            margin-top: 30px;
            position: relative;
            z-index: 1;
            border: 3px solid var(--primary);
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        }

        .score-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 15px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.7);
            min-width: 120px;
            transition: transform 0.3s ease;
        }

        .score-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.9);
        }

        .score-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-dark);
        }

        .score-label {
            font-size: 1.1rem;
            color: var(--text);
            font-weight: bold;
        }

        .progress {
            height: 18px;
            background: #e0e0e0;
            border-radius: 9px;
            margin-top: 20px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            width: 0%;
            transition: width 0.8s ease;
            border-radius: 9px;
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

        .visual-explanation {
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 20px;
            margin: 25px 0;
            border: 3px solid var(--info);
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 25px rgba(116, 185, 255, 0.2);
        }

        .explanation-text {
            text-align: center;
            font-size: 1.3rem;
            color: var(--primary-dark);
            font-weight: bold;
            line-height: 1.8;
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

        .confetti {
            position: absolute;
            width: 16px;
            height: 16px;
            background: var(--success);
            opacity: 0;
            border-radius: 3px;
        }

        .number-bubble {
            position: absolute;
            font-size: 1.8rem;
            color: var(--primary);
            animation: float 5s ease-in-out infinite;
            z-index: 0;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg) scale(1);
            }
            33% {
                transform: translateY(-30px) rotate(120deg) scale(1.1);
            }
            66% {
                transform: translateY(-20px) rotate(240deg) scale(0.9);
            }
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100px) rotate(0deg) scale(1);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg) scale(0.5);
                opacity: 0;
            }
        }

        @keyframes bounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-15px); }
            80% { transform: translateY(-8px); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-15px); }
            75% { transform: translateX(15px); }
        }

        .level-indicator {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.3);
            z-index: 2;
        }

        /* تصميم متجاوب */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .game-card {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 2.2rem;
            }

            .number-display {
                font-size: 3.2rem;
                letter-spacing: 12px;
            }

            .digit {
                min-width: 50px;
                padding: 10px 3px;
            }

            .place-label {
                min-width: 50px;
                font-size: 0.9rem;
            }

            .place-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }

            input[type="number"] {
                width: 180px;
                font-size: 1.8rem;
                padding: 18px;
            }

            .controls {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                width: 100%;
                min-width: auto;
            }

            .score-container {
                flex-direction: column;
                gap: 15px;
            }

            .score-item {
                min-width: 100px;
            }
        }

        @media (max-width: 480px) {
            .number-display {
                font-size: 2.5rem;
                letter-spacing: 8px;
            }

            .digit {
                min-width: 40px;
                padding: 8px 2px;
            }

            .place-label {
                min-width: 40px;
                font-size: 0.8rem;
            }

            .question-text {
                font-size: 1.3rem;
                padding: 15px;
            }

            input[type="number"] {
                width: 150px;
                font-size: 1.6rem;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎮 سباق القيمة المنزلية</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
            <div class="range-info">المدى: {{ $min_range }} إلى {{ $max_range }}</div>
        </div>

        <div class="game-card">
            <div class="level-indicator">المستوى: <span id="level">1</span></div>

            <div class="place-value-guide">
                <h3>📊 دليل المنازل العددية</h3>
                <div class="place-grid" id="place-grid">
                    <!-- سيتم تعبئة المنازل بالجافاسكريبت -->
                </div>
            </div>

            <div class="instructions">
                <p>🎯 حدد القيمة المنزلية للرقم المظلل في العدد</p>
                <p>💡 تذكر: القيمة المنزلية = الرقم × قيمة المنزلة</p>
                <p>⚡ استعد للسباق التعليمي!</p>
            </div>

            <div class="number-display-container">
                <div class="number-display" id="number-display">
                    <!-- سيتم تعبئة الأرقام بالجافاسكريبت -->
                </div>
                <div class="place-labels" id="place-labels">
                    <!-- سيتم تعبئة تسميات المنازل بالجافاسكريبت -->
                </div>
            </div>

            <div class="question-text" id="question-text">
                <!-- سيتم تعبئة السؤال بالجافاسكريبت -->
            </div>

            <div class="visual-explanation" id="visual-explanation">
                <div class="explanation-text" id="explanation-text">
                    <!-- سيتم تعبئة الشرح البصري بالجافاسكريبت -->
                </div>
            </div>

            <div class="input-container">
                <input type="number" id="answer" placeholder="أدخل القيمة المنزلية" min="0">
                <button class="btn btn-hint" id="hint-btn">💡 تلميح</button>
            </div>

            <div class="controls">
                <button class="btn" id="check-btn">✅ تحقق من الإجابة</button>
                <button class="btn btn-reset" id="reset-btn">🔄 سؤال جديد</button>
            </div>

            <div id="feedback"></div>

            <div class="score-container">
                <div class="score-item">
                    <span class="score-label">النقاط</span>
                    <span class="score-value" id="score">0</span>
                </div>
                <div class="score-item">
                    <span class="score-label">التسلسل</span>
                    <span class="score-value" id="streak">0</span>
                </div>
                <div class="score-item">
                    <span class="score-label">السؤال</span>
                    <span class="score-value"><span id="current-question">0</span>/<span id="total-questions">10</span></span>
                </div>
                <div class="score-item">
                    <span class="score-label">الوقت</span>
                    <span class="score-value" id="timer">60</span>
                </div>
            </div>

            <div class="progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range ?? 1000 }};
        const maxRange = {{ $max_range ?? 9999 }};
        const operationType = "{{ $operation_type ?? 'place_value' }}";

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let currentNumber = 0;
        let highlightedDigitIndex = 0;
        let correctPlaceValue = 0;
        let streak = 0;
        let timer = 60;
        let timerInterval;
        let maxDigits = maxRange <= 9999 ? 4 : 5;

        // عناصر DOM
        const numberDisplay = document.getElementById('number-display');
        const placeLabels = document.getElementById('place-labels');
        const placeGrid = document.getElementById('place-grid');
        const questionText = document.getElementById('question-text');
        const explanationText = document.getElementById('explanation-text');
        const scoreElement = document.getElementById('score');
        const streakElement = document.getElementById('streak');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const feedbackElement = document.getElementById('feedback');
        const answerInput = document.getElementById('answer');
        const checkButton = document.getElementById('check-btn');
        const resetButton = document.getElementById('reset-btn');
        const hintButton = document.getElementById('hint-btn');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const levelElement = document.getElementById('level');
        const timerElement = document.getElementById('timer');

        // أسماء المنازل وقيمها
        const placeNames = ['آحاد', 'عشرات', 'مئات', 'آحاد الآلاف', 'عشرات الآلاف'];
        const placeValues = [1, 10, 100, 1000, 10000];

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            checkButton.addEventListener('click', submitAnswer);
            resetButton.addEventListener('click', generateQuestion);
            hintButton.addEventListener('click', showHint);
            answerInput.addEventListener('keydown', handleKeyPress);

            initializePlaceGrid();
            createNumberBubbles();
            startTimer();
            generateQuestion();
        });

        // تهيئة شبكة المنازل
        function initializePlaceGrid() {
            placeGrid.innerHTML = '';
            for (let i = maxDigits - 1; i >= 0; i--) {
                const placeItem = document.createElement('div');
                placeItem.className = 'place-item';
                placeItem.innerHTML = `
                    <div class="place-name">${placeNames[i]}</div>
                    <div class="place-value">× ${placeValues[i].toLocaleString('ar-EG')}</div>
                `;
                placeGrid.appendChild(placeItem);
            }
        }

        // بدء المؤقت
        function startTimer() {
            timerInterval = setInterval(() => {
                timer--;
                timerElement.textContent = timer;

                if (timer <= 10) {
                    timerElement.style.color = 'var(--error)';
                    timerElement.style.animation = 'pulse 1s infinite';
                }

                if (timer <= 0) {
                    endGame();
                }
            }, 1000);
        }

        // توليد عدد عشوائي ضمن المدى
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // إنشاء فقاعات الأرقام
        function createNumberBubbles() {
            const container = document.querySelector('.game-card');
            for (let i = 0; i < 8; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'number-bubble';
                bubble.textContent = Math.floor(Math.random() * 10);
                bubble.style.left = `${Math.random() * 85 + 5}%`;
                bubble.style.top = `${Math.random() * 85 + 5}%`;
                bubble.style.animationDelay = `${Math.random() * 4}s`;
                container.appendChild(bubble);
            }
        }

        // توليد سؤال جديد
        function generateQuestion() {
            if (questionCount >= totalQuestions) {
                endGame();
                return;
            }

            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();
            updateLevel();

            currentNumber = generateRandomNumber();
            const numberStr = currentNumber.toString();
            const digitCount = numberStr.length;

            // اختيار منزلة عشوائية
            highlightedDigitIndex = Math.floor(Math.random() * digitCount);
            const placeValueIndex = digitCount - 1 - highlightedDigitIndex;
            const highlightedDigit = parseInt(numberStr[highlightedDigitIndex]);
            correctPlaceValue = highlightedDigit * placeValues[placeValueIndex];

            // عرض العدد مع التظليل
            displayNumberWithHighlight(numberStr, digitCount, highlightedDigitIndex);

            // تحديث نص السؤال
            questionText.textContent = `ما القيمة المنزلية للرقم ${highlightedDigit} في العدد ${currentNumber.toLocaleString('ar-EG')}؟`;

            // تحديث الشرح البصري
            explanationText.textContent = `الرقم ${highlightedDigit} في منزلة ${placeNames[placeValueIndex]} → ${highlightedDigit} × ${placeValues[placeValueIndex].toLocaleString('ar-EG')} = ${correctPlaceValue.toLocaleString('ar-EG')}`;

            answerInput.value = '';
            answerInput.focus();
            feedbackElement.textContent = '';
            feedbackElement.className = '';
        }

        // عرض العدد مع التظليل
        function displayNumberWithHighlight(numberStr, digitCount, highlightIndex) {
            numberDisplay.innerHTML = '';
            placeLabels.innerHTML = '';

            for (let i = 0; i < maxDigits; i++) {
                const digitElement = document.createElement('span');
                digitElement.className = 'digit';

                if (i >= maxDigits - digitCount) {
                    const digitIndex = i - (maxDigits - digitCount);
                    const digit = numberStr[digitIndex];
                    digitElement.textContent = digit;

                    if (digitIndex === highlightIndex) {
                        digitElement.classList.add('highlighted');
                    }
                } else {
                    digitElement.innerHTML = '&nbsp;';
                }

                numberDisplay.appendChild(digitElement);

                // إضافة تسميات المنازل
                const labelElement = document.createElement('div');
                labelElement.className = 'place-label';
                if (i >= maxDigits - digitCount) {
                    labelElement.textContent = placeNames[maxDigits - 1 - i];
                    if (i === maxDigits - digitCount + highlightIndex) {
                        labelElement.classList.add('active');
                    }
                } else {
                    labelElement.innerHTML = '&nbsp;';
                }
                placeLabels.appendChild(labelElement);
            }
        }

        // التعامل مع الضغط على الأزرار
        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                submitAnswer();
            }
        }

        // إظهار التلميح
        function showHint() {
            const digits = currentNumber.toString();
            const highlightedDigit = parseInt(digits[highlightedDigitIndex]);
            const placeValueIndex = digits.length - 1 - highlightedDigitIndex;

            feedbackElement.textContent = `💡 تلميح: الرقم ${highlightedDigit} في منزلة ${placeNames[placeValueIndex]} (${placeValues[placeValueIndex].toLocaleString('ar-EG')})`;
            feedbackElement.className = "feedback-correct";

            // خصم نقاط عند استخدام التلميح
            score = Math.max(0, score - 2);
            scoreElement.textContent = score;
        }

        // التحقق من الإجابة
        function submitAnswer() {
            const userAnswer = parseInt(answerInput.value);

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = "⚠️ يرجى إدخال قيمة رقمية";
                feedbackElement.className = "feedback-wrong";
                answerInput.focus();
                return;
            }

            if (userAnswer === correctPlaceValue) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            const points = 10 + Math.min(streak, 5); // نقاط إضافية للتسلسل
            score += points;
            streak++;

            scoreElement.textContent = score;
            streakElement.textContent = streak;

            feedbackElement.textContent = `${getSuccessMessage()} +${points} نقطة!`;
            feedbackElement.className = "feedback-correct";

            // تأثير الاحتفال عند الإجابات الصحيحة المتتالية
            if (streak >= 3) {
                createCelebration();
            }

            // إضافة وقت إضافي للإجابات الصحيحة
            timer += 5;
            timerElement.textContent = timer;

            setTimeout(() => {
                generateQuestion();
            }, 1500);
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            streak = 0;
            streakElement.textContent = streak;

            feedbackElement.textContent = `❌ إجابة خاطئة. القيمة الصحيحة هي ${correctPlaceValue.toLocaleString('ar-EG')}`;
            feedbackElement.className = "feedback-wrong";

            setTimeout(() => {
                generateQuestion();
            }, 2000);
        }

        // الحصول على رسالة نجاح عشوائية
        function getSuccessMessage() {
            const messages = [
                "أحسنت! 🌟 فهمت القيمة المنزلية",
                "رائع! 🎯 إجابة صحيحة",
                "إبداع! 💫 أنت تتقن المنازل العددية",
                "ممتاز! ⚡ استمر في التميز",
                "برافو! 👏 فهم ممتاز للمنازل",
                "ذهبي! 🥇 أنت سريع جداً",
                "مذهل! 🚀 تسلسل رائع"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // تحديث المستوى
        function updateLevel() {
            const level = Math.floor(score / 50) + 1;
            levelElement.textContent = level;
        }

        // إنهاء اللعبة
        function endGame() {
            clearInterval(timerInterval);

            questionText.textContent = "🎉 انتهت اللعبة!";
            numberDisplay.style.display = 'none';
            placeLabels.style.display = 'none';
            answerInput.style.display = 'none';
            checkButton.style.display = 'none';
            hintButton.style.display = 'none';
            document.getElementById('visual-explanation').style.display = 'none';

            let message = "";
            let emoji = "";
            if (score >= 120) {
                message = "مذهل! 🏆 أنت خبير في القيم المنزلية";
                emoji = "🎊";
            } else if (score >= 80) {
                message = "رائع! ⭐ فهم ممتاز للمنازل";
                emoji = "✨";
            } else if (score >= 50) {
                message = "جيد جداً! 👍 واصل التعلم";
                emoji = "📚";
            } else {
                message = "حاول مرة أخرى! 💪 ستتحسن مع الممارسة";
                emoji = "🎯";
            }

            feedbackElement.innerHTML = `${message} ${emoji}<br><br>مجموع نقاطك: <strong>${score}</strong> من ${totalQuestions * 15}`;
            feedbackElement.className = "feedback-correct";

            createCelebration();
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (questionCount / totalQuestions) * 100;
            progressBar.style.width = `${progress}%`;
        }

        // تأثير الاحتفال
        function createCelebration() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            const colors = ['#6c5ce7', '#5649c2', '#00b894', '#ff7675', '#fdcb6e', '#74b9ff', '#a29bfe'];

            for (let i = 0; i < 150; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = `${Math.random() * 100}%`;
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.animationDelay = `${Math.random() * 0.5}s`;

                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 4000);
        }
    </script>
</body>
</html>
