<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍎 {{ $lesson_game->lesson->name ?? 'السلة الفارغة' }}</title>
    <style>
        :root {
            --primary: #ff7043;
            --primary-dark: #bf360c;
            --success: #2e7d32;
            --error: #d32f2f;
            --background: #fffbe6;
            --basket: #ffe0b2;
            --text: #5d4037;
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
            margin-bottom: 12px;
            font-size: 28px;
        }

        .game-info {
            background: #fff3e0;
            padding: 10px 15px;
            border-radius: 10px;
            margin: 0 auto 15px auto;
            max-width: 500px;
            font-size: 14px;
            color: var(--primary-dark);
            border: 1px solid #ffcc80;
        }

        #instruction {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 15px;
            color: var(--primary-dark);
        }

        .baskets {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
            padding: 10px;
        }

        .basket {
            width: 100px;
            height: 110px;
            background: var(--basket);
            border-radius: 12px;
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            transition: transform .25s, box-shadow .25s, background-color .2s;
            border: 2px solid transparent;
            padding: 5px;
        }

        .basket:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, .12);
            background: #ffd54f;
        }

        .basket::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 8px;
            background: #ffb74d;
            border-radius: 4px 4px 0 0;
        }

        .fruit-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 3px;
            max-width: 80px;
            min-height: 60px;
        }

        .fruit {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .fruit::before {
            content: '';
            position: absolute;
            top: -3px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            background: #8d6e63;
            border-radius: 50%;
        }

        .fruit::after {
            content: '';
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 6px;
            background: #5d4037;
        }

        .correct {
            outline: 3px solid var(--success);
            background: #c8e6c9 !important;
            transform: scale(1.05);
        }

        .wrong {
            outline: 3px solid var(--error);
            background: #ffcdd2 !important;
        }

        #msg {
            font-size: 20px;
            font-weight: 700;
            margin-top: 20px;
            min-height: 30px;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .msg-success {
            color: var(--success);
            background: #e8f5e8;
            border: 1px solid #a5d6a7;
        }

        .msg-error {
            color: var(--error);
            background: #ffebee;
            border: 1px solid #ef9a9a;
        }

        .controls {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        button {
            padding: 10px 16px;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: background-color .2s, transform .1s;
            font-size: 16px;
        }

        button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        .empty-label {
            font-size: 14px;
            color: #757575;
            font-weight: 600;
            margin-top: 5px;
        }

        @media (max-width: 600px) {
            .basket {
                width: 85px;
                height: 95px;
            }

            .fruit {
                width: 18px;
                height: 18px;
            }

            h1 {
                font-size: 24px;
            }

            #instruction {
                font-size: 16px;
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

    <h1>🍎 {{ $lesson_game->lesson->name ?? 'السلة الفارغة' }}</h1>

    <div class="game-info">
        <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
        <strong>الهدف:</strong> التعرف على العدد صفر من خلال السلة الفارغة
    </div>

    <p id="instruction">اختر السلة التي تحتوي على صفر تفاحات</p>

    <div class="baskets" id="baskets"></div>

    <p id="msg"></p>

    <div class="controls">
        <button id="newGameBtn">🔄 جولة جديدة</button>
        <button id="hintBtn">💡 تلميح</button>
    </div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 0 }};
        const maxRange = {{ $max_range ?? 5 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'السلة الفارغة' }}";

        // تحديث عنوان الصفحة
        document.title = "🍎 " + gameTitle;

        // عناصر DOM
        const basketsEl = document.getElementById('baskets');
        const msgEl = document.getElementById('msg');
        const newGameBtn = document.getElementById('newGameBtn');
        const hintBtn = document.getElementById('hintBtn');
        const instructionEl = document.getElementById('instruction');

        // حالة اللعبة
        let correctBasket = 0;
        let totalBaskets = 6;
        let gameActive = true;

        // ألوان الفواكه
        const fruitColors = [
            '#ff5252', // أحمر
            '#ff9800', // برتقالي
            '#ffeb3b', // أصفر
            '#4caf50', // أخضر
            '#2196f3', // أزرق
            '#9c27b0'  // بنفسجي
        ];

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
            basketsEl.innerHTML = '';
            msgEl.textContent = '';
            msgEl.className = '';
            gameActive = true;

            // تحديد عدد السلال بناءً على النطاق
            totalBaskets = Math.min(8, Math.max(4, maxRange - minRange + 2));

            // اختيار سلة عشوائية لتكون فارغة
            let emptyIndex = Math.floor(Math.random() * totalBaskets);
            correctBasket = emptyIndex;

            // إنشاء السلال
            for (let i = 0; i < totalBaskets; i++) {
                const basket = document.createElement('div');
                basket.className = 'basket';
                basket.dataset.index = i;

                const fruitContainer = document.createElement('div');
                fruitContainer.className = 'fruit-container';

                if (i !== emptyIndex) {
                    // سلة تحتوي على فواكه
                    let fruitCount = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    if (fruitCount === 0) fruitCount = 1; // تأكد من أن السلة ليست فارغة

                    for (let j = 0; j < fruitCount; j++) {
                        const fruit = document.createElement('div');
                        fruit.className = 'fruit';
                        const colorIndex = Math.floor(Math.random() * fruitColors.length);
                        fruit.style.backgroundColor = fruitColors[colorIndex];
                        fruitContainer.appendChild(fruit);
                    }
                } else {
                    // السلة الفارغة
                    const emptyLabel = document.createElement('div');
                    emptyLabel.className = 'empty-label';
                    emptyLabel.textContent = 'فارغة';
                    fruitContainer.appendChild(emptyLabel);
                }

                basket.appendChild(fruitContainer);
                basket.addEventListener('click', () => checkAnswer(i, basket));
                basketsEl.appendChild(basket);
            }
        }

        /**
         * التحقق من الإجابة
         */
        function checkAnswer(selectedIndex, basketElement) {
            if (!gameActive) return;

            const allBaskets = document.querySelectorAll('.basket');

            // إزالة التحديد من جميع السلال
            allBaskets.forEach(basket => {
                basket.classList.remove('correct', 'wrong');
            });

            if (selectedIndex === correctBasket) {
                // الإجابة الصحيحة
                basketElement.classList.add('correct');
                msgEl.textContent = '🎉 أحسنت! هذه السلة فارغة (تحتوي على صفر تفاحات)';
                msgEl.className = 'msg-success';
                playTone(880, 0.18);

                // تأثير النجاح
                basketElement.animate([
                    { transform: 'scale(1)' },
                    { transform: 'scale(1.1)' },
                    { transform: 'scale(1)' }
                ], {
                    duration: 500,
                    easing: 'ease-out'
                });

                gameActive = false;
            } else {
                // الإجابة الخاطئة
                basketElement.classList.add('wrong');
                msgEl.textContent = '😅 ليس صحيحًا، هذه السلة تحتوي على تفاحات. حاول مرة أخرى';
                msgEl.className = 'msg-error';
                playTone(220, 0.18);

                // تأثير الخطأ
                basketElement.animate([
                    { transform: 'translateX(0)' },
                    { transform: 'translateX(-5px)' },
                    { transform: 'translateX(5px)' },
                    { transform: 'translateX(0)' }
                ], {
                    duration: 300
                });
            }
        }

        /**
         * عرض تلميح
         */
        function showHint() {
            if (!gameActive) return;

            const allBaskets = document.querySelectorAll('.basket');
            const correctBasketElement = allBaskets[correctBasket];

            // تأثير تلميح للسلة الصحيحة
            correctBasketElement.animate([
                { transform: 'scale(1)' },
                { transform: 'scale(1.05)' },
                { transform: 'scale(1)' }
            ], {
                duration: 1000,
                easing: 'ease-in-out'
            });

            msgEl.textContent = '💡 انظر إلى السلة التي لا تحتوي على أي تفاحات';
            msgEl.className = 'msg-success';
        }

        // أحداث الأزرار
        newGameBtn.addEventListener('click', newGame);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', newGame);

        // تحديث التعليمات بناءً على النطاق
        instructionEl.textContent = `اختر السلة التي تحتوي على صفر تفاحات (العدد ${minRange} إلى ${maxRange})`;
    </script>
</body>
</html>
