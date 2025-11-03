{{-- resources/views/mathplay/games/compare_numbers.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مقارنة الأعداد - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #e0f7ff 0%, #bbdefb 100%);
            text-align: center;
            padding: 20px;
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #0077b6;
            margin-bottom: 15px;
            font-size: 28px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 25px;
            font-size: 18px;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
        }

        .numbers {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            margin: 30px 0;
        }

        .num-box {
            width: 100px;
            height: 100px;
            background: #fff;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: bold;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 4px solid transparent;
        }

        .num-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border-color: #0077b6;
        }

        .correct {
            background: #b4f8c8 !important;
            border-color: #2ecc71 !important;
            transform: scale(1.1);
        }

        .wrong {
            background: #ffb4b4 !important;
            border-color: #e74c3c !important;
            animation: shake 0.5s;
        }

        .vs {
            font-size: 24px;
            font-weight: bold;
            color: #0077b6;
            background: #e3f2fd;
            padding: 10px 15px;
            border-radius: 50%;
        }

        #msg {
            margin-top: 20px;
            font-weight: bold;
            font-size: 20px;
            min-height: 30px;
            padding: 10px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .msg-correct {
            color: #198754;
            background: #d4edda;
        }

        .msg-wrong {
            color: #dc3545;
            background: #f8d7da;
        }

        button {
            margin-top: 20px;
            padding: 12px 24px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0077b6 0%, #0056b3 100%);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 119, 182, 0.3);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 119, 182, 0.4);
        }

        .score {
            font-size: 18px;
            margin: 15px 0;
            color: #2c3e50;
            font-weight: bold;
            background: #e3f2fd;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .bounce {
            animation: bounce 0.5s;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔢 أي الرقم أكبر؟</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="numbers">
            <div class="num-box" id="num1"></div>
            <div class="vs">VS</div>
            <div class="num-box" id="num2"></div>
        </div>

        <div id="msg"></div>
        <button id="nextBtn">➡️ رقم جديد</button>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};

        const num1 = document.getElementById('num1');
        const num2 = document.getElementById('num2');
        const msg = document.getElementById('msg');
        const nextBtn = document.getElementById('nextBtn');
        const scoreElement = document.getElementById('score');

        let correctNumber = null;
        let points = 0;
        let attempts = 0;
        let gameActive = true;

        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        function newNumbers() {
            if (!gameActive) return;

            // إعادة تعيين الأنماط
            num1.style.background = '#fff';
            num2.style.background = '#fff';
            num1.style.borderColor = 'transparent';
            num2.style.borderColor = 'transparent';
            num1.classList.remove('correct', 'wrong', 'bounce');
            num2.classList.remove('correct', 'wrong', 'bounce');
            msg.textContent = '';
            msg.className = '';

            // توليد أرقام مختلفة
            let a = generateRandomNumber();
            let b = generateRandomNumber();

            // التأكد من أن الرقمين مختلفين
            while (b === a) {
                b = generateRandomNumber();
            }

            num1.textContent = a;
            num2.textContent = b;
            correctNumber = a > b ? 'num1' : 'num2';

            // إضافة تأثير ظهور
            num1.classList.add('bounce');
            num2.classList.add('bounce');
        }

        function handleChoice(selectedElement, selectedId) {
            if (!gameActive) return;

            attempts++;

            if (selectedId === correctNumber) {
                // الإجابة الصحيحة
                selectedElement.classList.add('correct');
                points++;
                msg.textContent = '🎉 أحسنت! هذا الرقم أكبر 🎉';
                msg.className = 'msg-correct';

                // تحديث النقاط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // الانتقال التلقائي للسؤال التالي بعد ثانية
                gameActive = false;
                setTimeout(() => {
                    gameActive = true;
                    newNumbers();
                }, 1500);
            } else {
                // الإجابة الخاطئة
                selectedElement.classList.add('wrong');
                msg.textContent = '❌ ليس صحيح، حاول مرة أخرى';
                msg.className = 'msg-wrong';

                // إظهار الإجابة الصحيحة
                const correctElement = document.getElementById(correctNumber);
                correctElement.classList.add('correct');

                // تحديث المحاولات فقط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // إعادة تفعيل اللعبة بعد ثانيتين
                gameActive = false;
                setTimeout(() => {
                    gameActive = true;
                    newNumbers();
                }, 2000);
            }
        }

        // إضافة مستمعي الأحداث
        num1.addEventListener('click', () => handleChoice(num1, 'num1'));
        num2.addEventListener('click', () => handleChoice(num2, 'num2'));

        nextBtn.addEventListener('click', () => {
            if (gameActive) {
                newNumbers();
            }
        });

        // بدء اللعبة
        newNumbers();
    </script>
</body>
</html>
