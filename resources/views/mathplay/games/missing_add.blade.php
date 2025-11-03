<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>❓ {{ $lesson_game->lesson->name ?? 'جمل مفقودة: اكمل ثم حول' }}</title>
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --secondary: #ef6c00;
            --secondary-dark: #e65100;
            --success: #43a047;
            --error: #d32f2f;
            --background: #e8f5e9;
            --card: #ffffff;
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
            margin-bottom: 10px;
            font-size: 32px;
        }

        .game-info {
            background: #c8e6c9;
            padding: 10px 15px;
            border-radius: 10px;
            margin: 0 auto 20px auto;
            max-width: 600px;
            font-size: 14px;
            color: var(--primary-dark);
            border: 1px solid #a5d6a7;
        }

        .card {
            background: var(--card);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #c8e6c9;
        }

        #prompt {
            font-weight: 900;
            font-size: 28px;
            margin: 20px 0;
            color: var(--primary-dark);
            background: #f1f8e9;
            padding: 20px;
            border-radius: 12px;
            border: 2px dashed #a5d6a7;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .missing-number {
            display: inline-block;
            width: 60px;
            height: 60px;
            background: #ffeb3b;
            border-radius: 50%;
            line-height: 60px;
            margin: 0 10px;
            border: 3px solid #fbc02d;
            font-weight: 900;
            color: #f57f17;
        }

        .opts {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        button.opt {
            padding: 16px 24px;
            border-radius: 12px;
            border: 0;
            background: var(--primary);
            color: #fff;
            font-weight: 900;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.2s ease;
            min-width: 70px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        button.opt:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        button.opt:active {
            transform: translateY(0);
        }

        button.opt.correct {
            background: var(--success);
            transform: scale(1.1);
        }

        button.opt.wrong {
            background: var(--error);
            animation: shake 0.5s ease-in-out;
        }

        #result {
            min-height: 60px;
            font-weight: 900;
            margin-top: 20px;
            padding: 16px;
            border-radius: 12px;
            font-size: 18px;
            transition: all 0.3s ease;
            line-height: 1.6;
        }

        .result-success {
            color: var(--success);
            background: #e8f5e8;
            border: 2px solid #a5d6a7;
        }

        .result-info {
            color: #1976d2;
            background: #e3f2fd;
            border: 2px solid #90caf9;
        }

        .controls {
            margin-top: 25px;
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        button.control-btn {
            padding: 12px 20px;
            border-radius: 10px;
            border: 0;
            background: var(--secondary);
            color: #fff;
            font-weight: 800;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        button.control-btn:hover {
            background: var(--secondary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        button.control-btn:active {
            transform: translateY(0);
        }

        .score {
            font-size: 20px;
            font-weight: 700;
            margin: 15px 0;
            color: var(--primary);
            background: rgba(255,255,255,0.8);
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .explanation {
            background: #fff3e0;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-right: 4px solid #ff9800;
            text-align: right;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .bounce {
            animation: bounce 0.5s ease-in-out;
        }

        @media (max-width: 600px) {
            #prompt {
                font-size: 22px;
                padding: 15px;
            }

            .missing-number {
                width: 50px;
                height: 50px;
                line-height: 50px;
                font-size: 18px;
            }

            button.opt {
                padding: 14px 20px;
                font-size: 18px;
                min-width: 60px;
            }

            .controls {
                flex-direction: column;
                align-items: center;
            }

            button.control-btn {
                width: 200px;
            }

            h1 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <h1>❓ {{ $lesson_game->lesson->name ?? 'جمل مفقودة: اكمل ثم حول' }}</h1>

    <div class="game-info">
        <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
        <strong>النطاق:</strong> من {{ $min_range }} إلى {{ $max_range }}
    </div>

    <div class="card">
        <div class="score">النقاط: <span id="score">0</span></div>

        <div id="prompt">تحميل...</div>

        <div class="opts" id="opts"></div>

        <div id="result"></div>

        <div class="explanation" id="explanation">
            <strong>💡 تذكر:</strong> العلاقة بين الجمع والطرح - إذا كان أ + ب = جـ، فإن جـ - أ = ب وجـ - ب = أ
        </div>

        <div class="controls">
            <button class="control-btn" id="newBtn">🔄 سؤال جديد</button>
            <button class="control-btn" id="showBtn">🔎 أظهر جملة الطرح</button>
            <button class="control-btn" id="hintBtn">💡 تلميح</button>
        </div>
    </div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 10 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'جمل مفقودة: اكمل ثم حول' }}";

        // تحديث عنوان الصفحة
        document.title = "❓ " + gameTitle;

        // عناصر DOM
        const promptEl = document.getElementById('prompt');
        const optsEl = document.getElementById('opts');
        const resultEl = document.getElementById('result');
        const newBtn = document.getElementById('newBtn');
        const showBtn = document.getElementById('showBtn');
        const hintBtn = document.getElementById('hintBtn');
        const scoreEl = document.getElementById('score');
        const explanationEl = document.getElementById('explanation');

        // حالة اللعبة
        let total = 0;
        let missingIdx = 0;
        let knownNumber = 0;
        let correctAnswer = 0;
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
         * توليد عدد عشوائي ضمن النطاق
         */
        function rand(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        /**
         * عرض سؤال جديد
         */
        function render() {
            optsEl.innerHTML = '';
            resultEl.textContent = '';
            resultEl.className = '';
            gameActive = true;

            // اختيار المجموع الكلي ضمن النطاق
            total = rand(minRange + 1, maxRange);

            // اختيار أي موقع سيكون مفقوداً (0 للعدد الأول، 1 للعدد الثاني)
            missingIdx = Math.random() < 0.5 ? 0 : 1;

            if (missingIdx === 0) {
                // النمط: ? + ب = المجموع
                knownNumber = rand(1, total - 1);
                correctAnswer = total - knownNumber;
                promptEl.innerHTML = `<span class="missing-number">?</span> + ${knownNumber} = ${total}`;
            } else {
                // النمط: أ + ? = المجموع
                knownNumber = rand(1, total - 1);
                correctAnswer = total - knownNumber;
                promptEl.innerHTML = `${knownNumber} + <span class="missing-number">?</span> = ${total}`;
            }

            // توليد خيارات الإجابة
            const opts = new Set([correctAnswer]);
            while (opts.size < 4) {
                const randomOpt = rand(1, maxRange);
                // تأكد من أن الخيار ضمن النطاق المنطقي
                if (randomOpt !== correctAnswer && randomOpt <= maxRange) {
                    opts.add(randomOpt);
                }
            }

            // عرض الخيارات بشكل عشوائي
            Array.from(opts).sort(() => Math.random() - 0.5).forEach(n => {
                const btn = document.createElement('button');
                btn.className = 'opt';
                btn.textContent = n;
                btn.addEventListener('click', () => pick(n, btn));
                optsEl.appendChild(btn);
            });

            // تحديث الشرح بناءً على النمط
            if (missingIdx === 0) {
                explanationEl.innerHTML = `<strong>💡 تذكر:</strong> لإيجاد العدد المجهول، نطرح العدد المعروف من المجموع: ${total} - ${knownNumber} = ?`;
            } else {
                explanationEl.innerHTML = `<strong>💡 تذكر:</strong> لإيجاد العدد المجهول، نطرح العدد المعروف من المجموع: ${total} - ${knownNumber} = ?`;
            }
        }

        /**
         * اختيار إجابة
         */
        function pick(n, btn) {
            if (!gameActive) return;

            if (n === correctAnswer) {
                // الإجابة الصحيحة
                btn.classList.add('correct');
                resultEl.textContent = `✅ أحسنت! الإجابة الصحيحة هي ${n}`;
                resultEl.className = 'result-success';

                // عرض العلاقة بين الجمع والطرح
                if (missingIdx === 0) {
                    resultEl.textContent += `\nالعلاقة: ${n} + ${knownNumber} = ${total} ← ${total} - ${n} = ${knownNumber}`;
                } else {
                    resultEl.textContent += `\nالعلاقة: ${knownNumber} + ${n} = ${total} ← ${total} - ${knownNumber} = ${n}`;
                }

                playTone(880, 0.18);

                // زيادة النقاط
                score += 10;
                scoreEl.textContent = score;

                gameActive = false;
            } else {
                // الإجابة الخاطئة
                btn.classList.add('wrong');
                resultEl.textContent = `❌ خطأ! ${n} ليست الإجابة الصحيحة. حاول مرة أخرى`;
                resultEl.className = 'result-info';
                playTone(220, 0.18);

                // إزالة class الخطأ بعد فترة
                setTimeout(() => {
                    btn.classList.remove('wrong');
                }, 1000);

                // خصم نقطة للإجابة الخاطئة
                score = Math.max(0, score - 1);
                scoreEl.textContent = score;
            }
        }

        /**
         * عرض جملة الطرح المكافئة
         */
        function showSubtraction() {
            if (!gameActive) return;

            let subtractionSentence = '';
            if (missingIdx === 0) {
                subtractionSentence = `${total} - ? = ${knownNumber}`;
            } else {
                subtractionSentence = `${total} - ${knownNumber} = ?`;
            }

            resultEl.textContent = `🔎 جملة الطرح المكافئة: ${subtractionSentence}\nالجواب الصحيح هو: ${correctAnswer}`;
            resultEl.className = 'result-info';

            // خصم نقاط لاستخدام المساعدة
            score = Math.max(0, score - 3);
            scoreEl.textContent = score;

            gameActive = false;
        }

        /**
         * عرض تلميح
         */
        function showHint() {
            if (!gameActive) return;

            // عرض تلميح عن عملية الطرح
            const hintMessage = `💡 تلميح: استخدم عملية الطرح! ${total} - ${knownNumber} = ?`;
            resultEl.textContent = hintMessage;
            resultEl.className = 'result-info';

            // خصم نقاط لاستخدام التلميح
            score = Math.max(0, score - 2);
            scoreEl.textContent = score;
        }

        // أحداث الأزرار
        newBtn.addEventListener('click', render);
        showBtn.addEventListener('click', showSubtraction);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', render);
    </script>
</body>
</html>
