<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 لعبة المدقق الرياضي - {{ $lesson_game->lesson->name }}</title>
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --success: #27ae60;
            --success-dark: #229954;
            --error: #e74c3c;
            --error-dark: #c0392b;
            --warning: #f39c12;
            --warning-dark: #e67e22;
            --info: #9b59b6;
            --info-dark: #8e44ad;
            --text: #2c3e50;
            --light: #f8f9fa;
            --exam-bg: linear-gradient(135deg, #3498db 0%, #9b59b6 100%);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tajawal", sans-serif;
            background: var(--exam-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            color: white;
        }

        .header h1 {
            font-size: 2.4rem;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .lesson-info {
            background: rgba(255, 255, 255, 0.9);
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-weight: bold;
            color: var(--primary-dark);
            backdrop-filter: blur(10px);
            border: 2px solid var(--primary);
        }

        .game-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 35px;
            width: 100%;
            transition: transform 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .game-card::before {
            content: "✓";
            position: absolute;
            top: -30px;
            right: -30px;
            font-size: 150px;
            color: rgba(52, 152, 219, 0.08);
            z-index: 0;
            font-weight: bold;
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .verification-guide {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 6px 20px rgba(155, 89, 182, 0.3);
        }

        .verification-guide h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        .guide-steps {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .guide-step {
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .step-icon {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .step-text {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .instructions {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--text);
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.15rem;
            font-weight: bold;
        }

        .problem-container {
            position: relative;
            z-index: 1;
            margin: 30px 0;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--primary);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .problem-display {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 25px;
            background: var(--light);
            border-radius: 15px;
            border: 2px dashed var(--primary);
            font-family: 'Courier New', monospace;
            direction: ltr;
            text-align: center;
        }

        .verification-steps {
            margin: 30px 0;
            position: relative;
            z-index: 1;
        }

        .verification-step {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border: 2px solid var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .step-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light);
        }

        .step-number {
            width: 35px;
            height: 35px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .step-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--primary-dark);
        }

        .step-description {
            font-size: 1.1rem;
            color: var(--text);
            margin-bottom: 15px;
        }

        .input-group {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 15px 0;
            flex-wrap: wrap;
        }

        .calculation-display {
            font-family: 'Courier New', monospace;
            font-size: 1.3rem;
            background: var(--light);
            padding: 10px 15px;
            border-radius: 8px;
            flex: 1;
            min-width: 200px;
            direction: ltr;
            text-align: center;
        }

        input[type="number"] {
            font-size: 1.3rem;
            padding: 12px;
            border: 2px solid var(--primary);
            border-radius: 10px;
            text-align: center;
            min-width: 150px;
            transition: all 0.3s;
            font-family: inherit;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.3);
        }

        .equal-sign {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
            margin: 0 10px;
        }

        .final-decision {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            padding: 25px;
            border-radius: 15px;
            margin: 30px 0;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .decision-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--text);
            margin-bottom: 20px;
        }

        .decision-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
            border: none;
            border-radius: 15px;
            padding: 16px 32px;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            font-family: inherit;
            min-width: 180px;
        }

        .btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(2px);
        }

        .btn-error {
            background: linear-gradient(135deg, var(--error), var(--error-dark));
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.5rem;
            min-height: 60px;
            text-align: center;
            padding: 18px;
            border-radius: 12px;
            transition: all 0.4s;
            position: relative;
            z-index: 1;
            font-weight: bold;
        }

        .feedback-correct {
            background: rgba(39, 174, 96, 0.15);
            color: var(--success-dark);
            border: 2px solid var(--success);
            animation: bounce 0.6s ease;
        }

        .feedback-wrong {
            background: rgba(231, 76, 60, 0.15);
            color: var(--error-dark);
            border: 2px solid var(--error);
            animation: shake 0.5s ease;
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--light), #f0f4f8);
            padding: 18px;
            border-radius: 15px;
            margin-top: 25px;
            position: relative;
            z-index: 1;
            border: 2px solid var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .score-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .score-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-dark);
        }

        .score-label {
            font-size: 1rem;
            color: var(--text);
        }

        .progress {
            height: 14px;
            background: #e0e0e0;
            border-radius: 7px;
            margin-top: 15px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            width: 0%;
            transition: width 0.6s ease;
            border-radius: 7px;
        }

        .celebration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 100;
            display: none;
        }

        .confetti {
            position: absolute;
            width: 14px;
            height: 14px;
            background: var(--success);
            opacity: 0;
        }

        @keyframes bounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-12px); }
            80% { transform: translateY(-6px); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-12px); }
            75% { transform: translateX(12px); }
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* تصميم متجاوب */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .game-card {
                padding: 25px 20px;
            }

            .problem-display {
                font-size: 2rem;
                padding: 20px;
            }

            .guide-steps {
                grid-template-columns: 1fr;
            }

            .input-group {
                flex-direction: column;
                gap: 10px;
            }

            .calculation-display {
                min-width: 100%;
            }

            .decision-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .problem-display {
                font-size: 1.6rem;
            }

            .step-header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .score-container {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎯 لعبة المدقق الرياضي</h1>
            <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>
        </div>

        <div class="game-card">
            <div class="verification-guide">
                <h3>🔍 دليل التحقق من الجمع</h3>
                <div class="guide-steps">
                    <div class="guide-step">
                        <div class="step-icon">🔄</div>
                        <div class="step-text">التبديل: تغيير ترتيب الأعداد<br>يجب أن يعطي نفس الناتج</div>
                    </div>
                    <div class="guide-step">
                        <div class="step-icon">📊</div>
                        <div class="step-text">التقريب: تقريب الأعداد<br>للتحقق من معقولية الناتج</div>
                    </div>
                </div>
            </div>

            <div class="instructions">
                <p>🎯 تحقق من صحة عملية الجمع باستخدام طريقي التبديل والتقريب</p>
                <p>💡 استخدم كلا الطريقتين لتتأكد من صحة الناتج المعروض</p>
            </div>

            <div class="problem-container">
                <div class="problem-display" id="problem-display">
                    <!-- سيتم تعبئة المسألة بالجافاسكريبت -->
                </div>

                <div class="verification-steps">
                    <div class="verification-step">
                        <div class="step-header">
                            <div class="step-number">1</div>
                            <div class="step-title">التحقق بالتبديل</div>
                        </div>
                        <div class="step-description">
                            غير ترتيب الأعداد ثم اجمعها. الناتج يجب أن يكون متطابقاً.
                        </div>
                        <div class="input-group">
                            <div class="calculation-display" id="commutative-calculation">
                                <!-- سيتم تعبئة عملية التبديل بالجافاسكريبت -->
                            </div>
                            <span class="equal-sign">=</span>
                            <input type="number" id="commutative-result" placeholder="أدخل الناتج">
                        </div>
                    </div>

                    <div class="verification-step">
                        <div class="step-header">
                            <div class="step-number">2</div>
                            <div class="step-title">التحقق بالتقريب</div>
                        </div>
                        <div class="step-description">
                            قرب كل عدد لأقرب ألف ثم اجمع الأعداد المقربة.
                        </div>
                        <div class="input-group">
                            <div class="calculation-display" id="estimation-calculation">
                                <!-- سيتم تعبئة عملية التقريب بالجافاسكريبت -->
                            </div>
                            <span class="equal-sign">=</span>
                            <input type="number" id="estimation-result" placeholder="أدخل الناتج المقرب">
                        </div>
                    </div>
                </div>

                <div class="final-decision">
                    <div class="decision-title">
                        بناءً على تحليلك، هل النتيجة المعروضة صحيحة؟
                    </div>
                    <div class="decision-buttons">
                        <button class="btn" onclick="submitAnswer(true)">✅ الناتج صحيح</button>
                        <button class="btn btn-error" onclick="submitAnswer(false)">❌ الناتج غير صحيح</button>
                    </div>
                </div>
            </div>

            <div id="feedback" class="feedback"></div>

            <div class="score-container">
                <div class="score-item">
                    <span class="score-label">النقاط</span>
                    <span class="score-value" id="score">0</span>
                </div>
                <div class="score-item">
                    <span class="score-label">السؤال</span>
                    <span class="score-value"><span id="current-question">0</span>/<span id="total-questions">10</span></span>
                </div>
                <div class="score-item">
                    <span class="score-label">المستوى</span>
                    <span class="score-value" id="level">1</span>
                </div>
                <div class="score-item">
                    <span class="score-label">الإجابات المتتالية</span>
                    <span class="score-value" id="streak">0</span>
                </div>
            </div>

            <div class="progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range ?? 10000 }};
        const maxRange = {{ $max_range ?? 99999 }};
        const operationType = "{{ $operation_type ?? 'addition_verification' }}";

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let num1 = 0;
        let num2 = 0;
        let actualSum = 0;
        let displayedSum = 0;
        let isDisplayedSumCorrect = true;
        let streak = 0;

        // عناصر DOM
        const problemDisplay = document.getElementById('problem-display');
        const commutativeCalculation = document.getElementById('commutative-calculation');
        const estimationCalculation = document.getElementById('estimation-calculation');
        const commutativeResult = document.getElementById('commutative-result');
        const estimationResult = document.getElementById('estimation-result');
        const scoreElement = document.getElementById('score');
        const currentQuestionElement = document.getElementById('current-question');
        const totalQuestionsElement = document.getElementById('total-questions');
        const feedbackElement = document.getElementById('feedback');
        const progressBar = document.getElementById('progress-bar');
        const celebrationElement = document.getElementById('celebration');
        const levelElement = document.getElementById('level');
        const streakElement = document.getElementById('streak');

        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            totalQuestionsElement.textContent = totalQuestions;
            generateQuestion();
        });

        // توليد عدد عشوائي ضمن المدى
        function generateRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // تقريب لأقرب ألف
        function roundToNearestThousand(n) {
            return Math.round(n / 1000) * 1000;
        }

        // تنسيق الأعداد
        function formatNumber(n) {
            return n.toLocaleString('ar-EG');
        }

        // توليد سؤال جديد
        function generateQuestion() {
            questionCount++;
            currentQuestionElement.textContent = questionCount;
            updateProgress();
            updateLevel();

            num1 = generateRandomNumber();
            num2 = generateRandomNumber();
            actualSum = num1 + num2;

            // 60% احتمالية لخطأ بسيط لإجبار الطالب على التدقيق
            if (Math.random() < 0.6) {
                isDisplayedSumCorrect = false;
                // إدخال خطأ بسيط (أكثر أو أقل بـ 100، 1000، 10000)
                const errors = [100, 1000, 10000];
                const error = (Math.random() < 0.5 ? 1 : -1) * errors[Math.floor(Math.random() * errors.length)];
                displayedSum = actualSum + error;
            } else {
                isDisplayedSumCorrect = true;
                displayedSum = actualSum;
            }

            // تحديث العرض
            problemDisplay.textContent = `${formatNumber(num1)} + ${formatNumber(num2)} = ${formatNumber(displayedSum)}`;
            commutativeCalculation.textContent = `${formatNumber(num2)} + ${formatNumber(num1)}`;
            estimationCalculation.textContent = `${formatNumber(roundToNearestThousand(num1))} + ${formatNumber(roundToNearestThousand(num2))}`;

            // مسح الحقول
            commutativeResult.value = '';
            estimationResult.value = '';

            feedbackElement.textContent = 'استخدم طريقي التبديل والتقريب للتحقق من صحة الناتج';
            feedbackElement.className = 'feedback';
        }

        // إرسال الإجابة
        function submitAnswer(userFinalAnswer) {
            const commInput = parseInt(commutativeResult.value);
            const estInput = parseInt(estimationResult.value);

            let isCommCorrect = commInput === actualSum;
            const roundedNum1 = roundToNearestThousand(num1);
            const roundedNum2 = roundToNearestThousand(num2);
            const correctEst = roundedNum1 + roundedNum2;
            let isEstCorrect = estInput === correctEst;

            let feedback = '';
            let isWin = false;
            let pointsEarned = 0;

            if (userFinalAnswer === isDisplayedSumCorrect) {
                // الفحص النهائي صحيح
                if (isCommCorrect && isEstCorrect) {
                    feedback = `🎉 إجابة ممتازة! استخدمت كلا الطريقتين بشكل صحيح`;
                    pointsEarned = 3 + (streak > 0 ? 1 : 0);
                    streak++;
                    isWin = true;
                } else if (isCommCorrect || isEstCorrect) {
                    // استخدم إحدى الطريقتين فقط بشكل صحيح
                    feedback = `👍 جيد! الإجابة النهائية صحيحة، لكن ${!isCommCorrect ? 'التبديل' : 'التقريب'} يحتاج مراجعة`;
                    pointsEarned = 2;
                    streak = 0;
                    isWin = true;
                } else {
                    // الفحص النهائي صحيح لكن الطريقتين خطأ
                    feedback = `⚠️ الإجابة النهائية صحيحة، لكن أعد مراجعة طرق التحقق`;
                    pointsEarned = 1;
                    streak = 0;
                    isWin = true;
                }

                // إضافة تفاصيل عن الأخطاء
                if (!isCommCorrect) {
                    feedback += `<br>✖️ التبديل الصحيح: ${formatNumber(actualSum)}`;
                }
                if (!isEstCorrect) {
                    feedback += `<br>✖️ التقريب الصحيح: ${formatNumber(correctEst)}`;
                }
            } else {
                // الفحص النهائي خاطئ
                feedback = `❌ الإجابة النهائية غير صحيحة! الناتج المعروض ${isDisplayedSumCorrect ? 'صحيح' : 'غير صحيح'}`;
                if (!isCommCorrect) feedback += `<br>✖️ ناتج التبديل الصحيح: ${formatNumber(actualSum)}`;
                if (!isEstCorrect) feedback += `<br>✖️ ناتج التقريب الصحيح: ${formatNumber(correctEst)}`;
                pointsEarned = -2;
                streak = 0;
            }

            score += pointsEarned;
            score = Math.max(0, score);
            scoreElement.textContent = score;
            streakElement.textContent = streak;

            feedbackElement.innerHTML = feedback;
            feedbackElement.className = isWin ? 'feedback-correct' : 'feedback-wrong';

            // تأثير الاحتفال عند الإجابات الممتازة
            if (isWin && isCommCorrect && isEstCorrect && streak >= 2) {
                createCelebration();
            }

            setTimeout(() => {
                if (questionCount < totalQuestions) {
                    generateQuestion();
                } else {
                    endGame();
                }
            }, 3000);
        }

        // تحديث المستوى
        function updateLevel() {
            const level = Math.floor(score / 30) + 1;
            levelElement.textContent = level;
        }

        // إنهاء اللعبة
        function endGame() {
            problemDisplay.textContent = "🎉 انتهت اللعبة!";
            document.querySelector('.verification-steps').style.display = 'none';
            document.querySelector('.final-decision').style.display = 'none';

            let message = "";
            let emoji = "";
            if (score >= 25) {
                message = "مذهل! 🏆 أنت مدقق رياضي محترف";
                emoji = "🎊";
            } else if (score >= 18) {
                message = "رائع! ⭐ أداء ممتاز في التحقق";
                emoji = "✨";
            } else if (score >= 12) {
                message = "جيد جداً! 👍 واصل التعلم";
                emoji = "📚";
            } else {
                message = "حاول مرة أخرى! 💪 الممارسة تصنع الفرق";
                emoji = "🎯";
            }

            feedbackElement.innerHTML = `${message} ${emoji}<br><br>مجموع نقاطك: <strong>${score}</strong> من ${totalQuestions * 3}<br>الإجابات المتتالية القصوى: <strong>${streak}</strong>`;
            feedbackElement.className = 'feedback-correct';

            createCelebration();
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (questionCount / totalQuestions) * 100;
            progressBar.style.width = `${progress}%`;
        }

        // تأثير الاحتفال
        function createCelebration() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            const colors = ['#3498db', '#2980b9', '#27ae60', '#e74c3c', '#f39c12', '#9b59b6'];

            for (let i = 0; i < 150; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = `${Math.random() * 100}%`;
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.animationDelay = `${Math.random() * 0.5}s`;

                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 4000);
        }
    </script>
</body>
</html>
