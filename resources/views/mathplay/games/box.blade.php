<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لعبة مخزون القياس - {{ $lesson_game->lesson->name }}</title>
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
            background: linear-gradient(135deg, #e8f6f8 0%, #d1f0f6 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #3498db;
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
            color: #3498db;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .question-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-right: 5px solid #3498db;
        }

        .question-title {
            font-size: 1.4rem;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .object-display {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 25px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .object-icon {
            font-size: 4rem;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            min-width: 140px;
            border: 3px solid #3498db;
        }

        .object-info {
            text-align: right;
            flex: 1;
            min-width: 250px;
        }

        .object-name {
            font-size: 1.8rem;
            color: #3498db;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .object-description {
            font-size: 1.1rem;
            color: #7f8c8d;
            line-height: 1.5;
        }

        .units-guide {
            background: #e8f6f3;
            padding: 20px;
            border-radius: 12px;
            margin: 25px 0;
            border-right: 4px solid #1abc9c;
        }

        .guide-title {
            font-weight: bold;
            color: #3498db;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .guide-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .guide-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .guide-unit {
            font-weight: bold;
            color: #e67e22;
            font-size: 1.3rem;
            margin-bottom: 5px;
        }

        .guide-name {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .guide-examples {
            font-size: 0.9rem;
            color: #7f8c8d;
            line-height: 1.4;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .options-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .options-grid {
                grid-template-columns: 1fr;
            }
        }

        .option-btn {
            padding: 20px 15px;
            font-size: 1.3rem;
            background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .option-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            animation: pulse 1s infinite;
        }

        .option-btn.incorrect {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
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

        #next-btn {
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

        .explanation {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: right;
            display: none;
        }

        .explanation-title {
            font-weight: bold;
            color: #3498db;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .explanation-content {
            line-height: 1.6;
            color: #2c3e50;
        }

        .comparison-chart {
            background: #fff9e6;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-right: 4px solid #f39c12;
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

        .bounce {
            animation: bounce 0.5s ease infinite;
        }

        .completion-message {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00b894;
            margin: 20px 0;
            animation: pulse 2s infinite;
        }

        .ruler-animation {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>لعبة مخزون القياس 📦</h3>
            <p>🎯 اختر الوحدة المناسبة لقياس الكمية المطلوبة</p>
            <p>💡 تذكر: لكل كمية وحدة قياس مناسبة</p>
            <p>✨ انتبه للفرق بين وحدات الطول والوزن والسعة</p>
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

            <!-- صندوق السؤال -->
            <div class="question-box">
                <div class="question-title">ما هي الوحدة الأفضل للقياس؟</div>

                <!-- عرض الشيء -->
                <div class="object-display">
                    <div class="object-icon" id="object-icon">📏</div>
                    <div class="object-info">
                        <div class="object-name" id="object-name">طول قلم الرصاص</div>
                        <div class="object-description" id="object-description">أداة كتابة صغيرة الحجم</div>
                    </div>
                </div>

                <!-- رسم متحرك -->
                <div class="ruler-animation">
                    <div class="scale">📐</div>
                </div>

                <!-- دليل الوحدات -->
                <div class="units-guide">
                    <div class="guide-title">دليل وحدات القياس:</div>
                    <div class="guide-items">
                        <div class="guide-item">
                            <div class="guide-unit">مم</div>
                            <div class="guide-name">المليمتر</div>
                            <div class="guide-examples">سمك العملة، سمك الورق</div>
                        </div>
                        <div class="guide-item">
                            <div class="guide-unit">سم</div>
                            <div class="guide-name">السنتيمتر</div>
                            <div class="guide-examples">طول القلم، عرض الكتاب</div>
                        </div>
                        <div class="guide-item">
                            <div class="guide-unit">م</div>
                            <div class="guide-name">المتر</div>
                            <div class="guide-examples">طول الغرفة، ارتفاع الباب</div>
                        </div>
                        <div class="guide-item">
                            <div class="guide-unit">كم</div>
                            <div class="guide-name">الكيلومتر</div>
                            <div class="guide-examples">المسافة بين المدن، طول الطريق</div>
                        </div>
                    </div>
                </div>

                <!-- مخطط المقارنة -->
                <div class="comparison-chart">
                    <strong>💡 تذكر:</strong> 1 كم = 1000 م | 1 م = 100 سم | 1 سم = 10 مم
                </div>
            </div>

            <!-- شبكة الخيارات -->
            <div id="options-grid" class="options-grid">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- الشرح -->
            <div class="explanation" id="explanation">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- رسالة الإكمال -->
            <div id="completion-message" class="completion-message" style="display: none;">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="next-btn">سؤال تالي</button>
                <button id="hint-btn">مساعدة</button>
                <button id="reset-btn">لعبة جديدة</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">اختر الوحدة المناسبة للقياس!</div>
        </div>

        <!-- شريط التقدم -->
        <div class="progress">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // بيانات المشاكل
        const PROBLEMS = [
            {
                object: "طول قلم الرصاص",
                icon: "✏️",
                description: "أداة كتابة صغيرة الحجم",
                correct: "سم",
                options: ["مم", "سم", "م", "كم", "جم", "كجم"],
                explanation: "طول القلم يقاس عادة بالسنتيمتر (سم) لأنه مناسب للأشياء الصغيرة. القلم العادي طوله حوالي 15-20 سم."
            },
            {
                object: "وزن حبة التفاح",
                icon: "🍎",
                description: "فاكهة متوسطة الحجم",
                correct: "جم",
                options: ["مم", "سم", "لتر", "جم", "كجم", "م"],
                explanation: "وزن التفاحة يقاس بالجرام (جم) لأنه مناسب للأوزان الخفيفة. التفاحة المتوسطة تزن حوالي 150-200 جم."
            },
            {
                object: "طول طريق السفر بين مدينتين",
                icon: "🛣️",
                description: "مسافة طويلة بين موقعين",
                correct: "كم",
                options: ["م", "سم", "كم", "مم", "لتر", "جم"],
                explanation: "المسافات الطرقية بين المدن تقاس بالكيلومتر (كم) لأنها مناسبة للمسافات الكبيرة."
            },
            {
                object: "سعة خزان المياه",
                icon: "🚰",
                description: "خزان كبير لتخزين الماء",
                correct: "لتر",
                options: ["مليلتر", "لتر", "كجم", "م", "سم", "جم"],
                explanation: "سعة السوائل في الخزانات الكبيرة تقاس باللتر لأنه مناسب للحجوم الكبيرة."
            },
            {
                object: "وزن شاحنة كبيرة",
                icon: "🚛",
                description: "مركبة نقل ثقيلة",
                correct: "كجم",
                options: ["جم", "كجم", "طن", "م", "سم", "لتر"],
                explanation: "وزن الشاحنات الكبيرة يقاس بالكيلوجرام (كجم) أو الطن لأنه مناسب للأوزان الثقيلة."
            },
            {
                object: "طول غرفة الصف",
                icon: "🏫",
                description: "مساحة غرفة الدراسة",
                correct: "م",
                options: ["سم", "م", "كم", "مم", "جم", "لتر"],
                explanation: "أطوال الغرف تقاس بالمتر (م) لأنه مناسب للمسافات المتوسطة. غرفة الصف عادة طولها 8-10 أمتار."
            },
            {
                object: "كمية العصير في كوب صغير",
                icon: "🥤",
                description: "مشروب في وعاء صغير",
                correct: "مليلتر",
                options: ["مليلتر", "لتر", "كجم", "جم", "سم", "م"],
                explanation: "كميات السوائل الصغيرة تقاس بالمليلتر لأنه مناسب للحجوم الصغيرة. كوب العصير الصغير حوالي 200-300 مل."
            },
            {
                object: "طول إصبع اليد",
                icon: "👆",
                description: "أحد أصابع اليد",
                correct: "سم",
                options: ["مم", "سم", "م", "كم", "جم", "لتر"],
                explanation: "طول الإصبع يقاس بالسنتيمتر (سم) لأنه مناسب للأطوال الصغيرة. الإصبع العادي طوله 5-10 سم."
            },
            {
                object: "وزن دبوس الورق",
                icon: "📎",
                description: "أداة صغيرة لتثبيت الأوراق",
                correct: "جم",
                options: ["مم", "جم", "كجم", "سم", "م", "لتر"],
                explanation: "وزن الدبوس يقاس بالجرام (جم) لأنه خفيف جداً. الدبوس يزن حوالي 1-2 جم."
            },
            {
                object: "سمك عملة معدنية",
                icon: "🪙",
                description: "قطعة نقدية معدنية",
                correct: "مم",
                options: ["مم", "سم", "م", "كم", "جم", "كجم"],
                explanation: "سمك العملة المعدنية يقاس بالمليمتر (مم) لأنه مناسب للقياسات الدقيقة جداً."
            },
            {
                object: "ارتفاع مبنى طابقين",
                icon: "🏢",
                description: "مبنى متعدد الطوابق",
                correct: "م",
                options: ["سم", "م", "كم", "مم", "لتر", "جم"],
                explanation: "ارتفاع المباني يقاس بالمتر (م) لأنه مناسب للمسافات المتوسطة. المبنى المكون من طابقين ارتفاعه حوالي 6-8 أمتار."
            },
            {
                object: "سعة حوض السباحة",
                icon: "🏊",
                description: "مساحة مائية كبيرة للسباحة",
                correct: "لتر",
                options: ["مليلتر", "لتر", "م", "سم", "جم", "كجم"],
                explanation: "سعة أحواض السباحة تقاس باللتر لأنه مناسب للحجوم الكبيرة. حوض السباحة المنزلي سعته آلاف اللترات."
            }
        ];

        // المتغيرات الأساسية
        let currentProblem = null;
        let score = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalQuestions = 10;
        let currentQuestion = 0;
        let gameStarted = false;
        let hintsUsed = 0;

        // عناصر DOM
        const objectIconElement = document.getElementById('object-icon');
        const objectNameElement = document.getElementById('object-name');
        const objectDescriptionElement = document.getElementById('object-description');
        const optionsGridElement = document.getElementById('options-grid');
        const feedbackElement = document.getElementById('feedback');
        const nextButton = document.getElementById('next-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const scoreElement = document.getElementById('score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const progressDisplayElement = document.getElementById('progress-display');
        const progressBarElement = document.getElementById('progress-bar');
        const explanationElement = document.getElementById('explanation');
        const completionMessageElement = document.getElementById('completion-message');
        const celebrationElement = document.getElementById('celebration');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            nextButton.addEventListener('click', generateNewProblem);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', resetGame);
        }

        // بدء اللعبة
        function startGame() {
            gameStarted = true;
            generateNewProblem();
        }

        // إنشاء مسألة جديدة
        function generateNewProblem() {
            if (currentQuestion >= totalQuestions) {
                endGame();
                return;
            }

            currentQuestion++;
            updateProgress();

            // اختيار مشكلة عشوائية
            const index = Math.floor(Math.random() * PROBLEMS.length);
            currentProblem = PROBLEMS[index];

            // تحديث واجهة المستخدم
            updateQuestionDisplay();
            generateOptions();
            resetFeedback();
        }

        // تحديث عرض السؤال
        function updateQuestionDisplay() {
            objectIconElement.textContent = currentProblem.icon;
            objectNameElement.textContent = currentProblem.object;
            objectDescriptionElement.textContent = currentProblem.description;

            // إخفاء الشرح
            explanationElement.style.display = 'none';
        }

        // إنشاء الخيارات
        function generateOptions() {
            optionsGridElement.innerHTML = '';

            // خلط الخيارات
            const shuffledOptions = [...currentProblem.options].sort(() => Math.random() - 0.5);

            shuffledOptions.forEach(option => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.textContent = option;
                button.addEventListener('click', () => checkAnswer(option));
                optionsGridElement.appendChild(button);
            });

            // تفعيل الأزرار
            enableOptions(true);
        }

        // التحقق من الإجابة
        function checkAnswer(userChoice) {
            // تعطيل جميع الأزرار
            enableOptions(false);

            const isCorrect = userChoice === currentProblem.correct;
            const optionButtons = document.querySelectorAll('.option-btn');

            // تلوين الأزرار
            optionButtons.forEach(button => {
                if (button.textContent === currentProblem.correct) {
                    button.classList.add('correct');
                } else if (button.textContent === userChoice && !isCorrect) {
                    button.classList.add('incorrect');
                }
            });

            // معالجة النتيجة
            if (isCorrect) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }

            // عرض الشرح
            showExplanation();
        }

        // معالجة الإجابة الصحيحة
        function handleCorrectAnswer() {
            score += 100;
            correctAnswers++;
            currentStreak++;
            updateStats();

            feedbackElement.textContent = `🎉 ممتاز! ${currentProblem.correct} هي الوحدة الأنسب`;
            feedbackElement.className = 'feedback correct';

            // تأثير التتابع
            if (currentStreak >= 3) {
                celebrate();
            }
        }

        // معالجة الإجابة الخاطئة
        function handleIncorrectAnswer() {
            score = Math.max(0, score - 50);
            currentStreak = 0;
            updateStats();

            feedbackElement.textContent = `❌ غير صحيح! حاول التركيز على نوع القياس المطلوب`;
            feedbackElement.className = 'feedback incorrect';
        }

        // عرض الشرح
        function showExplanation() {
            explanationElement.style.display = 'block';
            explanationElement.innerHTML = `
                <div class="explanation-title">💡 شرح الإجابة:</div>
                <div class="explanation-content">${currentProblem.explanation}</div>
            `;
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

            const optionButtons = document.querySelectorAll('.option-btn');
            const wrongOptions = Array.from(optionButtons).filter(btn =>
                btn.textContent !== currentProblem.correct && !btn.classList.contains('incorrect')
            );

            if (wrongOptions.length > 0) {
                const randomWrongOption = wrongOptions[Math.floor(Math.random() * wrongOptions.length)];
                randomWrongOption.classList.add('incorrect');
                randomWrongOption.disabled = true;
            }

            feedbackElement.textContent = `💡 تلميح: استبعدت أحد الخيارات الخاطئة!`;
            feedbackElement.className = 'feedback info';
        }

        // نهاية اللعبة
        function endGame() {
            gameStarted = false;
            nextButton.disabled = true;
            hintButton.disabled = true;

            const percentage = (correctAnswers / totalQuestions) * 100;
            let message = '';

            if (percentage >= 90) {
                message = `🎊 مبروك! أنت خبير في وحدات القياس! ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 70) {
                message = `👍 أحسنت! معرفتك جيدة بوحدات القياس ${correctAnswers}/${totalQuestions}`;
            } else if (percentage >= 50) {
                message = `👌 جيد! واصل التعلم عن وحدات القياس ${correctAnswers}/${totalQuestions}`;
            } else {
                message = `📚 راجع وحدات القياس المختلفة! ${correctAnswers}/${totalQuestions}`;
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
            nextButton.disabled = false;
            hintButton.disabled = false;
            completionMessageElement.style.display = 'none';
            explanationElement.style.display = 'none';

            generateNewProblem();
        }

        // تفعيل/تعطيل الخيارات
        function enableOptions(enabled) {
            const optionButtons = document.querySelectorAll('.option-btn');
            optionButtons.forEach(button => {
                button.disabled = !enabled;
            });
        }

        // إعادة تعيين التغذية الراجعة
        function resetFeedback() {
            feedbackElement.textContent = 'اختر الوحدة المناسبة للقياس!';
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
