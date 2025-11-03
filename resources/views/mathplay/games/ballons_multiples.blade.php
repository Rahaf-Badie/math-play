<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>🎈 {{ $lesson_game->lesson->name ?? 'بالونات المضاعفات' }}</title>
    <style>
        :root {
            --primary: #1565c0;
            --primary-dark: #0d47a1;
            --success: #2e7d32;
            --success-light: #4caf50;
            --error: #d32f2f;
            --error-light: #f44336;
            --background: #f0f8ff;
            --balloon-shadow: rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: "Noto Kufi Arabic", "Segoe UI", Tahoma, sans-serif;
            background: var(--background);
            margin: 0;
            padding: 20px;
            text-align: center;
            color: #37474f;
        }

        h1 {
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .game-info {
            background: #e3f2fd;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 0 auto 20px auto;
            max-width: 600px;
            font-size: 1rem;
            color: var(--primary-dark);
            border: 2px solid #64b5f6;
        }

        .board {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 3px solid #e3f2fd;
        }

        .instruction {
            font-weight: 800;
            font-size: 1.3rem;
            color: #37474f;
            margin-bottom: 20px;
            background: #f5f5f5;
            padding: 15px;
            border-radius: 10px;
            border-right: 4px solid var(--primary);
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            padding: 20px;
            margin: 20px 0;
            background: #fafafa;
            border-radius: 15px;
            border: 2px dashed #bbdefb;
            min-height: 300px;
        }

        .balloon {
            width: 90px;
            height: 100px;
            border-radius: 50% 50% 50% 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: #fff;
            font-size: 1.4rem;
            cursor: pointer;
            position: relative;
            box-shadow: 0 8px 20px var(--balloon-shadow);
            transition: all 0.3s ease;
            border: 3px solid transparent;
            animation: float 3s ease-in-out infinite;
        }

        .balloon:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .balloon:nth-child(2n) {
            animation-delay: 0.5s;
        }

        .balloon:nth-child(3n) {
            animation-delay: 1s;
        }

        .string {
            width: 2px;
            height: 25px;
            background: #9e9e9e;
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            transition: all 0.3s ease;
        }

        .balloon.popped {
            opacity: 0.4;
            transform: translateY(-20px) scale(0.9);
            pointer-events: none;
            animation: none;
        }

        .balloon.correct {
            border: 3px solid var(--success);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.3);
        }

        .balloon.wrong {
            border: 3px solid var(--error);
            animation: shake 0.5s ease-in-out;
        }

        .balloon.highlight {
            border: 3px solid #ffeb3b;
            box-shadow: 0 0 20px rgba(255, 235, 59, 0.5);
            animation: pulse 1s ease-in-out infinite;
        }

        .controls {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        button {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border: 0;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 900;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        button:active {
            transform: translateY(0);
        }

        #revealBtn {
            background: linear-gradient(135deg, #90a4ae, #607d8b);
        }

        #hintBtn {
            background: linear-gradient(135deg, #ff9800, #f57c00);
        }

        #msg {
            min-height: 50px;
            font-weight: 900;
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .msg-success {
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

        .msg-info {
            color: #1976d2;
            background: #e3f2fd;
            border: 2px solid #90caf9;
        }

        .score {
            font-size: 1.3rem;
            margin-top: 20px;
            background: linear-gradient(135deg, #ffd54f, #ffb300);
            padding: 12px 25px;
            border-radius: 25px;
            display: inline-block;
            color: #5d4037;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .progress {
            font-size: 1.1rem;
            margin: 15px 0;
            color: #666;
            font-weight: bold;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
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
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
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
            .balloon {
                width: 75px;
                height: 85px;
                font-size: 1.2rem;
            }

            h1 {
                font-size: 2rem;
            }

            .controls {
                flex-direction: column;
                align-items: center;
            }

            button {
                width: 200px;
            }
        }

        @media (max-width: 480px) {
            .balloon {
                width: 65px;
                height: 75px;
                font-size: 1.1rem;
            }

            .grid {
                gap: 10px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="board">
        <h1>🎈 {{ $lesson_game->lesson->name ?? 'بالونات المضاعفات' }}</h1>

        <div class="game-info">
            <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
            <strong>العدد الأساسي:</strong> {{ $settings->base_number ?? 10 }}
        </div>

        <div class="instruction" id="instruction">فقع البالونات التي تحمل مضاعفات العدد {{ $settings->base_number ?? 10 }}</div>

        <div class="progress" id="progress">البالونات الصحيحة: <span id="correctCount">0</span>/<span id="totalCorrect">0</span></div>

        <div class="grid" id="grid"></div>

        <div class="controls">
            <button id="newBtn">🔄 جولة جديدة</button>
            <button id="hintBtn">💡 تلميح</button>
            <button id="revealBtn">🔎 أظهر الإجابات</button>
        </div>

        <div id="msg"></div>

        <div class="score">النقاط: <span id="score">0</span></div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const baseNumber = {{ $settings->base_number ?? 10 }};
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 90 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'بالونات المضاعفات' }}";

        // تحديث عنوان الصفحة والتعليمات
        document.title = "🎈 " + gameTitle;
        document.getElementById('instruction').textContent = `فقع البالونات التي تحمل مضاعفات العدد ${baseNumber}`;

        // عناصر DOM
        const grid = document.getElementById('grid');
        const newBtn = document.getElementById('newBtn');
        const revealBtn = document.getElementById('revealBtn');
        const hintBtn = document.getElementById('hintBtn');
        const msg = document.getElementById('msg');
        const scoreEl = document.getElementById('score');
        const correctCountEl = document.getElementById('correctCount');
        const totalCorrectEl = document.getElementById('totalCorrect');
        const celebrationEl = document.getElementById('celebration');

        // حالة اللعبة
        let score = 0;
        let poppedCount = 0;
        let totalMultiples = 0;
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
         * توليد لون عشوائي للبالونات
         */
        function randomColor(i) {
            const hue = (i * 35) % 360;
            return `hsl(${hue}, 75%, 60%)`;
        }

        /**
         * بدء لعبة جديدة
         */
        function newGame() {
            grid.innerHTML = '';
            msg.textContent = '';
            msg.className = '';
            poppedCount = 0;
            gameActive = true;

            // توليد مضاعفات العدد الأساسي
            const multiples = [];
            for (let i = baseNumber; i <= maxRange; i += baseNumber) {
                if (i >= minRange && i <= maxRange) {
                    multiples.push(i);
                }
            }

            totalMultiples = multiples.length;
            totalCorrectEl.textContent = totalMultiples;
            correctCountEl.textContent = '0';

            // توليد أرقام مشتتة للانتباه
            const distractors = [];
            while (distractors.length < totalMultiples) {
                const n = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                // تأكد من أن الرقم ليس مضاعفاً وغير مكرر
                if (n % baseNumber !== 0 && !distractors.includes(n) && !multiples.includes(n)) {
                    distractors.push(n);
                }
            }

            // دمج وخلط الأرقام
            const allNumbers = multiples.concat(distractors).sort(() => Math.random() - 0.5);

            // إنشاء البالونات
            allNumbers.forEach((number, index) => {
                const balloon = document.createElement('div');
                balloon.className = 'balloon';
                balloon.style.background = randomColor(index);
                balloon.textContent = number;

                const string = document.createElement('div');
                string.className = 'string';
                balloon.appendChild(string);

                balloon.dataset.val = number;
                balloon.dataset.isMultiple = (number % baseNumber === 0).toString();

                balloon.addEventListener('click', () => handleBalloonClick(balloon, number));
                grid.appendChild(balloon);
            });

            msg.textContent = `ابحث عن مضاعفات العدد ${baseNumber} وفقع البالونات الصحيحة!`;
            msg.className = 'msg-info';
        }

        /**
         * التعامل مع النقر على البالون
         */
        function handleBalloonClick(balloon, number) {
            if (!gameActive) return;

            const isMultiple = number % baseNumber === 0;

            if (isMultiple) {
                // البالون الصحيح
                balloon.classList.add('popped', 'correct');
                msg.textContent = `🎉 أحسنت! ${number} مضاعف للعدد ${baseNumber}`;
                msg.className = 'msg-success';
                playTone(880, 0.3);

                poppedCount++;
                correctCountEl.textContent = poppedCount;

                // زيادة النقاط
                score += 10;
                scoreEl.textContent = score;

                // التحقق من اكتمال اللعبة
                if (poppedCount === totalMultiples) {
                    msg.textContent = `🎊 مبروك! فقعت جميع مضاعفات ${baseNumber} بنجاح!`;
                    gameActive = false;

                    // تأثير الاحتفال
                    createCelebration();

                    // جولة جديدة بعد 3 ثوان
                    setTimeout(newGame, 3000);
                }
            } else {
                // البالون الخطأ
                balloon.classList.add('wrong');
                msg.textContent = `❌ ${number} ليس مضاعفاً للعدد ${baseNumber}`;
                msg.className = 'msg-error';
                playTone(220, 0.3);

                // خصم نقطة للخطأ
                score = Math.max(0, score - 2);
                scoreEl.textContent = score;

                // إزالة class الخطأ بعد فترة
                setTimeout(() => {
                    balloon.classList.remove('wrong');
                }, 1000);
            }
        }

        /**
         * عرض تلميح
         */
        function showHint() {
            if (!gameActive) return;

            const multiples = Array.from(grid.children)
                .filter(b => b.dataset.isMultiple === 'true' && !b.classList.contains('popped'))
                .map(b => parseInt(b.dataset.val));

            if (multiples.length > 0) {
                const randomMultiple = multiples[Math.floor(Math.random() * multiples.length)];
                msg.textContent = `💡 تلميح: ${randomMultiple} هو مضاعف للعدد ${baseNumber}`;
                msg.className = 'msg-info';

                // إبراز البالون المقترح
                const suggestedBalloon = Array.from(grid.children).find(b =>
                    parseInt(b.dataset.val) === randomMultiple
                );
                if (suggestedBalloon) {
                    suggestedBalloon.classList.add('highlight');
                    setTimeout(() => {
                        suggestedBalloon.classList.remove('highlight');
                    }, 2000);
                }

                // خصم نقاط لاستخدام التلميح
                score = Math.max(0, score - 3);
                scoreEl.textContent = score;
            }
        }

        /**
         * كشف الإجابات
         */
        function revealAnswers() {
            if (!gameActive) return;

            Array.from(grid.children).forEach(balloon => {
                const isMultiple = balloon.dataset.isMultiple === 'true';
                if (isMultiple && !balloon.classList.contains('popped')) {
                    balloon.classList.add('correct');
                    balloon.style.outline = '3px solid #4caf50';
                } else if (!isMultiple) {
                    balloon.style.outline = '3px solid #f44336';
                }
            });

            msg.textContent = `🔎 مضاعفات ${baseNumber} موضحة باللون الأخضر`;
            msg.className = 'msg-info';

            // خصم نقاط لاستخدام كشف الإجابات
            score = Math.max(0, score - 5);
            scoreEl.textContent = score;

            gameActive = false;

            // جولة جديدة بعد 3 ثوان
            setTimeout(newGame, 3000);
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
        newBtn.addEventListener('click', newGame);
        hintBtn.addEventListener('click', showHint);
        revealBtn.addEventListener('click', revealAnswers);

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
