{{-- resources/views/mathplay/games/number_race.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سباق الأرقام - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: #fff7e6;
            text-align: center;
            padding: 20px;
            margin: 0;
        }

        h1 {
            color: #ff6b00;
            margin-bottom: 10px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
        }

        #target {
            font-size: 24px;
            margin: 20px 0;
            font-weight: bold;
            color: #333;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            gap: 15px;
            justify-content: center;
            margin: 20px auto;
        }

        .cell {
            width: 100px;
            height: 100px;
            background: #fff;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }

        .cell:hover {
            background: #ffe0b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .correct {
            background: #b4f8c8 !important;
            border-color: #2ecc71;
            transform: scale(1.05);
        }

        .wrong {
            background: #ffb4b4 !important;
            border-color: #e74c3c;
        }

        button {
            margin-top: 20px;
            padding: 12px 24px;
            background: #ff6b00;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #e55a00;
        }

        #score {
            font-size: 20px;
            margin: 15px 0;
            color: #2c3e50;
            font-weight: bold;
        }

        .win-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            z-index: 1000;
            text-align: center;
            display: none;
        }

        .win-message h2 {
            color: #27ae60;
            margin-bottom: 15px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            z-index: 999;
        }
    </style>
</head>
<body>
    <h1>🎯 سباق الأرقام!</h1>

    @if($lesson_game->lesson)
        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }}
        </div>
    @endif

    <div id="target"></div>
    <div class="grid" id="grid"></div>
    <div id="score">النقاط: 0</div>
    <button id="newBtn">لعبة جديدة</button>

    <!-- رسالة الفوز -->
    <div class="overlay" id="overlay"></div>
    <div class="win-message" id="winMessage">
        <h2>🎉 أحسنت! 🎉</h2>
        <p id="finalScore"></p>
        <button onclick="hideWinMessage()">استمر في اللعب</button>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};
        const totalNumbers = maxRange - minRange + 1;

        const grid = document.getElementById('grid');
        const target = document.getElementById('target');
        const scoreElement = document.getElementById('score');
        const newBtn = document.getElementById('newBtn');
        const winMessage = document.getElementById('winMessage');
        const overlay = document.getElementById('overlay');

        let currentTarget = 0;
        let points = 0;
        let round = 0;
        let numbers = [];

        // توليد مصفوفة الأرقام بناءً على المدى
        function generateNumbers() {
            numbers = [];
            for (let i = minRange; i <= maxRange; i++) {
                numbers.push(i);
            }
            return numbers;
        }

        // دالة لخلط المصفوفة عشوائياً
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // بدء جولة جديدة
        function newRound() {
            grid.innerHTML = '';

            // توليد الأرقام وخلطها
            const availableNumbers = generateNumbers();
            const shuffledNumbers = shuffleArray([...availableNumbers]);

            // اختيار رقم عشوائي كهدف
            currentTarget = shuffledNumbers[Math.floor(Math.random() * shuffledNumbers.length)];
            target.textContent = `ابحث عن الرقم ${currentTarget} 👇`;
            round++;

            // إنشاء المربعات
            shuffledNumbers.forEach(number => {
                const cell = document.createElement('div');
                cell.className = 'cell';
                cell.textContent = number;

                cell.addEventListener('click', () => {
                    if (cell.classList.contains('correct') || cell.classList.contains('wrong')) {
                        return; // منع النقر المتكرر على نفس الخلية
                    }

                    if (number === currentTarget) {
                        cell.classList.add('correct');
                        points++;
                        scoreElement.textContent = `النقاط: ${points}`;

                        // عرض رسالة الفوز بعد تحقيق 5 نقاط
                        if (points >= 5) {
                            showWinMessage();
                        } else {
                            setTimeout(newRound, 600);
                        }
                    } else {
                        cell.classList.add('wrong');
                        // إضافة تأثير الاهتزاز للخطأ
                        cell.style.animation = 'shake 0.5s';
                        setTimeout(() => {
                            cell.style.animation = '';
                        }, 500);
                    }
                });

                grid.appendChild(cell);
            });
        }

        // عرض رسالة الفوز
        function showWinMessage() {
            const finalScore = document.getElementById('finalScore');
            finalScore.textContent = `لقد حصلت على ${points} نقاط!`;
            winMessage.style.display = 'block';
            overlay.style.display = 'block';
        }

        // إخفاء رسالة الفوز
        function hideWinMessage() {
            winMessage.style.display = 'none';
            overlay.style.display = 'none';
            points = 0;
            round = 0;
            scoreElement.textContent = 'النقاط: 0';
            newRound();
        }

        // بدء لعبة جديدة
        newBtn.addEventListener('click', () => {
            points = 0;
            round = 0;
            scoreElement.textContent = 'النقاط: 0';
            newRound();
        });

        // إضافة تأثير الاهتزاز CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        `;
        document.head.appendChild(style);

        // بدء اللعبة لأول مرة
        newRound();
    </script>
</body>
</html>
