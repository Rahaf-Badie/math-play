<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مغامرة المحيط - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            direction: rtl;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            text-align: center;
            border: 3px solid #4a6fa5;
        }

        .lesson-info {
            background: linear-gradient(135deg, #4a6fa5 0%, #3a5a80 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #4a6fa5;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .subtitle {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 25px;
        }

        .instructions {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #4a6fa5;
            font-size: 1.1em;
        }

        .game-area {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            margin: 20px 0;
            justify-content: center;
        }

        .shape-section {
            flex: 1;
            min-width: 350px;
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid #4a6fa5;
        }

        .shape-container {
            position: relative;
            height: 280px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 20px;
        }

        .shape {
            position: absolute;
            border: 4px solid #4a6fa5;
            background: rgba(74, 111, 165, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .rectangle {
            width: 200px;
            height: 140px;
        }

        .square {
            width: 160px;
            height: 160px;
        }

        .dimension {
            position: absolute;
            background: white;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            border: 2px solid #e91e63;
            font-size: 1.1em;
        }

        .width {
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
        }

        .height {
            right: -40px;
            top: 50%;
            transform: translateY(-50%);
            writing-mode: vertical-rl;
        }

        .problem-section {
            flex: 1;
            min-width: 350px;
            background: #e3f2fd;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid #4a6fa5;
        }

        .problem-text {
            font-size: 1.5rem;
            color: #4a6fa5;
            margin: 15px 0;
            font-weight: bold;
            line-height: 1.6;
        }

        .formula-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 2px dashed #4a6fa5;
        }

        .formula {
            font-size: 2rem;
            font-weight: bold;
            color: #e91e63;
            margin: 15px 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .formula-explanation {
            font-size: 1.1rem;
            color: #666;
            margin: 15px 0;
            line-height: 1.5;
        }

        .input-section {
            margin: 25px 0;
        }

        .dimension-inputs {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .input-label {
            font-weight: bold;
            color: #4a6fa5;
            font-size: 1.2em;
        }

        .dimension-input {
            width: 120px;
            height: 60px;
            border: 3px solid #4a6fa5;
            border-radius: 10px;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background: #fffdf6;
            transition: all 0.3s ease;
        }

        .dimension-input:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.3);
            transform: scale(1.05);
        }

        .perimeter-input {
            width: 220px;
            height: 70px;
            border: 3px solid #4a6fa5;
            border-radius: 12px;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background: #fffdf6;
            transition: all 0.3s ease;
        }

        .perimeter-input:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.3);
            transform: scale(1.05);
        }

        .perimeter-input.correct {
            border-color: #4caf50;
            background-color: #e8f5e9;
        }

        .perimeter-input.incorrect {
            border-color: #f44336;
            background-color: #ffebee;
        }

        .examples-section {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .example-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 170px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid #4a6fa5;
        }

        .example-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .example-shape {
            width: 90px;
            height: 70px;
            border: 3px solid #4a6fa5;
            background: rgba(74, 111, 165, 0.1);
            margin: 15px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1em;
        }

        .example-square {
            width: 70px;
            height: 70px;
        }

        .feedback {
            font-size: 1.8rem;
            margin: 25px 0;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            padding: 15px;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-align: center;
            line-height: 1.5;
        }

        .correct {
            color: #4caf50;
            background: #e8f5e9;
            border: 2px solid #4caf50;
            animation: celebrate 0.6s ease;
        }

        .incorrect {
            color: #f44336;
            background: #ffebee;
            border: 2px solid #f44336;
            animation: shake 0.5s ease;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        button {
            background: linear-gradient(135deg, #4a6fa5 0%, #3a5a80 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            min-width: 180px;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        button:active {
            transform: translateY(2px);
        }

        .btn-hint {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
        }

        .btn-next {
            background: linear-gradient(135deg, #4caf50 0%, #388e3c 100%);
        }

        .btn-check {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
        }

        .btn-calculate {
            background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%);
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
            border: 2px solid #4a6fa5;
        }

        #score {
            font-size: 2.2em;
            color: #4a6fa5;
            font-weight: bold;
            display: inline-block;
            padding: 8px 20px;
            background: white;
            border-radius: 50px;
            margin: 0 10px;
        }

        .celebration {
            animation: celebrate 0.6s ease-in-out;
        }

        .progress-bar {
            width: 100%;
            height: 15px;
            background-color: #ddd;
            border-radius: 8px;
            margin: 25px 0;
            overflow: hidden;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #4a6fa5 0%, #3a5a80 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .perimeter-rules {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 12px;
            margin: 25px 0;
            border: 2px dashed #4a6fa5;
            font-weight: bold;
            font-size: 1.1em;
        }

        .shape-type {
            font-size: 1.8rem;
            color: #e91e63;
            font-weight: bold;
            margin: 15px 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        /* الرسوم المتحركة */
        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .shape {
            animation: pulse 3s infinite ease-in-out;
        }

        /* تصميم متجاوب */
        @media (max-width: 768px) {
            .game-area {
                flex-direction: column;
            }

            .shape-section, .problem-section {
                min-width: 100%;
            }

            .dimension-inputs {
                gap: 15px;
            }

            h1 {
                font-size: 2rem;
            }

            .shape-container {
                height: 240px;
            }

            .container {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .perimeter-input {
                width: 180px;
                height: 60px;
                font-size: 1.6rem;
            }

            .dimension-input {
                width: 100px;
                height: 50px;
                font-size: 1.3rem;
            }

            .formula {
                font-size: 1.6rem;
            }

            .controls {
                gap: 10px;
            }

            button {
                padding: 12px 20px;
                font-size: 1.1rem;
                min-width: 150px;
            }

            .example-card {
                width: 140px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>📐 مغامرة المحيط</h1>
        <p class="subtitle">تعلم حساب محيط المستطيل والمربع</p>

        <!-- التعليمات -->
        <div class="instructions">
            <p>🔢 المدى: من {{ $min_range ?? 5 }} إلى {{ $max_range ?? 50 }}</p>
            <p>🎯 تدرب على حساب محيط المستطيل والمربع باستخدام القواعد الرياضية</p>
        </div>

        <!-- قواعد المحيط -->
        <div class="perimeter-rules">
            📚 قواعد المحيط:
            <span style="color: #e91e63; font-weight: bold;">محيط المستطيل = (الطول + العرض) × 2</span> •
            <span style="color: #4caf50; font-weight: bold;">محيط المربع = طول الضلع × 4</span>
        </div>

        <div class="game-area">
            <div class="shape-section">
                <div class="shape-type" id="shape-type">المستطيل</div>
                <div class="shape-container">
                    <div class="shape rectangle" id="shape">
                        <div class="dimension width" id="width-label">الطول: 0</div>
                        <div class="dimension height" id="height-label">العرض: 0</div>
                    </div>
                </div>
                <div class="examples-section" id="examples-section">
                    <!-- سيتم إنشاء الأمثلة هنا -->
                </div>
            </div>

            <div class="problem-section">
                <div class="problem-text" id="problem-text">
                    <!-- سيتم عرض نص المسألة هنا -->
                </div>

                <div class="formula-section">
                    <div class="formula" id="formula">المحيط = (الطول + العرض) × 2</div>
                    <div class="formula-explanation" id="formula-explanation">
                        نجمع الطول والعرض ثم نضرب الناتج في 2
                    </div>
                </div>

                <!-- شريط التقدم -->
                <div class="progress-bar">
                    <div class="progress" id="progress"></div>
                </div>

                <div class="input-section">
                    <div class="dimension-inputs">
                        <div class="input-group">
                            <div class="input-label">الطول</div>
                            <input type="number" class="dimension-input" id="length-input" placeholder="0">
                        </div>
                        <div class="input-group">
                            <div class="input-label">العرض</div>
                            <input type="number" class="dimension-input" id="width-input" placeholder="0">
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-label">المحيط</div>
                        <input type="number" class="perimeter-input" id="perimeter-input" placeholder="أدخل المحيط">
                    </div>
                </div>
            </div>
        </div>

        <div class="feedback" id="feedback"></div>

        <div class="controls">
            <button id="check-btn" class="btn-check">✅ تحقق من الإجابة</button>
            <button id="hint-btn" class="btn-hint">💡 عرض التلميح</button>
            <button id="calculate-btn" class="btn-calculate">🧮 احسب بنفسك</button>
            <button id="next-btn" class="btn-next">🔄 سؤال آخر</button>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>الإجابات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // استخدام المتغيرات من Laravel
            const minRange = {{ $min_range ?? 5 }};
            const maxRange = {{ $max_range ?? 50 }};

            const shapeTypeElement = document.getElementById('shape-type');
            const shapeElement = document.getElementById('shape');
            const widthLabel = document.getElementById('width-label');
            const heightLabel = document.getElementById('height-label');
            const problemText = document.getElementById('problem-text');
            const formulaElement = document.getElementById('formula');
            const formulaExplanation = document.getElementById('formula-explanation');
            const examplesSection = document.getElementById('examples-section');
            const lengthInput = document.getElementById('length-input');
            const widthInput = document.getElementById('width-input');
            const perimeterInput = document.getElementById('perimeter-input');
            const feedbackElement = document.getElementById('feedback');
            const checkButton = document.getElementById('check-btn');
            const hintButton = document.getElementById('hint-btn');
            const calculateButton = document.getElementById('calculate-btn');
            const nextButton = document.getElementById('next-btn');
            const scoreElement = document.getElementById('score');
            const correctCountElement = document.getElementById('correct-count');
            const totalCountElement = document.getElementById('total-count');
            const progressElement = document.getElementById('progress');

            let currentShape = ''; // 'rectangle' or 'square'
            let length = 0;
            let width = 0;
            let correctPerimeter = 0;
            let score = 0;
            let correctAnswers = 0;
            let totalQuestions = 0;

            // إنشاء لعبة جديدة
            function createNewGame() {
                // تحديد نوع الشكل (مستطيل أو مربع)
                currentShape = Math.random() > 0.5 ? 'rectangle' : 'square';

                // توليد أبعاد عشوائية ضمن المدى المحدد
                generateDimensions();

                // حساب المحيط الصحيح
                correctPerimeter = calculatePerimeter(length, width);

                // تحديث العرض
                updateDisplay();

                // إنشاء أمثلة
                createExamples();

                // إعادة تعيين الحالة
                lengthInput.value = '';
                widthInput.value = '';
                perimeterInput.value = '';
                perimeterInput.className = 'perimeter-input';
                feedbackElement.textContent = '💭 ابدأ بحل المسألة!';
                feedbackElement.className = 'feedback';

                totalQuestions++;
                totalCountElement.textContent = totalQuestions;

                // تحديث شريط التقدم
                updateProgress();

                // التركيز على حقل الإدخال
                perimeterInput.focus();
            }

            // توليد الأبعاد
            function generateDimensions() {
                if (currentShape === 'rectangle') {
                    length = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    width = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    // التأكد من أن الطول أكبر من العرض للمستطيل
                    if (length < width) {
                        [length, width] = [width, length];
                    }
                } else { // square
                    length = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                    width = length; // المربع جميع أضلاعه متساوية
                }
            }

            // حساب المحيط
            function calculatePerimeter(l, w) {
                return 2 * (l + w);
            }

            // تحديث العرض
            function updateDisplay() {
                // تحديث نوع الشكل
                shapeTypeElement.textContent = currentShape === 'rectangle' ? 'المستطيل' : 'المربع';

                // تحديث الشكل المرئي
                if (currentShape === 'rectangle') {
                    shapeElement.className = 'shape rectangle';
                    shapeElement.style.width = (length * 5) + 'px';
                    shapeElement.style.height = (width * 5) + 'px';
                } else {
                    shapeElement.className = 'shape square';
                    shapeElement.style.width = (length * 5) + 'px';
                    shapeElement.style.height = (length * 5) + 'px';
                }

                // تحديث التسميات
                widthLabel.textContent = `الطول: ${length}`;
                heightLabel.textContent = `العرض: ${width}`;

                // تحديث نص المسألة
                if (currentShape === 'rectangle') {
                    problemText.textContent = `مستطيل طوله ${length} سم وعرضه ${width} سم. ما هو محيطه؟`;
                    formulaElement.textContent = 'المحيط = (الطول + العرض) × 2';
                    formulaExplanation.textContent = 'نجمع الطول والعرض ثم نضرب الناتج في 2';
                } else {
                    problemText.textContent = `مربع طول ضلعه ${length} سم. ما هو محيطه؟`;
                    formulaElement.textContent = 'المحيط = طول الضلع × 4';
                    formulaExplanation.textContent = 'نضرب طول الضلع في 4 لأن جميع أضلاع المربع متساوية';
                }

                // تحديث حقول الإدخال
                lengthInput.value = length;
                widthInput.value = width;

                if (currentShape === 'square') {
                    widthInput.disabled = true;
                    widthInput.style.background = '#f5f5f5';
                } else {
                    widthInput.disabled = false;
                    widthInput.style.background = '#fffdf6';
                }
            }

            // إنشاء أمثلة
            function createExamples() {
                examplesSection.innerHTML = '';

                const examples = [
                    { l: 5, w: 3, shape: 'rectangle' },
                    { l: 4, w: 4, shape: 'square' },
                    { l: 8, w: 6, shape: 'rectangle' },
                    { l: 7, w: 7, shape: 'square' }
                ];

                examples.forEach(example => {
                    const exampleCard = document.createElement('div');
                    exampleCard.className = 'example-card';

                    const perimeter = calculatePerimeter(example.l, example.w);

                    exampleCard.innerHTML = `
                        <div class="example-shape ${example.shape === 'square' ? 'example-square' : ''}">
                            ${example.l} × ${example.w}
                        </div>
                        <div style="font-weight: bold; color: #4a6fa5;">المحيط = ${perimeter}</div>
                    `;

                    exampleCard.addEventListener('click', function() {
                        showExampleExplanation(example);
                    });

                    examplesSection.appendChild(exampleCard);
                });
            }

            // عرض شرح المثال
            function showExampleExplanation(example) {
                let explanation = '';

                if (example.shape === 'rectangle') {
                    explanation = `📐 مستطيل ${example.l} × ${example.w}:<br>
                                  المحيط = (${example.l} + ${example.w}) × 2 = ${example.l + example.w} × 2 = ${calculatePerimeter(example.l, example.w)}`;
                } else {
                    explanation = `🟦 مربع ضلعه ${example.l}:<br>
                                  المحيط = ${example.l} × 4 = ${calculatePerimeter(example.l, example.l)}`;
                }

                feedbackElement.innerHTML = explanation;
                feedbackElement.className = 'feedback';
            }

            // عرض التلميح
            function showHint() {
                let hint = '';

                if (currentShape === 'rectangle') {
                    hint = `💡 تلميح: المحيط = (الطول + العرض) × 2<br>
                           (${length} + ${width}) × 2 = ${length + width} × 2`;
                } else {
                    hint = `💡 تلميح: محيط المربع = طول الضلع × 4<br>
                           ${length} × 4`;
                }

                feedbackElement.innerHTML = hint;
                feedbackElement.className = 'feedback';
            }

            // حساب المحيط
            function calculatePerimeterManually() {
                const userLength = parseInt(lengthInput.value) || 0;
                const userWidth = parseInt(widthInput.value) || 0;

                if (userLength === 0 || userWidth === 0) {
                    feedbackElement.textContent = '❌ يرجى إدخال الأبعاد أولاً!';
                    feedbackElement.className = 'feedback incorrect';
                    return;
                }

                const calculatedPerimeter = calculatePerimeter(userLength, userWidth);

                if (currentShape === 'rectangle') {
                    feedbackElement.innerHTML = `🧮 الحساب: (${userLength} + ${userWidth}) × 2 = ${calculatedPerimeter}`;
                } else {
                    feedbackElement.innerHTML = `🧮 الحساب: ${userLength} × 4 = ${calculatedPerimeter}`;
                }

                feedbackElement.className = 'feedback';

                // تعبئة الناتج في حقل المحيط
                perimeterInput.value = calculatedPerimeter;
            }

            // التحقق من الإجابة
            function checkAnswer() {
                const userAnswer = parseInt(perimeterInput.value);

                if (isNaN(userAnswer)) {
                    feedbackElement.textContent = '❌ يرجى إدخال الإجابة أولاً!';
                    feedbackElement.className = 'feedback incorrect';
                    return;
                }

                if (userAnswer === correctPerimeter) {
                    feedbackElement.innerHTML = '🎉 أحسنت! الإجابة صحيحة ✓<br><small>ممتاز في حساب المحيط!</small>';
                    feedbackElement.className = 'feedback correct';
                    perimeterInput.className = 'perimeter-input correct';
                    score += 10;
                    correctAnswers++;
                    scoreElement.textContent = score;
                    correctCountElement.textContent = correctAnswers;
                } else {
                    feedbackElement.textContent = '❌ ليس صحيحاً! حاول مرة أخرى';
                    feedbackElement.className = 'feedback incorrect';
                    perimeterInput.className = 'perimeter-input incorrect';
                    score = Math.max(0, score - 2);
                    scoreElement.textContent = score;

                    // عرض الحل الصحيح بعد ثانيتين
                    setTimeout(() => {
                        if (currentShape === 'rectangle') {
                            feedbackElement.innerHTML = `
                                📝 الحل الصحيح:<br>
                                المحيط = (${length} + ${width}) × 2 = ${length + width} × 2 = ${correctPerimeter}
                            `;
                        } else {
                            feedbackElement.innerHTML = `
                                📝 الحل الصحيح:<br>
                                المحيط = ${length} × 4 = ${correctPerimeter}
                            `;
                        }
                    }, 2000);
                }

                // تحديث شريط التقدم
                updateProgress();
            }

            // تحديث شريط التقدم
            function updateProgress() {
                const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
                progressElement.style.width = `${progress}%`;
            }

            // أحداث الأزرار
            checkButton.addEventListener('click', checkAnswer);
            hintButton.addEventListener('click', showHint);
            calculateButton.addEventListener('click', calculatePerimeterManually);
            nextButton.addEventListener('click', createNewGame);

            // السماح بالتحقق بالضغط على Enter
            perimeterInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    checkAnswer();
                }
            });

            // بدء اللعبة الأولى
            createNewGame();
        });
    </script>
</body>
</html>
