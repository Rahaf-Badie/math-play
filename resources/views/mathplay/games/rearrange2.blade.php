<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة ترتيب الأعداد - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #e67e22;
            --primary-dark: #d35400;
            --success: #27ae60;
            --success-dark: #229954;
            --error: #e74c3c;
            --error-dark: #c0392b;
            --warning: #f39c12;
            --warning-dark: #e67e22;
            --info: #3498db;
            --info-dark: #2980b9;
            --text: #2c3e50;
            --light: #f8f9fa;
            --sort-bg: linear-gradient(135deg, #fffaf0, #fcf1e0);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: var(--sort-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            color: var(--text);
        }

        .header h1 {
            font-size: 2.4rem;
            margin-bottom: 8px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.85);
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-weight: bold;
            color: var(--primary-dark);
            backdrop-filter: blur(10px);
            border: 2px solid var(--primary);
        }

        .game-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            padding: 35px;
            width: 100%;
            transition: transform 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .game-card::before {
            content: "{{ $max_range }}";
            position: absolute;
            top: -30px;
            right: -30px;
            font-size: 150px;
            color: rgba(230, 126, 34, 0.08);
            z-index: 0;
            font-weight: bold;
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .comparison-guide {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
        }

        .comparison-guide h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        .guide-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .guide-step {
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .step-icon {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .step-text {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .instructions {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--text);
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.15rem;
            font-weight: bold;
        }

        .order-type-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
            position: relative;
            z-index: 1;
        }

        .order-badge {
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 1.3rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .ascending {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
        }

        .descending {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .sortable-area {
            position: relative;
            z-index: 1;
            margin: 30px 0;
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 20px;
            border: 3px dashed var(--primary);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            min-height: 350px;
        }

        .sortable-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            min-height: 280px;
        }

        .sortable-item {
            background: white;
            padding: 20px;
            border: 3px solid var(--primary);
            border-radius: 15px;
            font-size: 1.6rem;
            font-weight: bold;
            cursor: grab;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            user-select: none;
        }

        .sortable-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(230, 126, 34, 0.3);
        }

        .sortable-item:active {
            cursor: grabbing;
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(230, 126, 34, 0.4);
        }

        .sortable-item.dragging {
            opacity: 0.7;
            transform: rotate(3deg);
            border-style: dashed;
        }

        .sortable-item.over {
            border: 3px dashed var(--success);
            background: rgba(39, 174, 96, 0.1);
        }

        .item-number {
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
            flex: 1;
            text-align: center;
        }

        .position-indicator {
            background: var(--primary);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: bold;
            flex-shrink: 0;
        }

        .drag-handle {
            color: var(--primary);
            font-size: 1.4rem;
            cursor: grab;
            padding: 5px;
            flex-shrink: 0;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
        }

        .btn {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
            border: none;
            border-radius: 15px;
            padding: 16px 32px;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            font-family: inherit;
            position: relative;
            overflow: hidden;
            min-width: 160px;
        }

        .btn::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s;
        }

        .btn:hover::after {
            width: 120px;
            height: 120px;
        }

        .btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(2px);
        }

        .btn-reset {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--text);
        }

        .btn-hint {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
        }

        #feedback {
            margin-top: 25px;
            font-size: 1.5rem;
            min-height: 60px;
            text-align: center;
            padding: 18px;
            border-radius: 12px;
            transition: all 0.4s;
            position: relative;
            z-index: 1;
            font-weight: bold;
        }

        .feedback-correct {
            background: rgba(39, 174, 96, 0.15);
            color: var(--success-dark);
            border: 2px solid var(--success);
            animation: bounce 0.6s ease;
        }

        .feedback-wrong {
            background: rgba(231, 76, 60, 0.15);
            color: var(--error-dark);
            border: 2px solid var(--error);
            animation: shake 0.5s ease;
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--light), #fffaf0);
            padding: 18px;
            border-radius: 15px;
            margin-top: 25px;
            position: relative;
            z-index: 1;
            border: 2px solid var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .score-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            text-align: center;
        }

        .score-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-dark);
        }

        .score-label {
            font-size: 1rem;
            color: var(--text);
        }

        .progress {
            height: 14px;
            background: #e0e0e0;
            border-radius: 7px;
            margin-top: 15px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            width: 0%;
            transition: width 0.6s ease;
            border-radius: 7px;
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

        .confetti {
            position: absolute;
            width: 14px;
            height: 14px;
            background: var(--success);
            opacity: 0;
        }

        .number-bubble {
            position: absolute;
            font-size: 1.4rem;
            color: var(--primary);
            animation: float 4s ease-in-out infinite;
            z-index: 0;
            font-weight: bold;
            opacity: 0.6;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(-10px) rotate(240deg); }
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes bounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-12px); }
            80% { transform: translateY(-6px); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-12px); }
            75% { transform: translateX(12px); }
        }

        /* تصميم متجاوب */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .game-card {
                padding: 25px 20px;
            }

            .sortable-item {
                font-size: 1.4rem;
                padding: 15px;
            }

            .controls {
                flex-direction: column;
                gap: 12px;
            }

            .btn {
                width: 100%;
                min-width: auto;
            }

            .guide-steps {
                grid-template-columns: 1fr;
            }

            .score-container {
                flex-direction: column;
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .sortable-item {
                font-size: 1.2rem;
                padding: 12px;
                flex-direction: column;
                gap: 10px;
            }

            .position-indicator {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }

            .item-number {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎮 لعبة ترتيب الأعداد</h1>
            <div class="lesson-info">
                الدرس: {{ $lesson_game->lesson->name }} |
                المدى: {{ $min_range }} إلى {{ $max_range }}
            </div>
        </div>

        <div class="game-card">
            <div class="comparison-guide">
                <h3>📊 دليل مقارنة الأعداد</h3>
                <div class="guide-steps">
                    <div class="guide-step">
                        <div class="step-icon">1️⃣</div>
                        <div class="step-text">قارن المنازل من اليسار إلى اليمين</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">2️⃣</div>
                        <div class="step-text">انظر إلى المنازل الكبيرة أولاً</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">3️⃣</div>
                        <div class="step-text">استمر في المقارنة حتى تجد اختلافاً</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">4️⃣</div>
                        <div class="step-text">العدد الأكبر هو الذي يحتوي على رقم أكبر في المنزلة المختلفة</div>
                    </div>
                </div>
            </div>

            <div class="instructions">
                <p>🎯 اسحب الأعداد وافلتها لترتيبها حسب التعليمات</p>
                <p>💡 تذكر: ابدأ بمقارنة المنازل الكبيرة أولاً (الآلاف ثم المئات ثم العشرات فالآحاد)</p>
            </div>

            <div class="order-type-indicator">
                <div id="order-badge" class="order-badge ascending">
                    <!-- سيتم تحديث نوع الترتيب بالجافاسكريبت -->
                </div>
            </div>

            <div class="sortable-area">
                <div id="sortable-list" class="sortable-list">
                    <!-- سيتم تعبئة الأعداد بالجافاسكريبت -->
                </div>
            </div>

            <div class="controls">
                <button class="btn" id="check-btn">✅ تحقق من الترتيب</button>
                <button class="btn btn-hint" id="hint-btn">💡 عرض تلميح</button>
                <button class="btn btn-reset" id="reset-btn">🔄 جولة جديدة</button>
            </div>

            <div id="feedback"></div>

            <div class="score-container">
                <div class="score-item">
                    <span class="score-label">النقاط</span>
                    <span class="score-value" id="score">0</span>
                </div>
                <div class="score-item">
                    <span class="score-label">الجولة</span>
                    <span class="score-value"><span id="current-round">0</span>/<span id="total-rounds">10</span></span>
                </div>
                <div class="score-item">
                    <span class="score-label">المستوى</span>
                    <span class="score-value" id="level">1</span>
                </div>
                <div class="score-item">
                    <span class="score-label">الإجابات المتتالية</span>
                    <span class="score-value" id="streak">0</span>
                </div>
            </div>

            <div class="progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range ?? 1000 }};
        const maxRange = {{ $max_range ?? 99999 }};
        const operationType = "{{ $operation_type ?? 'number_comparison' }}";

        // متغيرات اللعبة
        let score = 0;
        let currentRound = 0;
        const totalRounds = 10;
        let currentNumbers = [];
        let isAscending = true;
        let draggedItem = null;
        let streak = 0;
        let difficultyLevel = 1;

        // عناصر DOM
        const sortableList = document.getElementById('sortable-list');
        const orderBadge = document.getElementById('order-badge');
        const scoreElement = document.getElementById('score');
        const currentRoundElement = document.getElementById('current-round');
        const totalRoundsElement = document.getElementById('total-rounds');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const levelElement = document.getElementById('level');
        const streakElement = document.getElementById('streak');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalRoundsElement.textContent = totalRounds;
            checkButton.addEventListener('click', checkOrder);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', startNewRound);

            createNumberBubbles();
            startNewRound();
        });

        // توليد عدد عشوائي ضمن المدى
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // إنشاء فقاعات الأرقام
        function createNumberBubbles() {
            const container = document.querySelector('.game-card');
            for (let i = 0; i < 8; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'number-bubble';
                bubble.textContent = generateRandomNumber().toLocaleString('ar-EG');
                bubble.style.left = `${Math.random() * 80 + 10}%`;
                bubble.style.top = `${Math.random() * 80 + 10}%`;
                bubble.style.animationDelay = `${Math.random() * 3}s`;
                container.appendChild(bubble);
            }
        }

        // بدء جولة جديدة
        function startNewRound() {
            currentRound++;
            currentRoundElement.textContent = currentRound;
            updateProgress();
            updateLevel();

            // اختيار نوع الترتيب عشوائياً
            isAscending = Math.random() < 0.5;
            updateOrderBadge();

            // تحديد عدد الأعداد بناءً على مستوى الصعوبة
            const numberCount = 4 + Math.min(Math.floor(score / 50), 3); // 4-7 أعداد

            // توليد أعداد فريدة
            currentNumbers = [];
            while (currentNumbers.length < numberCount) {
                const num = generateRandomNumber();
                if (!currentNumbers.includes(num)) {
                    currentNumbers.push(num);
                }
            }

            // ترتيب عشوائي للبداية
            shuffleArray(currentNumbers);
            renderSortableList();

            feedbackElement.textContent = 'اسحب الأعداد وافلتها للترتيب الصحيح';
            feedbackElement.className = '';
        }

        // تحديث شارة نوع الترتيب
        function updateOrderBadge() {
            if (isAscending) {
                orderBadge.textContent = '🔼 ترتيب تصاعدي (من الأصغر إلى الأكبر)';
                orderBadge.className = 'order-badge ascending';
            } else {
                orderBadge.textContent = '🔽 ترتيب تنازلي (من الأكبر إلى الأصغر)';
                orderBadge.className = 'order-badge descending';
            }
        }

        // خلط المصفوفة عشوائياً
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // عرض القائمة القابلة للترتيب
        function renderSortableList() {
            sortableList.innerHTML = '';

            currentNumbers.forEach((number, index) => {
                const item = document.createElement('div');
                item.className = 'sortable-item';
                item.draggable = true;
                item.dataset.value = number;

                item.innerHTML = `
                    <div class="position-indicator">${index + 1}</div>
                    <div class="item-number">${number.toLocaleString('ar-EG')}</div>
                    <div class="drag-handle">⋮⋮</div>
                `;

                // إضافة مستمعي السحب والإفلات
                item.addEventListener('dragstart', handleDragStart);
                item.addEventListener('dragend', handleDragEnd);
                item.addEventListener('dragover', handleDragOver);
                item.addEventListener('dragenter', handleDragEnter);
                item.addEventListener('dragleave', handleDragLeave);
                item.addEventListener('drop', handleDrop);

                sortableList.appendChild(item);
            });
        }

        // معالجات السحب والإفلات
        function handleDragStart(e) {
            draggedItem = this;
            this.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', this.dataset.value);
        }

        function handleDragEnd() {
            this.classList.remove('dragging');
            draggedItem = null;
        }

        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
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

            if (draggedItem !== this) {
                const allItems = Array.from(sortableList.children);
                const fromIndex = allItems.indexOf(draggedItem);
                const toIndex = allItems.indexOf(this);

                if (fromIndex < toIndex) {
                    sortableList.insertBefore(draggedItem, this.nextSibling);
                } else {
                    sortableList.insertBefore(draggedItem, this);
                }

                // تحديث الأرقام الترتيبية
                updatePositionIndicators();
            }
        }

        // تحديث الأرقام الترتيبية
        function updatePositionIndicators() {
            const items = Array.from(sortableList.children);
            items.forEach((item, index) => {
                const indicator = item.querySelector('.position-indicator');
                indicator.textContent = index + 1;
            });
        }

        // التحقق من الترتيب
        function checkOrder() {
            const items = Array.from(sortableList.children);
            const userOrder = items.map(item => parseInt(item.dataset.value));

            // الترتيب الصحيح
            const correctOrder = [...currentNumbers].sort((a, b) => a - b);
            if (!isAscending) {
                correctOrder.reverse();
            }

            const isCorrect = userOrder.every((num, index) => num === correctOrder[index]);

            if (isCorrect) {
                score += 10 + (streak * 2);
                streak++;
                scoreElement.textContent = score;
                streakElement.textContent = streak;
                feedbackElement.textContent = getSuccessMessage();
                feedbackElement.className = 'feedback-correct';

                // تأثير الاحتفال عند الإجابات الصحيحة المتتالية
                if (streak >= 3) {
                    createCelebration();
                }

                setTimeout(() => {
                    if (currentRound < totalRounds) {
                        startNewRound();
                    } else {
                        endGame();
                    }
                }, 2000);
            } else {
                streak = 0;
                streakElement.textContent = streak;
                feedbackElement.textContent = '❌ الترتيب غير صحيح. حاول مرة أخرى!';
                feedbackElement.className = 'feedback-wrong';

                // عرض الترتيب الصحيح كتلميح
                setTimeout(() => {
                    const correctText = isAscending ?
                        'التريب الصحيح (تصاعدي): ' + correctOrder.map(n => n.toLocaleString('ar-EG')).join(' ← ') :
                        'التريب الصحيح (تنازلي): ' + correctOrder.map(n => n.toLocaleString('ar-EG')).join(' → ');
                    feedbackElement.textContent = `💡 ${correctText}`;
                }, 1500);
            }
        }

        // عرض تلميح
        function showHint() {
            const correctOrder = [...currentNumbers].sort((a, b) => a - b);
            if (!isAscending) {
                correctOrder.reverse();
            }

            const hintType = Math.floor(Math.random() * 3);
            let hint = '';

            switch(hintType) {
                case 0:
                    hint = `أول عدد يجب أن يكون: ${correctOrder[0].toLocaleString('ar-EG')}`;
                    break;
                case 1:
                    hint = `آخر عدد يجب أن يكون: ${correctOrder[correctOrder.length - 1].toLocaleString('ar-EG')}`;
                    break;
                case 2:
                    const midIndex = Math.floor(correctOrder.length / 2);
                    hint = `العدد في المنتصف يجب أن يكون: ${correctOrder[midIndex].toLocaleString('ar-EG')}`;
                    break;
            }

            feedbackElement.textContent = `💡 ${hint}`;
            feedbackElement.className = 'feedback-wrong';
        }

        // الحصول على رسالة نجاح عشوائية
        function getSuccessMessage() {
            const messages = [
                `أحسنت! 🌟 ترتيب صحيح ${streak > 1 ? `(${streak} إجابات متتالية!)` : ''}`,
                "رائع! 🎯 فهمت المقارنة جيداً",
                "إبداع! 💫 أنت تتقن ترتيب الأعداد",
                "ممتاز! ⚡ استمر في التميز",
                "برافو! 👏 ترتيب ممتاز"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // تحديث المستوى
        function updateLevel() {
            difficultyLevel = Math.floor(score / 30) + 1;
            levelElement.textContent = difficultyLevel;
        }

        // إنهاء اللعبة
        function endGame() {
            feedbackElement.innerHTML = `
                🎉 <strong>انتهت اللعبة!</strong><br><br>
                ${getFinalMessage()}<br>
                مجموع نقاطك: <strong>${score}</strong> من ${totalRounds * 10}<br>
                الإجابات المتتالية القصوى: <strong>${streak}</strong>
            `;
            feedbackElement.className = 'feedback-correct';

            checkButton.style.display = 'none';
            hintButton.style.display = 'none';

            createCelebration();
        }

        // الحصول على الرسالة النهائية
        function getFinalMessage() {
            if (score >= 90) {
                return "مذهل! 🏆 أنت خبير في ترتيب الأعداد";
            } else if (score >= 70) {
                return "رائع! ⭐ أداء ممتاز في المقارنة";
            } else if (score >= 50) {
                return "جيد جداً! 👍 واصل التعلم";
            } else {
                return "حاول مرة أخرى! 💪 الممارسة تصنع الفرق";
            }
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (currentRound / totalRounds) * 100;
            progressBar.style.width = `${progress}%`;
        }

        // تأثير الاحتفال
        function createCelebration() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            const colors = ['#e67e22', '#d35400', '#27ae60', '#e74c3c', '#f39c12', '#3498db'];

            for (let i = 0; i < 150; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = `${Math.random() * 100}%`;
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.animationDelay = `${Math.random() * 0.5}s`;

                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 4000);
        }
    </script>
</body>
</html>
