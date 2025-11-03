<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة الطرح دون استلاف - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tahoma", sans-serif;
            background: linear-gradient(135deg, #fab1a0 0%, #ffeaa7 100%);
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
            max-width: 500px;
        }

        .lesson-info {
            background: linear-gradient(to right, #d63031, #e17055);
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
            border-right: 5px solid #d63031;
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

        .question-display {
            font-size: 3rem;
            font-weight: bold;
            margin: 25px 0;
            color: #d63031;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
            border: 3px solid #d63031;
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

        .check-btn {
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

        .check-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .check-btn:active {
            transform: translateY(1px);
        }

        .options-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .option-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .option-btn:active {
            transform: translateY(2px);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            animation: pulse 0.5s;
        }

        .option-btn.wrong {
            background: linear-gradient(135deg, #e63946, #c1121f);
            animation: shake 0.5s;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }

        .game-mode-selector {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .mode-btn {
            background: linear-gradient(135deg, #fd79a8, #e84393);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex: 1;
        }

        .mode-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .mode-btn.active {
            background: linear-gradient(135deg, #d63031, #e17055);
            transform: scale(1.05);
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
            background: rgba(214, 48, 49, 0.2);
            color: #d63031;
            border: 2px solid #d63031;
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

        .visual-help {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
        }

        .calculation-steps {
            font-size: 1.2rem;
            line-height: 1.8;
            text-align: right;
        }

        .no-borrow-indicator {
            color: #00b894;
            font-weight: bold;
            margin: 10px 0;
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

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .game-title {
                font-size: 2rem;
            }

            .question-display {
                font-size: 2.2rem;
            }

            .answer-input {
                width: 100px;
                font-size: 1.8rem;
                padding: 12px;
            }

            .options-container {
                grid-template-columns: 1fr;
            }

            .option-btn, .check-btn {
                padding: 15px;
                font-size: 1.3rem;
                min-height: 70px;
            }

            .mode-btn, .control-btn {
                padding: 12px 18px;
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
            الدرس: {{ $lesson_game->lesson->name }} | المدى: {{ $min_range }} إلى {{ $max_range }}
        </div>

        <h1 class="game-title">🎯 الطرح دون استلاف</h1>

        <div class="instructions">
            <p>🎯 الهدف: حل مسائل الطرح دون الحاجة للاستلاف</p>
            <p>💡 تذكر: آحاد المطروح منه يجب أن تكون أكبر أو تساوي آحاد المطروح</p>
            <p class="no-borrow-indicator">✅ لا حاجة للاستلاف في هذه المسائل</p>
        </div>

        <div class="game-mode-selector">
            <button class="mode-btn active" id="input-mode" onclick="setGameMode('input')">
                ⌨️ وضع الإدخال
            </button>
            <button class="mode-btn" id="options-mode" onclick="setGameMode('options')">
                🔘 وضع الخيارات
            </button>
        </div>

        <div class="game-area">
            <div class="question-display" id="question-display">
                <!-- المسألة ستظهر هنا -->
            </div>

            <div class="input-container" id="input-container">
                <input type="number" class="answer-input" id="answer-input" placeholder="الإجابة" min="0">
                <button class="check-btn" onclick="checkAnswerInput()">
                    ✓ تحقق
                </button>
            </div>

            <div class="options-container" id="options-container">
                <!-- الخيارات ستظهر هنا -->
            </div>

            <div class="timer-container" id="timer-container">
                ⏱️ الوقت المتبقي: <span id="timer">15</span> ثانية
            </div>

            <div class="visual-help" id="visual-help">
                <h3>💡 خطوات الحل:</h3>
                <div class="calculation-steps" id="calculation-steps">
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
            اختر وضع اللعبة ثم ابدأ بحل المسائل!
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
        let currentAnswer = 0;
        let currentNumbers = [];
        let gameMode = 'input'; // 'input' أو 'options'
        let gameActive = false;
        let timerInterval;
        let timeLeft = 15;
        let currentStreak = 0;
        let bestStreak = 0;

        // عناصر DOM
        const questionDisplay = document.getElementById("question-display");
        const answerInput = document.getElementById("answer-input");
        const inputContainer = document.getElementById("input-container");
        const optionsContainer = document.getElementById("options-container");
        const timerContainer = document.getElementById("timer-container");
        const timerDisplay = document.getElementById("timer");
        const messageDisplay = document.getElementById("message");
        const scoreDisplay = document.getElementById("score");
        const questionCountDiv = document.getElementById("question-count");
        const progressFill = document.getElementById("progress-fill");
        const streakDiv = document.getElementById("streak");
        const helpBtn = document.getElementById("help-btn");
        const startBtn = document.getElementById("start-btn");
        const restartBtn = document.getElementById("restart-btn");
        const inputModeBtn = document.getElementById("input-mode");
        const optionsModeBtn = document.getElementById("options-mode");
        const visualHelp = document.getElementById("visual-help");
        const calculationSteps = document.getElementById("calculation-steps");
        const celebrationDiv = document.getElementById("celebration");

        // تعيين وضع اللعبة
        function setGameMode(mode) {
            if (gameActive) return;

            gameMode = mode;

            if (mode === 'input') {
                inputModeBtn.classList.add('active');
                optionsModeBtn.classList.remove('active');
                inputContainer.style.display = 'flex';
                optionsContainer.style.display = 'none';
            } else {
                optionsModeBtn.classList.add('active');
                inputModeBtn.classList.remove('active');
                inputContainer.style.display = 'none';
                optionsContainer.style.display = 'grid';
            }

            messageDisplay.textContent = `الوضع: ${mode === 'input' ? 'الإدخال' : 'الخيارات'} - اضغط ابدأ للعب`;
            messageDisplay.className = 'message-info';
        }

        // توليد مسألة طرح دون استلاف
        function generateQuestion() {
            let a, b;
            let valid = false;

            while (!valid) {
                a = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                b = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

                // التأكد من أن a > b وأن لا حاجة للاستلاف
                if (a > b) {
                    const onesA = a % 10;
                    const onesB = b % 10;
                    valid = onesA >= onesB; // لا حاجة للاستلاف
                }
            }

            currentNumbers = [a, b];
            currentAnswer = a - b;

            questionDisplay.textContent = `${a} - ${b} = ?`;

            if (gameMode === 'options') {
                generateOptions();
            } else {
                answerInput.value = '';
                answerInput.focus();
            }

            // إعادة ضبط المؤقت
            resetTimer();

            // تحديث التقدم
            updateProgress();

            // إخفاء المساعدة
            visualHelp.style.display = 'none';
        }

        // توليد خيارات الإجابة
        function generateOptions() {
            optionsContainer.innerHTML = '';
            let options = [currentAnswer];

            // توليد خيارات خاطئة
            while (options.length < 4) {
                let wrongAnswer;
                const pattern = Math.floor(Math.random() * 3);

                switch (pattern) {
                    case 0: // خطأ في الآحاد
                        const onesError = (currentAnswer % 10) + (Math.random() > 0.5 ? 1 : -1);
                        wrongAnswer = Math.floor(currentAnswer / 10) * 10 + onesError;
                        break;
                    case 1: // خطأ في العشرات
                        const tensError = Math.floor(currentAnswer / 10) + (Math.random() > 0.5 ? 1 : -1);
                        wrongAnswer = tensError * 10 + (currentAnswer % 10);
                        break;
                    case 2: // خطأ عشوائي قريب
                        wrongAnswer = currentAnswer + (Math.floor(Math.random() * 9) - 4);
                        break;
                }

                if (wrongAnswer >= 0 && !options.includes(wrongAnswer) && wrongAnswer !== currentAnswer) {
                    options.push(wrongAnswer);
                }
            }

            // خلط الخيارات
            options.sort(() => Math.random() - 0.5);

            // إنشاء أزرار الخيارات
            options.forEach(option => {
                const btn = document.createElement("button");
                btn.className = "option-btn";
                btn.textContent = option;
                btn.onclick = () => checkAnswerOption(option, btn);
                optionsContainer.appendChild(btn);
            });
        }

        // التحقق من الإجابة في وضع الإدخال
        function checkAnswerInput() {
            if (!gameActive) return;

            const userAnswer = parseInt(answerInput.value);

            if (isNaN(userAnswer)) {
                messageDisplay.textContent = "⚠️ الرجاء إدخال إجابة صحيحة";
                messageDisplay.className = "message-error";
                return;
            }

            if (userAnswer < 0) {
                messageDisplay.textContent = "⚠️ الإجابة لا يمكن أن تكون سالبة";
                messageDisplay.className = "message-error";
                return;
            }

            checkAnswer(userAnswer);
        }

        // التحقق من الإجابة في وضع الخيارات
        function checkAnswerOption(selectedAnswer, btn) {
            if (!gameActive) return;

            checkAnswer(selectedAnswer);

            // تعطيل جميع الأزرار
            document.querySelectorAll('.option-btn').forEach(button => {
                button.disabled = true;
                button.style.pointerEvents = 'none';
            });
        }

        // التحقق من الإجابة
        function checkAnswer(userAnswer) {
            clearInterval(timerInterval);

            const isCorrect = userAnswer === currentAnswer;

            if (isCorrect) {
                // الإجابة صحيحة
                score += 10;
                currentStreak++;
                bestStreak = Math.max(bestStreak, currentStreak);

                // مكافأة الوقت الإضافي
                const timeBonus = Math.floor(timeLeft / 3);
                score += timeBonus;

                messageDisplay.textContent = `أحسنت! ✅ +10 نقاط${timeBonus > 0 ? ` +${timeBonus} مكافأة وقت` : ''}`;
                messageDisplay.className = "message-success";

                // مكافأة التسلسل
                if (currentStreak >= 3) {
                    const streakBonus = currentStreak * 2;
                    score += streakBonus;
                    messageDisplay.textContent += ` 🎯 تسلسل ${currentStreak}! +${streakBonus} نقاط`;
                }

                if (gameMode === 'options') {
                    document.querySelectorAll('.option-btn').forEach(btn => {
                        if (parseInt(btn.textContent) === currentAnswer) {
                            btn.classList.add('correct');
                        }
                    });
                }
            } else {
                // الإجابة خاطئة
                currentStreak = 0;
                messageDisplay.textContent = `خطأ! الإجابة الصحيحة هي ${currentAnswer} 😅`;
                messageDisplay.className = "message-error";

                if (gameMode === 'options') {
                    document.querySelectorAll('.option-btn').forEach(btn => {
                        if (parseInt(btn.textContent) === currentAnswer) {
                            btn.classList.add('correct');
                        } else if (parseInt(btn.textContent) === userAnswer) {
                            btn.classList.add('wrong');
                        }
                    });
                }
            }

            // تحديث النقاط والتسلسل
            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;

            questionCount++;

            if (questionCount < totalQuestions) {
                setTimeout(generateQuestion, 2000);
            } else {
                setTimeout(() => endGame(true), 2000);
            }
        }

        // إعادة ضبط المؤقت
        function resetTimer() {
            clearInterval(timerInterval);
            timeLeft = 15;
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
                        setTimeout(generateQuestion, 1500);
                    } else {
                        endGame(true);
                    }
                }
            }, 1000);
        }

        // عرض المساعدة
        function showHelp() {
            if (!gameActive) return;

            const [a, b] = currentNumbers;
            const onesA = a % 10;
            const onesB = b % 10;
            const tensA = Math.floor(a / 10);
            const tensB = Math.floor(b / 10);

            calculationSteps.innerHTML = `
                <p>${a} = ${tensA} عشرات + ${onesA} آحاد</p>
                <p>${b} = ${tensB} عشرات + ${onesB} آحاد</p>
                <p class="no-borrow-indicator">✅ لا حاجة للاستلاف لأن ${onesA} ≥ ${onesB}</p>
                <p>🔹 طرح الآحاد: ${onesA} - ${onesB} = ${onesA - onesB}</p>
                <p>🔹 طرح العشرات: ${tensA} - ${tensB} = ${tensA - tensB}</p>
                <p>🔹 النتيجة: ${tensA - tensB} عشرات + ${onesA - onesB} آحاد = ${currentAnswer}</p>
            `;

            visualHelp.style.display = 'block';
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

            messageDisplay.textContent = `ابدأ بحل مسائل الطرح!`;
            messageDisplay.className = 'message-info';

            generateQuestion();
        }

        // إنهاء اللعبة
        function endGame(isComplete) {
            gameActive = false;
            clearInterval(timerInterval);

            if (isComplete) {
                messageDisplay.innerHTML = `🎉 تهانينا! أكملت جميع الأسئلة بنجاح!<br>مجموع نقاطك: ${score} | أفضل تسلسل: ${bestStreak} 🌟`;
                messageDisplay.className = "message-success";
                createConfetti();
            }

            helpBtn.style.display = 'none';
            restartBtn.style.display = 'inline-block';
        }

        // إعادة تشغيل اللعبة
        function restartGame() {
            questionDisplay.textContent = "جاري التحضير...";
            inputContainer.style.display = gameMode === 'input' ? 'flex' : 'none';
            optionsContainer.style.display = gameMode === 'options' ? 'grid' : 'none';
            optionsContainer.innerHTML = '';
            timerContainer.classList.remove('timer-warning');
            visualHelp.style.display = 'none';
            celebrationDiv.style.display = 'none';
            celebrationDiv.innerHTML = '';
            startGame();
        }

        // تأثير احتفالي
        function createConfetti() {
            celebrationDiv.style.display = 'block';
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#d63031'];

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
                checkAnswerInput();
            }
        });

        // تهيئة الوضع الافتراضي
        setGameMode('input');
    </script>
</body>
</html>
