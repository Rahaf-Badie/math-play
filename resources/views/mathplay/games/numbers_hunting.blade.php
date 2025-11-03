{{-- resources/views/mathplay/games/numbers_hunting.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎣 صيد الأرقام - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
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
            color: #388e3c;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #f1f8e9;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #388e3c;
        }

        .game-box {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #4caf50;
        }

        .current-number {
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: #e8f5e9;
            border-radius: 15px;
            color: #2e7d32;
            border: 2px solid #4caf50;
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

        .pond {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin: 30px 0;
            min-height: 100px;
        }

        .number {
            width: 80px;
            height: 80px;
            line-height: 80px;
            margin: 5px;
            font-size: 32px;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #43a047 0%, #2e7d32 100%);
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(67, 160, 71, 0.3);
            border: 3px solid transparent;
            user-select: none;
        }

        .number:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 25px rgba(67, 160, 71, 0.4);
            border-color: #fff;
        }

        .number:active {
            transform: translateY(-2px) scale(1.02);
        }

        .number.correct {
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            border-color: #fff;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.5);
        }

        .number.wrong {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            border-color: #fff;
            animation: shake 0.5s ease-in-out;
        }

        button {
            margin-top: 20px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #388e3c 0%, #2e7d32 100%);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(56, 142, 60, 0.3);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(56, 142, 60, 0.4);
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
            background: #e8f5e9;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
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

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 0.5s ease-in-out;
        }

        .fishing-rod {
            font-size: 40px;
            margin: 10px 0;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(10deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎣 صيد الأرقام</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="fishing-rod">🎣</div>

        <div class="game-box">
            <div class="current-number">
                الرقم الحالي هو: <span id="currentNumber"></span>
            </div>

            <div class="instruction">
                اختر <span id="action"></span> الرقم
            </div>

            <div class="pond" id="pond"></div>

            <div id="msg"></div>

            <button id="newRoundBtn">🔄 جولة جديدة</button>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};

        const pond = document.getElementById("pond");
        const msg = document.getElementById("msg");
        const actionEl = document.getElementById("action");
        const currentNumberEl = document.getElementById("currentNumber");
        const newRoundBtn = document.getElementById("newRoundBtn");
        const scoreElement = document.getElementById("score");

        let currentNumber = 1;
        let isNext = true;
        let points = 0;
        let attempts = 0;
        let gameActive = true;

        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        function newRound() {
            if (!gameActive) return;

            pond.innerHTML = "";
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
            while (choices.length < 5) {
                let randomNum = generateRandomNumber();
                if (!choices.includes(randomNum)) {
                    choices.push(randomNum);
                }
            }

            // خلط الخيارات
            choices = shuffleArray(choices);

            // عرض الخيارات
            choices.forEach(num => {
                const div = document.createElement("div");
                div.className = "number";
                div.textContent = num;
                div.dataset.value = num;

                div.addEventListener("click", () => {
                    if (gameActive) {
                        checkAnswer(num, div);
                    }
                });

                pond.appendChild(div);
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

        function checkAnswer(selectedNumber, selectedElement) {
            if (!gameActive) return;

            attempts++;
            gameActive = false;

            // حساب الإجابة الصحيحة
            let correctAnswer = isNext ? currentNumber + 1 : currentNumber - 1;
            if (correctAnswer < minRange) correctAnswer = minRange;
            if (correctAnswer > maxRange) correctAnswer = maxRange;

            if (selectedNumber === correctAnswer) {
                // الإجابة الصحيحة
                points++;
                selectedElement.classList.add("correct");
                msg.textContent = getSuccessMessage();
                msg.className = "msg-correct";

                // تحديث النقاط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // الانتقال التلقائي بعد ثانية
                setTimeout(() => {
                    gameActive = true;
                    newRound();
                }, 1500);
            } else {
                // الإجابة الخاطئة
                selectedElement.classList.add("wrong");
                msg.textContent = getErrorMessage(correctAnswer);
                msg.className = "msg-wrong";

                // إظهار الإجابة الصحيحة
                const correctElement = Array.from(pond.children).find(
                    el => parseInt(el.dataset.value) === correctAnswer
                );
                if (correctElement) {
                    correctElement.classList.add("correct");
                }

                // تحديث المحاولات فقط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // إعادة تفعيل اللعبة بعد ثانيتين
                setTimeout(() => {
                    gameActive = true;
                    newRound();
                }, 2000);
            }
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! لقد صدت الرقم الصحيح!",
                "👏 رائع! صيد ممتاز",
                "💫 إبداع! أنت صياد ماهر",
                "🌟 برافو! لقد وجدت الكنز"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage(correctAnswer) {
            return `😅 ليس صحيح! الإجابة الصحيحة هي: ${correctAnswer}`;
        }

        newRoundBtn.addEventListener("click", () => {
            if (gameActive) {
                newRound();
            }
        });

        // بدء اللعبة
        newRound();
    </script>
</body>
</html>
