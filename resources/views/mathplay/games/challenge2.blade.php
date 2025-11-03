<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحدي الضرب السريع - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            max-width: 1100px;
            width: 100%;
            position: relative;
        }

        .back-to-lesson {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #e17055 0%, #d63031 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .back-to-lesson:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 10px;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.4rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .lesson-info {
            display: inline-block;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
            color: #2d3436;
            margin-top: 10px;
        }

        .challenge-arena {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .game-area {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .control-panel {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 25px;
            border: 3px solid #e9ecef;
        }

        .panel-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
            font-weight: bold;
            font-size: 1.4rem;
        }

        .game-area .panel-title {
            color: white;
        }

        .problem-display {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            margin: 25px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .problem-numbers {
            font-size: 4rem;
            font-weight: bold;
            color: #e84393;
            margin: 20px 0;
            direction: ltr;
        }

        .problem-equation {
            font-size: 2rem;
            color: #636e72;
            margin: 20px 0;
        }

        .timer-container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 15px;
            margin: 20px auto;
            max-width: 300px;
        }

        .timer-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ffeaa7;
            text-align: center;
        }

        .answer-input-container {
            margin: 25px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .answer-input {
            width: 100%;
            padding: 25px;
            border: 4px solid #a29bfe;
            border-radius: 15px;
            font-size: 2.5rem;
            text-align: center;
            outline: none;
            direction: ltr;
            transition: all 0.3s ease;
        }

        .answer-input:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.3);
        }

        .check-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 15px 30px;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 300px;
        }

        .check-btn:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .check-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .option-btn {
            background: white;
            border: 3px solid #dfe6e9;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #2d3436;
        }

        .option-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .challenge-controls {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 25px 0;
        }

        .challenge-btn {
            padding: 15px 20px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        #start-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #skip-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .challenge-btn:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .challenge-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback-display {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.2rem;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .challenge-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .challenge-fail {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .challenge-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .stats-panel {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .stat-item {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .progress-container {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
        }

        .progress-bar {
            width: 100%;
            height: 20px;
            background: #dfe6e9;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            border-radius: 10px;
            transition: width 0.5s ease;
            width: 0%;
        }

        .level-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .multiplication-tips {
            background: #e9f7ef;
            border: 2px solid #00b894;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .tips-title {
            text-align: center;
            font-weight: bold;
            color: #00b894;
            margin-bottom: 15px;
        }

        .tip-item {
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 8px;
            border-right: 3px solid #00b894;
        }

        @media (max-width: 768px) {
            .challenge-arena {
                grid-template-columns: 1fr;
            }
            .options-grid, .stats-panel {
                grid-template-columns: 1fr;
            }
            .problem-numbers {
                font-size: 2.5rem;
            }
            .back-to-lesson {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 15px;
                width: 100%;
                justify-content: center;
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes celebrate {
            0% { transform: translateY(0px) scale(1); }
            25% { transform: translateY(-10px) scale(1.1); }
            50% { transform: translateY(0px) scale(1.1); }
            75% { transform: translateY(-5px) scale(1.05); }
            100% { transform: translateY(0px) scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .celebrate {
            animation: celebrate 0.5s ease-in-out;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-to-lesson">
            ← الرجوع إلى الدرس
        </a>

        <div class="header">
            <h1 class="lesson-title">⚡ تحدي الضرب السريع</h1>
            <div class="lesson-info">
                @if($lesson_game->id == 114)
                    ضرب عددين من منزلتين في عدد من منزلتين
                @elseif($lesson_game->id == 115)
                    ضرب عدد من 3 منازل في عدد من منزلتين
                @endif
            </div>
        </div>

        <div class="challenge-arena">
            <div class="game-area">
                <div class="panel-title">🎮 ساحة التحدي</div>

                <div class="problem-display">
                    <div class="problem-numbers" id="problem-numbers">
                        25 × 34
                    </div>
                    <div class="problem-equation">
                        = <span id="result-placeholder">?</span>
                    </div>
                </div>

                <div class="timer-container">
                    <div class="timer-display" id="timer">
                        01:40
                    </div>
                </div>

                <div class="answer-input-container">
                    <input type="number" class="answer-input" id="answer-input" placeholder="أدخل الناتج" disabled>
                    <button class="check-btn" id="check-btn" disabled>✅ تحقق من الإجابة</button>
                </div>

                <div class="options-grid" id="options-grid">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>

                <div class="feedback-display" id="challenge-feedback">
                    انقر على "بدء التحدي" للبدء!
                </div>
            </div>

            <div class="control-panel">
                <div class="panel-title">🎛 لوحة التحكم</div>

                <div class="challenge-controls">
                    <button class="challenge-btn" id="start-btn">
                        🚀 بدء التحدي
                    </button>
                    <button class="challenge-btn" id="skip-btn" disabled>
                        ⏭ تخطي
                    </button>
                    <button class="challenge-btn" id="hint-btn" disabled>
                        💡 تلميح
                    </button>
                </div>

                <div class="stats-panel">
                    <div class="stat-item">
                        <div class="stat-value" id="score">0</div>
                        <div class="stat-label">النقاط</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="correct-count">0</div>
                        <div class="stat-label">إجابات صحيحة</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="challenge-level">1</div>
                        <div class="stat-label">مستوى التحدي</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="accuracy">100%</div>
                        <div class="stat-label">الدقة</div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                    <div class="level-info">
                        <span>التقدم</span>
                        <span id="progress-text">0/10</span>
                    </div>
                </div>

                <div class="multiplication-tips">
                    <div class="tips-title">💡 نصائح للضرب السريع</div>
                    <div class="tip-item">استخدم خاصية التوزيع لتقسيم المسألة</div>
                    <div class="tip-item">تذكر جدول الضرب جيداً</div>
                    <div class="tip-item">تحقق من الإجابة بتقدير الناتج</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const lessonId = {{ $lesson_game->id }};
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};

        // تحديد نطاق الأعداد بناءً على الـ ID
        let number1Range, number2Range;
        if (lessonId === 114) {
            number1Range = { min: 10, max: 99 };
            number2Range = { min: 10, max: 99 };
        } else if (lessonId === 115) {
            number1Range = { min: 100, max: 999 };
            number2Range = { min: 10, max: 99 };
        }

        // متغيرات اللعبة
        let score = 0;
        let correctCount = 0;
        let challengeLevel = 1;
        let totalAttempts = 0;
        let currentProblem = null;
        let totalTime = 100; // 1 دقيقة و 40 ثانية = 100 ثانية
        let timeLeft = totalTime;
        let timerInterval = null;
        let isChallengeActive = false;
        let progress = 0;
        let progressTarget = 10;

        // عناصر DOM
        const problemNumbers = document.getElementById('problem-numbers');
        const resultPlaceholder = document.getElementById('result-placeholder');
        const timerDisplay = document.getElementById('timer');
        const answerInput = document.getElementById('answer-input');
        const checkBtn = document.getElementById('check-btn');
        const optionsGrid = document.getElementById('options-grid');
        const challengeFeedback = document.getElementById('challenge-feedback');
        const startBtn = document.getElementById('start-btn');
        const skipBtn = document.getElementById('skip-btn');
        const hintBtn = document.getElementById('hint-btn');
        const scoreElement = document.getElementById('score');
        const correctCountElement = document.getElementById('correct-count');
        const challengeLevelElement = document.getElementById('challenge-level');
        const accuracyElement = document.getElementById('accuracy');
        const progressFill = document.getElementById('progress-fill');
        const progressText = document.getElementById('progress-text');

        // تهيئة اللعبة
        function initGame() {
            console.log("🎮 تهيئة اللعبة...");
            setupEventListeners();
            updateStats();
        }

        function setupEventListeners() {
            console.log("🔗 إعداد مستمعي الأحداث...");
            
            startBtn.addEventListener('click', startChallenge);
            skipBtn.addEventListener('click', skipProblem);
            hintBtn.addEventListener('click', provideHint);
            checkBtn.addEventListener('click', checkAnswer);

            answerInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && isChallengeActive) {
                    checkAnswer();
                }
            });

            answerInput.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.style.borderColor = '#6c5ce7';
                    checkBtn.disabled = false;
                } else {
                    this.style.borderColor = '#a29bfe';
                    checkBtn.disabled = true;
                }
            });
        }

        function startChallenge() {
            console.log("🚀 بدء التحدي...");
            
            if (isChallengeActive) return;
            
            isChallengeActive = true;
            startBtn.disabled = true;
            skipBtn.disabled = false;
            hintBtn.disabled = false;
            answerInput.disabled = false;
            checkBtn.disabled = true;

            // إعادة تعيين الإحصائيات
            score = 0;
            correctCount = 0;
            challengeLevel = 1;
            totalAttempts = 0;
            progress = 0;
            progressTarget = 10;
            timeLeft = totalTime;

            updateStats();
            generateNewProblem();
            startTimer();

            challengeFeedback.className = 'feedback-display challenge-info';
            challengeFeedback.textContent = 'أدخل الإجابة أو اختر من الخيارات!';

            answerInput.focus();
        }

        function startTimer() {
            console.log("⏰ بدء التايمر... الوقت المتبقي:", timeLeft);
            
            // إلغاء أي تايمر سابق
            if (timerInterval) {
                clearInterval(timerInterval);
            }

            // تحديث العرض أولاً
            updateTimerDisplay();
            timerDisplay.style.color = '#ffeaa7';

            // بدء التايمر الجديد
            timerInterval = setInterval(function() {
                timeLeft--;
                updateTimerDisplay();

                if (timeLeft <= 30) {
                    timerDisplay.style.color = '#ff7675';
                    timerDisplay.classList.add('pulse');
                }

                if (timeLeft <= 0) {
                    endChallenge();
                }
            }, 1000);
        }

        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        function generateNewProblem() {
            console.log("🔄 إنشاء مسألة جديدة...");
            
            const num1 = Math.floor(Math.random() * (number1Range.max - number1Range.min + 1)) + number1Range.min;
            const num2 = Math.floor(Math.random() * (number2Range.max - number2Range.min + 1)) + number2Range.min;

            currentProblem = {
                number1: num1,
                number2: num2,
                result: num1 * num2
            };

            console.log("❓ المسألة الجديدة:", `${num1} × ${num2} = ${currentProblem.result}`);

            problemNumbers.textContent = `${num1} × ${num2}`;
            resultPlaceholder.textContent = '?';
            answerInput.value = '';
            answerInput.style.borderColor = '#a29bfe';
            checkBtn.disabled = true;

            generateOptions();
        }

        function generateOptions() {
            optionsGrid.innerHTML = '';
            const correctAnswer = currentProblem.result;
            const options = [correctAnswer];

            // توليد خيارات خاطئة
            while (options.length < 4) {
                let wrongAnswer;
                if (Math.random() > 0.5) {
                    // خطأ في الآحاد
                    wrongAnswer = correctAnswer + (Math.random() > 0.5 ? 1 : -1) * (Math.floor(Math.random() * 10) + 1);
                } else {
                    // خطأ في المنازل
                    const wrongDigit = Math.floor(Math.random() * 10);
                    const wrongPlace = Math.pow(10, Math.floor(Math.random() * 3));
                    wrongAnswer = correctAnswer + wrongDigit * wrongPlace;
                }

                if (wrongAnswer > 0 && !options.includes(wrongAnswer)) {
                    options.push(wrongAnswer);
                }
            }

            // خلط الخيارات
            shuffleArray(options);

            // عرض الخيارات
            options.forEach(option => {
                const optionBtn = document.createElement('div');
                optionBtn.className = 'option-btn';
                optionBtn.textContent = option;
                optionBtn.dataset.value = option;

                optionBtn.addEventListener('click', function() {
                    if (isChallengeActive) {
                        answerInput.value = option;
                        checkBtn.disabled = false;
                    }
                });

                optionsGrid.appendChild(optionBtn);
            });
        }

        function checkAnswer() {
            console.log("✅ التحقق من الإجابة...");
            
            if (!isChallengeActive) {
                console.log("❌ التحدي غير نشط");
                return;
            }
            
            const userAnswer = parseInt(answerInput.value);
            if (isNaN(userAnswer)) {
                challengeFeedback.className = 'feedback-display challenge-fail';
                challengeFeedback.textContent = '❌ يرجى إدخال إجابة صحيحة!';
                return;
            }
            
            console.log("🔍 الإجابة المدخلة:", userAnswer, "الإجابة الصحيحة:", currentProblem.result);
            
            totalAttempts++;
            const isCorrect = userAnswer === currentProblem.result;

            if (isCorrect) {
                handleCorrectAnswer();
            } else {
                handleWrongAnswer();
            }
            
            checkBtn.disabled = true;
        }

        function handleCorrectAnswer() {
            console.log("🎉 إجابة صحيحة!");
            
            correctCount++;
            score += 10 + (challengeLevel * 2);
            progress++;

            challengeFeedback.className = 'feedback-display challenge-success celebrate';
            challengeFeedback.textContent = '🎉 إجابة صحيحة! +' + (10 + challengeLevel * 2) + ' نقطة';

            resultPlaceholder.textContent = currentProblem.result;

            // تحديث مستوى التحدي
            if (progress >= progressTarget) {
                challengeLevel++;
                progress = 0;
                progressTarget = Math.min(progressTarget + 5, 20);
                challengeFeedback.textContent += ` - انتقل للمستوى ${challengeLevel}!`;
            }

            updateStats();

            // مسألة جديدة بعد ثانية
            setTimeout(() => {
                if (isChallengeActive) {
                    generateNewProblem();
                    challengeFeedback.textContent = 'أدخل الإجابة أو اختر من الخيارات!';
                    challengeFeedback.className = 'feedback-display challenge-info';
                }
            }, 1500);
        }

        function handleWrongAnswer() {
            console.log("❌ إجابة خاطئة!");
            
            score = Math.max(0, score - 5);
            challengeFeedback.className = 'feedback-display challenge-fail shake';
            challengeFeedback.textContent = `❌ إجابة خاطئة! حاول مرة أخرى`;

            updateStats();
        }

        function skipProblem() {
            if (!isChallengeActive) return;

            score = Math.max(0, score - 2);
            challengeFeedback.className = 'feedback-display challenge-info';
            challengeFeedback.textContent = 'تم تخطي المسألة! -2 نقطة';

            updateStats();
            generateNewProblem();
        }

        function provideHint() {
            if (!isChallengeActive || !currentProblem) return;

            const hintType = Math.floor(Math.random() * 3);
            let hint = '';

            switch(hintType) {
                case 0:
                    hint = `تلميح: ${currentProblem.number1} × ${currentProblem.number2} = ${currentProblem.number1 * currentProblem.number2}`;
                    break;
                case 1:
                    const partial = Math.floor(currentProblem.number1 / 10) * currentProblem.number2;
                    hint = `تلميح: ${Math.floor(currentProblem.number1 / 10)} × ${currentProblem.number2} = ${partial} (ثم أضف صفراً)`;
                    break;
                case 2:
                    hint = `تلميح: الناتج بين ${currentProblem.result - 20} و ${currentProblem.result + 20}`;
                    break;
            }

            challengeFeedback.className = 'feedback-display challenge-info pulse';
            challengeFeedback.textContent = hint;

            score = Math.max(0, score - 3);
            updateStats();
        }

        function endChallenge() {
            console.log("⏹️ انتهاء التحدي");
            
            isChallengeActive = false;
            startBtn.disabled = false;
            skipBtn.disabled = true;
            hintBtn.disabled = true;
            answerInput.disabled = true;
            checkBtn.disabled = true;

            if (timerInterval) {
                clearInterval(timerInterval);
                timerInterval = null;
            }

            const accuracy = totalAttempts > 0 ? Math.round((correctCount / totalAttempts) * 100) : 0;

            challengeFeedback.className = 'feedback-display challenge-info';
            challengeFeedback.textContent = `انتهى الوقت! النقاط: ${score} | الدقة: ${accuracy}%`;

            timeLeft = totalTime;
            updateTimerDisplay();
            timerDisplay.style.color = '#ffeaa7';
            timerDisplay.classList.remove('pulse');
        }

        function updateStats() {
            scoreElement.textContent = score;
            correctCountElement.textContent = correctCount;
            challengeLevelElement.textContent = challengeLevel;

            const accuracy = totalAttempts > 0 ? Math.round((correctCount / totalAttempts) * 100) : 100;
            accuracyElement.textContent = `${accuracy}%`;

            const progressPercent = (progress / progressTarget) * 100;
            progressFill.style.width = `${progressPercent}%`;
            progressText.textContent = `${progress}/${progressTarget}`;
        }

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // بدء اللعبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', initGame);
    </script>
</body>
</html>