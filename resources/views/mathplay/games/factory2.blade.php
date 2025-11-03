<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصنع الضرب السريع - {{ $lesson_game->lesson->name }}</title>
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
            background: linear-gradient(135deg, #fff9e6 0%, #ffeaa7 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #f39c12;
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
            color: #f39c12;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .multiplication-area {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
            margin: 30px 0;
        }

        @media (max-width: 768px) {
            .multiplication-area {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        .problem-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #3498db;
        }

        .problem-title {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .multiplication-problem {
            font-size: 3rem;
            font-weight: bold;
            color: #e74c3c;
            margin: 25px 0;
            direction: ltr;
            text-align: center;
        }

        .step-by-step {
            background: #e8f6f3;
            padding: 25px;
            border-radius: 12px;
            margin: 20px 0;
            border-right: 4px solid #1abc9c;
        }

        .step-title {
            font-weight: bold;
            color: #3498db;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .calculation-steps {
            text-align: right;
            line-height: 2;
            font-size: 1.1rem;
        }

        .step {
            margin-bottom: 10px;
            padding: 8px;
            background: white;
            border-radius: 8px;
            border-right: 3px solid #3498db;
        }

        .input-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #2ecc71;
        }

        .answer-input {
            width: 200px;
            height: 80px;
            font-size: 2.5rem;
            text-align: center;
            border: 4px solid #3498db;
            border-radius: 12px;
            outline: none;
            margin: 20px 0;
            direction: ltr;
            font-weight: bold;
            transition: all 0.3s;
        }

        .answer-input:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 15px rgba(116, 185, 255, 0.5);
            transform: scale(1.05);
        }

        .input-label {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
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

        #show-steps-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #hint-btn {
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

        .visual-multiplication {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .number-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            min-width: 100px;
        }

        .digit-row {
            display: flex;
            gap: 5px;
            margin: 5px 0;
        }

        .digit-box {
            width: 40px;
            height: 40px;
            background: #3498db;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .group-label {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-top: 8px;
        }

        @keyframes pulse {
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

        .completion-message {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00b894;
            margin: 20px 0;
            animation: pulse 2s infinite;
        }

        .difficulty-selector {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .difficulty-btn {
            padding: 10px 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
        }

        .difficulty-btn.active {
            background: #3498db;
            color: white;
            border-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>مصنع الضرب السريع 🏭</h3>
            <p>🎯 احسب ناتج ضرب الأعداد بسرعة ودقة</p>
            <p>💡 استخدم خاصية التوزيع لتبسيط المسألة</p>
            <p>✨ اختر مستوى الصعوبة المناسب لمستواك</p>
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

            <!-- اختيار مستوى الصعوبة -->
            <div class="difficulty-selector">
                <button class="difficulty-btn active" data-difficulty="two-digit">عدد من منزلتين × عدد من منزلة واحدة</button>
                <button class="difficulty-btn" data-difficulty="three-digit">عدد من ثلاث منازل × عدد من منزلة واحدة</button>
            </div>

            <!-- منطقة الضرب -->
            <div class="multiplication-area">
                <!-- قسم المسألة -->
                <div class="problem-section">
                    <div class="problem-title">المسألة الحالية:</div>
                    <div class="multiplication-problem" id="multiplication-problem">
                        25 × 3
                    </div>

                    <!-- الضرب البصري -->
                    <div class="visual-multiplication" id="visual-multiplication">
                        <!-- سيتم تعبئتها ديناميكياً -->
                    </div>

                    <!-- الخطوات الحسابية -->
                    <div class="step-by-step" id="step-by-step" style="display: none;">
                        <div class="step-title">💡 خطوات الحل:</div>
                        <div class="calculation-steps" id="calculation-steps">
                            <!-- سيتم تعبئتها ديناميكياً -->
                        </div>
                    </div>
                </div>

                <!-- قسم الإدخال -->
                <div class="input-section">
                    <div class="input-label">أدخل ناتج الضرب:</div>
                    <input type="number" id="answer-input" class="answer-input" placeholder="0" min="0">

                    <div class="controls">
                        <button id="check-btn">تحقق</button>
                        <button id="show-steps-btn">اظهر الخطوات</button>
                        <button id="hint-btn">مساعدة</button>
                        <button id="reset-btn">سؤال جديد</button>
                    </div>

                    <!-- التغذية الراجعة -->
                    <div class="feedback" id="feedback">احسب ناتج الضرب وأدخل الإجابة!</div>
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
        // المتغيرات الأساسية
        let num1 = 0;
        let num2 = 0;
        let correctAnswer = 0;
        let currentDifficulty = 'two-digit';
        let score = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalQuestions = 10;
        let currentQuestion = 0;
        let gameStarted = false;
        let hintsUsed = 0;
        let stepsShown = false;

        // عناصر DOM
        const multiplicationProblemElement = document.getElementById('multiplication-problem');
        const visualMultiplicationElement = document.getElementById('visual-multiplication');
        const stepByStepElement = document.getElementById('step-by-step');
        const calculationStepsElement = document.getElementById('calculation-steps');
        const answerInputElement = document.getElementById('answer-input');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const showStepsButton = document.getElementById('show-steps-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const progressDisplayElement = document.getElementById('progress-display');
        const progressBarElement = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const difficultyButtons = document.querySelectorAll('.difficulty-btn');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            checkButton.addEventListener('click', checkAnswer);
            showStepsButton.addEventListener('click', toggleSteps);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', resetGame);

            answerInputElement.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    checkAnswer();
                }
            });

            difficultyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    difficultyButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    currentDifficulty = this.getAttribute('data-difficulty');
                    resetGame();
                });
            });
        }

        // بدء اللعبة
        function startGame() {
            gameStarted = true;
            generateNewProblem();
        }

        // توليد أعداد حسب مستوى الصعوبة
        function generateNumbers() {
            if (currentDifficulty === 'two-digit') {
                // عدد من منزلتين × عدد من منزلة واحدة
                num1 = Math.floor(Math.random() * 90) + 10; // 10-99
                num2 = Math.floor(Math.random() * 9) + 1;   // 1-9
            } else {
                // عدد من ثلاث منازل × عدد من منزلة واحدة
                num1 = Math.floor(Math.random() * 900) + 100; // 100-999
                num2 = Math.floor(Math.random() * 9) + 1;     // 1-9
            }

            correctAnswer = num1 * num2;
        }

        // إنشاء مسألة جديدة
        function generateNewProblem() {
            if (currentQuestion >= totalQuestions) {
                endGame();
                return;
            }

            currentQuestion++;
            updateProgress();

            // توليد الأعداد
            generateNumbers();

            // تحديث واجهة المستخدم
            updateProblemDisplay();
            createVisualMultiplication();
            resetFeedback();
        }

        // تحديث عرض المسألة
        function updateProblemDisplay() {
            multiplicationProblemElement.textContent = `${num1} × ${num2}`;
            answerInputElement.value = '';
            answerInputElement.disabled = false;
            stepByStepElement.style.display = 'none';
            stepsShown = false;
            answerInputElement.focus();
        }

        // إنشاء الضرب البصري
        function createVisualMultiplication() {
            visualMultiplicationElement.innerHTML = '';

            const num1Str = num1.toString();
            const num2Str = num2.toString();

            // العدد الأول
            const firstNumberGroup = document.createElement('div');
            firstNumberGroup.className = 'number-group';

            const firstNumberLabel = document.createElement('div');
            firstNumberLabel.className = 'group-label';
            firstNumberLabel.textContent = 'العدد الأول';

            const firstNumberDigits = document.createElement('div');
            firstNumberDigits.className = 'digit-row';

            for (let i = 0; i < num1Str.length; i++) {
                const digitBox = document.createElement('div');
                digitBox.className = 'digit-box';
                digitBox.textContent = num1Str[i];
                firstNumberDigits.appendChild(digitBox);
            }

            firstNumberGroup.appendChild(firstNumberDigits);
            firstNumberGroup.appendChild(firstNumberLabel);

            // علامة الضرب
            const multiplySign = document.createElement('div');
            multiplySign.className = 'multiplication-problem';
            multiplySign.textContent = '×';
            multiplySign.style.fontSize = '2rem';
            multiplySign.style.margin = '0 20px';

            // العدد الثاني
            const secondNumberGroup = document.createElement('div');
            secondNumberGroup.className = 'number-group';

            const secondNumberLabel = document.createElement('div');
            secondNumberLabel.className = 'group-label';
            secondNumberLabel.textContent = 'العدد الثاني';

            const secondNumberDigits = document.createElement('div');
            secondNumberDigits.className = 'digit-row';

            for (let i = 0; i < num2Str.length; i++) {
                const digitBox = document.createElement('div');
                digitBox.className = 'digit-box';
                digitBox.textContent = num2Str[i];
                secondNumberDigits.appendChild(digitBox);
            }

            secondNumberGroup.appendChild(secondNumberDigits);
            secondNumberGroup.appendChild(secondNumberLabel);

            visualMultiplicationElement.appendChild(firstNumberGroup);
            visualMultiplicationElement.appendChild(multiplySign);
            visualMultiplicationElement.appendChild(secondNumberGroup);
        }

        // تبديل عرض الخطوات
        function toggleSteps() {
            stepsShown = !stepsShown;

            if (stepsShown) {
                showSteps();
                showStepsButton.textContent = 'إخفاء الخطوات';
            } else {
                stepByStepElement.style.display = 'none';
                showStepsButton.textContent = 'اظهر الخطوات';
            }
        }

        // عرض خطوات الحل
        function showSteps() {
            stepByStepElement.style.display = 'block';

            let stepsHTML = '';

            if (currentDifficulty === 'two-digit') {
                // تحليل العدد إلى عشرات وآحاد
                const tens = Math.floor(num1 / 10);
                const ones = num1 % 10;

                stepsHTML = `
                    <div class="step">الخطوة 1: نحلل العدد ${num1} إلى ${tens} عشرات و ${ones} آحاد</div>
                    <div class="step">الخطوة 2: نضرب العشرات: ${tens} × ${num2} = ${tens * num2}</div>
                    <div class="step">الخطوة 3: نضرب الآحاد: ${ones} × ${num2} = ${ones * num2}</div>
                    <div class="step">الخطوة 4: نجمع النواتج: ${tens * num2} + ${ones * num2} = ${correctAnswer}</div>
                `;
            } else {
                // تحليل العدد إلى مئات وعشرات وآحاد
                const hundreds = Math.floor(num1 / 100);
                const tens = Math.floor((num1 % 100) / 10);
                const ones = num1 % 10;

                stepsHTML = `
                    <div class="step">الخطوة 1: نحلل العدد ${num1} إلى ${hundreds} مئات و ${tens} عشرات و ${ones} آحاد</div>
                    <div class="step">الخطوة 2: نضرب المئات: ${hundreds} × ${num2} = ${hundreds * num2}</div>
                    <div class="step">الخطوة 3: نضرب العشرات: ${tens} × ${num2} = ${tens * num2}</div>
                    <div class="step">الخطوة 4: نضرب الآحاد: ${ones} × ${num2} = ${ones * num2}</div>
                    <div class="step">الخطوة 5: نجمع النواتج: ${hundreds * num2} + ${tens * num2} + ${ones * num2} = ${correctAnswer}</div>
                `;
            }

            calculationStepsElement.innerHTML = stepsHTML;
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseInt(answerInputElement.value);

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = '⚠️ الرجاء إدخال إجابة صحيحة!';
                feedbackElement.className = 'feedback incorrect';
                return;
            }

            if (userAnswer === correctAnswer) {
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

            feedbackElement.textContent = `🎉 أحسنت! ${num1} × ${num2} = ${correctAnswer}`;
            feedbackElement.className = 'feedback correct';

            // تأثير التتابع
            if (currentStreak >= 3) {
                celebrate();
            }

            answerInputElement.disabled = true;

            // الانتقال إلى السؤال التالي بعد تأخير
            setTimeout(generateNewProblem, 2000);
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            score = Math.max(0, score - 50);
            currentStreak = 0;
            updateStats();

            feedbackElement.textContent = `❌ إجابة خاطئة! حاول مرة أخرى`;
            feedbackElement.className = 'feedback incorrect';

            answerInputElement.focus();
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

            let hintMessage = '';

            if (currentDifficulty === 'two-digit') {
                const tens = Math.floor(num1 / 10);
                const ones = num1 % 10;
                hintMessage = `💡 جرب: (${tens} × ${num2}) + (${ones} × ${num2})`;
            } else {
                const hundreds = Math.floor(num1 / 100);
                const tens = Math.floor((num1 % 100) / 10);
                const ones = num1 % 10;
                hintMessage = `💡 جرب: (${hundreds} × ${num2}) + (${tens} × ${num2}) + (${ones} × ${num2})`;
            }

            feedbackElement.textContent = hintMessage;
            feedbackElement.className = 'feedback info';
        }

        // نهاية اللعبة
        function endGame() {
            gameStarted = false;
            checkButton.disabled = true;
            showStepsButton.disabled = true;
            hintButton.disabled = true;

            const percentage = (correctAnswers / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أنت خبير في الضرب! ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 أحسنت! مهاراتك في الضرب ممتازة ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 جيد! واصل التدرب على الضرب ${correctAnswers}/${totalQuestions}`;
            } else {
                message = `📚 راجع جدول الضرب وطرق الحساب! ${correctAnswers}/${totalQuestions}`;
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
            stepsShown = false;
            gameStarted = true;

            updateStats();
            updateProgress();
            checkButton.disabled = false;
            showStepsButton.disabled = false;
            hintButton.disabled = false;
            showStepsButton.textContent = 'اظهر الخطوات';
            stepByStepElement.style.display = 'none';

            generateNewProblem();
        }

        // إعادة تعيين التغذية الراجعة
        function resetFeedback() {
            feedbackElement.textContent = 'احسب ناتج الضرب وأدخل الإجابة!';
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
