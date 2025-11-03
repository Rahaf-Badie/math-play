<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة جدول الضرب للعدد 3 - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 600px;
        }

        .lesson-info {
            background: linear-gradient(to right, #e17055, #fdcb6e);
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
            border-right: 5px solid #e17055;
            text-align: right;
            line-height: 1.6;
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.1rem;
        }

        .level-selector {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .level-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex: 1;
            min-width: 120px;
        }

        .level-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .level-btn.active {
            background: linear-gradient(135deg, #fd79a8, #e84393);
            transform: scale(1.05);
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
            color: #e17055;
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
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .groups-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin: 15px 0;
        }

        .group {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            background: rgba(116, 185, 255, 0.1);
            border-radius: 15px;
            border: 2px solid #74b9ff;
        }

        .group-label {
            font-size: 1rem;
            color: #0984e3;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .items-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
            max-width: 150px;
        }

        .item {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            animation: popIn 0.5s ease-out;
            background: linear-gradient(135deg, #fd79a8, #e84393);
            color: white;
        }

        @keyframes popIn {
            0% { transform: scale(0); opacity: 0; }
            70% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        .pattern-display {
            font-size: 1.3rem;
            margin: 15px 0;
            color: #0984e3;
            background: rgba(9, 132, 227, 0.1);
            padding: 10px;
            border-radius: 10px;
            font-weight: bold;
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
            border: 3px solid #e17055;
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
            background: rgba(225, 112, 85, 0.2);
            color: #e17055;
            border: 2px solid #e17055;
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

            .question-display {
                font-size: 2rem;
            }

            .groups-container {
                gap: 10px;
            }

            .group {
                padding: 10px;
            }

            .item {
                width: 20px;
                height: 20px;
                font-size: 0.9rem;
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

            .level-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
                min-width: 100px;
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
            الدرس: {{ $lesson_game->lesson->name }} | جدول الضرب للعدد 3
        </div>

        <h1 class="game-title">🎮 جدول الضرب للعدد 3</h1>

        <div class="instructions">
            <p>🎯 الهدف: حفظ وإتقان جدول الضرب للعدد 3</p>
            <p>💡 تذكر: الضرب في 3 يعني جمع العدد 3 مرات</p>
            <p>🌟 النمط: 3, 6, 9, 12, 15, 18, 21, 24, 27, 30</p>
        </div>

        <div class="level-selector">
            <button class="level-btn active" onclick="setLevel(1)">
                🟢 المستوى 1 (1-5)
            </button>
            <button class="level-btn" onclick="setLevel(2)">
                🔵 المستوى 2 (6-10)
            </button>
            <button class="level-btn" onclick="setLevel(3)">
                🟣 المستوى 3 (1-10)
            </button>
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
                ⏱️ الوقت المتبقي: <span id="timer">25</span> ثانية
            </div>

            <div class="explanation-box" id="explanation-box">
                <h3>💡 شرح جدول الضرب للعدد 3:</h3>
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
                <div class="progress-value" id="question-count">1/12</div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill" style="width: 8%"></div>
                </div>
            </div>
            <div class="progress-item">
                <div class="progress-label">التسلسل</div>
                <div class="progress-value" id="streak">0</div>
            </div>
        </div>

        <div id="message" class="message-info">
            اختر المستوى ثم ابدأ بحل مسائل الضرب في 3!
        </div>

        <div class="controls">
            <button class="control-btn" id="help-btn" onclick="showExplanation()">
                💡 شرح
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
        const totalQuestions = 12; // 12 سؤال لتغطية جدول 3 كامل
        let currentLevel = 1;
        let correctAnswer = 0;
        let currentMultiplier = 0;
        let gameActive = false;
        let timerInterval;
        let timeLeft = 25;
        let currentStreak = 0;
        let bestStreak = 0;
        let usedMultipliers = [];

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

        // تعيين مستوى اللعبة
        function setLevel(level) {
            if (gameActive) return;

            currentLevel = level;
            document.querySelectorAll('.level-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            let levelName = '';
            switch(level) {
                case 1: levelName = 'المستوى 1 (1-5)'; break;
                case 2: levelName = 'المستوى 2 (6-10)'; break;
                case 3: levelName = 'المستوى 3 (1-10)'; break;
            }

            messageDisplay.textContent = `${levelName} - اضغط ابدأ للعب`;
            messageDisplay.className = 'message-info';
        }

        // توليد سؤال جديد
        function generateQuestion() {
            let minMultiplier, maxMultiplier;

            switch(currentLevel) {
                case 1:
                    minMultiplier = 1; maxMultiplier = 5;
                    break;
                case 2:
                    minMultiplier = 6; maxMultiplier = 10;
                    break;
                case 3:
                    minMultiplier = 1; maxMultiplier = 10;
                    break;
            }

            // توليد مضروب جديد لم يتم استخدامه
            let multiplier;
            do {
                multiplier = Math.floor(Math.random() * (maxMultiplier - minMultiplier + 1)) + minMultiplier;
            } while (usedMultipliers.includes(multiplier) && usedMultipliers.length < (maxMultiplier - minMultiplier + 1));

            // إذا تم استخدام جميع المضروبات، أعد تعيين القائمة
            if (usedMultipliers.length >= (maxMultiplier - minMultiplier + 1)) {
                usedMultipliers = [];
            }

            usedMultipliers.push(multiplier);
            currentMultiplier = multiplier;
            correctAnswer = 3 * multiplier;

            // عرض السؤال
            questionDisplay.textContent = `3 × ${multiplier} = ?`;

            // إنشاء التمثيل البصري
            createVisualRepresentation(multiplier);

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

        // إنشاء التمثيل البصري
        function createVisualRepresentation(multiplier) {
            visualRepresentation.innerHTML = '';

            const groupsContainer = document.createElement('div');
            groupsContainer.className = 'groups-container';

            for (let i = 0; i < multiplier; i++) {
                const group = document.createElement('div');
                group.className = 'group';

                const groupLabel = document.createElement('div');
                groupLabel.className = 'group-label';
                groupLabel.textContent = `مجموعة ${i + 1}`;

                const itemsContainer = document.createElement('div');
                itemsContainer.className = 'items-container';

                // كل مجموعة تحتوي على 3 عناصر
                for (let j = 0; j < 3; j++) {
                    const item = document.createElement('div');
                    item.className = 'item';
                    item.textContent = '3';
                    item.style.animationDelay = `${(i * 3 + j) * 0.1}s`;
                    itemsContainer.appendChild(item);
                }

                group.appendChild(groupLabel);
                group.appendChild(itemsContainer);
                groupsContainer.appendChild(group);
            }

            visualRepresentation.appendChild(groupsContainer);
        }

        // عرض النمط
        function showPattern(multiplier) {
            let patternText = '';
            for (let i = 1; i <= multiplier; i++) {
                if (i === multiplier) {
                    patternText += `<strong>${3 * i}</strong>`;
                } else {
                    patternText += `${3 * i} → `;
                }
            }
            patternDisplay.innerHTML = `النمط: ${patternText}`;
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
                setTimeout(generateQuestion, 2000);
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
                <p><strong>جدول الضرب للعدد 3:</strong></p>
                <p>الضرب في 3 يعني جمع العدد 3 مرات متتالية</p>
                <p><strong>في هذا السؤال:</strong></p>
                <p>3 × ${currentMultiplier} = 3 + 3 + ... (${currentMultiplier} مرات)</p>
                <p><strong>النتيجة:</strong> ${correctAnswer}</p>
                <p><strong>النمط:</strong> 3, 6, 9, 12, 15, 18, 21, 24, 27, 30</p>
                <p><strong>تلميح:</strong> لاحظ أن الناتج دائماً من مضاعفات العدد 3</p>
            `;
            explanationBox.style.display = 'block';
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
            usedMultipliers = [];

            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;
            updateProgress();

            startBtn.style.display = 'none';
            restartBtn.style.display = 'none';
            helpBtn.style.display = 'inline-block';

            messageDisplay.textContent = "ابدأ بحل مسائل الضرب في 3!";
            messageDisplay.className = 'message-info';

            generateQuestion();
        }

        // إنهاء اللعبة
        function endGame(isComplete) {
            gameActive = false;
            clearInterval(timerInterval);

            if (isComplete) {
                const percentage = Math.round((score / 120) * 100);
                let finalMessage = `🎉 تهانينا! أكملت جدول الضرب للعدد 3!<br>`;
                finalMessage += `مجموع نقاطك: ${score}/${120} (${percentage}%)<br>`;
                finalMessage += `أفضل تسلسل: ${bestStreak} إجابات متتالية 🌟`;

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
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#e17055'];

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

        // تهيئة الوضع الافتراضي
        setLevel(1);
    </script>
</body>
</html>
