<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة مقارنة الأعداد - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tahoma", sans-serif;
            background: linear-gradient(135deg, #55efc4 0%, #81ecec 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
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
            background: linear-gradient(to right, #0984e3, #74b9ff);
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
            border-right: 5px solid #0984e3;
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

        .numbers-display {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .number-box {
            width: 140px;
            height: 140px;
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: bold;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            position: relative;
            transition: all 0.3s ease;
        }

        .number-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            border-radius: 20px;
        }

        .number-label {
            position: absolute;
            top: -25px;
            font-size: 1rem;
            color: #0984e3;
            font-weight: bold;
            background: white;
            padding: 5px 15px;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .comparison-symbol {
            font-size: 4rem;
            font-weight: bold;
            color: #0984e3;
            margin: 0 10px;
            min-width: 60px;
        }

        .options-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .comparison-btn {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #fd79a8, #e84393);
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 2.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .comparison-btn:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .comparison-btn:active {
            transform: translateY(2px);
        }

        .comparison-btn.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            animation: pulse 0.5s;
        }

        .comparison-btn.wrong {
            background: linear-gradient(135deg, #e63946, #c1121f);
            animation: shake 0.5s;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }

        .level-indicator {
            background: linear-gradient(135deg, #fdcb6e, #e17055);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            margin: 15px 0;
            font-size: 1.1rem;
            font-weight: bold;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
            background: rgba(9, 132, 227, 0.2);
            color: #0984e3;
            border: 2px solid #0984e3;
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

        .visual-help {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
        }

        .comparison-steps {
            font-size: 1.2rem;
            line-height: 1.8;
            text-align: right;
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

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .game-title {
                font-size: 2rem;
            }

            .numbers-display {
                gap: 15px;
            }

            .number-box {
                width: 120px;
                height: 120px;
                font-size: 2.5rem;
            }

            .comparison-symbol {
                font-size: 3rem;
                min-width: 50px;
            }

            .comparison-btn {
                width: 70px;
                height: 70px;
                font-size: 2rem;
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
            الدرس: {{ $lesson_game->lesson->name }} | المدى: {{ $min_range }} إلى {{ $max_range }}
        </div>

        <h1 class="game-title">🔢 مقارنة الأعداد</h1>

        <div class="instructions">
            <p>🎯 الهدف: قارن بين العددين باستخدام الإشارة المناسبة</p>
            <p>💡 تذكر: انظر إلى المنازل من اليسار إلى اليمين (مئات → عشرات → آحاد)</p>
        </div>

        <div class="level-indicator" id="level-indicator">
            المستوى: <span id="current-level">1</span> - الأعداد ضمن 99
        </div>

        <div class="game-area">
            <div class="numbers-display">
                <div class="number-box">
                    <div class="number-label">العدد الأول</div>
                    <span id="number-a">0</span>
                </div>

                <div class="comparison-symbol" id="comparison-symbol">?</div>

                <div class="number-box">
                    <div class="number-label">العدد الثاني</div>
                    <span id="number-b">0</span>
                </div>
            </div>

            <div class="options-container">
                <button class="comparison-btn" onclick="checkAnswer('>')">></button>
                <button class="comparison-btn" onclick="checkAnswer('<')"><</button>
                <button class="comparison-btn" onclick="checkAnswer('=')">=</button>
            </div>

            <div class="visual-help" id="visual-help">
                <h3>💡 خطوات المقارنة:</h3>
                <div class="comparison-steps" id="comparison-steps">
                    <!-- خطوات المقارنة ستظهر هنا -->
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
            اختر الإشارة المناسبة للمقارنة بين العددين
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
        let currentLevel = 1;
        let currentA = 0;
        let currentB = 0;
        let correctAnswer = '';
        let gameActive = false;
        let currentStreak = 0;
        let bestStreak = 0;

        // عناصر DOM
        const numberA = document.getElementById("number-a");
        const numberB = document.getElementById("number-b");
        const comparisonSymbol = document.getElementById("comparison-symbol");
        const messageDisplay = document.getElementById("message");
        const scoreDisplay = document.getElementById("score");
        const questionCountDiv = document.getElementById("question-count");
        const progressFill = document.getElementById("progress-fill");
        const streakDiv = document.getElementById("streak");
        const levelIndicator = document.getElementById("level-indicator");
        const currentLevelSpan = document.getElementById("current-level");
        const helpBtn = document.getElementById("help-btn");
        const startBtn = document.getElementById("start-btn");
        const restartBtn = document.getElementById("restart-btn");
        const visualHelp = document.getElementById("visual-help");
        const comparisonSteps = document.getElementById("comparison-steps");
        const celebrationDiv = document.getElementById("celebration");

        // بدء اللعبة
        function startGame() {
            if (gameActive) return;

            gameActive = true;
            score = 0;
            questionCount = 0;
            currentLevel = 1;
            currentStreak = 0;

            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;
            updateProgress();
            updateLevelIndicator();

            startBtn.style.display = 'none';
            restartBtn.style.display = 'none';
            helpBtn.style.display = 'inline-block';

            generateQuestion();
        }

        // توليد سؤال جديد
        function generateQuestion() {
            // تحديد المدى بناءً على المستوى
            let rangeMin, rangeMax;
            switch(currentLevel) {
                case 1: // الأعداد ضمن 99
                    rangeMin = 1;
                    rangeMax = 99;
                    break;
                case 2: // الأعداد ضمن 199
                    rangeMin = 100;
                    rangeMax = 199;
                    break;
                case 3: // الأعداد ضمن 399
                    rangeMin = 200;
                    rangeMax = 399;
                    break;
                case 4: // الأعداد ضمن 599
                    rangeMin = 400;
                    rangeMax = 599;
                    break;
                default: // الأعداد ضمن 999
                    rangeMin = 600;
                    rangeMax = 999;
                    break;
            }

            // توليد عددين عشوائيين
            currentA = Math.floor(Math.random() * (rangeMax - rangeMin + 1)) + rangeMin;
            currentB = Math.floor(Math.random() * (rangeMax - rangeMin + 1)) + rangeMin;

            // تحديد الإجابة الصحيحة
            if (currentA > currentB) {
                correctAnswer = '>';
            } else if (currentA < currentB) {
                correctAnswer = '<';
            } else {
                correctAnswer = '=';
            }

            // عرض الأعداد
            numberA.textContent = currentA;
            numberB.textContent = currentB;
            comparisonSymbol.textContent = '?';

            // إعادة تعليمات اللعبة
            messageDisplay.textContent = "اختر الإشارة المناسبة للمقارنة بين العددين";
            messageDisplay.className = "message-info";

            // إخفاء المساعدة
            visualHelp.style.display = "none";

            // إعادة تعيين أزرار المقارنة
            document.querySelectorAll('.comparison-btn').forEach(btn => {
                btn.classList.remove('correct', 'wrong');
                btn.disabled = false;
                btn.style.pointerEvents = 'auto';
            });

            questionCount++;
            updateProgress();
        }

        // التحقق من الإجابة
        function checkAnswer(userAnswer) {
            if (!gameActive) return;

            // تعطيل جميع الأزرار
            document.querySelectorAll('.comparison-btn').forEach(btn => {
                btn.disabled = true;
                btn.style.pointerEvents = 'none';
            });

            // إظهار الإشارة الصحيحة
            comparisonSymbol.textContent = correctAnswer;

            const isCorrect = userAnswer === correctAnswer;

            if (isCorrect) {
                // الإجابة صحيحة
                score += 10;
                currentStreak++;
                bestStreak = Math.max(bestStreak, currentStreak);

                messageDisplay.textContent = getRandomSuccessMessage();
                messageDisplay.className = "message-success";

                // تلوين الزر الصحيح
                document.querySelectorAll('.comparison-btn').forEach(btn => {
                    if (btn.textContent === correctAnswer) {
                        btn.classList.add('correct');
                    }
                });

                // مكافأة التسلسل
                if (currentStreak >= 3) {
                    const streakBonus = currentStreak * 2;
                    score += streakBonus;
                    messageDisplay.textContent += ` 🎯 تسلسل ${currentStreak}! +${streakBonus} نقاط`;
                }

                // زيادة المستوى كل 3 أسئلة صحيحة
                if (questionCount % 3 === 0 && currentLevel < 5) {
                    currentLevel++;
                    updateLevelIndicator();
                }
            } else {
                // الإجابة خاطئة
                currentStreak = 0;
                messageDisplay.textContent = `خطأ! الإجابة الصحيحة هي ${correctAnswer} 😅`;
                messageDisplay.className = "message-error";

                // تلوين الأزرار
                document.querySelectorAll('.comparison-btn').forEach(btn => {
                    if (btn.textContent === correctAnswer) {
                        btn.classList.add('correct');
                    } else if (btn.textContent === userAnswer) {
                        btn.classList.add('wrong');
                    }
                });
            }

            // تحديث النقاط والتسلسل
            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;

            if (questionCount < totalQuestions) {
                setTimeout(generateQuestion, 2000);
            } else {
                setTimeout(() => endGame(true), 2000);
            }
        }

        // رسائل نجاح عشوائية
        function getRandomSuccessMessage() {
            const messages = [
                "أحسنت! 👏",
                "إجابة صحيحة! 🌟",
                "ممتاز! 🎯",
                "رائع! 💫",
                "برافو! ✅"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // عرض المساعدة
        function showHelp() {
            if (!gameActive) return;

            const aStr = currentA.toString().padStart(3, '0');
            const bStr = currentB.toString().padStart(3, '0');

            let steps = `
                <p><strong>العدد الأول:</strong> ${currentA}</p>
                <p><strong>العدد الثاني:</strong> ${currentB}</p>
                <hr>
            `;

            // مقارنة المنازل
            for (let i = 0; i < 3; i++) {
                const placeNames = ['المئات', 'العشرات', 'الآحاد'];
                const digitA = parseInt(aStr[i]);
                const digitB = parseInt(bStr[i]);

                if (digitA > digitB) {
                    steps += `<p>✅ ${placeNames[i]}: ${digitA} > ${digitB} → العدد الأول أكبر</p>`;
                    break;
                } else if (digitA < digitB) {
                    steps += `<p>✅ ${placeNames[i]}: ${digitA} < ${digitB} → العدد الثاني أكبر</p>`;
                    break;
                } else if (i === 2) {
                    steps += `<p>✅ جميع المنازل متساوية → العددان متساويان</p>`;
                } else {
                    steps += `<p>⚪ ${placeNames[i]}: ${digitA} = ${digitB} → انتقل للمنزلة التالية</p>`;
                }
            }

            steps += `<p><strong>النتيجة:</strong> ${currentA} ${correctAnswer} ${currentB}</p>`;

            comparisonSteps.innerHTML = steps;
            visualHelp.style.display = "block";
        }

        // تحديث مؤشر المستوى
        function updateLevelIndicator() {
            currentLevelSpan.textContent = currentLevel;

            let levelText = '';
            switch(currentLevel) {
                case 1: levelText = 'الأعداد ضمن 99'; break;
                case 2: levelText = 'الأعداد ضمن 199'; break;
                case 3: levelText = 'الأعداد ضمن 399'; break;
                case 4: levelText = 'الأعداد ضمن 599'; break;
                case 5: levelText = 'الأعداد ضمن 999'; break;
            }

            levelIndicator.textContent = `المستوى: ${currentLevel} - ${levelText}`;
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (questionCount / totalQuestions) * 100;
            progressFill.style.width = `${progress}%`;
            questionCountDiv.textContent = `${questionCount}/${totalQuestions}`;
        }

        // إنهاء اللعبة
        function endGame(isComplete) {
            gameActive = false;

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
            comparisonSymbol.textContent = '?';
            visualHelp.style.display = 'none';
            celebrationDiv.style.display = 'none';
            celebrationDiv.innerHTML = '';
            startGame();
        }

        // تأثير احتفالي
        function createConfetti() {
            celebrationDiv.style.display = 'block';
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#0984e3'];

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
    </script>
</body>
</html>
