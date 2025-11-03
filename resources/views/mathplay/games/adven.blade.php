<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مغامرة الفرص - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 1400px;
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

        .adventure-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 968px) {
            .adventure-layout {
                grid-template-columns: 1fr;
            }
        }

        .situations-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .situation-card {
            background: white;
            border: 2px solid #ddd;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .situation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .situation-card.active {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .situation-icon {
            font-size: 2.5em;
            text-align: center;
            margin-bottom: 10px;
        }

        .situation-details {
            text-align: center;
        }

        .game-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .adventure-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .situation-scene {
            background: #f8f9fa;
            border: 2px dashed #ffb300;
            border-radius: 20px;
            padding: 30px;
            margin: 20px auto;
            max-width: 500px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .scene-elements {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .scene-element {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            transition: all 0.3s ease;
        }

        .probability-calculator {
            background: #e8f4fd;
            border: 2px solid #74b9ff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .calculator-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 15px 0;
        }

        .calculator-item {
            background: white;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .calculator-value {
            font-size: 1.5em;
            font-weight: bold;
            color: #667eea;
            margin: 5px 0;
        }

        .prediction-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 20px 0;
        }

        .prediction-option {
            background: #f8f9fa;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .prediction-option:hover {
            border-color: #667eea;
            transform: scale(1.05);
        }

        .prediction-option.selected {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }

        .prediction-option.correct {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border-color: #00b894;
        }

        .prediction-option.incorrect {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
            border-color: #ff7675;
        }

        .experiment-area {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .experiment-results {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
            flex-wrap: wrap;
        }

        .experiment-result {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

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

        #predict-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #experiment-btn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        #next-situation-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        #reset-adventure-btn {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
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

        .analysis {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            display: none;
        }

        .analysis.show {
            display: block;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .real-life-tip {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🧭 مغامرة الفرص</h1>
            <p>توقع واختبر فرص الأحداث في مواقف حقيقية!</p>
        </div>
        
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="adventure-layout">
            <div class="situations-section">
                <h3>🎯 مواقف حياتية</h3>
                
                <div class="situation-card active" data-situation="weather">
                    <div class="situation-icon">🌦️</div>
                    <div class="situation-details">
                        <h4>توقع الطقس</h4>
                        <p>ما فرصة هطول المطر؟</p>
                    </div>
                </div>

                <div class="situation-card" data-situation="game">
                    <div class="situation-icon">🎮</div>
                    <div class="situation-details">
                        <h4>لعبة الحظ</h4>
                        <p>ما فرصة الفوز بالجائزة؟</p>
                    </div>
                </div>

                <div class="situation-card" data-situation="lunch">
                    <div class="situation-icon">🍽️</div>
                    <div class="situation-details">
                        <h4>وجبة الغداء</h4>
                        <p>ما فرصة الحصول على الطبق المفضل؟</p>
                    </div>
                </div>

                <div class="situation-card" data-situation="transport">
                    <div class="situation-icon">🚌</div>
                    <div class="situation-details">
                        <h4>مواصلات المدرسة</h4>
                        <p>ما فرصة وصول الحافلة في الوقت؟</p>
                    </div>
                </div>

                <div class="real-life-tip">
                    <h4>💡 في الحياة الواقعية:</h4>
                    <p>نستخدم الفرص يومياً في:</p>
                    <ul style="margin-right: 20px; margin-top: 10px;">
                        <li>توقع الطقس</li>
                        <li>اتخاذ القرارات</li>
                        <li>التخطيط للأحداث</li>
                    </ul>
                </div>
            </div>
            
            <div class="game-area">
                <div class="adventure-display">
                    <h3 id="situation-title">توقع الطقس</h3>
                    <div class="situation-scene" id="situation-scene">
                        <div class="scene-elements" id="scene-elements">
                            <!-- عناصر المشهد ستظهر هنا -->
                        </div>
                        <div class="situation-question" id="situation-question">
                            <!-- السؤال سيظهر هنا -->
                        </div>
                    </div>
                </div>

                <div class="probability-calculator">
                    <h4 style="text-align: center; margin-bottom: 15px;">🧮 احسب الفرصة</h4>
                    <div class="calculator-grid">
                        <div class="calculator-item">
                            <div>النتائج المرغوبة</div>
                            <div class="calculator-value" id="desired-outcomes">2</div>
                        </div>
                        <div class="calculator-item">
                            <div>كل النتائج الممكنة</div>
                            <div class="calculator-value" id="total-outcomes">5</div>
                        </div>
                    </div>
                    <div style="text-align: center; margin: 15px 0; font-weight: bold;">
                        الفرصة = <span id="chance-calculation">2 ÷ 5</span>
                    </div>
                </div>

                <div class="prediction-options" id="prediction-options">
                    <!-- خيارات التوقع ستظهر هنا -->
                </div>

                <div class="experiment-area" id="experiment-area" style="display: none;">
                    <h4 style="text-align: center; margin-bottom: 15px;">🔬 جرب بنفسك</h4>
                    <div class="experiment-results" id="experiment-results">
                        <!-- نتائج التجربة ستظهر هنا -->
                    </div>
                    <div style="text-align: center; margin: 10px 0;">
                        النتائج: <span id="success-count">0</span> نجاح من <span id="total-trials">0</span> محاولة
                    </div>
                </div>

                <div class="analysis" id="analysis">
                    <!-- التحليل سيظهر هنا -->
                </div>

                <div class="controls">
                    <button id="predict-btn">🎯 توقع الفرصة</button>
                    <button id="experiment-btn">🔬 جرب التجربة</button>
                    <button id="next-situation-btn" disabled>➡️ الموقف التالي</button>
                    <button id="reset-adventure-btn">🔄 إعادة المغامرة</button>
                </div>
                
                <div class="feedback" id="feedback">
                    اختر موقفاً ثم توقع الفرصة!
                </div>
            </div>
        </div>
        
        <div class="score-board">
            المواقف المحلولة: <span id="solved-situations">0</span> | 
            النقاط: <span id="score">0</span> |
            الدقة: <span id="accuracy">0%</span>
        </div>
    </div>

    <script>
        // تعريف المواقف
        const situations = {
            weather: {
                title: "توقع الطقس",
                icon: "🌦️",
                scene: ["☀️", "☀️", "🌧️", "☀️", "🌧️"],
                question: "ما فرصة هطول المطر غداً؟",
                desiredOutcomes: 2,
                totalOutcomes: 5,
                correctPrediction: "محتمل قليلاً",
                analysis: "هناك يومان ماطران من أصل 5 أيام، إذاً فرصة المطر محتملة قليلاً"
            },
            game: {
                title: "لعبة الحظ", 
                icon: "🎮",
                scene: ["🎁", "💔", "💔", "💔", "💔", "💔"],
                question: "ما فرصة الفوز بالجائزة الكبرى؟",
                desiredOutcomes: 1,
                totalOutcomes: 6,
                correctPrediction: "محتمل قليلاً",
                analysis: "هناك 1 فرصة للفوز من أصل 6، إذاً الفرصة محتملة قليلاً"
            },
            lunch: {
                title: "وجبة الغداء",
                icon: "🍽️",
                scene: ["🍕", "🍔", "🍟", "🥗", "🍕", "🍔", "🍟"],
                question: "ما فرصة تقديم البيتزا اليوم؟",
                desiredOutcomes: 2,
                totalOutcomes: 7,
                correctPrediction: "محتمل قليلاً", 
                analysis: "هناك 2 يوم بيتزا من أصل 7 أيام، إذاً الفرصة محتملة قليلاً"
            },
            transport: {
                title: "مواصلات المدرسة",
                icon: "🚌",
                scene: ["✅", "✅", "✅", "⏰", "✅"],
                question: "ما فرصة وصول الحافلة في الوقت؟",
                desiredOutcomes: 4,
                totalOutcomes: 5,
                correctPrediction: "محتمل جداً",
                analysis: "الحافلة تصل في الوقت 4 مرات من أصل 5، إذاً الفرصة محتملة جداً"
            }
        };

        // خيارات التوقع
        const predictionOptions = [
            "مستحيل",
            "محتمل قليلاً",
            "محتمل",
            "محتمل جداً", 
            "مؤكد"
        ];

        // بيانات اللعبة
        const gameData = {
            currentSituation: 'weather',
            solvedSituations: 0,
            totalAttempts: 0,
            score: 0,
            selectedPrediction: null,
            experimentCount: 0,
            successCount: 0
        };

        // عناصر DOM
        const situationTitleElement = document.getElementById('situation-title');
        const sceneElementsElement = document.getElementById('scene-elements');
        const situationQuestionElement = document.getElementById('situation-question');
        const desiredOutcomesElement = document.getElementById('desired-outcomes');
        const totalOutcomesElement = document.getElementById('total-outcomes');
        const chanceCalculationElement = document.getElementById('chance-calculation');
        const predictionOptionsElement = document.getElementById('prediction-options');
        const experimentAreaElement = document.getElementById('experiment-area');
        const experimentResultsElement = document.getElementById('experiment-results');
        const successCountElement = document.getElementById('success-count');
        const totalTrialsElement = document.getElementById('total-trials');
        const analysisElement = document.getElementById('analysis');
        const solvedSituationsElement = document.getElementById('solved-situations');
        const scoreElement = document.getElementById('score');
        const accuracyElement = document.getElementById('accuracy');
        const feedbackElement = document.getElementById('feedback');
        const predictBtn = document.getElementById('predict-btn');
        const experimentBtn = document.getElementById('experiment-btn');
        const nextSituationBtn = document.getElementById('next-situation-btn');
        const resetAdventureBtn = document.getElementById('reset-adventure-btn');
        const situationCards = document.querySelectorAll('.situation-card');

        // تهيئة اللعبة
        function initGame() {
            setupSituations();
            loadSituation('weather');
        }

        // إعداد المواقف
        function setupSituations() {
            situationCards.forEach(card => {
                card.addEventListener('click', () => {
                    situationCards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    loadSituation(card.dataset.situation);
                });
            });
        }

        // تحميل الموقف
        function loadSituation(situationId) {
            gameData.currentSituation = situationId;
            gameData.selectedPrediction = null;
            gameData.experimentCount = 0;
            gameData.successCount = 0;
            
            const situation = situations[situationId];
            
            // تحديث الواجهة
            situationTitleElement.textContent = situation.title;
            situationQuestionElement.textContent = situation.question;
            desiredOutcomesElement.textContent = situation.desiredOutcomes;
            totalOutcomesElement.textContent = situation.totalOutcomes;
            chanceCalculationElement.textContent = `${situation.desiredOutcomes} ÷ ${situation.totalOutcomes}`;
            
            // عرض المشهد
            renderScene(situation.scene);
            
            // عرض خيارات التوقع
            renderPredictionOptions();
            
            // إعادة تعيين
            experimentAreaElement.style.display = 'none';
            analysisElement.classList.remove('show');
            predictBtn.disabled = true;
            nextSituationBtn.disabled = true;
            
            showFeedback('توقع الفرصة ثم اضغط على "توقع الفرصة"!', 'info');
        }

        // عرض المشهد
        function renderScene(sceneElements) {
            sceneElementsElement.innerHTML = '';
            
            sceneElements.forEach((element, index) => {
                const elementDiv = document.createElement('div');
                elementDiv.className = 'scene-element';
                elementDiv.textContent = element;
                elementDiv.style.animationDelay = `${index * 0.1}s`;
                sceneElementsElement.appendChild(elementDiv);
            });
        }

        // عرض خيارات التوقع
        function renderPredictionOptions() {
            predictionOptionsElement.innerHTML = '';
            
            predictionOptions.forEach(option => {
                const optionElement = document.createElement('div');
                optionElement.className = `prediction-option ${gameData.selectedPrediction === option ? 'selected' : ''}`;
                optionElement.textContent = option;
                optionElement.addEventListener('click', () => selectPrediction(option));
                predictionOptionsElement.appendChild(optionElement);
            });
        }

        // اختيار التوقع
        function selectPrediction(prediction) {
            gameData.selectedPrediction = prediction;
            renderPredictionOptions();
            predictBtn.disabled = false;
        }

        // التحقق من التوقع
        function checkPrediction() {
            if (!gameData.selectedPrediction) {
                showFeedback('❌ اختر توقعاً أولاً!', 'error');
                return;
            }
            
            const situation = situations[gameData.currentSituation];
            const isCorrect = gameData.selectedPrediction === situation.correctPrediction;
            
            gameData.totalAttempts++;
            
            // تحديث مظهر الخيارات
            document.querySelectorAll('.prediction-option').forEach(option => {
                if (option.textContent === situation.correctPrediction) {
                    option.classList.add('correct');
                } else if (option.textContent === gameData.selectedPrediction && !isCorrect) {
                    option.classList.add('incorrect');
                }
            });
            
            if (isCorrect) {
                gameData.score += 20;
                gameData.solvedSituations++;
                showFeedback('🎉 توقع صحيح! +20 نقطة', 'success');
                showAnalysis();
                experimentBtn.disabled = false;
            } else {
                showFeedback('❌ توقع خاطئ! راجع التحليل', 'error');
                showAnalysis();
            }
            
            predictBtn.disabled = true;
            updateUI();
        }

        // إظهار التحليل
        function showAnalysis() {
            const situation = situations[gameData.currentSituation];
            
            analysisElement.innerHTML = `
                <h4>📊 تحليل الموقف:</h4>
                <div style="margin: 15px 0;">
                    <strong>النتائج المرغوبة:</strong> ${situation.desiredOutcomes}
                </div>
                <div style="margin: 15px 0;">
                    <strong>كل النتائج الممكنة:</strong> ${situation.totalOutcomes}
                </div>
                <div style="margin: 15px 0; font-weight: bold;">
                    ${situation.analysis}
                </div>
                <div style="margin: 15px 0; color: #00b894; font-weight: bold;">
                    التوقع الصحيح: ${situation.correctPrediction}
                </div>
            `;
            analysisElement.classList.add('show');
        }

        // تجربة عملية
        function runExperiment() {
            const situation = situations[gameData.currentSituation];
            
            gameData.experimentCount++;
            const isSuccess = Math.random() < (situation.desiredOutcomes / situation.totalOutcomes);
            
            if (isSuccess) {
                gameData.successCount++;
            }
            
            // عرض نتائج التجربة
            experimentAreaElement.style.display = 'block';
            
            const resultElement = document.createElement('div');
            resultElement.className = 'experiment-result';
            resultElement.textContent = isSuccess ? '✅' : '❌';
            resultElement.style.background = isSuccess ? '#00b894' : '#ff7675';
            resultElement.style.animation = 'bounceIn 0.5s';
            
            experimentResultsElement.appendChild(resultElement);
            
            // تحديث العدادات
            successCountElement.textContent = gameData.successCount;
            totalTrialsElement.textContent = gameData.experimentCount;
            
            // حساب النسبة المئوية
            const successRate = Math.round((gameData.successCount / gameData.experimentCount) * 100);
            
            showFeedback(`🔬 التجربة ${gameData.experimentCount}: ${isSuccess ? 'نجاح' : 'فشل'} (${successRate}% نجاح)`, 'info');
            
            // تمكين الزر التالي بعد 3 تجارب
            if (gameData.experimentCount >= 3) {
                nextSituationBtn.disabled = false;
            }
        }

        // الموقف التالي
        function nextSituation() {
            const situationIds = Object.keys(situations);
            const currentIndex = situationIds.indexOf(gameData.currentSituation);
            const nextIndex = (currentIndex + 1) % situationIds.length;
            
            loadSituation(situationIds[nextIndex]);
        }

        // إعادة المغامرة
        function resetAdventure() {
            gameData.solvedSituations = 0;
            gameData.totalAttempts = 0;
            gameData.score = 0;
            loadSituation('weather');
            updateUI();
            showFeedback('🔄 تم إعادة المغامرة! ابدأ من جديد', 'info');
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            solvedSituationsElement.textContent = gameData.solvedSituations;
            scoreElement.textContent = gameData.score;
            
            const accuracy = gameData.totalAttempts > 0 ? 
                Math.round((gameData.solvedSituations / gameData.totalAttempts) * 100) : 0;
            accuracyElement.textContent = `${accuracy}%`;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // event listeners
        predictBtn.addEventListener('click', checkPrediction);
        experimentBtn.addEventListener('click', runExperiment);
        nextSituationBtn.addEventListener('click', nextSituation);
        resetAdventureBtn.addEventListener('click', resetAdventure);

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>