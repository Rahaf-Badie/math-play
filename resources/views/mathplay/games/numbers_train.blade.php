<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚂 {{ $lesson_game->lesson->name ?? 'قطار الأرقام' }}</title>
    <style>
        :root {
            --primary: #00796b;
            --primary-dark: #004d40;
            --primary-light: #26a69a;
            --success: #2e7d32;
            --error: #d32f2f;
            --background: #e0f7fa;
            --wagon-bg: #26a69a;
            --wagon-hover: #00897b;
        }

        body {
            font-family: "Noto Kufi Arabic", "Segoe UI", Tahoma, sans-serif;
            background: var(--background);
            text-align: center;
            padding: 20px;
            margin: 0;
            color: #004d40;
        }

        h1 {
            color: var(--primary);
            margin-bottom: 25px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .game-info {
            background: #b2dfdb;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 0 auto 20px auto;
            max-width: 500px;
            font-size: 1rem;
            color: var(--primary-dark);
            border: 2px solid var(--primary-light);
        }

        .train-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            display: inline-block;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid var(--primary-light);
            max-width: 800px;
            width: 100%;
            margin: 10px auto;
        }

        .instruction {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 25px;
            color: var(--primary-dark);
            background: #e0f2f1;
            padding: 15px;
            border-radius: 10px;
            border: 2px dashed var(--primary);
        }

        .action-type {
            color: var(--primary);
            font-size: 1.8rem;
            display: inline-block;
            margin: 0 8px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .train-track {
            background: #795548;
            height: 8px;
            margin: 30px 0;
            border-radius: 4px;
            position: relative;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .train-track::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 0;
            right: 0;
            height: 12px;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 15px,
                #ffd54f 15px,
                #ffd54f 30px
            );
            border-radius: 6px;
        }

        .train {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin: 25px 0;
            position: relative;
        }

        .train::before {
            content: '🚂';
            font-size: 3rem;
            position: absolute;
            right: -50px;
            animation: moveTrain 2s ease-in-out infinite;
        }

        .wagon {
            display: inline-block;
            width: 80px;
            height: 80px;
            line-height: 80px;
            margin: 0 8px;
            font-size: 2.2rem;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, var(--wagon-bg), var(--primary));
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            border: 3px solid white;
            position: relative;
            z-index: 2;
        }

        .wagon:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, var(--wagon-hover), var(--primary-dark));
        }

        .wagon.missing {
            background: linear-gradient(135deg, #ffb74d, #f57c00);
            animation: pulse 2s infinite;
            border: 3px dashed white;
        }

        .wagon.missing::after {
            content: '?';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
        }

        .options-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin: 30px 0;
            padding: 20px;
            background: #e0f2f1;
            border-radius: 15px;
            border: 2px solid var(--primary-light);
        }

        .option-btn {
            font-size: 1.8rem;
            padding: 15px 25px;
            margin: 5px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            min-width: 80px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .option-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
        }

        .option-btn:active {
            transform: translateY(0) scale(1);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            transform: scale(1.1);
        }

        .option-btn.wrong {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            animation: shake 0.5s ease-in-out;
        }

        #msg {
            margin-top: 20px;
            font-size: 1.5rem;
            font-weight: 600;
            min-height: 40px;
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

        .control-btn {
            font-size: 1.2rem;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #ffb74d, #ff9800);
        }

        .score {
            font-size: 1.3rem;
            margin-top: 20px;
            background: linear-gradient(135deg, #ffd54f, #ffb300);
            padding: 12px 25px;
            border-radius: 25px;
            display: inline-block;
            color: #5d4037;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            font-weight: bold;
        }

        @keyframes moveTrain {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(-10px); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
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
            .wagon {
                width: 60px;
                height: 60px;
                line-height: 60px;
                font-size: 1.8rem;
            }

            .option-btn {
                font-size: 1.5rem;
                padding: 12px 20px;
                min-width: 60px;
            }

            h1 {
                font-size: 2rem;
            }

            .instruction {
                font-size: 1.3rem;
            }

            .controls {
                flex-direction: column;
                align-items: center;
            }

            .control-btn {
                width: 200px;
            }
        }

        @media (max-width: 480px) {
            .train {
                flex-wrap: wrap;
            }

            .wagon {
                width: 50px;
                height: 50px;
                line-height: 50px;
                font-size: 1.5rem;
                margin: 5px;
            }

            .option-btn {
                font-size: 1.3rem;
                padding: 10px 16px;
                min-width: 50px;
            }
        }
    </style>
</head>
<body>
    <h1>🚂 {{ $lesson_game->lesson->name ?? 'قطار الأرقام' }}</h1>

    <div class="game-info">
        <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
        <strong>النطاق:</strong> من {{ $min_range }} إلى {{ $max_range }}
    </div>

    <div class="train-container">
        <div class="instruction">
            اختر <span class="action-type" id="action">التالي</span> الرقم
        </div>

        <div class="train-track"></div>

        <div class="train" id="train">
            <!-- سيتم إضافة عربات القطار هنا -->
        </div>

        <div class="options-container" id="options">
            <!-- سيتم إضافة أزرار الخيارات هنا -->
        </div>

        <div id="msg"></div>

        <div class="controls">
            <button class="control-btn" id="newBtn">🔄 جولة جديدة</button>
            <button class="control-btn" id="hintBtn">💡 تلميح</button>
        </div>

        <div class="score">النقاط: <span id="score">0</span></div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 20 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'قطار الأرقام' }}";

        // تحديث عنوان الصفحة
        document.title = "🚂 " + gameTitle;

        // عناصر DOM
        const trainEl = document.getElementById("train");
        const optionsEl = document.getElementById("options");
        const msgEl = document.getElementById("msg");
        const actionEl = document.getElementById("action");
        const newBtn = document.getElementById("newBtn");
        const hintBtn = document.getElementById("hintBtn");
        const scoreEl = document.getElementById("score");
        const celebrationEl = document.getElementById("celebration");

        // حالة اللعبة
        let currentNumber = 1;
        let isNext = true;
        let score = 0;
        let correctAnswer = 0;
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
            trainEl.innerHTML = "";
            optionsEl.innerHTML = "";
            msgEl.textContent = "";
            msgEl.className = "";
            gameActive = true;

            // توليد رقم عشوائي ضمن النطاق (مع ترك مسافة للرقم السابق/التالي)
            currentNumber = Math.floor(Math.random() * (maxRange - 2)) + minRange + 1;
            isNext = Math.random() < 0.5;

            // تحديث نص التعليمات
            actionEl.textContent = isNext ? "التالي" : "السابق";

            // إنشاء عربات القطار
            createTrainWagons();

            // إنشاء أزرار الخيارات
            createOptions();
        }

        /**
         * إنشاء عربات القطار
         */
        function createTrainWagons() {
            correctAnswer = isNext ? currentNumber + 1 : currentNumber - 1;

            // تحديد موقع العربة المفقودة (بداية، وسط، نهاية)
            const missingPosition = Math.floor(Math.random() * 3);

            if (missingPosition === 0) {
                // العربة المفقودة في البداية
                createWagon(correctAnswer, true);
                createWagon(currentNumber, false);
                if (isNext) {
                    createWagon(currentNumber - 1, false);
                } else {
                    createWagon(currentNumber + 1, false);
                }
            } else if (missingPosition === 1) {
                // العربة المفقودة في الوسط
                if (isNext) {
                    createWagon(currentNumber - 1, false);
                    createWagon(correctAnswer, true);
                    createWagon(currentNumber, false);
                } else {
                    createWagon(currentNumber + 1, false);
                    createWagon(correctAnswer, true);
                    createWagon(currentNumber, false);
                }
            } else {
                // العربة المفقودة في النهاية
                if (isNext) {
                    createWagon(currentNumber - 1, false);
                    createWagon(currentNumber, false);
                    createWagon(correctAnswer, true);
                } else {
                    createWagon(currentNumber + 1, false);
                    createWagon(currentNumber, false);
                    createWagon(correctAnswer, true);
                }
            }
        }

        /**
         * إنشاء عربة قطار
         */
        function createWagon(number, isMissing) {
            const wagon = document.createElement("div");
            wagon.className = `wagon ${isMissing ? 'missing' : ''}`;
            if (!isMissing) {
                wagon.textContent = number;
            }
            trainEl.appendChild(wagon);
        }

        /**
         * إنشاء خيارات الإجابة
         */
        function createOptions() {
            let choices = [correctAnswer];

            // إضافة خيارات خاطئة
            while (choices.length < 4) {
                let randomNum;
                if (isNext) {
                    randomNum = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                } else {
                    randomNum = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                }

                // تأكد من أن الرقم ضمن النطاق وغير مكرر
                if (!choices.includes(randomNum) && randomNum >= minRange && randomNum <= maxRange) {
                    choices.push(randomNum);
                }
            }

            // خلط الخيارات
            choices.sort(() => Math.random() - 0.5);

            // إنشاء أزرار الخيارات
            choices.forEach(num => {
                const btn = document.createElement("button");
                btn.className = "option-btn";
                btn.textContent = num;
                btn.onclick = () => checkAnswer(num, btn);
                optionsEl.appendChild(btn);
            });
        }

        /**
         * التحقق من الإجابة
         */
        function checkAnswer(selectedNumber, button) {
            if (!gameActive) return;

            if (selectedNumber === correctAnswer) {
                // الإجابة الصحيحة
                button.classList.add("correct");
                msgEl.textContent = `🎉 أحسنت! الرقم ${isNext ? 'التالي' : 'السابق'} لـ ${currentNumber} هو ${correctAnswer}`;
                msgEl.className = "msg-correct";
                playTone(880, 0.3);

                // زيادة النقاط
                score += 10;
                scoreEl.textContent = score;

                // تأثير الاحتفال
                createCelebration();

                gameActive = false;

                // جولة جديدة بعد ثانيتين
                setTimeout(newRound, 2000);
            } else {
                // الإجابة الخاطئة
                button.classList.add("wrong");
                msgEl.textContent = "😅 حاول مرة أخرى!";
                msgEl.className = "msg-error";
                playTone(220, 0.3);

                // إزالة class الخطأ بعد فترة
                setTimeout(() => {
                    button.classList.remove("wrong");
                }, 1000);

                // خصم نقطة للإجابة الخاطئة
                score = Math.max(0, score - 1);
                scoreEl.textContent = score;
            }
        }

        /**
         * عرض تلميح
         */
        function showHint() {
            if (!gameActive) return;

            const hintMessage = isNext ?
                `💡 تلميح: الرقم التالي لـ ${currentNumber} هو ${currentNumber + 1}` :
                `💡 تلميح: الرقم السابق لـ ${currentNumber} هو ${currentNumber - 1}`;

            msgEl.textContent = hintMessage;
            msgEl.className = "msg-correct";

            // خصم نقاط لاستخدام التلميح
            score = Math.max(0, score - 2);
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
