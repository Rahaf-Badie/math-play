<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مختبر التقدير العلمي - {{ $lesson_game->lesson->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            direction: rtl;
            text-align: center;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 900px;
            border: 3px solid #e74c3c;
        }

        .lesson-info {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #e74c3c;
            margin-bottom: 15px;
            border-bottom: 3px solid #e74c3c;
            padding-bottom: 10px;
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #fdf5f5 0%, #f9e3e3 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #e74c3c;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #fff0f0 0%, #ffe0e0 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #e74c3c;
        }

        .lab-display {
            font-size: 4em;
            margin: 20px 0;
            animation: bubble 3s ease-in-out infinite;
        }

        @keyframes bubble {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }

        .experiment-area {
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            border: 3px solid #3498db;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .problem-statement {
            font-size: 1.8em;
            color: #2c3e50;
            margin: 20px 0;
            line-height: 1.6;
        }

        .numbers-display {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .number-beaker {
            padding: 20px 30px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border-radius: 12px;
            font-size: 2em;
            font-weight: bold;
            min-width: 100px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .operation-flask {
            font-size: 2.5em;
            color: #e74c3c;
            font-weight: bold;
        }

        .estimation-scale {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .scale-label {
            font-size: 1.3em;
            font-weight: bold;
            color: #2c3e50;
        }

        .estimation-input {
            width: 150px;
            height: 70px;
            border: 3px solid #9b59b6;
            border-radius: 12px;
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background: #fffdf6;
            transition: all 0.3s ease;
        }

        .estimation-input:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.3);
            outline: none;
            transform: scale(1.05);
        }

        .tolerance-slider {
            width: 80%;
            margin: 20px auto;
        }

        .slider-label {
            font-size: 1.1em;
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        .accuracy-feedback {
            margin-top: 25px;
            font-size: 1.3em;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.5em;
            color: #e74c3c;
            font-weight: bold;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background-color: #ddd;
            border-radius: 6px;
            margin: 20px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 30px;
            font-size: 1.2em;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        #check-btn {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
        }

        #next-btn {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        #auto-btn {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: white;
        }

        .accuracy-meter {
            width: 80%;
            height: 20px;
            background: #ecf0f1;
            border-radius: 10px;
            margin: 15px auto;
            overflow: hidden;
            position: relative;
        }

        .accuracy-fill {
            height: 100%;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        @media (max-width: 768px) {
            .numbers-display {
                flex-direction: column;
            }
            
            .estimation-scale {
                flex-direction: column;
                gap: 15px;
            }
            
            .problem-statement {
                font-size: 1.5em;
            }
            
            .lab-display {
                font-size: 3em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>🔬 مختبر التقدير العلمي</h1>
        
        <div class="instructions">
            <p>🔢 تقدير ناتج الضرب والقسمة بدقة</p>
            <p>🎯 أدخل تقديرك وتحقق من دقته</p>
        </div>

        <div class="game-area">
            <div class="lab-display">🔬</div>

            <div class="experiment-area">
                <div class="problem-statement" id="problem-statement">
                    <!-- سيتم تعبئته ديناميكياً -->
                </div>

                <div class="numbers-display">
                    <div class="number-beaker" id="number1">0</div>
                    <div class="operation-flask" id="operation-symbol">?</div>
                    <div class="number-beaker" id="number2">0</div>
                    <div class="operation-flask">≈</div>
                </div>

                <div class="estimation-scale">
                    <div class="scale-label">تقديري:</div>
                    <input type="number" id="user-estimation" class="estimation-input" placeholder="أدخل التقدير">
                    <button id="check-btn">✅ تحقق</button>
                </div>

                <div class="accuracy-meter">
                    <div class="accuracy-fill" id="accuracy-fill"></div>
                </div>

                <div class="accuracy-feedback" id="accuracy-feedback">
                    أدخل تقديرك وتحقق من دقته!
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <div class="controls">
                <button id="next-btn">🔬 تجربة جديدة</button>
                <button id="auto-btn">🤖 تقدير تلقائي</button>
            </div>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>متوسط الدقة: <span id="accuracy-rate">0</span>%</p>
            <p>التجارب: <span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript لمختبر التقدير العلمي ===
        const minRange = {{ $min_range ?? 10 }};
        const maxRange = {{ $max_range ?? 99 }};
        
        let score = 0;
        let totalQuestions = 0;
        let totalAccuracy = 0;
        let labOperation = '';
        let labNum1 = 0;
        let labNum2 = 0;
        let labExactResult = 0;
        let labTolerance = 0;

        function generateLabProblem() {
            // تحديد العملية
            labOperation = Math.random() < 0.5 ? 'multiplication' : 'division';
            
            if (labOperation === 'multiplication') {
                labNum1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                labNum2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                labExactResult = labNum1 * labNum2;
                labTolerance = Math.max(10, labExactResult * 0.1); // 10% tolerance
            } else {
                labNum2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                if (labNum2 === 0) labNum2 = 1;
                labNum1 = labNum2 * Math.floor(Math.random() * 10 + 1);
                labExactResult = labNum1 / labNum2;
                labTolerance = Math.max(1, labExactResult * 0.15); // 15% tolerance
            }

            // تحديث العرض
            updateLabDisplay();
            
            document.getElementById('user-estimation').value = '';
            document.getElementById('accuracy-feedback').textContent = 'أدخل تقديرك وتحقق من دقته!';
            document.getElementById('accuracy-feedback').style.background = '#f8f9fa';
            document.getElementById('accuracy-fill').style.width = '0%';

            totalQuestions++;
            document.getElementById('total-count').textContent = totalQuestions;
        }

        function updateLabDisplay() {
            const symbol = labOperation === 'multiplication' ? '×' : '÷';
            let statement = '';
            
            if (labOperation === 'multiplication') {
                statement = `ما هو تقديرك لناتج ضرب ${labNum1} في ${labNum2}؟`;
            } else {
                statement = `ما هو تقديرك لناتج قسمة ${labNum1} على ${labNum2}؟`;
            }
            
            document.getElementById('problem-statement').textContent = statement;
            document.getElementById('number1').textContent = labNum1;
            document.getElementById('operation-symbol').textContent = symbol;
            document.getElementById('number2').textContent = labNum2;
        }

        function checkEstimationAccuracy() {
            const userEstimation = parseFloat(document.getElementById('user-estimation').value);
            const feedbackElement = document.getElementById('accuracy-feedback');
            
            if (isNaN(userEstimation)) {
                feedbackElement.textContent = '❌ الرجاء إدخال تقدير صحيح';
                feedbackElement.style.background = '#f8d7da';
                return;
            }

            // حساب نسبة الدقة
            const difference = Math.abs(userEstimation - labExactResult);
            const accuracy = Math.max(0, 100 - (difference / labTolerance) * 100);
            const roundedAccuracy = Math.min(100, Math.round(accuracy));

            // تحديث عداد الدقة
            document.getElementById('accuracy-fill').style.width = `${roundedAccuracy}%`;
            
            // حساب النقاط بناءً على الدقة
            let pointsEarned = 0;
            let feedbackMessage = '';
            
            if (roundedAccuracy >= 90) {
                pointsEarned = 15;
                feedbackMessage = `🎉 دقة مذهلة! ${roundedAccuracy}%`;
                feedbackElement.style.background = '#d4edda';
            } else if (roundedAccuracy >= 75) {
                pointsEarned = 10;
                feedbackMessage = `👍 تقدير جيد! ${roundedAccuracy}%`;
                feedbackElement.style.background = '#d1ecf1';
            } else if (roundedAccuracy >= 60) {
                pointsEarned = 5;
                feedbackMessage = `⚠️ ليس سيئاً! ${roundedAccuracy}%`;
                feedbackElement.style.background = '#fff3cd';
            } else {
                pointsEarned = 0;
                feedbackMessage = `❌ يمكنك التحسن! ${roundedAccuracy}%`;
                feedbackElement.style.background = '#f8d7da';
            }

            feedbackMessage += `<br><small>الناتج الدقيق: ${labExactResult.toLocaleString('ar-EG')}</small>`;
            feedbackElement.innerHTML = feedbackMessage;

            score += pointsEarned;
            totalAccuracy += roundedAccuracy;
            
            document.getElementById('score').textContent = score;
            document.getElementById('accuracy-rate').textContent = 
                totalQuestions > 0 ? Math.round(totalAccuracy / totalQuestions) : 0;
            
            updateProgress();
        }

        function autoEstimate() {
            let autoEstimation;
            
            if (labOperation === 'multiplication') {
                // تقريب لأقرب عشرة ثم ضرب
                const rounded1 = Math.round(labNum1 / 10) * 10;
                const rounded2 = Math.round(labNum2 / 10) * 10;
                autoEstimation = rounded1 * rounded2;
            } else {
                // تقريب لأقرب عشرة ثم قسمة
                const rounded1 = Math.round(labNum1 / 10) * 10;
                const rounded2 = Math.round(labNum2 / 10) * 10;
                autoEstimation = Math.round(rounded1 / rounded2);
            }
            
            document.getElementById('user-estimation').value = autoEstimation;
            
            const feedbackElement = document.getElementById('accuracy-feedback');
            feedbackElement.innerHTML = `🤖 التقدير التلقائي: ${autoEstimation.toLocaleString('ar-EG')}<br>
                                       <small>اضغط "تحقق" لمعرفة الدقة</small>`;
            feedbackElement.style.background = '#e2e3e5';
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (totalAccuracy / totalQuestions) : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        // إعداد event listeners
        document.getElementById('check-btn').addEventListener('click', checkEstimationAccuracy);
        document.getElementById('next-btn').addEventListener('click', generateLabProblem);
        document.getElementById('auto-btn').addEventListener('click', autoEstimate);

        // السماح بالضغط على Enter
        document.getElementById('user-estimation').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                checkEstimationAccuracy();
            }
        });

        // بدء اللعبة
        generateLabProblem();
    </script>
</body>
</html>