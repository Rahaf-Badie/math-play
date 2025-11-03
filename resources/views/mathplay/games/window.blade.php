<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نافذة المحايد - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 600px;
            border: 3px solid #008080;
        }

        .lesson-info {
            background: linear-gradient(135deg, #008080 0%, #006666 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #008080;
            margin-bottom: 15px;
            border-bottom: 3px solid #008080;
            padding-bottom: 10px;
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #e0ffff 0%, #b0e0e6 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #008080;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #e0ffff 0%, #afeeee 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #008080;
            position: relative;
        }

        .game-area::before {
            content: "🎯";
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 1.8em;
            opacity: 0.3;
        }

        .equation-display {
            font-size: 2.5em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .input-box {
            width: 120px;
            padding: 15px;
            font-size: 1em;
            border: 3px solid #ffcc00;
            border-radius: 10px;
            text-align: center;
            background-color: #fffdf6;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .input-box:focus {
            border-color: #008080;
            box-shadow: 0 0 15px rgba(0, 128, 128, 0.5);
            outline: none;
            transform: scale(1.05);
        }

        .controls {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 25px;
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
            min-width: 140px;
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
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.2em;
            color: #008080;
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
            background: linear-gradient(135deg, #008080 0%, #00a085 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .property-rule {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border: 2px dashed #008080;
            font-weight: bold;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .equation-display {
                font-size: 2em;
                gap: 10px;
            }

            .input-box {
                width: 90px;
                padding: 12px;
            }

            button {
                padding: 12px 25px;
                min-width: 120px;
                font-size: 1.1em;
            }

            h1 {
                font-size: 1.6em;
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

        <h1>🪟 نافذة المحايد</h1>

        <!-- التعليمات -->
        <div class="instructions">
            <p>🔢 المدى: من {{ $min_range ?? 100 }} إلى {{ $max_range ?? 10000 }}</p>
            <p>🎯 اكتشف خاصية الضرب في 1 - أي عدد × 1 = العدد نفسه!</p>
        </div>

        <!-- قاعدة الخاصية -->
        <div class="property-rule">
            📚 القاعدة: <strong>أي عدد × 1 = العدد نفسه</strong> ⚡
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <div id="equation-display" class="equation-display">
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
                ابدأ باكتشاف الخاصية!
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
        const minRange = {{ $min_range ?? 100 }};
        const maxRange = {{ $max_range ?? 10000 }};

        let factor = 0;
        let missingType = 0; // 1: الناتج, 2: العامل المفقود (يجب أن يكون 1)
        let missingValue = 0;
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;

        function generateProblem() {
            // توليد عدد عشوائي ضمن المدى المحدد
            factor = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            // 70% لإيجاد الناتج، 30% لإيجاد العامل المفقود (1)
            missingType = Math.random() < 0.7 ? 1 : 2;

            let displayHTML = '';

            if (missingType === 1) {
                // الناتج مفقود (ضرب عادي في 1)
                missingValue = factor;
                displayHTML = `${factor.toLocaleString('en')} × 1 = <input type="number" id="user-input" class="input-box" placeholder="؟">`;
            } else {
                // العامل المفقود هو 1
                missingValue = 1;
                // تحديد مكان الـ 1 عشوائياً
                if (Math.random() < 0.5) {
                    displayHTML = `<input type="number" id="user-input" class="input-box" placeholder="؟"> × ${factor.toLocaleString('en')} = ${factor.toLocaleString('en')}`;
                } else {
                    displayHTML = `${factor.toLocaleString('en')} × <input type="number" id="user-input" class="input-box" placeholder="؟"> = ${factor.toLocaleString('en')}`;
                }
            }

            document.getElementById('equation-display').innerHTML = displayHTML;
            document.getElementById('feedback').innerHTML = '🧠 أدخل العدد المفقود...';
            document.getElementById('feedback').style.color = '#2c3e50';
            document.getElementById('user-input').focus();

            // تحديث شريط التقدم
            updateProgress();
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

            if (userInput === missingValue) {
                // إجابة صحيحة
                feedbackElement.innerHTML = '🎉 ممتاز! الإجابة صحيحة 🎉<br><small>تذكر: أي عدد × 1 = العدد نفسه</small>';
                feedbackElement.style.color = '#2ecc71';
                feedbackElement.classList.add('celebration');

                score += 10;
                correctAnswers++;

                // إظهار الإجابة الصحيحة
                document.getElementById('user-input').value = missingValue.toLocaleString('en');
                document.getElementById('user-input').disabled = true;
                document.getElementById('user-input').style.background = '#d4edda';

                setTimeout(() => {
                    feedbackElement.classList.remove('celebration');
                    generateProblem();
                }, 2000);
            } else {
                // إجابة خاطئة
                let hint = '';
                if (missingType === 1) {
                    hint = `تذكر: ${factor.toLocaleString('en')} × 1 = ${factor.toLocaleString('en')}`;
                } else {
                    hint = `العامل المفقود يجب أن يكون 1 للحفاظ على الناتج`;
                }

                feedbackElement.innerHTML = `❌ خطأ! الإجابة الصحيحة هي: <strong>${missingValue}</strong><br><small>${hint}</small>`;
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

        // جعل الدوال متاحة globally للاستدعاء من الأزرار
        window.checkAnswer = checkAnswer;
        window.resetGame = resetGame;
        window.startGame = startGame;
    </script>
</body>
</html>
