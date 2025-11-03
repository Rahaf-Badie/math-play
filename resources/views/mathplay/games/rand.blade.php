<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صندوق المفاجآت العشوائي - {{ $lesson_game->lesson->name }}</title>
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
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        .lesson-info {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .instructions {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #74b9ff;
        }

        .instructions h3 {
            color: #0984e3;
            margin-bottom: 10px;
        }

        .instructions p {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .game-area {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 25px;
        }

        .mystery-box {
            width: 200px;
            height: 200px;
            margin: 0 auto;
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .mystery-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .mystery-box:active {
            transform: scale(0.95);
        }

        .box-label {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.3);
            padding: 5px 10px;
            border-radius: 10px;
        }

        .results {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .result-item {
            background: #f1f2f6;
            padding: 15px;
            border-radius: 15px;
            min-width: 120px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .result-item h4 {
            color: #667eea;
            margin-bottom: 5px;
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
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .feedback {
            min-height: 60px;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .error {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .score-board {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #667eea;
        }

        .hidden {
            display: none;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .celebrate {
            animation: celebrate 0.5s ease 3;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            
            .mystery-box {
                width: 150px;
                height: 150px;
                font-size: 2rem;
            }
            
            .controls {
                flex-direction: column;
            }
            
            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }} - التجربة العشوائية
        </div>
        
        <div class="instructions">
            <h3>🎲 كيف تلعب؟</h3>
            <p>1. انقر على صندوق المفاجآت لاكتشاف الرقم العشوائي</p>
            <p>2. راقب النتائج في الجدول أدناه</p>
            <p>3. حاول توقع الرقم التالي!</p>
            <p>المدى: {{ $min_range }} إلى {{ $max_range }}</p>
        </div>
        
        <div class="game-area">
            <div class="mystery-box" id="mystery-box">
                <div class="box-label">انقر هنا</div>
                <span id="box-number">?</span>
            </div>
            
            <div class="results">
                <div class="result-item">
                    <h4>المحاولات</h4>
                    <span id="attempts">0</span>
                </div>
                <div class="result-item">
                    <h4>آخر رقم</h4>
                    <span id="last-number">-</span>
                </div>
                <div class="result-item">
                    <h4>الأرقام الفردية</h4>
                    <span id="odd-count">0</span>
                </div>
                <div class="result-item">
                    <h4>الأرقام الزوجية</h4>
                    <span id="even-count">0</span>
                </div>
            </div>
        </div>
        
        <div class="controls">
            <button id="check-btn">تحقق من التوقع</button>
            <button id="reset-btn">إعادة البدء</button>
        </div>
        
        <div class="feedback info" id="feedback">
            انقر على صندوق المفاجآت لبدء اللعبة!
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span>
        </div>
    </div>

    <script>
        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // حالة اللعبة
        let score = 0;
        let attempts = 0;
        let lastNumber = null;
        let oddCount = 0;
        let evenCount = 0;
        let userPrediction = null;
        
        // عناصر DOM
        const mysteryBox = document.getElementById('mystery-box');
        const boxNumber = document.getElementById('box-number');
        const attemptsEl = document.getElementById('attempts');
        const lastNumberEl = document.getElementById('last-number');
        const oddCountEl = document.getElementById('odd-count');
        const evenCountEl = document.getElementById('even-count');
        const feedbackEl = document.getElementById('feedback');
        const scoreEl = document.getElementById('score');
        const checkBtn = document.getElementById('check-btn');
        const resetBtn = document.getElementById('reset-btn');
        
        // توليد رقم عشوائي
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }
        
        // تحديث النتائج
        function updateResults(number) {
            attempts++;
            lastNumber = number;
            
            // تحديث العدادات
            if (number % 2 === 0) {
                evenCount++;
            } else {
                oddCount++;
            }
            
            // تحديث الواجهة
            attemptsEl.textContent = attempts;
            lastNumberEl.textContent = number;
            oddCountEl.textContent = oddCount;
            evenCountEl.textContent = evenCount;
            
            // إضافة النقاط
            score += 5;
            scoreEl.textContent = score;
            
            // عرض الرقم مع تأثير
            boxNumber.textContent = number;
            mysteryBox.classList.add('celebrate');
            setTimeout(() => {
                mysteryBox.classList.remove('celebrate');
            }, 1500);
            
            // تحديث التغذية الراجعة
            feedbackEl.textContent = `مبروك! الرقم الذي ظهر هو: ${number}`;
            feedbackEl.className = 'feedback success';
            
            // السماح للمستخدم بالتوقع للجولة القادمة
            setTimeout(() => {
                userPrediction = prompt(`توقع الرقم التالي (بين ${minRange} و ${maxRange}):`);
                if (userPrediction) {
                    feedbackEl.textContent = `توقعت الرقم: ${userPrediction}. انقر على الصندوق لمعرفة النتيجة!`;
                    feedbackEl.className = 'feedback info';
                }
            }, 1000);
        }
        
        // إعادة تعيين اللعبة
        function resetGame() {
            score = 0;
            attempts = 0;
            lastNumber = null;
            oddCount = 0;
            evenCount = 0;
            userPrediction = null;
            
            attemptsEl.textContent = attempts;
            lastNumberEl.textContent = '-';
            oddCountEl.textContent = oddCount;
            evenCountEl.textContent = evenCount;
            scoreEl.textContent = score;
            boxNumber.textContent = '?';
            
            feedbackEl.textContent = 'انقر على صندوق المفاجآت لبدء اللعبة!';
            feedbackEl.className = 'feedback info';
        }
        
        // التحقق من التوقع
        function checkPrediction(number) {
            if (userPrediction !== null) {
                if (parseInt(userPrediction) === number) {
                    score += 20; // مكافأة للتوقع الصحيح
                    scoreEl.textContent = score;
                    feedbackEl.textContent = `تهانينا! توقعت الرقم بشكل صحيح! +20 نقطة`;
                    feedbackEl.className = 'feedback success';
                } else {
                    feedbackEl.textContent = `للأسف! توقعت ${userPrediction} ولكن الرقم كان ${number}. حاول مرة أخرى!`;
                    feedbackEl.className = 'feedback error';
                }
                userPrediction = null;
            }
        }
        
        // معالجة النقر على الصندوق
        mysteryBox.addEventListener('click', function() {
            const randomNumber = generateRandomNumber();
            updateResults(randomNumber);
            checkPrediction(randomNumber);
        });
        
        // معالجة زر التحقق
        checkBtn.addEventListener('click', function() {
            if (lastNumber !== null) {
                userPrediction = prompt(`توقع الرقم التالي (بين ${minRange} و ${maxRange}):`);
                if (userPrediction) {
                    feedbackEl.textContent = `توقعت الرقم: ${userPrediction}. انقر على الصندوق لمعرفة النتيجة!`;
                    feedbackEl.className = 'feedback info';
                }
            } else {
                feedbackEl.textContent = 'يجب أن تبدأ بالضغط على الصندوق أولاً!';
                feedbackEl.className = 'feedback error';
            }
        });
        
        // معالجة زر الإعادة
        resetBtn.addEventListener('click', resetGame);
    </script>
</body>
</html>