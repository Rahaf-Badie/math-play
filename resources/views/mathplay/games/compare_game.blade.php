<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 من الأكبر؟ - {{ $lesson_game->lesson->name ?? 'المقارنة بين عددين' }}</title>
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
            max-width: 600px;
            width: 100%;
            color: #333;
            text-align: center;
        }

        h1 {
            color: #1d3557;
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

        .numbers-display {
            font-size: 3.5rem;
            font-weight: bold;
            color: #457b9d;
            background: linear-gradient(135deg, #f1faee, #a8dadc);
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 4px solid #457b9d;
            direction: ltr;
            text-align: center;
        }

        .question-mark {
            color: #e63946;
            font-size: 4rem;
            margin: 0 20px;
            animation: pulse 2s infinite;
        }

        .comparison-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .comparison-btn {
            width: 100px;
            height: 100px;
            font-size: 3rem;
            font-weight: bold;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-less {
            background: linear-gradient(135deg, #e63946, #ff6b6b);
            color: white;
        }

        .btn-equal {
            background: linear-gradient(135deg, #f4a261, #ff9e6d);
            color: white;
        }

        .btn-greater {
            background: linear-gradient(135deg, #2a9d8f, #06d6a0);
            color: white;
        }

        .comparison-btn:hover {
            transform: translateY(-8px) scale(1.1);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
        }

        .comparison-btn:active {
            transform: translateY(-2px) scale(1.05);
        }

        .feedback {
            margin: 25px 0;
            font-size: 1.8rem;
            font-weight: bold;
            min-height: 80px;
            padding: 20px;
            border-radius: 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feedback.correct {
            background: linear-gradient(135deg, #2a9d8f, #06d6a0);
            color: white;
            animation: celebrate 0.5s ease-in-out;
        }

        .feedback.incorrect {
            background: linear-gradient(135deg, #e63946, #ff6b6b);
            color: white;
            animation: shake 0.5s ease-in-out;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        .progress {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        .progress-dot {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #ddd;
            transition: all 0.3s;
        }

        .progress-dot.active {
            background: #2a9d8f;
            transform: scale(1.2);
        }

        .progress-dot.correct {
            background: #2a9d8f;
        }

        .progress-dot.incorrect {
            background: #e63946;
        }

        .score-board {
            display: flex;
            justify-content: space-around;
            margin: 25px 0;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 20px;
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
            font-size: 2rem;
            color: #1d3557;
            margin-top: 5px;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        button {
            padding: 15px 30px;
            font-size: 1.3rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        #restartBtn {
            background: linear-gradient(135deg, #457b9d, #1d3557);
            color: white;
        }

        #nextBtn {
            background: linear-gradient(135deg, #2a9d8f, #06d6a0);
            color: white;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
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

        @media (max-width: 768px) {
            .numbers-display {
                font-size: 2.5rem;
                padding: 20px;
            }

            .question-mark {
                font-size: 3rem;
                margin: 0 10px;
            }

            .comparison-btn {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎯 من الأكبر؟ - لعبة المقارنة</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'المقارنة بين عددين' }}
        </div>

        <div class="instructions">
            <p>اختر الإشارة الصحيحة للمقارنة بين العددين</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 1 }} إلى {{ $settings->max_range ?? 99 }}</p>
        </div>

        <div class="game-area">
            <div class="numbers-display" id="numbers-display">
                <span id="num1">0</span>
                <span class="question-mark">?</span>
                <span id="num2">0</span>
            </div>

            <div class="comparison-buttons">
                <button class="comparison-btn btn-less" onclick="checkAnswer('<')">
                    &lt;
                </button>
                <button class="comparison-btn btn-equal" onclick="checkAnswer('=')">
                    =
                </button>
                <button class="comparison-btn btn-greater" onclick="checkAnswer('>')">
                    &gt;
                </button>
            </div>

            <div class="feedback" id="feedback">
                اختر الإشارة الصحيحة للمقارنة
            </div>

            <div class="progress" id="progress">
                <!-- سيتم توليد نقاط التقدم ديناميكياً -->
            </div>

            <div class="score-board">
                <div class="score-item">
                    <span>النقاط</span>
                    <div class="score-value" id="score">0</div>
                </div>
                <div class="score-item">
                    <span>السؤال</span>
                    <div class="score-value" id="round">1/10</div>
                </div>
                <div class="score-item">
                    <span>الصحيحة</span>
                    <div class="score-value" id="correct">0</div>
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
            const num1Element = document.getElementById('num1');
            const num2Element = document.getElementById('num2');
            const numbersDisplay = document.getElementById('numbers-display');
            const feedbackElement = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const roundElement = document.getElementById('round');
            const correctElement = document.getElementById('correct');
            const progressElement = document.getElementById('progress');
            const nextBtn = document.getElementById('nextBtn');
            const celebration = document.getElementById('celebration');

            // متغيرات اللعبة
            let currentRound = 1;
            let score = 0;
            let correctAnswers = 0;
            let num1, num2;
            let correctAnswer;
            let gameActive = true;

            // تهيئة نقاط التقدم
            function initializeProgress() {
                progressElement.innerHTML = '';
                for (let i = 0; i < totalRounds; i++) {
                    const dot = document.createElement('div');
                    dot.className = 'progress-dot';
                    if (i === 0) dot.classList.add('active');
                    progressElement.appendChild(dot);
                }
            }

            // توليد سؤال جديد
            function generateQuestion() {
                gameActive = true;
                feedbackElement.textContent = 'اختر الإشارة الصحيحة للمقارنة';
                feedbackElement.className = 'feedback info';
                nextBtn.disabled = true;

                // توليد عددين عشوائيين ضمن المدى المحدد
                num1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                num2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

                // تحديث العرض
                num1Element.textContent = num1;
                num2Element.textContent = num2;

                // تحديث شاشة التقدم
                updateProgress();

                // تحديث شاشة المعلومات
                roundElement.textContent = `${currentRound}/${totalRounds}`;
            }

            // تحديث شاشة التقدم
            function updateProgress() {
                const dots = progressElement.querySelectorAll('.progress-dot');
                dots.forEach((dot, index) => {
                    dot.classList.remove('active');
                    if (index === currentRound - 1) {
                        dot.classList.add('active');
                    }
                });
            }

            // التحقق من الإجابة
            function checkAnswer(choice) {
                if (!gameActive) return;

                gameActive = false;
                nextBtn.disabled = false;

                let isCorrect = false;

                if (choice === '<' && num1 < num2) {
                    isCorrect = true;
                } else if (choice === '>' && num1 > num2) {
                    isCorrect = true;
                } else if (choice === '=' && num1 === num2) {
                    isCorrect = true;
                }

                if (isCorrect) {
                    score += 10;
                    correctAnswers++;
                    feedbackElement.textContent = '🎉 أحسنت! إجابة صحيحة';
                    feedbackElement.className = 'feedback correct';

                    // تحديث النقاط
                    scoreElement.textContent = score;
                    correctElement.textContent = correctAnswers;

                    // تأثير الاحتفال للإجابات المتتالية الصحيحة
                    if (correctAnswers % 3 === 0) {
                        createCelebration();
                    }

                    // تحديث نقطة التقدم
                    const dots = progressElement.querySelectorAll('.progress-dot');
                    if (dots[currentRound - 1]) {
                        dots[currentRound - 1].classList.add('correct');
                    }
                } else {
                    feedbackElement.textContent = `❌ حاول مرة أخرى! ${num1} ${getCorrectSymbol()} ${num2}`;
                    feedbackElement.className = 'feedback incorrect';

                    // تحديث نقطة التقدم
                    const dots = progressElement.querySelectorAll('.progress-dot');
                    if (dots[currentRound - 1]) {
                        dots[currentRound - 1].classList.add('incorrect');
                    }
                }
            }

            // الحصول على الرمز الصحيح
            function getCorrectSymbol() {
                if (num1 < num2) return '<';
                if (num1 > num2) return '>';
                return '=';
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
                numbersDisplay.innerHTML = '🎉 تهانينا! أكملت جميع الأسئلة';
                nextBtn.disabled = true;
                createCelebration();
            }

            // إعادة تشغيل اللعبة
            function restartGame() {
                currentRound = 1;
                score = 0;
                correctAnswers = 0;
                scoreElement.textContent = '0';
                correctElement.textContent = '0';
                roundElement.textContent = '1/10';
                initializeProgress();
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
            initializeProgress();
            generateQuestion();
        });
    </script>
</body>
</html>
