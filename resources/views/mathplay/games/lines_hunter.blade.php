<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صائد المستقيمات المتوازية - {{ $lesson_game->lesson->name }}</title>
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
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        /* زر الرجوع إلى الدرس */
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
            background: linear-gradient(135deg, #d63031 0%, #c23616 100%);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 10px;
        }

        .lesson-info {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 1.2em;
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
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            min-height: 400px;
            position: relative;
            overflow: hidden;
        }

        .canvas-container {
            width: 100%;
            height: 350px;
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 10px;
            position: relative;
            cursor: crosshair;
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
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        button:active {
            transform: translateY(-1px);
        }

        .feedback {
            text-align: center;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            font-size: 1.2em;
        }

        .success {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            animation: celebrate 0.5s ease;
        }

        .error {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        .info {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .line {
            position: absolute;
            background: #333;
            transform-origin: left center;
            height: 4px;
        }

        .parallel {
            background: #00b894 !important;
        }

        .perpendicular {
            background: #ff7675 !important;
        }

        .selected {
            box-shadow: 0 0 0 3px gold;
            z-index: 2;
        }

        .hint {
            position: absolute;
            width: 20px;
            height: 20px;
            background: gold;
            border-radius: 50%;
            animation: pulse 1s infinite;
            z-index: 3;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .controls {
                flex-direction: column;
            }

            button {
                width: 100%;
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
    </style>
</head>
<body>
    <div class="container">
        <!-- زر الرجوع إلى الدرس -->
        <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-to-lesson">
            ← الرجوع إلى الدرس
        </a>

        <div class="header">
            <h1>🎯 صائد المستقيمات المتوازية</h1>
        </div>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }} - المستقيمات المتوازية والمتعامدة
        </div>

        <div class="instructions">
            <h3>📋 التعليمات:</h3>
            <p>• انقر على المستقيمات <strong>المتوازية</strong> (التي لا تلتقي أبداً)</p>
            <p>• المستقيمات المتوازية ستظهر باللون <span style="color: #00b894; font-weight: bold">الأخضر</span></p>
            <p>• المستقيمات المتعامدة ستظهر باللون <span style="color: #ff7675; font-weight: bold">الأحمر</span></p>
            <p>• حاول الحصول على أعلى نقاط!</p>
        </div>

        <div class="game-area">
            <div class="canvas-container" id="canvas">
                <!-- المستقيمات سيتم رسمها هنا بالJavaScript -->
            </div>
        </div>

        <div class="controls">
            <button id="check-btn">✅ تحقق من الإجابة</button>
            <button id="hint-btn">💡 الحصول على تلميح</button>
            <button id="reset-btn">🔄 إعادة اللعبة</button>
        </div>

        <div class="feedback" id="feedback">
            ابدأ بالضغط على المستقيمات المتوازية!
        </div>

        <div class="score-board">
            النقاط: <span id="score">0</span> | المحاولات المتبقية: <span id="attempts">5</span>
        </div>
    </div>

    <script>
        // المتغيرات الأساسية
        const gameData = {
            score: 0,
            attempts: 5,
            lines: [],
            selectedLines: [],
            correctAnswers: []
        };

        // عناصر DOM
        const canvas = document.getElementById('canvas');
        const scoreElement = document.getElementById('score');
        const attemptsElement = document.getElementById('attempts');
        const feedbackElement = document.getElementById('feedback');
        const checkBtn = document.getElementById('check-btn');
        const resetBtn = document.getElementById('reset-btn');
        const hintBtn = document.getElementById('hint-btn');

        // تهيئة اللعبة
        function initGame() {
            generateLines();
            renderLines();
            updateUI();
        }

        // توليد المستقيمات
        function generateLines() {
            gameData.lines = [];
            gameData.correctAnswers = [];
            gameData.selectedLines = [];

            const canvasWidth = canvas.offsetWidth;
            const canvasHeight = canvas.offsetHeight;

            // إنشاء 8 مستقيمات (4 متوازية، 4 متعامدة)
            for (let i = 0; i < 8; i++) {
                const isParallel = i < 4;
                const line = createRandomLine(isParallel, canvasWidth, canvasHeight, i);
                gameData.lines.push(line);

                if (isParallel) {
                    gameData.correctAnswers.push(line.id);
                }
            }
        }

        // إنشاء مستقيم عشوائي
        function createRandomLine(isParallel, canvasWidth, canvasHeight, index) {
            const margin = 40;
            const minLength = 60;
            const maxLength = 120;

            let x1, y1, x2, y2;

            if (isParallel) {
                // مستقيمات متوازية (أفقية أو رأسية)
                if (Math.random() > 0.5) {
                    // أفقية
                    x1 = margin + Math.random() * (canvasWidth - 2 * margin - minLength);
                    y1 = margin + Math.random() * (canvasHeight - 2 * margin);
                    x2 = x1 + minLength + Math.random() * (maxLength - minLength);
                    y2 = y1;
                } else {
                    // رأسية
                    x1 = margin + Math.random() * (canvasWidth - 2 * margin);
                    y1 = margin + Math.random() * (canvasHeight - 2 * margin - minLength);
                    x2 = x1;
                    y2 = y1 + minLength + Math.random() * (maxLength - minLength);
                }
            } else {
                // مستقيمات متعامدة (مائلة)
                x1 = margin + Math.random() * (canvasWidth - 2 * margin - minLength);
                y1 = margin + Math.random() * (canvasHeight - 2 * margin - minLength);

                const angle = Math.random() * Math.PI;
                const length = minLength + Math.random() * (maxLength - minLength);
                x2 = x1 + Math.cos(angle) * length;
                y2 = y1 + Math.sin(angle) * length;

                // التأكد من أن الخط يبقى داخل Canvas
                x2 = Math.max(margin, Math.min(canvasWidth - margin, x2));
                y2 = Math.max(margin, Math.min(canvasHeight - margin, y2));
            }

            return {
                id: `line-${index}`,
                x1, y1, x2, y2,
                isParallel,
                selected: false
            };
        }

        // رسم المستقيمات
        function renderLines() {
            canvas.innerHTML = '';

            gameData.lines.forEach(line => {
                const lineElement = document.createElement('div');
                lineElement.className = `line ${line.isParallel ? 'parallel' : 'perpendicular'} ${line.selected ? 'selected' : ''}`;

                const length = Math.sqrt(Math.pow(line.x2 - line.x1, 2) + Math.pow(line.y2 - line.y1, 2));
                const angle = Math.atan2(line.y2 - line.y1, line.x2 - line.x1) * 180 / Math.PI;

                lineElement.style.width = `${length}px`;
                lineElement.style.left = `${line.x1}px`;
                lineElement.style.top = `${line.y1}px`;
                lineElement.style.transform = `rotate(${angle}deg)`;
                lineElement.dataset.id = line.id;

                lineElement.addEventListener('click', () => toggleLineSelection(line));

                canvas.appendChild(lineElement);
            });
        }

        // تبديل اختيار المستقيم
        function toggleLineSelection(line) {
            if (gameData.attempts <= 0) return;

            line.selected = !line.selected;

            if (line.selected) {
                gameData.selectedLines.push(line.id);
            } else {
                gameData.selectedLines = gameData.selectedLines.filter(id => id !== line.id);
            }

            renderLines();
        }

        // التحقق من الإجابة
        function checkAnswer() {
            if (gameData.attempts <= 0) {
                showFeedback('❌ لم تعد لديك محاولات متبقية!', 'error');
                return;
            }

            gameData.attempts--;

            // التحقق إذا كانت جميع الإجابات صحيحة
            const allCorrect = gameData.correctAnswers.every(id =>
                gameData.selectedLines.includes(id)
            ) && gameData.selectedLines.length === gameData.correctAnswers.length;

            if (allCorrect) {
                gameData.score += 10;
                showFeedback('🎉 أحسنت! جميع المستقيمات المتوازية صحيحة!', 'success');
                setTimeout(() => {
                    resetGame();
                }, 2000);
            } else {
                showFeedback('⚠️ ليست جميع الإجابات صحيحة. حاول مرة أخرى!', 'error');
            }

            updateUI();

            if (gameData.attempts <= 0 && !allCorrect) {
                showFeedback('💔 انتهت محاولاتك! إعادة اللعبة...', 'error');
                setTimeout(() => {
                    resetGame();
                }, 3000);
            }
        }

        // إظهار التلميح
        function showHint() {
            if (gameData.attempts <= 1) {
                showFeedback('❌ لا يمكنك استخدام التلميح مع محاولة واحدة متبقية!', 'error');
                return;
            }

            gameData.attempts--;

            // إظهار تلميح لأحد المستقيمات المتوازية
            const unselectedParallel = gameData.lines.find(line =>
                line.isParallel && !line.selected
            );

            if (unselectedParallel) {
                const hint = document.createElement('div');
                hint.className = 'hint';
                hint.style.left = `${(unselectedParallel.x1 + unselectedParallel.x2) / 2 - 10}px`;
                hint.style.top = `${(unselectedParallel.y1 + unselectedParallel.y2) / 2 - 10}px`;

                canvas.appendChild(hint);

                setTimeout(() => {
                    hint.remove();
                }, 2000);

                showFeedback('💡 هذا المستقيم متوازي!', 'info');
            }

            updateUI();
        }

        // إعادة اللعبة
        function resetGame() {
            gameData.score = 0;
            gameData.attempts = 5;
            gameData.selectedLines = [];
            initGame();
            showFeedback('🔄 تم إعادة اللعبة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            attemptsElement.textContent = gameData.attempts;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        checkBtn.addEventListener('click', checkAnswer);
        resetBtn.addEventListener('click', resetGame);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>
