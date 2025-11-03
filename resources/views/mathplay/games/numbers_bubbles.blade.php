{{-- resources/views/mathplay/games/numbers_bubbles.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🟢 فقاعات الأرقام - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #e1f5fe 0%, #b3e5fc 100%);
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
            color: #0288d1;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #e3f2fd;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #0288d1;
        }

        .game-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #4fc3f7;
        }

        .current-number {
            font-size: 32px;
            font-weight: bold;
            margin: 20px 0;
            padding: 20px;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 15px;
            color: #0288d1;
            border: 3px solid #29b6f6;
        }

        .instruction {
            font-size: 22px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: #fff9c4;
            border-radius: 10px;
            color: #f57f17;
            border-right: 4px solid #ffd54f;
        }

        #bubbles {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            min-height: 120px;
        }

        .bubble {
            display: inline-block;
            width: 80px;
            height: 80px;
            line-height: 80px;
            margin: 10px;
            font-size: 32px;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #03a9f4 0%, #0288d1 100%);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(3, 169, 244, 0.3);
            border: 4px solid transparent;
            position: relative;
            user-select: none;
            animation: float 3s ease-in-out infinite;
        }

        .bubble:hover {
            transform: scale(1.15);
            box-shadow: 0 10px 25px rgba(3, 169, 244, 0.4);
            border-color: #fff;
        }

        .bubble:active {
            transform: scale(1.05);
        }

        .bubble.correct {
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            border-color: #fff;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.4);
        }

        .bubble.wrong {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            border-color: #fff;
            animation: shake 0.5s ease-in-out;
        }

        button {
            margin-top: 20px;
            padding: 12px 24px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0288d1 0%, #01579b 100%);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(2, 136, 209, 0.3);
            font-weight: bold;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 136, 209, 0.4);
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
            background: #e3f2fd;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .concept-explanation {
            margin: 15px 0;
            padding: 12px;
            background: #f3e5f5;
            border-radius: 10px;
            color: #7b1fa2;
            font-weight: bold;
            border-right: 3px solid #ba68c8;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
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

        .number-sequence {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            color: #666;
        }

        .sequence-arrow {
            font-size: 24px;
            color: #0288d1;
        }

        @media (max-width: 600px) {
            .bubble {
                width: 70px;
                height: 70px;
                line-height: 70px;
                font-size: 28px;
            }

            .current-number {
                font-size: 28px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🟢 فقاعات الأرقام</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="concept-explanation">
            💡 تذكر: لكل رقم رقم سابق ورقم تالي في التسلسل العددي
        </div>

        <div class="game-box">
            <div class="current-number">
                الرقم الحالي هو: <span id="currentNumber"></span>
            </div>

            <div class="instruction">
                اضغط على <span id="action"></span> الرقم
            </div>

            <div class="number-sequence" id="numberSequence"></div>

            <div id="bubbles"></div>

            <div id="msg"></div>

            <button id="newRoundBtn">🔄 جولة جديدة</button>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 20 }};

        const bubblesEl = document.getElementById("bubbles");
        const msg = document.getElementById("msg");
        const actionEl = document.getElementById("action");
        const currentNumberEl = document.getElementById("currentNumber");
        const newRoundBtn = document.getElementById("newRoundBtn");
        const scoreElement = document.getElementById("score");
        const numberSequenceEl = document.getElementById("numberSequence");

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

            bubblesEl.innerHTML = "";
            msg.textContent = "";
            msg.className = "";
            numberSequenceEl.innerHTML = "";

            // توليد رقم حالي ضمن المدى 1-20
            // تجنب الأطراف لضمان وجود أرقام سابقة ولاحقة
            currentNumber = Math.floor(Math.random() * (maxRange - 2)) + 2;
            currentNumberEl.textContent = currentNumber;

            // تحديد إذا كان المطلوب الرقم التالي أو السابق
            isNext = Math.random() < 0.5;
            actionEl.textContent = isNext ? "التالي" : "السابق";

            // حساب الإجابة الصحيحة
            let correctAnswer = isNext ? currentNumber + 1 : currentNumber - 1;

            // التأكد من أن الإجابة ضمن المدى المسموح
            if (correctAnswer < minRange) correctAnswer = minRange;
            if (correctAnswer > maxRange) correctAnswer = maxRange;

            // تحديث تسلسل الأرقام المرئي
            updateNumberSequence(correctAnswer);

            // توليد خيارات متضمنة الإجابة الصحيحة
            let choices = [correctAnswer];

            // إضافة خيارات عشوائية أخرى
            while (choices.length < 6) {
                let randomNum = generateRandomNumber();
                if (!choices.includes(randomNum) && randomNum !== currentNumber) {
                    choices.push(randomNum);
                }
            }

            // خلط الخيارات
            choices = shuffleArray(choices);

            // عرض الفقاعات
            choices.forEach(num => {
                const bubble = document.createElement("div");
                bubble.className = "bubble";
                bubble.textContent = num;
                bubble.dataset.value = num;

                bubble.addEventListener("click", () => {
                    if (gameActive) {
                        checkAnswer(num, bubble);
                    }
                });

                bubblesEl.appendChild(bubble);
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

        function updateNumberSequence(correctAnswer) {
            let sequenceHTML = "";

            if (!isNext) {
                // إذا كان المطلوب الرقم السابق
                sequenceHTML = `
                    <span class="sequence-number">${correctAnswer}</span>
                    <span class="sequence-arrow">←</span>
                    <span class="sequence-number current">${currentNumber}</span>
                    <span class="sequence-arrow">→</span>
                    <span class="sequence-number">${currentNumber + 1}</span>
                `;
            } else {
                // إذا كان المطلوب الرقم التالي
                sequenceHTML = `
                    <span class="sequence-number">${currentNumber - 1}</span>
                    <span class="sequence-arrow">←</span>
                    <span class="sequence-number current">${currentNumber}</span>
                    <span class="sequence-arrow">→</span>
                    <span class="sequence-number">${correctAnswer}</span>
                `;
            }

            numberSequenceEl.innerHTML = sequenceHTML;
        }

        function checkAnswer(selectedNumber, selectedBubble) {
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
                selectedBubble.classList.add("correct");
                msg.textContent = getSuccessMessage();
                msg.className = "msg-correct";

                // تحديث النقاط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // إضافة تأثير النبض للفقاعة الصحيحة
                selectedBubble.classList.add("pulse");

                // الانتقال التلقائي بعد ثانية
                setTimeout(() => {
                    gameActive = true;
                    newRound();
                }, 1500);
            } else {
                // الإجابة الخاطئة
                selectedBubble.classList.add("wrong");
                msg.textContent = getErrorMessage(correctAnswer);
                msg.className = "msg-wrong";

                // إظهار الإجابة الصحيحة
                const correctBubble = Array.from(bubblesEl.children).find(
                    bubble => parseInt(bubble.dataset.value) === correctAnswer
                );
                if (correctBubble) {
                    correctBubble.classList.add("correct");
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
                "🎉 أحسنت! لقد وجدت الرقم الصحيح",
                "👏 رائع! معرفتك بالتسلسل العددي ممتازة",
                "💫 إبداع! أنت ماهر في الأرقام",
                "🌟 برافو! هذه هي الإجابة الصحيحة"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage(correctAnswer) {
            const messages = [
                `❌ ليس صحيحاً! الإجابة الصحيحة هي: ${correctAnswer}`,
                `💡 حاول مرة أخرى! الرقم ${isNext ? "التالي" : "السابق"} هو ${correctAnswer}`,
                `🔍 انظر جيداً! ${currentNumber} ${isNext ? "يليه" : "يسبقه"} ${correctAnswer}`,
                `🔄 ركز أكثر! ${correctAnswer} هو الرقم ${isNext ? "التالي" : "السابق"}`
            ];
            return messages[Math.floor(Math.random() * messages.length)];
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
