<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة اكمل المعادلة - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tahoma", sans-serif;
            background: linear-gradient(135deg, #55efc4 0%, #81ecec 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: #2d3436;
            text-align: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 100%;
            max-width: 600px;
        }

        .lesson-info {
            background: linear-gradient(to right, #0984e3, #74b9ff);
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            margin-bottom: 25px;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .game-title {
            color: #2d3436;
            font-size: 2.3rem;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .instructions {
            background: #f8f9fa;
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #0984e3;
            text-align: right;
            line-height: 1.6;
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.1rem;
        }

        .game-area {
            padding: 25px;
            background: #f1f2f6;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #dfe6e9;
        }

        .equation-display {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 25px 0;
            color: #0984e3;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            direction: ltr;
            text-align: center;
        }

        .missing-number {
            display: inline-block;
            width: 100px;
            height: 60px;
            border: 3px dashed #fd79a8;
            border-radius: 10px;
            margin: 0 10px;
            background: rgba(253, 121, 168, 0.1);
            color: #fd79a8;
            font-size: 2rem;
            line-height: 60px;
            vertical-align: middle;
        }

        .input-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .answer-input {
            width: 120px;
            padding: 15px;
            font-size: 2rem;
            font-weight: bold;
            border-radius: 15px;
            border: 3px solid #0984e3;
            text-align: center;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .answer-input:focus {
            outline: none;
            border-color: #00b894;
            box-shadow: 0 0 0 3px rgba(0, 184, 148, 0.3);
            transform: scale(1.05);
        }

        .submit-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border: none;
            padding: 18px 30px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.3rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .submit-btn:active {
            transform: translateY(1px);
        }

        .operation-type {
            background: linear-gradient(135deg, #fdcb6e, #e17055);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            margin: 15px 0;
            font-size: 1.1rem;
            font-weight: bold;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .relationship-help {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
        }

        .relationship-steps {
            font-size: 1.2rem;
            line-height: 1.8;
            text-align: right;
        }

        .timer-container {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            padding: 15px;
            border-radius: 15px;
            margin: 15px 0;
            font-size: 1.3rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .timer-warning {
            background: linear-gradient(135deg, #e63946, #c1121f);
            animation: pulse 1s infinite;
        }

        #message {
            font-size: 1.4rem;
            margin: 20px 0;
            min-height: 60px;
            font-weight: bold;
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .message-success {
            background: rgba(0, 184, 148, 0.2);
            color: #00b894;
            border: 2px solid #00b894;
        }

        .message-error {
            background: rgba(230, 57, 70, 0.2);
            color: #e63946;
            border: 2px solid #e63946;
        }

        .message-info {
            background: rgba(9, 132, 227, 0.2);
            color: #0984e3;
            border: 2px solid #0984e3;
        }

        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0;
            background: #f1faee;
            padding: 20px;
            border-radius: 15px;
        }

        .progress-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .progress-label {
            font-size: 1rem;
            color: #457b9d;
            margin-bottom: 5px;
        }

        .progress-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1d3557;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: #dfe6e9;
            border-radius: 10px;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, #00b894, #00a085);
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .control-btn {
            background: linear-gradient(to right, #f4a261, #e76f51);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .control-btn:active {
            transform: translateY(1px);
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
            width: 12px;
            height: 12px;
            opacity: 0;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .game-title {
                font-size: 2rem;
            }

            .equation-display {
                font-size: 2rem;
            }

            .missing-number {
                width: 80px;
                height: 50px;
                font-size: 1.5rem;
                line-height: 50px;
            }

            .answer-input {
                width: 100px;
                font-size: 1.8rem;
                padding: 12px;
            }

            .submit-btn {
                padding: 15px 25px;
                font-size: 1.1rem;
            }

            .control-btn {
                padding: 12px 20px;
                font-size: 1rem;
            }

            .progress-value {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }} | العلاقة بين الجمع والطرح
        </div>

        <h1 class="game-title">🎮 اكمل المعادلة</h1>

        <div class="instructions">
            <p>🎯 الهدف: اكمل الرقم الناقص في المعادلة باستخدام العلاقة بين الجمع والطرح</p>
            <p>💡 تذكر: إذا كان أ + ب = جـ، فإن جـ - أ = ب وجـ - ب = أ</p>
        </div>

        <div class="game-area">
            <div class="operation-type" id="operation-type">
                <!-- نوع العملية سيظهر هنا -->
            </div>

            <div class="equation-display" id="equation-display">
                <!-- المعادلة ستظهر هنا -->
            </div>

            <div class="input-container">
                <input type="number" class="answer-input" id="answer-input" placeholder="الإجابة">
                <button class="submit-btn" onclick="checkAnswer()">
                    ✓ تحقق
                </button>
            </div>

            <div class="timer-container" id="timer-container">
                ⏱️ الوقت المتبقي: <span id="timer">25</span> ثانية
            </div>

            <div class="relationship-help" id="relationship-help">
                <h3>💡 العلاقة بين الجمع والطرح:</h3>
                <div class="relationship-steps" id="relationship-steps">
                    <!-- خطوات الحل ستظهر هنا -->
                </div>
            </div>
        </div>

        <div class="progress-container">
            <div class="progress-item">
                <div class="progress-label">النقاط</div>
                <div class="progress-value" id="score">0</div>
            </div>
            <div class="progress-item">
                <div class="progress-label">السؤال</div>
                <div class="progress-value" id="question-count">1/10</div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill" style="width: 10%"></div>
                </div>
            </div>
            <div class="progress-item">
                <div class="progress-label">التسلسل</div>
                <div class="progress-value" id="streak">0</div>
            </div>
        </div>

        <div id="message" class="message-info">
            أدخل الرقم الناقص في المعادلة
        </div>

        <div class="controls">
            <button class="control-btn" id="help-btn" onclick="showHelp()">
                💡 مساعدة
            </button>
            <button class="control-btn" id="start-btn" onclick="startGame()">
                🚀 ابدأ اللعبة
            </button>
            <button class="control-btn" id="restart-btn" onclick="restartGame()" style="display:none;">
                🔁 العب مرة أخرى
            </button>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let correctAnswer = 0;
        let currentNumbers = [];
        let currentOperation = '';
        let gameActive = false;
        let timerInterval;
        let timeLeft = 25;
        let currentStreak = 0;
        let bestStreak = 0;

        // عناصر DOM
        const equationDisplay = document.getElementById("equation-display");
        const operationType = document.getElementById("operation-type");
        const answerInput = document.getElementById("answer-input");
        const messageDisplay = document.getElementById("message");
        const scoreDisplay = document.getElementById("score");
        const questionCountDiv = document.getElementById("question-count");
        const progressFill = document.getElementById("progress-fill");
        const streakDiv = document.getElementById("streak");
        const helpBtn = document.getElementById("help-btn");
        const startBtn = document.getElementById("start-btn");
        const restartBtn = document.getElementById("restart-btn");
        const timerContainer = document.getElementById("timer-container");
        const timerDisplay = document.getElementById("timer");
        const relationshipHelp = document.getElementById("relationship-help");
        const relationshipSteps = document.getElementById("relationship-steps");
        const celebrationDiv = document.getElementById("celebration");

        // توليد معادلة جديدة
        function generateEquation() {
            const operationTypes = ['addition_missing_first', 'addition_missing_second', 'subtraction_missing_first', 'subtraction_missing_second'];
            const selectedType = operationTypes[Math.floor(Math.random() * operationTypes.length)];

            let a, b, result;
            let equationText = '';

            // توليد أعداد ضمن المدى المحدد
            a = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            b = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            switch(selectedType) {
                case 'addition_missing_first':
                    result = a + b;
                    correctAnswer = a;
                    equationText = `<span class="missing-number">?</span> + ${b} = ${result}`;
                    currentOperation = 'جمع - الرقم الأول ناقص';
                    currentNumbers = [a, b, result];
                    break;

                case 'addition_missing_second':
                    result = a + b;
                    correctAnswer = b;
                    equationText = `${a} + <span class="missing-number">?</span> = ${result}`;
                    currentOperation = 'جمع - الرقم الثاني ناقص';
                    currentNumbers = [a, b, result];
                    break;

                case 'subtraction_missing_first':
                    result = a;
                    correctAnswer = a + b;
                    equationText = `<span class="missing-number">?</span> - ${b} = ${result}`;
                    currentOperation = 'طرح - المطروح منه ناقص';
                    currentNumbers = [a + b, b, a];
                    break;

                case 'subtraction_missing_second':
                    result = a;
                    correctAnswer = b;
                    equationText = `${a + b} - <span class="missing-number">?</span> = ${result}`;
                    currentOperation = 'طرح - المطروح ناقص';
                    currentNumbers = [a + b, b, a];
                    break;
            }

            equationDisplay.innerHTML = equationText;
            operationType.textContent = currentOperation;
            answerInput.value = '';
            answerInput.focus();

            // إعادة ضبط المؤقت
            resetTimer();

            // تحديث التقدم
            updateProgress();

            // إخفاء المساعدة
            relationshipHelp.style.display = 'none';
        }

        // التحقق من الإجابة
        function checkAnswer() {
            if (!gameActive) return;

            const userAnswer = parseInt(answerInput.value);

            if (isNaN(userAnswer)) {
                messageDisplay.textContent = "⚠️ الرجاء إدخال إجابة صحيحة";
                messageDisplay.className = "message-error";
                return;
            }

            clearInterval(timerInterval);

            const isCorrect = userAnswer === correctAnswer;

            if (isCorrect) {
                // الإجابة صحيحة
                score += 10;
                currentStreak++;
                bestStreak = Math.max(bestStreak, currentStreak);

                // مكافأة الوقت الإضافي
                const timeBonus = Math.floor(timeLeft / 5);
                score += timeBonus;

                messageDisplay.textContent = `أحسنت! ✅ +10 نقاط${timeBonus > 0 ? ` +${timeBonus} مكافأة وقت` : ''}`;
                messageDisplay.className = "message-success";

                // مكافأة التسلسل
                if (currentStreak >= 3) {
                    const streakBonus = currentStreak * 3;
                    score += streakBonus;
                    messageDisplay.textContent += ` 🎯 تسلسل ${currentStreak}! +${streakBonus} نقاط`;
                }
            } else {
                // الإجابة خاطئة
                currentStreak = 0;
                messageDisplay.textContent = `خطأ! الإجابة الصحيحة هي ${correctAnswer} 😅`;
                messageDisplay.className = "message-error";
            }

            // تحديث النقاط والتسلسل
            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;

            questionCount++;

            if (questionCount < totalQuestions) {
                setTimeout(generateEquation, 2000);
            } else {
                setTimeout(() => endGame(true), 2000);
            }
        }

        // إعادة ضبط المؤقت
        function resetTimer() {
            clearInterval(timerInterval);
            timeLeft = 25;
            timerDisplay.textContent = timeLeft;
            timerContainer.classList.remove('timer-warning');

            timerInterval = setInterval(() => {
                timeLeft--;
                timerDisplay.textContent = timeLeft;

                if (timeLeft <= 5) {
                    timerContainer.classList.add('timer-warning');
                }

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    messageDisplay.textContent = "⏰ انتهى الوقت! جرب السؤال التالي";
                    messageDisplay.className = "message-error";
                    questionCount++;

                    if (questionCount < totalQuestions) {
                        setTimeout(generateEquation, 1500);
                    } else {
                        endGame(true);
                    }
                }
            }, 1000);
        }

        // عرض المساعدة
        function showHelp() {
            if (!gameActive) return;

            let steps = '';
            const [num1, num2, result] = currentNumbers;

            if (currentOperation.includes('جمع')) {
                steps = `
                    <p><strong>المعادلة:</strong> ? ${currentOperation.includes('الأول') ? '+' + num2 : num1 + '+'} = ${result}</p>
                    <p><strong>العلاقة:</strong> إذا كان أ + ب = جـ، فإن جـ - ب = أ</p>
                    <p><strong>الحل:</strong> ${result} - ${currentOperation.includes('الأول') ? num2 : num1} = ${correctAnswer}</p>
                    <p class="no-carry-indicator">✅ الإجابة الصحيحة هي: ${correctAnswer}</p>
                `;
            } else {
                steps = `
                    <p><strong>المعادلة:</strong> ? ${currentOperation.includes('المطروح منه') ? '-' + num2 : num1 + '-'} = ${result}</p>
                    <p><strong>العلاقة:</strong> إذا كان أ - ب = جـ، فإن جـ + ب = أ</p>
                    <p><strong>الحل:</strong> ${result} + ${currentOperation.includes('المطروح منه') ? num2 : '?'} = ${correctAnswer}</p>
                    <p class="no-carry-indicator">✅ الإجابة الصحيحة هي: ${correctAnswer}</p>
                `;
            }

            relationshipSteps.innerHTML = steps;
            relationshipHelp.style.display = 'block';
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (questionCount / totalQuestions) * 100;
            progressFill.style.width = `${progress}%`;
            questionCountDiv.textContent = `${questionCount + 1}/${totalQuestions}`;
        }

        // بدء اللعبة
        function startGame() {
            if (gameActive) return;

            gameActive = true;
            score = 0;
            questionCount = 0;
            currentStreak = 0;

            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;
            updateProgress();

            startBtn.style.display = 'none';
            restartBtn.style.display = 'none';
            helpBtn.style.display = 'inline-block';

            messageDisplay.textContent = "ابدأ بحل المعادلات!";
            messageDisplay.className = 'message-info';

            generateEquation();
        }

        // إنهاء اللعبة
        function endGame(isComplete) {
            gameActive = false;
            clearInterval(timerInterval);

            if (isComplete) {
                messageDisplay.innerHTML = `🎉 تهانينا! أكملت جميع المعادلات بنجاح!<br>مجموع نقاطك: ${score} | أفضل تسلسل: ${bestStreak} 🌟`;
                messageDisplay.className = "message-success";
                createConfetti();
            }

            helpBtn.style.display = 'none';
            restartBtn.style.display = 'inline-block';
        }

        // إعادة تشغيل اللعبة
        function restartGame() {
            equationDisplay.innerHTML = '';
            relationshipHelp.style.display = 'none';
            timerContainer.classList.remove('timer-warning');
            celebrationDiv.style.display = 'none';
            celebrationDiv.innerHTML = '';
            startGame();
        }

        // تأثير احتفالي
        function createConfetti() {
            celebrationDiv.style.display = 'block';
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#0984e3'];

            for (let i = 0; i < 150; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.opacity = Math.random();
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                celebrationDiv.appendChild(confetti);

                const animation = confetti.animate([
                    { transform: 'translateY(-100px) rotate(0deg)', opacity: 1 },
                    { transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 720}deg)`, opacity: 0 }
                ], {
                    duration: 2000 + Math.random() * 3000,
                    easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
                });

                animation.onfinish = () => {
                    confetti.remove();
                };
            }
        }

        // السماح بالإدخال باستخدام زر Enter
        answerInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                checkAnswer();
            }
        });

        // منع الإدخال غير الرقمي
        answerInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html>
