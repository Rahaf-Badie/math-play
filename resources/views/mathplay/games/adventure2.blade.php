<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مغامرة جمع وطرح الكسور العشرية - {{ $lesson_game->lesson->name }}</title>
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

        .operation-badge {
            background: #ffb300;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
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

        .rules-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .rule-item {
            margin-bottom: 15px;
            padding-right: 30px;
            position: relative;
        }

        .rule-item:before {
            content: "✅";
            position: absolute;
            right: 0;
        }

        .example-section {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .math-example {
            font-family: 'Courier New', monospace;
            font-size: 1.3em;
            text-align: center;
            margin: 15px 0;
            padding: 15px;
            background: white;
            border-radius: 8px;
            direction: ltr;
        }

        .step-by-step {
            font-size: 0.9em;
            color: #666;
            margin-top: 10px;
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

        .math-problem {
            font-size: 3em;
            color: #667eea;
            font-weight: bold;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            direction: ltr;
        }

        .input-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
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

        .decimal-alignment {
            font-family: 'Courier New', monospace;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            direction: ltr;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 مغامرة جمع وطرح الكسور العشرية</h1>
            <p>تحدي العمليات الحسابية مع الكسور العشرية!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
            <div class="operation-badge" id="operation-badge">
                <!-- سيتم تعبئته بالجافاسكريبت -->
            </div>
        </div>

        <div class="game-layout">
            <div class="learning-panel">
                <div class="rules-section">
                    <h3>📝 قواعد الجمع والطرح</h3>
                    <div class="rule-item">رتب الأعداد بحيث تكون الفواصل العشرية تحت بعضها</div>
                    <div class="rule-item">أضف أصفاراً إذا لزم الأمر لتساوي المنازل العشرية</div>
                    <div class="rule-item">اجمع أو اطرح كما تفعل مع الأعداد الصحيحة</div>
                    <div class="rule-item">ضع الفاصلة العشرية في الناتج تحت الفواصل في الأعداد الأصلية</div>
                </div>

                <div class="example-section">
                    <h4>🔍 مثال على <span id="example-type">الجمع</span>:</h4>
                    <div class="math-example" id="math-example">
                        <!-- سيتم تعبئته بالجافاسكريبت -->
                    </div>
                    <div class="step-by-step" id="example-steps">
                        <!-- سيتم تعبئته بالجافاسكريبت -->
                    </div>
                </div>

                <div class="rules-section">
                    <h3>💡 نصائح مهمة</h3>
                    <div class="rule-item">تأكد من محاذاة الفواصل العشرية</div>
                    <div class="rule-item">راجع الناتج للتأكد من وضع الفاصلة في المكان الصحيح</div>
                    <div class="rule-item">في الطرح، تأكد من أن العدد العلوي أكبر من السفلي</div>
                </div>
            </div>
            
            <div class="game-area">
                <div class="problem-display">
                    <h3>حل المسألة التالية:</h3>
                    <div class="math-problem" id="math-problem">
                        <!-- المسألة ستظهر هنا -->
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
                    <input type="number" step="0.01" id="answer-input" class="answer-input" placeholder="0.00">
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
                    أدخل الإجابة ثم اضغط على "تحقق من الإجابة"
                </div>
            </div>
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span> | الأسئلة: <span id="current-question">1</span>/<span id="total-questions">10</span> |
            المستوى: <span id="level">1</span>
        </div>
    </div>

    <script>
        // تعريف الدروس المختلفة
        const lessons = {
            // جمع الأعداد العشرية
            'decimal-addition': {
                name: "جمع الأعداد العشرية",
                operation: "addition",
                symbol: "+",
                badge: "➕ جمع",
                examples: [
                    {
                        problem: "2.5 + 1.3",
                        solution: "3.8",
                        steps: [
                            "رتب الأعداد:  2.5\n            + 1.3",
                            "اجمع الأجزاء العشرية: 5 + 3 = 8",
                            "اجمع الأجزاء الصحيحة: 2 + 1 = 3",
                            "الناتج: 3.8"
                        ]
                    },
                    {
                        problem: "4.75 + 2.25", 
                        solution: "7.00",
                        steps: [
                            "رتب الأعداد:  4.75\n            + 2.25",
                            "اجمع الأجزاء العشرية: 75 + 25 = 100 (نكتب 00 ونضيف 1 للجزء الصحيح)",
                            "اجمع الأجزاء الصحيحة: 4 + 2 + 1 = 7",
                            "الناتج: 7.00"
                        ]
                    }
                ]
            },
            // طرح الأعداد العشرية  
            'decimal-subtraction': {
                name: "طرح الأعداد العشرية",
                operation: "subtraction", 
                symbol: "-",
                badge: "➖ طرح",
                examples: [
                    {
                        problem: "5.8 - 2.3",
                        solution: "3.5",
                        steps: [
                            "رتب الأعداد:  5.8\n            - 2.3", 
                            "اطرح الأجزاء العشرية: 8 - 3 = 5",
                            "اطرح الأجزاء الصحيحة: 5 - 2 = 3",
                            "الناتج: 3.5"
                        ]
                    },
                    {
                        problem: "7.42 - 3.15",
                        solution: "4.27",
                        steps: [
                            "رتب الأعداد:  7.42\n            - 3.15",
                            "اطرح الأجزاء العشرية: 42 - 15 = 27",
                            "اطرح الأجزاء الصحيحة: 7 - 3 = 4", 
                            "الناتج: 4.27"
                        ]
                    }
                ]
            }
        };

        // بيانات اللعبة
        const gameData = {
            currentLesson: '<?php 
                $lessonName = $lesson_game->lesson->name;
                if (strpos($lessonName, 'جمع') !== false) {
                    echo 'decimal-addition';
                } else {
                    echo 'decimal-subtraction';
                }
            ?>',
            score: 0,
            level: 1,
            currentQuestion: 1,
            totalQuestions: 10,
            currentProblem: null
        };

        // عناصر DOM
        const operationBadgeElement = document.getElementById('operation-badge');
        const exampleTypeElement = document.getElementById('example-type');
        const mathExampleElement = document.getElementById('math-example');
        const exampleStepsElement = document.getElementById('example-steps');
        const mathProblemElement = document.getElementById('math-problem');
        const answerInputElement = document.getElementById('answer-input');
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

        // الحصول على الدرس الحالي
        function getCurrentLesson() {
            return lessons[gameData.currentLesson];
        }

        // تهيئة اللعبة
        function initGame() {
            setupLessonInfo();
            generateProblem();
            updateUI();
        }

        // إعداد معلومات الدرس
        function setupLessonInfo() {
            const lesson = getCurrentLesson();
            
            operationBadgeElement.textContent = lesson.badge;
            exampleTypeElement.textContent = lesson.operation === 'addition' ? 'الجمع' : 'الطرح';
            
            // عرض مثال عشوائي
            const randomExample = lesson.examples[Math.floor(Math.random() * lesson.examples.length)];
            mathExampleElement.textContent = randomExample.problem;
            exampleStepsElement.innerHTML = randomExample.steps.map(step => 
                `<div>${step}</div>`
            ).join('');
        }

        // توليد مسألة جديدة
        function generateProblem() {
            const lesson = getCurrentLesson();
            
            let num1, num2;
            
            if (lesson.operation === 'addition') {
                // توليد أعداد للجمع
                num1 = (Math.random() * 10).toFixed(2);
                num2 = (Math.random() * 10).toFixed(2);
            } else {
                // توليد أعداد للطرح (تأكد أن num1 > num2)
                num1 = (Math.random() * 10 + 1).toFixed(2);
                num2 = (Math.random() * parseFloat(num1)).toFixed(2);
            }
            
            const correctAnswer = lesson.operation === 'addition' 
                ? (parseFloat(num1) + parseFloat(num2)).toFixed(2)
                : (parseFloat(num1) - parseFloat(num2)).toFixed(2);
            
            gameData.currentProblem = {
                num1: num1,
                num2: num2,
                operation: lesson.operation,
                symbol: lesson.symbol,
                correctAnswer: correctAnswer
            };
            
            // تحديث واجهة المسألة
            mathProblemElement.textContent = `${num1} ${lesson.symbol} ${num2}`;
            
            // إعادة تعيين الحقول
            answerInputElement.value = '';
            answerInputElement.className = 'answer-input';
            solutionStepsElement.classList.remove('show');
            
            // إعادة تعليمات الأزرار
            checkBtn.disabled = false;
            nextBtn.disabled = true;
            
            showFeedback('أدخل الإجابة ثم اضغط على "تحقق من الإجابة"', 'info');
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseFloat(answerInputElement.value);
            const correctAnswer = parseFloat(gameData.currentProblem.correctAnswer);
            
            if (isNaN(userAnswer)) {
                showFeedback('❌ يرجى إدخال إجابة صحيحة!', 'error');
                return;
            }
            
            const isCorrect = Math.abs(userAnswer - correctAnswer) < 0.01; // تحقق بدقة 0.01
            
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
            const lesson = getCurrentLesson();
            
            let steps = [];
            
            if (lesson.operation === 'addition') {
                steps = [
                    `رتب الأعداد بحيث تكون الفواصل تحت بعضها:`,
                    `<div class="decimal-alignment">  ${problem.num1}\n+ ${problem.num2}</div>`,
                    `اجمع الأجزاء العشرية: ${problem.num1.split('.')[1]} + ${problem.num2.split('.')[1]} = ${(parseInt(problem.num1.split('.')[1]) + parseInt(problem.num2.split('.')[1])).toString().padStart(2, '0')}`,
                    `اجمع الأجزاء الصحيحة: ${problem.num1.split('.')[0]} + ${problem.num2.split('.')[0]} = ${parseInt(problem.num1.split('.')[0]) + parseInt(problem.num2.split('.')[0])}`,
                    `الناتج: ${problem.correctAnswer}`
                ];
            } else {
                steps = [
                    `رتب الأعداد بحيث تكون الفواصل تحت بعضها:`,
                    `<div class="decimal-alignment">  ${problem.num1}\n- ${problem.num2}</div>`,
                    `اطرح الأجزاء العشرية: ${problem.num1.split('.')[1]} - ${problem.num2.split('.')[1]} = ${(parseInt(problem.num1.split('.')[1]) - parseInt(problem.num2.split('.')[1])).toString().padStart(2, '0')}`,
                    `اطرح الأجزاء الصحيحة: ${problem.num1.split('.')[0]} - ${problem.num2.split('.')[0]} = ${parseInt(problem.num1.split('.')[0]) - parseInt(problem.num2.split('.')[0])}`,
                    `الناتج: ${problem.correctAnswer}`
                ];
            }
            
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
            const lesson = getCurrentLesson();
            let hint = '';
            
            if (lesson.operation === 'addition') {
                hint = '💡 تلميح: تذكر محاذاة الفواصل العشرية! رتب الأعداد بحيث تكون النقاط تحت بعضها ثم اجمع كما تفعل مع الأعداد الصحيحة.';
            } else {
                hint = '💡 تلميح: تأكد من محاذاة الفواصل العشرية! إذا احتجت إلى استعارة، تذكر أن 1 من الجزء الصحيح = 10 من الأجزاء العشرية.';
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

        // السماح بالضغط على Enter للإرسال
        answerInputElement.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') checkAnswer();
        });

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>