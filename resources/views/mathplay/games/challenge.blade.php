<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحدي الضرب الذهني - {{ $lesson_game->lesson->name }}</title>
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
            background: linear-gradient(135deg, #e8f6f3 0%, #d1f2eb 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #1abc9c;
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
            color: #1abc9c;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .challenge-area {
            margin: 30px 0;
        }

        .timer-section {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
            border: 3px solid #e74c3c;
        }

        .timer-display {
            font-size: 3rem;
            font-weight: bold;
            color: #e74c3c;
            margin: 15px 0;
        }

        .timer-label {
            font-size: 1.2rem;
            color: #7f8c8d;
        }

        .problems-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        @media (max-width: 768px) {
            .problems-grid {
                grid-template-columns: 1fr;
            }
        }

        .problem-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #3498db;
            transition: all 0.3s;
        }

        .problem-card.solved {
            border-color: #2ecc71;
            background: #e8f6f3;
        }

        .problem-card.current {
            border-color: #f39c12;
            background: #fef9e7;
            transform: scale(1.05);
        }

        .problem-expression {
            font-size: 2.2rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 15px 0;
            direction: ltr;
        }

        .answer-input {
            width: 150px;
            height: 60px;
            font-size: 1.8rem;
            text-align: center;
            border: 3px solid #3498db;
            border-radius: 10px;
            outline: none;
            margin: 10px 0;
            direction: ltr;
            font-weight: bold;
            transition: all 0.3s;
        }

        .answer-input:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 10px rgba(116, 185, 255, 0.5);
        }

        .answer-input.correct {
            border-color: #2ecc71;
            background: #e8f6f3;
        }

        .answer-input.incorrect {
            border-color: #e74c3c;
            background: #fdedec;
        }

        .problem-status {
            font-size: 1.1rem;
            font-weight: bold;
            margin-top: 10px;
            min-height: 25px;
        }

        .status-correct {
            color: #2ecc71;
        }

        .status-incorrect {
            color: #e74c3c;
        }

        .status-pending {
            color: #7f8c8d;
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

        #start-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #pause-btn {
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

        .results-summary {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            margin: 20px 0;
            display: none;
        }

        .results-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .results-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 20px 0;
        }

        .result-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }

        .result-value {
            font-size: 2rem;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 5px;
        }

        .result-label {
            font-size: 0.9rem;
            color: #7f8c8d;
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

        .difficulty-selector {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .difficulty-btn {
            padding: 10px 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
        }

        .difficulty-btn.active {
            background: #3498db;
            color: white;
            border-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        
        <!-- التعليمات -->
        <div class="instructions">
            <h3>تحدي الضرب الذهني 🧠</h3>
            <p>🎯 حل أكبر عدد ممكن من مسائل الضرب خلال الوقت المحدد</p>
            <p>💡 استخدم الحساب الذهني والطرق السريعة</p>
            <p>✨ تحدى نفسك وارفع من سرعتك ودقتك</p>
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
                        <div class="stat-value" id="solved-count">0</div>
                        <div class="stat-label">تم الحل</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="accuracy">0%</div>
                        <div class="stat-label">الدقة</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="time-remaining">60</div>
                    <div class="stat-label">ثانية متبقية</div>
                </div>
            </div>

            <!-- اختيار مستوى الصعوبة -->
            <div class="difficulty-selector">
                <button class="difficulty-btn active" data-difficulty="two-digit">عدد من منزلتين × عدد من منزلة واحدة</button>
                <button class="difficulty-btn" data-difficulty="three-digit">عدد من ثلاث منازل × عدد من منزلة واحدة</button>
            </div>

            <!-- منطقة التحدي -->
            <div class="challenge-area">
                <!-- المؤقت -->
                <div class="timer-section">
                    <div class="timer-label">الوقت المتبقي:</div>
                    <div class="timer-display" id="timer-display">01:00</div>
                </div>

                <!-- شبكة المسائل -->
                <div class="problems-grid" id="problems-grid">
                    <!-- سيتم تعبئتها ديناميكياً -->
                </div>

                <!-- ملخص النتائج -->
                <div class="results-summary" id="results-summary">
                    <div class="results-title">🎊 نتائج التحدي</div>
                    <div class="results-stats">
                        <div class="result-item">
                            <div class="result-value" id="final-score">0</div>
                            <div class="result-label">النقاط النهائية</div>
                        </div>
                        <div class="result-item">
                            <div class="result-value" id="total-solved">0</div>
                            <div class="result-label">مسائل محلولة</div>
                        </div>
                        <div class="result-item">
                            <div class="result-value" id="final-accuracy">0%</div>
                            <div class="result-label">نسبة الدقة</div>
                        </div>
                    </div>
                </div>

                <!-- عناصر التحكم -->
                <div class="controls">
                    <button id="start-btn">بدء التحدي</button>
                    <button id="pause-btn" disabled>إيقاف مؤقت</button>
                    <button id="reset-btn">تحدي جديد</button>
                </div>
                
                <!-- التغذية الراجعة -->
                <div class="feedback" id="feedback">اضغط "بدء التحدي" لبدء حل مسائل الضرب!</div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // المتغيرات الأساسية
        let problems = [];
        let currentDifficulty = 'two-digit';
        let score = 0;
        let solvedCount = 0;
        let totalAttempts = 0;
        let timeRemaining = 60;
        let timerInterval = null;
        let gameActive = false;
        let currentProblemIndex = 0;

        // عناصر DOM
        const problemsGridElement = document.getElementById('problems-grid');
        const timerDisplayElement = document.getElementById('timer-display');
        const feedbackElement = document.getElementById('feedback');
        const startButton = document.getElementById('start-btn');
        const pauseButton = document.getElementById('pause-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const solvedCountElement = document.getElementById('solved-count');
        const accuracyElement = document.getElementById('accuracy');
        const timeRemainingElement = document.getElementById('time-remaining');
        const progressBarElement = document.getElementById('progress-bar');
        const resultsSummaryElement = document.getElementById('results-summary');
        const finalScoreElement = document.getElementById('final-score');
        const totalSolvedElement = document.getElementById('total-solved');
        const finalAccuracyElement = document.getElementById('final-accuracy');
        const celebrationElement = document.getElementById('celebration');
        const difficultyButtons = document.querySelectorAll('.difficulty-btn');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            startButton.addEventListener('click', startChallenge);
            pauseButton.addEventListener('click', togglePause);
            resetButton.addEventListener('click', resetGame);

            difficultyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    difficultyButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    currentDifficulty = this.getAttribute('data-difficulty');
                    resetGame();
                });
            });
        }

        // توليد مسألة حسب مستوى الصعوبة
        function generateProblem() {
            let num1, num2;
            
            if (currentDifficulty === 'two-digit') {
                num1 = Math.floor(Math.random() * 90) + 10; // 10-99
                num2 = Math.floor(Math.random() * 9) + 1;   // 1-9
            } else {
                num1 = Math.floor(Math.random() * 900) + 100; // 100-999
                num2 = Math.floor(Math.random() * 9) + 1;     // 1-9
            }
            
            return {
                expression: `${num1} × ${num2}`,
                answer: num1 * num2,
                userAnswer: null,
                solved: false,
                correct: false
            };
        }

        // توليد 6 مسائل
        function generateProblems() {
            problems = [];
            for (let i = 0; i < 6; i++) {
                problems.push(generateProblem());
            }
        }

        // بدء التحدي
        function startChallenge() {
            if (gameActive) return;
            
            gameActive = true;
            startButton.disabled = true;
            pauseButton.disabled = false;
            
            startTimer();
            updateProblemsDisplay();
            focusOnCurrentProblem();
            
            feedbackElement.textContent = '🏁 بدأ التحدي! حل المسائل بأسرع ما يمكن!';
        }

        // تبديل الإيقاف المؤقت
        function togglePause() {
            if (!gameActive) return;
            
            if (timerInterval) {
                clearInterval(timerInterval);
                timerInterval = null;
                pauseButton.textContent = 'متابعة';
                feedbackElement.textContent = '⏸️ التحدي متوقف مؤقتاً';
            } else {
                startTimer();
                pauseButton.textContent = 'إيقاف مؤقت';
                feedbackElement.textContent = '🏁 واصل التحدي!';
            }
        }

        // بدء المؤقت
        function startTimer() {
            timerInterval = setInterval(() => {
                timeRemaining--;
                updateTimerDisplay();
                
                if (timeRemaining <= 0) {
                    endChallenge();
                }
            }, 1000);
        }

        // تحديث عرض المؤقت
        function updateTimerDisplay() {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            timerDisplayElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            timeRemainingElement.textContent = timeRemaining;
            
            // تحديث شريط التقدم
            const progress = ((60 - timeRemaining) / 60) * 100;
            progressBarElement.style.width = `${progress}%`;
        }

        // تحديث عرض المسائل
        function updateProblemsDisplay() {
            problemsGridElement.innerHTML = '';
            
            problems.forEach((problem, index) => {
                const card = document.createElement('div');
                card.className = 'problem-card';
                if (problem.solved) card.classList.add('solved');
                if (index === currentProblemIndex) card.classList.add('current');
                
                card.innerHTML = `
                    <div class="problem-expression">${problem.expression}</div>
                    <input type="number" 
                           class="answer-input ${problem.correct ? 'correct' : problem.userAnswer !== null ? 'incorrect' : ''}"
                           data-index="${index}"
                           placeholder="الإجابة"
                           ${problem.solved ? 'disabled' : ''}
                           value="${problem.userAnswer || ''}">
                    <div class="problem-status ${problem.solved ? (problem.correct ? 'status-correct' : 'status-incorrect') : 'status-pending'}">
                        ${problem.solved ? (problem.correct ? '✓ صحيح' : '✗ خطأ') : 'بانتظار الحل'}
                    </div>
                `;
                
                problemsGridElement.appendChild(card);
            });
            
            // إضافة مستمعي الأحداث لحقول الإدخال
            document.querySelectorAll('.answer-input').forEach(input => {
                input.addEventListener('input', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    checkProblemAnswer(index, parseInt(this.value) || null);
                });
                
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        const index = parseInt(this.getAttribute('data-index'));
                        if (index < problems.length - 1) {
                            currentProblemIndex = index + 1;
                            updateProblemsDisplay();
                            focusOnCurrentProblem();
                        }
                    }
                });
            });
        }

        // التركيز على المسألة الحالية
        function focusOnCurrentProblem() {
            const currentInput = document.querySelector(`.answer-input[data-index="${currentProblemIndex}"]`);
            if (currentInput) {
                currentInput.focus();
            }
        }

        // التحقق من إجابة المسألة
        function checkProblemAnswer(index, userAnswer) {
            if (userAnswer === null || problems[index].solved) return;
            
            problems[index].userAnswer = userAnswer;
            totalAttempts++;
            
            if (userAnswer === problems[index].answer) {
                problems[index].solved = true;
                problems[index].correct = true;
                solvedCount++;
                score += 100;
                
                // الانتقال إلى المسألة التالية تلقائياً
                if (currentProblemIndex < problems.length - 1) {
                    currentProblemIndex++;
                }
                
                updateStats();
                updateProblemsDisplay();
                focusOnCurrentProblem();
                
                // تأثير للمسائل الصحيحة المتتالية
                if (solvedCount % 3 === 0) {
                    celebrate();
                }
            } else {
                problems[index].solved = false;
                problems[index].correct = false;
                score = Math.max(0, score - 20);
                updateStats();
                updateProblemsDisplay();
            }
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            solvedCountElement.textContent = solvedCount;
            
            const accuracy = totalAttempts > 0 ? Math.round((solvedCount / totalAttempts) * 100) : 0;
            accuracyElement.textContent = `${accuracy}%`;
        }

        // نهاية التحدي
        function endChallenge() {
            gameActive = false;
            clearInterval(timerInterval);
            timerInterval = null;
            
            startButton.disabled = false;
            pauseButton.disabled = true;
            pauseButton.textContent = 'إيقاف مؤقت';
            
            // تعطيل جميع حقول الإدخال
            document.querySelectorAll('.answer-input').forEach(input => {
                input.disabled = true;
            });
            
            // عرض النتائج النهائية
            showFinalResults();
            celebrate();
        }

        // عرض النتائج النهائية
        function showFinalResults() {
            const accuracy = totalAttempts > 0 ? Math.round((solvedCount / totalAttempts) * 100) : 0;
            
            finalScoreElement.textContent = score;
            totalSolvedElement.textContent = solvedCount;
            finalAccuracyElement.textContent = `${accuracy}%`;
            
            resultsSummaryElement.style.display = 'block';
            
            let message = '';
            if (solvedCount >= 15) {
                message = '🎊 مبروك! أنت بطل الضرب الذهني!';
            } else if (solvedCount >= 10) {
                message = '👍 أداء رائع! مهاراتك في الضرب ممتازة';
            } else if (solvedCount >= 5) {
                message = '👌 جيد جداً! واصل التدريب';
            } else {
                message = '💪 لا تستسلم! التدريب المستهر هو المفتاح';
            }
            
            feedbackElement.textContent = message;
        }

        // إعادة تعيين اللعبة
        function resetGame() {
            gameActive = false;
            clearInterval(timerInterval);
            timerInterval = null;
            
            score = 0;
            solvedCount = 0;
            totalAttempts = 0;
            timeRemaining = 60;
            currentProblemIndex = 0;
            
            generateProblems();
            updateStats();
            updateTimerDisplay();
            updateProblemsDisplay();
            
            startButton.disabled = false;
            pauseButton.disabled = true;
            pauseButton.textContent = 'إيقاف مؤقت';
            resultsSummaryElement.style.display = 'none';
            progressBarElement.style.width = '0%';
            
            feedbackElement.textContent = 'اضغط "بدء التحدي" لبدء حل مسائل الضرب!';
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
            }, 2000);
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