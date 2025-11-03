<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة الجمع مع الحمل - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #4a6fa5;
            --primary-dark: #3a5a80;
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
            --addition-bg: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: var(--addition-bg);
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
            color: white;
        }

        .header h1 {
            font-size: 2.4rem;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.9);
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
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 35px;
            width: 100%;
            transition: transform 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .game-card::before {
            content: "+";
            position: absolute;
            top: -30px;
            right: -30px;
            font-size: 150px;
            color: rgba(74, 111, 165, 0.08);
            z-index: 0;
            font-weight: bold;
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .addition-guide {
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

        .addition-guide h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        .guide-steps {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
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

        .addition-area {
            position: relative;
            z-index: 1;
            margin: 30px 0;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--primary);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
            border-radius: 15px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .addition-row {
            display: flex;
            justify-content: flex-end;
            margin: 10px 0;
            position: relative;
        }

        .digit-cell {
            width: 65px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
            font-weight: bold;
            position: relative;
        }

        .number1, .number2 {
            border-bottom: 3px solid var(--primary);
        }

        .plus-sign {
            margin-right: 20px;
            color: var(--error);
            font-weight: bold;
            font-size: 2.5rem;
        }

        .carry-row {
            position: absolute;
            top: -35px;
            display: flex;
            justify-content: flex-end;
            width: 100%;
        }

        .carry-cell {
            width: 65px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
            font-size: 1.4rem;
            color: var(--error);
            font-weight: bold;
        }

        .result-row {
            border-top: 3px solid var(--primary);
            padding-top: 10px;
            margin-top: 10px;
        }

        .input-cell {
            width: 65px;
            height: 75px;
            border: 3px solid var(--primary);
            border-radius: 10px;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            background: white;
            margin: 0 5px;
            font-family: inherit;
            transition: all 0.3s;
        }

        .input-cell:focus {
            outline: none;
            border-color: var(--error);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.3);
            transform: scale(1.05);
        }

        .input-cell.correct {
            border-color: var(--success);
            background-color: #e8f5e9;
        }

        .input-cell.incorrect {
            border-color: var(--error);
            background-color: #ffebee;
        }

        .carry-input {
            width: 50px;
            height: 50px;
            border: 3px dashed var(--error);
            border-radius: 50%;
            font-size: 1.4rem;
            font-weight: bold;
            text-align: center;
            background: #fff3e0;
            margin: 0 10px;
            font-family: inherit;
            transition: all 0.3s;
        }

        .carry-input:focus {
            outline: none;
            border-style: solid;
            background: #ffe0b2;
        }

        .place-labels {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .place-label {
            width: 65px;
            text-align: center;
            font-size: 1rem;
            color: var(--text);
            font-weight: bold;
            background: var(--light);
            padding: 8px;
            border-radius: 8px;
        }

        .steps-container {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 15px;
            margin: 25px 0;
            text-align: right;
        }

        .step {
            margin: 12px 0;
            font-size: 1.2rem;
            display: none;
            padding: 12px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .step.active {
            display: block;
            animation: fadeIn 0.5s ease;
            border-right: 4px solid var(--info);
        }

        .feedback {
            font-size: 1.8rem;
            margin: 25px 0;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            padding: 15px;
            border-radius: 12px;
            transition: all 0.4s;
        }

        .feedback.correct {
            background: rgba(39, 174, 96, 0.15);
            color: var(--success-dark);
            border: 2px solid var(--success);
            animation: bounce 0.6s ease;
        }

        .feedback.incorrect {
            background: rgba(231, 76, 60, 0.15);
            color: var(--error-dark);
            border: 2px solid var(--error);
            animation: shake 0.5s ease;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            position: relative;
            z-index: 1;
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

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--light), #f0f4f8);
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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

        /* تصميم متجاوب */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .game-card {
                padding: 25px 20px;
            }

            .vertical-addition {
                font-size: 1.8rem;
                padding: 20px;
            }

            .digit-cell, .input-cell {
                width: 50px;
                height: 60px;
                font-size: 1.6rem;
            }

            .carry-cell {
                width: 50px;
            }

            .carry-input {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .place-label {
                width: 50px;
                font-size: 0.9rem;
            }

            .controls {
                flex-direction: column;
                gap: 12px;
            }

            .btn {
                width: 100%;
            }

            .guide-steps {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .vertical-addition {
                font-size: 1.5rem;
                padding: 15px;
            }

            .digit-cell, .input-cell {
                width: 40px;
                height: 50px;
                font-size: 1.4rem;
                margin: 0 3px;
            }

            .carry-cell {
                width: 40px;
            }

            .carry-input {
                width: 35px;
                height: 35px;
                font-size: 1.1rem;
            }

            .place-label {
                width: 40px;
                font-size: 0.8rem;
                padding: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎮 لعبة الجمع مع الحمل</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="addition-guide">
                <h3>🧮 دليل الجمع مع الحمل</h3>
                <div class="guide-steps">
                    <div class="guide-step">
                        <div class="step-icon">1️⃣</div>
                        <div class="step-text">ابدأ بجمع الآحاد</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">2️⃣</div>
                        <div class="step-text">إذا كان المجموع ≥ 10<br>اكتب الآحاد واحمل العشرات</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">3️⃣</div>
                        <div class="step-text">اجمع العشرات مع الحمل</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">4️⃣</div>
                        <div class="step-text">استمر حتى تنتهي من جميع المنازل</div>
                    </div>
                </div>
            </div>

            <div class="instructions">
                <p>🎯 أكمل عملية الجمع مع مراعاة الحمل في كل منزلة</p>
                <p>💡 ابدأ من اليمين (الآحاد) وتحرك نحو اليسار</p>
            </div>

            <div class="addition-area">
                <div class="vertical-addition" id="vertical-addition">
                    <!-- سيتم إنشاء عملية الجمع هنا -->
                </div>

                <div class="place-labels">
                    <div class="place-label">آحاد</div>
                    <div class="place-label">عشرات</div>
                    <div class="place-label">مئات</div>
                    <div class="place-label">آلاف</div>
                    <div class="place-label">عشرات الآلاف</div>
                </div>

                <div class="steps-container" id="steps-container">
                    <div class="step" id="step1">الخطوة 1: اجمع الآحاد</div>
                    <div class="step" id="step2">الخطوة 2: اجمع العشرات مع الحمل</div>
                    <div class="step" id="step3">الخطوة 3: اجمع المئات مع الحمل</div>
                    <div class="step" id="step4">الخطوة 4: اجمع الآلاف مع الحمل</div>
                    <div class="step" id="step5">الخطوة 5: اجمع عشرات الآلاف مع الحمل</div>
                </div>
            </div>

            <div id="feedback" class="feedback"></div>

            <div class="controls">
                <button class="btn" id="check-btn">✅ تحقق من الإجابة</button>
                <button class="btn btn-hint" id="hint-btn">💡 عرض تلميح</button>
                <button class="btn btn-reset" id="reset-btn">🔄 سؤال جديد</button>
            </div>

            <div class="score-container">
                <div class="score-item">
                    <span class="score-label">النقاط</span>
                    <span class="score-value" id="score">0</span>
                </div>
                <div class="score-item">
                    <span class="score-label">السؤال</span>
                    <span class="score-value"><span id="current-question">0</span>/<span id="total-questions">10</span></span>
                </div>
                <div class="score-item">
                    <span class="score-label">المستوى</span>
                    <span class="score-value" id="level">1</span>
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
        const maxRange = {{ $max_range ?? 9999 }};
        const operationType = "{{ $operation_type ?? 'addition' }}";

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let number1 = 0;
        let number2 = 0;
        let correctResult = 0;
        let inputCells = [];
        let carryInputs = [];
        let currentStep = 0;
        let streak = 0;

        // عناصر DOM
        const verticalAdditionElement = document.getElementById('vertical-addition');
        const stepsContainer = document.getElementById('steps-container');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const levelElement = document.getElementById('level');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            checkButton.addEventListener('click', checkAnswer);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', generateQuestion);

            generateQuestion();
        });

        // توليد عددين عشوائيين مع حمل
        function generateRandomNumbersWithCarry() {
            let num1, num2;
            let hasCarry = false;

            // التأكد من وجود حمل في العملية
            do {
                num1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                num2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                hasCarry = checkForCarry(num1, num2);
            } while (!hasCarry || (num1 + num2) > 99999);

            return { num1, num2 };
        }

        // التحقق من وجود حمل
        function checkForCarry(num1, num2) {
            let n1 = num1;
            let n2 = num2;

            for (let i = 0; i < 4; i++) {
                const digit1 = n1 % 10;
                const digit2 = n2 % 10;

                if (digit1 + digit2 >= 10) {
                    return true;
                }

                n1 = Math.floor(n1 / 10);
                n2 = Math.floor(n2 / 10);
            }

            return false;
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();
            updateLevel();

            const numbers = generateRandomNumbersWithCarry();
            number1 = numbers.num1;
            number2 = numbers.num2;
            correctResult = number1 + number2;

            displayVerticalAddition();

            feedbackElement.textContent = 'أكمل عملية الجمع مع مراعاة الحمل';
            feedbackElement.className = 'feedback';
            resetSteps();

            currentStep = 0;
        }

        // عرض الجمع العمودي
        function displayVerticalAddition() {
            const digits1 = getDigits(number1, 5);
            const digits2 = getDigits(number2, 5);

            let html = `
                <div class="carry-row" id="carry-row">
                    <div class="carry-cell"></div>
                    <div class="carry-cell"></div>
                    <div class="carry-cell"></div>
                    <div class="carry-cell"></div>
                    <div class="carry-cell"></div>
                </div>
                <div class="addition-row number1">
                    <div class="digit-cell">${digits1[4]}</div>
                    <div class="digit-cell">${digits1[3]}</div>
                    <div class="digit-cell">${digits1[2]}</div>
                    <div class="digit-cell">${digits1[1]}</div>
                    <div class="digit-cell">${digits1[0]}</div>
                </div>
                <div class="addition-row number2">
                    <div class="digit-cell plus-sign">+</div>
                    <div class="digit-cell">${digits2[4]}</div>
                    <div class="digit-cell">${digits2[3]}</div>
                    <div class="digit-cell">${digits2[2]}</div>
                    <div class="digit-cell">${digits2[1]}</div>
                    <div class="digit-cell">${digits2[0]}</div>
                </div>
                <div class="addition-row result-row" id="result-row">
                    <div class="digit-cell"></div>
                    <div class="digit-cell"></div>
                    <div class="digit-cell"></div>
                    <div class="digit-cell"></div>
                    <div class="digit-cell"></div>
                    <div class="digit-cell"></div>
                </div>
            `;

            verticalAdditionElement.innerHTML = html;
            createInputCells();
        }

        // الحصول على أرقام العدد
        function getDigits(number, length) {
            const digits = new Array(length).fill(0);
            let n = number;

            for (let i = 0; i < length; i++) {
                digits[i] = n % 10;
                n = Math.floor(n / 10);
            }

            return digits;
        }

        // إنشاء خانات الإدخال
        function createInputCells() {
            const resultRow = document.getElementById('result-row');
            const carryRow = document.getElementById('carry-row');

            resultRow.innerHTML = '';
            carryRow.innerHTML = '';
            inputCells = [];
            carryInputs = [];

            // إنشاء خانات الحمل
            for (let i = 0; i < 5; i++) {
                const carryInput = document.createElement('input');
                carryInput.type = 'number';
                carryInput.className = 'carry-input';
                carryInput.max = 1;
                carryInput.min = 0;
                carryInput.placeholder = '0';
                carryInput.addEventListener('input', handleCarryInput);

                const carryCell = document.createElement('div');
                carryCell.className = 'carry-cell';
                carryCell.appendChild(carryInput);
                carryRow.appendChild(carryCell);
                carryInputs.push(carryInput);
            }

            // إنشاء خانات النتيجة
            for (let i = 0; i < 6; i++) {
                const input = document.createElement('input');
                input.type = 'number';
                input.className = 'input-cell';
                input.max = 9;
                input.min = 0;
                input.placeholder = '_';
                input.addEventListener('input', handleResultInput);

                const digitCell = document.createElement('div');
                digitCell.className = 'digit-cell';
                digitCell.appendChild(input);
                resultRow.appendChild(digitCell);
                inputCells.push(input);
            }

            // التركيز على الخانة الأولى
            inputCells[0].focus();
        }

        // معالجة إدخال الحمل
        function handleCarryInput(e) {
            const value = e.target.value;
            if (value > 1) {
                e.target.value = 1;
            }
        }

        // معالجة إدخال النتيجة
        function handleResultInput(e) {
            const value = e.target.value;
            if (value > 9) {
                e.target.value = value.slice(0, 1);
            }
        }

        // إعادة تعيين الخطوات
        function resetSteps() {
            const steps = document.querySelectorAll('.step');
            steps.forEach(step => {
                step.classList.remove('active');
            });
        }

        // عرض التلميح
        function showHint() {
            resetSteps();

            if (currentStep < 5) {
                currentStep++;
            } else {
                currentStep = 1;
            }

            const currentStepElement = document.getElementById(`step${currentStep}`);
            currentStepElement.classList.add('active');

            showStepDetails(currentStep);
        }

        // عرض تفاصيل الخطوة
        function showStepDetails(step) {
            const digits1 = getDigits(number1, 5);
            const digits2 = getDigits(number2, 5);

            let message = '';
            let calculation = '';

            switch(step) {
                case 1:
                    calculation = `${digits1[0]} + ${digits2[0]}`;
                    message = `الآحاد: ${calculation} = ${digits1[0] + digits2[0]}`;
                    if (digits1[0] + digits2[0] >= 10) {
                        message += ` ← اكتب ${(digits1[0] + digits2[0]) % 10} واحمل ${Math.floor((digits1[0] + digits2[0]) / 10)}`;
                    }
                    break;
                case 2:
                    const onesCarry = Math.floor((digits1[0] + digits2[0]) / 10);
                    calculation = `${digits1[1]} + ${digits2[1]} + ${onesCarry}`;
                    message = `العشرات: ${calculation} = ${digits1[1] + digits2[1] + onesCarry}`;
                    if (digits1[1] + digits2[1] + onesCarry >= 10) {
                        message += ` ← اكتب ${(digits1[1] + digits2[1] + onesCarry) % 10} واحمل ${Math.floor((digits1[1] + digits2[1] + onesCarry) / 10)}`;
                    }
                    break;
                case 3:
                    const tensCarry = Math.floor((digits1[1] + digits2[1] + Math.floor((digits1[0] + digits2[0]) / 10)) / 10);
                    calculation = `${digits1[2]} + ${digits2[2]} + ${tensCarry}`;
                    message = `المئات: ${calculation} = ${digits1[2] + digits2[2] + tensCarry}`;
                    if (digits1[2] + digits2[2] + tensCarry >= 10) {
                        message += ` ← اكتب ${(digits1[2] + digits2[2] + tensCarry) % 10} واحمل ${Math.floor((digits1[2] + digits2[2] + tensCarry) / 10)}`;
                    }
                    break;
                case 4:
                    const hundredsCarry = Math.floor((digits1[2] + digits2[2] + Math.floor((digits1[1] + digits2[1] + Math.floor((digits1[0] + digits2[0]) / 10)) / 10)) / 10);
                    calculation = `${digits1[3]} + ${digits2[3]} + ${hundredsCarry}`;
                    message = `الآلاف: ${calculation} = ${digits1[3] + digits2[3] + hundredsCarry}`;
                    if (digits1[3] + digits2[3] + hundredsCarry >= 10) {
                        message += ` ← اكتب ${(digits1[3] + digits2[3] + hundredsCarry) % 10} واحمل ${Math.floor((digits1[3] + digits2[3] + hundredsCarry) / 10)}`;
                    }
                    break;
                case 5:
                    const thousandsCarry = Math.floor((digits1[3] + digits2[3] + Math.floor((digits1[2] + digits2[2] + Math.floor((digits1[1] + digits2[1] + Math.floor((digits1[0] + digits2[0]) / 10)) / 10)) / 10)) / 10);
                    calculation = `${digits1[4]} + ${digits2[4]} + ${thousandsCarry}`;
                    message = `عشرات الآلاف: ${calculation} = ${digits1[4] + digits2[4] + thousandsCarry}`;
                    break;
            }

            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback';
        }

        // التحقق من الإجابة
        function checkAnswer() {
            let userAnswer = '';
            let allFilled = true;

            // جمع الإجابة من الخانات
            for (let i = 5; i >= 0; i--) {
                if (inputCells[i].value === '') {
                    allFilled = false;
                    break;
                }
                userAnswer += inputCells[i].value;
            }

            if (!allFilled) {
                feedbackElement.textContent = '⚠️ يرجى ملء جميع خانات النتيجة!';
                feedbackElement.className = 'feedback incorrect';
                return;
            }

            const userResult = parseInt(userAnswer);

            if (userResult === correctResult) {
                score += 10;
                streak++;
                scoreElement.textContent = score;
                feedbackElement.textContent = getSuccessMessage();
                feedbackElement.className = 'feedback correct';

                // تأثير الاحتفال عند الإجابات الصحيحة المتتالية
                if (streak >= 3) {
                    createCelebration();
                }

                // تلوين الخانات بالإجابة الصحيحة
                inputCells.forEach(cell => {
                    cell.className = 'input-cell correct';
                });

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 2000);
            } else {
                streak = 0;
                feedbackElement.textContent = `❌ إجابة خاطئة. الإجابة الصحيحة هي ${correctResult.toLocaleString('ar-EG')}`;
                feedbackElement.className = 'feedback incorrect';

                // عرض الإجابة الصحيحة
                showCorrectAnswer();
            }
        }

        // عرض الإجابة الصحيحة
        function showCorrectAnswer() {
            const correctDigits = getDigits(correctResult, 6);

            for (let i = 0; i < 6; i++) {
                inputCells[i].value = correctDigits[i];
                inputCells[i].className = 'input-cell correct';
            }
        }

        // الحصول على رسالة نجاح عشوائية
        function getSuccessMessage() {
            const messages = [
                "أحسنت! 🌟 جمع صحيح مع الحمل",
                "رائع! 🎯 فهمت عملية الحمل",
                "إبداع! 💫 أنت تتقن الجمع مع الحمل",
                "ممتاز! ⚡ استمر في التميز",
                "برافو! 👏 جمع ممتاز"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // تحديث المستوى
        function updateLevel() {
            const level = Math.floor(score / 30) + 1;
            levelElement.textContent = level;
        }

        // إنهاء اللعبة
        function endGame() {
            feedbackElement.innerHTML = `
                🎉 <strong>انتهت اللعبة!</strong><br><br>
                ${getFinalMessage()}<br>
                مجموع نقاطك: <strong>${score}</strong> من ${totalQuestions * 10}
            `;
            feedbackElement.className = 'feedback correct';

            checkButton.style.display = 'none';
            hintButton.style.display = 'none';

            createCelebration();
        }

        // الحصول على الرسالة النهائية
        function getFinalMessage() {
            if (score >= 90) {
                return "مذهل! 🏆 أنت خبير في الجمع مع الحمل";
            } else if (score >= 70) {
                return "رائع! ⭐ أداء ممتاز في الجمع";
            } else if (score >= 50) {
                return "جيد جداً! 👍 واصل التعلم";
            } else {
                return "حاول مرة أخرى! 💪 الممارسة تصنع الفرق";
            }
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (questionCount / totalQuestions) * 100;
            progressBar.style.width = `${progress}%`;
        }

        // تأثير الاحتفال
        function createCelebration() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            const colors = ['#4a6fa5', '#3a5a80', '#27ae60', '#e74c3c', '#f39c12', '#3498db'];

            for (let i = 0; i < 120; i++) {
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
            }, 3500);
        }
    </script>
</body>
</html>
