<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عائلة الضرب والقسمة - {{ $lesson_game->lesson->name }}</title>
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

        .game-area {
            padding: 25px;
            background: linear-gradient(135deg, #f4ecff 0%, #e8d6ff 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #9b59b6;
        }

        .family-title {
            font-size: 1.4rem;
            color: #8e44ad;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .fact-family {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (max-width: 600px) {
            .fact-family {
                grid-template-columns: 1fr;
            }
        }

        .fact-item {
            background: white;
            padding: 20px;
            border-radius: 12px;
            font-size: 1.8rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid transparent;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80px;
        }

        .fact-item.missing {
            border-color: #e74c3c;
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
            animation: pulse 2s infinite;
        }

        .input-box {
            width: 100px;
            height: 60px;
            font-size: 1.8rem;
            text-align: center;
            border: 3px solid #f1c40f;
            border-radius: 10px;
            outline: none;
            margin: 0 8px;
            transition: all 0.3s;
            font-weight: bold;
        }

        .input-box:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 10px rgba(116, 185, 255, 0.5);
            transform: scale(1.05);
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

        .family-relations {
            margin-top: 15px;
            padding: 10px;
            background: rgba(155, 89, 182, 0.1);
            border-radius: 8px;
            font-size: 1rem;
            color: #8e44ad;
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

            .fact-item {
                font-size: 1.5rem;
                padding: 15px;
            }

            .input-box {
                width: 80px;
                height: 50px;
                font-size: 1.5rem;
            }

            button {
                padding: 10px 20px;
                font-size: 1rem;
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
            <h3>عائلة الضرب والقسمة 🔗</h3>
            <p>🎯 اكتشف العلاقة بين الضرب والقسمة وأكمل عائلة الحقائق</p>
            <p>📊 المدى: {{ $min_range }} إلى {{ $max_range }}</p>
            <p>✨ استخدم العلاقات العكسية بين الضرب والقسمة لحل المسألة!</p>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <div class="family-title">أكمل عائلة الحقائق الرياضية:</div>

            <div id="fact-family" class="fact-family">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <div class="family-relations" id="family-relations">
                <!-- شرح العلاقات بين الأعداد -->
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
        <div class="feedback" id="feedback">أدخل القيمة المفقودة في المربع الأحمر</div>

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
        let factor1, factor2, product;
        let missingFactIndex = 0; // 0, 1, 2, 3
        let missingValue = 0;
        let score = 0;
        let totalQuestions = 10;
        let currentQuestion = 0;
        let correctAnswers = 0;
        let wrongAnswers = 0;
        let currentStreak = 0;
        let hintsUsed = 0;

        // عناصر DOM
        const factFamilyElement = document.getElementById('fact-family');
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
        const familyRelationsElement = document.getElementById('family-relations');

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
            // توليد عاملين مختلفين ضمن المدى المحدد
            do {
                factor1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                factor2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            } while (factor1 === factor2);

            product = factor1 * factor2;

            // اختيار حقيقة مفقودة عشوائياً
            missingFactIndex = Math.floor(Math.random() * 4);

            renderFacts();
            updateFamilyRelations();
        }

        // عرض عائلة الحقائق
        function renderFacts() {
            const facts = [
                `${factor1} × ${factor2} = ${product}`,
                `${factor2} × ${factor1} = ${product}`,
                `${product} ÷ ${factor1} = ${factor2}`,
                `${product} ÷ ${factor2} = ${factor1}`
            ];

            factFamilyElement.innerHTML = '';

            // تحديد القيمة المفقودة بناءً على نوع الحقيقة
            if (missingFactIndex === 0 || missingFactIndex === 1) {
                missingValue = product;
            } else if (missingFactIndex === 2) {
                missingValue = factor2;
            } else {
                missingValue = factor1;
            }

            // إنشاء عناصر الحقائق
            for (let i = 0; i < 4; i++) {
                const factItem = document.createElement('div');
                factItem.classList.add('fact-item');

                if (i === missingFactIndex) {
                    factItem.classList.add('missing');
                    let factHTML = '';

                    if (i === 0) {
                        factHTML = `${factor1} × ${factor2} = <input type="number" id="user-input" class="input-box" placeholder="؟">`;
                    } else if (i === 1) {
                        factHTML = `${factor2} × ${factor1} = <input type="number" id="user-input" class="input-box" placeholder="؟">`;
                    } else if (i === 2) {
                        factHTML = `${product} ÷ ${factor1} = <input type="number" id="user-input" class="input-box" placeholder="؟">`;
                    } else {
                        factHTML = `${product} ÷ ${factor2} = <input type="number" id="user-input" class="input-box" placeholder="؟">`;
                    }

                    factItem.innerHTML = factHTML;
                } else {
                    factItem.textContent = facts[i];
                }

                factFamilyElement.appendChild(factItem);
            }

            // إعادة تعيين واجهة المستخدم
            feedbackElement.textContent = 'أدخل القيمة المفقودة في المربع الأحمر';
            feedbackElement.className = 'feedback info';

            // تفعيل حقل الإدخال
            const inputElement = document.getElementById('user-input');
            if (inputElement) {
                inputElement.disabled = false;
                inputElement.focus();
            }

            // إعادة تفعيل الأزرار
            checkButton.disabled = false;
            hintButton.disabled = false;
        }

        // تحديث شرح العلاقات العائلية
        function updateFamilyRelations() {
            let relationText = '';

            if (missingFactIndex === 0 || missingFactIndex === 1) {
                relationText = `💡 تذكر: ${factor1} × ${factor2} = ${factor2} × ${factor1} = نفس الناتج`;
            } else if (missingFactIndex === 2) {
                relationText = `💡 تذكر: إذا كان ${factor1} × ${factor2} = ${product}، فإن ${product} ÷ ${factor1} = ${factor2}`;
            } else {
                relationText = `💡 تذكر: إذا كان ${factor1} × ${factor2} = ${product}، فإن ${product} ÷ ${factor2} = ${factor1}`;
            }

            familyRelationsElement.textContent = relationText;
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
                handleCorrectAnswer(inputElement);
            } else {
                // الإجابة خاطئة
                handleIncorrectAnswer(inputElement);
            }
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer(inputElement) {
            score++;
            currentQuestion++;
            correctAnswers++;
            currentStreak++;
            updateScore();
            updateStats();
            updateProgress();

            feedbackElement.textContent = '🎉 إجابة صحيحة! عائلة الحقائق مكتملة!';
            feedbackElement.className = 'feedback correct';

            // تأثير الاحتفال
            if (currentStreak >= 3) {
                celebrate();
            }

            // تعطيل الحقل والأزرار
            inputElement.disabled = true;
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
        function handleIncorrectAnswer(inputElement) {
            wrongAnswers++;
            currentStreak = 0;
            updateStats();

            feedbackElement.textContent = `❌ إجابة خاطئة! حاول مرة أخرى.`;
            feedbackElement.className = 'feedback incorrect';

            // مسح الحقل وإعادة التركيز
            inputElement.value = '';
            inputElement.focus();
        }

        // عرض مساعدة
        function showHint() {
            hintsUsed++;
            let hintMessage = '';

            if (missingFactIndex === 0 || missingFactIndex === 1) {
                hintMessage = `💡 تلميح: ${factor1} × ${factor2} = ${product}`;
            } else if (missingFactIndex === 2) {
                hintMessage = `💡 تلميح: ${product} ÷ ${factor1} = ${factor2}`;
            } else {
                hintMessage = `💡 تلميح: ${product} ÷ ${factor2} = ${factor1}`;
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
                message = `🎊 مبروك! أداء رائع! ${score}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 جيد جداً! ${score}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 ليس سيئاً! ${score}/${totalQuestions}`;
            } else {
                message = `📚 تحتاج إلى مزيد من الممارسة! ${score}/${totalQuestions}`;
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

            for (let i = 0; i < 50; i++) {
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
