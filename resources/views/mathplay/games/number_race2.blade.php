<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏁 سباق الأرقام - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
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
            color: #1565c0;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .game-info {
            background: #e3f2fd;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 0 auto 20px auto;
            max-width: 600px;
            font-size: 1rem;
            color: #1565c0;
            border: 2px solid #64b5f6;
        }

        .game-box {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #64b5f6;
        }

        #instruction {
            font-size: 22px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            background: #e8f5e9;
            border-radius: 10px;
            color: #2e7d32;
            border-right: 4px solid #4caf50;
        }

        .number-box {
            display: flex;
            gap: 15px;
            justify-content: center;
            align-items: center;
            margin: 30px 0;
            min-height: 100px;
            flex-wrap: wrap;
        }

        .number {
            width: 70px;
            height: 70px;
            line-height: 70px;
            background: linear-gradient(135deg, #64b5f6 0%, #1976d2 100%);
            border-radius: 15px;
            color: white;
            font-size: 24px;
            font-weight: bold;
            cursor: grab;
            user-select: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(100, 181, 246, 0.3);
            border: 3px solid transparent;
            position: relative;
        }

        .number:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(100, 181, 246, 0.4);
            border-color: #fff;
        }

        .number:active {
            cursor: grabbing;
        }

        .number.dragging {
            opacity: 0.6;
            transform: scale(1.1) rotate(5deg);
            border-color: #ff9800;
        }

        .number.over {
            border: 3px dashed #4caf50;
            background: linear-gradient(135deg, #81c784 0%, #4caf50 100%);
        }

        .drop-zone {
            width: 70px;
            height: 70px;
            border: 3px dashed #ccc;
            border-radius: 15px;
            background: #f5f5f5;
            transition: all 0.3s ease;
        }

        .drop-zone.active {
            border-color: #ff9800;
            background: #fff3e0;
        }

        button {
            margin-top: 20px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(21, 101, 192, 0.3);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(21, 101, 192, 0.4);
        }

        #msg {
            margin-top: 20px;
            font-size: 22px;
            font-weight: 600;
            min-height: 40px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .correct {
            color: #2e7d32;
            background: #e8f5e9;
            border: 2px solid #4caf50;
            animation: celebrate 0.6s ease-in-out;
        }

        .wrong {
            color: #d32f2f;
            background: #ffebee;
            border: 2px solid #f44336;
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

        .drag-hint {
            margin-top: 10px;
            color: #666;
            font-size: 16px;
            background: #f5f5f5;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
        }

        .controls {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
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

        @media (max-width: 768px) {
            .number {
                width: 60px;
                height: 60px;
                line-height: 60px;
                font-size: 20px;
            }

            .number-box {
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏁 سباق الأرقام</h1>

        <div class="game-info">
            <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
            <strong>النطاق:</strong> من {{ $min_range }} إلى {{ $max_range }}
        </div>

        <div class="score" id="score">المحاولات الناجحة: 0</div>

        <div class="game-box">
            <p id="instruction">رتّب الأرقام بالترتيب <span id="order"></span></p>

            <div class="drag-hint">💡 اسحب وأسقط الأرقام لترتيبها</div>

            <div class="number-box" id="numbers"></div>

            <div class="controls">
                <button id="newRoundBtn">🔄 جولة جديدة</button>
                <button id="hintBtn">💡 تلميح</button>
            </div>

            <p id="msg"></p>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 20 }};
        const lessonName = "{{ $lesson_game->lesson->name ?? '' }}";

        const numbersContainer = document.getElementById("numbers");
        const msg = document.getElementById("msg");
        const orderEl = document.getElementById("order");
        const instruction = document.getElementById("instruction");
        const newRoundBtn = document.getElementById("newRoundBtn");
        const hintBtn = document.getElementById("hintBtn");
        const scoreElement = document.getElementById("score");

        let ascending = true;
        let draggedElement = null;
        let successfulAttempts = 0;
        let currentNumbers = [];

        // تحديد نوع الترتيب بناءً على اسم الدرس
        function determineOrderType() {
            if (lessonName.includes('تنازلي')) {
                return false; // تنازلي
            } else if (lessonName.includes('تصاعدي')) {
                return true; // تصاعدي
            } else {
                // إذا لم يتضح من اسم الدرس، نختار عشوائياً
                return Math.random() < 0.5;
            }
        }

        // حساب عدد الأرقام المناسب بناءً على النطاق
        function calculateNumbersCount() {
            const range = maxRange - minRange + 1;
            if (range <= 6) {
                return range; // استخدام جميع الأرقام إذا كان النطاق صغير
            } else if (range <= 10) {
                return 6; // 6 أرقام للنطاقات المتوسطة
            } else {
                return 5; // 5 أرقام للنطاقات الكبيرة
            }
        }

        function generateAppropriateNumbers(count, min, max, isAscending) {
            const numbers = new Set();

            if (isAscending) {
                // للترتيب التصاعدي: نبدأ من البداية
                let start = min;
                while (numbers.size < count && start <= max) {
                    numbers.add(start);
                    start++;
                }
            } else {
                // للترتيب التنازلي: نبدأ من النهاية
                let start = max;
                while (numbers.size < count && start >= min) {
                    numbers.add(start);
                    start--;
                }
            }

            // إذا لم نحصل على أرقام كافية، نضيف أرقام عشوائية
            while (numbers.size < count) {
                const num = Math.floor(Math.random() * (max - min + 1)) + min;
                numbers.add(num);
            }

            return Array.from(numbers);
        }

        function shuffleArray(array) {
            const shuffled = [...array];
            for (let i = shuffled.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
            }
            return shuffled;
        }

        function newRound() {
            msg.textContent = "";
            msg.className = "";

            // تحديد نوع الترتيب وعدد الأرقام
            ascending = determineOrderType();
            const numbersCount = calculateNumbersCount();

            const orderText = ascending ? "تصاعدي ⬆️" : "تنازلي ⬇️";
            orderEl.textContent = orderText;
            instruction.textContent = `رتّب الأرقام بالترتيب ${orderText}`;

            // توليد أرقام مناسبة
            currentNumbers = generateAppropriateNumbers(numbersCount, minRange, maxRange, ascending);

            // خلط الأرقام للعرض
            const shuffledNumbers = shuffleArray(currentNumbers);

            // عرض الأرقام
            numbersContainer.innerHTML = "";
            shuffledNumbers.forEach(num => {
                const div = document.createElement("div");
                div.className = "number";
                div.textContent = num;
                div.draggable = true;
                div.dataset.value = num;

                // أحداث السحب والإفلات
                div.addEventListener("dragstart", handleDragStart);
                div.addEventListener("dragend", handleDragEnd);
                div.addEventListener("dragover", handleDragOver);
                div.addEventListener("dragenter", handleDragEnter);
                div.addEventListener("dragleave", handleDragLeave);
                div.addEventListener("drop", handleDrop);

                numbersContainer.appendChild(div);
            });

            console.log("الأرقام المولدة:", currentNumbers);
            console.log("الترتيب المطلوب:", ascending ? "تصاعدي" : "تنازلي");
        }

        function handleDragStart(e) {
            draggedElement = this;
            this.classList.add("dragging");
            e.dataTransfer.effectAllowed = "move";
            e.dataTransfer.setData("text/plain", this.dataset.value);
        }

        function handleDragEnd() {
            this.classList.remove("dragging");
            document.querySelectorAll(".number").forEach(num => {
                num.classList.remove("over");
            });
            checkOrder();
        }

        function handleDragOver(e) {
            e.preventDefault();
            return false;
        }

        function handleDragEnter(e) {
            e.preventDefault();
            if (this !== draggedElement) {
                this.classList.add("over");
            }
        }

        function handleDragLeave() {
            this.classList.remove("over");
        }

        function handleDrop(e) {
            e.preventDefault();
            this.classList.remove("over");

            if (this !== draggedElement) {
                const allNumbers = Array.from(numbersContainer.children);
                const fromIndex = allNumbers.indexOf(draggedElement);
                const toIndex = allNumbers.indexOf(this);

                if (fromIndex < toIndex) {
                    numbersContainer.insertBefore(draggedElement, this.nextSibling);
                } else {
                    numbersContainer.insertBefore(draggedElement, this);
                }

                checkOrder();
            }
        }

        function checkOrder() {
            const currentOrder = Array.from(numbersContainer.children).map(el => parseInt(el.textContent));
            const correctOrder = ascending
                ? [...currentNumbers].sort((a, b) => a - b)
                : [...currentNumbers].sort((a, b) => b - a);

            const isCorrect = currentOrder.every((num, index) => num === correctOrder[index]);

            if (isCorrect) {
                successfulAttempts++;
                scoreElement.textContent = `المحاولات الناجحة: ${successfulAttempts}`;
                msg.textContent = getSuccessMessage();
                msg.className = "correct";

                // إضافة تأثير النبض للجميع
                document.querySelectorAll(".number").forEach(num => {
                    num.classList.add("pulse");
                    setTimeout(() => num.classList.remove("pulse"), 500);
                });

                // الانتقال التلقائي بعد ثانيتين
                setTimeout(() => {
                    newRound();
                }, 2000);
            } else {
                msg.textContent = "استمر في الترتيب...";
                msg.className = "";
            }
        }

        function showHint() {
            const correctOrder = ascending
                ? [...currentNumbers].sort((a, b) => a - b)
                : [...currentNumbers].sort((a, b) => b - a);

            msg.textContent = `💡 التلميح: الترتيب الصحيح هو ${correctOrder.join(' ← ')}`;
            msg.className = "correct";

            // إخفاء التلميح بعد 3 ثوان
            setTimeout(() => {
                if (msg.textContent.includes('💡 التلميح')) {
                    msg.textContent = "استمر في الترتيب...";
                    msg.className = "";
                }
            }, 3000);
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! السباق انتهى بنجاح!",
                "👏 رائع! لقد رتبت الأرقام بشكل صحيح",
                "💫 إبداع! ترتيبك مثالي",
                "🌟 برافو! أنت بطل السباق",
                "🚀 مذهل! ترتيبك صحيح بنسبة 100%"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        newRoundBtn.addEventListener("click", newRound);
        hintBtn.addEventListener("click", showHint);

        // بدء اللعبة
        newRound();
    </script>
</body>
</html>
