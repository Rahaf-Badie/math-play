<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مستكشف محيط المستطيل - {{ $lesson_game->lesson->name }}</title>
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

        .rectangle-visual {
            width: 180px;
            height: 120px;
            border: 3px solid #667eea;
            margin: 15px auto;
            position: relative;
            background: rgba(102, 126, 234, 0.1);
        }

        .side-length {
            position: absolute;
            background: #ff7675;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 0.9em;
        }

        .side-top {
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
        }

        .side-right {
            right: -40px;
            top: 50%;
            transform: translateY(-50%);
            writing-mode: vertical-lr;
        }

        .side-bottom {
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
        }

        .side-left {
            left: -40px;
            top: 50%;
            transform: translateY(-50%);
            writing-mode: vertical-lr;
        }

        .formula-box {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
        }

        .example-section {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .game-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .mission-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .rectangle-problem {
            width: 200px;
            height: 140px;
            border: 4px solid #00b894;
            margin: 20px auto;
            position: relative;
            background: rgba(0, 184, 148, 0.1);
        }

        .problem-length {
            position: absolute;
            background: #00b894;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
        }

        .length-top {
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
        }

        .length-right {
            right: -50px;
            top: 50%;
            transform: translateY(-50%);
            writing-mode: vertical-lr;
        }

        .problem-text {
            font-size: 1.3em;
            color: #2d3436;
            margin: 15px 0;
        }

        .input-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .dimensions-input {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .dimension-group {
            text-align: center;
        }

        .dimension-label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .dimension-input {
            width: 100px;
            height: 60px;
            border: 3px solid #ddd;
            border-radius: 10px;
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .dimension-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
            outline: none;
        }

        .answer-input {
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

        .answer-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 15px rgba(102, 126, 234, 0.3);
            outline: none;
        }

        .answer-input.correct {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .answer-input.incorrect {
            border-color: #ff7675;
            background: rgba(255, 118, 117, 0.1);
        }

        .unit-selector {
            text-align: center;
            margin-top: 15px;
        }

        .unit-btn {
            display: inline-block;
            padding: 8px 15px;
            margin: 0 5px;
            border: 2px solid #ddd;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .unit-btn.active {
            border-color: #667eea;
            background: #667eea;
            color: white;
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
            <h1>🎯 مستكشف محيط المستطيل</h1>
            <p>تعلم وتدرب على حساب محيط المستطيل بطريقة ممتعة!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="game-layout">
            <div class="learning-panel">
                <div class="concept-card">
                    <h3>📐 ما هو المستطيل؟</h3>
                    <p>المستطيل هو شكل رباعي جميع زواياه قائمة (90 درجة) وكل ضلعين متقابلين متساويين</p>
                    <div class="rectangle-visual">
                        <div class="side-length side-top">الطول</div>
                        <div class="side-length side-right">العرض</div>
                        <div class="side-length side-bottom">الطول</div>
                        <div class="side-length side-left">العرض</div>
                    </div>
                </div>

                <div class="concept-card">
                    <h3>📏 ما هو المحيط؟</h3>
                    <p>المحيط هو <strong>مجموع أطوال جميع أضلاع الشكل</strong></p>
                    <div class="formula-box">
                        محيط المستطيل = (الطول + العرض) × 2
                    </div>
                    <div style="text-align: center; font-size: 1.5em; margin: 10px 0;">
                        P = 2 × (L + W)
                    </div>
                </div>

                <div class="example-section">
                    <h4>🔍 مثال تطبيقي:</h4>
                    <div class="real-life-example">
                        <strong>مثال:</strong> مستطيل طوله 5 متر وعرضه 3 متر<br>
                        <strong>الحل:</strong> المحيط = 2 × (5 + 3) = 2 × 8 = 16 متر
                    </div>
                    <div class="step-by-step">
                        <div class="step">الخطوة 1: اجمع الطول والعرض: 5 + 3 = 8</div>
                        <div class="step">الخطوة 2: اضرب الناتج في 2: 2 × 8 = 16</div>
                        <div class="step">الخطوة 3: المحيط = 16 متر</div>
                    </div>
                </div>

                <div class="concept-card">
                    <h3>💡 نصائح مهمة</h3>
                    <div class="rule-item">تأكد من تحديد الطول والعرض بشكل صحيح</div>
                    <div class="rule-item">لا تنس ضرب مجموع الطول والعرض في 2</div>
                    <div class="rule-item">اكتب وحدة القياس مع الإجابة</div>
                </div>
            </div>
            
            <div class="game-area">
                <div class="mission-display">
                    <h3>احسب محيط المستطيل التالي:</h3>
                    <div class="rectangle-problem" id="rectangle-visual">
                        <div class="problem-length length-top" id="length-display">8 سم</div>
                        <div class="problem-length length-right" id="width-display">5 سم</div>
                    </div>
                    <div class="problem-text" id="problem-text">
                        مستطيل طوله <span id="length-value">8</span> سم وعرضه <span id="width-value">5</span> سم
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
                    <div class="dimensions-input">
                        <div class="dimension-group">
                            <span class="dimension-label">الطول:</span>
                            <input type="number" id="length-input" class="dimension-input" value="8" min="1" max="50">
                        </div>
                        <div class="dimension-group">
                            <span class="dimension-label">العرض:</span>
                            <input type="number" id="width-input" class="dimension-input" value="5" min="1" max="50">
                        </div>
                    </div>
                    <input type="number" id="answer-input" class="answer-input" placeholder="0">
                    <div class="unit-selector">
                        <span>الوحدة:</span>
                        <span class="unit-btn active" data-unit="سم">سم</span>
                        <span class="unit-btn" data-unit="م">م</span>
                        <span class="unit-btn" data-unit="مم">مم</span>
                    </div>
                </div>

                <div class="solution-steps" id="solution-steps">
                    <!-- خطوات الحل ستظهر هنا -->
                </div>

                <div class="controls">
                    <button id="update-btn">🔄 تحديث المسألة</button>
                    <button id="check-btn">✅ تحقق من الإجابة</button>
                    <button id="hint-btn">💡 الحصول على تلميح</button>
                    <button id="next-btn" disabled>➡️ السؤال التالي</button>
                    <button id="reset-btn">🔄 إعادة اللعبة</button>
                </div>
                
                <div class="feedback" id="feedback">
                    أدخل محيط المستطيل ثم اضغط على "تحقق من الإجابة"
                </div>
            </div>
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span> | الأسئلة: <span id="current-question">1</span>/<span id="total-questions">8</span> |
            المستوى: <span id="level">1</span>
        </div>
    </div>

    <script>
        // بيانات اللعبة
        const gameData = {
            score: 0,
            level: 1,
            currentQuestion: 1,
            totalQuestions: 8,
            currentUnit: 'سم',
            currentProblem: null
        };

        // عناصر DOM
        const rectangleVisualElement = document.getElementById('rectangle-visual');
        const lengthDisplayElement = document.getElementById('length-display');
        const widthDisplayElement = document.getElementById('width-display');
        const lengthValueElement = document.getElementById('length-value');
        const widthValueElement = document.getElementById('width-value');
        const problemTextElement = document.getElementById('problem-text');
        const lengthInputElement = document.getElementById('length-input');
        const widthInputElement = document.getElementById('width-input');
        const answerInputElement = document.getElementById('answer-input');
        const solutionStepsElement = document.getElementById('solution-steps');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const levelElement = document.getElementById('level');
        const progressElement = document.getElementById('progress');
        const progressTextElement = document.getElementById('progress-text');
        const feedbackElement = document.getElementById('feedback');
        const updateBtn = document.getElementById('update-btn');
        const checkBtn = document.getElementById('check-btn');
        const nextBtn = document.getElementById('next-btn');
        const hintBtn = document.getElementById('hint-btn');
        const resetBtn = document.getElementById('reset-btn');
        const unitButtons = document.querySelectorAll('.unit-btn');

        // تهيئة اللعبة
        function initGame() {
            setupUnitButtons();
            setupInputListeners();
            generateProblem();
            updateUI();
        }

        // إعداد أزرار الوحدات
        function setupUnitButtons() {
            unitButtons.forEach(button => {
                button.addEventListener('click', () => {
                    unitButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    gameData.currentUnit = button.dataset.unit;
                    updateProblemDisplay();
                });
            });
        }

        // إعداد مستمعي الإدخال
        function setupInputListeners() {
            lengthInputElement.addEventListener('input', updateProblemFromInputs);
            widthInputElement.addEventListener('input', updateProblemFromInputs);
        }

        // تحديث المسألة من المدخلات
        function updateProblemFromInputs() {
            const length = parseInt(lengthInputElement.value) || 1;
            const width = parseInt(widthInputElement.value) || 1;
            
            // التأكد من أن الطول أكبر من العرض للمستطيل
            const adjustedLength = Math.max(length, width);
            const adjustedWidth = Math.min(length, width);
            
            lengthInputElement.value = adjustedLength;
            widthInputElement.value = adjustedWidth;
            
            gameData.currentProblem = {
                length: adjustedLength,
                width: adjustedWidth,
                perimeter: 2 * (adjustedLength + adjustedWidth),
                unit: gameData.currentUnit
            };
            
            updateProblemDisplay();
        }

        // توليد مسألة جديدة
        function generateProblem() {
            // توليد أبعاد عشوائية بين 3 و 20
            const length = Math.floor(Math.random() * 18) + 3;
            const width = Math.floor(Math.random() * (length - 1)) + 2;
            
            gameData.currentProblem = {
                length: length,
                width: width,
                perimeter: 2 * (length + width),
                unit: gameData.currentUnit
            };
            
            // تحديث المدخلات
            lengthInputElement.value = length;
            widthInputElement.value = width;
            
            updateProblemDisplay();
            
            // إعادة تعيين الحقول
            answerInputElement.value = '';
            answerInputElement.className = 'answer-input';
            solutionStepsElement.classList.remove('show');
            
            // إعادة تعليمات الأزرار
            checkBtn.disabled = false;
            nextBtn.disabled = true;
            
            showFeedback('أدخل محيط المستطيل ثم اضغط على "تحقق من الإجابة"', 'info');
        }

        // تحديث عرض المسألة
        function updateProblemDisplay() {
            const problem = gameData.currentProblem;
            
            lengthDisplayElement.textContent = `${problem.length} ${problem.unit}`;
            widthDisplayElement.textContent = `${problem.width} ${problem.unit}`;
            lengthValueElement.textContent = problem.length;
            widthValueElement.textContent = problem.width;
            problemTextElement.textContent = `مستطيل طوله ${problem.length} ${problem.unit} وعرضه ${problem.width} ${problem.unit}`;
            
            // تحديث حجم المستطيل المرئي (نسبي)
            const maxSize = 200;
            const scale = maxSize / Math.max(problem.length, problem.width);
            rectangleVisualElement.style.width = `${problem.length * scale}px`;
            rectangleVisualElement.style.height = `${problem.width * scale}px`;
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseInt(answerInputElement.value);
            const correctAnswer = gameData.currentProblem.perimeter;
            
            if (isNaN(userAnswer)) {
                showFeedback('❌ يرجى إدخال إجابة صحيحة!', 'error');
                return;
            }
            
            const isCorrect = userAnswer === correctAnswer;
            
            if (isCorrect) {
                gameData.score += 10 * gameData.level;
                answerInputElement.classList.add('correct');
                showFeedback('🎉 إجابة صحيحة! أحسنت!', 'success');
                nextBtn.disabled = false;
            } else {
                answerInputElement.classList.add('incorrect');
                showFeedback('❌ إجابة خاطئة! راجع خطوات الحل', 'error');
                showSolutionSteps();
            }
            
            checkBtn.disabled = true;
            updateUI();
        }

        // إظهار خطوات الحل
        function showSolutionSteps() {
            const problem = gameData.currentProblem;
            
            const steps = [
                `المعطيات: الطول = ${problem.length} ${problem.unit}, العرض = ${problem.width} ${problem.unit}`,
                `القانون: محيط المستطيل = 2 × (الطول + العرض)`,
                `الحل: 2 × (${problem.length} + ${problem.width}) = 2 × ${problem.length + problem.width}`,
                `الإجابة: المحيط = ${problem.perimeter} ${problem.unit}`
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
            const hint = `💡 تلميح: استخدم القانون: محيط المستطيل = 2 × (الطول + العرض). الطول هو ${problem.length} ${problem.unit} والعرض هو ${problem.width} ${problem.unit}`;
            
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
        updateBtn.addEventListener('click', () => {
            updateProblemFromInputs();
            showFeedback('🔄 تم تحديث المسألة!', 'info');
        });
        checkBtn.addEventListener('click', checkAnswer);
        nextBtn.addEventListener('click', nextQuestion);
        hintBtn.addEventListener('click', showHint);
        resetBtn.addEventListener('click', resetGame);

        // السماح بالضغط على Enter للإرسال
        answerInputElement.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') checkAnswer();
        });

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>