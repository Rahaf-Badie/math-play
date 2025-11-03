<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لعبة صياد المجسمات - {{ $lesson_game->lesson->name }}</title>
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
            background: linear-gradient(135deg, #ecf0f1 0%, #d5dbdb 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #16a085;
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
            color: #16a085;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .question-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-right: 5px solid #16a085;
        }

        .question-title {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .properties-list {
            text-align: right;
            font-size: 1.2rem;
            line-height: 1.8;
            color: #34495e;
        }

        .property-item {
            margin-bottom: 10px;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 8px;
            border-right: 3px solid #3498db;
        }

        .shape-visual {
            margin: 20px 0;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .shape-symbol {
            font-size: 4rem;
            margin-bottom: 10px;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            .options-grid {
                grid-template-columns: 1fr;
            }
        }

        .option-btn {
            padding: 20px 15px;
            font-size: 1.3rem;
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
        }

        .option-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            animation: pulse 1s infinite;
        }

        .option-btn.incorrect {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
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

        #next-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #reset-btn {
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
            margin-bottom: 20px;
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

        .shape-details {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: right;
        }

        .detail-item {
            margin-bottom: 10px;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 8px;
            border-right: 3px solid #9b59b6;
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

        .bounce {
            animation: bounce 0.5s ease infinite;
        }

        .completion-message {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00b894;
            margin: 20px 0;
            animation: pulse 2s infinite;
        }

        .difficulty-selector {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .difficulty-btn {
            padding: 8px 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
        }

        .difficulty-btn.active {
            background: #3498db;
            color: white;
            border-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>لعبة صياد المجسمات 🏹</h3>
            <p>🎯 اقرأ خصائص المجسم جيداً واختر اسمه الصحيح</p>
            <p>💡 تعرف على المجسمات من خلال عدد الأوجه والأحرف والرؤوس</p>
            <p>✨ استخدم المساعدة إذا احتجت إلى تلميح!</p>
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
                    <div class="stat-value" id="progress-display">0/10</div>
                    <div class="stat-label">التقدم</div>
                </div>
            </div>

            <!-- صندوق السؤال -->
            <div class="question-box">
                <div class="question-title">خصائص المجسم:</div>
                <div id="properties-list" class="properties-list">
                    <!-- سيتم تعبئتها ديناميكياً -->
                </div>

                <!-- المساعدة البصرية -->
                <div class="shape-visual">
                    <div class="shape-symbol" id="shape-symbol">🔷</div>
                    <div id="shape-hint">مجسم ثلاثي الأبعاد</div>
                </div>
            </div>

            <!-- شبكة الخيارات -->
            <div id="options-grid" class="options-grid">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- تفاصيل إضافية -->
            <div class="shape-details" id="shape-details" style="display: none;">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- رسالة الإكمال -->
            <div id="completion-message" class="completion-message" style="display: none;">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="next-btn">سؤال تالي</button>
                <button id="hint-btn">مساعدة</button>
                <button id="reset-btn">لعبة جديدة</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">اقرأ الخصائص واختر اسم المجسم الصحيح!</div>
        </div>

        <!-- شريط التقدم -->
        <div class="progress">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // بيانات المجسمات
        const SHAPES = [
            {
                name: "المكعب",
                properties: [
                    "6 أوجه مربعة متطابقة",
                    "12 حرفاً",
                    "8 رؤوس",
                    "جميع الأوجه متساوية",
                    "زواياه قائمة"
                ],
                symbol: "⬜",
                examples: "مكعبات الثلج، علب الهدايا المكعبة",
                details: "المكعب هو مجسم جميع أوجهه مربعات متطابقة وجميع أحرفه متساوية في الطول."
            },
            {
                name: "متوازي المستطيلات",
                properties: [
                    "6 أوجه مستطيلة",
                    "12 حرفاً",
                    "8 رؤوس",
                    "الأوجه المتقابلة متطابقة",
                    "زواياه قائمة"
                ],
                symbol: "📦",
                examples: "الكتب، الصناديق، الهواتف",
                details: "متوازي المستطيلات له ستة أوجه مستطيلة، كل وجهين متقابلين متطابقان ومتوازيان."
            },
            {
                name: "الهرم الثلاثي",
                properties: [
                    "4 أوجه مثلثة",
                    "6 أحرف",
                    "4 رؤوس",
                    "قاعدة مثلثة",
                    "أوجهه مثلثات"
                ],
                symbol: "🔺",
                examples: "الهرم المصري، خيمة السيرك",
                details: "الهرم الثلاثي له قاعدة مثلثة وثلاثة أوجه مثلثة تلتقي في قمة واحدة."
            },
            {
                name: "الأسطوانة",
                properties: [
                    "قاعدتان دائريتان متطابقتان",
                    "سطح جانبي منحنٍ",
                    "لا يوجد رؤوس",
                    "قاعدتان متوازيتان",
                    "سطح منحنٍ واحد"
                ],
                symbol: "🥫",
                examples: "علب المشروبات، الأنابيب، الشموع",
                details: "الأسطوانة لها قاعدتان دائريتان متطابقتان ومتوازيتان، وسطح جانبي منحنٍ."
            },
            {
                name: "المخروط",
                properties: [
                    "قاعدة دائرية واحدة",
                    "سطح جانبي منحنٍ",
                    "رأس واحد",
                    "قاعدة دائرية",
                    "ينتهي برأس حاد"
                ],
                symbol: "🎯",
                examples: "المثلجات، أقماع المرور، أقماع الحفلات",
                details: "المخروط له قاعدة دائرية وسطح جانبي منحنٍ يلتقي في رأس واحد."
            },
            {
                name: "الكرة",
                properties: [
                    "لا يوجد أوجه",
                    "لا يوجد أحرف",
                    "لا يوجد رؤوس",
                    "سطح منحنٍ كامل",
                    "جميع النقاط على بعد متساوي من المركز"
                ],
                symbol: "⚽",
                examples: "كرة القدم، كرة السلة، الكرة الأرضية",
                details: "الكرة هي مجسم كروي ليس لها أوجه أو أحرف أو رؤوس، وجميع نقاط سطحها على بعد متساوٍ من المركز."
            },
            {
                name: "المنشور الثلاثي",
                properties: [
                    "5 أوجه (2 مثلث + 3 مستطيل)",
                    "9 أحرف",
                    "6 رؤوس",
                    "قاعدتان مثلثتان",
                    "أوجه جانبية مستطيلة"
                ],
                symbol: "📐",
                examples: "سقف المنزل، منشور الزجاج",
                details: "المنشور الثلاثي له قاعدتان مثلثتان متطابقتان ومتوازيتان، وثلاثة أوجه جانبية مستطيلة."
            },
            {
                name: "الهرم الرباعي",
                properties: [
                    "5 أوجه (1 مربع + 4 مثلث)",
                    "8 أحرف",
                    "5 رؤوس",
                    "قاعدة مربعة",
                    "أوجهه مثلثات"
                ],
                symbol: "🏰",
                examples: "الأهرامات المصرية",
                details: "الهرم الرباعي له قاعدة مربعة وأربعة أوجه مثلثة تلتقي في قمة واحدة."
            }
        ];

        // المتغيرات الأساسية
        let currentShape = null;
        let score = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalQuestions = 10;
        let currentQuestion = 0;
        let gameStarted = false;
        let hintsUsed = 0;

        // عناصر DOM
        const propertiesListElement = document.getElementById('properties-list');
        const optionsGridElement = document.getElementById('options-grid');
        const feedbackElement = document.getElementById('feedback');
        const nextButton = document.getElementById('next-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const progressDisplayElement = document.getElementById('progress-display');
        const progressBarElement = document.getElementById('progress-bar');
        const shapeSymbolElement = document.getElementById('shape-symbol');
        const shapeHintElement = document.getElementById('shape-hint');
        const shapeDetailsElement = document.getElementById('shape-details');
        const completionMessageElement = document.getElementById('completion-message');
        const celebrationElement = document.getElementById('celebration');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            nextButton.addEventListener('click', generateNewProblem);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', resetGame);
        }

        // بدء اللعبة
        function startGame() {
            gameStarted = true;
            generateNewProblem();
        }

        // إنشاء مسألة جديدة
        function generateNewProblem() {
            if (currentQuestion >= totalQuestions) {
                endGame();
                return;
            }

            currentQuestion++;
            updateProgress();

            // اختيار مجسم عشوائي
            const correctIndex = Math.floor(Math.random() * SHAPES.length);
            currentShape = SHAPES[correctIndex];

            // تحديث واجهة المستخدم
            updateQuestionDisplay();
            generateOptions(correctIndex);
            resetFeedback();
        }

        // تحديث عرض السؤال
        function updateQuestionDisplay() {
            // تحديث الخصائص
            propertiesListElement.innerHTML = '';
            currentShape.properties.forEach(property => {
                const propertyItem = document.createElement('div');
                propertyItem.className = 'property-item';
                propertyItem.textContent = `• ${property}`;
                propertiesListElement.appendChild(propertyItem);
            });

            // تحديث الرمز والتلميح
            shapeSymbolElement.textContent = currentShape.symbol;
            shapeHintElement.textContent = `مجسم ${currentShape.properties.length} خاصية`;

            // إخفاء التفاصيل
            shapeDetailsElement.style.display = 'none';
        }

        // إنشاء الخيارات
        function generateOptions(correctIndex) {
            optionsGridElement.innerHTML = '';

            let options = new Set();
            options.add(currentShape.name);

            // توليد 3 خيارات خاطئة فريدة
            while (options.size < 4) {
                let wrongIndex = Math.floor(Math.random() * SHAPES.length);
                options.add(SHAPES[wrongIndex].name);
            }

            let finalOptions = Array.from(options);
            finalOptions.sort(() => Math.random() - 0.5);

            finalOptions.forEach(option => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.textContent = option;
                button.addEventListener('click', () => checkAnswer(option));
                optionsGridElement.appendChild(button);
            });

            // تفعيل الأزرار
            enableOptions(true);
        }

        // التحقق من الإجابة
        function checkAnswer(userChoice) {
            // تعطيل جميع الأزرار
            enableOptions(false);

            const isCorrect = userChoice === currentShape.name;
            const optionButtons = document.querySelectorAll('.option-btn');

            // تلوين الأزرار
            optionButtons.forEach(button => {
                if (button.textContent === currentShape.name) {
                    button.classList.add('correct');
                } else if (button.textContent === userChoice && !isCorrect) {
                    button.classList.add('incorrect');
                }
            });

            // معالجة النتيجة
            if (isCorrect) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }

            // عرض التفاصيل
            showShapeDetails();
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            score += 100;
            correctAnswers++;
            currentStreak++;
            updateStats();

            feedbackElement.textContent = `🎉 أحسنت! ${currentShape.name} هو الإجابة الصحيحة!`;
            feedbackElement.className = 'feedback correct';

            // تأثير التتابع
            if (currentStreak >= 3) {
                celebrate();
            }
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            score = Math.max(0, score - 50);
            currentStreak = 0;
            updateStats();

            feedbackElement.textContent = `❌ خطأ! الإجابة الصحيحة هي ${currentShape.name}`;
            feedbackElement.className = 'feedback incorrect';
        }

        // عرض تفاصيل المجسم
        function showShapeDetails() {
            shapeDetailsElement.style.display = 'block';
            shapeDetailsElement.innerHTML = `
                <div class="detail-item"><strong>${currentShape.name}</strong></div>
                <div class="detail-item">${currentShape.details}</div>
                <div class="detail-item"><strong>أمثلة:</strong> ${currentShape.examples}</div>
            `;
        }

        // عرض مساعدة
        function showHint() {
            if (hintsUsed >= 2) {
                feedbackElement.textContent = '⚠️ لقد استخدمت جميع المساعدات المتاحة!';
                feedbackElement.className = 'feedback info';
                return;
            }

            hintsUsed++;
            score = Math.max(0, score - 25);
            updateStats();

            const optionButtons = document.querySelectorAll('.option-btn');
            const wrongOptions = Array.from(optionButtons).filter(btn =>
                btn.textContent !== currentShape.name && !btn.classList.contains('incorrect')
            );

            if (wrongOptions.length > 0) {
                const randomWrongOption = wrongOptions[Math.floor(Math.random() * wrongOptions.length)];
                randomWrongOption.classList.add('incorrect');
                randomWrongOption.disabled = true;
            }

            feedbackElement.textContent = `💡 تلميح: استبعدت أحد الخيارات الخاطئة!`;
            feedbackElement.className = 'feedback info';
        }

        // نهاية اللعبة
        function endGame() {
            gameStarted = false;
            nextButton.disabled = true;
            hintButton.disabled = true;

            const percentage = (correctAnswers / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أنت خبير في المجسمات! ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 أحسنت! فهمت المجسمات جيداً ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 جيد! واصل التعلم ${correctAnswers}/${totalQuestions}`;
            } else {
                message = `📚 تحتاج إلى مزيد من الدراسة! ${correctAnswers}/${totalQuestions}`;
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
            nextButton.disabled = false;
            hintButton.disabled = false;
            completionMessageElement.style.display = 'none';
            shapeDetailsElement.style.display = 'none';

            generateNewProblem();
        }

        // تفعيل/تعطيل الخيارات
        function enableOptions(enabled) {
            const optionButtons = document.querySelectorAll('.option-btn');
            optionButtons.forEach(button => {
                button.disabled = !enabled;
            });
        }

        // إعادة تعيين التغذية الراجعة
        function resetFeedback() {
            feedbackElement.textContent = 'اقرأ الخصائص واختر اسم المجسم الصحيح!';
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

            for (let i = 0; i < 60; i++) {
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
