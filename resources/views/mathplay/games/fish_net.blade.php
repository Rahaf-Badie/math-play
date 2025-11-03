{{-- resources/views/mathplay/games/fish_net.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>🐠 جمع الأسماك - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
            margin: 0;
            padding: 20px;
            text-align: center;
            color: #103f47;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #0277bd;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #e0f7fa;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #0277bd;
        }

        .game-area {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #4dd0e1;
        }

        .sea {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .pool {
            width: 400px;
            background: linear-gradient(135deg, #b3e5fc 0%, #81d4fa 100%);
            border-radius: 20px;
            padding: 20px;
            min-height: 280px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-content: flex-start;
            justify-content: center;
            border: 3px solid #4fc3f7;
            box-shadow: inset 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .pool::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 20px,
                rgba(255, 255, 255, 0.1) 20px,
                rgba(255, 255, 255, 0.1) 40px
            );
            pointer-events: none;
        }

        .net {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            width: 320px;
            border: 3px solid #ffb74d;
        }

        .fish {
            width: 70px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, #4dd0e1 0%, #26c6da 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #004d40;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid transparent;
            font-size: 18px;
            position: relative;
            user-select: none;
        }

        .fish:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border-color: #fff;
        }

        .fish:active {
            transform: translateY(-2px) scale(1.02);
        }

        .fish.caught {
            opacity: 0.4;
            transform: scale(0.9);
            pointer-events: none;
            background: linear-gradient(135deg, #81c784 0%, #4caf50 100%);
        }

        .fish.over-limit {
            animation: shake 0.5s ease-in-out;
            background: linear-gradient(135deg, #ef9a9a 0%, #f44336 100%);
        }

        .controls {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        button {
            background: linear-gradient(135deg, #0288d1 0%, #0277bd 100%);
            border: 0;
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(2, 136, 209, 0.3);
            font-family: inherit;
            font-size: 14px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 136, 209, 0.4);
        }

        button.reset {
            background: linear-gradient(135deg, #90a4ae 0%, #607d8b 100%);
        }

        .info-panel {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            border-right: 4px solid #0288d1;
        }

        .target-display {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
            color: #0277bd;
        }

        .current-display {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
            color: #f57c00;
        }

        .progress-container {
            margin: 15px 0;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: #e0e0e0;
            border-radius: 6px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            border-radius: 6px;
            transition: width 0.3s ease;
            width: 0%;
        }

        #msg {
            min-height: 40px;
            font-weight: bold;
            margin-top: 20px;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .msg-success {
            color: #2e7d32;
            background: #e8f5e9;
            border: 2px solid #4caf50;
            animation: celebrate 0.6s ease-in-out;
        }

        .msg-warning {
            color: #f57c00;
            background: #fff3e0;
            border: 2px solid #ffb74d;
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
            background: #e0f7fa;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        @keyframes swim {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-5px) rotate(-2deg); }
            75% { transform: translateY(5px) rotate(2deg); }
        }

        .swimming {
            animation: swim 3s ease-in-out infinite;
        }

        .operation-info {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
            background: #f5f5f5;
            padding: 8px 12px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐠 جمع الأسماك</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="game-area">
            <div class="info-panel">
                <p id="instruction">اضغط على السمك لجمعه في الشبكة — هدفك الوصول إلى العدد المطلوب دون تجاوزه</p>
            </div>

            <div class="sea">
                <div class="pool" id="pool"></div>
                <div class="net" id="netBox">
                    <div class="target-display">الهدف: <span id="target">0</span></div>
                    <div class="current-display">المجموع الحالي: <span id="current">0</span></div>

                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress" id="progressBar"></div>
                        </div>
                    </div>

                    <div class="controls">
                        <button id="newBtn">🔄 جولة جديدة</button>
                        <button id="resetBtn" class="reset">↩️ إفراغ الشبكة</button>
                    </div>

                    <div id="msg"></div>

                    <div class="operation-info">
                        @if($settings->operation_type == 'addition')
                            عملية: الجمع - اختر الأسماك التي مجموعها يساوي الهدف
                        @else
                            عملية: الجمع - اختر الأسماك التي مجموعها يساوي الهدف
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};
        const operationType = "{{ $settings->operation_type ?? 'addition' }}";
        const maxLimit = maxRange; // أقصى حد للمجموع

        const pool = document.getElementById('pool');
        const newBtn = document.getElementById('newBtn');
        const resetBtn = document.getElementById('resetBtn');
        const targetEl = document.getElementById('target');
        const currentEl = document.getElementById('current');
        const msg = document.getElementById('msg');
        const progressBar = document.getElementById('progressBar');
        const scoreElement = document.getElementById('score');
        const instruction = document.getElementById('instruction');

        let target = 0;
        let current = 0;
        let fishes = [];
        let points = 0;
        let attempts = 0;
        let gameActive = true;

        // تحديث التعليمات بناءً على نوع العملية والمدى
        instruction.textContent = `اضغط على السمك لجمعه في الشبكة — هدفك الوصول إلى العدد ${maxLimit} دون تجاوزه`;

        function newGame() {
            if (!gameActive) return;

            pool.innerHTML = '';
            msg.textContent = '';
            msg.className = '';
            current = 0;

            // توليد هدف عشوائي ضمن المدى
            target = Math.floor(Math.random() * (maxLimit - 2)) + 2; // من 2 إلى maxLimit-1
            targetEl.textContent = target;
            currentEl.textContent = current;
            updateProgressBar();

            fishes = [];
            // توليد 12 سمكة بقيم من 1 إلى 4
            for (let i = 0; i < 12; i++) {
                const n = Math.floor(Math.random() * 4) + 1; // 1-4
                const f = document.createElement('div');
                f.className = 'fish swimming';
                f.textContent = n;
                f.dataset.val = n;

                // تأثير طفو عشوائي
                f.style.animationDelay = `${(i % 3) * 0.5}s`;

                f.addEventListener('click', () => pickFish(f));
                pool.appendChild(f);
                fishes.push(f);
            }
        }

        function pickFish(fish) {
            if (!gameActive) return;

            const val = Number(fish.dataset.val);

            // التحقق من عدم تجاوز الحد الأقصى
            if (current + val > maxLimit) {
                msg.textContent = `❌ لا يمكن إضافة ${val} — سيصبح المجموع ${current + val} (>${maxLimit})`;
                msg.className = 'msg-error';

                // تأثير اهتزاز للسمكة
                fish.classList.add('over-limit');
                setTimeout(() => {
                    fish.classList.remove('over-limit');
                }, 500);
                return;
            }

            // إضافة القيمة
            current += val;
            currentEl.textContent = current;

            // تأثير اصطياد السمكة
            fish.classList.add('caught');
            fish.style.pointerEvents = 'none';

            msg.textContent = `🎣 أضفت ${val} — المجموع الآن ${current}`;
            msg.className = 'msg-warning';

            updateProgressBar();
            checkResult();
        }

        function updateProgressBar() {
            const percentage = (current / maxLimit) * 100;
            progressBar.style.width = `${percentage}%`;

            if (current > target) {
                progressBar.style.background = 'linear-gradient(135deg, #f44336 0%, #d32f2f 100%)';
            } else if (current === target) {
                progressBar.style.background = 'linear-gradient(135deg, #4caf50 0%, #2e7d32 100%)';
            } else {
                progressBar.style.background = 'linear-gradient(135deg, #2196f3 0%, #1976d2 100%)';
            }
        }

        function checkResult() {
            if (current === target) {
                // النجاح في الوصول للهدف
                attempts++;
                points++;
                msg.textContent = getSuccessMessage();
                msg.className = 'msg-success';
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                gameActive = false;
                setTimeout(() => {
                    gameActive = true;
                    newGame();
                }, 2000);
            } else if (current > target) {
                // تجاوز الهدف
                msg.textContent = `⚠️ تجاوزت الهدف! ${current} > ${target}`;
                msg.className = 'msg-error';
            }
        }

        function resetGame() {
            if (!gameActive) return;

            // إعادة تعيين جميع الأسماك
            fishes.forEach(fish => {
                fish.classList.remove('caught', 'over-limit');
                fish.style.pointerEvents = 'auto';
                fish.style.opacity = '1';
            });

            current = 0;
            currentEl.textContent = current;
            msg.textContent = '';
            msg.className = '';
            updateProgressBar();
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! لقد اصطدت العدد الصحيح",
                "👏 رائع! مهارة صيد ممتازة",
                "💫 إبداع! مجموع الأسماك = " + target,
                "🌟 برافو! أنت صياد ماهر"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        newBtn.addEventListener('click', newGame);
        resetBtn.addEventListener('click', resetGame);

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
