<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة سلم الجمع مع الحمل - {{ $lesson_game->lesson->name }}</title>
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
            --ladder-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: var(--ladder-bg);
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
            max-width: 800px;
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
            content: "+";
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

        .addition-guide {
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

        .guide-steps {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .guide-step {
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .step-icon {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .step-text {
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

        .ladder-container {
            position: relative;
            z-index: 1;
            margin: 30px 0;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--primary);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .ladder-step {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 20px 0;
            padding: 20px;
            background: var(--light);
            border-radius: 15px;
            border: 2px solid var(--primary);
            transition: all 0.3s;
        }

        .ladder-step.active {
            border-color: var(--success);
            background: rgba(0, 184, 148, 0.1);
            transform: scale(1.02);
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .step-content {
            flex: 1;
            margin: 0 20px;
            text-align: center;
        }

        .step-description {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--text);
            margin-bottom: 10px;
        }

        .step-calculation {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--primary-dark);
            font-family: 'Courier New', monospace;
        }

        .step-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .carry-input, .result-input {
            width: 60px;
            height: 60px;
            border: 2px solid var(--primary);
            border-radius: 10px;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            background: white;
            transition: all 0.3s;
        }

        .carry-input {
            border-style: dashed;
            background: #fff3e0;
        }

        .carry-input:focus, .result-input:focus {
            outline: none;
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
            transform: scale(1.05);
        }

        .carry-input.correct, .result-input.correct {
            border-color: var(--success);
            background: #e8f5e9;
        }

        .carry-input.incorrect, .result-input.incorrect {
            border-color: var(--error);
            background: #ffebee;
        }

        .equal-sign {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
            margin: 0 10px;
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

        .feedback.correct {
            background: rgba(0, 184, 148, 0.15);
            color: var(--success-dark);
            border: 2px solid var(--success);
            animation: bounce 0.6s ease;
        }

        .feedback.incorrect {
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
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-12px); }
            80% { transform: translateY(-6px); }
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

            .ladder-step {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .step-content {
                margin: 10px 0;
            }

            .guide-steps {
                grid-template-columns: 1fr;
            }

            .controls {
                flex-direction: column;
                gap: 12px;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .carry-input, .result-input {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }

            .step-calculation {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎮 لعبة سلم الجمع مع الحمل</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="addition-guide">
                <h3>🧮 دليل الجمع مع الحمل خطوة بخطوة</h3>
                <div class="guide-steps">
                    <div class="guide-step">
                        <div class="step-icon">1️⃣</div>
                        <div class="step-text">ابدأ بجمع الآحاد</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">2️⃣</div>
                        <div class="step-text">إذا كان المجموع ≥ 10<br>اكتب الآحاد واحمل الباقي</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">3️⃣</div>
                        <div class="step-text">اجمع المنزلة التالية<br>مع الحمل</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">4️⃣</div>
                        <div class="step-text">استمر حتى تنتهي<br>من جميع المنازل</div>
                    </div>
                </div>
            </div>

            <div class="instructions">
                <p>🎯 اتبع سلم الجمع خطوة بخطوة وأدخل الحمل والنتيجة في كل مرحلة</p>
                <p>💡 تذكر: ابدأ من الأسفل (الآحاد) وتحرك للأعلى</p>
            </div>

            <div class="ladder-container" id="ladder-container">
                <!-- سيتم إنشاء سلم الجمع هنا -->
            </div>

            <div id="feedback" class="feedback"></div>

            <div class="controls">
                <button class="btn" id="check-btn">✅ تحقق من الإجابة</button>
                <button class="btn btn-hint" id="hint-btn">💡 عرض تلميح</button>
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
        const operationType = "{{ $operation_type ?? 'addition' }}";

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let number1 = 0;
        let number2 = 0;
        let correctResult = 0;
        let currentStep = 0;
        let streak = 0;
        let ladderSteps = [];

        // عناصر DOM
        const ladderContainer = document.getElementById('ladder-container');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const levelElement = document.getElementById('level');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            checkButton.addEventListener('click', checkAnswer);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', generateQuestion);

            generateQuestion();
        });

        // توليد عددين عشوائيين مع حمل
        function generateRandomNumbersWithCarry() {
            let num1, num2;
            let hasCarry = false;

            do {
                num1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                num2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                hasCarry = checkForCarry(num1, num2);
            } while (!hasCarry || (num1 + num2) > 99999);

            return { num1, num2 };
        }

        // التحقق من وجود حمل
        function checkForCarry(num1, num2) {
            let n1 = num1;
            let n2 = num2;

            for (let i = 0; i < 4; i++) {
                const digit1 = n1 % 10;
                const digit2 = n2 % 10;

                if (digit1 + digit2 >= 10) {
                    return true;
                }

                n1 = Math.floor(n1 / 10);
                n2 = Math.floor(n2 / 10);
            }

            return false;
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();
            updateLevel();

            const numbers = generateRandomNumbersWithCarry();
            number1 = numbers.num1;
            number2 = numbers.num2;
            correctResult = number1 + number2;

            createLadderSteps();
            renderLadder();

            feedbackElement.textContent = 'اتبع سلم الجمع خطوة بخطوة وأدخل الحمل والنتيجة';
            feedbackElement.className = 'feedback';

            currentStep = 0;
            streak = 0;
        }

        // إنشاء خطوات السلم
        function createLadderSteps() {
            const digits1 = getDigits(number1, 5);
            const digits2 = getDigits(number2, 5);
            ladderSteps = [];
            let carry = 0;

            // خطوات الجمع لكل منزلة
            for (let i = 0; i < 5; i++) {
                const sum = digits1[i] + digits2[i] + carry;
                const resultDigit = sum % 10;
                const nextCarry = Math.floor(sum / 10);

                const placeNames = ['الآحاد', 'العشرات', 'المئات', 'الآلاف', 'عشرات الآلاف'];
                const placeValues = [1, 10, 100, 1000, 10000];

                ladderSteps.push({
                    step: i + 1,
                    place: placeNames[i],
                    calculation: `${digits1[i]} + ${digits2[i]} ${carry > 0 ? `+ ${carry}` : ''}`,
                    fullCalculation: `${digits1[i]} + ${digits2[i]} ${carry > 0 ? `+ ${carry} (حمل)` : ''}`,
                    correctCarry: carry,
                    correctResult: resultDigit,
                    nextCarry: nextCarry,
                    userCarry: '',
                    userResult: ''
                });

                carry = nextCarry;
            }

            // الخطوة النهائية للحمل الأخير
            if (carry > 0) {
                ladderSteps.push({
                    step: 6,
                    place: 'نتيجة نهائية',
                    calculation: `الحمل النهائي`,
                    fullCalculation: `الحمل النهائي: ${carry}`,
                    correctCarry: carry,
                    correctResult: null,
                    nextCarry: 0,
                    userCarry: '',
                    userResult: ''
                });
            }
        }

        // الحصول على أرقام العدد
        function getDigits(number, length) {
            const digits = new Array(length).fill(0);
            let n = number;

            for (let i = 0; i < length; i++) {
                digits[i] = n % 10;
                n = Math.floor(n / 10);
            }

            return digits;
        }

        // عرض السلم
        function renderLadder() {
            ladderContainer.innerHTML = '';

            ladderSteps.forEach((step, index) => {
                const stepElement = document.createElement('div');
                stepElement.className = `ladder-step ${index === currentStep ? 'active' : ''}`;

                stepElement.innerHTML = `
                    <div class="step-number">${step.step}</div>
                    <div class="step-content">
                        <div class="step-description">${step.place}</div>
                        <div class="step-calculation">${step.calculation}</div>
                    </div>
                    <div class="step-inputs">
                        ${step.correctResult !== null ? `
                            <input type="number" class="carry-input" placeholder="حمل"
                                   min="0" max="1" value="${step.userCarry}"
                                   data-step="${index}" data-type="carry">
                            <span class="equal-sign">=</span>
                            <input type="number" class="result-input" placeholder="نتيجة"
                                   min="0" max="9" value="${step.userResult}"
                                   data-step="${index}" data-type="result">
                        ` : `
                            <input type="number" class="carry-input" placeholder="حمل نهائي"
                                   min="0" max="9" value="${step.userCarry}"
                                   data-step="${index}" data-type="carry">
                        `}
                    </div>
                `;

                ladderContainer.appendChild(stepElement);
            });

            // إضافة مستمعي الأحداث
            document.querySelectorAll('.carry-input, .result-input').forEach(input => {
                input.addEventListener('input', handleInput);
                input.addEventListener('focus', handleFocus);
            });
        }

        // معالجة الإدخال
        function handleInput(e) {
            const value = e.target.value;
            const stepIndex = parseInt(e.target.dataset.step);
            const type = e.target.dataset.type;

            if (value.length > 1) {
                e.target.value = value.slice(0, 1);
            }

            if (type === 'carry') {
                ladderSteps[stepIndex].userCarry = e.target.value;
            } else {
                ladderSteps[stepIndex].userResult = e.target.value;
            }
        }

        // معالجة التركيز
        function handleFocus(e) {
            const stepIndex = parseInt(e.target.dataset.step);
            currentStep = stepIndex;
            renderLadder();
        }

        // عرض التلميح
        function showHint() {
            if (currentStep < ladderSteps.length) {
                const step = ladderSteps[currentStep];
                let hint = '';

                if (step.correctResult !== null) {
                    hint = `💡 ${step.fullCalculation} = ${step.correctResult} (الحمل التالي: ${step.nextCarry})`;
                } else {
                    hint = `💡 ${step.fullCalculation}`;
                }

                feedbackElement.textContent = hint;
                feedbackElement.className = 'feedback';
            }
        }

        // التحقق من الإجابة
        function checkAnswer() {
            let allCorrect = true;
            let allFilled = true;

            // التحقق من كل خطوة
            ladderSteps.forEach((step, index) => {
                const carryInput = document.querySelector(`.carry-input[data-step="${index}"]`);
                const resultInput = document.querySelector(`.result-input[data-step="${index}"]`);

                if (step.userCarry === '') {
                    allFilled = false;
                }

                if (step.correctResult !== null && step.userResult === '') {
                    allFilled = false;
                }

                if (parseInt(step.userCarry) !== step.correctCarry) {
                    allCorrect = false;
                    if (carryInput) {
                        carryInput.className = 'carry-input incorrect';
                    }
                } else {
                    if (carryInput) {
                        carryInput.className = 'carry-input correct';
                    }
                }

                if (step.correctResult !== null && parseInt(step.userResult) !== step.correctResult) {
                    allCorrect = false;
                    if (resultInput) {
                        resultInput.className = 'result-input incorrect';
                    }
                } else if (resultInput) {
                    resultInput.className = 'result-input correct';
                }
            });

            if (!allFilled) {
                feedbackElement.textContent = '⚠️ يرجى ملء جميع الحقول!';
                feedbackElement.className = 'feedback incorrect';
                return;
            }

            if (allCorrect) {
                score += 10;
                streak++;
                scoreElement.textContent = score;
                feedbackElement.textContent = getSuccessMessage();
                feedbackElement.className = 'feedback correct';

                if (streak >= 3) {
                    createCelebration();
                }

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 2000);
            } else {
                streak = 0;
                feedbackElement.textContent = '❌ بعض الإجابات غير صحيحة. راجع الخطوات!';
                feedbackElement.className = 'feedback incorrect';
            }
        }

        // الحصول على رسالة نجاح
        function getSuccessMessage() {
            const messages = [
                "أحسنت! 🌟 فهمت الجمع مع الحمل",
                "رائع! 🎯 سلم الجمع مكتمل",
                "إبداع! 💫 أنت تتقن الحمل",
                "ممتاز! ⚡ استمر في التميز",
                "برافو! 👏 أداء رائع"
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
            feedbackElement.innerHTML = `
                🎉 <strong>انتهت اللعبة!</strong><br><br>
                ${getFinalMessage()}<br>
                مجموع نقاطك: <strong>${score}</strong> من ${totalQuestions * 10}
            `;
            feedbackElement.className = 'feedback correct';

            checkButton.style.display = 'none';
            hintButton.style.display = 'none';

            createCelebration();
        }

        // الحصول على الرسالة النهائية
        function getFinalMessage() {
            if (score >= 90) {
                return "مذهل! 🏆 أنت خبير في الجمع مع الحمل";
            } else if (score >= 70) {
                return "رائع! ⭐ أداء ممتاز في الجمع";
            } else if (score >= 50) {
                return "جيد جداً! 👍 واصل التعلم";
            } else {
                return "حاول مرة أخرى! 💪 الممارسة تصنع الفرق";
            }
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
