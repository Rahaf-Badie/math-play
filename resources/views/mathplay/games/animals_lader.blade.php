{{-- resources/views/mathplay/games/animals_ladder.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐒 سلم الحيوانات - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            text-align: center;
            padding: 20px;
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #fb8c00;
            margin-bottom: 15px;
            font-size: 32px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #fff3e0;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #fb8c00;
        }

        .game-area {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #ffb74d;
        }

        .ladder-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 30px 0;
            position: relative;
        }

        .ladder-side {
            position: absolute;
            width: 10px;
            background: linear-gradient(135deg, #8d6e63 0%, #5d4037 100%);
            border-radius: 5px;
        }

        .ladder-side.left {
            left: 40px;
        }

        .ladder-side.right {
            right: 40px;
        }

        .ladder {
            width: 250px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .step {
            height: 70px;
            background: linear-gradient(135deg, #ffe0b2 0%, #ffb74d 100%);
            border-radius: 12px;
            margin: 8px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 32px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid transparent;
            position: relative;
            z-index: 3;
        }

        .step:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border-color: #fb8c00;
            background: linear-gradient(135deg, #ffb74d 0%, #fb8c00 100%);
        }

        .step:active {
            transform: translateY(-1px) scale(1.02);
        }

        .step.correct {
            background: linear-gradient(135deg, #a5d6a7 0%, #4caf50 100%);
            border-color: #2e7d32;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.4);
        }

        .step.wrong {
            background: linear-gradient(135deg, #ef9a9a 0%, #f44336 100%);
            border-color: #d32f2f;
            animation: shake 0.5s ease-in-out;
        }

        .step-number {
            position: absolute;
            top: -10px;
            left: -10px;
            background: #fb8c00;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        #instruction {
            font-size: 24px;
            font-weight: bold;
            margin: 25px 0;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 15px;
            color: #1976d2;
            border-right: 4px solid #1976d2;
        }

        button {
            font-size: 18px;
            padding: 12px 24px;
            margin: 10px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #fb8c00 0%, #f57c00 100%);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(251, 140, 0, 0.3);
            font-family: inherit;
            font-weight: bold;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(251, 140, 0, 0.4);
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
            background: #fff3e0;
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

        @keyframes climb {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        .climbing {
            animation: climb 0.5s ease-in-out;
        }

        .ordinal-numbers {
            display: flex;
            justify-content: space-around;
            margin: 15px 0;
            font-size: 16px;
            color: #666;
            font-weight: bold;
        }

        .animal-names {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐒 سلم الحيوانات</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="game-area">
            <div id="instruction"></div>

            <div class="ladder-container">
                <div class="ladder-side left"></div>
                <div class="ladder-side right"></div>
                <div class="ladder" id="ladder"></div>
            </div>

            <div class="ordinal-numbers">
                <span>الأول</span>
                <span>الثاني</span>
                <span>الثالث</span>
                <span>الرابع</span>
                <span>الخامس</span>
            </div>

            <div id="msg"></div>

            <button id="newGameBtn">🔄 جولة جديدة</button>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade (يمكن استخدامها لتحديد عدد الحيوانات أو الصعوبة)
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 5 }};

        const ladder = document.getElementById("ladder");
        const instruction = document.getElementById("instruction");
        const msg = document.getElementById("msg");
        const newGameBtn = document.getElementById("newGameBtn");
        const scoreElement = document.getElementById("score");

        const animals = [
            { emoji: "🐶", name: "الكلب" },
            { emoji: "🐱", name: "القط" },
            { emoji: "🐰", name: "الأرنب" },
            { emoji: "🐵", name: "القرد" },
            { emoji: "🦊", name: "الثعلب" },
            { emoji: "🐻", name: "الدب" },
            { emoji: "🐼", name: "الباندا" },
            { emoji: "🐯", name: "النمر" }
        ];

        const ordinalNames = ["الأول", "الثاني", "الثالث", "الرابع", "الخامس", "السادس", "السابع", "الثامن"];

        let correctIndex;
        let points = 0;
        let attempts = 0;
        let gameActive = true;
        let currentAnimals = [];

        function newGame() {
            if (!gameActive) return;

            ladder.innerHTML = "";
            msg.textContent = "";
            msg.className = "";

            // اختيار عدد عشوائي من الحيوانات (بين 4 و6)
            const numAnimals = Math.floor(Math.random() * 3) + 4;
            currentAnimals = shuffleArray([...animals]).slice(0, numAnimals);

            // عرض سلم الحيوانات
            currentAnimals.forEach((animal, index) => {
                const step = document.createElement("div");
                step.className = "step";
                step.dataset.index = index;

                // إضافة الرمز
                const emojiSpan = document.createElement("span");
                emojiSpan.textContent = animal.emoji;
                emojiSpan.style.fontSize = "32px";
                step.appendChild(emojiSpan);

                // إضافة رقم الخطوة
                const stepNumber = document.createElement("div");
                stepNumber.className = "step-number";
                stepNumber.textContent = index + 1;
                step.appendChild(stepNumber);

                // إضافة اسم الحيوان
                const nameSpan = document.createElement("div");
                nameSpan.className = "animal-names";
                nameSpan.textContent = animal.name;
                step.appendChild(nameSpan);

                step.addEventListener("click", () => {
                    if (gameActive) {
                        checkAnswer(index, step);
                    }
                });

                ladder.appendChild(step);
            });

            // اختيار مرتبة عشوائية للسؤال
            correctIndex = Math.floor(Math.random() * currentAnimals.length);
            instruction.textContent = `من هو الحيوان في المرتبة ${ordinalNames[correctIndex]}؟`;
        }

        function shuffleArray(array) {
            const shuffled = [...array];
            for (let i = shuffled.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
            }
            return shuffled;
        }

        function checkAnswer(selectedIndex, selectedStep) {
            if (!gameActive) return;

            attempts++;
            gameActive = false;

            if (selectedIndex === correctIndex) {
                // الإجابة الصحيحة
                points++;
                selectedStep.classList.add("correct");
                msg.textContent = getSuccessMessage();
                msg.className = "msg-correct";

                // تأثير التسلق
                selectedStep.classList.add("climbing");

                // تحديث النقاط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // الانتقال التلقائي بعد ثانية
                setTimeout(() => {
                    gameActive = true;
                    newGame();
                }, 1500);
            } else {
                // الإجابة الخاطئة
                selectedStep.classList.add("wrong");
                msg.textContent = getErrorMessage();
                msg.className = "msg-wrong";

                // إظهار الإجابة الصحيحة
                const correctStep = ladder.children[correctIndex];
                correctStep.classList.add("correct");

                // تحديث المحاولات فقط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // إعادة تفعيل اللعبة بعد ثانيتين
                setTimeout(() => {
                    gameActive = true;
                    newGame();
                }, 2000);
            }
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! لقد وجدت الحيوان الصحيح",
                "👏 رائع! أنت ماهر في الترتيب",
                "💫 إبداع! معرفتك ممتازة",
                "🌟 برافو! إجابة صحيحة"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage() {
            const messages = [
                "😅 ليس صحيح! حاول مرة أخرى",
                "❌ خطأ! انظر جيداً للترتيب",
                "💡 فكر في الترتيب من جديد",
                "🔄 ركز أكثر في المراتب"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        newGameBtn.addEventListener("click", () => {
            if (gameActive) {
                newGame();
            }
        });

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
