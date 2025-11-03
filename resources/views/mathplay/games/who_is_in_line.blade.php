<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>🎯 {{ $lesson_game->lesson->name ?? 'من يقف أولًا في الصف؟' }}</title>
    <style>
        :root {
            --bg: #f7fbff;
            --card: #fff;
            --accent: #ffb74d;
            --ok: #2e7d32;
            --err: #d32f2f;
        }

        body {
            font-family: "Noto Kufi Arabic", "Segoe UI", Tahoma, sans-serif;
            background: var(--bg);
            margin: 0;
            padding: 18px;
            text-align: center;
            color: #123;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 26px;
            color: #1976d2;
        }

        .game {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
            max-width: 980px;
            margin: 8px auto;
        }

        .panel {
            background: var(--card);
            padding: 14px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(25, 118, 210, .08);
            width: 100%;
        }

        #instruction {
            font-weight: 800;
            color: #0b556e;
            margin-bottom: 10px;
            font-size: 18px;
        }

        /* row of kids */
        .row {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .kid {
            width: 82px;
            height: 110px;
            background: linear-gradient(180deg, #fff, #fff);
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 10px;
            cursor: pointer;
            position: relative;
            border: 2px solid transparent;
            transition: transform .25s, box-shadow .25s, border-color .15s;
        }

        .kid:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .12);
        }

        .avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffd9b3, #ffb380);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .name {
            margin-top: 8px;
            font-weight: 700;
            font-size: 14px;
            color: #333;
        }

        .pos-label {
            position: absolute;
            bottom: 6px;
            left: 0;
            right: 0;
            font-size: 12px;
            color: #666;
        }

        /* visual for correct/wrong */
        .kid.correct {
            outline: 3px solid rgba(46, 125, 50, .12);
            box-shadow: 0 8px 18px rgba(46, 125, 50, .12);
            transform: scale(1.06);
        }

        .kid.wrong {
            outline: 3px solid rgba(211, 47, 47, .12);
            transform: translateY(0) scale(.98);
            opacity: .9;
        }

        /* feedback */
        #feedback {
            min-height: 26px;
            font-weight: 800;
            margin: 10px 0;
        }

        .ok {
            color: var(--ok);
        }

        .bad {
            color: var(--err);
        }

        /* confetti canvas */
        canvas {
            position: absolute;
            left: 0;
            top: 0;
            pointer-events: none;
        }

        /* footer controls */
        .controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .btn {
            background: #1976d2;
            color: white;
            padding: 8px 12px;
            border-radius: 10px;
            border: 0;
            cursor: pointer;
            font-weight: 700;
            transition: background-color .2s;
        }

        .btn:hover {
            background: #1565c0;
        }

        .small {
            padding: 6px 10px;
            font-size: 14px;
        }

        .game-info {
            background: #e3f2fd;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            color: #0d47a1;
        }

        @media (max-width: 600px) {
            .kid {
                width: 68px;
                height: 98px;
            }

            .avatar {
                width: 48px;
                height: 48px;
                font-size: 26px;
            }

            .controls {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                max-width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="game">
        <h1>🎯 {{ $lesson_game->lesson->name ?? 'من يقف في الصف؟' }}</h1>

        <div class="game-info">
            <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
            <strong>نطاق الأرقام:</strong> من {{ $min_range }} إلى {{ $max_range }}
        </div>

        <div class="panel" id="panel">
            <div id="instruction">تحميل...</div>

            <div class="row" id="row"></div>

            <div id="feedback" aria-live="polite"></div>

            <div class="controls">
                <button class="btn small" id="newBtn">🔄 جولة جديدة</button>
                <button class="btn small" id="revealBtn">🔎 أظهر الإجابة</button>
            </div>
        </div>
    </div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 9 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'من يقف في الصف؟' }}";

        // تحديث عنوان الصفحة
        document.title = "🎯 " + gameTitle;

        /* بيانات شخصيات كرتونية */
        const kidsData = [
            {name: 'ليان', color: '#ff8a80', emoji: '🧒'},
            {name: 'سليم', color: '#ffd180', emoji: '👦'},
            {name: 'نور', color: '#b39ddb', emoji: '👧'},
            {name: 'علي', color: '#a5d6a7', emoji: '👦'},
            {name: 'مها', color: '#ffcc80', emoji: '👧'},
            {name: 'رامي', color: '#90caf9', emoji: '👦'},
            {name: 'هنا', color: '#f48fb1', emoji: '👧'},
            {name: 'زياد', color: '#c5e1a5', emoji: '👦'},
            {name: 'ليلى', color: '#ffe082', emoji: '👧'},
            {name: 'ياسمين', color: '#ce93d8', emoji: '👧'},
            {name: 'خالد', color: '#80cbc4', emoji: '👦'},
            {name: 'سارة', color: '#ffab91', emoji: '👧'}
        ];

        // كلمات المرتبة الترتيبية بالعربية
        const orderWords = [
            "الأولى", "الثانية", "الثالثة", "الرابعة", "الخامسة",
            "السادسة", "السابعة", "الثامنة", "التاسعة", "العاشرة",
            "الحادية عشرة", "الثانية عشرة"
        ];

        // عناصر DOM
        const rowEl = document.getElementById('row');
        const instr = document.getElementById('instruction');
        const feedback = document.getElementById('feedback');
        const newBtn = document.getElementById('newBtn');
        const revealBtn = document.getElementById('revealBtn');

        // حالة اللعبة
        let currentOrder = []; // مصفوفة مؤشرات إلى kidsData
        let targetPos = 0; // الموضع المستهدف (بدءًا من 0)
        let correctIndex = -1; // المؤشر الصحيح
        let gameActive = true; // حالة اللعبة نشطة

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
         * إنشاء صف من الأطفال بناءً على currentOrder
         */
        function renderRow() {
            rowEl.innerHTML = '';
            currentOrder.forEach((kidIndex, pos) => {
                const d = kidsData[kidIndex];
                const el = document.createElement('div');
                el.className = 'kid';
                el.dataset.pos = pos;
                el.dataset.kid = kidIndex;
                el.innerHTML = `
                    <div class="avatar" style="background:linear-gradient(135deg,${d.color},#fff);">${d.emoji}</div>
                    <div class="name">${d.name}</div>
                    <div class="pos-label">المرتبة ${pos + 1}</div>
                `;
                el.addEventListener('click', () => onPick(el, pos));
                rowEl.appendChild(el);
            });
        }

        /**
         * بدء جولة جديدة من اللعبة
         */
        function newRound() {
            gameActive = true;
            feedback.textContent = '';
            feedback.className = '';

            // إزالة classes من الجولة السابقة
            const allKids = rowEl.querySelectorAll('.kid');
            allKids.forEach(kid => {
                kid.classList.remove('correct', 'wrong');
            });

            // حساب عدد الأطفال بناءً على النطاق
            const numKids = maxRange - minRange + 1;

            // إنشاء مصفوفة مؤشرات وخلطها
            let indices = Array.from({length: kidsData.length}, (_, i) => i);
            indices = shuffleArray(indices).slice(0, numKids);
            currentOrder = indices;

            // اختيار موضع عشوائي ضمن النطاق
            targetPos = Math.floor(Math.random() * numKids);

            // تحديد الطفل الصحيح
            correctIndex = currentOrder[targetPos];

            // تحديد التعليمات
            const actualPosition = targetPos + minRange;
            instr.textContent = `من يقف في المرتبة ${getOrdinalWord(actualPosition)}؟`;

            // عرض الصف
            renderRow();
        }

        /**
         * خلط مصفوفة عشوائيًا
         */
        function shuffleArray(array) {
            const newArray = [...array];
            for (let i = newArray.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [newArray[i], newArray[j]] = [newArray[j], newArray[i]];
            }
            return newArray;
        }

        /**
         * الحصول على الكلمة الترتيبية المناسبة
         */
        function getOrdinalWord(position) {
            // position يبدأ من min_range
            const index = position - minRange;
            if (index >= 0 && index < orderWords.length) {
                return orderWords[index];
            }
            return `المرتبة ${position}`;
        }

        /**
         * التعامل مع اختيار الطفل
         */
        function onPick(el, pos) {
            if (!gameActive) return;

            const kidIdx = currentOrder[pos];
            if (kidIdx === correctIndex) {
                // الإجابة الصحيحة
                el.classList.add('correct');
                feedback.textContent = '🎉 أحسنت! إجابة صحيحة';
                feedback.className = 'ok';
                playTone(880, 0.18);

                // تأثير النجاح
                el.animate([
                    {transform: 'scale(1)'},
                    {transform: 'scale(1.08)'},
                    {transform: 'scale(1)'}
                ], {
                    duration: 450,
                    easing: 'ease-out'
                });

                gameActive = false;
            } else {
                // الإجابة الخاطئة
                el.classList.add('wrong');
                feedback.textContent = '😅 ليس صحيحًا — حاول مرة أخرى';
                feedback.className = 'bad';
                playTone(220, 0.18);

                // تأثير الخطأ
                el.animate([
                    {transform: 'translateX(0)'},
                    {transform: 'translateX(-8px)'},
                    {transform: 'translateX(8px)'},
                    {transform: 'translateX(0)'}
                ], {
                    duration: 350
                });
            }
        }

        /**
         * كشف الإجابة الصحيحة
         */
        revealBtn.addEventListener('click', () => {
            if (!gameActive) return;

            const all = rowEl.querySelectorAll('.kid');
            all.forEach(k => k.classList.remove('correct', 'wrong'));

            const correctEl = Array.from(all).find(e => Number(e.dataset.kid) === correctIndex);
            if (correctEl) {
                correctEl.classList.add('correct');
                feedback.textContent = `🔎 هذه هي الإجابة: ${kidsData[correctIndex].name}`;
                feedback.className = 'ok';
                playTone(660, 0.18);
                gameActive = false;
            }
        });

        /**
         * زر الجولة الجديدة
         */
        newBtn.addEventListener('click', newRound);

        // بدء اللعبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', newRound);
    </script>
</body>
</html>
