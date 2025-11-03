<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>🚗 {{ $lesson_game->lesson->name ?? 'سباق الجمع' }}</title>
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --success: #43a047;
            --error: #d32f2f;
            --background: #e8f5e9;
            --track: #c8e6c9;
            --lane: #a5d6a7;
        }

        body {
            font-family: "Noto Kufi Arabic", "Segoe UI", Tahoma, sans-serif;
            background: var(--background);
            margin: 0;
            padding: 20px;
            text-align: center;
            color: #1b5e20;
        }

        h1 {
            color: var(--primary);
            margin-bottom: 6px;
            font-size: 32px;
        }

        .game-info {
            background: #c8e6c9;
            padding: 10px 15px;
            border-radius: 10px;
            margin: 0 auto 15px auto;
            max-width: 600px;
            font-size: 14px;
            color: var(--primary-dark);
            border: 1px solid #a5d6a7;
        }

        #instruction {
            font-weight: 800;
            margin-bottom: 12px;
            font-size: 18px;
            color: var(--primary-dark);
        }

        .target-display {
            background: white;
            padding: 12px 24px;
            border-radius: 25px;
            display: inline-block;
            margin: 10px auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: 3px solid var(--primary);
            font-size: 18px;
        }

        .target-value {
            font-size: 28px;
            font-weight: 900;
            color: var(--primary);
            margin: 0 8px;
        }

        .track {
            max-width: 900px;
            margin: 20px auto;
            background: var(--track);
            padding: 15px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            border: 3px solid #81c784;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .track::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 20px,
                rgba(255,255,255,0.3) 20px,
                rgba(255,255,255,0.3) 40px
            );
        }

        .finish-line {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 8px;
            background: repeating-linear-gradient(
                45deg,
                #fff,
                #fff 10px,
                #f44336 10px,
                #f44336 20px
            );
            z-index: 2;
        }

        .lanes {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 15px;
            position: relative;
            z-index: 1;
        }

        .lane {
            height: 90px;
            background: var(--lane);
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            border: 2px solid #81c784;
            transition: all 0.3s ease;
        }

        .lane:hover {
            background: #90caf9;
            transform: scale(1.02);
        }

        .car {
            font-size: 54px;
            position: absolute;
            left: 15px;
            top: 18px;
            cursor: pointer;
            transition: left 1.5s cubic-bezier(0.2, 0.8, 0.3, 1.2);
            z-index: 3;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3));
        }

        .car-label {
            position: absolute;
            left: 85px;
            top: 32px;
            font-weight: 800;
            font-size: 22px;
            color: #1b5e20;
            background: rgba(255,255,255,0.9);
            padding: 4px 12px;
            border-radius: 20px;
            border: 2px solid #66bb6a;
        }

        .car.winner {
            animation: bounce 0.5s ease-in-out 3;
        }

        .car.correct {
            filter: drop-shadow(0 0 8px #4caf50);
        }

        .car.wrong {
            animation: shake 0.5s ease-in-out;
        }

        button {
            background: var(--primary);
            border: 0;
            color: white;
            padding: 12px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 800;
            margin: 8px;
            font-size: 16px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        button:active {
            transform: translateY(0);
        }

        #msg {
            min-height: 40px;
            font-weight: 900;
            margin-top: 20px;
            padding: 12px;
            border-radius: 10px;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .msg-success {
            color: var(--success);
            background: #e8f5e8;
            border: 2px solid #a5d6a7;
        }

        .msg-error {
            color: var(--error);
            background: #ffebee;
            border: 2px solid #ef9a9a;
        }

        .score {
            font-size: 20px;
            font-weight: 700;
            margin: 15px 0;
            color: var(--primary);
            background: rgba(255,255,255,0.8);
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
        }

        .controls {
            margin-top: 20px;
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @keyframes confetti {
            0% { transform: translateY(0) rotate(0); opacity: 1; }
            100% { transform: translateY(100px) rotate(360deg); opacity: 0; }
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #ff0000;
            animation: confetti 2s ease-in-out forwards;
        }

        @media (max-width: 600px) {
            .car {
                font-size: 44px;
                left: 10px;
            }

            .car-label {
                left: 70px;
                font-size: 18px;
                top: 28px;
            }

            .lane {
                height: 80px;
            }

            h1 {
                font-size: 26px;
            }

            .target-value {
                font-size: 24px;
            }

            .controls {
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
    <h1>🚗 {{ $lesson_game->lesson->name ?? 'سباق الجمع' }}</h1>

    <div class="game-info">
        <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
        <strong>النطاق:</strong> من {{ $min_range }} إلى {{ $max_range }}
    </div>

    <p id="instruction">اضغط على السيارة التي مجموع رقمينها يساوي العدد المطلوب</p>

    <div class="target-display">
        <span>العدد المطلوب:</span>
        <span class="target-value" id="target">0</span>
    </div>

    <div class="score">النقاط: <span id="score">0</span></div>

    <div class="track">
        <div class="finish-line"></div>
        <div class="lanes" id="lanesArea"></div>
    </div>

    <div class="controls">
        <button id="newBtn">🔄 جولة جديدة</button>
        <button id="hintBtn">💡 تلميح</button>
    </div>

    <div id="msg"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 9 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'سباق الجمع' }}";

        // تحديث عنوان الصفحة
        document.title = "🚗 " + gameTitle;

        // عناصر DOM
        const lanesArea = document.getElementById('lanesArea');
        const targetEl = document.getElementById('target');
        const msg = document.getElementById('msg');
        const newBtn = document.getElementById('newBtn');
        const hintBtn = document.getElementById('hintBtn');
        const scoreEl = document.getElementById('score');
        const instructionEl = document.getElementById('instruction');

        // حالة اللعبة
        let target = 0;
        let options = [];
        let score = 0;
        let gameActive = true;
        let correctCars = [];

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
            lanesArea.innerHTML = '';
            msg.textContent = '';
            msg.className = '';
            gameActive = true;
            options = [];
            correctCars = [];

            // تحديد الهدف بناءً على النطاق
            target = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            targetEl.textContent = target;

            // تحديث التعليمات
            instructionEl.textContent = `اضغط على السيارة التي مجموع رقمينها يساوي ${target}`;

            // إنشاء السيارات
            createCars();
        }

        /**
         * إنشاء السيارات
         */
        function createCars() {
            // توليد 4 سيارات مع ضمان وجود واحدة صحيحة على الأقل
            const correctA = Math.floor(Math.random() * (target - 1)) + 1;
            const correctB = target - correctA;
            let pairs = [[correctA, correctB]];

            // توليد أزواج إضافية
            while (pairs.length < 4) {
                let a = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                let b = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                // تجنب التكرار
                if (!pairs.some(p => p[0] === a && p[1] === b)) {
                    pairs.push([a, b]);
                }
            }

            // خلط الأزواج
            pairs.sort(() => Math.random() - 0.5);

            // أنواع السيارات المختلفة
            const carTypes = ['🚗', '🚙', '🚕', '🚓', '🚑', '🚒', '🚐', '🚚'];

            pairs.forEach((p, i) => {
                const lane = document.createElement('div');
                lane.className = 'lane';

                const car = document.createElement('div');
                car.className = 'car';
                car.textContent = carTypes[i % carTypes.length];
                lane.appendChild(car);

                const label = document.createElement('div');
                label.className = 'car-label';
                label.textContent = `${p[0]} + ${p[1]}`;
                lane.appendChild(label);

                lanesArea.appendChild(lane);

                const sum = p[0] + p[1];
                options.push({ a: p[0], b: p[1], sum: sum, el: car, lane: lane });

                car.addEventListener('click', () => checkCar(sum, car, lane));

                // تسجيل السيارات الصحيحة
                if (sum === target) {
                    correctCars.push(car);
                }
            });
        }

        /**
         * التحقق من السيارة
         */
        function checkCar(sum, carEl, laneEl) {
            if (!gameActive) return;

            if (sum === target) {
                // الإجابة الصحيحة
                carEl.classList.add('correct', 'winner');
                msg.textContent = `🎉 أحسنت! ${carEl.parentElement.querySelector('.car-label').textContent} = ${target}`;
                msg.className = 'msg-success';
                playTone(880, 0.18);

                // تحريك السيارة للجانب الأيمن (نهاية المسار)
                const laneWidth = laneEl.offsetWidth;
                carEl.style.left = (laneWidth - 70) + 'px';

                // زيادة النقاط
                score += 10;
                scoreEl.textContent = score;

                // تأثير الفوز
                createConfetti(laneEl);

                gameActive = false;

                // عرض جميع السيارات الصحيحة
                setTimeout(() => {
                    correctCars.forEach(car => {
                        if (!car.classList.contains('correct')) {
                            const carLane = car.parentElement;
                            const carLaneWidth = carLane.offsetWidth;
                            car.style.left = (carLaneWidth - 70) + 'px';
                            car.classList.add('correct');
                        }
                    });
                }, 1000);

            } else {
                // الإجابة الخاطئة
                carEl.classList.add('wrong');
                msg.textContent = `😅 ${carEl.parentElement.querySelector('.car-label').textContent} = ${sum} ≠ ${target} — جرب سيارة أخرى`;
                msg.className = 'msg-error';
                playTone(220, 0.18);

                // إزالة class الخطأ بعد فترة
                setTimeout(() => {
                    carEl.classList.remove('wrong');
                }, 1000);
            }
        }

        /**
         * إنشاء تأثير الكونفيتي
         */
        function createConfetti(laneEl) {
            for (let i = 0; i < 20; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.background = `hsl(${Math.random() * 360}, 70%, 60%)`;
                confetti.style.animationDelay = Math.random() * 1 + 's';
                laneEl.appendChild(confetti);

                setTimeout(() => {
                    confetti.remove();
                }, 2000);
            }
        }

        /**
         * عرض تلميح
         */
        function showHint() {
            if (!gameActive) return;

            if (correctCars.length > 0) {
                const randomCorrect = correctCars[Math.floor(Math.random() * correctCars.length)];

                // تأثير تلميح للسيارة الصحيحة
                randomCorrect.animate([
                    { transform: 'scale(1)' },
                    { transform: 'scale(1.3)' },
                    { transform: 'scale(1)' }
                ], {
                    duration: 1000,
                    easing: 'ease-in-out',
                    iterations: 2
                });

                msg.textContent = '💡 انظر إلى السيارة التي تضيء!';
                msg.className = 'msg-success';

                // خصم نقاط لاستخدام التلميح
                score = Math.max(0, score - 2);
                scoreEl.textContent = score;
            }
        }

        // أحداث الأزرار
        newBtn.addEventListener('click', newGame);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', newGame);
    </script>
</body>
</html>
