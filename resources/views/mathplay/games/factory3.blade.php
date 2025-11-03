<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصنع القسمة الذكي - {{ $lesson_game->lesson->name }}</title>
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
            border: 3px solid #e67e22;
        }

        /* شريط التنقل العلوي */
        .navigation-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
        }

        .back-button {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
            text-decoration: none;
            color: white;
        }

        .lesson-title h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.5rem;
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
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #fef5e7 0%, #fcebcf 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #e67e22;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #fffaf0 0%, #fff5e6 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #e67e22;
        }

        .factory-display {
            font-size: 4em;
            margin: 20px 0;
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .problem-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            border: 3px solid #3498db;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .division-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .number-box {
            padding: 20px 30px;
            background: #3498db;
            color: white;
            border-radius: 10px;
            font-size: 2em;
            font-weight: bold;
            min-width: 80px;
        }

        .division-symbol {
            font-size: 2.5em;
            color: #e74c3c;
            font-weight: bold;
        }

        .equals-symbol {
            font-size: 2.5em;
            color: #27ae60;
            font-weight: bold;
        }

        .answer-box {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 20px 0;
        }

        .answer-part {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .answer-label {
            font-size: 1.1em;
            color: #7f8c8d;
            font-weight: bold;
        }

        .answer-input {
            width: 100px;
            height: 60px;
            border: 3px solid #9b59b6;
            border-radius: 10px;
            font-size: 1.8em;
            font-weight: bold;
            text-align: center;
            background: #fffdf6;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .option-btn {
            padding: 20px;
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.3em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
        }

        .option-btn.incorrect {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
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
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.5em;
            color: #e67e22;
            font-weight: bold;
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
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
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

        @media (max-width: 768px) {
            .division-visual {
                flex-direction: column;
            }

            .options-grid {
                grid-template-columns: 1fr;
            }

            .number-box {
                font-size: 1.6em;
                padding: 15px 25px;
            }

            .factory-display {
                font-size: 3em;
            }

            .navigation-bar {
                flex-direction: column;
                gap: 15px;
            }

            .back-button {
                order: 2;
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    <!-- رابط أيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- شريط التنقل العلوي -->
        <div class="navigation-bar">
            <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-button">
                <i class="fas fa-arrow-right"></i>
                العودة إلى الدرس
            </a>
            <div class="lesson-title">
                <h2>مصنع القسمة الذكي</h2>
            </div>
        </div>

        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>🏭 مصنع القسمة الذكي</h1>

        <div class="instructions">
            <p>🔢 قسمة أعداد من منزلتين على أعداد من منزلة واحدة - قسمة بدون باقي</p>
            <p>🎯 اختر الإجابة الصحيحة من بين الخيارات</p>
        </div>

        <div class="game-area">
            <div class="factory-display">🏭</div>

            <div class="problem-container">
                <div class="division-visual">
                    <div class="number-box" id="dividend">0</div>
                    <div class="division-symbol">÷</div>
                    <div class="number-box" id="divisor">0</div>
                    <div class="equals-symbol">=</div>
                    <div class="answer-box">
                        <div class="answer-part">
                            <div class="answer-label">الناتج</div>
                            <input type="number" id="factory-quotient" class="answer-input" placeholder="?" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <div class="options-grid" id="options-grid">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="feedback" id="feedback">
                <i class="fas fa-mouse-pointer"></i>
                اختر الإجابة الصحيحة من الخيارات!
            </div>

            <div class="controls">
                <button id="next-btn">
                    <i class="fas fa-sync-alt"></i>
                    مسألة جديدة
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
        // === JavaScript لمصنع القسمة الذكي ===
        const minRange = {{ $min_range ?? 10 }};
        const maxRange = {{ $max_range ?? 99 }};
        const divisorRange = { min: 2, max: 9 };

        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let factoryDividend = 0;
        let factoryDivisor = 0;
        let factoryQuotient = 0;
        let correctOptionIndex = 0;

        function generateFactoryProblem() {
            // توليد مسألة قسمة بدون باقي
            do {
                factoryDivisor = Math.floor(Math.random() * (divisorRange.max - divisorRange.min + 1)) + divisorRange.min;
                factoryQuotient = Math.floor(Math.random() * (Math.floor(maxRange/factoryDivisor) - Math.ceil(minRange/factoryDivisor) + 1)) + Math.ceil(minRange/factoryDivisor);
                factoryDividend = factoryDivisor * factoryQuotient;
            } while (factoryDividend < minRange || factoryDividend > maxRange);

            // تحديث العرض
            document.getElementById('dividend').textContent = factoryDividend;
            document.getElementById('divisor').textContent = factoryDivisor;
            document.getElementById('factory-quotient').value = '';

            // توليد خيارات متعددة
            generateOptions();

            document.getElementById('feedback').innerHTML = '<i class="fas fa-play-circle"></i> اختر الإجابة الصحيحة!';
            document.getElementById('feedback').style.background = '#f8f9fa';

            totalQuestions++;
            document.getElementById('total-count').textContent = totalQuestions;
        }

        function generateOptions() {
            const options = [];
            const optionsGrid = document.getElementById('options-grid');
            optionsGrid.innerHTML = '';

            // الإجابة الصحيحة
            options.push(factoryQuotient);

            // إجابات خاطئة
            while (options.length < 4) {
                let wrongAnswer;
                do {
                    const variation = Math.floor(Math.random() * 3) + 1; // 1, 2, أو 3
                    const direction = Math.random() < 0.5 ? -1 : 1;
                    wrongAnswer = factoryQuotient + (variation * direction);
                } while (wrongAnswer < 1 || options.includes(wrongAnswer));

                options.push(wrongAnswer);
            }

            // خلط الخيارات
            options.sort(() => Math.random() - 0.5);

            // تحديث correctOptionIndex
            correctOptionIndex = options.indexOf(factoryQuotient);

            // إنشاء الأزرار
            options.forEach((option, index) => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.textContent = option;
                button.onclick = () => checkFactoryAnswer(index, button);
                optionsGrid.appendChild(button);
            });
        }

        function checkFactoryAnswer(selectedIndex, button) {
            const isCorrect = selectedIndex === correctOptionIndex;
            const feedbackElement = document.getElementById('feedback');

            // تعطيل جميع الأزرار
            document.querySelectorAll('.option-btn').forEach(btn => {
                btn.disabled = true;
                if (btn === document.querySelectorAll('.option-btn')[correctOptionIndex]) {
                    btn.classList.add('correct');
                }
            });

            if (isCorrect) {
                button.classList.add('correct');
                feedbackElement.innerHTML =
                    `<i class="fas fa-trophy"></i> صحيح! ${factoryDividend} ÷ ${factoryDivisor} = ${factoryQuotient}`;
                feedbackElement.style.background = '#d4edda';
                score += 12;
                correctAnswers++;

                // تعبئة الإجابة في الحقول
                document.getElementById('factory-quotient').value = factoryQuotient;
            } else {
                button.classList.add('incorrect');
                feedbackElement.innerHTML =
                    `<i class="fas fa-times-circle"></i> خطأ! الإجابة الصحيحة: ${factoryQuotient}`;
                feedbackElement.style.background = '#f8d7da';
                score = Math.max(0, score - 3);
            }

            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            updateProgress();
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        // إعداد event listener لزر المسألة الجديدة
        document.getElementById('next-btn').addEventListener('click', generateFactoryProblem);

        // بدء اللعبة
        generateFactoryProblem();
    </script>
</body>
</html>
