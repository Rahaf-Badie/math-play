<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 سباق الطرح - {{ $lesson_game->lesson->name ?? 'طرح عددين ضمن 999 دون استلاف' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            color: #333;
            text-align: center;
        }

        h1 {
            color: #e91e63;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .lesson-info {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            padding: 12px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 1.3rem;
            color: white;
            font-weight: bold;
        }

        .instructions {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-size: 1.2rem;
            line-height: 1.6;
            color: #2d3436;
            font-weight: bold;
        }

        .game-area {
            margin: 30px 0;
        }

        .question-display {
            font-size: 3rem;
            font-weight: bold;
            color: #e91e63;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
            border: 4px solid #e91e63;
            direction: ltr;
            animation: pulse 2s infinite;
        }

        .input-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .answer-input {
            width: 180px;
            height: 90px;
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            border: 4px solid #ff9800;
            border-radius: 15px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: #2d3436;
            transition: all 0.3s ease;
            direction: ltr;
        }

        .answer-input:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 4px rgba(233, 30, 99, 0.3);
            transform: scale(1.05);
        }

        .submit-btn {
            padding: 20px 40px;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .submit-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        .submit-btn:active {
            transform: translateY(-2px) scale(1.02);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .timer-container {
            margin: 25px 0;
        }

        .timer-display {
            font-size: 2rem;
            font-weight: bold;
            color: #2d3436;
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            padding: 15px 30px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .timer-bar {
            width: 100%;
            height: 20px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin: 15px 0;
        }

        .timer-fill {
            height: 100%;
            background: linear-gradient(135deg, #ff9800, #f57c00);
            border-radius: 10px;
            transition: width 1s linear;
            width: 100%;
        }

        .timer-fill.warning {
            background: linear-gradient(135deg, #fdcb6e, #e17055);
        }

        .timer-fill.danger {
            background: linear-gradient(135deg, #e17055, #d63031);
            animation: pulse 0.5s infinite;
        }

        .feedback {
            margin: 30px 0;
            font-size: 1.8rem;
            font-weight: bold;
            min-height: 80px;
            padding: 25px;
            border-radius: 20px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feedback.correct {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
            animation: celebrate 0.5s ease-in-out;
        }

        .feedback.incorrect {
            background: linear-gradient(135deg, #d63031, #e84393);
            color: white;
            animation: shake 0.5s ease-in-out;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        .feedback.timeout {
            background: linear-gradient(135deg, #fdcb6e, #e17055);
            color: white;
        }

        .score-board {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 25px;
            border-radius: 20px;
            font-size: 1.3rem;
            font-weight: bold;
            color: #2d3436;
        }

        .score-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .score-value {
            font-size: 2.2rem;
            color: #e91e63;
            margin-top: 5px;
        }

        .bonus-display {
            font-size: 1.1rem;
            color: #ff9800;
            font-weight: bold;
            margin-top: 5px;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
        }

        button {
            padding: 15px 35px;
            font-size: 1.3rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        #nextBtn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        #restartBtn {
            background: linear-gradient(135deg, #9c27b0, #7b1fa2);
            color: white;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
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
            width: 15px;
            height: 15px;
            background-color: #f00;
            opacity: 0.8;
            animation: fall linear forwards;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        .progress-container {
            margin: 20px 0;
        }

        .progress-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2d3436;
            margin-bottom: 10px;
        }

        .calculation-steps {
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.1rem;
            color: #2d3436;
            display: none;
        }

        .calculation-steps.show {
            display: block;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .no-borrowing-info {
            background: linear-gradient(135deg, #c8e6c9, #a5d6a7);
            padding: 15px;
            border-radius: 15px;
            margin: 15px 0;
            font-size: 1.1rem;
            color: #2e7d32;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .question-display {
                font-size: 2.5rem;
                padding: 20px;
            }

            .answer-input {
                width: 140px;
                height: 70px;
                font-size: 2rem;
            }

            .submit-btn {
                padding: 15px 30px;
                font-size: 1.3rem;
            }

            h1 {
                font-size: 2rem;
            }

            .input-container {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎮 سباق الطرح</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'طرح عددين ضمن 999 دون استلاف' }}
        </div>

        <div class="instructions">
            <p>أدخل ناتج طرح العددين في أسرع وقت ممكن!</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 1 }} إلى {{ $settings->max_range ?? 999 }}</p>
            <p><strong>مكافأة السرعة:</strong> تحصل على نقاط إضافية حسب سرعة إجابتك!</p>
        </div>

        <div class="no-borrowing-info">
            💡 <strong>بدون استلاف:</strong> في هذه المسائل، كل منزلة في العدد الأول أكبر من أو تساوي المنزلة المقابلة في العدد الثاني
        </div>

        <div class="game-area">
            <div class="question-display" id="question-display">
                ?
            </div>

            <div class="input-container">
                <input type="number" class="answer-input" id="answer-input" placeholder="0" min="0" max="999">
                <button class="submit-btn" id="submitBtn" onclick="submitAnswer()">✅ تحقق</button>
            </div>

            <div class="timer-container">
                <div class="timer-display" id="timer-display">⏰ 15 ثانية</div>
                <div class="timer-bar">
                    <div class="timer-fill" id="timer-fill"></div>
                </div>
            </div>

            <div class="calculation-steps" id="calculation-steps">
                <!-- سيتم عرض خطوات الحل هنا -->
            </div>

            <div class="feedback" id="feedback">
                أدخل ناتج الطرح في أسرع وقت ممكن!
            </div>

            <div class="progress-container">
                <div class="progress-text" id="progress-text">السؤال 1 من 10</div>
            </div>

            <div class="score-board">
                <div class="score-item">
                    <span>النقاط</span>
                    <div class="score-value" id="score">0</div>
                </div>
                <div class="score-item">
                    <span>الإجابات الصحيحة</span>
                    <div class="score-value" id="correct">0</div>
                </div>
                <div class="score-item">
                    <span>متوسط الوقت</span>
                    <div class="score-value" id="avg-time">0</div>
                    <div class="bonus-display">ثانية</div>
                </div>
            </div>
        </div>

        <div class="controls">
            <button id="nextBtn" onclick="nextQuestion()">➡️ سؤال تالي</button>
            <button id="restartBtn" onclick="restartGame()">🔁 إعادة اللعبة</button>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // قراءة الإعدادات من Blade
            const minRange = {{ $settings->min_range ?? 1 }};
            const maxRange = {{ $settings->max_range ?? 999 }};
            const totalRounds = 10;
            const baseTime = 15; // 15 ثانية لكل سؤال

            // عناصر DOM
            const questionDisplay = document.getElementById('question-display');
            const answerInput = document.getElementById('answer-input');
            const submitBtn = document.getElementById('submitBtn');
            const timerDisplay = document.getElementById('timer-display');
            const timerFill = document.getElementById('timer-fill');
            const feedbackElement = document.getElementById('feedback');
            const calculationSteps = document.getElementById('calculation-steps');
            const scoreElement = document.getElementById('score');
            const correctElement = document.getElementById('correct');
            const avgTimeElement = document.getElementById('avg-time');
            const progressText = document.getElementById('progress-text');
            const nextBtn = document.getElementById('nextBtn');
            const celebration = document.getElementById('celebration');

            // متغيرات اللعبة
            let currentRound = 1;
            let score = 0;
            let correctAnswers = 0;
            let currentAnswer = 0;
            let timeLeft = baseTime;
            let timerInterval;
            let startTime;
            let totalTimeUsed = 0;
            let gameActive = false;
            let num1 = 0, num2 = 0;

            // توليد مسألة طرح دون استلاف
            function generateSubtractionProblem() {
                let attempts = 0;

                do {
                    num1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    num2 = Math.floor(Math.random() * (num1 - minRange + 1)) + minRange;
                    attempts++;

                    // التأكد من عدم وجود استلاف في أي منزلة
                    if (attempts > 100) break; // منع التكرار اللانهائي

                } while (hasBorrowing(num1, num2));

                currentAnswer = num1 - num2;
                questionDisplay.textContent = `${num1} - ${num2} = ?`;
                questionDisplay.style.direction = 'ltr';

                return { num1, num2 };
            }

            // التحقق من وجود استلاف
            function hasBorrowing(a, b) {
                let tempA = a;
                let tempB = b;

                while (tempA > 0 || tempB > 0) {
                    const digitA = tempA % 10;
                    const digitB = tempB % 10;

                    if (digitA < digitB) {
                        return true; // يوجد استلاف
                    }

                    tempA = Math.floor(tempA / 10);
                    tempB = Math.floor(tempB / 10);
                }

                return false; // لا يوجد استلاف
            }

            // توليد سؤال جديد
            function generateQuestion() {
                gameActive = true;
                generateSubtractionProblem();

                // إعادة تعيين الحقول
                answerInput.value = '';
                answerInput.disabled = false;
                answerInput.focus();

                // إعادة تعيين المؤقت
                timeLeft = baseTime;
                timerFill.style.width = '100%';
                timerFill.className = 'timer-fill';
                updateTimerDisplay();

                // إخفاء خطوات الحل
                calculationSteps.classList.remove('show');

                // بدء المؤقت
                startTime = Date.now();
                clearInterval(timerInterval);
                timerInterval = setInterval(updateTimer, 100);

                // تحديث الواجهة
                feedbackElement.textContent = 'أدخل ناتج الطرح في أسرع وقت ممكن!';
                feedbackElement.className = 'feedback info';
                progressText.textContent = `السؤال ${currentRound} من ${totalRounds}`;
                nextBtn.disabled = true;
            }

            // تحديث المؤقت
            function updateTimer() {
                if (!gameActive) return;

                timeLeft -= 0.1;
                const percentage = (timeLeft / baseTime) * 100;
                timerFill.style.width = `${percentage}%`;

                // تغيير اللون حسب الوقت المتبقي
                if (percentage <= 30) {
                    timerFill.className = 'timer-fill warning';
                }
                if (percentage <= 15) {
                    timerFill.className = 'timer-fill danger';
                }

                updateTimerDisplay();

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timeOut();
                }
            }

            // تحديث عرض المؤقت
            function updateTimerDisplay() {
                timerDisplay.textContent = `⏰ ${Math.ceil(timeLeft)} ثانية`;
            }

            // انتهاء الوقت
            function timeOut() {
                gameActive = false;
                answerInput.disabled = true;
                feedbackElement.textContent = '⏰ انتهى الوقت! حاول أن تكون أسرع في المرة القادمة';
                feedbackElement.className = 'feedback timeout';
                showCalculationSteps();
                nextBtn.disabled = false;
                totalTimeUsed += baseTime; // إضافة الوقت الكامل للإحصاءات
            }

            // عرض خطوات الحل
            function showCalculationSteps() {
                calculationSteps.innerHTML = `
                    <strong>📝 خطوات الحل:</strong><br>
                    ${num1} - ${num2}<br>
                    = ${currentAnswer}
                `;
                calculationSteps.classList.add('show');
            }

            // إرسال الإجابة
            function submitAnswer() {
                if (!gameActive) return;

                clearInterval(timerInterval);
                gameActive = false;
                answerInput.disabled = true;

                const userAnswer = parseInt(answerInput.value);
                const endTime = Date.now();
                const timeUsed = (endTime - startTime) / 1000;
                const actualTime = Math.min(timeUsed, baseTime);
                totalTimeUsed += actualTime;

                if (userAnswer === currentAnswer) {
                    // حساب النقاط مع مكافأة السرعة
                    const timeBonus = Math.max(0, Math.floor((baseTime - actualTime) * 2));
                    const points = 10 + timeBonus;
                    score += points;
                    correctAnswers++;

                    feedbackElement.innerHTML = `
                        🎉 أحسنت! الإجابة صحيحة<br>
                        <small>+10 نقاط أساسية + ${timeBonus} نقاط سرعة</small>
                    `;
                    feedbackElement.className = 'feedback correct';

                    // تحديث النقاط
                    scoreElement.textContent = score;
                    correctElement.textContent = correctAnswers;

                    // تأثير احتفال للإجابات السريعة
                    if (timeBonus >= 20) {
                        createCelebration();
                    }
                } else {
                    feedbackElement.textContent = `❌ ليس صحيحًا! الإجابة الصحيحة: ${currentAnswer}`;
                    feedbackElement.className = 'feedback incorrect';
                    showCalculationSteps();
                }

                // تحديث متوسط الوقت
                const avgTime = (totalTimeUsed / currentRound).toFixed(1);
                avgTimeElement.textContent = avgTime;

                nextBtn.disabled = false;
            }

            // الانتقال للسؤال التالي
            function nextQuestion() {
                if (currentRound < totalRounds) {
                    currentRound++;
                    generateQuestion();
                } else {
                    endGame();
                }
            }

            // إنهاء اللعبة
            function endGame() {
                feedbackElement.innerHTML = `
                    🎊 انتهت اللعبة!<br>
                    <strong>النقاط النهائية: ${score}</strong>
                `;
                feedbackElement.className = 'feedback correct';
                questionDisplay.textContent = '🎉 تهانينا!';
                answerInput.style.display = 'none';
                submitBtn.style.display = 'none';
                timerDisplay.style.display = 'none';
                timerFill.style.display = 'none';
                calculationSteps.style.display = 'none';
                nextBtn.disabled = true;

                createCelebration();
            }

            // إعادة تشغيل اللعبة
            function restartGame() {
                currentRound = 1;
                score = 0;
                correctAnswers = 0;
                totalTimeUsed = 0;
                scoreElement.textContent = '0';
                correctElement.textContent = '0';
                avgTimeElement.textContent = '0';
                answerInput.style.display = 'block';
                submitBtn.style.display = 'block';
                timerDisplay.style.display = 'block';
                timerFill.style.display = 'block';
                calculationSteps.style.display = 'block';
                generateQuestion();
            }

            // تأثير الاحتفال
            function createCelebration() {
                celebration.style.display = 'block';
                const colors = ['#ff6b6b', '#ffa726', '#ffeb3b', '#4caf50', '#2196f3', '#9c27b0'];

                for (let i = 0; i < 100; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    confetti.style.width = (Math.random() * 10 + 5) + 'px';
                    confetti.style.height = (Math.random() * 10 + 5) + 'px';
                    celebration.appendChild(confetti);

                    setTimeout(() => {
                        confetti.remove();
                    }, 5000);
                }

                setTimeout(() => {
                    celebration.style.display = 'none';
                    celebration.innerHTML = '';
                }, 5000);
            }

            // السماح بالضغط على Enter للإجابة
            answerInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    submitAnswer();
                }
            });

            // جعل الدوال متاحة عالمياً
            window.submitAnswer = submitAnswer;
            window.nextQuestion = nextQuestion;
            window.restartGame = restartGame;

            // تهيئة اللعبة
            generateQuestion();
        });
    </script>
</body>
</html>
