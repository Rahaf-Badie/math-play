<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصياد الذكي - {{ $lesson_game->lesson->name }}</title>
    <style>
        /* === CSS / التنسيقات === */
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
            border: 3px solid #1abc9c;
        }

        .lesson-info {
            background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #1abc9c;
            margin-bottom: 15px;
            border-bottom: 3px solid #1abc9c;
            padding-bottom: 10px;
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #e0f8f4 0%, #c8f4ec 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #1abc9c;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #f0f8ff 0%, #e0f0f8 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #1abc9c;
            position: relative;
        }

        .game-area::before {
            content: "🎯";
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 2em;
            opacity: 0.3;
        }

        .hunter-icon {
            font-size: 3em;
            margin: 15px 0;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .shape-display {
            font-size: 1.6em;
            color: #2c3e50;
            margin: 20px 0;
            padding: 20px;
            background: white;
            border-radius: 12px;
            border: 3px dashed #1abc9c;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            line-height: 1.6;
        }

        .question-text {
            font-size: 1.4em;
            font-weight: bold;
            color: #e74c3c;
            margin: 25px 0;
            padding: 15px;
            background: #fff5f5;
            border-radius: 10px;
            border: 2px solid #e74c3c;
        }

        .input-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin: 25px 0;
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
            margin-bottom: 8px;
        }

        .calculation-input {
            width: 200px;
            padding: 15px;
            font-size: 1.3em;
            border: 3px solid #3498db;
            border-radius: 10px;
            text-align: center;
            background-color: #fffdf6;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .calculation-input:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.3);
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
            color: #1abc9c;
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
            background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .formulas-section {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 12px;
            margin: 25px 0;
            border: 2px dashed #1abc9c;
            font-weight: bold;
        }

        .formula-card {
            display: inline-block;
            background: white;
            padding: 10px 20px;
            margin: 8px;
            border-radius: 8px;
            border: 2px solid #1abc9c;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .shape-display {
                font-size: 1.4em;
                padding: 15px;
            }

            .question-text {
                font-size: 1.2em;
            }

            .calculation-input {
                width: 180px;
                padding: 12px;
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
            .shape-display {
                font-size: 1.2em;
            }

            .calculation-input {
                width: 150px;
                padding: 10px;
                font-size: 1.1em;
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

        <h1>🎯 الصياد الذكي</h1>

        <!-- التعليمات -->
        <div class="instructions">
            <p>🔢 المدى: من {{ $min_range ?? 3 }} إلى {{ $max_range ?? 15 }}</p>
            <p>🎯 احسب المساحة للأشكال الهندسية المختلفة</p>
        </div>

        <!-- قواعد الحساب -->
        <div class="formulas-section">
            📚 قواعد الحساب:
            <span class="formula-card">مساحة المستطيل = الطول × العرض</span>
            <span class="formula-card">مساحة المربع = الضلع × الضلع</span>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- أيقونة الصياد -->
            <div class="hunter-icon">🎯</div>

            <!-- عرض الشكل -->
            <div id="shape-display" class="shape-display">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <!-- نص السؤال -->
            <div id="question-text" class="question-text">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <!-- منطقة الإدخال -->
            <div class="input-section">
                <div class="input-group">
                    <div class="input-label">المساحة:</div>
                    <input type="number" id="area-input" class="calculation-input" placeholder="أدخل المساحة">
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="check-btn">✅ تحقق من الإجابة</button>
                <button id="reset-btn">🔄 سؤال جديد</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">
                ابدأ بحساب المساحة!
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
        const minRange = {{ $min_range ?? 3 }};
        const maxRange = {{ $max_range ?? 15 }};

        let length = 0;
        let width = 0;
        let isSquare = false;
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;

        function generateDimensions() {
            // توليد أبعاد عشوائية ضمن المدى المحدد
            length = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            width = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            // تحديد عشوائي إذا كان الشكل مربع (50% من المرات)
            isSquare = Math.random() < 0.5;
            if (isSquare) {
                width = length;
            }
        }

        function setupNewRound() {
            generateDimensions();

            const shapeName = isSquare ? 'مربع' : 'مستطيل';
            let displayString;

            if (isSquare) {
                displayString = `🟦 الشكل: ${shapeName}<br>📏 طول الضلع = ${length} وحدة`;
            } else {
                displayString = `⬜ الشكل: ${shapeName}<br>📐 الطول = ${length} وحدة، العرض = ${width} وحدة`;
            }

            document.getElementById('shape-display').innerHTML = displayString;

            // تحديث نص السؤال
            document.getElementById('question-text').textContent =
                isSquare ?
                `ما هي مساحة المربع؟` :
                `ما هي مساحة المستطيل؟`;

            document.getElementById('area-input').value = '';
            document.getElementById('feedback').innerHTML = '💭 احسب المساحة وأدخل الإجابة...';
            document.getElementById('feedback').style.color = '#2c3e50';

            // تحديث شريط التقدم
            updateProgress();

            totalQuestions++;
            document.getElementById('total-count').textContent = totalQuestions;

            // التركيز على حقل الإدخال
            document.getElementById('area-input').focus();
        }

        function calculateArea() {
            return length * width;
        }

        function checkAnswer() {
            const userArea = parseInt(document.getElementById('area-input').value);
            const feedbackElement = document.getElementById('feedback');
            const correctArea = calculateArea();

            if (isNaN(userArea)) {
                feedbackElement.innerHTML = '❌ الرجاء إدخال رقم صحيح للمساحة';
                feedbackElement.style.color = '#e74c3c';
                return;
            }

            if (userArea === correctArea) {
                // إجابة صحيحة
                feedbackElement.innerHTML = `🎉 أحسنت! الإجابة صحيحة<br><small>مساحة ${isSquare ? 'المربع' : 'المستطيل'} = ${correctArea} وحدة مربعة</small>`;
                feedbackElement.style.color = '#27ae60';
                feedbackElement.classList.add('celebration');

                score += 10;
                correctAnswers++;

                // إظهار الإجابة الصحيحة
                document.getElementById('area-input').value = correctArea;
                document.getElementById('area-input').disabled = true;
                document.getElementById('area-input').style.background = '#d4edda';

                setTimeout(() => {
                    feedbackElement.classList.remove('celebration');
                    setupNewRound();
                }, 2500);
            } else {
                // إجابة خاطئة
                feedbackElement.innerHTML = `❌ ليست الإجابة الصحيحة!<br><small>المساحة الصحيحة هي: ${correctArea}</small>`;
                feedbackElement.style.color = '#e74c3c';
                score = Math.max(0, score - 2);

                setTimeout(() => {
                    document.getElementById('area-input').value = '';
                    document.getElementById('area-input').focus();
                    feedbackElement.innerHTML = '💪 حاول مرة أخرى!';
                    feedbackElement.style.color = '#e67e22';
                }, 3000);
            }

            // تحديث النتائج
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            updateProgress();
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        function resetGame() {
            document.getElementById('area-input').disabled = false;
            document.getElementById('area-input').style.background = '#fffdf6';
            setupNewRound();
        }

        function startGame() {
            score = 0;
            correctAnswers = 0;
            totalQuestions = 0;
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();
            setupNewRound();
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
