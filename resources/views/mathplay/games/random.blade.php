<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لعبة الكسور المتكافئة - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 700px;
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

        .game-area {
            padding: 25px;
            background: linear-gradient(135deg, #eaf2f8 0%, #d6eaf8 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #3498db;
        }

        .question-display {
            font-size: 1.6rem;
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: bold;
            line-height: 1.5;
        }

        .fraction-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .fraction-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            min-width: 150px;
        }

        .fraction {
            font-size: 3rem;
            font-weight: bold;
            margin: 10px 0;
        }

        .fraction-line {
            width: 100%;
            height: 4px;
            background: #333;
            margin: 5px 0;
        }

        .fraction-input {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .fraction-input input {
            width: 100px;
            height: 80px;
            font-size: 2.5rem;
            text-align: center;
            border: 3px solid #f1c40f;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s;
            font-weight: bold;
        }

        .fraction-input input:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 10px rgba(116, 185, 255, 0.5);
            transform: scale(1.05);
        }

        .equals-sign {
            font-size: 3rem;
            font-weight: bold;
            color: #e74c3c;
        }

        .visual-aid {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .circle-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: conic-gradient(
                #e74c3c 0% calc(var(--filled) * 100%),
                #ecf0f1 calc(var(--filled) * 100%) 100%
            );
            margin-bottom: 10px;
            border: 3px solid #34495e;
            position: relative;
        }

        .circle-label {
            font-weight: bold;
            color: #2c3e50;
        }

        .explanation {
            background: rgba(52, 152, 219, 0.1);
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            font-size: 1.1rem;
            color: #2c3e50;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
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

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #reset-btn {
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

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback {
            min-height: 80px;
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

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
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

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .bounce {
            animation: bounce 0.5s ease infinite;
        }

        @keyframes confetti-fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .fraction {
                font-size: 2.5rem;
            }

            .fraction-input input {
                width: 80px;
                height: 70px;
                font-size: 2rem;
            }

            .circle {
                width: 100px;
                height: 100px;
            }

            button {
                padding: 10px 20px;
                font-size: 1rem;
            }

            .fraction-container {
                gap: 15px;
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
            <h3>لعبة الكسور المتكافئة 🎯</h3>
            <p>✨ ابحث عن الكسر المكافئ للكسر المعطى</p>
            <p>📝 تذكر: الكسور المتكافئة تمثل نفس الكمية ولكن بأرقام مختلفة</p>
            <p>💡 اضرب أو اقسم البسط والمقام بنفس العدد</p>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <div id="question-display" class="question-display">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- المساعدة البصرية -->
            <div class="visual-aid">
                <div class="circle-container">
                    <div class="circle" id="original-circle" style="--filled: 0.5"></div>
                    <div class="circle-label" id="original-label">1/2</div>
                </div>
                <div class="circle-container">
                    <div class="circle" id="equivalent-circle" style="--filled: 0.5"></div>
                    <div class="circle-label" id="equivalent-label">؟/؟</div>
                </div>
            </div>

            <!-- منطقة الكسور -->
            <div class="fraction-container">
                <div class="fraction-box">
                    <div class="fraction" id="original-fraction">1/2</div>
                    <div>الكسر الأصلي</div>
                </div>

                <div class="equals-sign">=</div>

                <div class="fraction-box">
                    <div class="fraction-input">
                        <input type="number" id="user-numerator" placeholder="؟" min="1" max="20">
                        <div class="fraction-line"></div>
                        <div class="fraction" id="target-denominator">4</div>
                    </div>
                    <div>الكسر المكافئ</div>
                </div>
            </div>

            <!-- الشرح -->
            <div class="explanation" id="explanation">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>
        </div>

        <!-- شريط التقدم -->
        <div class="progress">
            <div class="progress-bar" id="progress-bar"></div>
        </div>

        <!-- عناصر التحكم -->
        <div class="controls">
            <button id="check-btn">تحقق</button>
            <button id="hint-btn">مساعدة</button>
            <button id="reset-btn">سؤال جديد</button>
        </div>

        <!-- التغذية الراجعة -->
        <div class="feedback" id="feedback">أدخل البسط المناسب للكسر المكافئ</div>

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
        let baseNumerator, baseDenominator, targetDenominator, correctNumerator;
        let multiplier;
        let score = 0;
        let totalQuestions = 10;
        let currentQuestion = 0;
        let correctAnswers = 0;
        let wrongAnswers = 0;
        let currentStreak = 0;
        let hintsUsed = 0;

        // عناصر DOM
        const questionDisplayElement = document.getElementById('question-display');
        const originalFractionElement = document.getElementById('original-fraction');
        const targetDenominatorElement = document.getElementById('target-denominator');
        const userNumeratorInput = document.getElementById('user-numerator');
        const explanationElement = document.getElementById('explanation');
        const feedbackElement = document.getElementById('feedback');
        const checkButton = document.getElementById('check-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const correctAnswersElement = document.getElementById('correct-answers');
        const wrongAnswersElement = document.getElementById('wrong-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const originalCircleElement = document.getElementById('original-circle');
        const equivalentCircleElement = document.getElementById('equivalent-circle');
        const originalLabelElement = document.getElementById('original-label');
        const equivalentLabelElement = document.getElementById('equivalent-label');

        // تهيئة اللعبة
        function initGame() {
            score = 0;
            currentQuestion = 0;
            correctAnswers = 0;
            wrongAnswers = 0;
            currentStreak = 0;
            hintsUsed = 0;
            updateScore();
            updateStats();
            generateNewProblem();
            updateProgress();

            // إضافة مستمعي الأحداث
            checkButton.addEventListener('click', checkAnswer);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', resetGame);

            // تفعيل إدخال الإجابة عند الضغط على Enter
            document.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    checkAnswer();
                }
            });
        }

        // إنشاء مسألة جديدة
        function generateNewProblem() {
            // توليد كسر بسيط مناسب للصف الثالث
            baseDenominator = Math.floor(Math.random() * 4) + 2; // 2 إلى 5
            baseNumerator = Math.floor(Math.random() * (baseDenominator - 1)) + 1; // 1 إلى baseDenominator-1

            // توليد معامل مناسب (2، 3، أو 4)
            multiplier = Math.floor(Math.random() * 3) + 2;

            targetDenominator = baseDenominator * multiplier;
            correctNumerator = baseNumerator * multiplier;

            // تحديث الواجهة
            updateInterface();
        }

        // تحديث واجهة المستخدم
        function updateInterface() {
            // تحديث السؤال
            questionDisplayElement.textContent =
                `أوجد الكسر المكافئ للكسر ${baseNumerator}/${baseDenominator} الذي مقامه ${targetDenominator}`;

            // تحديث الكسور
            originalFractionElement.textContent = `${baseNumerator}/${baseDenominator}`;
            targetDenominatorElement.textContent = targetDenominator;

            // تحديث الشرح
            explanationElement.textContent =
                `لإيجاد الكسر المكافئ، نضرب البسط والمقام في ${multiplier}`;

            // تحديث المساعدة البصرية
            updateVisualAid();

            // إعادة تعيين واجهة المستخدم
            userNumeratorInput.value = '';
            userNumeratorInput.disabled = false;
            feedbackElement.textContent = 'أدخل البسط المناسب للكسر المكافئ';
            feedbackElement.className = 'feedback info';

            // تفعيل الأزرار
            checkButton.disabled = false;
            hintButton.disabled = false;

            // التركيز على حقل الإدخال
            userNumeratorInput.focus();
        }

        // تحديث المساعدة البصرية
        function updateVisualAid() {
            const originalFraction = baseNumerator / baseDenominator;
            const equivalentFraction = correctNumerator / targetDenominator;

            // تحديث الدوائر
            originalCircleElement.style.setProperty('--filled', originalFraction);
            equivalentCircleElement.style.setProperty('--filled', originalFraction); // نفس الكمية

            // تحديث التسميات
            originalLabelElement.textContent = `${baseNumerator}/${baseDenominator}`;
            equivalentLabelElement.textContent = `؟/${targetDenominator}`;
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseInt(userNumeratorInput.value);

            if (isNaN(userAnswer) || userAnswer < 1) {
                feedbackElement.textContent = '⚠️ الرجاء إدخال عدد صحيح موجب!';
                feedbackElement.className = 'feedback incorrect';
                return;
            }

            if (userAnswer === correctNumerator) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            score++;
            currentQuestion++;
            correctAnswers++;
            currentStreak++;
            updateScore();
            updateStats();
            updateProgress();

            feedbackElement.textContent = `🎉 إجابة صحيحة! ${baseNumerator}/${baseDenominator} = ${correctNumerator}/${targetDenominator}`;
            feedbackElement.className = 'feedback correct';

            // تحديث المساعدة البصرية
            equivalentLabelElement.textContent = `${correctNumerator}/${targetDenominator}`;

            // تأثير الاحتفال
            if (currentStreak >= 3) {
                celebrate();
            }

            // تعطيل الحقل والأزرار
            userNumeratorInput.disabled = true;
            checkButton.disabled = true;
            hintButton.disabled = true;

            // الانتقال إلى السؤال التالي بعد تأخير
            if (currentQuestion < totalQuestions) {
                setTimeout(generateNewProblem, 2000);
            } else {
                setTimeout(endGame, 2000);
            }
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            wrongAnswers++;
            currentStreak = 0;
            updateStats();

            feedbackElement.textContent = `❌ إجابة خاطئة! حاول مرة أخرى`;
            feedbackElement.className = 'feedback incorrect';

            // مسح الحقل وإعادة التركيز
            userNumeratorInput.value = '';
            userNumeratorInput.focus();
        }

        // عرض مساعدة
        function showHint() {
            hintsUsed++;

            let hintMessage = '';
            if (multiplier === 2) {
                hintMessage = `💡 تلميح: اضرب البسط ${baseNumerator} في 2`;
            } else if (multiplier === 3) {
                hintMessage = `💡 تلميح: اضرب البسط ${baseNumerator} في 3`;
            } else {
                hintMessage = `💡 تلميح: اضرب البسط ${baseNumerator} في 4`;
            }

            feedbackElement.textContent = hintMessage;
            feedbackElement.className = 'feedback info';

            // تعطيل زر المساعدة مؤقتاً
            hintButton.disabled = true;
            setTimeout(() => {
                hintButton.disabled = false;
            }, 3000);
        }

        // نهاية اللعبة
        function endGame() {
            const percentage = (score / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أنت خبير في الكسور! ${score}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 أحسنت! فهمت الفكرة جيداً ${score}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 جيد! واصل الممارسة ${score}/${totalQuestions}`;
            } else {
                message = `📚 تحتاج إلى مزيد من التمرين! ${score}/${totalQuestions}`;
            }

            if (hintsUsed > 0) {
                message += ` (استخدمت ${hintsUsed} مساعدة)`;
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
            hintsUsed = 0;
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

            for (let i = 0; i < 40; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.width = '15px';
                confetti.style.height = '15px';
                confetti.style.background = getRandomColor();
                confetti.style.borderRadius = '50%';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s linear forwards`;
                celebrationElement.appendChild(confetti);
            }

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
