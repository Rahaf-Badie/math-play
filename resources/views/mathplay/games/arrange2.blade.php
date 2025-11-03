<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔢 ترتيب الأعداد - {{ $lesson_game->lesson->name ?? 'ترتيب الأعداد ضمن 999' }}</title>
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
            max-width: 900px;
            width: 100%;
            color: #333;
            text-align: center;
        }

        h1 {
            color: #4a6fa5;
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

        .order-type {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e91e63;
            margin: 20px 0;
            padding: 15px;
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            border-radius: 15px;
            border: 3px solid #e91e63;
            animation: pulse 2s infinite;
        }

        .numbers-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #bbdefb, #90caf9);
            border-radius: 20px;
            border: 3px solid #4a6fa5;
            min-height: 120px;
            flex-wrap: wrap;
        }

        .number-box {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #4a6fa5, #3a5a80);
            color: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: bold;
            cursor: grab;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            user-select: none;
            position: relative;
        }

        .number-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .number-box:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .number-box.dragging {
            opacity: 0.7;
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .drop-zone {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 20px;
            border: 3px dashed #90caf9;
            min-height: 150px;
            flex-wrap: wrap;
            transition: all 0.3s ease;
        }

        .drop-zone.active {
            border-color: #4a6fa5;
            background: linear-gradient(135deg, #c8e6c9, #a5d6a7);
            box-shadow: 0 0 20px rgba(76, 175, 80, 0.3);
        }

        .drop-slot {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 3px dashed #90caf9;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #999;
            font-weight: bold;
            transition: all 0.3s ease;
            position: relative;
        }

        .drop-slot::before {
            content: attr(data-position);
            position: absolute;
            top: -25px;
            font-size: 1rem;
            color: #4a6fa5;
            font-weight: bold;
        }

        .drop-slot.filled {
            border: 3px solid #4caf50;
            background: linear-gradient(135deg, #c8e6c9, #a5d6a7);
            color: #2e7d32;
        }

        .drop-slot.drag-over {
            border-color: #4a6fa5;
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            transform: scale(1.05);
        }

        .feedback {
            margin: 30px 0;
            font-size: 1.8rem;
            font-weight: bold;
            min-height: 80px;
            padding: 25px;
            border-radius: 20px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feedback.correct {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
            animation: celebrate 0.5s ease-in-out;
        }

        .feedback.incorrect {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
            animation: shake 0.5s ease-in-out;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        .score-board {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 25px;
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
            font-size: 2.2rem;
            color: #4a6fa5;
            margin-top: 5px;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
        }

        button {
            padding: 15px 35px;
            font-size: 1.3rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        #checkBtn {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
        }

        #nextBtn {
            background: linear-gradient(135deg, #4a6fa5, #3a5a80);
            color: white;
        }

        #restartBtn {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        @keyframes celebrate {
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

        .progress-container {
            margin: 20px 0;
        }

        .progress-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2d3436;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .numbers-container, .drop-zone {
                gap: 10px;
            }

            .number-box, .drop-slot {
                width: 80px;
                height: 80px;
                font-size: 1.8rem;
            }

            .order-type {
                font-size: 1.4rem;
                padding: 10px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔢 ترتيب الأعداد</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'ترتيب الأعداد ضمن 999' }}
        </div>

        <div class="instructions">
            <p>اسحب الأعداد ورتبها في الخانات حسب التعليمات!</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 1 }} إلى {{ $settings->max_range ?? 999 }}</p>
        </div>

        <div class="game-area">
            <div class="order-type" id="order-type">
                جاري التحميل...
            </div>

            <div class="numbers-container" id="numbers-container">
                <!-- سيتم توليد الأعداد القابلة للسحب هنا -->
            </div>

            <div class="drop-zone" id="drop-zone">
                <!-- سيتم توليد الخانات الفارغة هنا -->
            </div>

            <div class="feedback" id="feedback">
                اسحب الأعداد إلى الخانات بالترتيب الصحيح
            </div>

            <div class="progress-container">
                <div class="progress-text" id="progress-text">السؤال 1 من 10</div>
            </div>

            <div class="score-board">
                <div class="score-item">
                    <span>النقاط</span>
                    <div class="score-value" id="score">0</div>
                </div>
                <div class="score-item">
                    <span>الإجابات الصحيحة</span>
                    <div class="score-value" id="correct">0</div>
                </div>
                <div class="score-item">
                    <span>التتابع الحالي</span>
                    <div class="score-value" id="streak">0</div>
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
            const minRange = {{ $settings->min_range ?? 1 }};
            const maxRange = {{ $settings->max_range ?? 999 }};
            const totalRounds = 10;

            // عناصر DOM
            const numbersContainer = document.getElementById('numbers-container');
            const dropZone = document.getElementById('drop-zone');
            const feedbackElement = document.getElementById('feedback');
            const orderTypeElement = document.getElementById('order-type');
            const scoreElement = document.getElementById('score');
            const correctElement = document.getElementById('correct');
            const streakElement = document.getElementById('streak');
            const progressText = document.getElementById('progress-text');
            const nextBtn = document.getElementById('nextBtn');
            const celebration = document.getElementById('celebration');

            // متغيرات اللعبة
            let currentRound = 1;
            let score = 0;
            let correctAnswers = 0;
            let currentStreak = 0;
            let bestStreak = 0;
            let currentNumbers = [];
            let correctOrder = [];
            let isAscending = true;
            let userOrder = [];

            // توليد أعداد عشوائية فريدة ضمن المدى المحدد
            function generateUniqueNumbers(count) {
                const numbers = new Set();
                while (numbers.size < count) {
                    const num = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    numbers.add(num);
                }
                return Array.from(numbers);
            }

            // توليد سؤال جديد
            function generateQuestion() {
                // مسح المحتوى السابق
                numbersContainer.innerHTML = '';
                dropZone.innerHTML = '';
                feedbackElement.textContent = 'اسحب الأعداد إلى الخانات بالترتيب الصحيح';
                feedbackElement.className = 'feedback info';

                // تحديد نوع الترتيب (تصاعدي أو تنازلي)
                isAscending = Math.random() > 0.5;
                orderTypeElement.textContent = isAscending ?
                    '📈 رتب الأعداد من الأصغر إلى الأكبر' :
                    '📉 رتب الأعداد من الأكبر إلى الأصغر';

                // توليد 4-5 أعداد عشوائية فريدة
                const numberCount = Math.floor(Math.random() * 2) + 4; // 4 أو 5 أعداد
                currentNumbers = generateUniqueNumbers(numberCount);

                // إنشاء الترتيب الصحيح
                correctOrder = [...currentNumbers];
                if (isAscending) {
                    correctOrder.sort((a, b) => a - b);
                } else {
                    correctOrder.sort((a, b) => b - a);
                }

                // إعادة تعيين ترتيب المستخدم
                userOrder = Array(numberCount).fill(null);

                // إنشاء الأعداد القابلة للسحب (مخلوطة)
                const shuffledNumbers = [...currentNumbers].sort(() => Math.random() - 0.5);
                shuffledNumbers.forEach((num, index) => {
                    const numberElement = document.createElement('div');
                    numberElement.className = 'number-box';
                    numberElement.textContent = num;
                    numberElement.draggable = true;
                    numberElement.dataset.value = num;
                    numberElement.dataset.index = index;

                    numberElement.addEventListener('dragstart', handleDragStart);
                    numberElement.addEventListener('dragend', handleDragEnd);

                    numbersContainer.appendChild(numberElement);
                });

                // إنشاء الخانات الفارغة
                for (let i = 0; i < numberCount; i++) {
                    const slot = document.createElement('div');
                    slot.className = 'drop-slot';
                    slot.dataset.index = i;
                    slot.dataset.position = `المرتبة ${i + 1}`;
                    slot.textContent = '?';

                    slot.addEventListener('dragover', handleDragOver);
                    slot.addEventListener('dragenter', handleDragEnter);
                    slot.addEventListener('dragleave', handleDragLeave);
                    slot.addEventListener('drop', handleDrop);

                    dropZone.appendChild(slot);
                }

                // تحديث واجهة المستخدم
                progressText.textContent = `السؤال ${currentRound} من ${totalRounds}`;
                nextBtn.disabled = true;
            }

            // معالجات أحداث السحب والإفلات
            function handleDragStart(e) {
                e.dataTransfer.setData('text/plain', e.target.dataset.value);
                setTimeout(() => {
                    e.target.classList.add('dragging');
                }, 0);
            }

            function handleDragEnd(e) {
                e.target.classList.remove('dragging');
            }

            function handleDragOver(e) {
                e.preventDefault();
            }

            function handleDragEnter(e) {
                e.preventDefault();
                e.target.classList.add('drag-over');
                dropZone.classList.add('active');
            }

            function handleDragLeave(e) {
                e.target.classList.remove('drag-over');
                if (!dropZone.querySelector('.drag-over')) {
                    dropZone.classList.remove('active');
                }
            }

            function handleDrop(e) {
                e.preventDefault();
                e.target.classList.remove('drag-over');
                dropZone.classList.remove('active');

                const slotIndex = parseInt(e.target.dataset.index);
                const numberValue = parseInt(e.dataTransfer.getData('text/plain'));

                // إذا كانت الخانة تحتوي بالفعل على عدد، إرجاعه إلى مكانه
                if (userOrder[slotIndex] !== null) {
                    returnNumberToContainer(userOrder[slotIndex]);
                }

                // وضع العدد الجديد في الخانة
                e.target.textContent = numberValue;
                e.target.classList.add('filled');
                userOrder[slotIndex] = numberValue;

                // إزالة العدد من الحاوية الأصلية
                const numberElement = document.querySelector(`.number-box[data-value="${numberValue}"]`);
                if (numberElement) {
                    numberElement.style.visibility = 'hidden';
                }

                checkCompletion();
            }

            // إرجاع عدد إلى الحاوية الأصلية
            function returnNumberToContainer(numberValue) {
                const numberElement = document.querySelector(`.number-box[data-value="${numberValue}"]`);
                if (numberElement) {
                    numberElement.style.visibility = 'visible';
                }

                // إزالة العدد من ترتيب المستخدم
                const slotIndex = userOrder.indexOf(numberValue);
                if (slotIndex !== -1) {
                    userOrder[slotIndex] = null;
                    const slot = document.querySelector(`.drop-slot[data-index="${slotIndex}"]`);
                    if (slot) {
                        slot.textContent = '?';
                        slot.classList.remove('filled');
                    }
                }
            }

            // التحقق من اكتمال جميع الخانات
            function checkCompletion() {
                const allFilled = userOrder.every(num => num !== null);
                if (allFilled) {
                    feedbackElement.textContent = 'تم تعبئة جميع الخانات! اضغط على زر التحقق';
                }
            }

            // التحقق من الإجابة
            function checkAnswer() {
                const allFilled = userOrder.every(num => num !== null);
                if (!allFilled) {
                    feedbackElement.textContent = 'يرجى وضع جميع الأعداد في الخانات أولاً!';
                    feedbackElement.className = 'feedback incorrect';
                    return;
                }

                let isCorrect = true;
                for (let i = 0; i < userOrder.length; i++) {
                    if (userOrder[i] !== correctOrder[i]) {
                        isCorrect = false;
                        break;
                    }
                }

                if (isCorrect) {
                    score += 10;
                    correctAnswers++;
                    currentStreak++;

                    if (currentStreak > bestStreak) {
                        bestStreak = currentStreak;
                    }

                    feedbackElement.textContent = '🎉 أحسنت! الترتيب صحيح تماماً';
                    feedbackElement.className = 'feedback correct';

                    // تحديث النقاط والمؤشرات
                    scoreElement.textContent = score;
                    correctElement.textContent = correctAnswers;
                    streakElement.textContent = currentStreak;

                    // تأثير احتفال للتتابعات العالية
                    if (currentStreak >= 3) {
                        createCelebration();
                    }

                    // تلوين الخانات باللون الأخضر
                    const slots = document.querySelectorAll('.drop-slot');
                    slots.forEach(slot => {
                        slot.style.borderColor = '#4caf50';
                        slot.style.background = 'linear-gradient(135deg, #c8e6c9, #a5d6a7)';
                    });
                } else {
                    feedbackElement.textContent = '❌ ليس صحيحاً! حاول مرة أخرى';
                    feedbackElement.className = 'feedback incorrect';
                    currentStreak = 0;
                    streakElement.textContent = '0';

                    // تلوين الخانات باللون الأحمر وإظهار الإجابة الصحيحة
                    const slots = document.querySelectorAll('.drop-slot');
                    slots.forEach((slot, index) => {
                        if (userOrder[index] !== correctOrder[index]) {
                            slot.style.borderColor = '#f44336';
                            slot.style.background = 'linear-gradient(135deg, #ffcdd2, #ef9a9a)';
                        } else {
                            slot.style.borderColor = '#4caf50';
                            slot.style.background = 'linear-gradient(135deg, #c8e6c9, #a5d6a7)';
                        }
                    });

                    // إظهار الإجابة الصحيحة بعد ثانيتين
                    setTimeout(() => {
                        slots.forEach((slot, index) => {
                            slot.textContent = correctOrder[index];
                            slot.style.borderColor = '#4caf50';
                            slot.style.background = 'linear-gradient(135deg, #c8e6c9, #a5d6a7)';
                        });

                        // إرجاع جميع الأعداد إلى مكانها الأصلي
                        document.querySelectorAll('.number-box').forEach(box => {
                            box.style.visibility = 'visible';
                        });
                    }, 2000);
                }

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
                feedbackElement.innerHTML = `
                    🎊 انتهت اللعبة!<br>
                    <strong>النقاط النهائية: ${score}</strong>
                `;
                feedbackElement.className = 'feedback correct';
                orderTypeElement.textContent = '🎉 تهانينا! أكملت جميع الأسئلة';
                numbersContainer.innerHTML = '';
                dropZone.innerHTML = '';
                nextBtn.disabled = true;

                createCelebration();
            }

            // إعادة تشغيل اللعبة
            function restartGame() {
                currentRound = 1;
                score = 0;
                correctAnswers = 0;
                currentStreak = 0;
                scoreElement.textContent = '0';
                correctElement.textContent = '0';
                streakElement.textContent = '0';
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

            // جعل الدوال متاحة عالمياً
            window.checkAnswer = checkAnswer;
            window.nextQuestion = nextQuestion;
            window.restartGame = restartGame;

            // تهيئة اللعبة
            generateQuestion();
        });
    </script>
</body>
</html>
