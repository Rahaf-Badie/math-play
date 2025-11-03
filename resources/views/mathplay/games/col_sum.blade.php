<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الجمع العمودي - {{ $lesson_game->lesson->name }}</title>
    <style>
        /* ===== التنسيقات الأساسية ===== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            direction: rtl;
        }

        .container {
            max-width: 900px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* ===== رأس اللعبة ===== */
        .game-header {
            margin-bottom: 25px;
        }

        .lesson-info {
            font-size: 1.1em;
            color: #666;
            margin-bottom: 10px;
        }

        h1 {
            color: #4a6fa5;
            margin-bottom: 10px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .instructions {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .range-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* ===== منطقة المسألة ===== */
        .problem-area {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .vertical-addition {
            display: inline-block;
            text-align: left;
            direction: ltr;
            font-family: 'Courier New', monospace;
            font-size: 2.2rem;
            margin: 20px 0;
            padding: 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            position: relative;
        }

        .addition-row {
            display: flex;
            justify-content: flex-end;
            margin: 8px 0;
            position: relative;
        }

        .digit {
            width: 55px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 3px;
            font-weight: bold;
            position: relative;
        }

        .number1, .number2 {
            border-bottom: 3px solid #4a6fa5;
            padding-bottom: 8px;
        }

        .plus-sign {
            margin-right: 15px;
            color: #e91e63;
            font-weight: bold;
        }

        .result-row {
            border-top: 3px solid #4a6fa5;
            padding-top: 8px;
            margin-top: 8px;
        }

        .line {
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 2px;
            background: #4a6fa5;
        }

        /* ===== خانات الإدخال ===== */
        .input-section {
            margin: 25px 0;
        }

        .place-labels {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .place-label {
            width: 55px;
            text-align: center;
            font-size: 0.95rem;
            color: #666;
            font-weight: bold;
            background: #e9ecef;
            padding: 5px;
            border-radius: 5px;
        }

        .input-grid {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 15px 0;
        }

        .input-cell {
            width: 55px;
            height: 65px;
            border: 3px solid #4a6fa5;
            border-radius: 10px;
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            background: white;
            transition: all 0.3s ease;
        }

        .input-cell:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.3);
            transform: scale(1.05);
        }

        .input-cell.correct {
            border-color: #00b894;
            background-color: #e8f5e9;
            color: #00b894;
        }

        .input-cell.incorrect {
            border-color: #ff7675;
            background-color: #ffebee;
            color: #e84393;
        }

        /* ===== التغذية الراجعة ===== */
        .feedback {
            font-size: 1.8rem;
            margin: 25px 0;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .feedback.success {
            color: #00b894;
            animation: celebrate 0.5s ease;
        }

        .feedback.error {
            color: #ff7675;
            animation: shake 0.5s ease;
        }

        .feedback.info {
            color: #74b9ff;
        }

        /* ===== التلميحات ===== */
        .hint-section {
            margin: 20px 0;
        }

        .hint {
            font-size: 1.1rem;
            color: #666;
            margin-top: 10px;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 10px;
            border-right: 4px solid #74b9ff;
            text-align: right;
            line-height: 1.6;
        }

        .hint.hidden {
            display: none;
        }

        /* ===== عناصر التحكم ===== */
        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .control-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            min-width: 140px;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .control-btn:active {
            transform: translateY(1px);
        }

        .control-btn.secondary {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
        }

        .control-btn.success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
        }

        /* ===== لوحة النقاط ===== */
        .score-board {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px dashed #74b9ff;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            background: #f8f9fa;
            min-width: 120px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #0984e3;
            display: block;
            margin-top: 5px;
        }

        .stat-label {
            color: #666;
            font-weight: bold;
        }

        /* ===== الرسوم المتحركة ===== */
        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* ===== التصميم المتجاوب ===== */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .vertical-addition {
                font-size: 1.8rem;
                padding: 20px;
            }

            .digit, .input-cell {
                width: 45px;
                height: 55px;
            }

            .place-label {
                width: 45px;
            }

            .controls {
                gap: 10px;
            }

            .control-btn {
                padding: 12px 20px;
                font-size: 1rem;
                min-width: 120px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .vertical-addition {
                font-size: 1.5rem;
                padding: 15px;
            }

            .digit, .input-cell {
                width: 40px;
                height: 50px;
                font-size: 1.5rem;
            }

            .place-label {
                width: 40px;
                font-size: 0.8rem;
            }

            .stats {
                flex-direction: column;
                gap: 10px;
            }

            .stat-item {
                min-width: 100px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- رأس اللعبة -->
        <div class="game-header">
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
            <h1>🧮 الجمع العمودي</h1>
            <div class="instructions">أكمل عملية الجمع دون حمل</div>
            <div class="range-info">المدى: {{ $min_range }} إلى {{ $max_range }}</div>
        </div>

        <!-- منطقة المسألة -->
        <div class="problem-area">
            <div class="vertical-addition" id="vertical-addition">
                <!-- سيتم إنشاء عملية الجمع هنا بالجافاسكريبت -->
            </div>
        </div>

        <!-- خانات الإدخال -->
        <div class="input-section">
            <div class="place-labels">
                <div class="place-label">عشرات الآلاف</div>
                <div class="place-label">الآلاف</div>
                <div class="place-label">المئات</div>
                <div class="place-label">العشرات</div>
                <div class="place-label">الآحاد</div>
            </div>

            <div class="input-grid" id="input-grid">
                <!-- سيتم إنشاء خانات الإدخال هنا بالجافاسكريبت -->
            </div>
        </div>

        <!-- التغذية الراجعة -->
        <div class="feedback info" id="feedback">أدخل ناتج الجمع في الخانات أعلاه</div>

        <!-- التلميحات -->
        <div class="hint-section">
            <div id="hint" class="hint hidden">
                <!-- سيتم عرض التلميح هنا -->
            </div>
        </div>

        <!-- عناصر التحكم -->
        <div class="controls">
            <button id="check-btn" class="control-btn success">✓ تحقق</button>
            <button id="hint-btn" class="control-btn secondary">💡 تلميح</button>
            <button id="next-btn" class="control-btn">➡ التالي</button>
        </div>

        <!-- لوحة النقاط -->
        <div class="score-board">
            <div class="stats">
                <div class="stat-item">
                    <span class="stat-label">النقاط</span>
                    <span id="score-value" class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">الإجابات الصحيحة</span>
                    <span id="correct-answers" class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">المستوى</span>
                    <span id="level" class="stat-value">1</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">المسائل</span>
                    <span id="total-questions" class="stat-value">0</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ===== تهيئة المتغيرات =====
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};

        let number1 = 0;
        let number2 = 0;
        let correctResult = 0;
        let inputCells = [];
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let currentLevel = 1;
        let hintShown = false;

        // ===== العناصر =====
        const verticalAdditionElement = document.getElementById('vertical-addition');
        const inputGridElement = document.getElementById('input-grid');
        const feedbackElement = document.getElementById('feedback');
        const hintElement = document.getElementById('hint');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const nextButton = document.getElementById('next-btn');
        const scoreValueElement = document.getElementById('score-value');
        const correctAnswersElement = document.getElementById('correct-answers');
        const levelElement = document.getElementById('level');
        const totalQuestionsElement = document.getElementById('total-questions');

        // ===== الدوال الأساسية =====

        // إنشاء لعبة جديدة
        function createNewGame() {
            // توليد عددين عشوائيين ضمن المدى المحدد ودون حمل
            do {
                number1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                number2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            } while (hasCarry(number1, number2));

            correctResult = number1 + number2;

            // عرض عملية الجمع عمودياً
            displayVerticalAddition();

            // إنشاء خانات الإدخال
            createInputCells();

            // إعادة تعيين الحالة
            resetGameState();

            totalQuestions++;
            totalQuestionsElement.textContent = totalQuestions;
        }

        // التحقق من وجود حمل
        function hasCarry(num1, num2) {
            let n1 = num1;
            let n2 = num2;

            for (let i = 0; i < 4; i++) {
                const digit1 = n1 % 10;
                const digit2 = n2 % 10;

                if (digit1 + digit2 >= 10) {
                    return true; // يوجد حمل
                }

                n1 = Math.floor(n1 / 10);
                n2 = Math.floor(n2 / 10);
            }

            return false; // لا يوجد حمل
        }

        // عرض الجمع العمودي
        function displayVerticalAddition() {
            const digits1 = getDigits(number1);
            const digits2 = getDigits(number2);

            let html = `
                <div class="addition-row number1">
                    <div class="digit">${digits1[3]}</div>
                    <div class="digit">${digits1[2]}</div>
                    <div class="digit">${digits1[1]}</div>
                    <div class="digit">${digits1[0]}</div>
                </div>
                <div class="addition-row number2">
                    <div class="digit plus-sign">+</div>
                    <div class="digit">${digits2[3]}</div>
                    <div class="digit">${digits2[2]}</div>
                    <div class="digit">${digits2[1]}</div>
                    <div class="digit">${digits2[0]}</div>
                </div>
                <div class="line"></div>
                <div class="addition-row result-row" id="result-row">
                    <div class="digit"></div>
                    <div class="digit"></div>
                    <div class="digit"></div>
                    <div class="digit"></div>
                    <div class="digit"></div>
                </div>
            `;

            verticalAdditionElement.innerHTML = html;
        }

        // الحصول على أرقام العدد
        function getDigits(number) {
            const digits = [];
            let n = number;

            for (let i = 0; i < 4; i++) {
                digits.push(n % 10);
                n = Math.floor(n / 10);
            }

            return digits;
        }

        // إنشاء خانات الإدخال
        function createInputCells() {
            inputGridElement.innerHTML = '';
            inputCells = [];

            for (let i = 0; i < 5; i++) {
                const input = document.createElement('input');
                input.type = 'number';
                input.className = 'input-cell';
                input.maxLength = 1;
                input.min = 0;
                input.max = 9;

                input.addEventListener('input', function() {
                    if (this.value.length > 1) {
                        this.value = this.value.slice(0, 1);
                    }
                    // الانتقال إلى الخانة التالية تلقائياً
                    if (this.value !== '' && i < 4) {
                        inputCells[i + 1].focus();
                    }
                    // السماح بالرجوع للخلف عند المسح
                    if (this.value === '' && i > 0) {
                        inputCells[i - 1].focus();
                    }
                });

                input.addEventListener('keydown', function(e) {
                    // السماح بالتحرك بين الخانات باستخدام الأسهم
                    if (e.key === 'ArrowLeft' && i > 0) {
                        inputCells[i - 1].focus();
                    } else if (e.key === 'ArrowRight' && i < 4) {
                        inputCells[i + 1].focus();
                    }
                });

                inputGridElement.appendChild(input);
                inputCells.push(input);
            }

            // التركيز على الخانة الأولى
            setTimeout(() => inputCells[0].focus(), 100);
        }

        // إعادة تعيين حالة اللعبة
        function resetGameState() {
            feedbackElement.textContent = 'أدخل ناتج الجمع في الخانات أعلاه';
            feedbackElement.className = 'feedback info';
            hintElement.innerHTML = '';
            hintElement.classList.add('hidden');
            hintShown = false;
        }

        // التحقق من الإجابة
        function checkAnswer() {
            let userAnswer = '';
            let allFilled = true;

            // جمع الإجابة من الخانات
            for (let i = 4; i >= 0; i--) {
                if (inputCells[i].value === '') {
                    allFilled = false;
                    break;
                }
                userAnswer += inputCells[i].value;
            }

            if (!allFilled) {
                feedbackElement.textContent = 'يرجى ملء جميع الخانات!';
                feedbackElement.className = 'feedback error';
                return;
            }

            const userResult = parseInt(userAnswer);

            if (userResult === correctResult) {
                // إجابة صحيحة
                feedbackElement.textContent = 'أحسنت! 🎉 الإجابة صحيحة';
                feedbackElement.className = 'feedback success';

                score += currentLevel * 10;
                correctAnswers++;

                // تحديث المستوى
                if (correctAnswers % 5 === 0) {
                    currentLevel++;
                    levelElement.textContent = currentLevel;
                    feedbackElement.textContent += ` 🚀 تقدمت للمستوى ${currentLevel}!`;
                }

                // تلوين الخانات بالإجابة الصحيحة
                inputCells.forEach(cell => {
                    cell.className = 'input-cell correct';
                });

                // تحديث الإحصائيات
                updateStats();
            } else {
                // إجابة خاطئة
                feedbackElement.textContent = 'ليس صحيحاً! حاول مرة أخرى';
                feedbackElement.className = 'feedback error';

                // إظهار التلميح تلقائياً بعد خطأ
                if (!hintShown) {
                    showHint();
                }
            }
        }

        // إظهار التلميح
        function showHint() {
            if (hintShown) return;

            const digits1 = getDigits(number1);
            const digits2 = getDigits(number2);

            hintElement.innerHTML = `
                <strong>تلميح:</strong>
                <br>${number1} + ${number2} = ?
                <br>اجمع كل منزلة على حدة:
                <br>الآحاد: ${digits1[0]} + ${digits2[0]} = ${digits1[0] + digits2[0]}
                <br>العشرات: ${digits1[1]} + ${digits2[1]} = ${digits1[1] + digits2[1]}
                <br>المئات: ${digits1[2]} + ${digits2[2]} = ${digits1[2] + digits2[2]}
                <br>الآلاف: ${digits1[3]} + ${digits2[3]} = ${digits1[3] + digits2[3]}
                <br><em>تذكر: لا يوجد حمل في هذه المسألة!</em>
            `;
            hintElement.classList.remove('hidden');
            hintShown = true;
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreValueElement.textContent = score;
            correctAnswersElement.textContent = correctAnswers;
        }

        // ===== تهيئة الأحداث =====
        checkButton.addEventListener('click', checkAnswer);
        hintButton.addEventListener('click', showHint);
        nextButton.addEventListener('click', createNewGame);

        // السماح بالتحقق باستخدام زر Enter
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                checkAnswer();
            }
        });

        // بدء اللعبة الأولى
        window.addEventListener('load', createNewGame);
    </script>
</body>
</html>
