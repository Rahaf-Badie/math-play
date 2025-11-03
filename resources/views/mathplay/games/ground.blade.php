<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ساحة التحدي العشري - {{ $lesson_game->lesson->name }}</title>
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

        .operation-display {
            background: #ffb300;
            color: white;
            padding: 10px 30px;
            border-radius: 25px;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
            font-size: 1.1em;
        }

        .challenge-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 968px) {
            .challenge-layout {
                grid-template-columns: 1fr;
            }
        }

        .workshop-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .workspace {
            background: white;
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 20px;
            min-height: 300px;
            margin-bottom: 20px;
            position: relative;
        }

        .decimal-workspace {
            font-family: 'Courier New', monospace;
            font-size: 1.5em;
            line-height: 2;
            direction: ltr;
            text-align: right;
            margin-bottom: 20px;
        }

        .input-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 20px;
        }

        .number-btn {
            background: #f8f9fa;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2em;
            font-weight: bold;
        }

        .number-btn:hover {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .number-btn.operator {
            background: #ffb300;
            color: white;
            border-color: #ffb300;
        }

        .number-btn.clear {
            background: #ff7675;
            color: white;
            border-color: #ff7675;
        }

        .number-btn.equals {
            background: #00b894;
            color: white;
            border-color: #00b894;
        }

        .challenge-section {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .challenge-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .challenge-problem {
            font-size: 2.5em;
            color: #667eea;
            font-weight: bold;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            direction: ltr;
            text-align: center;
        }

        .time-display {
            background: #2d3436;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin: 10px 0;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .option-card {
            background: #f8f9fa;
            border: 2px solid #ddd;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.3em;
            font-weight: bold;
        }

        .option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .option-card.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border-color: #00b894;
            transform: scale(1.05);
        }

        .option-card.incorrect {
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

        #start-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #skip-btn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        #reset-challenge-btn {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        #show-solution-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
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

        .solution-display {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            display: none;
        }

        .solution-display.show {
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

        .user-input {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏟️ ساحة التحدي العشري</h1>
            <p>اختبر سرعتك ودقتك في جمع وطرح الكسور العشرية!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
            <div class="operation-display" id="operation-display">
                <!-- سيتم تعبئته بالجافاسكريبت -->
            </div>
        </div>

        <div class="challenge-layout">
            <div class="workshop-section">
                <h3>🔧 ورشة العمل</h3>
                <div class="workspace">
                    <div class="user-input" id="user-input">
                        ابدأ بالضغط على الأرقام
                    </div>
                    <div class="input-grid">
                        <div class="number-btn" data-value="7">7</div>
                        <div class="number-btn" data-value="8">8</div>
                        <div class="number-btn" data-value="9">9</div>
                        <div class="number-btn clear" data-value="clear">⌫</div>
                        <div class="number-btn" data-value="4">4</div>
                        <div class="number-btn" data-value="5">5</div>
                        <div class="number-btn" data-value="6">6</div>
                        <div class="number-btn" data-value=".">.</div>
                        <div class="number-btn" data-value="1">1</div>
                        <div class="number-btn" data-value="2">2</div>
                        <div class="number-btn" data-value="3">3</div>
                        <div class="number-btn" data-value="0">0</div>
                        <div class="number-btn operator" data-value="+">+</div>
                        <div class="number-btn operator" data-value="-">-</div>
                        <div class="number-btn equals" data-value="=">=</div>
                        <div class="number-btn" data-value="00">00</div>
                    </div>
                </div>
                
                <div class="solution-display" id="solution-display">
                    <!-- الحلول ستظهر هنا -->
                </div>
            </div>
            
            <div class="challenge-section">
                <div class="challenge-header">
                    <h3>⚡ تحدي السرعة</h3>
                    <div class="time-display">
                        ⏱️ الوقت: <span id="timer">60</span> ثانية
                    </div>
                    <div class="challenge-problem" id="challenge-problem">
                        <!-- المسألة ستظهر هنا -->
                    </div>
                </div>
                
                <div class="options-grid" id="options-grid">
                    <!-- الخيارات ستظهر هنا -->
                </div>

                <div class="controls">
                    <button id="start-btn">🎬 بدء التحدي</button>
                    <button id="skip-btn" disabled>⏭️ تخطي</button>
                    <button id="show-solution-btn">🔍 عرض الحل</button>
                    <button id="reset-challenge-btn">🔄 إعادة التحدي</button>
                </div>
                
                <div class="feedback" id="feedback">
                    اضغط على "بدء التحدي" لتبدأ!
                </div>
            </div>
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span> | الإجابات الصحيحة: <span id="correct-answers">0</span> |
            أفضل وقت: <span id="best-time">0</span> ثانية
        </div>
    </div>

    <script>
        // تعريف الدروس المختلفة
        const lessons = {
            'decimal-addition': {
                name: "جمع الأعداد العشرية",
                operation: "addition",
                symbol: "+",
                display: "➕ تحدي الجمع"
            },
            'decimal-subtraction': {
                name: "طرح الأعداد العشرية", 
                operation: "subtraction",
                symbol: "-",
                display: "➖ تحدي الطرح"
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
            correctAnswers: 0,
            bestTime: 0,
            timer: 60,
            isPlaying: false,
            currentChallenge: null,
            userInput: '',
            timerInterval: null
        };

        // عناصر DOM
        const operationDisplayElement = document.getElementById('operation-display');
        const userInputElement = document.getElementById('user-input');
        const solutionDisplayElement = document.getElementById('solution-display');
        const challengeProblemElement = document.getElementById('challenge-problem');
        const optionsGridElement = document.getElementById('options-grid');
        const timerElement = document.getElementById('timer');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const bestTimeElement = document.getElementById('best-time');
        const feedbackElement = document.getElementById('feedback');
        const startBtn = document.getElementById('start-btn');
        const skipBtn = document.getElementById('skip-btn');
        const showSolutionBtn = document.getElementById('show-solution-btn');
        const resetChallengeBtn = document.getElementById('reset-challenge-btn');
        const numberButtons = document.querySelectorAll('.number-btn');

        // الحصول على الدرس الحالي
        function getCurrentLesson() {
            return lessons[gameData.currentLesson];
        }

        // تهيئة اللعبة
        function initGame() {
            setupLessonInfo();
            setupNumberButtons();
            updateUI();
        }

        // إعداد معلومات الدرس
        function setupLessonInfo() {
            const lesson = getCurrentLesson();
            operationDisplayElement.textContent = lesson.display;
        }

        // إعداد أزرار الأرقام
        function setupNumberButtons() {
            numberButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (!gameData.isPlaying) return;
                    
                    const value = button.dataset.value;
                    
                    if (value === 'clear') {
                        gameData.userInput = '';
                    } else if (value === '=') {
                        checkWorkspaceAnswer();
                    } else {
                        gameData.userInput += value;
                    }
                    
                    userInputElement.textContent = gameData.userInput || 'ابدأ بالضغط على الأرقام';
                });
            });
        }

        // بدء التحدي
        function startChallenge() {
            gameData.isPlaying = true;
            gameData.timer = 60;
            gameData.score = 0;
            gameData.correctAnswers = 0;
            
            startTimer();
            generateChallenge();
            
            startBtn.disabled = true;
            skipBtn.disabled = false;
            
            showFeedback('⚡ ابدأ! اختر الإجابة الصحيحة بسرعة!', 'info');
        }

        // بدء المؤقت
        function startTimer() {
            clearInterval(gameData.timerInterval);
            
            gameData.timerInterval = setInterval(() => {
                gameData.timer--;
                timerElement.textContent = gameData.timer;
                
                if (gameData.timer <= 0) {
                    endChallenge();
                }
            }, 1000);
        }

        // توليد تحدي جديد
        function generateChallenge() {
            const lesson = getCurrentLesson();
            
            let num1, num2;
            
            if (lesson.operation === 'addition') {
                num1 = (Math.random() * 20).toFixed(2);
                num2 = (Math.random() * 20).toFixed(2);
            } else {
                num1 = (Math.random() * 20 + 5).toFixed(2);
                num2 = (Math.random() * parseFloat(num1)).toFixed(2);
            }
            
            const correctAnswer = lesson.operation === 'addition' 
                ? (parseFloat(num1) + parseFloat(num2)).toFixed(2)
                : (parseFloat(num1) - parseFloat(num2)).toFixed(2);
            
            gameData.currentChallenge = {
                num1: num1,
                num2: num2,
                operation: lesson.operation,
                symbol: lesson.symbol,
                correctAnswer: correctAnswer
            };
            
            // تحديث واجهة التحدي
            challengeProblemElement.textContent = `${num1} ${lesson.symbol} ${num2}`;
            
            // توليد خيارات عشوائية
            generateOptions(correctAnswer);
        }

        // توليد خيارات الإجابة
        function generateOptions(correctAnswer) {
            const options = [correctAnswer];
            
            // إضافة خيارات خاطئة
            while (options.length < 4) {
                const randomOption = (parseFloat(correctAnswer) + (Math.random() - 0.5) * 4).toFixed(2);
                if (!options.includes(randomOption) && randomOption > 0) {
                    options.push(randomOption);
                }
            }
            
            // خلط الخيارات
            options.sort(() => Math.random() - 0.5);
            
            // عرض الخيارات
            optionsGridElement.innerHTML = '';
            options.forEach(option => {
                const optionElement = document.createElement('div');
                optionElement.className = 'option-card';
                optionElement.textContent = option;
                optionElement.addEventListener('click', () => selectOption(option));
                optionsGridElement.appendChild(optionElement);
            });
        }

        // اختيار خيار الإجابة
        function selectOption(selectedOption) {
            if (!gameData.isPlaying) return;
            
            const correctAnswer = gameData.currentChallenge.correctAnswer;
            const isCorrect = selectedOption === correctAnswer;
            
            // تحديث مظهر الخيارات
            const options = optionsGridElement.children;
            for (let option of options) {
                if (option.textContent === correctAnswer) {
                    option.classList.add('correct');
                } else if (option.textContent === selectedOption && !isCorrect) {
                    option.classList.add('incorrect');
                }
            }
            
            if (isCorrect) {
                gameData.score += 10;
                gameData.correctAnswers++;
                showFeedback('🎉 صحيح! +10 نقاط', 'success');
                
                setTimeout(() => {
                    generateChallenge();
                }, 1500);
            } else {
                showFeedback('❌ خاطئ! حاول في السؤال القادم', 'error');
                
                setTimeout(() => {
                    generateChallenge();
                }, 2000);
            }
            
            updateUI();
        }

        // التحقق من إجابة ورشة العمل
        function checkWorkspaceAnswer() {
            const userAnswer = parseFloat(gameData.userInput);
            const correctAnswer = parseFloat(gameData.currentChallenge.correctAnswer);
            
            if (isNaN(userAnswer)) {
                showFeedback('❌ أدخل إجابة صحيحة أولاً!', 'error');
                return;
            }
            
            const isCorrect = Math.abs(userAnswer - correctAnswer) < 0.01;
            
            if (isCorrect) {
                showFeedback('🎉 أحسنت! الإجابة صحيحة', 'success');
            } else {
                showFeedback('❌ الإجابة خاطئة، حاول مرة أخرى', 'error');
            }
        }

        // عرض الحل
        function showSolution() {
            const challenge = gameData.currentChallenge;
            let solution = '';
            
            if (challenge.operation === 'addition') {
                solution = `
                    <div class="step"><strong>الخطوة 1:</strong> رتب الأعداد</div>
                    <div style="font-family: 'Courier New'; direction: ltr; text-align: right; background: white; padding: 10px; border-radius: 5px; margin: 10px 0;">
                      ${challenge.num1}<br>
                    + ${challenge.num2}<br>
                    ―――――――<br>
                      ${challenge.correctAnswer}
                    </div>
                `;
            } else {
                solution = `
                    <div class="step"><strong>الخطوة 1:</strong> رتب الأعداد</div>
                    <div style="font-family: 'Courier New'; direction: ltr; text-align: right; background: white; padding: 10px; border-radius: 5px; margin: 10px 0;">
                      ${challenge.num1}<br>
                    - ${challenge.num2}<br>
                    ―――――――<br>
                      ${challenge.correctAnswer}
                    </div>
                `;
            }
            
            solutionDisplayElement.innerHTML = solution;
            solutionDisplayElement.classList.add('show');
        }

        // إنهاء التحدي
        function endChallenge() {
            gameData.isPlaying = false;
            clearInterval(gameData.timerInterval);
            
            if (gameData.timer > gameData.bestTime) {
                gameData.bestTime = gameData.timer;
            }
            
            startBtn.disabled = false;
            skipBtn.disabled = true;
            
            showFeedback(`⏰ انتهى الوقت! النقاط النهائية: ${gameData.score}`, 'info');
            updateUI();
        }

        // إعادة التحدي
        function resetChallenge() {
            clearInterval(gameData.timerInterval);
            gameData.isPlaying = false;
            gameData.timer = 60;
            gameData.score = 0;
            gameData.correctAnswers = 0;
            gameData.userInput = '';
            
            userInputElement.textContent = 'ابدأ بالضغط على الأرقام';
            solutionDisplayElement.classList.remove('show');
            startBtn.disabled = false;
            skipBtn.disabled = true;
            
            updateUI();
            showFeedback('🔄 تم إعادة التحدي!', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            correctAnswersElement.textContent = gameData.correctAnswers;
            bestTimeElement.textContent = gameData.bestTime;
            timerElement.textContent = gameData.timer;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        startBtn.addEventListener('click', startChallenge);
        skipBtn.addEventListener('click', () => {
            if (gameData.isPlaying) {
                generateChallenge();
            }
        });
        showSolutionBtn.addEventListener('click', showSolution);
        resetChallengeBtn.addEventListener('click', resetChallenge);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>