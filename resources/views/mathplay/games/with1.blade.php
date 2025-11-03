<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مطابقة الكسور المتكافئة - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 1000px;
            padding: 30px;
            text-align: center;
        }

        /* شريط التنقل العلوي */
        .navigation-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
        }

        .back-button {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
            text-decoration: none;
            color: white;
        }

        .back-button i {
            font-size: 1.2rem;
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
            background: linear-gradient(135deg, #fff9e6 0%, #ffeaa7 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #f39c12;
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
            color: #f39c12;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .matching-area {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin: 30px 0;
        }

        @media (max-width: 768px) {
            .matching-area {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .navigation-bar {
                flex-direction: column;
                gap: 15px;
            }

            .back-button {
                order: 2;
                width: 100%;
                justify-content: center;
            }
        }

        .fractions-column {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #3498db;
        }

        .column-title {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .fractions-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .fraction-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border: 2px solid #bdc3c7;
            cursor: grab;
            transition: all 0.3s;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fraction-item:active {
            cursor: grabbing;
        }

        .fraction-item.dragging {
            opacity: 0.7;
            transform: scale(1.05);
        }

        .fraction-item.matched {
            background: #e8f6f3;
            border-color: #2ecc71;
            cursor: default;
        }

        .fraction-display {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .fraction-visual {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .fraction-bar {
            width: 100px;
            height: 20px;
            background: #ecf0f1;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .fraction-fill {
            height: 100%;
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            transition: width 0.3s;
        }

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

        #new-game-btn {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
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

        .equivalent-explanation {
            background: #e8f6f3;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            border-right: 4px solid #1abc9c;
        }

        .explanation-title {
            font-weight: bold;
            color: #3498db;
            margin-bottom: 10px;
        }

        .explanation-content {
            line-height: 1.6;
            color: #2c3e50;
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

        .fraction-equivalence {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 10px 0;
            font-size: 1.2rem;
        }
    </style>
    <!-- رابط أيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- شريط التنقل العلوي -->
        <div class="navigation-bar">
            <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-button">
                <i class="fas fa-arrow-right"></i>
                العودة إلى الدرس
            </a>
            <div class="lesson-title">
                <h2 style="margin: 0; color: #2c3e50;">مطابقة الكسور المتكافئة</h2>
            </div>
        </div>

        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>مطابقة الكسور المتكافئة 🧩</h3>
            <p>🎯 اسحب كل كسر من العمود الأيسر إلى الكسر المكافئ له في العمود الأيمن</p>
            <p>💡 تذكر: الكسور المتكافئة تمثل نفس القيمة</p>
            <p>✨ استخدم خاصية الضرب أو القسمة في البسط والمقام</p>
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
                        <div class="stat-value" id="completed-rounds">0</div>
                        <div class="stat-label">الجولات المكتملة</div>
                    </div>
                </div>
            </div>

            <!-- منطقة المطابقة -->
            <div class="matching-area">
                <!-- العمود الأول: الكسور الأساسية -->
                <div class="fractions-column">
                    <div class="column-title">الكسور الأساسية</div>
                    <div class="fractions-list" id="original-fractions">
                        <!-- سيتم تعبئتها ديناميكياً -->
                    </div>
                </div>

                <!-- العمود الثاني: الكسور المكافئة -->
                <div class="fractions-column">
                    <div class="column-title">الكسور المكافئة</div>
                    <div class="fractions-list" id="equivalent-fractions">
                        <!-- سيتم تعبئتها ديناميكياً -->
                    </div>
                </div>
            </div>

            <!-- شرح التكافؤ -->
            <div class="equivalent-explanation" id="equivalent-explanation" style="display: none;">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="check-btn">
                    <i class="fas fa-check-circle"></i>
                    تحقق
                </button>
                <button id="hint-btn">
                    <i class="fas fa-lightbulb"></i>
                    مساعدة
                </button>
                <button id="new-game-btn">
                    <i class="fas fa-sync-alt"></i>
                    لوحة جديدة
                </button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">
                <i class="fas fa-mouse-pointer"></i>
                اسحب الكسور واطابقها مع كسور مكافئة!
            </div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // بيانات الكسور المتكافئة - 3 كسور في كل عمود
        const FRACTION_SETS = [
            {
                originals: [
                    { numerator: 1, denominator: 2 },
                    { numerator: 1, denominator: 3 },
                    { numerator: 2, denominator: 3 }
                ],
                equivalents: [
                    { numerator: 2, denominator: 4 },
                    { numerator: 2, denominator: 6 },
                    { numerator: 4, denominator: 6 }
                ]
            },
            {
                originals: [
                    { numerator: 3, denominator: 4 },
                    { numerator: 2, denominator: 5 },
                    { numerator: 3, denominator: 5 }
                ],
                equivalents: [
                    { numerator: 6, denominator: 8 },
                    { numerator: 4, denominator: 10 },
                    { numerator: 6, denominator: 10 }
                ]
            },
            {
                originals: [
                    { numerator: 1, denominator: 4 },
                    { numerator: 2, denominator: 6 },
                    { numerator: 3, denominator: 8 }
                ],
                equivalents: [
                    { numerator: 2, denominator: 8 },
                    { numerator: 1, denominator: 3 },
                    { numerator: 6, denominator: 16 }
                ]
            },
            {
                originals: [
                    { numerator: 2, denominator: 4 },
                    { numerator: 3, denominator: 6 },
                    { numerator: 4, denominator: 8 }
                ],
                equivalents: [
                    { numerator: 1, denominator: 2 },
                    { numerator: 1, denominator: 2 },
                    { numerator: 1, denominator: 2 }
                ]
            },
            {
                originals: [
                    { numerator: 4, denominator: 6 },
                    { numerator: 6, denominator: 9 },
                    { numerator: 8, denominator: 12 }
                ],
                equivalents: [
                    { numerator: 2, denominator: 3 },
                    { numerator: 2, denominator: 3 },
                    { numerator: 2, denominator: 3 }
                ]
            }
        ];

        // المتغيرات الأساسية
        let currentSet = null;
        let currentMatches = new Map(); // لتخزين المطابقات الحالية
        let score = 0;
        let completedRounds = 0;
        let draggedFraction = null;

        // عناصر DOM
        const originalFractionsElement = document.getElementById('original-fractions');
        const equivalentFractionsElement = document.getElementById('equivalent-fractions');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const newGameButton = document.getElementById('new-game-btn');
        const scoreElement = document.getElementById('score');
        const completedRoundsElement = document.getElementById('completed-rounds');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            setupDragAndDrop();
            generateNewGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            checkButton.addEventListener('click', checkAllMatches);
            hintButton.addEventListener('click', showHint);
            newGameButton.addEventListener('click', generateNewGame);
        }

        // إعداد السحب والإفلات
        function setupDragAndDrop() {
            // إعداد السحب للكسور الأساسية
            document.addEventListener('dragstart', function(e) {
                if (e.target.classList.contains('fraction-item') &&
                    e.target.getAttribute('data-type') === 'original' &&
                    !e.target.classList.contains('matched')) {
                    draggedFraction = e.target;
                    e.target.classList.add('dragging');
                    e.target.style.opacity = '0.7';
                }
            });

            document.addEventListener('dragend', function(e) {
                if (e.target.classList.contains('fraction-item')) {
                    e.target.classList.remove('dragging');
                    e.target.style.opacity = '1';
                    draggedFraction = null;
                }
            });

            // إعداد الإفلات للكسور المكافئة
            document.addEventListener('dragover', function(e) {
                e.preventDefault();
                if (draggedFraction && e.target.classList.contains('fraction-item') &&
                    e.target.getAttribute('data-type') === 'equivalent' &&
                    !e.target.classList.contains('matched')) {
                    e.target.classList.add('hover');
                }
            });

            document.addEventListener('dragleave', function(e) {
                if (e.target.classList.contains('fraction-item')) {
                    e.target.classList.remove('hover');
                }
            });

            document.addEventListener('drop', function(e) {
                e.preventDefault();
                if (e.target.classList.contains('fraction-item') &&
                    e.target.getAttribute('data-type') === 'equivalent' &&
                    !e.target.classList.contains('matched')) {
                    e.target.classList.remove('hover');

                    if (draggedFraction) {
                        handleFractionMatch(draggedFraction, e.target);
                    }
                }
            });
        }

        // إنشاء لعبة جديدة
        function generateNewGame() {
            // اختيار مجموعة كسور عشوائية
            const index = Math.floor(Math.random() * FRACTION_SETS.length);
            currentSet = JSON.parse(JSON.stringify(FRACTION_SETS[index])); // Deep copy
            currentMatches.clear();

            // خلط الكسور المكافئة
            currentSet.equivalents = [...currentSet.equivalents].sort(() => Math.random() - 0.5);

            // تحديث واجهة المستخدم
            updateFractionsDisplay();
            resetFeedback();
        }

        // تحديث عرض الكسور
        function updateFractionsDisplay() {
            originalFractionsElement.innerHTML = '';
            equivalentFractionsElement.innerHTML = '';
            document.getElementById('equivalent-explanation').style.display = 'none';

            // إنشاء الكسور الأساسية
            currentSet.originals.forEach((fraction, index) => {
                const fractionElement = createFractionElement(fraction, 'original', index);
                originalFractionsElement.appendChild(fractionElement);
            });

            // إنشاء الكسور المكافئة
            currentSet.equivalents.forEach((equivalent, index) => {
                const equivalentElement = createFractionElement(equivalent, 'equivalent', index);
                equivalentFractionsElement.appendChild(equivalentElement);
            });
        }

        // إنشاء عنصر كسر
        function createFractionElement(fraction, type, index) {
            const fractionItem = document.createElement('div');
            fractionItem.className = 'fraction-item';
            fractionItem.draggable = (type === 'original');
            fractionItem.setAttribute('data-numerator', fraction.numerator);
            fractionItem.setAttribute('data-denominator', fraction.denominator);
            fractionItem.setAttribute('data-type', type);
            fractionItem.setAttribute('data-index', index);

            const fractionDisplay = document.createElement('div');
            fractionDisplay.className = 'fraction-display';
            fractionDisplay.textContent = `${fraction.numerator}/${fraction.denominator}`;

            const fractionVisual = document.createElement('div');
            fractionVisual.className = 'fraction-visual';

            const fractionBar = document.createElement('div');
            fractionBar.className = 'fraction-bar';

            const fractionFill = document.createElement('div');
            fractionFill.className = 'fraction-fill';
            fractionFill.style.width = `${(fraction.numerator / fraction.denominator) * 100}%`;

            fractionBar.appendChild(fractionFill);
            fractionVisual.appendChild(fractionBar);

            fractionItem.appendChild(fractionDisplay);
            fractionItem.appendChild(fractionVisual);

            return fractionItem;
        }

        // معالجة مطابقة الكسور
        function handleFractionMatch(originalElement, equivalentElement) {
            const originalNum = parseInt(originalElement.getAttribute('data-numerator'));
            const originalDen = parseInt(originalElement.getAttribute('data-denominator'));
            const equivalentNum = parseInt(equivalentElement.getAttribute('data-numerator'));
            const equivalentDen = parseInt(equivalentElement.getAttribute('data-denominator'));

            const originalValue = originalNum / originalDen;
            const equivalentValue = equivalentNum / equivalentDen;

            // التحقق من التكافؤ
            if (Math.abs(originalValue - equivalentValue) < 0.001) {
                // الكسور متكافئة - تطابق ناجح
                originalElement.classList.add('matched');
                equivalentElement.classList.add('matched');
                originalElement.draggable = false;

                // تسجيل المطابقة
                currentMatches.set(originalElement.getAttribute('data-index'), equivalentElement.getAttribute('data-index'));

                feedbackElement.innerHTML = '<i class="fas fa-check-circle"></i> تطابق ناجح! الكسور متكافئة';
                feedbackElement.className = 'feedback correct';

                // تحديث النقاط
                score += 50;
                updateStats();

                // التحقق إذا اكتملت جميع المطابقات
                if (currentMatches.size === currentSet.originals.length) {
                    handleAllMatchesCorrect();
                }
            } else {
                // الكسور غير متكافئة
                feedbackElement.innerHTML = '<i class="fas fa-times-circle"></i> الكسور غير متكافئة! حاول مرة أخرى';
                feedbackElement.className = 'feedback incorrect';
            }
        }

        // التحقق من جميع المطابقات
        function checkAllMatches() {
            if (currentMatches.size === currentSet.originals.length) {
                handleAllMatchesCorrect();
            } else {
                const remaining = currentSet.originals.length - currentMatches.size;
                feedbackElement.innerHTML = `<i class="fas fa-exclamation-circle"></i> لم تكتمل جميع المطابقات بعد! باقي ${remaining} مطابقة`;
                feedbackElement.className = 'feedback incorrect';
            }
        }

        // معالجة اكتمال جميع المطابقات
        function handleAllMatchesCorrect() {
            score += 100;
            completedRounds++;
            updateStats();

            feedbackElement.innerHTML = '<i class="fas fa-trophy"></i> أحسنت! جميع المطابقات صحيحة! جولة جديدة جاهزة';
            feedbackElement.className = 'feedback correct';

            celebrate();

            // إعداد جولة جديدة بعد تأخير
            setTimeout(() => {
                generateNewGame();
            }, 3000);
        }

        // عرض مساعدة
        function showHint() {
            // إيجاد كسر غير متطابق في العمود الأول
            const unmatchedOriginals = document.querySelectorAll('.fraction-item[data-type="original"]:not(.matched)');
            if (unmatchedOriginals.length > 0) {
                const randomOriginal = unmatchedOriginals[Math.floor(Math.random() * unmatchedOriginals.length)];
                const originalNum = parseInt(randomOriginal.getAttribute('data-numerator'));
                const originalDen = parseInt(randomOriginal.getAttribute('data-denominator'));
                const originalValue = originalNum / originalDen;

                // إيجاد الكسر المكافئ الصحيح في العمود الثاني
                const allEquivalents = document.querySelectorAll('.fraction-item[data-type="equivalent"]');
                const correctEquivalent = Array.from(allEquivalents).find(f => {
                    const equivNum = parseInt(f.getAttribute('data-numerator'));
                    const equivDen = parseInt(f.getAttribute('data-denominator'));
                    return Math.abs((equivNum / equivDen) - originalValue) < 0.001 && !f.classList.contains('matched');
                });

                if (correctEquivalent) {
                    // توهيم الكسر الصحيح
                    randomOriginal.style.animation = 'pulse 1s infinite';
                    correctEquivalent.style.animation = 'pulse 1s infinite';

                    feedbackElement.innerHTML = `<i class="fas fa-lightbulb"></i> جرب مطابقة ${randomOriginal.textContent.split('\n')[0]} مع ${correctEquivalent.textContent.split('\n')[0]}`;
                    feedbackElement.className = 'feedback info';

                    setTimeout(() => {
                        randomOriginal.style.animation = '';
                        correctEquivalent.style.animation = '';
                    }, 2000);
                }
            }
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            completedRoundsElement.textContent = completedRounds;
        }

        // إعادة تعيين التغذية الراجعة
        function resetFeedback() {
            feedbackElement.innerHTML = '<i class="fas fa-mouse-pointer"></i> اسحب الكسور من العمود الأيسر إلى الكسور المكافئة في العمود الأيمن!';
            feedbackElement.className = 'feedback info';
        }

        // تأثير الاحتفال
        function celebrate() {
            const celebrationElement = document.getElementById('celebration');
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            for (let i = 0; i < 50; i++) {
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
