<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صائد الأعداد القابلة للقسمة - {{ $lesson_game->lesson->name }}</title>
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

        .rules-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #74b9ff;
        }

        .rules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .rule-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            border-top: 4px solid;
        }

        .rule-card.divisible-2 { border-color: #ff7675; }
        .rule-card.divisible-3 { border-color: #74b9ff; }
        .rule-card.divisible-4 { border-color: #55efc4; }
        .rule-card.divisible-5 { border-color: #a29bfe; }

        .rule-icon {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .rule-examples {
            font-size: 0.9em;
            color: #666;
            margin-top: 10px;
        }

        .game-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .current-target {
            text-align: center;
            margin-bottom: 30px;
        }

        .target-number {
            font-size: 3em;
            color: #667eea;
            font-weight: bold;
            margin: 10px 0;
        }

        .target-rule {
            font-size: 1.5em;
            color: #2d3436;
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
        }

        .numbers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .number-card {
            background: #f8f9fa;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .number-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .number-card.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border-color: #00b894;
        }

        .number-card.incorrect {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
            border-color: #ff7675;
        }

        .number-card.selected {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
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

        #reset-btn {
            background: linear-gradient(135deg, #ff7675, #e84393);
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

        .progress-bar {
            width: 100%;
            height: 10px;
            background: #f8f9fa;
            border-radius: 5px;
            margin: 20px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #00b894, #00a085);
            border-radius: 5px;
            transition: width 0.3s ease;
        }

        .lesson-indicator {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .lesson-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ddd;
            transition: all 0.3s ease;
        }

        .lesson-dot.active {
            background: #667eea;
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .rules-grid {
                grid-template-columns: 1fr;
            }
            
            .numbers-grid {
                grid-template-columns: repeat(auto-fit, minmax(60px, 1fr));
            }
            
            .controls {
                flex-direction: column;
            }
            
            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 صائد الأعداد القابلة للقسمة</h1>
            <p>تعلم قواعد القسمة بطريقة تفاعلية وممتعة!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <!-- قسم القواعد -->
        <div class="rules-section">
            <h2>📚 قواعد القسمة</h2>
            <div class="rules-grid">
                <div class="rule-card divisible-2">
                    <div class="rule-icon">🔢</div>
                    <h3>القسمة على 2</h3>
                    <p>يكون العدد قابلاً للقسمة على 2 إذا كان <strong>زوجياً</strong></p>
                    <p>أي أن رقم الآحاد يكون: 0, 2, 4, 6, 8</p>
                    <div class="rule-examples">مثال: 14, 26, 38, 50</div>
                </div>
                
                <div class="rule-card divisible-3">
                    <div class="rule-icon">🔢</div>
                    <h3>القسمة على 3</h3>
                    <p>يكون العدد قابلاً للقسمة على 3 إذا كان <strong>مجموع أرقامه</strong> يقبل القسمة على 3</p>
                    <div class="rule-examples">مثال: 123 → 1+2+3=6 ← يقبل القسمة على 3</div>
                </div>
                
                <div class="rule-card divisible-4">
                    <div class="rule-icon">🔢</div>
                    <h3>القسمة على 4</h3>
                    <p>يكون العدد قابلاً للقسمة على 4 إذا كان <strong>آخر رقمين</strong> يقبلان القسمة على 4</p>
                    <div class="rule-examples">مثال: 132 → 32 ÷ 4 = 8 ← يقبل القسمة على 4</div>
                </div>
                
                <div class="rule-card divisible-5">
                    <div class="rule-icon">🔢</div>
                    <h3>القسمة على 5</h3>
                    <p>يكون العدد قابلاً للقسمة على 5 إذا كان <strong>رقم آحاده</strong> 0 أو 5</p>
                    <div class="rule-examples">مثال: 15, 20, 35, 40, 55</div>
                </div>
            </div>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <div class="lesson-indicator" id="lesson-indicator">
                <!-- سيتم إضافة نقاط الدروس هنا -->
            </div>
            
            <div class="current-target">
                <h3>اختر الأعداد القابلة للقسمة على:</h3>
                <div class="target-number" id="target-divisor">?</div>
                <div class="target-rule" id="target-rule">?</div>
            </div>
            
            <div class="progress-bar">
                <div class="progress" id="progress" style="width: 0%"></div>
            </div>
            
            <div class="numbers-grid" id="numbers-grid">
                <!-- الأعداد ستضاف هنا بالJavaScript -->
            </div>
            
            <div class="controls">
                <button id="check-btn">✅ تحقق من الإجابات</button>
                <button id="hint-btn">💡 أعطني تلميحاً</button>
                <button id="next-btn">➡️ التالي</button>
                <button id="reset-btn">🔄 إعادة اللعبة</button>
            </div>
            
            <div class="feedback" id="feedback">
                اختر الأعداد التي تقبل القسمة على الرقم المستهدف!
            </div>
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span> | المستوى: <span id="level">1</span> | 
            الأسئلة: <span id="current-question">1</span>/<span id="total-questions">10</span>
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
                examples: [2, 4, 6, 8, 10, 12, 14, 16, 18, 20]
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
                examples: [3, 6, 9, 12, 15, 18, 21, 24, 27, 30]
            },
            112: {
                id: 112,
                name: "قابلية القسمة على 4",
                divisor: 4,
                rule: "آخر رقمين من العدد يقبلان القسمة على 4",
                checkFunction: (num) => num % 4 === 0,
                examples: [4, 8, 12, 16, 20, 24, 28, 32, 36, 40]
            },
            113: {
                id: 113,
                name: "قابلية القسمة على 5",
                divisor: 5,
                rule: "رقم آحاد العدد هو 0 أو 5",
                checkFunction: (num) => num % 5 === 0,
                examples: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50]
            }
        };

        // بيانات اللعبة
        const gameData = {
            currentLessonId: <?php echo $lesson_game->lesson->id; ?>,
            score: 0,
            level: 1,
            currentQuestion: 1,
            totalQuestions: 10,
            selectedNumbers: [],
            currentNumbers: [],
            correctAnswers: []
        };

        // عناصر DOM
        const lessonIndicator = document.getElementById('lesson-indicator');
        const targetDivisor = document.getElementById('target-divisor');
        const targetRule = document.getElementById('target-rule');
        const numbersGrid = document.getElementById('numbers-grid');
        const scoreElement = document.getElementById('score');
        const levelElement = document.getElementById('level');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const progressElement = document.getElementById('progress');
        const feedbackElement = document.getElementById('feedback');
        const checkBtn = document.getElementById('check-btn');
        const resetBtn = document.getElementById('reset-btn');
        const hintBtn = document.getElementById('hint-btn');
        const nextBtn = document.getElementById('next-btn');

        // الحصول على الدرس الحالي
        function getCurrentLesson() {
            return lessons[gameData.currentLessonId];
        }

        // تهيئة اللعبة
        function initGame() {
            updateLessonIndicator();
            generateQuestion();
            updateUI();
        }

        // تحديث مؤشر الدروس
        function updateLessonIndicator() {
            lessonIndicator.innerHTML = '';
            Object.values(lessons).forEach(lesson => {
                const dot = document.createElement('div');
                dot.className = `lesson-dot ${lesson.id === gameData.currentLessonId ? 'active' : ''}`;
                dot.title = lesson.name;
                lessonIndicator.appendChild(dot);
            });
        }

        // توليد سؤال جديد
        function generateQuestion() {
            const lesson = getCurrentLesson();
            gameData.selectedNumbers = [];
            gameData.currentNumbers = [];
            gameData.correctAnswers = [];
            
            // تحديث واجهة السؤال
            targetDivisor.textContent = lesson.divisor;
            targetRule.textContent = lesson.rule;
            
            // توليد أعداد عشوائية
            const numbers = new Set();
            while (numbers.size < 12) {
                const num = Math.floor(Math.random() * 50) + 1;
                numbers.add(num);
            }
            
            gameData.currentNumbers = Array.from(numbers);
            
            // تحديد الإجابات الصحيحة
            gameData.correctAnswers = gameData.currentNumbers.filter(num => 
                lesson.checkFunction(num)
            );
            
            renderNumbers();
        }

        // عرض الأعداد
        function renderNumbers() {
            numbersGrid.innerHTML = '';
            
            gameData.currentNumbers.forEach(num => {
                const numberCard = document.createElement('div');
                numberCard.className = `number-card ${gameData.selectedNumbers.includes(num) ? 'selected' : ''}`;
                numberCard.textContent = num;
                numberCard.addEventListener('click', () => toggleNumberSelection(num));
                numbersGrid.appendChild(numberCard);
            });
        }

        // تبديل اختيار العدد
        function toggleNumberSelection(num) {
            if (gameData.selectedNumbers.includes(num)) {
                gameData.selectedNumbers = gameData.selectedNumbers.filter(n => n !== num);
            } else {
                gameData.selectedNumbers.push(num);
            }
            renderNumbers();
        }

        // التحقق من الإجابات
        function checkAnswers() {
            const lesson = getCurrentLesson();
            let correctCount = 0;
            let wrongCount = 0;
            
            // تحديث مظهر الأعداد
            gameData.currentNumbers.forEach(num => {
                const isCorrect = lesson.checkFunction(num);
                const isSelected = gameData.selectedNumbers.includes(num);
                const numberCard = Array.from(numbersGrid.children).find(card => 
                    parseInt(card.textContent) === num
                );
                
                if (numberCard) {
                    if (isSelected && isCorrect) {
                        numberCard.classList.add('correct');
                        correctCount++;
                    } else if (isSelected && !isCorrect) {
                        numberCard.classList.add('incorrect');
                        wrongCount++;
                    } else if (!isSelected && isCorrect) {
                        numberCard.classList.add('correct');
                    }
                }
            });
            
            if (wrongCount === 0 && correctCount === gameData.correctAnswers.length) {
                gameData.score += 10 * gameData.level;
                showFeedback(`🎉 ممتاز! جميع الإجابات صحيحة!`, 'success');
                nextBtn.disabled = false;
            } else {
                showFeedback(`📊 ${correctCount} إجابة صحيحة من ${gameData.correctAnswers.length}`, 'error');
            }
            
            checkBtn.disabled = true;
            updateUI();
        }

        // الانتقال للسؤال التالي
        function nextQuestion() {
            gameData.currentQuestion++;
            
            if (gameData.currentQuestion > gameData.totalQuestions) {
                gameData.level++;
                gameData.currentQuestion = 1;
                showFeedback(`🚀 تقدم للمستوى ${gameData.level}!`, 'info');
            }
            
            // تغيير الدرس كل سؤالين
            if (gameData.currentQuestion % 2 === 1) {
                const lessonIds = Object.keys(lessons);
                const currentIndex = lessonIds.indexOf(gameData.currentLessonId.toString());
                const nextIndex = (currentIndex + 1) % lessonIds.length;
                gameData.currentLessonId = parseInt(lessonIds[nextIndex]);
                updateLessonIndicator();
            }
            
            generateQuestion();
            checkBtn.disabled = false;
            nextBtn.disabled = true;
            updateUI();
        }

        // إظهار التلميح
        function showHint() {
            const lesson = getCurrentLesson();
            let hint = '';
            
            switch(lesson.divisor) {
                case 2:
                    hint = '💡 تلميح: انظر إلى رقم الآحاد - يجب أن يكون 0, 2, 4, 6, أو 8';
                    break;
                case 3:
                    hint = '💡 تلميح: اجمع أرقام العدد - إذا كان المجموع يقبل القسمة على 3 فالعدد يقبل القسمة على 3';
                    break;
                case 4:
                    hint = '💡 تلميح: انظر إلى آخر رقمين - إذا كانا يقبلان القسمة على 4 فالعدد يقبل القسمة على 4';
                    break;
                case 5:
                    hint = '💡 تلميح: انظر إلى رقم الآحاد - يجب أن يكون 0 أو 5';
                    break;
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
            levelElement.textContent = gameData.level;
            currentQuestionElement.textContent = gameData.currentQuestion;
            totalQuestionsElement.textContent = gameData.totalQuestions;
            
            const progress = (gameData.currentQuestion / gameData.totalQuestions) * 100;
            progressElement.style.width = `${progress}%`;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        checkBtn.addEventListener('click', checkAnswers);
        resetBtn.addEventListener('click', resetGame);
        hintBtn.addEventListener('click', showHint);
        nextBtn.addEventListener('click', nextQuestion);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>