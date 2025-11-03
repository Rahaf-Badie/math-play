<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة جدول الضرب للعدد 5 - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tahoma", sans-serif;
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
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
            max-width: 700px;
        }

        .lesson-info {
            background: linear-gradient(to right, #00cec9, #81ecec);
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
            border-right: 5px solid #00cec9;
            text-align: right;
            line-height: 1.6;
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.1rem;
        }

        .pattern-highlight {
            background: linear-gradient(135deg, #fdcb6e, #e17055);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            margin: 10px 0;
            font-size: 1.1rem;
            font-weight: bold;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .game-area {
            padding: 25px;
            background: #f1f2f6;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #dfe6e9;
        }

        .question-display {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 20px 0;
            color: #00cec9;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .visual-representation {
            margin: 25px 0;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            min-height: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .hands-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin: 20px 0;
        }

        .hand {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            background: rgba(116, 185, 255, 0.1);
            border-radius: 15px;
            border: 2px solid #74b9ff;
            position: relative;
        }

        .hand-label {
            font-size: 1rem;
            color: #0984e3;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .fingers-container {
            display: flex;
            gap: 8px;
        }

        .finger {
            width: 30px;
            height: 40px;
            background: linear-gradient(135deg, #fd79a8, #e84393);
            border-radius: 15px 15px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
            animation: popIn 0.5s ease-out;
            position: relative;
        }

        .finger::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 10px;
            background: #e84393;
            border-radius: 50%;
        }

        .finger.active {
            background: linear-gradient(135deg, #00b894, #00a085);
            transform: scale(1.1);
        }

        .finger.active::after {
            background: #00a085;
        }

        @keyframes popIn {
            0% { transform: scale(0) rotate(-10deg); opacity: 0; }
            70% { transform: scale(1.1) rotate(5deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }

        .pattern-display {
            font-size: 1.4rem;
            margin: 20px 0;
            color: #0984e3;
            background: rgba(9, 132, 227, 0.1);
            padding: 15px;
            border-radius: 15px;
            font-weight: bold;
        }

        .pattern-item {
            display: inline-block;
            margin: 0 5px;
            padding: 5px 10px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .pattern-item.current {
            background: #00cec9;
            color: white;
            transform: scale(1.2);
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
            border: 3px solid #00cec9;
            text-align: center;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .answer-input:focus {
            outline: none;
            border-color: #fd79a8;
            box-shadow: 0 0 0 3px rgba(253, 121, 168, 0.3);
            transform: scale(1.05);
        }

        .submit-btn {
            background: linear-gradient(135deg, #fd79a8, #e84393);
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

        .timer-container {
            background: linear-gradient(135deg, #fdcb6e, #e17055);
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

        .explanation-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
        }

        .explanation-text {
            font-size: 1.2rem;
            line-height: 1.8;
            text-align: right;
            color: #2d3436;
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
            background: rgba(0, 206, 201, 0.2);
            color: #00cec9;
            border: 2px solid #00cec9;
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

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .game-title {
                font-size: 2rem;
            }

            .question-display {
                font-size: 2rem;
            }

            .hands-container {
                gap: 15px;
            }

            .hand {
                padding: 10px;
            }

            .finger {
                width: 25px;
                height: 35px;
                font-size: 0.8rem;
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
            الدرس: {{ $lesson_game->lesson->name }} | جدول الضرب للعدد 5
        </div>

        <h1 class="game-title">🎮 جدول الضرب للعدد 5</h1>

        <div class="instructions">
            <p>🎯 الهدف: حفظ وإتقان جدول الضرب للعدد 5</p>
            <p>💡 تلميح سحري: الناتج ينتهي دائماً بـ 0 أو 5!</p>
            <p>✋ يمكنك استخدام أصابع اليدين للعد: كل يد = 5 أصابع</p>
        </div>

        <div class="pattern-highlight">
            النمط السحري: 5, 10, 15, 20, 25, 30, 35, 40, 45, 50
        </div>

        <div class="game-area">
            <div class="question-display" id="question-display">
                <!-- السؤال سيظهر هنا -->
            </div>

            <div class="visual-representation" id="visual-representation">
                <!-- التمثيل البصري سيظهر هنا -->
            </div>

            <div class="pattern-display" id="pattern-display">
                <!-- النمط سيظهر هنا -->
            </div>

            <div class="input-container">
                <input type="number" class="answer-input" id="answer-input" placeholder="الإجابة">
                <button class="submit-btn" onclick="checkAnswer()">
                    ✓ تحقق
                </button>
            </div>

            <div class="timer-container" id="timer-container">
                ⏱️ الوقت المتبقي: <span id="timer">20</span> ثانية
            </div>

            <div class="explanation-box" id="explanation-box">
                <h3>💡 أسرار جدول الضرب للعدد 5:</h3>
                <div class="explanation-text" id="explanation-text">
                    <!-- الشرح سيظهر هنا -->
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
            استخدم النمط السحري: الناتج ينتهي دائماً بـ 0 أو 5!
        </div>

        <div class="controls">
            <button class="control-btn" id="help-btn" onclick="showExplanation()">
                💡 أسرار
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
        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let correctAnswer = 0;
        let currentMultiplier = 0;
        let gameActive = false;
        let timerInterval;
        let timeLeft = 20;
        let currentStreak = 0;
        let bestStreak = 0;
        let usedMultipliers = [];

        // جدول الضرب للعدد 5
        const multiplicationTable5 = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50];

        // عناصر DOM
        const questionDisplay = document.getElementById("question-display");
        const visualRepresentation = document.getElementById("visual-representation");
        const patternDisplay = document.getElementById("pattern-display");
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
        const explanationBox = document.getElementById("explanation-box");
        const explanationText = document.getElementById("explanation-text");
        const celebrationDiv = document.getElementById("celebration");

        // بدء اللعبة
        function startGame() {
            if (gameActive) return;

            gameActive = true;
            score = 0;
            questionCount = 0;
            currentStreak = 0;
            usedMultipliers = [];

            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;
            updateProgress();

            startBtn.style.display = 'none';
            restartBtn.style.display = 'none';
            helpBtn.style.display = 'inline-block';

            messageDisplay.textContent = "استخدم النمط السحري: الناتج ينتهي دائماً بـ 0 أو 5!";
            messageDisplay.className = 'message-info';

            generateQuestion();
        }

        // توليد سؤال جديد
        function generateQuestion() {
            // توليد مضروب جديد لم يتم استخدامه
            let multiplier;
            do {
                multiplier = Math.floor(Math.random() * 10) + 1;
            } while (usedMultipliers.includes(multiplier) && usedMultipliers.length < 10);

            if (usedMultipliers.length >= 10) {
                usedMultipliers = [];
            }

            usedMultipliers.push(multiplier);
            currentMultiplier = multiplier;
            correctAnswer = 5 * multiplier;

            // عرض السؤال
            questionDisplay.textContent = `5 × ${multiplier} = ?`;

            // إنشاء التمثيل البصري بالأيدي
            createHandsVisualization(multiplier);

            // عرض النمط
            showPattern(multiplier);

            answerInput.value = '';
            answerInput.focus();

            // إعادة ضبط المؤقت
            resetTimer();

            // تحديث التقدم
            updateProgress();

            // إخفاء الشرح
            explanationBox.style.display = 'none';
        }

        // إنشاء التمثيل البصري بالأيدي
        function createHandsVisualization(multiplier) {
            visualRepresentation.innerHTML = '';

            const handsContainer = document.createElement('div');
            handsContainer.className = 'hands-container';

            const numberOfHands = Math.ceil(multiplier / 2); // كل يدين تمثلان 10 أصابع

            for (let i = 0; i < numberOfHands; i++) {
                const hand = document.createElement('div');
                hand.className = 'hand';

                const handLabel = document.createElement('div');
                handLabel.className = 'hand-label';
                handLabel.textContent = `اليد ${i + 1}`;

                const fingersContainer = document.createElement('div');
                fingersContainer.className = 'fingers-container';

                // عدد الأصابع في هذه اليد (5 أصابع لكل يد)
                const fingersInThisHand = Math.min(5, multiplier - (i * 5));

                for (let j = 0; j < 5; j++) {
                    const finger = document.createElement('div');
                    finger.className = `finger ${j < fingersInThisHand ? 'active' : ''}`;
                    finger.textContent = '5';
                    finger.style.animationDelay = `${(i * 5 + j) * 0.1}s`;
                    fingersContainer.appendChild(finger);
                }

                hand.appendChild(handLabel);
                hand.appendChild(fingersContainer);
                handsContainer.appendChild(hand);
            }

            visualRepresentation.appendChild(handsContainer);

            // إضافة شرح بسيط
            const explanation = document.createElement('div');
            explanation.style.marginTop = '15px';
            explanation.style.fontSize = '1rem';
            explanation.style.color = '#0984e3';
            explanation.innerHTML = `👆 ${multiplier} × 5 = ${multiplier} مجموعات من 5 أصابع`;
            visualRepresentation.appendChild(explanation);
        }

        // عرض النمط
        function showPattern(multiplier) {
            let patternHTML = '';
            for (let i = 1; i <= 10; i++) {
                const isCurrent = i === multiplier;
                patternHTML += `<span class="pattern-item ${isCurrent ? 'current' : ''}">${5 * i}</span>`;
                if (i < 10) patternHTML += ' • ';
            }
            patternDisplay.innerHTML = `النمط السحري: ${patternHTML}`;
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

            // التحقق من النمط (يجب أن ينتهي بـ 0 أو 5)
            const endsWithZeroOrFive = userAnswer % 10 === 0 || userAnswer % 10 === 5;

            if (!endsWithZeroOrFive) {
                messageDisplay.textContent = "تلميح: الناتج يجب أن ينتهي بـ 0 أو 5! 🔍";
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
                const timeBonus = Math.floor(timeLeft / 4);
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
                setTimeout(generateQuestion, 2000);
            } else {
                setTimeout(() => endGame(true), 2000);
            }
        }

        // إعادة ضبط المؤقت
        function resetTimer() {
            clearInterval(timerInterval);
            timeLeft = 20;
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

        // عرض الشرح
        function showExplanation() {
            if (!gameActive) return;

            explanationText.innerHTML = `
                <p><strong>أسرار جدول الضرب للعدد 5:</strong></p>
                <p>🔮 <strong>السر الأول:</strong> الناتج دائماً ينتهي بـ 0 أو 5</p>
                <p>👋 <strong>السر الثاني:</strong> يمكنك استخدام أصابع اليدين للعد</p>
                <p>📈 <strong>السر الثالث:</strong> النمط ثابت: 5, 10, 15, 20, 25, 30, 35, 40, 45, 50</p>
                <p>🎯 <strong>السر الرابع:</strong> الضرب في 5 = نصف الضرب في 10</p>
                <p><strong>مثال:</strong> 5 × ${currentMultiplier} = (10 × ${currentMultiplier}) ÷ 2 = ${10 * currentMultiplier} ÷ 2 = ${correctAnswer}</p>
                <p><strong>تلميح سريع:</strong> انظر إلى النمط أعلاه وتوقع الإجابة!</p>
            `;
            explanationBox.style.display = 'block';
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (questionCount / totalQuestions) * 100;
            progressFill.style.width = `${progress}%`;
            questionCountDiv.textContent = `${questionCount + 1}/${totalQuestions}`;
        }

        // إنهاء اللعبة
        function endGame(isComplete) {
            gameActive = false;
            clearInterval(timerInterval);

            if (isComplete) {
                const percentage = Math.round((score / 100) * 100);
                let finalMessage = `🎉 تهانينا! أتقنت جدول الضرب للعدد 5!<br>`;
                finalMessage += `مجموع نقاطك: ${score}/${100} (${percentage}%)<br>`;
                finalMessage += `أفضل تسلسل: ${bestStreak} إجابات متتالية 🌟`;

                if (percentage === 100) {
                    finalMessage += `<br>🏆 إنجاز مذهل! أنت خبير في جدول الـ 5!`;
                }

                messageDisplay.innerHTML = finalMessage;
                messageDisplay.className = "message-success";
                createConfetti();
            }

            helpBtn.style.display = 'none';
            restartBtn.style.display = 'inline-block';
        }

        // إعادة تشغيل اللعبة
        function restartGame() {
            visualRepresentation.innerHTML = '';
            patternDisplay.textContent = '';
            explanationBox.style.display = 'none';
            timerContainer.classList.remove('timer-warning');
            celebrationDiv.style.display = 'none';
            celebrationDiv.innerHTML = '';
            startGame();
        }

        // تأثير احتفالي
        function createConfetti() {
            celebrationDiv.style.display = 'block';
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#00cec9'];

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
