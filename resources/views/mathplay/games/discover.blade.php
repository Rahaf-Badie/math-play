<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مستكشف الأعداد الكسرية - {{ $lesson_game->lesson->name }}</title>
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
            position: relative;
        }

        /* زر الرجوع إلى الدرس */
        .back-to-lesson {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #e17055 0%, #d63031 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .back-to-lesson:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #d63031 0%, #c23616 100%);
        }

        .lesson-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.4rem;
            font-weight: bold;
            margin-top: 10px;
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

        .mixed-number-area {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin: 30px 0;
        }

        @media (max-width: 768px) {
            .mixed-number-area {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .back-to-lesson {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 15px;
                width: 100%;
                justify-content: center;
            }
        }

        .visual-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #3498db;
        }

        .section-title {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .mixed-number-display {
            font-size: 3rem;
            font-weight: bold;
            color: #e74c3c;
            margin: 25px 0;
            direction: ltr;
            text-align: center;
        }

        .visual-representation {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .whole-parts {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .whole-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            border: 3px solid #2471a3;
        }

        .fraction-part {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .fraction-circle {
            width: 80px;
            height: 80px;
            background: conic-gradient(
                #f39c12 0% calc(var(--filled) * 100%),
                #ecf0f1 calc(var(--filled) * 100%) 100%
            );
            border-radius: 50%;
            border: 3px solid #d35400;
            position: relative;
        }

        .fraction-text {
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .interactive-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #2ecc71;
        }

        .number-parts {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .number-input {
            width: 80px;
            height: 80px;
            font-size: 2rem;
            text-align: center;
            border: 3px solid #3498db;
            border-radius: 10px;
            outline: none;
            font-weight: bold;
            transition: all 0.3s;
        }

        .number-input:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 10px rgba(116, 185, 255, 0.5);
            transform: scale(1.05);
        }

        .number-label {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 10px;
        }

        .plus-sign {
            font-size: 2rem;
            font-weight: bold;
            color: #e74c3c;
            margin: 0 10px;
        }

        .conversion-section {
            background: #e8f6f3;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            border-right: 4px solid #1abc9c;
        }

        .conversion-title {
            font-weight: bold;
            color: #3498db;
            margin-bottom: 15px;
        }

        .conversion-steps {
            text-align: right;
            line-height: 1.8;
        }

        .step {
            margin-bottom: 10px;
            padding: 8px;
            background: white;
            border-radius: 8px;
            border-right: 3px solid #3498db;
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

        #show-conversion-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
        }

        #reset-btn {
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

        .mixed-number-parts {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        .part-box {
            padding: 15px 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px solid #bdc3c7;
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- زر الرجوع إلى الدرس -->
        <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-to-lesson">
            ← الرجوع إلى الدرس
        </a>

        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>مستكشف الأعداد الكسرية 🧮</h3>
            <p>🎯 تعرف على مكونات العدد الكسري وكيفية كتابته</p>
            <p>💡 العدد الكسري يتكون من جزء صحيح وجزء كسري</p>
            <p>✨ استخدم التمثيل البصري لفهم العلاقة بين الأجزاء</p>
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

            <!-- منطقة العدد الكسري -->
            <div class="mixed-number-area">
                <!-- القسم البصري -->
                <div class="visual-section">
                    <div class="section-title">التمثيل البصري للعدد الكسري</div>

                    <div class="mixed-number-display" id="mixed-number-display">
                        2 ¾
                    </div>

                    <div class="visual-representation">
                        <div class="whole-parts" id="whole-parts">
                            <!-- سيتم تعبئتها ديناميكياً -->
                        </div>

                        <div class="fraction-part">
                            <div class="fraction-circle" id="fraction-circle" style="--filled: 0.75"></div>
                            <div class="fraction-text" id="fraction-text">¾</div>
                        </div>
                    </div>

                    <div class="mixed-number-parts">
                        <div class="part-box">الجزء الصحيح</div>
                        <div class="part-box">+</div>
                        <div class="part-box">الجزء الكسري</div>
                    </div>
                </div>

                <!-- القسم التفاعلي -->
                <div class="interactive-section">
                    <div class="section-title">اكتب العدد الكسري</div>

                    <div class="number-parts">
                        <div>
                            <input type="number" id="whole-part-input" class="number-input" placeholder="0" min="0">
                            <div class="number-label">الجزء الصحيح</div>
                        </div>

                        <div class="plus-sign">+</div>

                        <div>
                            <input type="number" id="numerator-input" class="number-input" placeholder="بسط" min="1">
                            <div class="number-label">البسط</div>
                        </div>

                        <div style="font-size: 2rem; margin: 0 5px;">/</div>

                        <div>
                            <input type="number" id="denominator-input" class="number-input" placeholder="مقام" min="1">
                            <div class="number-label">المقام</div>
                        </div>
                    </div>

                    <!-- قسم التحويل -->
                    <div class="conversion-section" id="conversion-section" style="display: none;">
                        <div class="conversion-title">💡 كيف نحول العدد الكسري إلى كسر غير فعلي؟</div>
                        <div class="conversion-steps" id="conversion-steps">
                            <!-- سيتم تعبئتها ديناميكياً -->
                        </div>
                    </div>

                    <!-- عناصر التحكم -->
                    <div class="controls">
                        <button id="check-btn">تحقق</button>
                        <button id="show-conversion-btn">اظهر التحويل</button>
                        <button id="hint-btn">مساعدة</button>
                        <button id="reset-btn">سؤال جديد</button>
                    </div>

                    <!-- التغذية الراجعة -->
                    <div class="feedback" id="feedback">اكتب العدد الكسري بناءً على التمثيل البصري!</div>
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // بيانات الأعداد الكسرية
        const MIXED_NUMBERS = [
            { whole: 1, numerator: 1, denominator: 2 },
            { whole: 2, numerator: 3, denominator: 4 },
            { whole: 3, numerator: 1, denominator: 3 },
            { whole: 1, numerator: 2, denominator: 5 },
            { whole: 2, numerator: 1, denominator: 4 },
            { whole: 1, numerator: 3, denominator: 8 },
            { whole: 3, numerator: 2, denominator: 3 },
            { whole: 2, numerator: 2, denominator: 5 }
        ];

        // المتغيرات الأساسية
        let currentNumber = null;
        let score = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalQuestions = 8;
        let currentQuestion = 0;
        let gameStarted = false;
        let hintsUsed = 0;
        let conversionShown = false;

        // عناصر DOM
        const mixedNumberDisplayElement = document.getElementById('mixed-number-display');
        const wholePartsElement = document.getElementById('whole-parts');
        const fractionCircleElement = document.getElementById('fraction-circle');
        const fractionTextElement = document.getElementById('fraction-text');
        const wholePartInput = document.getElementById('whole-part-input');
        const numeratorInput = document.getElementById('numerator-input');
        const denominatorInput = document.getElementById('denominator-input');
        const conversionSectionElement = document.getElementById('conversion-section');
        const conversionStepsElement = document.getElementById('conversion-steps');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const showConversionButton = document.getElementById('show-conversion-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const progressDisplayElement = document.getElementById('progress-display');
        const progressBarElement = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            checkButton.addEventListener('click', checkAnswer);
            showConversionButton.addEventListener('click', toggleConversion);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', resetGame);

            // إدخال الإجابة عند الضغط على Enter
            wholePartInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') checkAnswer();
            });
            numeratorInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') checkAnswer();
            });
            denominatorInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') checkAnswer();
            });
        }

        // بدء اللعبة
        function startGame() {
            gameStarted = true;
            generateNewNumber();
        }

        // توليد عدد كسري جديد
        function generateNewNumber() {
            if (currentQuestion >= totalQuestions) {
                endGame();
                return;
            }

            currentQuestion++;
            updateProgress();

            // اختيار عدد كسري عشوائي
            const index = Math.floor(Math.random() * MIXED_NUMBERS.length);
            currentNumber = {...MIXED_NUMBERS[index]};

            // تحديث واجهة المستخدم
            updateVisualDisplay();
            resetInputs();
            resetFeedback();
        }

        // تحديث العرض البصري
        function updateVisualDisplay() {
            // تحديث عرض العدد الكسري
            mixedNumberDisplayElement.textContent = `${currentNumber.whole} ${currentNumber.numerator}/${currentNumber.denominator}`;

            // تحديث الأجزاء الصحيحة
            wholePartsElement.innerHTML = '';
            for (let i = 0; i < currentNumber.whole; i++) {
                const wholeCircle = document.createElement('div');
                wholeCircle.className = 'whole-circle';
                wholeCircle.textContent = '1';
                wholePartsElement.appendChild(wholeCircle);
            }

            // تحديث الجزء الكسري
            const fractionValue = currentNumber.numerator / currentNumber.denominator;
            fractionCircleElement.style.setProperty('--filled', fractionValue);
            fractionTextElement.textContent = `${currentNumber.numerator}/${currentNumber.denominator}`;
        }

        // إعادة تعيين المدخلات
        function resetInputs() {
            wholePartInput.value = '';
            numeratorInput.value = '';
            denominatorInput.value = '';
            wholePartInput.disabled = false;
            numeratorInput.disabled = false;
            denominatorInput.disabled = false;

            // إخفاء قسم التحويل
            conversionSectionElement.style.display = 'none';
            conversionShown = false;
            showConversionButton.textContent = 'اظهر التحويل';

            // التركيز على أول حقل إدخال
            wholePartInput.focus();
        }

        // تبديل عرض التحويل
        function toggleConversion() {
            conversionShown = !conversionShown;

            if (conversionShown) {
                showConversion();
                showConversionButton.textContent = 'إخفاء التحويل';
            } else {
                conversionSectionElement.style.display = 'none';
                showConversionButton.textContent = 'اظهر التحويل';
            }
        }

        // عرض عملية التحويل
        function showConversion() {
            conversionSectionElement.style.display = 'block';

            const improperNumerator = (currentNumber.whole * currentNumber.denominator) + currentNumber.numerator;
            const improperDenominator = currentNumber.denominator;

            const stepsHTML = `
                <div class="step">الخطوة 1: نضرب الجزء الصحيح في المقام</div>
                <div class="step">${currentNumber.whole} × ${currentNumber.denominator} = ${currentNumber.whole * currentNumber.denominator}</div>
                <div class="step">الخطوة 2: نضيف البسط</div>
                <div class="step">${currentNumber.whole * currentNumber.denominator} + ${currentNumber.numerator} = ${improperNumerator}</div>
                <div class="step">الخطوة 3: نكتب الكسر غير الفعلي</div>
                <div class="step">${currentNumber.whole} ${currentNumber.numerator}/${currentNumber.denominator} = ${improperNumerator}/${improperDenominator}</div>
            `;

            conversionStepsElement.innerHTML = stepsHTML;
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userWhole = parseInt(wholePartInput.value);
            const userNumerator = parseInt(numeratorInput.value);
            const userDenominator = parseInt(denominatorInput.value);

            if (isNaN(userWhole) || isNaN(userNumerator) || isNaN(userDenominator)) {
                feedbackElement.textContent = '⚠️ الرجاء إدخال جميع القيم!';
                feedbackElement.className = 'feedback incorrect';
                return;
            }

            if (userWhole === currentNumber.whole &&
                userNumerator === currentNumber.numerator &&
                userDenominator === currentNumber.denominator) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            score += 100;
            correctAnswers++;
            currentStreak++;
            updateStats();

            feedbackElement.textContent = '🎉 أحسنت! الإجابة صحيحة!';
            feedbackElement.className = 'feedback correct';

            // تعطيل المدخلات
            wholePartInput.disabled = true;
            numeratorInput.disabled = true;
            denominatorInput.disabled = true;

            // تأثير التتابع
            if (currentStreak >= 3) {
                celebrate();
            }

            // الانتقال إلى السؤال التالي بعد تأخير
            setTimeout(generateNewNumber, 2000);
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            score = Math.max(0, score - 50);
            currentStreak = 0;
            updateStats();

            feedbackElement.textContent = '❌ إجابة خاطئة! حاول مرة أخرى';
            feedbackElement.className = 'feedback incorrect';

            // التركيز على أول حقل إدخال
            wholePartInput.focus();
        }

        // عرض مساعدة
        function showHint() {
            if (hintsUsed >= 3) {
                feedbackElement.textContent = '⚠️ لقد استخدمت جميع المساعدات المتاحة!';
                feedbackElement.className = 'feedback info';
                return;
            }

            hintsUsed++;
            score = Math.max(0, score - 25);
            updateStats();

            let hintMessage = '';

            if (hintsUsed === 1) {
                hintMessage = `💡 انظر إلى عدد الدوائر الزرقاء (الجزء الصحيح): ${currentNumber.whole}`;
            } else if (hintsUsed === 2) {
                hintMessage = `💡 انظر إلى الجزء البرتقالي في الدائرة (الجزء الكسري): ${currentNumber.numerator}/${currentNumber.denominator}`;
            } else {
                hintMessage = `💡 العدد الكسري هو: ${currentNumber.whole} و ${currentNumber.numerator}/${currentNumber.denominator}`;
            }

            feedbackElement.textContent = hintMessage;
            feedbackElement.className = 'feedback info';
        }

        // نهاية اللعبة
        function endGame() {
            gameStarted = false;
            checkButton.disabled = true;
            showConversionButton.disabled = true;
            hintButton.disabled = true;

            const percentage = (correctAnswers / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أنت خبير في الأعداد الكسرية! ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 أحسنت! مهاراتك في الأعداد الكسرية ممتازة ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 جيد! واصل التدرب على الأعداد الكسرية ${correctAnswers}/${totalQuestions}`;
            } else {
                message = `📚 راجع مفهوم الأعداد الكسرية! ${correctAnswers}/${totalQuestions}`;
            }

            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback correct';

            celebrate();
        }

        // إعادة تعيين اللعبة
        function resetGame() {
            score = 0;
            correctAnswers = 0;
            currentStreak = 0;
            currentQuestion = 0;
            hintsUsed = 0;
            conversionShown = false;
            gameStarted = true;

            updateStats();
            updateProgress();
            checkButton.disabled = false;
            showConversionButton.disabled = false;
            hintButton.disabled = false;
            showConversionButton.textContent = 'اظهر التحويل';

            generateNewNumber();
        }

        // إعادة تعيين التغذية الراجعة
        function resetFeedback() {
            feedbackElement.textContent = 'اكتب العدد الكسري بناءً على التمثيل البصري!';
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
