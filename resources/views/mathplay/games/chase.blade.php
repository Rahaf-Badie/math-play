<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مطاردة المضاعفات - {{ $lesson_game->lesson->name }}</title>
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
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.4rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .chase-arena {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .game-board {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hunter-controls {
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

        .game-board .panel-title {
            color: white;
        }

        #chase-canvas {
            background: white;
            border-radius: 15px;
            display: block;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .target-number {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }

        .target-display {
            font-size: 3rem;
            font-weight: bold;
            color: #e84393;
            margin: 10px 0;
        }

        .target-label {
            font-size: 1.2rem;
            color: #636e72;
        }

        .number-stream {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin: 25px 0;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
        }

        .stream-number {
            background: white;
            border: 3px solid #a29bfe;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #2d3436;
        }

        .stream-number:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .stream-number.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            border-color: #00b894;
        }

        .stream-number.wrong {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
            border-color: #ff7675;
        }

        .stream-number.caught {
            animation: celebrate 0.5s ease-in-out;
        }

        .chase-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .chase-stat {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .chase-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .chase-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .chase-controls {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 25px 0;
        }

        .chase-btn {
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

        #start-chase-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #next-round-btn {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .chase-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .chase-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .chase-feedback {
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

        .chase-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .chase-fail {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .chase-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
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

        .round-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .multiples-list {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            max-height: 150px;
            overflow-y: auto;
        }

        .multiples-title {
            text-align: center;
            font-weight: bold;
            color: #e84393;
            margin-bottom: 10px;
        }

        .multiples-items {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }

        .multiple-item {
            background: #74b9ff;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .multiple-item.found {
            background: #00b894;
        }

        @media (max-width: 768px) {
            .chase-arena {
                grid-template-columns: 1fr;
            }
            
            .number-stream, .chase-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            #chase-canvas {
                width: 100%;
                height: auto;
            }
        }

        /* تأثيرات الرسوم المتحركة */
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

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .celebrate {
            animation: celebrate 0.5s ease-in-out;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="lesson-title">🎯 مطاردة المضاعفات</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="chase-arena">
            <div class="game-board">
                <div class="panel-title">🎮 ساحة المطاردة</div>
                <canvas id="chase-canvas" width="600" height="400"></canvas>
                
                <div class="target-number">
                    <div class="target-label">العدد المستهدف:</div>
                    <div class="target-display" id="target-number">--</div>
                    <div class="target-label" id="target-multiples">اختر المضاعفات الصحيحة</div>
                </div>
                
                <div class="chase-feedback" id="chase-feedback">
                    انقر على "بدء المطاردة" للبدء!
                </div>
            </div>
            
            <div class="hunter-controls">
                <div class="panel-title">🎒 أدوات الصياد</div>
                
                <div class="number-stream" id="number-stream">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>
                
                <div class="chase-stats">
                    <div class="chase-stat">
                        <div class="chase-value" id="chase-score">0</div>
                        <div class="chase-label">النقاط</div>
                    </div>
                    <div class="chase-stat">
                        <div class="chase-value" id="numbers-caught">0</div>
                        <div class="chase-label">أعداد صيدت</div>
                    </div>
                    <div class="chase-stat">
                        <div class="chase-value" id="chase-level">1</div>
                        <div class="chase-label">مستوى المطاردة</div>
                    </div>
                    <div class="chase-stat">
                        <div class="chase-value" id="chase-accuracy">100%</div>
                        <div class="chase-label">دقة الصيد</div>
                    </div>
                </div>
                
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" id="chase-progress"></div>
                    </div>
                    <div class="round-info">
                        <span>الجولة الحالية</span>
                        <span id="round-text">0/5</span>
                    </div>
                </div>
                
                <div class="multiples-list">
                    <div class="multiples-title">المضاعفات المطلوبة:</div>
                    <div class="multiples-items" id="multiples-items">
                        <!-- سيتم ملؤها ديناميكياً -->
                    </div>
                </div>
                
                <div class="chase-controls">
                    <button class="chase-btn" id="start-chase-btn">
                        🎯 بدء المطاردة
                    </button>
                    <button class="chase-btn" id="hint-btn" disabled>
                        💡 تلميح
                    </button>
                    <button class="chase-btn" id="next-round-btn" disabled>
                        ⭐ جولة جديدة
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let chaseScore = 0;
        let numbersCaught = 0;
        let chaseLevel = 1;
        let chaseAccuracy = 100;
        let totalAttempts = 0;
        let successfulAttempts = 0;
        let currentTarget = null;
        let currentMultiples = [];
        let foundMultiples = [];
        let isChasing = false;
        let roundProgress = 0;
        let roundTarget = 5;
        
        // عناصر DOM
        const chaseCanvas = document.getElementById('chase-canvas');
        const ctx = chaseCanvas.getContext('2d');
        const startChaseBtn = document.getElementById('start-chase-btn');
        const hintBtn = document.getElementById('hint-btn');
        const nextRoundBtn = document.getElementById('next-round-btn');
        const chaseFeedback = document.getElementById('chase-feedback');
        const targetNumberElement = document.getElementById('target-number');
        const targetMultiplesElement = document.getElementById('target-multiples');
        const numberStream = document.getElementById('number-stream');
        const chaseScoreElement = document.getElementById('chase-score');
        const numbersCaughtElement = document.getElementById('numbers-caught');
        const chaseLevelElement = document.getElementById('chase-level');
        const chaseAccuracyElement = document.getElementById('chase-accuracy');
        const chaseProgressElement = document.getElementById('chase-progress');
        const roundTextElement = document.getElementById('round-text');
        const multiplesItems = document.getElementById('multiples-items');
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeChaseCanvas();
            setupChaseEventListeners();
            drawChaseScene();
        });
        
        function setupChaseEventListeners() {
            startChaseBtn.addEventListener('click', startChase);
            hintBtn.addEventListener('click', provideChaseHint);
            nextRoundBtn.addEventListener('click', startNextRound);
        }
        
        function initializeChaseCanvas() {
            chaseCanvas.width = 600;
            chaseCanvas.height = 400;
        }
        
        function drawChaseScene() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, chaseCanvas.width, chaseCanvas.height);
            
            // رسم خلفية الساحة
            ctx.fillStyle = '#dfe6e9';
            ctx.fillRect(0, 0, chaseCanvas.width, chaseCanvas.height);
            
            // رسم شبكة المطاردة
            ctx.strokeStyle = '#b2bec3';
            ctx.lineWidth = 1;
            for (let i = 0; i <= chaseCanvas.width; i += 40) {
                ctx.beginPath();
                ctx.moveTo(i, 0);
                ctx.lineTo(i, chaseCanvas.height);
                ctx.stroke();
                
                ctx.beginPath();
                ctx.moveTo(0, i);
                ctx.lineTo(chaseCanvas.width, i);
                ctx.stroke();
            }
            
            if (currentTarget && isChasing) {
                drawTargetAndMultiples();
            } else {
                // رسم رسالة ترحيب
                ctx.fillStyle = '#2d3436';
                ctx.font = '24px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('انقر على "بدء المطاردة" للبدء!', 
                           chaseCanvas.width / 2, chaseCanvas.height / 2);
            }
        }
        
        function drawTargetAndMultiples() {
            const centerX = chaseCanvas.width / 2;
            const centerY = chaseCanvas.height / 2;
            
            // رسم العدد المستهدف
            ctx.fillStyle = '#e84393';
            ctx.font = 'bold 48px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(currentTarget, centerX, centerY - 50);
            
            // رسم المضاعفات
            ctx.fillStyle = '#2d3436';
            ctx.font = '20px Arial';
            ctx.fillText(`مضاعفات العدد ${currentTarget}`, centerX, centerY);
            
            // رسم المضاعفات المطلوبة
            ctx.fillStyle = '#00b894';
            ctx.font = '18px Arial';
            const multiplesText = currentMultiples.slice(0, 5).join(', ');
            ctx.fillText(multiplesText, centerX, centerY + 30);
            
            // رسم تأثير المطاردة
            if (isChasing) {
                ctx.strokeStyle = '#fdcb6e';
                ctx.lineWidth = 3;
                ctx.setLineDash([10, 5]);
                ctx.beginPath();
                ctx.arc(centerX, centerY, 100, 0, Math.PI * 2);
                ctx.stroke();
                ctx.setLineDash([]);
            }
        }
        
        function startChase() {
            isChasing = true;
            hintBtn.disabled = false;
            
            // اختيار عدد مستهدف عشوائي من 2 إلى 12
            currentTarget = Math.floor(Math.random() * 11) + 2;
            
            // توليد المضاعفات المطلوبة (من 1 إلى 10)
            currentMultiples = [];
            for (let i = 1; i <= 10; i++) {
                currentMultiples.push(currentTarget * i);
            }
            
            // توليد تيار الأعداد
            generateNumberStream();
            
            // تحديث العرض
            targetNumberElement.textContent = currentTarget;
            targetMultiplesElement.textContent = `اضرب في: 1, 2, 3, ...`;
            chaseFeedback.className = 'chase-feedback chase-info';
            chaseFeedback.textContent = `اصطد مضاعفات العدد ${currentTarget}!`;
            
            // تحديث قائمة المضاعفات
            updateMultiplesList();
            
            drawChaseScene();
        }
        
        function generateNumberStream() {
            numberStream.innerHTML = '';
            foundMultiples = [];
            
            const allNumbers = new Set(currentMultiples);
            
            // إضافة أعداد عشوائية
            while (allNumbers.size < 24) {
                const randomNum = Math.floor(Math.random() * 100) + 1;
                if (!currentMultiples.includes(randomNum)) {
                    allNumbers.add(randomNum);
                }
            }
            
            const numberArray = Array.from(allNumbers);
            shuffleArray(numberArray);
            
            numberArray.forEach(number => {
                const numberElement = document.createElement('div');
                numberElement.className = 'stream-number';
                numberElement.textContent = number;
                numberElement.dataset.number = number;
                
                numberElement.addEventListener('click', function() {
                    catchNumber(parseInt(this.dataset.number), this);
                });
                
                numberStream.appendChild(numberElement);
            });
        }
        
        function updateMultiplesList() {
            multiplesItems.innerHTML = '';
            
            currentMultiples.forEach(multiple => {
                const item = document.createElement('div');
                item.className = 'multiple-item';
                if (foundMultiples.includes(multiple)) {
                    item.classList.add('found');
                }
                item.textContent = multiple;
                multiplesItems.appendChild(item);
            });
        }
        
        function catchNumber(number, element) {
            if (!isChasing) return;
            
            totalAttempts++;
            
            const isMultiple = currentMultiples.includes(number);
            const alreadyFound = foundMultiples.includes(number);
            
            if (isMultiple && !alreadyFound) {
                // إصطياد ناجح
                successfulAttempts++;
                numbersCaught++;
                chaseScore += 10;
                foundMultiples.push(number);
                
                element.classList.add('correct', 'caught');
                element.classList.remove('wrong');
                
                chaseFeedback.className = 'chase-feedback chase-success celebrate';
                chaseFeedback.textContent = `🎉 أصبت! ${number} هو مضاعف لـ ${currentTarget}`;
                
                // تحديث التقدم
                roundProgress++;
                
                // تحديث الإحصائيات
                updateChaseStats();
                updateMultiplesList();
                
                // التحقق من اكتمال الجولة
                if (foundMultiples.length === currentMultiples.length) {
                    completeRound();
                }
            } else if (alreadyFound) {
                // تم اصطياده مسبقاً
                chaseFeedback.className = 'chase-feedback chase-fail';
                chaseFeedback.textContent = `⚠️ هذا العدد تم اصطياده مسبقاً!`;
            } else {
                // إصطياد خاطئ
                chaseScore = Math.max(0, chaseScore - 5);
                element.classList.add('wrong');
                
                chaseFeedback.className = 'chase-feedback chase-fail';
                chaseFeedback.textContent = `❌ خطأ! ${number} ليس مضاعفاً لـ ${currentTarget}`;
                
                updateChaseStats();
            }
        }
        
        function provideChaseHint() {
            if (!isChasing) return;
            
            // إيجاد مضاعف لم يتم اصطياده بعد
            const remainingMultiples = currentMultiples.filter(m => !foundMultiples.includes(m));
            if (remainingMultiples.length > 0) {
                const hintMultiple = remainingMultiples[0];
                chaseFeedback.className = 'chase-feedback chase-info pulse';
                chaseFeedback.textContent = `💡 تلميح: ${hintMultiple} هو مضاعف لـ ${currentTarget}`;
                
                // خصم نقاط للتلميح
                chaseScore = Math.max(0, chaseScore - 3);
                updateChaseStats();
            }
        }
        
        function completeRound() {
            isChasing = false;
            hintBtn.disabled = true;
            nextRoundBtn.disabled = false;
            
            chaseLevel++;
            roundProgress = 0;
            roundTarget = Math.min(roundTarget + 2, 10);
            
            chaseFeedback.className = 'chase-feedback chase-success';
            chaseFeedback.textContent = `🎊 مبروك! أكملت الجولة! انتقل للمستوى ${chaseLevel}`;
            
            updateChaseStats();
        }
        
        function startNextRound() {
            nextRoundBtn.disabled = true;
            startChase();
        }
        
        function updateChaseStats() {
            chaseScoreElement.textContent = chaseScore;
            numbersCaughtElement.textContent = numbersCaught;
            chaseLevelElement.textContent = chaseLevel;
            
            chaseAccuracy = totalAttempts > 0 ? 
                Math.round((successfulAttempts / totalAttempts) * 100) : 100;
            chaseAccuracyElement.textContent = `${chaseAccuracy}%`;
            
            // تحديث شريط التقدم
            const progressPercent = (roundProgress / roundTarget) * 100;
            chaseProgressElement.style.width = `${progressPercent}%`;
            roundTextElement.textContent = `${roundProgress}/${roundTarget}`;
        }
        
        // دوال مساعدة
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
    </script>
</body>
</html>