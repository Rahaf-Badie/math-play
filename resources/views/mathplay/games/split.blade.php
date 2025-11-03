<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔍 تفكيك القيمة المنزلية - {{ $lesson_game->lesson->name ?? 'درس القيمة المنزلية' }}</title>
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
            font-size: 3.5rem;
            font-weight: bold;
            color: #e91e63;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
            border: 4px solid #e91e63;
            animation: pulse 2s infinite;
        }

        .place-value-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .place-value {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 220px;
        }

        .place-value h3 {
            color: #4a6fa5;
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .place-box {
            width: 100%;
            min-height: 200px;
            background: linear-gradient(135deg, #e6f2ff, #bbdefb);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .place-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .hundreds .place-box {
            border-color: #ffab91;
        }

        .tens .place-box {
            border-color: #80deea;
        }

        .ones .place-box {
            border-color: #c5e1a5;
        }

        .value-display {
            font-size: 3rem;
            font-weight: bold;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .hundreds .value-display {
            color: #bf360c;
            border: 4px solid #ffab91;
            background: linear-gradient(135deg, #fff, #ffe0b2);
        }

        .tens .value-display {
            color: #006064;
            border: 4px solid #80deea;
            background: linear-gradient(135deg, #fff, #e0f2f1);
        }

        .ones .value-display {
            color: #33691e;
            border: 4px solid #c5e1a5;
            background: linear-gradient(135deg, #fff, #f1f8e9);
        }

        .visual-representation {
            margin: 15px 0;
            min-height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .visual-item {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: inline-block;
        }

        .hundreds .visual-item {
            background: #ffab91;
            border: 2px solid #bf360c;
        }

        .tens .visual-item {
            background: #80deea;
            border: 2px solid #006064;
        }

        .ones .visual-item {
            background: #c5e1a5;
            border: 2px solid #33691e;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .control-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .plus-btn {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
        }

        .minus-btn {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
        }

        .control-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .control-btn:active {
            transform: scale(0.95);
        }

        .control-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .current-number {
            margin: 30px 0;
        }

        .current-number-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #4a6fa5;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: 3px solid #4a6fa5;
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

        #resetBtn {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
        }

        #nextBtn {
            background: linear-gradient(135deg, #4a6fa5, #3a5a80);
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

        @media (max-width: 768px) {
            .place-value-container {
                flex-direction: column;
                align-items: center;
                gap: 25px;
            }

            .place-value {
                width: 100%;
                max-width: 300px;
            }

            .target-number {
                font-size: 2.5rem;
                padding: 20px;
            }

            .current-number-display {
                font-size: 2rem;
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
        <h1>🔍 تفكيك القيمة المنزلية</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'القيمة المنزلية للأعداد ضمن 999' }}
        </div>

        <div class="instructions">
            <p>اضبط المئات والعشرات والآحاد لتكوين العدد المستهدف</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 100 }} إلى {{ $settings->max_range ?? 999 }}</p>
        </div>

        <div class="game-area">
            <div class="target-number" id="target-number">
                العدد المستهدف: <span id="target-value">0</span>
            </div>

            <div class="place-value-container">
                <div class="place-value hundreds">
                    <h3>🎯 المئات</h3>
                    <div class="place-box">
                        <div class="value-display" id="hundreds-value">0</div>
                        <div class="visual-representation" id="hundreds-visual"></div>
                        <div class="controls">
                            <button class="control-btn minus-btn" id="hundreds-minus">-</button>
                            <button class="control-btn plus-btn" id="hundreds-plus">+</button>
                        </div>
                    </div>
                </div>

                <div class="place-value tens">
                    <h3>🔢 العشرات</h3>
                    <div class="place-box">
                        <div class="value-display" id="tens-value">0</div>
                        <div class="visual-representation" id="tens-visual"></div>
                        <div class="controls">
                            <button class="control-btn minus-btn" id="tens-minus">-</button>
                            <button class="control-btn plus-btn" id="tens-plus">+</button>
                        </div>
                    </div>
                </div>

                <div class="place-value ones">
                    <h3>📊 الآحاد</h3>
                    <div class="place-box">
                        <div class="value-display" id="ones-value">0</div>
                        <div class="visual-representation" id="ones-visual"></div>
                        <div class="controls">
                            <button class="control-btn minus-btn" id="ones-minus">-</button>
                            <button class="control-btn plus-btn" id="ones-plus">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="current-number">
                <div class="current-number-display" id="current-number">
                    العدد الحالي: <span id="current-value">0</span>
                </div>
            </div>

            <div class="feedback" id="feedback">
                اضبط القيم لتكوين العدد المستهدف
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
            <button id="resetBtn" onclick="resetValues()">🔄 إعادة تعيين</button>
            <button id="nextBtn" onclick="nextQuestion()">➡️ سؤال تالي</button>
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
            const targetValueElement = document.getElementById('target-value');
            const hundredsValueElement = document.getElementById('hundreds-value');
            const tensValueElement = document.getElementById('tens-value');
            const onesValueElement = document.getElementById('ones-value');
            const hundredsVisualElement = document.getElementById('hundreds-visual');
            const tensVisualElement = document.getElementById('tens-visual');
            const onesVisualElement = document.getElementById('ones-visual');
            const currentValueElement = document.getElementById('current-value');
            const feedbackElement = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const correctElement = document.getElementById('correct');
            const streakElement = document.getElementById('streak');
            const progressText = document.getElementById('progress-text');
            const nextBtn = document.getElementById('nextBtn');
            const celebration = document.getElementById('celebration');

            // عناصر التحكم
            const hundredsPlus = document.getElementById('hundreds-plus');
            const hundredsMinus = document.getElementById('hundreds-minus');
            const tensPlus = document.getElementById('tens-plus');
            const tensMinus = document.getElementById('tens-minus');
            const onesPlus = document.getElementById('ones-plus');
            const onesMinus = document.getElementById('ones-minus');

            // متغيرات اللعبة
            let currentRound = 1;
            let score = 0;
            let correctAnswers = 0;
            let currentStreak = 0;
            let bestStreak = 0;
            let targetNumber = 0;
            let hundreds = 0;
            let tens = 0;
            let ones = 0;

            // توليد عدد عشوائي ضمن المدى المحدد
            function generateRandomNumber() {
                return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            }

            // توليد سؤال جديد
            function generateQuestion() {
                targetNumber = generateRandomNumber();
                targetValueElement.textContent = targetNumber.toLocaleString();

                // إعادة تعيين القيم
                hundreds = 0;
                tens = 0;
                ones = 0;
                updateDisplay();

                // تحديث واجهة المستخدم
                feedbackElement.textContent = 'اضبط القيم لتكوين العدد المستهدف';
                feedbackElement.className = 'feedback info';
                progressText.textContent = `السؤال ${currentRound} من ${totalRounds}`;
                nextBtn.disabled = true;
            }

            // تحديث العرض
            function updateDisplay() {
                // تحديث القيم الرقمية
                hundredsValueElement.textContent = hundreds;
                tensValueElement.textContent = tens;
                onesValueElement.textContent = ones;

                // تحديث التمثيل البصري
                updateVisualRepresentation(hundredsVisualElement, hundreds, 'hundreds');
                updateVisualRepresentation(tensVisualElement, tens, 'tens');
                updateVisualRepresentation(onesVisualElement, ones, 'ones');

                // تحديث العدد الحالي
                const currentNumber = (hundreds * 100) + (tens * 10) + ones;
                currentValueElement.textContent = currentNumber.toLocaleString();

                // تحديث حالة أزرار التحكم
                updateControlButtons();
            }

            // تحديث التمثيل البصري
            function updateVisualRepresentation(element, value, type) {
                element.innerHTML = '';

                if (value === 0) {
                    element.innerHTML = '<span style="color: #999; font-size: 0.9rem;">لا توجد</span>';
                    return;
                }

                // للمئات: عرض مجموعات من 10
                if (type === 'hundreds') {
                    for (let i = 0; i < value; i++) {
                        const group = document.createElement('div');
                        group.style.display = 'flex';
                        group.style.flexWrap = 'wrap';
                        group.style.justifyContent = 'center';
                        group.style.gap = '2px';
                        group.style.marginBottom = '5px';

                        for (let j = 0; j < 10; j++) {
                            const item = document.createElement('div');
                            item.className = 'visual-item';
                            group.appendChild(item);
                        }

                        element.appendChild(group);
                    }
                } else {
                    // للعشرات والآحاد: عرض نقاط فردية
                    for (let i = 0; i < value; i++) {
                        const item = document.createElement('div');
                        item.className = 'visual-item';
                        element.appendChild(item);
                    }
                }
            }

            // تحديث حالة أزرار التحكم
            function updateControlButtons() {
                hundredsPlus.disabled = hundreds >= 9;
                hundredsMinus.disabled = hundreds <= 0;
                tensPlus.disabled = tens >= 9;
                tensMinus.disabled = tens <= 0;
                onesPlus.disabled = ones >= 9;
                onesMinus.disabled = ones <= 0;
            }

            // التحقق من الإجابة
            function checkAnswer() {
                const currentNumber = (hundreds * 100) + (tens * 10) + ones;

                if (currentNumber === targetNumber) {
                    score += 10;
                    correctAnswers++;
                    currentStreak++;

                    if (currentStreak > bestStreak) {
                        bestStreak = currentStreak;
                    }

                    feedbackElement.textContent = '🎉 أحسنت! العدد صحيح تماماً';
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
                    feedbackElement.textContent = '❌ ليس صحيحاً! حاول مرة أخرى';
                    feedbackElement.className = 'feedback incorrect';
                    currentStreak = 0;
                    streakElement.textContent = '0';
                }
            }

            // إعادة تعيين القيم
            function resetValues() {
                hundreds = 0;
                tens = 0;
                ones = 0;
                updateDisplay();
                feedbackElement.textContent = 'تم إعادة تعيين القيم';
                feedbackElement.className = 'feedback info';
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
                targetValueElement.textContent = '🎉 تهانينا!';
                nextBtn.disabled = true;

                createCelebration();
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

            // إضافة معالجات الأحداث لأزرار التحكم
            hundredsPlus.addEventListener('click', function() {
                if (hundreds < 9) {
                    hundreds++;
                    updateDisplay();
                }
            });

            hundredsMinus.addEventListener('click', function() {
                if (hundreds > 0) {
                    hundreds--;
                    updateDisplay();
                }
            });

            tensPlus.addEventListener('click', function() {
                if (tens < 9) {
                    tens++;
                    updateDisplay();
                }
            });

            tensMinus.addEventListener('click', function() {
                if (tens > 0) {
                    tens--;
                    updateDisplay();
                }
            });

            onesPlus.addEventListener('click', function() {
                if (ones < 9) {
                    ones++;
                    updateDisplay();
                }
            });

            onesMinus.addEventListener('click', function() {
                if (ones > 0) {
                    ones--;
                    updateDisplay();
                }
            });

            // جعل الدوال متاحة عالمياً
            window.checkAnswer = checkAnswer;
            window.resetValues = resetValues;
            window.nextQuestion = nextQuestion;

            // تهيئة اللعبة
            generateQuestion();
        });
    </script>
</body>
</html>
