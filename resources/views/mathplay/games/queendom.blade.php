<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مملكة القسمة السحرية - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 800px;
            border: 3px solid #9b59b6;
        }

        /* شريط التنقل العلوي */
        .navigation-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
        }

        .back-button {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
            text-decoration: none;
            color: white;
        }

        .lesson-title h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.5rem;
        }

        .lesson-info {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #9b59b6;
            margin-bottom: 15px;
            border-bottom: 3px solid #9b59b6;
            padding-bottom: 10px;
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #f4ecff 0%, #e8d6ff 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #9b59b6;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #f9f5ff 0%, #f0e6ff 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #9b59b6;
        }

        .magic-castle {
            font-size: 4em;
            margin: 20px 0;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .division-problem {
            font-size: 3em;
            font-weight: bold;
            color: #2c3e50;
            margin: 30px 0;
            padding: 25px;
            background: white;
            border-radius: 15px;
            border: 4px solid #3498db;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            font-family: 'Courier New', monospace;
        }

        .division-symbol {
            color: #e74c3c;
            margin: 0 15px;
        }

        .input-section {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .input-label {
            font-size: 1.3em;
            font-weight: bold;
            color: #2c3e50;
        }

        .division-input {
            width: 120px;
            height: 70px;
            border: 3px solid #3498db;
            border-radius: 12px;
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background: #fffdf6;
            transition: all 0.3s ease;
        }

        .division-input:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.3);
            outline: none;
            transform: scale(1.05);
        }

        .division-input.correct {
            border-color: #27ae60;
            background-color: #e8f5e9;
        }

        .division-input.incorrect {
            border-color: #e74c3c;
            background-color: #ffebee;
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 25px 0;
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
            min-width: 160px;
        }

        #check-btn {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        #next-btn {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: white;
        }

        #check-btn:hover, #hint-btn:hover, #next-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.4em;
            font-weight: bold;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-align: center;
            line-height: 1.6;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.5em;
            color: #9b59b6;
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
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .division-steps {
            background: #e8f4f8;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            font-size: 1.1em;
            text-align: right;
        }

        .step {
            margin: 10px 0;
            padding: 8px;
            background: white;
            border-radius: 8px;
            border-right: 4px solid #3498db;
        }

        @media (max-width: 768px) {
            .division-problem {
                font-size: 2.2em;
                padding: 20px;
            }

            .input-section {
                gap: 20px;
            }

            .division-input {
                width: 100px;
                height: 60px;
                font-size: 1.8em;
            }

            .magic-castle {
                font-size: 3em;
            }

            .navigation-bar {
                flex-direction: column;
                gap: 15px;
            }

            .back-button {
                order: 2;
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    <!-- رابط أيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- شريط التنقل العلوي -->
        <div class="navigation-bar">
            <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-button">
                <i class="fas fa-arrow-right"></i>
                العودة إلى الدرس
            </a>
            <div class="lesson-title">
                <h2>مملكة القسمة السحرية</h2>
            </div>
        </div>

        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>🏰 مملكة القسمة السحرية</h1>

        <div class="instructions">
            <p>🔢 قسمة أعداد من منزلتين على أعداد من منزلة واحدة - قسمة بدون باقي</p>
            <p>🎯 أدخل ناتج القسمة فقط (جميع المسائل قسمة متوازنة)</p>
        </div>

        <div class="game-area">
            <div class="magic-castle">🏰</div>

            <div class="division-problem" id="division-problem">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="input-section">
                <div class="input-group">
                    <div class="input-label">ناتج القسمة</div>
                    <input type="number" id="quotient-input" class="division-input" placeholder="الناتج">
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <div class="controls">
                <button id="check-btn">
                    <i class="fas fa-check-circle"></i>
                    تحقق
                </button>
                <button id="hint-btn">
                    <i class="fas fa-lightbulb"></i>
                    تلميح
                </button>
                <button id="next-btn">
                    <i class="fas fa-arrow-right"></i>
                    مسألة تالية
                </button>
            </div>

            <div class="feedback" id="feedback">
                <i class="fas fa-play-circle"></i>
                ابدأ بحل مسألة القسمة!
            </div>

            <div class="division-steps" id="division-steps" style="display: none;">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>الإجابات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript لمملكة القسمة السحرية ===
        const minRange = {{ $min_range ?? 10 }};
        const maxRange = {{ $max_range ?? 99 }};
        const divisorRange = { min: 2, max: 9 };

        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let dividend = 0;
        let divisor = 0;
        let correctQuotient = 0;

        function generateDivisionProblem() {
            // توليد مسألة قسمة بدون باقي
            do {
                divisor = Math.floor(Math.random() * (divisorRange.max - divisorRange.min + 1)) + divisorRange.min;
                correctQuotient = Math.floor(Math.random() * (Math.floor(maxRange/divisor) - Math.ceil(minRange/divisor) + 1)) + Math.ceil(minRange/divisor);
                dividend = divisor * correctQuotient;
            } while (dividend < minRange || dividend > maxRange);

            // تحديث العرض
            document.getElementById('division-problem').innerHTML =
                `${dividend} <span class="division-symbol">÷</span> ${divisor} = ?`;

            // إعادة تعيين الحقول
            document.getElementById('quotient-input').value = '';
            document.getElementById('quotient-input').className = 'division-input';

            document.getElementById('feedback').innerHTML = '<i class="fas fa-play-circle"></i> أدخل ناتج القسمة';
            document.getElementById('feedback').style.background = '#f8f9fa';
            document.getElementById('division-steps').style.display = 'none';

            totalQuestions++;
            document.getElementById('total-count').textContent = totalQuestions;
        }

        function checkAnswer() {
            const userQuotient = parseInt(document.getElementById('quotient-input').value);
            const feedbackElement = document.getElementById('feedback');
            const stepsElement = document.getElementById('division-steps');

            if (isNaN(userQuotient)) {
                feedbackElement.innerHTML = '<i class="fas fa-exclamation-circle"></i> الرجاء إدخال ناتج القسمة';
                feedbackElement.style.background = '#f8d7da';
                return;
            }

            const isCorrect = userQuotient === correctQuotient;

            // تحديث مظهر الحقول
            document.getElementById('quotient-input').className =
                isCorrect ? 'division-input correct' : 'division-input incorrect';

            if (isCorrect) {
                feedbackElement.innerHTML =
                    `<i class="fas fa-trophy"></i> أحسنت! الإجابة صحيحة<br>
                     <small>${dividend} ÷ ${divisor} = ${correctQuotient}</small>`;
                feedbackElement.style.background = '#d4edda';
                score += 15;
                correctAnswers++;
            } else {
                feedbackElement.innerHTML =
                    `<i class="fas fa-times-circle"></i> خطأ! حاول مرة أخرى<br>
                     <small>${dividend} ÷ ${divisor} = ${correctQuotient}</small>`;
                feedbackElement.style.background = '#f8d7da';
                score = Math.max(0, score - 5);

                // عرض خطوات الحل بعد ثانيتين
                setTimeout(() => {
                    showSolutionSteps();
                }, 2000);
            }

            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            updateProgress();
        }

        function showSolutionSteps() {
            const stepsElement = document.getElementById('division-steps');
            stepsElement.innerHTML = `
                <h3><i class="fas fa-list-ol"></i> خطوات الحل:</h3>
                <div class="step">1. المقسوم: ${dividend}</div>
                <div class="step">2. المقسوم عليه: ${divisor}</div>
                <div class="step">3. ${divisor} × ${correctQuotient} = ${dividend}</div>
                <div class="step">4. الناتج: ${correctQuotient}</div>
                <div class="step">5. هذه قسمة متوازنة بدون باقي</div>
            `;
            stepsElement.style.display = 'block';
        }

        function showHint() {
            const hint = `<i class="fas fa-lightbulb"></i> تلميح: ${dividend} ÷ ${divisor} = ?<br>
                         حاول قسمة ${Math.floor(dividend/10)} عشرات و ${dividend%10} آحاد على ${divisor}`;
            document.getElementById('feedback').innerHTML = hint;
            document.getElementById('feedback').style.background = '#d1ecf1';
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        // إعداد event listeners
        document.getElementById('check-btn').addEventListener('click', checkAnswer);
        document.getElementById('hint-btn').addEventListener('click', showHint);
        document.getElementById('next-btn').addEventListener('click', generateDivisionProblem);

        // السماح بالضغط على Enter
        document.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                checkAnswer();
            }
        });

        // بدء اللعبة
        generateDivisionProblem();
    </script>
</body>
</html>
