<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معركة الأعداد العملاقة - {{ $lesson_game->lesson->name }}</title>
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

        .battle-arena {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 30px 0;
            gap: 20px;
        }

        .number-card {
            flex: 1;
            padding: 25px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 4px solid #3498db;
            min-height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .number-display {
            font-size: 2.5em;
            font-weight: bold;
            color: #2c3e50;
            font-family: 'Courier New', monospace;
        }

        .vs-badge {
            font-size: 3em;
            font-weight: bold;
            color: #e74c3c;
            background: white;
            padding: 15px 25px;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .comparison-btn {
            padding: 20px 35px;
            font-size: 1.8em;
            font-weight: bold;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            min-width: 80px;
        }

        .comparison-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .comparison-btn.correct {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            animation: celebrate 0.6s ease;
        }

        .comparison-btn.incorrect {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.4em;
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
            font-size: 2.5em;
            color: #e74c3c;
            font-weight: bold;
        }

        .number-info {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            font-size: 1.1em;
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

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @media (max-width: 768px) {
            .battle-arena {
                flex-direction: column;
            }

            .number-display {
                font-size: 2em;
            }

            .vs-badge {
                font-size: 2em;
                padding: 10px 20px;
            }

            .comparison-btn {
                padding: 15px 25px;
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>⚔️ معركة الأعداد العملاقة</h1>

        <div class="instructions">
            <p>🔢 المدى: حتى 999,999,999</p>
            <p>🎯 قارن بين الأعداد واختر الرمز المناسب</p>
        </div>

        <div class="game-area">
            <div class="number-info" id="question-text">
                أي عدد أكبر؟
            </div>

            <div class="battle-arena">
                <div class="number-card">
                    <div class="number-display" id="number1">0</div>
                </div>

                <div class="vs-badge">VS</div>

                <div class="number-card">
                    <div class="number-display" id="number2">0</div>
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <div class="controls">
                <button class="comparison-btn" onclick="checkAnswer('>')">></button>
                <button class="comparison-btn" onclick="checkAnswer('=')">=</button>
                <button class="comparison-btn" onclick="checkAnswer('<')"><</button>
            </div>

            <div class="feedback" id="feedback">
                ابدأ المعركة واختر الرمز الصحيح!
            </div>

            <div class="controls">
                <button onclick="nextBattle()" style="background: linear-gradient(135deg, #27ae60 0%, #219a52 100%); color: white; padding: 15px 30px; border: none; border-radius: 10px; cursor: pointer; font-size: 1.2em;">
                    ⚔️ معركة تالية
                </button>
            </div>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>الإجابات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript لمعركة الأعداد العملاقة ===
        const minRange = {{ $min_range ?? 100000 }};
        const maxRange = {{ $max_range ?? 999999999 }};

        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let number1 = 0;
        let number2 = 0;
        let correctSymbol = '';

        function formatNumber(num) {
            return new Intl.NumberFormat('ar-EG').format(num);
        }

        function generateBattleNumbers() {
            // توليد عددين ضمن المدى المحدد
            number1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            number2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            // تحديد الرمز الصحيح
            if (number1 === number2) {
                correctSymbol = '=';
            } else if (number1 > number2) {
                correctSymbol = '>';
            } else {
                correctSymbol = '<';
            }

            // تحديث العرض
            document.getElementById('number1').textContent = formatNumber(number1);
            document.getElementById('number2').textContent = formatNumber(number2);

            document.getElementById('feedback').textContent = 'اختر رمز المقارنة الصحيح!';
            document.getElementById('feedback').style.background = '#f8f9fa';

            // إعادة تعيين أزرار المقارنة
            document.querySelectorAll('.comparison-btn').forEach(btn => {
                btn.classList.remove('correct', 'incorrect');
                btn.disabled = false;
            });

            totalQuestions++;
            document.getElementById('total-count').textContent = totalQuestions;
        }

        function checkAnswer(userSymbol) {
            const isCorrect = userSymbol === correctSymbol;
            const feedbackElement = document.getElementById('feedback');

            // تعطيل جميع الأزرار
            document.querySelectorAll('.comparison-btn').forEach(btn => {
                btn.disabled = true;
                if (btn.textContent === correctSymbol) {
                    btn.classList.add('correct');
                }
            });

            if (isCorrect) {
                feedbackElement.innerHTML = `🎉 صحيح! ${formatNumber(number1)} ${correctSymbol} ${formatNumber(number2)}`;
                feedbackElement.style.background = '#d4edda';
                score += 10;
                correctAnswers++;
            } else {
                feedbackElement.innerHTML = `❌ خطأ! الإجابة الصحيحة: ${formatNumber(number1)} ${correctSymbol} ${formatNumber(number2)}`;
                feedbackElement.style.background = '#f8d7da';
                score = Math.max(0, score - 5);

                // إبراز الزر الخاطئ
                document.querySelectorAll('.comparison-btn').forEach(btn => {
                    if (btn.textContent === userSymbol) {
                        btn.classList.add('incorrect');
                    }
                });
            }

            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            updateProgress();
        }

        function nextBattle() {
            generateBattleNumbers();
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        // بدء اللعبة
        generateBattleNumbers();
    </script>
</body>
</html>
