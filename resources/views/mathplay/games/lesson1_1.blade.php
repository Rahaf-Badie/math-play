<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎨 تحديد نوع الخط - {{ $lesson_game->lesson->name ?? 'الخط المستقيم والمنحني' }}</title>
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
            color: #4a6fa5;
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

        .line-display-container {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 20px;
            padding: 30px;
            margin: 30px 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 4px solid #4a6fa5;
            min-height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .line-display {
            width: 100%;
            height: 200px;
        }

        .options-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .option-btn {
            width: 200px;
            height: 120px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 4px solid transparent;
        }

        .btn-straight {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
        }

        .btn-curved {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
        }

        .option-btn:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .option-btn:active {
            transform: translateY(-2px) scale(1.02);
        }

        .option-btn.selected {
            border-color: #e91e63;
            box-shadow: 0 0 0 4px #e91e63, 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .btn-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
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
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
            animation: shake 0.5s ease-in-out;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
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
            color: #4a6fa5;
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

        #checkBtn {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
        }

        #nextBtn {
            background: linear-gradient(135deg, #4a6fa5, #3a5a80);
            color: white;
        }

        #restartBtn {
            background: linear-gradient(135deg, #ff9800, #f57c00);
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

        .line-examples {
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.1rem;
            color: #2d3436;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .options-container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .option-btn {
                width: 100%;
                max-width: 250px;
                height: 100px;
            }

            .line-display-container {
                padding: 20px;
                min-height: 200px;
            }

            .line-display {
                height: 150px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎨 تحديد نوع الخط</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'الخط المستقيم والمنحني' }}
        </div>

        <div class="instructions">
            <p>اختر نوع الخط المعروض أمامك: مستقيم أم منحني؟</p>
            <p><strong>الهدف:</strong> تمييز أنواع الخطوط المختلفة</p>
        </div>

        <div class="line-examples">
            💡 <strong>تلميح:</strong> الخط المستقيم لا يتغير اتجاهه، بينما الخط المنحني يتغير اتجاهه بشكل متواصل
        </div>

        <div class="game-area">
            <div class="line-display-container">
                <svg class="line-display" id="line-display" viewBox="0 0 400 200" preserveAspectRatio="xMidYMid meet">
                    <!-- سيتم توليد الخط هنا -->
                </svg>
            </div>

            <div class="options-container">
                <div class="option-btn btn-straight" onclick="selectOption('straight')">
                    <span class="btn-icon">📏</span>
                    <span>مستقيم</span>
                </div>

                <div class="option-btn btn-curved" onclick="selectOption('curved')">
                    <span class="btn-icon">〰️</span>
                    <span>منحني</span>
                </div>
            </div>

            <div class="feedback" id="feedback">
                اختر نوع الخط المعروض
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
                    <span>التتابع الحالي</span>
                    <div class="score-value" id="streak">0</div>
                </div>
            </div>
        </div>

        <div class="controls">
            <button id="checkBtn" onclick="checkAnswer()">✔ تحقق من الإجابة</button>
            <button id="nextBtn" onclick="nextQuestion()">➡️ سؤال تالي</button>
            <button id="restartBtn" onclick="restartGame()">🔁 إعادة اللعبة</button>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // قراءة الإعدادات من Blade
            const totalRounds = 10;

            // عناصر DOM
            const lineDisplay = document.getElementById('line-display');
            const feedbackElement = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const correctElement = document.getElementById('correct');
            const streakElement = document.getElementById('streak');
            const progressText = document.getElementById('progress-text');
            const nextBtn = document.getElementById('nextBtn');
            const celebration = document.getElementById('celebration');

            // متغيرات اللعبة
            let currentRound = 1;
            let score = 0;
            let correctAnswers = 0;
            let currentStreak = 0;
            let bestStreak = 0;
            let currentLineType = ''; // 'straight' أو 'curved'
            let selectedOption = null;
            let gameActive = true;

            // توليد خط عشوائي
            function generateRandomLine() {
                lineDisplay.innerHTML = '';

                const isStraight = Math.random() < 0.5;
                currentLineType = isStraight ? 'straight' : 'curved';

                if (isStraight) {
                    // توليد خط مستقيم
                    generateStraightLine();
                } else {
                    // توليد خط منحني
                    generateCurvedLine();
                }
            }

            // توليد خط مستقيم
            function generateStraightLine() {
                const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');

                // إعدادات الخط المستقيم
                line.setAttribute('x1', '50');
                line.setAttribute('y1', '100');
                line.setAttribute('x2', '350');
                line.setAttribute('y2', '100');
                line.setAttribute('stroke', '#4a6fa5');
                line.setAttribute('stroke-width', '8');
                line.setAttribute('stroke-linecap', 'round');

                lineDisplay.appendChild(line);
            }

            // توليد خط منحني
            function generateCurvedLine() {
                const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');

                // أنواع مختلفة من الخطوط المنحنية
                const curveTypes = [
                    // منحني بسيط
                    'M 50 100 Q 200 50 350 100',
                    // منحني متموج
                    'M 50 100 C 100 50, 150 150, 200 100 C 250 50, 300 150, 350 100',
                    // منحني حلزوني بسيط
                    'M 50 100 C 100 50, 150 150, 200 100 S 300 50, 350 100',
                    // منحني متعدد التموجات
                    'M 50 100 C 120 50, 150 150, 220 100 C 280 50, 300 150, 350 100'
                ];

                const randomCurve = curveTypes[Math.floor(Math.random() * curveTypes.length)];

                path.setAttribute('d', randomCurve);
                path.setAttribute('stroke', '#ff9800');
                path.setAttribute('stroke-width', '8');
                path.setAttribute('fill', 'none');
                path.setAttribute('stroke-linecap', 'round');

                lineDisplay.appendChild(path);
            }

            // توليد سؤال جديد
            function generateQuestion() {
                gameActive = true;
                generateRandomLine();

                // إعادة تعيين التحديد
                selectedOption = null;
                document.querySelectorAll('.option-btn').forEach(btn => {
                    btn.classList.remove('selected');
                });

                // تحديث واجهة المستخدم
                feedbackElement.textContent = 'اختر نوع الخط المعروض';
                feedbackElement.className = 'feedback info';
                progressText.textContent = `السؤال ${currentRound} من ${totalRounds}`;
                nextBtn.disabled = true;
            }

            // اختيار نوع الخط
            function selectOption(type) {
                if (!gameActive) return;

                selectedOption = type;
                document.querySelectorAll('.option-btn').forEach(btn => {
                    btn.classList.remove('selected');
                });

                const selectedBtn = document.querySelector(`.btn-${type}`);
                selectedBtn.classList.add('selected');
            }

            // التحقق من الإجابة
            function checkAnswer() {
                if (!gameActive || !selectedOption) {
                    feedbackElement.textContent = 'يرجى اختيار نوع الخط أولاً!';
                    feedbackElement.className = 'feedback incorrect';
                    return;
                }

                gameActive = false;
                nextBtn.disabled = false;

                const isCorrect = selectedOption === currentLineType;

                if (isCorrect) {
                    score += 10;
                    correctAnswers++;
                    currentStreak++;

                    if (currentStreak > bestStreak) {
                        bestStreak = currentStreak;
                    }

                    feedbackElement.textContent = '🎉 أحسنت! الإجابة صحيحة';
                    feedbackElement.className = 'feedback correct';

                    // تحديث النقاط والمؤشرات
                    scoreElement.textContent = score;
                    correctElement.textContent = correctAnswers;
                    streakElement.textContent = currentStreak;

                    // تأثير احتفال للتتابعات العالية
                    if (currentStreak >= 3) {
                        createCelebration();
                    }
                } else {
                    const correctAnswer = currentLineType === 'straight' ? 'مستقيم' : 'منحني';
                    feedbackElement.innerHTML = `
                        ❌ ليس صحيحاً!<br>
                        <small>الإجابة الصحيحة: ${correctAnswer}</small>
                    `;
                    feedbackElement.className = 'feedback incorrect';
                    currentStreak = 0;
                    streakElement.textContent = '0';
                }
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
                lineDisplay.innerHTML = '<text x="200" y="100" text-anchor="middle" font-size="24" fill="#4a6fa5">🎉 تهانينا!</text>';
                nextBtn.disabled = true;

                createCelebration();
            }

            // إعادة تشغيل اللعبة
            function restartGame() {
                currentRound = 1;
                score = 0;
                correctAnswers = 0;
                currentStreak = 0;
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

            // جعل الدوال متاحة عالمياً
            window.selectOption = selectOption;
            window.checkAnswer = checkAnswer;
            window.nextQuestion = nextQuestion;
            window.restartGame = restartGame;

            // تهيئة اللعبة
            generateQuestion();
        });
    </script>
</body>
</html>
