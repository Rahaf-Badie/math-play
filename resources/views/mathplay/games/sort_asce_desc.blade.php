{{-- resources/views/mathplay/games/sort_asec_desc.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>🔼 ترتيب الأرقام تصاعدي - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #fff7e6 0%, #ffe8cc 100%);
            text-align: center;
            padding: 20px;
            margin: 0;
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
            color: #ff7f50;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #fff3e0;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #ff7f50;
        }

        .game-area {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #ffb074;
        }

        #instruction {
            font-size: 22px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 15px;
            color: #1976d2;
            border-right: 4px solid #2196f3;
        }

        .grid {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
            min-height: 100px;
        }

        .card {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #fff 0%, #f5f5f5 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 3px solid transparent;
            position: relative;
            user-select: none;
        }

        .card:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-color: #ff7f50;
        }

        .card.selected {
            background: linear-gradient(135deg, #ffd580 0%, #ffb347 100%);
            border-color: #ff7f50;
            transform: scale(1.1);
        }

        .card.correct {
            background: linear-gradient(135deg, #b4f8c8 0%, #4caf50 100%) !important;
            border-color: #2e7d32 !important;
            color: white;
        }

        .card.wrong {
            background: linear-gradient(135deg, #ffb4b4 0%, #f44336 100%) !important;
            border-color: #d32f2f !important;
            color: white;
            animation: shake 0.5s ease-in-out;
        }

        .selection-area {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            min-height: 100px;
            flex-wrap: wrap;
        }

        .selection-card {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 3px dashed #2196f3;
            position: relative;
            transition: all 0.3s ease;
        }

        .selection-card.filled {
            background: linear-gradient(135deg, #a5d6a7 0%, #4caf50 100%);
            border: 3px solid #2e7d32;
            color: white;
        }

        .selection-number {
            position: absolute;
            top: -10px;
            left: -10px;
            background: #ff7f50;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 24px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ff7f50 0%, #ff5722 100%);
            color: white;
            border: 0;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 127, 80, 0.3);
            font-family: inherit;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 127, 80, 0.4);
        }

        button:disabled {
            background: linear-gradient(135deg, #cccccc 0%, #999999 100%);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        #checkBtn {
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
        }

        #resetBtn {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
        }

        #msg {
            margin-top: 20px;
            font-weight: bold;
            font-size: 20px;
            min-height: 50px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .msg-success {
            color: #2e7d32;
            background: #e8f5e9;
            border: 2px solid #4caf50;
            animation: celebrate 0.6s ease-in-out;
        }

        .msg-error {
            color: #d32f2f;
            background: #ffebee;
            border: 2px solid #f44336;
        }

        .msg-info {
            color: #1976d2;
            background: #e3f2fd;
            border: 2px solid #2196f3;
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

        .order-indicator {
            font-size: 24px;
            margin: 10px 0;
            color: #ff7f50;
            font-weight: bold;
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

        @media (max-width: 600px) {
            .card, .selection-card {
                width: 70px;
                height: 70px;
                font-size: 28px;
            }

            .grid, .selection-area {
                gap: 10px;
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
        <h1>🔼 ترتيب الأرقام تصاعدي</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات الناجحة: 0</div>

        <div class="game-area">
            <div id="instruction"></div>

            <div class="order-indicator" id="orderIndicator">🔼 من الأصغر إلى الأكبر</div>

            <div class="grid" id="grid"></div>

            <div class="selection-area" id="selectionArea">
                <!-- سيتم إنشاء أماكن الاختيار ديناميكياً -->
            </div>

            <div class="controls">
                <button id="checkBtn">✅ تحقق من الترتيب</button>
                <button id="resetBtn">🔄 إعادة التعيين</button>
                <button id="newBtn">🎮 جولة جديدة</button>
            </div>

            <div id="msg"></div>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 20 }};
        const numbersCount = 5; // عدد الأرقام في كل جولة

        const grid = document.getElementById('grid');
        const msg = document.getElementById('msg');
        const checkBtn = document.getElementById('checkBtn');
        const resetBtn = document.getElementById('resetBtn');
        const newBtn = document.getElementById('newBtn');
        const instruction = document.getElementById('instruction');
        const selectionArea = document.getElementById('selectionArea');
        const scoreElement = document.getElementById('score');
        const orderIndicator = document.getElementById('orderIndicator');

        let numbers = [];
        let selectedNumbers = [];
        let points = 0;
        let successCount = 0;
        let gameActive = true;

        function generateUniqueNumbers(count, min, max) {
            const uniqueNumbers = new Set();
            while (uniqueNumbers.size < count) {
                const num = Math.floor(Math.random() * (max - min + 1)) + min;
                uniqueNumbers.add(num);
            }
            return Array.from(uniqueNumbers);
        }

        function shuffleArray(array) {
            const shuffled = [...array];
            for (let i = shuffled.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
            }
            return shuffled;
        }

        function newGame() {
            if (!gameActive) return;

            grid.innerHTML = '';
            selectionArea.innerHTML = '';
            msg.textContent = '';
            msg.className = '';
            selectedNumbers = [];
            gameActive = true;

            // توليد أرقام فريدة ضمن المدى
            numbers = generateUniqueNumbers(numbersCount, minRange, maxRange);

            // خلط الأرقام
            const shuffledNumbers = shuffleArray(numbers);

            // تحديث التعليمات
            instruction.textContent = '✨ رتّب الأرقام من الأصغر إلى الأكبر';
            orderIndicator.textContent = '🔼 من الأصغر إلى الأكبر';

            // إنشاء أماكن الاختيار
            createSelectionSlots();

            // عرض الأرقام المخلوطة
            renderNumbers(shuffledNumbers);

            // تفعيل/تعطيل الأزرار
            updateButtons();
        }

        function createSelectionSlots() {
            selectionArea.innerHTML = '';
            for (let i = 0; i < numbersCount; i++) {
                const slot = document.createElement('div');
                slot.className = 'selection-card';
                slot.dataset.index = i;

                const numberLabel = document.createElement('div');
                numberLabel.className = 'selection-number';
                numberLabel.textContent = i + 1;
                slot.appendChild(numberLabel);

                selectionArea.appendChild(slot);
            }
        }

        function renderNumbers(numbersArray) {
            grid.innerHTML = '';
            numbersArray.forEach((num, index) => {
                const card = document.createElement('div');
                card.className = 'card bouncing';
                card.textContent = num;
                card.dataset.value = num;
                card.dataset.index = index;

                card.addEventListener('click', () => {
                    if (!gameActive) return;
                    selectNumber(num, card);
                });

                grid.appendChild(card);
            });
        }

        function selectNumber(number, card) {
            if (selectedNumbers.includes(number)) {
                // الرقم مختار مسبقاً - إلغاء الاختيار
                const index = selectedNumbers.indexOf(number);
                selectedNumbers.splice(index, 1);
                card.classList.remove('selected');

                // إزالة الرقم من مكان الاختيار
                const slots = selectionArea.querySelectorAll('.selection-card');
                slots.forEach(slot => {
                    if (slot.textContent.includes(number)) {
                        slot.innerHTML = '<div class="selection-number">' + (parseInt(slot.dataset.index) + 1) + '</div>';
                        slot.classList.remove('filled');
                    }
                });
            } else if (selectedNumbers.length < numbersCount) {
                // اختيار رقم جديد
                selectedNumbers.push(number);
                card.classList.add('selected');

                // وضع الرقم في أول مكان فارغ
                const slots = selectionArea.querySelectorAll('.selection-card');
                for (let slot of slots) {
                    if (!slot.classList.contains('filled')) {
                        slot.textContent = number;
                        slot.classList.add('filled');
                        break;
                    }
                }
            }

            updateButtons();
        }

        function updateButtons() {
            checkBtn.disabled = selectedNumbers.length !== numbersCount;
            resetBtn.disabled = selectedNumbers.length === 0;
        }

        function checkOrder() {
            if (!gameActive) return;

            const correctOrder = [...numbers].sort((a, b) => a - b);
            const isCorrect = selectedNumbers.every((num, index) => num === correctOrder[index]);

            if (isCorrect) {
                // الإجابة الصحيحة
                points += 10;
                successCount++;
                scoreElement.textContent = `النقاط: ${points} | المحاولات الناجحة: ${successCount}`;
                msg.textContent = getSuccessMessage();
                msg.className = 'msg-success';

                // تمييز الأرقام باللون الأخضر
                document.querySelectorAll('.card').forEach(card => {
                    card.classList.add('correct');
                });

                gameActive = false;
                setTimeout(() => {
                    newGame();
                }, 2000);
            } else {
                // الإجابة الخاطئة
                msg.textContent = getErrorMessage(correctOrder);
                msg.className = 'msg-error';

                // تمييز الأرقام الخاطئة
                document.querySelectorAll('.card').forEach(card => {
                    const num = parseInt(card.dataset.value);
                    const selectedIndex = selectedNumbers.indexOf(num);
                    const correctIndex = correctOrder.indexOf(num);

                    if (selectedIndex !== correctIndex) {
                        card.classList.add('wrong');
                    }
                });

                // إعادة تعيين بعد ثانيتين
                setTimeout(() => {
                    resetSelection();
                }, 2000);
            }
        }

        function resetSelection() {
            selectedNumbers = [];
            document.querySelectorAll('.card').forEach(card => {
                card.classList.remove('selected', 'correct', 'wrong');
            });
            createSelectionSlots();
            updateButtons();
            msg.textContent = 'يمكنك إعادة ترتيب الأرقام مرة أخرى';
            msg.className = 'msg-info';
            gameActive = true;
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! الترتيب صحيح تماماً",
                "👏 رائع! لقد رتبت الأرقام بشكل مثالي",
                "💫 إبداع! معرفتك بالترتيب التصاعدي ممتازة",
                "🌟 برافو! ترتيبك صحيح مئة بالمئة"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage(correctOrder) {
            const messages = [
                `❌ ليس صحيحاً! الترتيب الصحيح هو: ${correctOrder.join(' ← ')}`,
                `💡 حاول مرة أخرى! رتب من الأصغر إلى الأكبر`,
                `🔍 انظر جيداً! الأرقام الحمراء ليست في مكانها الصحيح`,
                `🔄 ركز أكثر في الترتيب التصاعدي`
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        checkBtn.addEventListener('click', checkOrder);
        resetBtn.addEventListener('click', resetSelection);
        newBtn.addEventListener('click', newGame);

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
