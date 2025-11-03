<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ترتيب الكنوز - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #333;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 900px;
            padding: 30px;
            text-align: center;
        }

        .lesson-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .instructions {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-right: 5px solid #74b9ff;
        }

        .instructions h3 {
            color: #0984e3;
            margin-bottom: 10px;
        }

        .instructions p {
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .game-area {
            padding: 25px;
            background: linear-gradient(135deg, #e8f6f3 0%, #d1f2eb 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #1abc9c;
        }

        .game-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .game-stats {
            display: flex;
            gap: 20px;
        }

        .stat-item {
            background: white;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1abc9c;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .sorting-area {
            margin: 30px 0;
        }

        .numbers-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .number-card {
            background: white;
            padding: 25px 20px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #3498db;
            cursor: grab;
            transition: all 0.3s;
            min-width: 180px;
            position: relative;
        }

        .number-card:active {
            cursor: grabbing;
            transform: scale(1.05);
        }

        .number-value {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            direction: ltr;
            text-align: center;
        }

        .card-label {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-top: 8px;
        }

        .slots-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .slot {
            background: #f8f9fa;
            padding: 30px 25px;
            border-radius: 15px;
            border: 3px dashed #95a5a6;
            min-width: 200px;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .slot.filled {
            border-style: solid;
            border-color: #2ecc71;
            background: #e8f6f3;
        }

        .slot-number {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .slot-label {
            font-size: 1rem;
            color: #7f8c8d;
        }

        .slot.ordinal-1 { border-color: #e74c3c; background: #fdedec; }
        .slot.ordinal-2 { border-color: #f39c12; background: #fef5e7; }
        .slot.ordinal-3 { border-color: #f1c40f; background: #fef9e7; }
        .slot.ordinal-4 { border-color: #2ecc71; background: #eafaf1; }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #reset-sort-btn {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
        }

        #reset-game-btn {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: translateY(0);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback {
            min-height: 80px;
            padding: 15px;
            border-radius: 12px;
            margin: 20px 0;
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s;
        }

        .feedback.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback.incorrect {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .score-container {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .progress {
            margin-top: 15px;
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            width: 0%;
            transition: width 0.5s;
        }

        .celebration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 100;
            display: none;
        }

        .drag-instruction {
            background: #fff9e6;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-right: 4px solid #f39c12;
            font-size: 1.1rem;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes confetti-fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .completion-message {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00b894;
            margin: 20px 0;
            animation: pulse 2s infinite;
        }

        .number-card.correct {
            border-color: #00b894;
            background: #e8f6f3;
            animation: pulse 1s infinite;
        }

        .number-card.incorrect {
            border-color: #e74c3c;
            background: #fdedec;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>لعبة ترتيب الكنوز 🏰</h3>
            <p>🎯 اسحب الأعداد وارتبها من الأصغر إلى الأكبر</p>
            <p>💡 ابدأ بمقارنة الأرقام من اليسار (أكبر منزلة)</p>
            <p>✨ استخدم مهاراتك في المقارنة لترتيب الكنوز!</p>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- رأس اللعبة -->
            <div class="game-header">
                <div class="game-stats">
                    <div class="stat-item">
                        <div class="stat-value" id="score">0</div>
                        <div class="stat-label">النقاط</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="correct-answers">0</div>
                        <div class="stat-label">إجابات صحيحة</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="current-streak">0</div>
                        <div class="stat-label">التتابع الحالي</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="progress-display">0/8</div>
                    <div class="stat-label">التقدم</div>
                </div>
            </div>

            <!-- تعليمات السحب -->
            <div class="drag-instruction">
                💡 اسحب البطاقات وافلتها في المكان المناسب لترتيبها من الأصغر إلى الأكبر
            </div>

            <!-- منطقة الأعداد -->
            <div class="sorting-area">
                <div class="numbers-container" id="numbers-container">
                    <!-- سيتم تعبئتها ديناميكياً -->
                </div>

                <!-- أماكن الترتيب -->
                <div class="slots-container">
                    <div class="slot ordinal-1" data-order="1">
                        <div class="slot-number" id="slot1">?</div>
                        <div class="slot-label">الأصغر</div>
                    </div>
                    <div class="slot ordinal-2" data-order="2">
                        <div class="slot-number" id="slot2">?</div>
                        <div class="slot-label">→</div>
                    </div>
                    <div class="slot ordinal-3" data-order="3">
                        <div class="slot-number" id="slot3">?</div>
                        <div class="slot-label">→</div>
                    </div>
                    <div class="slot ordinal-4" data-order="4">
                        <div class="slot-number" id="slot4">?</div>
                        <div class="slot-label">الأكبر</div>
                    </div>
                </div>
            </div>

            <!-- رسالة الإكمال -->
            <div id="completion-message" class="completion-message" style="display: none;">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="check-btn">تحقق من الترتيب</button>
                <button id="hint-btn">مساعدة</button>
                <button id="reset-sort-btn">إعادة الترتيب</button>
                <button id="reset-game-btn">لعبة جديدة</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">اسحب الأعداد وارتبها من الأصغر إلى الأكبر!</div>
        </div>

        <!-- شريط التقدم -->
        <div class="progress">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // المتغيرات الأساسية
        let numbers = [];
        let sortedNumbers = [];
        let currentOrder = [null, null, null, null];
        let score = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalQuestions = 8;
        let currentQuestion = 0;
        let gameStarted = false;
        let hintsUsed = 0;
        let draggedCard = null;

        // عناصر DOM
        const numbersContainerElement = document.getElementById('numbers-container');
        const slots = document.querySelectorAll('.slot');
        const slotNumbers = [
            document.getElementById('slot1'),
            document.getElementById('slot2'),
            document.getElementById('slot3'),
            document.getElementById('slot4')
        ];
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetSortButton = document.getElementById('reset-sort-btn');
        const resetGameButton = document.getElementById('reset-game-btn');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const progressDisplayElement = document.getElementById('progress-display');
        const progressBarElement = document.getElementById('progress-bar');
        const completionMessageElement = document.getElementById('completion-message');
        const celebrationElement = document.getElementById('celebration');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            setupDragAndDrop();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            checkButton.addEventListener('click', checkOrder);
            hintButton.addEventListener('click', showHint);
            resetSortButton.addEventListener('click', resetSorting);
            resetGameButton.addEventListener('click', resetGame);
        }

        // إعداد السحب والإفلات
        function setupDragAndDrop() {
            // إعداد السحب للبطاقات
            document.addEventListener('dragstart', function(e) {
                if (e.target.classList.contains('number-card')) {
                    draggedCard = e.target;
                    e.target.style.opacity = '0.5';
                }
            });

            document.addEventListener('dragend', function(e) {
                if (e.target.classList.contains('number-card')) {
                    e.target.style.opacity = '1';
                    draggedCard = null;
                }
            });

            // إعداد الإفلات للاماكن
            slots.forEach(slot => {
                slot.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.style.background = '#d5f4e6';
                });

                slot.addEventListener('dragleave', function(e) {
                    this.style.background = '';
                });

                slot.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.style.background = '';

                    if (draggedCard) {
                        const order = parseInt(this.getAttribute('data-order')) - 1;
                        placeNumberInSlot(draggedCard, order);
                    }
                });
            });
        }

        // بدء اللعبة
        function startGame() {
            gameStarted = true;
            generateNewProblem();
        }

        // توليد 4 أعداد عشوائية مختلفة
        function generateRandomNumbers() {
            const newNumbers = new Set();

            while (newNumbers.size < 4) {
                const num = Math.floor(Math.random() * 1000000000);
                newNumbers.add(num);
            }

            return Array.from(newNumbers);
        }

        // تنسيق العدد مع الفواصل
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // إنشاء مسألة جديدة
        function generateNewProblem() {
            if (currentQuestion >= totalQuestions) {
                endGame();
                return;
            }

            currentQuestion++;
            updateProgress();

            // توليد أعداد جديدة
            numbers = generateRandomNumbers();
            sortedNumbers = [...numbers].sort((a, b) => a - b);

            // خلط الأعداد للعرض
            numbers = shuffleArray([...numbers]);

            // إعادة تعيين الترتيب الحالي
            currentOrder = [null, null, null, null];

            // تحديث واجهة المستخدم
            updateNumbersDisplay();
            resetSlots();
            resetFeedback();
        }

        // خلط المصفوفة
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // تحديث عرض الأعداد
        function updateNumbersDisplay() {
            numbersContainerElement.innerHTML = '';

            numbers.forEach((number, index) => {
                const card = document.createElement('div');
                card.className = 'number-card';
                card.draggable = true;
                card.setAttribute('data-number', number);
                card.setAttribute('data-index', index);

                const value = document.createElement('div');
                value.className = 'number-value';
                value.textContent = formatNumber(number);

                const label = document.createElement('div');
                label.className = 'card-label';
                label.textContent = `كنز ${index + 1}`;

                card.appendChild(value);
                card.appendChild(label);
                numbersContainerElement.appendChild(card);
            });
        }

        // إعادة تعيين أماكن الترتيب
        function resetSlots() {
            slots.forEach(slot => {
                slot.classList.remove('filled');
            });

            slotNumbers.forEach(slot => {
                slot.textContent = '?';
            });

            currentOrder = [null, null, null, null];
        }

        // وضع عدد في مكان
        function placeNumberInSlot(card, order) {
            const number = parseInt(card.getAttribute('data-number'));

            // إزالة العدد من أي مكان آخر
            const currentIndex = currentOrder.indexOf(number);
            if (currentIndex !== -1) {
                currentOrder[currentIndex] = null;
                slotNumbers[currentIndex].textContent = '?';
                slots[currentIndex].classList.remove('filled');
            }

            // وضع العدد في المكان الجديد
            currentOrder[order] = number;
            slotNumbers[order].textContent = formatNumber(number);
            slots[order].classList.add('filled');

            // إزالة البطاقة من القائمة
            card.style.display = 'none';
        }

        // التحقق من الترتيب
        function checkOrder() {
            const isCorrect = JSON.stringify(currentOrder) === JSON.stringify(sortedNumbers);

            if (isCorrect) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            score += 150;
            correctAnswers++;
            currentStreak++;
            updateStats();

            feedbackElement.textContent = '🎉 أحسنت! الترتيب صحيح تماماً!';
            feedbackElement.className = 'feedback correct';

            // تلوين البطاقات باللون الصحيح
            document.querySelectorAll('.number-card').forEach(card => {
                card.classList.add('correct');
            });

            // تأثير التتابع
            if (currentStreak >= 3) {
                celebrate();
            }

            // الانتقال إلى السؤال التالي بعد تأخير
            setTimeout(generateNewProblem, 2500);
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            score = Math.max(0, score - 75);
            currentStreak = 0;
            updateStats();

            feedbackElement.textContent = '❌ الترتيب غير صحيح! حاول مرة أخرى';
            feedbackElement.className = 'feedback incorrect';

            // إظهار البطاقات المخفية
            document.querySelectorAll('.number-card').forEach(card => {
                card.style.display = 'block';
                card.classList.add('incorrect');
            });

            // إعادة تعيين الترتيب بعد تأخير
            setTimeout(resetSorting, 2000);
        }

        // إعادة الترتيب
        function resetSorting() {
            score = Math.max(0, score - 25);
            updateStats();

            resetSlots();
            document.querySelectorAll('.number-card').forEach(card => {
                card.style.display = 'block';
                card.classList.remove('correct', 'incorrect');
            });

            feedbackElement.textContent = 'تم إعادة الترتيب! حاول مرة أخرى';
            feedbackElement.className = 'feedback info';
        }

        // عرض مساعدة
        function showHint() {
            if (hintsUsed >= 2) {
                feedbackElement.textContent = '⚠️ لقد استخدمت جميع المساعدات المتاحة!';
                feedbackElement.className = 'feedback info';
                return;
            }

            hintsUsed++;
            score = Math.max(0, score - 50);
            updateStats();

            // إظهار أصغر عدد
            const smallestNumber = sortedNumbers[0];
            const card = document.querySelector(`.number-card[data-number="${smallestNumber}"]`);

            if (card) {
                card.classList.add('correct');
                feedbackElement.textContent = `💡 هذا هو أصغر عدد: ${formatNumber(smallestNumber)}`;
                feedbackElement.className = 'feedback info';
            }
        }

        // نهاية اللعبة
        function endGame() {
            gameStarted = false;
            checkButton.disabled = true;
            hintButton.disabled = true;
            resetSortButton.disabled = true;

            const percentage = (correctAnswers / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أنت خبير في ترتيب الأعداد! ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 أحسنت! مهاراتك في الترتيب ممتازة ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 جيد! واصل التدرب على الترتيب ${correctAnswers}/${totalQuestions}`;
            } else {
                message = `📚 راجع استراتيجيات مقارنة الأعداد! ${correctAnswers}/${totalQuestions}`;
            }

            completionMessageElement.style.display = 'block';
            completionMessageElement.textContent = message;

            celebrate();
        }

        // إعادة تعيين اللعبة
        function resetGame() {
            score = 0;
            correctAnswers = 0;
            currentStreak = 0;
            currentQuestion = 0;
            hintsUsed = 0;
            gameStarted = true;

            updateStats();
            updateProgress();
            checkButton.disabled = false;
            hintButton.disabled = false;
            resetSortButton.disabled = false;
            completionMessageElement.style.display = 'none';

            generateNewProblem();
        }

        // إعادة تعيين التغذية الراجعة
        function resetFeedback() {
            feedbackElement.textContent = 'اسحب الأعداد وارتبها من الأصغر إلى الأكبر!';
            feedbackElement.className = 'feedback info';
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            correctAnswersElement.textContent = correctAnswers;
            currentStreakElement.textContent = currentStreak;

            // تلوين التتابع
            if (currentStreak >= 5) {
                currentStreakElement.style.color = '#00b894';
            } else if (currentStreak >= 3) {
                currentStreakElement.style.color = '#ffb300';
            } else {
                currentStreakElement.style.color = '#0984e3';
            }
        }

        // تحديث التقدم
        function updateProgress() {
            const progress = (currentQuestion / totalQuestions) * 100;
            progressBarElement.style.width = `${progress}%`;
            progressDisplayElement.textContent = `${currentQuestion}/${totalQuestions}`;
        }

        // تأثير الاحتفال
        function celebrate() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            for (let i = 0; i < 80; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.width = '15px';
                confetti.style.height = '15px';
                confetti.style.background = getRandomColor();
                confetti.style.borderRadius = '50%';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s linear forwards`;
                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 3000);
        }

        // الحصول على لون عشوائي
        function getRandomColor() {
            const colors = [
                '#ff7675', '#74b9ff', '#55efc4', '#ffeaa7',
                '#a29bfe', '#fd79a8', '#fdcb6e', '#00b894'
            ];
            return colors[Math.floor(Math.random() * colors.length)];
        }

        // بدء اللعبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', initGame);
    </script>
</body>
</html>
