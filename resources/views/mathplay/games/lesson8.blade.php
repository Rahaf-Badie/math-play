<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة العد القفزي - {{ $lesson_game->lesson->name }}</title>
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
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
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
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .header h1 {
            font-size: 2.2rem;
            margin-bottom: 5px;
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            color: white;
        }

        .game-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 100%;
            transition: transform 0.3s ease;
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
            border-left: 4px solid var(--info);
        }

        .instructions p {
            margin: 5px 0;
            font-size: 1.1rem;
        }

        .range-info {
            display: flex;
            justify-content: space-around;
            background: linear-gradient(to right, var(--info), var(--info-dark));
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        #question {
            font-size: 1.8rem;
            margin: 25px 0;
            color: var(--primary-dark);
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .sequence-item {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 5px;
        }

        input[type="number"] {
            font-size: 1.4rem;
            padding: 10px;
            width: 80px;
            text-align: center;
            border: 2px solid var(--primary);
            border-radius: 8px;
            transition: all 0.3s;
            font-family: inherit;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
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
            font-size: 1.3rem;
            min-height: 40px;
            text-align: center;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .feedback-correct {
            background: rgba(0, 184, 148, 0.2);
            color: var(--success-dark);
            border: 1px solid var(--success);
        }

        .feedback-wrong {
            background: rgba(255, 118, 117, 0.2);
            color: var(--error-dark);
            border: 1px solid var(--error);
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--light);
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .progress {
            height: 10px;
            background: #e0e0e0;
            border-radius: 5px;
            margin-top: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(to right, var(--success), var(--success-dark));
            width: 0%;
            transition: width 0.5s ease;
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
            width: 10px;
            height: 10px;
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

        /* تصميم متجاوب */
        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }

            .game-card {
                padding: 20px;
            }

            #question {
                font-size: 1.5rem;
            }

            input[type="number"] {
                width: 70px;
                font-size: 1.2rem;
            }

            .controls {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎮 لعبة العد القفزي</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="instructions">
                <p>أكمل المتتابعة العددية بإدخال الأرقام الناقصة</p>
            </div>

            <div class="range-info">
                <div>المدى: {{ $min_range }} إلى {{ $max_range }}</div>
                <div>نوع العملية: {{ $operation_type ?? 'عد قفزي' }}</div>
            </div>

            <div id="question">جاري تحميل السؤال...</div>

            <div class="controls">
                <button class="btn" id="check-btn">تحقق من الإجابة</button>
                <button class="btn btn-reset" id="reset-btn">إعادة المحاولة</button>
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
        const maxRange = {{ $max_range ?? 50 }};
        const operationType = "{{ $operation_type ?? 'counting' }}";

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let correctAnswers = [];
        let currentStep = 1;

        // عناصر DOM
        const questionElement = document.getElementById('question');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const resetButton = document.getElementById('reset-btn');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            checkButton.addEventListener('click', submitAnswer);
            resetButton.addEventListener('click', resetGame);
            generateQuestion();
        });

        // توليد رقم عشوائي ضمن المدى
        function randomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();

            // تحديد خطوات العد بناءً على المدى
            let stepOptions;
            if (maxRange <= 20) {
                stepOptions = [2, 3];
            } else if (maxRange <= 50) {
                stepOptions = [2, 3, 5];
            } else {
                stepOptions = [5, 10];
            }

            const step = stepOptions[randomInt(0, stepOptions.length - 1)];
            const start = randomInt(minRange, Math.max(minRange, maxRange - 4 * step));
            const blanksCount = 2;
            let sequence = [];
            correctAnswers = [];

            // إنشاء المتتابعة
            for (let i = 0; i < 5; i++) {
                sequence.push(start + i * step);
            }

            // تحديد المواضع الفارغة
            let blanksIndices = [];
            while (blanksIndices.length < blanksCount) {
                let idx = randomInt(0, sequence.length - 1);
                if (!blanksIndices.includes(idx)) blanksIndices.push(idx);
            }
            blanksIndices.sort();

            correctAnswers = blanksIndices.map(idx => sequence[idx]);

            // عرض المتتابعة مع المدخلات
            let displaySequence = sequence.map((num, idx) => {
                if (blanksIndices.includes(idx)) {
                    return `<input type="number" id="input${idx}" class="sequence-input" min="${minRange}" max="${maxRange}">`;
                } else {
                    return `<span class="sequence-item">${num}</span>`;
                }
            });

            questionElement.innerHTML = displaySequence.join(" &nbsp; ");
            feedbackElement.textContent = "";
            feedbackElement.className = "";

            // تفعيل المدخلات
            setTimeout(() => {
                const firstInput = document.querySelector('.sequence-input');
                if (firstInput) firstInput.focus();
            }, 100);
        }

        // التحقق من الإجابة
        function submitAnswer() {
            let allCorrect = true;
            let emptyFields = false;

            correctAnswers.forEach((ans, idx) => {
                const inputElement = document.getElementById(`input${idx}`);
                const userAns = parseInt(inputElement.value);

                if (isNaN(userAns)) {
                    emptyFields = true;
                    allCorrect = false;
                    inputElement.style.borderColor = 'var(--error)';
                } else if (userAns !== ans) {
                    allCorrect = false;
                    inputElement.style.borderColor = 'var(--error)';
                } else {
                    inputElement.style.borderColor = 'var(--success)';
                }
            });

            if (emptyFields) {
                feedbackElement.textContent = "⚠️ يرجى ملء جميع الخانات";
                feedbackElement.className = "feedback-wrong";
                return;
            }

            if (allCorrect) {
                score += 10;
                scoreElement.textContent = score;
                feedbackElement.textContent = "أحسنت! ✅ إجابة صحيحة";
                feedbackElement.className = "feedback-correct";

                // تأثير الاحتفال عند الإجابة الصحيحة
                if (score % 30 === 0) {
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
                feedbackElement.textContent = `❌ إجابة خاطئة. الإجابات الصحيحة: ${correctAnswers.join(", ")}`;
                feedbackElement.className = "feedback-wrong";

                setTimeout(() => {
                    if (questionCount < totalQuestions) {
                        generateQuestion();
                    } else {
                        endGame();
                    }
                }, 2000);
            }
        }

        // إنهاء اللعبة
        function endGame() {
            questionElement.innerHTML = "🎉 <strong>انتهت اللعبة!</strong>";
            document.querySelectorAll('input').forEach(input => input.style.display = 'none');
            checkButton.style.display = 'none';

            let message = "";
            if (score >= 80) {
                message = "ممتاز! 🌟 أداء رائع";
            } else if (score >= 60) {
                message = "جيد جداً! 👍 واصل التقدم";
            } else if (score >= 40) {
                message = "ليس سيئاً! 😊 حاول مرة أخرى";
            } else {
                message = "تحتاج للمزيد من الممارسة 💪";
            }

            feedbackElement.textContent = `${message} - مجموع نقاطك: ${score} من ${totalQuestions * 10}`;
            feedbackElement.className = "feedback-correct";

            createCelebration();
        }

        // إعادة اللعبة
        function resetGame() {
            score = 0;
            questionCount = 0;
            scoreElement.textContent = score;
            currentQuestionElement.textContent = questionCount;
            updateProgress();

            document.querySelectorAll('input').forEach(input => {
                input.style.display = 'inline-block';
                input.style.borderColor = 'var(--primary)';
            });

            checkButton.style.display = 'block';
            feedbackElement.textContent = "";
            feedbackElement.className = "";

            generateQuestion();
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

        // السماح بالإدخال باستخدام زر Enter
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                submitAnswer();
            }
        });
    </script>
</body>
</html>
