<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✏️ اكتب القيمة المنزلية - {{ $lesson_game->lesson->name ?? 'درس القيمة المنزلية' }}</title>
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
            max-width: 1000px;
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

        .target-number {
            font-size: 4rem;
            font-weight: bold;
            color: #e91e63;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
            border: 4px solid #e91e63;
            animation: pulse 2s infinite;
            letter-spacing: 15px;
            direction: ltr;
        }

        .digits-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .digit-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 200px;
        }

        .place-label {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4a6fa5;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            padding: 10px 20px;
            border-radius: 15px;
            width: 100%;
        }

        .digit-display {
            width: 100px;
            height: 100px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .hundreds-digit {
            background: linear-gradient(135deg, #ffcc80, #ffb74d);
            color: #bf360c;
            border: 4px solid #ff9800;
        }

        .tens-digit {
            background: linear-gradient(135deg, #80deea, #4dd0e1);
            color: #006064;
            border: 4px solid #00bcd4;
        }

        .ones-digit {
            background: linear-gradient(135deg, #c5e1a5, #aed581);
            color: #33691e;
            border: 4px solid #8bc34a;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            width: 100%;
        }

        .value-input {
            width: 150px;
            height: 70px;
            border: 4px solid #4a6fa5;
            border-radius: 15px;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            direction: ltr;
        }

        .value-input:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 4px rgba(233, 30, 99, 0.3);
            transform: scale(1.05);
        }

        .value-input.correct {
            border-color: #4caf50;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
        }

        .value-input.incorrect {
            border-color: #f44336;
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #d32f2f;
        }

        .expected-value {
            font-size: 1.1rem;
            color: #666;
            min-height: 25px;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.8);
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

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
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

        .visual-guide {
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            padding: 15px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.1rem;
            color: #2d3436;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .digits-container {
                flex-direction: column;
                align-items: center;
                gap: 25px;
            }

            .digit-box {
                width: 100%;
                max-width: 300px;
            }

            .target-number {
                font-size: 3rem;
                padding: 20px;
                letter-spacing: 10px;
            }

            .digit-display {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }

            .value-input {
                width: 120px;
                height: 60px;
                font-size: 1.8rem;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ اكتب القيمة المنزلية</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'القيمة المنزلية للأعداد ضمن 999' }}
        </div>

        <div class="instructions">
            <p>اكتب قيمة كل رقم حسب منزلته في العدد</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 100 }} إلى {{ $settings->max_range ?? 999 }}</p>
        </div>

        <div class="visual-guide">
            💡 <strong>تلميح:</strong> قيمة الرقم = الرقم × قيمة المنزلة (مئات = ×100, عشرات = ×10, آحاد = ×1)
        </div>

        <div class="game-area">
            <div class="target-number" id="target-number">
                <span id="target-digits">0 0 0</span>
            </div>

            <div class="digits-container">
                <div class="digit-box">
                    <div class="place-label">🎯 رقم المئات</div>
                    <div class="digit-display hundreds-digit" id="hundreds-digit">0</div>
                    <div class="input-container">
                        <input type="number" class="value-input" id="hundreds-input" placeholder="0" min="0" max="900" step="100">
                        <div class="expected-value" id="hundreds-expected"></div>
                    </div>
                </div>

                <div class="digit-box">
                    <div class="place-label">🔢 رقم العشرات</div>
                    <div class="digit-display tens-digit" id="tens-digit">0</div>
                    <div class="input-container">
                        <input type="number" class="value-input" id="tens-input" placeholder="0" min="0" max="90" step="10">
                        <div class="expected-value" id="tens-expected"></div>
                    </div>
                </div>

                <div class="digit-box">
                    <div class="place-label">📊 رقم الآحاد</div>
                    <div class="digit-display ones-digit" id="ones-digit">0</div>
                    <div class="input-container">
                        <input type="number" class="value-input" id="ones-input" placeholder="0" min="0" max="9">
                        <div class="expected-value" id="ones-expected"></div>
                    </div>
                </div>
            </div>

            <div class="feedback" id="feedback">
                اكتب قيمة كل رقم في مكانه الصحيح
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
            const maxRange = {{ $settings->max_range ?? 999 }};
            const totalRounds = 10;

            // عناصر DOM
            const targetDigitsElement = document.getElementById('target-digits');
            const hundredsDigitElement = document.getElementById('hundreds-digit');
            const tensDigitElement = document.getElementById('tens-digit');
            const onesDigitElement = document.getElementById('ones-digit');
            const hundredsInput = document.getElementById('hundreds-input');
            const tensInput = document.getElementById('tens-input');
            const onesInput = document.getElementById('ones-input');
            const hundredsExpected = document.getElementById('hundreds-expected');
            const tensExpected = document.getElementById('tens-expected');
            const onesExpected = document.getElementById('ones-expected');
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
            let targetNumber = 0;
            let hundredsDigit = 0;
            let tensDigit = 0;
            let onesDigit = 0;
            let correctHundreds = 0;
            let correctTens = 0;
            let correctOnes = 0;

            // توليد عدد عشوائي ضمن المدى المحدد
            function generateRandomNumber() {
                return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            }

            // توليد سؤال جديد
            function generateQuestion() {
                targetNumber = generateRandomNumber();

                // تفكيك العدد إلى أرقام
                hundredsDigit = Math.floor(targetNumber / 100);
                tensDigit = Math.floor((targetNumber % 100) / 10);
                onesDigit = targetNumber % 10;

                // حساب القيم الصحيحة
                correctHundreds = hundredsDigit * 100;
                correctTens = tensDigit * 10;
                correctOnes = onesDigit;

                // تحديث العرض
                targetDigitsElement.textContent = `${hundredsDigit} ${tensDigit} ${onesDigit}`;
                hundredsDigitElement.textContent = hundredsDigit;
                tensDigitElement.textContent = tensDigit;
                onesDigitElement.textContent = onesDigit;

                // إعادة تعيين الحقول
                resetInputs();

                // تحديث واجهة المستخدم
                feedbackElement.textContent = 'اكتب قيمة كل رقم في مكانه الصحيح';
                feedbackElement.className = 'feedback info';
                progressText.textContent = `السؤال ${currentRound} من ${totalRounds}`;
                nextBtn.disabled = true;

                // تركيز على أول حقل إدخال
                setTimeout(() => hundredsInput.focus(), 500);
            }

            // إعادة تعيين حقول الإدخال
            function resetInputs() {
                hundredsInput.value = '';
                tensInput.value = '';
                onesInput.value = '';
                hundredsInput.className = 'value-input';
                tensInput.className = 'value-input';
                onesInput.className = 'value-input';
                hundredsExpected.textContent = '';
                tensExpected.textContent = '';
                onesExpected.textContent = '';
            }

            // التحقق من الإجابة
            function checkAnswer() {
                const hundredsValue = parseInt(hundredsInput.value) || 0;
                const tensValue = parseInt(tensInput.value) || 0;
                const onesValue = parseInt(onesInput.value) || 0;

                let allCorrect = true;
                let correctCount = 0;

                // التحقق من المئات
                if (hundredsValue === correctHundreds) {
                    hundredsInput.className = 'value-input correct';
                    correctCount++;
                } else {
                    hundredsInput.className = 'value-input incorrect';
                    hundredsExpected.textContent = `القيمة الصحيحة: ${correctHundreds}`;
                    allCorrect = false;
                }

                // التحقق من العشرات
                if (tensValue === correctTens) {
                    tensInput.className = 'value-input correct';
                    correctCount++;
                } else {
                    tensInput.className = 'value-input incorrect';
                    tensExpected.textContent = `القيمة الصحيحة: ${correctTens}`;
                    allCorrect = false;
                }

                // التحقق من الآحاد
                if (onesValue === correctOnes) {
                    onesInput.className = 'value-input correct';
                    correctCount++;
                } else {
                    onesInput.className = 'value-input incorrect';
                    onesExpected.textContent = `القيمة الصحيحة: ${correctOnes}`;
                    allCorrect = false;
                }

                if (allCorrect) {
                    score += 10;
                    correctAnswers++;
                    currentStreak++;

                    if (currentStreak > bestStreak) {
                        bestStreak = currentStreak;
                    }

                    feedbackElement.textContent = '🎉 أحسنت! جميع الإجابات صحيحة';
                    feedbackElement.className = 'feedback correct';

                    // تحديث النقاط والمؤشرات
                    scoreElement.textContent = score;
                    correctElement.textContent = correctAnswers;
                    streakElement.textContent = currentStreak;

                    // تأثير احتفال للتتابعات العالية
                    if (currentStreak >= 3) {
                        createCelebration();
                    }

                    nextBtn.disabled = false;
                } else {
                    feedbackElement.innerHTML = `
                        ❌ ${correctCount}/3 إجابات صحيحة<br>
                        <small>حاول مرة أخرى لتحصل على جميع الإجابات الصحيحة</small>
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
                    <strong>النقاط النهائية: ${score}</strong><br>
                    <small>${correctAnswers} من ${totalRounds} إجابات صحيحة</small>
                `;
                feedbackElement.className = 'feedback correct';
                targetDigitsElement.textContent = '🎉 تهانينا!';
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
                const colors = ['#ff6b6b', '#ffa726', '#ffeb3b', '#4caf50, #2196f3', '#9c27b0'];

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

            // السماح بالتحقق بالضغط على Enter
            [hundredsInput, tensInput, onesInput].forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        checkAnswer();
                    }
                });
            });

            // التنقل بين الحقول باستخدام Tab و Shift+Tab
            [hundredsInput, tensInput, onesInput].forEach((input, index, array) => {
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Tab') {
                        e.preventDefault();
                        const nextIndex = e.shiftKey ?
                            (index - 1 + array.length) % array.length :
                            (index + 1) % array.length;
                        array[nextIndex].focus();
                    }
                });
            });

            // جعل الدوال متاحة عالمياً
            window.checkAnswer = checkAnswer;
            window.nextQuestion = nextQuestion;
            window.restartGame = restartGame;

            // تهيئة اللعبة
            generateQuestion();
        });
    </script>
</body>
</html>
