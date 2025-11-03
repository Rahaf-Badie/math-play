<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مختبر الأعداد الكسرية - {{ $lesson_game->lesson->name }}</title>
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

        /* شريط التنقل العلوي */
        .navigation-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
        }

        .back-button {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
            text-decoration: none;
            color: white;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.3rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }

        .lab-environment {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .experiment-area {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
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

        .mixed-number-display {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .mixed-number {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .whole-part {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ffeaa7;
            min-width: 50px;
            text-align: center;
        }

        .fraction-visual {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            min-width: 60px;
        }

        .fraction-num, .fraction-den {
            width: 100%;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.3rem;
        }

        .fraction-num {
            background: #74b9ff;
            color: white;
        }

        .fraction-den {
            background: #0984e3;
            color: white;
            border-top: 2px solid white;
        }

        .operation-symbol {
            font-size: 3rem;
            font-weight: bold;
            color: #ffeaa7;
            margin: 0 15px;
            min-width: 40px;
            text-align: center;
        }

        .equals-symbol {
            font-size: 3rem;
            font-weight: bold;
            color: #00b894;
            margin: 0 15px;
            min-width: 40px;
            text-align: center;
        }

        .answer-slot {
            background: rgba(255, 255, 255, 0.3);
            border: 3px dashed #ffeaa7;
            border-radius: 15px;
            padding: 20px;
            min-width: 150px;
            text-align: center;
            font-size: 1.3rem;
            color: #ffeaa7;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .number-pieces {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 20px 0;
        }

        .number-piece {
            background: white;
            border: 2px solid #a29bfe;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .number-piece:hover {
            transform: translateY(-3px);
            border-color: #6c5ce7;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .number-piece.whole {
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
            color: #2d3436;
        }

        .number-piece.numerator {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .number-piece.denominator {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .construction-area {
            background: rgba(255, 255, 255, 0.1);
            border: 2px dashed rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .constructed-number {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.9);
            padding: 12px;
            border-radius: 10px;
        }

        .constructed-whole {
            font-size: 2rem;
            font-weight: bold;
            color: #2d3436;
            min-width: 40px;
            text-align: center;
        }

        .constructed-fraction {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 50px;
        }

        .constructed-num, .constructed-den {
            width: 100%;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .constructed-num {
            background: #74b9ff;
            color: white;
            border-radius: 6px 6px 0 0;
        }

        .constructed-den {
            background: #0984e3;
            color: white;
            border-top: 2px solid white;
            border-radius: 0 0 6px 6px;
        }

        .construction-controls {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        .construction-part {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 8px;
        }

        .part-label {
            font-weight: bold;
            color: #2d3436;
            min-width: 70px;
        }

        .part-value {
            background: white;
            border: 2px solid #a29bfe;
            border-radius: 6px;
            padding: 8px;
            min-width: 50px;
            text-align: center;
            font-weight: bold;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        .lab-button {
            padding: 12px 20px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        #build-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #check-construction-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #clear-btn {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .lab-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.2);
        }

        .feedback-area {
            text-align: center;
            padding: 15px;
            border-radius: 12px;
            margin: 15px 0;
            font-size: 1.1rem;
            font-weight: bold;
            min-height: 60px;
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

        .progress-tracker {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 20px;
        }

        .progress-card {
            background: linear-gradient(135deg, #dfe6e9 0%, #b2bec3 100%);
            padding: 15px;
            border-radius: 12px;
            text-align: center;
        }

        .progress-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2d3436;
        }

        .progress-label {
            font-size: 0.8rem;
            color: #636e72;
            margin-top: 5px;
        }

        .conversion-help {
            background: #e9f7ef;
            border: 2px solid #00b894;
            border-radius: 12px;
            padding: 15px;
            margin: 15px 0;
            display: none;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .lab-environment {
                grid-template-columns: 1fr;
            }

            .mixed-number-display {
                flex-direction: column;
                gap: 15px;
            }

            .number-pieces {
                grid-template-columns: repeat(2, 1fr);
            }

            .progress-tracker {
                grid-template-columns: repeat(2, 1fr);
            }

            .controls {
                flex-direction: column;
            }

            .navigation-bar {
                flex-direction: column;
                gap: 15px;
            }

            .back-button {
                order: 2;
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    <!-- رابط أيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- شريط التنقل العلوي -->
        <div class="navigation-bar">
            <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-button">
                <i class="fas fa-arrow-right"></i>
                العودة إلى الدرس
            </a>
            <div>
                <h1 class="lesson-title">🔬 مختبر الأعداد الكسرية</h1>
                <p style="text-align: center; color: #636e72;">{{ $lesson_game->lesson->name }}</p>
            </div>
        </div>

        <div class="lab-environment">
            <div class="experiment-area">
                <div class="panel-title">🧪 منطقة التجارب</div>

                <div class="mixed-number-display">
                    <div class="mixed-number">
                        <div class="whole-part" id="exp-whole1">0</div>
                        <div class="fraction-visual">
                            <div class="fraction-num" id="exp-num1">0</div>
                            <div class="fraction-den" id="exp-den1">1</div>
                        </div>
                    </div>

                    <div class="operation-symbol" id="exp-operation">
                        {{ $operation_type == 'addition' ? '+' : '-' }}
                    </div>

                    <div class="mixed-number">
                        <div class="whole-part" id="exp-whole2">0</div>
                        <div class="fraction-visual">
                            <div class="fraction-num" id="exp-num2">0</div>
                            <div class="fraction-den" id="exp-den2">1</div>
                        </div>
                    </div>

                    <div class="equals-symbol">=</div>

                    <div class="answer-slot" id="answer-slot">
                        ؟؟
                    </div>
                </div>

                <div class="construction-area" id="construction-area">
                    <div style="color: rgba(255, 255, 255, 0.7); text-align: center;">
                        <i class="fas fa-mouse-pointer"></i><br>
                        اختر القطع لبناء الإجابة
                    </div>
                </div>

                <!-- عناصر التحكم في البناء -->
                <div class="construction-controls" id="construction-controls" style="display: none;">
                    <div class="construction-part">
                        <div class="part-label">العدد الصحيح:</div>
                        <div class="part-value" id="current-whole">0</div>
                        <button class="lab-button" onclick="changePart('whole', 1)" style="padding: 8px 12px; font-size: 0.9rem;">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="lab-button" onclick="changePart('whole', -1)" style="padding: 8px 12px; font-size: 0.9rem; background: #ff7675;">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <div class="construction-part">
                        <div class="part-label">البسط:</div>
                        <div class="part-value" id="current-numerator">0</div>
                        <button class="lab-button" onclick="changePart('numerator', 1)" style="padding: 8px 12px; font-size: 0.9rem;">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="lab-button" onclick="changePart('numerator', -1)" style="padding: 8px 12px; font-size: 0.9rem; background: #ff7675;">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <div class="construction-part">
                        <div class="part-label">المقام:</div>
                        <div class="part-value" id="current-denominator">1</div>
                        <button class="lab-button" onclick="changePart('denominator', 1)" style="padding: 8px 12px; font-size: 0.9rem;">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="lab-button" onclick="changePart('denominator', -1)" style="padding: 8px 12px; font-size: 0.9rem; background: #ff7675;">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="conversion-help" id="conversion-help">
                    <h4>💡 مساعدة في التحويل:</h4>
                    <p id="conversion-steps"></p>
                </div>
            </div>

            <div class="tools-panel">
                <div class="panel-title">🛠 أدوات البناء</div>

                <div class="number-pieces" id="number-pieces">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>

                <div class="controls">
                    <button class="lab-button" id="start-build-btn">
                        <i class="fas fa-play"></i>
                        ابدأ البناء
                    </button>
                    <button class="lab-button" id="check-construction-btn">
                        <i class="fas fa-check-circle"></i>
                        فحص
                    </button>
                    <button class="lab-button" id="clear-btn">
                        <i class="fas fa-trash"></i>
                        مسح
                    </button>
                </div>

                <div class="feedback-area feedback-info" id="feedback-area">
                    <i class="fas fa-play-circle"></i>
                    انقر على "ابدأ البناء" لبناء الإجابة
                </div>

                <div class="progress-tracker">
                    <div class="progress-card">
                        <div class="progress-value" id="lab-score">0</div>
                        <div class="progress-label">النقاط</div>
                    </div>
                    <div class="progress-card">
                        <div class="progress-value" id="constructions">0</div>
                        <div class="progress-label">الإنشاءات</div>
                    </div>
                    <div class="progress-card">
                        <div class="progress-value" id="success-rate">100%</div>
                        <div class="progress-label">معدل النجاح</div>
                    </div>
                    <div class="progress-card">
                        <div class="progress-value" id="level">1</div>
                        <div class="progress-label">المستوى</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        const operationType = "{{ $operation_type }}";

        // متغيرات اللعبة
        let currentExperiment = null;
        let labScore = 0;
        let totalConstructions = 0;
        let successfulConstructions = 0;
        let currentLevel = 1;
        let currentConstruction = {
            whole: 0,
            numerator: 0,
            denominator: 1
        };
        let isBuilding = false;

        // عناصر DOM
        const expWhole1 = document.getElementById('exp-whole1');
        const expNum1 = document.getElementById('exp-num1');
        const expDen1 = document.getElementById('exp-den1');
        const expWhole2 = document.getElementById('exp-whole2');
        const expNum2 = document.getElementById('exp-num2');
        const expDen2 = document.getElementById('exp-den2');
        const answerSlot = document.getElementById('answer-slot');
        const constructionArea = document.getElementById('construction-area');
        const constructionControls = document.getElementById('construction-controls');
        const numberPiecesContainer = document.getElementById('number-pieces');
        const startBuildButton = document.getElementById('start-build-btn');
        const checkButton = document.getElementById('check-construction-btn');
        const clearButton = document.getElementById('clear-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const conversionHelp = document.getElementById('conversion-help');
        const conversionSteps = document.getElementById('conversion-steps');
        const labScoreElement = document.getElementById('lab-score');
        const constructionsElement = document.getElementById('constructions');
        const successRateElement = document.getElementById('success-rate');
        const levelElement = document.getElementById('level');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            setupExperiment();
            setupEventListeners();
            generateNumberPieces();
        });

        function setupEventListeners() {
            startBuildButton.addEventListener('click', startBuilding);
            checkButton.addEventListener('click', checkConstruction);
            clearButton.addEventListener('click', clearConstruction);
        }

        function setupExperiment() {
            // توليد تجربة جديدة
            const whole1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
            const whole2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;

            const denominator = getRandomDenominator();
            const numerator1 = getRandomNumerator(denominator);
            let numerator2 = getRandomNumerator(denominator);

            // التأكد من أن عملية الطرح تعطي نتيجة موجبة
            if (operationType === 'subtraction') {
                const total1 = whole1 + numerator1/denominator;
                const total2 = whole2 + numerator2/denominator;
                if (total1 < total2) {
                    [whole1, whole2] = [whole2, whole1];
                    [numerator1, numerator2] = [numerator2, numerator1];
                }
            }

            currentExperiment = {
                whole1,
                numerator1,
                denominator1: denominator,
                whole2,
                numerator2,
                denominator2: denominator,
                operation: operationType
            };

            // حساب الإجابة الصحيحة
            calculateExperimentAnswer();

            // عرض التجربة
            displayExperiment();

            // إخفاء المساعدة وعناصر البناء
            conversionHelp.style.display = 'none';
            constructionControls.style.display = 'none';
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.innerHTML = '<i class="fas fa-play-circle"></i> انقر على "ابدأ البناء" لبناء الإجابة';

            // إعادة تعيين البناء
            resetConstruction();
        }

        function displayExperiment() {
            expWhole1.textContent = currentExperiment.whole1;
            expNum1.textContent = currentExperiment.numerator1;
            expDen1.textContent = currentExperiment.denominator1;

            expWhole2.textContent = currentExperiment.whole2;
            expNum2.textContent = currentExperiment.numerator2;
            expDen2.textContent = currentExperiment.denominator2;
        }

        function calculateExperimentAnswer() {
            if (operationType === 'addition') {
                // جمع الأعداد الكسرية
                let totalWhole = currentExperiment.whole1 + currentExperiment.whole2;
                let totalNumerator = currentExperiment.numerator1 + currentExperiment.numerator2;
                let totalDenominator = currentExperiment.denominator1;

                // تحويل الكسور غير الحقيقية
                if (totalNumerator >= totalDenominator) {
                    const extraWhole = Math.floor(totalNumerator / totalDenominator);
                    totalWhole += extraWhole;
                    totalNumerator = totalNumerator % totalDenominator;
                }

                // تبسيط الكسر
                const simplified = simplifyFraction(totalNumerator, totalDenominator);

                currentExperiment.correctAnswer = {
                    whole: totalWhole,
                    numerator: simplified.numerator,
                    denominator: simplified.denominator
                };
            } else {
                // طرح الأعداد الكسرية
                const improper1 = currentExperiment.whole1 * currentExperiment.denominator1 + currentExperiment.numerator1;
                const improper2 = currentExperiment.whole2 * currentExperiment.denominator2 + currentExperiment.numerator2;

                let resultNumerator = improper1 - improper2;
                const resultDenominator = currentExperiment.denominator1;

                const resultWhole = Math.floor(resultNumerator / resultDenominator);
                resultNumerator = resultNumerator % resultDenominator;

                const simplified = simplifyFraction(resultNumerator, resultDenominator);

                currentExperiment.correctAnswer = {
                    whole: resultWhole,
                    numerator: simplified.numerator,
                    denominator: simplified.denominator
                };
            }
        }

        function generateNumberPieces() {
            numberPiecesContainer.innerHTML = '';

            // توليد قطع أعداد متنوعة
            const numbers = [];

            // إضافة الأعداد الصحيحة المحتملة (0-20)
            for (let i = 0; i <= 20; i++) {
                numbers.push({value: i, type: 'whole'});
            }

            // إضافة بسط ومقام محتملين (1-12)
            for (let i = 1; i <= 12; i++) {
                numbers.push({value: i, type: 'numerator'});
                numbers.push({value: i, type: 'denominator'});
            }

            // خلط المصفوفة
            shuffleArray(numbers);

            // عرض 15 قطعة عشوائية
            numbers.slice(0, 15).forEach(item => {
                const piece = document.createElement('div');
                piece.className = `number-piece ${item.type}`;
                piece.textContent = item.value;
                piece.setAttribute('data-value', item.value);
                piece.setAttribute('data-type', item.type);

                piece.addEventListener('click', function() {
                    if (isBuilding) {
                        useNumberPiece(item.value, item.type);
                    }
                });

                numberPiecesContainer.appendChild(piece);
            });
        }

        function useNumberPiece(value, type) {
            switch(type) {
                case 'whole':
                    currentConstruction.whole = value;
                    break;
                case 'numerator':
                    currentConstruction.numerator = value;
                    break;
                case 'denominator':
                    currentConstruction.denominator = value;
                    break;
            }
            updateConstructionDisplay();
            updateConstructionControls();
        }

        function changePart(part, change) {
            switch(part) {
                case 'whole':
                    currentConstruction.whole = Math.max(0, currentConstruction.whole + change);
                    break;
                case 'numerator':
                    currentConstruction.numerator = Math.max(0, currentConstruction.numerator + change);
                    break;
                case 'denominator':
                    currentConstruction.denominator = Math.max(1, currentConstruction.denominator + change);
                    break;
            }
            updateConstructionDisplay();
            updateConstructionControls();
        }

        function updateConstructionDisplay() {
            constructionArea.innerHTML = '';

            if (currentConstruction.whole !== 0 || currentConstruction.numerator !== 0) {
                const constructedNumber = document.createElement('div');
                constructedNumber.className = 'constructed-number';

                if (currentConstruction.whole !== 0) {
                    const wholePart = document.createElement('div');
                    wholePart.className = 'constructed-whole';
                    wholePart.textContent = currentConstruction.whole;
                    constructedNumber.appendChild(wholePart);
                }

                if (currentConstruction.numerator !== 0 && currentConstruction.denominator !== 0) {
                    const fractionVisual = document.createElement('div');
                    fractionVisual.className = 'constructed-fraction';

                    const numerator = document.createElement('div');
                    numerator.className = 'constructed-num';
                    numerator.textContent = currentConstruction.numerator;
                    fractionVisual.appendChild(numerator);

                    const denominator = document.createElement('div');
                    denominator.className = 'constructed-den';
                    denominator.textContent = currentConstruction.denominator;
                    fractionVisual.appendChild(denominator);

                    constructedNumber.appendChild(fractionVisual);
                }

                constructionArea.appendChild(constructedNumber);
            } else {
                constructionArea.innerHTML = '<div style="color: rgba(255, 255, 255, 0.7); text-align: center;"><i class="fas fa-mouse-pointer"></i><br>استخدم الأزرار أو القطع لبناء الإجابة</div>';
            }
        }

        function updateConstructionControls() {
            document.getElementById('current-whole').textContent = currentConstruction.whole;
            document.getElementById('current-numerator').textContent = currentConstruction.numerator;
            document.getElementById('current-denominator').textContent = currentConstruction.denominator;
        }

        function startBuilding() {
            isBuilding = true;
            constructionControls.style.display = 'flex';
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.innerHTML = '<i class="fas fa-hammer"></i> استخدم الأزرار أو القطع لبناء الإجابة';
            updateConstructionDisplay();
            updateConstructionControls();
        }

        function checkConstruction() {
            if (!isBuilding) {
                feedbackArea.className = 'feedback-area feedback-wrong';
                feedbackArea.innerHTML = '<i class="fas fa-exclamation-circle"></i> يرجى البدء بالبناء أولاً';
                return;
            }

            if (currentConstruction.numerator === 0 && currentConstruction.denominator === 1) {
                feedbackArea.className = 'feedback-area feedback-wrong';
                feedbackArea.innerHTML = '<i class="fas fa-exclamation-circle"></i> يرجى بناء كسر صحيح';
                return;
            }

            if (currentConstruction.denominator === 0) {
                feedbackArea.className = 'feedback-area feedback-wrong';
                feedbackArea.innerHTML = '<i class="fas fa-exclamation-circle"></i> المقام لا يمكن أن يكون صفراً';
                return;
            }

            totalConstructions++;

            const isCorrect =
                currentConstruction.whole === currentExperiment.correctAnswer.whole &&
                currentConstruction.numerator === currentExperiment.correctAnswer.numerator &&
                currentConstruction.denominator === currentExperiment.correctAnswer.denominator;

            // عرض الإجابة المبنية
            answerSlot.innerHTML = `
                <div style="display: flex; align-items: center; gap: 8px; justify-content: center;">
                    <span style="font-size: 1.8rem;">${currentConstruction.whole}</span>
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <div style="background: #74b9ff; color: white; padding: 4px 12px; border-radius: 5px 5px 0 0; font-size: 1.1rem;">${currentConstruction.numerator}</div>
                        <div style="background: #0984e3; color: white; padding: 4px 12px; border-top: 2px solid white; border-radius: 0 0 5px 5px; font-size: 1.1rem;">${currentConstruction.denominator}</div>
                    </div>
                </div>
            `;

            if (isCorrect) {
                successfulConstructions++;
                labScore += 25;

                feedbackArea.className = 'feedback-area feedback-correct';
                feedbackArea.innerHTML = '<i class="fas fa-trophy"></i> بناء صحيح! إجابة ممتازة!';

                updateProgress();

                // تجربة جديدة بعد ثانيتين
                setTimeout(() => {
                    setupExperiment();
                    generateNumberPieces();
                }, 2000);
            } else {
                labScore = Math.max(0, labScore - 5);
                feedbackArea.className = 'feedback-area feedback-wrong';
                feedbackArea.innerHTML = '<i class="fas fa-times-circle"></i> بناء خاطئ! حاول مرة أخرى';

                // عرض المساعدة
                showConversionHelp();
                updateProgress();
            }
        }

        function showConversionHelp() {
            conversionHelp.style.display = 'block';

            if (operationType === 'addition') {
                conversionSteps.innerHTML = `
                    <strong>طريقة الجمع:</strong><br>
                    1. اجمع الأعداد الصحيحة: ${currentExperiment.whole1} + ${currentExperiment.whole2} = ${currentExperiment.whole1 + currentExperiment.whole2}<br>
                    2. اجمع الكسور: ${currentExperiment.numerator1}/${currentExperiment.denominator1} + ${currentExperiment.numerator2}/${currentExperiment.denominator2} = ${currentExperiment.numerator1 + currentExperiment.numerator2}/${currentExperiment.denominator1}<br>
                    3. إذا كان الكسر أكبر من ١، حوله إلى عدد صحيح وكسر<br>
                    4. الناتج النهائي: ${currentExperiment.correctAnswer.whole} و ${currentExperiment.correctAnswer.numerator}/${currentExperiment.correctAnswer.denominator}
                `;
            } else {
                conversionSteps.innerHTML = `
                    <strong>طريقة الطرح:</strong><br>
                    1. حول إلى كسور غير حقيقية:<br>
                    &nbsp;&nbsp;${currentExperiment.whole1} ${currentExperiment.numerator1}/${currentExperiment.denominator1} = ${currentExperiment.whole1 * currentExperiment.denominator1 + currentExperiment.numerator1}/${currentExperiment.denominator1}<br>
                    &nbsp;&nbsp;${currentExperiment.whole2} ${currentExperiment.numerator2}/${currentExperiment.denominator2} = ${currentExperiment.whole2 * currentExperiment.denominator2 + currentExperiment.numerator2}/${currentExperiment.denominator2}<br>
                    2. اطرح الكسور<br>
                    3. الناتج النهائي: ${currentExperiment.correctAnswer.whole} و ${currentExperiment.correctAnswer.numerator}/${currentExperiment.correctAnswer.denominator}
                `;
            }
        }

        function clearConstruction() {
            resetConstruction();
            answerSlot.innerHTML = '？？';
            conversionHelp.style.display = 'none';
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.innerHTML = '<i class="fas fa-play-circle"></i> انقر على "ابدأ البناء" لبناء الإجابة';
        }

        function resetConstruction() {
            currentConstruction = {
                whole: 0,
                numerator: 0,
                denominator: 1
            };
            isBuilding = false;
            constructionControls.style.display = 'none';
            updateConstructionDisplay();
            updateConstructionControls();
        }

        function updateProgress() {
            labScoreElement.textContent = labScore;
            constructionsElement.textContent = totalConstructions;

            const successRate = totalConstructions > 0 ?
                Math.round((successfulConstructions / totalConstructions) * 100) : 100;
            successRateElement.textContent = `${successRate}%`;

            // تحديث المستوى
            currentLevel = Math.floor(labScore / 100) + 1;
            levelElement.textContent = currentLevel;
        }

        // دوال مساعدة
        function getRandomDenominator() {
            const denominators = [2, 3, 4, 5, 6, 8, 10];
            return denominators[Math.floor(Math.random() * denominators.length)];
        }

        function getRandomNumerator(denominator) {
            return Math.floor(Math.random() * denominator) + 1;
        }

        function simplifyFraction(numerator, denominator) {
            if (numerator === 0) {
                return { numerator: 0, denominator: 1 };
            }

            const gcd = findGCD(numerator, denominator);
            return {
                numerator: numerator / gcd,
                denominator: denominator / gcd
            };
        }

        function findGCD(a, b) {
            return b === 0 ? a : findGCD(b, a % b);
        }

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
    </script>
</body>
</html>
