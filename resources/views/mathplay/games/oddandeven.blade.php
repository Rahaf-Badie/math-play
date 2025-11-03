<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 العدد الزوجي والفردي - {{ $lesson_game->lesson->name ?? 'درس الأعداد الزوجية والفردية' }}</title>
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
            max-width: 700px;
            width: 100%;
            color: #333;
            text-align: center;
        }

        h1 {
            color: #6c5ce7;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .lesson-info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
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

        .number-display {
            font-size: 5rem;
            font-weight: bold;
            color: #6c5ce7;
            background: linear-gradient(135deg, #f7d794, #f8a5c2);
            padding: 40px;
            border-radius: 25px;
            margin-bottom: 40px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
            border: 6px solid #fd79a8;
            animation: pulse 2s infinite;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .choice-btn {
            width: 180px;
            height: 180px;
            border: none;
            border-radius: 25px;
            font-size: 2.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-even {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        .btn-odd {
            background: linear-gradient(135deg, #d63031, #e84393);
            color: white;
        }

        .choice-btn:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .choice-btn:active {
            transform: translateY(-3px) scale(1.02);
        }

        .btn-icon {
            font-size: 3rem;
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
            background: linear-gradient(135deg, #00b894, #00a085);
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

        .progress-container {
            margin: 25px 0;
        }

        .progress-bar {
            width: 100%;
            height: 20px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #00b894, #00a085);
            border-radius: 10px;
            transition: width 0.5s ease;
            width: 0%;
        }

        .progress-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2d3436;
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
            color: #6c5ce7;
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
            background: linear-gradient(135deg, #fd79a8, #e84393);
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
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
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

        .explanation {
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.1rem;
            color: #2d3436;
            display: none;
        }

        .explanation.show {
            display: block;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .number-display {
                font-size: 3.5rem;
                padding: 30px;
                min-height: 150px;
            }

            .choice-btn {
                width: 140px;
                height: 140px;
                font-size: 1.8rem;
            }

            .btn-icon {
                font-size: 2.5rem;
            }

            h1 {
                font-size: 2rem;
            }

            .buttons-container {
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎯 العدد الزوجي والفردي</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'الأعداد الزوجية والفردية ضمن 99' }}
        </div>

        <div class="instructions">
            <p>اختر إذا كان العدد المعروض زوجيًا أم فرديًا</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 1 }} إلى {{ $settings->max_range ?? 99 }}</p>
            <p><strong>تلميح:</strong> العدد الزوجي ينتهي بـ (0, 2, 4, 6, 8) والفردي ينتهي بـ (1, 3, 5, 7, 9)</p>
        </div>

        <div class="game-area">
            <div class="number-display" id="number-display">
                ?
            </div>

            <div class="buttons-container">
                <button class="choice-btn btn-even" onclick="checkAnswer('even')">
                    <span class="btn-icon">🔢</span>
                    <span>زوجي</span>
                </button>

                <button class="choice-btn btn-odd" onclick="checkAnswer('odd')">
                    <span class="btn-icon">🔣</span>
                    <span>فردي</span>
                </button>
            </div>

            <div class="explanation" id="explanation">
                <!-- سيتم عرض الشرح هنا -->
            </div>

            <div class="feedback" id="feedback">
                اختر إذا كان العدد زوجيًا أم فرديًا
            </div>

            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill"></div>
                </div>
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
                    <span>التتابع الحالي</span>
                    <div class="score-value" id="streak">0</div>
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
            const maxRange = {{ $settings->max_range ?? 99 }};
            const totalRounds = 10;

            // عناصر DOM
            const numberDisplay = document.getElementById('number-display');
            const feedbackElement = document.getElementById('feedback');
            const explanationElement = document.getElementById('explanation');
            const scoreElement = document.getElementById('score');
            const correctElement = document.getElementById('correct');
            const streakElement = document.getElementById('streak');
            const progressFill = document.getElementById('progress-fill');
            const progressText = document.getElementById('progress-text');
            const nextBtn = document.getElementById('nextBtn');
            const celebration = document.getElementById('celebration');

            // متغيرات اللعبة
            let currentRound = 1;
            let score = 0;
            let correctAnswers = 0;
            let currentStreak = 0;
            let bestStreak = 0;
            let currentNumber = 0;
            let gameActive = true;

            // توليد عدد عشوائي ضمن المدى المحدد
            function generateRandomNumber() {
                return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            }

            // توليد سؤال جديد
            function generateQuestion() {
                gameActive = true;
                currentNumber = generateRandomNumber();

                // تحديث العرض
                numberDisplay.textContent = currentNumber;
                numberDisplay.style.animation = 'pulse 2s infinite';

                // إعادة تعليمات اللعبة
                feedbackElement.textContent = 'اختر إذا كان العدد زوجيًا أم فرديًا';
                feedbackElement.className = 'feedback info';

                // إخفاء الشرح
                explanationElement.classList.remove('show');

                // تحديث شريط التقدم
                updateProgress();

                // تعطيل زر التالي
                nextBtn.disabled = true;
            }

            // تحديث شريط التقدم
            function updateProgress() {
                const progress = (currentRound / totalRounds) * 100;
                progressFill.style.width = `${progress}%`;
                progressText.textContent = `السؤال ${currentRound} من ${totalRounds}`;
            }

            // التحقق من الإجابة
            function checkAnswer(answer) {
                if (!gameActive) return;

                gameActive = false;
                nextBtn.disabled = false;

                const isEven = currentNumber % 2 === 0;
                const correctAnswer = isEven ? 'even' : 'odd';
                const isCorrect = answer === correctAnswer;

                // إيقاف تأثير النبض
                numberDisplay.style.animation = 'none';

                if (isCorrect) {
                    // الإجابة الصحيحة
                    score += 10;
                    correctAnswers++;
                    currentStreak++;

                    if (currentStreak > bestStreak) {
                        bestStreak = currentStreak;
                    }

                    feedbackElement.textContent = '🎉 أحسنت! إجابة صحيحة';
                    feedbackElement.className = 'feedback correct';

                    // تحديث النقاط والمؤشرات
                    scoreElement.textContent = score;
                    correctElement.textContent = correctAnswers;
                    streakElement.textContent = currentStreak;

                    // تأثير احتفال للتتابعات العالية
                    if (currentStreak >= 3) {
                        createCelebration();
                    }

                    // عرض الشرح للإجابة الصحيحة
                    showExplanation(true);
                } else {
                    // الإجابة الخاطئة
                    feedbackElement.textContent = '❌ حاول مرة أخرى!';
                    feedbackElement.className = 'feedback incorrect';
                    currentStreak = 0;
                    streakElement.textContent = '0';

                    // عرض الشرح للإجابة الخاطئة
                    showExplanation(false);
                }
            }

            // عرض الشرح
            function showExplanation(isCorrect) {
                const lastDigit = currentNumber % 10;
                const isEven = currentNumber % 2 === 0;
                const numberType = isEven ? 'زوجي' : 'فردي';
                const evenEndings = [0, 2, 4, 6, 8];
                const oddEndings = [1, 3, 5, 7, 9];

                let explanationHTML = '';

                if (isCorrect) {
                    explanationHTML = `
                        <strong>✅ صحيح!</strong> العدد ${currentNumber} هو عدد <strong>${numberType}</strong><br>
                        لأنه ينتهي بالرقم <strong>${lastDigit}</strong> ${isEven ?
                        '(الأعداد الزوجية تنتهي بـ 0, 2, 4, 6, 8)' :
                        '(الأعداد الفردية تنتهي بـ 1, 3, 5, 7, 9)'}
                    `;
                } else {
                    explanationHTML = `
                        <strong>❌ ليس صحيحًا!</strong> العدد ${currentNumber} هو عدد <strong>${numberType}</strong><br>
                        لأنه ينتهي بالرقم <strong>${lastDigit}</strong> ${isEven ?
                        '(الأعداد الزوجية تنتهي بـ 0, 2, 4, 6, 8)' :
                        '(الأعداد الفردية تنتهي بـ 1, 3, 5, 7, 9)'}
                    `;
                }

                explanationElement.innerHTML = explanationHTML;
                explanationElement.classList.add('show');
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
                feedbackElement.textContent = `🎊 انتهت اللعبة! النقاط النهائية: ${score}`;
                feedbackElement.className = 'feedback correct';
                numberDisplay.textContent = '🎉 تهانينا!';
                numberDisplay.style.animation = 'none';
                explanationElement.classList.remove('show');
                nextBtn.disabled = true;

                // عرض النتائج النهائية
                setTimeout(() => {
                    explanationElement.innerHTML = `
                        <strong>النتائج النهائية:</strong><br>
                        - النقاط: ${score}<br>
                        - الإجابات الصحيحة: ${correctAnswers}/${totalRounds}<br>
                        - أفضل تتابع: ${bestStreak}
                    `;
                    explanationElement.classList.add('show');
                }, 1000);

                createCelebration();
            }

            // إعادة تشغيل اللعبة
            function restartGame() {
                currentRound = 1;
                score = 0;
                correctAnswers = 0;
                currentStreak = 0;
                bestStreak = 0;
                scoreElement.textContent = '0';
                correctElement.textContent = '0';
                streakElement.textContent = '0';
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

            // تهيئة اللعبة
            generateQuestion();
        });
    </script>
</body>
</html>
