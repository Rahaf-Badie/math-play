{{-- resources/views/mathplay/games/rabbit_race.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐇 سباق الأرنب - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #fffde7 0%, #fff9c4 100%);
            text-align: center;
            padding: 20px;
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #fbc02d;
            margin-bottom: 15px;
            font-size: 32px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #fff9c4;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #fbc02d;
        }

        .game-box {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #ffd54f;
        }

        .current-number {
            font-size: 36px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: #fff9c4;
            border-radius: 15px;
            color: #f57f17;
            border: 2px solid #ffd54f;
        }

        .instruction {
            font-size: 22px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 10px;
            color: #1976d2;
            border-right: 4px solid #1976d2;
        }

        .race-container {
            margin: 30px 0;
            position: relative;
        }

        .track {
            width: 100%;
            height: 80px;
            background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
            margin: 20px auto;
            border-radius: 15px;
            position: relative;
            border: 3px solid #4caf50;
            overflow: hidden;
        }

        .track::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 20px,
                rgba(255, 255, 255, 0.3) 20px,
                rgba(255, 255, 255, 0.3) 40px
            );
        }

        .finish-line {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 10px;
            background: repeating-linear-gradient(
                45deg,
                #ff0000,
                #ff0000 10px,
                #ffffff 10px,
                #ffffff 20px
            );
            z-index: 2;
        }

        .rabbit {
            width: 60px;
            height: 60px;
            position: absolute;
            top: 10px;
            right: 20px;
            transition: right 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            z-index: 3;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.3));
        }

        .rabbit.jumping {
            animation: jump 0.5s ease-in-out;
        }

        .options {
            margin: 30px 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .option-btn {
            font-size: 24px;
            padding: 15px 25px;
            margin: 5px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #f57c00 0%, #ef6c00 100%);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(245, 124, 0, 0.3);
            font-weight: bold;
            min-width: 80px;
        }

        .option-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(245, 124, 0, 0.4);
        }

        .option-btn:active {
            transform: translateY(-1px) scale(1.02);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            transform: scale(1.1);
        }

        .option-btn.wrong {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            animation: shake 0.5s ease-in-out;
        }

        button {
            margin-top: 20px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #fbc02d 0%, #f9a825 100%);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(251, 192, 45, 0.3);
            font-weight: bold;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(251, 192, 45, 0.4);
        }

        #msg {
            margin-top: 20px;
            font-size: 22px;
            font-weight: 600;
            min-height: 40px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .msg-correct {
            color: #2e7d32;
            background: #e8f5e9;
            border: 2px solid #4caf50;
            animation: celebrate 0.6s ease-in-out;
        }

        .msg-wrong {
            color: #d32f2f;
            background: #ffebee;
            border: 2px solid #f44336;
        }

        .score {
            font-size: 18px;
            margin: 15px 0;
            color: #2c3e50;
            font-weight: bold;
            background: #fff9c4;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background: #e0e0e0;
            border-radius: 5px;
            margin: 15px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            border-radius: 5px;
            transition: width 0.8s ease;
            width: 0%;
        }

        @keyframes jump {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
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

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .carrot {
            font-size: 30px;
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            animation: bounce 2s infinite;
            z-index: 2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐇 سباق الأرنب</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">المسافة: 0% | النقاط: 0</div>

        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>

        <div class="game-box">
            <div class="current-number">
                الرقم الحالي: <span id="currentNumber"></span>
            </div>

            <div class="instruction">
                اختر <span id="action"></span> الرقم
            </div>

            <div class="race-container">
                <div class="track">
                    <div class="finish-line"></div>
                    <div class="carrot">🥕</div>
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMjUiIGZpbGw9IiNGRjcxNDMiLz4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyNSIgcj0iNSIgZmlsbD0id2hpdGUiLz4KPGNpcmNsZSBjeD0iNDAiIGN5PSIyNSIgcj0iNSIgZmlsbD0id2hpdGUiLz4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyNSIgcj0iMiIgZmlsbD0iYmxhY2siLz4KPGNpcmNsZSBjeD0iNDAiIGN5PSIyNSIgcj0iMiIgZmlsbD0iYmxhY2siLz4KPGVsbGlwc2UgY3g9IjMwIiBjeT0iMzUiIHJ4PSI4IiByeT0iNCIgZmlsbD0iI0ZGNjZCNyIvPgo8L3N2Zz4K"
                         class="rabbit" id="rabbit" alt="أرنب">
                </div>
            </div>

            <div class="options" id="options"></div>

            <div id="msg"></div>

            <button id="newRoundBtn">🔄 جولة جديدة</button>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};
        const totalSteps = 5; // عدد الخطوات لإنهاء السباق

        const rabbit = document.getElementById("rabbit");
        const optionsEl = document.getElementById("options");
        const msg = document.getElementById("msg");
        const actionEl = document.getElementById("action");
        const currentNumberEl = document.getElementById("currentNumber");
        const newRoundBtn = document.getElementById("newRoundBtn");
        const scoreElement = document.getElementById("score");
        const progressBar = document.getElementById("progress");

        let currentNumber = 1;
        let isNext = true;
        let currentStep = 0;
        let points = 0;
        let gameActive = true;

        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        function generateQuestion() {
            if (!gameActive) return;

            optionsEl.innerHTML = "";
            msg.textContent = "";
            msg.className = "";

            // توليد رقم حالي
            currentNumber = generateRandomNumber();
            currentNumberEl.textContent = currentNumber;

            // تحديد إذا كان المطلوب الرقم التالي أو السابق
            isNext = Math.random() < 0.5;
            actionEl.textContent = isNext ? "التالي" : "السابق";

            // حساب الإجابة الصحيحة
            let correctAnswer = isNext ? currentNumber + 1 : currentNumber - 1;

            // التأكد من أن الإجابة ضمن المدى المسموح
            if (correctAnswer < minRange) correctAnswer = minRange;
            if (correctAnswer > maxRange) correctAnswer = maxRange;

            // توليد خيارات متضمنة الإجابة الصحيحة
            let choices = [correctAnswer];

            // إضافة خيارات عشوائية أخرى
            while (choices.length < 4) {
                let randomNum = generateRandomNumber();
                if (!choices.includes(randomNum)) {
                    choices.push(randomNum);
                }
            }

            // خلط الخيارات
            choices = shuffleArray(choices);

            // عرض الخيارات
            choices.forEach(num => {
                const btn = document.createElement("button");
                btn.className = "option-btn";
                btn.textContent = num;
                btn.dataset.value = num;

                btn.addEventListener("click", () => {
                    if (gameActive) {
                        checkAnswer(num, btn);
                    }
                });

                optionsEl.appendChild(btn);
            });
        }

        function shuffleArray(array) {
            const shuffled = [...array];
            for (let i = shuffled.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
            }
            return shuffled;
        }

        function checkAnswer(selectedNumber, selectedButton) {
            if (!gameActive) return;

            gameActive = false;

            // حساب الإجابة الصحيحة
            let correctAnswer = isNext ? currentNumber + 1 : currentNumber - 1;
            if (correctAnswer < minRange) correctAnswer = minRange;
            if (correctAnswer > maxRange) correctAnswer = maxRange;

            if (selectedNumber === correctAnswer) {
                // الإجابة الصحيحة
                points++;
                currentStep++;
                selectedButton.classList.add("correct");
                msg.textContent = getSuccessMessage();
                msg.className = "msg-correct";

                // تحريك الأرنب
                moveRabbit();

                // تحديث النقاط والتقدم
                updateProgress();

                // تأثير القفز
                rabbit.classList.add("jumping");
                setTimeout(() => {
                    rabbit.classList.remove("jumping");
                }, 500);

                // الانتقال للسؤال التالي بعد ثانية
                setTimeout(() => {
                    if (currentStep >= totalSteps) {
                        finishRace();
                    } else {
                        gameActive = true;
                        generateQuestion();
                    }
                }, 1000);
            } else {
                // الإجابة الخاطئة
                selectedButton.classList.add("wrong");
                msg.textContent = getErrorMessage(correctAnswer);
                msg.className = "msg-wrong";

                // إظهار الإجابة الصحيحة
                const correctButton = Array.from(optionsEl.children).find(
                    btn => parseInt(btn.dataset.value) === correctAnswer
                );
                if (correctButton) {
                    correctButton.classList.add("correct");
                }

                // إعادة تفعيل اللعبة بعد ثانيتين
                setTimeout(() => {
                    gameActive = true;
                    generateQuestion();
                }, 2000);
            }
        }

        function moveRabbit() {
            const trackWidth = document.querySelector('.track').offsetWidth - 70;
            const newPosition = (currentStep / totalSteps) * trackWidth;
            rabbit.style.right = `${newPosition}px`;
        }

        function updateProgress() {
            const progressPercentage = (currentStep / totalSteps) * 100;
            progressBar.style.width = `${progressPercentage}%`;
            scoreElement.textContent = `المسافة: ${Math.round(progressPercentage)}% | النقاط: ${points}`;
        }

        function finishRace() {
            msg.textContent = `🎉 مبروك! أكملت السباق بنقاط: ${points}`;
            msg.className = "msg-correct";

            // تأثير احتفالي
            rabbit.style.animation = "jump 0.5s infinite";

            setTimeout(() => {
                newRound();
            }, 3000);
        }

        function newRound() {
            currentStep = 0;
            points = 0;
            rabbit.style.right = "20px";
            rabbit.style.animation = "";
            progressBar.style.width = "0%";
            gameActive = true;
            generateQuestion();
            updateProgress();
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! الأرنب يتحرك للأمام",
                "👏 رائع! استمر في التقدم",
                "💫 إبداع! أنت تسابق بسرعة",
                "🌟 برافو! خطوة أقرب للفوز"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage(correctAnswer) {
            return `😅 حاول مرة أخرى! الإجابة الصحيحة هي: ${correctAnswer}`;
        }

        newRoundBtn.addEventListener("click", newRound);

        // بدء اللعبة
        newRound();
    </script>
</body>
</html>
