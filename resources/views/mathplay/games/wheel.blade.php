<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دولاب الحظ العشوائي - {{ $lesson_game->lesson->name }}</title>
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
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .wheel-container {
            position: relative;
            width: 300px;
            height: 300px;
        }

        .wheel {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(
                #ff7675, #e84393, #74b9ff, #0984e3, 
                #00b894, #00a085, #ffb300, #ff8f00
            );
            position: relative;
            transition: transform 3s cubic-bezier(0.2, 0.8, 0.3, 1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .wheel-pointer {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 40px;
            background: #333;
            clip-path: polygon(50% 100%, 0 0, 100% 0);
            z-index: 10;
        }

        .wheel-number {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            z-index: 5;
        }

        .spin-btn {
            padding: 15px 40px;
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .spin-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .spin-btn:active {
            transform: translateY(0);
        }

        .spin-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            width: 100%;
            margin-top: 20px;
        }

        .stat-item {
            background: #f1f2f6;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-item h4 {
            color: #667eea;
            margin-bottom: 5px;
        }

        .history {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 15px;
            margin-top: 20px;
            max-height: 150px;
            overflow-y: auto;
        }

        .history h4 {
            color: #0984e3;
            margin-bottom: 10px;
        }

        .history-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }

        .history-number {
            background: white;
            padding: 5px 10px;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-weight: bold;
        }

        .feedback {
            min-height: 60px;
            padding: 15px;
            border-radius: 15px;
            margin: 20px 0;
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

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .spinning {
            animation: spin 0.5s linear infinite;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            
            .wheel-container {
                width: 250px;
                height: 250px;
            }
            
            .wheel-number {
                font-size: 2.5rem;
            }
            
            .stats {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }} - دولاب الحظ العشوائي
        </div>
        
        <div class="instructions">
            <h3>🎯 كيف تلعب؟</h3>
            <p>1. انقر على زر "دوران" لتدوير دولاب الحظ</p>
            <p>2. راقب الأرقام التي تظهر وتتبع النمط</p>
            <p>3. حاول توقع الرقم الذي سيظهر في الجولة القادمة!</p>
            <p>المدى: {{ $min_range }} إلى {{ $max_range }}</p>
        </div>
        
        <div class="game-area">
            <div class="wheel-container">
                <div class="wheel" id="wheel">
                    <div class="wheel-number" id="wheel-number">?</div>
                </div>
                <div class="wheel-pointer"></div>
            </div>
            
            <button class="spin-btn" id="spin-btn">دوران 🎡</button>
            
            <div class="stats">
                <div class="stat-item">
                    <h4>المحاولات</h4>
                    <span id="attempts">0</span>
                </div>
                <div class="stat-item">
                    <h4>آخر رقم</h4>
                    <span id="last-number">-</span>
                </div>
                <div class="stat-item">
                    <h4>أعلى رقم</h4>
                    <span id="max-number">-</span>
                </div>
                <div class="stat-item">
                    <h4>أقل رقم</h4>
                    <span id="min-number">-</span>
                </div>
            </div>
            
            <div class="history">
                <h4>سجل الأرقام</h4>
                <div class="history-list" id="history-list"></div>
            </div>
        </div>
        
        <div class="feedback info" id="feedback">
            انقر على زر "دوران" لبدء اللعبة!
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
        let maxNumber = null;
        let minNumber = null;
        let numberHistory = [];
        let isSpinning = false;
        let userPrediction = null;
        
        // عناصر DOM
        const wheel = document.getElementById('wheel');
        const wheelNumber = document.getElementById('wheel-number');
        const spinBtn = document.getElementById('spin-btn');
        const attemptsEl = document.getElementById('attempts');
        const lastNumberEl = document.getElementById('last-number');
        const maxNumberEl = document.getElementById('max-number');
        const minNumberEl = document.getElementById('min-number');
        const historyList = document.getElementById('history-list');
        const feedbackEl = document.getElementById('feedback');
        const scoreEl = document.getElementById('score');
        
        // توليد رقم عشوائي
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }
        
        // تدوير الدولاب
        function spinWheel() {
            if (isSpinning) return;
            
            isSpinning = true;
            spinBtn.disabled = true;
            feedbackEl.textContent = 'الدولاب يدور...';
            feedbackEl.className = 'feedback info';
            
            // تأثير التدوير
            wheel.classList.add('spinning');
            
            // توليد الرقم بعد التأثير
            setTimeout(() => {
                const randomNumber = generateRandomNumber();
                updateGame(randomNumber);
                
                // إيقاف التأثير
                wheel.classList.remove('spinning');
                
                // تدوير الدولاب بشكل عشوائي
                const rotations = 5 + Math.random() * 5; // 5-10 دورات
                const degrees = 360 * rotations + (randomNumber / maxRange) * 360;
                wheel.style.transform = `rotate(${degrees}deg)`;
                
                isSpinning = false;
                spinBtn.disabled = false;
                
                // التحقق من التوقع بعد انتهاء التدوير
                setTimeout(() => {
                    checkPrediction(randomNumber);
                }, 500);
            }, 1000);
        }
        
        // تحديث حالة اللعبة
        function updateGame(number) {
            attempts++;
            lastNumber = number;
            numberHistory.push(number);
            
            // تحديث الأرقام القصوى
            if (maxNumber === null || number > maxNumber) {
                maxNumber = number;
            }
            if (minNumber === null || number < minNumber) {
                minNumber = number;
            }
            
            // تحديث الواجهة
            attemptsEl.textContent = attempts;
            lastNumberEl.textContent = number;
            maxNumberEl.textContent = maxNumber !== null ? maxNumber : '-';
            minNumberEl.textContent = minNumber !== null ? minNumber : '-';
            wheelNumber.textContent = number;
            
            // تحديث السجل
            updateHistory();
            
            // إضافة النقاط
            score += 5;
            scoreEl.textContent = score;
            
            // التغذية الراجعة
            feedbackEl.textContent = `ظهر الرقم: ${number}!`;
            feedbackEl.className = 'feedback success';
        }
        
        // تحديث سجل الأرقام
        function updateHistory() {
            historyList.innerHTML = '';
            numberHistory.slice(-10).forEach(num => {
                const numEl = document.createElement('div');
                numEl.className = 'history-number';
                numEl.textContent = num;
                historyList.appendChild(numEl);
            });
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
                
                // طلب توقع جديد بعد ثواني
                setTimeout(() => {
                    askForPrediction();
                }, 2000);
            } else {
                // طلب توقع بعد أول محاولة
                if (attempts === 1) {
                    setTimeout(() => {
                        askForPrediction();
                    }, 1000);
                }
            }
        }
        
        // طلب التوقع من المستخدم
        function askForPrediction() {
            userPrediction = prompt(`توقع الرقم التالي (بين ${minRange} و ${maxRange}):`);
            if (userPrediction) {
                feedbackEl.textContent = `توقعت الرقم: ${userPrediction}. انقر على "دوران" لمعرفة النتيجة!`;
                feedbackEl.className = 'feedback info';
            }
        }
        
        // إعادة تعيين اللعبة
        function resetGame() {
            score = 0;
            attempts = 0;
            lastNumber = null;
            maxNumber = null;
            minNumber = null;
            numberHistory = [];
            userPrediction = null;
            
            attemptsEl.textContent = attempts;
            lastNumberEl.textContent = '-';
            maxNumberEl.textContent = '-';
            minNumberEl.textContent = '-';
            wheelNumber.textContent = '?';
            scoreEl.textContent = score;
            historyList.innerHTML = '';
            wheel.style.transform = 'rotate(0deg)';
            
            feedbackEl.textContent = 'انقر على زر "دوران" لبدء اللعبة!';
            feedbackEl.className = 'feedback info';
        }
        
        // معالجة النقر على زر التدوير
        spinBtn.addEventListener('click', spinWheel);
        
        // إضافة زر إعادة للوحة المفاتيح
        document.addEventListener('keydown', function(e) {
            if (e.key === 'r' || e.key === 'R') {
                resetGame();
            }
        });
    </script>
</body>
</html>