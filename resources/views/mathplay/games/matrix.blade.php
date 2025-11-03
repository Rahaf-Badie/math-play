<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصفوفة الكسور - {{ $lesson_game->lesson->name }}</title>
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
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            max-width: 900px;
            width: 100%;
            position: relative;
        }

        /* زر الرجوع إلى الدرس */
        .back-to-lesson {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #e17055 0%, #d63031 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .back-to-lesson:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #d63031 0%, #c23616 100%);
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            margin-top: 10px;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .game-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .game-board {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .problem-board, .interactive-board {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border: 3px solid #dfe6e9;
        }

        .board-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
            font-weight: bold;
            font-size: 1.3rem;
        }

        .fraction-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .fraction-card {
            background: white;
            border: 3px solid #74b9ff;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: move;
            transition: all 0.3s ease;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fraction-card.dragging {
            opacity: 0.5;
            transform: scale(1.05);
        }

        .fraction-card.correct {
            border-color: #00b894;
            background: #00b894;
            color: white;
        }

        .fraction-card.wrong {
            border-color: #ff7675;
            background: #ff7675;
            color: white;
        }

        .drop-zone {
            display: grid;
            grid-template-columns: 1fr auto 1fr auto 1fr;
            gap: 10px;
            align-items: center;
            background: white;
            border: 3px dashed #b2bec3;
            border-radius: 15px;
            padding: 20px;
            min-height: 150px;
            margin-bottom: 20px;
        }

        .drop-slot {
            min-height: 100px;
            border: 2px dashed #74b9ff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            padding: 10px;
        }

        .drop-slot.active {
            border-color: #e84393;
            background: #fff5f7;
        }

        .operation-symbol {
            font-size: 2.5rem;
            font-weight: bold;
            color: #e84393;
            text-align: center;
        }

        .equals-symbol {
            font-size: 2.5rem;
            font-weight: bold;
            color: #00b894;
            text-align: center;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        button {
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #submit-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #new-problem-btn {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .feedback-area {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
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
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .fraction-display {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .fraction-numerator, .fraction-denominator {
            width: 50px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .fraction-numerator {
            background: #74b9ff;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .fraction-denominator {
            background: #0984e3;
            color: white;
            border-top: 2px solid white;
            border-radius: 0 0 8px 8px;
        }

        @media (max-width: 768px) {
            .game-board {
                grid-template-columns: 1fr;
            }

            .fraction-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .drop-zone {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(5, auto);
            }

            .operation-symbol, .equals-symbol {
                transform: rotate(0deg);
                margin: 10px 0;
            }

            .back-to-lesson {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 15px;
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- زر الرجوع إلى الدرس -->
        <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="back-to-lesson">
            ← الرجوع إلى الدرس
        </a>

        <div class="header">
            <h1 class="lesson-title">🧩 مصفوفة الكسور - {{ $lesson_game->lesson->name }}</h1>
        </div>

        <div class="game-stats">
            <div class="stat-card">
                <div class="stat-value" id="current-score">0</div>
                <div class="stat-label">النقاط الحالية</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="problems-solved">0</div>
                <div class="stat-label">المسائل المحلولة</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="accuracy">100%</div>
                <div class="stat-label">الدقة</div>
            </div>
        </div>

        <div class="game-board">
            <div class="problem-board">
                <div class="board-title">🧮 اختر الكسور المناسبة</div>
                <div class="fraction-grid" id="fractions-grid">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>
                <div class="instructions">
                    <p>💡 اسحب وأسقط الكسور في المكان المناسب لحل المسألة</p>
                </div>
            </div>

            <div class="interactive-board">
                <div class="board-title">🎯 منطقة الحل</div>
                <div class="drop-zone" id="drop-zone">
                    <div class="drop-slot" id="slot1"></div>
                    <div class="operation-symbol" id="op-symbol">
                        {{ $operation_type == 'addition' ? '+' : '-' }}
                    </div>
                    <div class="drop-slot" id="slot2"></div>
                    <div class="equals-symbol">=</div>
                    <div class="drop-slot" id="result-slot"></div>
                </div>

                <div class="controls">
                    <button id="submit-btn">✅ تحقق</button>
                    <button id="hint-btn">💡 تلميح</button>
                    <button id="new-problem-btn">🔄 جديدة</button>
                </div>

                <div class="feedback-area" id="feedback-area">
                    ابدأ بسحب الكسور إلى منطقة الحل
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 12 }};
        const operationType = "{{ $operation_type ?? 'addition' }}";

        // متغيرات اللعبة
        let currentScore = 0;
        let problemsSolved = 0;
        let totalAttempts = 0;
        let correctAttempts = 0;
        let currentFractions = [];
        let correctSolution = null;
        let draggedFraction = null;

        // عناصر DOM
        const fractionsGrid = document.getElementById('fractions-grid');
        const dropSlots = {
            slot1: document.getElementById('slot1'),
            slot2: document.getElementById('slot2'),
            result: document.getElementById('result-slot')
        };
        const submitButton = document.getElementById('submit-btn');
        const hintButton = document.getElementById('hint-btn');
        const newProblemButton = document.getElementById('new-problem-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const currentScoreElement = document.getElementById('current-score');
        const problemsSolvedElement = document.getElementById('problems-solved');
        const accuracyElement = document.getElementById('accuracy');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeGame();
            setupEventListeners();
        });

        function initializeGame() {
            generateNewProblem();
            updateStats();
            setupDragAndDrop();
        }

        function setupEventListeners() {
            submitButton.addEventListener('click', checkSolution);
            hintButton.addEventListener('click', provideHint);
            newProblemButton.addEventListener('click', generateNewProblem);
        }

        function setupDragAndDrop() {
            // إعداد سحب الكسور
            document.querySelectorAll('.fraction-card').forEach(card => {
                card.setAttribute('draggable', 'true');

                card.addEventListener('dragstart', function(e) {
                    draggedFraction = this.getAttribute('data-fraction');
                    this.classList.add('dragging');
                    e.dataTransfer.setData('text/plain', draggedFraction);
                });

                card.addEventListener('dragend', function() {
                    this.classList.remove('dragging');
                    draggedFraction = null;
                });
            });

            // إعداد مناطق الإسقاط
            Object.values(dropSlots).forEach(slot => {
                slot.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('active');
                });

                slot.addEventListener('dragleave', function() {
                    this.classList.remove('active');
                });

                slot.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('active');

                    const fractionData = e.dataTransfer.getData('text/plain');
                    if (fractionData) {
                        this.innerHTML = createFractionDisplay(fractionData);
                        this.setAttribute('data-fraction', fractionData);
                    }
                });
            });
        }

        function generateNewProblem() {
            // إعادة تعيين الواجهة
            resetGameBoard();

            // توليد كسور جديدة بنفس المقام
            const denominator = getRandomDenominator();
            let numerator1, numerator2;

            if (operationType === 'addition') {
                // للجمع: ناتج القسمة يجب أن يكون أقل من 1
                numerator1 = getRandomNumerator(denominator);
                numerator2 = getRandomNumerator(denominator);

                // التأكد من أن الناتج لا يتجاوز المقام بعد التبسيط
                const sumNumerator = numerator1 + numerator2;
                if (sumNumerator >= denominator * 2) {
                    // إذا كان الناتج كبير جداً، نعيد توليد الأرقام
                    return generateNewProblem();
                }
            } else {
                // للطرح: ناتج القسمة يجب أن يكون موجباً
                numerator1 = getRandomNumerator(denominator);
                numerator2 = getRandomNumerator(denominator);

                // التأكد من أن البسط الأول أكبر من الثاني
                if (numerator1 <= numerator2) {
                    [numerator1, numerator2] = [numerator2 + 1, numerator1];
                }

                // التأكد من أن الناتج لا يقل عن 1/المقام
                if (numerator1 - numerator2 < 1) {
                    numerator1 = numerator2 + 1;
                }
            }

            // حساب الإجابة الصحيحة
            let resultNumerator, resultDenominator;
            if (operationType === 'addition') {
                const sum = addFractions(numerator1, numerator2, denominator);
                resultNumerator = sum.numerator;
                resultDenominator = sum.denominator;
            } else {
                const difference = subtractFractions(numerator1, numerator2, denominator);
                resultNumerator = difference.numerator;
                resultDenominator = difference.denominator;
            }

            // التأكد من أن الناتج منطقي
            if (resultNumerator <= 0 || resultDenominator <= 0) {
                return generateNewProblem();
            }

            correctSolution = {
                fraction1: `${numerator1}/${denominator}`,
                fraction2: `${numerator2}/${denominator}`,
                result: `${resultNumerator}/${resultDenominator}`
            };

            console.log('المسألة:', `${numerator1}/${denominator} ${operationType === 'addition' ? '+' : '-'} ${numerator2}/${denominator}`);
            console.log('الحل الصحيح:', correctSolution);

            // توليد كسور عشوائية للاختيار منها
            generateFractionOptions(numerator1, numerator2, denominator, resultNumerator, resultDenominator);

            // عرض رسالة الترحيب
            showFeedback(`حل المسألة: ${numerator1}/${denominator} ${operationType === 'addition' ? '+' : '-'} ${numerator2}/${denominator}`, 'info');
        }

        function generateFractionOptions(num1, num2, den, resNum, resDen) {
            fractionsGrid.innerHTML = '';
            currentFractions = [];

            // إضافة الكسور الصحيحة
            currentFractions.push(`${num1}/${den}`, `${num2}/${den}`, `${resNum}/${resDen}`);

            // إضافة كسور خاطئة
            const wrongFractions = generateWrongFractions(den, resNum, resDen);
            currentFractions.push(...wrongFractions);

            // خلط الكسور
            shuffleArray(currentFractions);

            // عرض الكسور
            currentFractions.forEach(fraction => {
                const fractionCard = document.createElement('div');
                fractionCard.className = 'fraction-card';
                fractionCard.setAttribute('data-fraction', fraction);
                fractionCard.innerHTML = createFractionDisplay(fraction);
                fractionsGrid.appendChild(fractionCard);
            });

            // إعادة إعداد السحب والإسقاط
            setTimeout(setupDragAndDrop, 100);
        }

        function createFractionDisplay(fraction) {
            const [numerator, denominator] = fraction.split('/');
            return `
                <div class="fraction-display">
                    <div class="fraction-numerator">${numerator}</div>
                    <div class="fraction-denominator">${denominator}</div>
                </div>
            `;
        }

        function checkSolution() {
            const slot1Fraction = dropSlots.slot1.getAttribute('data-fraction');
            const slot2Fraction = dropSlots.slot2.getAttribute('data-fraction');
            const resultFraction = dropSlots.result.getAttribute('data-fraction');

            if (!slot1Fraction || !slot2Fraction || !resultFraction) {
                showFeedback('⚠️ من فضلك ضع كسور في جميع الخانات!', 'error');
                return;
            }

            totalAttempts++;

            // التحقق من الحل
            const usedFractions = [slot1Fraction, slot2Fraction];
            const isCorrect =
                usedFractions.includes(correctSolution.fraction1) &&
                usedFractions.includes(correctSolution.fraction2) &&
                slot1Fraction !== slot2Fraction &&
                resultFraction === correctSolution.result;

            console.log('الحل المقدم:', {slot1Fraction, slot2Fraction, resultFraction});
            console.log('هل الحل صحيح؟', isCorrect);

            if (isCorrect) {
                correctAttempts++;
                problemsSolved++;
                currentScore += 20;

                // تلوين الكروت الصحيحة
                highlightCorrectCards();

                showFeedback('🎉 أحسنت! الحل صحيح!', 'success');

                // تحديث الإحصائيات
                updateStats();

                // توليد مسألة جديدة بعد ثانيتين
                setTimeout(generateNewProblem, 2000);
            } else {
                currentScore = Math.max(0, currentScore - 5);

                // تحديد نوع الخطأ
                let errorMessage = '❌ الحل غير صحيح!';

                if (!usedFractions.includes(correctSolution.fraction1) || !usedFractions.includes(correctSolution.fraction2)) {
                    errorMessage += ' الكسور المدخلة غير صحيحة';
                } else if (resultFraction !== correctSolution.result) {
                    errorMessage += ' ناتج القسمة غير صحيح';
                }

                showFeedback(errorMessage, 'error');
                updateStats();
            }
        }

        function provideHint() {
            currentScore = Math.max(0, currentScore - 2);

            // إظهار أحد الكسور الصحيحة
            const emptySlots = Object.entries(dropSlots)
                .filter(([key, slot]) => !slot.getAttribute('data-fraction'))
                .map(([key, slot]) => key);

            if (emptySlots.length > 0) {
                const randomSlot = emptySlots[Math.floor(Math.random() * emptySlots.length)];
                let correctFraction;

                if (randomSlot === 'result') {
                    correctFraction = correctSolution.result;
                } else {
                    correctFraction = randomSlot === 'slot1' ?
                        correctSolution.fraction1 : correctSolution.fraction2;
                }

                dropSlots[randomSlot].innerHTML = createFractionDisplay(correctFraction);
                dropSlots[randomSlot].setAttribute('data-fraction', correctFraction);

                showFeedback('💡 لقد ساعدتك بوضع أحد الكسور!', 'info');
                updateStats();
            } else {
                showFeedback('💡 جميع الخانات ممتلئة! حاول التحقق من الحل', 'info');
            }
        }

        function highlightCorrectCards() {
            document.querySelectorAll('.fraction-card').forEach(card => {
                const fraction = card.getAttribute('data-fraction');
                if ([correctSolution.fraction1, correctSolution.fraction2, correctSolution.result].includes(fraction)) {
                    card.classList.add('correct');
                }
            });
        }

        function resetGameBoard() {
            Object.values(dropSlots).forEach(slot => {
                slot.innerHTML = '';
                slot.removeAttribute('data-fraction');
            });

            document.querySelectorAll('.fraction-card').forEach(card => {
                card.classList.remove('correct', 'wrong');
            });
        }

        function showFeedback(message, type) {
            feedbackArea.textContent = message;
            feedbackArea.className = `feedback-area feedback-${type}`;
        }

        function updateStats() {
            currentScoreElement.textContent = currentScore;
            problemsSolvedElement.textContent = problemsSolved;
            const accuracy = totalAttempts > 0 ? Math.round((correctAttempts / totalAttempts) * 100) : 100;
            accuracyElement.textContent = `${accuracy}%`;
        }

        // دوال مساعدة للكسور
        function getRandomDenominator() {
            const denominators = [2, 3, 4, 5, 6, 8, 10, 12];
            return denominators[Math.floor(Math.random() * denominators.length)];
        }

        function getRandomNumerator(denominator) {
            return Math.floor(Math.random() * (denominator - 1)) + 1;
        }

        function addFractions(num1, num2, den) {
            const numerator = num1 + num2;
            return simplifyFraction(numerator, den);
        }

        function subtractFractions(num1, num2, den) {
            const numerator = num1 - num2;
            return simplifyFraction(numerator, den);
        }

        function simplifyFraction(numerator, denominator) {
            const gcd = findGCD(numerator, denominator);
            const simplifiedNum = numerator / gcd;
            const simplifiedDen = denominator / gcd;

            // إذا كان الناتج عدد صحيح، نعيده على شكل كسر مقامه 1
            if (simplifiedNum % simplifiedDen === 0) {
                return {
                    numerator: simplifiedNum / simplifiedDen,
                    denominator: 1
                };
            }

            return {
                numerator: simplifiedNum,
                denominator: simplifiedDen
            };
        }

        function findGCD(a, b) {
            // استخدام القيمة المطلقة للتعامل مع الأرقام السالبة
            a = Math.abs(a);
            b = Math.abs(b);

            while (b !== 0) {
                const temp = b;
                b = a % b;
                a = temp;
            }
            return a;
        }

        function generateWrongFractions(denominator, correctNum, correctDen) {
            const wrongFractions = [];
            const usedFractions = new Set([`${correctNum}/${correctDen}`]);

            while (wrongFractions.length < 3) {
                let wrongNum, wrongDen;

                // إنشاء كسور خاطئة بطرق مختلفة
                const method = Math.floor(Math.random() * 3);
                switch (method) {
                    case 0: // تغيير البسط فقط
                        wrongNum = correctNum + (Math.random() > 0.5 ? 1 : -1) * (Math.floor(Math.random() * 2) + 1);
                        wrongDen = correctDen;
                        break;
                    case 1: // تغيير المقام فقط
                        wrongNum = correctNum;
                        wrongDen = getRandomDenominator();
                        break;
                    case 2: // تغيير كليهما
                        wrongNum = getRandomNumerator(denominator);
                        wrongDen = getRandomDenominator();
                        break;
                }

                // التأكد من أن القيم موجبة ومعقولة
                wrongNum = Math.max(1, wrongNum);
                wrongDen = Math.max(2, wrongDen);

                const wrongFraction = `${wrongNum}/${wrongDen}`;

                // التأكد من عدم تكرار الكسور
                if (!usedFractions.has(wrongFraction) &&
                    !currentFractions.includes(wrongFraction)) {
                    wrongFractions.push(wrongFraction);
                    usedFractions.add(wrongFraction);
                }
            }

            return wrongFractions;
        }

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }
    </script>
</body>
</html>
