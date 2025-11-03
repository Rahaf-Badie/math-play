<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مستكشف خصائص المربع - {{ $lesson_game->lesson->name }}</title>
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

        .explorer-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .theory-section {
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

        .square-properties {
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

        .property-side { border-color: #00b894; }
        .property-angle { border-color: #fd79a8; }
        .property-diagonal { border-color: #fdcb6e; }
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

        .square-canvas-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        #square-canvas {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .measurement-panel {
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
            margin: 10px 0;
        }

        .measurement-label {
            font-weight: bold;
            color: #2d3436;
        }

        .measurement-value {
            font-weight: bold;
            color: #e84393;
        }

        .control-panel {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .control-btn {
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

        #transform-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #quiz-btn {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .control-btn:hover {
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
            .explorer-layout {
                grid-template-columns: 1fr;
            }
            
            .square-properties, .real-world-examples, .stats-panel {
                grid-template-columns: 1fr;
            }
            
            .control-panel {
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
            <h1 class="lesson-title">🔍 مستكشف خصائص المربع</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="explorer-layout">
            <div class="theory-section">
                <div class="section-title">📚 خصائص المربع</div>
                
                <div class="square-properties">
                    <div class="property-card property-side" data-property="sides">
                        <div class="property-icon">📏</div>
                        <div class="property-name">الأضلاع</div>
                        <div class="property-description">
                            جميع أضلاع المربع متساوية في الطول
                        </div>
                    </div>
                    
                    <div class="property-card property-angle" data-property="angles">
                        <div class="property-icon">📐</div>
                        <div class="property-name">الزوايا</div>
                        <div class="property-description">
                            جميع زوايا المربع قائمة (٩٠ درجة)
                        </div>
                    </div>
                    
                    <div class="property-card property-diagonal" data-property="diagonals">
                        <div class="property-icon">✳️</div>
                        <div class="property-name">الأقطار</div>
                        <div class="property-description">
                            قطرا المربع متساويان ومتعامدان وينصف كل منهما الآخر
                        </div>
                    </div>
                    
                    <div class="property-card property-symmetry" data-property="symmetry">
                        <div class="property-icon">🔄</div>
                        <div class="property-name">التناظر</div>
                        <div class="property-description">
                            للمربع ٤ محاور تناظر
                        </div>
                    </div>
                </div>
                
                <div class="real-world-examples">
                    <div class="example-card">
                        <div class="example-icon">🧱</div>
                        <h5>بلاط الأرضية</h5>
                        <p>أضلاع متساوية وزوايا قائمة</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">📦</div>
                        <h5>صناديق</h5>
                        <p>أقطار متساوية ومتعامدة</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">🪟</div>
                        <h5>النوافذ</h5>
                        <p>تناظر في جميع الاتجاهات</p>
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
                <div class="section-title">🎯 منطقة الاستكشاف التفاعلي</div>
                
                <div class="square-canvas-container">
                    <canvas id="square-canvas" width="300" height="300"></canvas>
                </div>
                
                <div class="measurement-panel">
                    <div class="measurement-item">
                        <span class="measurement-label">طول الضلع:</span>
                        <span class="measurement-value" id="side-length">٠ وحدة</span>
                    </div>
                    <div class="measurement-item">
                        <span class="measurement-label">قياس الزاوية:</span>
                        <span class="measurement-value" id="angle-measure">٠°</span>
                    </div>
                    <div class="measurement-item">
                        <span class="measurement-label">طول القطر:</span>
                        <span class="measurement-value" id="diagonal-length">٠ وحدة</span>
                    </div>
                    <div class="measurement-item">
                        <span class="measurement-label">المساحة:</span>
                        <span class="measurement-value" id="area-value">٠ وحدة²</span>
                    </div>
                </div>
                
                <div class="control-panel">
                    <button class="control-btn" id="transform-btn">
                        🔄 تحويل الشكل
                    </button>
                    <button class="control-btn" id="reset-btn">
                        🏠 إعادة تعيين
                    </button>
                    <button class="control-btn" id="quiz-btn">
                        ❓ اختبر معرفتك
                    </button>
                </div>
                
                <div class="feedback-area" id="feedback-area">
                    انقر على خصائص المربع لاكتشافها!
                </div>
                
                <div class="quiz-section" id="quiz-section">
                    <div class="quiz-question" id="quiz-question">
                        ما عدد أضلاع المربع؟
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
        let squareSize = 150;
        let isTransformed = false;
        
        // عناصر DOM
        const squareCanvas = document.getElementById('square-canvas');
        const ctx = squareCanvas.getContext('2d');
        const sideLengthElement = document.getElementById('side-length');
        const angleMeasureElement = document.getElementById('angle-measure');
        const diagonalLengthElement = document.getElementById('diagonal-length');
        const areaValueElement = document.getElementById('area-value');
        const transformBtn = document.getElementById('transform-btn');
        const resetBtn = document.getElementById('reset-btn');
        const quizBtn = document.getElementById('quiz-btn');
        const feedbackArea = document.getElementById('feedback-area');
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
                question: "ما عدد أضلاع المربع؟",
                options: ["٣ أضلاع", "٤ أضلاع", "٥ أضلاع", "٦ أضلاع"],
                correct: 1
            },
            {
                question: "ما قياس كل زاوية في المربع؟",
                options: ["٤٥ درجة", "٦٠ درجة", "٩٠ درجة", "١٢٠ درجة"],
                correct: 2
            },
            {
                question: "كيف تكون أضلاع المربع؟",
                options: ["مختلفة الأطوال", "متعامدة فقط", "متساوية ومتعامدة", "غير متساوية"],
                correct: 2
            },
            {
                question: "كم عدد محاور التناظر في المربع؟",
                options: ["محور واحد", "محوران", "٣ محاور", "٤ محاور"],
                correct: 3
            },
            {
                question: "كيف تكون أقطار المربع؟",
                options: ["مختلفة الأطوال", "متساوية ومتعامدة", "غير متعامدة", "متعامدة فقط"],
                correct: 1
            }
        ];
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeCanvas();
            setupEventListeners();
            drawSquare();
            updateMeasurements();
        });
        
        function setupEventListeners() {
            transformBtn.addEventListener('click', transformSquare);
            resetBtn.addEventListener('click', resetSquare);
            quizBtn.addEventListener('click', startQuiz);
            
            // أحداث بطاقات الخصائص
            propertyCards.forEach(card => {
                card.addEventListener('click', function() {
                    exploreProperty(this.dataset.property);
                });
            });
        }
        
        function initializeCanvas() {
            squareCanvas.width = 300;
            squareCanvas.height = 300;
        }
        
        function drawSquare() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, squareCanvas.width, squareCanvas.height);
            
            const centerX = squareCanvas.width / 2;
            const centerY = squareCanvas.height / 2;
            
            if (isTransformed) {
                // رسم معين (للمقارنة)
                ctx.strokeStyle = '#ff7675';
                ctx.lineWidth = 3;
                ctx.setLineDash([5, 5]);
                
                ctx.beginPath();
                ctx.moveTo(centerX, centerY - squareSize/2);
                ctx.lineTo(centerX + squareSize/2, centerY);
                ctx.lineTo(centerX, centerY + squareSize/2);
                ctx.lineTo(centerX - squareSize/2, centerY);
                ctx.closePath();
                ctx.stroke();
                
                ctx.setLineDash([]);
            }
            
            // رسم المربع
            ctx.strokeStyle = '#00b894';
            ctx.lineWidth = 4;
            ctx.fillStyle = 'rgba(0, 184, 148, 0.1)';
            
            const x = centerX - squareSize/2;
            const y = centerY - squareSize/2;
            
            ctx.beginPath();
            ctx.rect(x, y, squareSize, squareSize);
            ctx.fill();
            ctx.stroke();
            
            // رسم الأقطار إذا كانت الخصائص مختارة
            if (currentProperty === 'diagonals' || currentProperty === 'symmetry') {
                ctx.strokeStyle = '#6c5ce7';
                ctx.lineWidth = 2;
                ctx.setLineDash([5, 3]);
                
                ctx.beginPath();
                ctx.moveTo(x, y);
                ctx.lineTo(x + squareSize, y + squareSize);
                ctx.stroke();
                
                ctx.beginPath();
                ctx.moveTo(x + squareSize, y);
                ctx.lineTo(x, y + squareSize);
                ctx.stroke();
                
                ctx.setLineDash([]);
                
                // رسم نقطة التقاء الأقطار
                ctx.fillStyle = '#e84393';
                ctx.beginPath();
                ctx.arc(centerX, centerY, 5, 0, Math.PI * 2);
                ctx.fill();
            }
            
            // إظهار الزوايا إذا كانت الخصائص مختارة
            if (currentProperty === 'angles') {
                drawAngleMarks(x, y, squareSize);
            }
        }
        
        function drawAngleMarks(x, y, size) {
            ctx.strokeStyle = '#fd79a8';
            ctx.lineWidth = 2;
            
            // الزاوية العلوية اليسرى
            ctx.beginPath();
            ctx.arc(x, y, 15, 0, Math.PI / 2);
            ctx.stroke();
            
            // الزاوية العلوية اليمنى
            ctx.beginPath();
            ctx.arc(x + size, y, 15, Math.PI / 2, Math.PI);
            ctx.stroke();
            
            // الزاوية السفلية اليمنى
            ctx.beginPath();
            ctx.arc(x + size, y + size, 15, Math.PI, 3 * Math.PI / 2);
            ctx.stroke();
            
            // الزاوية السفلية اليسرى
            ctx.beginPath();
            ctx.arc(x, y + size, 15, 3 * Math.PI / 2, 2 * Math.PI);
            ctx.stroke();
            
            // كتابة قياس الزوايا
            ctx.fillStyle = '#fd79a8';
            ctx.font = '12px Arial';
            ctx.fillText('٩٠°', x - 10, y - 10);
            ctx.fillText('٩٠°', x + size + 5, y - 10);
            ctx.fillText('٩٠°', x + size + 5, y + size + 15);
            ctx.fillText('٩٠°', x - 10, y + size + 15);
        }
        
        function updateMeasurements() {
            sideLengthElement.textContent = `${squareSize} وحدة`;
            angleMeasureElement.textContent = '٩٠°';
            
            const diagonal = Math.sqrt(2 * squareSize * squareSize);
            diagonalLengthElement.textContent = `${Math.round(diagonal)} وحدة`;
            
            const area = squareSize * squareSize;
            areaValueElement.textContent = `${area} وحدة²`;
        }
        
        function exploreProperty(property) {
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
                    message = '🎯 جميع أضلاع المربع متساوية في الطول!';
                    break;
                case 'angles':
                    message = '🎯 جميع زوايا المربع قائمة (٩٠ درجة)!';
                    break;
                case 'diagonals':
                    message = '🎯 قطرا المربع متساويان ومتعامدان وينصف كل منهما الآخر!';
                    break;
                case 'symmetry':
                    message = '🎯 للمربع ٤ محاور تناظر: محوران أفقيان ورأسيان ومحوران قطريان!';
                    break;
            }
            
            feedbackArea.className = 'feedback-area feedback-success';
            feedbackArea.textContent = message;
            
            propertiesLearned++;
            if (propertiesLearned % 4 === 0) {
                explorerLevel++;
            }
            
            updateStats();
            drawSquare();
        }
        
        function transformSquare() {
            isTransformed = !isTransformed;
            
            if (isTransformed) {
                feedbackArea.className = 'feedback-area feedback-info';
                feedbackArea.textContent = '🔍 لاحظ الفرق بين المربع (أخضر) والمعين (منقط)';
                transformBtn.innerHTML = '🔲 إرجاع المربع';
            } else {
                feedbackArea.className = 'feedback-area feedback-info';
                feedbackArea.textContent = '✅ هذا هو المربع الحقيقي بجميع خصائصه';
                transformBtn.innerHTML = '🔄 تحويل الشكل';
            }
            
            drawSquare();
        }
        
        function resetSquare() {
            squareSize = 150;
            currentProperty = null;
            isTransformed = false;
            
            propertyCards.forEach(card => {
                card.classList.remove('active');
            });
            
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'انقر على خصائص المربع لاكتشافها!';
            transformBtn.innerHTML = '🔄 تحويل الشكل';
            
            drawSquare();
            updateMeasurements();
        }
        
        function startQuiz() {
            const randomQuestion = quizQuestions[Math.floor(Math.random() * quizQuestions.length)];
            
            quizQuestion.textContent = randomQuestion.question;
            quizOptions.innerHTML = '';
            
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
            
            quizSection.style.display = 'block';
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