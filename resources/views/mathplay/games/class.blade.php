<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ساحة القسمة - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 1000px;
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

        @media (max-width: 768px) {
            .game-layout {
                grid-template-columns: 1fr;
            }
        }

        .rules-panel {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .current-rule {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .rule-icon {
            font-size: 3em;
            margin-bottom: 10px;
        }

        .rule-description {
            font-size: 1.1em;
            margin: 10px 0;
            color: #2d3436;
        }

        .rule-example {
            background: #e8f4fd;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
            font-size: 0.9em;
        }

        .game-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .challenge-area {
            text-align: center;
            margin-bottom: 25px;
        }

        .challenge-number {
            font-size: 4em;
            color: #667eea;
            font-weight: bold;
            margin: 15px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .challenge-question {
            font-size: 1.3em;
            color: #2d3436;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            display: inline-block;
        }

        .answers-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .answer-option {
            background: #f8f9fa;
            border: 2px solid #ddd;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2em;
            font-weight: bold;
        }

        .answer-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .answer-option.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border-color: #00b894;
            transform: scale(1.05);
        }

        .answer-option.incorrect {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
            border-color: #ff7675;
        }

        .answer-option.selected {
            border-color: #667eea;
            background: #667eea;
            color: white;
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

        #submit-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #next-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
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

        .lesson-progress {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 ساحة القسمة</h1>
            <p>اختبر معرفتك بقواعد القسمة بطريقة مسلية!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="game-layout">
            <div class="rules-panel">
                <div class="current-rule" id="current-rule">
                    <!-- سيتم تحديث قاعدة القسمة هنا -->
                </div>
                
                <h3>📖 قواعد سريعة:</h3>
                <ul style="list-style: none; padding: 0; margin-top: 15px;">
                    <li style="margin-bottom: 10px; padding-right: 20px;">✅ <strong>القسمة على 2:</strong> رقم الآحاد زوجي</li>
                    <li style="margin-bottom: 10px; padding-right: 20px;">✅ <strong>القسمة على 3:</strong> مجموع الأرقام يقبل القسمة على 3</li>
                    <li style="margin-bottom: 10px; padding-right: 20px;">✅ <strong>القسمة على 4:</strong> آخر رقمين يقبلان القسمة على 4</li>
                    <li style="margin-bottom: 10px; padding-right: 20px;">✅ <strong>القسمة على 5:</strong> رقم الآحاد 0 أو 5</li>
                </ul>
            </div>
            
            <div class="game-area">
                <div class="challenge-area">
                    <h3>هل هذا العدد يقبل القسمة على:</h3>
                    <div class="challenge-number" id="challenge-number">?</div>
                    <div class="challenge-question" id="challenge-question">?</div>
                </div>
                
                <div class="progress-container">
                    <div class="progress-text">
                        تقدم اللعبة: <span id="progress-text">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" id="progress" style="width: 0%"></div>
                    </div>
                    <div class="lesson-progress">
                        <span>السؤال: <span id="current-q">1</span>/<span id="total-q">10</span></span>
                        <span>المستوى: <span id="current-level">1</span></span>
                    </div>
                </div>
                
                <div class="answers-grid" id="answers-grid">
                    <!-- خيارات الإجابة ستضاف هنا -->
                </div>
                
                <div class="explanation" id="explanation">
                    <!-- الشرح سيضاف هنا -->
                </div>

                <div class="controls">
                    <button id="submit-btn">✅ تأكيد الإجابة</button>
                    <button id="hint-btn">💡 الحصول على تلميح</button>
                    <button id="next-btn" disabled>➡️ السؤال التالي</button>
                    <button id="reset-btn">🔄 إعادة اللعبة</button>
                </div>
                
                <div class="feedback" id="feedback">
                    اختر الإجابة الصحيحة!
                </div>
            </div>
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span> | الإجابات الصحيحة: <span id="correct-answers">0</span> | 
            الدروس المكتملة: <span id="completed-lessons">0</span>/4
        </div>
    </div>

    <script>
        // تعريف الدروس المختلفة
        const lessons = {
            110: {
                id: 110,
                name: "قابلية القسمة على 2",
                divisor: 2,
                rule: "العدد الزوجي (رقم الآحاد 0, 2, 4, 6, 8)",
                checkFunction: (num) => num % 2 === 0,
                icon: "🔢",
                examples: [14, 26, 38, 50, 62, 74, 86, 98]
            },
            111: {
                id: 111,
                name: "قابلية القسمة على 3", 
                divisor: 3,
                rule: "مجموع أرقام العدد يقبل القسمة على 3",
                checkFunction: (num) => {
                    const sum = num.toString().split('').reduce((acc, digit) => acc + parseInt(digit), 0);
                    return sum % 3 === 0;
                },
                icon: "🔢",
                examples: [12, 15, 18, 21, 24, 27, 30, 33]
            },
            112: {
                id: 112,
                name: "قابلية القسمة على 4",
                divisor: 4,
                rule: "آخر رقمين من العدد يقبلان القسمة على 4",
                checkFunction: (num) => num % 4 === 0,
                icon: "🔢",
                examples: [12, 16, 20, 24, 28, 32, 36, 40]
            },
            113: {
                id: 113,
                name: "قابلية القسمة على 5",
                divisor: 5,
                rule: "رقم آحاد العدد هو 0 أو 5",
                checkFunction: (num) => num % 5 === 0,
                icon: "🔢",
                examples: [15, 20, 25, 30, 35, 40, 45, 50]
            }
        };

        // بيانات اللعبة
        const gameData = {
            currentLessonId: <?php echo $lesson_game->lesson->id; ?>,
            score: 0,
            level: 1,
            currentQuestion: 1,
            totalQuestions: 10,
            correctAnswersCount: 0,
            completedLessons: new Set(),
            selectedAnswer: null,
            currentChallenge: null
        };

        // عناصر DOM
        const currentRuleElement = document.getElementById('current-rule');
        const challengeNumberElement = document.getElementById('challenge-number');
        const challengeQuestionElement = document.getElementById('challenge-question');
        const answersGrid = document.getElementById('answers-grid');
        const explanationElement = document.getElementById('explanation');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const completedLessonsElement = document.getElementById('completed-lessons');
        const currentQElement = document.getElementById('current-q');
        const totalQElement = document.getElementById('total-q');
        const currentLevelElement = document.getElementById('current-level');
        const progressElement = document.getElementById('progress');
        const progressTextElement = document.getElementById('progress-text');
        const feedbackElement = document.getElementById('feedback');
        const submitBtn = document.getElementById('submit-btn');
        const nextBtn = document.getElementById('next-btn');
        const hintBtn = document.getElementById('hint-btn');
        const resetBtn = document.getElementById('reset-btn');

        // الحصول على الدرس الحالي
        function getCurrentLesson() {
            return lessons[gameData.currentLessonId];
        }

        // تهيئة اللعبة
        function initGame() {
            updateCurrentRule();
            generateChallenge();
            updateUI();
        }

        // تحديث قاعدة القسمة المعروضة
        function updateCurrentRule() {
            const lesson = getCurrentLesson();
            currentRuleElement.innerHTML = `
                <div class="rule-icon">${lesson.icon}</div>
                <h3>القسمة على ${lesson.divisor}</h3>
                <div class="rule-description">${lesson.rule}</div>
                <div class="rule-example">
                    <strong>أمثلة:</strong> ${lesson.examples.slice(0, 3).join(', ')}...
                </div>
            `;
        }

        // توليد تحدي جديد
        function generateChallenge() {
            const lesson = getCurrentLesson();
            gameData.selectedAnswer = null;
            
            // توليد عدد عشوائي
            const randomNum = Math.floor(Math.random() * 100) + 1;
            gameData.currentChallenge = {
                number: randomNum,
                correctAnswer: lesson.checkFunction(randomNum)
            };
            
            // تحديث واجهة التحدي
            challengeNumberElement.textContent = randomNum;
            challengeQuestionElement.textContent = `هل ${randomNum} يقبل القسمة على ${lesson.divisor}؟`;
            
            // توليد خيارات الإجابة
            renderAnswerOptions();
            
            // إعادة تعليمات الأزرار
            submitBtn.disabled = false;
            nextBtn.disabled = true;
            explanationElement.classList.remove('show');
        }

        // عرض خيارات الإجابة
        function renderAnswerOptions() {
            answersGrid.innerHTML = '';
            
            const options = [
                { text: 'نعم ✅', value: true },
                { text: 'لا ❌', value: false }
            ];
            
            options.forEach(option => {
                const optionElement = document.createElement('div');
                optionElement.className = `answer-option ${gameData.selectedAnswer === option.value ? 'selected' : ''}`;
                optionElement.textContent = option.text;
                optionElement.addEventListener('click', () => selectAnswer(option.value));
                answersGrid.appendChild(optionElement);
            });
        }

        // اختيار الإجابة
        function selectAnswer(answer) {
            gameData.selectedAnswer = answer;
            renderAnswerOptions();
        }

        // التحقق من الإجابة
        function checkAnswer() {
            if (gameData.selectedAnswer === null) {
                showFeedback('❌ اختر إجابة أولاً!', 'error');
                return;
            }
            
            const isCorrect = gameData.selectedAnswer === gameData.currentChallenge.correctAnswer;
            const lesson = getCurrentLesson();
            
            // تحديث مظهر خيارات الإجابة
            const options = answersGrid.children;
            for (let option of options) {
                const isYesOption = option.textContent.includes('نعم');
                const isCorrectOption = (isYesOption === gameData.currentChallenge.correctAnswer);
                
                if (isCorrectOption) {
                    option.classList.add('correct');
                } else if (option.classList.contains('selected') && !isCorrectOption) {
                    option.classList.add('incorrect');
                }
            }
            
            // عرض الشرح
            showExplanation(isCorrect, lesson);
            
            if (isCorrect) {
                gameData.score += 10 * gameData.level;
                gameData.correctAnswersCount++;
                showFeedback('🎉 إجابة صحيحة! أحسنت!', 'success');
            } else {
                showFeedback('❌ إجابة خاطئة! حاول مرة أخرى في السؤال القادم', 'error');
            }
            
            submitBtn.disabled = true;
            nextBtn.disabled = false;
            updateUI();
        }

        // عرض الشرح
        function showExplanation(isCorrect, lesson) {
            const num = gameData.currentChallenge.number;
            let explanation = '';
            
            if (isCorrect) {
                explanation = `<strong>🎯 إجابة صحيحة!</strong><br>`;
            } else {
                explanation = `<strong>📝 دعنا نتعلم معاً:</strong><br>`;
            }
            
            switch(lesson.divisor) {
                case 2:
                    const lastDigit = num % 10;
                    const isEven = lastDigit % 2 === 0;
                    explanation += `العدد ${num} - رقم الآحاد هو ${lastDigit}<br>`;
                    explanation += isEven ? 
                        `بما أن ${lastDigit} زوجي، إذاً ${num} يقبل القسمة على 2 ✅` :
                        `بما أن ${lastDigit} فردي، إذاً ${num} لا يقبل القسمة على 2 ❌`;
                    break;
                    
                case 3:
                    const digits = num.toString().split('').map(Number);
                    const sum = digits.reduce((a, b) => a + b, 0);
                    explanation += `العدد ${num} - أرقامه: ${digits.join(' + ')} = ${sum}<br>`;
                    explanation += (sum % 3 === 0) ?
                        `بما أن ${sum} ÷ 3 = ${sum/3}، إذاً ${num} يقبل القسمة على 3 ✅` :
                        `بما أن ${sum} لا يقبل القسمة على 3، إذاً ${num} لا يقبل القسمة على 3 ❌`;
                    break;
                    
                case 4:
                    const lastTwoDigits = num % 100;
                    explanation += `العدد ${num} - آخر رقمين هما ${lastTwoDigits}<br>`;
                    explanation += (lastTwoDigits % 4 === 0) ?
                        `بما أن ${lastTwoDigits} ÷ 4 = ${lastTwoDigits/4}، إذاً ${num} يقبل القسمة على 4 ✅` :
                        `بما أن ${lastTwoDigits} لا يقبل القسمة على 4، إذاً ${num} لا يقبل القسمة على 4 ❌`;
                    break;
                    
                case 5:
                    const onesDigit = num % 10;
                    explanation += `العدد ${num} - رقم الآحاد هو ${onesDigit}<br>`;
                    explanation += (onesDigit === 0 || onesDigit === 5) ?
                        `بما أن رقم الآحاد هو ${onesDigit}، إذاً ${num} يقبل القسمة على 5 ✅` :
                        `بما أن رقم الآحاد هو ${onesDigit} (ليس 0 أو 5)، إذاً ${num} لا يقبل القسمة على 5 ❌`;
                    break;
            }
            
            explanationElement.innerHTML = explanation;
            explanationElement.classList.add('show');
        }

        // الانتقال للسؤال التالي
        function nextQuestion() {
            gameData.currentQuestion++;
            
            if (gameData.currentQuestion > gameData.totalQuestions) {
                // إكمال الدرس الحالي
                gameData.completedLessons.add(gameData.currentLessonId);
                
                // الانتقال للمستوى التالي أو درس جديد
                if (gameData.completedLessons.size === Object.keys(lessons).length) {
                    gameData.level++;
                    gameData.completedLessons.clear();
                    showFeedback(`🚀 مبروك! أكملت جميع الدروس! تقدم للمستوى ${gameData.level}`, 'success');
                } else {
                    // اختيار درس لم يكتمل بعد
                    const incompleteLessons = Object.keys(lessons).filter(id => 
                        !gameData.completedLessons.has(parseInt(id))
                    );
                    const randomLessonId = incompleteLessons[Math.floor(Math.random() * incompleteLessons.length)];
                    gameData.currentLessonId = parseInt(randomLessonId);
                    showFeedback(`📚 انتقل لدرس جديد: ${lessons[randomLessonId].name}`, 'info');
                }
                
                gameData.currentQuestion = 1;
            }
            
            generateChallenge();
            updateCurrentRule();
            updateUI();
        }

        // إظهار التلميح
        function showHint() {
            const lesson = getCurrentLesson();
            let hint = '';
            
            switch(lesson.divisor) {
                case 2:
                    hint = '💡 انظر إلى رقم الآحاد - الأعداد الزوجية تنتهي ب 0, 2, 4, 6, 8';
                    break;
                case 3:
                    hint = '💡 اجمع جميع أرقام العدد - إذا كان المجموع يقبل القسمة على 3 فالعدد يقبل القسمة على 3';
                    break;
                case 4:
                    hint = '💡 انظر إلى آخر رقمين فقط - إذا كانا يشكلان عدداً يقبل القسمة على 4';
                    break;
                case 5:
                    hint = '💡 انظر إلى رقم الآحاد - يجب أن يكون 0 أو 5';
                    break;
            }
            
            showFeedback(hint, 'info');
        }

        // إعادة اللعبة
        function resetGame() {
            gameData.score = 0;
            gameData.level = 1;
            gameData.currentQuestion = 1;
            gameData.correctAnswersCount = 0;
            gameData.completedLessons.clear();
            initGame();
            showFeedback('🔄 تم إعادة اللعبة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            correctAnswersElement.textContent = gameData.correctAnswersCount;
            completedLessonsElement.textContent = gameData.completedLessons.size;
            currentQElement.textContent = gameData.currentQuestion;
            totalQElement.textContent = gameData.totalQuestions;
            currentLevelElement.textContent = gameData.level;
            
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
        submitBtn.addEventListener('click', checkAnswer);
        nextBtn.addEventListener('click', nextQuestion);
        hintBtn.addEventListener('click', showHint);
        resetBtn.addEventListener('click', resetGame);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>