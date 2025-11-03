<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حديقة الكسور الملونة - {{ $lesson_game->lesson->name }}</title>
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
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 700px;
            border: 3px solid #27ae60;
        }

        .lesson-info {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 1em;
        }

        h1 {
            color: #27ae60;
            margin-bottom: 10px;
            font-size: 1.8em;
        }

        .instructions {
            background: linear-gradient(135deg, #d4f4dd 0%, #b8e6c8 100%);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 3px solid #27ae60;
            font-size: 1em;
        }

        .game-area {
            padding: 20px;
            background: linear-gradient(135deg, #f0fff4 0%, #e6ffed 100%);
            border-radius: 15px;
            margin-bottom: 20px;
            border: 2px solid #27ae60;
        }

        .garden-display {
            font-size: 3em;
            margin: 15px 0;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .fraction-garden {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .flower-pot {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .fraction-flower {
            width: 120px;
            height: 120px;
            background: #ffeb3b;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 3px solid #ff9800;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .fraction-petal {
            position: absolute;
            width: 30px;
            height: 50px;
            background: #ff5722;
            border-radius: 50%;
        }

        .petal-1 { top: -10px; left: 45px; transform: rotate(0deg); }
        .petal-2 { top: 15px; right: -10px; transform: rotate(90deg); }
        .petal-3 { bottom: -10px; left: 45px; transform: rotate(180deg); }
        .petal-4 { top: 15px; left: -10px; transform: rotate(270deg); }

        .fraction-center {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px solid #795548;
            z-index: 2;
        }

        .fraction-display {
            font-size: 1.4em;
            font-weight: bold;
            color: #333;
        }

        .fraction-line {
            width: 80%;
            height: 2px;
            background: #333;
            margin: 2px 0;
        }

        .comparison-symbol {
            font-size: 3em;
            color: #e74c3c;
            font-weight: bold;
        }

        .options-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .comparison-btn {
            padding: 15px 25px;
            font-size: 1.5em;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            min-width: 60px;
        }

        .comparison-btn:hover {
            transform: scale(1.1);
        }

        .comparison-btn.correct {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            animation: celebrate 0.6s ease;
        }

        .comparison-btn.incorrect {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .feedback {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
        }

        #score {
            font-size: 2em;
            color: #27ae60;
            font-weight: bold;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background-color: #ddd;
            border-radius: 5px;
            margin: 15px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 20px;
            font-size: 1em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        #next-btn {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @media (max-width: 768px) {
            .fraction-garden {
                gap: 15px;
            }
            
            .fraction-flower {
                width: 100px;
                height: 100px;
            }
            
            .fraction-center {
                width: 50px;
                height: 50px;
            }
            
            .comparison-symbol {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>🌷 حديقة الكسور الملونة</h1>
        
        <div class="instructions">
            <p>🎯 قارن بين الكسور واختر الرمز المناسب</p>
            <p>💡 تذكر: كلما زاد عدد الأجزاء الملونة زادت قيمة الكسر</p>
        </div>

        <div class="game-area">
            <div class="garden-display">🌼</div>

            <div class="fraction-garden">
                <div class="flower-pot">
                    <div class="fraction-flower" id="flower1">
                        <div class="fraction-petal petal-1"></div>
                        <div class="fraction-petal petal-2"></div>
                        <div class="fraction-petal petal-3"></div>
                        <div class="fraction-petal petal-4"></div>
                        <div class="fraction-center">
                            <div class="fraction-display" id="fraction1">1/2</div>
                        </div>
                    </div>
                    <div class="fraction-label">الكسر الأول</div>
                </div>

                <div class="comparison-symbol" id="comparison-symbol">?</div>

                <div class="flower-pot">
                    <div class="fraction-flower" id="flower2">
                        <div class="fraction-petal petal-1"></div>
                        <div class="fraction-petal petal-2"></div>
                        <div class="fraction-petal petal-3"></div>
                        <div class="fraction-petal petal-4"></div>
                        <div class="fraction-center">
                            <div class="fraction-display" id="fraction2">1/2</div>
                        </div>
                    </div>
                    <div class="fraction-label">الكسر الثاني</div>
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <div class="options-buttons">
                <button class="comparison-btn" onclick="checkAnswer('>')">أكبر</button>
                <button class="comparison-btn" onclick="checkAnswer('=')">يساوي</button>
                <button class="comparison-btn" onclick="checkAnswer('<')">أصغر</button>
            </div>

            <div class="feedback" id="feedback">
                قارن بين الكسور واختر الإجابة!
            </div>

            <div class="controls">
                <button id="next-btn">➡️ سؤال جديد</button>
            </div>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>الإجابات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript لحديقة الكسور الملونة ===
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 8 }};
        
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let fraction1 = { numerator: 1, denominator: 2 };
        let fraction2 = { numerator: 1, denominator: 2 };
        let correctSymbol = '';

        function generateSimpleFractions() {
            // توليد كسور بسيطة مناسبة للصف الرابع
            const denominators = [2, 3, 4, 5, 6, 8];
            const denominator = denominators[Math.floor(Math.random() * denominators.length)];
            
            // توليد بسطين مختلفين
            let numerator1, numerator2;
            do {
                numerator1 = Math.floor(Math.random() * denominator) + 1;
                numerator2 = Math.floor(Math.random() * denominator) + 1;
            } while (numerator1 === numerator2);

            fraction1 = { numerator: numerator1, denominator: denominator };
            fraction2 = { numerator: numerator2, denominator: denominator };

            // تحديد الرمز الصحيح
            const value1 = fraction1.numerator / fraction1.denominator;
            const value2 = fraction2.numerator / fraction2.denominator;
            
            if (value1 === value2) {
                correctSymbol = '=';
            } else if (value1 > value2) {
                correctSymbol = '>';
            } else {
                correctSymbol = '<';
            }

            updateFlowersDisplay();
            
            document.getElementById('feedback').textContent = 'قارن بين الكسور واختر الإجابة!';
            document.getElementById('feedback').style.background = '#f8f9fa';
            
            // إعادة تعيين الأزرار
            document.querySelectorAll('.comparison-btn').forEach(btn => {
                btn.classList.remove('correct', 'incorrect');
            });

            totalQuestions++;
            document.getElementById('total-count').textContent = totalQuestions;
        }

        function updateFlowersDisplay() {
            // تحديث عرض الكسور
            document.getElementById('fraction1').innerHTML = 
                `${fraction1.numerator}<div class="fraction-line"></div>${fraction1.denominator}`;
            document.getElementById('fraction2').innerHTML = 
                `${fraction2.numerator}<div class="fraction-line"></div>${fraction2.denominator}`;

            // تحديث البتلات الملونة
            updateFlowerPetals('flower1', fraction1.numerator, fraction1.denominator);
            updateFlowerPetals('flower2', fraction2.numerator, fraction2.denominator);
        }

        function updateFlowerPetals(flowerId, numerator, denominator) {
            const flower = document.getElementById(flowerId);
            const petals = flower.querySelectorAll('.fraction-petal');
            
            // إخفاء جميع البتلات أولاً
            petals.forEach(petal => {
                petal.style.display = 'none';
            });
            
            // إظهار البتلات حسب قيمة الكسر
            const petalsToShow = Math.round((numerator / denominator) * 4);
            for (let i = 0; i < petalsToShow; i++) {
                if (petals[i]) {
                    petals[i].style.display = 'block';
                }
            }
        }

        function checkAnswer(userSymbol) {
            const isCorrect = userSymbol === correctSymbol;
            const feedbackElement = document.getElementById('feedback');
            
            // تعطيل جميع الأزرار
            document.querySelectorAll('.comparison-btn').forEach(btn => {
                if (btn.textContent === getArabicSymbol(correctSymbol)) {
                    btn.classList.add('correct');
                }
            });

            if (isCorrect) {
                feedbackElement.innerHTML = 
                    `🎉 أحسنت! <br>
                     ${fraction1.numerator}/${fraction1.denominator} ${correctSymbol} ${fraction2.numerator}/${fraction2.denominator}`;
                feedbackElement.style.background = '#d4edda';
                score += 10;
                correctAnswers++;
            } else {
                feedbackElement.innerHTML = 
                    `❌ حاول مرة أخرى! <br>
                     ${fraction1.numerator}/${fraction1.denominator} ${correctSymbol} ${fraction2.numerator}/${fraction2.denominator}`;
                feedbackElement.style.background = '#f8d7da';
                score = Math.max(0, score - 2);
                
                // إبراز الزر الخاطئ
                document.querySelectorAll('.comparison-btn').forEach(btn => {
                    if (btn.textContent === getArabicSymbol(userSymbol)) {
                        btn.classList.add('incorrect');
                    }
                });
            }

            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            updateProgress();
        }

        function getArabicSymbol(symbol) {
            const symbols = {
                '>': 'أكبر',
                '=': 'يساوي',
                '<': 'أصغر'
            };
            return symbols[symbol];
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        // إعداد event listeners
        document.getElementById('next-btn').addEventListener('click', generateSimpleFractions);

        // بدء اللعبة
        generateSimpleFractions();
    </script>
</body>
</html>