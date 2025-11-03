<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>🔢 {{ $lesson_game->lesson->name ?? 'أي المجموعة أكبر؟' }}</title>
    <style>
        :root {
            --primary: #ff7f50;
            --primary-dark: #e67347;
            --success: #198754;
            --success-light: #b4f8c8;
            --error: #dc3545;
            --error-light: #ffb4b4;
            --background: #fff7f0;
            --box-bg: #ffffff;
        }

        body {
            font-family: "Noto Kufi Arabic", "Segoe UI", Tahoma, sans-serif;
            background: var(--background);
            text-align: center;
            padding: 20px;
            margin: 0;
            color: #333;
        }

        h1 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 2.2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .game-info {
            background: #ffe8dc;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 0 auto 20px auto;
            max-width: 500px;
            font-size: 1rem;
            color: var(--primary-dark);
            border: 2px solid var(--primary);
        }

        .instruction {
            font-size: 1.4rem;
            font-weight: bold;
            margin: 20px 0;
            color: #5a5a5a;
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            display: inline-block;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .box {
            width: 200px;
            min-height: 200px;
            background: var(--box-bg);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            padding: 20px;
            border: 4px solid transparent;
            position: relative;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border-color: var(--primary);
        }

        .box-label {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        .items-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            width: 100%;
        }

        .img-item {
            width: 35px;
            height: 35px;
            font-size: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .img-item:hover {
            transform: scale(1.2);
        }

        .correct {
            background: var(--success-light);
            border-color: var(--success);
            animation: pulse 0.5s ease-in-out;
        }

        .wrong {
            background: var(--error-light);
            border-color: var(--error);
            animation: shake 0.5s ease-in-out;
        }

        #msg {
            margin-top: 20px;
            font-weight: 700;
            font-size: 1.3rem;
            min-height: 50px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .msg-success {
            color: var(--success);
            background: #d4edda;
            border: 2px solid #c3e6cb;
        }

        .msg-error {
            color: var(--error);
            background: #f8d7da;
            border: 2px solid #f5c6cb;
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
            background: var(--primary);
            color: white;
            border: 0;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        button:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        button:active {
            transform: translateY(0);
        }

        .score {
            font-size: 1.3rem;
            margin-top: 20px;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 12px 25px;
            border-radius: 25px;
            display: inline-block;
            color: #5a5a5a;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-weight: bold;
        }

        .comparison-result {
            font-size: 1.5rem;
            margin: 15px 0;
            padding: 12px 20px;
            background: #e9ecef;
            border-radius: 10px;
            display: inline-block;
            font-weight: bold;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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
            .container {
                gap: 20px;
            }

            .box {
                width: 170px;
                min-height: 170px;
                padding: 15px;
            }

            .img-item {
                width: 30px;
                height: 30px;
                font-size: 24px;
            }

            h1 {
                font-size: 1.8rem;
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
    <h1>🔢 {{ $lesson_game->lesson->name ?? 'أي المجموعة أكبر؟' }}</h1>

    <div class="game-info">
        <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
        <strong>النطاق:</strong> من {{ $min_range }} إلى {{ $max_range }}
    </div>

    <div class="instruction">انقر على المجموعة التي تحتوي على عدد أكبر</div>

    <div class="container">
        <div class="box" id="box1">
            <div class="box-label">المجموعة أ</div>
            <div class="items-container" id="items1"></div>
        </div>
        <div class="box" id="box2">
            <div class="box-label">المجموعة ب</div>
            <div class="items-container" id="items2"></div>
        </div>
    </div>

    <div class="comparison-result" id="comparisonResult"></div>

    <div id="msg"></div>

    <div class="controls">
        <button id="nextBtn">🔄 مجموعة جديدة</button>
        <button id="hintBtn">💡 تلميح</button>
    </div>

    <div class="score">النقاط: <span id="score">0</span></div>

    <div class="celebration" id="celebration"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 20 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'أي المجموعة أكبر؟' }}";

        // تحديث عنوان الصفحة
        document.title = "🔢 " + gameTitle;

        // رموز متنوعة للعبة
        const symbols = ["⭐", "🍎", "🐶", "⚽", "🚗", "🐱", "🍕", "🏀", "🚲", "🍦", "🐼", "🎈", "🍉", "🦋", "🎨"];

        // عناصر DOM
        const box1 = document.getElementById('box1');
        const box2 = document.getElementById('box2');
        const items1 = document.getElementById('items1');
        const items2 = document.getElementById('items2');
        const msg = document.getElementById('msg');
        const nextBtn = document.getElementById('nextBtn');
        const hintBtn = document.getElementById('hintBtn');
        const scoreEl = document.getElementById('score');
        const comparisonResult = document.getElementById('comparisonResult');
        const celebrationEl = document.getElementById('celebration');

        // حالة اللعبة
        let correctBox = null;
        let count1 = 0;
        let count2 = 0;
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
         * إنشاء مجموعتين جديدتين
         */
        function newGroups() {
            // إعادة تعيين التصميم
            box1.classList.remove('correct', 'wrong');
            box2.classList.remove('correct', 'wrong');
            items1.innerHTML = '';
            items2.innerHTML = '';
            msg.textContent = '';
            msg.className = '';
            comparisonResult.textContent = '';
            gameActive = true;

            // توليد أعداد عشوائية ضمن النطاق
            count1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            let tempCount2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            // التأكد من أن العددين مختلفين
            while (tempCount2 === count1) {
                tempCount2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            }
            count2 = tempCount2;

            // اختيار رموز عشوائية مختلفة للمجموعتين
            const symbol1 = symbols[Math.floor(Math.random() * symbols.length)];
            let symbol2 = symbols[Math.floor(Math.random() * symbols.length)];

            // التأكد من أن الرمزين مختلفين
            while (symbol2 === symbol1) {
                symbol2 = symbols[Math.floor(Math.random() * symbols.length)];
            }

            // إضافة العناصر إلى المجموعة الأولى
            for (let i = 0; i < count1; i++) {
                const item = document.createElement('div');
                item.textContent = symbol1;
                item.className = 'img-item';
                items1.appendChild(item);
            }

            // إضافة العناصر إلى المجموعة الثانية
            for (let i = 0; i < count2; i++) {
                const item = document.createElement('div');
                item.textContent = symbol2;
                item.className = 'img-item';
                items2.appendChild(item);
            }

            // تحديد المجموعة الأكبر
            correctBox = count1 > count2 ? box1 : box2;

            console.log(`المجموعة أ: ${count1} عناصر، المجموعة ب: ${count2} عناصر، الأكبر: ${count1 > count2 ? 'أ' : 'ب'}`);
        }

        /**
         * التعامل مع النقر على المجموعات
         */
        [box1, box2].forEach(box => {
            box.addEventListener('click', () => {
                if (!gameActive) return;

                if (box === correctBox) {
                    // الإجابة الصحيحة
                    box.classList.add('correct');
                    msg.textContent = '🎉 أحسنت! هذه المجموعة تحتوي على عدد أكبر';
                    msg.className = 'msg-success';
                    playTone(880, 0.3);

                    // عرض نتيجة المقارنة
                    comparisonResult.textContent = `${count1} ${count1 > count2 ? '>' : '<'} ${count2}`;
                    comparisonResult.style.background = '#d4edda';
                    comparisonResult.style.color = '#198754';

                    // زيادة النقاط
                    score += 10;
                    scoreEl.textContent = score;

                    // تأثير الاحتفال
                    createCelebration();

                    gameActive = false;
                } else {
                    // الإجابة الخاطئة
                    box.classList.add('wrong');
                    msg.textContent = '❌ ليس صحيحًا، حاول مرة أخرى';
                    msg.className = 'msg-error';
                    playTone(220, 0.3);

                    // خصم نقطة للإجابة الخاطئة
                    score = Math.max(0, score - 1);
                    scoreEl.textContent = score;

                    // إزالة class الخطأ بعد فترة
                    setTimeout(() => {
                        box.classList.remove('wrong');
                    }, 1000);
                }
            });
        });

        /**
         * عرض تلميح
         */
        function showHint() {
            if (!gameActive) return;

            const hintMessage = `💡 تلميح: المجموعة أ تحتوي على ${count1} عناصر والمجموعة ب تحتوي على ${count2} عناصر`;

            msg.textContent = hintMessage;
            msg.className = 'msg-success';

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
        nextBtn.addEventListener('click', newGroups);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة
        newGroups();
    </script>
</body>
</html>
