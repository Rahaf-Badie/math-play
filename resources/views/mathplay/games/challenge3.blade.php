<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحدي المستطيلات - {{ $lesson_game->lesson->name }}</title>
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

        .challenge-arena {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .game-area {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .control-panel {
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

        .game-area .panel-title {
            color: white;
        }

        #challenge-canvas {
            background: white;
            border-radius: 15px;
            display: block;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .mission-display {
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

        .challenge-types {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .challenge-card {
            background: white;
            border: 3px solid #dfe6e9;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .challenge-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .challenge-card.active {
            border-color: #00b894;
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .challenge-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .input-panel {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-label {
            font-weight: bold;
            color: #636e72;
            margin-bottom: 8px;
            display: block;
        }

        .dimension-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .number-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #a29bfe;
            border-radius: 8px;
            text-align: center;
            font-size: 1.1rem;
        }

        .challenge-controls {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 25px 0;
        }

        .challenge-btn {
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

        #start-challenge-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #submit-answer-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .challenge-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .challenge-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .challenge-feedback {
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

        .challenge-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .challenge-fail {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .challenge-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .challenge-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .challenge-stat {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .challenge-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .challenge-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .progress-track {
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

        .level-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-weight: bold;
            color: #2d3436;
        }

        .rectangle-tips {
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
            .challenge-arena {
                grid-template-columns: 1fr;
            }
            
            .challenge-types, .challenge-stats {
                grid-template-columns: 1fr;
            }
            
            .dimension-inputs {
                grid-template-columns: 1fr;
            }
            
            #challenge-canvas {
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
            <h1 class="lesson-title">🏆 تحدي المستطيلات</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="challenge-arena">
            <div class="game-area">
                <div class="panel-title">🎮 ساحة التحدي</div>
                <canvas id="challenge-canvas" width="500" height="400"></canvas>
                
                <div class="mission-display">
                    <div class="mission-title" id="mission-title">التحدي الحالي</div>
                    <div class="mission-description" id="mission-description">
                        انقر على "بدء التحدي" لبدء رحلتك في عالم المستطيلات!
                    </div>
                </div>
                
                <div class="challenge-feedback" id="challenge-feedback">
                    مستعد للتحدي؟
                </div>
            </div>
            
            <div class="control-panel">
                <div class="panel-title">🎛 لوحة التحكم</div>
                
                <div class="challenge-types">
                    <div class="challenge-card" data-type="properties">
                        <div class="challenge-icon">🔍</div>
                        <div>تحدي الخصائص</div>
                    </div>
                    <div class="challenge-card" data-type="calculations">
                        <div class="challenge-icon">🧮</div>
                        <div>تحدي الحسابات</div>
                    </div>
                    <div class="challenge-card" data-type="recognition">
                        <div class="challenge-icon">👁️</div>
                        <div>تحدي التعرف</div>
                    </div>
                    <div class="challenge-card" data-type="construction">
                        <div class="challenge-icon">🏗️</div>
                        <div>تحدي البناء</div>
                    </div>
                </div>
                
                <div class="input-panel" id="input-panel">
                    <div class="input-group">
                        <label class="input-label">أدخل الإجابة:</label>
                        <input type="text" class="number-input" id="answer-input" placeholder="الإجابة هنا">
                    </div>
                    <div class="dimension-inputs" id="dimension-inputs" style="display: none;">
                        <div class="input-group">
                            <label class="input-label">الطول:</label>
                            <input type="number" class="number-input" id="length-input" placeholder="٠">
                        </div>
                        <div class="input-group">
                            <label class="input-label">العرض:</label>
                            <input type="number" class="number-input" id="width-input" placeholder="٠">
                        </div>
                    </div>
                </div>
                
                <div class="challenge-stats">
                    <div class="challenge-stat">
                        <div class="challenge-value" id="challenge-score">٠</div>
                        <div class="challenge-label">النقاط</div>
                    </div>
                    <div class="challenge-stat">
                        <div class="challenge-value" id="challenges-won">٠</div>
                        <div class="challenge-label">تحديات ربحت</div>
                    </div>
                    <div class="challenge-stat">
                        <div class="challenge-value" id="challenge-level">١</div>
                        <div class="challenge-label">مستوى التحدي</div>
                    </div>
                    <div class="challenge-stat">
                        <div class="challenge-value" id="challenge-accuracy">١٠٠٪</div>
                        <div class="challenge-label">الدقة</div>
                    </div>
                </div>
                
                <div class="progress-track">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                    <div class="level-info">
                        <span>تقدم التحدي</span>
                        <span id="progress-text">٠/١٠</span>
                    </div>
                </div>
                
                <div class="challenge-controls">
                    <button class="challenge-btn" id="start-challenge-btn">
                        🚀 بدء التحدي
                    </button>
                    <button class="challenge-btn" id="submit-answer-btn" disabled>
                        ✅ تقديم الإجابة
                    </button>
                    <button class="challenge-btn" id="hint-btn" disabled>
                        💡 تلميح
                    </button>
                </div>
                
                <div class="rectangle-tips">
                    <div class="tips-title">💡 نصائح للتحدي</div>
                    <div class="tip-item">تذكر: الأضلاع المتقابلة متساوية</div>
                    <div class="tip-item">المحيط = ٢ × (الطول + العرض)</div>
                    <div class="tip-item">المساحة = الطول × العرض</div>
                    <div class="tip-item">القطر = √(الطول² + العرض²)</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let challengeScore = 0;
        let challengesWon = 0;
        let challengeLevel = 1;
        let totalAttempts = 0;
        let successfulAttempts = 0;
        let currentChallenge = null;
        let currentChallengeType = 'properties';
        let isChallengeActive = false;
        let challengeProgress = 0;
        let progressTarget = 10;
        
        // عناصر DOM
        const challengeCanvas = document.getElementById('challenge-canvas');
        const ctx = challengeCanvas.getContext('2d');
        const missionTitle = document.getElementById('mission-title');
        const missionDescription = document.getElementById('mission-description');
        const answerInput = document.getElementById('answer-input');
        const lengthInput = document.getElementById('length-input');
        const widthInput = document.getElementById('width-input');
        const dimensionInputs = document.getElementById('dimension-inputs');
        const challengeFeedback = document.getElementById('challenge-feedback');
        const startChallengeBtn = document.getElementById('start-challenge-btn');
        const submitAnswerBtn = document.getElementById('submit-answer-btn');
        const hintBtn = document.getElementById('hint-btn');
        const challengeCards = document.querySelectorAll('.challenge-card');
        const challengeScoreElement = document.getElementById('challenge-score');
        const challengesWonElement = document.getElementById('challenges-won');
        const challengeLevelElement = document.getElementById('challenge-level');
        const challengeAccuracyElement = document.getElementById('challenge-accuracy');
        const progressFill = document.getElementById('progress-fill');
        const progressText = document.getElementById('progress-text');
        
        // التحديات المختلفة
        const challenges = {
            properties: [
                {
                    question: "ما عدد محاور التناظر في المستطيل؟",
                    answer: "2",
                    type: "text"
                },
                {
                    question: "ما قياس زوايا المستطيل؟",
                    answer: "90",
                    type: "text"
                },
                {
                    question: "كيف تكون أضلاع المستطيل المتقابلة؟",
                    answer: "متساوية",
                    type: "text"
                }
            ],
            calculations: [
                {
                    question: "مستطيل طوله ٨ وعرضه ٥، ما محيطه؟",
                    answer: "26",
                    type: "text"
                },
                {
                    question: "مستطيل مساحته ٤٠ وطوله ٨، ما عرضه؟",
                    answer: "5",
                    type: "text"
                },
                {
                    question: "مستطيل طوله ٦ وعرضه ٨، ما طول قطره؟",
                    answer: "10",
                    type: "text"
                }
            ],
            recognition: [
                {
                    question: "أي من هذه الأشكال يمثل مستطيلاً حقيقياً؟",
                    shapes: ["rectangle", "square", "parallelogram", "trapezoid"],
                    answer: "rectangle",
                    type: "shape"
                }
            ],
            construction: [
                {
                    question: "ابنِ مستطيلاً طوله ١٢٠ وعرضه ٨٠",
                    target: { length: 120, width: 80 },
                    type: "construction"
                },
                {
                    question: "ابنِ مستطيلاً محيطه ١٠٠ وطوله ٣٠",
                    target: { length: 30, width: 20 },
                    type: "construction"
                }
            ]
        };
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeChallengeCanvas();
            setupChallengeEventListeners();
            drawChallengeScene();
        });
        
        function setupChallengeEventListeners() {
            startChallengeBtn.addEventListener('click', startChallenge);
            submitAnswerBtn.addEventListener('click', submitAnswer);
            hintBtn.addEventListener('click', provideChallengeHint);
            
            // أحداث أنواع التحديات
            challengeCards.forEach(card => {
                card.addEventListener('click', function() {
                    if (!isChallengeActive) {
                        challengeCards.forEach(c => c.classList.remove('active'));
                        this.classList.add('active');
                        currentChallengeType = this.dataset.type;
                        updateInputPanel();
                    }
                });
            });
            
            // أحداث الإدخال
            answerInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && isChallengeActive) {
                    submitAnswer();
                }
            });
        }
        
        function initializeChallengeCanvas() {
            challengeCanvas.width = 500;
            challengeCanvas.height = 400;
        }
        
        function drawChallengeScene() {
            // مسح الكانفاس
            ctx.clearRect(0, 0, challengeCanvas.width, challengeCanvas.height);
            
            // رسم خلفية الساحة
            ctx.fillStyle = '#dfe6e9';
            ctx.fillRect(0, 0, challengeCanvas.width, challengeCanvas.height);
            
            if (isChallengeActive && currentChallenge) {
                drawCurrentChallenge();
            } else {
                // رسم رسالة ترحيب
                ctx.fillStyle = '#2d3436';
                ctx.font = '24px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('انقر على "بدء التحدي" للبدء!', 
                           challengeCanvas.width / 2, challengeCanvas.height / 2);
            }
        }
        
        function drawCurrentChallenge() {
            const centerX = challengeCanvas.width / 2;
            const centerY = challengeCanvas.height / 2;
            
            if (currentChallenge.type === 'shape') {
                drawShapeRecognitionChallenge(centerX, centerY);
            } else if (currentChallenge.type === 'construction') {
                drawConstructionChallenge(centerX, centerY);
            } else {
                drawTextChallenge(centerX, centerY);
            }
        }
        
        function drawTextChallenge(centerX, centerY) {
            ctx.fillStyle = '#2d3436';
            ctx.font = 'bold 20px Arial';
            ctx.textAlign = 'center';
            
            // تقسيم النص إذا كان طويلاً
            const words = currentChallenge.question.split(' ');
            let lines = [];
            let currentLine = '';
            
            for (const word of words) {
                const testLine = currentLine + word + ' ';
                const metrics = ctx.measureText(testLine);
                
                if (metrics.width > 450 && currentLine !== '') {
                    lines.push(currentLine);
                    currentLine = word + ' ';
                } else {
                    currentLine = testLine;
                }
            }
            lines.push(currentLine);
            
            // رسم الأسطر
            lines.forEach((line, index) => {
                ctx.fillText(line, centerX, centerY - 50 + (index * 30));
            });
        }
        
        function drawShapeRecognitionChallenge(centerX, centerY) {
            ctx.fillStyle = '#2d3436';
            ctx.font = 'bold 18px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(currentChallenge.question, centerX, 50);
            
            // رسم الأشكال المختلفة
            const shapes = [
                { type: 'rectangle', x: 100, y: 100, width: 120, height: 80 },
                { type: 'square', x: 250, y: 100, width: 80, height: 80 },
                { type: 'parallelogram', x: 100, y: 220, width: 120, height: 80, skew: 20 },
                { type: 'trapezoid', x: 250, y: 220, width: 120, height: 80, topWidth: 80 }
            ];
            
            shapes.forEach(shape => {
                ctx.save();
                
                if (shape.type === 'rectangle') {
                    ctx.strokeStyle = '#00b894';
                    ctx.fillStyle = 'rgba(0, 184, 148, 0.2)';
                    ctx.strokeRect(shape.x, shape.y, shape.width, shape.height);
                    ctx.fillRect(shape.x, shape.y, shape.width, shape.height);
                } else if (shape.type === 'square') {
                    ctx.strokeStyle = '#fd79a8';
                    ctx.fillStyle = 'rgba(253, 121, 168, 0.2)';
                    ctx.strokeRect(shape.x, shape.y, shape.width, shape.height);
                    ctx.fillRect(shape.x, shape.y, shape.width, shape.height);
                } else if (shape.type === 'parallelogram') {
                    ctx.strokeStyle = '#fdcb6e';
                    ctx.fillStyle = 'rgba(253, 203, 110, 0.2)';
                    ctx.beginPath();
                    ctx.moveTo(shape.x + shape.skew, shape.y);
                    ctx.lineTo(shape.x + shape.width + shape.skew, shape.y);
                    ctx.lineTo(shape.x + shape.width, shape.y + shape.height);
                    ctx.lineTo(shape.x, shape.y + shape.height);
                    ctx.closePath();
                    ctx.stroke();
                    ctx.fill();
                } else if (shape.type === 'trapezoid') {
                    ctx.strokeStyle = '#6c5ce7';
                    ctx.fillStyle = 'rgba(108, 92, 231, 0.2)';
                    ctx.beginPath();
                    ctx.moveTo(shape.x + (shape.width - shape.topWidth) / 2, shape.y);
                    ctx.lineTo(shape.x + (shape.width + shape.topWidth) / 2, shape.y);
                    ctx.lineTo(shape.x + shape.width, shape.y + shape.height);
                    ctx.lineTo(shape.x, shape.y + shape.height);
                    ctx.closePath();
                    ctx.stroke();
                    ctx.fill();
                }
                
                ctx.restore();
                
                // إضافة تفاعل للنقر على الأشكال
                challengeCanvas.addEventListener('click', function(e) {
                    const rect = challengeCanvas.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    if (x >= shape.x && x <= shape.x + shape.width &&
                        y >= shape.y && y <= shape.y + shape.height) {
                        checkShapeAnswer(shape.type);
                    }
                });
            });
        }
        
        function drawConstructionChallenge(centerX, centerY) {
            ctx.fillStyle = '#2d3436';
            ctx.font = 'bold 18px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(currentChallenge.question, centerX, 50);
            
            // رسم المستطيل المستهدف
            const target = currentChallenge.target;
            const targetX = centerX - target.length / 2;
            const targetY = centerY - target.width / 2;
            
            ctx.strokeStyle = '#fd79a8';
            ctx.lineWidth = 2;
            ctx.setLineDash([5, 5]);
            ctx.strokeRect(targetX, targetY, target.length, target.width);
            ctx.setLineDash([]);
            
            // رسم المستطيل الذي بناه المستخدم إذا وجد
            if (lengthInput.value && widthInput.value) {
                const userLength = parseInt(lengthInput.value);
                const userWidth = parseInt(widthInput.value);
                const userX = centerX - userLength / 2;
                const userY = centerY + 50;
                
                ctx.strokeStyle = '#00b894';
                ctx.lineWidth = 3;
                ctx.fillStyle = 'rgba(0, 184, 148, 0.2)';
                ctx.strokeRect(userX, userY, userLength, userWidth);
                ctx.fillRect(userX, userY, userLength, userWidth);
                
                // كتابة الأبعاد
                ctx.fillStyle = '#00b894';
                ctx.font = '14px Arial';
                ctx.fillText(`الطول: ${userLength}`, userX + userLength/2, userY - 10);
                ctx.fillText(`العرض: ${userWidth}`, userX + userLength/2, userY + userWidth + 20);
            }
        }
        
        function updateInputPanel() {
            answerInput.style.display = 'block';
            dimensionInputs.style.display = 'none';
            answerInput.value = '';
            lengthInput.value = '';
            widthInput.value = '';
        }
        
        function startChallenge() {
            isChallengeActive = true;
            startChallengeBtn.disabled = true;
            submitAnswerBtn.disabled = false;
            hintBtn.disabled = false;
            
            challengeScore = 0;
            challengesWon = 0;
            challengeLevel = 1;
            totalAttempts = 0;
            successfulAttempts = 0;
            challengeProgress = 0;
            progressTarget = 10;
            
            updateChallengeStats();
            generateNewChallenge();
            
            challengeFeedback.className = 'challenge-feedback challenge-info';
            challengeFeedback.textContent = 'حل التحدي وأدخل الإجابة!';
            
            answerInput.focus();
        }
        
        function generateNewChallenge() {
            const challengeList = challenges[currentChallengeType];
            const randomChallenge = challengeList[Math.floor(Math.random() * challengeList.length)];
            
            currentChallenge = randomChallenge;
            
            missionTitle.textContent = `تحدي ${getChallengeTypeName(currentChallengeType)}`;
            missionDescription.textContent = currentChallenge.question;
            
            // تحديث واجهة الإدخال بناءً على نوع التحدي
            if (currentChallenge.type === 'construction') {
                answerInput.style.display = 'none';
                dimensionInputs.style.display = 'grid';
            } else {
                answerInput.style.display = 'block';
                dimensionInputs.style.display = 'none';
            }
            
            answerInput.value = '';
            lengthInput.value = '';
            widthInput.value = '';
            
            drawChallengeScene();
        }
        
        function getChallengeTypeName(type) {
            const names = {
                properties: 'الخصائص',
                calculations: 'الحسابات',
                recognition: 'التعرف',
                construction: 'البناء'
            };
            return names[type];
        }
        
        function submitAnswer() {
            if (!isChallengeActive || !currentChallenge) return;
            
            let userAnswer;
            let isCorrect = false;
            
            totalAttempts++;
            
            if (currentChallenge.type === 'construction') {
                const userLength = parseInt(lengthInput.value) || 0;
                const userWidth = parseInt(widthInput.value) || 0;
                const target = currentChallenge.target;
                
                const lengthDiff = Math.abs(userLength - target.length);
                const widthDiff = Math.abs(userWidth - target.width);
                
                isCorrect = lengthDiff <= 5 && widthDiff <= 5;
                userAnswer = `الطول: ${userLength}, العرض: ${userWidth}`;
            } else if (currentChallenge.type === 'shape') {
                // يتم التعامل مع إجابات الأشكال في دالة منفصلة
                return;
            } else {
                userAnswer = answerInput.value.trim().toLowerCase();
                isCorrect = userAnswer === currentChallenge.answer.toLowerCase();
            }
            
            if (isCorrect) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }
        }
        
        function checkShapeAnswer(selectedShape) {
            totalAttempts++;
            const isCorrect = selectedShape === currentChallenge.answer;
            
            if (isCorrect) {
                handleCorrectAnswer();
            } else {
                handleIncorrectAnswer();
            }
        }
        
        function handleCorrectAnswer() {
            successfulAttempts++;
            challengesWon++;
            challengeScore += 20 + (challengeLevel * 5);
            challengeProgress++;
            
            challengeFeedback.className = 'challenge-feedback challenge-success celebrate';
            challengeFeedback.textContent = `🎉 إجابة صحيحة! +${20 + challengeLevel * 5} نقطة`;
            
            // تحديث مستوى التحدي
            if (challengesWon % 3 === 0) {
                challengeLevel++;
                challengeFeedback.textContent += ` - انتقل للمستوى ${challengeLevel}!`;
            }
            
            updateChallengeStats();
            
            // تحدي جديد بعد ثانيتين
            setTimeout(() => {
                if (challengeProgress < progressTarget) {
                    generateNewChallenge();
                } else {
                    endChallenge();
                }
            }, 2000);
        }
        
        function handleIncorrectAnswer() {
            challengeScore = Math.max(0, challengeScore - 5);
            challengeFeedback.className = 'challenge-feedback challenge-fail';
            challengeFeedback.textContent = `❌ إجابة خاطئة! حاول مرة أخرى`;
            
            updateChallengeStats();
        }
        
        function provideChallengeHint() {
            if (!currentChallenge) return;
            
            let hint = '';
            
            switch(currentChallengeType) {
                case 'properties':
                    hint = '💡 تلميح: فكر في الأضلاع والزوايا والأقطار';
                    break;
                case 'calculations':
                    hint = '💡 تلميح: استخدم قوانين المحيط والمساحة والقطر';
                    break;
                case 'recognition':
                    hint = '💡 تلميح: ابحث عن الشكل الذي جميع زواياه قائمة';
                    break;
                case 'construction':
                    hint = '💡 تلميح: تأكد من أن الأضلاع المتقابلة متساوية';
                    break;
            }
            
            challengeFeedback.className = 'challenge-feedback challenge-info pulse';
            challengeFeedback.textContent = hint;
            
            challengeScore = Math.max(0, challengeScore - 3);
            updateChallengeStats();
        }
        
        function endChallenge() {
            isChallengeActive = false;
            startChallengeBtn.disabled = false;
            submitAnswerBtn.disabled = true;
            hintBtn.disabled = true;
            
            const accuracy = totalAttempts > 0 ? 
                Math.round((successfulAttempts / totalAttempts) * 100) : 0;
            
            challengeFeedback.className = 'challenge-feedback challenge-info';
            challengeFeedback.textContent = `🎊 انتهى التحدي! النقاط: ${challengeScore} | الدقة: ${accuracy}%`;
            
            missionTitle.textContent = 'التحدي مكتمل!';
            missionDescription.textContent = 'تهانينا! أصبحت خبيراً في المستطيلات';
        }
        
        function updateChallengeStats() {
            challengeScoreElement.textContent = challengeScore;
            challengesWonElement.textContent = challengesWon;
            challengeLevelElement.textContent = challengeLevel;
            
            const accuracy = totalAttempts > 0 ? 
                Math.round((successfulAttempts / totalAttempts) * 100) : 100;
            challengeAccuracyElement.textContent = `${accuracy}%`;
            
            // تحديث شريط التقدم
            const progressPercent = (challengeProgress / progressTarget) * 100;
            progressFill.style.width = `${progressPercent}%`;
            progressText.textContent = `${challengeProgress}/${progressTarget}`;
        }
    </script>
</body>
</html>