<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصنع الحجوم - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 1200px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.3rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .factory-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .control-section {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 25px;
            border: 3px solid #e9ecef;
        }

        .visualization-section {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
            font-weight: bold;
            font-size: 1.4rem;
        }

        .visualization-section .section-title {
            color: white;
        }

        .dimension-controls {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .dimension-group {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            border: 3px solid #a29bfe;
        }

        .dimension-label {
            font-weight: bold;
            color: #2d3436;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .dimension-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #dfe6e9;
            border-radius: 10px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .dimension-value {
            font-size: 1.1rem;
            color: #e84393;
            font-weight: bold;
        }

        .volume-formula {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .formula-display {
            font-size: 1.8rem;
            font-weight: bold;
            color: #00b894;
            margin: 15px 0;
            direction: ltr;
        }

        .unit-cubes {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 20px 0;
        }

        .unit-cube {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #dfe6e9;
        }

        .unit-cube:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .unit-cube.active {
            border-color: #00b894;
            background: #00b894;
            color: white;
        }

        .cube-visualization {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #cube-canvas {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .volume-calculations {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .calculation-step {
            margin: 15px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            border-right: 5px solid #74b9ff;
            direction: ltr;
            text-align: left;
        }

        .factory-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .factory-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        #calculate-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #practice-btn {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .factory-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .feedback-area {
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

        .feedback-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback-error {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .feedback-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .real-world-examples {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .example-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            border: 2px solid #dfe6e9;
            transition: all 0.3s ease;
        }

        .example-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .example-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .stats-panel {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .practice-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            display: none;
        }

        .practice-problem {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #2d3436;
        }

        .practice-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .practice-option {
            padding: 15px;
            background: #f8f9fa;
            border: 2px solid #dfe6e9;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .practice-option:hover {
            background: #e9ecef;
        }

        .practice-option.correct {
            background: #00b894;
            color: white;
            border-color: #00b894;
        }

        .practice-option.wrong {
            background: #ff7675;
            color: white;
            border-color: #ff7675;
        }

        @media (max-width: 768px) {
            .factory-layout {
                grid-template-columns: 1fr;
            }
            
            .dimension-controls, .real-world-examples, .stats-panel {
                grid-template-columns: 1fr;
            }
            
            .unit-cubes, .practice-options {
                grid-template-columns: 1fr;
            }
            
            .factory-controls {
                flex-direction: column;
            }
        }

        /* تأثيرات الرسوم المتحركة */
        @keyframes celebrate {
            0% { transform: translateY(0px); }
            25% { transform: translateY(-10px); }
            50% { transform: translateY(0px); }
            75% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        .celebrate {
            animation: celebrate 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="lesson-title">🏭 مصنع الحجوم</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="factory-layout">
            <div class="control-section">
                <div class="section-title">🔧 لوحة التحكم</div>
                
                <div class="dimension-controls">
                    <div class="dimension-group">
                        <div class="dimension-label">الطول</div>
                        <input type="range" class="dimension-input" id="length-input" min="1" max="10" value="4">
                        <div class="dimension-value" id="length-value">٤ وحدات</div>
                    </div>
                    
                    <div class="dimension-group">
                        <div class="dimension-label">العرض</div>
                        <input type="range" class="dimension-input" id="width-input" min="1" max="10" value="3">
                        <div class="dimension-value" id="width-value">٣ وحدات</div>
                    </div>
                    
                    <div class="dimension-group">
                        <div class="dimension-label">الارتفاع</div>
                        <input type="range" class="dimension-input" id="height-input" min="1" max="10" value="2">
                        <div class="dimension-value" id="height-value">٢ وحدات</div>
                    </div>
                </div>
                
                <div class="volume-formula">
                    <h4>📐 قانون حجم متوازي المستطيلات</h4>
                    <div class="formula-display" id="formula-display">
                        الحجم = الطول × العرض × الارتفاع
                    </div>
                    <div class="formula-display" id="volume-result">
                        ٤ × ٣ × ٢ = ٢٤ وحدة مكعبة
                    </div>
                </div>
                
                <div class="unit-cubes">
                    <div class="unit-cube active" data-unit="1">
                        <div>مكعب وحدة</div>
                        <div>١×١×١</div>
                    </div>
                    <div class="unit-cube" data-unit="2">
                        <div>مكعب مزدوج</div>
                        <div>٢×٢×٢</div>
                    </div>
                    <div class="unit-cube" data-unit="5">
                        <div>مكعب كبير</div>
                        <div>٥×٥×٥</div>
                    </div>
                </div>
                
                <div class="real-world-examples">
                    <div class="example-card">
                        <div class="example-icon">📦</div>
                        <h5>صندوق</h5>
                        <p>حجم الصندوق = الطول × العرض × الارتفاع</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">🧱</div>
                        <h5>طوبة</h5>
                        <p>نحسب حجمها بنفس القانون</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">📚</div>
                        <h5>كتاب</h5>
                        <p>جميع الأبعاد مهمة</p>
                    </div>
                </div>
                
                <div class="stats-panel">
                    <div class="stat-card">
                        <div class="stat-value" id="problems-solved">٠</div>
                        <div class="stat-label">مسائل محلولة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="correct-answers">٠</div>
                        <div class="stat-label">إجابات صحيحة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="factory-level">١</div>
                        <div class="stat-label">مستوى المصنع</div>
                    </div>
                </div>
            </div>
            
            <div class="visualization-section">
                <div class="section-title">🎯 المعمل البصري</div>
                
                <div class="cube-visualization">
                    <canvas id="cube-canvas" width="280" height="280"></canvas>
                </div>
                
                <div class="volume-calculations">
                    <h4 style="text-align: center; margin-bottom: 15px;">🧮 خطوات حساب الحجم</h4>
                    <div class="calculation-step" id="step1">
                        <strong>الخطوة ١:</strong> عدد المكعبات في الطبقة الأولى = الطول × العرض
                    </div>
                    <div class="calculation-step" id="step2">
                        <strong>الخطوة ٢:</strong> عدد الطبقات = الارتفاع
                    </div>
                    <div class="calculation-step" id="step3">
                        <strong>الخطوة ٣:</strong> الحجم الكلي = عدد المكعبات في الطبقة × عدد الطبقات
                    </div>
                </div>
                
                <div class="factory-controls">
                    <button class="factory-btn" id="calculate-btn">
                        🧮 احسب الحجم
                    </button>
                    <button class="factory-btn" id="reset-btn">
                        🔄 إعادة تعيين
                    </button>
                    <button class="factory-btn" id="practice-btn">
                        💪 تدرب على المسائل
                    </button>
                </div>
                
                <div class="feedback-area" id="feedback-area">
                    حرك أزرار الأبعاد وشاهد التغيرات!
                </div>
                
                <div class="practice-section" id="practice-section">
                    <div class="practice-problem" id="practice-problem">
                        ما حجم متوازي المستطيلات الذي طوله ٥، عرضه ٣، ارتفاعه ٢؟
                    </div>
                    <div class="practice-options" id="practice-options">
                        <!-- سيتم ملؤها ديناميكياً -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let problemsSolved = 0;
        let correctAnswers = 0;
        let factoryLevel = 1;
        let length = 4;
        let width = 3;
        let height = 2;
        let unitSize = 1;
        let currentVolume = 0;
        
        // عناصر DOM
        const cubeCanvas = document.getElementById('cube-canvas');
        const ctx = cubeCanvas.getContext('2d');
        const lengthInput = document.getElementById('length-input');
        const widthInput = document.getElementById('width-input');
        const heightInput = document.getElementById('height-input');
        const lengthValue = document.getElementById('length-value');
        const widthValue = document.getElementById('width-value');
        const heightValue = document.getElementById('height-value');
        const formulaDisplay = document.getElementById('formula-display');
        const volumeResult = document.getElementById('volume-result');
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step3 = document.getElementById('step3');
        const calculateBtn = document.getElementById('calculate-btn');
        const resetBtn = document.getElementById('reset-btn');
        const practiceBtn = document.getElementById('practice-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const practiceSection = document.getElementById('practice-section');
        const practiceProblem = document.getElementById('practice-problem');
        const practiceOptions = document.getElementById('practice-options');
        const unitCubes = document.querySelectorAll('.unit-cube');
        const problemsSolvedElement = document.getElementById('problems-solved');
        const correctAnswersElement = document.getElementById('correct-answers');
        const factoryLevelElement = document.getElementById('factory-level');
        
        // مسائل التدريب
        const practiceProblems = [
            {
                problem: "ما حجم متوازي المستطيلات الذي طوله ٥، عرضه ٣، ارتفاعه ٢؟",
                answer: 30,
                options: [25, 30, 35, 40]
            },
            {
                problem: "صندوق طوله ٤، عرضه ٤، ارتفاعه ٤، ما حجمه؟",
                answer: 64,
                options: [16, 32, 64, 128]
            },
            {
                problem: "ما حجم متوازي المستطيلات الذي طوله ٦، عرضه ٢، ارتفاعه ٣؟",
                answer: 36,
                options: [11, 18, 36, 72]
            },
            {
                problem: "إذا كان حجم صندوق ٢٤ وحدة مكعبة، وطوله ٣، عرضه ٢، فما ارتفاعه؟",
                answer: 4,
                options: [2, 3, 4, 6]
            }
        ];
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeCanvas();
            setupEventListeners();
            updateDimensions();
            calculateVolume();
            drawCuboid();
        });
        
        function setupEventListeners() {
            // أحداث المدخلات
            lengthInput.addEventListener('input', function() {
                length = parseInt(this.value);
                lengthValue.textContent = `${length} وحدات`;
                updateDimensions();
            });
            
            widthInput.addEventListener('input', function() {
                width = parseInt(this.value);
                widthValue.textContent = `${width} وحدات`;
                updateDimensions();
            });
            
            heightInput.addEventListener('input', function() {
                height = parseInt(this.value);
                heightValue.textContent = `${height} وحدات`;
                updateDimensions();
            });
            
            // أحداث أزرار التحكم
            calculateBtn.addEventListener('click', calculateVolume);
            resetBtn.addEventListener('click', resetFactory);
            practiceBtn.addEventListener('click', startPractice);
            
            // أحداث وحدات القياس
            unitCubes.forEach(cube => {
                cube.addEventListener('click', function() {
                    unitCubes.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    unitSize = parseInt(this.dataset.unit);
                    updateDimensions();
                });
            });
        }
        
        function initializeCanvas() {
            cubeCanvas.width = 280;
            cubeCanvas.height = 280;
        }
        
        function updateDimensions() {
            drawCuboid();
            updateFormula();
        }
        
        function drawCuboid() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, cubeCanvas.width, cubeCanvas.height);
            
            const centerX = cubeCanvas.width / 2;
            const centerY = cubeCanvas.height / 2;
            
            // حساب الأبعاد مع مراعاة وحدة القياس
            const scaledLength = length * unitSize * 8;
            const scaledWidth = width * unitSize * 8;
            const scaledHeight = height * unitSize * 8;
            
            // رسم متوازي المستطيلات ثلاثي الأبعاد
            draw3DCuboid(centerX, centerY, scaledLength, scaledWidth, scaledHeight);
            
            // رسم المكعبات الصغيرة إذا كانت الوحدة 1
            if (unitSize === 1) {
                drawUnitCubes(centerX, centerY, length, width, height);
            }
        }
        
        function draw3DCuboid(x, y, l, w, h) {
            const perspective = 0.3;
            
            // النقاط الأساسية
            const points = [
                { x: x - l/2, y: y - h/2 }, // أمامي علوي يسار
                { x: x + l/2, y: y - h/2 }, // أمامي علوي يمين
                { x: x + l/2, y: y + h/2 }, // أمامي سفلي يمين
                { x: x - l/2, y: y + h/2 }, // أمامي سفلي يسار
                
                { x: x - l/2 + w * perspective, y: y - h/2 - w * perspective }, // خلفي علوي يسار
                { x: x + l/2 + w * perspective, y: y - h/2 - w * perspective }, // خلفي علوي يمين
                { x: x + l/2 + w * perspective, y: y + h/2 - w * perspective }, // خلفي سفلي يمين
                { x: x - l/2 + w * perspective, y: y + h/2 - w * perspective }  // خلفي سفلي يسار
            ];
            
            // الوجوه الأمامية
            ctx.strokeStyle = '#00b894';
            ctx.lineWidth = 2;
            ctx.fillStyle = 'rgba(0, 184, 148, 0.3)';
            
            // الوجه الأمامي
            ctx.beginPath();
            ctx.moveTo(points[0].x, points[0].y);
            ctx.lineTo(points[1].x, points[1].y);
            ctx.lineTo(points[2].x, points[2].y);
            ctx.lineTo(points[3].x, points[3].y);
            ctx.closePath();
            ctx.fill();
            ctx.stroke();
            
            // الوجه العلوي
            ctx.fillStyle = 'rgba(0, 184, 148, 0.2)';
            ctx.beginPath();
            ctx.moveTo(points[0].x, points[0].y);
            ctx.lineTo(points[1].x, points[1].y);
            ctx.lineTo(points[5].x, points[5].y);
            ctx.lineTo(points[4].x, points[4].y);
            ctx.closePath();
            ctx.fill();
            ctx.stroke();
            
            // الوجه الجانبي
            ctx.fillStyle = 'rgba(0, 184, 148, 0.15)';
            ctx.beginPath();
            ctx.moveTo(points[1].x, points[1].y);
            ctx.lineTo(points[2].x, points[2].y);
            ctx.lineTo(points[6].x, points[6].y);
            ctx.lineTo(points[5].x, points[5].y);
            ctx.closePath();
            ctx.fill();
            ctx.stroke();
            
            // الخطوط الخلفية
            ctx.strokeStyle = '#00b894';
            ctx.setLineDash([5, 3]);
            ctx.beginPath();
            ctx.moveTo(points[4].x, points[4].y);
            ctx.lineTo(points[5].x, points[5].y);
            ctx.lineTo(points[6].x, points[6].y);
            ctx.lineTo(points[7].x, points[7].y);
            ctx.closePath();
            ctx.stroke();
            
            ctx.beginPath();
            ctx.moveTo(points[5].x, points[5].y);
            ctx.lineTo(points[6].x, points[6].y);
            ctx.stroke();
            
            ctx.beginPath();
            ctx.moveTo(points[4].x, points[4].y);
            ctx.lineTo(points[7].x, points[7].y);
            ctx.stroke();
            
            ctx.setLineDash([]);
        }
        
        function drawUnitCubes(centerX, centerY, l, w, h) {
            const cubeSize = 15;
            const spacing = 18;
            
            ctx.fillStyle = '#fd79a8';
            ctx.strokeStyle = '#e84393';
            ctx.lineWidth = 1;
            
            // رسم المكعبات في جميع الطبقات
            for (let z = 0; z < h; z++) {
                for (let y = 0; y < w; y++) {
                    for (let x = 0; x < l; x++) {
                        const cubeX = centerX - (l * spacing)/2 + (x * spacing) + (y * 5);
                        const cubeY = centerY - (h * spacing)/2 + (z * spacing) - (y * 5);
                        
                        ctx.fillRect(cubeX, cubeY, cubeSize, cubeSize);
                        ctx.strokeRect(cubeX, cubeY, cubeSize, cubeSize);
                    }
                }
            }
        }
        
        function updateFormula() {
            formulaDisplay.textContent = `الحجم = الطول × العرض × الارتفاع`;
        }
        
        function calculateVolume() {
            currentVolume = length * width * height;
            const totalVolume = currentVolume * (unitSize * unitSize * unitSize);
            
            volumeResult.textContent = `${length} × ${width} × ${height} = ${currentVolume} وحدة مكعبة`;
            
            // تحديث خطوات الحساب
            step1.textContent = `<strong>الخطوة ١:</strong> عدد المكعبات في الطبقة الأولى = ${length} × ${width} = ${length * width}`;
            step2.textContent = `<strong>الخطوة ٢:</strong> عدد الطبقات = ${height}`;
            step3.textContent = `<strong>الخطوة ٣:</strong> الحجم الكلي = ${length * width} × ${height} = ${currentVolume} وحدة مكعبة`;
            
            if (unitSize > 1) {
                volumeResult.textContent += ` (${totalVolume} مع الوحدة الكبيرة)`;
            }
            
            problemsSolved++;
            if (problemsSolved % 5 === 0) {
                factoryLevel++;
            }
            
            updateStats();
            
            feedbackArea.className = 'feedback-area feedback-success celebrate';
            feedbackArea.textContent = `🎉 تم حساب الحجم بنجاح! ${currentVolume} وحدة مكعبة`;
        }
        
        function resetFactory() {
            length = 4;
            width = 3;
            height = 2;
            unitSize = 1;
            
            lengthInput.value = length;
            widthInput.value = width;
            heightInput.value = height;
            
            lengthValue.textContent = `${length} وحدات`;
            widthValue.textContent = `${width} وحدات`;
            heightValue.textContent = `${height} وحدات`;
            
            unitCubes.forEach(cube => {
                cube.classList.remove('active');
                if (parseInt(cube.dataset.unit) === 1) {
                    cube.classList.add('active');
                }
            });
            
            updateDimensions();
            calculateVolume();
            
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'تم إعادة التعيين! جرب أبعاد جديدة';
        }
        
        function startPractice() {
            const randomProblem = practiceProblems[Math.floor(Math.random() * practiceProblems.length)];
            
            practiceProblem.textContent = randomProblem.problem;
            practiceOptions.innerHTML = '';
            
            // خلط الخيارات
            const shuffledOptions = [...randomProblem.options].sort(() => Math.random() - 0.5);
            
            shuffledOptions.forEach(option => {
                const optionElement = document.createElement('div');
                optionElement.className = 'practice-option';
                optionElement.textContent = option;
                
                optionElement.addEventListener('click', function() {
                    checkPracticeAnswer(option, randomProblem.answer);
                });
                
                practiceOptions.appendChild(optionElement);
            });
            
            practiceSection.style.display = 'block';
        }
        
        function checkPracticeAnswer(selectedAnswer, correctAnswer) {
            const options = document.querySelectorAll('.practice-option');
            
            options.forEach(option => {
                if (parseInt(option.textContent) === correctAnswer) {
                    option.classList.add('correct');
                }
                if (parseInt(option.textContent) === selectedAnswer && selectedAnswer !== correctAnswer) {
                    option.classList.add('wrong');
                }
                option.style.pointerEvents = 'none';
            });
            
            if (selectedAnswer === correctAnswer) {
                correctAnswers++;
                feedbackArea.className = 'feedback-area feedback-success celebrate';
                feedbackArea.textContent = '🎉 إجابة صحيحة! أحسنت!';
            } else {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = `❌ إجابة خاطئة! الجواب الصحيح هو ${correctAnswer}`;
            }
            
            updateStats();
            
            // إخفاء قسم التدريب بعد 3 ثوان
            setTimeout(() => {
                practiceSection.style.display = 'none';
            }, 3000);
        }
        
        function updateStats() {
            problemsSolvedElement.textContent = problemsSolved;
            correctAnswersElement.textContent = correctAnswers;
            factoryLevelElement.textContent = factoryLevel;
        }
    </script>
</body>
</html>