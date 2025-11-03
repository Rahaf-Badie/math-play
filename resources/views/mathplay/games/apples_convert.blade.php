{{-- resources/views/mathplay/games/apples_convert.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>🍎 العلاقة بين الجمع والطرح - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%);
            margin: 0;
            padding: 20px;
            text-align: center;
            color: #2b2b2b;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            margin: 0 0 15px;
            color: #ef6c00;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #fff3e0;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #ef6c00;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #ffb74d;
        }

        #question {
            font-weight: bold;
            font-size: 28px;
            margin: 20px 0;
            padding: 20px;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 15px;
            color: #1976d2;
            border: 3px solid #64b5f6;
        }

        #scene {
            display: flex;
            gap: 30px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            margin: 25px 0;
        }

        .visual-section {
            background: #f1f8e9;
            border-radius: 15px;
            padding: 20px;
            border: 2px solid #c5e1a5;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 15px;
            color: #558b2f;
            font-size: 18px;
        }

        .apples {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 400px;
            min-height: 80px;
        }

        .apple {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
        }

        .apple.group-a {
            background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
            border: 2px solid #ff8a80;
        }

        .apple.group-b {
            background: linear-gradient(135deg, #fb8c00 0%, #ef6c00 100%);
            border: 2px solid #ffb74d;
        }

        .apple:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .apple-number {
            position: absolute;
            top: -8px;
            left: -8px;
            background: #ffd54f;
            color: #333;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .explanation {
            font-size: 16px;
            color: #666;
            margin: 15px 0;
            padding: 12px;
            background: #f5f5f5;
            border-radius: 10px;
            border-right: 3px solid #ffb74d;
        }

        .choices {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        button.choice {
            padding: 15px 20px;
            border-radius: 12px;
            border: 0;
            background: linear-gradient(135deg, #1976d2 0%, #0d47a1 100%);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(25, 118, 210, 0.3);
            font-size: 16px;
            font-family: inherit;
            min-width: 140px;
        }

        button.choice:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 20px rgba(25, 118, 210, 0.4);
        }

        button.choice.wrong {
            background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
            transform: scale(0.95);
            animation: shake 0.5s ease-in-out;
        }

        button.choice.correct {
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
        }

        #feedback {
            min-height: 50px;
            font-weight: bold;
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .feedback-success {
            color: #2e7d32;
            background: #e8f5e9;
            border: 2px solid #4caf50;
            animation: celebrate 0.6s ease-in-out;
        }

        .feedback-error {
            color: #d32f2f;
            background: #ffebee;
            border: 2px solid #f44336;
        }

        .feedback-info {
            color: #1976d2;
            background: #e3f2fd;
            border: 2px solid #2196f3;
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        button.control-btn {
            padding: 12px 20px;
            border-radius: 10px;
            border: 0;
            background: linear-gradient(135deg, #ef6c00 0%, #e65100 100%);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(239, 108, 0, 0.3);
            font-family: inherit;
            font-size: 14px;
        }

        button.control-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 108, 0, 0.4);
        }

        button.control-btn.secondary {
            background: linear-gradient(135deg, #78909c 0%, #546e7a 100%);
        }

        .score {
            font-size: 18px;
            margin: 15px 0;
            color: #2c3e50;
            font-weight: bold;
            background: #fff3e0;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .concept-explanation {
            margin: 20px 0;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 10px;
            border-right: 4px solid #2196f3;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .bouncing {
            animation: bounce 2s ease-in-out infinite;
        }

        .groups-explanation {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin: 15px 0;
            flex-wrap: wrap;
        }

        .group-info {
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        .group-a-info {
            background: #ffebee;
            color: #c62828;
            border: 2px solid #ef9a9a;
        }

        .group-b-info {
            background: #fff3e0;
            color: #ef6c00;
            border: 2px solid #ffcc80;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🍎 العلاقة بين الجمع والطرح</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="card">
            <div class="concept-explanation">
                <strong>💡 مفهوم العلاقة:</strong> كل جملة جمع يمكن تحويلها إلى جملتي طرح مكافئتين
            </div>

            <div id="question">تحميل...</div>

            <div id="scene">
                <div class="visual-section">
                    <div class="section-title">🍎 التفاحات المرئية</div>
                    <div class="apples" id="apples"></div>

                    <div class="groups-explanation">
                        <div class="group-info group-a-info">🔴 المجموعة الأولى</div>
                        <div class="group-info group-b-info">🟠 المجموعة الثانية</div>
                    </div>
                </div>
            </div>

            <div class="explanation">
                اختر جملة الطرح التي تعادل جملة الجمع المعروضة
            </div>

            <div class="choices" id="choices"></div>

            <div id="feedback"></div>

            <div class="controls">
                <button class="control-btn" id="newBtn">🔄 سؤال جديد</button>
                <button class="control-btn secondary" id="showBtn">🔎 أظهر الإجابة</button>
                <button class="control-btn secondary" id="explainBtn">📚 شرح المفهوم</button>
            </div>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};
        const operationType = "{{ $settings->operation_type ?? 'conversion' }}";

        const questionEl = document.getElementById('question');
        const applesEl = document.getElementById('apples');
        const choicesEl = document.getElementById('choices');
        const feedback = document.getElementById('feedback');
        const newBtn = document.getElementById('newBtn');
        const showBtn = document.getElementById('showBtn');
        const explainBtn = document.getElementById('explainBtn');
        const scoreElement = document.getElementById('score');

        let a = 0, b = 0, sum = 0;
        let points = 0;
        let attempts = 0;
        let gameActive = true;

        function getRandom(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        function render() {
            if (!gameActive) return;

            applesEl.innerHTML = '';
            choicesEl.innerHTML = '';
            feedback.textContent = '';
            feedback.className = '';

            // توليد أعداد ضمن المدى المحدد
            a = getRandom(1, maxRange - 2);
            b = getRandom(1, maxRange - a);
            sum = a + b;

            questionEl.textContent = ` ${a} + ${b} = ${sum} `;

            // عرض التفاحات المرئية مع ترميز لوني
            for (let i = 0; i < a; i++) {
                const apple = document.createElement('div');
                apple.className = 'apple group-a bouncing';
                apple.textContent = '🍎';

                const number = document.createElement('div');
                number.className = 'apple-number';
                number.textContent = i + 1;
                apple.appendChild(number);

                applesEl.appendChild(apple);
            }

            for (let i = 0; i < b; i++) {
                const apple = document.createElement('div');
                apple.className = 'apple group-b bouncing';
                apple.textContent = '🍎';

                const number = document.createElement('div');
                number.className = 'apple-number';
                number.textContent = a + i + 1;
                apple.appendChild(number);

                applesEl.appendChild(apple);
            }

            // إنشاء الخيارات (الإجابات الصحيحة والخاطئة)
            const correct1 = `${sum} - ${a} = ${b}`;
            const correct2 = `${sum} - ${b} = ${a}`;

            const options = new Set();
            options.add(correct1);
            options.add(correct2);

            // توليد خيارات خاطئة
            while (options.size < 5) {
                let x = getRandom(1, maxRange);
                let y = getRandom(1, x);
                if (x - y >= 1 && x - y <= maxRange) {
                    options.add(`${x} - ${y} = ${x - y}`);
                }
            }

            // خلط الخيارات
            const shuffledOptions = Array.from(options).sort(() => Math.random() - 0.5);

            shuffledOptions.forEach(text => {
                const btn = document.createElement('button');
                btn.className = 'choice';
                btn.textContent = text;
                btn.addEventListener('click', () => checkAnswer(btn, text, correct1, correct2));
                choicesEl.appendChild(btn);
            });
        }

        function checkAnswer(btn, selectedText, correct1, correct2) {
            if (!gameActive) return;

            attempts++;

            // التحقق إذا كانت الإجابة صحيحة (أي من الصيغتين المقبولتين)
            if (selectedText === correct1 || selectedText === correct2) {
                // الإجابة الصحيحة
                points++;
                btn.classList.add('correct');
                feedback.textContent = getSuccessMessage();
                feedback.className = 'feedback-success';
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                gameActive = false;
                setTimeout(() => {
                    gameActive = true;
                    render();
                }, 2000);
            } else {
                // الإجابة الخاطئة
                btn.classList.add('wrong');
                feedback.textContent = '❌ ليست مكافئة — جرب اختيار آخر';
                feedback.className = 'feedback-error';
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;
            }
        }

        function showAnswer() {
            if (!gameActive) return;

            feedback.textContent = `🔎 الإجابات الصحيحة: ${sum} - ${a} = ${b}  أو  ${sum} - ${b} = ${a}`;
            feedback.className = 'feedback-info';
        }

        function explainConcept() {
            if (!gameActive) return;

            feedback.innerHTML = `
                <strong>📚 شرح العلاقة بين الجمع والطرح:</strong><br>
                • إذا كان: ${a} + ${b} = ${sum}<br>
                • فإن: ${sum} - ${a} = ${b}<br>
                • وكذلك: ${sum} - ${b} = ${a}<br>
                <em>هذه هي العلاقة العكسية بين الجمع والطرح</em>
            `;
            feedback.className = 'feedback-info';
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! لقد فهمت العلاقة بين الجمع والطرح",
                "👏 رائع! هذه جملة طرح مكافئة",
                "💫 إبداع! العلاقة العكسية صحيحة",
                "🌟 برافو! أنت تتقن تحويل الجمع إلى طرح"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        newBtn.addEventListener('click', render);
        showBtn.addEventListener('click', showAnswer);
        explainBtn.addEventListener('click', explainConcept);

        // بدء اللعبة
        render();
    </script>
</body>
</html>
