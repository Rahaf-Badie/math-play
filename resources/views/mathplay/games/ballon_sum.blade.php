{{-- resources/views/mathplay/games/ballon_sum.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎈 البالونات المجزأة - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            margin: 0;
            padding: 20px;
            text-align: center;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #1976d2;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #e3f2fd;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #1976d2;
        }

        .game-area {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #64b5f6;
        }

        #instruction {
            font-weight: bold;
            font-size: 22px;
            margin-bottom: 25px;
            color: #0d47a1;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 15px;
            border-right: 4px solid #1976d2;
        }

        .target-number {
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: linear-gradient(135deg, #ffeb3b 0%, #fbc02d 100%);
            border-radius: 15px;
            color: #f57f17;
            border: 3px solid #ffd54f;
            display: inline-block;
        }

        #balloons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            min-height: 120px;
        }

        .balloon {
            width: 70px;
            height: 85px;
            border-radius: 35px;
            background: linear-gradient(135deg, #64b5f6 0%, #1976d2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 22px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(100, 181, 246, 0.3);
            border: 3px solid transparent;
            position: relative;
            user-select: none;
        }

        .balloon:hover {
            transform: translateY(-8px) scale(1.1);
            box-shadow: 0 12px 25px rgba(100, 181, 246, 0.4);
            border-color: #fff;
        }

        .balloon:active {
            transform: translateY(-4px) scale(1.05);
        }

        .balloon.selected {
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            transform: scale(1.15);
            border-color: #fff;
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.4);
        }

        .balloon.over-limit {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            animation: shake 0.5s ease-in-out;
        }

        .balloon::after {
            content: "";
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 20px;
            background: #666;
        }

        .progress-container {
            margin: 20px 0;
        }

        .progress-bar {
            width: 100%;
            height: 20px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px 0;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            border-radius: 10px;
            transition: width 0.3s ease;
            width: 0%;
        }

        .sum-display {
            font-size: 24px;
            font-weight: bold;
            margin: 15px 0;
            padding: 12px 20px;
            background: #f5f5f5;
            border-radius: 10px;
            color: #333;
            border: 2px solid #ddd;
            display: inline-block;
            min-width: 200px;
        }

        #msg {
            font-size: 22px;
            font-weight: bold;
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            min-height: 30px;
        }

        .msg-correct {
            color: #2e7d32;
            background: #e8f5e9;
            border: 2px solid #4caf50;
            animation: celebrate 0.6s ease-in-out;
        }

        .msg-wrong {
            color: #d32f2f;
            background: #ffebee;
            border: 2px solid #f44336;
        }

        .msg-warning {
            color: #f57c00;
            background: #fff3e0;
            border: 2px solid #ffb74d;
        }

        button {
            margin-top: 20px;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #1976d2 0%, #0d47a1 100%);
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(25, 118, 210, 0.3);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 118, 210, 0.4);
        }

        .score {
            font-size: 18px;
            margin: 15px 0;
            color: #2c3e50;
            font-weight: bold;
            background: #e3f2fd;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .selected-balloons {
            margin: 15px 0;
            min-height: 40px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .selected-item {
            background: #4caf50;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: bold;
            animation: popIn 0.3s ease-out;
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

        @keyframes popIn {
            0% { transform: scale(0); opacity: 0; }
            70% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎈 البالونات المجزأة</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="game-area">
            <p id="instruction">اختر البالونات لتكوين العدد المطلوب</p>

            <div class="target-number" id="targetDisplay">العدد المطلوب: <span id="targetNumber">0</span></div>

            <div class="progress-container">
                <div class="sum-display" id="sumDisplay">المجموع: 0</div>
                <div class="progress-bar">
                    <div class="progress" id="progressBar"></div>
                </div>
            </div>

            <div class="selected-balloons" id="selectedBalloons"></div>

            <div id="balloons"></div>

            <div id="msg"></div>

            <button id="resetBtn">🔄 إعادة التعيين</button>
            <button id="newGameBtn">🎮 جولة جديدة</button>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};

        const balloonsEl = document.getElementById('balloons');
        const msg = document.getElementById('msg');
        const targetDisplay = document.getElementById('targetDisplay');
        const targetNumber = document.getElementById('targetNumber');
        const sumDisplay = document.getElementById('sumDisplay');
        const progressBar = document.getElementById('progressBar');
        const selectedBalloonsEl = document.getElementById('selectedBalloons');
        const resetBtn = document.getElementById('resetBtn');
        const newGameBtn = document.getElementById('newGameBtn');
        const scoreElement = document.getElementById('score');

        let target = 0;
        let selectedSum = 0;
        let selectedNumbers = [];
        let points = 0;
        let attempts = 0;
        let gameActive = true;

        function newGame() {
            if (!gameActive) return;

            balloonsEl.innerHTML = '';
            selectedBalloonsEl.innerHTML = '';
            msg.textContent = '';
            msg.className = '';
            selectedSum = 0;
            selectedNumbers = [];

            // توليد عدد مستهدف بين 5 و9
            target = Math.floor(Math.random() * 5) + 5;
            targetNumber.textContent = target;
            updateSumDisplay();
            updateProgressBar();

            // توليد أرقام البالونات
            let nums = [];
            for (let i = 0; i < 12; i++) {
                nums.push(Math.floor(Math.random() * 4) + 1); // أرقام من 1 إلى 4
            }

            // خلط البالونات
            nums = shuffleArray(nums);

            // إنشاء البالونات
            nums.forEach((num, index) => {
                const balloon = document.createElement('div');
                balloon.className = 'balloon floating';
                balloon.textContent = num;
                balloon.dataset.value = num;
                balloon.dataset.index = index;

                balloon.addEventListener('click', () => {
                    if (gameActive) {
                        selectBalloon(num, balloon);
                    }
                });

                balloonsEl.appendChild(balloon);
            });
        }

        function shuffleArray(array) {
            const shuffled = [...array];
            for (let i = shuffled.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
            }
            return shuffled;
        }

        function selectBalloon(num, balloon) {
            if (balloon.classList.contains('selected')) {
                // إلغاء الاختيار إذا كان البالون مختاراً بالفعل
                selectedSum -= num;
                selectedNumbers = selectedNumbers.filter(n => n !== num || balloon.dataset.index !== balloon.dataset.index);
                balloon.classList.remove('selected');
            } else {
                // اختيار البالون
                selectedSum += num;
                selectedNumbers.push({value: num, element: balloon});
                balloon.classList.add('selected');
            }

            updateSumDisplay();
            updateProgressBar();
            updateSelectedBalloons();
            checkAnswer();
        }

        function updateSumDisplay() {
            sumDisplay.textContent = `المجموع: ${selectedSum}`;

            if (selectedSum > target) {
                sumDisplay.style.background = '#ffebee';
                sumDisplay.style.color = '#d32f2f';
                sumDisplay.style.borderColor = '#f44336';
            } else if (selectedSum === target) {
                sumDisplay.style.background = '#e8f5e9';
                sumDisplay.style.color = '#2e7d32';
                sumDisplay.style.borderColor = '#4caf50';
            } else {
                sumDisplay.style.background = '#f5f5f5';
                sumDisplay.style.color = '#333';
                sumDisplay.style.borderColor = '#ddd';
            }
        }

        function updateProgressBar() {
            const percentage = Math.min((selectedSum / target) * 100, 100);
            progressBar.style.width = `${percentage}%`;

            if (selectedSum > target) {
                progressBar.style.background = 'linear-gradient(135deg, #f44336 0%, #d32f2f 100%)';
            } else if (selectedSum === target) {
                progressBar.style.background = 'linear-gradient(135deg, #4caf50 0%, #2e7d32 100%)';
            } else {
                progressBar.style.background = 'linear-gradient(135deg, #2196f3 0%, #1976d2 100%)';
            }
        }

        function updateSelectedBalloons() {
            selectedBalloonsEl.innerHTML = '';
            selectedNumbers.forEach(item => {
                const span = document.createElement('span');
                span.className = 'selected-item';
                span.textContent = item.value;
                selectedBalloonsEl.appendChild(span);
            });
        }

        function checkAnswer() {
            if (selectedSum === target) {
                // الإجابة الصحيحة
                attempts++;
                points++;
                msg.textContent = getSuccessMessage();
                msg.className = 'msg-correct';
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                gameActive = false;
                setTimeout(() => {
                    gameActive = true;
                    newGame();
                }, 2000);
            } else if (selectedSum > target) {
                // تجاوز العدد المطلوب
                msg.textContent = `⚠️ تجاوزت العدد المطلوب! حاول مرة أخرى`;
                msg.className = 'msg-warning';

                // إضافة تأثير للبالونات التي تجاوزت الحد
                selectedNumbers.forEach(item => {
                    item.element.classList.add('over-limit');
                });
            } else {
                msg.textContent = '';
                msg.className = '';
            }
        }

        function resetSelection() {
            if (!gameActive) return;

            selectedNumbers.forEach(item => {
                item.element.classList.remove('selected', 'over-limit');
            });

            selectedSum = 0;
            selectedNumbers = [];
            updateSumDisplay();
            updateProgressBar();
            updateSelectedBalloons();
            msg.textContent = '';
            msg.className = '';
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! لقد وجدت التركيب الصحيح",
                "👏 رائع! أنت ماهر في الجمع",
                "💫 إبداع! معرفتك بمكونات الأعداد ممتازة",
                "🌟 برافو! مجموع البالونات = " + target
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        resetBtn.addEventListener('click', resetSelection);
        newGameBtn.addEventListener('click', newGame);

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
