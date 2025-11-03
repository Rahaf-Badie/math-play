<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>برج المقارنة الذكي - {{ $lesson_game->lesson->name }}</title>
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
            border: 3px solid #f39c12;
        }

        .lesson-info {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #f39c12;
            margin-bottom: 15px;
            border-bottom: 3px solid #f39c12;
            padding-bottom: 10px;
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #fef9e7 0%, #fcf3cf 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #f39c12;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #fffaf0 0%, #fff5e6 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #f39c12;
        }

        .tower-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .number-tower {
            flex: 1;
            min-width: 250px;
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #3498db;
        }

        .tower-header {
            font-size: 1.3em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            padding: 10px;
            background: #ecf0f1;
            border-radius: 8px;
        }

        .number-display {
            font-size: 2.2em;
            font-weight: bold;
            color: #2c3e50;
            font-family: 'Courier New', monospace;
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px dashed #bdc3c7;
        }

        .comparison-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 30px 0;
        }

        .option-card {
            padding: 20px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.4em;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .option-card.correct {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            animation: celebrate 0.6s ease;
        }

        .option-card.incorrect {
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
            color: #f39c12;
            font-weight: bold;
        }

        .digit-analysis {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            font-size: 1.1em;
        }

        .analysis-item {
            margin: 8px 0;
            padding: 5px;
            background: white;
            border-radius: 5px;
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
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
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

        #next-btn {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: white;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @media (max-width: 768px) {
            .tower-container {
                flex-direction: column;
            }

            .comparison-options {
                grid-template-columns: 1fr;
            }

            .number-display {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>🏗️ برج المقارنة الذكي</h1>

        <div class="instructions">
            <p>🔢 المدى: حتى 999,999,999</p>
            <p>🎯 قارن الأعداد باستخدام تحليل المنازل الرقمية</p>
        </div>

        <div class="game-area">
            <div class="tower-container">
                <div class="number-tower">
                    <div class="tower-header">العدد الأول</div>
                    <div class="number-display" id="tower-number1">0</div>
                    <div class="digit-analysis" id="analysis1">
                        <!-- سيتم تعبئته ديناميكياً -->
                    </div>
                </div>

                <div class="number-tower">
                    <div class="tower-header">العدد الثاني</div>
                    <div class="number-display" id="tower-number2">0</div>
                    <div class="digit-analysis" id="analysis2">
                        <!-- سيتم تعبئته ديناميكياً -->
                    </div>
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <div class="comparison-options">
                <div class="option-card" onclick="checkAnswer('>')">أكبر من</div>
                <div class="option-card" onclick="checkAnswer('=')">يساوي</div>
                <div class="option-card" onclick="checkAnswer('<')">أصغر من</div>
            </div>

            <div class="feedback" id="feedback">
                قارن بين العددين واختر العلاقة الصحيحة!
            </div>

            <div class="controls">
                <button id="next-btn" onclick="nextComparison()">🏗️ مقارنة تالية</button>
                <button id="hint-btn" onclick="showHint()">💡 عرض المساعدة</button>
            </div>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>الإجابات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript لبرج المقارنة الذكي ===
        const minRange = {{ $min_range ?? 100000 }};
        const maxRange = {{ $max_range ?? 999999999 }};

        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let towerNumber1 = 0;
        let towerNumber2 = 0;
        let correctSymbol = '';

        function formatNumber(num) {
            return new Intl.NumberFormat('ar-EG').format(num);
        }

        function analyzeNumber(num) {
            const digits = num.toString().split('');
            const places = ['مئات الملايين', 'عشرات الملايين', 'ملايين', 'مئات الآلاف', 'عشرات الآلاف', 'آلاف', 'مئات', 'عشرات', 'آحاد'];

            let analysis = '';
            digits.forEach((digit, index) => {
                const placeIndex = places.length - digits.length + index;
                if (placeIndex >= 0) {
                    analysis += `<div class="analysis-item">${digit} - ${places[placeIndex]}</div>`;
                }
            });

            return analysis;
        }

        function generateTowerNumbers() {
            // توليد عددين ضمن المدى المحدد
            towerNumber1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            towerNumber2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            // تحديد الرمز الصحيح
            if (towerNumber1 === towerNumber2) {
                correctSymbol = '=';
            } else if (towerNumber1 > towerNumber2) {
                correctSymbol = '>';
            } else {
                correctSymbol = '<';
            }

            // تحديث العرض
            document.getElementById('tower-number1').textContent = formatNumber(towerNumber1);
            document.getElementById('tower-number2').textContent = formatNumber(towerNumber2);

            // تحديث التحليل
            document.getElementById('analysis1').innerHTML = analyzeNumber(towerNumber1);
            document.getElementById('analysis2').innerHTML = analyzeNumber(towerNumber2);

            document.getElementById('feedback').textContent = 'قارن بين العددين باستخدام تحليل المنازل!';
            document.getElementById('feedback').style.background = '#f8f9fa';

            // إعادة تعيين البطاقات
            document.querySelectorAll('.option-card').forEach(card => {
                card.classList.remove('correct', 'incorrect');
                card.style.cursor = 'pointer';
            });

            totalQuestions++;
            document.getElementById('total-count').textContent = totalQuestions;
        }

        function checkAnswer(userSymbol) {
            const isCorrect = userSymbol === correctSymbol;
            const feedbackElement = document.getElementById('feedback');

            // تعطيل جميع البطاقات
            document.querySelectorAll('.option-card').forEach(card => {
                card.style.cursor = 'not-allowed';
                if (card.textContent === getSymbolText(correctSymbol)) {
                    card.classList.add('correct');
                }
            });

            if (isCorrect) {
                feedbackElement.innerHTML = `🎉 ممتاز! ${formatNumber(towerNumber1)} ${correctSymbol} ${formatNumber(towerNumber2)}<br><small>استخدمت تحليل المنازل بشكل صحيح</small>`;
                feedbackElement.style.background = '#d4edda';
                score += 12;
                correctAnswers++;
            } else {
                feedbackElement.innerHTML = `❌ حاول مرة أخرى!<br><small>${formatNumber(towerNumber1)} ${correctSymbol} ${formatNumber(towerNumber2)}</small>`;
                feedbackElement.style.background = '#f8d7da';
                score = Math.max(0, score - 3);

                // إبراز البطاقة الخاطئة
                document.querySelectorAll('.option-card').forEach(card => {
                    if (card.textContent === getSymbolText(userSymbol)) {
                        card.classList.add('incorrect');
                    }
                });
            }

            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            updateProgress();
        }

        function getSymbolText(symbol) {
            const symbols = {
                '>': 'أكبر من',
                '=': 'يساوي',
                '<': 'أصغر من'
            };
            return symbols[symbol];
        }

        function showHint() {
            const hint = `💡 المساعدة: ابدأ بالمقارنة من أقصى اليسار (أكبر منزلة)<br>
                         ${towerNumber1.toString().length} أرقام 🆚 ${towerNumber2.toString().length} أرقام`;
            document.getElementById('feedback').innerHTML = hint;
            document.getElementById('feedback').style.background = '#d1ecf1';
        }

        function nextComparison() {
            generateTowerNumbers();
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        // بدء اللعبة
        generateTowerNumbers();
    </script>
</body>
</html>
