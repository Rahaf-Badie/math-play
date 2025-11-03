<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مستكشف زوايا المثلث - {{ $lesson_game->lesson->name }}</title>
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

        .learning-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #74b9ff;
        }

        .concept-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .concept-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .concept-card:hover {
            transform: translateY(-5px);
        }

        .triangle-demo {
            width: 120px;
            height: 120px;
            margin: 15px auto;
            position: relative;
        }

        .triangle {
            width: 0;
            height: 0;
            border-style: solid;
            margin: 0 auto;
        }

        .acute-triangle {
            border-width: 0 50px 86.6px 50px;
            border-color: transparent transparent #00b894 transparent;
        }

        .right-triangle {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ff7675, #e84393);
            clip-path: polygon(0 0, 0 100%, 100% 100%);
        }

        .obtuse-triangle {
            border-width: 0 30px 86.6px 80px;
            border-color: transparent transparent #ffb300 transparent;
        }

        .angle-mark {
            position: absolute;
            width: 20px;
            height: 20px;
            background: gold;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .angle-1 { top: 10px; left: 10px; }
        .angle-2 { top: 10px; right: 10px; }
        .angle-3 { bottom: 10px; left: 50%; transform: translateX(-50%); }

        .game-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .triangle-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .triangle-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .triangle-item:hover {
            border-color: #667eea;
            transform: scale(1.05);
        }

        .triangle-item.selected {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
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

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
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

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }

        .angle-info {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .angle-type {
            padding: 10px 20px;
            background: #dfe6e9;
            border-radius: 25px;
            font-weight: bold;
        }

        .angle-type.acute { background: #00b894; color: white; }
        .angle-type.right { background: #ff7675; color: white; }
        .angle-type.obtuse { background: #ffb300; color: white; }

        @media (max-width: 768px) {
            .concept-cards {
                grid-template-columns: 1fr;
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
            <h1>🔺 مستكشف زوايا المثلث</h1>
            <p>تعلم وتفاعل مع عالم المثلثات الرائع!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }} - زوايا المثلث وأنواعه
        </div>

        <!-- قسم التعلم -->
        <div class="learning-section">
            <h2>📚 ماذا نتعلم اليوم؟</h2>
            <div class="concept-cards">
                <div class="concept-card">
                    <h3>🔺 ما هو المثلث؟</h3>
                    <p>شكل هندسي له 3 أضلاع و 3 زوايا و 3 رؤوس</p>
                    <div class="triangle-demo">
                        <div class="triangle acute-triangle"></div>
                        <div class="angle-mark angle-1"></div>
                        <div class="angle-mark angle-2"></div>
                        <div class="angle-mark angle-3"></div>
                    </div>
                </div>
                
                <div class="concept-card">
                    <h3>📐 مجموع زوايا المثلث</h3>
                    <p>مجموع زوايا أي مثلث دائماً يساوي 180 درجة</p>
                    <div style="font-size: 3em; color: #667eea; margin: 15px 0;">∠1 + ∠2 + ∠3 = 180°</div>
                </div>
                
                <div class="concept-card">
                    <h3>🎯 أنواع المثلثات من حيث الزوايا</h3>
                    <div class="angle-info">
                        <div class="angle-type acute">حاد الزوايا</div>
                        <div class="angle-type right">قائم الزاوية</div>
                        <div class="angle-type obtuse">منفرج الزاوية</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- أنواع المثلثات -->
        <div class="learning-section">
            <h2>🔍 أنواع المثلثات من حيث الزوايا</h2>
            <div class="concept-cards">
                <div class="concept-card">
                    <h3>🔺 مثلث حاد الزوايا</h3>
                    <p>جميع زواياه حادة (أقل من 90 درجة)</p>
                    <div class="triangle-demo">
                        <div class="triangle acute-triangle"></div>
                    </div>
                    <p><strong>مثال:</strong> 60° + 60° + 60° = 180°</p>
                </div>
                
                <div class="concept-card">
                    <h3>📐 مثلث قائم الزاوية</h3>
                    <p>له زاوية قائمة تساوي 90 درجة</p>
                    <div class="triangle-demo">
                        <div class="right-triangle"></div>
                    </div>
                    <p><strong>مثال:</strong> 90° + 45° + 45° = 180°</p>
                </div>
                
                <div class="concept-card">
                    <h3>🔻 مثلث منفرج الزاوية</h3>
                    <p>له زاوية منفرجة (أكبر من 90 درجة)</p>
                    <div class="triangle-demo">
                        <div class="triangle obtuse-triangle"></div>
                    </div>
                    <p><strong>مثال:</strong> 120° + 30° + 30° = 180°</p>
                </div>
            </div>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <h2>🎮 العب وتعلم</h2>
            <p>اختر نوع المثلث المناسب لكل مجموعة من الزوايا:</p>
            
            <div class="triangle-container" id="triangle-container">
                <!-- المحتوى الديناميكي -->
            </div>
            
            <div class="controls">
                <button id="check-btn">✅ تحقق من الإجابة</button>
                <button id="hint-btn">💡 أعطني تلميحاً</button>
                <button id="reset-btn">🔄 إعادة اللعبة</button>
            </div>
            
            <div class="feedback" id="feedback">
                اختر نوع المثلث المناسب للزوايا المعطاة!
            </div>
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span> | المستوى: <span id="level">1</span>
        </div>
    </div>

    <script>
        // بيانات اللعبة
        const gameData = {
            score: 0,
            level: 1,
            currentQuestion: null,
            selectedAnswer: null,
            questions: [
                {
                    angles: [60, 60, 60],
                    correctType: 'acute',
                    explanation: 'جميع الزوايا أقل من 90 درجة - مثلث حاد الزوايا'
                },
                {
                    angles: [90, 45, 45],
                    correctType: 'right',
                    explanation: 'يوجد زاوية قائمة 90 درجة - مثلث قائم الزاوية'
                },
                {
                    angles: [120, 30, 30],
                    correctType: 'obtuse',
                    explanation: 'يوجد زاوية منفرجة 120 درجة - مثلث منفرج الزاوية'
                },
                {
                    angles: [80, 50, 50],
                    correctType: 'acute',
                    explanation: 'جميع الزوايا أقل من 90 درجة - مثلث حاد الزوايا'
                },
                {
                    angles: [100, 40, 40],
                    correctType: 'obtuse',
                    explanation: 'يوجد زاوية منفرجة 100 درجة - مثلث منفرج الزاوية'
                }
            ]
        };

        // عناصر DOM
        const triangleContainer = document.getElementById('triangle-container');
        const scoreElement = document.getElementById('score');
        const levelElement = document.getElementById('level');
        const feedbackElement = document.getElementById('feedback');
        const checkBtn = document.getElementById('check-btn');
        const resetBtn = document.getElementById('reset-btn');
        const hintBtn = document.getElementById('hint-btn');

        // تهيئة اللعبة
        function initGame() {
            generateQuestion();
            updateUI();
        }

        // توليد سؤال جديد
        function generateQuestion() {
            const randomIndex = Math.floor(Math.random() * gameData.questions.length);
            gameData.currentQuestion = gameData.questions[randomIndex];
            gameData.selectedAnswer = null;
            
            renderQuestion();
        }

        // عرض السؤال
        function renderQuestion() {
            triangleContainer.innerHTML = '';
            
            // عرض الزوايا
            const anglesElement = document.createElement('div');
            anglesElement.className = 'concept-card';
            anglesElement.innerHTML = `
                <h3>📐 زوايا المثلث</h3>
                <div style="font-size: 2em; color: #667eea; margin: 15px 0;">
                    ${gameData.currentQuestion.angles[0]}° + ${gameData.currentQuestion.angles[1]}° + ${gameData.currentQuestion.angles[2]}° = 180°
                </div>
                <p>ما هو نوع هذا المثلث؟</p>
            `;
            triangleContainer.appendChild(anglesElement);
            
            // خيارات الإجابة
            const types = [
                { type: 'acute', name: 'حاد الزوايا', icon: '🔺' },
                { type: 'right', name: 'قائم الزاوية', icon: '📐' },
                { type: 'obtuse', name: 'منفرج الزاوية', icon: '🔻' }
            ];
            
            types.forEach(typeInfo => {
                const typeElement = document.createElement('div');
                typeElement.className = `triangle-item ${gameData.selectedAnswer === typeInfo.type ? 'selected' : ''}`;
                typeElement.innerHTML = `
                    <div style="font-size: 2em;">${typeInfo.icon}</div>
                    <h4>${typeInfo.name}</h4>
                `;
                typeElement.addEventListener('click', () => selectAnswer(typeInfo.type));
                triangleContainer.appendChild(typeElement);
            });
        }

        // اختيار الإجابة
        function selectAnswer(type) {
            gameData.selectedAnswer = type;
            renderQuestion();
        }

        // التحقق من الإجابة
        function checkAnswer() {
            if (!gameData.selectedAnswer) {
                showFeedback('❌ اختر نوع المثلث أولاً!', 'error');
                return;
            }
            
            const isCorrect = gameData.selectedAnswer === gameData.currentQuestion.correctType;
            
            if (isCorrect) {
                gameData.score += 10 * gameData.level;
                showFeedback(`🎉 ${gameData.currentQuestion.explanation} - إجابة صحيحة!`, 'success');
                
                setTimeout(() => {
                    if (gameData.score >= gameData.level * 30) {
                        gameData.level++;
                        showFeedback(`🚀 تقدم للمستوى ${gameData.level}!`, 'info');
                    }
                    generateQuestion();
                }, 2000);
            } else {
                showFeedback('❌ إجابة خاطئة! حاول مرة أخرى.', 'error');
            }
            
            updateUI();
        }

        // إظهار التلميح
        function showHint() {
            const question = gameData.currentQuestion;
            let hint = '';
            
            if (question.correctType === 'acute') {
                hint = '💡 تلميح: جميع الزوايا في هذا المثلث أصغر من 90 درجة';
            } else if (question.correctType === 'right') {
                hint = '💡 تلميح: إحدى زوايا هذا المثلث تساوي 90 درجة بالضبط';
            } else {
                hint = '💡 تلميح: إحدى زوايا هذا المثلث أكبر من 90 درجة';
            }
            
            showFeedback(hint, 'info');
        }

        // إعادة اللعبة
        function resetGame() {
            gameData.score = 0;
            gameData.level = 1;
            initGame();
            showFeedback('🔄 تم إعادة اللعبة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            levelElement.textContent = gameData.level;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        checkBtn.addEventListener('click', checkAnswer);
        resetBtn.addEventListener('click', resetGame);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>