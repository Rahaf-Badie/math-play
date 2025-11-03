<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>برج الكسور - {{ $lesson_game->lesson->name }}</title>
    <style>
        /* ======================================= */
        /* === CSS / التنسيقات === */
        /* ======================================= */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            direction: rtl;
            text-align: center;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 900px;
            border: 3px solid #e74c3c;
        }

        .lesson-info {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #e74c3c;
            margin-bottom: 15px;
            border-bottom: 3px solid #e74c3c;
            padding-bottom: 10px;
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #fdf5f5 0%, #f9e3e3 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #e74c3c;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #fdf5f5 0%, #f9e3e3 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #e74c3c;
            position: relative;
        }

        .game-area::before {
            content: "🏗️";
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 2em;
            opacity: 0.3;
        }

        .comparison-layout {
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            min-height: 300px;
            margin-bottom: 30px;
            gap: 40px;
        }

        .tower-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 180px;
        }

        .tower-label {
            font-size: 1.3em;
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .tower {
            display: flex;
            flex-direction: column-reverse;
            width: 100px;
            border: 3px solid #34495e;
            border-radius: 8px 8px 0 0;
            margin-bottom: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
            position: relative;
            overflow: hidden;
        }

        .tower-segment {
            height: 25px;
            border-top: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .filled {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .empty {
            background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
        }

        .fraction-display {
            font-size: 2em;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 15px;
            padding: 10px 20px;
            background: white;
            border-radius: 10px;
            border: 2px solid #e74c3c;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .controls-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 200px;
        }

        .controls-title {
            font-size: 1.4em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .controls button {
            padding: 20px;
            font-size: 2.2em;
            font-weight: bold;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            min-width: 80px;
        }

        .controls button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .controls button:active {
            transform: translateY(-2px);
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.3em;
            font-weight: bold;
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-align: center;
            line-height: 1.5;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.2em;
            color: #e74c3c;
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

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background-color: #ddd;
            border-radius: 6px;
            margin: 20px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .fraction-rule {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px dashed #e74c3c;
            font-weight: bold;
            font-size: 1.1em;
            text-align: center;
        }

        .reset-btn {
            padding: 12px 25px;
            font-size: 1.1em;
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            margin-top: 10px;
        }

        .reset-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(116, 185, 255, 0.4);
        }

        .lesson-type-indicator {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            display: inline-block;
        }

        .difficulty-indicator {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.9em;
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .comparison-layout {
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }

            .controls-area {
                order: -1;
                margin-bottom: 20px;
            }

            .controls {
                flex-direction: row;
            }

            .tower {
                width: 80px;
            }

            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.6em;
            }
        }

        @media (max-width: 480px) {
            .fraction-display {
                font-size: 1.6em;
            }

            .controls button {
                padding: 15px;
                font-size: 1.8em;
                min-width: 60px;
            }

            .tower {
                width: 70px;
            }

            .game-area {
                padding: 20px;
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

        <h1>🏗️ برج الكسور</h1>

        <!-- مؤشر نوع الدرس -->
        <div class="lesson-type-indicator" id="lesson-type-indicator">
            <!-- سيتم تعبئته ديناميكياً -->
        </div>

        <!-- التعليمات -->
        <div class="instructions">
            <p>🔢 المدى: من {{ $min_range ?? 1 }} إلى {{ $max_range ?? 10 }}</p>
            <p id="game-instructions">🎯 قارن بين الكسور باستخدام الأبراج الملونة</p>
        </div>

        <!-- قاعدة الكسور -->
        <div class="fraction-rule" id="fraction-rule">
            <!-- سيتم تعبئته ديناميكياً -->
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <div class="comparison-layout">
                <!-- البرج الأول -->
                <div class="tower-container">
                    <div class="tower-label">البرج الأول</div>
                    <div id="tower1" class="tower"></div>
                    <div id="frac-disp-1" class="fraction-display">---</div>
                </div>

                <!-- عناصر التحكم -->
                <div class="controls-area">
                    <div class="controls-title" id="controls-title">أي كسر أكبر؟</div>
                    <div class="controls" id="controls-buttons">
                        <!-- سيتم تعبئته ديناميكياً -->
                    </div>
                </div>

                <!-- البرج الثاني -->
                <div class="tower-container">
                    <div class="tower-label">البرج الثاني</div>
                    <div id="tower2" class="tower"></div>
                    <div id="frac-disp-2" class="fraction-display">---</div>
                </div>
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">
                قارن بين الأبراج واختر الرمز المناسب!
            </div>

            <!-- زر إعادة -->
            <button class="reset-btn" onclick="resetGame()">🔄 سؤال جديد</button>
        </div>

        <!-- النقاط -->
        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>الإجابات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript / المنطق ===

        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 10 }};
        const lessonId = {{ $lesson_game->lesson->id ?? 83 }};

        let f1Num, f1Den, f2Num, f2Den;
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let currentLessonType = '';

        // تحديد نوع الدرس وإعداداته
        const lessonConfigs = {
            83: { // الكسور (مقدمة أساسية)
                type: 'fractions_basic',
                name: '📚 مقدمة في الكسور',
                instructions: '🎯 قارن بين الكسور باستخدام الأبراج الملونة واختر رمز المقارنة الصحيح',
                rule: '📚 تذكر: الكسر يمثل جزءاً من الكل - البسط/المقام 🧩',
                controlsTitle: 'أي كسر أكبر؟',
                buttons: ['<', '=', '>'],
                difficulty: 'مبتدئ',
                equalProbability: 0.2,
                maxDenominator: 8
            },
            84: { // الكسور المتكافئة
                type: 'equivalent_fractions',
                name: '🔄 الكسور المتكافئة',
                instructions: '🎯 اكتشف الكسور المتكافئة - الكسور التي تمثل نفس القيمة',
                rule: '📚 تذكر: الكسور المتكافئة لها نفس القيمة مثل ½ = ²⁄₄ 🔄',
                controlsTitle: 'هل الكسران متكافئان؟',
                buttons: ['≠', '='],
                difficulty: 'متوسط',
                equalProbability: 0.7,
                maxDenominator: 12
            },
            85: { // مقارنة الكسور
                type: 'fractions_comparison',
                name: '⚖️ مقارنة الكسور',
                instructions: '🎯 قارن بين الكسور بدقة باستخدام الأبراج والتمثيل البصري',
                rule: '📚 تذكر: كسران لهما نفس المقام - الأكبر بسطاً هو الأكبر قيمة ⚖️',
                controlsTitle: 'قارن بين الكسرين',
                buttons: ['<', '=', '>'],
                difficulty: 'متقدم',
                equalProbability: 0.1,
                maxDenominator: 15
            }
        };

        function determineLessonType() {
            const config = lessonConfigs[lessonId] || lessonConfigs[83];
            currentLessonType = config.type;

            document.getElementById('lesson-type-indicator').innerHTML =
                `${config.name} <span class="difficulty-indicator">${config.difficulty}</span>`;
            document.getElementById('game-instructions').textContent = config.instructions;
            document.getElementById('fraction-rule').innerHTML = config.rule;
            document.getElementById('controls-title').textContent = config.controlsTitle;

            // إنشاء أزرار التحكم المناسبة
            createControlButtons(config.buttons);
        }

        function createControlButtons(buttons) {
            const controlsContainer = document.getElementById('controls-buttons');
            controlsContainer.innerHTML = '';

            buttons.forEach(buttonSymbol => {
                const button = document.createElement('button');
                button.textContent = buttonSymbol;
                button.onclick = () => submitAnswer(buttonSymbol);
                controlsContainer.appendChild(button);
            });
        }

        function generateFraction(maxDen) {
            let den = Math.floor(Math.random() * (maxDen - minRange + 1)) + minRange;
            let num = Math.floor(Math.random() * den) + 1;
            return { num, den };
        }

        function simplifyFraction(num, den) {
            const gcd = (a, b) => b === 0 ? a : gcd(b, a % b);
            const divisor = gcd(num, den);
            return {
                num: num / divisor,
                den: den / divisor
            };
        }

        function generateProblemForLesson() {
            const config = lessonConfigs[lessonId];

            switch(currentLessonType) {
                case 'fractions_basic':
                    generateBasicFractionsProblem(config);
                    break;
                case 'equivalent_fractions':
                    generateEquivalentFractionsProblem(config);
                    break;
                case 'fractions_comparison':
                    generateFractionsComparisonProblem(config);
                    break;
            }
        }

        function generateBasicFractionsProblem(config) {
            let f1 = generateFraction(config.maxDenominator);
            let f2 = generateFraction(config.maxDenominator);

            if (Math.random() < config.equalProbability) {
                const simplified = simplifyFraction(f1.num, f1.den);
                const multiplier = Math.floor(Math.random() * 2) + 2;
                f2.num = simplified.num * multiplier;
                f2.den = simplified.den * multiplier;
            } else {
                while (Math.abs(f1.num/f1.den - f2.num/f2.den) < 0.15) {
                    f2 = generateFraction(config.maxDenominator);
                }
            }

            f1Num = f1.num; f1Den = f1.den;
            f2Num = f2.num; f2Den = f2.den;

            renderTowers();
        }

        function generateEquivalentFractionsProblem(config) {
            const isEquivalent = Math.random() < config.equalProbability;

            if (isEquivalent) {
                const baseFraction = generateFraction(config.maxDenominator);
                const multiplier = Math.floor(Math.random() * 2) + 2;

                f1Num = baseFraction.num;
                f1Den = baseFraction.den;
                f2Num = baseFraction.num * multiplier;
                f2Den = baseFraction.den * multiplier;
            } else {
                let f1 = generateFraction(config.maxDenominator);
                let f2 = generateFraction(config.maxDenominator);

                while (f1.num * f2.den === f1.den * f2.num) {
                    f2 = generateFraction(config.maxDenominator);
                }

                f1Num = f1.num; f1Den = f1.den;
                f2Num = f2.num; f2Den = f2.den;
            }

            renderTowers();
        }

        function generateFractionsComparisonProblem(config) {
            // لمقارنة الكسور، نركز على كسور لها نفس المقام أو بسط متقارب
            const comparisonType = Math.random();

            if (comparisonType < 0.4) {
                // كسور لها نفس المقام
                const commonDen = Math.floor(Math.random() * (config.maxDenominator - 3 + 1)) + 3;
                f1Den = commonDen;
                f2Den = commonDen;
                f1Num = Math.floor(Math.random() * (commonDen - 1)) + 1;
                do {
                    f2Num = Math.floor(Math.random() * (commonDen - 1)) + 1;
                } while (Math.abs(f1Num - f2Num) < 2);
            } else if (comparisonType < 0.7) {
                // كسور لها نفس البسط
                const commonNum = Math.floor(Math.random() * (config.maxDenominator - 2 + 1)) + 2;
                f1Num = commonNum;
                f2Num = commonNum;
                f1Den = Math.floor(Math.random() * (config.maxDenominator - commonNum + 1)) + commonNum;
                do {
                    f2Den = Math.floor(Math.random() * (config.maxDenominator - commonNum + 1)) + commonNum;
                } while (Math.abs(f1Den - f2Den) < 2);
            } else {
                // كسور عادية مع فرق واضح
                let f1 = generateFraction(config.maxDenominator);
                let f2 = generateFraction(config.maxDenominator);

                while (Math.abs(f1.num/f1.den - f2.num/f2.den) < 0.2) {
                    f2 = generateFraction(config.maxDenominator);
                }

                f1Num = f1.num; f1Den = f1.den;
                f2Num = f2.num; f2Den = f2.den;
            }

            renderTowers();
        }

        function renderTowers() {
            const maxDen = Math.max(f1Den, f2Den);
            const segmentsCount = maxDen;

            // برج الأول
            const tower1 = document.getElementById('tower1');
            tower1.innerHTML = '';
            tower1.style.height = `${segmentsCount * 27}px`;
            const filledSegments1 = Math.round(f1Num * (maxDen / f1Den));

            for (let i = 0; i < segmentsCount; i++) {
                const segment = document.createElement('div');
                segment.classList.add('tower-segment');
                segment.classList.add(i < filledSegments1 ? 'filled' : 'empty');
                tower1.appendChild(segment);
            }

            // برج الثاني
            const tower2 = document.getElementById('tower2');
            tower2.innerHTML = '';
            tower2.style.height = `${segmentsCount * 27}px`;
            const filledSegments2 = Math.round(f2Num * (maxDen / f2Den));

            for (let i = 0; i < segmentsCount; i++) {
                const segment = document.createElement('div');
                segment.classList.add('tower-segment');
                segment.classList.add(i < filledSegments2 ? 'filled' : 'empty');
                tower2.appendChild(segment);
            }

            // عرض الكسور
            document.getElementById('frac-disp-1').textContent = `${f1Num}/${f1Den}`;
            document.getElementById('frac-disp-2').textContent = `${f2Num}/${f2Den}`;

            // تعيين رسالة التعليمات المناسبة
            let instructionMessage = '';
            const config = lessonConfigs[lessonId];

            switch(currentLessonType) {
                case 'fractions_basic':
                    instructionMessage = '🔍 قارن بين الأبراج... أي كسر يمثل مساحة أكبر؟';
                    break;
                case 'equivalent_fractions':
                    instructionMessage = '🔍 هل هذان الكسران متكافئان؟ انظر إلى الأبراج!';
                    break;
                case 'fractions_comparison':
                    instructionMessage = '🔍 قارن بدقة... انظر إلى البسط والمقام!';
                    break;
            }

            document.getElementById('feedback').innerHTML = instructionMessage;
            document.getElementById('feedback').style.color = '#2c3e50';
            document.querySelectorAll('.controls button').forEach(btn => btn.disabled = false);
        }

        function getCorrectSymbol() {
            const value1 = f1Num / f1Den;
            const value2 = f2Num / f2Den;

            if (currentLessonType === 'equivalent_fractions') {
                return (f1Num * f2Den === f1Den * f2Num) ? '=' : '≠';
            } else {
                if (Math.abs(value1 - value2) < 0.001) {
                    return '=';
                } else if (value1 > value2) {
                    return '>';
                } else {
                    return '<';
                }
            }
        }

        function submitAnswer(userChoice) {
            const correctSymbol = getCorrectSymbol();
            const feedbackElement = document.getElementById('feedback');
            totalQuestions++;

            // تعطيل الأزرار
            document.querySelectorAll('.controls button').forEach(btn => btn.disabled = true);

            if (userChoice === correctSymbol) {
                let successMessage = '';
                const config = lessonConfigs[lessonId];

                switch(currentLessonType) {
                    case 'fractions_basic':
                        successMessage = `🎉 أحسنت! ${f1Num}/${f1Den} ${userChoice} ${f2Num}/${f2Den}<br><small>التمثيل البصري يساعد في فهم الكسور!</small>`;
                        break;
                    case 'equivalent_fractions':
                        if (userChoice === '=') {
                            successMessage = `🎉 صحيح! ${f1Num}/${f1Den} = ${f2Num}/${f2Den}<br><small>هذان كسران متكافئان!</small>`;
                        } else {
                            successMessage = `🎉 صحيح! ${f1Num}/${f1Den} ≠ ${f2Num}/${f2Den}<br><small>هذان كسران غير متكافئين!</small>`;
                        }
                        break;
                    case 'fractions_comparison':
                        successMessage = `🎉 ممتاز! ${f1Num}/${f1Den} ${userChoice} ${f2Num}/${f2Den}<br><small>مقارنة دقيقة للكسور!</small>`;
                        break;
                }

                feedbackElement.innerHTML = successMessage;
                feedbackElement.style.color = '#27ae60';
                feedbackElement.classList.add('celebration');

                score += 10;
                correctAnswers++;
            } else {
                let errorMessage = '';
                const config = lessonConfigs[lessonId];

                switch(currentLessonType) {
                    case 'fractions_basic':
                        errorMessage = `❌ حاول مرة أخرى! ${f1Num}/${f1Den} ${correctSymbol} ${f2Num}/${f2Den}<br><small>انظر إلى البرج الأحمر - كلما زاد ارتفاعه زاد قيمة الكسر</small>`;
                        break;
                    case 'equivalent_fractions':
                        errorMessage = `❌ حاول مرة أخرى! ${f1Num}/${f1Den} ${correctSymbol} ${f2Num}/${f2Den}<br><small>الكسران ${correctSymbol === '=' ? 'متكافئان' : 'غير متكافئين'}</small>`;
                        break;
                    case 'fractions_comparison':
                        let hint = '';
                        if (f1Den === f2Den) {
                            hint = 'عندما يتساوى المقام، الكسر الأكبر بسطاً هو الأكبر';
                        } else if (f1Num === f2Num) {
                            hint = 'عندما يتساوى البسط، الكسر الأصغر مقاماً هو الأكبر';
                        } else {
                            hint = 'قارن بين القيمتين العشريتين أو وحد المقامات';
                        }
                        errorMessage = `❌ حاول مرة أخرى! ${f1Num}/${f1Den} ${correctSymbol} ${f2Num}/${f2Den}<br><small>${hint}</small>`;
                        break;
                }

                feedbackElement.innerHTML = errorMessage;
                feedbackElement.style.color = '#e74c3c';
                score = Math.max(0, score - 2);
            }

            // تحديث النتائج
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();

            setTimeout(() => {
                feedbackElement.classList.remove('celebration');
                generateProblemForLesson();
            }, 3000);
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        function resetGame() {
            score = 0;
            correctAnswers = 0;
            totalQuestions = 0;
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('total-count').textContent = totalQuestions;
            updateProgress();
            generateProblemForLesson();
        }

        // إضافة event listeners
        document.addEventListener('DOMContentLoaded', function() {
            determineLessonType();
            resetGame();
        });

        // جعل الدوال متاحة globally
        window.submitAnswer = submitAnswer;
        window.resetGame = resetGame;
    </script>
</body>
</html>
