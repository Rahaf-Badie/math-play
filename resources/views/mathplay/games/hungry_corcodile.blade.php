{{-- resources/views/mathplay/games/hungry_crocodile.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐊 لعبة التمساح الجائع - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
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
            color: #00796b;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 25px;
            font-size: 18px;
            background: #f1f8e9;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #00796b;
        }

        .game-box {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #4db6ac;
        }

        .numbers {
            font-size: 60px;
            font-weight: bold;
            color: #00796b;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            margin: 30px 0;
        }

        .crocodile {
            font-size: 50px;
            margin: 0 15px;
            animation: bite 0.5s infinite alternate;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
        }

        button {
            font-size: 28px;
            padding: 15px 25px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #26a69a 0%, #00796b 100%);
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(38, 166, 154, 0.3);
            font-weight: bold;
            min-width: 80px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(38, 166, 154, 0.4);
        }

        button:active {
            transform: translateY(-1px);
        }

        .new-round-btn {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
            font-size: 20px;
            padding: 12px 24px;
        }

        .new-round-btn:hover {
            box-shadow: 0 6px 20px rgba(255, 152, 0, 0.4);
        }

        #msg {
            margin-top: 20px;
            font-size: 24px;
            font-weight: 600;
            min-height: 40px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .correct {
            color: #2e7d32;
            background: #e8f5e9;
            border: 2px solid #4caf50;
        }

        .wrong {
            color: #d32f2f;
            background: #ffebee;
            border: 2px solid #f44336;
        }

        .score {
            font-size: 18px;
            margin: 20px 0;
            color: #2c3e50;
            font-weight: bold;
            background: #e0f2f1;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        @keyframes bite {
            0% { transform: scale(1) rotate(0deg); }
            100% { transform: scale(1.1) rotate(5deg); }
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes wrongShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .celebrate {
            animation: celebrate 0.6s ease-in-out;
        }

        .wrong-shake {
            animation: wrongShake 0.5s ease-in-out;
        }

        .explanation {
            margin-top: 15px;
            font-size: 18px;
            color: #555;
            background: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            border-right: 3px solid #00796b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐊 لعبة التمساح الجائع</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="game-box">
            <div class="numbers">
                <span id="num1">5</span>
                <span class="crocodile">🐊</span>
                <span id="num2">8</span>
            </div>

            <div class="explanation" id="explanation">
                التمساح الجائع دائماً يأكل الرقم <strong>الأكبر</strong>! اختر الاتجاه الصحيح
            </div>

            <div class="buttons">
                <button onclick="checkAnswer('<')">&lt; أصغر</button>
                <button onclick="checkAnswer('=')">= يساوي</button>
                <button onclick="checkAnswer('>')">أكبر &gt;</button>
            </div>

            <p id="msg"></p>

            <button class="new-round-btn" onclick="newRound()">🔄 رقمين جديدين</button>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};

        const num1El = document.getElementById("num1");
        const num2El = document.getElementById("num2");
        const msg = document.getElementById("msg");
        const scoreElement = document.getElementById("score");
        const explanation = document.getElementById("explanation");
        const crocodile = document.querySelector('.crocodile');

        let points = 0;
        let attempts = 0;
        let gameActive = true;

        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        function newRound() {
            if (!gameActive) return;

            // إعادة تعيين الأنماط
            msg.textContent = "";
            msg.className = "";
            crocodile.classList.remove('celebrate', 'wrong-shake');

            // توليد أرقام جديدة
            let n1 = generateRandomNumber();
            let n2 = generateRandomNumber();

            // التأكد من وجود تنوع في الأسئلة (ليس دائماً نفس الرقمين)
            while (n1 === n2 && (maxRange - minRange) > 0) {
                n2 = generateRandomNumber();
            }

            num1El.textContent = n1;
            num2El.textContent = n2;

            // تحديث الشرح بناءً على الأرقام
            explanation.innerHTML = `التمساح الجائع دائماً يأكل الرقم <strong>الأكبر</strong>! ماذا سيأكل التمساح؟`;
        }

        function checkAnswer(op) {
            if (!gameActive) return;

            attempts++;
            const n1 = parseInt(num1El.textContent);
            const n2 = parseInt(num2El.textContent);
            const correctOp = n1 > n2 ? ">" : n1 < n2 ? "<" : "=";

            if (op === correctOp) {
                // الإجابة الصحيحة
                points++;
                msg.textContent = getSuccessMessage(n1, n2, op);
                msg.className = "correct";
                crocodile.classList.add('celebrate');

                // تحديث النقاط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // الانتقال التلقائي بعد ثانية
                gameActive = false;
                setTimeout(() => {
                    gameActive = true;
                    newRound();
                }, 1500);
            } else {
                // الإجابة الخاطئة
                msg.textContent = getErrorMessage(n1, n2, correctOp);
                msg.className = "wrong";
                crocodile.classList.add('wrong-shake');

                // تحديث المحاولات فقط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // إعادة تفعيل اللعبة بعد ثانيتين
                gameActive = false;
                setTimeout(() => {
                    gameActive = true;
                    newRound();
                }, 2000);
            }
        }

        function getSuccessMessage(n1, n2, op) {
            const messages = [
                "أحسنت! 🎉 التمساح أكل الرقم الأكبر بنجاح 🍃",
                "رائع! 👏 التمساح يشكرك على الوجبة اللذيذة",
                "إجابة صحيحة! 🐊 التمساح سعيد باختيارك",
                "ممتاز! 💫 لقد أطعمت التمساح بشكل صحيح"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage(n1, n2, correctOp) {
            let correctAnswer = "";
            if (correctOp === ">") {
                correctAnswer = `${n1} أكبر من ${n2}`;
            } else if (correctOp === "<") {
                correctAnswer = `${n1} أصغر من ${n2}`;
            } else {
                correctAnswer = `${n1} يساوي ${n2}`;
            }

            return `😅 التمساح اختار خطأ! الإجابة الصحيحة: ${correctAnswer}`;
        }

        // بدء اللعبة
        newRound();
    </script>
</body>
</html>
