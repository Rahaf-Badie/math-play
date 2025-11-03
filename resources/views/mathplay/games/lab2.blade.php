<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مختبر الأعداد الكسرية - {{ $lesson_game->lesson->name }}</title>
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
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            max-width: 900px;
            width: 100%;
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
        }

        .back-to-lesson:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #d63031 0%, #c23616 100%);
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            margin-top: 10px;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .game-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .instructions {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            line-height: 1.6;
        }

        .formula-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            color: #856404;
        }

        .game-area {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #dfe6e9;
        }

        .problem-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .mixed-number {
            display: inline-flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            border: 3px solid #74b9ff;
            margin: 20px 0;
        }

        .whole-part {
            font-size: 2.5rem;
            font-weight: bold;
            color: #e84393;
            padding: 10px 20px;
            background: #ffeaa7;
            border-radius: 10px;
        }

        .fraction-part {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .numerator, .denominator {
            width: 60px;
            height: 45px;
            background: #74b9ff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .denominator {
            background: #0984e3;
            border-top: 2px solid white;
        }

        .conversion-arrow {
            font-size: 2.5rem;
            color: #00b894;
            margin: 0 20px;
            font-weight: bold;
        }

        .solution-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            border: 3px dashed #b2bec3;
            margin-bottom: 25px;
        }

        .input-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .input-label {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2d3436;
        }

        .fraction-input {
            width: 80px;
            height: 60px;
            border: 3px solid #3498db;
            border-radius: 12px;
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background: #fffdf6;
        }

        .fraction-input:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.3);
            outline: none;
        }

        .fraction-separator {
            font-size: 2rem;
            font-weight: bold;
            color: #2d3436;
            margin: 0 10px;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 30px;
            font-size: 1.2rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            min-width: 160px;
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #new-problem-btn {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .feedback-area {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 1.3rem;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .feedback-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback-error {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .feedback-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .solution-steps {
            background: #e8f4f8;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            font-size: 1.1rem;
            text-align: right;
            display: none;
        }

        .step {
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 8px;
            border-right: 4px solid #3498db;
        }

        .step-number {
            font-weight: bold;
            color: #e84393;
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .mixed-number {
                flex-direction: column;
                gap: 10px;
            }

            .conversion-arrow {
                transform: rotate(90deg);
                margin: 10px 0;
            }

            .input-group {
                flex-direction: column;
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
    </style>
</head>
<body>
    <div class="container">
        <!-- زر الرجوع إلى الدرس -->
        <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-to-lesson">
            ← الرجوع إلى الدرس
        </a>

        <div class="header">
            <h1 class="lesson-title">🔬 مختبر الأعداد الكسرية - {{ $lesson_game->lesson->name }}</h1>
        </div>

        <div class="game-stats">
            <div class="stat-card">
                <div class="stat-value" id="current-score">0</div>
                <div class="stat-label">النقاط الحالية</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="problems-solved">0</div>
                <div class="stat-label">المسائل المحلولة</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="accuracy">100%</div>
                <div class="stat-label">الدقة</div>
            </div>
        </div>

        <div class="instructions">
            <h3>🎯 تحويل العدد الكسري إلى كسر عادي</h3>
            <div class="formula-box">
                📝 القانون: البسط = (المقام × العدد الصحيح) + البسط الأصلي
            </div>
            <p>💡 أدخل البسط والمقام الصحيحين للكسر الناتج</p>
        </div>

        <div class="game-area">
            <div class="problem-section">
                <h3>المسألة:</h3>
                <div class="mixed-number" id="mixed-number">
                    <!-- سيتم تعبئته ديناميكياً -->
                </div>
                <div class="conversion-arrow">↓</div>
            </div>

            <div class="solution-section">
                <h3>الحل:</h3>
                <div class="input-group">
                    <div class="input-label">البسط:</div>
                    <input type="number" id="numerator-input" class="fraction-input" placeholder="?">
                    <div class="fraction-separator">/</div>
                    <input type="number" id="denominator-input" class="fraction-input" placeholder="?">
                    <div class="input-label">المقام:</div>
                </div>

                <div class="controls">
                    <button id="check-btn">✅ تحقق</button>
                    <button id="hint-btn">💡 تلميح</button>
                    <button id="new-problem-btn">🔄 جديدة</button>
                </div>

                <div class="feedback-area" id="feedback-area">
                    ابدأ بحل المسألة!
                </div>

                <div class="solution-steps" id="solution-steps">
                    <!-- سيتم تعبئته ديناميكياً -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 12 }};

        // متغيرات اللعبة
        let currentScore = 0;
        let problemsSolved = 0;
        let totalAttempts = 0;
        let correctAttempts = 0;
        let currentProblem = null;

        // عناصر DOM
        const mixedNumberElement = document.getElementById('mixed-number');
        const numeratorInput = document.getElementById('numerator-input');
        const denominatorInput = document.getElementById('denominator-input');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const newProblemButton = document.getElementById('new-problem-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const solutionSteps = document.getElementById('solution-steps');
        const currentScoreElement = document.getElementById('current-score');
        const problemsSolvedElement = document.getElementById('problems-solved');
        const accuracyElement = document.getElementById('accuracy');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeGame();
            setupEventListeners();
        });

        function initializeGame() {
            generateNewProblem();
            updateStats();
        }

        function setupEventListeners() {
            checkButton.addEventListener('click', checkSolution);
            hintButton.addEventListener('click', provideHint);
            newProblemButton.addEventListener('click', generateNewProblem);

            // السماح بالضغط على Enter
            numeratorInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') checkSolution();
            });
            denominatorInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') checkSolution();
            });
        }

        function generateNewProblem() {
            // إعادة تعيين الواجهة
            resetGameBoard();

            // توليد عدد كسري عشوائي
            const wholePart = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            const denominator = getRandomDenominator();
            const numerator = getRandomNumerator(denominator);

            currentProblem = {
                wholePart: wholePart,
                numerator: numerator,
                denominator: denominator,
                correctNumerator: (denominator * wholePart) + numerator,
                correctDenominator: denominator
            };

            console.log('المسألة:', currentProblem);

            // عرض العدد الكسري
            displayMixedNumber();

            // عرض رسالة الترحيب
            showFeedback('حول العدد الكسري إلى كسر عادي!', 'info');
        }

        function displayMixedNumber() {
            mixedNumberElement.innerHTML = `
                <div class="whole-part">${currentProblem.wholePart}</div>
                <div class="fraction-part">
                    <div class="numerator">${currentProblem.numerator}</div>
                    <div class="denominator">${currentProblem.denominator}</div>
                </div>
            `;
        }

        function checkSolution() {
            const userNumerator = parseInt(numeratorInput.value);
            const userDenominator = parseInt(denominatorInput.value);

            if (isNaN(userNumerator) || isNaN(userDenominator)) {
                showFeedback('⚠️ من فضلك أدخل البسط والمقام!', 'error');
                return;
            }

            totalAttempts++;

            const isCorrect =
                userNumerator === currentProblem.correctNumerator &&
                userDenominator === currentProblem.correctDenominator;

            if (isCorrect) {
                correctAttempts++;
                problemsSolved++;
                currentScore += 15;

                showFeedback('🎉 أحسنت! الإجابة صحيحة!', 'success');
                showSolutionSteps();

                // تحديث الإحصائيات
                updateStats();

                // توليد مسألة جديدة بعد ثانيتين
                setTimeout(generateNewProblem, 2000);
            } else {
                currentScore = Math.max(0, currentScore - 5);

                let errorMessage = '❌ الإجابة غير صحيحة!';
                if (userNumerator !== currentProblem.correctNumerator && userDenominator !== currentProblem.correctDenominator) {
                    errorMessage += ' البسط والمقام غير صحيحين';
                } else if (userNumerator !== currentProblem.correctNumerator) {
                    errorMessage += ' البسط غير صحيح';
                } else {
                    errorMessage += ' المقام غير صحيح';
                }

                showFeedback(errorMessage, 'error');
                showSolutionSteps();
                updateStats();
            }
        }

        function showSolutionSteps() {
            solutionSteps.innerHTML = `
                <h4>📝 خطوات الحل:</h4>
                <div class="step">
                    <span class="step-number">1.</span>
                    العدد الكسري: ${currentProblem.wholePart} و ${currentProblem.numerator}/${currentProblem.denominator}
                </div>
                <div class="step">
                    <span class="step-number">2.</span>
                    القانون: البسط = (المقام × العدد الصحيح) + البسط الأصلي
                </div>
                <div class="step">
                    <span class="step-number">3.</span>
                    البسط = (${currentProblem.denominator} × ${currentProblem.wholePart}) + ${currentProblem.numerator}
                </div>
                <div class="step">
                    <span class="step-number">4.</span>
                    البسط = ${currentProblem.denominator * currentProblem.wholePart} + ${currentProblem.numerator} = ${currentProblem.correctNumerator}
                </div>
                <div class="step">
                    <span class="step-number">5.</span>
                    المقام يبقى كما هو: ${currentProblem.correctDenominator}
                </div>
                <div class="step">
                    <span class="step-number">6.</span>
                    الناتج: ${currentProblem.correctNumerator}/${currentProblem.correctDenominator}
                </div>
            `;
            solutionSteps.style.display = 'block';
        }

        function provideHint() {
            currentScore = Math.max(0, currentScore - 3);

            // إعطاء تلميح عشوائي
            const hintType = Math.floor(Math.random() * 2);

            if (hintType === 0) {
                // تلميح بالبسط
                numeratorInput.value = currentProblem.correctNumerator;
                showFeedback('💡 لقد ساعدتك بإدخال البسط الصحيح!', 'info');
            } else {
                // تلميح بالمقام
                denominatorInput.value = currentProblem.correctDenominator;
                showFeedback('💡 لقد ساعدتك بإدخال المقام الصحيح!', 'info');
            }

            updateStats();
        }

        function resetGameBoard() {
            numeratorInput.value = '';
            denominatorInput.value = '';
            numeratorInput.className = 'fraction-input';
            denominatorInput.className = 'fraction-input';
            solutionSteps.style.display = 'none';
        }

        function showFeedback(message, type) {
            feedbackArea.textContent = message;
            feedbackArea.className = `feedback-area feedback-${type}`;
        }

        function updateStats() {
            currentScoreElement.textContent = currentScore;
            problemsSolvedElement.textContent = problemsSolved;
            const accuracy = totalAttempts > 0 ? Math.round((correctAttempts / totalAttempts) * 100) : 100;
            accuracyElement.textContent = `${accuracy}%`;
        }

        // دوال مساعدة
        function getRandomDenominator() {
            const denominators = [2, 3, 4, 5, 6, 7, 8, 9, 10];
            return denominators[Math.floor(Math.random() * denominators.length)];
        }

        function getRandomNumerator(denominator) {
            return Math.floor(Math.random() * (denominator - 1)) + 1;
        }
    </script>
</body>
</html>
