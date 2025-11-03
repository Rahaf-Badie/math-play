<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة خواص الجمع - {{ $lesson_game->lesson->name }}</title>
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

        .property-info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            padding: 15px;
            border-radius: 15px;
            margin: 15px 0;
            font-size: 1.1rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .game-area {
            padding: 25px;
            background: #f1f2f6;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #dfe6e9;
        }

        .equation-display {
            font-size: 2.2rem;
            font-weight: bold;
            margin: 25px 0;
            color: #e17055;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            direction: ltr;
            text-align: center;
        }

        .missing-number {
            display: inline-block;
            width: 100px;
            height: 60px;
            border: 3px dashed #fd79a8;
            border-radius: 10px;
            margin: 0 10px;
            background: rgba(253, 121, 168, 0.1);
            color: #fd79a8;
            font-size: 2rem;
            line-height: 60px;
            vertical-align: middle;
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

        .properties-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .property-btn {
            background: linear-gradient(135deg, #a29bfe, #6c5ce7);
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

        .property-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .property-btn.active {
            background: linear-gradient(135deg, #fd79a8, #e84393);
            transform: scale(1.05);
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

        .timer-container {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
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

            .equation-display {
                font-size: 1.8rem;
            }

            .missing-number {
                width: 80px;
                height: 50px;
                font-size: 1.5rem;
                line-height: 50px;
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

            .property-btn {
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
            الدرس: {{ $lesson_game->lesson->name }} | خواص عملية الجمع
        </div>

        <h1 class="game-title">🎮 خواص عملية الجمع</h1>

        <div class="instructions">
            <p>🎯 الهدف: اكمل المعادلات باستخدام خواص الجمع المختلفة</p>
            <p>💡 اختر الخاصية التي تريد التدرب عليها أو اتركها عشوائية</p>
        </div>

        <div class="properties-container">
            <button class="property-btn active" onclick="setProperty('random')">
                🎲 عشوائي
            </button>
            <button class="property-btn" onclick="setProperty('commutative')">
                🔄 التبديلية
            </button>
            <button class="property-btn" onclick="setProperty('associative')">
                🧩 التجميعية
            </button>
            <button class="property-btn" onclick="setProperty('identity')">
                ⚪ العنصر المحايد
            </button>
        </div>

        <div class="game-area">
            <div class="property-info" id="property-info">
                <!-- معلومات الخاصية ستظهر هنا -->
            </div>

            <div class="equation-display" id="equation-display">
                <!-- المعادلة ستظهر هنا -->
            </div>

            <div class="input-container">
                <input type="number" class="answer-input" id="answer-input" placeholder="الإجابة">
                <button class="submit-btn" onclick="checkAnswer()">
                    ✓ تحقق
                </button>
            </div>

            <div class="timer-container" id="timer-container">
                ⏱️ الوقت المتبقي: <span id="timer">30</span> ثانية
            </div>

            <div class="explanation-box" id="explanation-box">
                <h3>💡 شرح الخاصية:</h3>
                <div class="explanation-text" id="explanation-text">
                    <!-- شرح الخاصية سيظهر هنا -->
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
            اختر الخاصية ثم ابدأ بحل المعادلات!
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
        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let correctAnswer = 0;
        let currentProperty = 'random';
        let gameActive = false;
        let timerInterval;
        let timeLeft = 30;
        let currentStreak = 0;
        let bestStreak = 0;

        // معلومات الخواص
        const propertiesInfo = {
            'commutative': {
                name: 'الخاصية التبديلية',
                description: 'تغير ترتيب الأعداد لا يغير النتيجة: أ + ب = ب + أ',
                examples: ['5 + 3 = 3 + 5', '12 + 7 = 7 + 12']
            },
            'associative': {
                name: 'الخاصية التجميعية',
                description: 'تغير تجميع الأعداد لا يغير النتيجة: (أ + ب) + جـ = أ + (ب + جـ)',
                examples: ['(2 + 3) + 4 = 2 + (3 + 4)', '(10 + 5) + 2 = 10 + (5 + 2)']
            },
            'identity': {
                name: 'خاصية العنصر المحايد',
                description: 'جمع أي عدد مع الصفر يعطي العدد نفسه: أ + 0 = أ',
                examples: ['7 + 0 = 7', '25 + 0 = 25']
            }
        };

        // عناصر DOM
        const equationDisplay = document.getElementById("equation-display");
        const propertyInfo = document.getElementById("property-info");
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

        // تعيين الخاصية
        function setProperty(property) {
            if (gameActive) return;

            currentProperty = property;
            document.querySelectorAll('.property-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            let propertyName = 'جميع الخواص';
            if (property !== 'random') {
                propertyName = propertiesInfo[property].name;
            }

            messageDisplay.textContent = `الخاصية: ${propertyName} - اضغط ابدأ للعب`;
            messageDisplay.className = 'message-info';
        }

        // توليد معادلة جديدة
        function generateEquation() {
            let a, b, c;
            let equationText = '';
            let selectedProperty = currentProperty;

            // إذا كانت الخاصية عشوائية، اختر خاصية عشوائية
            if (selectedProperty === 'random') {
                const properties = ['commutative', 'associative', 'identity'];
                selectedProperty = properties[Math.floor(Math.random() * properties.length)];
            }

            // توليد أعداد عشوائية
            a = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            b = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            c = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            switch(selectedProperty) {
                case 'commutative':
                    correctAnswer = b;
                    equationText = `${a} + <span class="missing-number">?</span> = ${b} + ${a}`;
                    propertyInfo.textContent = `خاصية: ${propertiesInfo.commutative.name}`;
                    break;

                case 'associative':
                    correctAnswer = c;
                    equationText = `(${a} + ${b}) + <span class="missing-number">?</span> = ${a} + (${b} + ${c})`;
                    propertyInfo.textContent = `خاصية: ${propertiesInfo.associative.name}`;
                    break;

                case 'identity':
                    correctAnswer = a;
                    equationText = `<span class="missing-number">?</span> + 0 = ${a}`;
                    propertyInfo.textContent = `خاصية: ${propertiesInfo.identity.name}`;
                    break;
            }

            equationDisplay.innerHTML = equationText;
            answerInput.value = '';
            answerInput.focus();

            // إعادة ضبط المؤقت
            resetTimer();

            // تحديث التقدم
            updateProgress();

            // إخفاء الشرح
            explanationBox.style.display = 'none';
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
                const timeBonus = Math.floor(timeLeft / 6);
                score += timeBonus;

                messageDisplay.textContent = `أحسنت! ✅ +10 نقاط${timeBonus > 0 ? ` +${timeBonus} مكافأة وقت` : ''}`;
                messageDisplay.className = "message-success";

                // مكافأة التسلسل
                if (currentStreak >= 3) {
                    const streakBonus = currentStreak * 2;
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
                setTimeout(generateEquation, 2000);
            } else {
                setTimeout(() => endGame(true), 2000);
            }
        }

        // إعادة ضبط المؤقت
        function resetTimer() {
            clearInterval(timerInterval);
            timeLeft = 30;
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
                        setTimeout(generateEquation, 1500);
                    } else {
                        endGame(true);
                    }
                }
            }, 1000);
        }

        // عرض الشرح
        function showExplanation() {
            if (!gameActive) return;

            let currentPropertyName = propertyInfo.textContent.replace('خاصية: ', '');
            let propertyKey = '';

            for (const [key, info] of Object.entries(propertiesInfo)) {
                if (info.name === currentPropertyName) {
                    propertyKey = key;
                    break;
                }
            }

            if (propertyKey && propertiesInfo[propertyKey]) {
                const info = propertiesInfo[propertyKey];
                explanationText.innerHTML = `
                    <p><strong>${info.name}:</strong></p>
                    <p>${info.description}</p>
                    <p><strong>أمثلة:</strong></p>
                    <ul>
                        ${info.examples.map(example => `<li>${example}</li>`).join('')}
                    </ul>
                    <p><strong>في هذا السؤال:</strong></p>
                    <p>${equationDisplay.textContent.replace('?', correctAnswer)}</p>
                `;
                explanationBox.style.display = 'block';
            }
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

            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;
            updateProgress();

            startBtn.style.display = 'none';
            restartBtn.style.display = 'none';
            helpBtn.style.display = 'inline-block';

            messageDisplay.textContent = "ابدأ بحل المعادلات باستخدام خواص الجمع!";
            messageDisplay.className = 'message-info';

            generateEquation();
        }

        // إنهاء اللعبة
        function endGame(isComplete) {
            gameActive = false;
            clearInterval(timerInterval);

            if (isComplete) {
                messageDisplay.innerHTML = `🎉 تهانينا! أكملت جميع المعادلات بنجاح!<br>مجموع نقاطك: ${score} | أفضل تسلسل: ${bestStreak} 🌟`;
                messageDisplay.className = "message-success";
                createConfetti();
            }

            helpBtn.style.display = 'none';
            restartBtn.style.display = 'inline-block';
        }

        // إعادة تشغيل اللعبة
        function restartGame() {
            equationDisplay.innerHTML = '';
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
        setProperty('random');
    </script>
</body>
</html>
