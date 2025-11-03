<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بطل القسمة الممتعة - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .header h1 {
            color: #2d3436;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .lesson-info {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 1.3em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-to-lesson {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .back-to-lesson:hover {
            background: white;
            color: #00a085;
            transform: translateY(-2px);
        }

        .game-layout {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 968px) {
            .game-layout {
                grid-template-columns: 1fr;
            }
        }

        .instructions {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .instructions h3 {
            color: #0984e3;
            margin-bottom: 20px;
            text-align: center;
        }

        .steps {
            list-style: none;
            padding: 0;
            margin-bottom: 25px;
        }

        .steps li {
            margin-bottom: 15px;
            padding-right: 40px;
            position: relative;
            line-height: 1.6;
        }

        .steps li:before {
            content: "🔢";
            position: absolute;
            right: 0;
            font-size: 1.2em;
        }

        .example {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 4px solid #00b894;
        }

        .example h4 {
            color: #00b894;
            margin-bottom: 10px;
        }

        .division-problem {
            font-family: 'Courier New', monospace;
            font-size: 1.2em;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
        }

        .game-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .problem-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .problem-numbers {
            font-size: 3em;
            color: #667eea;
            font-weight: bold;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
        }

        .division-symbol {
            font-size: 2em;
            margin: 0 20px;
            color: #2d3436;
        }

        .input-area {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .input-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .input-label {
            font-weight: bold;
            color: #2d3436;
            min-width: 100px;
        }

        .number-input {
            width: 80px;
            height: 50px;
            border: 2px solid #ddd;
            border-radius: 10px;
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .number-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
            outline: none;
        }

        .equals {
            font-size: 1.5em;
            font-weight: bold;
            color: #2d3436;
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
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        #next-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            font-size: 1.2em;
        }

        .success {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            animation: celebrate 0.5s ease;
        }

        .error {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        .info {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .progress-container {
            margin: 20px 0;
        }

        .progress-text {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: #f8f9fa;
            border-radius: 6px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #00b894, #00a085);
            border-radius: 6px;
            transition: width 0.3s ease;
        }

        .step-by-step {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            display: none;
        }

        .step-by-step.show {
            display: block;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .step {
            margin-bottom: 15px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            border-right: 4px solid #74b9ff;
        }

        .hint-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            display: none;
        }

        .hint-box.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 بطل القسمة الممتعة</h1>
            <p>تعلم القسمة المطولة بطريقة سهلة وممتعة!</p>
        </div>

        <div class="lesson-info">
            <span>🎯 الدرس: {{ $lesson_game->lesson->name }}</span>
            <a href="{{ url()->previous() }}" class="back-to-lesson">← الرجوع إلى الدرس</a>
        </div>

        <div class="game-layout">
            <div class="instructions">
                <h3>📝 خطوات القسمة المطولة</h3>
                <ul class="steps">
                    <li>اقسم أول منزلتين على المقسوم عليه</li>
                    <li>اضرب الناتج في المقسوم عليه</li>
                    <li>اطرح الناتج من الرقم الأصلي</li>
                    <li>انزل المنزلة التالية</li>
                    <li>كرر الخطوات حتى تنتهي من جميع المنازل</li>
                </ul>

                <div class="example">
                    <h4>🔍 مثال توضيحي:</h4>
                    <div class="division-problem" id="example-problem">
                        <!-- سيتم تعبئته بالجافاسكريبت -->
                    </div>
                    <div class="step-by-step" id="example-steps">
                        <!-- سيتم تعبئته بالجافاسكريبت -->
                    </div>
                </div>
            </div>

            <div class="game-area">
                <div class="problem-display">
                    <h3>حل مسألة القسمة التالية:</h3>
                    <div class="problem-numbers">
                        <span id="dividend">?</span>
                        <span class="division-symbol">÷</span>
                        <span id="divisor">?</span>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-text">
                        تقدم اللعبة: <span id="progress-text">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" id="progress" style="width: 0%"></div>
                    </div>
                </div>

                <div class="input-area">
                    <div class="input-group">
                        <span class="input-label">الناتج:</span>
                        <input type="number" id="quotient-input" class="number-input" placeholder="؟">
                        <span class="equals">=</span>
                    </div>

                    <div class="input-group">
                        <span class="input-label">الباقي:</span>
                        <input type="number" id="remainder-input" class="number-input" placeholder="؟">
                    </div>
                </div>

                <div class="hint-box" id="hint-box">
                    <!-- التلميح سيظهر هنا -->
                </div>

                <div class="step-by-step" id="solution-steps">
                    <!-- خطوات الحل ستظهر هنا -->
                </div>

                <div class="controls">
                    <button id="check-btn">✅ تحقق من الإجابة</button>
                    <button id="hint-btn">💡 الحصول على تلميح</button>
                    <button id="next-btn" disabled>➡️ السؤال التالي</button>
                    <button id="reset-btn">🔄 إعادة اللعبة</button>
                </div>

                <div class="feedback" id="feedback">
                    أدخل الناتج والباقي ثم اضغط على "تحقق من الإجابة"
                </div>
            </div>
        </div>

        <div class="score-board">
            النقاط: <span id="score">0</span> | الأسئلة الصحيحة: <span id="correct-count">0</span> |
            المستوى: <span id="level">1</span>
        </div>
    </div>

    <script>
        // تعريف الدروس المختلفة
        const lessons = {
            116: {
                id: 116,
                name: "قسمة عدد من منزلتين على عدد من منزلتين",
                minDividend: 20, // زيادة الحد الأدنى لتجنب الأرقام الصغيرة جداً
                maxDividend: 99,
                minDivisor: 10,
                maxDivisor: 99,
                example: {
                    dividend: 84,
                    divisor: 12,
                    steps: [
                        "84 ÷ 12: نبحث عن عدد إذا ضرب في 12 يعطي 84 أو أقل",
                        "12 × 7 = 84",
                        "84 - 84 = 0",
                        "الناتج: 7 والباقي: 0"
                    ]
                }
            },
            117: {
                id: 117,
                name: "قسمة عدد من 3 منازل على عدد من منزلتين",
                minDividend: 100,
                maxDividend: 999,
                minDivisor: 10,
                maxDivisor: 99,
                example: {
                    dividend: 156,
                    divisor: 12,
                    steps: [
                        "156 ÷ 12: نأخذ أول منزلتين (15)",
                        "15 ÷ 12 = 1 والباقي 3",
                        "ننزل 6 فيصبح 36",
                        "36 ÷ 12 = 3",
                        "الناتج: 13 والباقي: 0"
                    ]
                }
            }
        };

        // بيانات اللعبة
        const gameData = {
            currentLessonId: <?php echo $lesson_game->lesson->id; ?>,
            score: 0,
            level: 1,
            currentQuestion: 1,
            totalQuestions: 8,
            correctCount: 0,
            currentProblem: null
        };

        // عناصر DOM
        const exampleProblemElement = document.getElementById('example-problem');
        const exampleStepsElement = document.getElementById('example-steps');
        const dividendElement = document.getElementById('dividend');
        const divisorElement = document.getElementById('divisor');
        const quotientInput = document.getElementById('quotient-input');
        const remainderInput = document.getElementById('remainder-input');
        const scoreElement = document.getElementById('score');
        const correctCountElement = document.getElementById('correct-count');
        const levelElement = document.getElementById('level');
        const progressElement = document.getElementById('progress');
        const progressTextElement = document.getElementById('progress-text');
        const hintBoxElement = document.getElementById('hint-box');
        const solutionStepsElement = document.getElementById('solution-steps');
        const feedbackElement = document.getElementById('feedback');
        const checkBtn = document.getElementById('check-btn');
        const nextBtn = document.getElementById('next-btn');
        const hintBtn = document.getElementById('hint-btn');
        const resetBtn = document.getElementById('reset-btn');

        // الحصول على الدرس الحالي
        function getCurrentLesson() {
            return lessons[gameData.currentLessonId];
        }

        // تهيئة اللعبة
        function initGame() {
            setupExample();
            generateProblem();
            updateUI();
        }

        // إعداد المثال التوضيحي
        function setupExample() {
            const lesson = getCurrentLesson();
            const example = lesson.example;

            exampleProblemElement.innerHTML = `
                <strong>${example.dividend} ÷ ${example.divisor} = ?</strong>
            `;

            exampleStepsElement.innerHTML = example.steps.map((step, index) => `
                <div class="step">
                    <strong>الخطوة ${index + 1}:</strong> ${step}
                </div>
            `).join('');

            exampleStepsElement.classList.add('show');
        }

        // توليد مسألة جديدة (محسّن)
        function generateProblem() {
            const lesson = getCurrentLesson();
            let dividend, divisor, quotient, remainder;

            // محاولات لتجنب الأرقام غير المنطقية
            let attempts = 0;
            const maxAttempts = 10;

            do {
                attempts++;
                
                // توليد المقسوم عليه (يجب أن يكون من منزلتين)
                divisor = Math.floor(Math.random() * (lesson.maxDivisor - lesson.minDivisor + 1)) + lesson.minDivisor;
                
                // التأكد من أن المقسوم عليه ليس صفراً
                if (divisor === 0) divisor = 10;

                if (lesson.id === 116) {
                    // قسمة عدد من منزلتين على عدد من منزلتين
                    // نضمن أن الناتج ليس صفراً
                    quotient = Math.floor(Math.random() * 9) + 1; // ناتج من 1 إلى 9
                    remainder = Math.floor(Math.random() * divisor); // باقي أقل من المقسوم عليه
                    dividend = quotient * divisor + remainder;
                    
                    // التأكد من أن المقسوم بين الحدود المطلوبة
                    if (dividend < lesson.minDividend) {
                        dividend = lesson.minDividend;
                    } else if (dividend > lesson.maxDividend) {
                        dividend = lesson.maxDividend;
                    }
                } else {
                    // قسمة عدد من 3 منازل على عدد من منزلتين
                    quotient = Math.floor(Math.random() * 10) + 1; // ناتج من 1 إلى 10
                    remainder = Math.floor(Math.random() * divisor); // باقي أقل من المقسوم عليه
                    dividend = quotient * divisor + remainder;
                    
                    // التأكد من أن المقسوم بين الحدود المطلوبة
                    if (dividend < lesson.minDividend) {
                        dividend = lesson.minDividend;
                    } else if (dividend > lesson.maxDividend) {
                        dividend = lesson.maxDividend;
                    }
                }
                
                // إعادة حساب القيم بناءً على المقسوم المعدّل
                quotient = Math.floor(dividend / divisor);
                remainder = dividend % divisor;
                
            } while ((dividend === 0 || quotient === 0 || divisor === 0) && attempts < maxAttempts);

            // إذا فشلت جميع المحاولات، استخدم قيم افتراضية
            if (attempts >= maxAttempts) {
                dividend = 84;
                divisor = 12;
                quotient = 7;
                remainder = 0;
            }

            gameData.currentProblem = {
                dividend: dividend,
                divisor: divisor,
                quotient: quotient,
                remainder: remainder
            };

            // تحديث واجهة المسألة
            dividendElement.textContent = dividend;
            divisorElement.textContent = divisor;

            // إعادة تعيين الحقول
            quotientInput.value = '';
            remainderInput.value = '';
            quotientInput.disabled = false;
            remainderInput.disabled = false;

            // إخفاء التلميح وخطوات الحل
            hintBoxElement.classList.remove('show');
            solutionStepsElement.classList.remove('show');

            // إعادة تعليمات الأزرار
            checkBtn.disabled = false;
            nextBtn.disabled = true;

            showFeedback('أدخل الناتج والباقي ثم اضغط على "تحقق من الإجابة"', 'info');
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userQuotient = parseInt(quotientInput.value);
            const userRemainder = parseInt(remainderInput.value);
            const problem = gameData.currentProblem;

            if (isNaN(userQuotient) || isNaN(userRemainder)) {
                showFeedback('❌ يرجى إدخال الناتج والباقي!', 'error');
                return;
            }

            const isCorrect = userQuotient === problem.quotient && userRemainder === problem.remainder;

            if (isCorrect) {
                gameData.score += 10 * gameData.level;
                gameData.correctCount++;
                showFeedback('🎉 إجابة صحيحة! أحسنت!', 'success');

                // تعطيل الحقول
                quotientInput.disabled = true;
                remainderInput.disabled = true;
                checkBtn.disabled = true;
                nextBtn.disabled = false;
            } else {
                showFeedback('❌ إجابة خاطئة! حاول مرة أخرى أو اطلب تلميحاً', 'error');
                showSolutionSteps();
            }

            updateUI();
        }

        // إظهار خطوات الحل
        function showSolutionSteps() {
            const problem = gameData.currentProblem;
            const lesson = getCurrentLesson();
            let steps = [];

            if (lesson.id === 116) {
                // قسمة عدد من منزلتين على عدد من منزلتين
                steps = [
                    `${problem.dividend} ÷ ${problem.divisor}`,
                    `نبحث عن عدد إذا ضرب في ${problem.divisor} يعطي ${problem.dividend} أو أقل`,
                    `${problem.divisor} × ${problem.quotient} = ${problem.divisor * problem.quotient}`,
                    `${problem.dividend} - ${problem.divisor * problem.quotient} = ${problem.remainder}`,
                    `الناتج: ${problem.quotient} والباقي: ${problem.remainder}`
                ];
            } else {
                // قسمة عدد من 3 منازل على عدد من منزلتين
                const firstTwoDigits = Math.floor(problem.dividend / 10);
                const firstQuotient = Math.floor(firstTwoDigits / problem.divisor);
                const firstRemainder = firstTwoDigits % problem.divisor;
                const newNumber = firstRemainder * 10 + (problem.dividend % 10);
                const secondQuotient = Math.floor(newNumber / problem.divisor);
                const secondRemainder = newNumber % problem.divisor;

                steps = [
                    `${problem.dividend} ÷ ${problem.divisor}`,
                    `نأخذ أول منزلتين: ${firstTwoDigits}`,
                    `${firstTwoDigits} ÷ ${problem.divisor} = ${firstQuotient} والباقي ${firstRemainder}`,
                    `ننزل ${problem.dividend % 10} فيصبح ${newNumber}`,
                    `${newNumber} ÷ ${problem.divisor} = ${secondQuotient} والباقي ${secondRemainder}`,
                    `الناتج: ${problem.quotient} والباقي: ${problem.remainder}`
                ];
            }

            solutionStepsElement.innerHTML = steps.map((step, index) => `
                <div class="step">
                    <strong>الخطوة ${index + 1}:</strong> ${step}
                </div>
            `).join('');

            solutionStepsElement.classList.add('show');
        }

        // إظهار التلميح
        function showHint() {
            const problem = gameData.currentProblem;
            const lesson = getCurrentLesson();
            let hint = '';

            if (lesson.id === 116) {
                hint = `💡 تلميح: حاول قسمة ${problem.dividend} على ${problem.divisor}. ابحث عن عدد إذا ضرب في ${problem.divisor} يعطي ${problem.dividend} أو أقرب عدد أقل منه.`;
            } else {
                hint = `💡 تلميح: ابدأ بأول منزلتين من ${problem.dividend}. قسمهما على ${problem.divisor} ثم انزل المنزلة الثالثة.`;
            }

            hintBoxElement.innerHTML = hint;
            hintBoxElement.classList.add('show');
        }

        // الانتقال للسؤال التالي
        function nextQuestion() {
            gameData.currentQuestion++;

            if (gameData.currentQuestion > gameData.totalQuestions) {
                gameData.level++;
                gameData.currentQuestion = 1;
                showFeedback(`🚀 تقدم للمستوى ${gameData.level}!`, 'info');
            }

            generateProblem();
            updateUI();
        }

        // إعادة اللعبة
        function resetGame() {
            gameData.score = 0;
            gameData.level = 1;
            gameData.currentQuestion = 1;
            gameData.correctCount = 0;
            initGame();
            showFeedback('🔄 تم إعادة اللعبة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            correctCountElement.textContent = gameData.correctCount;
            levelElement.textContent = gameData.level;

            const progress = (gameData.currentQuestion / gameData.totalQuestions) * 100;
            progressElement.style.width = `${progress}%`;
            progressTextElement.textContent = `${Math.round(progress)}%`;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        checkBtn.addEventListener('click', checkAnswer);
        nextBtn.addEventListener('click', nextQuestion);
        hintBtn.addEventListener('click', showHint);
        resetBtn.addEventListener('click', resetGame);

        // السماح بالضغط على Enter للإرسال
        quotientInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') checkAnswer();
        });

        remainderInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') checkAnswer();
        });

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>