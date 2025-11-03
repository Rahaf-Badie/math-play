<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>باني المربعات المحترف - {{ $lesson_game->lesson->name }}</title>
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

        .builder-workshop {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .construction-area {
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

        .construction-area .panel-title {
            color: white;
        }

        #construction-canvas {
            background: white;
            border-radius: 15px;
            display: block;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .mission-board {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .mission-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #e84393;
            margin-bottom: 15px;
        }

        .mission-description {
            font-size: 1.1rem;
            color: #2d3436;
            line-height: 1.6;
        }

        .building-tools {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .tool-btn {
            background: white;
            border: 3px solid #dfe6e9;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            color: #2d3436;
        }

        .tool-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .tool-btn.active {
            border-color: #00b894;
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .tool-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .measurement-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 25px 0;
        }

        .measurement-group {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .measurement-label {
            font-weight: bold;
            color: #636e72;
            margin-bottom: 10px;
        }

        .measurement-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #a29bfe;
            border-radius: 8px;
            text-align: center;
            font-size: 1.1rem;
            outline: none;
        }

        .measurement-input:focus {
            border-color: #6c5ce7;
        }

        .builder-controls {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 25px 0;
        }

        .builder-btn {
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

        #start-mission-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #check-square-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .builder-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .builder-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .builder-feedback {
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

        .builder-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .builder-fail {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .builder-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .builder-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .builder-stat {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .builder-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .builder-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .progress-workshop {
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

        .mission-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .square-tips {
            background: #e9f7ef;
            border: 2px solid #00b894;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .tips-title {
            text-align: center;
            font-weight: bold;
            color: #00b894;
            margin-bottom: 15px;
        }

        .tip-item {
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 8px;
            border-right: 3px solid #00b894;
        }

        @media (max-width: 768px) {
            .builder-workshop {
                grid-template-columns: 1fr;
            }
            
            .building-tools, .builder-stats {
                grid-template-columns: 1fr;
            }
            
            .measurement-inputs {
                grid-template-columns: 1fr;
            }
            
            #construction-canvas {
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
            <h1 class="lesson-title">🏗️ باني المربعات المحترف</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="builder-workshop">
            <div class="construction-area">
                <div class="panel-title">🔨 ورشة البناء</div>
                <canvas id="construction-canvas" width="500" height="400"></canvas>
                
                <div class="mission-board">
                    <div class="mission-title" id="mission-title">المهمة الحالية</div>
                    <div class="mission-description" id="mission-description">
                        انقر على "بدء المهمة" لبدء بناء المربعات!
                    </div>
                </div>
                
                <div class="builder-feedback" id="builder-feedback">
                    مستعد لتصبح باني مربعات محترف؟
                </div>
            </div>
            
            <div class="tools-panel">
                <div class="panel-title">🛠️ أدوات البناء</div>
                
                <div class="building-tools">
                    <div class="tool-btn" data-tool="draw">
                        <div class="tool-icon">✏️</div>
                        <div>رسم المربع</div>
                    </div>
                    <div class="tool-btn" data-tool="measure">
                        <div class="tool-icon">📏</div>
                        <div>أدوات القياس</div>
                    </div>
                    <div class="tool-btn" data-tool="rotate">
                        <div class="tool-icon">🔄</div>
                        <div>تدوير الشكل</div>
                    </div>
                </div>
                
                <div class="measurement-inputs">
                    <div class="measurement-group">
                        <div class="measurement-label">طول الضلع</div>
                        <input type="number" class="measurement-input" id="side-length-input" placeholder="١٠٠" min="50" max="200">
                    </div>
                    <div class="measurement-group">
                        <div class="measurement-label">زاوية الدوران</div>
                        <input type="number" class="measurement-input" id="rotation-input" placeholder="٠" min="0" max="360">
                    </div>
                </div>
                
                <div class="builder-stats">
                    <div class="builder-stat">
                        <div class="builder-value" id="builder-score">٠</div>
                        <div class="builder-label">النقاط</div>
                    </div>
                    <div class="builder-stat">
                        <div class="builder-value" id="squares-built">٠</div>
                        <div class="builder-label">مربعات مبينة</div>
                    </div>
                    <div class="builder-stat">
                        <div class="builder-value" id="builder-level">١</div>
                        <div class="builder-label">مستوى البناء</div>
                    </div>
                    <div class="builder-stat">
                        <div class="builder-value" id="builder-accuracy">١٠٠٪</div>
                        <div class="builder-label">الدقة</div>
                    </div>
                </div>
                
                <div class="progress-workshop">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                    <div class="mission-info">
                        <span>تقدم الورشة</span>
                        <span id="progress-text">٠/٥</span>
                    </div>
                </div>
                
                <div class="builder-controls">
                    <button class="builder-btn" id="start-mission-btn">
                        🚀 بدء المهمة
                    </button>
                    <button class="builder-btn" id="check-square-btn" disabled>
                        ✅ فحص المربع
                    </button>
                    <button class="builder-btn" id="hint-btn" disabled>
                        💡 تلميح
                    </button>
                </div>
                
                <div class="square-tips">
                    <div class="tips-title">💡 أسرار المربع الناجح</div>
                    <div class="tip-item">جميع الأضلاع يجب أن تكون متساوية</div>
                    <div class="tip-item">الزوايا يجب أن تكون ٩٠ درجة</div>
                    <div class="tip-item">الأقطار متساوية ومتعامدة</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let builderScore = 0;
        let squaresBuilt = 0;
        let builderLevel = 1;
        let totalAttempts = 0;
        let successfulAttempts = 0;
        let currentMission = null;
        let currentTool = 'draw';
        let isBuildingActive = false;
        let workshopProgress = 0;
        let progressTarget = 5;
        let userSquare = null;
        
        // عناصر DOM
        const constructionCanvas = document.getElementById('construction-canvas');
        const ctx = constructionCanvas.getContext('2d');
        const missionTitle = document.getElementById('mission-title');
        const missionDescription = document.getElementById('mission-description');
        const sideLengthInput = document.getElementById('side-length-input');
        const rotationInput = document.getElementById('rotation-input');
        const builderFeedback = document.getElementById('builder-feedback');
        const startMissionBtn = document.getElementById('start-mission-btn');
        const checkSquareBtn = document.getElementById('check-square-btn');
        const hintBtn = document.getElementById('hint-btn');
        const toolButtons = document.querySelectorAll('.tool-btn');
        const builderScoreElement = document.getElementById('builder-score');
        const squaresBuiltElement = document.getElementById('squares-built');
        const builderLevelElement = document.getElementById('builder-level');
        const builderAccuracyElement = document.getElementById('builder-accuracy');
        const progressFill = document.getElementById('progress-fill');
        const progressText = document.getElementById('progress-text');
        
        // المهام المختلفة
        const missions = [
            {
                title: "المهمة ١: مربع أساسي",
                description: "ابنِ مربعاً طول ضلعه ١٠٠ وحدة",
                target: { sideLength: 100, rotation: 0 },
                points: 20
            },
            {
                title: "المهمة ٢: مربع مائل",
                description: "ابنِ مربعاً مائلاً بزاوية ٤٥ درجة",
                target: { sideLength: 120, rotation: 45 },
                points: 25
            },
            {
                title: "المهمة ٣: مربع كبير",
                description: "ابنِ مربعاً كبيراً طول ضلعه ١٥٠ وحدة",
                target: { sideLength: 150, rotation: 0 },
                points: 30
            },
            {
                title: "المهمة ٤: تحدي الزوايا",
                description: "ابنِ مربعاً بزاوية ٣٠ درجة",
                target: { sideLength: 130, rotation: 30 },
                points: 35
            },
            {
                title: "المهمة ٥: التحدي النهائي",
                description: "ابنِ مربعاً بدقة عالية - طول الضلع ١٤٠، زاوية ١٥ درجة",
                target: { sideLength: 140, rotation: 15 },
                points: 40
            }
        ];
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeConstructionCanvas();
            setupBuilderEventListeners();
            drawConstructionScene();
        });
        
        function setupBuilderEventListeners() {
            startMissionBtn.addEventListener('click', startMission);
            checkSquareBtn.addEventListener('click', checkSquare);
            hintBtn.addEventListener('click', provideBuilderHint);
            
            // أحداث أدوات البناء
            toolButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    toolButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentTool = this.dataset.tool;
                    updateConstruction();
                });
            });
            
            // أحداث إدخال القياسات
            sideLengthInput.addEventListener('input', updateConstruction);
            rotationInput.addEventListener('input', updateConstruction);
        }
        
        function initializeConstructionCanvas() {
            constructionCanvas.width = 500;
            constructionCanvas.height = 400;
        }
        
        function drawConstructionScene() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, constructionCanvas.width, constructionCanvas.height);
            
            // رسم خلفية الورشة
            ctx.fillStyle = '#dfe6e9';
            ctx.fillRect(0, 0, constructionCanvas.width, constructionCanvas.height);
            
            if (isBuildingActive && userSquare) {
                drawUserSquare();
                if (currentMission) {
                    drawTargetSquare();
                }
            } else {
                // رسم رسالة ترحيب
                ctx.fillStyle = '#2d3436';
                ctx.font = '24px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('انقر على "بدء المهمة" للبدء!', 
                           constructionCanvas.width / 2, constructionCanvas.height / 2);
            }
        }
        
        function drawUserSquare() {
            const centerX = constructionCanvas.width / 2 - 100;
            const centerY = constructionCanvas.height / 2;
            
            ctx.save();
            ctx.translate(centerX, centerY);
            ctx.rotate(userSquare.rotation * Math.PI / 180);
            
            ctx.strokeStyle = '#00b894';
            ctx.lineWidth = 3;
            ctx.fillStyle = 'rgba(0, 184, 148, 0.2)';
            
            const halfSize = userSquare.sideLength / 2;
            ctx.beginPath();
            ctx.rect(-halfSize, -halfSize, userSquare.sideLength, userSquare.sideLength);
            ctx.fill();
            ctx.stroke();
            
            // رسم القياسات إذا كانت الأداة مختارة
            if (currentTool === 'measure') {
                drawMeasurements(userSquare.sideLength);
            }
            
            ctx.restore();
        }
        
        function drawTargetSquare() {
            const centerX = constructionCanvas.width / 2 + 100;
            const centerY = constructionCanvas.height / 2;
            
            ctx.save();
            ctx.translate(centerX, centerY);
            ctx.rotate(currentMission.target.rotation * Math.PI / 180);
            
            ctx.strokeStyle = '#fd79a8';
            ctx.lineWidth = 3;
            ctx.setLineDash([5, 5]);
            ctx.fillStyle = 'rgba(253, 121, 168, 0.1)';
            
            const halfSize = currentMission.target.sideLength / 2;
            ctx.beginPath();
            ctx.rect(-halfSize, -halfSize, currentMission.target.sideLength, currentMission.target.sideLength);
            ctx.fill();
            ctx.stroke();
            ctx.setLineDash([]);
            
            ctx.restore();
            
            // تسمية المربعين
            ctx.fillStyle = '#2d3436';
            ctx.font = '16px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('مربعك', constructionCanvas.width / 2 - 100, constructionCanvas.height - 20);
            ctx.fillText('المطلوب', constructionCanvas.width / 2 + 100, constructionCanvas.height - 20);
        }
        
        function drawMeasurements(sideLength) {
            ctx.strokeStyle = '#6c5ce7';
            ctx.lineWidth = 1;
            ctx.fillStyle = '#6c5ce7';
            ctx.font = '12px Arial';
            
            // قياس الضلع العلوي
            ctx.beginPath();
            ctx.moveTo(-sideLength/2, -sideLength/2 - 10);
            ctx.lineTo(sideLength/2, -sideLength/2 - 10);
            ctx.stroke();
            
            ctx.fillText(`${sideLength}`, 0, -sideLength/2 - 15);
            
            // قياس الزاوية
            ctx.beginPath();
            ctx.arc(-sideLength/2, -sideLength/2, 15, 0, Math.PI / 2);
            ctx.stroke();
            ctx.fillText('٩٠°', -sideLength/2 + 10, -sideLength/2 + 10);
        }
        
        function startMission() {
            isBuildingActive = true;
            startMissionBtn.disabled = true;
            checkSquareBtn.disabled = false;
            hintBtn.disabled = false;
            
            builderScore = 0;
            squaresBuilt = 0;
            builderLevel = 1;
            totalAttempts = 0;
            successfulAttempts = 0;
            workshopProgress = 0;
            progressTarget = missions.length;
            
            updateBuilderStats();
            generateNewMission();
            
            builderFeedback.className = 'builder-feedback builder-info';
            builderFeedback.textContent = 'استخدم الأدوات لبناء المربع المطلوب!';
        }
        
        function generateNewMission() {
            if (workshopProgress < missions.length) {
                currentMission = missions[workshopProgress];
                
                missionTitle.textContent = currentMission.title;
                missionDescription.textContent = currentMission.description;
                
                // إعادة تعيين المدخلات
                sideLengthInput.value = '';
                rotationInput.value = '';
                userSquare = null;
                
                updateConstruction();
            } else {
                endWorkshop();
            }
        }
        
        function updateConstruction() {
            const sideLength = parseInt(sideLengthInput.value) || 0;
            const rotation = parseInt(rotationInput.value) || 0;
            
            if (sideLength > 0) {
                userSquare = {
                    sideLength: sideLength,
                    rotation: rotation
                };
            }
            
            drawConstructionScene();
        }
        
        function checkSquare() {
            if (!userSquare || !currentMission) {
                builderFeedback.className = 'builder-feedback builder-fail';
                builderFeedback.textContent = '❌ يرجى بناء مربع أولاً!';
                return;
            }
            
            totalAttempts++;
            
            const target = currentMission.target;
            const sideDiff = Math.abs(userSquare.sideLength - target.sideLength);
            const rotationDiff = Math.abs(userSquare.rotation - target.rotation);
            
            // حساب الدقة (هامش خطأ 5 وحدات للطول و 5 درجات للزاوية)
            const sideAccuracy = Math.max(0, 100 - (sideDiff / target.sideLength * 100));
            const rotationAccuracy = Math.max(0, 100 - (rotationDiff / 90 * 100));
            const totalAccuracy = (sideAccuracy + rotationAccuracy) / 2;
            
            const isSuccessful = sideDiff <= 5 && rotationDiff <= 5;
            
            if (isSuccessful) {
                successfulAttempts++;
                squaresBuilt++;
                builderScore += currentMission.points;
                workshopProgress++;
                
                builderFeedback.className = 'builder-feedback builder-success celebrate';
                builderFeedback.textContent = `🎉 نجاح! دقتك ${Math.round(totalAccuracy)}% - +${currentMission.points} نقطة`;
                
                // تحديث مستوى البناء
                if (squaresBuilt % 3 === 0) {
                    builderLevel++;
                    builderFeedback.textContent += ` - انتقل للمستوى ${builderLevel}!`;
                }
                
                updateBuilderStats();
                
                // مهمة جديدة بعد ثانيتين
                setTimeout(generateNewMission, 2000);
            } else {
                builderFeedback.className = 'builder-feedback builder-fail';
                builderFeedback.textContent = `❌ تحتاج تحسين! دقتك ${Math.round(totalAccuracy)}%`;
                
                updateBuilderStats();
            }
        }
        
        function provideBuilderHint() {
            if (!currentMission) return;
            
            const target = currentMission.target;
            let hint = '';
            
            if (!userSquare) {
                hint = `تلميح: ابدأ بضلع طوله حوالي ${target.sideLength} وحدة`;
            } else {
                const sideDiff = userSquare.sideLength - target.sideLength;
                const rotationDiff = userSquare.rotation - target.rotation;
                
                if (Math.abs(sideDiff) > 5) {
                    hint = `تلميح: ${sideDiff > 0 ? 'قلل' : 'زد'} طول الضلع بمقدار ${Math.abs(sideDiff)} وحدة`;
                } else if (Math.abs(rotationDiff) > 5) {
                    hint = `تلميح: ${rotationDiff > 0 ? 'قلل' : 'زد'} الزاوية بمقدار ${Math.abs(rotationDiff)} درجة`;
                } else {
                    hint = 'أنت قريب جداً! حاول تحسين الدقة';
                }
            }
            
            builderFeedback.className = 'builder-feedback builder-info pulse';
            builderFeedback.textContent = hint;
            
            builderScore = Math.max(0, builderScore - 5);
            updateBuilderStats();
        }
        
        function endWorkshop() {
            isBuildingActive = false;
            startMissionBtn.disabled = false;
            checkSquareBtn.disabled = true;
            hintBtn.disabled = true;
            
            const accuracy = totalAttempts > 0 ? 
                Math.round((successfulAttempts / totalAttempts) * 100) : 0;
            
            builderFeedback.className = 'builder-feedback builder-info';
            builderFeedback.textContent = `🎊 انتهت الورشة! النقاط: ${builderScore} | الدقة: ${accuracy}%`;
            
            missionTitle.textContent = 'الورشة مكتملة!';
            missionDescription.textContent = 'تهانينا! أصبحت باني مربعات محترف';
        }
        
        function updateBuilderStats() {
            builderScoreElement.textContent = builderScore;
            squaresBuiltElement.textContent = squaresBuilt;
            builderLevelElement.textContent = builderLevel;
            
            const accuracy = totalAttempts > 0 ? 
                Math.round((successfulAttempts / totalAttempts) * 100) : 100;
            builderAccuracyElement.textContent = `${accuracy}%`;
            
            // تحديث شريط التقدم
            const progressPercent = (workshopProgress / progressTarget) * 100;
            progressFill.style.width = `${progressPercent}%`;
            progressText.textContent = `${workshopProgress}/${progressTarget}`;
        }
    </script>
</body>
</html>