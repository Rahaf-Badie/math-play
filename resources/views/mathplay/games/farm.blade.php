<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مزرعة الأعداد الكسرية - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
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
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
            text-decoration: none;
            color: white;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.2rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }

        .game-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .info-card {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            border: 3px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .info-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2d3436;
        }

        .instructions {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            color: #2d3436;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
            border: 2px dashed #fd7e14;
        }

        .game-area {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .visual-section, .interaction-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 20px;
            border: 3px solid #e9ecef;
        }

        .section-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
            font-weight: bold;
            font-size: 1.3rem;
        }

        .number-farm {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .mixed-number {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 15px;
            border-radius: 15px;
            border: 3px solid #74b9ff;
            box-shadow: 0 5px 15px rgba(116, 185, 255, 0.3);
        }

        .whole-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #e84393;
            min-width: 60px;
            text-align: center;
        }

        .fraction-part {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 70px;
        }

        .numerator, .denominator {
            width: 100%;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .numerator {
            background: #74b9ff;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .denominator {
            background: #0984e3;
            color: white;
            border-top: 2px solid white;
            border-radius: 0 0 8px 8px;
        }

        .operation-display {
            font-size: 3rem;
            color: #00b894;
            font-weight: bold;
            min-width: 50px;
            text-align: center;
        }

        .input-section {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 15px;
            align-items: center;
            margin: 25px 0;
        }

        .number-input {
            width: 100%;
            padding: 15px;
            border: 3px solid #a29bfe;
            border-radius: 15px;
            font-size: 1.5rem;
            text-align: center;
            outline: none;
            transition: all 0.3s ease;
        }

        .number-input:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
        }

        .input-separator {
            font-size: 2rem;
            font-weight: bold;
            color: #636e72;
            text-align: center;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .game-button {
            padding: 15px 25px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #show-steps-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
        }

        .game-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .feedback {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.2rem;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .feedback.success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback.error {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .steps-container {
            background: #e9f7ef;
            border: 2px solid #00b894;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            display: none;
        }

        .step {
            margin: 10px 0;
            padding: 12px;
            background: white;
            border-radius: 8px;
            border-right: 4px solid #00b894;
            font-size: 1rem;
        }

        .score-board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .score-card {
            background: linear-gradient(135deg, #fdcbf1 0%, #e6dee9 100%);
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            border: 2px solid #fff;
        }

        .score-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .score-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .game-area {
                grid-template-columns: 1fr;
            }

            .game-info, .score-board {
                grid-template-columns: 1fr;
            }

            .number-farm {
                flex-direction: column;
                gap: 15px;
            }

            .input-section {
                grid-template-columns: 1fr;
            }

            .controls {
                flex-direction: column;
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
            <div>
                <h1 class="lesson-title">🏡 مزرعة الأعداد الكسرية</h1>
                <p style="text-align: center; color: #636e72;">{{ $lesson_game->lesson->name }}</p>
            </div>
        </div>

        <div class="game-info">
            <div class="info-card">
                <div class="info-label">نوع العملية</div>
                <div class="info-value" id="operation-type">
                    {{ $operation_type == 'addition' ? 'جمع الأعداد الكسرية' : 'طرح الأعداد الكسرية' }}
                </div>
            </div>
            <div class="info-card">
                <div class="info-label">المستوى</div>
                <div class="info-value">الصف الرابع</div>
            </div>
            <div class="info-card">
                <div class="info-label">المدى</div>
                <div class="info-value">{{ $min_range }} - {{ $max_range }}</div>
            </div>
        </div>

        <div class="instructions">
            <h3>📚 كيف نحل الأعداد الكسرية؟</h3>
            <p><strong>العدد الكسري = عدد صحيح + كسر عادي</strong></p>
            <p><strong>التحويل إلى كسر عادي:</strong> (المقام × العدد الصحيح) + البسط</p>
            <p>مثال: 2½ = (2 × 2) + 1 = 5/2</p>
        </div>

        <div class="game-area">
            <div class="visual-section">
                <div class="section-title">🧮 المسألة الحالية</div>
                <div class="number-farm">
                    <div class="mixed-number">
                        <div class="whole-number" id="whole1">0</div>
                        <div class="fraction-part">
                            <div class="numerator" id="num1">0</div>
                            <div class="denominator" id="den1">1</div>
                        </div>
                    </div>

                    <div class="operation-display" id="operation-sign">
                        {{ $operation_type == 'addition' ? '+' : '-' }}
                    </div>

                    <div class="mixed-number">
                        <div class="whole-number" id="whole2">0</div>
                        <div class="fraction-part">
                            <div class="numerator" id="num2">0</div>
                            <div class="denominator" id="den2">1</div>
                        </div>
                    </div>

                    <div class="operation-display">=</div>
                </div>

                <div class="steps-container" id="steps-container">
                    <h4>📝 خطوات الحل:</h4>
                    <div class="step" id="step1"></div>
                    <div class="step" id="step2"></div>
                    <div class="step" id="step3"></div>
                    <div class="step" id="step4"></div>
                </div>
            </div>

            <div class="interaction-section">
                <div class="section-title">🎯 أدخل الإجابة</div>

                <div class="input-section">
                    <input type="number" class="number-input" id="answer-whole" placeholder="العدد الصحيح" min="0">
                    <div class="input-separator">و</div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <input type="number" class="number-input" id="answer-num" placeholder="البسط" min="0">
                        <input type="number" class="number-input" id="answer-den" placeholder="المقام" min="1">
                    </div>
                </div>

                <div class="controls">
                    <button class="game-button" id="check-btn">
                        <i class="fas fa-check-circle"></i>
                        تحقق
                    </button>
                    <button class="game-button" id="show-steps-btn">
                        <i class="fas fa-lightbulb"></i>
                        عرض الخطوات
                    </button>
                    <button class="game-button" id="reset-btn">
                        <i class="fas fa-sync-alt"></i>
                        جديدة
                    </button>
                </div>

                <div class="feedback" id="feedback">
                    <i class="fas fa-play-circle"></i>
                    ابدأ بحل المسألة!
                </div>

                <div class="score-board">
                    <div class="score-card">
                        <div class="score-value" id="score">0</div>
                        <div class="score-label">النقاط</div>
                    </div>
                    <div class="score-card">
                        <div class="score-value" id="correct-count">0</div>
                        <div class="score-label">الإجابات الصحيحة</div>
                    </div>
                    <div class="score-card">
                        <div class="score-value" id="streak">0</div>
                        <div class="score-label">التوالي</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        const operationType = "{{ $operation_type }}";

        // متغيرات اللعبة
        let currentProblem = null;
        let score = 0;
        let correctCount = 0;
        let currentStreak = 0;

        // عناصر DOM
        const whole1Element = document.getElementById('whole1');
        const num1Element = document.getElementById('num1');
        const den1Element = document.getElementById('den1');
        const whole2Element = document.getElementById('whole2');
        const num2Element = document.getElementById('num2');
        const den2Element = document.getElementById('den2');
        const answerWholeInput = document.getElementById('answer-whole');
        const answerNumInput = document.getElementById('answer-num');
        const answerDenInput = document.getElementById('answer-den');
        const checkButton = document.getElementById('check-btn');
        const showStepsButton = document.getElementById('show-steps-btn');
        const resetButton = document.getElementById('reset-btn');
        const feedbackElement = document.getElementById('feedback');
        const stepsContainer = document.getElementById('steps-container');
        const scoreElement = document.getElementById('score');
        const correctCountElement = document.getElementById('correct-count');
        const streakElement = document.getElementById('streak');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            generateProblem();
            setupEventListeners();
        });

        function setupEventListeners() {
            checkButton.addEventListener('click', checkAnswer);
            showStepsButton.addEventListener('click', showSolutionSteps);
            resetButton.addEventListener('click', generateProblem);

            // إدخال الأرقام فقط
            [answerWholeInput, answerNumInput, answerDenInput].forEach(input => {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        }

        function generateProblem() {
            // إخفاء التغذية الراجعة والخطوات
            feedbackElement.className = 'feedback';
            feedbackElement.innerHTML = '<i class="fas fa-play-circle"></i> ابدأ بحل المسألة!';
            stepsContainer.style.display = 'none';

            // توليد أعداد كسرية عشوائية
            const whole1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            const whole2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            const denominator = getRandomDenominator();
            const numerator1 = getRandomNumerator(denominator);
            let numerator2 = getRandomNumerator(denominator);

            // التأكد من أن عملية الطرح تعطي نتيجة موجبة
            if (operationType === 'subtraction') {
                const total1 = whole1 + numerator1/denominator;
                const total2 = whole2 + numerator2/denominator;
                if (total1 < total2) {
                    // تبديل الأعداد إذا كانت النتيجة سالبة
                    [whole1, whole2] = [whole2, whole1];
                    [numerator1, numerator2] = [numerator2, numerator1];
                }
            }

            currentProblem = {
                whole1,
                numerator1,
                denominator1: denominator,
                whole2,
                numerator2,
                denominator2: denominator,
                operation: operationType
            };

            // حساب الإجابة الصحيحة
            calculateCorrectAnswer();

            // عرض المسألة
            displayProblem();

            // مسح حقول الإدخال
            answerWholeInput.value = '';
            answerNumInput.value = '';
            answerDenInput.value = '';
            answerWholeInput.focus();
        }

        function displayProblem() {
            whole1Element.textContent = currentProblem.whole1;
            num1Element.textContent = currentProblem.numerator1;
            den1Element.textContent = currentProblem.denominator1;

            whole2Element.textContent = currentProblem.whole2;
            num2Element.textContent = currentProblem.numerator2;
            den2Element.textContent = currentProblem.denominator2;
        }

        function calculateCorrectAnswer() {
            if (operationType === 'addition') {
                // جمع الأعداد الكسرية
                let totalWhole = currentProblem.whole1 + currentProblem.whole2;
                let totalNumerator = currentProblem.numerator1 + currentProblem.numerator2;
                let totalDenominator = currentProblem.denominator1;

                // تحويل الكسور غير الحقيقية إلى أعداد كسرية
                if (totalNumerator >= totalDenominator) {
                    const extraWhole = Math.floor(totalNumerator / totalDenominator);
                    totalWhole += extraWhole;
                    totalNumerator = totalNumerator % totalDenominator;
                }

                // تبسيط الكسر
                const simplified = simplifyFraction(totalNumerator, totalDenominator);

                currentProblem.correctAnswer = {
                    whole: totalWhole,
                    numerator: simplified.numerator,
                    denominator: simplified.denominator
                };
            } else {
                // طرح الأعداد الكسرية
                // تحويل إلى كسور غير حقيقية أولاً
                const improper1 = currentProblem.whole1 * currentProblem.denominator1 + currentProblem.numerator1;
                const improper2 = currentProblem.whole2 * currentProblem.denominator2 + currentProblem.numerator2;

                let resultNumerator = improper1 - improper2;
                const resultDenominator = currentProblem.denominator1;

                // تحويل النتيجة إلى عدد كسري
                const resultWhole = Math.floor(resultNumerator / resultDenominator);
                resultNumerator = resultNumerator % resultDenominator;

                // تبسيط الكسر
                const simplified = simplifyFraction(resultNumerator, resultDenominator);

                currentProblem.correctAnswer = {
                    whole: resultWhole,
                    numerator: simplified.numerator,
                    denominator: simplified.denominator
                };
            }
        }

        function checkAnswer() {
            const userWhole = parseInt(answerWholeInput.value) || 0;
            const userNum = parseInt(answerNumInput.value) || 0;
            const userDen = parseInt(answerDenInput.value) || 1;

            if (userDen === 0) {
                showFeedback('<i class="fas fa-exclamation-circle"></i> المقام لا يمكن أن يكون صفراً!', 'error');
                return;
            }

            const isCorrect =
                userWhole === currentProblem.correctAnswer.whole &&
                userNum === currentProblem.correctAnswer.numerator &&
                userDen === currentProblem.correctAnswer.denominator;

            if (isCorrect) {
                currentStreak++;
                correctCount++;
                score += 10 + (currentStreak * 2); // نقاط إضافية للتوالي

                showFeedback(`<i class="fas fa-trophy"></i> إجابة صحيحة! ${currentStreak > 1 ? `توالي ${currentStreak}!` : ''}`, 'success');
                updateScore();

                // توليد مسألة جديدة بعد ثانيتين
                setTimeout(generateProblem, 2000);
            } else {
                currentStreak = 0;
                score = Math.max(0, score - 5);
                showFeedback('<i class="fas fa-times-circle"></i> إجابة خاطئة! حاول مرة أخرى أو انقر على "عرض الخطوات"', 'error');
                updateScore();
            }
        }

        function showSolutionSteps() {
            stepsContainer.style.display = 'block';

            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const step3 = document.getElementById('step3');
            const step4 = document.getElementById('step4');

            if (operationType === 'addition') {
                step1.innerHTML = `<strong>الخطوة 1:</strong> جمع الأعداد الصحيحة: ${currentProblem.whole1} + ${currentProblem.whole2} = ${currentProblem.whole1 + currentProblem.whole2}`;
                step2.innerHTML = `<strong>الخطوة 2:</strong> جمع الكسور: ${currentProblem.numerator1}/${currentProblem.denominator1} + ${currentProblem.numerator2}/${currentProblem.denominator2} = ${currentProblem.numerator1 + currentProblem.numerator2}/${currentProblem.denominator1}`;

                let step3Text = '';
                let step4Text = '';

                if (currentProblem.numerator1 + currentProblem.numerator2 >= currentProblem.denominator1) {
                    const extraWhole = Math.floor((currentProblem.numerator1 + currentProblem.numerator2) / currentProblem.denominator1);
                    const remainingNumerator = (currentProblem.numerator1 + currentProblem.numerator2) % currentProblem.denominator1;
                    step3Text = `<strong>الخطوة 3:</strong> تحويل الكسر غير الحقيقي: ${currentProblem.numerator1 + currentProblem.numerator2}/${currentProblem.denominator1} = ${extraWhole} و ${remainingNumerator}/${currentProblem.denominator1}`;
                    step4Text = `<strong>الخطوة 4:</strong> الجمع النهائي: ${currentProblem.whole1 + currentProblem.whole2} + ${extraWhole} = ${currentProblem.correctAnswer.whole} و ${currentProblem.correctAnswer.numerator}/${currentProblem.correctAnswer.denominator}`;
                } else {
                    step3Text = `<strong>الخطوة 3:</strong> الكسر الناتج صحيح (أصغر من 1)`;
                    step4Text = `<strong>الخطوة 4:</strong> الناتج النهائي: ${currentProblem.correctAnswer.whole} و ${currentProblem.correctAnswer.numerator}/${currentProblem.correctAnswer.denominator}`;
                }

                step3.innerHTML = step3Text;
                step4.innerHTML = step4Text;
            } else {
                step1.innerHTML = `<strong>الخطوة 1:</strong> تحويل إلى كسور غير حقيقية:<br>${currentProblem.whole1} ${currentProblem.numerator1}/${currentProblem.denominator1} = ${currentProblem.whole1 * currentProblem.denominator1 + currentProblem.numerator1}/${currentProblem.denominator1}`;
                step2.innerHTML = `<strong>الخطوة 2:</strong> ${currentProblem.whole2} ${currentProblem.numerator2}/${currentProblem.denominator2} = ${currentProblem.whole2 * currentProblem.denominator2 + currentProblem.numerator2}/${currentProblem.denominator2}`;
                step3.innerHTML = `<strong>الخطوة 3:</strong> طرح الكسور: ${currentProblem.whole1 * currentProblem.denominator1 + currentProblem.numerator1}/${currentProblem.denominator1} - ${currentProblem.whole2 * currentProblem.denominator2 + currentProblem.numerator2}/${currentProblem.denominator2} = ${(currentProblem.whole1 * currentProblem.denominator1 + currentProblem.numerator1) - (currentProblem.whole2 * currentProblem.denominator2 + currentProblem.numerator2)}/${currentProblem.denominator1}`;
                step4.innerHTML = `<strong>الخطوة 4:</strong> تحويل إلى عدد كسري: ${currentProblem.correctAnswer.whole} و ${currentProblem.correctAnswer.numerator}/${currentProblem.correctAnswer.denominator}`;
            }
        }

        function showFeedback(message, type) {
            feedbackElement.innerHTML = message;
            feedbackElement.className = `feedback ${type}`;
        }

        function updateScore() {
            scoreElement.textContent = score;
            correctCountElement.textContent = correctCount;
            streakElement.textContent = currentStreak;
        }

        // دوال مساعدة
        function getRandomDenominator() {
            const denominators = [2, 3, 4, 5, 6, 8, 10];
            return denominators[Math.floor(Math.random() * denominators.length)];
        }

        function getRandomNumerator(denominator) {
            return Math.floor(Math.random() * denominator) + 1;
        }

        function simplifyFraction(numerator, denominator) {
            if (numerator === 0) {
                return { numerator: 0, denominator: 1 };
            }

            const gcd = findGCD(numerator, denominator);
            return {
                numerator: numerator / gcd,
                denominator: denominator / gcd
            };
        }

        function findGCD(a, b) {
            return b === 0 ? a : findGCD(b, a % b);
        }
    </script>
</body>
</html>
