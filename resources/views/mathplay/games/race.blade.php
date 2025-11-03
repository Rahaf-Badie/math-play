<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سباق الكسور العشرية - {{ $lesson_game->lesson->name }}</title>
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
            position: relative;
        }

        /* زر العودة إلى الدرس */
        .back-to-lesson {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #e17055 0%, #d63031 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .back-to-lesson:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 10px;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.4rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .race-badge {
            display: inline-block;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
            color: #2d3436;
            margin-top: 10px;
            font-size: 1.2rem;
        }

        .race-track {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .game-area {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .control-panel {
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

        .game-area .panel-title {
            color: white;
        }

        #race-canvas {
            background: white;
            border-radius: 15px;
            display: block;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .problem-display {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .fraction-problem {
            font-size: 2.2rem;
            font-weight: bold;
            color: #e84393;
            margin: 15px 0;
            direction: ltr;
        }

        .fraction {
            display: inline-block;
            text-align: center;
            margin: 0 5px;
        }

        .numerator {
            border-bottom: 2px solid #e84393;
            padding: 0 8px;
        }

        .denominator {
            padding: 0 8px;
        }

        .timer-container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 15px;
            margin: 20px auto;
            max-width: 200px;
        }

        .timer-display {
            font-size: 2rem;
            font-weight: bold;
            color: #ffeaa7;
            text-align: center;
        }

        .answer-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin: 25px 0;
        }

        .option-btn {
            background: white;
            border: 3px solid #a29bfe;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #2d3436;
            direction: ltr;
        }

        .option-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            border-color: #00b894;
        }

        .option-btn.wrong {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
            border-color: #ff7675;
        }

        .option-btn.selected {
            border-color: #6c5ce7;
            background: #6c5ce7;
            color: white;
        }

        .race-controls {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 25px 0;
        }

        .race-btn {
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

        #start-race-btn {
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

        .race-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .race-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .race-feedback {
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

        .race-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .race-fail {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .race-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .race-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .race-stat {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .race-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .race-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .progress-track {
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

        .lap-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .fraction-tips {
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
            .race-track {
                grid-template-columns: 1fr;
            }
            
            .answer-options, .race-stats {
                grid-template-columns: 1fr;
            }
            
            #race-canvas {
                width: 100%;
                height: auto;
            }
            
            .fraction-problem {
                font-size: 1.8rem;
            }

            .back-to-lesson {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 15px;
                width: 100%;
                justify-content: center;
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes celebrate {
            0% { transform: translateY(0px) scale(1); }
            25% { transform: translateY(-10px) scale(1.1); }
            50% { transform: translateY(0px) scale(1.1); }
            75% { transform: translateY(-5px) scale(1.05); }
            100% { transform: translateY(0px) scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .celebrate {
            animation: celebrate 0.5s ease-in-out;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- زر العودة إلى الدرس -->
        <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-to-lesson">
            ← الرجوع إلى الدرس
        </a>

        <div class="header">
            <h1 class="lesson-title">🏎️ سباق الكسور العشرية</h1>
            <div class="race-badge" id="race-badge">
                @if($operation_type == 'addition')
                    سباق جمع الكسور العشرية
                @else
                    سباق طرح الكسور العشرية
                @endif
            </div>
        </div>
        
        <div class="race-track">
            <div class="game-area">
                <div class="panel-title">🎮 مضمار السباق</div>
                <canvas id="race-canvas" width="600" height="400"></canvas>
                
                <div class="problem-display">
                    <div class="fraction-problem" id="race-problem">
                        <span class="fraction">
                            <div class="numerator" id="num1-numerator">0</div>
                            <div class="denominator">10</div>
                        </span>
                        <span class="operation-symbol">
                            {{ $operation_type == 'addition' ? '+' : '−' }}
                        </span>
                        <span class="fraction">
                            <div class="numerator" id="num2-numerator">0</div>
                            <div class="denominator">10</div>
                        </span>
                        <span class="equals-symbol">=</span>
                        <span class="fraction">
                            <div class="numerator">?</div>
                            <div class="denominator">10</div>
                        </span>
                    </div>
                </div>
                
                <div class="timer-container">
                    <div class="timer-display" id="timer">٣٠</div>
                </div>
                
                <div class="answer-options" id="answer-options">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>
                
                <div class="race-feedback" id="race-feedback">
                    انقر على "بدء السباق" للبدء!
                </div>
            </div>
            
            <div class="control-panel">
                <div class="panel-title">🎛 لوحة التحكم</div>
                
                <div class="race-controls">
                    <button class="race-btn" id="start-race-btn">
                        🚀 بدء السباق
                    </button>
                    <button class="race-btn" id="submit-answer-btn" disabled>
                        ✅ تقديم الإجابة
                    </button>
                    <button class="race-btn" id="hint-btn" disabled>
                        💡 تلميح
                    </button>
                </div>
                
                <div class="race-stats">
                    <div class="race-stat">
                        <div class="race-value" id="race-score">٠</div>
                        <div class="race-label">النقاط</div>
                    </div>
                    <div class="race-stat">
                        <div class="race-value" id="correct-count">٠</div>
                        <div class="race-label">إجابات صحيحة</div>
                    </div>
                    <div class="race-stat">
                        <div class="race-value" id="race-level">١</div>
                        <div class="race-label">مستوى السباق</div>
                    </div>
                    <div class="race-stat">
                        <div class="race-value" id="race-accuracy">١٠٠٪</div>
                        <div class="race-label">الدقة</div>
                    </div>
                </div>
                
                <div class="progress-track">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                    <div class="lap-info">
                        <span>الجولة الحالية</span>
                        <span id="lap-text">٠/١٠</span>
                    </div>
                </div>
                
                <div class="fraction-tips">
                    <div class="tips-title">💡 نصائح للسباق</div>
                    <div class="tip-item">المقامات متساوية (10) لذا يمكن {{ $operation_type == 'addition' ? 'الجمع' : 'الطرح' }} مباشرة</div>
                    <div class="tip-item">{{ $operation_type == 'addition' ? 'اجمع' : 'اطرح' }} البسوط فقط</div>
                    <div class="tip-item">الناتج سيكون مقامه 10 أيضاً</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const operationType = "{{ $operation_type }}";
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let raceScore = 0;
        let correctCount = 0;
        let raceLevel = 1;
        let totalAttempts = 0;
        let successfulAttempts = 0;
        let currentProblem = null;
        let selectedAnswer = null;
        let isRaceActive = false;
        let timer = 30;
        let timerInterval = null;
        let raceProgress = 0;
        let progressTarget = 10;
        
        // عناصر DOM
        const raceCanvas = document.getElementById('race-canvas');
        const ctx = raceCanvas.getContext('2d');
        const raceProblem = document.getElementById('race-problem');
        const timerDisplay = document.getElementById('timer');
        const answerOptions = document.getElementById('answer-options');
        const raceFeedback = document.getElementById('race-feedback');
        const startRaceBtn = document.getElementById('start-race-btn');
        const submitAnswerBtn = document.getElementById('submit-answer-btn');
        const hintBtn = document.getElementById('hint-btn');
        const raceScoreElement = document.getElementById('race-score');
        const correctCountElement = document.getElementById('correct-count');
        const raceLevelElement = document.getElementById('race-level');
        const raceAccuracyElement = document.getElementById('race-accuracy');
        const progressFill = document.getElementById('progress-fill');
        const lapText = document.getElementById('lap-text');
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeRaceCanvas();
            setupRaceEventListeners();
            drawRaceScene();
        });
        
        function setupRaceEventListeners() {
            startRaceBtn.addEventListener('click', startRace);
            submitAnswerBtn.addEventListener('click', submitAnswer);
            hintBtn.addEventListener('click', provideRaceHint);
        }
        
        function initializeRaceCanvas() {
            raceCanvas.width = 600;
            raceCanvas.height = 400;
        }
        
        function drawRaceScene() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, raceCanvas.width, raceCanvas.height);
            
            // رسم خلفية المضمار
            ctx.fillStyle = '#dfe6e9';
            ctx.fillRect(0, 0, raceCanvas.width, raceCanvas.height);
            
            if (isRaceActive && currentProblem) {
                drawRaceTrack();
            } else {
                // رسم رسالة ترحيب
                ctx.fillStyle = '#2d3436';
                ctx.font = '24px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('انقر على "بدء السباق" للبدء!', 
                           raceCanvas.width / 2, raceCanvas.height / 2);
            }
        }
        
        function drawRaceTrack() {
            const centerX = raceCanvas.width / 2;
            const centerY = raceCanvas.height / 2;
            
            // رسم مضمار السباق
            ctx.strokeStyle = '#00b894';
            ctx.lineWidth = 10;
            ctx.beginPath();
            ctx.arc(centerX, centerY, 120, 0, Math.PI * 2);
            ctx.stroke();
            
            // رسم خط البداية/النهاية
            ctx.strokeStyle = '#e84393';
            ctx.lineWidth = 3;
            ctx.beginPath();
            ctx.moveTo(centerX + 120, centerY);
            ctx.lineTo(centerX + 100, centerY);
            ctx.stroke();
            
            // رسم سيارة السباق
            const progressAngle = (raceProgress / progressTarget) * (Math.PI * 2);
            const carX = centerX + Math.cos(progressAngle) * 120;
            const carY = centerY + Math.sin(progressAngle) * 120;
            
            ctx.fillStyle = '#fd79a8';
            ctx.beginPath();
            ctx.arc(carX, carY, 15, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.fillStyle = '#2d3436';
            ctx.beginPath();
            ctx.arc(carX, carY, 8, 0, Math.PI * 2);
            ctx.fill();
            
            // رسم المشكلة الحالية
            ctx.fillStyle = '#2d3436';
            ctx.font = 'bold 20px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(`الجولة: ${raceProgress + 1}/${progressTarget}`, centerX, centerY - 160);
        }
        
        function startRace() {
            isRaceActive = true;
            startRaceBtn.disabled = true;
            submitAnswerBtn.disabled = false;
            hintBtn.disabled = false;
            
            raceScore = 0;
            correctCount = 0;
            raceLevel = 1;
            totalAttempts = 0;
            successfulAttempts = 0;
            raceProgress = 0;
            progressTarget = 10;
            
            updateRaceStats();
            generateRaceProblem();
            startTimer();
            
            raceFeedback.className = 'race-feedback race-info';
            raceFeedback.textContent = 'اختر الإجابة الصحيحة بسرعة!';
        }
        
        function startTimer() {
            timer = 30;
            timerDisplay.textContent = timer;
            timerDisplay.style.color = '#ffeaa7';
            
            if (timerInterval) {
                clearInterval(timerInterval);
            }
            
            timerInterval = setInterval(function() {
                timer--;
                timerDisplay.textContent = timer;
                
                if (timer <= 10) {
                    timerDisplay.style.color = '#ff7675';
                    timerDisplay.classList.add('pulse');
                }
                
                if (timer <= 0) {
                    timeUp();
                }
            }, 1000);
        }
        
        function generateRaceProblem() {
            // توليد كسور عشرية (مقام 10)
            const numerator1 = Math.floor(Math.random() * 9) + 1; // من 1 إلى 9
            const numerator2 = Math.floor(Math.random() * 9) + 1; // من 1 إلى 9
            
            let correctNumerator;
            if (operationType === 'addition') {
                correctNumerator = numerator1 + numerator2;
            } else {
                // التأكد من أن الناتج موجب
                const maxNumerator = Math.max(numerator1, numerator2);
                const minNumerator = Math.min(numerator1, numerator2);
                correctNumerator = maxNumerator - minNumerator;
                
                // تحديث العرض ليكون الأكبر أولاً
                document.getElementById('num1-numerator').textContent = maxNumerator;
                document.getElementById('num2-numerator').textContent = minNumerator;
            }
            
            currentProblem = {
                numerator1: numerator1,
                numerator2: numerator2,
                correctNumerator: correctNumerator,
                denominator: 10
            };
            
            if (operationType === 'addition') {
                document.getElementById('num1-numerator').textContent = numerator1;
                document.getElementById('num2-numerator').textContent = numerator2;
            }
            
            // توليد خيارات الإجابة
            generateAnswerOptions(correctNumerator);
            
            drawRaceScene();
        }
        
        function generateAnswerOptions(correctAnswer) {
            answerOptions.innerHTML = '';
            selectedAnswer = null;
            
            const options = [correctAnswer];
            
            // توليد خيارات خاطئة
            while (options.length < 4) {
                let wrongAnswer;
                
                // أنواع مختلفة من الأخطاء
                const errorType = Math.floor(Math.random() * 3);
                switch(errorType) {
                    case 0:
                        // خطأ بسيط ±1
                        wrongAnswer = correctAnswer + (Math.random() > 0.5 ? 1 : -1);
                        break;
                    case 1:
                        // خطأ بجمع بدل الطرح أو العكس
                        if (operationType === 'addition') {
                            wrongAnswer = Math.abs(currentProblem.numerator1 - currentProblem.numerator2);
                        } else {
                            wrongAnswer = currentProblem.numerator1 + currentProblem.numerator2;
                        }
                        break;
                    case 2:
                        // خطأ عشوائي
                        wrongAnswer = correctAnswer + (Math.random() > 0.5 ? 2 : -2);
                        break;
                }
                
                // التأكد من أن الناتج بين 0 و 10
                wrongAnswer = Math.max(0, Math.min(10, wrongAnswer));
                
                if (wrongAnswer !== correctAnswer && !options.includes(wrongAnswer)) {
                    options.push(wrongAnswer);
                }
            }
            
            // خلط الخيارات
            shuffleArray(options);
            
            // عرض الخيارات
            options.forEach(option => {
                const optionBtn = document.createElement('div');
                optionBtn.className = 'option-btn';
                optionBtn.textContent = `${option}/10`;
                optionBtn.dataset.value = option;
                
                optionBtn.addEventListener('click', function() {
                    if (!isRaceActive) return;
                    
                    // إلغاء تحديد الخيارات الأخرى
                    document.querySelectorAll('.option-btn').forEach(btn => {
                        btn.classList.remove('selected');
                    });
                    
                    this.classList.add('selected');
                    selectedAnswer = parseInt(this.dataset.value);
                });
                
                answerOptions.appendChild(optionBtn);
            });
        }
        
        function submitAnswer() {
            if (!isRaceActive || !selectedAnswer) {
                raceFeedback.className = 'race-feedback race-fail shake';
                raceFeedback.textContent = '❌ يرجى اختيار إجابة أولاً!';
                return;
            }
            
            totalAttempts++;
            const isCorrect = selectedAnswer === currentProblem.correctNumerator;
            
            if (isCorrect) {
                successfulAttempts++;
                correctCount++;
                raceScore += Math.max(10, timer * 2); // نقاط أكثر للإجابات السريعة
                raceProgress++;
                
                raceFeedback.className = 'race-feedback race-success celebrate';
                raceFeedback.textContent = `🎉 إجابة صحيحة! +${Math.max(10, timer * 2)} نقطة`;
                
                // إعادة تعيين المؤقت
                clearInterval(timerInterval);
                
                // تحديث مستوى السباق
                if (raceProgress >= progressTarget) {
                    raceLevel++;
                    raceProgress = 0;
                    progressTarget = Math.min(progressTarget + 5, 20);
                    raceFeedback.textContent += ` - انتقل للمستوى ${raceLevel}!`;
                }
                
                updateRaceStats();
                
                // مشكلة جديدة بعد ثانية
                setTimeout(() => {
                    if (raceProgress < progressTarget) {
                        generateRaceProblem();
                        startTimer();
                    } else {
                        endRace();
                    }
                }, 1000);
            } else {
                raceScore = Math.max(0, raceScore - 5);
                raceFeedback.className = 'race-feedback race-fail shake';
                raceFeedback.textContent = `❌ إجابة خاطئة! الجواب الصحيح: ${currentProblem.correctNumerator}/10`;
                
                updateRaceStats();
            }
        }
        
        function provideRaceHint() {
            if (!isRaceActive || !currentProblem) return;
            
            let hint = '';
            const { numerator1, numerator2 } = currentProblem;
            
            if (operationType === 'addition') {
                hint = `تلميح: ${numerator1}/10 + ${numerator2}/10 = ${numerator1 + numerator2}/10`;
            } else {
                hint = `تلميح: ${numerator1}/10 - ${numerator2}/10 = ${numerator1 - numerator2}/10`;
            }
            
            raceFeedback.className = 'race-feedback race-info pulse';
            raceFeedback.textContent = hint;
            
            raceScore = Math.max(0, raceScore - 3);
            updateRaceStats();
        }
        
        function timeUp() {
            raceFeedback.className = 'race-feedback race-fail';
            raceFeedback.textContent = '⏰ انتهى الوقت! حاول بسرعة أكبر';
            
            generateRaceProblem();
            startTimer();
        }
        
        function endRace() {
            isRaceActive = false;
            startRaceBtn.disabled = false;
            submitAnswerBtn.disabled = true;
            hintBtn.disabled = true;
            
            clearInterval(timerInterval);
            
            const accuracy = totalAttempts > 0 ? 
                Math.round((successfulAttempts / totalAttempts) * 100) : 0;
            
            raceFeedback.className = 'race-feedback race-info';
            raceFeedback.textContent = `🎊 انتهى السباق! النقاط: ${raceScore} | الدقة: ${accuracy}%`;
            
            // إعادة تعيين العداد
            timerDisplay.textContent = '٣٠';
            timerDisplay.style.color = '#ffeaa7';
            timerDisplay.classList.remove('pulse');
        }
        
        function updateRaceStats() {
            raceScoreElement.textContent = raceScore;
            correctCountElement.textContent = correctCount;
            raceLevelElement.textContent = raceLevel;
            
            const accuracy = totalAttempts > 0 ? 
                Math.round((successfulAttempts / totalAttempts) * 100) : 100;
            raceAccuracyElement.textContent = `${accuracy}%`;
            
            // تحديث شريط التقدم
            const progressPercent = (raceProgress / progressTarget) * 100;
            progressFill.style.width = `${progressPercent}%`;
            lapText.textContent = `${raceProgress}/${progressTarget}`;
        }
        
        // دوال مساعدة
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
    </script>
</body>
</html>