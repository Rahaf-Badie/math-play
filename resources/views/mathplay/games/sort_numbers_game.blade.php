<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة ترتيب الأعداد - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tahoma", sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: #333;
            text-align: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
        }

        .lesson-info {
            background: linear-gradient(to right, #74b9ff, #0984e3);
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .game-title {
            color: #1d3557;
            font-size: 2.2rem;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .instructions {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-right: 5px solid #f4a261;
            text-align: right;
        }

        .instructions p {
            margin: 5px 0;
            font-size: 1rem;
        }

        #direction-select {
            margin-bottom: 25px;
            padding: 15px;
            background: #e9f7fe;
            border-radius: 10px;
        }

        .direction-btn {
            background: linear-gradient(to right, #00b894, #00a085);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            cursor: pointer;
            margin: 0 10px;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .direction-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }

        .direction-btn:active {
            transform: translateY(1px);
        }

        #numbers {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin: 25px 0;
        }

        .number-btn {
            background: linear-gradient(to bottom, #457b9d, #1d3557);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 18px 22px;
            font-size: 1.6rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 70px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .number-btn:hover:not(.correct):not(.wrong) {
            transform: scale(1.1);
            box-shadow: 0 6px 8px rgba(0,0,0,0.2);
        }

        .number-btn.correct {
            background: linear-gradient(to right, #00b894, #00a085);
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 184, 148, 0.4);
        }

        .number-btn.wrong {
            background: linear-gradient(to right, #ff7675, #e84393);
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        #message {
            font-size: 1.3rem;
            margin: 20px 0;
            min-height: 40px;
            font-weight: bold;
            padding: 10px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .message-success {
            background: rgba(0, 184, 148, 0.2);
            color: #00b894;
        }

        .message-error {
            background: rgba(255, 118, 117, 0.2);
            color: #e63946;
        }

        .message-info {
            background: rgba(116, 185, 255, 0.2);
            color: #1d3557;
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            background: #f1faee;
            padding: 15px;
            border-radius: 10px;
        }

        .score-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .score-label {
            font-size: 0.9rem;
            color: #457b9d;
        }

        .score-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1d3557;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .control-btn {
            background: linear-gradient(to right, #f4a261, #e76f51);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }

        .control-btn:active {
            transform: translateY(1px);
        }

        .celebration {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 10;
            display: none;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #f1c40f;
            opacity: 0;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .game-title {
                font-size: 1.8rem;
            }

            .number-btn {
                padding: 15px 18px;
                font-size: 1.4rem;
                min-width: 60px;
            }

            .direction-btn, .control-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1 class="game-title">🎯 رتب الأعداد</h1>

        <div class="instructions">
            <p>المدى: {{ $min_range }} إلى {{ $max_range }}</p>
            <p>اختر اتجاه الترتيب ثم انقر على الأعداد بالترتيب الصحيح</p>
        </div>

        <div id="direction-select">
            <p style="margin-bottom: 15px; font-weight: bold; color: #1d3557;">اختر اتجاه الترتيب:</p>
            <button class="direction-btn" onclick="setDirection('asc')">
                ⬆ تصاعدي (من الأصغر إلى الأكبر)
            </button>
            <button class="direction-btn" onclick="setDirection('desc')">
                ⬇ تنازلي (من الأكبر إلى الأصغر)
            </button>
        </div>

        <div id="numbers"></div>

        <div id="message" class="message-info"></div>

        <div class="score-container">
            <div class="score-item">
                <div class="score-label">النقاط</div>
                <div class="score-value" id="score">0</div>
            </div>
            <div class="score-item">
                <div class="score-label">المستوى</div>
                <div class="score-value" id="level">1</div>
            </div>
            <div class="score-item">
                <div class="score-label">الوقت</div>
                <div class="score-value" id="timer">60</div>
            </div>
        </div>

        <div class="controls">
            <button class="control-btn" id="restart-btn" onclick="restartGame()" style="display:none;">
                🔁 العب مرة أخرى
            </button>
            <button class="control-btn" id="hint-btn" onclick="giveHint()" style="display:none;">
                💡 تلميح
            </button>
        </div>

        <div class="celebration" id="celebration"></div>
    </div>

    <script>
        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};

        // متغيرات اللعبة
        let direction = null;
        let numbers = [];
        let correctOrder = [];
        let currentIndex = 0;
        let score = 0;
        let level = 1;
        let totalLevels = 5;
        let timer;
        let timeLeft = 60;
        let hintsUsed = 0;

        // عناصر DOM
        const numbersDiv = document.getElementById("numbers");
        const messageDiv = document.getElementById("message");
        const scoreDiv = document.getElementById("score");
        const levelDiv = document.getElementById("level");
        const timerDiv = document.getElementById("timer");
        const restartBtn = document.getElementById("restart-btn");
        const hintBtn = document.getElementById("hint-btn");
        const directionSelect = document.getElementById("direction-select");
        const celebrationDiv = document.getElementById("celebration");

        function setDirection(dir) {
            direction = dir;
            directionSelect.style.display = "none";
            hintBtn.style.display = "inline-block";
            startTimer();
            startLevel();
        }

        function startLevel() {
            // تحديد عدد الأعداد بناءً على المستوى
            let count = 3 + (level - 1);
            if (count > 8) count = 8; // حد أقصى 8 أعداد

            // إنشاء أعداد عشوائية ضمن المدى المحدد
            numbers = [];
            for (let i = 0; i < count; i++) {
                numbers.push(Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange);
            }

            // إنشاء الترتيب الصحيح
            correctOrder = [...numbers].sort((a, b) => a - b);
            if (direction === "desc") correctOrder.reverse();

            // خلط الأعداد لعرضها
            shuffleArray(numbers);

            // عرض الأعداد
            numbersDiv.innerHTML = "";
            numbers.forEach(num => {
                const btn = document.createElement("button");
                btn.textContent = num;
                btn.className = "number-btn";
                btn.onclick = () => checkNumber(num, btn);
                numbersDiv.appendChild(btn);
            });

            // إعادة تعليمات اللعبة
            messageDiv.textContent = direction === "asc"
                ? "انقر على الأعداد بالترتيب من الأصغر إلى الأكبر"
                : "انقر على الأعداد بالترتيب من الأكبر إلى الأصغر";
            messageDiv.className = "message-info";

            currentIndex = 0;
            levelDiv.textContent = level;
        }

        function checkNumber(num, btn) {
            if (num === correctOrder[currentIndex]) {
                // الإجابة صحيحة
                btn.classList.add("correct");
                btn.disabled = true;
                currentIndex++;

                // حساب النقاط (أعلى نقاط للمستويات الأعلى)
                score += 10 * level;
                scoreDiv.textContent = score;

                // رسالة تشجيعية عشوائية
                const messages = ["ممتاز! 🌟", "رائع! 👏", "إجابة صحيحة! ✓", "أحسنت! 🎯"];
                messageDiv.textContent = messages[Math.floor(Math.random() * messages.length)];
                messageDiv.className = "message-success";

                // التحقق من اكتمال المستوى
                if (currentIndex === correctOrder.length) {
                    if (level < totalLevels) {
                        messageDiv.textContent = `مستوى مكتمل! انتقل إلى المستوى ${level + 1} 🌟`;
                        level++;
                        setTimeout(startLevel, 1500);
                    } else {
                        endGame(true);
                    }
                }
            } else {
                // الإجابة خاطئة
                btn.classList.add("wrong");
                messageDiv.textContent = "خطأ! حاول مرة أخرى 😊";
                messageDiv.className = "message-error";

                // خصم نقاط
                score = Math.max(0, score - 5);
                scoreDiv.textContent = score;

                setTimeout(() => btn.classList.remove("wrong"), 800);
            }
        }

        function giveHint() {
            if (hintsUsed < 3) {
                // إظهار التلميح (تسليط الضوء على الرقم التالي الصحيح)
                const nextNumber = correctOrder[currentIndex];
                const buttons = numbersDiv.getElementsByClassName("number-btn");

                for (let btn of buttons) {
                    if (parseInt(btn.textContent) === nextNumber && !btn.classList.contains("correct")) {
                        btn.style.boxShadow = "0 0 0 3px #f4a261";
                        setTimeout(() => {
                            btn.style.boxShadow = "";
                        }, 1500);
                        break;
                    }
                }

                hintsUsed++;
                // خصم نقاط مقابل التلميح
                score = Math.max(0, score - 15);
                scoreDiv.textContent = score;

                messageDiv.textContent = `تم استخدام تلميح! (-15 نقطة)`;
                messageDiv.className = "message-info";
            } else {
                messageDiv.textContent = "لقد استخدمت جميع التلميحات المتاحة!";
                messageDiv.className = "message-error";
            }
        }

        function startTimer() {
            clearInterval(timer);
            timeLeft = 60;
            timerDiv.textContent = timeLeft;

            timer = setInterval(() => {
                timeLeft--;
                timerDiv.textContent = timeLeft;

                if (timeLeft <= 10) {
                    timerDiv.style.color = "#e63946";
                }

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    endGame(false);
                }
            }, 1000);
        }

        function endGame(isWin) {
            clearInterval(timer);

            if (isWin) {
                messageDiv.textContent = `🎉 تهانينا! أكملت جميع المستويات بنجاح! 🎉\nمجموع نقاطك: ${score}`;
                messageDiv.className = "message-success";
                createConfetti();
            } else {
                messageDiv.textContent = `انتهى الوقت! 😅\nمجموع نقاطك: ${score}`;
                messageDiv.className = "message-error";
            }

            numbersDiv.innerHTML = "";
            restartBtn.style.display = "inline-block";
            hintBtn.style.display = "none";
        }

        function restartGame() {
            level = 1;
            score = 0;
            hintsUsed = 0;
            direction = null;

            scoreDiv.textContent = score;
            levelDiv.textContent = level;
            timerDiv.textContent = "60";
            timerDiv.style.color = "#1d3557";

            restartBtn.style.display = "none";
            directionSelect.style.display = "block";
            numbersDiv.innerHTML = "";
            messageDiv.textContent = "";
            celebrationDiv.style.display = "none";
            celebrationDiv.innerHTML = "";
        }

        // دالة لخلط المصفوفة (Fisher-Yates shuffle)
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // تأثير احتفالي عند الفوز
        function createConfetti() {
            celebrationDiv.style.display = "block";
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71'];

            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.opacity = Math.random();
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                celebrationDiv.appendChild(confetti);

                // تأثير سقوط الكونفيتي
                const animation = confetti.animate([
                    { transform: 'translateY(-100px) rotate(0deg)', opacity: 1 },
                    { transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 360}deg)`, opacity: 0 }
                ], {
                    duration: 1000 + Math.random() * 3000,
                    easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
                });

                // إزالة الكونفيتي بعد انتهاء الحركة
                animation.onfinish = () => {
                    confetti.remove();
                };
            }
        }
    </script>
</body>
</html>
