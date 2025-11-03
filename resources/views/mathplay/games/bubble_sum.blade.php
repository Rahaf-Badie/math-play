{{-- resources/views/mathplay/games/bubble_sum.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>🎈 {{ $lesson_game->lesson->name ?? 'فقاعات العمليات الحسابية' }}</title>
    <style>
        :root {
            --primary: #1565c0;
            --primary-light: #42a5f5;
            --success: #2e7d32;
            --error: #d32f2f;
            --background: #e3f2fd;
            --text: #0d47a1;
        }

        body {
            font-family: "Noto Kufi Arabic", "Segoe UI", Tahoma, sans-serif;
            background: var(--background);
            margin: 0;
            padding: 20px;
            text-align: center;
            color: var(--text);
        }

        h1 {
            color: var(--primary);
            margin-bottom: 6px;
            font-size: 28px;
        }

        .game-info {
            background: #bbdefb;
            padding: 10px 15px;
            border-radius: 10px;
            margin: 0 auto 15px auto;
            max-width: 600px;
            font-size: 14px;
            color: var(--primary);
            border: 1px solid #90caf9;
        }

        #instruction {
            font-weight: 800;
            margin-bottom: 12px;
            font-size: 18px;
            color: #0d47a1;
        }

        .target-display {
            background: white;
            padding: 12px 20px;
            border-radius: 25px;
            display: inline-block;
            margin: 10px auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: 3px solid var(--primary);
        }

        .target-value {
            font-size: 24px;
            font-weight: 900;
            color: var(--primary);
            margin: 0 5px;
        }

        #board {
            max-width: 900px;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            padding: 15px;
        }

        .bubble {
            width: 110px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(145deg, var(--primary-light), var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 900;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(0,0,0,.15);
            transition: all 0.3s ease;
            border: 3px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .bubble::before {
            content: '';
            position: absolute;
            top: -10%;
            left: -10%;
            width: 120%;
            height: 120%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
        }

        .bubble:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 12px 24px rgba(0,0,0,.2);
        }

        .bubble.correct {
            background: linear-gradient(145deg, #4caf50, #2e7d32);
            transform: scale(0.95);
            border-color: var(--success);
        }

        .bubble.wrong {
            background: linear-gradient(145deg, #f44336, #d32f2f);
            border-color: var(--error);
            animation: shake 0.5s ease-in-out;
        }

        .bubble.popped {
            opacity: 0.4;
            transform: scale(0.9);
            pointer-events: none;
            background: linear-gradient(145deg, #9e9e9e, #757575);
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

        .controls {
            margin-top: 20px;
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        button {
            background: var(--primary);
            border: 0;
            color: white;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        button:hover {
            background: #0d47a1;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        button:active {
            transform: translateY(0);
        }

        .score {
            font-size: 18px;
            font-weight: 700;
            margin: 10px 0;
            color: var(--primary);
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .bubble {
            animation: float 3s ease-in-out infinite;
        }

        .bubble:nth-child(2n) {
            animation-delay: 0.5s;
        }

        .bubble:nth-child(3n) {
            animation-delay: 1s;
        }

        @media (max-width: 600px) {
            .bubble {
                width: 90px;
                height: 80px;
                font-size: 16px;
            }

            #board {
                gap: 10px;
            }

            h1 {
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
    <h1>🎈 {{ $lesson_game->lesson->name ?? 'فقاعات العمليات الحسابية' }}</h1>

    <div class="game-info">
        <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
        <strong>نوع العملية:</strong>
        @if($settings->operation_type == 'addition')
            جمع
        @elseif($settings->operation_type == 'subtraction')
            طرح
        @else
            {{ $settings->operation_type ?? 'جمع' }}
        @endif
        |
        <strong>النطاق:</strong> من {{ $settings->min_range ?? 1 }} إلى {{ $settings->max_range ?? 9 }}
    </div>

    <p id="instruction">فقع الفقاعات التي ناتج عمليتها يساوي العدد المطلوب</p>

    <div class="target-display">
        <span>الهدف:</span>
        <span class="target-value" id="target">0</span>
    </div>

    <div class="score">النقاط: <span id="score">0</span></div>

    <div id="board"></div>

    <div class="controls">
        <button id="newBtn">🔄 جولة جديدة</button>
        <button id="hintBtn">💡 تلميح</button>
    </div>

    <div id="msg"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};
        const operationType = "{{ $settings->operation_type ?? 'addition' }}";
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'فقاعات العمليات الحسابية' }}";

        // التأكد من نوع العملية
        const currentOperationType = operationType;

        // تحديث عنوان الصفحة
        document.title = "🎈 " + gameTitle;

        // عناصر DOM
        const board = document.getElementById('board');
        const targetEl = document.getElementById('target');
        const newBtn = document.getElementById('newBtn');
        const hintBtn = document.getElementById('hintBtn');
        const msg = document.getElementById('msg');
        const scoreEl = document.getElementById('score');
        const instructionEl = document.getElementById('instruction');

        // حالة اللعبة
        let target = 0;
        let bubbles = [];
        let score = 0;
        let gameActive = true;
        let correctBubbles = [];

        /**
         * بدء لعبة جديدة
         */
        function newGame() {
            board.innerHTML = '';
            msg.textContent = '';
            msg.className = '';
            gameActive = true;
            bubbles = [];
            correctBubbles = [];

            // تحديد الهدف بناءً على نوع العملية والنطاق
            if (currentOperationType === 'subtraction') {
                // للطرح: الهدف هو الفرق بين عددين
                target = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            } else {
                // للجمع: الهدف هو مجموع عددين
                target = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            }

            targetEl.textContent = target;

            // تحديث التعليمات بناءً على نوع العملية
            updateInstruction();

            // إنشاء الفقاعات
            createBubbles();

            // ضمان وجود فقاعة صحيحة واحدة على الأقل
            ensureCorrectBubble();
        }

        /**
         * تحديث التعليمات بناءً على نوع العملية
         */
        function updateInstruction() {
            if (currentOperationType === 'addition') {
                instructionEl.textContent = `فقع الفقاعات التي مجموعها يساوي ${target}`;
            } else if (currentOperationType === 'subtraction') {
                instructionEl.textContent = `فقع الفقاعات التي ناتج طرحها يساوي ${target}`;
            } else {
                instructionEl.textContent = `فقع الفقاعات التي تمثل العدد ${target}`;
            }
        }

        /**
         * إنشاء الفقاعات
         */
        function createBubbles() {
            const numBubbles = 9;

            for (let i = 0; i < numBubbles; i++) {
                let a, b, result, displayText;

                if (currentOperationType === 'subtraction') {
                    // عملية الطرح: a - b = result
                    a = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    b = Math.floor(Math.random() * (a - minRange + 1)) + minRange;
                    result = a - b;
                    displayText = `${a} - ${b}`;
                } else if (currentOperationType === 'addition') {
                    // عملية الجمع: a + b = result
                    a = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    b = Math.floor(Math.random() * (maxRange - a + 1)) + minRange;
                    result = a + b;
                    displayText = `${a} + ${b}`;
                } else {
                    // لمكونات العدد: عرض العدد نفسه
                    result = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    displayText = `${result}`;
                }

                const el = document.createElement('div');
                el.className = 'bubble';
                el.textContent = displayText;
                el.dataset.result = result;
                el.addEventListener('click', () => popBubble(el, result));
                board.appendChild(el);

                bubbles.push({ a, b, result, el, displayText });

                // تسجيل الفقاعات الصحيحة
                if (result === target) {
                    correctBubbles.push(el);
                }
            }
        }

        /**
         * ضمان وجود فقاعة صحيحة واحدة على الأقل
         */
        function ensureCorrectBubble() {
            if (correctBubbles.length === 0) {
                const randomIndex = Math.floor(Math.random() * bubbles.length);
                const bubble = bubbles[randomIndex];

                // تعديل الفقاعة لتصبح صحيحة
                if (currentOperationType === 'subtraction') {
                    // جعل a - b = target
                    bubble.a = target + Math.floor(Math.random() * 3) + 1;
                    bubble.b = bubble.a - target;
                    bubble.result = target;
                    bubble.displayText = `${bubble.a} - ${bubble.b}`;
                } else if (currentOperationType === 'addition') {
                    // جعل a + b = target
                    bubble.a = Math.floor(Math.random() * (target - 1)) + 1;
                    bubble.b = target - bubble.a;
                    bubble.result = target;
                    bubble.displayText = `${bubble.a} + ${bubble.b}`;
                } else {
                    // لمكونات العدد: جعل الفقاعة تمثل العدد المستهدف
                    bubble.result = target;
                    bubble.displayText = `${target}`;
                }

                bubble.el.textContent = bubble.displayText;
                bubble.el.dataset.result = target;
                correctBubbles.push(bubble.el);
            }
        }

        /**
         * فقع الفقاعة
         */
        function popBubble(el, result) {
            if (!gameActive) return;

            if (result === target) {
                // الإجابة الصحيحة
                el.classList.add('correct', 'popped');
                el.textContent = '✓';
                msg.textContent = `🎉 أحسنت! ${el.textContent} = ${target}`;
                msg.className = 'msg-success';

                // زيادة النقاط
                score += 10;
                scoreEl.textContent = score;

                // تحقق إذا كانت جميع الفقاعات الصحيحة قد فقعت
                checkGameCompletion();
            } else {
                // الإجابة الخاطئة
                el.classList.add('wrong');
                if (currentOperationType === 'addition') {
                    msg.textContent = `❌ ${el.textContent} = ${result} ≠ ${target}`;
                } else if (currentOperationType === 'subtraction') {
                    msg.textContent = `❌ ${el.textContent} = ${result} ≠ ${target}`;
                } else {
                    msg.textContent = `❌ ${el.textContent} ≠ ${target}`;
                }
                msg.className = 'msg-error';

                // إزالة class الخطأ بعد فترة
                setTimeout(() => {
                    el.classList.remove('wrong');
                }, 1000);
            }
        }

        /**
         * التحقق من اكتمال اللعبة
         */
        function checkGameCompletion() {
            const remainingCorrect = correctBubbles.filter(bubble =>
                !bubble.classList.contains('popped')
            );

            if (remainingCorrect.length === 0) {
                msg.textContent = `🎊 مبروك! لقد فقعت جميع الفقاعات الصحيحة! النقاط: ${score}`;
                gameActive = false;
            }
        }

        /**
         * عرض تلميح
         */
        function showHint() {
            if (!gameActive) return;

            const unpoppedCorrect = correctBubbles.filter(bubble =>
                !bubble.classList.contains('popped')
            );

            if (unpoppedCorrect.length > 0) {
                const randomCorrect = unpoppedCorrect[Math.floor(Math.random() * unpoppedCorrect.length)];

                // تأثير تلميح للفقاعة الصحيحة
                randomCorrect.animate([
                    { transform: 'scale(1)' },
                    { transform: 'scale(1.2)' },
                    { transform: 'scale(1)' }
                ], {
                    duration: 1000,
                    easing: 'ease-in-out'
                });

                msg.textContent = '💡 انظر إلى الفقاعة التي تضيء!';
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
