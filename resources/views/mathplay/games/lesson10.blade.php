<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة جدول الضرب للعدد 2 - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #764ba2;
            --success: #00b894;
            --success-dark: #00a085;
            --error: #ff7675;
            --error-dark: #e84393;
            --warning: #ffb300;
            --warning-dark: #ff8f00;
            --info: #74b9ff;
            --info-dark: #0984e3;
            --text: #2d3436;
            --light: #f8f9fa;
            --multiply-bg: linear-gradient(135deg, #ffeaa7, #fab1a0);
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
            max-width: 500px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            color: var(--text);
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 2.2rem;
            margin-bottom: 5px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.7);
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            color: var(--primary-dark);
            backdrop-filter: blur(10px);
        }

        .game-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 100%;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .game-card::before {
            content: "×";
            position: absolute;
            top: -30px;
            right: -30px;
            font-size: 150px;
            color: rgba(102, 126, 234, 0.1);
            z-index: 0;
        }

        .game-card:hover {
            transform: translateY(-5px);
        }

        .instructions {
            background: var(--light);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            border-left: 4px solid var(--warning);
            position: relative;
            z-index: 1;
        }

        .instructions p {
            margin: 5px 0;
            font-size: 1.1rem;
        }

        .range-info {
            display: flex;
            justify-content: space-around;
            background: linear-gradient(to right, var(--warning), var(--warning-dark));
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .question-container {
            position: relative;
            z-index: 1;
            margin: 30px 0;
        }

        #question {
            font-size: 2.5rem;
            color: var(--primary-dark);
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .input-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
            position: relative;
            z-index: 1;
        }

        input[type="number"] {
            font-size: 1.8rem;
            padding: 15px;
            width: 120px;
            text-align: center;
            border: 3px solid var(--primary);
            border-radius: 12px;
            transition: all 0.3s;
            font-family: inherit;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.3);
            transform: scale(1.05);
        }

        .input-hint {
            font-size: 1.2rem;
            color: var(--primary);
            margin-top: 10px;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            position: relative;
            z-index: 1;
        }

        .btn {
            background: linear-gradient(to right, var(--success), var(--success-dark));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 28px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }

        .btn:hover::after {
            width: 100px;
            height: 100px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .btn-reset {
            background: linear-gradient(to right, var(--warning), var(--warning-dark));
        }

        #feedback {
            margin-top: 20px;
            font-size: 1.4rem;
            min-height: 50px;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s;
            position: relative;
            z-index: 1;
            font-weight: bold;
        }

        .feedback-correct {
            background: rgba(0, 184, 148, 0.2);
            color: var(--success-dark);
            border: 2px solid var(--success);
            animation: bounce 0.5s ease;
        }

        .feedback-wrong {
            background: rgba(255, 118, 117, 0.2);
            color: var(--error-dark);
            border: 2px solid var(--error);
            animation: shake 0.5s ease;
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--light);
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
            position: relative;
            z-index: 1;
            border: 2px solid var(--primary);
        }

        .progress {
            height: 12px;
            background: #e0e0e0;
            border-radius: 6px;
            margin-top: 10px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(to right, var(--success), var(--success-dark));
            width: 0%;
            transition: width 0.5s ease;
            border-radius: 6px;
        }

        .multiplication-table {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
            margin: 20px 0;
            position: relative;
            z-index: 1;
        }

        .table-item {
            padding: 10px;
            background: var(--light);
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .table-item:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.05);
        }

        .table-item.active {
            background: var(--success);
            color: white;
            border-color: var(--success-dark);
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
            width: 12px;
            height: 12px;
            background: var(--success);
            opacity: 0;
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
            40% { transform: translateY(-10px); }
            80% { transform: translateY(-5px); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .number-bubble {
            position: absolute;
            font-size: 1.5rem;
            color: var(--primary);
            animation: float 3s ease-in-out infinite;
            z-index: 0;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* تصميم متجاوب */
        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }

            .game-card {
                padding: 20px;
            }

            #question {
                font-size: 2rem;
            }

            input[type="number"] {
                width: 100px;
                font-size: 1.5rem;
                padding: 12px;
            }

            .controls {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
            }

            .multiplication-table {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎮 لعبة جدول الضرب للعدد 2</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="instructions">
                <p>أكمل عملية الضرب بإدخال الإجابة الصحيحة</p>
                <p class="input-hint">💡 تذكر: الضرب في 2 يعني مضاعفة العدد</p>
            </div>

            <div class="range-info">
                <div>المدى: {{ $min_range ?? 1 }} إلى {{ $max_range ?? 10 }}</div>
                <div>العدد: 2</div>
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
                <button class="btn" id="check-btn">تحقق من الإجابة</button>
                <button class="btn btn-reset" id="reset-btn">سؤال جديد</button>
            </div>

            <div id="feedback"></div>

            <div class="score-container">
                <div>النقاط: <span id="score">0</span></div>
                <div>السؤال: <span id="current-question">0</span>/<span id="total-questions">10</span></div>
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
        const multiplier = 2; // الضرب في العدد 2

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let correctAnswer = 0;
        let currentMultiplicand = 0;

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

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            checkButton.addEventListener('click', submitAnswer);
            resetButton.addEventListener('click', generateQuestion);
            answerInput.addEventListener('keydown', handleKeyPress);

            // إنشاء جدول الضرب
            createMultiplicationTable();

            // إنشاء فقاعات الأرقام
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
                tableItem.textContent = `2 × ${i} = ${2 * i}`;
                tableItem.addEventListener('click', () => {
                    // إزالة النشاط من جميع العناصر
                    document.querySelectorAll('.table-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    // إضافة النشاط للعنصر المحدد
                    tableItem.classList.add('active');
                });
                multiplicationTable.appendChild(tableItem);
            }
        }

        // إنشاء فقاعات الأرقام
        function createNumberBubbles() {
            const container = document.querySelector('.game-card');
            for (let i = 0; i < 8; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'number-bubble';
                bubble.textContent = i * 2;
                bubble.style.left = `${Math.random() * 80 + 10}%`;
                bubble.style.top = `${Math.random() * 80 + 10}%`;
                bubble.style.animationDelay = `${Math.random() * 2}s`;
                container.appendChild(bubble);
            }
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();

            currentMultiplicand = randomInt(minRange, maxRange);
            correctAnswer = multiplier * currentMultiplicand;

            questionElement.innerHTML = `
                <div style="display: flex; align-items: center; justify-content: center; gap: 15px;">
                    <span style="font-size: 3rem;">${multiplier}</span>
                    <span style="font-size: 2rem;">×</span>
                    <span style="font-size: 3rem;">${currentMultiplicand}</span>
                    <span style="font-size: 2rem;">=</span>
                    <span style="font-size: 3rem;">?</span>
                </div>
            `;

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
                scoreElement.textContent = score;
                feedbackElement.textContent = "أحسنت! ✅ إجابة صحيحة";
                feedbackElement.className = "feedback-correct";

                // تأثير الاحتفال عند الإجابات الصحيحة المتتالية
                if (score % 30 === 0) {
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
                }, 1500);
            } else {
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

        // تسليط الضوء على العنصر في الجدول
        function highlightTableItem(multiplicand) {
            document.querySelectorAll('.table-item').forEach(item => {
                item.classList.remove('active');
                if (item.textContent.includes(`${multiplier} × ${multiplicand} =`)) {
                    item.classList.add('active');
                }
            });
        }

        // إنهاء اللعبة
        function endGame() {
            questionElement.innerHTML = "🎉 <strong>انتهت اللعبة!</strong>";
            answerInput.style.display = 'none';
            checkButton.style.display = 'none';
            multiplicationTable.style.display = 'none';

            let message = "";
            let emoji = "";
            if (score >= 80) {
                message = "ممتاز! 🌟 أنت خبير في جدول الضرب";
                emoji = "🏆";
            } else if (score >= 60) {
                message = "جيد جداً! 👍 واصل الممارسة";
                emoji = "⭐";
            } else if (score >= 40) {
                message = "ليس سيئاً! 😊 تحتاج لمزيد من التدريب";
                emoji = "📚";
            } else {
                message = "حاول مرة أخرى! 💪 ستتحسن مع الممارسة";
                emoji = "🎯";
            }

            feedbackElement.innerHTML = `${message} ${emoji}<br>مجموع نقاطك: ${score} من ${totalQuestions * 10}`;
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

            const colors = ['#667eea', '#764ba2', '#00b894', '#ff7675', '#ffb300', '#74b9ff'];

            for (let i = 0; i < 100; i++) {
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
            }, 3000);
        }
    </script>
</body>
</html>
