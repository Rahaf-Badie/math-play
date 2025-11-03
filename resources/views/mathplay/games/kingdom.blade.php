<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مملكة المستطيلات - {{ $lesson_game->lesson->name }}</title>
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

        .kingdom-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .discovery-section {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 25px;
            border: 3px solid #e9ecef;
        }

        .interactive-section {
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

        .interactive-section .section-title {
            color: white;
        }

        .properties-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .property-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            border: 3px solid;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .property-card.active {
            border-width: 5px;
        }

        .property-sides { border-color: #00b894; }
        .property-angles { border-color: #fd79a8; }
        .property-diagonals { border-color: #fdcb6e; }
        .property-symmetry { border-color: #6c5ce7; }

        .property-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .property-name {
            font-weight: bold;
            margin-bottom: 10px;
            color: #2d3436;
        }

        .property-description {
            font-size: 0.9rem;
            color: #636e72;
            line-height: 1.4;
        }

        .rectangle-canvas-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        #rectangle-canvas {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .dimensions-panel {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .dimension-controls {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 15px 0;
        }

        .dimension-group {
            text-align: center;
        }

        .dimension-label {
            font-weight: bold;
            color: #2d3436;
            margin-bottom: 10px;
        }

        .dimension-input {
            width: 100%;
            padding: 10px;
            border: 2px solid #a29bfe;
            border-radius: 8px;
            text-align: center;
            font-size: 1.1rem;
        }

        .measurements-panel {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .measurement-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 10px;
            margin: 8px 0;
        }

        .measurement-label {
            font-weight: bold;
            color: #2d3436;
        }

        .measurement-value {
            font-weight: bold;
            color: #e84393;
        }

        .kingdom-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .kingdom-btn {
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

        #explore-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #compare-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #quiz-btn {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .kingdom-btn:hover {
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

        .comparison-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            display: none;
        }

        .shapes-comparison {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }

        .shape-card {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .shape-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #2d3436;
        }

        .quiz-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            display: none;
        }

        .quiz-question {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #2d3436;
        }

        .quiz-options {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .quiz-option {
            padding: 15px;
            background: #f8f9fa;
            border: 2px solid #dfe6e9;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quiz-option:hover {
            background: #e9ecef;
        }

        .quiz-option.correct {
            background: #00b894;
            color: white;
            border-color: #00b894;
        }

        .quiz-option.wrong {
            background: #ff7675;
            color: white;
            border-color: #ff7675;
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

        @media (max-width: 768px) {
            .kingdom-layout {
                grid-template-columns: 1fr;
            }
            
            .properties-grid, .real-world-examples, .stats-panel {
                grid-template-columns: 1fr;
            }
            
            .dimension-controls, .shapes-comparison {
                grid-template-columns: 1fr;
            }
            
            .kingdom-controls {
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
            <h1 class="lesson-title">🏰 مملكة المستطيلات</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="kingdom-layout">
            <div class="discovery-section">
                <div class="section-title">📚 اكتشف خصائص المستطيل</div>
                
                <div class="properties-grid">
                    <div class="property-card property-sides" data-property="sides">
                        <div class="property-icon">📏</div>
                        <div class="property-name">الأضلاع</div>
                        <div class="property-description">
                            كل ضلعين متقابلين متساويان ومتوازيان
                        </div>
                    </div>
                    
                    <div class="property-card property-angles" data-property="angles">
                        <div class="property-icon">📐</div>
                        <div class="property-name">الزوايا</div>
                        <div class="property-description">
                            جميع زوايا المستطيل قائمة (٩٠ درجة)
                        </div>
                    </div>
                    
                    <div class="property-card property-diagonals" data-property="diagonals">
                        <div class="property-icon">✳️</div>
                        <div class="property-name">الأقطار</div>
                        <div class="property-description">
                            قطرا المستطيل متساويان وينصف كل منهما الآخر
                        </div>
                    </div>
                    
                    <div class="property-card property-symmetry" data-property="symmetry">
                        <div class="property-icon">🔄</div>
                        <div class="property-name">التناظر</div>
                        <div class="property-description">
                            للمستطيل محورا تناظر فقط
                        </div>
                    </div>
                </div>
                
                <div class="dimensions-panel">
                    <div class="section-title">🔧 عدّل أبعاد المستطيل</div>
                    <div class="dimension-controls">
                        <div class="dimension-group">
                            <div class="dimension-label">الطول</div>
                            <input type="range" class="dimension-input" id="length-input" min="80" max="200" value="150">
                            <div class="measurement-value" id="length-value">١٥٠ وحدة</div>
                        </div>
                        <div class="dimension-group">
                            <div class="dimension-label">العرض</div>
                            <input type="range" class="dimension-input" id="width-input" min="50" max="150" value="100">
                            <div class="measurement-value" id="width-value">١٠٠ وحدة</div>
                        </div>
                    </div>
                </div>
                
                <div class="real-world-examples">
                    <div class="example-card">
                        <div class="example-icon">📱</div>
                        <h5>شاشة الهاتف</h5>
                        <p>أضلاع متقابلة متساوية</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">🚪</div>
                        <h5>الباب</h5>
                        <p>زوايا قائمة</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">📘</div>
                        <h5>الصفحة</h5>
                        <p>أقطار متساوية</p>
                    </div>
                </div>
                
                <div class="stats-panel">
                    <div class="stat-card">
                        <div class="stat-value" id="properties-learned">٠</div>
                        <div class="stat-label">خصائص مكتشفة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="correct-answers">٠</div>
                        <div class="stat-label">إجابات صحيحة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="explorer-level">١</div>
                        <div class="stat-label">مستوى المستكشف</div>
                    </div>
                </div>
            </div>
            
            <div class="interactive-section">
                <div class="section-title">🎯 المعمل التفاعلي</div>
                
                <div class="rectangle-canvas-container">
                    <canvas id="rectangle-canvas" width="300" height="300"></canvas>
                </div>
                
                <div class="measurements-panel">
                    <div class="measurement-item">
                        <span class="measurement-label">المحيط:</span>
                        <span class="measurement-value" id="perimeter-value">٠ وحدة</span>
                    </div>
                    <div class="measurement-item">
                        <span class="measurement-label">المساحة:</span>
                        <span class="measurement-value" id="area-value">٠ وحدة²</span>
                    </div>
                    <div class="measurement-item">
                        <span class="measurement-label">طول القطر:</span>
                        <span class="measurement-value" id="diagonal-value">٠ وحدة</span>
                    </div>
                    <div class="measurement-item">
                        <span class="measurement-label">نسبة الطول إلى العرض:</span>
                        <span class="measurement-value" id="ratio-value">٠:٠</span>
                    </div>
                </div>
                
                <div class="kingdom-controls">
                    <button class="kingdom-btn" id="explore-btn">
                        🔍 استكشاف الخصائص
                    </button>
                    <button class="kingdom-btn" id="compare-btn">
                        ⚖️ مقارنة مع المربع
                    </button>
                    <button class="kingdom-btn" id="quiz-btn">
                        ❓ اختبر معرفتك
                    </button>
                </div>
                
                <div class="feedback-area" id="feedback-area">
                    حرك أزرار الطول والعرض وشاهد التغيرات!
                </div>
                
                <div class="comparison-section" id="comparison-section">
                    <div class="section-title">⚖️ مقارنة: المستطيل vs المربع</div>
                    <div class="shapes-comparison">
                        <div class="shape-card">
                            <div class="shape-title">المستطيل</div>
                            <div>• الأضلاع: متقابلة متساوية</div>
                            <div>• الزوايا: ٩٠ درجة</div>
                            <div>• الأقطار: متساوية</div>
                            <div>• التناظر: محوران</div>
                        </div>
                        <div class="shape-card">
                            <div class="shape-title">المربع</div>
                            <div>• الأضلاع: جميعها متساوية</div>
                            <div>• الزوايا: ٩٠ درجة</div>
                            <div>• الأقطار: متساوية ومتعامدة</div>
                            <div>• التناظر: ٤ محاور</div>
                        </div>
                    </div>
                </div>
                
                <div class="quiz-section" id="quiz-section">
                    <div class="quiz-question" id="quiz-question">
                        ما عدد أضلاع المستطيل؟
                    </div>
                    <div class="quiz-options" id="quiz-options">
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
        let propertiesLearned = 0;
        let correctAnswers = 0;
        let explorerLevel = 1;
        let currentProperty = null;
        let rectangleLength = 150;
        let rectangleWidth = 100;
        
        // عناصر DOM
        const rectangleCanvas = document.getElementById('rectangle-canvas');
        const ctx = rectangleCanvas.getContext('2d');
        const lengthInput = document.getElementById('length-input');
        const widthInput = document.getElementById('width-input');
        const lengthValue = document.getElementById('length-value');
        const widthValue = document.getElementById('width-value');
        const perimeterValue = document.getElementById('perimeter-value');
        const areaValue = document.getElementById('area-value');
        const diagonalValue = document.getElementById('diagonal-value');
        const ratioValue = document.getElementById('ratio-value');
        const exploreBtn = document.getElementById('explore-btn');
        const compareBtn = document.getElementById('compare-btn');
        const quizBtn = document.getElementById('quiz-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const comparisonSection = document.getElementById('comparison-section');
        const quizSection = document.getElementById('quiz-section');
        const quizQuestion = document.getElementById('quiz-question');
        const quizOptions = document.getElementById('quiz-options');
        const propertyCards = document.querySelectorAll('.property-card');
        const propertiesLearnedElement = document.getElementById('properties-learned');
        const correctAnswersElement = document.getElementById('correct-answers');
        const explorerLevelElement = document.getElementById('explorer-level');
        
        // أسئلة الاختبار
        const quizQuestions = [
            {
                question: "ما عدد أضلاع المستطيل؟",
                options: ["٣ أضلاع", "٤ أضلاع", "٥ أضلاع", "٦ أضلاع"],
                correct: 1
            },
            {
                question: "كيف تكون أضلاع المستطيل؟",
                options: ["جميعها متساوية", "مختلفة الأطوال", "المتقابلة متساوية", "غير متوازية"],
                correct: 2
            },
            {
                question: "ما قياس زوايا المستطيل؟",
                options: ["٤٥ درجة", "٦٠ درجة", "٩٠ درجة", "١٢٠ درجة"],
                correct: 2
            },
            {
                question: "كم عدد محاور التناظر في المستطيل؟",
                options: ["محور واحد", "محوران", "٣ محاور", "٤ محاور"],
                correct: 1
            },
            {
                question: "كيف تكون أقطار المستطيل؟",
                options: ["مختلفة الأطوال", "متساوية الطول", "متعامدة", "غير متقاطعة"],
                correct: 1
            }
        ];
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeCanvas();
            setupEventListeners();
            drawRectangle();
            updateMeasurements();
        });
        
        function setupEventListeners() {
            // أحداث أزرار التحكم
            exploreBtn.addEventListener('click', exploreProperties);
            compareBtn.addEventListener('click', toggleComparison);
            quizBtn.addEventListener('click', startQuiz);
            
            // أحداث المدخلات
            lengthInput.addEventListener('input', function() {
                rectangleLength = parseInt(this.value);
                lengthValue.textContent = `${rectangleLength} وحدة`;
                updateRectangle();
            });
            
            widthInput.addEventListener('input', function() {
                rectangleWidth = parseInt(this.value);
                widthValue.textContent = `${rectangleWidth} وحدة`;
                updateRectangle();
            });
            
            // أحداث بطاقات الخصائص
            propertyCards.forEach(card => {
                card.addEventListener('click', function() {
                    selectProperty(this.dataset.property);
                });
            });
        }
        
        function initializeCanvas() {
            rectangleCanvas.width = 300;
            rectangleCanvas.height = 300;
        }
        
        function drawRectangle() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, rectangleCanvas.width, rectangleCanvas.height);
            
            const centerX = rectangleCanvas.width / 2;
            const centerY = rectangleCanvas.height / 2;
            
            // رسم المستطيل
            ctx.strokeStyle = '#00b894';
            ctx.lineWidth = 4;
            ctx.fillStyle = 'rgba(0, 184, 148, 0.1)';
            
            const x = centerX - rectangleLength/2;
            const y = centerY - rectangleWidth/2;
            
            ctx.beginPath();
            ctx.rect(x, y, rectangleLength, rectangleWidth);
            ctx.fill();
            ctx.stroke();
            
            // رسم الخصائص المحددة
            if (currentProperty === 'sides') {
                drawSidesProperties(x, y);
            } else if (currentProperty === 'angles') {
                drawAnglesProperties(x, y);
            } else if (currentProperty === 'diagonals') {
                drawDiagonalsProperties(x, y);
            } else if (currentProperty === 'symmetry') {
                drawSymmetryProperties(centerX, centerY);
            }
        }
        
        function drawSidesProperties(x, y) {
            ctx.strokeStyle = '#fd79a8';
            ctx.lineWidth = 2;
            ctx.setLineDash([5, 3]);
            
            // تساوي الأضلاع المتقابلة
            ctx.beginPath();
            ctx.moveTo(x, y - 10);
            ctx.lineTo(x + rectangleLength, y - 10);
            ctx.stroke();
            
            ctx.beginPath();
            ctx.moveTo(x, y + rectangleWidth + 10);
            ctx.lineTo(x + rectangleLength, y + rectangleWidth + 10);
            ctx.stroke();
            
            ctx.beginPath();
            ctx.moveTo(x - 10, y);
            ctx.lineTo(x - 10, y + rectangleWidth);
            ctx.stroke();
            
            ctx.beginPath();
            ctx.moveTo(x + rectangleLength + 10, y);
            ctx.lineTo(x + rectangleLength + 10, y + rectangleWidth);
            ctx.stroke();
            
            ctx.setLineDash([]);
            
            // كتابة أطوال الأضلاع
            ctx.fillStyle = '#fd79a8';
            ctx.font = '14px Arial';
            ctx.fillText(`${rectangleLength}`, x + rectangleLength/2 - 15, y - 15);
            ctx.fillText(`${rectangleLength}`, x + rectangleLength/2 - 15, y + rectangleWidth + 25);
            ctx.fillText(`${rectangleWidth}`, x - 25, y + rectangleWidth/2 - 5);
            ctx.fillText(`${rectangleWidth}`, x + rectangleLength + 20, y + rectangleWidth/2 - 5);
        }
        
        function drawAnglesProperties(x, y) {
            ctx.strokeStyle = '#fdcb6e';
            ctx.lineWidth = 2;
            
            // رسم علامات الزوايا القائمة
            const angleSize = 15;
            
            // الزاوية العلوية اليسرى
            ctx.beginPath();
            ctx.moveTo(x, y);
            ctx.lineTo(x + angleSize, y);
            ctx.lineTo(x + angleSize, y + angleSize);
            ctx.stroke();
            
            // الزاوية العلوية اليمنى
            ctx.beginPath();
            ctx.moveTo(x + rectangleLength, y);
            ctx.lineTo(x + rectangleLength - angleSize, y);
            ctx.lineTo(x + rectangleLength - angleSize, y + angleSize);
            ctx.stroke();
            
            // الزاوية السفلية اليمنى
            ctx.beginPath();
            ctx.moveTo(x + rectangleLength, y + rectangleWidth);
            ctx.lineTo(x + rectangleLength - angleSize, y + rectangleWidth);
            ctx.lineTo(x + rectangleLength - angleSize, y + rectangleWidth - angleSize);
            ctx.stroke();
            
            // الزاوية السفلية اليسرى
            ctx.beginPath();
            ctx.moveTo(x, y + rectangleWidth);
            ctx.lineTo(x + angleSize, y + rectangleWidth);
            ctx.lineTo(x + angleSize, y + rectangleWidth - angleSize);
            ctx.stroke();
            
            // كتابة قياس الزوايا
            ctx.fillStyle = '#fdcb6e';
            ctx.font = '12px Arial';
            ctx.fillText('٩٠°', x + 20, y + 10);
            ctx.fillText('٩٠°', x + rectangleLength - 25, y + 10);
            ctx.fillText('٩٠°', x + rectangleLength - 25, y + rectangleWidth - 5);
            ctx.fillText('٩٠°', x + 20, y + rectangleWidth - 5);
        }
        
        function drawDiagonalsProperties(x, y) {
            ctx.strokeStyle = '#6c5ce7';
            ctx.lineWidth = 2;
            ctx.setLineDash([5, 3]);
            
            // رسم الأقطار
            ctx.beginPath();
            ctx.moveTo(x, y);
            ctx.lineTo(x + rectangleLength, y + rectangleWidth);
            ctx.stroke();
            
            ctx.beginPath();
            ctx.moveTo(x + rectangleLength, y);
            ctx.lineTo(x, y + rectangleWidth);
            ctx.stroke();
            
            ctx.setLineDash([]);
            
            // رسم نقطة التقاء الأقطار
            const centerX = x + rectangleLength/2;
            const centerY = y + rectangleWidth/2;
            
            ctx.fillStyle = '#e84393';
            ctx.beginPath();
            ctx.arc(centerX, centerY, 5, 0, Math.PI * 2);
            ctx.fill();
            
            // كتابة أطوال الأقطار
            const diagonal = Math.sqrt(rectangleLength * rectangleLength + rectangleWidth * rectangleWidth);
            ctx.fillStyle = '#6c5ce7';
            ctx.font = '12px Arial';
            ctx.fillText(`${Math.round(diagonal)}`, centerX - 15, centerY - 10);
        }
        
        function drawSymmetryProperties(centerX, centerY) {
            ctx.strokeStyle = '#a29bfe';
            ctx.lineWidth = 2;
            ctx.setLineDash([5, 5]);
            
            // محوري التناظر
            ctx.beginPath();
            ctx.moveTo(centerX, centerY - rectangleWidth/2 - 10);
            ctx.lineTo(centerX, centerY + rectangleWidth/2 + 10);
            ctx.stroke();
            
            ctx.beginPath();
            ctx.moveTo(centerX - rectangleLength/2 - 10, centerY);
            ctx.lineTo(centerX + rectangleLength/2 + 10, centerY);
            ctx.stroke();
            
            ctx.setLineDash([]);
            
            // كتابة تسمية محاور التناظر
            ctx.fillStyle = '#a29bfe';
            ctx.font = '12px Arial';
            ctx.fillText('محور التناظر', centerX + 10, centerY - rectangleWidth/2 - 15);
            ctx.fillText('محور التناظر', centerX + rectangleLength/2 + 15, centerY - 5);
        }
        
        function updateRectangle() {
            drawRectangle();
            updateMeasurements();
        }
        
        function updateMeasurements() {
            const perimeter = 2 * (rectangleLength + rectangleWidth);
            const area = rectangleLength * rectangleWidth;
            const diagonal = Math.sqrt(rectangleLength * rectangleLength + rectangleWidth * rectangleWidth);
            const ratio = (rectangleLength / rectangleWidth).toFixed(1);
            
            perimeterValue.textContent = `${perimeter} وحدة`;
            areaValue.textContent = `${area} وحدة²`;
            diagonalValue.textContent = `${Math.round(diagonal)} وحدة`;
            ratioValue.textContent = `${ratio}:١`;
        }
        
        function selectProperty(property) {
            currentProperty = property;
            
            // تحديث المظهر
            propertyCards.forEach(card => {
                card.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // عرض المعلومات
            let message = '';
            switch(property) {
                case 'sides':
                    message = '🎯 كل ضلعين متقابلين في المستطيل متساويان ومتوازيان!';
                    break;
                case 'angles':
                    message = '🎯 جميع زوايا المستطيل قائمة (٩٠ درجة)!';
                    break;
                case 'diagonals':
                    message = '🎯 قطرا المستطيل متساويان وينصف كل منهما الآخر!';
                    break;
                case 'symmetry':
                    message = '🎯 للمستطيل محورا تناظر فقط (أفقي ورأسي)!';
                    break;
            }
            
            feedbackArea.className = 'feedback-area feedback-success';
            feedbackArea.textContent = message;
            
            propertiesLearned++;
            if (propertiesLearned % 4 === 0) {
                explorerLevel++;
            }
            
            updateStats();
            drawRectangle();
        }
        
        function exploreProperties() {
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = '🔍 انقر على أي خاصية من الخصائص الأربع لاكتشافها!';
        }
        
        function toggleComparison() {
            const isVisible = comparisonSection.style.display === 'block';
            comparisonSection.style.display = isVisible ? 'none' : 'block';
            quizSection.style.display = 'none';
            
            if (!isVisible) {
                feedbackArea.className = 'feedback-area feedback-info';
                feedbackArea.textContent = '⚖️ لاحظ الفروق بين المستطيل والمربع!';
            }
        }
        
        function startQuiz() {
            const randomQuestion = quizQuestions[Math.floor(Math.random() * quizQuestions.length)];
            
            quizQuestion.textContent = randomQuestion.question;
            quizOptions.innerHTML = '';
            comparisonSection.style.display = 'none';
            quizSection.style.display = 'block';
            
            randomQuestion.options.forEach((option, index) => {
                const optionElement = document.createElement('div');
                optionElement.className = 'quiz-option';
                optionElement.textContent = option;
                optionElement.dataset.index = index;
                
                optionElement.addEventListener('click', function() {
                    checkQuizAnswer(parseInt(this.dataset.index), randomQuestion.correct);
                });
                
                quizOptions.appendChild(optionElement);
            });
        }
        
        function checkQuizAnswer(selectedIndex, correctIndex) {
            const options = document.querySelectorAll('.quiz-option');
            
            options.forEach((option, index) => {
                if (index === correctIndex) {
                    option.classList.add('correct');
                }
                if (index === selectedIndex && index !== correctIndex) {
                    option.classList.add('wrong');
                }
                option.style.pointerEvents = 'none';
            });
            
            if (selectedIndex === correctIndex) {
                correctAnswers++;
                feedbackArea.className = 'feedback-area feedback-success celebrate';
                feedbackArea.textContent = '🎉 إجابة صحيحة! أحسنت!';
            } else {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = '❌ إجابة خاطئة! حاول مرة أخرى';
            }
            
            updateStats();
            
            // إخفاء الاختبار بعد 3 ثوان
            setTimeout(() => {
                quizSection.style.display = 'none';
            }, 3000);
        }
        
        function updateStats() {
            propertiesLearnedElement.textContent = propertiesLearned;
            correctAnswersElement.textContent = correctAnswers;
            explorerLevelElement.textContent = explorerLevel;
        }
    </script>
</body>
</html>