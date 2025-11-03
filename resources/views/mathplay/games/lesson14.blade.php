<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة جدول الضرب للعدد 10 - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #00cec9;
            --primary-dark: #00b894;
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
            --multiply-bg: linear-gradient(135deg, #ffeaa7, #fab1a0);
            --card-bg: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: var(--multiply-bg);
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
            max-width: 600px;
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
            background: var(--card-bg);
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            padding: 35px;
            width: 100%;
            transition: transform 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .game-card::before {
            content: "10×";
            position: absolute;
            top: -40px;
            right: -40px;
            font-size: 180px;
            color: rgba(0, 206, 201, 0.08);
            z-index: 0;
            font-weight: bold;
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .magic-trick {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 6px 20px rgba(0, 206, 201, 0.3);
        }

        .magic-trick h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .magic-trick p {
            font-size: 1.2rem;
            margin: 8px 0;
        }

        .number-line {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            border: 2px solid var(--primary);
        }

        .number-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .number-box {
            width: 60px;
            height: 60px;
            background: var(--primary);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 206, 201, 0.3);
        }

        .arrow {
            font-size: 2rem;
            color: var(--primary-dark);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
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

        .question-container {
            position: relative;
            z-index: 1;
            margin: 30px 0;
            background: rgba(255, 255, 255, 0.8);
            padding: 25px;
            border-radius: 20px;
            border: 3px solid var(--primary);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        #question {
            font-size: 3rem;
            color: var(--primary-dark);
            text-align: center;
            margin: 15px 0;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
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
            width: 160px;
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
            box-shadow: 0 0 0 4px rgba(0, 206, 201, 0.3);
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

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--light), #e8f4ff);
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

        .place-value-demo {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
            position: relative;
            z-index: 1;
        }

        .place-box {
            width: 80px;
            height: 80px;
            background: var(--primary);
            color: white;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 206, 201, 0.3);
        }

        .place-label {
            font-size: 0.9rem;
            margin-top: 5px;
            opacity: 0.9;
        }

        .zero-highlight {
            animation: highlight 2s infinite;
        }

        @keyframes highlight {
            0%, 100% { background: var(--primary); }
            50% { background: var(--success); transform: scale(1.1); }
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
        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }

            .game-card {
                padding: 25px 20px;
            }

            #question {
                font-size: 2.4rem;
            }

            input[type="number"] {
                width: 130px;
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

            .number-line {
                flex-wrap: wrap;
                gap: 10px;
            }

            .place-value-demo {
                flex-wrap: wrap;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎮 لعبة جدول الضرب للعدد 10</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="magic-trick">
                <h3>🎩 خدعة الضرب في 10 السحرية!</h3>
                <p>✨ فقط أضف صفراً إلى نهاية العدد ✨</p>
                <p>مثال: 7 × 10 = 70 ← أضفنا صفراً إلى 7</p>
            </div>

            <div class="number-line" id="number-line">
                <!-- سيتم تعبئة خط الأعداد بالجافاسكريبت -->
            </div>

            <div class="instructions">
                <p>🎯 أكمل عملية الضرب باستخدام خدعة إضافة الصفر</p>
                <p>💡 تذكر: الضرب في 10 يعني تحريك العدد إلى خانة العشرات!</p>
            </div>

            <div class="place-value-demo" id="place-value-demo">
                <!-- سيتم تعبئة عرض المنازل بالجافاسكريبت -->
            </div>

            <div class="question-container">
                <div id="question">جاري تحميل السؤال...</div>
            </div>

            <div class="input-container">
                <input type="number" id="answer" placeholder="الإجابة" min="0" max="1000">
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
                    <span class="score-label">السؤال</span>
                    <span class="score-value"><span id="current-question">0</span>/<span id="total-questions">10</span></span>
                </div>
                <div class="score-item">
                    <span class="score-label">الخدع المستخدمة</span>
                    <span class="score-value" id="tricks-used">0</span>
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
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 12 }};
        const operationType = "{{ $operation_type ?? 'multiplication' }}";
        const multiplier = 10; // الضرب في العدد 10

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let correctAnswer = 0;
        let currentMultiplicand = 0;
        let streak = 0;
        let tricksUsed = 0;

        // عناصر DOM
        const questionElement = document.getElementById('question');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const feedbackElement = document.getElementById('feedback');
        const answerInput = document.getElementById('answer');
        const checkButton = document.getElementById('check-btn');
        const resetButton = document.getElementById('reset-btn');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const numberLine = document.getElementById('number-line');
        const placeValueDemo = document.getElementById('place-value-demo');
        const tricksUsedElement = document.getElementById('tricks-used');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            checkButton.addEventListener('click', submitAnswer);
            resetButton.addEventListener('click', generateQuestion);
            answerInput.addEventListener('keydown', handleKeyPress);

            createNumberBubbles();
            generateQuestion();
        });

        // توليد رقم عشوائي ضمن المدى
        function randomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // إنشاء فقاعات الأرقام
        function createNumberBubbles() {
            const container = document.querySelector('.game-card');
            for (let i = 0; i < 8; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'number-bubble';
                bubble.textContent = i * 10;
                bubble.style.left = `${Math.random() * 80 + 10}%`;
                bubble.style.top = `${Math.random() * 80 + 10}%`;
                bubble.style.animationDelay = `${Math.random() * 3}s`;
                container.appendChild(bubble);
            }
        }

        // إنشاء خط الأعداد التوضيحي
        function createNumberLine(multiplicand) {
            numberLine.innerHTML = '';

            const steps = [
                { number: multiplicand, label: 'العدد الأصلي' },
                { number: multiplicand * 10, label: 'بعد الضرب في 10' }
            ];

            steps.forEach((step, index) => {
                const stepElement = document.createElement('div');
                stepElement.className = 'number-step';

                const numberBox = document.createElement('div');
                numberBox.className = 'number-box';
                numberBox.textContent = step.number;
                numberBox.style.animationDelay = `${index * 0.5}s`;

                const label = document.createElement('div');
                label.className = 'step-label';
                label.textContent = step.label;
                label.style.fontSize = '0.9rem';
                label.style.color = 'var(--text)';

                stepElement.appendChild(numberBox);
                stepElement.appendChild(label);
                numberLine.appendChild(stepElement);

                // إضافة سهم بين الخطوات
                if (index < steps.length - 1) {
                    const arrow = document.createElement('div');
                    arrow.className = 'arrow';
                    arrow.textContent = '→';
                    arrow.style.animationDelay = `${index * 0.5 + 0.2}s`;
                    numberLine.appendChild(arrow);
                }
            });
        }

        // إنشاء عرض المنازل العددية
        function createPlaceValueDemo(multiplicand) {
            placeValueDemo.innerHTML = '';

            const originalNumber = multiplicand;
            const multipliedNumber = multiplicand * 10;

            // العدد الأصلي
            const originalDiv = document.createElement('div');
            originalDiv.innerHTML = `
                <div style="text-align: center; margin-bottom: 10px;">
                    <div style="font-size: 1.1rem; color: var(--text); margin-bottom: 5px;">العدد الأصلي</div>
                    <div class="place-box">${originalNumber}</div>
                </div>
            `;
            placeValueDemo.appendChild(originalDiv);

            // سهم التحويل
            const arrowDiv = document.createElement('div');
            arrowDiv.className = 'arrow';
            arrowDiv.textContent = '→';
            arrowDiv.style.fontSize = '2.5rem';
            placeValueDemo.appendChild(arrowDiv);

            // العدد بعد الضرب في 10
            const multipliedDiv = document.createElement('div');
            multipliedDiv.innerHTML = `
                <div style="text-align: center;">
                    <div style="font-size: 1.1rem; color: var(--text); margin-bottom: 5px;">بعد الضرب في 10</div>
                    <div style="display: flex; gap: 5px;">
                        <div class="place-box">${Math.floor(multipliedNumber / 10)}</div>
                        <div class="place-box zero-highlight">0</div>
                    </div>
                    <div style="display: flex; gap: 5px; margin-top: 5px;">
                        <div class="place-label">العشرات</div>
                        <div class="place-label">الآحاد</div>
                    </div>
                </div>
            `;
            placeValueDemo.appendChild(multipliedDiv);
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();

            currentMultiplicand = randomInt(minRange, maxRange);
            correctAnswer = multiplier * currentMultiplicand;

            questionElement.innerHTML = `
                <div style="display: flex; align-items: center; justify-content: center; gap: 20px; flex-wrap: wrap;">
                    <span style="font-size: 3.5rem; color: var(--primary);">10</span>
                    <span style="font-size: 2.5rem;">×</span>
                    <span style="font-size: 3.5rem; color: var(--primary);">${currentMultiplicand}</span>
                    <span style="font-size: 2.5rem;">=</span>
                    <span style="font-size: 3.5rem; color: var(--success);">?</span>
                </div>
            `;

            // إنشاء العروض التوضيحية
            createNumberLine(currentMultiplicand);
            createPlaceValueDemo(currentMultiplicand);

            answerInput.value = '';
            answerInput.focus();
            feedbackElement.textContent = '';
            feedbackElement.className = '';
        }

        // التعامل مع الضغط على الأزرار
        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                submitAnswer();
            }
        }

        // التحقق من الإجابة
        function submitAnswer() {
            const userAnswer = parseInt(answerInput.value);

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = "⚠️ يرجى إدخال إجابة رقمية";
                feedbackElement.className = "feedback-wrong";
                answerInput.focus();
                return;
            }

            // التحقق من استخدام خدعة إضافة الصفر
            const usedTrick = userAnswer === parseInt(currentMultiplicand + '0');

            if (userAnswer === correctAnswer) {
                score += 10;
                streak++;
                if (usedTrick) {
                    tricksUsed++;
                    tricksUsedElement.textContent = tricksUsed;
                }

                scoreElement.textContent = score;
                feedbackElement.textContent = getSuccessMessage(usedTrick);
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
                feedbackElement.textContent = `❌ إجابة خاطئة. الإجابة الصحيحة: ${correctAnswer}`;
                feedbackElement.className = "feedback-wrong";

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 2000);
            }
        }

        // الحصول على رسالة نجاح عشوائية
        function getSuccessMessage(usedTrick) {
            const messages = usedTrick ? [
                "أحسنت! 🎩 استخدمت الخدعة السحرية!",
                "رائع! ✨ أضفت الصفر بشكل صحيح!",
                "إبداع! 💫 أنت تتقن ضرب العشرة!",
                "برافو! 👏 خدعة إضافة الصفر ناجحة!"
            ] : [
                "أحسنت! 🌟 إجابة صحيحة",
                "رائع! 🎯 ضرب ممتاز",
                "مذهل! ⚡ استمر في التميز",
                "إجابة صحيحة! 👍 أحسنت"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // إنهاء اللعبة
        function endGame() {
            questionElement.innerHTML = "🎉 <strong>انتهت اللعبة!</strong>";
            answerInput.style.display = 'none';
            checkButton.style.display = 'none';
            numberLine.style.display = 'none';
            placeValueDemo.style.display = 'none';

            let message = "";
            let emoji = "";
            if (score >= 90) {
                message = "مذهل! 🏆 أنت ساحر الضرب في 10";
                emoji = "🎊";
            } else if (score >= 70) {
                message = "رائع! ⭐ أتقنت خدعة إضافة الصفر";
                emoji = "✨";
            } else if (score >= 50) {
                message = "جيد جداً! 👍 واصل تعلم الخدع";
                emoji = "📚";
            } else {
                message = "حاول مرة أخرى! 💪 ستتقنها مع الممارسة";
                emoji = "🎯";
            }

            feedbackElement.innerHTML = `
                ${message} ${emoji}<br><br>
                مجموع نقاطك: <strong>${score}</strong> من ${totalQuestions * 10}<br>
                الخدع المستخدمة: <strong>${tricksUsed}</strong>
            `;
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

            const colors = ['#00cec9', '#00b894', '#ffeaa7', '#fab1a0', '#fdcb6e', '#74b9ff'];

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
