<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🃏 {{ $lesson_game->lesson->name ?? 'البطاقات التعليمية - القيمة المنزلية' }}</title>
    <style>
        :root {
            --primary: #ff6b6b;
            --primary-dark: #e64a4a;
            --secondary: #06d6a0;
            --secondary-dark: #05b38a;
            --accent: #ffd166;
            --accent-dark: #ffb846;
            --background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
            --card-front: linear-gradient(135deg, #ffd166, #ff9e6d);
            --card-back: linear-gradient(135deg, #06d6a0, #118ab2);
            --block-bg: linear-gradient(135deg, #a8edea, #fed6e3);
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

        .game-area {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            margin: 30px 0;
        }

        .card {
            width: 160px;
            height: 220px;
            perspective: 1000px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card.selected {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(255, 107, 107, 0.5);
        }

        .card-inner {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card.flipped .card-inner {
            transform: rotateY(180deg);
        }

        .card-front, .card-back {
            width: 100%;
            height: 100%;
            position: absolute;
            backface-visibility: hidden;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            border: 3px solid white;
        }

        .card-front {
            background: var(--card-front);
            color: #073b4c;
        }

        .card-back {
            background: var(--card-back);
            color: white;
            transform: rotateY(180deg);
        }

        .card-number {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-label {
            font-size: 1.1rem;
            font-weight: bold;
            text-align: center;
        }

        .card-value {
            font-size: 2.2rem;
            font-weight: bold;
            margin: 15px 0;
        }

        .place-value {
            font-size: 1.3rem;
            margin: 5px 0;
            font-weight: 600;
        }

        .blocks-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .block {
            width: 140px;
            height: 170px;
            background: var(--block-bg);
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            border: 3px dashed #74b9ff;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .block:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        .block.selected {
            border: 3px solid var(--primary);
            background: linear-gradient(135deg, #ffeb3b, #ffc107);
        }

        .block-label {
            font-size: 1.3rem;
            font-weight: bold;
            color: #073b4c;
            margin-bottom: 15px;
        }

        .block-value {
            font-size: 3rem;
            font-weight: bold;
            color: #073b4c;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .block-value.filled {
            color: var(--primary-dark);
            transform: scale(1.1);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 30px;
            font-size: 1.2rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
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

        #new-cards-btn {
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
            transition: all 0.3s;
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
            animation: shake 0.5s;
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

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
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
                align-items: center;
            }

            .blocks-container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .card {
                width: 140px;
                height: 190px;
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

        <h1>🃏 {{ $lesson_game->lesson->name ?? 'البطاقات التعليمية - القيمة المنزلية' }}</h1>

        <div class="instructions">
            <p>مرحباً! انقر على البطاقات لمعرفة قيمتها المنزلية، ثم انقر على خانات العشرات والآحاد لوضع القيم الصحيحة.</p>
        </div>

        <div class="game-area" id="gameArea">
            <!-- سيتم إنشاء البطاقات ديناميكياً -->
        </div>

        <div class="blocks-container">
            <div class="block" id="tens-block">
                <div class="block-label">العشرات</div>
                <div class="block-value" id="tens-value">?</div>
            </div>

            <div class="block" id="ones-block">
                <div class="block-label">الآحاد</div>
                <div class="block-value" id="ones-value">?</div>
            </div>
        </div>

        <div class="controls">
            <button id="check-btn">✅ تحقق من الإجابة</button>
            <button id="hint-btn">💡 تلميح</button>
            <button id="new-cards-btn">🔄 بطاقات جديدة</button>
        </div>

        <div class="feedback" id="feedback">انقر على البطاقة لمعرفة قيمتها المنزلية</div>

        <div class="score">النقاط: <span id="score">0</span></div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 10 }};
        const maxRange = {{ $max_range ?? 20 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'البطاقات التعليمية - القيمة المنزلية' }}";

        // تحديث عنوان الصفحة
        document.title = "🃏 " + gameTitle;

        // عناصر DOM
        const gameArea = document.getElementById('gameArea');
        const tensBlock = document.getElementById('tens-block');
        const onesBlock = document.getElementById('ones-block');
        const tensValue = document.getElementById('tens-value');
        const onesValue = document.getElementById('ones-value');
        const checkBtn = document.getElementById('check-btn');
        const newCardsBtn = document.getElementById('new-cards-btn');
        const hintBtn = document.getElementById('hint-btn');
        const feedback = document.getElementById('feedback');
        const scoreElement = document.getElementById('score');
        const celebrationEl = document.getElementById('celebration');

        // حالة اللعبة
        let score = 0;
        let selectedCard = null;
        let currentCardNumber = 0;
        let currentTens = 0;
        let currentOnes = 0;
        let cardsData = [];

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
         * إنشاء بطاقات جديدة
         */
        function generateNewCards() {
            gameArea.innerHTML = '';
            cardsData = [];
            feedback.textContent = 'انقر على البطاقة لمعرفة قيمتها المنزلية';
            feedback.className = 'feedback';

            // إعادة تعيين الكتل
            tensValue.textContent = '?';
            onesValue.textContent = '?';
            tensValue.classList.remove('filled');
            onesValue.classList.remove('filled');
            tensBlock.classList.remove('selected');
            onesBlock.classList.remove('selected');

            selectedCard = null;
            currentCardNumber = 0;
            currentTens = 0;
            currentOnes = 0;

            // توليد 3 أرقام فريدة ضمن النطاق
            const numbers = [];
            while (numbers.length < 3) {
                const num = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                if (!numbers.includes(num)) {
                    numbers.push(num);
                }
            }

            // إنشاء البطاقات
            numbers.forEach((num, index) => {
                const card = document.createElement('div');
                card.className = 'card';
                card.id = `card${index + 1}`;

                const tens = Math.floor(num / 10);
                const ones = num % 10;

                card.innerHTML = `
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-number">${num}</div>
                            <div class="card-label">انقر لمعرفة القيمة المنزلية</div>
                        </div>
                        <div class="card-back">
                            <div class="card-label">العدد</div>
                            <div class="card-value">${num}</div>
                            <div class="place-value">${tens} عشرات</div>
                            <div class="place-value">${ones} آحاد</div>
                        </div>
                    </div>
                `;

                gameArea.appendChild(card);
                cardsData.push({ number: num, tens: tens, ones: ones });

                // إضافة حدث النقر على البطاقة
                card.addEventListener('click', () => selectCard(card, num, tens, ones));
            });
        }

        /**
         * اختيار بطاقة
         */
        function selectCard(card, number, tens, ones) {
            // إزالة التحديد من جميع البطاقات
            document.querySelectorAll('.card').forEach(c => {
                c.classList.remove('selected');
                c.classList.remove('flipped');
            });

            // تحديد البطاقة المختارة وقلبها
            card.classList.add('selected');
            card.classList.add('flipped');
            selectedCard = card;
            currentCardNumber = number;
            currentTens = tens;
            currentOnes = ones;

            feedback.textContent = `العدد ${number} يتكون من ${tens} عشرات و ${ones} آحاد`;
            feedback.className = 'feedback info';
            playTone(550, 0.2);
        }

        /**
         * التعامل مع النقر على الكتل
         */
        const blocks = [tensBlock, onesBlock];
        blocks.forEach(block => {
            block.addEventListener('click', function() {
                if (!selectedCard) {
                    feedback.textContent = 'يرجى اختيار بطاقة أولاً!';
                    feedback.className = 'feedback incorrect';
                    playTone(220, 0.2);
                    return;
                }

                // تحديث قيمة الكتلة المحددة
                if (this.id === 'tens-block') {
                    tensValue.textContent = currentTens;
                    tensValue.classList.add('filled');
                    this.classList.add('selected');
                    feedback.textContent = `تم تعيين العشرات: ${currentTens}`;
                } else {
                    onesValue.textContent = currentOnes;
                    onesValue.classList.add('filled');
                    this.classList.add('selected');
                    feedback.textContent = `تم تعيين الآحاد: ${currentOnes}`;
                }

                feedback.className = 'feedback info';
                playTone(440, 0.1);
            });
        });

        /**
         * التحقق من الإجابة
         */
        function checkAnswer() {
            if (!selectedCard) {
                feedback.textContent = 'يرجى اختيار بطاقة أولاً!';
                feedback.className = 'feedback incorrect';
                playTone(220, 0.2);
                return;
            }

            const tens = parseInt(tensValue.textContent);
            const ones = parseInt(onesValue.textContent);

            if (tensValue.textContent === '?' || onesValue.textContent === '?') {
                feedback.textContent = 'يرجى تعيين قيم العشرات والآحاد أولاً!';
                feedback.className = 'feedback incorrect';
                playTone(220, 0.2);
                return;
            }

            if (tens === currentTens && ones === currentOnes) {
                feedback.textContent = `🎉 أحسنت! العدد ${currentCardNumber} = ${tens} عشرات + ${ones} آحاد`;
                feedback.className = 'feedback correct';
                playTone(880, 0.5);

                // زيادة النقاط
                score += 10;
                scoreElement.textContent = score;

                // تأثير الاحتفال
                createCelebration();

                // إنشاء بطاقات جديدة بعد ثانيتين
                setTimeout(generateNewCards, 2000);
            } else {
                feedback.textContent = `❌ ليس صحيحاً. العدد ${currentCardNumber} = ${currentTens} عشرات + ${currentOnes} آحاد`;
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
            if (!selectedCard) {
                feedback.textContent = 'يرجى اختيار بطاقة أولاً!';
                feedback.className = 'feedback incorrect';
                return;
            }

            const hintMessage = `💡 تلميح: العدد ${currentCardNumber} = ${currentTens} عشرات + ${currentOnes} آحاد`;

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
        newCardsBtn.addEventListener('click', generateNewCards);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة
        generateNewCards();
    </script>
</body>
</html>
