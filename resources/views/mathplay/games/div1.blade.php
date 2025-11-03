<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لعبة القسمة وتمارين الضرب - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #333;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            padding: 30px;
            text-align: center;
        }

        .lesson-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .instructions {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-right: 5px solid #74b9ff;
        }

        .instructions h3 {
            color: #0984e3;
            margin-bottom: 10px;
        }

        .instructions p {
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .game-type-selector {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .game-type-btn {
            padding: 12px 25px;
            background: linear-gradient(135deg, #f1f2f6 0%, #dfe4ea 100%);
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
        }

        .game-type-btn.active {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            border-color: #00a085;
        }

        .game-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .problem-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .problem {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 20px 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .blank-input {
            width: 100px;
            height: 70px;
            font-size: 2rem;
            text-align: center;
            border: 3px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s;
        }

        .blank-input:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 10px rgba(116, 185, 255, 0.5);
        }

        .problem-explanation {
            font-size: 1.1rem;
            color: #666;
            margin-top: 10px;
            font-style: italic;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        button {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135-gradient, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #new-game-btn {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: translateY(0);
        }

        .feedback {
            min-height: 60px;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s;
        }

        .feedback.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback.incorrect {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .score-container {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .progress {
            margin-top: 15px;
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            width: 0%;
            transition: width 0.5s;
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

        .game-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0984e3;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .bounce {
            animation: bounce 0.5s ease infinite;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .problem {
                font-size: 2rem;
            }

            .blank-input {
                width: 80px;
                height: 60px;
                font-size: 1.8rem;
            }

            button {
                padding: 10px 20px;
                font-size: 1rem;
            }

            .game-type-selector {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>لعبة القسمة وتمارين الضرب</h3>
            <p>🎯 اختر نوع التمرين: ضرب ناقص (إيجاد العدد المفقود) أو قسمة صريحة</p>
            <p>📊 المدى: {{ $min_range }} إلى {{ $max_range }}</p>
            <p>✨ استخدم معرفتك بجدول الضرب لحل المسائل!</p>
        </div>

        <!-- اختيار نوع اللعبة -->
        <div class="game-type-selector">
            <button class="game-type-btn active" data-type="multiplication">تمارين الضرب الناقص</button>
            <button class="game-type-btn" data-type="division">تمارين القسمة</button>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <div class="problem-container">
                <div id="problem-display" class="problem">
                    <!-- سيتم تعبئتها ديناميكياً -->
                </div>
                <div id="problem-explanation" class="problem-explanation">
                    <!-- شرح المسألة -->
                </div>
            </div>
        </div>

        <!-- شريط التقدم -->
        <div class="progress">
            <div class="progress-bar" id="progress-bar"></div>
        </div>

        <!-- عناصر التحكم -->
        <div class="controls">
            <button id="check-btn">تحقق</button>
            <button id="new-game-btn">سؤال جديد</button>
            <button id="reset-btn">إعادة اللعبة</button>
        </div>

        <!-- التغذية الراجعة -->
        <div class="feedback" id="feedback">اختر نوع التمرين وأدخل إجابتك</div>

        <!-- النقاط -->
        <div class="score-container">
            النقاط: <span id="score">0</span>/10
        </div>

        <!-- الإحصائيات -->
        <div class="game-stats">
            <div class="stat-item">
                <div class="stat-value" id="correct-answers">0</div>
                <div class="stat-label">إجابات صحيحة</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="wrong-answers">0</div>
                <div class="stat-label">إجابات خاطئة</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="current-streak">0</div>
                <div class="stat-label">التتابع الحالي</div>
            </div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // المتغيرات الأساسية
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        let currentGameType = 'multiplication'; // 'multiplication' أو 'division'
        let num1, num2, result, missingValue;
        let missingPosition = 0; // 1: num1, 2: num2, 3: result
        let score = 0;
        let totalQuestions = 10;
        let currentQuestion = 0;
        let correctAnswers = 0;
        let wrongAnswers = 0;
        let currentStreak = 0;

        // عناصر DOM
        const problemDisplayElement = document.getElementById('problem-display');
        const problemExplanationElement = document.getElementById('problem-explanation');
        const checkButton = document.getElementById('check-btn');
        const newGameButton = document.getElementById('new-game-btn');
        const resetButton = document.getElementById('reset-btn');
        const feedbackElement = document.getElementById('feedback');
        const scoreElement = document.getElementById('score');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const gameTypeButtons = document.querySelectorAll('.game-type-btn');
        const correctAnswersElement = document.getElementById('correct-answers');
        const wrongAnswersElement = document.getElementById('wrong-answers');
        const currentStreakElement = document.getElementById('current-streak');

        // تهيئة اللعبة
        function initGame() {
            score = 0;
            currentQuestion = 0;
            correctAnswers = 0;
            wrongAnswers = 0;
            currentStreak = 0;
            updateScore();
            updateStats();
            generateNewProblem();
            updateProgress();

            // إضافة مستمعي الأحداث
            checkButton.addEventListener('click', checkAnswer);
            newGameButton.addEventListener('click', generateNewProblem);
            resetButton.addEventListener('click', resetGame);

            // مستمعي أحداث أزرار نوع اللعبة
            gameTypeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    gameTypeButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    currentGameType = this.getAttribute('data-type');
                    resetGame();
                });
            });

            // تفعيل إدخال الإجابة عند الضغط على Enter
            document.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    checkAnswer();
                }
            });
        }

        // إنشاء مسألة جديدة
        function generateNewProblem() {
            // توليد أرقام عشوائية ضمن المدى المحدد
            num1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            num2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            result = num1 * num2;

            let displayHTML = '';
            let explanation = '';

            if (currentGameType === 'multiplication') {
                // تمارين الضرب الناقص
                missingPosition = Math.floor(Math.random() * 3) + 1; // 1, 2, أو 3

                if (missingPosition === 1) {
                    // العدد الأول مفقود (قسمة: الناتج ÷ العدد الثاني)
                    missingValue = num1;
                    displayHTML = `
                        <input type="number" id="user-input" class="blank-input" placeholder="؟">
                        <span> × ${num2} = ${result}</span>
                    `;
                    explanation = `أوجد العدد الذي إذا ضرب في ${num2} يعطي ${result}`;
                } else if (missingPosition === 2) {
                    // العدد الثاني مفقود (قسمة: الناتج ÷ العدد الأول)
                    missingValue = num2;
                    displayHTML = `
                        <span>${num1} × </span>
                        <input type="number" id="user-input" class="blank-input" placeholder="؟">
                        <span> = ${result}</span>
                    `;
                    explanation = `أوجد العدد الذي إذا ضرب في ${num1} يعطي ${result}`;
                } else {
                    // الناتج مفقود (ضرب عادي)
                    missingValue = result;
                    displayHTML = `
                        <span>${num1} × ${num2} = </span>
                        <input type="number" id="user-input" class="blank-input" placeholder="؟">
                    `;
                    explanation = `احسب ناتج ضرب ${num1} في ${num2}`;
                }
            } else {
                // تمارين القسمة الصريحة
                // تأكد من أن القسمة ستكون صحيحة (بدون باقي)
                const divisor = num2;
                const dividend = num1 * divisor;

                displayHTML = `
                    <span>${dividend} ÷ ${divisor} = </span>
                    <input type="number" id="user-input" class="blank-input" placeholder="؟">
                `;
                explanation = `اقسم ${dividend} على ${divisor}`;
                missingValue = num1;
            }

            problemDisplayElement.innerHTML = displayHTML;
            problemExplanationElement.textContent = explanation;

            // إعادة تعيين واجهة المستخدم
            feedbackElement.textContent = 'أدخل إجابتك واضغط "تحقق"';
            feedbackElement.className = 'feedback';

            // تفعيل حقل الإدخال
            const inputElement = document.getElementById('user-input');
            if (inputElement) {
                inputElement.disabled = false;
                inputElement.focus();
            }
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const inputElement = document.getElementById('user-input');
            const userAnswer = parseInt(inputElement.value);

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = '⚠️ الرجاء إدخال إجابة صحيحة!';
                feedbackElement.className = 'feedback incorrect';
                return;
            }

            if (userAnswer === missingValue) {
                // الإجابة صحيحة
                score++;
                currentQuestion++;
                correctAnswers++;
                currentStreak++;
                updateScore();
                updateStats();
                updateProgress();

                feedbackElement.textContent = '🎉 إجابة صحيحة! أحسنت!';
                feedbackElement.className = 'feedback correct';

                // تأثير الاحتفال
                if (currentStreak >= 3) {
                    celebrate();
                }

                // تعطيل الحقل وعرض الإجابة الصحيحة
                inputElement.disabled = true;

                // الانتقال إلى السؤال التالي بعد تأخير
                if (currentQuestion < totalQuestions) {
                    setTimeout(generateNewProblem, 1500);
                } else {
                    setTimeout(endGame, 1500);
                }
            } else {
                // الإجابة خاطئة
                wrongAnswers++;
                currentStreak = 0;
                updateStats();

                feedbackElement.textContent = `❌ إجابة خاطئة! الإجابة الصحيحة هي: ${missingValue}`;
                feedbackElement.className = 'feedback incorrect';

                // تعطيل الحقل وعرض الإجابة الصحيحة
                inputElement.value = missingValue;
                inputElement.disabled = true;

                // إعادة تفعيل الحقل بعد تأخير
                setTimeout(() => {
                    inputElement.value = '';
                    inputElement.disabled = false;
                    inputElement.focus();
                    feedbackElement.textContent = 'حاول مرة أخرى!';
                }, 2000);
            }
        }

        // نهاية اللعبة
        function endGame() {
            const percentage = (score / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أداء رائع! ${score}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 جيد جداً! ${score}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 ليس سيئاً! ${score}/${totalQuestions}`;
            } else {
                message = `📚 تحتاج إلى مزيد من الممارسة! ${score}/${totalQuestions}`;
            }

            feedbackElement.textContent = message;
        }

        // إعادة تعيين اللعبة
        function resetGame() {
            score = 0;
            currentQuestion = 0;
            correctAnswers = 0;
            wrongAnswers = 0;
            currentStreak = 0;
            updateScore();
            updateStats();
            updateProgress();
            generateNewProblem();
        }

        // تحديث النقاط
        function updateScore() {
            scoreElement.textContent = score;
        }

        // تحديث الإحصائيات
        function updateStats() {
            correctAnswersElement.textContent = correctAnswers;
            wrongAnswersElement.textContent = wrongAnswers;
            currentStreakElement.textContent = currentStreak;

            // تلوين التتابع بناءً على قيمته
            if (currentStreak >= 5) {
                currentStreakElement.style.color = '#00b894';
            } else if (currentStreak >= 3) {
                currentStreakElement.style.color = '#ffb300';
            } else {
                currentStreakElement.style.color = '#0984e3';
            }
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (currentQuestion / totalQuestions) * 100;
            progressBar.style.width = `${progress}%`;
        }

        // تأثير الاحتفال
        function celebrate() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            for (let i = 0; i < 30; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.width = '15px';
                confetti.style.height = '15px';
                confetti.style.background = getRandomColor();
                confetti.style.borderRadius = '50%';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
                celebrationElement.appendChild(confetti);
            }

            // إضافة أنماط للconfetti
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fall {
                    to {
                        transform: translateY(100vh) rotate(${Math.random() * 360}deg);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 3000);
        }

        // الحصول على لون عشوائي
        function getRandomColor() {
            const colors = [
                '#ff7675', '#74b9ff', '#55efc4', '#ffeaa7',
                '#a29bfe', '#fd79a8', '#fdcb6e', '#00b894'
            ];
            return colors[Math.floor(Math.random() * colors.length)];
        }

        // بدء اللعبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', initGame);
    </script>
</body>
</html>
