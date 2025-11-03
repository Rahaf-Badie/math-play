<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 القيمة المنزلية - {{ $lesson_game->lesson->name ?? 'درس القيمة المنزلية' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            color: #333;
            text-align: center;
        }

        h1 {
            color: #1d3557;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .lesson-info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            padding: 12px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 1.3rem;
            color: white;
            font-weight: bold;
        }

        .instructions {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-size: 1.2rem;
            line-height: 1.6;
            color: #2d3436;
            font-weight: bold;
        }

        .game-area {
            margin: 30px 0;
        }

        .number-display {
            font-size: 3rem;
            font-weight: bold;
            color: #457b9d;
            background: linear-gradient(135deg, #f1faee, #a8dadc);
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 4px solid #457b9d;
        }

        .places-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .place-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .place-label {
            font-size: 1.3rem;
            font-weight: bold;
            color: #1d3557;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 10px 20px;
            border-radius: 15px;
            min-width: 120px;
        }

        .drop-zone {
            width: 120px;
            height: 120px;
            border: 3px dashed #457b9d;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-size: 2rem;
            font-weight: bold;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .drop-zone.active {
            border-color: #2a9d8f;
            background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
            box-shadow: 0 0 20px rgba(42, 157, 143, 0.3);
        }

        .drop-zone.correct {
            border-color: #2a9d8f;
            background: linear-gradient(135deg, #c8e6c9, #a5d6a7);
        }

        .drop-zone.incorrect {
            border-color: #e63946;
            background: linear-gradient(135deg, #ffcdd2, #ef9a9a);
        }

        .draggables-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            border-radius: 20px;
            border: 3px dashed #74b9ff;
            flex-wrap: wrap;
        }

        .draggable {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #457b9d, #1d3557);
            color: white;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: grab;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            user-select: none;
        }

        .draggable:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .draggable.dragging {
            opacity: 0.6;
            transform: scale(0.95);
        }

        .draggable.used {
            opacity: 0.4;
            cursor: not-allowed;
            transform: scale(0.9);
        }

        .feedback {
            margin: 25px 0;
            font-size: 1.5rem;
            font-weight: bold;
            min-height: 70px;
            padding: 20px;
            border-radius: 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feedback.correct {
            background: linear-gradient(135deg, #2a9d8f, #06d6a0);
            color: white;
            animation: pulse 1s infinite;
        }

        .feedback.incorrect {
            background: linear-gradient(135deg, #e63946, #ff6b6b);
            color: white;
            animation: shake 0.5s;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        .score-board {
            display: flex;
            justify-content: space-around;
            margin: 25px 0;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 20px;
            border-radius: 20px;
            font-size: 1.3rem;
            font-weight: bold;
            color: #2d3436;
        }

        .score-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .score-value {
            font-size: 2rem;
            color: #1d3557;
            margin-top: 5px;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        button {
            padding: 15px 30px;
            font-size: 1.3rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        #checkBtn {
            background: linear-gradient(135deg, #2a9d8f, #06d6a0);
            color: white;
        }

        #nextBtn {
            background: linear-gradient(135deg, #457b9d, #1d3557);
            color: white;
        }

        #restartBtn {
            background: linear-gradient(135deg, #f4a261, #e76f51);
            color: white;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
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
            width: 15px;
            height: 15px;
            background-color: #f00;
            opacity: 0.8;
            animation: fall linear forwards;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .places-container {
                flex-direction: column;
                align-items: center;
            }

            .number-display {
                font-size: 2.2rem;
                padding: 20px;
            }

            .draggable {
                width: 80px;
                height: 80px;
                font-size: 1.5rem;
            }

            .drop-zone {
                width: 100px;
                height: 100px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎮 القيمة المنزلية - سحب وإفلات</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'القيمة المنزلية ضمن 99' }}
        </div>

        <div class="instructions">
            <p>اسحب القيمة المنزلية الصحيحة لكل رقم إلى مكانه المناسب</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 10 }} إلى {{ $settings->max_range ?? 99 }}</p>
        </div>

        <div class="game-area">
            <div class="number-display" id="number-display">
                العدد: <span id="current-number">0</span>
            </div>

            <div class="places-container" id="places-container">
                <!-- سيتم توليد أماكن القيم المنزلية ديناميكياً -->
            </div>

            <div class="draggables-container" id="draggables-container">
                <!-- سيتم توليد القيم القابلة للسحب ديناميكياً -->
            </div>

            <div class="feedback" id="feedback">
                اسحب القيمة المنزلية الصحيحة لكل رقم
            </div>

            <div class="score-board">
                <div class="score-item">
                    <span>النقاط</span>
                    <div class="score-value" id="score">0</div>
                </div>
                <div class="score-item">
                    <span>السؤال</span>
                    <div class="score-value" id="round">1/10</div>
                </div>
                <div class="score-item">
                    <span>الصحيحة</span>
                    <div class="score-value" id="correct">0</div>
                </div>
            </div>
        </div>

        <div class="controls">
            <button id="checkBtn" onclick="checkAnswer()">✔ تحقق من الإجابة</button>
            <button id="nextBtn" onclick="nextQuestion()">➡️ سؤال تالي</button>
            <button id="restartBtn" onclick="restartGame()">🔁 إعادة اللعبة</button>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // قراءة الإعدادات من Blade
            const minRange = {{ $settings->min_range ?? 10 }};
            const maxRange = {{ $settings->max_range ?? 99 }};
            const totalRounds = 10;

            // عناصر DOM
            const currentNumberElement = document.getElementById('current-number');
            const placesContainer = document.getElementById('places-container');
            const draggablesContainer = document.getElementById('draggables-container');
            const feedbackElement = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const roundElement = document.getElementById('round');
            const correctElement = document.getElementById('correct');
            const checkBtn = document.getElementById('checkBtn');
            const nextBtn = document.getElementById('nextBtn');
            const celebration = document.getElementById('celebration');

            // متغيرات اللعبة
            let currentRound = 1;
            let score = 0;
            let correctAnswers = 0;
            let currentNumber = '';
            let placeValues = [];
            let correctPlacements = [];
            let userPlacements = [];

            // توليد عدد عشوائي ضمن المدى المحدد
            function generateRandomNumber() {
                return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            }

            // توليد سؤال جديد
            function generateQuestion() {
                currentNumber = generateRandomNumber().toString();
                currentNumberElement.textContent = currentNumber;

                // حساب القيم المنزلية
                placeValues = [];
                correctPlacements = [];
                userPlacements = Array(currentNumber.length).fill(null);

                for (let i = 0; i < currentNumber.length; i++) {
                    const digit = parseInt(currentNumber[i]);
                    const placeValue = digit * Math.pow(10, currentNumber.length - i - 1);
                    placeValues.push(placeValue);
                    correctPlacements.push(placeValue);
                }

                // إنشاء أماكن القيم المنزلية
                createPlaceZones();

                // إنشاء القيم القابلة للسحب
                createDraggableValues();

                // تحديث واجهة المستخدم
                feedbackElement.textContent = 'اسحب القيمة المنزلية الصحيحة لكل رقم';
                feedbackElement.className = 'feedback info';
                roundElement.textContent = `${currentRound}/${totalRounds}`;
                checkBtn.disabled = false;
                nextBtn.disabled = true;
            }

            // إنشاء أماكن القيم المنزلية
            function createPlaceZones() {
                placesContainer.innerHTML = '';

                for (let i = 0; i < currentNumber.length; i++) {
                    const placeBox = document.createElement('div');
                    placeBox.className = 'place-box';

                    const placeLabel = document.createElement('div');
                    placeLabel.className = 'place-label';
                    placeLabel.textContent = getPlaceName(i, currentNumber.length);

                    const dropZone = document.createElement('div');
                    dropZone.className = 'drop-zone';
                    dropZone.dataset.index = i;
                    dropZone.dataset.expected = placeValues[i];
                    dropZone.textContent = '?';

                    // أحداث السحب والإفلات
                    dropZone.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        this.classList.add('active');
                    });

                    dropZone.addEventListener('dragleave', function() {
                        this.classList.remove('active');
                    });

                    dropZone.addEventListener('drop', function(e) {
                        e.preventDefault();
                        this.classList.remove('active');

                        const value = parseInt(e.dataTransfer.getData('text/plain'));
                        const index = parseInt(this.dataset.index);

                        // التحقق مما إذا كانت المنطقة فارغة
                        if (userPlacements[index] === null) {
                            this.textContent = value;
                            this.classList.add('filled');
                            userPlacements[index] = value;

                            // تعطيل العنصر المسحوب
                            const draggedElement = document.querySelector(`.draggable[data-value="${value}"]:not(.used)`);
                            if (draggedElement) {
                                draggedElement.classList.add('used');
                                draggedElement.draggable = false;
                            }

                            checkCompletion();
                        }
                    });

                    placeBox.appendChild(placeLabel);
                    placeBox.appendChild(dropZone);
                    placesContainer.appendChild(placeBox);
                }
            }

            // الحصول على اسم المكان المنزلي
            function getPlaceName(index, length) {
                const places = ['آحاد', 'عشرات', 'مئات'];
                return places[length - index - 1] || `المرتبة ${index + 1}`;
            }

            // إنشاء القيم القابلة للسحب
            function createDraggableValues() {
                draggablesContainer.innerHTML = '';

                // خلط القيم بشكل عشوائي
                const shuffledValues = [...placeValues].sort(() => Math.random() - 0.5);

                // إضافة بعض القيم الخاطئة
                const wrongValues = [];
                while (wrongValues.length < 2) {
                    const wrongValue = Math.floor(Math.random() * 100);
                    if (!placeValues.includes(wrongValue) && !wrongValues.includes(wrongValue)) {
                        wrongValues.push(wrongValue);
                    }
                }

                const allValues = [...shuffledValues, ...wrongValues].sort(() => Math.random() - 0.5);

                allValues.forEach(value => {
                    const draggable = document.createElement('div');
                    draggable.className = 'draggable';
                    draggable.textContent = value;
                    draggable.dataset.value = value;
                    draggable.draggable = true;

                    draggable.addEventListener('dragstart', function(e) {
                        e.dataTransfer.setData('text/plain', value);
                        this.classList.add('dragging');
                    });

                    draggable.addEventListener('dragend', function() {
                        this.classList.remove('dragging');
                    });

                    draggablesContainer.appendChild(draggable);
                });
            }

            // التحقق من اكتمال جميع القيم
            function checkCompletion() {
                const allFilled = userPlacements.every(value => value !== null);
                if (allFilled) {
                    checkBtn.disabled = false;
                    feedbackElement.textContent = 'تم تعبئة جميع القيم! اضغط على زر التحقق';
                }
            }

            // التحقق من الإجابة
            function checkAnswer() {
                let isCorrect = true;

                for (let i = 0; i < userPlacements.length; i++) {
                    const dropZone = document.querySelector(`.drop-zone[data-index="${i}"]`);
                    if (userPlacements[i] === correctPlacements[i]) {
                        dropZone.classList.add('correct');
                        dropZone.classList.remove('incorrect');
                    } else {
                        dropZone.classList.add('incorrect');
                        dropZone.classList.remove('correct');
                        isCorrect = false;
                    }
                }

                if (isCorrect) {
                    score += 10;
                    correctAnswers++;
                    feedbackElement.textContent = '🎉 أحسنت! جميع القيم صحيحة';
                    feedbackElement.className = 'feedback correct';
                    scoreElement.textContent = score;
                    correctElement.textContent = correctAnswers;

                    // تأثير الاحتفال للإجابات المتتالية الصحيحة
                    if (correctAnswers % 3 === 0) {
                        createCelebration();
                    }
                } else {
                    feedbackElement.textContent = '❌ بعض القيم غير صحيحة، حاول مرة أخرى';
                    feedbackElement.className = 'feedback incorrect';

                    // إظهار الإجابات الصحيحة
                    setTimeout(() => {
                        for (let i = 0; i < correctPlacements.length; i++) {
                            const dropZone = document.querySelector(`.drop-zone[data-index="${i}"]`);
                            dropZone.textContent = correctPlacements[i];
                            dropZone.classList.add('correct');
                        }
                    }, 2000);
                }

                checkBtn.disabled = true;
                nextBtn.disabled = false;
            }

            // الانتقال للسؤال التالي
            function nextQuestion() {
                if (currentRound < totalRounds) {
                    currentRound++;
                    generateQuestion();
                } else {
                    endGame();
                }
            }

            // إنهاء اللعبة
            function endGame() {
                feedbackElement.textContent = `🎊 انتهت اللعبة! النقاط النهائية: ${score}`;
                feedbackElement.className = 'feedback correct';
                currentNumberElement.textContent = '🎉 تهانينا!';
                placesContainer.innerHTML = '';
                draggablesContainer.innerHTML = '';
                checkBtn.disabled = true;
                nextBtn.disabled = true;
                createCelebration();
            }

            // إعادة تشغيل اللعبة
            function restartGame() {
                currentRound = 1;
                score = 0;
                correctAnswers = 0;
                scoreElement.textContent = '0';
                correctElement.textContent = '0';
                roundElement.textContent = '1/10';
                generateQuestion();
            }

            // تأثير الاحتفال
            function createCelebration() {
                celebration.style.display = 'block';
                const colors = ['#ff6b6b', '#ffa726', '#ffeb3b', '#4caf50', '#2196f3', '#9c27b0'];

                for (let i = 0; i < 100; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    confetti.style.width = (Math.random() * 10 + 5) + 'px';
                    confetti.style.height = (Math.random() * 10 + 5) + 'px';
                    celebration.appendChild(confetti);

                    setTimeout(() => {
                        confetti.remove();
                    }, 5000);
                }

                setTimeout(() => {
                    celebration.style.display = 'none';
                    celebration.innerHTML = '';
                }, 5000);
            }

            // تهيئة اللعبة
            generateQuestion();
        });
    </script>
</body>
</html>
