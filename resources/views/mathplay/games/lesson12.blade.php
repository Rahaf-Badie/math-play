<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة جدول الضرب للعدد 4 - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #546de5;
            --primary-dark: #3867d6;
            --success: #00b894;
            --success-dark: #00a085;
            --error: #ff7675;
            --error-dark: #e84393;
            --warning: #fdcb6e;
            --warning-dark: #fdcb6e;
            --info: #74b9ff;
            --info-dark: #0984e3;
            --text: #2d3436;
            --light: #f8f9fa;
            --multiply-bg: linear-gradient(135deg, #81ecec, #74b9ff);
            --card-bg: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: var(--multiply-bg);
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
            max-width: 550px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            color: var(--text);
        }

        .header h1 {
            font-size: 2.3rem;
            margin-bottom: 8px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-weight: bold;
            color: var(--primary-dark);
            backdrop-filter: blur(10px);
            border: 2px solid var(--primary);
        }

        .game-card {
            background: var(--card-bg);
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            padding: 35px;
            width: 100%;
            transition: transform 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .game-card::before {
            content: "4×";
            position: absolute;
            top: -40px;
            right: -40px;
            font-size: 180px;
            color: rgba(84, 109, 229, 0.08);
            z-index: 0;
            font-weight: bold;
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .visual-representation {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin: 25px 0;
            position: relative;
            z-index: 1;
        }

        .visual-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .dots-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 6px;
            padding: 12px;
            background: rgba(116, 185, 255, 0.1);
            border-radius: 12px;
            border: 2px dashed var(--info);
        }

        .dot {
            width: 20px;
            height: 20px;
            background: var(--primary);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .group-label {
            font-size: 0.9rem;
            color: var(--primary-dark);
            font-weight: bold;
        }

        .instructions {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: white;
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(253, 203, 110, 0.3);
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.15rem;
        }

        .math-tip {
            background: rgba(116, 185, 255, 0.15);
            padding: 12px;
            border-radius: 10px;
            margin: 15px 0;
            border-right: 4px solid var(--info);
            position: relative;
            z-index: 1;
        }

        .math-tip p {
            margin: 5px 0;
            font-size: 1.1rem;
            color: var(--primary-dark);
        }

        .question-container {
            position: relative;
            z-index: 1;
            margin: 30px 0;
            background: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 15px;
            border: 2px solid var(--primary);
        }

        #question {
            font-size: 2.8rem;
            color: var(--primary-dark);
            text-align: center;
            margin: 15px 0;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .input-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 30px 0;
            position: relative;
            z-index: 1;
        }

        input[type="number"] {
            font-size: 2rem;
            padding: 18px;
            width: 140px;
            text-align: center;
            border: 3px solid var(--primary);
            border-radius: 15px;
            transition: all 0.3s;
            font-family: inherit;
            font-weight: bold;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            background: var(--light);
        }

        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 4px rgba(84, 109, 229, 0.3);
            transform: scale(1.05);
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
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s;
        }

        .btn:hover::after {
            width: 120px;
            height: 120px;
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

        #feedback {
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

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--light), #e8f4ff);
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

        .multiplication-table {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin: 25px 0;
            position: relative;
            z-index: 1;
        }

        .table-item {
            padding: 12px 8px;
            background: var(--light);
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid transparent;
            font-size: 0.95rem;
        }

        .table-item:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.08);
            box-shadow: 0 4px 12px rgba(84, 109, 229, 0.3);
        }

        .table-item.active {
            background: var(--success);
            color: white;
            border-color: var(--success-dark);
            transform: scale(1.05);
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

        .number-bubble {
            position: absolute;
            font-size: 1.6rem;
            color: var(--primary);
            animation: float 4s ease-in-out infinite;
            z-index: 0;
            font-weight: bold;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-25px) rotate(120deg); }
            66% { transform: translateY(-15px) rotate(240deg); }
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

        /* تصميم متجاوب */
        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }

            .game-card {
                padding: 25px 20px;
            }

            #question {
                font-size: 2.2rem;
            }

            input[type="number"] {
                width: 120px;
                font-size: 1.8rem;
                padding: 15px;
            }

            .controls {
                flex-direction: column;
                gap: 12px;
            }

            .btn {
                width: 100%;
            }

            .multiplication-table {
                grid-template-columns: repeat(3, 1fr);
            }

            .visual-group {
                transform: scale(0.9);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎮 لعبة جدول الضرب للعدد 4</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="instructions">
                <p>🎯 أكمل عملية الضرب بإدخال الإجابة الصحيحة</p>
                <p>💡 تذكر: الضرب في 4 يعني ضرب العدد في 2 ثم في 2 مرة أخرى!</p>
            </div>

            <div class="math-tip">
                <p>✨ خدعة سريعة: الضرب في 4 = الضرب في 2 ثم الضرب في 2</p>
                <p>📊 مثال: 4 × 3 = (2 × 3) × 2 = 6 × 2 = 12</p>
            </div>

            <div class="visual-representation" id="visual-representation">
                <!-- سيتم تعبئة التمثيل البصري بالجافاسكريبت -->
            </div>

            <div class="multiplication-table" id="multiplication-table">
                <!-- سيتم تعبئة جدول الضرب بالجافاسكريبت -->
            </div>

            <div class="question-container">
                <div id="question">جاري تحميل السؤال...</div>
            </div>

            <div class="input-container">
                <input type="number" id="answer" placeholder="الإجابة" min="0" max="100">
            </div>

            <div class="controls">
                <button class="btn" id="check-btn">✅ تحقق من الإجابة</button>
                <button class="btn btn-reset" id="reset-btn">🔄 سؤال جديد</button>
            </div>

            <div id="feedback"></div>

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
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 10 }};
        const operationType = "{{ $operation_type ?? 'multiplication' }}";
        const multiplier = 4; // الضرب في العدد 4

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let correctAnswer = 0;
        let currentMultiplicand = 0;
        let streak = 0;

        // عناصر DOM
        const questionElement = document.getElementById('question');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const feedbackElement = document.getElementById('feedback');
        const answerInput = document.getElementById('answer');
        const checkButton = document.getElementById('check-btn');
        const resetButton = document.getElementById('reset-btn');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const multiplicationTable = document.getElementById('multiplication-table');
        const visualRepresentation = document.getElementById('visual-representation');
        const levelElement = document.getElementById('level');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            checkButton.addEventListener('click', submitAnswer);
            resetButton.addEventListener('click', generateQuestion);
            answerInput.addEventListener('keydown', handleKeyPress);

            // إنشاء جدول الضرب والتمثيل البصري
            createMultiplicationTable();
            createNumberBubbles();

            generateQuestion();
        });

        // توليد رقم عشوائي ضمن المدى
        function randomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // إنشاء جدول الضرب
        function createMultiplicationTable() {
            multiplicationTable.innerHTML = '';
            for (let i = minRange; i <= maxRange; i++) {
                const tableItem = document.createElement('div');
                tableItem.className = 'table-item';
                tableItem.textContent = `4 × ${i} = ${4 * i}`;
                tableItem.addEventListener('click', () => {
                    document.querySelectorAll('.table-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    tableItem.classList.add('active');
                });
                multiplicationTable.appendChild(tableItem);
            }
        }

        // إنشاء فقاعات الأرقام
        function createNumberBubbles() {
            const container = document.querySelector('.game-card');
            for (let i = 0; i < 6; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'number-bubble';
                bubble.textContent = i * 4;
                bubble.style.left = `${Math.random() * 80 + 10}%`;
                bubble.style.top = `${Math.random() * 80 + 10}%`;
                bubble.style.animationDelay = `${Math.random() * 3}s`;
                container.appendChild(bubble);
            }
        }

        // إنشاء التمثيل البصري للنقاط
        function createVisualRepresentation(multiplicand) {
            visualRepresentation.innerHTML = '';

            for (let group = 0; group < multiplicand; group++) {
                const visualGroup = document.createElement('div');
                visualGroup.className = 'visual-group';

                const dotsContainer = document.createElement('div');
                dotsContainer.className = 'dots-container';

                // إنشاء 4 نقاط لكل مجموعة (لتمثيل الضرب في 4)
                for (let i = 0; i < 4; i++) {
                    const dot = document.createElement('div');
                    dot.className = 'dot';
                    dot.style.animationDelay = `${i * 0.2}s`;
                    dotsContainer.appendChild(dot);
                }

                const groupLabel = document.createElement('div');
                groupLabel.className = 'group-label';
                groupLabel.textContent = `مجموعة ${group + 1}`;

                visualGroup.appendChild(dotsContainer);
                visualGroup.appendChild(groupLabel);
                visualRepresentation.appendChild(visualGroup);
            }
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();
            updateLevel();

            currentMultiplicand = randomInt(minRange, maxRange);
            correctAnswer = multiplier * currentMultiplicand;

            questionElement.innerHTML = `
                <div style="display: flex; align-items: center; justify-content: center; gap: 20px; flex-wrap: wrap;">
                    <span style="font-size: 3.5rem; color: var(--primary);">4</span>
                    <span style="font-size: 2.5rem;">×</span>
                    <span style="font-size: 3.5rem; color: var(--primary);">${currentMultiplicand}</span>
                    <span style="font-size: 2.5rem;">=</span>
                    <span style="font-size: 3.5rem; color: var(--success);">?</span>
                </div>
            `;

            // إنشاء التمثيل البصري
            createVisualRepresentation(currentMultiplicand);

            answerInput.value = '';
            answerInput.focus();
            feedbackElement.textContent = '';
            feedbackElement.className = '';

            // تحديث جدول الضرب
            document.querySelectorAll('.table-item').forEach(item => {
                item.classList.remove('active');
            });
        }

        // التعامل مع الضغط على الأزرار
        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                submitAnswer();
            }
        }

        // التحقق من الإجابة
        function submitAnswer() {
            const userAnswer = parseInt(answerInput.value);

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = "⚠️ يرجى إدخال إجابة رقمية";
                feedbackElement.className = "feedback-wrong";
                answerInput.focus();
                return;
            }

            if (userAnswer === correctAnswer) {
                score += 10;
                streak++;
                scoreElement.textContent = score;
                feedbackElement.textContent = getSuccessMessage();
                feedbackElement.className = "feedback-correct";

                // تأثير الاحتفال عند الإجابات الصحيحة المتتالية
                if (streak >= 3) {
                    createCelebration();
                }

                // تسليط الضوء على الإجابة في الجدول
                highlightTableItem(currentMultiplicand);

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 1800);
            } else {
                streak = 0;
                feedbackElement.textContent = `❌ إجابة خاطئة. الإجابة الصحيحة: ${correctAnswer}`;
                feedbackElement.className = "feedback-wrong";

                // تسليط الضوء على الإجابة الصحيحة في الجدول
                highlightTableItem(currentMultiplicand);

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
                "أحسنت! 🌟 إجابة صحيحة",
                "رائع! 🎯 ضرب ممتاز",
                "إبداع! 💫 أنت تتقن الضرب",
                "مذهل! ⚡ استمر في التميز",
                "برافو! 👏 ضرب صحيح"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // تسليط الضوء على العنصر في الجدول
        function highlightTableItem(multiplicand) {
            document.querySelectorAll('.table-item').forEach(item => {
                item.classList.remove('active');
                if (item.textContent.includes(`4 × ${multiplicand} =`)) {
                    item.classList.add('active');
                }
            });
        }

        // تحديث المستوى
        function updateLevel() {
            const level = Math.floor(score / 30) + 1;
            levelElement.textContent = level;
        }

        // إنهاء اللعبة
        function endGame() {
            questionElement.innerHTML = "🎉 <strong>انتهت اللعبة!</strong>";
            answerInput.style.display = 'none';
            checkButton.style.display = 'none';
            multiplicationTable.style.display = 'none';
            visualRepresentation.style.display = 'none';

            let message = "";
            let emoji = "";
            if (score >= 90) {
                message = "مذهل! 🏆 أنت خبير في جدول الضرب";
                emoji = "🎊";
            } else if (score >= 70) {
                message = "رائع! ⭐ أداء ممتاز";
                emoji = "✨";
            } else if (score >= 50) {
                message = "جيد جداً! 👍 واصل التعلم";
                emoji = "📚";
            } else {
                message = "حاول مرة أخرى! 💪 الممارسة تصنع الفرق";
                emoji = "🎯";
            }

            feedbackElement.innerHTML = `${message} ${emoji}<br><br>مجموع نقاطك: <strong>${score}</strong> من ${totalQuestions * 10}`;
            feedbackElement.className = "feedback-correct";

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

            const colors = ['#546de5', '#3867d6', '#00b894', '#ff7675', '#fdcb6e', '#74b9ff'];

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
