<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🕵️ المفتش الرقمي - {{ $lesson_game->lesson->name }}</title>
    <style>
        /* ===== التنسيقات الأساسية ===== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            direction: rtl;
        }

        .container {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
        }

        /* ===== رأس اللعبة ===== */
        .game-header {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .game-header::before {
            content: "🕵️";
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 120px;
            opacity: 0.1;
            transform: rotate(25deg);
        }

        .lesson-info {
            font-size: 1.3em;
            margin-bottom: 12px;
            opacity: 0.95;
            font-weight: bold;
        }

        h1 {
            font-size: 2.8em;
            margin-bottom: 20px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .instructions {
            background: rgba(255, 255, 255, 0.25);
            padding: 15px;
            border-radius: 15px;
            margin-top: 20px;
            font-size: 1.2em;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .range-info {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.4);
        }

        /* ===== منطقة اللعبة ===== */
        .game-area {
            padding: 40px;
            background: #f8f9fa;
            min-height: 500px;
            position: relative;
        }

        .problem-section {
            background: white;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 4px solid #27ae60;
            text-align: center;
        }

        .problem-display {
            font-size: 2.8em;
            font-weight: bold;
            color: #e74c3c;
            margin: 25px 0;
            padding: 25px;
            border: 3px dashed #3498db;
            border-radius: 15px;
            background: #f8f9fa;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Courier New', monospace;
        }

        .investigation-section {
            background: white;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #3498db;
        }

        .investigation-title {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 1.8em;
            font-weight: bold;
            border-bottom: 3px solid #3498db;
            padding-bottom: 15px;
        }

        .investigation-steps {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .investigation-step {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            border-right: 5px solid #3498db;
            transition: all 0.3s ease;
        }

        .investigation-step:hover {
            transform: translateX(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .step-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .step-number {
            background: #3498db;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2em;
        }

        .step-title {
            font-size: 1.4em;
            font-weight: bold;
            color: #2c3e50;
        }

        .step-description {
            color: #7f8c8d;
            margin-bottom: 15px;
            font-size: 1.1em;
            line-height: 1.6;
        }

        .step-input {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .step-input input {
            padding: 12px 15px;
            font-size: 1.3em;
            border: 3px solid #bdc3c7;
            border-radius: 10px;
            text-align: center;
            min-width: 200px;
            transition: all 0.3s ease;
            font-family: 'Courier New', monospace;
        }

        .step-input input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.3);
        }

        .step-input input.correct {
            border-color: #27ae60;
            background-color: #e8f5e9;
        }

        .step-input input.incorrect {
            border-color: #e74c3c;
            background-color: #ffebee;
        }

        /* ===== التحقق النهائي ===== */
        .final-verdict {
            background: white;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #f39c12;
            text-align: center;
        }

        .verdict-title {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.6em;
            font-weight: bold;
        }

        .verdict-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 18px 35px;
            font-size: 1.4em;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            min-width: 200px;
        }

        .btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .btn:active {
            transform: translateY(2px);
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
        }

        .btn-error {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        /* ===== التغذية الراجعة ===== */
        .feedback {
            min-height: 100px;
            margin: 25px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .message {
            font-size: 1.6em;
            font-weight: bold;
            padding: 20px 35px;
            border-radius: 50px;
            text-align: center;
            transition: all 0.4s ease;
            max-width: 90%;
            backdrop-filter: blur(10px);
        }

        .message.success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            animation: messageBounce 0.6s ease;
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.4);
        }

        .message.error {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            animation: messageShake 0.6s ease;
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
        }

        .message.info {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        @keyframes messageBounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-12px); }
            80% { transform: translateY(-6px); }
        }

        @keyframes messageShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-12px); }
            75% { transform: translateX(12px); }
        }

        /* ===== لوحة النقاط ===== */
        .score-board {
            background: white;
            padding: 25px;
            border-radius: 20px;
            margin-top: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border: 3px solid #9b59b6;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            background: #f8f9fa;
            min-width: 150px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 2px solid #9b59b6;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 2.2em;
            font-weight: bold;
            color: #9b59b6;
            display: block;
            margin-top: 8px;
        }

        .stat-label {
            color: #7f8c8d;
            font-weight: bold;
            font-size: 1.1em;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        /* ===== الكونفيتي ===== */
        .celebration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
            display: none;
        }

        .confetti {
            position: absolute;
            width: 14px;
            height: 14px;
            opacity: 0;
            border-radius: 2px;
        }

        @keyframes confettiFall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* ===== التكيف مع الشاشات الصغيرة ===== */
        @media (max-width: 768px) {
            .container {
                margin: 10px;
            }

            .game-header {
                padding: 20px;
            }

            h1 {
                font-size: 2.2em;
            }

            .problem-display {
                font-size: 2.2em;
                padding: 20px;
            }

            .step-input {
                flex-direction: column;
                align-items: flex-start;
            }

            .step-input input {
                min-width: 100%;
            }

            .verdict-buttons {
                flex-direction: column;
            }

            .btn {
                min-width: 100%;
            }

            .stats {
                gap: 15px;
            }

            .stat-item {
                min-width: 130px;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .game-area {
                padding: 25px;
            }

            .problem-display {
                font-size: 1.8em;
            }

            .step-title {
                font-size: 1.2em;
            }

            .step-input input {
                font-size: 1.1em;
                padding: 10px;
            }

            .message {
                font-size: 1.3em;
                padding: 15px 25px;
            }

            .stats {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- رأس اللعبة -->
        <div class="game-header">
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
            <h1>🕵️ المفتش الرقمي</h1>
            <div class="instructions">
                <p>قم بالتحقق من صحة عمليات الجمع باستخدام طرق الجمع العكسي والتقدير</p>
                <div class="range-info">المدى: {{ $min_range }} إلى {{ $max_range }}</div>
            </div>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- قسم المسألة -->
            <div class="problem-section">
                <div id="problem-display" class="problem-display">---</div>
            </div>

            <!-- قسم التحقيق -->
            <div class="investigation-section">
                <div class="investigation-title">🔍 خطوات التحقيق</div>
                <div class="investigation-steps">
                    <!-- الخطوة 1: الجمع العكسي -->
                    <div class="investigation-step">
                        <div class="step-header">
                            <div class="step-number">1</div>
                            <div class="step-title">التحقق بالجمع العكسي</div>
                        </div>
                        <div class="step-description">
                            اطرح العدد الثاني من الناتج المعروض. يجب أن يساوي العدد الأول
                        </div>
                        <div class="step-input">
                            <span>الناتج المعروض - العدد الثاني =</span>
                            <input type="number" id="reverse-addition-check" placeholder="أدخل الناتج">
                        </div>
                    </div>

                    <!-- الخطوة 2: التقدير -->
                    <div class="investigation-step">
                        <div class="step-header">
                            <div class="step-number">2</div>
                            <div class="step-title">التحقق بالتقدير</div>
                        </div>
                        <div class="step-description">
                            قدّر العددين لأقرب ألف ثم جمعهما للحصول على الناتج التقريبي
                        </div>
                        <div class="step-input">
                            <span>التقدير لأقرب ألف =</span>
                            <input type="number" id="estimation-check" placeholder="أدخل التقدير">
                        </div>
                    </div>
                </div>
            </div>

            <!-- التحقق النهائي -->
            <div class="final-verdict">
                <div class="verdict-title">🎯 الحكم النهائي</div>
                <div class="verdict-buttons">
                    <button id="correct-btn" class="btn btn-success">✅ الناتج صحيح</button>
                    <button id="incorrect-btn" class="btn btn-error">❌ الناتج غير صحيح</button>
                </div>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback">
                <div id="message" class="message info">انقر على "مسألة جديدة" لبدء التحقيق!</div>
            </div>

            <!-- لوحة النقاط -->
            <div class="score-board">
                <div class="stats">
                    <div class="stat-item">
                        <span class="stat-label">النقاط</span>
                        <span id="score" class="stat-value">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">المسائل المحلولة</span>
                        <span id="solved-count" class="stat-value">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">المستوى</span>
                        <span id="level" class="stat-value">1</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">التسلسل</span>
                        <span id="streak" class="stat-value">0</span>
                    </div>
                </div>

                <div class="controls">
                    <button id="new-problem-btn" class="btn btn-primary">🔄 مسألة جديدة</button>
                    <button id="hint-btn" class="btn btn-primary">💡 تلميح</button>
                </div>
            </div>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // ===== تهيئة المتغيرات =====
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        const operationType = '{{ $operation_type }}'; // addition_verification

        let num1 = 0;
        let num2 = 0;
        let actualSum = 0;
        let displayedSum = 0;
        let isDisplayedSumCorrect = true;
        let score = 0;
        let solvedCount = 0;
        let currentLevel = 1;
        let currentStreak = 0;

        // ===== العناصر =====
        const problemDisplay = document.getElementById('problem-display');
        const reverseAdditionInput = document.getElementById('reverse-addition-check');
        const estimationInput = document.getElementById('estimation-check');
        const messageElement = document.getElementById('message');
        const scoreElement = document.getElementById('score');
        const solvedCountElement = document.getElementById('solved-count');
        const levelElement = document.getElementById('level');
        const streakElement = document.getElementById('streak');
        const celebrationElement = document.getElementById('celebration');

        // ===== الدوال الأساسية =====

        // توليد عدد عشوائي ضمن المدى المحدد
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // تقريب لأقرب ألف
        function roundToNearestThousand(n) {
            return Math.round(n / 1000) * 1000;
        }

        // تنسيق الأرقام بفاصلة
        function formatNumber(number) {
            return number.toLocaleString('ar-EG');
        }

        // توليد مسألة جمع
        function generateAdditionProblem() {
            num1 = generateRandomNumber();
            num2 = generateRandomNumber();
            actualSum = num1 + num2;

            // 60% احتمالية لخطأ بسيط لإجبار الطالب على التدقيق
            if (Math.random() < 0.6) {
                isDisplayedSumCorrect = false;
                // إدخال خطأ بسيط (أكثر أو أقل بـ 100، 1000، أو 10000)
                const errors = [100, 1000, 10000];
                const error = (Math.random() < 0.5 ? 1 : -1) * errors[Math.floor(Math.random() * errors.length)];
                displayedSum = actualSum + error;
            } else {
                isDisplayedSumCorrect = true;
                displayedSum = actualSum;
            }

            // عرض المسألة
            problemDisplay.textContent = `${formatNumber(num1)} + ${formatNumber(num2)} = ${formatNumber(displayedSum)}`;

            // مسح الحقول وإعادة تعيينها
            reverseAdditionInput.value = '';
            estimationInput.value = '';
            reverseAdditionInput.className = '';
            estimationInput.className = '';

            showMessage('🔍 ابدأ التحقيق باستخدام الطريقتين أعلاه!', 'info');
        }

        // التحقق من خطوات التحقيق
        function validateInvestigationSteps() {
            const reverseAdditionValue = parseInt(reverseAdditionInput.value);
            const estimationValue = parseInt(estimationInput.value);

            let reverseAdditionCorrect = false;
            let estimationCorrect = false;

            // التحقق من الجمع العكسي
            if (!isNaN(reverseAdditionValue)) {
                reverseAdditionCorrect = (reverseAdditionValue === num1);
                reverseAdditionInput.className = reverseAdditionCorrect ? 'correct' : 'incorrect';
            }

            // التحقق من التقدير
            if (!isNaN(estimationValue)) {
                const roundedNum1 = roundToNearestThousand(num1);
                const roundedNum2 = roundToNearestThousand(num2);
                const correctEstimation = roundedNum1 + roundedNum2;
                estimationCorrect = (estimationValue === correctEstimation);
                estimationInput.className = estimationCorrect ? 'correct' : 'incorrect';
            }

            return { reverseAdditionCorrect, estimationCorrect };
        }

        // التحقق من الحكم النهائي
        function checkFinalVerdict(userVerdict) {
            const steps = validateInvestigationSteps();
            const { reverseAdditionCorrect, estimationCorrect } = steps;

            let feedback = '';
            let isCorrect = false;
            let pointsEarned = 0;

            if (userVerdict === isDisplayedSumCorrect) {
                // الحكم النهائي صحيح
                if (reverseAdditionCorrect && estimationCorrect) {
                    // تحقق كامل وصحيح
                    feedback = `ممتاز! 🎉 تحققتم بشكل كامل وصحيح. الناتج ${isDisplayedSumCorrect ? 'صحيح' : 'غير صحيح'}`;
                    pointsEarned = 3;
                    currentStreak++;
                    isCorrect = true;
                } else {
                    // الحكم صحيح ولكن خطوات التحقق ناقصة
                    feedback = `حكمكم النهائي صحيح، لكن:`;
                    if (!reverseAdditionCorrect) feedback += `<br>✖️ الجمع العكسي الصحيح: ${formatNumber(num1)}`;
                    if (!estimationCorrect) {
                        const correctEst = roundToNearestThousand(num1) + roundToNearestThousand(num2);
                        feedback += `<br>✖️ التقدير الصحيح: ${formatNumber(correctEst)}`;
                    }
                    pointsEarned = 1;
                    currentStreak = 0;
                    isCorrect = true;
                }
            } else {
                // الحكم النهائي خاطئ
                feedback = `حكمكم خاطئ! الناتج المعروض هو في الواقع ${isDisplayedSumCorrect ? 'صحيح' : 'غير صحيح'}`;
                if (!reverseAdditionCorrect) feedback += `<br>✖️ الجمع العكسي الصحيح: ${formatNumber(num1)}`;
                if (!estimationCorrect) {
                    const correctEst = roundToNearestThousand(num1) + roundToNearestThousand(num2);
                    feedback += `<br>✖️ التقدير الصحيح: ${formatNumber(correctEst)}`;
                }
                pointsEarned = -1;
                currentStreak = 0;
            }

            // تحديث النقاط والإحصائيات
            score = Math.max(0, score + pointsEarned);
            if (isCorrect) solvedCount++;

            // ترقية المستوى
            if (solvedCount >= currentLevel * 5) {
                currentLevel++;
                showMessage(`🎯 تقدمتم للمستوى ${currentLevel}!`, 'success');
            }

            updateStats();
            showMessage(feedback, isCorrect ? 'success' : 'error');

            // تأثير الاحتفال للإجابات الممتازة
            if (pointsEarned === 3 && currentStreak >= 3) {
                createCelebration();
            }

            // الانتقال للمسألة التالية بعد فترة
            setTimeout(generateAdditionProblem, 4000);
        }

        // إظهار تلميح
        function showHint() {
            const steps = validateInvestigationSteps();

            let hint = '💡 تلميحات:';
            if (!steps.reverseAdditionCorrect) {
                hint += `<br>• الجمع العكسي: ${formatNumber(displayedSum)} - ${formatNumber(num2)} = ${formatNumber(num1)}`;
            }
            if (!steps.estimationCorrect) {
                const roundedNum1 = roundToNearestThousand(num1);
                const roundedNum2 = roundToNearestThousand(num2);
                hint += `<br>• التقدير: ${formatNumber(roundedNum1)} + ${formatNumber(roundedNum2)} = ${formatNumber(roundedNum1 + roundedNum2)}`;
            }

            showMessage(hint, 'info');
        }

        // تحديث الإحصائيات
        function updateStats() {
            scoreElement.textContent = score;
            solvedCountElement.textContent = solvedCount;
            levelElement.textContent = currentLevel;
            streakElement.textContent = currentStreak;
        }

        // عرض رسالة
        function showMessage(text, type) {
            messageElement.innerHTML = text;
            messageElement.className = `message ${type}`;
        }

        // تأثير الاحتفال
        function createCelebration() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            const colors = ['#27ae60', '#3498db', '#e74c3c', '#f39c12', '#9b59b6', '#1abc9c'];

            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = `${Math.random() * 100}%`;
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `confettiFall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.animationDelay = `${Math.random() * 0.5}s`;

                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 3000);
        }

        // ===== تهيئة الأحداث =====
        document.getElementById('correct-btn').addEventListener('click', () => checkFinalVerdict(true));
        document.getElementById('incorrect-btn').addEventListener('click', () => checkFinalVerdict(false));
        document.getElementById('new-problem-btn').addEventListener('click', generateAdditionProblem);
        document.getElementById('hint-btn').addEventListener('click', showHint);

        // التحقق التلقائي عند إدخال القيم
        reverseAdditionInput.addEventListener('input', validateInvestigationSteps);
        estimationInput.addEventListener('input', validateInvestigationSteps);

        // بدء اللعبة عند تحميل الصفحة
        window.addEventListener('load', generateAdditionProblem);
    </script>
</body>
</html>
