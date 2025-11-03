{{-- resources/views/mathplay/games/rabbits_in_the_garden.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>🐇 أرانب الطرح - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
            margin: 0;
            padding: 20px;
            text-align: center;
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
            color: #6a1b9a;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #f3e5f5;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #6a1b9a;
        }

        .game-area {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #ab47bc;
        }

        #instruction {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 20px;
            color: #6a1b9a;
            padding: 15px;
            background: #f3e5f5;
            border-radius: 15px;
            border-right: 4px solid #8e24aa;
        }

        .problem-container {
            background: linear-gradient(135deg, #e1bee7 0%, #ce93d8 100%);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border: 3px solid #8e24aa;
        }

        #problem {
            font-weight: bold;
            font-size: 28px;
            margin-bottom: 8px;
            color: #4a148c;
        }

        .garden-container {
            background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
            border-radius: 20px;
            padding: 25px;
            margin: 25px 0;
            border: 3px solid #4caf50;
            box-shadow: inset 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .garden-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.1) 10px,
                rgba(255, 255, 255, 0.1) 20px
            );
            pointer-events: none;
        }

        #garden {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-bottom: 12px;
            min-height: 120px;
            position: relative;
            z-index: 2;
        }

        .rabbit {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ab47bc 0%, #8e24aa 100%);
            color: white;
            font-size: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(171, 71, 188, 0.3);
            border: 3px solid transparent;
            position: relative;
            user-select: none;
        }

        .rabbit:hover {
            transform: translateY(-8px) scale(1.1);
            box-shadow: 0 12px 25px rgba(171, 71, 188, 0.4);
            border-color: #fff;
        }

        .rabbit:active {
            transform: translateY(-4px) scale(1.05);
        }

        .rabbit.leaving {
            animation: hopAway 0.8s ease-out forwards;
        }

        .rabbit-number {
            position: absolute;
            top: -5px;
            left: -5px;
            background: #ff9800;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .controls {
            margin: 25px 0;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        button {
            background: linear-gradient(135deg, #8e24aa 0%, #6a1b9a 100%);
            border: 0;
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            margin: 4px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(142, 36, 170, 0.3);
            font-family: inherit;
            font-size: 16px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(142, 36, 170, 0.4);
        }

        button#checkBtn {
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
        }

        button#resetBtn {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
        }

        #msg {
            min-height: 50px;
            font-weight: bold;
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .msg-success {
            color: #2e7d32;
            background: #e8f5e9;
            border: 2px solid #4caf50;
            animation: celebrate 0.6s ease-in-out;
        }

        .msg-error {
            color: #d32f2f;
            background: #ffebee;
            border: 2px solid #f44336;
        }

        .score {
            font-size: 18px;
            margin: 15px 0;
            color: #2c3e50;
            font-weight: bold;
            background: #f3e5f5;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .counter {
            font-size: 18px;
            margin: 15px 0;
            color: #6a1b9a;
            font-weight: bold;
            background: #e1bee7;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        @keyframes hopAway {
            0% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
            50% {
                transform: translateY(-20px) scale(1.1);
                opacity: 0.7;
            }
            100% {
                transform: translateY(-100px) scale(0.8);
                opacity: 0;
            }
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .bouncing {
            animation: bounce 2s ease-in-out infinite;
        }

        .remaining-rabbits {
            margin-top: 15px;
            font-size: 16px;
            color: #666;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐇 أرانب الطرح</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="game-area">
            <p id="instruction">اضغط على الأرانب التي تخرج من الحديقة حسب عملية الطرح</p>

            <div class="problem-container">
                <div id="problem">0 - 0 = ?</div>
                <div class="counter">الأرانب المتبقية: <span id="remainingCount">0</span></div>
            </div>

            <div class="garden-container">
                <div id="garden"></div>
                <div class="remaining-rabbits" id="remainingText"></div>
            </div>

            <div class="controls">
                <button id="checkBtn">✔ تحقق من الإجابة</button>
                <button id="resetBtn">↩️ إعادة الأرانب</button>
                <button id="newBtn">🔄 جولة جديدة</button>
            </div>

            <div id="msg"></div>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};
        const operationType = "{{ $settings->operation_type ?? 'subtraction' }}";

        const garden = document.getElementById('garden');
        const problemEl = document.getElementById('problem');
        const msg = document.getElementById('msg');
        const checkBtn = document.getElementById('checkBtn');
        const newBtn = document.getElementById('newBtn');
        const resetBtn = document.getElementById('resetBtn');
        const scoreElement = document.getElementById('score');
        const remainingCountEl = document.getElementById('remainingCount');
        const remainingTextEl = document.getElementById('remainingText');

        let start = 0;
        let subtract = 0;
        let points = 0;
        let attempts = 0;
        let gameActive = true;
        let rabbits = [];

        function newGame() {
            if (!gameActive) return;

            garden.innerHTML = '';
            msg.textContent = '';
            msg.className = '';
            rabbits = [];

            // توليد مسألة طرح ضمن المدى المحدد
            start = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            subtract = Math.floor(Math.random() * start) + 1; // طرح من 1 إلى start

            // التأكد من أن النتيجة ضمن المدى المسموح
            while (start - subtract < 0) {
                subtract = Math.floor(Math.random() * start) + 1;
            }

            problemEl.textContent = `${start} - ${subtract} = ?`;
            updateRemainingCount();

            // إنشاء الأرانب في الحديقة
            for (let i = 0; i < start; i++) {
                const rabbit = document.createElement('div');
                rabbit.className = 'rabbit bouncing';
                rabbit.textContent = '🐇';
                rabbit.dataset.index = i;

                // إضافة رقم للأرنب
                const number = document.createElement('div');
                number.className = 'rabbit-number';
                number.textContent = i + 1;
                rabbit.appendChild(number);

                rabbit.addEventListener('click', () => removeRabbit(rabbit));
                garden.appendChild(rabbit);
                rabbits.push(rabbit);
            }
        }

        function removeRabbit(rabbit) {
            if (!gameActive) return;

            // تأثير خروج الأرنب
            rabbit.classList.add('leaving');

            setTimeout(() => {
                if (rabbit.parentNode) {
                    rabbit.remove();
                    updateRemainingCount();
                }
            }, 800);
        }

        function updateRemainingCount() {
            const remaining = garden.querySelectorAll('.rabbit').length;
            remainingCountEl.textContent = remaining;

            const correctAnswer = start - subtract;
            remainingTextEl.textContent = `يجب أن يتبقى ${correctAnswer} أرنب بعد خروج ${subtract} أرنب`;

            if (remaining < correctAnswer) {
                remainingTextEl.style.color = '#f44336';
            } else if (remaining === correctAnswer) {
                remainingTextEl.style.color = '#4caf50';
            } else {
                remainingTextEl.style.color = '#666';
            }
        }

        function checkAnswer() {
            if (!gameActive) return;

            attempts++;
            const remaining = garden.querySelectorAll('.rabbit').length;
            const correctAnswer = start - subtract;

            if (remaining === correctAnswer) {
                // الإجابة الصحيحة
                points++;
                msg.textContent = getSuccessMessage(correctAnswer);
                msg.className = 'msg-success';
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                gameActive = false;
                setTimeout(() => {
                    gameActive = true;
                    newGame();
                }, 2000);
            } else {
                // الإجابة الخاطئة
                msg.textContent = getErrorMessage(remaining, correctAnswer);
                msg.className = 'msg-error';
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;
            }
        }

        function resetRabbits() {
            if (!gameActive) return;

            garden.innerHTML = '';
            rabbits.forEach(rabbitData => {
                const rabbit = document.createElement('div');
                rabbit.className = 'rabbit bouncing';
                rabbit.textContent = '🐇';

                const number = document.createElement('div');
                number.className = 'rabbit-number';
                number.textContent = parseInt(rabbitData.dataset.index) + 1;
                rabbit.appendChild(number);

                rabbit.addEventListener('click', () => removeRabbit(rabbit));
                garden.appendChild(rabbit);
            });

            updateRemainingCount();
            msg.textContent = '';
            msg.className = '';
        }

        function getSuccessMessage(correctAnswer) {
            const messages = [
                `🎉 أحسنت! ${start} - ${subtract} = ${correctAnswer}`,
                `👏 رائع! الإجابة صحيحة: ${correctAnswer}`,
                `💫 إبداع! لقد فهمت عملية الطرح`,
                `🌟 برافو! ${correctAnswer} أرانب متبقية`
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage(remaining, correctAnswer) {
            if (remaining > correctAnswer) {
                return `❌ ما زال هناك الكثير من الأرانب! يجب أن يتبقى ${correctAnswer} فقط`;
            } else {
                return `❌ خرجت أرانب كثيرة! يجب أن يتبقى ${correctAnswer}`;
            }
        }

        checkBtn.addEventListener('click', checkAnswer);
        newBtn.addEventListener('click', newGame);
        resetBtn.addEventListener('click', resetRabbits);

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
