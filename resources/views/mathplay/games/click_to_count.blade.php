{{-- resources/views/mathplay/games/click_to_count.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>عدّ بالنقر - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", Arial, sans-serif;
            background: linear-gradient(135deg, #f7fff6 0%, #e8f5e8 100%);
            padding: 20px;
            text-align: center;
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 10px;
            color: #7c3aed;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #f0f9ff;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #7c3aed;
        }

        .instructions {
            font-size: 18px;
            margin-bottom: 25px;
            color: #555;
            line-height: 1.6;
        }

        .play-area {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            margin: 30px 0;
        }

        .objects-container {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: 3px solid #e9d8fd;
        }

        .objects {
            display: grid;
            grid-template-columns: repeat(5, 70px);
            gap: 12px;
            padding: 15px;
            background: #fafafa;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .obj {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            background: linear-gradient(135deg, #ffe4e1 0%, #ffd1d1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            cursor: pointer;
            user-select: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 3px solid transparent;
            position: relative;
        }

        .obj:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            border-color: #7c3aed;
        }

        .obj.counted {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            transform: scale(0.95);
            border-color: #10b981;
        }

        .obj.counted::after {
            content: "✓";
            position: absolute;
            top: -5px;
            right: -5px;
            background: #10b981;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
        }

        .counter-panel {
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            color: white;
            padding: 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 20px;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
        }

        .choices-container {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: 3px solid #e9d8fd;
            min-width: 300px;
        }

        .choices-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #7c3aed;
        }

        .choices {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .choice {
            padding: 20px 15px;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 3px solid transparent;
            user-select: none;
        }

        .choice:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            border-color: #7c3aed;
        }

        .choice.correct {
            background: linear-gradient(135deg, #d1fae5 0%, #10b981 100%);
            color: white;
            border-color: #059669;
            transform: scale(1.05);
        }

        .choice.wrong {
            background: linear-gradient(135deg, #fee2e2 0%, #ef4444 100%);
            color: white;
            border-color: #dc2626;
        }

        .choice.chosen {
            pointer-events: none;
        }

        button {
            margin-top: 20px;
            padding: 15px 25px;
            border-radius: 12px;
            border: 0;
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
            font-family: inherit;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
        }

        .feedback {
            margin-top: 20px;
            padding: 15px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 18px;
            min-height: 30px;
            transition: all 0.3s ease;
        }

        .feedback-success {
            background: linear-gradient(135deg, #d1fae5 0%, #10b981 100%);
            color: white;
            animation: celebrate 0.6s ease-in-out;
        }

        .feedback-error {
            background: linear-gradient(135deg, #fee2e2 0%, #ef4444 100%);
            color: white;
        }

        .score {
            font-size: 18px;
            margin: 15px 0;
            color: #2c3e50;
            font-weight: bold;
            background: #f0f9ff;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .bouncing {
            animation: bounce 2s ease-in-out infinite;
        }

        .objects-count {
            font-size: 16px;
            color: #666;
            margin-top: 10px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .play-area {
                flex-direction: column;
                align-items: center;
            }

            .objects {
                grid-template-columns: repeat(4, 60px);
            }

            .obj {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }

            .choices {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .emoji-variety {
            font-size: 28px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔢 عدّ بالنقر</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات الناجحة: 0</div>

        <div class="instructions">
            <p>اضغط على العناصر لتحسبها، ثم اختر الرقم الصحيح من الخيارات</p>
        </div>

        <div class="play-area">
            <div class="objects-container">
                <div class="objects" id="objects"></div>
                <div class="counter-panel" id="counter">عدد النقرات: 0</div>
                <div class="objects-count" id="objectsCount"></div>
            </div>

            <div class="choices-container">
                <div class="choices-title">اختر الرقم الصحيح:</div>
                <div class="choices" id="choices"></div>
            </div>
        </div>

        <div class="feedback" id="feedback"></div>

        <button id="newBtn">🔄 لعبة جديدة</button>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 11 }};
        const maxRange = {{ $settings->max_range ?? 19 }};

        const objectsEl = document.getElementById('objects');
        const choicesEl = document.getElementById('choices');
        const counterEl = document.getElementById('counter');
        const feedbackEl = document.getElementById('feedback');
        const objectsCountEl = document.getElementById('objectsCount');
        const newBtn = document.getElementById('newBtn');
        const scoreElement = document.getElementById('score');

        let clicks = 0;
        let target = 0;
        let points = 0;
        let successCount = 0;
        let gameActive = true;

        // مجموعة متنوعة من الإيموجيز
        const emojis = ["🐶", "🐱", "🐰", "🐻", "🐼", "🐯", "🦊", "🐮", "🐷", "🐸", "🐙", "🦄", "🐝", "🐢", "🐬", "🦁", "🐨", "🐔", "🐧"];

        function newRound() {
            if (!gameActive) return;

            objectsEl.innerHTML = '';
            choicesEl.innerHTML = '';
            feedbackEl.textContent = '';
            feedbackEl.className = 'feedback';
            clicks = 0;
            counterEl.textContent = 'عدد النقرات: 0';

            // توليد عدد عشوائي ضمن المدى 11-19
            target = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            objectsCountEl.textContent = `هناك ${target} عنصراً أمامك`;

            // إنشاء عناصر بصرياً
            for (let i = 0; i < target; i++) {
                const obj = document.createElement('div');
                obj.className = 'obj bouncing';
                obj.innerHTML = `<span class="emoji-variety">${emojis[i % emojis.length]}</span>`;

                obj.addEventListener('click', () => {
                    if (!gameActive) return;
                    if (obj.classList.contains('counted')) return;

                    obj.classList.add('counted');
                    clicks++;
                    counterEl.textContent = `عدد النقرات: ${clicks}`;

                    // تحديث التغذية الراجعة
                    if (clicks === target) {
                        feedbackEl.textContent = 'ممتاز! الآن اختر الرقم الصحيح من الخيارات';
                        feedbackEl.className = 'feedback feedback-success';
                    } else if (clicks < target) {
                        feedbackEl.textContent = `استمر! نقرت على ${clicks} من ${target} عناصر`;
                        feedbackEl.className = 'feedback';
                    } else {
                        feedbackEl.textContent = 'لقد نقرت على جميع العناصر! اختر الرقم الصحيح';
                        feedbackEl.className = 'feedback';
                    }
                });

                objectsEl.appendChild(obj);
            }

            // إنشاء اختيارات (واحدة صحيحة + أخرى عشوائية)
            const options = new Set();
            options.add(target);

            // توليد خيارات خاطئة ضمن المدى
            while (options.size < 4) {
                const wrongOption = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                if (wrongOption !== target) {
                    options.add(wrongOption);
                }
            }

            const optionsArray = Array.from(options);
            // خلط الخيارات
            const shuffledOptions = optionsArray.sort(() => Math.random() - 0.5);

            shuffledOptions.forEach(option => {
                const choice = document.createElement('div');
                choice.className = 'choice';
                choice.textContent = option;

                choice.addEventListener('click', () => {
                    if (!gameActive) return;

                    // منع إعادة الاختيار
                    document.querySelectorAll('.choice').forEach(c => c.classList.add('chosen'));

                    if (option === target) {
                        // الإجابة الصحيحة
                        choice.classList.add('correct');
                        points += 10;
                        successCount++;
                        scoreElement.textContent = `النقاط: ${points} | المحاولات الناجحة: ${successCount}`;
                        feedbackEl.textContent = `🎉 أحسنت! العدد الصحيح هو ${target}`;
                        feedbackEl.className = 'feedback feedback-success';

                        gameActive = false;
                        setTimeout(() => {
                            gameActive = true;
                            newRound();
                        }, 2000);
                    } else {
                        // الإجابة الخاطئة
                        choice.classList.add('wrong');
                        feedbackEl.textContent = `❌ ليس صحيحاً! حاول مرة أخرى`;
                        feedbackEl.className = 'feedback feedback-error';

                        // إظهار الإجابة الصحيحة بعد ثانيتين
                        setTimeout(() => {
                            document.querySelectorAll('.choice').forEach(c => {
                                if (parseInt(c.textContent) === target) {
                                    c.classList.add('correct');
                                }
                            });
                            feedbackEl.textContent = `الإجابة الصحيحة هي: ${target}`;
                            feedbackEl.className = 'feedback feedback-success';

                            setTimeout(() => {
                                gameActive = true;
                                newRound();
                            }, 2000);
                        }, 1500);
                    }
                });

                choicesEl.appendChild(choice);
            });
        }

        newBtn.addEventListener('click', newRound);

        // بدء اللعبة
        newRound();
    </script>
</body>
</html>
