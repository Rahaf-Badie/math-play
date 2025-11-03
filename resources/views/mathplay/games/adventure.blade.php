<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مغامرة الأعداد العشرية - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            max-width: 1100px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.4rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .adventure-map {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .game-world {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .adventure-controls {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 25px;
            border: 3px solid #e9ecef;
        }

        .panel-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
            font-weight: bold;
            font-size: 1.4rem;
        }

        .game-world .panel-title {
            color: white;
        }

        #adventure-canvas {
            background: white;
            border-radius: 15px;
            display: block;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .mission-display {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .mission-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #e84393;
            margin-bottom: 15px;
        }

        .mission-description {
            font-size: 1.1rem;
            color: #2d3436;
            line-height: 1.6;
        }

        .decimal-inputs {
            display: grid;
            grid-template-columns: 1fr auto 1fr auto 1fr;
            gap: 15px;
            align-items: center;
            margin: 25px 0;
        }

        .decimal-input {
            width: 100%;
            padding: 20px;
            border: 3px solid #a29bfe;
            border-radius: 15px;
            font-size: 1.5rem;
            text-align: center;
            outline: none;
            direction: ltr;
        }

        .decimal-input:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
        }

        .operation-display {
            font-size: 2rem;
            font-weight: bold;
            color: #636e72;
            text-align: center;
        }

        .challenge-types {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .challenge-card {
            background: white;
            border: 3px solid #dfe6e9;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .challenge-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .challenge-card.active {
            border-color: #00b894;
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .challenge-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .adventure-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .adventure-stat {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .adventure-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .adventure-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .adventure-controls-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 25px 0;
        }

        .adventure-btn {
            padding: 15px 20px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        #start-adventure-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #submit-answer-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .back-btn {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .adventure-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .adventure-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .adventure-feedback {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.2rem;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .adventure-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .adventure-fail {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .adventure-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .progress-map {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
        }

        .progress-bar {
            width: 100%;
            height: 20px;
            background: #dfe6e9;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            border-radius: 10px;
            transition: width 0.5s ease;
            width: 0%;
        }

        .level-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .decimal-tips {
            background: #e9f7ef;
            border: 2px solid #00b894;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .tips-title {
            text-align: center;
            font-weight: bold;
            color: #00b894;
            margin-bottom: 15px;
        }

        .tip-item {
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 8px;
            border-right: 3px solid #00b894;
        }

        @media (max-width: 768px) {
            .adventure-map {
                grid-template-columns: 1fr;
            }
            
            .challenge-types, .adventure-stats {
                grid-template-columns: 1fr;
            }
            
            .decimal-inputs {
                grid-template-columns: 1fr;
                grid-template-areas: 
                    "input1"
                    "operation1"
                    "input2"
                    "operation2"
                    "result";
            }
            
            #adventure-canvas {
                width: 100%;
                height: auto;
            }
        }

        /* تأثيرات الرسوم المتحركة */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        @keyframes celebrate {
            0% { transform: translateY(0px) scale(1); }
            25% { transform: translateY(-10px) scale(1.1); }
            50% { transform: translateY(0px) scale(1.1); }
            75% { transform: translateY(-5px) scale(1.05); }
            100% { transform: translateY(0px) scale(1); }
        }

        .celebrate {
            animation: celebrate 0.5s ease-in-out;
        }

        .float {
            animation: float 3s ease-in-out infinite;
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
            <h1 class="lesson-title">🧭 مغامرة الأعداد العشرية</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="adventure-map">
            <div class="game-world">
                <div class="panel-title">🎮 عالم المغامرة</div>
                <canvas id="adventure-canvas" width="600" height="400"></canvas>
                
                <div class="mission-display">
                    <div class="mission-title" id="mission-title">المهمة الحالية</div>
                    <div class="mission-description" id="mission-description">
                        انقر على "بدء المغامرة" لبدء رحلتك في عالم الأعداد العشرية!
                    </div>
                </div>
                
                <div class="decimal-inputs">
                    <input type="text" class="decimal-input" id="decimal-input-1" placeholder="٠٫٠٠" disabled>
                    <div class="operation-display" id="operation-display">+</div>
                    <input type="text" class="decimal-input" id="decimal-input-2" placeholder="٠٫٠٠" disabled>
                    <div class="operation-display">=</div>
                    <input type="text" class="decimal-input" id="result-input" placeholder="الناتج">
                </div>
                
                <div class="adventure-feedback" id="adventure-feedback">
                    مستعد للمغامرة؟
                </div>

                <div class="back-container">
                    <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="adventure-btn back-btn">⬅️ العودة للدرس</a>
                </div>
            </div>
            
            <div class="adventure-controls">
                <div class="panel-title">🎒 أدوات المغامر</div>
                
                <div class="challenge-types">
                    <div class="challenge-card" data-type="addition">
                        <div class="challenge-icon">➕</div>
                        <h4>جمع الأعداد العشرية</h4>
                    </div>
                    <div class="challenge-card" data-type="subtraction">
                        <div class="challenge-icon">➖</div>
                        <h4>طرح الأعداد العشرية</h4>
                    </div>
                    <div class="challenge-card" data-type="comparison">
                        <div class="challenge-icon">⚖️</div>
                        <h4>مقارنة الأعداد</h4>
                    </div>
                    <div class="challenge-card" data-type="rounding">
                        <div class="challenge-icon">🔢</div>
                        <h4>تقريب الأعداد</h4>
                    </div>
                </div>
                
                <div class="adventure-stats">
                    <div class="adventure-stat">
                        <div class="adventure-value" id="adventure-score">٠</div>
                        <div class="adventure-label">النقاط</div>
                    </div>
                    <div class="adventure-stat">
                        <div class="adventure-value" id="missions-completed">٠</div>
                        <div class="adventure-label">مهمات مكتملة</div>
                    </div>
                    <div class="adventure-stat">
                        <div class="adventure-value" id="adventure-level">١</div>
                        <div class="adventure-label">مستوى المغامرة</div>
                    </div>
                    <div class="adventure-stat">
                        <div class="adventure-value" id="adventure-accuracy">١٠٠٪</div>
                        <div class="adventure-label">الدقة</div>
                    </div>
                </div>
                
                <div class="progress-map">
                    <div class="progress-bar">
                        <div class="progress-fill" id="adventure-progress"></div>
                    </div>
                    <div class="level-info">
                        <span>تقدم المغامرة</span>
                        <span id="progress-text">٠/١٠</span>
                    </div>
                </div>
                
                <div class="adventure-controls-buttons">
                    <button class="adventure-btn" id="start-adventure-btn">
                        🚀 بدء المغامرة
                    </button>
                    <button class="adventure-btn" id="submit-answer-btn" disabled>
                        ✅ تقديم الإجابة
                    </button>
                    <button class="adventure-btn" id="hint-btn" disabled>
                        💡 تلميح
                    </button>
                </div>
                
                <div class="decimal-tips">
                    <div class="tips-title">💡 أسرار الأعداد العشرية</div>
                    <div class="tip-item">انتبه للفاصلة العشرية عند الجمع والطرح</div>
                    <div class="tip-item">قارن الأعداد من اليسار إلى اليمين</div>
                    <div class="tip-item">أضف أصفاراً لتسهيل المقارنة</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let adventureScore = 0;
        let missionsCompleted = 0;
        let adventureLevel = 1;
        let totalAttempts = 0;
        let successfulAttempts = 0;
        let currentChallenge = null;
        let currentChallengeType = 'addition';
        let isAdventureActive = false;
        let adventureProgress = 0;
        let progressTarget = 10;
        
        // عناصر DOM
        const adventureCanvas = document.getElementById('adventure-canvas');
        const ctx = adventureCanvas.getContext('2d');
        const missionTitle = document.getElementById('mission-title');
        const missionDescription = document.getElementById('mission-description');
        const decimalInput1 = document.getElementById('decimal-input-1');
        const decimalInput2 = document.getElementById('decimal-input-2');
        const operationDisplay = document.getElementById('operation-display');
        const resultInput = document.getElementById('result-input');
        const adventureFeedback = document.getElementById('adventure-feedback');
        const startAdventureBtn = document.getElementById('start-adventure-btn');
        const submitAnswerBtn = document.getElementById('submit-answer-btn');
        const hintBtn = document.getElementById('hint-btn');
        const challengeCards = document.querySelectorAll('.challenge-card');
        const adventureScoreElement = document.getElementById('adventure-score');
        const missionsCompletedElement = document.getElementById('missions-completed');
        const adventureLevelElement = document.getElementById('adventure-level');
        const adventureAccuracyElement = document.getElementById('adventure-accuracy');
        const adventureProgressElement = document.getElementById('adventure-progress');
        const progressTextElement = document.getElementById('progress-text');
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeAdventureCanvas();
            setupAdventureEventListeners();
            drawAdventureScene();
        });
        
        function setupAdventureEventListeners() {
            startAdventureBtn.addEventListener('click', startAdventure);
            submitAnswerBtn.addEventListener('click', submitAnswer);
            hintBtn.addEventListener('click', provideAdventureHint);
            
            // أحداث أنواع التحديات
            challengeCards.forEach(card => {
                card.addEventListener('click', function() {
                    if (!isAdventureActive) {
                        challengeCards.forEach(c => c.classList.remove('active'));
                        this.classList.add('active');
                        currentChallengeType = this.dataset.type;
                    }
                });
            });
            
            // أحداث الإدخال
            resultInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && isAdventureActive) {
                    submitAnswer();
                }
            });
        }
        
        function initializeAdventureCanvas() {
            adventureCanvas.width = 600;
            adventureCanvas.height = 400;
        }
        
        function drawAdventureScene() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, adventureCanvas.width, adventureCanvas.height);
            
            // رسم خلفية المغامرة
            ctx.fillStyle = '#dfe6e9';
            ctx.fillRect(0, 0, adventureCanvas.width, adventureCanvas.height);
            
            if (isAdventureActive && currentChallenge) {
                drawCurrentChallenge();
            } else {
                // رسم رسالة ترحيب
                ctx.fillStyle = '#2d3436';
                ctx.font = '24px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('انقر على "بدء المغامرة" للبدء!', 
                           adventureCanvas.width / 2, adventureCanvas.height / 2);
            }
        }
        
        function drawCurrentChallenge() {
            const centerX = adventureCanvas.width / 2;
            const centerY = adventureCanvas.height / 2;
            
            // رسم الأعداد العشرية
            ctx.fillStyle = '#e84393';
            ctx.font = 'bold 36px Arial';
            ctx.textAlign = 'center';
            
            if (currentChallengeType === 'addition' || currentChallengeType === 'subtraction') {
                ctx.fillText(`${currentChallenge.num1} ${currentChallenge.operator} ${currentChallenge.num2} = ?`, 
                           centerX, centerY - 50);
            } else if (currentChallengeType === 'comparison') {
                ctx.fillText(`قارن: ${currentChallenge.num1} ? ${currentChallenge.num2}`, 
                           centerX, centerY - 50);
            } else if (currentChallengeType === 'rounding') {
                ctx.fillText(`قرب ${currentChallenge.number} إلى ${currentChallenge.place}`, 
                           centerX, centerY - 50);
            }
            
            // رسم تأثير المغامرة
            ctx.strokeStyle = '#fdcb6e';
            ctx.lineWidth = 3;
            ctx.setLineDash([10, 5]);
            ctx.beginPath();
            ctx.arc(centerX, centerY, 100, 0, Math.PI * 2);
            ctx.stroke();
            ctx.setLineDash([]);
        }
        
        function startAdventure() {
            isAdventureActive = true;
            startAdventureBtn.disabled = true;
            submitAnswerBtn.disabled = false;
            hintBtn.disabled = false;
            resultInput.disabled = false;
            
            adventureScore = 0;
            missionsCompleted = 0;
            adventureLevel = 1;
            totalAttempts = 0;
            successfulAttempts = 0;
            adventureProgress = 0;
            progressTarget = 10;
            
            updateAdventureStats();
            generateNewChallenge();
            
            adventureFeedback.className = 'adventure-feedback adventure-info';
            adventureFeedback.textContent = 'حل التحدي وأدخل الإجابة!';
            
            resultInput.focus();
        }
        
        function generateNewChallenge() {
            let challenge;
            
            switch(currentChallengeType) {
                case 'addition':
                    challenge = generateAdditionChallenge();
                    break;
                case 'subtraction':
                    challenge = generateSubtractionChallenge();
                    break;
                case 'comparison':
                    challenge = generateComparisonChallenge();
                    break;
                case 'rounding':
                    challenge = generateRoundingChallenge();
                    break;
            }
            
            currentChallenge = challenge;
            updateChallengeDisplay();
            drawAdventureScene();
        }
        
        function generateAdditionChallenge() {
            const num1 = (Math.random() * (maxRange - minRange) + minRange).toFixed(2);
            const num2 = (Math.random() * (maxRange - minRange) + minRange).toFixed(2);
            const result = (parseFloat(num1) + parseFloat(num2)).toFixed(2);
            
            return {
                type: 'addition',
                num1: num1,
                num2: num2,
                operator: '+',
                result: result,
                description: 'اجمع العددين العشريين معاً'
            };
        }
        
        function generateSubtractionChallenge() {
            let num1 = (Math.random() * (maxRange - minRange) + minRange).toFixed(2);
            let num2 = (Math.random() * (maxRange - minRange) + minRange).toFixed(2);
            
            // التأكد من أن الناتج موجب
            if (parseFloat(num1) < parseFloat(num2)) {
                [num1, num2] = [num2, num1];
            }
            
            const result = (parseFloat(num1) - parseFloat(num2)).toFixed(2);
            
            return {
                type: 'subtraction',
                num1: num1,
                num2: num2,
                operator: '-',
                result: result,
                description: 'اطرح العددين العشريين'
            };
        }
        
        function generateComparisonChallenge() {
            // توليد عددين مختلفين
            let num1, num2;
            do {
                num1 = (Math.random() * (maxRange - minRange) + minRange).toFixed(2);
                num2 = (Math.random() * (maxRange - minRange) + minRange).toFixed(2);
            } while (num1 === num2); // التأكد من أن العددين مختلفين
            
            const num1Float = parseFloat(num1);
            const num2Float = parseFloat(num2);
            
            console.log('المقارنة:', num1, num2, 'num1Float:', num1Float, 'num2Float:', num2Float);
            
            let correctAnswer;
            if (num1Float > num2Float) {
                correctAnswer = '>';
            } else if (num1Float < num2Float) {
                correctAnswer = '<';
            } else {
                correctAnswer = '=';
            }
            
            return {
                type: 'comparison',
                num1: num1,
                num2: num2,
                correctAnswer: correctAnswer,
                description: 'قارن بين العددين باستخدام <, =, أو >'
            };
        }
        
        function generateRoundingChallenge() {
            const number = (Math.random() * (maxRange - minRange) + minRange).toFixed(3);
            const places = ['أقرب جزء من عشرة', 'أقرب عدد صحيح'][Math.floor(Math.random() * 2)];
            let result;
            
            if (places === 'أقرب جزء من عشرة') {
                result = Math.round(parseFloat(number) * 10) / 10;
            } else {
                result = Math.round(parseFloat(number));
            }
            
            return {
                type: 'rounding',
                number: number,
                place: places,
                result: result,
                description: `قرب العدد إلى ${places.toLowerCase()}`
            };
        }
        
        function updateChallengeDisplay() {
            missionTitle.textContent = getChallengeTitle(currentChallengeType);
            missionDescription.textContent = currentChallenge.description;
            
            if (currentChallengeType === 'addition' || currentChallengeType === 'subtraction') {
                decimalInput1.value = currentChallenge.num1;
                decimalInput2.value = currentChallenge.num2;
                operationDisplay.textContent = currentChallenge.operator;
                resultInput.placeholder = 'أدخل الناتج';
                resultInput.type = 'text';
            } else if (currentChallengeType === 'comparison') {
                decimalInput1.value = currentChallenge.num1;
                decimalInput2.value = currentChallenge.num2;
                operationDisplay.textContent = '?';
                resultInput.placeholder = 'أدخل < أو = أو >';
                resultInput.type = 'text';
                
                // إضافة رسالة توضيحية للمقارنة
                console.log('عرض المقارنة:', currentChallenge.num1, currentChallenge.num2, 'الإجابة الصحيحة:', currentChallenge.correctAnswer);
            } else if (currentChallengeType === 'rounding') {
                decimalInput1.value = currentChallenge.number;
                decimalInput2.value = '';
                operationDisplay.textContent = '≈';
                resultInput.placeholder = 'أدخل العدد المقرب';
                resultInput.type = 'text';
            }
            
            resultInput.value = '';
        }
        
        function getChallengeTitle(type) {
            const titles = {
                addition: 'مهمة الجمع',
                subtraction: 'مهمة الطرح',
                comparison: 'مهمة المقارنة',
                rounding: 'مهمة التقريب'
            };
            return titles[type];
        }
        
        function submitAnswer() {
            if (!isAdventureActive || !currentChallenge) return;
            
            const userAnswer = resultInput.value.trim();
            let isCorrect = false;
            
            totalAttempts++;
            
            console.log('إجابة المستخدم:', userAnswer, 'الإجابة الصحيحة:', currentChallenge.correctAnswer);
            
            switch(currentChallengeType) {
                case 'addition':
                case 'subtraction':
                    isCorrect = Math.abs(parseFloat(userAnswer) - parseFloat(currentChallenge.result)) < 0.01;
                    break;
                case 'comparison':
                    isCorrect = userAnswer === currentChallenge.correctAnswer;
                    console.log('نتيجة المقارنة:', isCorrect, 'المستخدم:', userAnswer, 'الصحيحة:', currentChallenge.correctAnswer);
                    break;
                case 'rounding':
                    isCorrect = parseFloat(userAnswer) === currentChallenge.result;
                    break;
            }
            
            if (isCorrect) {
                successfulAttempts++;
                missionsCompleted++;
                adventureScore += 15;
                adventureProgress++;
                
                adventureFeedback.className = 'adventure-feedback adventure-success celebrate';
                adventureFeedback.textContent = '🎉 إجابة صحيحة! مهمة مكتملة!';
                
                // تحديث مستوى المغامرة
                if (adventureProgress >= progressTarget) {
                    adventureLevel++;
                    adventureProgress = 0;
                    progressTarget = Math.min(progressTarget + 5, 20);
                    adventureFeedback.textContent += ` - انتقل للمستوى ${adventureLevel}!`;
                }
                
                updateAdventureStats();
                
                // تحدي جديد بعد ثانية
                setTimeout(generateNewChallenge, 1000);
            } else {
                adventureScore = Math.max(0, adventureScore - 5);
                adventureFeedback.className = 'adventure-feedback adventure-fail';
                
                if (currentChallengeType === 'comparison') {
                    adventureFeedback.textContent = `❌ إجابة خاطئة! ${currentChallenge.num1} ${currentChallenge.correctAnswer} ${currentChallenge.num2}`;
                    console.log('التصحيح:', currentChallenge.num1, currentChallenge.correctAnswer, currentChallenge.num2);
                } else {
                    adventureFeedback.textContent = `❌ إجابة خاطئة! حاول مرة أخرى`;
                }
                
                updateAdventureStats();
            }
        }
        
        function provideAdventureHint() {
            if (!isAdventureActive || !currentChallenge) return;
            
            let hint = '';
            
            switch(currentChallengeType) {
                case 'addition':
                    hint = `تلميح: انتبه لمحاذاة الفواصل العشرية. ${currentChallenge.num1} + ${currentChallenge.num2}`;
                    break;
                case 'subtraction':
                    hint = `تلميح: اطرح الأجزاء المتشابهة. ${currentChallenge.num1} - ${currentChallenge.num2}`;
                    break;
                case 'comparison':
                    hint = `تلميح: قارن من اليسار إلى اليمين. انظر إلى الأجزاء العشرية`;
                    break;
                case 'rounding':
                    hint = `تلميح: انظر إلى الرقم الذي يلي المكان المطلوب`;
                    break;
            }
            
            adventureFeedback.className = 'adventure-feedback adventure-info';
            adventureFeedback.textContent = hint;
            
            adventureScore = Math.max(0, adventureScore - 3);
            updateAdventureStats();
        }
        
        function updateAdventureStats() {
            adventureScoreElement.textContent = adventureScore;
            missionsCompletedElement.textContent = missionsCompleted;
            adventureLevelElement.textContent = adventureLevel;
            
            const accuracy = totalAttempts > 0 ? 
                Math.round((successfulAttempts / totalAttempts) * 100) : 100;
            adventureAccuracyElement.textContent = `${accuracy}%`;
            
            // تحديث شريط التقدم
            const progressPercent = (adventureProgress / progressTarget) * 100;
            adventureProgressElement.style.width = `${progressPercent}%`;
            progressTextElement.textContent = `${adventureProgress}/${progressTarget}`;
        }
    </script>
</body>
</html>