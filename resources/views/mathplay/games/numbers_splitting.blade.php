<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔢 {{ $lesson_game->lesson->name ?? 'تفكيك الأعداد - الصورة الموسعة' }}</title>
    <style>
        :root {
            --primary: #ff6b6b;
            --primary-dark: #e64a4a;
            --secondary: #06d6a0;
            --secondary-dark: #05b38a;
            --accent: #ffd166;
            --accent-dark: #ffb846;
            --tens-color: #118ab2;
            --ones-color: #ef476f;
            --background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: var(--background);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            max-width: 1000px;
            width: 100%;
            color: #333;
            text-align: center;
        }

        .game-info {
            background: #ffe8dc;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 0 auto 20px auto;
            max-width: 600px;
            font-size: 1rem;
            color: var(--primary-dark);
            border: 2px solid var(--primary);
        }

        h1 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .instructions {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-size: 1.2rem;
            line-height: 1.6;
            color: #2d3436;
            border: 2px dashed #74b9ff;
        }

        .example {
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 12px 20px;
            border-radius: 10px;
            margin: 15px 0;
            font-size: 1.1rem;
            color: #073b4c;
            display: inline-block;
            font-weight: bold;
        }

        .target-number {
            font-size: 4rem;
            font-weight: bold;
            margin: 20px 0;
            color: #073b4c;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 20px 40px;
            border-radius: 20px;
            display: inline-block;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 5px solid #ef476f;
        }

        .game-area {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .number-box {
            width: 180px;
            height: 180px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border: 5px solid;
            transition: all 0.3s ease;
        }

        .tens-box {
            background: linear-gradient(135deg, var(--tens-color), #06d6a0);
            border-color: #073b4c;
        }

        .ones-box {
            background: linear-gradient(135deg, var(--ones-color), #ff9e6d);
            border-color: #ef476f;
        }

        .result-box {
            background: linear-gradient(135deg, #ffd166, #ffb846);
            border-color: #e6ac00;
        }

        .number-label {
            font-size: 1.4rem;
            font-weight: bold;
            color: white;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .number-value {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .math-symbol {
            font-size: 3.5rem;
            font-weight: bold;
            color: var(--accent-dark);
            margin: 0 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .blocks-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            padding: 25px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            border: 3px dashed #74b9ff;
        }

        .block {
            width: 80px;
            height: 80px;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
            border: 3px solid;
            position: relative;
        }

        .block:hover {
            transform: scale(1.15);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .block:active {
            transform: scale(1.05);
        }

        .tens-block {
            background: linear-gradient(135deg, var(--tens-color), #06d6a0);
            border-color: #073b4c;
        }

        .ones-block {
            background: linear-gradient(135deg, var(--ones-color), #ff9e6d);
            border-color: #ef476f;
        }

        .block.used {
            opacity: 0.4;
            cursor: not-allowed;
            transform: scale(0.9);
        }

        .block-value {
            position: absolute;
            top: -8px;
            right: -8px;
            background: white;
            color: #333;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            font-size: 0.9rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 30px;
            font-size: 1.2rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #check-btn {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            color: #073b4c;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .feedback {
            margin-top: 20px;
            font-size: 1.4rem;
            font-weight: bold;
            min-height: 60px;
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .correct {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: white;
            animation: pulse 1s infinite;
        }

        .incorrect {
            background: linear-gradient(135deg, #ef476f, #ff9e6d);
            color: white;
            animation: shake 0.5s ease-in-out;
        }

        .info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        .score {
            font-size: 1.4rem;
            margin-top: 20px;
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            padding: 12px 25px;
            border-radius: 50px;
            display: inline-block;
            color: #073b4c;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .expanded-form {
            font-size: 1.3rem;
            margin: 15px 0;
            padding: 12px 20px;
            background: #e9ecef;
            border-radius: 10px;
            display: inline-block;
            font-weight: bold;
            color: #495057;
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
            .game-area {
                flex-direction: column;
                gap: 15px;
            }

            .math-symbol {
                margin: 10px 0;
                transform: rotate(90deg);
            }

            h1 {
                font-size: 2rem;
            }

            .target-number {
                font-size: 3rem;
                padding: 15px 30px;
            }

            .number-box {
                width: 150px;
                height: 150px;
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
    <div class="container">
        <div class="game-info">
            <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
            <strong>النطاق:</strong> من {{ $min_range }} إلى {{ $max_range }}
        </div>

        <h1>🔢 {{ $lesson_game->lesson->name ?? 'تفكيك الأعداد - الصورة الموسعة' }}</h1>

        <div class="instructions">
            <p>مرحباً! ساعدني في تفكيك العدد إلى عشراته وآحاده باستخدام القطع المناسبة.</p>
        </div>

        <div class="example">
            <strong>مثال:</strong> العدد 14 = 10 + 4 أو 1 عشرات + 4 آحاد
        </div>

        <div class="target-number" id="target-number">14</div>

        <div class="expanded-form" id="expanded-form"></div>

        <div class="game-area">
            <div class="number-box tens-box" id="tens-box">
                <div class="number-label">العشرات</div>
                <div class="number-value" id="tens-value">0</div>
            </div>

            <div class="math-symbol">+</div>

            <div class="number-box ones-box" id="ones-box">
                <div class="number-label">الآحاد</div>
                <div class="number-value" id="ones-value">0</div>
            </div>

            <div class="math-symbol">=</div>

            <div class="number-box result-box" id="result-box">
                <div class="number-label">المجموع</div>
                <div class="number-value" id="result-value">0</div>
            </div>
        </div>

        <div class="blocks-container" id="blocks-container">
            <!-- سيتم إنشاء القطع ديناميكياً -->
        </div>

        <div class="controls">
            <button id="check-btn">✅ تحقق من الإجابة</button>
            <button id="hint-btn">💡 تلميح</button>
            <button id="reset-btn">🔄 إعادة المحاولة</button>
        </div>

        <div class="feedback" id="feedback">اختر القطع المناسبة لتفكيك العدد</div>

        <div class="score">النقاط: <span id="score">0</span></div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 10 }};
        const maxRange = {{ $max_range ?? 20 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'تفكيك الأعداد - الصورة الموسعة' }}";

        // تحديث عنوان الصفحة
        document.title = "🔢 " + gameTitle;

        // عناصر DOM
        const tensValue = document.getElementById('tens-value');
        const onesValue = document.getElementById('ones-value');
        const resultValue = document.getElementById('result-value');
        const targetNumber = document.getElementById('target-number');
        const expandedForm = document.getElementById('expanded-form');
        const blocksContainer = document.getElementById('blocks-container');
        const checkBtn = document.getElementById('check-btn');
        const resetBtn = document.getElementById('reset-btn');
        const hintBtn = document.getElementById('hint-btn');
        const feedback = document.getElementById('feedback');
        const scoreElement = document.getElementById('score');
        const celebrationEl = document.getElementById('celebration');

        // حالة اللعبة
        let score = 0;
        let currentNumber = 0;
        let currentTens = 0;
        let currentOnes = 0;
        let correctTens = 0;
        let correctOnes = 0;

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
         * إنشاء قطع جديدة
         */
        function createBlocks() {
            blocksContainer.innerHTML = '';

            // قطعة العشرات
            const tensBlock = document.createElement('div');
            tensBlock.className = 'block tens-block';
            tensBlock.setAttribute('data-value', '10');
            tensBlock.innerHTML = '10<div class="block-value">10</div>';
            blocksContainer.appendChild(tensBlock);

            // قطع الآحاد
            for (let i = 1; i <= 9; i++) {
                const onesBlock = document.createElement('div');
                onesBlock.className = 'block ones-block';
                onesBlock.setAttribute('data-value', i.toString());
                onesBlock.innerHTML = `${i}<div class="block-value">${i}</div>`;
                blocksContainer.appendChild(onesBlock);
            }

            // إضافة أحداث النقر
            setupBlockEvents();
        }

        /**
         * إعداد أحداث القطع
         */
        function setupBlockEvents() {
            const blocks = document.querySelectorAll('.block');
            blocks.forEach(block => {
                block.addEventListener('click', function() {
                    if (this.classList.contains('used')) return;

                    const blockValue = parseInt(this.getAttribute('data-value'));

                    if (this.classList.contains('tens-block')) {
                        // قطعة العشرات
                        if (currentTens === 0 && blockValue === 10) {
                            currentTens = blockValue;
                            tensValue.textContent = currentTens;
                            this.classList.add('used');
                            feedback.textContent = `تم إضافة ${blockValue} إلى العشرات`;
                            feedback.className = 'feedback info';
                            playTone(550, 0.2);
                        } else {
                            feedback.textContent = 'يمكن إضافة قطعة العشرات مرة واحدة فقط!';
                            feedback.className = 'feedback incorrect';
                            playTone(220, 0.2);
                            return;
                        }
                    } else {
                        // قطع الآحاد
                        if (currentOnes + blockValue <= 9) {
                            currentOnes += blockValue;
                            onesValue.textContent = currentOnes;
                            this.classList.add('used');
                            feedback.textContent = `تم إضافة ${blockValue} إلى الآحاد`;
                            feedback.className = 'feedback info';
                            playTone(440, 0.1);
                        } else {
                            feedback.textContent = 'لا يمكن أن يتجاوز الآحاد الرقم 9!';
                            feedback.className = 'feedback incorrect';
                            playTone(220, 0.2);
                            return;
                        }
                    }

                    updateResult();
                });
            });
        }

        /**
         * تحديث النتيجة والصورة الموسعة
         */
        function updateResult() {
            const total = currentTens + currentOnes;
            resultValue.textContent = total;

            // تحديث الصورة الموسعة
            if (currentTens > 0 || currentOnes > 0) {
                expandedForm.textContent = `${currentNumber} = ${currentTens} + ${currentOnes}`;
            }

            return total;
        }

        /**
         * إنشاء عدد عشوائي جديد
         */
        function generateNewNumber() {
            currentNumber = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            targetNumber.textContent = currentNumber;

            // حساب القيم الصحيحة
            correctTens = Math.floor(currentNumber / 10) * 10;
            correctOnes = currentNumber % 10;

            resetGame();
        }

        /**
         * إعادة تعيين اللعبة
         */
        function resetGame() {
            currentTens = 0;
            currentOnes = 0;
            tensValue.textContent = '0';
            onesValue.textContent = '0';
            resultValue.textContent = '0';
            expandedForm.textContent = '';

            // إعادة تفعيل جميع القطع
            const blocks = document.querySelectorAll('.block');
            blocks.forEach(block => {
                block.classList.remove('used');
            });

            feedback.textContent = 'اختر القطع المناسبة لتفكيك العدد';
            feedback.className = 'feedback';
        }

        /**
         * التحقق من الإجابة
         */
        function checkAnswer() {
            const total = currentTens + currentOnes;

            if (total === currentNumber) {
                feedback.textContent = `🎉 أحسنت! ${currentNumber} = ${currentTens} + ${currentOnes}`;
                feedback.className = 'feedback correct';
                playTone(880, 0.5);

                // زيادة النقاط
                score += 10;
                scoreElement.textContent = score;

                // تأثير الاحتفال
                createCelebration();

                // إنشاء عدد جديد بعد ثانيتين
                setTimeout(generateNewNumber, 2000);
            } else {
                feedback.textContent = `❌ ليس صحيحاً. ${currentNumber} = ${correctTens} + ${correctOnes}`;
                feedback.className = 'feedback incorrect';
                playTone(220, 0.3);

                // خصم نقطة للإجابة الخاطئة
                score = Math.max(0, score - 2);
                scoreElement.textContent = score;
            }
        }

        /**
         * عرض تلميح
         */
        function showHint() {
            const hintMessage = `💡 تلميح: ${currentNumber} = ${correctTens} + ${correctOnes}`;

            feedback.textContent = hintMessage;
            feedback.className = 'feedback info';

            // خصم نقاط لاستخدام التلميح
            score = Math.max(0, score - 3);
            scoreElement.textContent = score;
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
        checkBtn.addEventListener('click', checkAnswer);
        resetBtn.addEventListener('click', resetGame);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة
        createBlocks();
        generateNewNumber();
    </script>
</body>
</html>
