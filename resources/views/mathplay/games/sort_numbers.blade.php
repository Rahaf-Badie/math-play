{{-- resources/views/mathplay/games/sort_numbers.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔽 ترتيب الأرقام تنازلي - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #f0fff0 0%, #d4edda 100%);
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
            color: #00994d;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #e8f5e9;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #00994d;
        }

        .game-area {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #4caf50;
        }

        .instruction {
            font-size: 22px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 15px;
            color: #1976d2;
            border-right: 4px solid #2196f3;
        }

        .order-indicator {
            font-size: 24px;
            margin: 15px 0;
            color: #d32f2f;
            font-weight: bold;
            background: #ffebee;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            border: 2px solid #f44336;
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
            cursor: grab;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 3px solid transparent;
            position: relative;
            user-select: none;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-color: #00994d;
        }

        .card:active {
            cursor: grabbing;
        }

        .card.dragging {
            opacity: 0.6;
            transform: scale(1.1) rotate(5deg);
            border-color: #ff9800;
        }

        .card.over {
            border: 3px dashed #ff9800;
            background: #fff3e0;
        }

        .card.correct {
            background: linear-gradient(135deg, #b4f8c8 0%, #4caf50 100%);
            border-color: #2e7d32;
            color: white;
            transform: scale(1.05);
        }

        .card.wrong {
            background: linear-gradient(135deg, #ffb4b4 0%, #f44336 100%);
            border-color: #d32f2f;
            color: white;
            animation: shake 0.5s ease-in-out;
        }

        .card-number {
            position: absolute;
            top: -8px;
            left: -8px;
            background: #ff9800;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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
            background: linear-gradient(135deg, #00994d 0%, #007a3d 100%);
            color: white;
            border: 0;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 153, 77, 0.3);
            font-family: inherit;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 153, 77, 0.4);
        }

        #shuffleBtn {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
        }

        #checkBtn {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
        }

        #newGameBtn {
            background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%);
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
            background: #e8f5e9;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .drag-hint {
            margin: 10px 0;
            color: #666;
            font-size: 16px;
            background: #f5f5f5;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
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
            .card {
                width: 70px;
                height: 70px;
                font-size: 28px;
            }

            .grid {
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
        <h1>🔽 ترتيب الأرقام تنازلي</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات الناجحة: 0</div>

        <div class="game-area">
            <div class="instruction">
                اسحب وأسقط الأرقام لترتيبها من الأكبر إلى الأصغر
            </div>

            <div class="order-indicator">
                🔽 من الأكبر إلى الأصغر
            </div>

            <div class="drag-hint">💡 اسحب الأرقام لتغيير مواقعها</div>

            <div class="grid" id="grid"></div>

            <div class="controls">
                <button id="checkBtn">✅ تحقق من الترتيب</button>
                <button id="shuffleBtn">🔄 إعادة ترتيب عشوائي</button>
                <button id="newGameBtn">🎮 جولة جديدة</button>
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
        const shuffleBtn = document.getElementById('shuffleBtn');
        const newGameBtn = document.getElementById('newGameBtn');
        const scoreElement = document.getElementById('score');

        let numbers = [];
        let draggedCard = null;
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
            msg.textContent = '';
            msg.className = '';
            gameActive = true;

            // توليد أرقام فريدة ضمن المدى
            numbers = generateUniqueNumbers(numbersCount, minRange, maxRange);

            // خلط الأرقام
            const shuffledNumbers = shuffleArray(numbers);

            // عرض الأرقام المخلوطة
            renderNumbers(shuffledNumbers);
        }

        function renderNumbers(numbersArray) {
            grid.innerHTML = '';
            numbersArray.forEach((num, index) => {
                const card = document.createElement('div');
                card.className = 'card bouncing';
                card.textContent = num;
                card.draggable = true;
                card.dataset.value = num;
                card.dataset.index = index;

                // إضافة رقم تسلسلي
                const numberLabel = document.createElement('div');
                numberLabel.className = 'card-number';
                numberLabel.textContent = index + 1;
                card.appendChild(numberLabel);

                // أحداث السحب والإفلات
                card.addEventListener('dragstart', handleDragStart);
                card.addEventListener('dragend', handleDragEnd);
                card.addEventListener('dragover', handleDragOver);
                card.addEventListener('dragenter', handleDragEnter);
                card.addEventListener('dragleave', handleDragLeave);
                card.addEventListener('drop', handleDrop);

                grid.appendChild(card);
            });
        }

        function handleDragStart(e) {
            if (!gameActive) return;

            draggedCard = this;
            this.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', this.dataset.value);
        }

        function handleDragEnd() {
            this.classList.remove('dragging');
            document.querySelectorAll('.card').forEach(card => {
                card.classList.remove('over');
            });
        }

        function handleDragOver(e) {
            e.preventDefault();
            return false;
        }

        function handleDragEnter(e) {
            e.preventDefault();
            if (this !== draggedCard) {
                this.classList.add('over');
            }
        }

        function handleDragLeave() {
            this.classList.remove('over');
        }

        function handleDrop(e) {
            e.preventDefault();
            this.classList.remove('over');

            if (this !== draggedCard) {
                const fromIndex = parseInt(draggedCard.dataset.index);
                const toIndex = parseInt(this.dataset.index);

                // تبديل مواقع الأرقام في المصفوفة
                [numbers[fromIndex], numbers[toIndex]] = [numbers[toIndex], numbers[fromIndex]];

                // إعادة عرض الأرقام
                renderNumbers(numbers);

                // التحقق التلقائي من الترتيب
                autoCheckOrder();
            }
        }

        function autoCheckOrder() {
            const correctOrder = [...numbers].sort((a, b) => b - a); // ترتيب تنازلي
            const isCorrect = numbers.every((num, index) => num === correctOrder[index]);

            if (isCorrect) {
                // الإجابة الصحيحة
                points += 10;
                successCount++;
                scoreElement.textContent = `النقاط: ${points} | المحاولات الناجحة: ${successCount}`;
                msg.textContent = getSuccessMessage();
                msg.className = 'msg-success';

                // تمييز جميع الأرقام باللون الأخضر
                document.querySelectorAll('.card').forEach(card => {
                    card.classList.add('correct');
                });

                gameActive = false;
            }
        }

        function checkOrder() {
            if (!gameActive) return;

            const correctOrder = [...numbers].sort((a, b) => b - a); // ترتيب تنازلي
            const isCorrect = numbers.every((num, index) => num === correctOrder[index]);

            if (isCorrect) {
                // الإجابة الصحيحة
                points += 10;
                successCount++;
                scoreElement.textContent = `النقاط: ${points} | المحاولات الناجحة: ${successCount}`;
                msg.textContent = getSuccessMessage();
                msg.className = 'msg-success';

                // تمييز جميع الأرقام باللون الأخضر
                document.querySelectorAll('.card').forEach(card => {
                    card.classList.add('correct');
                });

                gameActive = false;
            } else {
                // الإجابة الخاطئة
                msg.textContent = getErrorMessage(correctOrder);
                msg.className = 'msg-error';

                // تمييز الأرقام الخاطئة
                document.querySelectorAll('.card').forEach(card => {
                    const num = parseInt(card.dataset.value);
                    const currentIndex = numbers.indexOf(num);
                    const correctIndex = correctOrder.indexOf(num);

                    if (currentIndex !== correctIndex) {
                        card.classList.add('wrong');
                    }
                });

                // إزالة التمييز بعد ثانية
                setTimeout(() => {
                    document.querySelectorAll('.card').forEach(card => {
                        card.classList.remove('wrong');
                    });
                    msg.textContent = 'استمر في الترتيب!';
                    msg.className = 'msg-info';
                }, 1000);
            }
        }

        function shuffleNumbers() {
            if (!gameActive) return;

            numbers = shuffleArray(numbers);
            renderNumbers(numbers);
            msg.textContent = 'تم إعادة ترتيب الأرقام عشوائياً';
            msg.className = 'msg-info';
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! الأرقام مرتبة تنازلياً بشكل صحيح",
                "👏 رائع! لقد أتقنت الترتيب التنازلي",
                "💫 إبداع! ترتيبك من الأكبر إلى الأصغر مثالي",
                "🌟 برافو! جميع الأرقام في مكانها الصحيح"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage(correctOrder) {
            const messages = [
                `❌ ليس صحيحاً بعد! الترتيب الصحيح هو: ${correctOrder.join(' → ')}`,
                `💡 حاول مرة أخرى! رتب من الأكبر إلى الأصغر`,
                `🔍 انظر جيداً! الأرقام الحمراء ليست في مكانها الصحيح`,
                `🔄 استمر في سحب الأرقام لوضعها في الترتيب الصحيح`
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        checkBtn.addEventListener('click', checkOrder);
        shuffleBtn.addEventListener('click', shuffleNumbers);
        newGameBtn.addEventListener('click', newGame);

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
