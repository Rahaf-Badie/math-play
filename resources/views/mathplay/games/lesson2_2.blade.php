<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎨 لعبة اختر المربع - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tahoma", sans-serif;
            background: linear-gradient(135deg, #55efc4 0%, #81ecec 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: #2d3436;
            text-align: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 100%;
            max-width: 600px;
        }

        .lesson-info {
            background: linear-gradient(to right, #fd79a8, #e84393);
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            margin-bottom: 25px;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .game-title {
            color: #2d3436;
            font-size: 2.3rem;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .instructions {
            background: #f8f9fa;
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #fd79a8;
            text-align: right;
            line-height: 1.6;
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.1rem;
        }

        .level-indicator {
            background: linear-gradient(135deg, #fdcb6e, #e17055);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            margin: 15px 0;
            font-size: 1.1rem;
            font-weight: bold;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .game-area {
            padding: 25px;
            background: #f1f2f6;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #dfe6e9;
        }

        .target-display {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 20px 0;
            color: #fd79a8;
            padding: 15px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .shapes-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
            padding: 20px;
        }

        .shape {
            width: 140px;
            height: 140px;
            margin: 0 auto;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .shape:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .shape:active {
            transform: translateY(2px);
        }

        .shape.correct {
            animation: pulse 0.5s;
            box-shadow: 0 0 0 4px #00b894, 0 8px 16px rgba(0,0,0,0.15);
        }

        .shape.wrong {
            animation: shake 0.5s;
            box-shadow: 0 0 0 4px #e63946, 0 8px 16px rgba(0,0,0,0.15);
        }

        .shape-label {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 0.9rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .shape:hover .shape-label {
            opacity: 1;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }

        /* أنماط الأشكال */
        .square {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
        }

        .rectangle {
            background: linear-gradient(135deg, #55efc4, #00b894);
            width: 180px;
            height: 100px;
        }

        .circle {
            background: linear-gradient(135deg, #fd79a8, #e84393);
            border-radius: 50%;
        }

        .triangle {
            background: transparent;
            width: 0;
            height: 0;
            border-left: 70px solid transparent;
            border-right: 70px solid transparent;
            border-bottom: 120px solid #fdcb6e;
        }

        .diamond {
            background: linear-gradient(135deg, #a29bfe, #6c5ce7);
            transform: rotate(45deg);
            width: 100px;
            height: 100px;
            margin: 20px auto;
        }

        .diamond .shape-label {
            transform: translateX(-50%) rotate(-45deg);
        }

        .oval {
            background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
            border-radius: 50%;
            width: 160px;
            height: 100px;
        }

        #message {
            font-size: 1.4rem;
            margin: 20px 0;
            min-height: 60px;
            font-weight: bold;
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .message-success {
            background: rgba(0, 184, 148, 0.2);
            color: #00b894;
            border: 2px solid #00b894;
        }

        .message-error {
            background: rgba(230, 57, 70, 0.2);
            color: #e63946;
            border: 2px solid #e63946;
        }

        .message-info {
            background: rgba(253, 121, 168, 0.2);
            color: #fd79a8;
            border: 2px solid #fd79a8;
        }

        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0;
            background: #f1faee;
            padding: 20px;
            border-radius: 15px;
        }

        .progress-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .progress-label {
            font-size: 1rem;
            color: #457b9d;
            margin-bottom: 5px;
        }

        .progress-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1d3557;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: #dfe6e9;
            border-radius: 10px;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, #00b894, #00a085);
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .shape-info {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
        }

        .info-text {
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: right;
            color: #2d3436;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .control-btn {
            background: linear-gradient(to right, #f4a261, #e76f51);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .control-btn:active {
            transform: translateY(1px);
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
            opacity: 0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .game-title {
                font-size: 2rem;
            }

            .shapes-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .shape {
                width: 120px;
                height: 120px;
            }

            .rectangle {
                width: 150px;
                height: 80px;
            }

            .triangle {
                border-left: 60px solid transparent;
                border-right: 60px solid transparent;
                border-bottom: 100px solid #fdcb6e;
            }

            .control-btn {
                padding: 12px 20px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }} | الأشكال الهندسية
        </div>

        <h1 class="game-title">🎨 اختر المربع</h1>

        <div class="instructions">
            <p>🎯 الهدف: اختر الشكل المربع من بين الأشكال المعروضة</p>
            <p>💡 تذكر: المربع له أربعة أضلاع متساوية وأربع زوايا قائمة</p>
        </div>

        <div class="level-indicator" id="level-indicator">
            المستوى: <span id="current-level">1</span> - الأشكال الأساسية
        </div>

        <div class="game-area">
            <div class="target-display" id="target-display">
                اختر الشكل المربع
            </div>

            <div class="shapes-container" id="shapes-container">
                <!-- الأشكال ستظهر هنا -->
            </div>

            <div class="shape-info" id="shape-info">
                <h3>💡 معلومات عن المربع:</h3>
                <div class="info-text" id="info-text">
                    <!-- معلومات الشكل ستظهر هنا -->
                </div>
            </div>
        </div>

        <div class="progress-container">
            <div class="progress-item">
                <div class="progress-label">النقاط</div>
                <div class="progress-value" id="score">0</div>
            </div>
            <div class="progress-item">
                <div class="progress-label">السؤال</div>
                <div class="progress-value" id="question-count">1/10</div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill" style="width: 10%"></div>
                </div>
            </div>
            <div class="progress-item">
                <div class="progress-label">التسلسل</div>
                <div class="progress-value" id="streak">0</div>
            </div>
        </div>

        <div id="message" class="message-info">
            انقر على الشكل المربع الصحيح
        </div>

        <div class="controls">
            <button class="control-btn" id="help-btn" onclick="showHelp()">
                💡 معلومات
            </button>
            <button class="control-btn" id="start-btn" onclick="startGame()">
                🚀 ابدأ اللعبة
            </button>
            <button class="control-btn" id="restart-btn" onclick="restartGame()" style="display:none;">
                🔁 العب مرة أخرى
            </button>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let currentLevel = 1;
        let correctShapeIndex = 0;
        let gameActive = false;
        let currentStreak = 0;
        let bestStreak = 0;

        // قائمة الأشكال المتاحة حسب المستوى
        const shapeTypes = {
            1: ['square', 'rectangle', 'circle', 'triangle'],
            2: ['square', 'rectangle', 'circle', 'triangle', 'diamond'],
            3: ['square', 'rectangle', 'circle', 'triangle', 'diamond', 'oval']
        };

        // أسماء الأشكال بالعربية
        const shapeNames = {
            'square': 'مربع',
            'rectangle': 'مستطيل',
            'circle': 'دائرة',
            'triangle': 'مثلث',
            'diamond': 'معين',
            'oval': 'بيضاوي'
        };

        // معلومات عن كل شكل
        const shapeInfo = {
            'square': 'المربع: له 4 أضلاع متساوية الطول و4 زوايا قائمة (90 درجة)',
            'rectangle': 'المستطيل: له 4 أضلاع، كل ضلعين متقابلين متساويين و4 زوايا قائمة',
            'circle': 'الدائرة: شكل منحني مغلق، جميع نقاطه متساوية البعد عن المركز',
            'triangle': 'المثلث: له 3 أضلاع و3 زوايا، مجموع زواياه 180 درجة',
            'diamond': 'المعين: له 4 أضلاع متساوية، لكن زواياه ليست قائمة',
            'oval': 'الشكل البيضاوي: يشبه الدائرة لكنه ممدود'
        };

        // عناصر DOM
        const shapesContainer = document.getElementById("shapes-container");
        const targetDisplay = document.getElementById("target-display");
        const messageDisplay = document.getElementById("message");
        const scoreDisplay = document.getElementById("score");
        const questionCountDiv = document.getElementById("question-count");
        const progressFill = document.getElementById("progress-fill");
        const streakDiv = document.getElementById("streak");
        const levelIndicator = document.getElementById("level-indicator");
        const currentLevelSpan = document.getElementById("current-level");
        const helpBtn = document.getElementById("help-btn");
        const startBtn = document.getElementById("start-btn");
        const restartBtn = document.getElementById("restart-btn");
        const shapeInfoDiv = document.getElementById("shape-info");
        const infoText = document.getElementById("info-text");
        const celebrationDiv = document.getElementById("celebration");

        // بدء اللعبة
        function startGame() {
            if (gameActive) return;

            gameActive = true;
            score = 0;
            questionCount = 0;
            currentLevel = 1;
            currentStreak = 0;

            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;
            updateProgress();
            updateLevelIndicator();

            startBtn.style.display = 'none';
            restartBtn.style.display = 'none';
            helpBtn.style.display = 'inline-block';

            generateQuestion();
        }

        // توليد سؤال جديد
        function generateQuestion() {
            shapesContainer.innerHTML = '';
            shapeInfoDiv.style.display = 'none';

            // الحصول على الأشكال المتاحة للمستوى الحالي
            const availableShapes = [...shapeTypes[currentLevel]];

            // اختيار شكل عشوائي ليكون المربع (الإجابة الصحيحة)
            correctShapeIndex = Math.floor(Math.random() * availableShapes.length);

            // عرض الأشكال
            availableShapes.forEach((shapeType, index) => {
                const shapeDiv = document.createElement("div");
                shapeDiv.className = `shape ${shapeType}`;
                shapeDiv.dataset.shapeType = shapeType;

                const label = document.createElement("div");
                label.className = "shape-label";
                label.textContent = shapeNames[shapeType];

                shapeDiv.appendChild(label);
                shapeDiv.onclick = () => checkAnswer(index === correctShapeIndex, shapeDiv, shapeType);

                shapesContainer.appendChild(shapeDiv);
            });

            targetDisplay.textContent = `اختر الشكل ${shapeNames[availableShapes[correctShapeIndex]]}`;

            messageDisplay.textContent = "انقر على الشكل الصحيح";
            messageDisplay.className = "message-info";

            questionCount++;
            updateProgress();
        }

        // التحقق من الإجابة
        function checkAnswer(isCorrect, shapeElement, shapeType) {
            if (!gameActive) return;

            // تعطيل جميع الأشكال
            document.querySelectorAll('.shape').forEach(shape => {
                shape.style.pointerEvents = 'none';
            });

            if (isCorrect) {
                // الإجابة صحيحة
                shapeElement.classList.add('correct');
                score += 10;
                currentStreak++;
                bestStreak = Math.max(bestStreak, currentStreak);

                messageDisplay.textContent = getRandomSuccessMessage();
                messageDisplay.className = "message-success";

                // مكافأة التسلسل
                if (currentStreak >= 3) {
                    const streakBonus = currentStreak * 2;
                    score += streakBonus;
                    messageDisplay.textContent += ` 🎯 تسلسل ${currentStreak}! +${streakBonus} نقاط`;
                }

                // زيادة المستوى كل 4 أسئلة صحيحة
                if (questionCount % 4 === 0 && currentLevel < 3) {
                    currentLevel++;
                    updateLevelIndicator();
                }
            } else {
                // الإجابة خاطئة
                shapeElement.classList.add('wrong');
                currentStreak = 0;

                // إظهار الشكل الصحيح
                document.querySelectorAll('.shape')[correctShapeIndex].classList.add('correct');

                messageDisplay.textContent = `خطأ! هذا الشكل هو ${shapeNames[shapeType]} وليس ${shapeNames[document.querySelectorAll('.shape')[correctShapeIndex].dataset.shapeType]} 😅`;
                messageDisplay.className = "message-error";
            }

            // تحديث النقاط والتسلسل
            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;

            if (questionCount < totalQuestions) {
                setTimeout(generateQuestion, 2000);
            } else {
                setTimeout(() => endGame(true), 2000);
            }
        }

        // رسائل نجاح عشوائية
        function getRandomSuccessMessage() {
            const messages = [
                "أحسنت! 👏",
                "إجابة صحيحة! 🌟",
                "ممتاز! 🎯",
                "رائع! 💫",
                "برافو! ✅"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // عرض المعلومات
        function showHelp() {
            if (!gameActive) return;

            const correctShapeType = document.querySelectorAll('.shape')[correctShapeIndex].dataset.shapeType;
            infoText.textContent = shapeInfo[correctShapeType];
            shapeInfoDiv.style.display = "block";
        }

        // تحديث مؤشر المستوى
        function updateLevelIndicator() {
            currentLevelSpan.textContent = currentLevel;

            let levelText = '';
            switch(currentLevel) {
                case 1: levelText = 'الأشكال الأساسية'; break;
                case 2: levelText = 'أشكال متوسطة'; break;
                case 3: levelText = 'جميع الأشكال'; break;
            }

            levelIndicator.textContent = `المستوى: ${currentLevel} - ${levelText}`;
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (questionCount / totalQuestions) * 100;
            progressFill.style.width = `${progress}%`;
            questionCountDiv.textContent = `${questionCount}/${totalQuestions}`;
        }

        // إنهاء اللعبة
        function endGame(isComplete) {
            gameActive = false;

            if (isComplete) {
                messageDisplay.innerHTML = `🎉 تهانينا! أكملت جميع الأسئلة بنجاح!<br>مجموع نقاطك: ${score} | أفضل تسلسل: ${bestStreak} 🌟`;
                messageDisplay.className = "message-success";
                createConfetti();
            }

            helpBtn.style.display = 'none';
            restartBtn.style.display = 'inline-block';
        }

        // إعادة تشغيل اللعبة
        function restartGame() {
            shapesContainer.innerHTML = '';
            shapeInfoDiv.style.display = 'none';
            celebrationDiv.style.display = 'none';
            celebrationDiv.innerHTML = '';
            startGame();
        }

        // تأثير احتفالي
        function createConfetti() {
            celebrationDiv.style.display = 'block';
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#fd79a8'];

            for (let i = 0; i < 150; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.opacity = Math.random();
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                celebrationDiv.appendChild(confetti);

                const animation = confetti.animate([
                    { transform: 'translateY(-100px) rotate(0deg)', opacity: 1 },
                    { transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 720}deg)`, opacity: 0 }
                ], {
                    duration: 2000 + Math.random() * 3000,
                    easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
                });

                animation.onfinish = () => {
                    confetti.remove();
                };
            }
        }
    </script>
</body>
</html>
