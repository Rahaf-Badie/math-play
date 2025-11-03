<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لعبة الضرب في العشرات والمئات - {{ $lesson_game->lesson->name }}</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .problem-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .problem {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 15px 0;
            color: #333;
        }

        .answer-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        .answer-container input {
            width: 100px;
            height: 60px;
            font-size: 2rem;
            text-align: center;
            border: 3px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s;
        }

        .answer-container input:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 10px rgba(116, 185, 255, 0.5);
        }

        .multiplier-type {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .multiplier-btn {
            padding: 10px 20px;
            background-color: #f1f2f6;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .multiplier-btn.active {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            border-color: #00a085;
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
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
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

            .answer-container input {
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
            <h3>تعليمات اللعبة</h3>
            <p>🏆 الهدف: تعلم الضرب في العشرات والمئات (إضافة صفر أو صفرين)</p>
            <p>📝 المدى: {{ $min_range }} إلى {{ $max_range }}</p>
            <p>✨ اختَر نوع الضرب ثم اكتب الإجابة الصحيحة!</p>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <div class="problem-container">
                <div id="base-problem" class="problem">5 × 3 = 15</div>
                <div id="multiplier-problem" class="problem">15 × 10 = ?</div>

                <div class="multiplier-type">
                    <button class="multiplier-btn" data-multiplier="10">ضرب في 10</button>
                    <button class="multiplier-btn" data-multiplier="100">ضرب في 100</button>
                </div>

                <div class="answer-container">
                    <input type="number" id="answer-input" placeholder="الإجابة">
                    <span class="problem">=</span>
                    <div id="result-display" class="problem">?</div>
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
            <button id="reset-btn">إعادة</button>
        </div>

        <!-- التغذية الراجعة -->
        <div class="feedback" id="feedback">أدخل إجابتك واضغط "تحقق"</div>

        <!-- النقاط -->
        <div class="score-container">
            النقاط: <span id="score">0</span>/10
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // المتغيرات الأساسية
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        let currentMultiplier = 10;
        let baseNumber1, baseNumber2, baseResult, currentResult;
        let score = 0;
        let totalQuestions = 10;
        let currentQuestion = 0;

        // عناصر DOM
        const baseProblemElement = document.getElementById('base-problem');
        const multiplierProblemElement = document.getElementById('multiplier-problem');
        const answerInput = document.getElementById('answer-input');
        const resultDisplay = document.getElementById('result-display');
        const checkButton = document.getElementById('check-btn');
        const resetButton = document.getElementById('reset-btn');
        const feedbackElement = document.getElementById('feedback');
        const scoreElement = document.getElementById('score');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const multiplierButtons = document.querySelectorAll('.multiplier-btn');

        // تهيئة اللعبة
        function initGame() {
            score = 0;
            currentQuestion = 0;
            updateScore();
            generateNewProblem();
            updateProgress();

            // إضافة مستمعي الأحداث
            checkButton.addEventListener('click', checkAnswer);
            resetButton.addEventListener('click', resetGame);
            answerInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    checkAnswer();
                }
            });

            // مستمعي أحداث أزرار المضاعف
            multiplierButtons.forEach(button => {
                button.addEventListener('click', function() {
                    multiplierButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    currentMultiplier = parseInt(this.getAttribute('data-multiplier'));
                    generateNewProblem();
                });
            });

            // تفعيل الزر الأول افتراضيًا
            multiplierButtons[0].classList.add('active');
        }

        // إنشاء مسألة جديدة
        function generateNewProblem() {
            // توليد أرقام عشوائية ضمن المدى المحدد
            baseNumber1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            baseNumber2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            // حساب النتائج
            baseResult = baseNumber1 * baseNumber2;
            currentResult = baseResult * currentMultiplier;

            // عرض المسألة
            baseProblemElement.textContent = `${baseNumber1} × ${baseNumber2} = ${baseResult}`;
            multiplierProblemElement.textContent = `${baseResult} × ${currentMultiplier} = ?`;

            // إعادة تعيين واجهة المستخدم
            answerInput.value = '';
            resultDisplay.textContent = '?';
            feedbackElement.textContent = 'أدخل إجابتك واضغط "تحقق"';
            feedbackElement.className = 'feedback';
            answerInput.focus();
        }

        // التحقق من الإجابة
        function checkAnswer() {
            const userAnswer = parseInt(answerInput.value);

            if (isNaN(userAnswer)) {
                feedbackElement.textContent = '⚠️ الرجاء إدخال إجابة صحيحة!';
                feedbackElement.className = 'feedback incorrect';
                return;
            }

            if (userAnswer === currentResult) {
                // الإجابة صحيحة
                score++;
                currentQuestion++;
                updateScore();
                updateProgress();
                resultDisplay.textContent = currentResult;
                feedbackElement.textContent = '🎉 إجابة صحيحة! أحسنت!';
                feedbackElement.className = 'feedback correct';

                // تأثير الاحتفال
                celebrate();

                // الانتقال إلى السؤال التالي بعد تأخير
                if (currentQuestion < totalQuestions) {
                    setTimeout(generateNewProblem, 1500);
                } else {
                    setTimeout(endGame, 1500);
                }
            } else {
                // الإجابة خاطئة
                feedbackElement.textContent = '❌ إجابة خاطئة! حاول مرة أخرى.';
                feedbackElement.className = 'feedback incorrect';
                resultDisplay.textContent = currentResult;
                answerInput.focus();
            }
        }

        // نهاية اللعبة
        function endGame() {
            const percentage = (score / totalQuestions) * 100;
            let message = '';

            if (percentage >= 80) {
                message = `🎊 مبروك! لقد أنهيت اللعبة بنجاح! ${score}/${totalQuestions}`;
            } else if (percentage >= 60) {
                message = `👍 جيد! ${score}/${totalQuestions} - يمكنك التحسن بالممارسة!`;
            } else {
                message = `📚 تحتاج إلى مزيد من الممارسة! ${score}/${totalQuestions}`;
            }

            feedbackElement.textContent = message;

            // عرض زر إعادة اللعبة
            checkButton.style.display = 'none';
            resetButton.textContent = 'العب مرة أخرى';
        }

        // إعادة تعيين اللعبة
        function resetGame() {
            score = 0;
            currentQuestion = 0;
            updateScore();
            updateProgress();
            generateNewProblem();
            checkButton.style.display = 'inline-block';
            resetButton.textContent = 'إعادة';
        }

        // تحديث النقاط
        function updateScore() {
            scoreElement.textContent = score;
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
