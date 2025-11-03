<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ساحر التحويلات - {{ $lesson_game->lesson->name }}</title>
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

        .learning-panel {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .category-tabs {
            display: flex;
            margin-bottom: 20px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .category-tab {
            flex: 1;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .category-tab.active {
            background: #667eea;
            color: white;
            border-bottom-color: #ffb300;
        }

        .conversion-rules {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .rule-item {
            margin-bottom: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            border-right: 4px solid #74b9ff;
        }

        .conversion-example {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
        }

        .game-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .conversion-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .conversion-card {
            background: #f8f9fa;
            border: 2px solid #ddd;
            border-radius: 15px;
            padding: 25px;
            margin: 20px auto;
            max-width: 500px;
        }

        .value-display {
            font-size: 2.5em;
            color: #667eea;
            font-weight: bold;
            margin: 15px 0;
        }

        .unit-display {
            font-size: 1.3em;
            color: #2d3436;
            margin: 10px 0;
        }

        .conversion-arrow {
            font-size: 2em;
            color: #ffb300;
            margin: 15px 0;
        }

        .input-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .conversion-input {
            width: 200px;
            height: 70px;
            border: 3px solid #ddd;
            border-radius: 15px;
            text-align: center;
            font-size: 2em;
            font-weight: bold;
            margin: 0 auto;
            display: block;
            transition: all 0.3s ease;
        }

        .conversion-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 15px rgba(102, 126, 234, 0.3);
            outline: none;
        }

        .conversion-input.correct {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .conversion-input.incorrect {
            border-color: #ff7675;
            background: rgba(255, 118, 117, 0.1);
        }

        .unit-selectors {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .unit-selector {
            text-align: center;
        }

        .unit-dropdown {
            width: 120px;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1em;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
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

        .solution-steps {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            display: none;
        }

        .solution-steps.show {
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

        .real-life-context {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎩 ساحر التحويلات</h1>
            <p>تعلم تحويل وحدات القياس بطريقة سحرية!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="game-layout">
            <div class="learning-panel">
                <div class="category-tabs">
                    <div class="category-tab active" data-category="length">الطول</div>
                    <div class="category-tab" data-category="mass">الكتلة</div>
                    <div class="category-tab" data-category="time">الزمن</div>
                </div>

                <div class="conversion-rules" id="length-rules">
                    <h3>📏 وحدات الطول</h3>
                    <div class="rule-item">1 كيلومتر = 1000 متر</div>
                    <div class="rule-item">1 متر = 100 سنتيمتر</div>
                    <div class="rule-item">1 سنتيمتر = 10 مليمتر</div>
                    <div class="rule-item">1 متر = 1000 مليمتر</div>
                    
                    <div class="conversion-example">
                        <strong>مثال:</strong> 2.5 كم = 2500 متر<br>
                        <strong>طريقة الحل:</strong> 2.5 × 1000 = 2500
                    </div>
                </div>

                <div class="conversion-rules" id="mass-rules" style="display: none;">
                    <h3>⚖️ وحدات الكتلة</h3>
                    <div class="rule-item">1 طن = 1000 كيلوجرام</div>
                    <div class="rule-item">1 كيلوجرام = 1000 جرام</div>
                    <div class="rule-item">1 جرام = 1000 مليجرام</div>
                    <div class="rule-item">1 كيلوجرام = 1000000 مليجرام</div>
                    
                    <div class="conversion-example">
                        <strong>مثال:</strong> 3.5 كجم = 3500 جرام<br>
                        <strong>طريقة الحل:</strong> 3.5 × 1000 = 3500
                    </div>
                </div>

                <div class="conversion-rules" id="time-rules" style="display: none;">
                    <h3>⏰ وحدات الزمن</h3>
                    <div class="rule-item">1 يوم = 24 ساعة</div>
                    <div class="rule-item">1 ساعة = 60 دقيقة</div>
                    <div class="rule-item">1 دقيقة = 60 ثانية</div>
                    <div class="rule-item">1 ساعة = 3600 ثانية</div>
                    
                    <div class="conversion-example">
                        <strong>مثال:</strong> 2.5 ساعة = 150 دقيقة<br>
                        <strong>طريقة الحل:</strong> 2.5 × 60 = 150
                    </div>
                </div>

                <div class="real-life-context">
                    <h4>💡 أمثلة من الحياة:</h4>
                    <p>• طول الملعب: 100 متر = 0.1 كم</p>
                    <p>• وزن التفاحة: 150 جرام = 0.15 كجم</p>
                    <p>• مدة الفيلم: 120 دقيقة = 2 ساعة</p>
                </div>
            </div>
            
            <div class="game-area">
                <div class="conversion-display">
                    <h3>حوّل القيمة التالية:</h3>
                    <div class="conversion-card">
                        <div class="value-display" id="from-value">5</div>
                        <div class="unit-display" id="from-unit">كيلومتر</div>
                        <div class="conversion-arrow">↓</div>
                        <div class="unit-display" id="to-unit">متر</div>
                    </div>
                </div>
                
                <div class="progress-container">
                    <div class="progress-text">
                        التقدم: <span id="progress-text">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" id="progress" style="width: 0%"></div>
                    </div>
                </div>
                
                <div class="input-section">
                    <input type="number" step="0.01" id="conversion-input" class="conversion-input" placeholder="0">
                    
                    <div class="unit-selectors">
                        <div class="unit-selector">
                            <span>من:</span>
                            <select class="unit-dropdown" id="from-unit-select">
                                <!-- سيتم تعبئته بالجافاسكريبت -->
                            </select>
                        </div>
                        <div class="unit-selector">
                            <span>إلى:</span>
                            <select class="unit-dropdown" id="to-unit-select">
                                <!-- سيتم تعبئته بالجافاسكريبت -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="solution-steps" id="solution-steps">
                    <!-- خطوات الحل ستظهر هنا -->
                </div>

                <div class="controls">
                    <button id="check-btn">✅ تحقق من الإجابة</button>
                    <button id="hint-btn">💡 الحصول على تلميح</button>
                    <button id="next-btn" disabled>➡️ السؤال التالي</button>
                    <button id="reset-btn">🔄 إعادة اللعبة</button>
                </div>
                
                <div class="feedback" id="feedback">
                    أدخل القيمة المحولة ثم اضغط على "تحقق من الإجابة"
                </div>
            </div>
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span> | الأسئلة: <span id="current-question">1</span>/<span id="total-questions">10</span> |
            المستوى: <span id="level">1</span>
        </div>
    </div>

    <script>
        // تعريف وحدات القياس
        const measurementUnits = {
            length: {
                name: "الطول",
                units: [
                    { name: "كيلومتر", abbreviation: "كم", factor: 1000 },
                    { name: "متر", abbreviation: "م", factor: 1 },
                    { name: "سنتيمتر", abbreviation: "سم", factor: 0.01 },
                    { name: "مليمتر", abbreviation: "مم", factor: 0.001 }
                ]
            },
            mass: {
                name: "الكتلة",
                units: [
                    { name: "طن", abbreviation: "طن", factor: 1000 },
                    { name: "كيلوجرام", abbreviation: "كجم", factor: 1 },
                    { name: "جرام", abbreviation: "جم", factor: 0.001 },
                    { name: "مليجرام", abbreviation: "ملجم", factor: 0.000001 }
                ]
            },
            time: {
                name: "الزمن",
                units: [
                    { name: "يوم", abbreviation: "يوم", factor: 86400 },
                    { name: "ساعة", abbreviation: "س", factor: 3600 },
                    { name: "دقيقة", abbreviation: "د", factor: 60 },
                    { name: "ثانية", abbreviation: "ث", factor: 1 }
                ]
            }
        };

        // بيانات اللعبة
        const gameData = {
            currentCategory: 'length',
            score: 0,
            level: 1,
            currentQuestion: 1,
            totalQuestions: 10,
            currentProblem: null
        };

        // عناصر DOM
        const categoryTabs = document.querySelectorAll('.category-tab');
        const conversionRules = document.querySelectorAll('.conversion-rules');
        const fromValueElement = document.getElementById('from-value');
        const fromUnitElement = document.getElementById('from-unit');
        const toUnitElement = document.getElementById('to-unit');
        const fromUnitSelect = document.getElementById('from-unit-select');
        const toUnitSelect = document.getElementById('to-unit-select');
        const conversionInput = document.getElementById('conversion-input');
        const solutionStepsElement = document.getElementById('solution-steps');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const levelElement = document.getElementById('level');
        const progressElement = document.getElementById('progress');
        const progressTextElement = document.getElementById('progress-text');
        const feedbackElement = document.getElementById('feedback');
        const checkBtn = document.getElementById('check-btn');
        const nextBtn = document.getElementById('next-btn');
        const hintBtn = document.getElementById('hint-btn');
        const resetBtn = document.getElementById('reset-btn');

        // تهيئة اللعبة
        function initGame() {
            setupCategoryTabs();
            setupUnitSelectors();
            generateProblem();
            updateUI();
        }

        // إعداد تبويبات الفئات
        function setupCategoryTabs() {
            categoryTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const category = tab.dataset.category;
                    
                    categoryTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    
                    conversionRules.forEach(rules => rules.style.display = 'none');
                    document.getElementById(`${category}-rules`).style.display = 'block';
                    
                    gameData.currentCategory = category;
                    setupUnitSelectors();
                    generateProblem();
                });
            });
        }

        // إعداد محددات الوحدات
        function setupUnitSelectors() {
            const category = measurementUnits[gameData.currentCategory];
            
            // تفريغ محددات الوحدات
            fromUnitSelect.innerHTML = '';
            toUnitSelect.innerHTML = '';
            
            // إضافة الوحدات للمحددات
            category.units.forEach(unit => {
                const fromOption = document.createElement('option');
                fromOption.value = unit.name;
                fromOption.textContent = unit.name;
                fromUnitSelect.appendChild(fromOption);
                
                const toOption = document.createElement('option');
                toOption.value = unit.name;
                toOption.textContent = unit.name;
                toUnitSelect.appendChild(toOption);
            });
            
            // اختيار وحدات مختلفة بشكل افتراضي
            toUnitSelect.selectedIndex = 1;
        }

        // توليد مسألة جديدة
        function generateProblem() {
            const category = measurementUnits[gameData.currentCategory];
            const units = category.units;
            
            // اختيار وحدات عشوائية (مختلفة)
            let fromUnitIndex, toUnitIndex;
            do {
                fromUnitIndex = Math.floor(Math.random() * units.length);
                toUnitIndex = Math.floor(Math.random() * units.length);
            } while (fromUnitIndex === toUnitIndex);
            
            const fromUnit = units[fromUnitIndex];
            const toUnit = units[toUnitIndex];
            
            // توليد قيمة عشوائية بين 1 و 20
            const fromValue = (Math.random() * 19 + 1).toFixed(1);
            
            // حساب القيمة الصحيحة
            const conversionFactor = fromUnit.factor / toUnit.factor;
            const correctAnswer = (fromValue * conversionFactor).toFixed(2);
            
            gameData.currentProblem = {
                fromValue: fromValue,
                fromUnit: fromUnit,
                toUnit: toUnit,
                correctAnswer: correctAnswer,
                conversionFactor: conversionFactor
            };
            
            updateProblemDisplay();
            
            // إعادة تعيين الحقول
            conversionInput.value = '';
            conversionInput.className = 'conversion-input';
            solutionStepsElement.classList.remove('show');
            
            // إعادة تعليمات الأزرار
            checkBtn.disabled = false;
            nextBtn.disabled = true;
            
            showFeedback('أدخل القيمة المحولة ثم اضغط على "تحقق من الإجابة"', 'info');
        }

        // تحديث عرض المسألة
        function updateProblemDisplay() {
            const problem = gameData.currentProblem;
            
            fromValueElement.textContent = problem.fromValue;
            fromUnitElement.textContent = problem.fromUnit.name;
            toUnitElement.textContent = problem.toUnit.name;
            
            // تحديث محددات الوحدات
            fromUnitSelect.value = problem.fromUnit.name;
            toUnitSelect.value = problem.toUnit.name;
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseFloat(conversionInput.value);
            const correctAnswer = parseFloat(gameData.currentProblem.correctAnswer);
            
            if (isNaN(userAnswer)) {
                showFeedback('❌ يرجى إدخال إجابة صحيحة!', 'error');
                return;
            }
            
            // السماح بهامش خطأ صغير بسبب التقريب
            const isCorrect = Math.abs(userAnswer - correctAnswer) < 0.01;
            
            if (isCorrect) {
                gameData.score += 10 * gameData.level;
                conversionInput.classList.add('correct');
                showFeedback('🎉 إجابة صحيحة! أحسنت!', 'success');
                nextBtn.disabled = false;
            } else {
                conversionInput.classList.add('incorrect');
                showFeedback('❌ إجابة خاطئة! راجع خطوات الحل', 'error');
                showSolutionSteps();
            }
            
            checkBtn.disabled = true;
            updateUI();
        }

        // إظهار خطوات الحل
        function showSolutionSteps() {
            const problem = gameData.currentProblem;
            const category = measurementUnits[gameData.currentCategory];
            
            let conversionExplanation = '';
            
            if (problem.conversionFactor > 1) {
                conversionExplanation = `للتحويل من ${problem.fromUnit.name} إلى ${problem.toUnit.name} نضرب في ${problem.conversionFactor}`;
            } else {
                conversionExplanation = `للتحويل من ${problem.fromUnit.name} إلى ${problem.toUnit.name} نقسم على ${(1/problem.conversionFactor).toFixed(0)}`;
            }
            
            const steps = [
                `المعطيات: ${problem.fromValue} ${problem.fromUnit.name}`,
                `التحويل المطلوب: إلى ${problem.toUnit.name}`,
                conversionExplanation,
                `الحل: ${problem.fromValue} × ${problem.conversionFactor} = ${problem.correctAnswer}`,
                `الإجابة: ${problem.correctAnswer} ${problem.toUnit.name}`
            ];
            
            solutionStepsElement.innerHTML = steps.map((step, index) => `
                <div class="step">
                    <strong>الخطوة ${index + 1}:</strong> ${step}
                </div>
            `).join('');
            
            solutionStepsElement.classList.add('show');
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

        // إظهار التلميح
        function showHint() {
            const problem = gameData.currentProblem;
            const category = measurementUnits[gameData.currentCategory];
            
            let hint = '';
            
            if (problem.conversionFactor > 1) {
                hint = `💡 تلميح: للتحويل من ${problem.fromUnit.name} إلى ${problem.toUnit.name}، اضرب في ${problem.conversionFactor}`;
            } else {
                hint = `💡 تلميح: للتحويل من ${problem.fromUnit.name} إلى ${problem.toUnit.name}، اقسم على ${(1/problem.conversionFactor).toFixed(0)}`;
            }
            
            showFeedback(hint, 'info');
        }

        // إعادة اللعبة
        function resetGame() {
            gameData.score = 0;
            gameData.level = 1;
            gameData.currentQuestion = 1;
            initGame();
            showFeedback('🔄 تم إعادة اللعبة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            currentQuestionElement.textContent = gameData.currentQuestion;
            totalQuestionsElement.textContent = gameData.totalQuestions;
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

        // تحديث المسألة عند تغيير الوحدات
        fromUnitSelect.addEventListener('change', generateProblem);
        toUnitSelect.addEventListener('change', generateProblem);

        // السماح بالضغط على Enter للإرسال
        conversionInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') checkAnswer();
        });

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>