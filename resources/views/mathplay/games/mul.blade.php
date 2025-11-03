<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جدول الضرب - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 500px;
            border: 3px solid #e67e22;
        }

        .lesson-info {
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #e67e22;
            margin-bottom: 15px;
            border-bottom: 3px solid #e67e22;
            padding-bottom: 10px;
            font-size: 1.8em;
        }

        .instructions {
            background: linear-gradient(135deg, #fbeedc 0%, #f8e3c9 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #e67e22;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #fdf2e9 0%, #fae5d3 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #e67e22;
            position: relative;
        }

        .game-area::before {
            content: "✏️";
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 1.8em;
            opacity: 0.3;
        }

        .equation-display {
            font-size: 2.2em;
            font-weight: bold;
            color: #c0392b;
            margin-bottom: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .blank-input {
            width: 100px;
            padding: 15px;
            font-size: 1em;
            border: 3px solid #f1c40f;
            border-radius: 10px;
            text-align: center;
            background-color: #fffdf6;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .blank-input:focus {
            border-color: #e67e22;
            box-shadow: 0 0 15px rgba(230, 126, 34, 0.5);
            outline: none;
            transform: scale(1.05);
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
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
            font-size: 1.2em;
            font-weight: bold;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }

        #score {
            font-size: 2em;
            color: #e67e22;
            font-weight: bold;
            display: inline-block;
            padding: 5px 15px;
            background: white;
            border-radius: 50px;
            margin: 0 10px;
        }

        .celebration {
            animation: celebrate 0.5s ease-in-out;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .property-rule {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 12px;
            border-radius: 8px;
            margin: 15px 0;
            border: 2px dashed #e67e22;
            font-weight: bold;
        }

        .stars {
            margin: 10px 0;
            font-size: 1.5em;
        }

        .star {
            color: #ddd;
            margin: 0 2px;
        }

        .star.filled {
            color: #f1c40f;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .equation-display {
                font-size: 1.8em;
            }

            .blank-input {
                width: 80px;
                padding: 12px;
            }

            button {
                padding: 10px 20px;
                min-width: 100px;
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

        <h1>✏️ املأ الفراغ (جدول الضرب)</h1>

        <!-- التعليمات -->
        <div class="instructions">
            <p>🔢 المدى: من {{ $min_range ?? 0 }} إلى {{ $max_range ?? 10 }}</p>
            <p>🎯 احسب ناتج الضرب وأدخله في المربع</p>
        </div>

        <!-- قاعدة الخاصية -->
        <div class="property-rule">
            📚 خاصية الضرب: أ × ب = الناتج
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <div id="equation-display" class="equation-display">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <!-- النجوم -->
            <div class="stars" id="stars">
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
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
                ابدأ بحل المسألة!
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
        const minRange = {{ $min_range ?? 0 }};
        const maxRange = {{ $max_range ?? 10 }};

        let factor1 = 0;
        let factor2 = 0;
        let product = 0;
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let consecutiveCorrect = 0; // الإجابات الصحيحة المتتالية

        function generateProblem() {
            // توليد الأعداد ضمن المدى المحدد (0-10)
            factor1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            factor2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            product = factor1 * factor2;

            // فقط إيجاد الناتج (بدون قسمة)
            const displayHTML = `${factor1} × ${factor2} = <input type="number" id="user-input" class="blank-input" placeholder="؟" min="0" max="${maxRange * maxRange}">`;

            document.getElementById('equation-display').innerHTML = displayHTML;
            document.getElementById('feedback').textContent = '🧠 احسب ناتج الضرب...';
            document.getElementById('feedback').style.color = '#333';
            document.getElementById('user-input').focus();

            // تحديث شريط التقدم والنجوم
            updateProgress();
            updateStars();
        }

        function checkAnswer() {
            const userInput = parseInt(document.getElementById('user-input').value);
            const feedbackElement = document.getElementById('feedback');

            if (isNaN(userInput)) {
                feedbackElement.innerHTML = '❌ الرجاء إدخال رقم صحيح';
                feedbackElement.style.color = '#e74c3c';
                return;
            }

            totalQuestions++;

            if (userInput === product) {
                // إجابة صحيحة
                feedbackElement.innerHTML = '🎉 صحيح! أحسنت! 🎉';
                feedbackElement.style.color = '#2ecc71';
                feedbackElement.classList.add('celebration');

                score += 10;
                correctAnswers++;
                consecutiveCorrect++;

                // إظهار الإجابة الصحيحة
                document.getElementById('user-input').value = product;
                document.getElementById('user-input').disabled = true;
                document.getElementById('user-input').style.background = '#d4edda';

                setTimeout(() => {
                    feedbackElement.classList.remove('celebration');
                    generateProblem();
                }, 1500);
            } else {
                // إجابة خاطئة
                feedbackElement.innerHTML = `❌ خطأ. الإجابة الصحيحة هي: <strong>${product}</strong>`;
                feedbackElement.style.color = '#e74c3c';
                score = Math.max(0, score - 2);
                consecutiveCorrect = 0;

                setTimeout(() => {
                    document.getElementById('user-input').value = '';
                    document.getElementById('user-input').focus();
                    feedbackElement.textContent = '💪 حاول مرة أخرى!';
                    feedbackElement.style.color = '#e67e22';
                }, 2000);
            }

            // تحديث النتائج
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();
            updateStars();
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        function updateStars() {
            const stars = document.querySelectorAll('.star');
            const starsToFill = Math.min(5, Math.floor(consecutiveCorrect / 2));

            stars.forEach((star, index) => {
                if (index < starsToFill) {
                    star.classList.add('filled');
                } else {
                    star.classList.remove('filled');
                }
            });
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
            consecutiveCorrect = 0;
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();
            updateStars();
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

        // جعل الدوال متاحة globally للاستدعاء من الأزرار
        window.checkAnswer = checkAnswer;
        window.resetGame = resetGame;
        window.startGame = startGame;
    </script>
</body>
</html>
