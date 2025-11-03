{{-- resources/views/mathplay/games/number_scales.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚖️ موازين الأعداد - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%);
            text-align: center;
            padding: 20px;
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #ff6f00;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #fff3e0;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #ff6f00;
        }

        .game-area {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #ffb74d;
        }

        .instruction {
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 10px;
            color: #1976d2;
            border-right: 4px solid #2196f3;
        }

        .balance-container {
            position: relative;
            width: 320px;
            height: 200px;
            margin: 40px auto;
        }

        .stand {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 80px;
            background: linear-gradient(135deg, #795548 0%, #5d4037 100%);
            border-radius: 10px 10px 0 0;
        }

        .arm {
            width: 300px;
            height: 8px;
            background: linear-gradient(135deg, #795548 0%, #5d4037 100%);
            position: absolute;
            top: 80px;
            left: 50%;
            transform: translateX(-50%) rotate(0deg);
            transform-origin: center;
            transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .pan {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #ffe0b2 0%, #ffcc80 100%);
            border-radius: 50%;
            position: absolute;
            top: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            color: #5d4037;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 4px solid #ffb74d;
            transition: all 0.3s ease;
        }

        .pan:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .left {
            left: 10px;
        }

        .right {
            right: 10px;
        }

        .pan.highlight {
            background: linear-gradient(135deg, #a5d6a7 0%, #4caf50 100%);
            border-color: #2e7d32;
            color: white;
        }

        .comparison-symbols {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 25px 0;
            font-size: 24px;
            font-weight: bold;
            color: #666;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
            direction: ltr;
            flex-wrap: wrap;
        }

        button {
            font-size: 20px;
            padding: 15px 25px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(255, 152, 0, 0.3);
            font-family: inherit;
            font-weight: bold;
            min-width: 140px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 152, 0, 0.4);
        }

        button:active {
            transform: translateY(-1px);
        }

        button.left-btn {
            background: linear-gradient(135deg, #ff6f00 0%, #e65100 100%);
        }

        button.equal-btn {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
        }

        button.right-btn {
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
        }

        #msg {
            margin-top: 25px;
            font-weight: 600;
            font-size: 22px;
            min-height: 50px;
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

        .new-round-btn {
            background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%) !important;
            margin-top: 20px;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0% { transform: translateX(-50%) rotate(var(--rot, 0deg)); }
            25% { transform: translateX(-50%) rotate(calc(var(--rot, 0deg) - 8deg)); }
            50% { transform: translateX(-50%) rotate(calc(var(--rot, 0deg) + 8deg)); }
            75% { transform: translateX(-50%) rotate(calc(var(--rot, 0deg) - 8deg)); }
            100% { transform: translateX(-50%) rotate(var(--rot, 0deg)); }
        }

        .shake {
            animation: shake 0.6s ease;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .bounce {
            animation: bounce 0.5s ease-in-out;
        }

        .weight-indicator {
            position: absolute;
            bottom: -25px;
            font-size: 14px;
            color: #666;
            font-weight: bold;
        }

        .left-weight {
            left: 50px;
        }

        .right-weight {
            right: 50px;
        }

        @media (max-width: 600px) {
            .balance-container {
                width: 280px;
                height: 180px;
            }

            .arm {
                width: 260px;
            }

            .pan {
                width: 80px;
                height: 80px;
                font-size: 28px;
            }

            .buttons {
                flex-direction: column;
                align-items: center;
            }

            button {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚖️ موازين الأعداد</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="game-area">
            <div class="instruction">
                قارن بين العددين واختر أي الميزان أثقل
            </div>

            <div class="balance-container">
                <div class="stand"></div>
                <div class="arm" id="arm"></div>
                <div class="pan left" id="leftPan">
                    <span id="leftNumber">0</span>
                </div>
                <div class="pan right" id="rightPan">
                    <span id="rightNumber">0</span>
                </div>
                <div class="weight-indicator left-weight" id="leftWeight"></div>
                <div class="weight-indicator right-weight" id="rightWeight"></div>
            </div>

            <div class="comparison-symbols">
                <span>&lt;</span>
                <span>=</span>
                <span>&gt;</span>
            </div>

            <div class="buttons">
                <button class="left-btn" onclick="checkAnswer('left')">🔺 اليسار أكبر</button>
                <button class="equal-btn" onclick="checkAnswer('equal')">🟰 متساويان</button>
                <button class="right-btn" onclick="checkAnswer('right')">🔺 اليمين أكبر</button>
            </div>

            <div id="msg"></div>

            <button class="new-round-btn" id="newRoundBtn">🔄 رقمين جديدين</button>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 20 }};

        const leftPan = document.getElementById("leftPan");
        const rightPan = document.getElementById("rightPan");
        const leftNumber = document.getElementById("leftNumber");
        const rightNumber = document.getElementById("rightNumber");
        const leftWeight = document.getElementById("leftWeight");
        const rightWeight = document.getElementById("rightWeight");
        const arm = document.getElementById("arm");
        const msg = document.getElementById("msg");
        const newRoundBtn = document.getElementById("newRoundBtn");
        const scoreElement = document.getElementById("score");

        let n1 = 0;
        let n2 = 0;
        let points = 0;
        let attempts = 0;
        let gameActive = true;

        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        function newRound() {
            if (!gameActive) return;

            msg.textContent = "";
            msg.className = "";
            gameActive = true;

            // توليد عددين عشوائيين
            n1 = generateRandomNumber();
            n2 = generateRandomNumber();

            // التأكد من أن العددين مختلفين في معظم الحالات
            while (n1 === n2 && Math.random() < 0.7) {
                n2 = generateRandomNumber();
            }

            leftNumber.textContent = n1;
            rightNumber.textContent = n2;

            // تحديث مؤشرات الوزن
            leftWeight.textContent = `وزن: ${n1}`;
            rightWeight.textContent = `وزن: ${n2}`;

            // إعادة الميزان إلى وضعه المتوازن
            arm.style.transform = 'translateX(-50%) rotate(0deg)';
            arm.classList.remove("shake");

            // إزالة التمييز من الأطباق
            leftPan.classList.remove("highlight");
            rightPan.classList.remove("highlight");
        }

        function checkAnswer(choice) {
            if (!gameActive) return;

            attempts++;
            gameActive = false;

            const correctAnswer = n1 > n2 ? "left" : n1 < n2 ? "right" : "equal";

            let rotation = '0deg';
            if (correctAnswer === "left") {
                rotation = '-12deg';
                leftPan.classList.add("highlight");
            } else if (correctAnswer === "right") {
                rotation = '12deg';
                rightPan.classList.add("highlight");
            } else {
                // في حالة التساوي يبقى الميزان مستوياً
                leftPan.classList.add("highlight");
                rightPan.classList.add("highlight");
            }

            arm.style.setProperty('--rot', rotation);
            arm.style.transform = `translateX(-50%) rotate(${rotation})`;

            if (choice === correctAnswer) {
                // الإجابة الصحيحة
                points += 10;
                msg.textContent = getSuccessMessage(n1, n2, correctAnswer);
                msg.className = "msg-correct";
                arm.classList.add("shake");

                // تحديث النقاط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // الانتقال التلقائي بعد ثانيتين
                setTimeout(() => {
                    gameActive = true;
                    newRound();
                }, 2000);
            } else {
                // الإجابة الخاطئة
                msg.textContent = getErrorMessage(n1, n2, correctAnswer);
                msg.className = "msg-wrong";

                // تحديث المحاولات فقط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // إعادة تفعيل اللعبة بعد ثانيتين
                setTimeout(() => {
                    gameActive = true;
                    newRound();
                }, 2000);
            }
        }

        function getSuccessMessage(num1, num2, correct) {
            const comparisons = {
                left: `${num1} > ${num2}`,
                right: `${num1} < ${num2}`,
                equal: `${num1} = ${num2}`
            };

            const messages = [
                `🎉 أحسنت! ${comparisons[correct]}`,
                `👏 رائع! ${num1} ${correct === 'left' ? 'أكبر من' : correct === 'right' ? 'أصغر من' : 'يساوي'} ${num2}`,
                `💫 إبداع! لقد قارنت بشكل صحيح`,
                `🌟 برافو! ${comparisons[correct]}`
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage(num1, num2, correct) {
            const correctComparison = correct === 'left' ? 'أكبر من' :
                                   correct === 'right' ? 'أصغر من' : 'يساوي';

            const messages = [
                `❌ ليس صحيحاً! ${num1} ${correctComparison} ${num2}`,
                `💡 حاول مرة أخرى! العدد ${correct === 'left' ? 'الأيسر' : correct === 'right' ? 'الأيمن' : 'المتساوي'} هو الأكبر`,
                `🔍 انظر جيداً! ${num1} ${correctComparison} ${num2}`,
                `🔄 ركز أكثر في المقارنة!`
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
