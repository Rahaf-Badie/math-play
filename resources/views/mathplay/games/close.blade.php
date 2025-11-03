<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة التقريب - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --success: #27ae60;
            --success-dark: #229954;
            --error: #e74c3c;
            --error-dark: #c0392b;
            --warning: #f39c12;
            --warning-dark: #e67e22;
            --info: #9b59b6;
            --info-dark: #8e44ad;
            --text: #2c3e50;
            --light: #f8f9fa;
            --rounding-bg: linear-gradient(135deg, #f0f4f8, #ebf0f5);
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
            max-width: 700px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            color: var(--text);
        }

        .header h1 {
            font-size: 2.4rem;
            margin-bottom: 8px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.85);
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
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
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
            color: rgba(52, 152, 219, 0.08);
            z-index: 0;
            font-weight: bold;
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
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
            box-shadow: 0 6px 20px rgba(155, 89, 182, 0.3);
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
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
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
            font-size: 4rem;
            font-weight: bold;
            color: var(--primary-dark);
            text-align: center;
            margin: 20px 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            font-family: 'Courier New', monospace;
            letter-spacing: 3px;
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

        .rounding-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 25px 0;
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
        }

        .number-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .number-box {
            width: 80px;
            height: 80px;
            background: var(--primary);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .step-label {
            font-size: 0.9rem;
            color: var(--text);
            font-weight: bold;
        }

        .arrow {
            font-size: 2.5rem;
            color: var(--primary-dark);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
        }

        .input-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 30px 0;
            position: relative;
            z-index: 1;
        }

        input[type="number"] {
            font-size: 2.2rem;
            padding: 20px;
            width: 220px;
            text-align: center;
            border: 3px solid var(--primary);
            border-radius: 15px;
            transition: all 0.3s;
            font-family: inherit;
            font-weight: bold;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            background: var(--light);
        }

        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.3);
            transform: scale(1.05);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            position: relative;
            z-index: 1;
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
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s;
        }

        .btn:hover::after {
            width: 120px;
            height: 120px;
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

        #feedback {
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
            background: rgba(39, 174, 96, 0.15);
            color: var(--success-dark);
            border: 2px solid var(--success);
            animation: bounce 0.6s ease;
        }

        .feedback-wrong {
            background: rgba(231, 76, 60, 0.15);
            color: var(--error-dark);
            border: 2px solid var(--error);
            animation: shake 0.5s ease;
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

        .number-bubble {
            position: absolute;
            font-size: 1.6rem;
            color: var(--primary);
            animation: float 4s ease-in-out infinite;
            z-index: 0;
            font-weight: bold;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-25px) rotate(120deg); }
            66% { transform: translateY(-15px) rotate(240deg); }
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

        @keyframes bounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-12px); }
            80% { transform: translateY(-6px); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-12px); }
            75% { transform: translateX(12px); }
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
                font-size: 3rem;
            }

            input[type="number"] {
                width: 180px;
                font-size: 1.8rem;
                padding: 15px;
            }

            .controls {
                flex-direction: column;
                gap: 12px;
            }

            .btn {
                width: 100%;
            }

            .guide-rules {
                grid-template-columns: 1fr;
            }

            .rounding-visual {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .number-display {
                font-size: 2.5rem;
            }

            input[type="number"] {
                width: 150px;
                font-size: 1.6rem;
            }

            .number-box {
                width: 60px;
                height: 60px;
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎯 لعبة التقريب</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="rounding-guide">
                <h3>📊 قواعد التقريب</h3>
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

            <div class="problem-container">
                <div class="number-display" id="number-display">
                    <!-- سيتم تعبئة العدد بالجافاسكريبت -->
                </div>

                <div class="rounding-instruction" id="rounding-instruction">
                    <!-- سيتم تعبئة التعليمات بالجافاسكريبت -->
                </div>

                <div class="rounding-visual" id="rounding-visual">
                    <!-- سيتم تعبئة التمثيل البصري بالجافاسكريبت -->
                </div>

                <div class="input-container">
                    <input type="number" id="answer" placeholder="أدخل العدد المقرب" min="0" max="10000">
                </div>
            </div>

            <div class="controls">
                <button class="btn" id="check-btn">✅ تحقق من الإجابة</button>
                <button class="btn btn-hint" id="hint-btn">💡 عرض تلميح</button>
                <button class="btn btn-reset" id="reset-btn">🔄 سؤال جديد</button>
            </div>

            <div id="feedback"></div>

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
        const operationType = "{{ $operation_type ?? 'rounding' }}";

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let currentNumber = 0;
        let roundingPlace = 0;
        let correctAnswer = 0;
        let streak = 0;

        // خيارات التقريب
        const roundingOptions = [
            { value: 10, name: 'أقرب عشرة', example: 'الآحاد' },
            { value: 100, name: 'أقرب مئة', example: 'العشرات' },
            { value: 1000, name: 'أقرب ألف', example: 'المئات' }
        ];

        // عناصر DOM
        const numberDisplay = document.getElementById('number-display');
        const roundingInstruction = document.getElementById('rounding-instruction');
        const roundingVisual = document.getElementById('rounding-visual');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const feedbackElement = document.getElementById('feedback');
        const answerInput = document.getElementById('answer');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const levelElement = document.getElementById('level');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            checkButton.addEventListener('click', checkAnswer);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', generateQuestion);
            answerInput.addEventListener('keydown', handleKeyPress);

            createNumberBubbles();
            generateQuestion();
        });

        // توليد عدد عشوائي ضمن المدى
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // إنشاء فقاعات الأرقام
        function createNumberBubbles() {
            const container = document.querySelector('.game-card');
            for (let i = 0; i < 6; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'number-bubble';
                bubble.textContent = generateRandomNumber();
                bubble.style.left = `${Math.random() * 80 + 10}%`;
                bubble.style.top = `${Math.random() * 80 + 10}%`;
                bubble.style.animationDelay = `${Math.random() * 3}s`;
                container.appendChild(bubble);
            }
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();
            updateLevel();

            currentNumber = generateRandomNumber();
            const randomOption = roundingOptions[Math.floor(Math.random() * roundingOptions.length)];
            roundingPlace = randomOption.value;

            // حساب الإجابة الصحيحة
            correctAnswer = Math.round(currentNumber / roundingPlace) * roundingPlace;

            // تحديث العرض
            numberDisplay.textContent = currentNumber.toLocaleString('ar-EG');
            roundingInstruction.textContent = `قرب العدد إلى ${randomOption.name} (انظر إلى منزلة ${randomOption.example})`;

            // إنشاء التمثيل البصري
            createRoundingVisual();

            answerInput.value = '';
            answerInput.focus();
            feedbackElement.textContent = '';
            feedbackElement.className = '';
        }

        // إنشاء التمثيل البصري للتقريب
        function createRoundingVisual() {
            roundingVisual.innerHTML = '';

            // العدد الأصلي
            const originalStep = document.createElement('div');
            originalStep.className = 'number-step';
            originalStep.innerHTML = `
                <div class="number-box">${currentNumber.toLocaleString('ar-EG')}</div>
                <div class="step-label">العدد الأصلي</div>
            `;
            roundingVisual.appendChild(originalStep);

            // سهم
            const arrow = document.createElement('div');
            arrow.className = 'arrow';
            arrow.textContent = '→';
            roundingVisual.appendChild(arrow);

            // العدد المقرب
            const roundedStep = document.createElement('div');
            roundedStep.className = 'number-step';
            roundedStep.innerHTML = `
                <div class="number-box" style="background: var(--success);">${correctAnswer.toLocaleString('ar-EG')}</div>
                <div class="step-label">العدد المقرب</div>
            `;
            roundingVisual.appendChild(roundedStep);

            // شرح التقريب
            const explanation = document.createElement('div');
            explanation.style.cssText = 'grid-column: 1 / -1; text-align: center; margin-top: 15px; font-size: 1.1rem; color: var(--text);';
            explanation.textContent = getRoundingExplanation();
            roundingVisual.appendChild(explanation);
        }

        // الحصول على شرح التقريب
        function getRoundingExplanation() {
            const digitToCheck = getDigitToCheck();
            const shouldRoundUp = digitToCheck >= 5;

            if (roundingPlace === 10) {
                return `الرقم في منزلة الآحاد هو ${digitToCheck} → ${shouldRoundUp ? 'نقرب للأعلى' : 'نبقى على الرقم'}`;
            } else if (roundingPlace === 100) {
                return `الرقم في منزلة العشرات هو ${digitToCheck} → ${shouldRoundUp ? 'نقرب للأعلى' : 'نبقى على الرقم'}`;
            } else {
                return `الرقم في منزلة المئات هو ${digitToCheck} → ${shouldRoundUp ? 'نقرب للأعلى' : 'نبقى على الرقم'}`;
            }
        }

        // الحصول على الرقم الذي يحدد التقريب
        function getDigitToCheck() {
            if (roundingPlace === 10) {
                return currentNumber % 10;
            } else if (roundingPlace === 100) {
                return Math.floor((currentNumber % 100) / 10);
            } else {
                return Math.floor((currentNumber % 1000) / 100);
            }
        }

        // التعامل مع الضغط على الأزرار
        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                checkAnswer();
            }
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseInt(answerInput.value);

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = "⚠️ يرجى إدخال قيمة رقمية";
                feedbackElement.className = "feedback-wrong";
                answerInput.focus();
                return;
            }

            if (userAnswer === correctAnswer) {
                score += 10;
                streak++;
                scoreElement.textContent = score;
                feedbackElement.textContent = getSuccessMessage();
                feedbackElement.className = "feedback-correct";

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
                }, 1800);
            } else {
                streak = 0;
                feedbackElement.textContent = `❌ إجابة خاطئة. الإجابة الصحيحة هي ${correctAnswer.toLocaleString('ar-EG')}`;
                feedbackElement.className = "feedback-wrong";

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 2500);
            }
        }

        // عرض تلميح
        function showHint() {
            const digitToCheck = getDigitToCheck();
            const hint = digitToCheck >= 5 ?
                `💡 التلميح: الرقم ${digitToCheck} أكبر من أو يساوي 5، لذا نقرب للأعلى` :
                `💡 التلميح: الرقم ${digitToCheck} أقل من 5، لذا نبقى على الرقم`;

            feedbackElement.textContent = hint;
            feedbackElement.className = "feedback-wrong";
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
            roundingVisual.style.display = 'none';
            answerInput.style.display = 'none';
            checkButton.style.display = 'none';
            hintButton.style.display = 'none';

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

            feedbackElement.innerHTML = `${message} ${emoji}<br><br>مجموع نقاطك: <strong>${score}</strong> من ${totalQuestions * 10}`;
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

            const colors = ['#3498db', '#2980b9', '#27ae60', '#e74c3c', '#f39c12', '#9b59b6'];

            for (let i = 0; i < 120; i++) {
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
            }, 3500);
        }
    </script>
</body>
</html>
