<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🪜 {{ $lesson_game->lesson->name ?? 'سلم الأرقام' }}</title>
    <style>
        :root {
            --primary: #fb8c00;
            --primary-dark: #f57c00;
            --primary-light: #ffb74d;
            --success: #2e7d32;
            --success-light: #4caf50;
            --error: #d32f2f;
            --background: #fff3e0;
            --step-bg: #ffb74d;
            --step-active: #4caf50;
        }

        body {
            font-family: "Noto Kufi Arabic", "Segoe UI", Tahoma, sans-serif;
            background: var(--background);
            text-align: center;
            padding: 20px;
            margin: 0;
            color: #5d4037;
        }

        h1 {
            color: var(--primary);
            margin-bottom: 25px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .game-info {
            background: #ffe0b2;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 0 auto 20px auto;
            max-width: 500px;
            font-size: 1rem;
            color: var(--primary-dark);
            border: 2px solid var(--primary);
        }

        .game-box {
            background: #fff;
            border-radius: 20px;
            display: inline-block;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid var(--primary-light);
            max-width: 600px;
            width: 100%;
        }

        .instruction {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 25px;
            color: #5d4037;
            background: #fff8e1;
            padding: 15px;
            border-radius: 10px;
            border: 2px dashed var(--primary);
        }

        .order-type {
            color: var(--primary-dark);
            font-weight: bold;
            font-size: 1.6rem;
            display: inline-block;
            margin: 0 8px;
        }

        .ladder-container {
            position: relative;
            margin: 30px 0;
            padding: 20px 0;
        }

        .ladder-side {
            position: absolute;
            width: 10px;
            background: #8d6e63;
            top: 0;
            bottom: 0;
            border-radius: 5px;
        }

        .ladder-left {
            left: 50px;
        }

        .ladder-right {
            right: 50px;
        }

        .stairs {
            display: flex;
            flex-direction: column-reverse;
            align-items: center;
            gap: 15px;
            margin: 0 auto;
            padding: 20px 0;
            position: relative;
            z-index: 2;
        }

        .step {
            width: 220px;
            height: 60px;
            line-height: 60px;
            background: linear-gradient(135deg, var(--step-bg), var(--primary));
            border-radius: 12px;
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            user-select: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border: 3px solid white;
            position: relative;
        }

        .step:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        .step:active {
            transform: translateY(0);
        }

        .step.correct {
            background: linear-gradient(135deg, var(--success-light), var(--success));
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }

        .step.wrong {
            background: linear-gradient(135deg, #f44336, var(--error));
            animation: shake 0.5s ease-in-out;
        }

        .step.completed {
            background: linear-gradient(135deg, #66bb6a, var(--success));
            color: #e8f5e8;
        }

        .step-number {
            position: absolute;
            top: -10px;
            left: -10px;
            background: var(--primary-dark);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 1rem;
            line-height: 30px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        #msg {
            margin-top: 20px;
            font-size: 1.4rem;
            font-weight: 600;
            min-height: 50px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .msg-correct {
            color: var(--success);
            background: #e8f5e8;
            border: 2px solid #a5d6a7;
            animation: bounce 0.5s ease-in-out;
        }

        .msg-error {
            color: var(--error);
            background: #ffebee;
            border: 2px solid #ef9a9a;
        }

        .controls {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 24px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: 0;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        button:active {
            transform: translateY(0);
        }

        .score {
            font-size: 1.3rem;
            margin-top: 20px;
            background: linear-gradient(135deg, #ffd54f, #ffb300);
            padding: 12px 25px;
            border-radius: 25px;
            display: inline-block;
            color: #5d4037;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-weight: bold;
        }

        .progress {
            font-size: 1.2rem;
            margin: 15px 0;
            color: var(--primary-dark);
            font-weight: bold;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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
            background-color: #f00;
            opacity: 0.8;
            animation: fall linear forwards;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .step {
                width: 180px;
                height: 50px;
                line-height: 50px;
                font-size: 1.5rem;
            }

            h1 {
                font-size: 2rem;
            }

            .instruction {
                font-size: 1.2rem;
            }

            .controls {
                flex-direction: column;
                align-items: center;
            }

            button {
                width: 200px;
            }

            .ladder-left {
                left: 30px;
            }

            .ladder-right {
                right: 30px;
            }
        }

        @media (max-width: 480px) {
            .step {
                width: 160px;
                height: 45px;
                line-height: 45px;
                font-size: 1.3rem;
            }

            .game-box {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <h1>🪜 {{ $lesson_game->lesson->name ?? 'سلم الأرقام' }}</h1>

    <div class="game-info">
        <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
        <strong>النطاق:</strong> من {{ $min_range }} إلى {{ $max_range }}
    </div>

    <div class="game-box">
        <div class="instruction">
            اضغط على الأرقام بالترتيب <span class="order-type" id="order">تصاعدي ⬆️</span>
        </div>

        <div class="progress">التقدم: <span id="progress">0</span>/<span id="totalSteps">0</span></div>

        <div class="ladder-container">
            <div class="ladder-side ladder-left"></div>
            <div class="ladder-side ladder-right"></div>
            <div class="stairs" id="stairs"></div>
        </div>

        <div id="msg"></div>

        <div class="controls">
            <button id="newBtn">🔄 جولة جديدة</button>
            <button id="hintBtn">💡 تلميح</button>
        </div>

        <div class="score">النقاط: <span id="score">0</span></div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 20 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'سلم الأرقام' }}";

        // تحديث عنوان الصفحة
        document.title = "🪜 " + gameTitle;

        // عناصر DOM
        const stairsEl = document.getElementById("stairs");
        const msgEl = document.getElementById("msg");
        const orderEl = document.getElementById("order");
        const newBtn = document.getElementById("newBtn");
        const hintBtn = document.getElementById("hintBtn");
        const scoreEl = document.getElementById("score");
        const progressEl = document.getElementById("progress");
        const totalStepsEl = document.getElementById("totalSteps");
        const celebrationEl = document.getElementById("celebration");

        // حالة اللعبة
        let sequence = [];
        let ascending = true;
        let currentIndex = 0;
        let score = 0;
        let gameActive = true;

        // Audio Context للتعليقات الصوتية
        let audioCtx;
        try {
            audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        } catch (e) {
            console.log("Web Audio API غير مدعوم في هذا المتصفح");
        }

        /**
         * تشغيل نغمة صوتية للتعليق
         */
        function playTone(freq, time = 0.12) {
            if (!audioCtx) return;

            try {
                const o = audioCtx.createOscillator();
                const g = audioCtx.createGain();
                o.type = 'sine';
                o.frequency.value = freq;
                g.gain.value = 0.0001;
                o.connect(g);
                g.connect(audioCtx.destination);
                o.start();
                g.gain.exponentialRampToValueAtTime(0.12, audioCtx.currentTime + 0.02);
                g.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + time);
                setTimeout(() => o.stop(), (time + 0.03) * 1000);
            } catch (e) {
                console.log("خطأ في تشغيل الصوت");
            }
        }

        /**
         * بدء جولة جديدة
         */
        function newRound() {
            stairsEl.innerHTML = "";
            msgEl.textContent = "";
            msgEl.className = "";
            currentIndex = 0;
            gameActive = true;

            // تحديث التقدم
            progressEl.textContent = "0";

            // توليد 5 أرقام فريدة ضمن النطاق
            let nums = [];
            const numSteps = 5; // عدد الخطوات في السلم

            while (nums.length < numSteps) {
                let n = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                if (!nums.includes(n)) nums.push(n);
            }

            // تحديد نوع الترتيب (تصاعدي أو تنازلي)
            ascending = Math.random() < 0.5;
            orderEl.textContent = ascending ? "تصاعدي ⬆️" : "تنازلي ⬇️";

            // إنشاء التسلسل الصحيح
            sequence = ascending ? nums.slice().sort((a, b) => a - b) : nums.slice().sort((a, b) => b - a);

            // خلط الأرقام للعرض
            let shuffled = nums.slice().sort(() => Math.random() - 0.5);

            // إنشاء خطوات السلم
            shuffled.forEach((n, index) => {
                let step = document.createElement("div");
                step.className = "step";
                step.textContent = n;

                // إضافة رقم الترتيب
                const stepNumber = document.createElement("div");
                stepNumber.className = "step-number";
                stepNumber.textContent = index + 1;
                step.appendChild(stepNumber);

                step.onclick = () => checkStep(step, n);
                stairsEl.appendChild(step);
            });

            // تحديث عدد الخطوات الإجمالي
            totalStepsEl.textContent = numSteps;
        }

        /**
         * التحقق من الخطوة
         */
        function checkStep(step, number) {
            if (!gameActive) return;

            if (number === sequence[currentIndex]) {
                // الإجابة الصحيحة
                step.classList.add("correct");
                currentIndex++;

                // تحديث التقدم
                progressEl.textContent = currentIndex;

                playTone(660, 0.2);

                // بعد فترة قصيرة، تغيير اللون إلى مكتمل
                setTimeout(() => {
                    step.classList.remove("correct");
                    step.classList.add("completed");
                }, 500);

                if (currentIndex === sequence.length) {
                    // اكتمال السلم
                    msgEl.textContent = "🎉 أحسنت! وصلت للقمة!";
                    msgEl.className = "msg-correct";
                    playTone(880, 0.5);

                    // زيادة النقاط
                    score += 20;
                    scoreEl.textContent = score;

                    // تأثير الاحتفال
                    createCelebration();

                    gameActive = false;
                }
            } else {
                // الإجابة الخاطئة
                step.classList.add("wrong");
                msgEl.textContent = "😅 ليس هذا الرقم! حاول مرة أخرى";
                msgEl.className = "msg-error";
                playTone(220, 0.3);

                // خصم نقطة للإجابة الخاطئة
                score = Math.max(0, score - 2);
                scoreEl.textContent = score;

                // إزالة class الخطأ بعد فترة
                setTimeout(() => {
                    step.classList.remove("wrong");
                }, 1000);
            }
        }

        /**
         * عرض تلميح
         */
        function showHint() {
            if (!gameActive) return;

            const nextNumber = sequence[currentIndex];
            const hintMessage = `💡 التلميح: الرقم التالي في الترتيب هو ${nextNumber}`;

            msgEl.textContent = hintMessage;
            msgEl.className = "msg-correct";

            // خصم نقاط لاستخدام التلميح
            score = Math.max(0, score - 5);
            scoreEl.textContent = score;
        }

        /**
         * إنشاء تأثير الاحتفال
         */
        function createCelebration() {
            celebrationEl.style.display = 'block';
            const colors = ['#ff6b6b', '#ffa726', '#ffeb3b', '#4caf50', '#2196f3', '#9c27b0'];

            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                confetti.style.width = (Math.random() * 10 + 5) + 'px';
                confetti.style.height = (Math.random() * 10 + 5) + 'px';
                celebrationEl.appendChild(confetti);

                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }

            setTimeout(() => {
                celebrationEl.style.display = 'none';
                celebrationEl.innerHTML = '';
            }, 5000);
        }

        // أحداث الأزرار
        newBtn.addEventListener('click', newRound);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة
        newRound();
    </script>
</body>
</html>
