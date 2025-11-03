<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 لعبة صيد الأعداد الزوجية والفردية - {{ $lesson_game->lesson->name }}</title>
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
            padding: 25px;
            width: 100%;
            max-width: 500px;
            margin-bottom: 20px;
        }

        .lesson-info {
            background: linear-gradient(to right, #fd79a8, #e84393);
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            margin-bottom: 20px;
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
            margin-bottom: 20px;
            border-right: 5px solid #fd79a8;
            text-align: right;
            line-height: 1.6;
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.1rem;
        }

        .game-mode-selector {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .mode-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex: 1;
        }

        .mode-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .mode-btn.active {
            background: linear-gradient(135deg, #fd79a8, #e84393);
            transform: scale(1.05);
        }

        .game-container {
            position: relative;
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #dfe6e9, #b2bec3);
            border-radius: 20px;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
            margin: 20px 0;
            border: 3px solid #636e72;
        }

        .ball {
            position: absolute;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            color: white;
            font-size: 1.6rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
            user-select: none;
            animation: float 3s ease-in-out infinite;
        }

        .ball:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        }

        .ball.even {
            background: linear-gradient(135deg, #00b894, #00a085);
            border: 3px solid #00a085;
        }

        .ball.odd {
            background: linear-gradient(135deg, #e84393, #fd79a8);
            border: 3px solid #e84393;
        }

        .ball.correct {
            animation: correctPop 0.5s ease-out forwards;
        }

        .ball.wrong {
            animation: wrongShake 0.5s ease-in-out forwards;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }

        @keyframes correctPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% {
                transform: scale(0);
                opacity: 0;
            }
        }

        @keyframes wrongShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .stats-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            background: #f1faee;
            padding: 18px;
            border-radius: 15px;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .stat-label {
            font-size: 1rem;
            color: #457b9d;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1d3557;
        }

        #message {
            font-size: 1.3rem;
            margin: 15px 0;
            min-height: 50px;
            font-weight: bold;
            padding: 12px;
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
            background: rgba(116, 185, 255, 0.2);
            color: #1d3557;
            border: 2px solid #74b9ff;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
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

        .target-indicator {
            font-size: 1.3rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 50px;
            margin: 15px 0;
            display: inline-block;
        }

        .target-even {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        .target-odd {
            background: linear-gradient(135deg, #e84393, #fd79a8);
            color: white;
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

            .game-container {
                height: 350px;
            }

            .ball {
                width: 60px;
                height: 60px;
                font-size: 1.4rem;
            }

            .mode-btn, .control-btn {
                padding: 12px 18px;
                font-size: 1rem;
            }

            .stat-value {
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

        <h1 class="game-title">🎯 صيد الأعداد الزوجية والفردية</h1>

        <div class="instructions">
            <p>🎯 الهدف: اصطد الأعداد الصحيحة حسب نوع اللعبة المختار</p>
            <p>💡 تذكر: العدد الزوجي يقبل القسمة على ٢، والفردي لا يقبل القسمة على ٢</p>
        </div>

        <div class="game-mode-selector">
            <button class="mode-btn active" id="even-mode" onclick="setGameMode('even')">
                🟢 صيد الأعداد الزوجية
            </button>
            <button class="mode-btn" id="odd-mode" onclick="setGameMode('odd')">
                🔴 صيد الأعداد الفردية
            </button>
        </div>

        <div class="target-indicator target-even" id="target-indicator">
            الهدف: الأعداد الزوجية 🟢
        </div>

        <div class="game-container" id="game-container"></div>

        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-label">النقاط</div>
                <div class="stat-value" id="score">0</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">الوقت</div>
                <div class="stat-value" id="timer">30</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">المستوى</div>
                <div class="stat-value" id="level">1</div>
            </div>
        </div>

        <div id="message" class="message-info">
            اختر وضع اللعبة ثم ابدأ بصيد الأعداد!
        </div>

        <div class="controls">
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
        let timeLeft = 30;
        let gameLevel = 1;
        let gameMode = 'even'; // 'even' أو 'odd'
        let gameActive = false;
        let timerInterval;
        let ballCount = 8;

        // عناصر DOM
        const gameContainer = document.getElementById("game-container");
        const scoreDisplay = document.getElementById("score");
        const timerDisplay = document.getElementById("timer");
        const levelDisplay = document.getElementById("level");
        const messageDisplay = document.getElementById("message");
        const startBtn = document.getElementById("start-btn");
        const restartBtn = document.getElementById("restart-btn");
        const evenModeBtn = document.getElementById("even-mode");
        const oddModeBtn = document.getElementById("odd-mode");
        const targetIndicator = document.getElementById("target-indicator");
        const celebrationDiv = document.getElementById("celebration");

        // تعيين وضع اللعبة
        function setGameMode(mode) {
            gameMode = mode;

            if (mode === 'even') {
                evenModeBtn.classList.add('active');
                oddModeBtn.classList.remove('active');
                targetIndicator.className = 'target-indicator target-even';
                targetIndicator.innerHTML = 'الهدف: الأعداد الزوجية 🟢';
            } else {
                oddModeBtn.classList.add('active');
                evenModeBtn.classList.remove('active');
                targetIndicator.className = 'target-indicator target-odd';
                targetIndicator.innerHTML = 'الهدف: الأعداد الفردية 🔴';
            }

            if (!gameActive) {
                messageDisplay.textContent = `الوضع: ${mode === 'even' ? 'صيد الزوجي' : 'صيد الفردي'} - اضغط ابدأ للعب`;
                messageDisplay.className = 'message-info';
            }
        }

        // إنشاء الكرات
        function createBalls() {
            gameContainer.innerHTML = "";
            const balls = [];

            for (let i = 0; i < ballCount; i++) {
                const ball = document.createElement("div");
                const number = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                const isEven = number % 2 === 0;

                ball.className = `ball ${isEven ? 'even' : 'odd'}`;
                ball.textContent = number;
                ball.dataset.number = number;
                ball.dataset.even = isEven;

                // موقع عشوائي مع تجنب التداخل
                let positionValid = false;
                let attempts = 0;
                let top, left;

                while (!positionValid && attempts < 50) {
                    top = Math.random() * (gameContainer.offsetHeight - 70);
                    left = Math.random() * (gameContainer.offsetWidth - 70);

                    positionValid = true;
                    for (const otherBall of balls) {
                        const dx = Math.abs(left - otherBall.left);
                        const dy = Math.abs(top - otherBall.top);
                        if (dx < 80 && dy < 80) {
                            positionValid = false;
                            break;
                        }
                    }
                    attempts++;
                }

                ball.style.top = `${top}px`;
                ball.style.left = `${left}px`;

                // تأثير ظهور متدرج
                ball.style.opacity = '0';
                ball.style.transform = 'scale(0)';

                ball.addEventListener('click', () => checkBall(ball));

                gameContainer.appendChild(ball);
                balls.push({top, left});

                // تأثير ظهور
                setTimeout(() => {
                    ball.style.transition = 'all 0.5s ease';
                    ball.style.opacity = '1';
                    ball.style.transform = 'scale(1)';
                }, i * 100);
            }
        }

        // التحقق من الكرة
        function checkBall(ball) {
            if (!gameActive) return;

            const number = parseInt(ball.dataset.number);
            const isEven = ball.dataset.even === 'true';
            let isCorrect = false;

            if (gameMode === 'even' && isEven) {
                isCorrect = true;
            } else if (gameMode === 'odd' && !isEven) {
                isCorrect = true;
            }

            if (isCorrect) {
                // الإجابة صحيحة
                ball.classList.add('correct');
                score += 10;

                // مكافأة إضافية بناءً على المستوى
                score += gameLevel * 2;

                messageDisplay.textContent = getRandomSuccessMessage();
                messageDisplay.className = 'message-success';

                // إزالة الكرة بعد الأنيميشن
                setTimeout(() => {
                    ball.remove();
                    checkGameProgress();
                }, 500);
            } else {
                // الإجابة خاطئة
                ball.classList.add('wrong');
                score = Math.max(0, score - 5);

                messageDisplay.textContent = "خطأ! هذا ليس الهدف 😅";
                messageDisplay.className = 'message-error';

                // إعادة الكرة بعد الأنيميشن
                setTimeout(() => {
                    ball.classList.remove('wrong');
                }, 500);
            }

            scoreDisplay.textContent = score;
        }

        // رسائل نجاح عشوائية
        function getRandomSuccessMessage() {
            const messages = [
                "أحسنت! 🎯",
                "إصابة مباشرة! ✅",
                "رائع! 🌟",
                "ممتاز! 👏",
                "برافو! 💫"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // التحقق من تقدم اللعبة
        function checkGameProgress() {
            const remainingBalls = document.querySelectorAll('.ball:not(.correct)').length;

            if (remainingBalls === 0) {
                // جميع الكرات تم اصطيادها
                createBalls();

                // زيادة المستوى
                gameLevel++;
                levelDisplay.textContent = gameLevel;

                // زيادة صعوبة اللعبة
                if (gameLevel % 2 === 0 && ballCount < 12) {
                    ballCount++;
                }

                // تقليل الوقت في المستويات الأعلى
                if (gameLevel > 3) {
                    timeLeft = Math.max(20, 30 - gameLevel);
                    timerDisplay.textContent = timeLeft;
                }

                messageDisplay.textContent = `مستوى جديد! المستوى ${gameLevel} 🔥`;
                messageDisplay.className = 'message-info';
            }
        }

        // بدء اللعبة
        function startGame() {
            if (gameActive) return;

            gameActive = true;
            score = 0;
            timeLeft = 30;
            gameLevel = 1;
            ballCount = 8;

            scoreDisplay.textContent = score;
            levelDisplay.textContent = gameLevel;
            timerDisplay.textContent = timeLeft;

            startBtn.style.display = 'none';
            restartBtn.style.display = 'none';

            messageDisplay.textContent = `اصطد الأعداد ${gameMode === 'even' ? 'الزوجية' : 'الفردية'}!`;
            messageDisplay.className = 'message-info';

            createBalls();

            // بدء المؤقت
            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                timeLeft--;
                timerDisplay.textContent = timeLeft;

                if (timeLeft <= 10) {
                    timerDisplay.style.color = '#e63946';
                }

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    endGame();
                }
            }, 1000);
        }

        // إنهاء اللعبة
        function endGame() {
            gameActive = false;
            clearInterval(timerInterval);

            messageDisplay.innerHTML = `🎉 انتهى الوقت!<br>مجموع نقاطك: ${score} | المستوى: ${gameLevel} 🌟`;
            messageDisplay.className = 'message-success';

            // إخفاء الكرات المتبقية
            document.querySelectorAll('.ball').forEach(ball => {
                ball.style.opacity = '0.3';
                ball.style.pointerEvents = 'none';
            });

            restartBtn.style.display = 'inline-block';

            // تأثير احتفالي إذا كانت النقاط عالية
            if (score >= 100) {
                createConfetti();
            }
        }

        // إعادة تشغيل اللعبة
        function restartGame() {
            gameContainer.innerHTML = "";
            timerDisplay.style.color = '#1d3557';
            celebrationDiv.style.display = 'none';
            celebrationDiv.innerHTML = '';
            startGame();
        }

        // تأثير احتفالي
        function createConfetti() {
            celebrationDiv.style.display = 'block';
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#fd79a8'];

            for (let i = 0; i < 120; i++) {
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
