<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صائد الزوايا - {{ $lesson_game->lesson->name }}</title>
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

        .hunter-dashboard {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .hunting-ground {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .tools-panel {
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

        .hunting-ground .panel-title {
            color: white;
        }

        #hunting-canvas {
            background: white;
            border-radius: 15px;
            display: block;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .target-angles {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .target-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            border: 3px solid;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .target-card.active {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .target-acute { border-color: #00b894; }
        .target-right { border-color: #fd79a8; }
        .target-obtuse { border-color: #fdcb6e; }
        .target-straight { border-color: #6c5ce7; }

        .target-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .hunter-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 15px;
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

        .hunter-controls {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 25px 0;
        }

        .hunter-btn {
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

        #start-hunt-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #next-level-btn {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .hunter-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .hunter-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback-display {
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

        .hunt-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .hunt-fail {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .hunt-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .angle-preview {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .preview-angle {
            font-size: 3rem;
            font-weight: bold;
            color: #ffeaa7;
            margin: 10px 0;
        }

        .preview-type {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00b894;
        }

        .progress-container {
            background: rgba(255, 255, 255, 0.9);
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

        .level-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .angle-counter {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }

        .counter-item {
            text-align: center;
        }

        .counter-number {
            font-size: 2rem;
            font-weight: bold;
            color: #e84393;
        }

        .counter-label {
            font-size: 0.8rem;
            color: #636e72;
        }

        @media (max-width: 768px) {
            .hunter-dashboard {
                grid-template-columns: 1fr;
            }
            
            .target-angles, .hunter-stats {
                grid-template-columns: 1fr;
            }
            
            #hunting-canvas {
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
            0% { transform: translateY(0px); }
            25% { transform: translateY(-10px); }
            50% { transform: translateY(0px); }
            75% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        .celebrate {
            animation: celebrate 0.5s ease-in-out;
        }

        .pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="lesson-title">🎯 صائد الزوايا</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="hunter-dashboard">
            <div class="hunting-ground">
                <div class="panel-title">🏹 ساحة الصيد</div>
                <canvas id="hunting-canvas" width="600" height="400"></canvas>
                
                <div class="angle-preview">
                    <div class="preview-angle" id="current-angle">--°</div>
                    <div class="preview-type" id="current-type">اختر الهدف</div>
                </div>
                
                <div class="feedback-display" id="hunt-feedback">
                    انقر على "بدء الصيد" لاكتشاف الزوايا!
                </div>
            </div>
            
            <div class="tools-panel">
                <div class="panel-title">🎒 أدوات الصياد</div>
                
                <div class="target-angles">
                    <div class="target-card target-acute" data-type="acute">
                        <div class="target-icon">📐</div>
                        <h4>زاوية حادة</h4>
                        <p>أقل من 90°</p>
                    </div>
                    
                    <div class="target-card target-right" data-type="right">
                        <div class="target-icon">🔲</div>
                        <h4>زاوية قائمة</h4>
                        <p>تساوي 90°</p>
                    </div>
                    
                    <div class="target-card target-obtuse" data-type="obtuse">
                        <div class="target-icon">🍕</div>
                        <h4>زاوية منفرجة</h4>
                        <p>أكثر من 90°</p>
                    </div>
                    
                    <div class="target-card target-straight" data-type="straight">
                        <div class="target-icon">📏</div>
                        <h4>زاوية مستقيمة</h4>
                        <p>تساوي 180°</p>
                    </div>
                </div>
                
                <div class="hunter-stats">
                    <div class="stat-item">
                        <div class="stat-value" id="hunter-score">0</div>
                        <div class="stat-label">النقاط</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="angles-caught">0</div>
                        <div class="stat-label">زوايا صيدت</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="hunter-level">1</div>
                        <div class="stat-label">مستوى الصياد</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="hunt-accuracy">100%</div>
                        <div class="stat-label">دقة الصيد</div>
                    </div>
                </div>
                
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" id="level-progress"></div>
                    </div>
                    <div class="level-info">
                        <span>المستوى الحالي</span>
                        <span id="progress-text">0/5</span>
                    </div>
                </div>
                
                <div class="hunter-controls">
                    <button class="hunter-btn" id="start-hunt-btn">
                        🎯 بدء الصيد
                    </button>
                    <button class="hunter-btn" id="hint-btn" disabled>
                        💡 تلميح
                    </button>
                    <button class="hunter-btn" id="next-level-btn" disabled>
                        ⭐ المستوى التالي
                    </button>
                </div>
                
                <div class="angle-counter">
                    <div class="counter-item">
                        <div class="counter-number" id="acute-count">0</div>
                        <div class="counter-label">حادة</div>
                    </div>
                    <div class="counter-item">
                        <div class="counter-number" id="right-count">0</div>
                        <div class="counter-label">قائمة</div>
                    </div>
                    <div class="counter-item">
                        <div class="counter-number" id="obtuse-count">0</div>
                        <div class="counter-label">منفرجة</div>
                    </div>
                    <div class="counter-item">
                        <div class="counter-number" id="straight-count">0</div>
                        <div class="counter-label">مستقيمة</div>
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
        let hunterScore = 0;
        let anglesCaught = 0;
        let hunterLevel = 1;
        let huntAccuracy = 100;
        let totalHunts = 0;
        let successfulHunts = 0;
        let currentTargetAngle = null;
        let isHunting = false;
        let levelProgress = 0;
        let levelTarget = 5;
        
        // إحصائيات الزوايا
        const angleStats = {
            acute: 0,
            right: 0,
            obtuse: 0,
            straight: 0
        };
        
        // عناصر DOM
        const huntingCanvas = document.getElementById('hunting-canvas');
        const ctx = huntingCanvas.getContext('2d');
        const startHuntBtn = document.getElementById('start-hunt-btn');
        const hintBtn = document.getElementById('hint-btn');
        const nextLevelBtn = document.getElementById('next-level-btn');
        const huntFeedback = document.getElementById('hunt-feedback');
        const currentAngleElement = document.getElementById('current-angle');
        const currentTypeElement = document.getElementById('current-type');
        const hunterScoreElement = document.getElementById('hunter-score');
        const anglesCaughtElement = document.getElementById('angles-caught');
        const hunterLevelElement = document.getElementById('hunter-level');
        const huntAccuracyElement = document.getElementById('hunt-accuracy');
        const levelProgressElement = document.getElementById('level-progress');
        const progressTextElement = document.getElementById('progress-text');
        const acuteCountElement = document.getElementById('acute-count');
        const rightCountElement = document.getElementById('right-count');
        const obtuseCountElement = document.getElementById('obtuse-count');
        const straightCountElement = document.getElementById('straight-count');
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeHuntingCanvas();
            setupHuntEventListeners();
            drawHuntingScene();
        });
        
        function setupHuntEventListeners() {
            startHuntBtn.addEventListener('click', startHunting);
            hintBtn.addEventListener('click', provideHint);
            nextLevelBtn.addEventListener('click', goToNextLevel);
            
            // أحداث أهداف الزوايا
            document.querySelectorAll('.target-card').forEach(card => {
                card.addEventListener('click', function() {
                    if (isHunting && currentTargetAngle) {
                        checkHunt(this.dataset.type);
                    }
                });
            });
        }
        
        function initializeHuntingCanvas() {
            huntingCanvas.width = 600;
            huntingCanvas.height = 400;
        }
        
        function drawHuntingScene() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, huntingCanvas.width, huntingCanvas.height);
            
            // رسم خلفية الساحة
            ctx.fillStyle = '#dfe6e9';
            ctx.fillRect(0, 0, huntingCanvas.width, huntingCanvas.height);
            
            // رسم شبكة الصيد
            ctx.strokeStyle = '#b2bec3';
            ctx.lineWidth = 1;
            for (let i = 0; i <= huntingCanvas.width; i += 40) {
                ctx.beginPath();
                ctx.moveTo(i, 0);
                ctx.lineTo(i, huntingCanvas.height);
                ctx.stroke();
                
                ctx.beginPath();
                ctx.moveTo(0, i);
                ctx.lineTo(huntingCanvas.width, i);
                ctx.stroke();
            }
            
            if (currentTargetAngle && isHunting) {
                drawTargetAngle();
            } else {
                // رسم رسالة ترحيب
                ctx.fillStyle = '#2d3436';
                ctx.font = '24px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('انقر على "بدء الصيد" لاكتشاف الزوايا!', 
                           huntingCanvas.width / 2, huntingCanvas.height / 2);
            }
        }
        
        function drawTargetAngle() {
            const centerX = huntingCanvas.width / 2;
            const centerY = huntingCanvas.height / 2;
            const radius = 120;
            
            // رسم دائرة الخلفية
            ctx.fillStyle = 'white';
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius + 20, 0, Math.PI * 2);
            ctx.fill();
            
            // رسم الذراع الأول
            ctx.strokeStyle = '#e84393';
            ctx.lineWidth = 6;
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.lineTo(centerX + radius, centerY);
            ctx.stroke();
            
            // رسم الذراع الثاني
            ctx.strokeStyle = '#00b894';
            ctx.lineWidth = 6;
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            const angleRad = currentTargetAngle * Math.PI / 180;
            ctx.lineTo(centerX + radius * Math.cos(angleRad), 
                      centerY + radius * Math.sin(angleRad));
            ctx.stroke();
            
            // رسم رأس الزاوية
            ctx.fillStyle = '#fd79a8';
            ctx.beginPath();
            ctx.arc(centerX, centerY, 10, 0, Math.PI * 2);
            ctx.fill();
            
            // رسم قوس الزاوية
            ctx.strokeStyle = '#6c5ce7';
            ctx.lineWidth = 3;
            const arcRadius = 50;
            ctx.beginPath();
            ctx.arc(centerX, centerY, arcRadius, 0, angleRad);
            ctx.stroke();
            
            // إضافة تأثير الاهتزاز للصيد
            if (isHunting) {
                ctx.strokeStyle = '#fdcb6e';
                ctx.lineWidth = 2;
                ctx.setLineDash([5, 5]);
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius + 10, 0, Math.PI * 2);
                ctx.stroke();
                ctx.setLineDash([]);
            }
        }
        
        function startHunting() {
            isHunting = true;
            hintBtn.disabled = false;
            
            // توليد زاوية عشوائية
            const angleTypes = ['acute', 'right', 'obtuse', 'straight'];
            const randomType = angleTypes[Math.floor(Math.random() * angleTypes.length)];
            
            switch(randomType) {
                case 'acute':
                    currentTargetAngle = Math.floor(Math.random() * 89) + 1;
                    break;
                case 'right':
                    currentTargetAngle = 90;
                    break;
                case 'obtuse':
                    currentTargetAngle = Math.floor(Math.random() * 89) + 91;
                    break;
                case 'straight':
                    currentTargetAngle = 180;
                    break;
            }
            
            // تحديث العرض
            currentAngleElement.textContent = `${currentTargetAngle}°`;
            currentTypeElement.textContent = '؟؟';
            huntFeedback.className = 'feedback-display hunt-info';
            huntFeedback.textContent = 'اختر نوع الزاوية الصحيح!';
            
            drawHuntingScene();
            
            // تفعيل أزرار التحكم
            document.querySelectorAll('.target-card').forEach(card => {
                card.style.cursor = 'pointer';
            });
        }
        
        function checkHunt(selectedType) {
            if (!isHunting || !currentTargetAngle) return;
            
            totalHunts++;
            const correctType = getAngleTypeFromMeasure(currentTargetAngle);
            const isCorrect = selectedType === correctType;
            
            if (isCorrect) {
                successfulHunts++;
                anglesCaught++;
                hunterScore += 20;
                angleStats[correctType]++;
                
                // تحديث التقدم
                levelProgress++;
                
                huntFeedback.className = 'feedback-display hunt-success celebrate';
                huntFeedback.textContent = `🎉 أصبت! ${getAngleTypeName(correctType)}`;
                currentTypeElement.textContent = getAngleTypeName(correctType);
                
                // تحديث الإحصائيات
                updateHuntStats();
                
                // الانتقال التلقائي بعد ثانيتين
                setTimeout(() => {
                    if (levelProgress >= levelTarget) {
                        completeLevel();
                    } else {
                        startHunting();
                    }
                }, 2000);
            } else {
                hunterScore = Math.max(0, hunterScore - 5);
                huntFeedback.className = 'feedback-display hunt-fail';
                huntFeedback.textContent = `❌ أخطأت! حاول مرة أخرى`;
                updateHuntStats();
            }
        }
        
        function getAngleTypeFromMeasure(angle) {
            if (angle < 90) return 'acute';
            if (angle === 90) return 'right';
            if (angle < 180) return 'obtuse';
            return 'straight';
        }
        
        function getAngleTypeName(type) {
            const names = {
                acute: 'زاوية حادة',
                right: 'زاوية قائمة', 
                obtuse: 'زاوية منفرجة',
                straight: 'زاوية مستقيمة'
            };
            return names[type];
        }
        
        function provideHint() {
            if (!isHunting || !currentTargetAngle) return;
            
            const correctType = getAngleTypeFromMeasure(currentTargetAngle);
            huntFeedback.className = 'feedback-display hunt-info pulse';
            huntFeedback.textContent = `💡 تلميح: هذه الزاوية ${getAngleTypeName(correctType)}`;
            
            // خصم نقاط للتلميح
            hunterScore = Math.max(0, hunterScore - 3);
            updateHuntStats();
        }
        
        function completeLevel() {
            isHunting = false;
            hintBtn.disabled = true;
            nextLevelBtn.disabled = false;
            
            hunterLevel++;
            levelProgress = 0;
            levelTarget = Math.min(levelTarget + 2, 10); // زيادة صعوبة المستوى
            
            huntFeedback.className = 'feedback-display hunt-success';
            huntFeedback.textContent = `🎊 مبروك! انتقلت للمستوى ${hunterLevel}`;
            
            updateHuntStats();
        }
        
        function goToNextLevel() {
            nextLevelBtn.disabled = true;
            startHunting();
        }
        
        function updateHuntStats() {
            hunterScoreElement.textContent = hunterScore;
            anglesCaughtElement.textContent = anglesCaught;
            hunterLevelElement.textContent = hunterLevel;
            
            huntAccuracy = totalHunts > 0 ? 
                Math.round((successfulHunts / totalHunts) * 100) : 100;
            huntAccuracyElement.textContent = `${huntAccuracy}%`;
            
            // تحديث شريط التقدم
            const progressPercent = (levelProgress / levelTarget) * 100;
            levelProgressElement.style.width = `${progressPercent}%`;
            progressTextElement.textContent = `${levelProgress}/${levelTarget}`;
            
            // تحديث عداد الزوايا
            acuteCountElement.textContent = angleStats.acute;
            rightCountElement.textContent = angleStats.right;
            obtuseCountElement.textContent = angleStats.obtuse;
            straightCountElement.textContent = angleStats.straight;
        }
    </script>
</body>
</html>