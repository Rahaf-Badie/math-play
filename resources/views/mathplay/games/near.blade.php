<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 لعبة مغامرة التقريب - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #764ba2;
            --success: #00b894;
            --success-dark: #00a085;
            --error: #ff7675;
            --error-dark: #e84393;
            --warning: #fdcb6e;
            --warning-dark: #f39c12;
            --info: #74b9ff;
            --info-dark: #0984e3;
            --text: #2d3436;
            --light: #f8f9fa;
            --rounding-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: var(--rounding-bg);
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
            max-width: 1000px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            color: white;
        }

        .header h1 {
            font-size: 2.4rem;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.9);
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-weight: bold;
            color: var(--primary-dark);
            backdrop-filter: blur(10px);
            border: 2px solid var(--primary);
        }

        .game-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 35px;
            width: 100%;
            transition: transform 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .game-card::before {
            content: "≈";
            position: absolute;
            top: -30px;
            right: -30px;
            font-size: 150px;
            color: rgba(102, 126, 234, 0.08);
            z-index: 0;
            font-weight: bold;
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .rounding-guide {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 6px 20px rgba(116, 185, 255, 0.3);
        }

        .rounding-guide h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        .guide-rules {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .rule-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .rule-icon {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .rule-text {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .instructions {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--text);
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(253, 203, 110, 0.3);
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.15rem;
            font-weight: bold;
        }

        .problem-container {
            position: relative;
            z-index: 1;
            margin: 30px 0;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--primary);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .number-display {
            font-size: 3.5rem;
            font-weight: bold;
            color: var(--primary-dark);
            text-align: center;
            margin: 20px 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            font-family: 'Courier New', monospace;
            letter-spacing: 3px;
            direction: ltr;
            text-align: center;
        }

        .rounding-instruction {
            text-align: center;
            font-size: 1.6rem;
            margin: 25px 0;
            color: var(--text);
            font-weight: bold;
            position: relative;
            z-index: 1;
        }

        .number-line-container {
            background: #e3f2fd;
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            position: relative;
            z-index: 1;
        }

        .number-line {
            height: 80px;
            background: white;
            border-radius: 10px;
            position: relative;
            margin: 20px 0;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary);
            transform: translateY(-50%);
        }

        .tick {
            position: absolute;
            top: 50%;
            width: 2px;
            height: 20px;
            background: #666;
            transform: translateY(-50%);
        }

        .tick.major {
            height: 30px;
            background: var(--primary);
        }

        .tick-label {
            position: absolute;
            top: 60%;
            transform: translateX(-50%);
            font-size: 0.9rem;
            color: var(--text);
            font-weight: bold;
        }

        .target-marker {
            position: absolute;
            top: 20%;
            width: 50px;
            height: 50px;
            background: var(--error);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            transform: translateX(-50%);
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            animation: bounce 2s infinite;
            font-size: 1.2rem;
        }

        .rounding-marker {
            position: absolute;
            top: 70%;
            width: 40px;
            height: 40px;
            background: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            transform: translateX(-50%);
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            font-size: 1.1rem;
        }

        .options-container {
            position: relative;
            z-index: 1;
            margin: 30px 0;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 25px 0;
        }

        @media (max-width: 768px) {
            .options-grid {
                grid-template-columns: 1fr;
            }

            .guide-rules {
                grid-template-columns: 1fr;
            }
        }

        .option-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 15px;
            padding: 25px 20px;
            font-size: 1.4rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 15px rgba(102, 126, 234, 0.3);
            font-family: inherit;
            position: relative;
            overflow: hidden;
        }

        .option-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .option-btn:hover::before {
            left: 100%;
        }

        .option-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .option-btn:active {
            transform: translateY(2px);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            animation: celebrate 0.6s ease;
        }

        .option-btn.incorrect {
            background: linear-gradient(135deg, var(--error), var(--error-dark));
            animation: shake 0.5s ease;
        }

        .visual-explanation {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border: 2px solid var(--info);
            position: relative;
            z-index: 1;
        }

        .explanation-text {
            text-align: center;
            font-size: 1.2rem;
            color: var(--primary-dark);
            font-weight: bold;
        }

        .rounding-steps {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            text-align: right;
        }

        .step {
            margin: 12px 0;
            padding: 12px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: none;
        }

        .step.active {
            display: block;
            animation: fadeIn 0.5s ease;
            border-right: 4px solid var(--info);
        }

        .step-number {
            display: inline-block;
            width: 30px;
            height: 30px;
            background: var(--info);
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            margin-left: 10px;
            font-weight: bold;
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.5rem;
            min-height: 60px;
            text-align: center;
            padding: 18px;
            border-radius: 12px;
            transition: all 0.4s;
            position: relative;
            z-index: 1;
            font-weight: bold;
        }

        .feedback-correct {
            background: rgba(0, 184, 148, 0.15);
            color: var(--success-dark);
            border: 2px solid var(--success);
            animation: bounce 0.6s ease;
        }

        .feedback-wrong {
            background: rgba(255, 118, 117, 0.15);
            color: var(--error-dark);
            border: 2px solid var(--error);
            animation: shake 0.5s ease;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
        }

        .btn {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
            border: none;
            border-radius: 15px;
            padding: 16px 32px;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            font-family: inherit;
            min-width: 160px;
        }

        .btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(2px);
        }

        .btn-reset {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--text);
        }

        .btn-hint {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--light), #f0f4f8);
            padding: 18px;
            border-radius: 15px;
            margin-top: 25px;
            position: relative;
            z-index: 1;
            border: 2px solid var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .score-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .score-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-dark);
        }

        .score-label {
            font-size: 1rem;
            color: var(--text);
        }

        .progress {
            height: 14px;
            background: #e0e0e0;
            border-radius: 7px;
            margin-top: 15px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            width: 0%;
            transition: width 0.6s ease;
            border-radius: 7px;
        }

        .level-indicator {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
        }

        .level-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #ddd;
            transition: all 0.3s;
        }

        .level-dot.active {
            background: var(--success);
            transform: scale(1.2);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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
            width: 14px;
            height: 14px;
            background: var(--success);
            opacity: 0;
        }

        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-10px); }
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-12px); }
            75% { transform: translateX(12px); }
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* تصميم متجاوب */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .game-card {
                padding: 25px 20px;
            }

            .number-display {
                font-size: 2.8rem;
            }

            .options-grid {
                grid-template-columns: 1fr;
            }

            .controls {
                flex-direction: column;
                gap: 12px;
            }

            .btn {
                width: 100%;
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .number-display {
                font-size: 2.2rem;
            }

            .rounding-instruction {
                font-size: 1.3rem;
            }

            .option-btn {
                padding: 20px 15px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎯 لعبة مغامرة التقريب</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="rounding-guide">
                <h3>📊 قواعد التقريب الذهبية</h3>
                <div class="guide-rules">
                    <div class="rule-item">
                        <div class="rule-icon">0-4️⃣</div>
                        <div class="rule-text">إذا كان الرقم 0-4<br>أبقِ الرقم كما هو</div>
                    </div>
                    <div class="rule-item">
                        <div class="rule-icon">5-9️⃣</div>
                        <div class="rule-text">إذا كان الرقم 5-9<br>زِد الرقم 1</div>
                    </div>
                </div>
            </div>

            <div class="instructions">
                <p>🎯 قرب العدد المعروض إلى المنزلة المطلوبة</p>
                <p>💡 انظر إلى الرقم الذي يلي المنزلة المطلوبة لتحديد طريقة التقريب</p>
            </div>

            <div class="level-indicator">
                <div class="level-dot" id="level-1"></div>
                <div class="level-dot" id="level-2"></div>
                <div class="level-dot" id="level-3"></div>
                <div class="level-dot" id="level-4"></div>
            </div>

            <div class="problem-container">
                <div class="rounding-instruction" id="rounding-instruction">
                    <!-- سيتم تعبئة التعليمات بالجافاسكريبت -->
                </div>

                <div class="number-display" id="number-display">
                    <!-- سيتم تعبئة العدد بالجافاسكريبت -->
                </div>

                <div class="number-line-container">
                    <div class="number-line" id="number-line">
                        <!-- سيتم إنشاء خط الأعداد هنا -->
                    </div>
                </div>

                <div class="visual-explanation">
                    <div class="explanation-text" id="explanation-text">
                        <!-- سيتم تعبئة الشرح البصري بالجافاسكريبت -->
                    </div>
                </div>

                <div class="rounding-steps" id="rounding-steps">
                    <div class="step" id="step1">
                        <span class="step-number">1</span>
                        انظر إلى الرقم الذي يلي المنزلة التي تريد التقريب إليها
                    </div>
                    <div class="step" id="step2">
                        <span class="step-number">2</span>
                        إذا كان هذا الرقم 5 أو أكبر، زد الرقم في المنزلة المطلوبة بمقدار 1
                    </div>
                    <div class="step" id="step3">
                        <span class="step-number">3</span>
                        إذا كان هذا الرقم 4 أو أقل، اترك الرقم في المنزلة المطلوبة كما هو
                    </div>
                    <div class="step" id="step4">
                        <span class="step-number">4</span>
                        اجعل كل الأرقام التي تلي المنزلة المطلوبة تساوي صفر
                    </div>
                </div>
            </div>

            <div class="options-container">
                <div class="options-grid" id="options-grid">
                    <!-- سيتم تعبئة خيارات الإجابة بالجافاسكريبت -->
                </div>
            </div>

            <div id="feedback" class="feedback"></div>

            <div class="controls">
                <button class="btn" id="check-btn" style="display: none;">✅ تحقق من الإجابة</button>
                <button class="btn btn-hint" id="hint-btn">💡 عرض تلميح</button>
                <button class="btn" id="explain-btn">📖 شرح الطريقة</button>
                <button class="btn btn-reset" id="reset-btn">🔄 سؤال جديد</button>
            </div>

            <div class="score-container">
                <div class="score-item">
                    <span class="score-label">النقاط</span>
                    <span class="score-value" id="score">0</span>
                </div>
                <div class="score-item">
                    <span class="score-label">السؤال</span>
                    <span class="score-value"><span id="current-question">0</span>/<span id="total-questions">10</span></span>
                </div>
                <div class="score-item">
                    <span class="score-label">المستوى</span>
                    <span class="score-value" id="level">1</span>
                </div>
                <div class="score-item">
                    <span class="score-label">الإجابات المتتالية</span>
                    <span class="score-value" id="streak">0</span>
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
        const maxRange = {{ $max_range ?? 99999 }};
        const operationType = "{{ $operation_type ?? 'rounding' }}";

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let currentNumber = 0;
        let roundingPlace = 0;
        let correctAnswer = 0;
        let streak = 0;
        let currentLevel = 0;
        let explanationStep = 0;

        // خيارات التقريب
        const roundingOptions = [
            { value: 10, name: 'أقرب عشرة', example: 'الآحاد' },
            { value: 100, name: 'أقرب مئة', example: 'العشرات' },
            { value: 1000, name: 'أقرب ألف', example: 'المئات' },
            { value: 10000, name: 'أقرب عشرة آلاف', example: 'الآلاف' }
        ];

        // عناصر DOM
        const numberDisplay = document.getElementById('number-display');
        const roundingInstruction = document.getElementById('rounding-instruction');
        const explanationText = document.getElementById('explanation-text');
        const optionsGrid = document.getElementById('options-grid');
        const numberLine = document.getElementById('number-line');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const explainButton = document.getElementById('explain-btn');
        const resetButton = document.getElementById('reset-btn');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const levelElement = document.getElementById('level');
        const streakElement = document.getElementById('streak');
        const levelDots = [
            document.getElementById('level-1'),
            document.getElementById('level-2'),
            document.getElementById('level-3'),
            document.getElementById('level-4')
        ];

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            checkButton.addEventListener('click', checkAnswer);
            hintButton.addEventListener('click', showHint);
            explainButton.addEventListener('click', explainMethod);
            resetButton.addEventListener('click', generateQuestion);

            generateQuestion();
        });

        // توليد عدد عشوائي ضمن المدى
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // تحديث مؤشر المستوى
        function updateLevelIndicator() {
            levelDots.forEach((dot, index) => {
                if (index <= currentLevel) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();
            updateLevel();

            // تحديث المستوى بناءً على عدد الأسئلة
            currentLevel = Math.min(Math.floor(questionCount / 3), 3);
            updateLevelIndicator();

            currentNumber = generateRandomNumber();
            const randomOption = roundingOptions[currentLevel];
            roundingPlace = randomOption.value;

            // حساب الإجابة الصحيحة
            correctAnswer = Math.round(currentNumber / roundingPlace) * roundingPlace;

            // تحديث العرض
            numberDisplay.textContent = currentNumber.toLocaleString('ar-EG');
            roundingInstruction.textContent = `قرب العدد إلى ${randomOption.name} (انظر إلى منزلة ${randomOption.example})`;

            // إنشاء خط الأعداد
            createNumberLine();

            // تحديث الشرح البصري
            updateVisualExplanation();

            // توليد خيارات الإجابة
            generateAnswerOptions();

            feedbackElement.textContent = 'اختر الإجابة الصحيحة من الخيارات أدناه';
            feedbackElement.className = 'feedback';

            // إعادة تعيين الشرح
            resetExplanation();

            streak = 0;
            streakElement.textContent = streak;
        }

        // إنشاء خط الأعداد
        function createNumberLine() {
            numberLine.innerHTML = '';

            // إضافة الخط الرئيسي
            const line = document.createElement('div');
            line.className = 'line';
            numberLine.appendChild(line);

            // تحديد نطاق خط الأعداد بناءً على نوع التقريب
            let min, max, step;

            switch(roundingPlace) {
                case 10:
                    min = Math.floor((currentNumber - 50) / 10) * 10;
                    max = Math.ceil((currentNumber + 50) / 10) * 10;
                    step = 10;
                    break;
                case 100:
                    min = Math.floor((currentNumber - 500) / 100) * 100;
                    max = Math.ceil((currentNumber + 500) / 100) * 100;
                    step = 100;
                    break;
                case 1000:
                    min = Math.floor((currentNumber - 5000) / 1000) * 1000;
                    max = Math.ceil((currentNumber + 5000) / 1000) * 1000;
                    step = 1000;
                    break;
                case 10000:
                    min = Math.floor((currentNumber - 50000) / 10000) * 10000;
                    max = Math.ceil((currentNumber + 50000) / 10000) * 10000;
                    step = 10000;
                    break;
            }

            // التأكد من أن النطاق منطقي
            min = Math.max(0, min);
            max = Math.min(100000, max);

            // إضافة العلامات والتسميات
            for (let i = min; i <= max; i += step) {
                const position = ((i - min) / (max - min)) * 100;

                const tick = document.createElement('div');
                tick.className = 'tick' + (i % (step * 5) === 0 ? ' major' : '');
                tick.style.left = position + '%';
                numberLine.appendChild(tick);

                if (i % (step * 5) === 0) {
                    const label = document.createElement('div');
                    label.className = 'tick-label';
                    label.textContent = i.toLocaleString('ar-EG');
                    label.style.left = position + '%';
                    numberLine.appendChild(label);
                }
            }

            // إضافة علامة العدد المستهدف
            const targetPosition = ((currentNumber - min) / (max - min)) * 100;
            const targetMarker = document.createElement('div');
            targetMarker.className = 'target-marker';
            targetMarker.textContent = '🎯';
            targetMarker.style.left = targetPosition + '%';
            numberLine.appendChild(targetMarker);

            // إضافة علامة التقريب الصحيحة
            const roundingPosition = ((correctAnswer - min) / (max - min)) * 100;
            const roundingMarker = document.createElement('div');
            roundingMarker.className = 'rounding-marker';
            roundingMarker.textContent = '✓';
            roundingMarker.style.left = roundingPosition + '%';
            numberLine.appendChild(roundingMarker);
        }

        // تحديث الشرح البصري
        function updateVisualExplanation() {
            const digitToCheck = getDigitToCheck();
            const shouldRoundUp = digitToCheck >= 5;

            explanationText.textContent = `الرقم في منزلة ${roundingOptions[currentLevel].example} هو ${digitToCheck} → ${shouldRoundUp ? 'نقرب للأعلى' : 'نبقى على الرقم'}`;
        }

        // الحصول على الرقم الذي يحدد التقريب
        function getDigitToCheck() {
            if (roundingPlace === 10) {
                return currentNumber % 10;
            } else if (roundingPlace === 100) {
                return Math.floor((currentNumber % 100) / 10);
            } else if (roundingPlace === 1000) {
                return Math.floor((currentNumber % 1000) / 100);
            } else {
                return Math.floor((currentNumber % 10000) / 1000);
            }
        }

        // توليد خيارات الإجابة
        function generateAnswerOptions() {
            optionsGrid.innerHTML = '';
            const options = new Set();
            options.add(correctAnswer);

            // توليد خيارات خاطئة
            while (options.size < 4) {
                let wrongValue;
                const errorType = Math.random();

                if (errorType < 0.4) {
                    // قيمة الرقم في منزلة أخرى
                    let wrongPosition;
                    do {
                        wrongPosition = Math.floor(Math.random() * 4);
                    } while (wrongPosition === currentLevel);

                    wrongValue = Math.round(currentNumber / roundingOptions[wrongPosition].value) * roundingOptions[wrongPosition].value;
                } else if (errorType < 0.7) {
                    // خطأ بأصفار أقل أو أكثر
                    const factor = Math.random() < 0.5 ? 0.1 : 10;
                    wrongValue = Math.round(correctAnswer * factor);
                } else {
                    // خطأ عشوائي
                    const randomOffset = (Math.random() < 0.5 ? -1 : 1) * roundingPlace;
                    wrongValue = correctAnswer + randomOffset;
                }

                // التأكد من صحة القيمة وعدم تكرارها
                if (wrongValue > 0 && wrongValue !== correctAnswer) {
                    options.add(wrongValue);
                }
            }

            // تحويل وخلط الخيارات
            const optionsArray = Array.from(options);
            shuffleArray(optionsArray);

            // إنشاء أزرار الخيارات
            optionsArray.forEach(option => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.textContent = option.toLocaleString('ar-EG');
                button.addEventListener('click', () => checkAnswer(option, button));
                optionsGrid.appendChild(button);
            });
        }

        // خلط المصفوفة
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        // التحقق من الإجابة
        function checkAnswer(selectedValue, button) {
            const allButtons = document.querySelectorAll('.option-btn');

            // تعطيل جميع الأزرار
            allButtons.forEach(btn => {
                btn.disabled = true;
                if (parseInt(btn.textContent.replace(/,/g, '')) === correctAnswer) {
                    btn.classList.add('correct');
                }
            });

            if (selectedValue === correctAnswer) {
                // إجابة صحيحة
                button.classList.add('correct');
                score += 10 + (streak * 2);
                streak++;
                scoreElement.textContent = score;
                streakElement.textContent = streak;
                feedbackElement.textContent = getSuccessMessage();
                feedbackElement.className = 'feedback-correct';

                // تأثير الاحتفال عند الإجابات الصحيحة المتتالية
                if (streak >= 3) {
                    createCelebration();
                }

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 1500);
            } else {
                // إجابة خاطئة
                button.classList.add('incorrect');
                streak = 0;
                streakElement.textContent = streak;
                feedbackElement.textContent = `❌ إجابة خاطئة. الإجابة الصحيحة هي ${correctAnswer.toLocaleString('ar-EG')}`;
                feedbackElement.className = 'feedback-wrong';

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 2000);
            }
        }

        // عرض تلميح
        function showHint() {
            const digitToCheck = getDigitToCheck();
            const hint = `💡 التلميح: الرقم ${digitToCheck} ${digitToCheck >= 5 ? 'أكبر من أو يساوي 5، لذا نقرب للأعلى' : 'أقل من 5، لذا نبقى على الرقم'}`;

            feedbackElement.textContent = hint;
            feedbackElement.className = 'feedback-wrong';
        }

        // شرح الطريقة
        function explainMethod() {
            resetExplanation();

            if (explanationStep < 4) {
                explanationStep++;
            } else {
                explanationStep = 1;
            }

            const currentStep = document.getElementById(`step${explanationStep}`);
            currentStep.classList.add('active');

            // إضافة مثال توضيحي في الخطوة الأخيرة
            if (explanationStep === 4) {
                const example = document.createElement('div');
                example.style.marginTop = '10px';
                example.style.padding = '10px';
                example.style.background = '#e8f5e9';
                example.style.borderRadius = '5px';
                example.style.fontSize = '1rem';
                example.innerHTML = `
                    <strong>مثال:</strong> ${currentNumber} → ${correctAnswer}<br>
                    الرقم الذي يلي ${roundingOptions[currentLevel].name.split(' ')[1]} هو ${getDigitToCheck()}
                `;
                currentStep.appendChild(example);
            }
        }

        // إعادة تعيين الشرح
        function resetExplanation() {
            const steps = document.querySelectorAll('.step');
            steps.forEach(step => {
                step.classList.remove('active');
            });
            explanationStep = 0;
        }

        // الحصول على رسالة نجاح عشوائية
        function getSuccessMessage() {
            const messages = [
                "أحسنت! 🌟 تقريب صحيح",
                "رائع! 🎯 فهمت قواعد التقريب",
                "إبداع! 💫 أنت تتقن التقريب",
                "ممتاز! ⚡ استمر في التميز",
                "برافو! 👏 تقريب ممتاز"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // تحديث المستوى
        function updateLevel() {
            const level = Math.floor(score / 30) + 1;
            levelElement.textContent = level;
        }

        // إنهاء اللعبة
        function endGame() {
            roundingInstruction.textContent = "🎉 انتهت اللعبة!";
            numberDisplay.style.display = 'none';
            optionsGrid.style.display = 'none';
            document.getElementById('number-line-container').style.display = 'none';
            document.getElementById('visual-explanation').style.display = 'none';
            document.getElementById('rounding-steps').style.display = 'none';

            let message = "";
            let emoji = "";
            if (score >= 90) {
                message = "مذهل! 🏆 أنت خبير في التقريب";
                emoji = "🎊";
            } else if (score >= 70) {
                message = "رائع! ⭐ أداء ممتاز في التقريب";
                emoji = "✨";
            } else if (score >= 50) {
                message = "جيد جداً! 👍 واصل التعلم";
                emoji = "📚";
            } else {
                message = "حاول مرة أخرى! 💪 ستتحسن مع الممارسة";
                emoji = "🎯";
            }

            feedbackElement.innerHTML = `${message} ${emoji}<br><br>مجموع نقاطك: <strong>${score}</strong> من ${totalQuestions * 10}<br>الإجابات المتتالية القصوى: <strong>${streak}</strong>`;
            feedbackElement.className = 'feedback-correct';

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

            const colors = ['#667eea', '#764ba2', '#00b894', '#ff7675', '#fdcb6e', '#74b9ff'];

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
