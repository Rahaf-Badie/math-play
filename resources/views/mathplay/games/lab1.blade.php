<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مختبر التجارب العشوائية - {{ $lesson_game->lesson->name }}</title>
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

        .concept-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .experiment-types {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin: 15px 0;
        }

        .experiment-type {
            padding: 15px;
            border-radius: 10px;
            border-right: 4px solid;
            background: #f8f9fa;
        }

        .experiment-type.random {
            border-color: #ff7675;
        }

        .experiment-type.certain {
            border-color: #00b894;
        }

        .experiment-type.impossible {
            border-color: #636e72;
        }

        .example-items {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .example-item {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .game-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .experiment-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .experiment-setup {
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 15px;
            padding: 25px;
            margin: 20px auto;
            max-width: 500px;
        }

        .experiment-items {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .experiment-item {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        .experiment-item:hover {
            transform: scale(1.1);
        }

        .experiment-item.selected {
            transform: scale(1.2);
            box-shadow: 0 0 20px gold;
        }

        .experiment-question {
            font-size: 1.3em;
            color: #2d3436;
            margin: 15px 0;
            line-height: 1.6;
        }

        .probability-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .probability-option {
            background: #f8f9fa;
            border: 2px solid #ddd;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1em;
            font-weight: bold;
        }

        .probability-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .probability-option.selected {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }

        .probability-option.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border-color: #00b894;
        }

        .probability-option.incorrect {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
            border-color: #ff7675;
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

        .explanation {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            display: none;
        }

        .explanation.show {
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

        .real-life-example {
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
            <h1>🔬 مختبر التجارب العشوائية</h1>
            <p>اكتشف عالم التجارب العشوائية واحتمالاتها!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="game-layout">
            <div class="learning-panel">
                <div class="concept-card">
                    <h3>🎯 ما هي التجربة العشوائية؟</h3>
                    <p>هي تجربة لا يمكننا توقع نتيجتها بدقة قبل إجرائها</p>
                    <p>نتيجتها تعتمد على <strong>الصدفة والعشوائية</strong></p>
                </div>

                <div class="concept-card">
                    <h3>📊 أنواع التجارب</h3>
                    <div class="experiment-types">
                        <div class="experiment-type random">
                            <strong>🔴 تجربة عشوائية</strong>
                            <p>نتيجتها غير مؤكدة</p>
                            <div class="example-items">
                                <div class="example-item" style="background: #ff7675;">1</div>
                                <div class="example-item" style="background: #74b9ff;">2</div>
                                <div class="example-item" style="background: #00b894;">3</div>
                            </div>
                            <p>مثال: رمي النرد</p>
                        </div>
                        
                        <div class="experiment-type certain">
                            <strong>🟢 تجربة مؤكدة</strong>
                            <p>نتيجتها معروفة مسبقاً</p>
                            <p>مثال: شروق الشمس صباحاً</p>
                        </div>
                        
                        <div class="experiment-type impossible">
                            <strong>⚫ تجربة مستحيلة</strong>
                            <p>لا يمكن أن تحدث</p>
                            <p>مثال: ظهور العدد 7 على نرد عادي</p>
                        </div>
                    </div>
                </div>

                <div class="concept-card">
                    <h3>🔢 عناصر التجربة العشوائية</h3>
                    <div class="rule-item">✅ <strong>فضاء العينة:</strong> جميع النتائج الممكنة</div>
                    <div class="rule-item">🎯 <strong>الحدث:</strong> مجموعة من النتائج المرغوبة</div>
                    <div class="rule-item">📈 <strong>الاحتمال:</strong> فرصة حدوث الحدث</div>
                    
                    <div class="real-life-example">
                        <strong>مثال:</strong> كيس به 3 كرات حمراء و 2 زرقاء
                        <div class="example-items">
                            <div class="example-item" style="background: #ff7675;">🔴</div>
                            <div class="example-item" style="background: #ff7675;">🔴</div>
                            <div class="example-item" style="background: #ff7675;">🔴</div>
                            <div class="example-item" style="background: #74b9ff;">🔵</div>
                            <div class="example-item" style="background: #74b9ff;">🔵</div>
                        </div>
                        <p>• فضاء العينة: {🔴, 🔴, 🔴, 🔵, 🔵}</p>
                        <p>• حدث سحب كرة زرقاء: {🔵, 🔵}</p>
                        <p>• الاحتمال: 2 ÷ 5 = 0.4</p>
                    </div>
                </div>

                <div class="concept-card">
                    <h3>💡 خصائص التجارب العشوائية</h3>
                    <div class="rule-item">يمكن تكرار التجربة عدة مرات</div>
                    <div class="rule-item">النتيجة غير معروفة قبل إجراء التجربة</div>
                    <div class="rule-item">يمكن تحديد جميع النتائج الممكنة</div>
                </div>
            </div>
            
            <div class="game-area">
                <div class="experiment-display">
                    <h3 id="experiment-title">سحب كرة من الكيس</h3>
                    <div class="experiment-setup">
                        <div class="experiment-items" id="experiment-items">
                            <!-- عناصر التجربة ستظهر هنا -->
                        </div>
                    </div>
                    <div class="experiment-question" id="experiment-question">
                        <!-- السؤال سيظهر هنا -->
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
                
                <div class="probability-options" id="probability-options">
                    <!-- خيارات الاحتمال ستظهر هنا -->
                </div>

                <div class="explanation" id="explanation">
                    <!-- الشرح سيظهر هنا -->
                </div>

                <div class="controls">
                    <button id="check-btn">✅ تحقق من الإجابة</button>
                    <button id="hint-btn">💡 الحصول على تلميح</button>
                    <button id="next-btn" disabled>➡️ التجربة التالية</button>
                    <button id="reset-btn">🔄 إعادة اللعبة</button>
                </div>
                
                <div class="feedback" id="feedback">
                    اختر مستوى الاحتمال المناسب ثم اضغط على "تحقق من الإجابة"
                </div>
            </div>
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span> | التجارب: <span id="current-experiment">1</span>/<span id="total-experiments">8</span> |
            المستوى: <span id="level">1</span>
        </div>
    </div>

    <script>
        // بيانات اللعبة
        const gameData = {
            score: 0,
            level: 1,
            currentExperiment: 1,
            totalExperiments: 8,
            selectedOption: null,
            currentScenario: null
        };

        // السيناريوهات
        const scenarios = [
            {
                title: "سحب كرة من الكيس",
                items: [
                    { type: "red", count: 3, color: "#ff7675", emoji: "🔴" },
                    { type: "blue", count: 2, color: "#74b9ff", emoji: "🔵" }
                ],
                question: "ما احتمال سحب كرة زرقاء؟",
                correctAnswer: "محتمل قليلاً",
                explanation: "هناك 2 كرة زرقاء من أصل 5 كرات، إذاً الاحتمال محتمل قليلاً"
            },
            {
                title: "رمي النرد",
                items: [
                    { type: "even", count: 3, color: "#00b894", emoji: "⚪" },
                    { type: "odd", count: 3, color: "#ffb300", emoji: "🟡" }
                ],
                question: "ما احتمال ظهور عدد زوجي؟",
                correctAnswer: "محتمل",
                explanation: "هناك 3 أعداد زوجية من أصل 6، إذاً الاحتمال محتمل"
            },
            {
                title: "سحب بطاقة",
                items: [
                    { type: "heart", count: 1, color: "#ff7675", emoji: "❤️" },
                    { type: "spade", count: 12, color: "#2d3436", emoji: "♠️" }
                ],
                question: "ما احتمال سحب بطاقة قلب؟",
                correctAnswer: "محتمل قليلاً",
                explanation: "هناك 1 بطاقة قلب من أصل 13 بطاقة، إذاً الاحتمال محتمل قليلاً"
            },
            {
                title: "دولاب الحظ",
                items: [
                    { type: "win", count: 2, color: "#00b894", emoji: "🎁" },
                    { type: "lose", count: 6, color: "#ff7675", emoji: "💔" }
                ],
                question: "ما احتمال الفوز؟",
                correctAnswer: "محتمل قليلاً",
                explanation: "هناك 2 فرص للفوز من أصل 8، إذاً الاحتمال محتمل قليلاً"
            },
            {
                title: "صندوق الألوان",
                items: [
                    { type: "red", count: 4, color: "#ff7675", emoji: "🔴" },
                    { type: "blue", count: 1, color: "#74b9ff", emoji: "🔵" }
                ],
                question: "ما احتمال سحب كرة حمراء؟",
                correctAnswer: "محتمل جداً",
                explanation: "هناك 4 كرات حمراء من أصل 5، إذاً الاحتمال محتمل جداً"
            }
        ];

        // خيارات الاحتمال
        const probabilityOptions = [
            "مستحيل",
            "محتمل قليلاً", 
            "محتمل",
            "محتمل جداً",
            "مؤكد"
        ];

        // عناصر DOM
        const experimentTitleElement = document.getElementById('experiment-title');
        const experimentItemsElement = document.getElementById('experiment-items');
        const experimentQuestionElement = document.getElementById('experiment-question');
        const probabilityOptionsElement = document.getElementById('probability-options');
        const explanationElement = document.getElementById('explanation');
        const scoreElement = document.getElementById('score');
        const currentExperimentElement = document.getElementById('current-experiment');
        const totalExperimentsElement = document.getElementById('total-experiments');
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
            generateExperiment();
            updateUI();
        }

        // توليد تجربة جديدة
        function generateExperiment() {
            const randomScenario = scenarios[Math.floor(Math.random() * scenarios.length)];
            gameData.currentScenario = randomScenario;
            gameData.selectedOption = null;
            
            // تحديث الواجهة
            experimentTitleElement.textContent = randomScenario.title;
            experimentQuestionElement.textContent = randomScenario.question;
            
            // عرض عناصر التجربة
            renderExperimentItems(randomScenario.items);
            
            // عرض خيارات الاحتمال
            renderProbabilityOptions();
            
            // إعادة تعيين
            explanationElement.classList.remove('show');
            checkBtn.disabled = false;
            nextBtn.disabled = true;
            
            showFeedback('اختر مستوى الاحتمال المناسب!', 'info');
        }

        // عرض عناصر التجربة
        function renderExperimentItems(items) {
            experimentItemsElement.innerHTML = '';
            
            items.forEach(item => {
                for (let i = 0; i < item.count; i++) {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'experiment-item';
                    itemElement.style.background = item.color;
                    itemElement.textContent = item.emoji;
                    itemElement.title = `${item.type} (${item.count})`;
                    experimentItemsElement.appendChild(itemElement);
                }
            });
        }

        // عرض خيارات الاحتمال
        function renderProbabilityOptions() {
            probabilityOptionsElement.innerHTML = '';
            
            probabilityOptions.forEach(option => {
                const optionElement = document.createElement('div');
                optionElement.className = `probability-option ${gameData.selectedOption === option ? 'selected' : ''}`;
                optionElement.textContent = option;
                optionElement.addEventListener('click', () => selectOption(option));
                probabilityOptionsElement.appendChild(optionElement);
            });
        }

        // اختيار خيار
        function selectOption(option) {
            gameData.selectedOption = option;
            renderProbabilityOptions();
        }

        // التحقق من الإجابة
        function checkAnswer() {
            if (!gameData.selectedOption) {
                showFeedback('❌ اختر مستوى الاحتمال أولاً!', 'error');
                return;
            }
            
            const isCorrect = gameData.selectedOption === gameData.currentScenario.correctAnswer;
            
            if (isCorrect) {
                gameData.score += 10 * gameData.level;
                markCorrectOption();
                showFeedback('🎉 إجابة صحيحة! أحسنت!', 'success');
                showExplanation();
                nextBtn.disabled = false;
            } else {
                markIncorrectOption();
                showFeedback('❌ إجابة خاطئة! راجع الشرح', 'error');
                showExplanation();
            }
            
            checkBtn.disabled = true;
            updateUI();
        }

        // تعليم الخيار الصحيح
        function markCorrectOption() {
            const options = probabilityOptionsElement.children;
            for (let option of options) {
                if (option.textContent === gameData.currentScenario.correctAnswer) {
                    option.classList.add('correct');
                }
            }
        }

        // تعليم الخيار الخاطئ
        function markIncorrectOption() {
            const options = probabilityOptionsElement.children;
            for (let option of options) {
                if (option.textContent === gameData.selectedOption) {
                    option.classList.add('incorrect');
                }
                if (option.textContent === gameData.currentScenario.correctAnswer) {
                    option.classList.add('correct');
                }
            }
        }

        // عرض الشرح
        function showExplanation() {
            explanationElement.innerHTML = `
                <h4>📝 الشرح:</h4>
                <div class="step">${gameData.currentScenario.explanation}</div>
                <div class="step" style="font-weight: bold; color: #00b894;">
                    الإجابة الصحيحة: ${gameData.currentScenario.correctAnswer}
                </div>
            `;
            explanationElement.classList.add('show');
        }

        // الانتقال للتجربة التالية
        function nextExperiment() {
            gameData.currentExperiment++;
            
            if (gameData.currentExperiment > gameData.totalExperiments) {
                gameData.level++;
                gameData.currentExperiment = 1;
                showFeedback(`🚀 تقدم للمستوى ${gameData.level}!`, 'info');
            }
            
            generateExperiment();
            updateUI();
        }

        // إظهار التلميح
        function showHint() {
            const scenario = gameData.currentScenario;
            const totalItems = scenario.items.reduce((sum, item) => sum + item.count, 0);
            
            let hint = `💡 تلميح: احسب عدد النتائج الممكنة (${totalItems}) وقارن بعدد النتائج المرغوبة`;
            
            showFeedback(hint, 'info');
        }

        // إعادة اللعبة
        function resetGame() {
            gameData.score = 0;
            gameData.level = 1;
            gameData.currentExperiment = 1;
            initGame();
            showFeedback('🔄 تم إعادة اللعبة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            currentExperimentElement.textContent = gameData.currentExperiment;
            totalExperimentsElement.textContent = gameData.totalExperiments;
            levelElement.textContent = gameData.level;
            
            const progress = (gameData.currentExperiment / gameData.totalExperiments) * 100;
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
        nextBtn.addEventListener('click', nextExperiment);
        hintBtn.addEventListener('click', showHint);
        resetBtn.addEventListener('click', resetGame);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>