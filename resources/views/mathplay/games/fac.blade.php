<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصنع التحويلات - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 1400px;
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

        .factory-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 968px) {
            .factory-layout {
                grid-template-columns: 1fr;
            }
        }

        .scenarios-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .scenario-card {
            background: white;
            border: 2px solid #ddd;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .scenario-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .scenario-card.active {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .scenario-icon {
            font-size: 2.5em;
            text-align: center;
            margin-bottom: 10px;
        }

        .scenario-details {
            text-align: center;
        }

        .workshop-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .workshop-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .conversion-machine {
            background: #f8f9fa;
            border: 3px dashed #ffb300;
            border-radius: 20px;
            padding: 30px;
            margin: 20px auto;
            max-width: 500px;
            position: relative;
        }

        .input-section, .output-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .conversion-value {
            font-size: 2em;
            font-weight: bold;
            color: #667eea;
            min-width: 100px;
            text-align: center;
        }

        .conversion-unit {
            font-size: 1.3em;
            color: #2d3436;
            font-weight: bold;
        }

        .conversion-arrow {
            font-size: 2.5em;
            color: #ffb300;
            margin: 20px 0;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .conversion-controls {
            background: #e8f4fd;
            border: 2px solid #74b9ff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .conversion-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .conversion-option {
            background: white;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .conversion-option:hover {
            border-color: #667eea;
            transform: scale(1.05);
        }

        .conversion-option.selected {
            border-color: #00b894;
            background: #00b894;
            color: white;
        }

        .conversion-option.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border-color: #00b894;
        }

        .conversion-option.incorrect {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
            border-color: #ff7675;
        }

        .real-life-context {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
        }

        .calculation-steps {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            display: none;
        }

        .calculation-steps.show {
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

        #next-scenario-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        #reset-workshop-btn {
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

        .scenario-image {
            width: 80px;
            height: 80px;
            margin: 0 auto 10px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏭 مصنع التحويلات</h1>
            <p>طبق التحويلات في مواقف حياتية واقعية!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="factory-layout">
            <div class="scenarios-section">
                <h3>🔄 سيناريوهات التحويل</h3>
                
                <div class="scenario-card active" data-scenario="travel">
                    <div class="scenario-icon">🚗</div>
                    <div class="scenario-details">
                        <h4>رحلة بالسيارة</h4>
                        <p>تحويل وحدات المسافة</p>
                    </div>
                </div>

                <div class="scenario-card" data-scenario="cooking">
                    <div class="scenario-icon">👨‍🍳</div>
                    <div class="scenario-details">
                        <h4>وصفة طعام</h4>
                        <p>تحويل وحدات الكتلة</p>
                    </div>
                </div>

                <div class="scenario-card" data-scenario="sports">
                    <div class="scenario-icon">⚽</div>
                    <div class="scenario-details">
                        <h4>مباراة رياضية</h4>
                        <p>تحويل وحدات الزمن</p>
                    </div>
                </div>

                <div class="scenario-card" data-scenario="construction">
                    <div class="scenario-icon">🏗️</div>
                    <div class="scenario-details">
                        <h4>مشروع بناء</h4>
                        <p>تحويل وحدات الطول</p>
                    </div>
                </div>

                <div class="real-life-context">
                    <h4>💡 لماذا نتعلم التحويلات؟</h4>
                    <p>التحويلات مهمة في الحياة اليومية:</p>
                    <ul style="margin-right: 20px; margin-top: 10px;">
                        <li>قراءة خرائط الطرق</li>
                        <li>تحضير الوصفات</li>
                        <li>تنظيم الوقت</li>
                        <li>التخطيط للمشاريع</li>
                    </ul>
                </div>
            </div>
            
            <div class="workshop-area">
                <div class="workshop-display">
                    <h3 id="scenario-title">رحلة بالسيارة</h3>
                    <div class="conversion-machine">
                        <div class="input-section">
                            <div class="conversion-value" id="input-value">120</div>
                            <div class="conversion-unit" id="input-unit">كيلومتر</div>
                        </div>
                        <div class="conversion-arrow">↓</div>
                        <div class="output-section">
                            <div class="conversion-unit" id="output-unit">متر</div>
                            <div class="conversion-value">؟</div>
                        </div>
                    </div>
                    <div class="scenario-description" id="scenario-description">
                        <!-- وصف السيناريو سيظهر هنا -->
                    </div>
                </div>

                <div class="conversion-controls">
                    <h4 style="text-align: center; margin-bottom: 15px;">اختر الإجابة الصحيحة:</h4>
                    <div class="conversion-options" id="conversion-options">
                        <!-- خيارات التحويل ستظهر هنا -->
                    </div>
                </div>

                <div class="calculation-steps" id="calculation-steps">
                    <!-- خطوات الحساب ستظهر هنا -->
                </div>

                <div class="controls">
                    <button id="check-btn">✅ تحقق من الإجابة</button>
                    <button id="hint-btn">💡 الحصول على تلميح</button>
                    <button id="next-scenario-btn" disabled>➡️ السيناريو التالي</button>
                    <button id="reset-workshop-btn">🔄 إعادة الضبط</button>
                </div>
                
                <div class="feedback" id="feedback">
                    اختر السيناريو ثم حدد الإجابة الصحيحة!
                </div>
            </div>
        </div>
        
        <div class="score-board">
            السيناريوهات المكتملة: <span id="completed-scenarios">0</span> | 
            النقاط: <span id="score">0</span> |
            الدقة: <span id="accuracy">0%</span>
        </div>
    </div>

    <script>
        // تعريف السيناريوهات
        const scenarios = {
            travel: {
                title: "رحلة بالسيارة",
                icon: "🚗",
                description: "أنت في رحلة بالسيارة. الخريطة تشير إلى أن المسافة 120 كم. كم متراً هذه المسافة؟",
                inputValue: 120,
                inputUnit: "كيلومتر",
                outputUnit: "متر",
                correctAnswer: 120000,
                explanation: "1 كم = 1000 متر، إذاً 120 كم = 120 × 1000 = 120,000 متر",
                category: "length"
            },
            cooking: {
                title: "وصفة طعام",
                icon: "👨‍🍳",
                description: "تطبخ وصفة تحتاج 2.5 كجم دقيق. كم جراماً من الدقيق تحتاج؟",
                inputValue: 2.5,
                inputUnit: "كيلوجرام",
                outputUnit: "جرام", 
                correctAnswer: 2500,
                explanation: "1 كجم = 1000 جرام، إذاً 2.5 كجم = 2.5 × 1000 = 2,500 جرام",
                category: "mass"
            },
            sports: {
                title: "مباراة رياضية",
                icon: "⚽",
                description: "مباراة كرة القدم تستمر 90 دقيقة. كم ساعة تستغرق المباراة؟",
                inputValue: 90,
                inputUnit: "دقيقة",
                outputUnit: "ساعة",
                correctAnswer: 1.5,
                explanation: "1 ساعة = 60 دقيقة، إذاً 90 دقيقة = 90 ÷ 60 = 1.5 ساعة",
                category: "time"
            },
            construction: {
                title: "مشروع بناء",
                icon: "🏗️",
                description: "يبلغ طول الحائط 450 سم. كم متراً طول الحائط؟",
                inputValue: 450,
                inputUnit: "سنتيمتر", 
                outputUnit: "متر",
                correctAnswer: 4.5,
                explanation: "1 متر = 100 سم، إذاً 450 سم = 450 ÷ 100 = 4.5 متر",
                category: "length"
            }
        };

        // بيانات اللعبة
        const gameData = {
            currentScenario: 'travel',
            completedScenarios: 0,
            totalAttempts: 0,
            score: 0,
            selectedAnswer: null,
            currentProblem: null
        };

        // عناصر DOM
        const scenarioTitleElement = document.getElementById('scenario-title');
        const inputValueElement = document.getElementById('input-value');
        const inputUnitElement = document.getElementById('input-unit');
        const outputUnitElement = document.getElementById('output-unit');
        const scenarioDescriptionElement = document.getElementById('scenario-description');
        const conversionOptionsElement = document.getElementById('conversion-options');
        const calculationStepsElement = document.getElementById('calculation-steps');
        const completedScenariosElement = document.getElementById('completed-scenarios');
        const scoreElement = document.getElementById('score');
        const accuracyElement = document.getElementById('accuracy');
        const feedbackElement = document.getElementById('feedback');
        const checkBtn = document.getElementById('check-btn');
        const hintBtn = document.getElementById('hint-btn');
        const nextScenarioBtn = document.getElementById('next-scenario-btn');
        const resetWorkshopBtn = document.getElementById('reset-workshop-btn');
        const scenarioCards = document.querySelectorAll('.scenario-card');

        // تهيئة اللعبة
        function initGame() {
            setupScenarios();
            loadScenario('travel');
        }

        // إعداد السيناريوهات
        function setupScenarios() {
            scenarioCards.forEach(card => {
                card.addEventListener('click', () => {
                    scenarioCards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    loadScenario(card.dataset.scenario);
                });
            });
        }

        // تحميل السيناريو
        function loadScenario(scenarioId) {
            gameData.currentScenario = scenarioId;
            gameData.selectedAnswer = null;
            
            const scenario = scenarios[scenarioId];
            gameData.currentProblem = scenario;
            
            // تحديث الواجهة
            scenarioTitleElement.textContent = scenario.title;
            inputValueElement.textContent = scenario.inputValue;
            inputUnitElement.textContent = scenario.inputUnit;
            outputUnitElement.textContent = scenario.outputUnit;
            scenarioDescriptionElement.textContent = scenario.description;
            
            // توليد خيارات الإجابة
            generateOptions(scenario.correctAnswer);
            
            // إعادة تعيين
            calculationStepsElement.classList.remove('show');
            checkBtn.disabled = true;
            nextScenarioBtn.disabled = true;
            
            showFeedback('اختر الإجابة الصحيحة للتحويل!', 'info');
        }

        // توليد خيارات الإجابة
        function generateOptions(correctAnswer) {
            const options = [correctAnswer];
            
            // إضافة خيارات خاطئة
            while (options.length < 4) {
                let wrongAnswer;
                if (correctAnswer > 10) {
                    wrongAnswer = correctAnswer + (Math.random() > 0.5 ? 1000 : -1000) * (Math.floor(Math.random() * 3) + 1);
                } else {
                    wrongAnswer = correctAnswer + (Math.random() > 0.5 ? 0.5 : -0.5) * (Math.floor(Math.random() * 3) + 1);
                }
                
                if (!options.includes(wrongAnswer) && wrongAnswer > 0) {
                    options.push(wrongAnswer);
                }
            }
            
            // خلط الخيارات
            options.sort(() => Math.random() - 0.5);
            
            // عرض الخيارات
            conversionOptionsElement.innerHTML = '';
            options.forEach(option => {
                const optionElement = document.createElement('div');
                optionElement.className = 'conversion-option';
                optionElement.textContent = this.formatNumber(option);
                optionElement.addEventListener('click', () => selectAnswer(option, optionElement));
                conversionOptionsElement.appendChild(optionElement);
            });
        }

        // تنسيق الأرقام
        function formatNumber(number) {
            if (number >= 1000) {
                return number.toLocaleString();
            }
            return number.toString();
        }

        // اختيار الإجابة
        function selectAnswer(answer, element) {
            gameData.selectedAnswer = answer;
            
            // تحديث المظهر
            document.querySelectorAll('.conversion-option').forEach(option => {
                option.classList.remove('selected');
            });
            element.classList.add('selected');
            
            checkBtn.disabled = false;
        }

        // التحقق من الإجابة
        function checkAnswer() {
            if (!gameData.selectedAnswer) {
                showFeedback('❌ اختر إجابة أولاً!', 'error');
                return;
            }
            
            const scenario = scenarios[gameData.currentScenario];
            const isCorrect = gameData.selectedAnswer === scenario.correctAnswer;
            
            gameData.totalAttempts++;
            
            // تحديث مظهر الخيارات
            document.querySelectorAll('.conversion-option').forEach(option => {
                if (parseFloat(option.textContent.replace(/,/g, '')) === scenario.correctAnswer) {
                    option.classList.add('correct');
                } else if (option.classList.contains('selected') && !isCorrect) {
                    option.classList.add('incorrect');
                }
            });
            
            if (isCorrect) {
                gameData.score += 20;
                gameData.completedScenarios++;
                showFeedback('🎉 إجابة صحيحة! +20 نقطة', 'success');
                showCalculationSteps();
                nextScenarioBtn.disabled = false;
            } else {
                showFeedback('❌ إجابة خاطئة! راجع طريقة الحل', 'error');
                showCalculationSteps();
            }
            
            checkBtn.disabled = true;
            updateUI();
        }

        // إظهار خطوات الحساب
        function showCalculationSteps() {
            const scenario = scenarios[gameData.currentScenario];
            
            calculationStepsElement.innerHTML = `
                <h4>📝 طريقة الحل:</h4>
                <div class="step">${scenario.explanation}</div>
                <div class="step" style="font-weight: bold; color: #00b894;">
                    الإجابة الصحيحة: ${this.formatNumber(scenario.correctAnswer)} ${scenario.outputUnit}
                </div>
            `;
            
            calculationStepsElement.classList.add('show');
        }

        // إظهار التلميح
        function showHint() {
            const scenario = scenarios[gameData.currentScenario];
            let hint = '';
            
            switch(scenario.category) {
                case 'length':
                    hint = '💡 تلميح: 1 كم = 1000 متر، 1 متر = 100 سم';
                    break;
                case 'mass':
                    hint = '💡 تلميح: 1 كجم = 1000 جرام، 1 جرام = 1000 ملجم';
                    break;
                case 'time':
                    hint = '💡 تلميح: 1 ساعة = 60 دقيقة، 1 دقيقة = 60 ثانية';
                    break;
            }
            
            showFeedback(hint, 'info');
        }

        // السيناريو التالي
        function nextScenario() {
            const scenarioIds = Object.keys(scenarios);
            const currentIndex = scenarioIds.indexOf(gameData.currentScenario);
            const nextIndex = (currentIndex + 1) % scenarioIds.length;
            
            loadScenario(scenarioIds[nextIndex]);
        }

        // إعادة الضبط
        function resetWorkshop() {
            gameData.completedScenarios = 0;
            gameData.totalAttempts = 0;
            gameData.score = 0;
            loadScenario('travel');
            updateUI();
            showFeedback('🔄 تم إعادة الضبط! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            completedScenariosElement.textContent = gameData.completedScenarios;
            scoreElement.textContent = gameData.score;
            
            const accuracy = gameData.totalAttempts > 0 ? 
                Math.round((gameData.completedScenarios / gameData.totalAttempts) * 100) : 0;
            accuracyElement.textContent = `${accuracy}%`;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        checkBtn.addEventListener('click', checkAnswer);
        hintBtn.addEventListener('click', showHint);
        nextScenarioBtn.addEventListener('click', nextScenario);
        resetWorkshopBtn.addEventListener('click', resetWorkshop);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>