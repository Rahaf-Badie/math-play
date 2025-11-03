{{-- resources/views/mathplay/games/sort_icons.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ترتيب المجموعات حسب العدد - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #f9fff0 0%, #e8f5e9 100%);
            text-align: center;
            padding: 20px;
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

        #instruction {
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 10px;
            color: #1976d2;
            border-right: 4px solid #1976d2;
        }

        .grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin: 30px 0;
            min-height: 150px;
        }

        .group {
            width: 140px;
            min-height: 120px;
            background: #fff;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 8px;
            cursor: grab;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 15px;
            font-size: 28px;
            border: 3px solid transparent;
            position: relative;
        }

        .group:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-color: #ff7f50;
        }

        .group:active {
            cursor: grabbing;
        }

        .group.dragging {
            opacity: 0.6;
            transform: scale(1.05);
            border-color: #ff7f50;
        }

        .group.over {
            border: 3px dashed #4caf50;
            background: #f1f8e9;
        }

        .count-badge {
            position: absolute;
            top: -10px;
            left: -10px;
            background: #ff7f50;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        button {
            padding: 12px 24px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ff7f50 0%, #ff5722 100%);
            color: white;
            border: none;
            cursor: pointer;
            margin: 10px;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 127, 80, 0.3);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 127, 80, 0.4);
        }

        #msg {
            margin-top: 20px;
            font-weight: bold;
            font-size: 22px;
            min-height: 40px;
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

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 0.5s ease-in-out;
        }

        .drag-hint {
            margin-top: 10px;
            color: #666;
            font-size: 16px;
            background: #f5f5f5;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🍎 رتب المجموعات حسب العدد</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">المحاولات الناجحة: 0</div>

        <p id="instruction"></p>

        <div class="drag-hint">💡 اسحب وأسقط المربعات لترتيبها</div>

        <div class="grid" id="grid"></div>

        <div id="msg"></div>

        <button id="newBtn">🔄 مجموعة جديدة</button>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 9 }};

        const grid = document.getElementById('grid');
        const msg = document.getElementById('msg');
        const instruction = document.getElementById('instruction');
        const newBtn = document.getElementById('newBtn');
        const scoreElement = document.getElementById('score');

        const symbols = ["⭐", "🍎", "🐶", "⚽", "🚗", "🐱", "🌺", "🍕", "🎈"];
        let groups = [];
        let order = 'asc';
        let draggedElement = null;
        let successfulAttempts = 0;

        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        function shuffleArray(array) {
            return array.sort(() => Math.random() - 0.5);
        }

        function newGame() {
            msg.textContent = '';
            msg.className = '';
            grid.innerHTML = '';
            groups = [];

            // تحديد نوع الترتيب عشوائياً
            order = Math.random() > 0.5 ? 'asc' : 'desc';
            instruction.textContent = order === 'asc'
                ? "✨ رتب المجموعات من الأقل إلى الأكثر"
                : "🌟 رتب المجموعات من الأكثر إلى الأقل";

            // توليد 4 مجموعات بأعداد مختلفة
            const usedNumbers = new Set();
            while (groups.length < 4) {
                const count = generateRandomNumber();
                if (!usedNumbers.has(count)) {
                    usedNumbers.add(count);
                    const symbol = symbols[Math.floor(Math.random() * symbols.length)];
                    groups.push({ count, symbol });
                }
            }

            // خلط المجموعات عشوائياً
            groups = shuffleArray([...groups]);
            render();
        }

        function render() {
            grid.innerHTML = '';

            groups.forEach((group, index) => {
                const div = document.createElement('div');
                div.className = 'group';
                div.draggable = true;
                div.dataset.index = index;

                // إضافة شارة العدد
                const countBadge = document.createElement('div');
                countBadge.className = 'count-badge';
                countBadge.textContent = group.count;
                div.appendChild(countBadge);

                // إضافة الرموز
                for (let j = 0; j < group.count; j++) {
                    const span = document.createElement('span');
                    span.textContent = group.symbol;
                    span.style.animation = 'pulse 0.5s ease-in-out';
                    div.appendChild(span);
                }

                // أحداث السحب والإفلات
                div.addEventListener('dragstart', handleDragStart);
                div.addEventListener('dragend', handleDragEnd);
                div.addEventListener('dragover', handleDragOver);
                div.addEventListener('dragenter', handleDragEnter);
                div.addEventListener('dragleave', handleDragLeave);
                div.addEventListener('drop', handleDrop);

                grid.appendChild(div);
            });

            checkOrder();
        }

        function handleDragStart(e) {
            draggedElement = this;
            this.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', this.dataset.index);
        }

        function handleDragEnd() {
            this.classList.remove('dragging');
            document.querySelectorAll('.group').forEach(group => {
                group.classList.remove('over');
            });
        }

        function handleDragOver(e) {
            e.preventDefault();
            return false;
        }

        function handleDragEnter(e) {
            e.preventDefault();
            this.classList.add('over');
        }

        function handleDragLeave() {
            this.classList.remove('over');
        }

        function handleDrop(e) {
            e.preventDefault();
            this.classList.remove('over');

            const fromIndex = parseInt(draggedElement.dataset.index);
            const toIndex = parseInt(this.dataset.index);

            if (fromIndex !== toIndex) {
                // تبديل المواقع
                [groups[fromIndex], groups[toIndex]] = [groups[toIndex], groups[fromIndex]];
                render();
                checkOrder();
            }
        }

        function checkOrder() {
            const correctOrder = [...groups].sort((a, b) =>
                order === 'asc' ? a.count - b.count : b.count - a.count
            );

            const isCorrect = groups.every((group, index) =>
                group.count === correctOrder[index].count
            );

            if (isCorrect) {
                successfulAttempts++;
                scoreElement.textContent = `المحاولات الناجحة: ${successfulAttempts}`;
                msg.textContent = getSuccessMessage();
                msg.className = 'msg-success';

                // الانتقال التلقائي بعد ثانيتين
                setTimeout(() => {
                    newGame();
                }, 2000);
            } else {
                msg.textContent = 'استمر في الترتيب...';
                msg.className = '';
            }
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 ممتاز! الترتيب صحيح تماماً",
                "👏 رائع! لقد أتقنت الترتيب",
                "💫 إبداع! ترتيبك صحيح مئة بالمئة",
                "🌟 برافو! أنت خبير في الترتيب"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        newBtn.addEventListener('click', newGame);

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
