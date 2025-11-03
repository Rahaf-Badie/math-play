<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ساعة التحويل - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 700px;
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
            background: linear-gradient(135deg, #fce4ec 0%, #f8bbd9 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #e74c3c;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #fff0f5 0%, #ffe4ec 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #e74c3c;
            position: relative;
        }

        .game-area::before {
            content: "⏱️";
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 2em;
            opacity: 0.3;
        }

        .clock-animation {
            font-size: 4em;
            margin: 20px 0;
            animation: clockSpin 3s ease-in-out infinite;
        }

        @keyframes clockSpin {
            0% { transform: rotate(0deg); }
            50% { transform: rotate(180deg); }
            100% { transform: rotate(360deg); }
        }

        .conversion-problem {
            font-size: 2.2em;
            font-weight: bold;
            color: #c0392b;
            margin: 30px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .input-box {
            width: 120px;
            padding: 15px;
            font-size: 1.2em;
            border: 3px solid #f39c12;
            border-radius: 10px;
            text-align: center;
            background-color: #fffdf6;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .input-box:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 15px rgba(231, 76, 60, 0.5);
            outline: none;
            transform: scale(1.05);
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 25px;
            font-size: 1.1em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            min-width: 120px;
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #check-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 184, 148, 0.4);
        }

        #reset-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(116, 185, 255, 0.4);
        }

        .feedback {
            margin-top: 20px;
            font-size: 1.3em;
            font-weight: bold;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
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
            color: #e74c3c;
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
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .time-rules {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px dashed #e74c3c;
            font-weight: bold;
            font-size: 1.1em;
        }

        .unit-card {
            display: inline-block;
            background: white;
            padding: 8px 15px;
            margin: 5px;
            border-radius: 8px;
            border: 2px solid #e74c3c;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .conversion-problem {
                font-size: 1.8em;
                flex-direction: column;
                gap: 10px;
            }

            .input-box {
                width: 100px;
                padding: 12px;
            }

            .clock-animation {
                font-size: 3em;
            }

            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.6em;
            }
        }

        @media (max-width: 480px) {
            .conversion-problem {
                font-size: 1.6em;
            }

            .input-box {
                width: 80px;
                padding: 10px;
                font-size: 1em;
            }

            .clock-animation {
                font-size: 2.5em;
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

        <h1>⏱️ ساعة التحويل</h1>

        <!-- التعليمات -->
        <div class="instructions">
            <p>🔢 المدى: من {{ $min_range ?? 1 }} إلى {{ $max_range ?? 60 }}</p>
            <p>🎯 حول بين وحدات قياس الزمن باستخدام العلاقات الأساسية</p>
        </div>

        <!-- قاعدة وحدات الزمن -->
        <div class="time-rules">
            📚 قواعد التحويل:
            <span class="unit-card">1 ساعة = 60 دقيقة</span>
            <span class="unit-card">1 دقيقة = 60 ثانية</span>
            <span class="unit-card">1 يوم = 24 ساعة</span>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- ساعة متحركة -->
            <div class="clock-animation">⏰</div>

            <!-- مشكلة التحويل -->
            <div id="conversion-problem" class="conversion-problem">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="check-btn">✅ تحقق</button>
                <button id="reset-btn">🔄 سؤال جديد</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">
                ابدأ بحل مسألة التحويل!
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
        const maxRange = {{ $max_range ?? 60 }};

        // وحدات قياس الزمن
        const TIME_CONVERSIONS = [
            // تحويل من وحدات كبيرة إلى صغيرة
            { factor: 60, unit1: "ساعة", unit2: "دقيقة", type: "multiply" },
            { factor: 60, unit1: "دقيقة", unit2: "ثانية", type: "multiply" },
            { factor: 24, unit1: "يوم", unit2: "ساعة", type: "multiply" },
            { factor: 7, unit1: "أسبوع", unit2: "يوم", type: "multiply" },

            // تحويل من وحدات صغيرة إلى كبيرة
            { factor: 60, unit1: "دقيقة", unit2: "ساعة", type: "divide" },
            { factor: 60, unit1: "ثانية", unit2: "دقيقة", type: "divide" },
            { factor: 24, unit1: "ساعة", unit2: "يوم", type: "divide" },
            { factor: 7, unit1: "يوم", unit2: "أسبوع", type: "divide" }
        ];

        let currentValue = 0;
        let correctResult = 0;
        let currentConversion = null;
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;

        function generateProblem() {
            const index = Math.floor(Math.random() * TIME_CONVERSIONS.length);
            currentConversion = TIME_CONVERSIONS[index];

            // توليد رقم عشوائي ضمن المدى المحدد
            currentValue = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            if (currentConversion.type === "multiply") {
                correctResult = currentValue * currentConversion.factor;
                document.getElementById('conversion-problem').innerHTML =
                    `${currentValue} ${currentConversion.unit1} = <input type="number" id="user-input" class="input-box" placeholder="؟"> ${currentConversion.unit2}`;
            } else {
                // لتحويل القسمة، نستخدم أعداداً تكون نتيجة قسمتها بسيطة
                let divisionValue = currentValue * currentConversion.factor;
                correctResult = currentValue;
                document.getElementById('conversion-problem').innerHTML =
                    `${divisionValue} ${currentConversion.unit1} = <input type="number" id="user-input" class="input-box" placeholder="؟"> ${currentConversion.unit2}`;
            }

            document.getElementById('user-input').value = '';
            document.getElementById('feedback').innerHTML = '⏳ أدخل القيمة بعد التحويل...';
            document.getElementById('feedback').style.color = '#2c3e50';
            document.getElementById('user-input').focus();

            // تحديث شريط التقدم
            updateProgress();
        }

        function checkAnswer() {
            const userInput = parseFloat(document.getElementById('user-input').value);
            const feedbackElement = document.getElementById('feedback');
            totalQuestions++;

            if (isNaN(userInput)) {
                feedbackElement.innerHTML = '❌ الرجاء إدخال رقم صحيح';
                feedbackElement.style.color = '#e74c3c';
                return;
            }

            // السماح بهامش خطأ صغير للأعداد العشرية
            if (Math.abs(userInput - correctResult) < 0.01) {
                // إجابة صحيحة
                feedbackElement.innerHTML = `🎉 أحسنت! ${currentValue} ${currentConversion.unit1} = ${correctResult} ${currentConversion.unit2}<br><small>تحويل صحيح! ⏱️</small>`;
                feedbackElement.style.color = '#27ae60';
                feedbackElement.classList.add('celebration');

                score += 10;
                correctAnswers++;

                // إظهار الإجابة الصحيحة
                document.getElementById('user-input').value = correctResult;
                document.getElementById('user-input').disabled = true;
                document.getElementById('user-input').style.background = '#d4edda';

                setTimeout(() => {
                    feedbackElement.classList.remove('celebration');
                    generateProblem();
                }, 2000);
            } else {
                // إجابة خاطئة
                feedbackElement.innerHTML = `❌ حاول مرة أخرى! الإجابة الصحيحة: ${correctResult}<br><small>تذكر: ${getConversionRule()}</small>`;
                feedbackElement.style.color = '#e74c3c';
                score = Math.max(0, score - 2);

                setTimeout(() => {
                    document.getElementById('user-input').value = '';
                    document.getElementById('user-input').focus();
                    feedbackElement.innerHTML = '💪 حاول مرة أخرى!';
                    feedbackElement.style.color = '#e67e22';
                }, 3000);
            }

            // تحديث النتائج
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();
        }

        function getConversionRule() {
            if (currentConversion.type === "multiply") {
                return `1 ${currentConversion.unit1} = ${currentConversion.factor} ${currentConversion.unit2}`;
            } else {
                return `${currentConversion.factor} ${currentConversion.unit1} = 1 ${currentConversion.unit2}`;
            }
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        function resetGame() {
            document.getElementById('user-input').disabled = false;
            document.getElementById('user-input').style.background = '#fffdf6';
            generateProblem();
        }

        function startGame() {
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
            document.getElementById('check-btn').addEventListener('click', checkAnswer);
            document.getElementById('reset-btn').addEventListener('click', resetGame);

            // السماح بالضغط على Enter
            document.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    checkAnswer();
                }
            });

            startGame();
        });

        // جعل الدوال متاحة globally
        window.checkAnswer = checkAnswer;
        window.resetGame = resetGame;
        window.startGame = startGame;
    </script>
</body>
</html>
