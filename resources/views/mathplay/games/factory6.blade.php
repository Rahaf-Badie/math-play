<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصنع القسمة الذكي - {{ $lesson_game->lesson->name }}</title>
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

        .factory-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 968px) {
            .factory-layout {
                grid-template-columns: 1fr;
            }
        }

        .input-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-right: 5px solid #74b9ff;
        }

        .problem-generator {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .problem-display {
            font-size: 2.5em;
            color: #667eea;
            font-weight: bold;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
        }

        .division-symbol {
            font-size: 1.5em;
            margin: 0 15px;
            color: #2d3436;
        }

        .manual-input {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        .input-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .input-label {
            font-weight: bold;
            color: #2d3436;
            min-width: 120px;
        }

        .number-input {
            width: 100px;
            height: 45px;
            border: 2px solid #ddd;
            border-radius: 8px;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .number-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
            outline: none;
        }

        .workshop-section {
            background: white;
            border: 3px solid #667eea;
            border-radius: 15px;
            padding: 25px;
        }

        .workshop-area {
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 20px;
            min-height: 400px;
            margin-bottom: 20px;
            position: relative;
        }

        .division-workspace {
            font-family: 'Courier New', monospace;
            font-size: 1.3em;
            line-height: 2;
            direction: ltr;
            text-align: left;
        }

        .step-indicator {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ffb300;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9em;
            font-weight: bold;
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

        #solve-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        #step-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        #reset-workshop-btn {
            background: linear-gradient(135deg, #ffb300, #ff8f00);
            color: white;
        }

        #new-problem-btn {
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

        .step-highlight {
            background: yellow;
            padding: 2px 5px;
            border-radius: 3px;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% { background-color: yellow; }
            50% { background-color: orange; }
            100% { background-color: yellow; }
        }

        .result-display {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
        }

        .workshop-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .workshop-item {
            background: white;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .workshop-item:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }

        .workshop-item.active {
            border-color: #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .lesson-selector {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-align: center;
        }

        .lesson-badge {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin: 5px;
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
            <div class="header">
                <h1>🏭 مصنع القسمة الذكي</h1>
                <p>تدرب على القسمة المطولة خطوة بخطوة!</p>
            </div>
        </div>

        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <div class="lesson-selector">
            <div class="lesson-badge">
                الدرس الحالي:
                @if($lesson_game->lesson->id == 116)
                    قسمة عدد من منزلتين على عدد من منزلتين
                @else
                    قسمة عدد من 3 منازل على عدد من منزلتين
                @endif
            </div>
        </div>

        <div class="factory-layout">
            <div class="input-section">
                <div class="problem-generator">
                    <h3>🎲 مولد المسائل</h3>
                    <div class="problem-display">
                        <span id="auto-dividend">?</span>
                        <span class="division-symbol">÷</span>
                        <span id="auto-divisor">?</span>
                    </div>
                    <button id="generate-btn" style="background: linear-gradient(135deg, #00b894, #00a085); color: white; padding: 10px 20px; border: none; border-radius: 25px; cursor: pointer;">
                        🎲 توليد مسألة جديدة
                    </button>
                </div>

                <div class="manual-input">
                    <h3>✏️ أدخل مسألة يدوياً</h3>
                    <div class="input-group">
                        <span class="input-label">المقسوم:</span>
                        <input type="number" id="manual-dividend" class="number-input" placeholder="؟">
                    </div>
                    <div class="input-group">
                        <span class="input-label">المقسوم عليه:</span>
                        <input type="number" id="manual-divisor" class="number-input" placeholder="؟">
                    </div>
                    <button id="manual-set-btn" style="background: linear-gradient(135deg, #74b9ff, #0984e3); color: white; padding: 10px 20px; border: none; border-radius: 25px; cursor: pointer; width: 100%; margin-top: 10px;">
                        ✅ تعيين المسألة
                    </button>
                </div>

                <div class="workshop-grid">
                    @if($lesson_game->lesson->id == 116)
                        <!-- تمارين للدرس 116 -->
                        <div class="workshop-item" data-dividend="84" data-divisor="12">
                            <strong>84 ÷ 12</strong>
                            <div style="font-size: 0.9em; color: #666;">تمرين سهل</div>
                        </div>
                        <div class="workshop-item" data-dividend="96" data-divisor="16">
                            <strong>96 ÷ 16</strong>
                            <div style="font-size: 0.9em; color: #666;">تمرين متوسط</div>
                        </div>
                        <div class="workshop-item" data-dividend="72" data-divisor="18">
                            <strong>72 ÷ 18</strong>
                            <div style="font-size: 0.9em; color: #666;">تمرين متقدم</div>
                        </div>
                    @else
                        <!-- تمارين للدرس 117 -->
                        <div class="workshop-item" data-dividend="156" data-divisor="13">
                            <strong>156 ÷ 13</strong>
                            <div style="font-size: 0.9em; color: #666;">تمرين سهل</div>
                        </div>
                        <div class="workshop-item" data-dividend="288" data-divisor="24">
                            <strong>288 ÷ 24</strong>
                            <div style="font-size: 0.9em; color: #666;">تمرين متوسط</div>
                        </div>
                        <div class="workshop-item" data-dividend="432" data-divisor="36">
                            <strong>432 ÷ 36</strong>
                            <div style="font-size: 0.9em; color: #666;">تمرين متقدم</div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="workshop-section">
                <h3 style="text-align: center; margin-bottom: 20px;">🔧 ورشة العمل</h3>

                <div class="workshop-area">
                    <div class="step-indicator">الخطوة: <span id="current-step">0</span></div>
                    <div class="division-workspace" id="division-workspace">
                        <!-- مساحة العمل ستظهر هنا -->
                    </div>
                </div>

                <div class="result-display" id="result-display" style="display: none;">
                    <!-- النتيجة ستظهر هنا -->
                </div>

                <div class="controls">
                    <button id="solve-btn">🎯 حل تلقائي</button>
                    <button id="step-btn">➡️ الخطوة التالية</button>
                    <button id="reset-workshop-btn">🔄 إعادة الورشة</button>
                    <button id="new-problem-btn">🆕 مسألة جديدة</button>
                </div>

                <div class="feedback" id="feedback">
                    اختر مسألة أو أدخل مسألة يدوياً لتبدأ!
                </div>
            </div>
        </div>

        <div class="score-board">
            المسائل المحلولة: <span id="solved-count">0</span> |
            الدقة: <span id="accuracy">0%</span> |
            الخبرة: <span id="experience">0</span> نقطة
        </div>
    </div>

    <script>
        // تعريف الدروس المختلفة
        const lessons = {
            116: {
                id: 116,
                name: "قسمة عدد من منزلتين على عدد من منزلتين",
                minDividend: 10,
                maxDividend: 99,
                minDivisor: 10,
                maxDivisor: 99,
                description: "قسمة مباشرة - ابحث عن الناتج مباشرة"
            },
            117: {
                id: 117,
                name: "قسمة عدد من 3 منازل على عدد من منزلتين",
                minDividend: 100,
                maxDividend: 999,
                minDivisor: 10,
                maxDivisor: 99,
                description: "قسمة مطولة - ابدأ بأول منزلتين"
            }
        };

        // بيانات اللعبة
        const gameData = {
            currentLessonId: <?php echo $lesson_game->lesson->id; ?>,
            solvedCount: 0,
            totalAttempts: 0,
            experience: 0,
            currentProblem: null,
            currentStep: 0,
            solutionSteps: []
        };

        // عناصر DOM
        const autoDividendElement = document.getElementById('auto-dividend');
        const autoDivisorElement = document.getElementById('auto-divisor');
        const manualDividendInput = document.getElementById('manual-dividend');
        const manualDivisorInput = document.getElementById('manual-divisor');
        const divisionWorkspaceElement = document.getElementById('division-workspace');
        const resultDisplayElement = document.getElementById('result-display');
        const currentStepElement = document.getElementById('current-step');
        const solvedCountElement = document.getElementById('solved-count');
        const accuracyElement = document.getElementById('accuracy');
        const experienceElement = document.getElementById('experience');
        const feedbackElement = document.getElementById('feedback');
        const generateBtn = document.getElementById('generate-btn');
        const manualSetBtn = document.getElementById('manual-set-btn');
        const solveBtn = document.getElementById('solve-btn');
        const stepBtn = document.getElementById('step-btn');
        const resetWorkshopBtn = document.getElementById('reset-workshop-btn');
        const newProblemBtn = document.getElementById('new-problem-btn');
        const workshopItems = document.querySelectorAll('.workshop-item');

        // الحصول على الدرس الحالي
        function getCurrentLesson() {
            return lessons[gameData.currentLessonId];
        }

        // تهيئة اللعبة
        function initGame() {
            generateProblem();
            updateUI();
        }

        // توليد مسألة جديدة
        function generateProblem() {
            const lesson = getCurrentLesson();

            let dividend, divisor;

            if (lesson.id === 116) {
                // قسمة عدد من منزلتين على عدد من منزلتين
                divisor = Math.floor(Math.random() * (lesson.maxDivisor - lesson.minDivisor + 1)) + lesson.minDivisor;
                const quotient = Math.floor(Math.random() * 9) + 1; // ناتج من 1 إلى 9
                dividend = quotient * divisor;

                // التأكد من أن المقسوم ضمن المدى الصحيح
                while (dividend < lesson.minDividend || dividend > lesson.maxDividend) {
                    divisor = Math.floor(Math.random() * (lesson.maxDivisor - lesson.minDivisor + 1)) + lesson.minDivisor;
                    const quotient = Math.floor(Math.random() * 9) + 1;
                    dividend = quotient * divisor;
                }
            } else {
                // قسمة عدد من 3 منازل على عدد من منزلتين
                divisor = Math.floor(Math.random() * (lesson.maxDivisor - lesson.minDivisor + 1)) + lesson.minDivisor;
                const quotient = Math.floor(Math.random() * 90) + 10; // ناتج من 10 إلى 99
                const remainder = Math.floor(Math.random() * divisor);
                dividend = quotient * divisor + remainder;

                // التأكد من أن المقسوم ضمن المدى الصحيح
                while (dividend < lesson.minDividend || dividend > lesson.maxDividend) {
                    divisor = Math.floor(Math.random() * (lesson.maxDivisor - lesson.minDivisor + 1)) + lesson.minDivisor;
                    const quotient = Math.floor(Math.random() * 90) + 10;
                    const remainder = Math.floor(Math.random() * divisor);
                    dividend = quotient * divisor + remainder;
                }
            }

            setProblem(dividend, divisor);
        }

        // تعيين المسألة
        function setProblem(dividend, divisor) {
            gameData.currentProblem = {
                dividend: dividend,
                divisor: divisor,
                quotient: Math.floor(dividend / divisor),
                remainder: dividend % divisor
            };

            gameData.currentStep = 0;
            gameData.solutionSteps = generateSolutionSteps(dividend, divisor);

            // تحديث الواجهة
            autoDividendElement.textContent = dividend;
            autoDivisorElement.textContent = divisor;
            manualDividendInput.value = dividend;
            manualDivisorInput.value = divisor;

            // إعادة تعيين ورشة العمل
            resetWorkshop();

            showFeedback(`🎯 مسألة جديدة: ${dividend} ÷ ${divisor}`, 'info');
        }

        // توليد خطوات الحل
        function generateSolutionSteps(dividend, divisor) {
            const lesson = getCurrentLesson();
            const steps = [];

            if (lesson.id === 116) {
                // قسمة عدد من منزلتين على عدد من منزلتين
                steps.push(`نبدأ بمسألة القسمة: ${dividend} ÷ ${divisor}`);
                steps.push(`نبحث عن عدد إذا ضرب في ${divisor} يعطي ${dividend} أو أقل`);
                steps.push(`${divisor} × ${Math.floor(dividend/divisor)} = ${divisor * Math.floor(dividend/divisor)}`);
                steps.push(`${dividend} - ${divisor * Math.floor(dividend/divisor)} = ${dividend % divisor}`);
                steps.push(`الناتج: ${Math.floor(dividend/divisor)} والباقي: ${dividend % divisor}`);
            } else {
                // قسمة عدد من 3 منازل على عدد من منزلتين
                const firstTwoDigits = Math.floor(dividend / 10);
                const firstQuotient = Math.floor(firstTwoDigits / divisor);
                const firstRemainder = firstTwoDigits % divisor;
                const newNumber = firstRemainder * 10 + (dividend % 10);
                const secondQuotient = Math.floor(newNumber / divisor);

                steps.push(`نبدأ بمسألة القسمة: ${dividend} ÷ ${divisor}`);
                steps.push(`نأخذ أول منزلتين: ${firstTwoDigits}`);
                steps.push(`${firstTwoDigits} ÷ ${divisor} = ${firstQuotient} والباقي ${firstRemainder}`);
                steps.push(`ننزل المنزلة الثالثة (${dividend % 10}) فيصبح العدد: ${newNumber}`);
                steps.push(`${newNumber} ÷ ${divisor} = ${secondQuotient} والباقي ${newNumber % divisor}`);
                steps.push(`الناتج: ${Math.floor(dividend/divisor)} والباقي: ${dividend % divisor}`);
            }

            return steps;
        }

        // إعادة تعيين ورشة العمل
        function resetWorkshop() {
            gameData.currentStep = 0;
            divisionWorkspaceElement.innerHTML = `
                <div style="text-align: center; color: #666; margin-top: 50px;">
                    🏭 ابدأ بالضغط على "الخطوة التالية" لمشاهدة خطوات الحل
                </div>
            `;
            resultDisplayElement.style.display = 'none';
            currentStepElement.textContent = '0';
            stepBtn.disabled = false;
        }

        // عرض الخطوة التالية
        function showNextStep() {
            if (gameData.currentStep < gameData.solutionSteps.length) {
                const step = gameData.solutionSteps[gameData.currentStep];
                const stepElement = document.createElement('div');
                stepElement.innerHTML = `
                    <div class="step-highlight">الخطوة ${gameData.currentStep + 1}:</div>
                    <div style="margin: 10px 0; padding: 10px; background: white; border-radius: 5px;">
                        ${step}
                    </div>
                `;
                divisionWorkspaceElement.appendChild(stepElement);

                gameData.currentStep++;
                currentStepElement.textContent = gameData.currentStep;

                // التمرير للأسفل
                divisionWorkspaceElement.scrollTop = divisionWorkspaceElement.scrollHeight;

                if (gameData.currentStep === gameData.solutionSteps.length) {
                    showFinalResult();
                    stepBtn.disabled = true;
                }
            }
        }

        // عرض النتيجة النهائية
        function showFinalResult() {
            const problem = gameData.currentProblem;
            resultDisplayElement.innerHTML = `
                <div style="color: #00b894;">🎉 تم حل المسألة بنجاح!</div>
                <div style="margin-top: 10px;">
                    ${problem.dividend} ÷ ${problem.divisor} = ${problem.quotient} والباقي ${problem.remainder}
                </div>
            `;
            resultDisplayElement.style.display = 'block';

            // تحديث الإحصائيات
            gameData.solvedCount++;
            gameData.totalAttempts++;
            gameData.experience += 10;

            updateUI();
        }

        // الحل التلقائي
        function solveAutomatically() {
            resetWorkshop();
            const interval = setInterval(() => {
                showNextStep();
                if (gameData.currentStep >= gameData.solutionSteps.length) {
                    clearInterval(interval);
                }
            }, 1500);
        }

        // تحديث واجهة المستخدم
        function updateUI() {
            solvedCountElement.textContent = gameData.solvedCount;
            experienceElement.textContent = gameData.experience;

            const accuracy = gameData.totalAttempts > 0 ?
                Math.round((gameData.solvedCount / gameData.totalAttempts) * 100) : 0;
            accuracyElement.textContent = `${accuracy}%`;
        }

        // إظهار التغذية الراجعة
        function showFeedback(message, type) {
            feedbackElement.textContent = message;
            feedbackElement.className = 'feedback ' + type;
        }

        // التحقق من صحة المدخلات حسب الدرس
        function validateInputs(dividend, divisor) {
            const lesson = getCurrentLesson();

            if (isNaN(dividend) || isNaN(divisor) || divisor === 0) {
                return '❌ يرجى إدخال أعداد صحيحة صحيحة!';
            }

            if (lesson.id === 116) {
                if (dividend < 10 || dividend > 99) {
                    return '❌ المقسوم يجب أن يكون عدداً من منزلتين (10-99)!';
                }
                if (divisor < 10 || divisor > 99) {
                    return '❌ المقسوم عليه يجب أن يكون عدداً من منزلتين (10-99)!';
                }
            } else {
                if (dividend < 100 || dividend > 999) {
                    return '❌ المقسوم يجب أن يكون عدداً من 3 منازل (100-999)!';
                }
                if (divisor < 10 || divisor > 99) {
                    return '❌ المقسوم عليه يجب أن يكون عدداً من منزلتين (10-99)!';
                }
            }

            return null;
        }

        // event listeners
        generateBtn.addEventListener('click', () => {
            generateProblem();
        });

        manualSetBtn.addEventListener('click', () => {
            const dividend = parseInt(manualDividendInput.value);
            const divisor = parseInt(manualDivisorInput.value);

            const error = validateInputs(dividend, divisor);
            if (error) {
                showFeedback(error, 'error');
                return;
            }

            setProblem(dividend, divisor);
        });

        workshopItems.forEach(item => {
            item.addEventListener('click', () => {
                workshopItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');

                const dividend = parseInt(item.dataset.dividend);
                const divisor = parseInt(item.dataset.divisor);
                setProblem(dividend, divisor);
            });
        });

        solveBtn.addEventListener('click', solveAutomatically);
        stepBtn.addEventListener('click', showNextStep);
        resetWorkshopBtn.addEventListener('click', resetWorkshop);
        newProblemBtn.addEventListener('click', () => {
            generateProblem();
        });

        // بدء اللعبة
        initGame();
    </script>
</body>
</html>
