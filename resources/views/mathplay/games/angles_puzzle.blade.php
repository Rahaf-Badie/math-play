<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بازل تصنيف المثلثات - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2d3436;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .lesson-info {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 1.3em;
        }

        .game-layout {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 968px) {
            .game-layout {
                grid-template-columns: 1fr;
            }
        }

        .instructions {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .instructions h3 {
            color: #0984e3;
            margin-bottom: 20px;
            text-align: center;
        }

        .rules-list {
            list-style: none;
            padding: 0;
        }

        .rules-list li {
            margin-bottom: 15px;
            padding-right: 40px;
            position: relative;
            line-height: 1.6;
        }

        .rules-list li:before {
            content: "🎯";
            position: absolute;
            right: 0;
            font-size: 1.2em;
        }

        .type-info {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 4px solid;
        }

        .type-info.acute { border-color: #00b894; background: rgba(0, 184, 148, 0.1); }
        .type-info.right { border-color: #ff7675; background: rgba(255, 118, 117, 0.1); }
        .type-info.obtuse { border-color: #ffb300; background: rgba(255, 179, 0, 0.1); }

        .puzzle-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .shapes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .shape {
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: grab;
            transition: all 0.3s ease;
            min-height: 120px;
            display: flex;
            flex-direction: column;
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

        .triangle-visual {
            width: 80px;
            height: 80px;
            margin: 10px auto;
            position: relative;
        }

        .triangle {
            width: 0;
            height: 0;
            border-style: solid;
        }

        .acute-visual {
            border-width: 0 35px 60px 35px;
            border-color: transparent transparent #00b894 transparent;
        }

        .right-visual {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #ff7675, #e84393);
            clip-path: polygon(0 0, 0 100%, 100% 100%);
        }

        .obtuse-visual {
            border-width: 0 25px 60px 55px;
            border-color: transparent transparent #ffb300 transparent;
        }

        .angles-display {
            font-size: 0.9em;
            color: #666;
            margin-top: 5px;
        }

        .targets-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .target {
            background: white;
            border: 3px dashed #667eea;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            min-height: 180px;
            display: flex;
            flex-direction: column;
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

        .target-header {
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 1.1em;
        }

        .target.acute .target-header { color: #00b894; }
        .target.right .target-header { color: #ff7675; }
        .target.obtuse .target-header { color: #ffb300; }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            flex-wrap: wrap;
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

        .completion-message {
            text-align: center;
            font-size: 1.5em;
            color: #00b894;
            margin: 20px 0;
            animation: celebrate 0.5s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🧩 بازل تصنيف المثلثات</h1>
            <p>صنف المثلثات حسب زواياها وتعلم بطريقة ممتعة!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }} - زوايا المثلث وأنواعه
        </div>

        <div class="game-layout">
            <div class="instructions">
                <h3>📋 قواعد اللعبة</h3>
                <ul class="rules-list">
                    <li>اسحب كل مثلث إلى التصنيف الصحيح</li>
                    <li>انظر إلى زوايا كل مثلث جيداً</li>
                    <li>تذكر أن مجموع زوايا المثلث = 180°</li>
                    <li>احصل على نقاط لكل تصنيف صحيح</li>
                </ul>

                <div class="type-info acute">
                    <strong>🔺 حاد الزوايا:</strong><br>
                    جميع الزوايا < 90°
                </div>

                <div class="type-info right">
                    <strong>📐 قائم الزاوية:</strong><br>
                    زاوية واحدة = 90°
                </div>

                <div class="type-info obtuse">
                    <strong>🔻 منفرج الزاوية:</strong><br>
                    زاوية واحدة > 90°
                </div>
            </div>
            
            <div class="puzzle-area">
                <h3 style="text-align: center; margin-bottom: 20px; color: #2d3436;">🎮 منطقة التصنيف</h3>
                
                <div class="shapes-grid" id="shapes-grid">
                    <!-- المثلثات ستضاف هنا بالJavaScript -->
                </div>
                
                <div class="targets-container" id="targets-container">
                    <div class="target acute" data-type="acute">
                        <div class="target-header">🔺 مثلث حاد الزوايا</div>
                        <div class="triangle-visual">
                            <div class="triangle acute-visual"></div>
                        </div>
                        <div style="font-size: 0.9em; color: #666; margin-top: 10px;">
                            جميع الزوايا < 90°
                        </div>
                    </div>
                    
                    <div class="target right" data-type="right">
                        <div class="target-header">📐 مثلث قائم الزاوية</div>
                        <div class="triangle-visual">
                            <div class="right-visual"></div>
                        </div>
                        <div style="font-size: 0.9em; color: #666; margin-top: 10px;">
                            زاوية واحدة = 90°
                        </div>
                    </div>
                    
                    <div class="target obtuse" data-type="obtuse">
                        <div class="target-header">🔻 مثلث منفرج الزاوية</div>
                        <div class="triangle-visual">
                            <div class="triangle obtuse-visual"></div>
                        </div>
                        <div style="font-size: 0.9em; color: #666; margin-top: 10px;">
                            زاوية واحدة > 90°
                        </div>
                    </div>
                </div>

                <div class="controls">
                    <button id="check-btn">✅ تحقق من التصنيف</button>
                    <button id="hint-btn">💡 عرض المساعدة</button>
                    <button id="reset-btn">🔄 إعادة الترتيب</button>
                </div>
                
                <div class="feedback" id="feedback">
                    ابدأ بسحب المثلثات إلى التصنيفات الصحيحة!
                </div>
            </div>
        </div>
        
        <div class="score-board">
            النقاط: <span id="score">0</span> | المثلثات المصنفة: <span id="classified">0</span>/<span id="total">0</span>
        </div>
    </div>

    <script>
        // بيانات اللعبة
        const gameData = {
            score: 0,
            triangles: [
                { id: 'tri-1', angles: [60, 60, 60], type: 'acute', name: 'مثلث متساوي الأضلاع' },
                { id: 'tri-2', angles: [90, 45, 45], type: 'right', name: 'مثلث قائم متساوي الساقين' },
                { id: 'tri-3', angles: [120, 30, 30], type: 'obtuse', name: 'مثلث منفرج الزاوية' },
                { id: 'tri-4', angles: [80, 50, 50], type: 'acute', name: 'مثلث حاد الزوايا' },
                { id: 'tri-5', angles: [100, 40, 40], type: 'obtuse', name: 'مثلث منفرج الزاوية' },
                { id: 'tri-6', angles: [90, 60, 30], type: 'right', name: 'مثلث قائم الزاوية' },
                { id: 'tri-7', angles: [70, 60, 50], type: 'acute', name: 'مثلث حاد الزوايا' },
                { id: 'tri-8', angles: [110, 35, 35], type: 'obtuse', name: 'مثلث منفرج الزاوية' },
                { id: 'tri-9', angles: [90, 50, 40], type: 'right', name: 'مثلث قائم الزاوية' }
            ],
            placements: {},
            currentLevel: 1
        };

        // عناصر DOM
        const shapesGrid = document.getElementById('shapes-grid');
        const targetsContainer = document.getElementById('targets-container');
        const scoreElement = document.getElementById('score');
        const classifiedElement = document.getElementById('classified');
        const totalElement = document.getElementById('total');
        const feedbackElement = document.getElementById('feedback');
        const checkBtn = document.getElementById('check-btn');
        const resetBtn = document.getElementById('reset-btn');
        const hintBtn = document.getElementById('hint-btn');

        // تهيئة اللعبة
        function initGame() {
            createTriangles();
            setupDragAndDrop();
            updateUI();
        }

        // إنشاء المثلثات
        function createTriangles() {
            // اختيار 6 مثلثات عشوائية للمستوى الحالي
            const selectedTriangles = [...gameData.triangles]
                .sort(() => Math.random() - 0.5)
                .slice(0, 6);

            shapesGrid.innerHTML = '';
            gameData.placements = {};

            selectedTriangles.forEach(triangle => {
                const shapeElement = document.createElement('div');
                shapeElement.className = 'shape';
                shapeElement.id = triangle.id;
                shapeElement.draggable = true;
                
                const visualClass = triangle.type === 'acute' ? 'acute-visual' : 
                                  triangle.type === 'right' ? 'right-visual' : 'obtuse-visual';
                
                shapeElement.innerHTML = `
                    <div class="triangle-visual">
                        <div class="${triangle.type === 'right' ? 'right-visual' : 'triangle ' + visualClass}"></div>
                    </div>
                    <div class="angles-display">
                        ${triangle.angles[0]}° + ${triangle.angles[1]}° + ${triangle.angles[2]}°
                    </div>
                    <div style="font-size: 0.8em; color: #666; margin-top: 5px;">${triangle.name}</div>
                `;

                shapesGrid.appendChild(shapeElement);
            });

            totalElement.textContent = selectedTriangles.length;
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
            
            const triangleId = e.dataTransfer.getData('text/plain');
            const triangle = gameData.triangles.find(t => t.id === triangleId);
            const targetType = this.getAttribute('data-type');
            
            if (triangle) {
                gameData.placements[triangleId] = targetType;
                this.classList.add('occupied');
                
                const triangleElement = document.getElementById(triangleId);
                triangleElement.style.opacity = '0.6';
                triangleElement.draggable = false;
                
                showFeedback(`✅ تم وضع ${triangle.name} في التصنيف`, 'info');
                updateUI();
            }
        }

        // التحقق من التصنيفات
        function checkClassifications() {
            let correctCount = 0;
            const totalTriangles = Object.keys(gameData.placements).length;
            
            if (totalTriangles < 3) {
                showFeedback('❌ ضع 3 مثلثات على الأقل قبل التحقق!', 'error');
                return;
            }
            
            Object.keys(gameData.placements).forEach(triangleId => {
                const triangle = gameData.triangles.find(t => t.id === triangleId);
                const playerType = gameData.placements[triangleId];
                const triangleElement = document.getElementById(triangleId);
                
                if (triangle.type === playerType) {
                    triangleElement.classList.add('correct');
                    triangleElement.classList.remove('incorrect');
                    correctCount++;
                } else {
                    triangleElement.classList.add('incorrect');
                    triangleElement.classList.remove('correct');
                }
            });
            
            if (correctCount === totalTriangles && totalTriangles === 6) {
                gameData.score += 50 * gameData.currentLevel;
                gameData.currentLevel++;
                showFeedback(`🎉 ممتاز! جميع التصنيفات صحيحة! تقدم للمستوى ${gameData.currentLevel}`, 'success');
                
                setTimeout(() => {
                    if (gameData.currentLevel <= 3) {
                        nextLevel();
                    } else {
                        showCompletionMessage();
                    }
                }, 3000);
            } else {
                const accuracy = Math.round((correctCount / totalTriangles) * 100);
                showFeedback(`📊 ${correctCount} من ${totalTriangles} تصنيفات صحيحة (${accuracy}%)`, 
                           correctCount === totalTriangles ? 'success' : 'error');
            }
            
            updateUI();
        }

        // الانتقال للمستوى التالي
        function nextLevel() {
            createTriangles();
            showFeedback(`🚀 المستوى ${gameData.currentLevel}! هيا نبدأ!`, 'info');
        }

        // إظهار رسالة الإكمال
        function showCompletionMessage() {
            const completionDiv = document.createElement('div');
            completionDiv.className = 'completion-message';
            completionDiv.innerHTML = `
                🏆 مبروك! أكملت جميع المستويات!<br>
                <span style="font-size: 0.8em;">النقاط النهائية: ${gameData.score}</span>
            `;
            document.querySelector('.puzzle-area').appendChild(completionDiv);
        }

        // إظهار التلميح
        function showHint() {
            // إيجاد مثلث لم يوضع أو وضع بشكل خاطئ
            const unplacedTriangle = gameData.triangles.find(t => 
                !gameData.placements[t.id] && document.getElementById(t.id)
            );
            
            if (unplacedTriangle) {
                const typeName = unplacedTriangle.type === 'acute' ? 'حاد الزوايا' : 
                               unplacedTriangle.type === 'right' ? 'قائم الزاوية' : 'منفرج الزاوية';
                
                showFeedback(`💡 ${unplacedTriangle.name} يجب تصنيفه كمثلث ${typeName}`, 'info');
            } else {
                showFeedback('🎯 حاول تحسين التصنيفات الخاطئة!', 'info');
            }
        }

        // إعادة اللعبة
        function resetGame() {
            gameData.score = 0;
            gameData.currentLevel = 1;
            initGame();
            showFeedback('🔄 تم إعادة اللعبة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            scoreElement.textContent = gameData.score;
            classifiedElement.textContent = Object.keys(gameData.placements).length;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        checkBtn.addEventListener('click', checkClassifications);
        resetBtn.addEventListener('click', resetGame);
        hintBtn.addEventListener('click', showHint);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>