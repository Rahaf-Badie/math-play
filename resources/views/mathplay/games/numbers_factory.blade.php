<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏭 مصنع الأعداد - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #1b262c;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #ef6c00;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .lesson-info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            padding: 12px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 1.3rem;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .instructions {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 30px;
            font-size: 1.2rem;
            line-height: 1.6;
            color: #2d3436;
            text-align: center;
            font-weight: bold;
            border: 3px solid #ffb300;
        }

        .game-area {
            display: flex;
            flex-direction: column;
            gap: 30px;
            margin: 30px 0;
        }

        .conveyor-section {
            background: linear-gradient(180deg, #f1f1f1, #e7eef7);
            padding: 25px;
            border-radius: 20px;
            border: 4px dashed #74b9ff;
        }

        .conveyor-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #2d3436;
            margin-bottom: 20px;
        }

        .conveyor {
            width: 100%;
            height: 140px;
            background: linear-gradient(180deg, #e3f2fd, #bbdefb);
            border-radius: 15px;
            display: flex;
            gap: 15px;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
            overflow-x: auto;
            border: 3px solid #90caf9;
            box-shadow: inset 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .number {
            min-width: 100px;
            height: 80px;
            border-radius: 15px;
            background: linear-gradient(135deg, #fff, #ffe6b3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.8rem;
            color: #5d4037;
            cursor: grab;
            border: 3px solid rgba(255, 179, 0, 0.3);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .number:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
            border-color: #ffb300;
        }

        .drop-section {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .dropbox {
            width: 300px;
            height: 200px;
            border-radius: 20px;
            border: 4px dashed rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-direction: column;
            background: linear-gradient(135deg, #fdfdfd, #fff);
            position: relative;
            padding: 20px;
            transition: all 0.3s ease;
            flex-wrap: wrap;
            overflow-y: auto;
        }

        .dropbox.ok {
            border-color: #00b894;
            box-shadow: 0 12px 25px rgba(46, 125, 50, 0.15);
            background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
        }

        .dropbox.err {
            border-color: #ff7675;
            box-shadow: 0 12px 25px rgba(211, 47, 47, 0.15);
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
        }

        .dropbox .title {
            font-weight: 800;
            color: #37474f;
            margin-bottom: 10px;
            font-size: 1.4rem;
        }

        .dropbox .hint {
            font-size: 1.1rem;
            color: #607d8b;
            margin-bottom: 15px;
        }

        .chip {
            padding: 10px 15px;
            border-radius: 12px;
            font-weight: 800;
            margin: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid transparent;
        }

        .chip.correct {
            background: linear-gradient(135deg, #c8e6c9, #a5d6a7);
            border-color: #00b894;
            color: #2e7d32;
        }

        .chip.incorrect {
            background: linear-gradient(135deg, #ffcdd2, #ef9a9a);
            border-color: #ff7675;
            color: #d32f2f;
        }

        .chip:hover {
            transform: scale(1.1);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
        }

        button {
            padding: 15px 30px;
            font-size: 1.3rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        #newBtn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        #checkBtn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #resetBtn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
        }

        .feedback {
            margin: 25px 0;
            font-size: 1.5rem;
            font-weight: bold;
            min-height: 70px;
            padding: 20px;
            border-radius: 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .feedback.success {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            animation: pulse 1s infinite;
        }

        .feedback.error {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        .score {
            font-size: 1.5rem;
            margin-top: 20px;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 15px 30px;
            border-radius: 50px;
            display: inline-block;
            color: #2d3436;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-weight: bold;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .gear {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffd54f, #ffb300);
            display: inline-block;
            margin: 0 8px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
            animation: rotate 3s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .drop-section {
                flex-direction: column;
                align-items: center;
            }

            .dropbox {
                width: 100%;
                height: 180px;
            }

            .conveyor {
                height: 120px;
            }

            .number {
                min-width: 80px;
                height: 70px;
                font-size: 1.5rem;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏭 مصنع الأعداد - مضاعفات العدد 10</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'غير محدد' }}
        </div>

        <div class="instructions">
            <p>اسحب الأعداد التي تمثل مضاعفات العدد 10 من خط الإنتاج إلى الصندوق</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 10 }} إلى {{ $settings->max_range ?? 90 }}</p>
            <p>مضاعفات 10 هي: 10, 20, 30, 40, 50, 60, 70, 80, 90 <span class="gear"></span></p>
        </div>

        <div class="game-area">
            <div class="conveyor-section">
                <div class="conveyor-title">🚂 خط الإنتاج - اسحب مضاعفات 10</div>
                <div class="conveyor" id="conveyor"></div>
            </div>

            <div class="drop-section">
                <div class="dropbox" id="drop">
                    <div class="title">📦 مضاعفات العدد 10</div>
                    <div class="hint">اسحب الأعداد الصحيحة إلى هنا</div>
                </div>
            </div>
        </div>

        <div class="controls">
            <button id="newBtn">🔄 توليد أعداد جديدة</button>
            <button id="checkBtn">✔ تحقق من الإجابات</button>
            <button id="resetBtn">🗑️ مسح الصندوق</button>
        </div>

        <div class="feedback" id="feedback">اسحب مضاعفات العدد 10 إلى الصندوق</div>

        <div class="score">النقاط: <span id="score">0</span></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // قراءة الإعدادات من Blade
            const minRange = {{ $settings->min_range ?? 10 }};
            const maxRange = {{ $settings->max_range ?? 90 }};

            const conveyor = document.getElementById('conveyor');
            const drop = document.getElementById('drop');
            const feedback = document.getElementById('feedback');
            const newBtn = document.getElementById('newBtn');
            const checkBtn = document.getElementById('checkBtn');
            const resetBtn = document.getElementById('resetBtn');
            const scoreElement = document.getElementById('score');

            let score = 0;
            let correctMultiples = [];

            // توليد مضاعفات العدد 10 ضمن المدى المحدد
            function generateMultiples() {
                const multiples = [];
                for (let i = minRange; i <= maxRange; i += 10) {
                    multiples.push(i);
                }
                return multiples;
            }

            // توليد أعداد عشوائية (بعضها مضاعفات والبعض الآخر ليس مضاعفات)
            function generateNumbers() {
                conveyor.innerHTML = '';
                feedback.textContent = 'اسحب مضاعفات العدد 10 إلى الصندوق';
                feedback.className = 'feedback info';
                drop.innerHTML = '<div class="title">📦 مضاعفات العدد 10</div><div class="hint">اسحب الأعداد الصحيحة إلى هنا</div>';
                drop.classList.remove('ok', 'err');

                const multiples = generateMultiples();
                correctMultiples = multiples;

                const pool = [];

                // إضافة 4-6 مضاعفات عشوائية
                const randomMultiples = [...multiples].sort(() => Math.random() - 0.5);
                const chosenMultiples = randomMultiples.slice(0, Math.floor(Math.random() * 3) + 4);
                pool.push(...chosenMultiples);

                // إضافة أعداد غير مضاعفة
                const nonMultiples = [];
                while (nonMultiples.length < 6) {
                    const num = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    if (num % 10 !== 0 && !pool.includes(num)) {
                        nonMultiples.push(num);
                    }
                }
                pool.push(...nonMultiples);

                // خلط الأعداد
                pool.sort(() => Math.random() - 0.5);

                // إنشاء عناصر الأعداد
                pool.forEach(num => {
                    const element = document.createElement('div');
                    element.className = 'number';
                    element.draggable = true;
                    element.textContent = num;
                    element.dataset.value = num;
                    element.dataset.isMultiple = (num % 10 === 0) ? 'true' : 'false';

                    element.addEventListener('dragstart', function(e) {
                        e.dataTransfer.setData('text/plain', num);
                        e.dataTransfer.setData('isMultiple', (num % 10 === 0) ? 'true' : 'false');
                        setTimeout(() => element.style.opacity = '0.6', 0);
                    });

                    element.addEventListener('dragend', function() {
                        element.style.opacity = '1';
                    });

                    conveyor.appendChild(element);
                });
            }

            // جعل منطقة الإفلات قابلة لاستقبال العناصر
            drop.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#ffb300';
            });

            drop.addEventListener('dragleave', function() {
                this.style.borderColor = 'rgba(0, 0, 0, 0.15)';
            });

            drop.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = 'rgba(0, 0, 0, 0.15)';

                const value = Number(e.dataTransfer.getData('text/plain'));
                const isMultiple = e.dataTransfer.getData('isMultiple') === 'true';

                // إنشاء شريحة للعدد المضاف
                const chip = document.createElement('div');
                chip.className = 'chip';
                chip.textContent = value;
                chip.dataset.value = value;
                chip.dataset.isMultiple = isMultiple;

                if (isMultiple) {
                    chip.classList.add('correct');
                } else {
                    chip.classList.add('incorrect');
                }

                // إمكانية إزالة الشريحة بالنقر عليها
                chip.addEventListener('click', function() {
                    this.remove();
                    updateFeedback();
                });

                // منع إضافة العدد المكرر
                const existingChips = Array.from(drop.querySelectorAll('.chip'));
                const alreadyExists = existingChips.some(chip => Number(chip.dataset.value) === value);

                if (!alreadyExists) {
                    // إزالة النص الإرشادي إذا كانت هذه أول شريحة
                    const hint = drop.querySelector('.hint');
                    if (hint && existingChips.length === 0) {
                        hint.remove();
                    }

                    drop.appendChild(chip);
                    updateFeedback();
                }
            });

            // تحديث رسالة التغذية الراجعة
            function updateFeedback() {
                const chips = Array.from(drop.querySelectorAll('.chip'));
                if (chips.length === 0) {
                    feedback.textContent = 'اسحب مضاعفات العدد 10 إلى الصندوق';
                    feedback.className = 'feedback info';
                }
            }

            // التحقق من الإجابات
            checkBtn.addEventListener('click', function() {
                const chips = Array.from(drop.querySelectorAll('.chip'));

                if (chips.length === 0) {
                    feedback.textContent = '😅 ضع بعض الأعداد في الصندوق أولاً';
                    feedback.className = 'feedback error';
                    return;
                }

                let correctCount = 0;
                let totalCount = chips.length;

                chips.forEach(chip => {
                    const value = Number(chip.dataset.value);
                    const isMultiple = chip.dataset.isMultiple === 'true';

                    if (isMultiple) {
                        correctCount++;
                        chip.classList.remove('incorrect');
                        chip.classList.add('correct');
                    } else {
                        chip.classList.remove('correct');
                        chip.classList.add('incorrect');
                    }
                });

                if (correctCount === totalCount && totalCount > 0) {
                    feedback.textContent = `🎉 ممتاز! كل الأعداد صحيحة (مضاعفات 10) — ${correctCount}/${totalCount}`;
                    feedback.className = 'feedback success';
                    drop.classList.add('ok');
                    drop.classList.remove('err');

                    // زيادة النقاط
                    score += correctCount * 5;
                    scoreElement.textContent = score;
                } else {
                    feedback.textContent = `😅 بعض الأعداد ليست مضاعفات 10 — صحيحة: ${correctCount} من ${totalCount}`;
                    feedback.className = 'feedback error';
                    drop.classList.add('err');
                    drop.classList.remove('ok');
                }
            });

            // زر توليد أعداد جديدة
            newBtn.addEventListener('click', generateNumbers);

            // زر مسح الصندوق
            resetBtn.addEventListener('click', function() {
                drop.innerHTML = '<div class="title">📦 مضاعفات العدد 10</div><div class="hint">اسحب الأعداد الصحيحة إلى هنا</div>';
                drop.classList.remove('ok', 'err');
                feedback.textContent = 'اسحب مضاعفات العدد 10 إلى الصندوق';
                feedback.className = 'feedback info';
            });

            // بدء اللعبة
            generateNumbers();
        });
    </script>
</body>
</html>
