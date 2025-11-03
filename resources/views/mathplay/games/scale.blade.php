<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الميزان الرقمي - {{ $lesson_game->lesson->name }}</title>
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
            border: 3px solid #9b59b6;
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
            font-size: 1.8em;
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
            position: relative;
        }

        .game-area::before {
            content: "⚖️";
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 2em;
            opacity: 0.3;
        }

        .balance-scale {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px 0;
            position: relative;
        }

        .scale-beam {
            width: 300px;
            height: 8px;
            background: linear-gradient(135deg, #7f8c8d 0%, #95a5a6 100%);
            border-radius: 4px;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .scale-pivot {
            width: 20px;
            height: 20px;
            background: #e74c3c;
            border-radius: 50%;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .scale-pan {
            width: 80px;
            height: 20px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border-radius: 8px;
            position: absolute;
            top: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .scale-pan.left {
            left: -90px;
        }

        .scale-pan.right {
            right: -90px;
        }

        .comparison-area {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 40px 0;
        }

        .fraction-box {
            font-size: 2.5em;
            font-weight: bold;
            color: #2c3e50;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 120px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid #9b59b6;
        }

        .numerator {
            border-bottom: 4px solid #9b59b6;
            padding: 0 20px;
            min-width: 50px;
            font-size: 1.2em;
        }

        .denominator {
            padding: 8px 20px 0;
            font-size: 1.2em;
        }

        .symbol-area {
            font-size: 3.5em;
            font-weight: 900;
            color: #e74c3c;
            margin: 0 30px;
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .controls button {
            padding: 15px 30px;
            font-size: 1.3em;
            font-weight: bold;
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            min-width: 120px;
        }

        .controls button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(155, 89, 182, 0.4);
        }

        .controls button:active {
            transform: translateY(-1px);
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.2em;
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
            color: #9b59b6;
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
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .equivalent-rule {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px dashed #9b59b6;
            font-weight: bold;
            font-size: 1.1em;
        }

        .reset-btn {
            padding: 12px 25px;
            font-size: 1.1em;
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            margin-top: 10px;
        }

        .reset-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(116, 185, 255, 0.4);
        }

        @media (max-width: 768px) {
            .comparison-area {
                flex-direction: column;
                gap: 20px;
            }

            .symbol-area {
                margin: 10px 0;
                order: -1;
            }

            .fraction-box {
                font-size: 2em;
                min-width: 100px;
            }

            .scale-beam {
                width: 250px;
            }

            .controls {
                flex-direction: column;
                align-items: center;
            }

            .controls button {
                width: 200px;
            }
        }

        @media (max-width: 480px) {
            .fraction-box {
                font-size: 1.8em;
                min-width: 80px;
                padding: 15px;
            }

            .symbol-area {
                font-size: 2.8em;
                padding: 10px 20px;
            }

            .scale-beam {
                width: 200px;
            }

            .container {
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

        <h1>⚖️ الميزان الرقمي</h1>

        <!-- التعليمات -->
        <div class="instructions">
            <p>🔢 المدى: من {{ $min_range ?? 1 }} إلى {{ $max_range ?? 12 }}</p>
            <p>🎯 اكتشف الكسور المتكافئة - الكسور التي تمثل نفس القيمة</p>
        </div>

        <!-- قاعدة الكسور المتكافئة -->
        <div class="equivalent-rule">
            📚 القاعدة: الكسور المتكافئة لها نفس القيمة مثل ½ = ²⁄₄ = ³⁄₆ 🔄
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- ميزان توضيحي -->
            <div class="balance-scale">
                <div class="scale-beam">
                    <div class="scale-pivot"></div>
                    <div class="scale-pan left"></div>
                    <div class="scale-pan right"></div>
                </div>
            </div>

            <!-- منطقة المقارنة -->
            <div class="comparison-area">
                <div id="fraction1" class="fraction-box">
                    <div class="numerator">--</div>
                    <div class="denominator">--</div>
                </div>

                <div id="comparison-symbol" class="symbol-area">?</div>

                <div id="fraction2" class="fraction-box">
                    <div class="numerator">--</div>
                    <div class="denominator">--</div>
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button onclick="submitAnswer('>')">أكبر من ></button>
                <button onclick="submitAnswer('=')">يساوي =</button>
                <button onclick="submitAnswer('<')">أصغر من <</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">
                هل هذان الكسران متكافئان؟ اختر رمز المقارنة الصحيح!
            </div>

            <!-- زر إعادة -->
            <button class="reset-btn" onclick="resetGame()">🔄 سؤال جديد</button>
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
        const maxRange = {{ $max_range ?? 12 }};

        let f1Num, f1Den, f2Num, f2Den;
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;

        function generateFraction() {
            let den = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            let num = Math.floor(Math.random() * den) + 1;
            return { num, den };
        }

        function simplifyFraction(num, den) {
            const gcd = (a, b) => b === 0 ? a : gcd(b, a % b);
            const divisor = gcd(num, den);
            return {
                num: num / divisor,
                den: den / divisor
            };
        }

        function startNewRound() {
            // 70% فرصة لكسرين متكافئين، 30% لكسرين غير متكافئين
            const isEquivalent = Math.random() < 0.7;

            if (isEquivalent) {
                // توليد كسرين متكافئين
                const baseFraction = generateFraction();
                const multiplier = Math.floor(Math.random() * 2) + 2; // 2 أو 3

                f1Num = baseFraction.num;
                f1Den = baseFraction.den;
                f2Num = baseFraction.num * multiplier;
                f2Den = baseFraction.den * multiplier;
            } else {
                // توليد كسرين غير متكافئين
                let f1 = generateFraction();
                let f2 = generateFraction();

                // التأكد من أن الكسرين غير متكافئين
                while (f1.num * f2.den === f1.den * f2.num) {
                    f2 = generateFraction();
                }

                f1Num = f1.num; f1Den = f1.den;
                f2Num = f2.num; f2Den = f2.den;
            }

            // تحديث العرض
            document.getElementById('fraction1').innerHTML = `
                <div class="numerator">${f1Num}</div>
                <div class="denominator">${f1Den}</div>
            `;

            document.getElementById('fraction2').innerHTML = `
                <div class="numerator">${f2Num}</div>
                <div class="denominator">${f2Den}</div>
            `;

            document.getElementById('comparison-symbol').textContent = '?';
            document.getElementById('feedback').innerHTML = '🔍 هل هذان الكسران متكافئان؟ اختر رمز المقارنة الصحيح!';
            document.getElementById('feedback').style.color = '#2c3e50';

            // تحديث شريط التقدم
            updateProgress();
        }

        function getCorrectSymbol() {
            // للكسور المتكافئة، نستخدم المقارنة الرياضية الدقيقة
            return (f1Num * f2Den === f1Den * f2Num) ? '=' :
                   (f1Num / f1Den > f2Num / f2Den) ? '>' : '<';
        }

        function submitAnswer(userChoice) {
            const correctSymbol = getCorrectSymbol();
            const feedbackElement = document.getElementById('feedback');
            totalQuestions++;

            // تحديث الرمز المعروض
            document.getElementById('comparison-symbol').textContent = userChoice;

            if (userChoice === correctSymbol) {
                let successMessage = '';
                if (userChoice === '=') {
                    successMessage = `🎉 صحيح! ${f1Num}/${f1Den} = ${f2Num}/${f2Den}<br><small>هذان كسران متكافئان! 🔄</small>`;
                } else {
                    successMessage = `🎉 صحيح! ${f1Num}/${f1Den} ${userChoice} ${f2Num}/${f2Den}<br><small>هذان كسران غير متكافئين!</small>`;
                }

                feedbackElement.innerHTML = successMessage;
                feedbackElement.style.color = '#27ae60';
                feedbackElement.classList.add('celebration');

                score += 10;
                correctAnswers++;
            } else {
                let errorMessage = '';
                if (correctSymbol === '=') {
                    errorMessage = `❌ حاول مرة أخرى! ${f1Num}/${f1Den} = ${f2Num}/${f2Den}<br><small>هذان كسران متكافئان! 🔄</small>`;
                } else {
                    errorMessage = `❌ حاول مرة أخرى! ${f1Num}/${f1Den} ${correctSymbol} ${f2Num}/${f2Den}<br><small>الكسران غير متكافئين</small>`;
                }

                feedbackElement.innerHTML = errorMessage;
                feedbackElement.style.color = '#e74c3c';
                score = Math.max(0, score - 2);
            }

            // تحديث النتائج
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();

            setTimeout(() => {
                feedbackElement.classList.remove('celebration');
                startNewRound();
            }, 3000);
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
            startNewRound();
        }

        // إضافة event listeners
        document.addEventListener('DOMContentLoaded', function() {
            resetGame();
        });

        // جعل الدوال متاحة globally
        window.submitAnswer = submitAnswer;
        window.resetGame = resetGame;
    </script>
</body>
</html>
