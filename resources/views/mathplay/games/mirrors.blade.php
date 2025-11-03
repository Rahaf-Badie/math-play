<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مطابقة المرايا - {{ $lesson_game->lesson->name }}</title>
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
            border: 3px solid #d35400;
        }

        .lesson-info {
            background: linear-gradient(135deg, #d35400 0%, #e67e22 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #d35400;
            margin-bottom: 20px;
            border-bottom: 3px solid #d35400;
            padding-bottom: 10px;
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #fbeedc 0%, #f8e3c9 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #d35400;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #fdf2e9 0%, #fae5d3 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #d35400;
            position: relative;
        }

        .game-area::before {
            content: "🪞";
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 2em;
            opacity: 0.3;
        }

        .main-equation {
            font-size: 2.8em;
            font-weight: bold;
            color: #c0392b;
            margin: 25px 0;
            padding: 20px;
            border: 4px dashed #d35400;
            display: inline-block;
            background: linear-gradient(135deg, #fff 0%, #fdf2e9 100%);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(211, 84, 0, 0.2);
        }

        .mirror-icon {
            font-size: 2em;
            margin: 20px 0;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .option-btn {
            padding: 20px 15px;
            font-size: 1.6em;
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(211, 84, 0, 0.3);
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            animation: pulse 0.5s;
        }

        .option-btn.incorrect {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.3em;
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
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.2em;
            color: #d35400;
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
            background: linear-gradient(135deg, #d35400 0%, #e67e22 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .property-rule {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border: 2px dashed #d35400;
            font-weight: bold;
            font-size: 1.1em;
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        button {
            padding: 12px 25px;
            font-size: 1.1em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        #reset-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #reset-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(116, 185, 255, 0.4);
        }

        @media (max-width: 768px) {
            .options-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .main-equation {
                font-size: 2.2em;
                padding: 15px;
            }

            .option-btn {
                font-size: 1.4em;
                padding: 15px 10px;
                min-height: 70px;
            }

            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.6em;
            }
        }

        @media (max-width: 480px) {
            .main-equation {
                font-size: 1.8em;
            }

            .option-btn {
                font-size: 1.2em;
                min-height: 60px;
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

        <h1>🪞 مطابقة المرايا</h1>

        <!-- التعليمات -->
        <div class="instructions">
            <p>🔢 المدى: من {{ $min_range ?? 2 }} إلى {{ $max_range ?? 12 }}</p>
            <p>🎯 اختر المعادلة التي تعكس الخاصية التبادلية للضرب</p>
        </div>

        <!-- قاعدة الخاصية -->
        <div class="property-rule">
            📚 القاعدة: <strong>أ × ب = ب × أ</strong> - تغيير ترتيب العوامل لا يغير الناتج! 🔄
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <p style="font-size: 1.2em; font-weight: bold; margin-bottom: 10px;">المعادلة الأصلية:</p>
            <div id="main-equation" class="main-equation">---</div>

            <div class="mirror-icon">🔍 ابحث عن المرآة</div>

            <p style="font-size: 1.2em; font-weight: bold; margin: 20px 0;">أين مرآتها؟</p>

            <div id="options-grid" class="options-grid">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">
                اختر المعادلة المماثلة باستخدام الخاصية التبادلية
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="reset-btn">🔄 سؤال جديد</button>
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
        const minRange = {{ $min_range ?? 2 }};
        const maxRange = {{ $max_range ?? 12 }};

        let factorA = 0;
        let factorB = 0;
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let correctAnswerIndex = 0;

        function generateProblem() {
            // توليد عاملين عشوائيين ضمن المدى المحدد
            factorA = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            factorB = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            // التأكد من أن العاملين مختلفين ليكون هناك تبديل واضح
            while (factorA === factorB) {
                factorB = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            }

            // المعادلة الأصلية
            const mainEq = `${factorA} × ${factorB}`;
            document.getElementById('main-equation').textContent = mainEq;
            document.getElementById('feedback').innerHTML = '🔍 اختر المعادلة المماثلة...';
            document.getElementById('feedback').style.color = '#2c3e50';

            generateOptions();
        }

        function generateOptions() {
            const correctEq = `${factorB} × ${factorA}`;
            const options = new Set();
            options.add(correctEq);

            // توليد خيارات خاطئة
            while (options.size < 4) {
                let wrongA = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                let wrongB = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

                // التأكد من أن الخيار الخاطئ ليس متطابقاً مع الأصلي أو التبادلي
                if ((wrongA !== factorA || wrongB !== factorB) && (wrongA !== factorB || wrongB !== factorA)) {
                    // أنواع مختلفة من الخيارات الخاطئة
                    const wrongType = Math.random();
                    if (wrongType < 0.3) {
                        // استخدام عملية جمع
                        options.add(`${factorA} + ${factorB}`);
                    } else if (wrongType < 0.6) {
                        // تغيير أحد العوامل بشكل طفيف
                        options.add(`${wrongA} × ${factorB}`);
                    } else {
                        // تغيير كلا العاملين
                        options.add(`${wrongA} × ${wrongB}`);
                    }
                }
            }

            // تحويل المجموعة إلى مصفوفة وخلطها
            let finalOptions = Array.from(options);
            finalOptions.sort(() => Math.random() - 0.5);

            // تحديد فهرس الإجابة الصحيحة بعد الخلط
            correctAnswerIndex = finalOptions.indexOf(correctEq);

            const optionsGrid = document.getElementById('options-grid');
            optionsGrid.innerHTML = '';

            finalOptions.forEach((option, index) => {
                const btn = document.createElement('button');
                btn.classList.add('option-btn');
                btn.textContent = option;
                btn.onclick = () => checkAnswer(index, btn);
                optionsGrid.appendChild(btn);
            });
        }

        function checkAnswer(userChoiceIndex, clickedBtn) {
            const feedbackElement = document.getElementById('feedback');
            totalQuestions++;

            // تعطيل جميع الأزرار لمنع النقر المزدوج
            document.querySelectorAll('.option-btn').forEach(btn => {
                btn.disabled = true;
                btn.style.cursor = 'not-allowed';
            });

            if (userChoiceIndex === correctAnswerIndex) {
                // إجابة صحيحة
                clickedBtn.classList.add('correct');
                feedbackElement.innerHTML = `🎉 أحسنت! الإجابة صحيحة<br><small>${factorA} × ${factorB} = ${factorB} × ${factorA} = ${factorA * factorB}</small>`;
                feedbackElement.style.color = '#2ecc71';
                feedbackElement.classList.add('celebration');

                score += 10;
                correctAnswers++;
            } else {
                // إجابة خاطئة
                clickedBtn.classList.add('incorrect');
                // إظهار الإجابة الصحيحة
                document.querySelectorAll('.option-btn')[correctAnswerIndex].classList.add('correct');

                feedbackElement.innerHTML = `❌ المعادلة الصحيحة هي <strong>${factorB} × ${factorA}</strong><br><small>تذكر: تغيير الترتيب لا يغير الناتج!</small>`;
                feedbackElement.style.color = '#e74c3c';
                score = Math.max(0, score - 2);
            }

            // تحديث النتائج
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();

            // الانتقال للجولة التالية
            setTimeout(() => {
                feedbackElement.classList.remove('celebration');
                generateProblem();
            }, 2500);
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
            document.getElementById('reset-btn').addEventListener('click', resetGame);
            resetGame();
        });

        // جعل الدوال متاحة globally للاستدعاء من الأزرار
        window.resetGame = resetGame;
    </script>
</body>
</html>
