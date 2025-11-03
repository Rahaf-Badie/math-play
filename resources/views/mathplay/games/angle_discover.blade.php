<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مستكشف الزوايا - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 1000px;
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

        .game-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            border: 3px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

        .learning-area {
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

        .practice-section {
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

        .practice-section .section-title {
            color: white;
        }

        .angle-types {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .angle-type-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            border: 3px solid;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .angle-type-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .angle-type-card.active {
            border-width: 5px;
        }

        .acute { border-color: #00b894; }
        .right { border-color: #fd79a8; }
        .obtuse { border-color: #fdcb6e; }
        .straight { border-color: #6c5ce7; }

        .angle-visual {
            width: 80px;
            height: 80px;
            margin: 10px auto;
            position: relative;
        }

        .angle-arm {
            position: absolute;
            width: 60px;
            height: 4px;
            background: currentColor;
            top: 50%;
            left: 50%;
            transform-origin: left center;
        }

        .angle-arm-1 {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        .angle-arm-2.acute { transform: translate(-50%, -50%) rotate(45deg); }
        .angle-arm-2.right { transform: translate(-50%, -50%) rotate(90deg); }
        .angle-arm-2.obtuse { transform: translate(-50%, -50%) rotate(120deg); }
        .angle-arm-2.straight { transform: translate(-50%, -50%) rotate(180deg); }

        .angle-demo {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            margin: 20px 0;
        }

        #angle-canvas {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .angle-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
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

        #create-angle-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #identify-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #reset-angle-btn {
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

        .feedback-correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback-wrong {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .feedback-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .angle-info {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .angle-measure {
            font-size: 2rem;
            font-weight: bold;
            color: #e84393;
            margin: 10px 0;
        }

        .angle-classification {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00b894;
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

        @media (max-width: 768px) {
            .learning-area {
                grid-template-columns: 1fr;
            }
            
            .game-stats, .angle-types, .real-world-examples {
                grid-template-columns: 1fr;
            }
            
            .angle-controls {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="lesson-title">🧭 مستكشف الزوايا</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="game-stats">
            <div class="stat-card">
                <div class="stat-value" id="discovered-angles">0</div>
                <div class="stat-label">زوايا مكتشفة</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="correct-answers">0</div>
                <div class="stat-label">إجابات صحيحة</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="explorer-level">1</div>
                <div class="stat-label">مستوى المستكشف</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="accuracy">100%</div>
                <div class="stat-label">الدقة</div>
            </div>
        </div>
        
        <div class="learning-area">
            <div class="theory-section">
                <div class="section-title">📚 تعرف على الزوايا</div>
                
                <div class="angle-info">
                    <h3>ما هي الزاوية؟</h3>
                    <p>الزاوية هي شكل ناتج عن التقاء شعاعين في نقطة تسمى رأس الزاوية</p>
                </div>
                
                <div class="angle-types">
                    <div class="angle-type-card acute" data-type="acute">
                        <div class="angle-visual">
                            <div class="angle-arm angle-arm-1" style="color: #00b894;"></div>
                            <div class="angle-arm angle-arm-2 acute" style="color: #00b894;"></div>
                        </div>
                        <h4>زاوية حادة</h4>
                        <p>أقل من 90°</p>
                    </div>
                    
                    <div class="angle-type-card right" data-type="right">
                        <div class="angle-visual">
                            <div class="angle-arm angle-arm-1" style="color: #fd79a8;"></div>
                            <div class="angle-arm angle-arm-2 right" style="color: #fd79a8;"></div>
                        </div>
                        <h4>زاوية قائمة</h4>
                        <p>تساوي 90°</p>
                    </div>
                    
                    <div class="angle-type-card obtuse" data-type="obtuse">
                        <div class="angle-visual">
                            <div class="angle-arm angle-arm-1" style="color: #fdcb6e;"></div>
                            <div class="angle-arm angle-arm-2 obtuse" style="color: #fdcb6e;"></div>
                        </div>
                        <h4>زاوية منفرجة</h4>
                        <p>أكثر من 90° وأقل من 180°</p>
                    </div>
                    
                    <div class="angle-type-card straight" data-type="straight">
                        <div class="angle-visual">
                            <div class="angle-arm angle-arm-1" style="color: #6c5ce7;"></div>
                            <div class="angle-arm angle-arm-2 straight" style="color: #6c5ce7;"></div>
                        </div>
                        <h4>زاوية مستقيمة</h4>
                        <p>تساوي 180°</p>
                    </div>
                </div>
                
                <div class="real-world-examples">
                    <div class="example-card">
                        <div class="example-icon">📐</div>
                        <h5>زاوية حادة</h5>
                        <p>مثلث حاد الزوايا</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">📦</div>
                        <h5>زاوية قائمة</h5>
                        <p>زوايا الصندوق</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">🍕</div>
                        <h5>زاوية منفرجة</h5>
                        <p>شريحة بيتزا كبيرة</p>
                    </div>
                </div>
            </div>
            
            <div class="practice-section">
                <div class="section-title">🎯 منطقة الاكتشاف</div>
                
                <div class="angle-demo">
                    <canvas id="angle-canvas" width="300" height="300"></canvas>
                </div>
                
                <div class="angle-controls">
                    <button class="control-btn" id="create-angle-btn">
                        🎨 إنشاء زاوية
                    </button>
                    <button class="control-btn" id="identify-btn">
                        🔍 تعرف على النوع
                    </button>
                    <button class="control-btn" id="reset-angle-btn">
                        🔄 زاوية جديدة
                    </button>
                </div>
                
                <div class="feedback-area" id="feedback-area">
                    انقر على "إنشاء زاوية" لبدء الاكتشاف!
                </div>
                
                <div class="angle-info" style="background: rgba(255, 255, 255, 0.2); color: white;">
                    <h4>معلومات الزاوية:</h4>
                    <div class="angle-measure" id="angle-measure">--°</div>
                    <div class="angle-classification" id="angle-classification">--</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let discoveredAngles = 0;
        let correctAnswers = 0;
        let totalAttempts = 0;
        let explorerLevel = 1;
        let currentAngle = null;
        let isCreatingAngle = false;
        
        // عناصر DOM
        const canvas = document.getElementById('angle-canvas');
        const ctx = canvas.getContext('2d');
        const createAngleBtn = document.getElementById('create-angle-btn');
        const identifyBtn = document.getElementById('identify-btn');
        const resetAngleBtn = document.getElementById('reset-angle-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const angleMeasureElement = document.getElementById('angle-measure');
        const angleClassificationElement = document.getElementById('angle-classification');
        const discoveredAnglesElement = document.getElementById('discovered-angles');
        const correctAnswersElement = document.getElementById('correct-answers');
        const explorerLevelElement = document.getElementById('explorer-level');
        const accuracyElement = document.getElementById('accuracy');
        
        // إحداثيات الزاوية
        let vertex = { x: 150, y: 150 };
        let arm1 = { x: 50, y: 150 };
        let arm2 = { x: 250, y: 150 };
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeCanvas();
            setupEventListeners();
            drawAngle();
        });
        
        function setupEventListeners() {
            createAngleBtn.addEventListener('click', startAngleCreation);
            identifyBtn.addEventListener('click', identifyAngleType);
            resetAngleBtn.addEventListener('click', resetAngle);
            
            // أحداث الكانفاس
            canvas.addEventListener('mousedown', startDrag);
            canvas.addEventListener('mousemove', drag);
            canvas.addEventListener('mouseup', endDrag);
            canvas.addEventListener('touchstart', startDrag);
            canvas.addEventListener('touchmove', drag);
            canvas.addEventListener('touchend', endDrag);
            
            // أحداث أنواع الزوايا
            document.querySelectorAll('.angle-type-card').forEach(card => {
                card.addEventListener('click', function() {
                    if (currentAngle) {
                        checkAngleType(this.dataset.type);
                    }
                });
            });
        }
        
        function initializeCanvas() {
            // تعيين أبعاد الكانفاس
            canvas.width = 300;
            canvas.height = 300;
        }
        
        function drawAngle() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // رسم دائرة الخلفية
            ctx.fillStyle = '#f8f9fa';
            ctx.beginPath();
            ctx.arc(vertex.x, vertex.y, 140, 0, Math.PI * 2);
            ctx.fill();
            
            // رسم خطوط الشبكة
            ctx.strokeStyle = '#dfe6e9';
            ctx.lineWidth = 1;
            for (let i = 0; i <= 300; i += 30) {
                ctx.beginPath();
                ctx.moveTo(i, 0);
                ctx.lineTo(i, 300);
                ctx.stroke();
                
                ctx.beginPath();
                ctx.moveTo(0, i);
                ctx.lineTo(300, i);
                ctx.stroke();
            }
            
            if (arm1 && arm2) {
                // حساب قياس الزاوية
                const angle = calculateAngle(arm1, vertex, arm2);
                currentAngle = angle;
                
                // رسم الذراع الأول
                ctx.strokeStyle = '#e84393';
                ctx.lineWidth = 4;
                ctx.beginPath();
                ctx.moveTo(vertex.x, vertex.y);
                ctx.lineTo(arm1.x, arm1.y);
                ctx.stroke();
                
                // رسم الذراع الثاني
                ctx.strokeStyle = '#00b894';
                ctx.lineWidth = 4;
                ctx.beginPath();
                ctx.moveTo(vertex.x, vertex.y);
                ctx.lineTo(arm2.x, arm2.y);
                ctx.stroke();
                
                // رسم رأس الزاوية
                ctx.fillStyle = '#fd79a8';
                ctx.beginPath();
                ctx.arc(vertex.x, vertex.y, 8, 0, Math.PI * 2);
                ctx.fill();
                
                // رسم قوس الزاوية
                ctx.strokeStyle = '#6c5ce7';
                ctx.lineWidth = 2;
                const radius = 40;
                const startAngle = Math.atan2(arm1.y - vertex.y, arm1.x - vertex.x);
                const endAngle = Math.atan2(arm2.y - vertex.y, arm2.x - vertex.x);
                
                ctx.beginPath();
                ctx.arc(vertex.x, vertex.y, radius, startAngle, endAngle);
                ctx.stroke();
                
                // عرض قياس الزاوية
                ctx.fillStyle = '#2d3436';
                ctx.font = '16px Arial';
                ctx.textAlign = 'center';
                const midAngle = (startAngle + endAngle) / 2;
                const textX = vertex.x + Math.cos(midAngle) * (radius + 20);
                const textY = vertex.y + Math.sin(midAngle) * (radius + 20);
                ctx.fillText(`${Math.round(angle)}°`, textX, textY);
                
                // تحديث عرض القياس
                angleMeasureElement.textContent = `${Math.round(angle)}°`;
                angleClassificationElement.textContent = classifyAngle(angle);
            }
        }
        
        function calculateAngle(point1, vertex, point2) {
            const dx1 = point1.x - vertex.x;
            const dy1 = point1.y - vertex.y;
            const dx2 = point2.x - vertex.x;
            const dy2 = point2.y - vertex.y;
            
            const dot = dx1 * dx2 + dy1 * dy2;
            const mag1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
            const mag2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);
            
            let angle = Math.acos(dot / (mag1 * mag2)) * (180 / Math.PI);
            
            // التأكد من أن الزاوية بين 0 و 180 درجة
            if (angle > 180) angle = 360 - angle;
            
            return angle;
        }
        
        function classifyAngle(angle) {
            if (angle < 90) return 'زاوية حادة';
            if (Math.abs(angle - 90) < 1) return 'زاوية قائمة';
            if (angle < 180) return 'زاوية منفرجة';
            if (Math.abs(angle - 180) < 1) return 'زاوية مستقيمة';
            return 'زاوية منعكسة';
        }
        
        let draggedArm = null;
        
        function startDrag(e) {
            e.preventDefault();
            const rect = canvas.getBoundingClientRect();
            const x = (e.clientX || e.touches[0].clientX) - rect.left;
            const y = (e.clientY || e.touches[0].clientY) - rect.top;
            
            // التحقق من أي ذراع يتم سحبه
            const distToArm1 = Math.sqrt((x - arm1.x) ** 2 + (y - arm1.y) ** 2);
            const distToArm2 = Math.sqrt((x - arm2.x) ** 2 + (y - arm2.y) ** 2);
            
            if (distToArm1 < 20) {
                draggedArm = 'arm1';
            } else if (distToArm2 < 20) {
                draggedArm = 'arm2';
            }
        }
        
        function drag(e) {
            if (!draggedArm) return;
            
            e.preventDefault();
            const rect = canvas.getBoundingClientRect();
            const x = (e.clientX || e.touches[0].clientX) - rect.left;
            const y = (e.clientY || e.touches[0].clientY) - rect.top;
            
            // تحديث موقع الذراع المسحوب
            if (draggedArm === 'arm1') {
                arm1.x = x;
                arm1.y = y;
            } else {
                arm2.x = x;
                arm2.y = y;
            }
            
            drawAngle();
        }
        
        function endDrag() {
            draggedArm = null;
        }
        
        function startAngleCreation() {
            isCreatingAngle = true;
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'اسحب أطراف الزاوية لتغيير قياسها!';
            
            // إنشاء زاوية عشوائية
            const randomAngle = Math.random() * 180;
            arm1.x = vertex.x + 100 * Math.cos(0);
            arm1.y = vertex.y + 100 * Math.sin(0);
            arm2.x = vertex.x + 100 * Math.cos(randomAngle * Math.PI / 180);
            arm2.y = vertex.y + 100 * Math.sin(randomAngle * Math.PI / 180);
            
            drawAngle();
        }
        
        function identifyAngleType() {
            if (!currentAngle) {
                feedbackArea.className = 'feedback-area feedback-wrong';
                feedbackArea.textContent = '❌ يرجى إنشاء زاوية أولاً!';
                return;
            }
            
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'انقر على نوع الزاوية الصحيح في القائمة!';
        }
        
        function checkAngleType(selectedType) {
            if (!currentAngle) return;
            
            totalAttempts++;
            const correctType = getAngleType(currentAngle);
            const isCorrect = selectedType === correctType;
            
            if (isCorrect) {
                correctAnswers++;
                discoveredAngles++;
                feedbackArea.className = 'feedback-area feedback-correct';
                feedbackArea.textContent = `🎉 صحيح! هذه ${classifyAngle(currentAngle)}`;
                
                // زيادة المستوى
                if (discoveredAngles % 5 === 0) {
                    explorerLevel++;
                }
                
                updateStats();
                
                // زاوية جديدة بعد ثانيتين
                setTimeout(startAngleCreation, 2000);
            } else {
                feedbackArea.className = 'feedback-area feedback-wrong';
                feedbackArea.textContent = `❌ غير صحيح! حاول مرة أخرى`;
                updateStats();
            }
        }
        
        function getAngleType(angle) {
            if (angle < 90) return 'acute';
            if (Math.abs(angle - 90) < 5) return 'right';
            if (angle < 180) return 'obtuse';
            return 'straight';
        }
        
        function resetAngle() {
            arm1 = { x: 50, y: 150 };
            arm2 = { x: 250, y: 150 };
            currentAngle = null;
            drawAngle();
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'انقر على "إنشاء زاوية" لبدء الاكتشاف!';
            angleMeasureElement.textContent = '--°';
            angleClassificationElement.textContent = '--';
        }
        
        function updateStats() {
            discoveredAnglesElement.textContent = discoveredAngles;
            correctAnswersElement.textContent = correctAnswers;
            explorerLevelElement.textContent = explorerLevel;
            
            const accuracy = totalAttempts > 0 ? 
                Math.round((correctAnswers / totalAttempts) * 100) : 100;
            accuracyElement.textContent = `${accuracy}%`;
        }
    </script>
</body>
</html>