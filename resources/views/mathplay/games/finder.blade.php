<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>باحث الكسور المفقودة - {{ $lesson_game->lesson->name }}</title>
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

        .puzzle-area {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            margin: 30px 0;
            border: 3px solid #3498db;
        }

        .puzzle-title {
            font-size: 1.4rem;
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .fraction-equation {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .fraction-part {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            min-width: 120px;
        }

        .fraction-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 10px 0;
        }

        .fraction-input {
            width: 80px;
            height: 60px;
            font-size: 2rem;
            text-align: center;
            border: 3px solid #3498db;
            border-radius: 8px;
            outline: none;
            margin: 5px 0;
            font-weight: bold;
            transition: all 0.3s;
        }

        .fraction-input:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 10px rgba(116, 185, 255, 0.5);
        }

        .fraction-input.correct {
            border-color: #2ecc71;
            background: #e8f6f3;
        }

        .fraction-input.incorrect {
            border-color: #e74c3c;
            background: #fdedec;
        }

        .equals-sign {
            font-size: 2.5rem;
            font-weight: bold;
            color: #e74c3c;
            margin: 0 15px;
        }

        .fraction-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .circle-visual {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: conic-gradient(
                #f39c12 0% calc(var(--filled) * 100%),
                #ecf0f1 calc(var(--filled) * 100%) 100%
            );
            margin-bottom: 10px;
            border: 3px solid #34495e;
            position: relative;
        }

        .circle-label {
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .multiplication-hint {
            background: #fff9e6;
            padding: 20px;
            border-radius: 12px;
            margin: 25px 0;
            border-right: 4px solid #f39c12;
        }

        .hint-title {
            font-weight: bold;
            color: #e67e22;
            margin-bottom: 15px;
        }

        .multiplication-steps {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            background: white;
            border-radius: 8px;
            min-width: 100px;
        }

        .step-number {
            font-weight: bold;
            color: #3498db;
            margin-bottom: 5px;
        }

        .step-value {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
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

        #show-hint-btn {
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

        .missing-part {
            background: #ffeaa7;
            border: 2px dashed #f39c12;
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        
        <!-- التعليمات -->
        <div class="instructions">
            <h3>باحث الكسور المفقودة 🔍</h3>
            <p>🎯 ابحث عن القيمة المفقودة في الكسور المتكافئة</p>
            <p>💡 استخدم خاصية الضرب أو القسمة لإيجاد القيمة</p>
            <p>✨ انظر إلى العلاقة بين البسط والمقام</p>
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
                        <div class="stat-value" id="solved-count">0</div>
                        <div class="stat-label">تم الحل</div>
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

            <!-- منطقة الأحجية -->
            <div class="puzzle-area">
                <div class="puzzle-title">أوجد القيمة المفقودة في الكسور المتكافئة:</div>
                
                <!-- معادلة الكسور -->
                <div class="fraction-equation">
                    <div class="fraction-part">
                        <div class="fraction-display" id="fraction1-numerator">1</div>
                        <div class="fraction-display" style="border-top: 3px solid #333; width: 100%;"></div>
                        <div class="fraction-display" id="fraction1-denominator">2</div>
                    </div>
                    
                    <div class="equals-sign">=</div>
                    
                    <div class="fraction-part">
                        <input type="number" id="fraction2-numerator" class="fraction-input missing-part" placeholder="؟" min="1">
                        <div style="border-top: 3px solid #333; width: 100%;"></div>
                        <input type="number" id="fraction2-denominator" class="fraction-input missing-part" placeholder="؟" min="1">
                    </div>
                </div>

                <!-- التمثيل البصري -->
                <div class="fraction-visual">
                    <div class="circle-visual">
                        <div class="circle" id="circle1" style="--filled: 0.5"></div>
                        <div class="circle-label" id="circle1-label">1/2</div>
                    </div>
                    <div class="equals-sign">=</div>
                    <div class="circle-visual">
                        <div class="circle" id="circle2" style="--filled: 0.5"></div>
                        <div class="circle-label" id="circle2-label">؟/؟</div>
                    </div>
                </div>

                <!-- تلميح الضرب -->
                <div class="multiplication-hint" id="multiplication-hint" style="display: none;">
                    <div class="hint-title">💡 تلميح الضرب:</div>
                    <div class="multiplication-steps" id="multiplication-steps">
                        <!-- سيتم تعبئتها ديناميكياً -->
                    </div>
                </div>
            </div>

            <!-- رسالة الإكمال -->
            <div id="completion-message" class="completion-message" style="display: none;">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="check-btn">تحقق</button>
                <button id="show-hint-btn">اظهر التلميح</button>
                <button id="reset-btn">سؤال جديد</button>
            </div>
            
            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">أدخل القيم المفقودة في الكسور المتكافئة!</div>
        </div>

        <!-- شريط التقدم -->
        <div class="progress">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // بيانات الكسور المتكافئة
        const FRACTION_PUZZLES = [
            { num1: 1, den1: 2, num2: null, den2: 4, missing: 'numerator' },
            { num1: 1, den1: 3, num2: 2, den2: null, missing: 'denominator' },
            { num1: 2, den1: 3, num2: null, den2: 6, missing: 'numerator' },
            { num1: 3, den1: 4, num2: 6, den2: null, missing: 'denominator' },
            { num1: 2, den1: 5, num2: null, den2: 10, missing: 'numerator' },
            { num1: 3, den1: 5, num2: 6, den2: null, missing: 'denominator' },
            { num1: 1, den1: 4, num2: null, den2: 8, missing: 'numerator' },
            { num1: 2, den1: 7, num2: 4, den2: null, missing: 'denominator' }
        ];

        // المتغيرات الأساسية
        let currentPuzzle = null;
        let score = 0;
        let solvedCount = 0;
        let currentStreak = 0;
        let totalQuestions = 8;
        let currentQuestion = 0;
        let gameStarted = false;
        let hintsUsed = 0;
        let hintShown = false;

        // عناصر DOM
        const fraction1NumeratorElement = document.getElementById('fraction1-numerator');
        const fraction1DenominatorElement = document.getElementById('fraction1-denominator');
        const fraction2NumeratorInput = document.getElementById('fraction2-numerator');
        const fraction2DenominatorInput = document.getElementById('fraction2-denominator');
        const circle1Element = document.getElementById('circle1');
        const circle2Element = document.getElementById('circle2');
        const circle1LabelElement = document.getElementById('circle1-label');
        const circle2LabelElement = document.getElementById('circle2-label');
        const multiplicationHintElement = document.getElementById('multiplication-hint');
        const multiplicationStepsElement = document.getElementById('multiplication-steps');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const showHintButton = document.getElementById('show-hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const solvedCountElement = document.getElementById('solved-count');
        const currentStreakElement = document.getElementById('current-streak');
        const progressDisplayElement = document.getElementById('progress-display');
        const progressBarElement = document.getElementById('progress-bar');
        const completionMessageElement = document.getElementById('completion-message');
        const celebrationElement = document.getElementById('celebration');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            checkButton.addEventListener('click', checkSolution);
            showHintButton.addEventListener('click', toggleHint);
            resetButton.addEventListener('click', resetGame);
            
            // إدخال الإجابة عند الضغط على Enter
            fraction2NumeratorInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') checkSolution();
            });
            fraction2DenominatorInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') checkSolution();
            });
        }

        // بدء اللعبة
        function startGame() {
            gameStarted = true;
            generateNewPuzzle();
        }

        // إنشاء أحجية جديدة
        function generateNewPuzzle() {
            if (currentQuestion >= totalQuestions) {
                endGame();
                return;
            }

            currentQuestion++;
            updateProgress();

            // اختيار أحجية عشوائية
            const index = Math.floor(Math.random() * FRACTION_PUZZLES.length);
            currentPuzzle = {...FRACTION_PUZZLES[index]};

            // تحديث واجهة المستخدم
            updatePuzzleDisplay();
            resetFeedback();
        }

        // تحديث عرض الأحجية
        function updatePuzzleDisplay() {
            // تحديث الكسر الأول
            fraction1NumeratorElement.textContent = currentPuzzle.num1;
            fraction1DenominatorElement.textContent = currentPuzzle.den1;

            // تحديث الكسر الثاني (المدخلات)
            fraction2NumeratorInput.value = '';
            fraction2DenominatorInput.value = '';
            fraction2NumeratorInput.classList.remove('correct', 'incorrect');
            fraction2DenominatorInput.classList.remove('correct', 'incorrect');

            // إعداد الحقول المناسبة
            if (currentPuzzle.missing === 'numerator') {
                fraction2NumeratorInput.placeholder = '؟';
                fraction2NumeratorInput.disabled = false;
                fraction2DenominatorInput.value = currentPuzzle.den2;
                fraction2DenominatorInput.disabled = true;
                fraction2DenominatorInput.classList.remove('missing-part');
                fraction2NumeratorInput.classList.add('missing-part');
            } else {
                fraction2DenominatorInput.placeholder = '؟';
                fraction2DenominatorInput.disabled = false;
                fraction2NumeratorInput.value = currentPuzzle.num2;
                fraction2NumeratorInput.disabled = true;
                fraction2NumeratorInput.classList.remove('missing-part');
                fraction2DenominatorInput.classList.add('missing-part');
            }

            // تحديث التمثيل البصري
            updateVisualRepresentation();

            // إخفاء التلميح
            multiplicationHintElement.style.display = 'none';
            hintShown = false;
            showHintButton.textContent = 'اظهر التلميح';

            // التركيز على الحقل المناسب
            if (currentPuzzle.missing === 'numerator') {
                fraction2NumeratorInput.focus();
            } else {
                fraction2DenominatorInput.focus();
            }
        }

        // تحديث التمثيل البصري
        function updateVisualRepresentation() {
            const fraction1Value = currentPuzzle.num1 / currentPuzzle.den1;
            circle1Element.style.setProperty('--filled', fraction1Value);
            circle1LabelElement.textContent = `${currentPuzzle.num1}/${currentPuzzle.den1}`;

            // تحديث الكسر الثاني بناءً على الإدخال
            let fraction2Value = fraction1Value;
            circle2Element.style.setProperty('--filled', fraction2Value);
            
            if (currentPuzzle.missing === 'numerator') {
                circle2LabelElement.textContent = `؟/${currentPuzzle.den2}`;
            } else {
                circle2LabelElement.textContent = `${currentPuzzle.num2}/؟`;
            }
        }

        // تبديل عرض التلميح
        function toggleHint() {
            hintShown = !hintShown;
            
            if (hintShown) {
                showHint();
                showHintButton.textContent = 'إخفاء التلميح';
            } else {
                multiplicationHintElement.style.display = 'none';
                showHintButton.textContent = 'اظهر التلميح';
            }
        }

        // عرض التلميح
        function showHint() {
            if (hintsUsed >= 4) {
                feedbackElement.textContent = '⚠️ لقد استخدمت جميع التلميحات المتاحة!';
                feedbackElement.className = 'feedback info';
                return;
            }

            hintsUsed++;
            score = Math.max(0, score - 25);
            updateStats();

            multiplicationHintElement.style.display = 'block';
            
            let stepsHTML = '';
            let multiplier = 0;

            if (currentPuzzle.missing === 'numerator') {
                multiplier = currentPuzzle.den2 / currentPuzzle.den1;
                stepsHTML = `
                    <div class="step">
                        <div class="step-number">الخطوة 1</div>
                        <div class="step-value">${currentPuzzle.den1} → ${currentPuzzle.den2}</div>
                        <div>المقام ضرب ${multiplier}</div>
                    </div>
                    <div class="step">
                        <div class="step-number">الخطوة 2</div>
                        <div class="step-value">${currentPuzzle.num1} × ${multiplier}</div>
                        <div>نفس العملية للبسط</div>
                    </div>
                    <div class="step">
                        <div class="step-number">الخطوة 3</div>
                        <div class="step-value">= ${currentPuzzle.num1 * multiplier}</div>
                        <div>الإجابة النهائية</div>
                    </div>
                `;
            } else {
                multiplier = currentPuzzle.num2 / currentPuzzle.num1;
                stepsHTML = `
                    <div class="step">
                        <div class="step-number">الخطوة 1</div>
                        <div class="step-value">${currentPuzzle.num1} → ${currentPuzzle.num2}</div>
                        <div>البسط ضرب ${multiplier}</div>
                    </div>
                    <div class="step">
                        <div class="step-number">الخطوة 2</div>
                        <div class="step-value">${currentPuzzle.den1} × ${multiplier}</div>
                        <div>نفس العملية للمقام</div>
                    </div>
                    <div class="step">
                        <div class="step-number">الخطوة 3</div>
                        <div class="step-value">= ${currentPuzzle.den1 * multiplier}</div>
                        <div>الإجابة النهائية</div>
                    </div>
                `;
            }

            multiplicationStepsElement.innerHTML = stepsHTML;
        }

        // التحقق من الحل
        function checkSolution() {
            let userAnswer, correctAnswer;

            if (currentPuzzle.missing === 'numerator') {
                userAnswer = parseInt(fraction2NumeratorInput.value);
                correctAnswer = (currentPuzzle.num1 * currentPuzzle.den2) / currentPuzzle.den1;
            } else {
                userAnswer = parseInt(fraction2DenominatorInput.value);
                correctAnswer = (currentPuzzle.den1 * currentPuzzle.num2) / currentPuzzle.num1;
            }

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = '⚠️ الرجاء إدخال إجابة صحيحة!';
                feedbackElement.className = 'feedback incorrect';
                return;
            }

            if (userAnswer === correctAnswer) {
                handleCorrectSolution();
            } else {
                handleIncorrectSolution();
            }
        }

        // معالجة الحل الصحيح
        function handleCorrectSolution() {
            score += 100;
            solvedCount++;
            currentStreak++;
            updateStats();

            // تلوين الحقل بالإجابة الصحيحة
            if (currentPuzzle.missing === 'numerator') {
                fraction2NumeratorInput.classList.add('correct');
            } else {
                fraction2DenominatorInput.classList.add('correct');
            }

            feedbackElement.textContent = '🎉 أحسنت! الإجابة صحيحة!';
            feedbackElement.className = 'feedback correct';

            // تحديث التمثيل البصري
            updateVisualRepresentationWithAnswer();

            // تأثير التتابع
            if (currentStreak >= 3) {
                celebrate();
            }

            // الانتقال إلى السؤال التالي بعد تأخير
            setTimeout(generateNewPuzzle, 2000);
        }

        // تحديث التمثيل البصري بالإجابة
        function updateVisualRepresentationWithAnswer() {
            let numerator, denominator;
            
            if (currentPuzzle.missing === 'numerator') {
                numerator = parseInt(fraction2NumeratorInput.value);
                denominator = currentPuzzle.den2;
            } else {
                numerator = currentPuzzle.num2;
                denominator = parseInt(fraction2DenominatorInput.value);
            }
            
            circle2LabelElement.textContent = `${numerator}/${denominator}`;
        }

        // معالجة الحل الخاطئ
        function handleIncorrectSolution() {
            score = Math.max(0, score - 50);
            currentStreak = 0;
            updateStats();

            // تلوين الحقل بالإجابة الخاطئة
            if (currentPuzzle.missing === 'numerator') {
                fraction2NumeratorInput.classList.add('incorrect');
            } else {
                fraction2DenominatorInput.classList.add('incorrect');
            }

            feedbackElement.textContent = '❌ إجابة خاطئة! حاول مرة أخرى';
            feedbackElement.className = 'feedback incorrect';
            
            // التركيز على الحقل المناسب
            if (currentPuzzle.missing === 'numerator') {
                fraction2NumeratorInput.focus();
            } else {
                fraction2DenominatorInput.focus();
            }
        }

        // نهاية اللعبة
        function endGame() {
            gameStarted = false;
            checkButton.disabled = true;
            showHintButton.disabled = true;

            const percentage = (solvedCount / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أنت خبير في الكسور المتكافئة! ${solvedCount}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 أحسنت! مهاراتك في الكسور ممتازة ${solvedCount}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 جيد! واصل التدرب على الكسور ${solvedCount}/${totalQuestions}`;
            } else {
                message = `📚 راجع مفهوم الكسور المتكافئة! ${solvedCount}/${totalQuestions}`;
            }

            completionMessageElement.style.display = 'block';
            completionMessageElement.textContent = message;

            celebrate();
        }

        // إعادة تعيين اللعبة
        function resetGame() {
            score = 0;
            solvedCount = 0;
            currentStreak = 0;
            currentQuestion = 0;
            hintsUsed = 0;
            hintShown = false;
            gameStarted = true;

            updateStats();
            updateProgress();
            checkButton.disabled = false;
            showHintButton.disabled = false;
            showHintButton.textContent = 'اظهر التلميح';
            completionMessageElement.style.display = 'none';
            multiplicationHintElement.style.display = 'none';

            generateNewPuzzle();
        }

        // إعادة تعيين التغذية الراجعة
        function resetFeedback() {
            feedbackElement.textContent = 'أدخل القيم المفقودة في الكسور المتكافئة!';
            feedbackElement.className = 'feedback info';
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            solvedCountElement.textContent = solvedCount;
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