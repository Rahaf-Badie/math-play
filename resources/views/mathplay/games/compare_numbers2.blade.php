<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚖️ مقارنة الأعداد - {{ $lesson_game->lesson->name ?? 'مقارنة الأعداد' }}</title>
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
            max-width: 900px;
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

        .question-display {
            font-size: 2.2rem;
            font-weight: bold;
            color: #e91e63;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 4px solid #e91e63;
            animation: pulse 2s infinite;
        }

        .numbers-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .number-box {
            width: 220px;
            height: 220px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            font-weight: bold;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .number-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: rgba(255, 255, 255, 0.3);
        }

        .number-1 {
            background: linear-gradient(135deg, #ffcc80, #ffb74d);
            color: #bf360c;
            border: 4px solid #ff9800;
        }

        .number-2 {
            background: linear-gradient(135deg, #80deea, #4dd0e1);
            color: #006064;
            border: 4px solid #00bcd4;
        }

        .number-box:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.3);
        }

        .number-box.selected {
            transform: scale(1.1);
            box-shadow: 0 0 0 6px #ff7043, 0 20px 35px rgba(0, 0, 0, 0.3);
            animation: selectedPulse 1s infinite;
        }

        .comparison-options {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .comparison-btn {
            width: 150px;
            height: 150px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 4px solid transparent;
        }

        .btn-greater {
            background: linear-gradient(135deg, #c5e1a5, #aed581);
            color: #33691e;
        }

        .btn-less {
            background: linear-gradient(135deg, #ef9a9a, #e57373);
            color: #b71c1c;
        }

        .btn-equal {
            background: linear-gradient(135deg, #b39ddb, #9575cd);
            color: #4a148c;
        }

        .comparison-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
        }

        .comparison-btn.selected {
            transform: scale(1.1);
            border-color: #ff7043;
            box-shadow: 0 0 0 4px #ff7043, 0 15px 25px rgba(0, 0, 0, 0.3);
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
            background: linear-gradient(135deg, #f44336, #d32f2f);
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
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        @keyframes selectedPulse {
            0% { box-shadow: 0 0 0 6px #ff7043, 0 20px 35px rgba(0, 0, 0, 0.3); }
            50% { box-shadow: 0 0 0 8px #ff7043, 0 20px 35px rgba(0, 0, 0, 0.4); }
            100% { box-shadow: 0 0 0 6px #ff7043, 0 20px 35px rgba(0, 0, 0, 0.3); }
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

        @media (max-width: 768px) {
            .numbers-container {
                gap: 20px;
            }

            .number-box {
                width: 160px;
                height: 160px;
                font-size: 2.5rem;
            }

            .comparison-btn {
                width: 120px;
                height: 120px;
                font-size: 1.5rem;
            }

            .btn-icon {
                font-size: 2rem;
            }

            .question-display {
                font-size: 1.8rem;
                padding: 15px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚖️ مقارنة الأعداد</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'مقارنة الأعداد' }}
        </div>

        <div class="instructions">
            <p>اختر العلاقة الصحيحة بين العددين حسب التعليمات</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 100 }} إلى {{ $settings->max_range ?? 99999 }}</p>
        </div>

        <div class="game-area">
            <div class="question-display" id="question-display">
                جاري التحميل...
            </div>

            <div class="numbers-container">
                <div class="number-box number-1" id="number-1">
                    0
                </div>
                <div class="number-box number-2" id="number-2">
                    0
                </div>
            </div>

            <div class="comparison-options">
                <div class="comparison-btn btn-greater" onclick="selectComparison('greater')">
                    <span class="btn-icon">⬆️</span>
                    <span>أكبر</span>
                </div>

                <div class="comparison-btn btn-less" onclick="selectComparison('less')">
                    <span class="btn-icon">⬇️</span>
                    <span>أصغر</span>
                </div>

                <div class="comparison-btn btn-equal" onclick="selectComparison('equal')">
                    <span class="btn-icon">⚖️</span>
                    <span>متساوي</span>
                </div>
            </div>

            <div class="feedback" id="feedback">
                اختر العلاقة الصحيحة بين العددين
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
            const minRange = {{ $settings->min_range ?? 100 }};
            const maxRange = {{ $settings->max_range ?? 99999 }};
            const totalRounds = 10;

            // عناصر DOM
            const questionDisplay = document.getElementById('question-display');
            const number1Element = document.getElementById('number-1');
            const number2Element = document.getElementById('number-2');
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
            let number1 = 0;
            let number2 = 0;
            let comparisonType = ''; // 'greater', 'less', 'equal'
            let selectedComparison = null;
            let gameActive = true;

            // تحديد الحد الأقصى بناءً على نطاق الأعداد
            function getMaxNumber() {
                if (maxRange <= 999) return 999;
                if (maxRange <= 9999) return 9999;
                return 99999;
            }

            // توليد عدد عشوائي ضمن المدى المحدد
            function generateRandomNumber() {
                return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            }

            // توليد سؤال جديد
            function generateQuestion() {
                gameActive = true;

                // توليد عددين عشوائيين
                number1 = generateRandomNumber();
                number2 = generateRandomNumber();

                // في 20% من الحالات، نجعل الأعداد متساوية
                if (Math.random() < 0.2) {
                    number2 = number1;
                }

                // تحديث عرض الأعداد
                number1Element.textContent = number1.toLocaleString();
                number2Element.textContent = number2.toLocaleString();

                // تحديد نوع المقارنة
                const randomType = Math.random();
                if (randomType < 0.4) {
                    comparisonType = 'greater';
                    questionDisplay.textContent = 'أي عدد هو الأكبر؟';
                } else if (randomType < 0.8) {
                    comparisonType = 'less';
                    questionDisplay.textContent = 'أي عدد هو الأصغر؟';
                } else {
                    comparisonType = 'equal';
                    questionDisplay.textContent = 'هل العددان متساويان؟';
                }

                // إعادة تعيين التحديد
                selectedComparison = null;
                document.querySelectorAll('.comparison-btn').forEach(btn => {
                    btn.classList.remove('selected');
                });

                // تحديث واجهة المستخدم
                feedbackElement.textContent = 'اختر العلاقة الصحيحة بين العددين';
                feedbackElement.className = 'feedback info';
                progressText.textContent = `السؤال ${currentRound} من ${totalRounds}`;
                nextBtn.disabled = true;
            }

            // اختيار نوع المقارنة
            function selectComparison(type) {
                if (!gameActive) return;

                selectedComparison = type;
                document.querySelectorAll('.comparison-btn').forEach(btn => {
                    btn.classList.remove('selected');
                });

                const selectedBtn = document.querySelector(`.btn-${type}`);
                selectedBtn.classList.add('selected');
            }

            // التحقق من الإجابة
            function checkAnswer() {
                if (!gameActive || !selectedComparison) {
                    feedbackElement.textContent = 'يرجى اختيار علاقة المقارنة أولاً!';
                    feedbackElement.className = 'feedback incorrect';
                    return;
                }

                gameActive = false;
                nextBtn.disabled = false;

                let isCorrect = false;
                let correctAnswer = '';

                // تحديد الإجابة الصحيحة بناءً على نوع السؤال
                if (comparisonType === 'greater') {
                    correctAnswer = number1 > number2 ? 'greater' :
                                   number1 < number2 ? 'less' : 'equal';
                    isCorrect = selectedComparison === correctAnswer;
                } else if (comparisonType === 'less') {
                    correctAnswer = number1 < number2 ? 'less' :
                                   number1 > number2 ? 'greater' : 'equal';
                    isCorrect = selectedComparison === correctAnswer;
                } else { // equal
                    correctAnswer = number1 === number2 ? 'equal' :
                                   number1 > number2 ? 'greater' : 'less';
                    isCorrect = selectedComparison === correctAnswer;
                }

                if (isCorrect) {
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
                } else {
                    feedbackElement.innerHTML = `
                        ❌ ليس صحيحاً!<br>
                        <small>الإجابة الصحيحة: ${getComparisonText(correctAnswer)}</small>
                    `;
                    feedbackElement.className = 'feedback incorrect';
                    currentStreak = 0;
                    streakElement.textContent = '0';
                }
            }

            // الحصول على نص المقارنة
            function getComparisonText(type) {
                switch(type) {
                    case 'greater': return 'أكبر';
                    case 'less': return 'أصغر';
                    case 'equal': return 'متساوي';
                    default: return '';
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
                questionDisplay.textContent = '🎉 تهانينا! أكملت جميع الأسئلة';
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
            window.selectComparison = selectComparison;
            window.checkAnswer = checkAnswer;
            window.nextQuestion = nextQuestion;
            window.restartGame = restartGame;

            // تهيئة اللعبة
            generateQuestion();
        });
    </script>
</body>
</html>
