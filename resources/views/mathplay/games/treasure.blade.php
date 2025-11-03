<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مقارنة الكنز - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 900px;
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
            background: linear-gradient(135deg, #fff9e6 0%, #ffeaa7 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #f39c12;
        }

        .game-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .game-stats {
            display: flex;
            gap: 20px;
        }

        .stat-item {
            background: white;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #f39c12;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .comparison-area {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 30px;
            align-items: center;
            margin: 30px 0;
        }

        @media (max-width: 768px) {
            .comparison-area {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto auto;
                gap: 20px;
            }
        }

        .number-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 4px solid #3498db;
        }

        .number-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 15px 0;
            direction: ltr;
            text-align: center;
        }

        .number-label {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        .comparison-symbol {
            font-size: 4rem;
            font-weight: bold;
            color: #e74c3c;
            animation: bounce 2s infinite;
        }

        .comparison-options {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .comparison-btn {
            padding: 20px 40px;
            font-size: 1.8rem;
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            min-width: 120px;
        }

        .comparison-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .comparison-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .comparison-btn.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            animation: pulse 1s infinite;
        }

        .comparison-btn.incorrect {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
        }

        .number-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .digit-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            min-width: 60px;
        }

        .digit-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e67e22;
        }

        .digit-label {
            font-size: 0.8rem;
            color: #7f8c8d;
            margin-top: 5px;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
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
            margin: 20px 0;
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

        .strategy-guide {
            background: #e8f6f3;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            border-right: 4px solid #1abc9c;
        }

        .guide-title {
            font-weight: bold;
            color: #3498db;
            margin-bottom: 15px;
        }

        .strategy-steps {
            text-align: right;
            line-height: 1.8;
        }

        .step {
            margin-bottom: 10px;
            padding: 8px;
            background: white;
            border-radius: 8px;
            border-right: 3px solid #3498db;
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

        @keyframes confetti-fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .completion-message {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00b894;
            margin: 20px 0;
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>لعبة مقارنة الكنز 🏆</h3>
            <p>🎯 قارن بين العددين واختر الإشارة المناسبة</p>
            <p>💡 ابدأ بمقارنة الأرقام من اليسار (أكبر منزلة)</p>
            <p>✨ استخدم استراتيجية المقارنة الذكية</p>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- رأس اللعبة -->
            <div class="game-header">
                <div class="game-stats">
                    <div class="stat-item">
                        <div class="stat-value" id="score">0</div>
                        <div class="stat-label">النقاط</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="correct-answers">0</div>
                        <div class="stat-label">إجابات صحيحة</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="current-streak">0</div>
                        <div class="stat-label">التتابع الحالي</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="progress-display">0/10</div>
                    <div class="stat-label">التقدم</div>
                </div>
            </div>

            <!-- منطقة المقارنة -->
            <div class="comparison-area">
                <!-- العدد الأول -->
                <div class="number-box">
                    <div class="number-label">العدد الأول</div>
                    <div class="number-display" id="number1">0</div>
                    <div class="number-visual" id="visual1">
                        <!-- سيتم تعبئتها ديناميكياً -->
                    </div>
                </div>

                <!-- رمز المقارنة -->
                <div class="comparison-symbol" id="comparison-symbol">?</div>

                <!-- العدد الثاني -->
                <div class="number-box">
                    <div class="number-label">العدد الثاني</div>
                    <div class="number-display" id="number2">0</div>
                    <div class="number-visual" id="visual2">
                        <!-- سيتم تعبئتها ديناميكياً -->
                    </div>
                </div>
            </div>

            <!-- خيارات المقارنة -->
            <div class="comparison-options">
                <button class="comparison-btn" data-option="<">&lt; أصغر</button>
                <button class="comparison-btn" data-option="=">= يساوي</button>
                <button class="comparison-btn" data-option=">">&gt; أكبر</button>
            </div>

            <!-- دليل الاستراتيجية -->
            <div class="strategy-guide">
                <div class="guide-title">💡 استراتيجية المقارنة الذكية:</div>
                <div class="strategy-steps">
                    <div class="step">1. ابدأ من أقصى اليسار (منزلة الملايين)</div>
                    <div class="step">2. إذا تساوت المنزلة، انتقل إلى المنزلة التالية</div>
                    <div class="step">3. العدد الذي فيه رقم أكبر في أي منزلة هو الأكبر</div>
                </div>
            </div>

            <!-- رسالة الإكمال -->
            <div id="completion-message" class="completion-message" style="display: none;">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="hint-btn">مساعدة</button>
                <button id="reset-btn">لعبة جديدة</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">قارن بين العددين واختر الإشارة المناسبة!</div>
        </div>

        <!-- شريط التقدم -->
        <div class="progress">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // المتغيرات الأساسية
        let number1 = 0;
        let number2 = 0;
        let correctAnswer = '';
        let score = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalQuestions = 10;
        let currentQuestion = 0;
        let gameStarted = false;
        let hintsUsed = 0;

        // عناصر DOM
        const number1Element = document.getElementById('number1');
        const number2Element = document.getElementById('number2');
        const visual1Element = document.getElementById('visual1');
        const visual2Element = document.getElementById('visual2');
        const comparisonSymbolElement = document.getElementById('comparison-symbol');
        const comparisonButtons = document.querySelectorAll('.comparison-btn');
        const feedbackElement = document.getElementById('feedback');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const progressDisplayElement = document.getElementById('progress-display');
        const progressBarElement = document.getElementById('progress-bar');
        const completionMessageElement = document.getElementById('completion-message');
        const celebrationElement = document.getElementById('celebration');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            comparisonButtons.forEach(button => {
                button.addEventListener('click', function() {
                    checkAnswer(this.getAttribute('data-option'));
                });
            });

            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', resetGame);
        }

        // بدء اللعبة
        function startGame() {
            gameStarted = true;
            generateNewProblem();
        }

        // توليد عدد عشوائي ضمن 999,999,999
        function generateRandomNumber() {
            return Math.floor(Math.random() * 1000000000);
        }

        // تنسيق العدد مع الفواصل
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // إنشاء مسألة جديدة
        function generateNewProblem() {
            if (currentQuestion >= totalQuestions) {
                endGame();
                return;
            }

            currentQuestion++;
            updateProgress();

            // توليد عددين عشوائيين
            number1 = generateRandomNumber();
            number2 = generateRandomNumber();

            // التأكد من أن العددين مختلفين
            while (number1 === number2) {
                number2 = generateRandomNumber();
            }

            // تحديد الإجابة الصحيحة
            if (number1 > number2) {
                correctAnswer = '>';
            } else if (number1 < number2) {
                correctAnswer = '<';
            }

            // تحديث واجهة المستخدم
            updateNumberDisplay();
            createVisualComparison();
            resetFeedback();
        }

        // تحديث عرض الأعداد
        function updateNumberDisplay() {
            number1Element.textContent = formatNumber(number1);
            number2Element.textContent = formatNumber(number2);
            comparisonSymbolElement.textContent = '?';

            // تفعيل الأزرار
            comparisonButtons.forEach(button => {
                button.disabled = false;
                button.classList.remove('correct', 'incorrect');
            });
        }

        // إنشاء المقارنة البصرية
        function createVisualComparison() {
            visual1Element.innerHTML = '';
            visual2Element.innerHTML = '';

            const digits1 = number1.toString().padStart(9, '0').split('');
            const digits2 = number2.toString().padStart(9, '0').split('');

            const placeNames = ['مئات الملايين', 'عشرات الملايين', 'الملايين', 'مئات الآلاف', 'عشرات الآلاف', 'الآلاف', 'المئات', 'العشرات', 'الآحاد'];

            for (let i = 0; i < 9; i++) {
                const group1 = createDigitGroup(digits1[i], placeNames[i]);
                const group2 = createDigitGroup(digits2[i], placeNames[i]);

                visual1Element.appendChild(group1);
                visual2Element.appendChild(group2);
            }
        }

        // إنشاء مجموعة أرقام
        function createDigitGroup(digit, label) {
            const group = document.createElement('div');
            group.className = 'digit-group';

            const value = document.createElement('div');
            value.className = 'digit-value';
            value.textContent = digit;

            const labelElement = document.createElement('div');
            labelElement.className = 'digit-label';
            labelElement.textContent = label;

            group.appendChild(value);
            group.appendChild(labelElement);

            return group;
        }

        // التحقق من الإجابة
        function checkAnswer(userAnswer) {
            // تعطيل جميع الأزرار
            comparisonButtons.forEach(button => {
                button.disabled = true;
            });

            const isCorrect = userAnswer === correctAnswer;

            // تلوين الأزرار
            comparisonButtons.forEach(button => {
                if (button.getAttribute('data-option') === correctAnswer) {
                    button.classList.add('correct');
                } else if (button.getAttribute('data-option') === userAnswer && !isCorrect) {
                    button.classList.add('incorrect');
                }
            });

            // تحديث رمز المقارنة
            comparisonSymbolElement.textContent = correctAnswer;

            // معالجة النتيجة
            if (isCorrect) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            score += 100;
            correctAnswers++;
            currentStreak++;
            updateStats();

            feedbackElement.textContent = `🎉 أحسنت! ${formatNumber(number1)} ${correctAnswer} ${formatNumber(number2)}`;
            feedbackElement.className = 'feedback correct';

            // تأثير التتابع
            if (currentStreak >= 3) {
                celebrate();
            }

            // الانتقال إلى السؤال التالي بعد تأخير
            setTimeout(generateNewProblem, 2000);
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            score = Math.max(0, score - 50);
            currentStreak = 0;
            updateStats();

            feedbackElement.textContent = `❌ غير صحيح! ${formatNumber(number1)} ${correctAnswer} ${formatNumber(number2)}`;
            feedbackElement.className = 'feedback incorrect';

            // الانتقال إلى السؤال التالي بعد تأخير
            setTimeout(generateNewProblem, 2500);
        }

        // عرض مساعدة
        function showHint() {
            if (hintsUsed >= 3) {
                feedbackElement.textContent = '⚠️ لقد استخدمت جميع المساعدات المتاحة!';
                feedbackElement.className = 'feedback info';
                return;
            }

            hintsUsed++;
            score = Math.max(0, score - 25);
            updateStats();

            // إيجاد أول منزلة مختلفة
            const str1 = number1.toString().padStart(9, '0');
            const str2 = number2.toString().padStart(9, '0');

            let differentIndex = -1;
            for (let i = 0; i < 9; i++) {
                if (str1[i] !== str2[i]) {
                    differentIndex = i;
                    break;
                }
            }

            const placeNames = ['مئات الملايين', 'عشرات الملايين', 'الملايين', 'مئات الآلاف', 'عشرات الآلاف', 'الآلاف', 'المئات', 'العشرات', 'الآحاد'];

            let hintMessage = `💡 انظر إلى منزلة ${placeNames[differentIndex]}: ${str1[differentIndex]} مقابل ${str2[differentIndex]}`;

            feedbackElement.textContent = hintMessage;
            feedbackElement.className = 'feedback info';
        }

        // نهاية اللعبة
        function endGame() {
            gameStarted = false;
            comparisonButtons.forEach(button => {
                button.disabled = true;
            });
            hintButton.disabled = true;

            const percentage = (correctAnswers / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أنت خبير في مقارنة الأعداد! ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 أحسنت! مهاراتك في المقارنة ممتازة ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 جيد! واصل التدرب على المقارنة ${correctAnswers}/${totalQuestions}`;
            } else {
                message = `📚 راجع استراتيجيات مقارنة الأعداد! ${correctAnswers}/${totalQuestions}`;
            }

            completionMessageElement.style.display = 'block';
            completionMessageElement.textContent = message;

            celebrate();
        }

        // إعادة تعيين اللعبة
        function resetGame() {
            score = 0;
            correctAnswers = 0;
            currentStreak = 0;
            currentQuestion = 0;
            hintsUsed = 0;
            gameStarted = true;

            updateStats();
            updateProgress();
            comparisonButtons.forEach(button => {
                button.disabled = false;
            });
            hintButton.disabled = false;
            completionMessageElement.style.display = 'none';

            generateNewProblem();
        }

        // إعادة تعيين التغذية الراجعة
        function resetFeedback() {
            feedbackElement.textContent = 'قارن بين العددين واختر الإشارة المناسبة!';
            feedbackElement.className = 'feedback info';
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            correctAnswersElement.textContent = correctAnswers;
            currentStreakElement.textContent = currentStreak;

            // تلوين التتابع
            if (currentStreak >= 5) {
                currentStreakElement.style.color = '#00b894';
            } else if (currentStreak >= 3) {
                currentStreakElement.style.color = '#ffb300';
            } else {
                currentStreakElement.style.color = '#0984e3';
            }
        }

        // تحديث التقدم
        function updateProgress() {
            const progress = (currentQuestion / totalQuestions) * 100;
            progressBarElement.style.width = `${progress}%`;
            progressDisplayElement.textContent = `${currentQuestion}/${totalQuestions}`;
        }

        // تأثير الاحتفال
        function celebrate() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            for (let i = 0; i < 60; i++) {
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
