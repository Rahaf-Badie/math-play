<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مهمة التقدير - {{ $lesson_game->lesson->name }}</title>
    <style>
        /* ======================================= */
        /* === CSS / التنسيقات === */
        /* ======================================= */
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
            border: 3px solid #3498db;
        }

        .lesson-info {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 15px;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #d1e5e9 0%, #b8d8e6 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #3498db;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #f0f7f9 0%, #e1f0f5 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #3498db;
            position: relative;
        }

        .game-area::before {
            content: "📏";
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 2em;
            opacity: 0.3;
        }

        .mission-header {
            font-size: 1.8em;
            color: #e74c3c;
            margin: 20px 0;
            font-weight: bold;
        }

        .task-description {
            font-size: 1.4em;
            color: #3498db;
            margin: 25px 0;
            font-weight: bold;
            padding: 15px;
            background: white;
            border-radius: 10px;
            border: 2px dashed #3498db;
        }

        .steps-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            text-align: right;
            margin: 30px 0;
        }

        .step-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 20px;
            border-radius: 12px;
            border: 2px solid #f39c12;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .step-header {
            font-size: 1.3em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-number {
            background: #f39c12;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .step-input {
            padding: 12px;
            font-size: 1.2em;
            border: 3px solid #3498db;
            border-radius: 8px;
            width: 150px;
            text-align: center;
            background-color: #fffdf6;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .step-input:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 15px rgba(231, 76, 60, 0.3);
            outline: none;
            transform: scale(1.05);
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 30px 0;
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

        #submit-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 184, 148, 0.4);
        }

        #reset-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(116, 185, 255, 0.4);
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.3em;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-align: center;
            line-height: 1.5;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.2em;
            color: #2c3e50;
            font-weight: bold;
            display: inline-block;
            padding: 8px 20px;
            background: white;
            border-radius: 50px;
            margin: 0 10px;
        }

        .celebration {
            animation: celebrate 0.6s ease-in-out;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .length-rules {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px dashed #3498db;
            font-weight: bold;
            font-size: 1.1em;
        }

        .unit-card {
            display: inline-block;
            background: white;
            padding: 8px 15px;
            margin: 5px;
            border-radius: 8px;
            border: 2px solid #3498db;
            font-weight: bold;
        }

        .measurement-tips {
            background: linear-gradient(135deg, #d1e5e9 0%, #b8d8e6 100%);
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            font-size: 1em;
        }

        @media (max-width: 768px) {
            .steps-section {
                gap: 15px;
            }

            .step-card {
                padding: 15px;
            }

            .step-input {
                width: 120px;
                font-size: 1.1em;
            }

            .task-description {
                font-size: 1.2em;
            }

            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.6em;
            }
        }

        @media (max-width: 480px) {
            .step-input {
                width: 100px;
                padding: 10px;
            }

            .task-description {
                font-size: 1.1em;
                padding: 10px;
            }

            button {
                padding: 12px 20px;
                min-width: 140px;
                font-size: 1.1em;
            }

            .game-area {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>📏 مهمة التقدير</h1>

        <!-- التعليمات -->
        <div class="instructions">
            <p>🔢 المدى: من {{ $min_range ?? 1 }} إلى {{ $max_range ?? 300 }}</p>
            <p>🎯 قدّر الأطوال ثم حوّل بين وحدات القياس المختلفة</p>
        </div>

        <!-- قاعدة وحدات الطول -->
        <div class="length-rules">
            📚 قواعد التحويل:
            <span class="unit-card">1 متر = 100 سم</span>
            <span class="unit-card">1 كم = 1000 متر</span>
            <span class="unit-card">1 متر = 1000 مم</span>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- عنوان المهمة -->
            <div class="mission-header">🎯 مهمة قياس الطول</div>

            <!-- وصف المهمة -->
            <div id="task-description" class="task-description">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <!-- نصائح القياس -->
            <div class="measurement-tips">
                💡 تذكر: طول القلم ≈ 15 سم، ارتفاع الباب ≈ 2 متر، طول السيارة ≈ 4 متر
            </div>

            <!-- خطوات المهمة -->
            <div class="steps-section">
                <!-- الخطوة 1: التقدير -->
                <div class="step-card">
                    <div class="step-header">
                        <div class="step-number">1</div>
                        <span id="step1-text">التقدير الأولي</span>
                    </div>
                    <input type="number" id="step1-input" class="step-input" placeholder="أدخل التقدير">
                </div>

                <!-- الخطوة 2: التحويل -->
                <div class="step-card">
                    <div class="step-header">
                        <div class="step-number">2</div>
                        <span id="step2-text">التحويل إلى الوحدة الجديدة</span>
                    </div>
                    <input type="number" id="step2-input" class="step-input" placeholder="القيمة المحولة">
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="submit-btn">📤 إرسل التقرير</button>
                <button id="reset-btn">🔄 مهمة جديدة</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">
                ابدأ بتقدير الطول ثم قم بالتحويل!
            </div>
        </div>

        <!-- النقاط -->
        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>الإجابات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript / المنطق ===

        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 300 }};

        // مشاكل القياس المختلفة
        const MEASUREMENT_PROBLEMS = [
            // تحويل من متر إلى سنتيمتر
            {
                object: "طول غرفة الصف",
                baseVal: 8,
                baseUnit: "متر",
                targetUnit: "سم",
                correct: 800,
                hint: "1 متر = 100 سم",
                tolerance: 2
            },
            {
                object: "ارتفاع باب المنزل",
                baseVal: 2,
                baseUnit: "متر",
                targetUnit: "سم",
                correct: 200,
                hint: "1 متر = 100 سم",
                tolerance: 0.5
            },
            {
                object: "عرض ملعب صغير",
                baseVal: 15,
                baseUnit: "متر",
                targetUnit: "سم",
                correct: 1500,
                hint: "1 متر = 100 سم",
                tolerance: 3
            },

            // تحويل من سنتيمتر إلى متر
            {
                object: "طول مكتبك الدراسي",
                baseVal: 120,
                baseUnit: "سم",
                targetUnit: "متر",
                correct: 1.2,
                hint: "100 سم = 1 متر",
                tolerance: 20
            },
            {
                object: "طول لوح الكتابة",
                baseVal: 240,
                baseUnit: "سم",
                targetUnit: "متر",
                correct: 2.4,
                hint: "100 سم = 1 متر",
                tolerance: 30
            },

            // تحويل من كيلومتر إلى متر
            {
                object: "المسافة بين المنزل والمدرسة",
                baseVal: 2,
                baseUnit: "كم",
                targetUnit: "متر",
                correct: 2000,
                hint: "1 كم = 1000 متر",
                tolerance: 0.5
            },

            // تحويل من متر إلى مليمتر
            {
                object: "طول قلم الرصاص",
                baseVal: 0.15,
                baseUnit: "متر",
                targetUnit: "مم",
                correct: 150,
                hint: "1 متر = 1000 مم",
                tolerance: 0.02
            }
        ];

        let currentProblem = null;
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;

        function generateProblem() {
            const index = Math.floor(Math.random() * MEASUREMENT_PROBLEMS.length);
            currentProblem = MEASUREMENT_PROBLEMS[index];

            // تحديث واجهة المستخدم
            document.getElementById('task-description').textContent =
                `📐 قدّر ${currentProblem.object} ثم حوّل القيمة`;

            document.getElementById('step1-text').textContent =
                `التقدير بوحدة ${currentProblem.baseUnit}`;

            document.getElementById('step2-text').textContent =
                `التحويل إلى ${currentProblem.targetUnit}`;

            // مسح الحقول
            document.getElementById('step1-input').value = '';
            document.getElementById('step2-input').value = '';
            document.getElementById('feedback').innerHTML =
                '💭 قدّر الطول أولاً، ثم حوّل إلى الوحدة المطلوبة';
            document.getElementById('feedback').style.color = '#2c3e50';

            document.getElementById('step1-input').focus();

            // تحديث شريط التقدم
            updateProgress();
        }

        function checkAnswer() {
            const step1Input = parseFloat(document.getElementById('step1-input').value);
            const step2Input = parseFloat(document.getElementById('step2-input').value);
            const feedbackElement = document.getElementById('feedback');
            totalQuestions++;

            if (isNaN(step1Input) || isNaN(step2Input)) {
                feedbackElement.innerHTML = '❌ الرجاء إدخال أرقام في كلا الحقلين';
                feedbackElement.style.color = '#e74c3c';
                return;
            }

            // التحقق من التقدير (هامش خطأ مسموح)
            const isEstimationClose = Math.abs(step1Input - currentProblem.baseVal) <= currentProblem.tolerance;

            // حساب التحويل الصحيح بناءً على التقدير المدخل
            let actualConversion = 0;
            if (currentProblem.baseUnit === "متر" && currentProblem.targetUnit === "سم") {
                actualConversion = step1Input * 100;
            } else if (currentProblem.baseUnit === "سم" && currentProblem.targetUnit === "متر") {
                actualConversion = step1Input / 100;
            } else if (currentProblem.baseUnit === "كم" && currentProblem.targetUnit === "متر") {
                actualConversion = step1Input * 1000;
            } else if (currentProblem.baseUnit === "متر" && currentProblem.targetUnit === "مم") {
                actualConversion = step1Input * 1000;
            }

            // التحقق من صحة التحويل
            const isConversionCorrect = Math.abs(step2Input - actualConversion) < 0.01;

            let feedback = '';
            let pointsEarned = 0;

            if (isEstimationClose && isConversionCorrect) {
                feedback = `🎉 ممتاز! تقديرك منطقي (${step1Input} ${currentProblem.baseUnit}) وتحويلك صحيح (${step2Input} ${currentProblem.targetUnit})`;
                pointsEarned = 2;
                correctAnswers++;
            } else if (isConversionCorrect && !isEstimationClose) {
                feedback = `⭐ تحويلك صحيح، لكن التقدير كان بعيداً. ${currentProblem.object} عادةً ≈ ${currentProblem.baseVal} ${currentProblem.baseUnit}`;
                pointsEarned = 1;
                correctAnswers++;
            } else if (!isConversionCorrect && isEstimationClose) {
                feedback = `⚠️ تقديرك منطقي، لكن التحويل خاطئ! كان يجب أن يكون: ${actualConversion} ${currentProblem.targetUnit}. تذكر: ${currentProblem.hint}`;
                pointsEarned = -1;
            } else {
                feedback = `❌ خطأ في التقدير والتحويل. القيمة النموذجية: ${currentProblem.baseVal} ${currentProblem.baseUnit}. تذكر: ${currentProblem.hint}`;
                pointsEarned = -2;
            }

            score = Math.max(0, score + pointsEarned);

            feedbackElement.innerHTML = feedback;
            feedbackElement.style.color = pointsEarned > 0 ? '#27ae60' : '#e74c3c';

            if (pointsEarned > 0) {
                feedbackElement.classList.add('celebration');
            }

            // تحديث النتائج
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();

            setTimeout(() => {
                feedbackElement.classList.remove('celebration');
                generateProblem();
            }, 4000);
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        function resetGame() {
            score = 0;
            correctAnswers = 0;
            totalQuestions = 0;
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();
            generateProblem();
        }

        // إضافة event listeners
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('submit-btn').addEventListener('click', checkAnswer);
            document.getElementById('reset-btn').addEventListener('click', resetGame);

            // السماح بالضغط على Enter في أي حقل
            document.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    checkAnswer();
                }
            });

            resetGame();
        });

        // جعل الدوال متاحة globally
        window.checkAnswer = checkAnswer;
        window.resetGame = resetGame;
    </script>
</body>
</html>
