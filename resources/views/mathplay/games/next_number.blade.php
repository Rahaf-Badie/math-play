<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختر الرقم التالي - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
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
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            color: #333;
            text-align: center;
        }

        h1 {
            color: #ff7f50;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .lesson-info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            padding: 10px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: white;
            font-weight: bold;
        }

        .instructions {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-size: 1.1rem;
            line-height: 1.6;
            color: #2d3436;
        }

        .game-area {
            margin: 30px 0;
        }

        .question {
            font-size: 2.2rem;
            font-weight: bold;
            color: #2d3436;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 20px 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 4px solid #ff7f50;
        }

        .options {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .option {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            color: white;
            border: 4px solid transparent;
        }

        .option:hover {
            transform: translateY(-8px) scale(1.1);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
            border-color: #ffd166;
        }

        .option.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            animation: pulse 0.5s ease-in-out;
            border-color: #00b894;
        }

        .option.wrong {
            background: linear-gradient(135deg, #ff7675, #e84393);
            animation: shake 0.5s ease-in-out;
            border-color: #ff7675;
        }

        .option:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .feedback {
            margin: 25px 0;
            font-size: 1.8rem;
            font-weight: bold;
            min-height: 70px;
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feedback.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            animation: pulse 1s infinite;
        }

        .feedback.incorrect {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        button {
            padding: 15px 35px;
            font-size: 1.3rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        #nextBtn {
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            color: white;
        }

        #resetBtn {
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            color: #073b4c;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .score {
            font-size: 1.5rem;
            margin-top: 25px;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 15px 30px;
            border-radius: 50px;
            display: inline-block;
            color: #2d3436;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-weight: bold;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
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
            .options {
                gap: 15px;
            }

            .option {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }

            .question {
                font-size: 1.8rem;
                padding: 15px 20px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>➡️ اختر الرقم التالي أو السابق</h1>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name ?? 'غير محدد' }}
        </div>

        <div class="instructions">
            <p>مرحباً! اختر الإجابة الصحيحة للرقم التالي أو السابق حسب السؤال.</p>
            <p><strong>المدى:</strong> من {{ $settings->min_range ?? 30 }} إلى {{ $settings->max_range ?? 90 }}</p>
        </div>

        <div class="game-area">
            <div class="question" id="question"></div>

            <div class="options" id="options"></div>

            <div class="feedback" id="feedback">اختر الإجابة الصحيحة</div>
        </div>

        <div class="controls">
            <button id="nextBtn">سؤال جديد</button>
            <button id="resetBtn">إعادة التعيين</button>
        </div>

        <div class="score">النقاط: <span id="score">0</span></div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // قراءة الإعدادات من Blade
            const minRange = {{ $settings->min_range ?? 30 }};
            const maxRange = {{ $settings->max_range ?? 90 }};

            const question = document.getElementById('question');
            const options = document.getElementById('options');
            const feedback = document.getElementById('feedback');
            const nextBtn = document.getElementById('nextBtn');
            const resetBtn = document.getElementById('resetBtn');
            const scoreElement = document.getElementById('score');
            const celebration = document.getElementById('celebration');

            let score = 0;
            let currentNumber = 0;
            let correctAnswer = 0;
            let mode = 'next';
            let gameActive = true;

            function generateNewQuestion() {
                gameActive = true;
                feedback.textContent = 'اختر الإجابة الصحيحة';
                feedback.className = 'feedback';
                options.innerHTML = '';

                // توليد عدد عشوائي ضمن المدى المحدد (مع ترك مسافة للرقم التالي/السابق)
                currentNumber = Math.floor(Math.random() * (maxRange - minRange - 1)) + minRange + 1;

                // اختيار عشوائي بين "التالي" أو "السابق"
                mode = Math.random() > 0.5 ? 'next' : 'prev';

                // تحديد الإجابة الصحيحة
                correctAnswer = mode === 'next' ? currentNumber + 1 : currentNumber - 1;

                // عرض السؤال
                question.textContent = mode === 'next'
                    ? `ما الرقم الذي يأتي بعد ${currentNumber}؟`
                    : `ما الرقم الذي يأتي قبل ${currentNumber}؟`;

                // إنشاء خيارات الإجابة
                let choices = [correctAnswer];

                // إضافة خيارات خاطئة
                while (choices.length < 4) {
                    let randomNum;
                    if (mode === 'next') {
                        randomNum = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    } else {
                        randomNum = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    }

                    // التأكد من أن الرقم العشوائي ليس الإجابة الصحيحة وليس مكرراً
                    if (randomNum !== correctAnswer && !choices.includes(randomNum)) {
                        choices.push(randomNum);
                    }
                }

                // خلط الخيارات
                choices.sort(() => Math.random() - 0.5);

                // إنشاء عناصر الخيارات
                choices.forEach(num => {
                    const option = document.createElement('div');
                    option.className = 'option';
                    option.textContent = num;
                    option.addEventListener('click', function() {
                        if (!gameActive) return;

                        gameActive = false;

                        if (num === correctAnswer) {
                            option.classList.add('correct');
                            feedback.textContent = '🎉 رائع! إجابة صحيحة';
                            feedback.className = 'feedback correct';
                            score += 10;
                            scoreElement.textContent = score;
                            createCelebration();
                        } else {
                            option.classList.add('wrong');
                            feedback.textContent = `❌ حاول مرة أخرى. الإجابة الصحيحة هي: ${correctAnswer}`;
                            feedback.className = 'feedback incorrect';

                            // إظهار الإجابة الصحيحة
                            const correctOption = Array.from(options.children).find(
                                opt => parseInt(opt.textContent) === correctAnswer
                            );
                            if (correctOption) {
                                correctOption.classList.add('correct');
                            }
                        }

                        // تعطيل جميع الخيارات بعد الاختيار
                        Array.from(options.children).forEach(opt => {
                            opt.style.pointerEvents = 'none';
                        });
                    });

                    options.appendChild(option);
                });
            }

            // إنشاء تأثير الاحتفال
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

            // أحداث الأزرار
            nextBtn.addEventListener('click', generateNewQuestion);

            resetBtn.addEventListener('click', function() {
                score = 0;
                scoreElement.textContent = score;
                generateNewQuestion();
            });

            // بدء اللعبة
            generateNewQuestion();
        });
    </script>
</body>
</html>
