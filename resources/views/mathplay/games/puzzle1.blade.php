<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بازل محيط المربع - {{ $lesson_game->lesson->name }}</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-to-lesson {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .back-to-lesson:hover {
            background: white;
            color: #00a085;
            transform: translateY(-2px);
        }

        .puzzle-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 968px) {
            .puzzle-layout {
                grid-template-columns: 1fr;
            }
        }

        .scenarios-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .scenario-card {
            background: white;
            border: 2px solid #ddd;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .scenario-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        .scenario-card.active {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .scenario-icon {
            font-size: 2.5em;
            text-align: center;
            margin-bottom: 10px;
        }

        .scenario-details {
            text-align: center;
        }

        .puzzle-area {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .puzzle-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .puzzle-visual {
            width: 200px;
            height: 200px;
            border: 4px solid #ffb300;
            margin: 20px auto;
            position: relative;
            background: rgba(255, 179, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .puzzle-text {
            font-size: 1.3em;
            color: #2d3436;
            margin: 15px 0;
            line-height: 1.6;
        }

        .construction-area {
            background: #e8f4fd;
            border: 2px dashed #74b9ff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            min-height: 150px;
        }

        .formula-builder {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
            flex-wrap: wrap;
        }

        .formula-part {
            background: white;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 60px;
            text-align: center;
        }

        .formula-part:hover {
            border-color: #667eea;
            transform: scale(1.05);
        }

        .formula-part.number {
            background: #ffb300;
            color: white;
            border-color: #ffb300;
        }

        .formula-part.operator {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .formula-part.equals {
            background: #00b894;
            color: white;
            border-color: #00b894;
        }

        .formula-part.variable {
            background: #a29bfe;
            color: white;
            border-color: #a29bfe;
        }

        .user-formula {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
            font-size: 1.3em;
            font-weight: bold;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .formula-item {
            background: white;
            padding: 8px 12px;
            border-radius: 8px;
            border: 2px solid #ddd;
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

        #check-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #build-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        #clear-btn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        #next-puzzle-btn {
            background: linear-gradient(135deg, #a29bfe, #6c5ce7);
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

        .real-life-context {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
        }

        .puzzle-explanation {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            display: none;
        }

        .puzzle-explanation.show {
            display: block;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .scenario-image {
            width: 80px;
            height: 80px;
            margin: 0 auto 10px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
        }

        .hint-text {
            text-align: center;
            color: #666;
            font-size: 0.9em;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🧩 بازل محيط المربع</h1>
            <p>طبق معرفتك في مواقف حياتية واقعية!</p>
        </div>
        
        <div class="lesson-info">
            <span>🎯 الدرس: {{ $lesson_game->lesson->name }}</span>
            <a href="{{ url()->previous() }}" class="back-to-lesson">← الرجوع إلى الدرس</a>
        </div>

        <div class="puzzle-layout">
            <div class="scenarios-section">
                <h3>🏗️ سيناريوهات واقعية</h3>
                
                <div class="scenario-card active" data-scenario="garden">
                    <div class="scenario-icon">🌿</div>
                    <div class="scenario-details">
                        <h4>حديقة مربعة</h4>
                        <p>احسب طول السياج المطلوب</p>
                    </div>
                </div>

                <div class="scenario-card" data-scenario="room">
                    <div class="scenario-icon">🏠</div>
                    <div class="scenario-details">
                        <h4>غرفة مربعة</h4>
                        <p>احسب طول حاشية السقف</p>
                    </div>
                </div>

                <div class="scenario-card" data-scenario="pool">
                    <div class="scenario-icon">🏊</div>
                    <div class="scenario-details">
                        <h4>مسبح مربع</h4>
                        <p>احسب طول السياج الأمني</p>
                    </div>
                </div>

                <div class="scenario-card" data-scenario="frame">
                    <div class="scenario-icon">🖼️</div>
                    <div class="scenario-details">
                        <h4>إطار صورة</h4>
                        <p>احسب طول الإطار المطلوب</p>
                    </div>
                </div>

                <div class="real-life-context">
                    <h4>💡 معلومات مفيدة:</h4>
                    <p>المحيط مهم في الحياة اليومية لحساب:</p>
                    <ul style="margin-right: 20px; margin-top: 10px;">
                        <li>طول الأسوار والسياجات</li>
                        <li>كمية المواد للتركيب</li>
                        <li>التخطيط للمساحات</li>
                    </ul>
                </div>
            </div>
            
            <div class="puzzle-area">
                <div class="puzzle-display">
                    <h3 id="puzzle-title">حديقة مربعة</h3>
                    <div class="puzzle-visual" id="puzzle-visual">
                        <div class="scenario-image">🌿</div>
                    </div>
                    <div class="puzzle-text" id="puzzle-text">
                        <!-- نص المسألة سيظهر هنا -->
                    </div>
                </div>

                <div class="construction-area">
                    <h4 style="text-align: center; margin-bottom: 15px;">🔨 بناء القانون</h4>
                    <div class="user-formula" id="user-formula">
                        <span style="color: #666;">انقر على القطع لبناء القانون</span>
                    </div>
                    <div class="formula-builder">
                        <div class="formula-part number" data-value="4">4</div>
                        <div class="formula-part operator" data-value="×">×</div>
                        <div class="formula-part variable" data-value="طول الضلع">طول الضلع</div>
                        <div class="formula-part equals" data-value="=">=</div>
                        <div class="formula-part variable" data-value="المحيط">المحيط</div>
                    </div>
                    <div class="hint-text">💡 انقر على: 4 → × → طول الضلع → = → المحيط</div>
                </div>

                <div class="puzzle-explanation" id="puzzle-explanation">
                    <!-- الشرح سيظهر هنا -->
                </div>

                <div class="controls">
                    <button id="build-btn">🧱 تأكيد البناء</button>
                    <button id="check-btn">✅ تحقق من الإجابة</button>
                    <button id="clear-btn">🗑️ مسح البناء</button>
                    <button id="next-puzzle-btn" disabled>➡️ اللغز التالي</button>
                </div>
                
                <div class="feedback" id="feedback">
                    اختر سيناريو ثم ابنِ القانون الصحيح!
                </div>
            </div>
        </div>
        
        <div class="score-board">
            الألغاز المحلولة: <span id="solved-puzzles">0</span> | 
            النقاط: <span id="score">0</span> |
            المستوى: <span id="level">1</span>
        </div>
    </div>

    <script>
        // تعريف السيناريوهات
        const scenarios = {
            garden: {
                title: "حديقة مربعة",
                icon: "🌿",
                description: "لديك حديقة مربعة الشكل، تريد وضع سياج حولها.",
                problem: "إذا كان طول ضلع الحديقة 8 متر، فكم متراً من السياج تحتاج؟",
                sideLength: 8,
                unit: "متر",
                correctAnswer: 32,
                explanation: "تحتاج 32 متر من السياج لأن محيط المربع = 4 × 8 = 32 متر"
            },
            room: {
                title: "غرفة مربعة", 
                icon: "🏠",
                description: "تريد تركيب حاشية زخرفية حول سقف غرفة مربعة.",
                problem: "إذا كان طول ضلع الغرفة 5 متر، فكم متراً من الحاشية تحتاج؟",
                sideLength: 5,
                unit: "متر",
                correctAnswer: 20,
                explanation: "تحتاج 20 متر من الحاشية لأن محيط المربع = 4 × 5 = 20 متر"
            },
            pool: {
                title: "مسبح مربع",
                icon: "🏊",
                description: "تريد وضع سياج أمني حول مسبح مربع للحماية.",
                problem: "إذا كان طول ضلع المسبح 10 متر، فكم متراً من السياج تحتاج؟",
                sideLength: 10, 
                unit: "متر",
                correctAnswer: 40,
                explanation: "تحتاج 40 متر من السياج لأن محيط المربع = 4 × 10 = 40 متر"
            },
            frame: {
                title: "إطار صورة",
                icon: "🖼️",
                description: "تريد صنع إطار خشبي لصورة مربعة.",
                problem: "إذا كان طول ضلع الصورة 30 سم، فكم سنتيمتراً من الخشب تحتاج؟",
                sideLength: 30,
                unit: "سم", 
                correctAnswer: 120,
                explanation: "تحتاج 120 سم من الخشب لأن محيط المربع = 4 × 30 = 120 سم"
            }
        };

        // بيانات اللعبة
        const gameData = {
            currentScenario: 'garden',
            score: 0,
            level: 1,
            solvedPuzzles: 0,
            userFormula: [],
            selectedAnswer: null,
            currentPuzzle: null,
            isFormulaCorrect: false
        };

        // عناصر DOM
        const puzzleTitleElement = document.getElementById('puzzle-title');
        const puzzleVisualElement = document.getElementById('puzzle-visual');
        const puzzleTextElement = document.getElementById('puzzle-text');
        const userFormulaElement = document.getElementById('user-formula');
        const puzzleExplanationElement = document.getElementById('puzzle-explanation');
        const solvedPuzzlesElement = document.getElementById('solved-puzzles');
        const scoreElement = document.getElementById('score');
        const levelElement = document.getElementById('level');
        const feedbackElement = document.getElementById('feedback');
        const buildBtn = document.getElementById('build-btn');
        const checkBtn = document.getElementById('check-btn');
        const clearBtn = document.getElementById('clear-btn');
        const nextPuzzleBtn = document.getElementById('next-puzzle-btn');
        const scenarioCards = document.querySelectorAll('.scenario-card');
        const formulaParts = document.querySelectorAll('.formula-part');

        // القانون الصحيح
        const correctFormula = ['4', '×', 'طول الضلع', '=', 'المحيط'];

        // تهيئة اللعبة
        function initGame() {
            setupScenarios();
            setupFormulaBuilder();
            loadScenario('garden');
        }

        // إعداد السيناريوهات
        function setupScenarios() {
            scenarioCards.forEach(card => {
                card.addEventListener('click', () => {
                    scenarioCards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    loadScenario(card.dataset.scenario);
                });
            });
        }

        // إعداد بناء القانون
        function setupFormulaBuilder() {
            formulaParts.forEach(part => {
                part.addEventListener('click', () => {
                    // منع إضافة نفس العنصر مرتين
                    if (!gameData.userFormula.includes(part.dataset.value)) {
                        gameData.userFormula.push(part.dataset.value);
                        updateUserFormulaDisplay();
                    }
                });
            });
        }

        // تحميل السيناريو
        function loadScenario(scenarioId) {
            gameData.currentScenario = scenarioId;
            gameData.userFormula = [];
            gameData.selectedAnswer = null;
            gameData.isFormulaCorrect = false;
            
            const scenario = scenarios[scenarioId];
            gameData.currentPuzzle = scenario;
            
            // تحديث الواجهة
            puzzleTitleElement.textContent = scenario.title;
            puzzleVisualElement.innerHTML = `<div class="scenario-image">${scenario.icon}</div>`;
            puzzleTextElement.innerHTML = `
                <div style="margin-bottom: 10px;">${scenario.description}</div>
                <div style="font-weight: bold; color: #667eea;">${scenario.problem}</div>
            `;
            
            // إعادة تعيين
            updateUserFormulaDisplay();
            puzzleExplanationElement.classList.remove('show');
            checkBtn.disabled = true;
            buildBtn.disabled = false;
            nextPuzzleBtn.disabled = true;
            
            showFeedback('ابنِ القانون الصحيح أولاً!', 'info');
        }

        // تحديث عرض القانون
        function updateUserFormulaDisplay() {
            if (gameData.userFormula.length === 0) {
                userFormulaElement.innerHTML = '<span style="color: #666;">انقر على القطع لبناء القانون</span>';
            } else {
                userFormulaElement.innerHTML = '';
                gameData.userFormula.forEach(value => {
                    const formulaItem = document.createElement('span');
                    formulaItem.className = 'formula-item';
                    formulaItem.textContent = value;
                    userFormulaElement.appendChild(formulaItem);
                });
            }
        }

        // التحقق من بناء القانون
        function checkFormulaBuild() {
            // التحقق إذا كان القانون مطابقاً للقانون الصحيح
            const isCorrect = JSON.stringify(gameData.userFormula) === JSON.stringify(correctFormula);
            
            if (isCorrect) {
                gameData.isFormulaCorrect = true;
                showFeedback('🎉 أحسنت! القانون صحيح: محيط المربع = 4 × طول الضلع', 'success');
                gameData.score += 10;
                buildBtn.disabled = true;
                checkBtn.disabled = false;
                
                // إظهار خيارات الإجابة بعد بناء القانون الصحيح
                showAnswerOptions();
            } else {
                showFeedback('❌ القانون غير صحيح! حاول مرة أخرى', 'error');
                
                // إظهار تلميح
                if (gameData.userFormula.length === 0) {
                    showFeedback('❌ لم تبني أي قانون بعد!', 'error');
                } else if (gameData.userFormula.length < correctFormula.length) {
                    showFeedback('❌ القانون غير مكتمل! أضف المزيد من القطع', 'error');
                } else {
                    showFeedback('❌ ترتيب القانون خاطئ! حاول: 4 × طول الضلع = المحيط', 'error');
                }
            }
            
            updateUI();
        }

        // إظهار خيارات الإجابة
        function showAnswerOptions() {
            const scenario = scenarios[gameData.currentScenario];
            
            // إنشاء خيارات الإجابة
            const options = [scenario.correctAnswer];
            
            // إضافة خيارات خاطئة
            while (options.length < 4) {
                const randomOption = scenario.correctAnswer + (Math.random() > 0.5 ? 4 : -4) * (Math.floor(Math.random() * 3) + 1);
                if (!options.includes(randomOption) && randomOption > 0) {
                    options.push(randomOption);
                }
            }
            
            // خلط الخيارات
            options.sort(() => Math.random() - 0.5);
            
            // عرض الخيارات في منطقة التغذية الراجعة
            let optionsHTML = '<div style="margin-top: 15px;"><strong>اختر الإجابة الصحيحة:</strong><br>';
            options.forEach((option, index) => {
                optionsHTML += `<button onclick="selectAnswer(${option})" style="margin: 5px; padding: 10px 15px; border: 2px solid #667eea; border-radius: 8px; background: white; cursor: pointer;">${option} ${scenario.unit}</button>`;
            });
            optionsHTML += '</div>';
            
            feedbackElement.innerHTML = '🎉 القانون صحيح! الآن اختر الإجابة:' + optionsHTML;
        }

        // اختيار الإجابة
        function selectAnswer(answer) {
            const scenario = scenarios[gameData.currentScenario];
            const isCorrect = answer === scenario.correctAnswer;
            
            if (isCorrect) {
                gameData.score += 20;
                gameData.solvedPuzzles++;
                showFeedback(`🎉 إجابة صحيحة! +20 نقطة. الجواب: ${scenario.correctAnswer} ${scenario.unit}`, 'success');
                showPuzzleExplanation();
                nextPuzzleBtn.disabled = false;
            } else {
                showFeedback(`❌ إجابة خاطئة! حاول مرة أخرى`, 'error');
                showPuzzleExplanation();
            }
            
            checkBtn.disabled = true;
            updateUI();
        }

        // عرض الشرح
        function showPuzzleExplanation() {
            const scenario = scenarios[gameData.currentScenario];
            puzzleExplanationElement.innerHTML = `
                <h4>📝 شرح الحل:</h4>
                <div style="margin: 15px 0;">
                    <strong>المعطيات:</strong> طول ضلع ${scenario.title.toLowerCase()} = ${scenario.sideLength} ${scenario.unit}
                </div>
                <div style="margin: 15px 0;">
                    <strong>القانون:</strong> محيط المربع = 4 × طول الضلع
                </div>
                <div style="margin: 15px 0;">
                    <strong>الحل:</strong> 4 × ${scenario.sideLength} = ${scenario.correctAnswer} ${scenario.unit}
                </div>
                <div style="margin: 15px 0; font-weight: bold; color: #00b894;">
                    ${scenario.explanation}
                </div>
            `;
            puzzleExplanationElement.classList.add('show');
        }

        // مسح البناء
        function clearBuild() {
            gameData.userFormula = [];
            gameData.isFormulaCorrect = false;
            updateUserFormulaDisplay();
            buildBtn.disabled = false;
            checkBtn.disabled = true;
            showFeedback('🗑️ تم مسح البناء، يمكنك البدء من جديد', 'info');
        }

        // اللغز التالي
        function nextPuzzle() {
            const scenarioIds = Object.keys(scenarios);
            const currentIndex = scenarioIds.indexOf(gameData.currentScenario);
            const nextIndex = (currentIndex + 1) % scenarioIds.length;
            
            loadScenario(scenarioIds[nextIndex]);
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            solvedPuzzlesElement.textContent = gameData.solvedPuzzles;
            scoreElement.textContent = gameData.score;
            levelElement.textContent = gameData.level;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            // إذا كانت الرسالة تحتوي على HTML، استخدم innerHTML
            if (message.includes('<')) {
                feedbackElement.innerHTML = message;
                feedbackElement.className = 'feedback ' + type;
            } else {
                feedbackElement.textContent = message;
                feedbackElement.className = 'feedback ' + type;
            }
        }

        // event listeners
        buildBtn.addEventListener('click', checkFormulaBuild);
        clearBtn.addEventListener('click', clearBuild);
        nextPuzzleBtn.addEventListener('click', nextPuzzle);

        // جعل selectAnswer متاحاً globally
        window.selectAnswer = selectAnswer;

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>