<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 مقياس القيمة المنزلية - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #764ba2;
            --success: #00b894;
            --success-dark: #00a085;
            --error: #ff7675;
            --error-dark: #e84393;
            --warning: #fdcb6e;
            --warning-dark: #f39c12;
            --info: #74b9ff;
            --info-dark: #0984e3;
            --text: #2d3436;
            --light: #f8f9fa;
            --place-value-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: var(--place-value-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            color: white;
        }

        .header h1 {
            font-size: 2.4rem;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.9);
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-weight: bold;
            color: var(--primary-dark);
            backdrop-filter: blur(10px);
            border: 2px solid var(--primary);
        }

        .game-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 35px;
            width: 100%;
            transition: transform 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .game-card::before {
            content: "99999";
            position: absolute;
            top: -30px;
            right: -30px;
            font-size: 150px;
            color: rgba(102, 126, 234, 0.08);
            z-index: 0;
            font-weight: bold;
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .place-value-guide {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 6px 20px rgba(116, 185, 255, 0.3);
        }

        .place-value-guide h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        .place-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            margin-top: 15px;
        }

        .place-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .place-name {
            font-size: 0.9rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .place-value {
            font-size: 0.8rem;
            opacity: 0.9;
        }

        .instructions {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--text);
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(253, 203, 110, 0.3);
        }

        .number-display-container {
            position: relative;
            z-index: 1;
            margin: 30px 0;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--primary);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .number-display {
            font-size: 3.5rem;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            letter-spacing: 8px;
            color: var(--primary-dark);
            direction: ltr;
            text-align: center;
        }

        .digit {
            display: inline-block;
            min-width: 50px;
            text-align: center;
            padding: 10px;
            margin: 0 2px;
            transition: all 0.3s;
            border-radius: 8px;
        }

        .digit.highlighted {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            transform: scale(1.2);
            box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1.2); }
            50% { transform: scale(1.3); }
        }

        .place-labels {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .place-label {
            font-size: 0.9rem;
            color: var(--primary-dark);
            font-weight: bold;
            text-align: center;
            min-width: 50px;
        }

        .question-text {
            text-align: center;
            font-size: 1.6rem;
            margin: 25px 0;
            color: var(--text);
            font-weight: bold;
            position: relative;
            z-index: 1;
        }

        .options-container {
            position: relative;
            z-index: 1;
            margin: 30px 0;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 25px 0;
        }

        @media (max-width: 768px) {
            .options-grid {
                grid-template-columns: 1fr;
            }

            .place-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .option-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 15px;
            padding: 25px 20px;
            font-size: 1.4rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 15px rgba(102, 126, 234, 0.3);
            font-family: inherit;
            position: relative;
            overflow: hidden;
        }

        .option-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .option-btn:hover::before {
            left: 100%;
        }

        .option-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .option-btn:active {
            transform: translateY(2px);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            animation: celebrate 0.6s ease;
        }

        .option-btn.incorrect {
            background: linear-gradient(135deg, var(--error), var(--error-dark));
            animation: shake 0.5s ease;
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.5rem;
            min-height: 60px;
            text-align: center;
            padding: 18px;
            border-radius: 12px;
            transition: all 0.4s;
            position: relative;
            z-index: 1;
            font-weight: bold;
        }

        .feedback-correct {
            background: rgba(0, 184, 148, 0.15);
            color: var(--success-dark);
            border: 2px solid var(--success);
            animation: bounce 0.6s ease;
        }

        .feedback-wrong {
            background: rgba(255, 118, 117, 0.15);
            color: var(--error-dark);
            border: 2px solid var(--error);
            animation: shake 0.5s ease;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            position: relative;
            z-index: 1;
        }

        .btn {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
            border: none;
            border-radius: 15px;
            padding: 16px 32px;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            font-family: inherit;
        }

        .btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(2px);
        }

        .btn-reset {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--text);
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--light), #f0f4f8);
            padding: 18px;
            border-radius: 15px;
            margin-top: 25px;
            position: relative;
            z-index: 1;
            border: 2px solid var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .score-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .score-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-dark);
        }

        .score-label {
            font-size: 1rem;
            color: var(--text);
        }

        .progress {
            height: 14px;
            background: #e0e0e0;
            border-radius: 7px;
            margin-top: 15px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            width: 0%;
            transition: width 0.6s ease;
            border-radius: 7px;
        }

        .celebration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 100;
            display: none;
        }

        .confetti {
            position: absolute;
            width: 14px;
            height: 14px;
            background: var(--success);
            opacity: 0;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-12px); }
            80% { transform: translateY(-6px); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-12px); }
            75% { transform: translateX(12px); }
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .visual-explanation {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border: 2px solid var(--info);
            position: relative;
            z-index: 1;
        }

        .explanation-text {
            text-align: center;
            font-size: 1.2rem;
            color: var(--primary-dark);
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎯 مقياس القيمة المنزلية</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="place-value-guide">
                <h3>📊 دليل المنازل العددية</h3>
                <div class="place-grid">
                    <div class="place-item">
                        <div class="place-name">مئات الآلاف</div>
                        <div class="place-value">× 100,000</div>
                    </div>
                    <div class="place-item">
                        <div class="place-name">عشرات الآلاف</div>
                        <div class="place-value">× 10,000</div>
                    </div>
                    <div class="place-item">
                        <div class="place-name">آحاد الآلاف</div>
                        <div class="place-value">× 1,000</div>
                    </div>
                    <div class="place-item">
                        <div class="place-name">مئات</div>
                        <div class="place-value">× 100</div>
                    </div>
                    <div class="place-item">
                        <div class="place-name">عشرات</div>
                        <div class="place-value">× 10</div>
                    </div>
                    <div class="place-item">
                        <div class="place-name">آحاد</div>
                        <div class="place-value">× 1</div>
                    </div>
                </div>
            </div>

            <div class="instructions">
                <p>🎯 حدد القيمة المنزلية الصحيحة للرقم المظلل في العدد</p>
                <p>💡 تذكر: القيمة المنزلية = الرقم × قيمة المنزلة</p>
            </div>

            <div class="number-display-container">
                <div class="number-display" id="number-display">
                    <!-- سيتم تعبئة الأرقام بالجافاسكريبت -->
                </div>
                <div class="place-labels" id="place-labels">
                    <!-- سيتم تعبئة تسميات المنازل بالجافاسكريبت -->
                </div>
            </div>

            <div class="question-text" id="question-text">
                <!-- سيتم تعبئة السؤال بالجافاسكريبت -->
            </div>

            <div class="visual-explanation" id="visual-explanation">
                <div class="explanation-text" id="explanation-text">
                    <!-- سيتم تعبئة الشرح البصري بالجافاسكريبت -->
                </div>
            </div>

            <div class="options-container">
                <div class="options-grid" id="options-grid">
                    <!-- سيتم تعبئة خيارات الإجابة بالجافاسكريبت -->
                </div>
            </div>

            <div id="feedback" class="feedback"></div>

            <div class="controls">
                <button class="btn" id="check-btn" style="display: none;">✅ تحقق من الإجابة</button>
                <button class="btn btn-reset" id="reset-btn">🔄 سؤال جديد</button>
            </div>

            <div class="score-container">
                <div class="score-item">
                    <span class="score-label">النقاط</span>
                    <span class="score-value" id="score">0</span>
                </div>
                <div class="score-item">
                    <span class="score-label">السؤال</span>
                    <span class="score-value"><span id="current-question">0</span>/<span id="total-questions">10</span></span>
                </div>
                <div class="score-item">
                    <span class="score-label">المستوى</span>
                    <span class="score-value" id="level">1</span>
                </div>
            </div>

            <div class="progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range ?? 1000 }};
        const maxRange = {{ $max_range ?? 99999 }};
        const operationType = "{{ $operation_type ?? 'place_value' }}";

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let currentNumber = 0;
        let highlightedDigitIndex = 0;
        let correctPlaceValue = 0;
        let streak = 0;

        // أسماء المنازل
        const placeNames = ['آحاد', 'عشرات', 'مئات', 'آحاد الآلاف', 'عشرات الآلاف', 'مئات الآلاف'];
        const placeValues = [1, 10, 100, 1000, 10000, 100000];

        // عناصر DOM
        const numberDisplay = document.getElementById('number-display');
        const placeLabels = document.getElementById('place-labels');
        const questionText = document.getElementById('question-text');
        const explanationText = document.getElementById('explanation-text');
        const optionsGrid = document.getElementById('options-grid');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const feedbackElement = document.getElementById('feedback');
        const resetButton = document.getElementById('reset-btn');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const levelElement = document.getElementById('level');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            resetButton.addEventListener('click', generateQuestion);

            generateQuestion();
        });

        // توليد عدد عشوائي ضمن المدى
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();
            updateLevel();

            currentNumber = generateRandomNumber();
            const numberStr = currentNumber.toString();
            const digitCount = numberStr.length;

            // اختيار منزلة عشوائية
            highlightedDigitIndex = Math.floor(Math.random() * digitCount);
            const actualIndex = digitCount - 1 - highlightedDigitIndex;

            const highlightedDigit = parseInt(numberStr[highlightedDigitIndex]);
            const placeValueIndex = (digitCount - 1 - highlightedDigitIndex);
            correctPlaceValue = highlightedDigit * placeValues[placeValueIndex];

            // عرض العدد مع التظليل
            displayNumberWithHighlight();

            // تحديث نص السؤال
            questionText.textContent = `ما القيمة المنزلية للرقم ${highlightedDigit} في العدد ${currentNumber.toLocaleString('ar-EG')}؟`;

            // تحديث الشرح البصري
            explanationText.textContent = `الرقم ${highlightedDigit} في منزلة ${placeNames[placeValueIndex]} → ${highlightedDigit} × ${placeValues[placeValueIndex].toLocaleString('ar-EG')} = ${correctPlaceValue.toLocaleString('ar-EG')}`;

            // توليد خيارات الإجابة
            generateAnswerOptions();

            feedbackElement.textContent = 'اختر الإجابة الصحيحة من الخيارات أدناه';
            feedbackElement.className = 'feedback';
        }

        // عرض العدد مع التظليل
        function displayNumberWithHighlight() {
            const numberStr = currentNumber.toString();
            const digitCount = numberStr.length;

            numberDisplay.innerHTML = '';
            placeLabels.innerHTML = '';

            for (let i = 0; i < digitCount; i++) {
                const digitElement = document.createElement('span');
                digitElement.className = 'digit';
                digitElement.textContent = numberStr[i];

                if (i === highlightedDigitIndex) {
                    digitElement.classList.add('highlighted');
                }

                numberDisplay.appendChild(digitElement);

                // إضافة تسميات المنازل
                const labelElement = document.createElement('div');
                labelElement.className = 'place-label';
                labelElement.textContent = placeNames[digitCount - 1 - i];
                placeLabels.appendChild(labelElement);
            }
        }

        // توليد خيارات الإجابة
        function generateAnswerOptions() {
            optionsGrid.innerHTML = '';
            const options = new Set();
            options.add(correctPlaceValue);

            // توليد خيارات خاطئة
            while (options.size < 4) {
                let wrongValue;
                const errorType = Math.random();

                if (errorType < 0.4) {
                    // قيمة الرقم في منزلة أخرى
                    let wrongPosition;
                    do {
                        wrongPosition = Math.floor(Math.random() * 6);
                    } while (wrongPosition === Math.log10(correctPlaceValue / parseInt(currentNumber.toString()[highlightedDigitIndex])));

                    wrongValue = parseInt(currentNumber.toString()[highlightedDigitIndex]) * placeValues[wrongPosition];
                } else if (errorType < 0.7) {
                    // خطأ بأصفار أقل أو أكثر
                    const factor = Math.random() < 0.5 ? 0.1 : 10;
                    wrongValue = Math.round(correctPlaceValue * factor);
                } else {
                    // خطأ عشوائي
                    const randomDigit = Math.floor(Math.random() * 10);
                    const randomPlace = Math.floor(Math.random() * 6);
                    wrongValue = randomDigit * placeValues[randomPlace];
                }

                // التأكد من صحة القيمة وعدم تكرارها
                if (wrongValue > 0 && wrongValue !== correctPlaceValue) {
                    options.add(wrongValue);
                }
            }

            // تحويل وخلط الخيارات
            const optionsArray = Array.from(options);
            shuffleArray(optionsArray);

            // إنشاء أزرار الخيارات
            optionsArray.forEach(option => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.textContent = option.toLocaleString('ar-EG');
                button.addEventListener('click', () => checkAnswer(option, button));
                optionsGrid.appendChild(button);
            });
        }

        // خلط المصفوفة
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        // التحقق من الإجابة
        function checkAnswer(selectedValue, button) {
            const allButtons = document.querySelectorAll('.option-btn');

            // تعطيل جميع الأزرار
            allButtons.forEach(btn => {
                btn.disabled = true;
                if (parseInt(btn.textContent.replace(/,/g, '')) === correctPlaceValue) {
                    btn.classList.add('correct');
                }
            });

            if (selectedValue === correctPlaceValue) {
                // إجابة صحيحة
                button.classList.add('correct');
                score += 10;
                streak++;
                scoreElement.textContent = score;
                feedbackElement.textContent = getSuccessMessage();
                feedbackElement.className = 'feedback-correct';

                // تأثير الاحتفال عند الإجابات الصحيحة المتتالية
                if (streak >= 3) {
                    createCelebration();
                }

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 1500);
            } else {
                // إجابة خاطئة
                button.classList.add('incorrect');
                streak = 0;
                feedbackElement.textContent = `❌ إجابة خاطئة. القيمة الصحيحة هي ${correctPlaceValue.toLocaleString('ar-EG')}`;
                feedbackElement.className = 'feedback-wrong';

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 2000);
            }
        }

        // الحصول على رسالة نجاح عشوائية
        function getSuccessMessage() {
            const messages = [
                "أحسنت! 🌟 فهمت القيمة المنزلية",
                "رائع! 🎯 إجابة صحيحة",
                "إبداع! 💫 أنت تتقن المنازل العددية",
                "ممتاز! ⚡ استمر في التميز",
                "برافو! 👏 فهم ممتاز للمنازل"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // تحديث المستوى
        function updateLevel() {
            const level = Math.floor(score / 30) + 1;
            levelElement.textContent = level;
        }

        // إنهاء اللعبة
        function endGame() {
            questionText.textContent = "🎉 انتهت اللعبة!";
            numberDisplay.style.display = 'none';
            placeLabels.style.display = 'none';
            optionsGrid.style.display = 'none';
            explanationText.style.display = 'none';

            let message = "";
            let emoji = "";
            if (score >= 90) {
                message = "مذهل! 🏆 أنت خبير في القيم المنزلية";
                emoji = "🎊";
            } else if (score >= 70) {
                message = "رائع! ⭐ فهم ممتاز للمنازل";
                emoji = "✨";
            } else if (score >= 50) {
                message = "جيد جداً! 👍 واصل التعلم";
                emoji = "📚";
            } else {
                message = "حاول مرة أخرى! 💪 ستتحسن مع الممارسة";
                emoji = "🎯";
            }

            feedbackElement.innerHTML = `${message} ${emoji}<br><br>مجموع نقاطك: <strong>${score}</strong> من ${totalQuestions * 10}`;
            feedbackElement.className = 'feedback-correct';

            createCelebration();
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (questionCount / totalQuestions) * 100;
            progressBar.style.width = `${progress}%`;
        }

        // تأثير الاحتفال
        function createCelebration() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            const colors = ['#667eea', '#764ba2', '#00b894', '#ff7675', '#fdcb6e', '#74b9ff'];

            for (let i = 0; i < 120; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = `${Math.random() * 100}%`;
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.animationDelay = `${Math.random() * 0.5}s`;

                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 3500);
        }
    </script>
</body>
</html>
