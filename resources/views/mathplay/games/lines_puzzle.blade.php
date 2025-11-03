<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بازل المستقيمات المتعامدة - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 900px;
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

        .game-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        @media (max-width: 768px) {
            .game-layout {
                grid-template-columns: 1fr;
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

        .instructions {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .instructions h3 {
            color: #0984e3;
            margin-bottom: 15px;
        }

        .instructions ul {
            list-style-type: none;
            padding-right: 10px;
        }

        .instructions li {
            margin-bottom: 10px;
            padding-right: 25px;
            position: relative;
            line-height: 1.6;
        }

        .instructions li:before {
            content: "•";
            color: #667eea;
            font-weight: bold;
            position: absolute;
            right: 0;
        }

        .puzzle-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 20px;
            min-height: 400px;
            position: relative;
        }

        .shapes-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .shape {
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: grab;
            transition: all 0.3s ease;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .shape:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .shape.dragging {
            opacity: 0.7;
            transform: scale(1.05);
        }

        .target-area {
            background: #f8f9fa;
            border: 3px dashed #667eea;
            border-radius: 15px;
            padding: 20px;
            min-height: 300px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .target {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s ease;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .target.highlight {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
            animation: pulse 1s infinite;
        }

        .target.occupied {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .line {
            width: 80px;
            height: 4px;
            background: #333;
            margin: 5px;
            position: relative;
        }

        .parallel-lines .line:nth-child(2) {
            margin-top: 20px;
        }

        .perpendicular-lines {
            position: relative;
            width: 80px;
            height: 80px;
        }

        .perpendicular-lines .horizontal {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            width: 100%;
        }

        .perpendicular-lines .vertical {
            position: absolute;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
            height: 100%;
            width: 4px;
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

        .feedback {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            min-height: 70px;
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

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(0, 184, 148, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(0, 184, 148, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 184, 148, 0); }
        }

        .shape.correct {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .shape.incorrect {
            border-color: #ff7675;
            background: rgba(255, 118, 117, 0.1);
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
            <h1>🧩 بازل المستقيمات المتعامدة</h1>
        </div>

        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }} - المستقيمات المتوازية والمتعامدة
        </div>

        <div class="game-layout">
            <div class="instructions">
                <h3>📋 كيف تلعب:</h3>
                <ul>
                    <li>اسحب الأشكال إلى المنطقة المستهدفة المناسبة</li>
                    <li>ضع المستقيمات <strong>المتوازية</strong> في المربع الأيسر</li>
                    <li>ضع المستقيمات <strong>المتعامدة</strong> في المربع الأيمن</li>
                    <li>المستقيمات المتوازية لا تلتقي أبداً</li>
                    <li>المستقيمات المتعامدة تتقاطع بزاوية 90 درجة</li>
                    <li>احصل على نقاط لكل إجابة صحيحة!</li>
                </ul>
            </div>

            <div class="puzzle-area">
                <div class="shapes-container" id="shapes-container">
                    <!-- الأشكال ستضاف هنا بالJavaScript -->
                </div>

                <div class="target-area" id="target-area">
                    <div class="target" data-type="parallel">
                        <h4>📏 المستقيمات المتوازية</h4>
                    </div>
                    <div class="target" data-type="perpendicular">
                        <h4>➕ المستقيمات المتعامدة</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="controls">
            <button id="check-btn">✅ تحقق من الإجابات</button>
            <button id="hint-btn">💡 عرض المساعدة</button>
            <button id="reset-btn">🔄 إعادة الترتيب</button>
        </div>

        <div class="feedback" id="feedback">
            ابدأ بسحب الأشكال إلى المكان الصحيح!
        </div>

        <div class="score-board">
            النقاط: <span id="score">0</span> | المستوى: <span id="level">1</span>
        </div>
    </div>

    <script>
        // بيانات اللعبة
        const gameData = {
            score: 0,
            level: 1,
            shapes: [],
            placements: {},
            correctPlacements: {
                'shape-1': 'parallel',
                'shape-2': 'parallel',
                'shape-3': 'perpendicular',
                'shape-4': 'perpendicular',
                'shape-5': 'parallel',
                'shape-6': 'perpendicular'
            }
        };

        // عناصر DOM
        const shapesContainer = document.getElementById('shapes-container');
        const targetArea = document.getElementById('target-area');
        const scoreElement = document.getElementById('score');
        const levelElement = document.getElementById('level');
        const feedbackElement = document.getElementById('feedback');
        const checkBtn = document.getElementById('check-btn');
        const resetBtn = document.getElementById('reset-btn');
        const hintBtn = document.getElementById('hint-btn');

        // تهيئة اللعبة
        function initGame() {
            createShapes();
            setupDragAndDrop();
            updateUI();
        }

        // إنشاء الأشكال
        function createShapes() {
            const shapes = [
                { id: 'shape-1', type: 'parallel', name: 'مستقيمان متوازيان' },
                { id: 'shape-2', type: 'parallel', name: 'مستقيمان أفقيان' },
                { id: 'shape-3', type: 'perpendicular', name: 'مستقيمان متعامدان' },
                { id: 'shape-4', type: 'perpendicular', name: 'تقاطع عمودي' },
                { id: 'shape-5', type: 'parallel', name: 'خطوط متوازية' },
                { id: 'shape-6', type: 'perpendicular', name: 'زاوية قائمة' }
            ];

            shapesContainer.innerHTML = '';
            gameData.placements = {};

            shapes.forEach(shape => {
                const shapeElement = document.createElement('div');
                shapeElement.className = 'shape';
                shapeElement.id = shape.id;
                shapeElement.draggable = true;
                shapeElement.innerHTML = `
                    <div class="${shape.type === 'parallel' ? 'parallel-lines' : 'perpendicular-lines'}">
                        ${shape.type === 'parallel' ?
                            '<div class="line"></div><div class="line"></div>' :
                            '<div class="line horizontal"></div><div class="line vertical"></div>'
                        }
                    </div>
                    <div style="margin-top: 10px; font-size: 12px; color: #666;">${shape.name}</div>
                `;

                shapesContainer.appendChild(shapeElement);
            });
        }

        // إعداد نظام السحب والإفلات
        function setupDragAndDrop() {
            const shapes = document.querySelectorAll('.shape');
            const targets = document.querySelectorAll('.target');

            shapes.forEach(shape => {
                shape.addEventListener('dragstart', handleDragStart);
                shape.addEventListener('dragend', handleDragEnd);
            });

            targets.forEach(target => {
                target.addEventListener('dragover', handleDragOver);
                target.addEventListener('dragenter', handleDragEnter);
                target.addEventListener('dragleave', handleDragLeave);
                target.addEventListener('drop', handleDrop);
            });
        }

        function handleDragStart(e) {
            this.classList.add('dragging');
            e.dataTransfer.setData('text/plain', this.id);
        }

        function handleDragEnd() {
            this.classList.remove('dragging');
            document.querySelectorAll('.target').forEach(target => {
                target.classList.remove('highlight');
            });
        }

        function handleDragOver(e) {
            e.preventDefault();
        }

        function handleDragEnter(e) {
            e.preventDefault();
            this.classList.add('highlight');
        }

        function handleDragLeave() {
            this.classList.remove('highlight');
        }

        function handleDrop(e) {
            e.preventDefault();
            this.classList.remove('highlight');

            const shapeId = e.dataTransfer.getData('text/plain');
            const shape = document.getElementById(shapeId);
            const targetType = this.getAttribute('data-type');

            // إزاحة الشكل من مكانه السابق
            if (gameData.placements[shapeId]) {
                const previousTarget = document.querySelector(`[data-type="${gameData.placements[shapeId]}"]`);
                previousTarget.classList.remove('occupied');
            }

            // وضع الشكل في الهدف الجديد
            gameData.placements[shapeId] = targetType;
            this.classList.add('occupied');

            showFeedback(`✅ تم وضع ${shape.querySelector('div:last-child').textContent} في المكان المناسب`, 'info');
        }

        // التحقق من الإجابات
        function checkAnswers() {
            let correctCount = 0;
            const totalShapes = Object.keys(gameData.correctPlacements).length;

            Object.keys(gameData.correctPlacements).forEach(shapeId => {
                const shape = document.getElementById(shapeId);
                const correctType = gameData.correctPlacements[shapeId];
                const playerType = gameData.placements[shapeId];

                if (playerType === correctType) {
                    shape.classList.add('correct');
                    shape.classList.remove('incorrect');
                    correctCount++;
                } else {
                    shape.classList.add('incorrect');
                    shape.classList.remove('correct');
                }
            });

            if (correctCount === totalShapes) {
                gameData.score += 20 * gameData.level;
                gameData.level++;
                showFeedback(`🎉 ممتاز! جميع الإجابات صحيحة! انتقل للمستوى ${gameData.level}`, 'success');
                setTimeout(() => {
                    nextLevel();
                }, 3000);
            } else {
                showFeedback(`⚠️ ${correctCount} من ${totalShapes} إجابات صحيحة. حاول مرة أخرى!`, 'error');
            }

            updateUI();
        }

        // الانتقال للمستوى التالي
        function nextLevel() {
            // زيادة صعوبة اللعبة بالمستويات الأعلى
            createShapes();
            showFeedback(`🚀 المستوى ${gameData.level}! هيا نبدأ!`, 'info');
        }

        // إظهار التلميح
        function showHint() {
            // إيجاد شكل لم يوضع بشكل صحيح
            const incorrectShape = Object.keys(gameData.correctPlacements).find(shapeId => {
                return gameData.placements[shapeId] !== gameData.correctPlacements[shapeId];
            });

            if (incorrectShape) {
                const correctType = gameData.correctPlacements[incorrectShape];
                const typeName = correctType === 'parallel' ? 'المتوازية' : 'المتعامدة';

                showFeedback(`💡 ${document.getElementById(incorrectShape).querySelector('div:last-child').textContent} يجب وضعه مع المستقيمات ${typeName}`, 'info');
            } else {
                showFeedback('🎯 جميع الأشكال في أماكنها الصحيحة تقريباً!', 'success');
            }
        }

        // إعادة اللعبة
        function resetGame() {
            gameData.score = 0;
            gameData.level = 1;
            initGame();
            showFeedback('🔄 تم إعادة اللعبة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            levelElement.textContent = gameData.level;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        checkBtn.addEventListener('click', checkAnswers);
        resetBtn.addEventListener('click', resetGame);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>
