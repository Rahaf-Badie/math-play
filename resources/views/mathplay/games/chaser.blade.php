<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مطاردة الأعداد العملاقة - {{ $lesson_game->lesson->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            direction: rtl;
            text-align: center;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 800px;
            border: 3px solid #e74c3c;
        }

        .lesson-info {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        h1 {
            color: #e74c3c;
            margin-bottom: 15px;
            border-bottom: 3px solid #e74c3c;
            padding-bottom: 10px;
        }

        .instructions {
            background: linear-gradient(135deg, #fdf5f5 0%, #f9e3e3 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #e74c3c;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #fff0f0 0%, #ffe0e0 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #e74c3c;
        }

        .number-display {
            font-size: 3em;
            font-weight: bold;
            color: #2c3e50;
            margin: 25px 0;
            padding: 25px;
            background: white;
            border-radius: 15px;
            border: 4px solid #3498db;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            font-family: 'Courier New', monospace;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .option-btn {
            padding: 20px;
            font-size: 1.4em;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .option-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            animation: celebrate 0.6s ease;
        }

        .option-btn.incorrect {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.4em;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.5em;
            color: #e74c3c;
            font-weight: bold;
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 30px;
            font-size: 1.2em;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        #next-btn {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .number-info {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            font-size: 1.1em;
        }

        @media (max-width: 768px) {
            .options-grid {
                grid-template-columns: 1fr;
            }

            .number-display {
                font-size: 2.2em;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>🦖 مطاردة الأعداد العملاقة</h1>

        <div class="instructions">
            <p>🔢 تعرف على الأعداد الكبيرة وتمييز قيمها</p>
            <p>🎯 اختر العدد الأكبر أو الأصغر حسب المطلوب</p>
        </div>

        <div class="game-area">
            <div class="number-info" id="question-text">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="number-display" id="number-display">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="options-grid" id="options-grid">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="feedback" id="feedback">
                ابدأ باللعبة واختر الإجابة الصحيحة!
            </div>

            <div class="controls">
                <button id="next-btn">➡️ سؤال تالي</button>
            </div>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>الإجابات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript للعبة مطاردة الأعداد العملاقة ===
        const minRange = {{ $min_range ?? 100000 }};
        const maxRange = {{ $max_range ?? 999999999 }};

        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let currentQuestionType = '';
        let correctAnswer = '';

        function formatNumber(num) {
            return new Intl.NumberFormat('ar-EG').format(num);
        }

        function generateLargeNumber() {
            // توليد أعداد ضمن المدى المحدد
            const isSmallRange = Math.random() < 0.5;
            const range = isSmallRange ?
                { min: 100000, max: 999999 } :
                { min: 1000000, max: 999999999 };

            return Math.floor(Math.random() * (range.max - range.min + 1)) + range.min;
        }

        function createQuestion() {
            currentQuestionType = Math.random() < 0.5 ? 'largest' : 'smallest';
            const numbers = [];

            // توليد 4 أعداد مختلفة
            for (let i = 0; i < 4; i++) {
                let num;
                do {
                    num = generateLargeNumber();
                } while (numbers.includes(num));
                numbers.push(num);
            }

            // تحديد الإجابة الصحيحة
            correctAnswer = currentQuestionType === 'largest' ?
                Math.max(...numbers) : Math.min(...numbers);

            // تحديث واجهة المستخدم
            document.getElementById('question-text').textContent =
                currentQuestionType === 'largest' ?
                'اختر العدد الأكبر:' : 'اختر العدد الأصغر:';

            // عرض الأعداد كخيارات
            const optionsGrid = document.getElementById('options-grid');
            optionsGrid.innerHTML = '';

            numbers.sort(() => Math.random() - 0.5).forEach(num => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.textContent = formatNumber(num);
                button.onclick = () => checkAnswer(num, button);
                optionsGrid.appendChild(button);
            });

            document.getElementById('feedback').textContent = 'اختر الإجابة الصحيحة!';
            document.getElementById('feedback').style.background = '#f8f9fa';
        }

        function checkAnswer(selectedNumber, button) {
            totalQuestions++;
            const isCorrect = selectedNumber === correctAnswer;

            // تعطيل جميع الأزرار
            document.querySelectorAll('.option-btn').forEach(btn => {
                btn.disabled = true;
                if (parseInt(btn.textContent.replace(/,/g, '')) === correctAnswer) {
                    btn.classList.add('correct');
                }
            });

            if (isCorrect) {
                button.classList.add('correct');
                document.getElementById('feedback').innerHTML =
                    `🎉 صحيح! ${formatNumber(correctAnswer)} هو العدد ${currentQuestionType === 'largest' ? 'الأكبر' : 'الأصغر'}`;
                document.getElementById('feedback').style.background = '#d4edda';
                score += 10;
                correctAnswers++;
            } else {
                button.classList.add('incorrect');
                document.getElementById('feedback').innerHTML =
                    `❌ خطأ! العدد ${currentQuestionType === 'largest' ? 'الأكبر' : 'الأصغر'} هو ${formatNumber(correctAnswer)}`;
                document.getElementById('feedback').style.background = '#f8d7da';
                score = Math.max(0, score - 5);
            }

            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
        }

        document.getElementById('next-btn').addEventListener('click', createQuestion);

        // بدء اللعبة
        createQuestion();
    </script>
</body>
</html>
