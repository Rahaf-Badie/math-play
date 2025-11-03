<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصنع الكسور العشرية - {{ $lesson_game->lesson->name }}</title>
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

        /* زر العودة إلى الدرس */
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

        .operation-badge {
            display: inline-block;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
            color: #2d3436;
            margin-top: 10px;
            font-size: 1.2rem;
        }

        .factory-layout {
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

        .problem-display {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .fraction-problem {
            font-size: 2.5rem;
            font-weight: bold;
            color: #e84393;
            margin: 20px 0;
            direction: ltr;
        }

        .fraction {
            display: inline-block;
            text-align: center;
            margin: 0 10px;
        }

        .numerator {
            border-bottom: 2px solid #e84393;
            padding: 0 10px;
        }

        .denominator {
            padding: 0 10px;
        }

        .input-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr auto 1fr;
            gap: 15px;
            align-items: center;
            margin: 25px 0;
        }

        .fraction-input {
            width: 100%;
            padding: 15px;
            border: 3px solid #a29bfe;
            border-radius: 15px;
            font-size: 1.5rem;
            text-align: center;
            outline: none;
            transition: all 0.3s ease;
            direction: ltr;
        }

        .fraction-input:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
        }

        .operation-symbol {
            font-size: 2.5rem;
            font-weight: bold;
            color: #636e72;
            text-align: center;
        }

        .equals-symbol {
            font-size: 2.5rem;
            font-weight: bold;
            color: #00b894;
            text-align: center;
        }

        .method-selector {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
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

        .visual-representation {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            min-height: 200px;
        }

        .fraction-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px 0;
        }

        .fraction-bar {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bar {
            width: 100px;
            height: 20px;
            background: #74b9ff;
            margin: 2px 0;
            border-radius: 3px;
        }

        .bar.filled {
            background: #fd79a8;
        }

        .bar-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .step-by-step {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
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

        .factory-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .factory-btn {
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

        #generate-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #check-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #show-steps-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .factory-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .factory-btn:disabled {
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

        .factory-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
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

        .alignment-guide {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
            color: #856404;
        }

        @media (max-width: 768px) {
            .factory-layout {
                grid-template-columns: 1fr;
            }
            
            .method-selector, .factory-stats {
                grid-template-columns: 1fr;
            }
            
            .input-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .fraction-problem {
                font-size: 1.8rem;
            }
            
            .factory-controls {
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
        <!-- زر العودة إلى الدرس -->
        <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-to-lesson">
            ← الرجوع إلى الدرس
        </a>

        <div class="header">
            <h1 class="lesson-title">🏭 مصنع الكسور العشرية الذكي</h1>
            <div class="operation-badge" id="operation-badge">
                @if($operation_type == 'addition')
                    جمع الكسور العشرية
                @else
                    طرح الكسور العشرية
                @endif
            </div>
        </div>
        
        <div class="factory-layout">
            <div class="input-section">
                <div class="section-title">🔢 منطقة الإدخال</div>
                
                <div class="problem-display">
                    <div class="fraction-problem" id="problem-display">
                        <span class="fraction">
                            <div class="numerator" id="num1-numerator">0</div>
                            <div class="denominator" id="num1-denominator">10</div>
                        </span>
                        <span class="operation-symbol" id="operation-symbol">
                            {{ $operation_type == 'addition' ? '+' : '−' }}
                        </span>
                        <span class="fraction">
                            <div class="numerator" id="num2-numerator">0</div>
                            <div class="denominator" id="num2-denominator">10</div>
                        </span>
                        <span class="equals-symbol">=</span>
                        <span class="fraction">
                            <div class="numerator" id="result-numerator">?</div>
                            <div class="denominator" id="result-denominator">10</div>
                        </span>
                    </div>
                </div>
                
                <div class="alignment-guide">
                    💡 تلميح: تأكد من أن المقامات متساوية قبل {{ $operation_type == 'addition' ? 'الجمع' : 'الطرح' }}
                </div>
                
                <div class="input-grid">
                    <input type="number" class="fraction-input" id="numerator1" placeholder="بسط 1" min="0" max="9">
                    <div class="operation-symbol">/</div>
                    <input type="number" class="fraction-input" id="denominator1" placeholder="مقام 1" value="10" readonly>
                    <div class="operation-symbol" id="operation-symbol">
                        {{ $operation_type == 'addition' ? '+' : '−' }}
                    </div>
                    <input type="number" class="fraction-input" id="numerator2" placeholder="بسط 2" min="0" max="9">
                    <div class="operation-symbol">/</div>
                    <input type="number" class="fraction-input" id="denominator2" placeholder="مقام 2" value="10" readonly>
                    <div class="equals-symbol">=</div>
                    <input type="number" class="fraction-input" id="result-numerator-input" placeholder="بسط الناتج">
                    <div class="operation-symbol">/</div>
                    <input type="number" class="fraction-input" id="result-denominator" placeholder="مقام" value="10" readonly>
                </div>
                
                <div class="method-selector">
                    <div class="method-btn active" data-method="visual">التمثيل المرئي</div>
                    <div class="method-btn" data-method="steps">الخطوات الحسابية</div>
                </div>
                
                <div class="factory-controls">
                    <button class="factory-btn" id="generate-btn">
                        🎲 توليد كسور
                    </button>
                    <button class="factory-btn" id="check-btn">
                        ✅ تحقق من الإجابة
                    </button>
                    <button class="factory-btn" id="show-steps-btn">
                        📝 عرض الخطوات
                    </button>
                </div>
                
                <div class="feedback-area" id="feedback-area">
                    أدخل البسوط وانقر على "تحقق من الإجابة"!
                </div>
            </div>
            
            <div class="visualization-section">
                <div class="section-title">🎯 منطقة الشرح المرئي</div>
                
                <div class="visual-representation" id="visual-representation">
                    <div style="text-align: center; color: #636e72; padding: 20px;">
                        سيظهر هنا التمثيل المرئي للكسور العشرية
                    </div>
                </div>
                
                <div class="step-by-step" id="step-by-step">
                    <div style="text-align: center; color: #636e72; padding: 20px;">
                        سيظهر هنا شرح طريقة الحل خطوة بخطوة
                    </div>
                </div>
                
                <div class="factory-stats">
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
        const operationType = "{{ $operation_type }}"; // 'addition' أو 'subtraction'
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let problemsSolved = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalScore = 0;
        let currentMethod = 'visual';
        let currentProblem = null;
        
        // عناصر DOM
        const problemDisplay = document.getElementById('problem-display');
        const numerator1Input = document.getElementById('numerator1');
        const denominator1Input = document.getElementById('denominator1');
        const numerator2Input = document.getElementById('numerator2');
        const denominator2Input = document.getElementById('denominator2');
        const resultNumeratorInput = document.getElementById('result-numerator-input');
        const resultDenominatorInput = document.getElementById('result-denominator');
        const generateBtn = document.getElementById('generate-btn');
        const checkBtn = document.getElementById('check-btn');
        const showStepsBtn = document.getElementById('show-steps-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const visualRepresentation = document.getElementById('visual-representation');
        const stepByStep = document.getElementById('step-by-step');
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
            generateBtn.addEventListener('click', generateNewProblem);
            checkBtn.addEventListener('click', checkAnswer);
            showStepsBtn.addEventListener('click', showSolutionSteps);
            
            // أحداث طرق العرض
            methodButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    methodButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentMethod = this.dataset.method;
                    if (currentProblem) {
                        updateVisualRepresentation();
                    }
                });
            });
            
            // أحداث الإدخال
            [numerator1Input, numerator2Input, resultNumeratorInput].forEach(input => {
                input.addEventListener('input', function() {
                    // السماح فقط بالأرقام من 0 إلى 9
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value > 9) this.value = 9;
                    if (this.value < 0) this.value = 0;
                    
                    updateProblemDisplay();
                });
            });
            
            resultNumeratorInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    checkAnswer();
                }
            });
        }
        
        function generateNewProblem() {
            // توليد كسور عشرية (مقام 10)
            const numerator1 = Math.floor(Math.random() * 9) + 1; // من 1 إلى 9
            const numerator2 = Math.floor(Math.random() * 9) + 1; // من 1 إلى 9
            
            currentProblem = {
                numerator1: numerator1,
                numerator2: numerator2,
                denominator: 10,
                operation: operationType
            };
            
            // تحديث الواجهة
            numerator1Input.value = numerator1;
            numerator2Input.value = numerator2;
            resultNumeratorInput.value = '';
            
            updateProblemDisplay();
            updateVisualRepresentation();
            
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'أدخل بسط الناتج ثم انقر على "تحقق من الإجابة"!';
            
            stepByStep.innerHTML = '<div style="text-align: center; color: #636e72; padding: 20px;">انقر على "عرض الخطوات" لرؤية طريقة الحل</div>';
        }
        
        function updateProblemDisplay() {
            const num1 = numerator1Input.value || '0';
            const num2 = numerator2Input.value || '0';
            
            document.getElementById('num1-numerator').textContent = num1;
            document.getElementById('num2-numerator').textContent = num2;
        }
        
        function updateVisualRepresentation() {
            const numerator1 = parseInt(numerator1Input.value) || 0;
            const numerator2 = parseInt(numerator2Input.value) || 0;
            
            visualRepresentation.innerHTML = '';
            
            if (currentMethod === 'visual') {
                createVisualRepresentation(numerator1, numerator2);
            } else {
                createStepsRepresentation(numerator1, numerator2);
            }
        }
        
        function createVisualRepresentation(num1, num2) {
            const container = document.createElement('div');
            
            // العدد الأول
            const num1Container = document.createElement('div');
            num1Container.style.marginBottom = '30px';
            num1Container.innerHTML = `<div style="text-align: center; margin-bottom: 10px; font-weight: bold;">العدد الأول: ${num1}/10</div>`;
            
            const num1Bars = document.createElement('div');
            num1Bars.className = 'fraction-visual';
            createFractionBars(num1Bars, num1, 10, '#74b9ff');
            num1Container.appendChild(num1Bars);
            
            // العدد الثاني
            const num2Container = document.createElement('div');
            num2Container.style.marginBottom = '30px';
            num2Container.innerHTML = `<div style="text-align: center; margin-bottom: 10px; font-weight: bold;">العدد الثاني: ${num2}/10</div>`;
            
            const num2Bars = document.createElement('div');
            num2Bars.className = 'fraction-visual';
            createFractionBars(num2Bars, num2, 10, '#fd79a8');
            num2Container.appendChild(num2Bars);
            
            container.appendChild(num1Container);
            container.appendChild(num2Container);
            visualRepresentation.appendChild(container);
        }
        
        function createFractionBars(container, numerator, denominator, color) {
            for (let i = 0; i < denominator; i++) {
                const barContainer = document.createElement('div');
                barContainer.className = 'fraction-bar';
                
                const bar = document.createElement('div');
                bar.className = 'bar';
                bar.style.background = i < numerator ? color : '#dfe6e9';
                if (i < numerator) {
                    bar.classList.add('filled');
                }
                
                const label = document.createElement('div');
                label.className = 'bar-label';
                label.textContent = `${i+1}/10`;
                
                barContainer.appendChild(bar);
                barContainer.appendChild(label);
                container.appendChild(barContainer);
            }
        }
        
        function createStepsRepresentation(num1, num2) {
            const container = document.createElement('div');
            container.innerHTML = `
                <div style="text-align: center; margin-bottom: 20px;">
                    <h4>التمثيل الرياضي</h4>
                </div>
                <div style="direction: ltr; text-align: center; font-size: 1.5rem; font-family: monospace;">
                    ${num1}/10 ${operationType === 'addition' ? '+' : '−'} ${num2}/10 = ?
                </div>
            `;
            visualRepresentation.appendChild(container);
        }
        
        function checkAnswer() {
            const userNumerator = parseInt(resultNumeratorInput.value);
            
            if (isNaN(userNumerator)) {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = '❌ يرجى إدخال بسط الناتج!';
                return;
            }
            
            problemsSolved++;
            
            // حساب الناتج الصحيح
            let correctNumerator;
            if (operationType === 'addition') {
                correctNumerator = parseInt(numerator1Input.value) + parseInt(numerator2Input.value);
            } else {
                correctNumerator = parseInt(numerator1Input.value) - parseInt(numerator2Input.value);
            }
            
            const isCorrect = userNumerator === correctNumerator;
            
            if (isCorrect) {
                correctAnswers++;
                currentStreak++;
                totalScore += 10 + (currentStreak * 2);
                
                feedbackArea.className = 'feedback-area feedback-success celebrate';
                feedbackArea.textContent = `🎉 إجابة صحيحة! ${currentStreak > 1 ? `توالي ${currentStreak}!` : ''}`;
                
                document.getElementById('result-numerator').textContent = correctNumerator;
            } else {
                currentStreak = 0;
                totalScore = Math.max(0, totalScore - 5);
                
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = `❌ إجابة خاطئة! الناتج الصحيح هو ${correctNumerator}/10`;
                
                document.getElementById('result-numerator').textContent = correctNumerator;
            }
            
            updateStats();
            showSolutionSteps();
        }
        
        function showSolutionSteps() {
            const num1 = parseInt(numerator1Input.value) || currentProblem.numerator1;
            const num2 = parseInt(numerator2Input.value) || currentProblem.numerator2;
            
            stepByStep.innerHTML = '';
            
            const stepsTitle = document.createElement('h4');
            stepsTitle.textContent = `📝 خطوات ${operationType === 'addition' ? 'جمع' : 'طرح'} ${num1}/10 ${operationType === 'addition' ? '+' : '−'} ${num2}/10`;
            stepsTitle.style.textAlign = 'center';
            stepsTitle.style.marginBottom = '20px';
            stepsTitle.style.color = '#2d3436';
            stepByStep.appendChild(stepsTitle);
            
            const step1 = document.createElement('div');
            step1.className = 'step';
            step1.innerHTML = `<strong>الخطوة 1:</strong> المقامات متساوية (10) لذلك يمكننا ${operationType === 'addition' ? 'جمع' : 'طرح'} البسوط مباشرة`;
            stepByStep.appendChild(step1);
            
            const step2 = document.createElement('div');
            step2.className = 'step';
            
            if (operationType === 'addition') {
                step2.innerHTML = `<strong>الخطوة 2:</strong> جمع البسوط<br>
                ${num1} + ${num2} = ${num1 + num2}`;
            } else {
                step2.innerHTML = `<strong>الخطوة 2:</strong> طرح البسوط<br>
                ${num1} - ${num2} = ${num1 - num2}`;
            }
            
            stepByStep.appendChild(step2);
            
            const step3 = document.createElement('div');
            step3.className = 'step';
            
            let result;
            if (operationType === 'addition') {
                result = num1 + num2;
            } else {
                result = num1 - num2;
            }
            
            step3.innerHTML = `<strong>الخطوة 3:</strong> كتابة الناتج<br>
            ${result}/10`;
            step3.style.borderRightColor = '#00b894';
            stepByStep.appendChild(step3);
            
            if (result > 10 && operationType === 'addition') {
                const step4 = document.createElement('div');
                step4.className = 'step';
                step4.innerHTML = `<strong>الخطوة 4:</strong> تحويل إلى عدد كسري<br>
                ${result}/10 = ${Math.floor(result/10)} و ${result % 10}/10`;
                step4.style.borderRightColor = '#00b894';
                stepByStep.appendChild(step4);
            }
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