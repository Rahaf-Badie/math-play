<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مغامرة الكسور العشرية - {{ $lesson_game->lesson->name }}</title>
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

        .fraction-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 15px 0;
            font-size: 1.5em;
            font-weight: bold;
        }

        .numerator {
            color: #667eea;
        }

        .denominator {
            color: #ff7675;
        }

        .fraction-line {
            border-top: 2px solid #2d3436;
            margin: 0 10px;
            width: 40px;
        }

        .decimal-representation {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 15px 0;
            font-size: 1.2em;
        }

        .fraction {
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 10px;
            margin: 0 10px;
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

        .mission-title {
            font-size: 1.5em;
            color: #2d3436;
            margin-bottom: 15px;
        }

        .fraction-challenge {
            font-size: 3em;
            color: #667eea;
            font-weight: bold;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 25px;
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

        .option-card.selected {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }

        .option-card.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border-color: #00b894;
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

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            display: inline-block;
            text-align: center;
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

        .back-btn {
            background: linear-gradient(135deg, #a29bfe, #6c5ce7);
            color: white;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .btn:disabled {
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
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
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

        .back-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 مغامرة الكسور العشرية</h1>
            <p>استكشف عالم الكسور العشرية بطريقة ممتعة!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="game-layout">
            <div class="learning-panel">
                <div class="concept-card">
                    <h3>🔢 ما هي الكسور العشرية؟</h3>
                    <p>الكسور العشرية هي كسور مقامها 10 أو 100 أو 1000 أو أي قوة للعدد 10</p>
                    <div class="fraction-visual">
                        <span class="numerator">3</span>
                        <div class="fraction-line"></div>
                        <span class="denominator">10</span>
                    </div>
                    <p>تُكتب عادةً على شكل عدد عشري: 0.3</p>
                </div>

                <div class="concept-card">
                    <h3>📊 أمثلة على الكسور العشرية</h3>
                    <div class="decimal-representation">
                        <div class="fraction">4/10</div>
                        <span> = </span>
                        <div class="fraction">0.4</div>
                    </div>
                    <div class="decimal-representation">
                        <div class="fraction">25/100</div>
                        <span> = </span>
                        <div class="fraction">0.25</div>
                    </div>
                    <div class="decimal-representation">
                        <div class="fraction">7/10</div>
                        <span> = </span>
                        <div class="fraction">0.7</div>
                    </div>
                </div>

                <div class="concept-card">
                    <h3>💰 أمثلة من الحياة</h3>
                    <p>نستخدم الكسور العشرية في:</p>
                    <ul style="margin-right: 20px; margin-top: 10px;">
                        <li>النقود: 0.75 ريال = 75 هللة</li>
                        <li>القياسات: 0.5 متر = نصف متر</li>
                        <li>الوزن: 0.25 كيلوجرام = ربع كيلو</li>
                    </ul>
                </div>
            </div>
            
            <div class="game-area">
                <div class="mission-display">
                    <div class="mission-title" id="mission-title">اختر الإجابة الصحيحة</div>
                    <div class="fraction-challenge" id="fraction-challenge">0/0</div>
                </div>
                
                <div class="progress-container">
                    <div class="progress-text">
                        تقدم المغامرة: <span id="progress-text">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" id="progress" style="width: 0%"></div>
                    </div>
                </div>
                
                <div class="options-grid" id="options-grid">
                    <!-- الخيارات ستظهر هنا -->
                </div>

                <div class="explanation" id="explanation">
                    <!-- الشرح سيظهر هنا -->
                </div>

                <div class="controls">
                    <button id="check-btn" class="btn">✅ تحقق من الإجابة</button>
                    <button id="hint-btn" class="btn">💡 الحصول على تلميح</button>
                    <button id="next-btn" class="btn" disabled>➡️ المهمة التالية</button>
                    <button id="reset-btn" class="btn">🔄 إعادة اللعبة</button>
                </div>
                
                <div class="feedback" id="feedback">
                    اختر الإجابة الصحيحة للكسر العشري المعروض!
                </div>

                <div class="back-container">
                    <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="btn back-btn">⬅️ العودة للدرس</a>
                </div>
            </div>
        </div>
        
        <div class="score-board">
            <div>النقاط: <span id="score">0</span></div>
            <div>المهمات: <span id="current-mission">1</span>/<span id="total-missions">8</span></div>
            <div>المستوى: <span id="level">1</span></div>
        </div>
    </div>

    <script>
        // بيانات اللعبة
        const gameData = {
            score: 0,
            level: 1,
            currentMission: 1,
            totalMissions: 8,
            selectedAnswer: null,
            currentChallenge: null,
            missionTypes: [
                'قراءة الكسور العشرية',
                'تحويل الكسور إلى عشرية',
                'مقارنة الكسور العشرية',
                'تمثيل الكسور العشرية'
            ]
        };

        // عناصر DOM
        const missionTitleElement = document.getElementById('mission-title');
        const fractionChallengeElement = document.getElementById('fraction-challenge');
        const optionsGridElement = document.getElementById('options-grid');
        const explanationElement = document.getElementById('explanation');
        const scoreElement = document.getElementById('score');
        const currentMissionElement = document.getElementById('current-mission');
        const totalMissionsElement = document.getElementById('total-missions');
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
            generateMission();
            updateUI();
        }

        // توليد مهمة جديدة
        function generateMission() {
            const missionType = gameData.missionTypes[
                Math.floor(Math.random() * gameData.missionTypes.length)
            ];
            
            missionTitleElement.textContent = missionType;
            gameData.selectedAnswer = null;
            
            let challenge;
            
            switch(missionType) {
                case 'قراءة الكسور العشرية':
                    challenge = generateReadingChallenge();
                    break;
                case 'تحويل الكسور إلى عشرية':
                    challenge = generateConversionChallenge();
                    break;
                case 'مقارنة الكسور العشرية':
                    challenge = generateComparisonChallenge();
                    break;
                case 'تمثيل الكسور العشرية':
                    challenge = generateRepresentationChallenge();
                    break;
            }
            
            gameData.currentChallenge = challenge;
            renderOptions();
        }

        // توليد تحدي القراءة
        function generateReadingChallenge() {
            const numerator = Math.floor(Math.random() * 9) + 1;
            const denominator = 10;
            
            const readings = [
                `${numerator} أعشار`,
                `${numerator} من ${denominator}`,
                `${numerator} على ${denominator}`,
                `كسر مقامه ${denominator} وبسطه ${numerator}`
            ];
            
            const correctReading = readings[0];
            
            return {
                type: 'reading',
                fraction: `${numerator}/${denominator}`,
                question: `كيف نقرأ الكسر ${numerator}/${denominator}؟`,
                options: [...readings].sort(() => Math.random() - 0.5),
                correctAnswer: correctReading,
                explanation: `الكسر ${numerator}/${denominator} يُقرأ: "${correctReading}" لأنه يمثل ${numerator} أجزاء من ${denominator}`
            };
        }

        // توليد تحدي التحويل
        function generateConversionChallenge() {
            const fractions = [
                { fraction: '1/10', decimal: '0.1' },
                { fraction: '2/10', decimal: '0.2' },
                { fraction: '3/10', decimal: '0.3' },
                { fraction: '4/10', decimal: '0.4' },
                { fraction: '5/10', decimal: '0.5' },
                { fraction: '6/10', decimal: '0.6' },
                { fraction: '7/10', decimal: '0.7' },
                { fraction: '8/10', decimal: '0.8' },
                { fraction: '9/10', decimal: '0.9' },
                { fraction: '10/10', decimal: '1.0' }
            ];
            
            const randomFraction = fractions[Math.floor(Math.random() * fractions.length)];
            
            const options = [
                randomFraction.decimal,
                (Math.random()).toFixed(1),
                (Math.random()).toFixed(1),
                (Math.random()).toFixed(1)
            ].sort(() => Math.random() - 0.5);
            
            return {
                type: 'conversion',
                fraction: randomFraction.fraction,
                question: `ما هو الكسر العشري المكافئ للكسر ${randomFraction.fraction}؟`,
                options: options,
                correctAnswer: randomFraction.decimal,
                explanation: `الكسر ${randomFraction.fraction} يساوي ${randomFraction.decimal} لأن ${randomFraction.fraction} = ${randomFraction.decimal}`
            };
        }

        // توليد تحدي المقارنة
        function generateComparisonChallenge() {
            const num1 = Math.floor(Math.random() * 9) + 1;
            const num2 = Math.floor(Math.random() * 9) + 1;
            
            const comparison = num1/10 > num2/10 ? '>' :
                             num1/10 < num2/10 ? '<' : '=';
            
            const options = ['>', '<', '='];
            
            return {
                type: 'comparison',
                fractions: [`${num1}/10`, `${num2}/10`],
                question: `قارن بين ${num1}/10 و ${num2}/10`,
                options: options,
                correctAnswer: comparison,
                explanation: `${num1}/10 ${comparison} ${num2}/10 لأن ${num1/10} ${comparison === '>' ? 'أكبر من' : comparison === '<' ? 'أصغر من' : 'يساوي'} ${num2/10}`
            };
        }

        // توليد تحدي التمثيل
        function generateRepresentationChallenge() {
            const numerator = Math.floor(Math.random() * 9) + 1;
            const representations = [
                `${numerator} أعشار من الدائرة`,
                `0.${numerator} من المتر`,
                `${numerator} قطع من 10`,
                `${numerator} من 10 أجزاء`
            ];
            
            return {
                type: 'representation',
                fraction: `${numerator}/10`,
                question: `أي من هذه يمثل الكسر ${numerator}/10؟`,
                options: [...representations].sort(() => Math.random() - 0.5),
                correctAnswer: representations[0],
                explanation: `التمثيل الصحيح هو "${representations[0]}" لأنه يمثل الكسر ${numerator}/10 بشكل مباشر`
            };
        }

        // عرض الخيارات
        function renderOptions() {
            const challenge = gameData.currentChallenge;
            
            fractionChallengeElement.textContent = 
                challenge.type === 'reading' ? challenge.fraction :
                challenge.type === 'conversion' ? challenge.fraction :
                challenge.type === 'comparison' ? `${challenge.fractions[0]} ? ${challenge.fractions[1]}` :
                challenge.fraction;
            
            optionsGridElement.innerHTML = '';
            
            challenge.options.forEach((option, index) => {
                const optionElement = document.createElement('div');
                optionElement.className = `option-card ${gameData.selectedAnswer === option ? 'selected' : ''}`;
                optionElement.textContent = option;
                optionElement.addEventListener('click', () => selectAnswer(option));
                optionsGridElement.appendChild(optionElement);
            });
            
            explanationElement.classList.remove('show');
            checkBtn.disabled = false;
            nextBtn.disabled = true;
        }

        // اختيار الإجابة
        function selectAnswer(answer) {
            gameData.selectedAnswer = answer;
            renderOptions();
        }

        // التحقق من الإجابة
        function checkAnswer() {
            if (!gameData.selectedAnswer) {
                showFeedback('❌ اختر إجابة أولاً!', 'error');
                return;
            }
            
            const challenge = gameData.currentChallenge;
            const isCorrect = gameData.selectedAnswer === challenge.correctAnswer;
            
            // تحديث مظهر الخيارات
            const options = optionsGridElement.children;
            for (let option of options) {
                if (option.textContent === challenge.correctAnswer) {
                    option.classList.add('correct');
                } else if (option.textContent === gameData.selectedAnswer && !isCorrect) {
                    option.classList.add('incorrect');
                }
            }
            
            // عرض الشرح
            explanationElement.innerHTML = challenge.explanation;
            explanationElement.classList.add('show');
            
            if (isCorrect) {
                gameData.score += 10 * gameData.level;
                showFeedback('🎉 إجابة صحيحة! أحسنت!', 'success');
                nextBtn.disabled = false;
            } else {
                showFeedback('❌ إجابة خاطئة! تعلم من الشرح', 'error');
            }
            
            checkBtn.disabled = true;
            updateUI();
        }

        // الانتقال للمهمة التالية
        function nextMission() {
            gameData.currentMission++;
            
            if (gameData.currentMission > gameData.totalMissions) {
                gameData.level++;
                gameData.currentMission = 1;
                showFeedback(`🚀 تقدم للمستوى ${gameData.level}!`, 'info');
            }
            
            generateMission();
            updateUI();
        }

        // إظهار التلميح
        function showHint() {
            const challenge = gameData.currentChallenge;
            let hint = '';
            
            switch(challenge.type) {
                case 'reading':
                    hint = '💡 تلميح: انظر إلى البسط والمقام - البسط هو عدد الأجزاء والمقام هو عدد الأجزاء الكلية';
                    break;
                case 'conversion':
                    hint = '💡 تلميح: تذكر أن 1/10 = 0.1، 2/10 = 0.2، 3/10 = 0.3، وهكذا';
                    break;
                case 'comparison':
                    hint = '💡 تلميح: قارن البسطين عندما يكون المقام متساوي';
                    break;
                case 'representation':
                    hint = '💡 تلميح: ابحث عن التمثيل الذي يحتوي على نفس العدد من الأجزاء';
                    break;
            }
            
            showFeedback(hint, 'info');
        }

        // إعادة اللعبة
        function resetGame() {
            gameData.score = 0;
            gameData.level = 1;
            gameData.currentMission = 1;
            initGame();
            showFeedback('🔄 تم إعادة اللعبة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            currentMissionElement.textContent = gameData.currentMission;
            totalMissionsElement.textContent = gameData.totalMissions;
            levelElement.textContent = gameData.level;
            
            const progress = (gameData.currentMission / gameData.totalMissions) * 100;
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
        nextBtn.addEventListener('click', nextMission);
        hintBtn.addEventListener('click', showHint);
        resetBtn.addEventListener('click', resetGame);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>