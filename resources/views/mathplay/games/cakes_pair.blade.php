<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>🎂 {{ $lesson_game->lesson->name ?? 'كعكات لذيذة - زوج المجموع' }}</title>
    <style>
        :root {
            --primary: #d84315;
            --primary-dark: #bf360c;
            --primary-light: #ffab91;
            --success: #2e7d32;
            --success-light: #4caf50;
            --error: #d32f2f;
            --error-light: #f44336;
            --background: #fff3e0;
            --cake-bg: #ffab91;
            --plate-bg: #fff;
        }

        body {
            font-family: "Noto Kufi Arabic", "Segoe UI", Tahoma, sans-serif;
            background: var(--background);
            margin: 0;
            padding: 20px;
            text-align: center;
            color: #4e342e;
        }

        h1 {
            color: var(--primary);
            margin-bottom: 10px;
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

        #instruction {
            font-weight: 800;
            margin-bottom: 15px;
            font-size: 1.3rem;
            color: #5d4037;
        }

        .area {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .plates {
            background: var(--plate-bg);
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #ffccbc;
            width: 100%;
            max-width: 600px;
        }

        .target-display {
            background: linear-gradient(135deg, #ffcc80, #ffb74d);
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 20px;
            border: 3px solid var(--primary);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .target-label {
            font-size: 1.2rem;
            font-weight: bold;
            color: #5d4037;
            margin-bottom: 5px;
        }

        .target-value {
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-dark);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            margin: 20px 0;
            padding: 15px;
            background: #fff8e1;
            border-radius: 15px;
            border: 2px dashed #ffd54f;
        }

        .cake {
            width: 90px;
            height: 90px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: #4e342e;
            cursor: pointer;
            margin: 5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 3px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .cake::before {
            content: '';
            position: absolute;
            top: -10%;
            left: -10%;
            width: 120%;
            height: 120%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
        }

        .cake:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .cake.selected {
            border: 3px solid #ff9800;
            transform: scale(1.1);
            box-shadow: 0 6px 18px rgba(255, 152, 0, 0.4);
        }

        .cake.correct {
            border: 3px solid var(--success);
            background: linear-gradient(135deg, #a5d6a7, #66bb6a) !important;
            transform: scale(1.1);
            box-shadow: 0 6px 18px rgba(76, 175, 80, 0.4);
        }

        .cake.wrong {
            border: 3px solid var(--error);
            background: linear-gradient(135deg, #ef9a9a, #e57373) !important;
            animation: shake 0.5s ease-in-out;
        }

        .cake-value {
            font-size: 1.8rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }

        #msg {
            min-height: 50px;
            font-weight: 800;
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

        .controls {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        button {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: 0;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 800;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        button:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
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
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @media (max-width: 768px) {
            .cake {
                width: 75px;
                height: 75px;
            }

            .cake-value {
                font-size: 1.5rem;
            }

            h1 {
                font-size: 2rem;
            }

            .target-value {
                font-size: 2.5rem;
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
            .cake {
                width: 65px;
                height: 65px;
            }

            .cake-value {
                font-size: 1.3rem;
            }

            .grid {
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <h1>🎂 {{ $lesson_game->lesson->name ?? 'كعكات لذيذة - زوج المجموع' }}</h1>

    <div class="game-info">
        <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
        <strong>النطاق:</strong> من {{ $min_range }} إلى {{ $max_range }}
    </div>

    <p id="instruction">اختر كعكتين مجموعهما يساوي العدد المطلوب</p>

    <div class="area">
        <div class="plates">
            <div class="target-display">
                <div class="target-label">العدد المطلوب</div>
                <div class="target-value" id="target">0</div>
            </div>

            <div class="grid" id="cakesGrid"></div>

            <div id="msg"></div>

            <div class="controls">
                <button id="newBtn">🔄 جولة جديدة</button>
                <button id="hintBtn">💡 تلميح</button>
            </div>

            <div class="score">النقاط: <span id="score">0</span></div>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 18 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'كعكات لذيذة - زوج المجموع' }}";

        // تحديث عنوان الصفحة
        document.title = "🎂 " + gameTitle;

        // عناصر DOM
        const cakesGrid = document.getElementById('cakesGrid');
        const targetEl = document.getElementById('target');
        const msgEl = document.getElementById('msg');
        const newBtn = document.getElementById('newBtn');
        const hintBtn = document.getElementById('hintBtn');
        const scoreEl = document.getElementById('score');
        const celebrationEl = document.getElementById('celebration');

        // حالة اللعبة
        let values = [];
        let target = 0;
        let picked = [];
        let score = 0;
        let gameActive = true;
        let validPairs = [];

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
         * بدء لعبة جديدة
         */
        function newGame() {
            cakesGrid.innerHTML = '';
            msgEl.textContent = '';
            msgEl.className = '';
            picked = [];
            gameActive = true;
            validPairs = [];

            // توليد الهدف ضمن النطاق
            target = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            targetEl.textContent = target;

            // توليد قيم الكعكات مع ضمان وجود زوج صحيح واحد على الأقل
            values = [];

            // إنشاء زوج مضمون
            const a = Math.floor(Math.random() * (target - 1)) + 1;
            const b = target - a;
            values.push(a, b);
            validPairs.push([a, b]);

            // ملء الباقي حتى 8 كعكات
            while (values.length < 8) {
                const randomValue = Math.floor(Math.random() * (maxRange - 1)) + 1;
                if (!values.includes(randomValue) || values.filter(v => v === randomValue).length < 2) {
                    values.push(randomValue);
                }
            }

            // البحث عن جميع الأزواج الصحيحة
            findValidPairs();

            // خلط القيم
            values.sort(() => Math.random() - 0.5);

            // إنشاء الكعكات
            values.forEach((v, i) => {
                const cake = document.createElement('div');
                cake.className = 'cake';
                cake.style.background = `linear-gradient(135deg, hsl(${i * 45}, 80%, 75%), hsl(${i * 45}, 80%, 60%))`;
                cake.innerHTML = `<div class="cake-value">${v}</div>`;
                cake.dataset.val = v;
                cake.addEventListener('click', () => onPick(cake, v));
                cakesGrid.appendChild(cake);
            });
        }

        /**
         * البحث عن جميع الأزواج الصحيحة
         */
        function findValidPairs() {
            validPairs = [];
            for (let i = 0; i < values.length; i++) {
                for (let j = i + 1; j < values.length; j++) {
                    if (values[i] + values[j] === target) {
                        validPairs.push([values[i], values[j]]);
                    }
                }
            }
        }

        /**
         * اختيار كعكة
         */
        function onPick(cake, value) {
            if (!gameActive) return;

            if (picked.includes(cake)) {
                // إلغاء التحديد
                picked = picked.filter(x => x !== cake);
                cake.classList.remove('selected');
                playTone(330, 0.1);
            } else {
                if (picked.length < 2) {
                    picked.push(cake);
                    cake.classList.add('selected');
                    playTone(440, 0.1);
                }
            }

            if (picked.length === 2) {
                const sum = Number(picked[0].dataset.val) + Number(picked[1].dataset.val);

                if (sum === target) {
                    // الإجابة الصحيحة
                    msgEl.textContent = `🎉 أحسنت! ${picked[0].dataset.val} + ${picked[1].dataset.val} = ${target}`;
                    msgEl.className = 'msg-success';
                    playTone(880, 0.3);

                    // تأثير النجاح
                    picked.forEach(cake => {
                        cake.classList.remove('selected');
                        cake.classList.add('correct');
                    });

                    // زيادة النقاط
                    score += 10;
                    scoreEl.textContent = score;

                    // تأثير الاحتفال
                    createCelebration();

                    gameActive = false;

                    // جولة جديدة بعد ثانيتين
                    setTimeout(newGame, 2000);
                } else {
                    // الإجابة الخاطئة
                    msgEl.textContent = `😅 ${picked[0].dataset.val} + ${picked[1].dataset.val} = ${sum} — حاول مرة أخرى`;
                    msgEl.className = 'msg-error';
                    playTone(220, 0.3);

                    // تأثير الخطأ
                    picked.forEach(cake => {
                        cake.classList.remove('selected');
                        cake.classList.add('wrong');
                    });

                    // خصم نقطة للإجابة الخاطئة
                    score = Math.max(0, score - 1);
                    scoreEl.textContent = score;

                    // إعادة تعيين بعد فترة
                    setTimeout(() => {
                        picked.forEach(cake => {
                            cake.classList.remove('wrong');
                        });
                        picked = [];
                    }, 1000);
                }
            }
        }

        /**
         * عرض تلميح
         */
        function showHint() {
            if (!gameActive) return;

            if (validPairs.length > 0) {
                const randomPair = validPairs[Math.floor(Math.random() * validPairs.length)];
                const hintMessage = `💡 تلميح: حاول ${randomPair[0]} + ${randomPair[1]}`;

                msgEl.textContent = hintMessage;
                msgEl.className = 'msg-success';

                // خصم نقاط لاستخدام التلميح
                score = Math.max(0, score - 2);
                scoreEl.textContent = score;
            }
        }

        /**
         * إنشاء تأثير الاحتفال
         */
        function createCelebration() {
            celebrationEl.style.display = 'block';
            const colors = ['#ff6b6b', '#ffa726', '#ffeb3b', '#4caf50', '#2196f3', '#9c27b0'];

            for (let i = 0; i < 80; i++) {
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

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
