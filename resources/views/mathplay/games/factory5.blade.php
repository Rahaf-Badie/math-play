<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصنع الضرب الذكي - {{ $lesson_game->lesson->name }}</title>
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
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            max-width: 1200px;
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
            z-index: 10;
        }

        .back-to-lesson:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #d63031 0%, #c23616 100%);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 10px;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.3rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .lesson-info {
            display: inline-block;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
            color: #2d3436;
            margin-top: 10px;
        }

        .factory-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .input-section {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 25px;
            border: 3px solid #e9ecef;
        }

        .visualization-section {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
            font-weight: bold;
            font-size: 1.4rem;
        }

        .visualization-section .section-title {
            color: white;
        }

        .multiplication-display {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .multiplication-formula {
            font-size: 3rem;
            font-weight: bold;
            color: #e84393;
            margin: 20px 0;
            direction: ltr;
            text-align: center;
        }

        .input-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr auto 1fr;
            gap: 15px;
            align-items: center;
            margin: 25px 0;
        }

        .number-input {
            width: 100%;
            padding: 20px;
            border: 3px solid #a29bfe;
            border-radius: 15px;
            font-size: 2rem;
            text-align: center;
            outline: none;
            transition: all 0.3s ease;
            direction: ltr;
        }

        .number-input:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
        }

        .operation-symbol {
            font-size: 3rem;
            font-weight: bold;
            color: #636e72;
            text-align: center;
        }

        .equals-symbol {
            font-size: 3rem;
            font-weight: bold;
            color: #00b894;
            text-align: center;
            margin: 0 20px;
        }

        .method-selector {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .method-btn {
            background: white;
            border: 3px solid #dfe6e9;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            color: #2d3436;
        }

        .method-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .method-btn.active {
            border-color: #00b894;
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .calculation-steps {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            min-height: 200px;
        }

        .step {
            margin: 15px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            border-right: 5px solid #74b9ff;
            direction: ltr;
            text-align: left;
        }

        .visual-grid {
            display: grid;
            gap: 10px;
            margin: 20px 0;
            justify-content: center;
        }

        .grid-row {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .grid-cell {
            width: 30px;
            height: 30px;
            background: #ffeaa7;
            border: 2px solid #fdcb6e;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .grid-header {
            background: #74b9ff;
            color: white;
            border-color: #0984e3;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .action-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #calculate-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #show-steps-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #new-problem-btn {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .action-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback-area {
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

        .feedback-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback-error {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .feedback-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .stat-card {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            border: 3px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .factory-container {
                grid-template-columns: 1fr;
            }

            .method-selector, .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .input-grid {
                grid-template-columns: 1fr;
            }

            .controls {
                flex-direction: column;
            }

            .multiplication-formula {
                font-size: 2rem;
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

        /* تأثيرات الرسوم المتحركة */
        @keyframes celebrate {
            0% { transform: translateY(0px); }
            25% { transform: translateY(-10px); }
            50% { transform: translateY(0px); }
            75% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        .celebrate {
            animation: celebrate 0.5s ease-in-out;
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
            <h1 class="lesson-title">🏭 مصنع الضرب الذكي</h1>
            <div class="lesson-info">
                @if($lesson_game->id == 114)
                    ضرب عددين من منزلتين في عدد من منزلتين
                @elseif($lesson_game->id == 115)
                    ضرب عدد من 3 منازل في عدد من منزلتين
                @endif
            </div>
        </div>

        <div class="factory-container">
            <div class="input-section">
                <div class="section-title">🔢 أدخل الأعداد</div>

                <div class="multiplication-display">
                    <div class="multiplication-formula" id="formula-display">
                        __ × __ = ?
                    </div>
                </div>

                <div class="input-grid">
                    <input type="number" class="number-input" id="number1" placeholder="العدد الأول" min="10" max="999">
                    <div class="operation-symbol">×</div>
                    <input type="number" class="number-input" id="number2" placeholder="العدد الثاني" min="10" max="99">
                    <div class="equals-symbol">=</div>
                    <input type="number" class="number-input" id="result-input" placeholder="الناتج">
                </div>

                <div class="method-selector">
                    <div class="method-btn" data-method="traditional">الطريقة التقليدية</div>
                    <div class="method-btn" data-method="area">نموذج المساحة</div>
                    <div class="method-btn" data-method="distributive">خاصية التوزيع</div>
                </div>

                <div class="controls">
                    <button class="action-btn" id="calculate-btn">
                        🧮 احسب
                    </button>
                    <button class="action-btn" id="show-steps-btn">
                        📝 عرض الخطوات
                    </button>
                    <button class="action-btn" id="new-problem-btn">
                        🔄 مسألة جديدة
                    </button>
                </div>

                <div class="feedback-area" id="feedback-area">
                    أدخل الأعداد وانقر على "احسب" للبدء!
                </div>
            </div>

            <div class="visualization-section">
                <div class="section-title">🎯 منطقة الشرح المرئي</div>

                <div class="calculation-steps" id="steps-container">
                    <div style="text-align: center; color: #636e72; padding: 20px;">
                        سيظهر هنا شرح طريقة الحل خطوة بخطوة
                    </div>
                </div>

                <div class="visual-grid" id="visual-grid">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>

                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-value" id="problems-solved">0</div>
                        <div class="stat-label">مسائل محلولة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="correct-answers">0</div>
                        <div class="stat-label">إجابات صحيحة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="current-streak">0</div>
                        <div class="stat-label">التوالي الحالي</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="total-score">0</div>
                        <div class="stat-label">مجموع النقاط</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const lessonId = {{ $lesson_game->id }};
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};

        // تحديد نطاق الأعداد بناءً على الـ ID
        let number1Range, number2Range;
        if (lessonId === 114) {
            // ضرب عددين من منزلتين في عدد من منزلتين
            number1Range = { min: 10, max: 99 };
            number2Range = { min: 10, max: 99 };
        } else if (lessonId === 115) {
            // ضرب عدد من 3 منازل في عدد من منزلتين
            number1Range = { min: 100, max: 999 };
            number2Range = { min: 10, max: 99 };
        }

        // متغيرات اللعبة
        let problemsSolved = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalScore = 0;
        let currentMethod = 'traditional';
        let currentProblem = null;

        // عناصر DOM
        const number1Input = document.getElementById('number1');
        const number2Input = document.getElementById('number2');
        const resultInput = document.getElementById('result-input');
        const formulaDisplay = document.getElementById('formula-display');
        const calculateBtn = document.getElementById('calculate-btn');
        const showStepsBtn = document.getElementById('show-steps-btn');
        const newProblemBtn = document.getElementById('new-problem-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const stepsContainer = document.getElementById('steps-container');
        const visualGrid = document.getElementById('visual-grid');
        const methodButtons = document.querySelectorAll('.method-btn');
        const problemsSolvedElement = document.getElementById('problems-solved');
        const correctAnswersElement = document.getElementById('correct-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const totalScoreElement = document.getElementById('total-score');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            generateNewProblem();
            updateStats();
        });

        function setupEventListeners() {
            calculateBtn.addEventListener('click', calculateResult);
            showStepsBtn.addEventListener('click', showCalculationSteps);
            newProblemBtn.addEventListener('click', generateNewProblem);

            // أحداث طرق الحل
            methodButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    methodButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentMethod = this.dataset.method;
                    if (currentProblem) {
                        showCalculationSteps();
                    }
                });
            });

            // أحداث الإدخال - إصلاح مشكلة عدم قبول الأرقام
            [number1Input, number2Input, resultInput].forEach(input => {
                input.addEventListener('input', function() {
                    const value = this.value;

                    // السماح فقط بالأرقام
                    this.value = value.replace(/[^0-9]/g, '');

                    if (this.id === 'number1') {
                        const numValue = parseInt(this.value) || 0;
                        if (numValue < number1Range.min || numValue > number1Range.max) {
                            this.style.borderColor = '#ff7675';
                        } else {
                            this.style.borderColor = '#a29bfe';
                        }
                    } else if (this.id === 'number2') {
                        const numValue = parseInt(this.value) || 0;
                        if (numValue < number2Range.min || numValue > number2Range.max) {
                            this.style.borderColor = '#ff7675';
                        } else {
                            this.style.borderColor = '#a29bfe';
                        }
                    }
                    updateFormulaDisplay();
                });

                // السماح بالنسخ واللصق
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const text = e.clipboardData.getData('text');
                    this.value = text.replace(/[^0-9]/g, '');
                    updateFormulaDisplay();
                });
            });

            resultInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    calculateResult();
                }
            });
        }

        function generateNewProblem() {
            // توليد أعداد عشوائية ضمن النطاق المحدد
            const num1 = Math.floor(Math.random() * (number1Range.max - number1Range.min + 1)) + number1Range.min;
            const num2 = Math.floor(Math.random() * (number2Range.max - number2Range.min + 1)) + number2Range.min;

            currentProblem = {
                number1: num1,
                number2: num2,
                result: num1 * num2
            };

            // تحديث الواجهة
            number1Input.value = '';
            number2Input.value = '';
            resultInput.value = '';
            number1Input.style.borderColor = '#a29bfe';
            number2Input.style.borderColor = '#a29bfe';

            updateFormulaDisplay();

            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'أدخل الأعداد ثم احسب الناتج!';

            stepsContainer.innerHTML = '<div style="text-align: center; color: #636e72; padding: 20px;">سيظهر هنا شرح طريقة الحل خطوة بخطوة</div>';
            visualGrid.innerHTML = '';
        }

        function updateFormulaDisplay() {
            const num1 = number1Input.value || '__';
            const num2 = number2Input.value || '__';
            formulaDisplay.textContent = `${num1} × ${num2} = ?`;
        }

        function calculateResult() {
            const num1 = parseInt(number1Input.value);
            const num2 = parseInt(number2Input.value);
            const userResult = parseInt(resultInput.value);

            // التحقق من صحة الإدخال
            if (!num1 || !num2 || !userResult) {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = '❌ يرجى إدخال جميع الأعداد!';
                return;
            }

            if (num1 < number1Range.min || num1 > number1Range.max) {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = `❌ العدد الأول يجب أن يكون بين ${number1Range.min} و ${number1Range.max}`;
                return;
            }

            if (num2 < number2Range.min || num2 > number2Range.max) {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = `❌ العدد الثاني يجب أن يكون بين ${number2Range.min} و ${number2Range.max}`;
                return;
            }

            problemsSolved++;

            // التحقق من الإجابة
            const correctResult = num1 * num2;
            const isCorrect = userResult === correctResult;

            if (isCorrect) {
                correctAnswers++;
                currentStreak++;
                totalScore += 10 + (currentStreak * 2);

                feedbackArea.className = 'feedback-area feedback-success celebrate';
                feedbackArea.textContent = `🎉 إجابة صحيحة! ${currentStreak > 1 ? `توالي ${currentStreak}!` : ''}`;
            } else {
                currentStreak = 0;
                totalScore = Math.max(0, totalScore - 5);

                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = `❌ إجابة خاطئة! الناتج الصحيح هو ${correctResult}`;
            }

            updateStats();
            showCalculationSteps();
        }

        function showCalculationSteps() {
            const num1 = parseInt(number1Input.value) || currentProblem?.number1;
            const num2 = parseInt(number2Input.value) || currentProblem?.number2;

            if (!num1 || !num2) {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = '❌ يرجى إدخال الأعداد أولاً!';
                return;
            }

            stepsContainer.innerHTML = '';
            visualGrid.innerHTML = '';

            const stepsTitle = document.createElement('h4');
            stepsTitle.textContent = `📝 خطوات ضرب ${num1} × ${num2}`;
            stepsTitle.style.textAlign = 'center';
            stepsTitle.style.marginBottom = '20px';
            stepsTitle.style.color = '#2d3436';
            stepsContainer.appendChild(stepsTitle);

            if (currentMethod === 'traditional') {
                showTraditionalMethod(num1, num2);
            } else if (currentMethod === 'area') {
                showAreaModel(num1, num2);
            } else if (currentMethod === 'distributive') {
                showDistributiveMethod(num1, num2);
            }
        }

        function showTraditionalMethod(num1, num2) {
            const step1 = document.createElement('div');
            step1.className = 'step';
            step1.innerHTML = `<strong>الخطوة 1:</strong> نضرب العدد ${num2} في آحاد العدد ${num1}<br>${num2} × ${num1 % 10} = ${num2 * (num1 % 10)}`;
            stepsContainer.appendChild(step1);

            if (num1 >= 10) {
                const step2 = document.createElement('div');
                step2.className = 'step';
                step2.innerHTML = `<strong>الخطوة 2:</strong> نضرب العدد ${num2} في عشرات العدد ${num1}<br>${num2} × ${Math.floor(num1 / 10)} = ${num2 * Math.floor(num1 / 10)} (نضيف صفراً)`;
                stepsContainer.appendChild(step2);
            }

            if (num1 >= 100) {
                const step3 = document.createElement('div');
                step3.className = 'step';
                step3.innerHTML = `<strong>الخطوة 3:</strong> نضرب العدد ${num2} في مئات العدد ${num1}<br>${num2} × ${Math.floor(num1 / 100)} = ${num2 * Math.floor(num1 / 100)} (نضيف صفرين)`;
                stepsContainer.appendChild(step3);
            }

            const finalStep = document.createElement('div');
            finalStep.className = 'step';
            finalStep.innerHTML = `<strong>الخطوة النهائية:</strong> نجمع النواتج الجزئية<br>${num1} × ${num2} = ${num1 * num2}`;
            finalStep.style.borderRightColor = '#00b894';
            stepsContainer.appendChild(finalStep);
        }

        function showAreaModel(num1, num2) {
            // تحليل الأعداد إلى منازل
            const num1Digits = [];
            let temp = num1;
            while (temp > 0) {
                num1Digits.unshift(temp % 10);
                temp = Math.floor(temp / 10);
            }

            const num2Digits = [];
            temp = num2;
            while (temp > 0) {
                num2Digits.unshift(temp % 10);
                temp = Math.floor(temp / 10);
            }

            // إنشاء شبكة المساحة
            visualGrid.style.gridTemplateColumns = `repeat(${num2Digits.length + 1}, auto)`;

            // رؤوس الأعمدة (العدد الثاني)
            const headerRow = document.createElement('div');
            headerRow.className = 'grid-row';
            headerRow.appendChild(createGridCell('×', 'grid-header'));
            num2Digits.forEach(digit => {
                headerRow.appendChild(createGridCell(digit, 'grid-header'));
            });
            visualGrid.appendChild(headerRow);

            // الصفوف (العدد الأول)
            num1Digits.forEach((digit, index) => {
                const row = document.createElement('div');
                row.className = 'grid-row';
                row.appendChild(createGridCell(digit, 'grid-header'));

                num2Digits.forEach(digit2 => {
                    row.appendChild(createGridCell(digit * digit2));
                });

                visualGrid.appendChild(row);
            });

            // شرح الطريقة
            const explanation = document.createElement('div');
            explanation.className = 'step';
            explanation.innerHTML = `<strong>نموذج المساحة:</strong><br>
            نقسم ${num1} إلى ${num1Digits.join(' + ')}<br>
            ونقسم ${num2} إلى ${num2Digits.join(' + ')}<br>
            ثم نضرب كل جزء في كل جزء ونجمع النتائج`;
            stepsContainer.appendChild(explanation);
        }

        function showDistributiveMethod(num1, num2) {
            const step1 = document.createElement('div');
            step1.className = 'step';
            step1.innerHTML = `<strong>الخطوة 1:</strong> نقسم العدد ${num1} إلى أجزاء<br>${num1} = ${Math.floor(num1 / 10) * 10} + ${num1 % 10}`;
            stepsContainer.appendChild(step1);

            const step2 = document.createElement('div');
            step2.className = 'step';
            step2.innerHTML = `<strong>الخطوة 2:</strong> نطبق خاصية التوزيع<br>${num2} × (${Math.floor(num1 / 10) * 10} + ${num1 % 10})`;
            stepsContainer.appendChild(step2);

            const step3 = document.createElement('div');
            step3.className = 'step';
            step3.innerHTML = `<strong>الخطوة 3:</strong> نوزع الضرب<br>(${num2} × ${Math.floor(num1 / 10) * 10}) + (${num2} × ${num1 % 10})`;
            stepsContainer.appendChild(step3);

            const step4 = document.createElement('div');
            step4.className = 'step';
            step4.innerHTML = `<strong>الخطوة 4:</strong> نحسب كل جزء<br>${num2 * Math.floor(num1 / 10) * 10} + ${num2 * (num1 % 10)}`;
            stepsContainer.appendChild(step4);

            const finalStep = document.createElement('div');
            finalStep.className = 'step';
            finalStep.innerHTML = `<strong>الخطوة النهائية:</strong> نجمع النواتج<br>${num1} × ${num2} = ${num1 * num2}`;
            finalStep.style.borderRightColor = '#00b894';
            stepsContainer.appendChild(finalStep);
        }

        function createGridCell(content, className = '') {
            const cell = document.createElement('div');
            cell.className = `grid-cell ${className}`;
            cell.textContent = content;
            return cell;
        }

        function updateStats() {
            problemsSolvedElement.textContent = problemsSolved;
            correctAnswersElement.textContent = correctAnswers;
            currentStreakElement.textContent = currentStreak;
            totalScoreElement.textContent = totalScore;
        }
    </script>
</body>
</html>
