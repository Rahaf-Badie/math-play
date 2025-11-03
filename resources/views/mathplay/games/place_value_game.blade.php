<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎮 لعبة القيمة المنزلية - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tahoma", sans-serif;
            background: linear-gradient(135deg, #a8dadc 0%, #f1faee 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: #1d3557;
            text-align: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 100%;
            max-width: 600px;
        }

        .lesson-info {
            background: linear-gradient(to right, #457b9d, #1d3557);
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            margin-bottom: 25px;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .game-title {
            color: #1d3557;
            font-size: 2.5rem;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .instructions {
            background: #f8f9fa;
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #457b9d;
            text-align: right;
            line-height: 1.6;
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.1rem;
        }

        .game-area {
            padding: 25px;
            background: #f1f2f6;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #dfe6e9;
        }

        .number-display {
            font-size: 3.5rem;
            font-weight: bold;
            margin: 25px 0;
            color: #457b9d;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .target-digit {
            color: #e63946;
            font-size: 4rem;
            display: inline-block;
            transform: scale(1.2);
            margin: 0 10px;
            text-shadow: 0 0 10px rgba(230, 57, 70, 0.3);
        }

        .question-text {
            font-size: 1.4rem;
            margin: 20px 0;
            color: #1d3557;
            line-height: 1.6;
        }

        .options-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 30px 0;
        }

        .option-btn {
            background: linear-gradient(135deg, #457b9d, #1d3557);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 20px;
            font-size: 1.4rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 10px rgba(0,0,0,0.1);
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }

        .option-btn:active {
            transform: translateY(2px);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, #2a9d8f, #1a7c6c);
            animation: pulse 0.5s;
        }

        .option-btn.wrong {
            background: linear-gradient(135deg, #e63946, #c1121f);
            animation: shake 0.5s;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }

        .visual-explanation {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 25px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
        }

        .place-value-chart {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 15px 0;
        }

        .place-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            min-width: 80px;
        }

        .place-label {
            font-size: 0.9rem;
            color: #457b9d;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .place-digit {
            font-size: 2rem;
            font-weight: bold;
            color: #1d3557;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .place-digit.target {
            background: linear-gradient(135deg, #e63946, #c1121f);
            color: white;
            transform: scale(1.2);
            box-shadow: 0 4px 8px rgba(230, 57, 70, 0.3);
        }

        .place-value {
            font-size: 1rem;
            color: #2a9d8f;
            margin-top: 8px;
            font-weight: bold;
        }

        #message {
            font-size: 1.4rem;
            margin: 20px 0;
            min-height: 60px;
            font-weight: bold;
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .message-success {
            background: rgba(42, 157, 143, 0.2);
            color: #2a9d8f;
            border: 2px solid #2a9d8f;
        }

        .message-error {
            background: rgba(230, 57, 70, 0.2);
            color: #e63946;
            border: 2px solid #e63946;
        }

        .message-info {
            background: rgba(69, 123, 157, 0.2);
            color: #457b9d;
            border: 2px solid #457b9d;
        }

        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0;
            background: #f1faee;
            padding: 20px;
            border-radius: 15px;
        }

        .progress-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .progress-label {
            font-size: 1rem;
            color: #457b9d;
            margin-bottom: 5px;
        }

        .progress-value {
            font-size: 2rem;
            font-weight: bold;
            color: #1d3557;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: #dfe6e9;
            border-radius: 10px;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, #2a9d8f, #1a7c6c);
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 25px 0;
        }

        .control-btn {
            background: linear-gradient(to right, #f4a261, #e76f51);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 6px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }

        .control-btn:active {
            transform: translateY(1px);
        }

        .control-btn:disabled {
            background: #b2bec3;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
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
            width: 12px;
            height: 12px;
            opacity: 0;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .game-title {
                font-size: 2rem;
            }

            .number-display {
                font-size: 2.5rem;
            }

            .target-digit {
                font-size: 3rem;
            }

            .options-container {
                grid-template-columns: 1fr;
            }

            .option-btn {
                padding: 15px;
                font-size: 1.2rem;
                min-height: 70px;
            }

            .control-btn {
                padding: 12px 20px;
                font-size: 1rem;
            }

            .progress-value {
                font-size: 1.6rem;
            }

            .place-box {
                min-width: 60px;
                padding: 10px;
            }

            .place-digit {
                font-size: 1.5rem;
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }} | المدى: {{ $min_range }} إلى {{ $max_range }}
        </div>

        <h1 class="game-title">🎯 القيمة المنزلية</h1>

        <div class="instructions">
            <p>🎯 الهدف: حدد القيمة المنزلية للرقم المحدد في العدد</p>
            <p>💡 تذكر: القيمة المنزلية = الرقم × منزلة الرقم (واحد، عشرات، مئات)</p>
        </div>

        <div class="game-area">
            <div class="number-display" id="number-display">
                <!-- العدد سيظهر هنا -->
            </div>

            <div class="question-text" id="question-text">
                <!-- السؤال سيظهر هنا -->
            </div>

            <div class="options-container" id="options-container">
                <!-- الخيارات ستظهر هنا -->
            </div>

            <div class="visual-explanation" id="visual-explanation">
                <h3>الشرح البصري:</h3>
                <div class="place-value-chart" id="place-value-chart">
                    <!-- مخطط القيمة المنزلية سيظهر هنا -->
                </div>
            </div>
        </div>

        <div class="progress-container">
            <div class="progress-item">
                <div class="progress-label">النقاط</div>
                <div class="progress-value" id="score">0</div>
            </div>
            <div class="progress-item">
                <div class="progress-label">السؤال</div>
                <div class="progress-value" id="question-count">1/10</div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill" style="width: 10%"></div>
                </div>
            </div>
            <div class="progress-item">
                <div class="progress-label">التسلسل</div>
                <div class="progress-value" id="streak">0</div>
            </div>
        </div>

        <div id="message" class="message-info">
            اختر الإجابة الصحيحة للرقم المحدد
        </div>

        <div class="controls">
            <button class="control-btn" id="explain-btn" onclick="showExplanation()">
                💡 شرح الجواب
            </button>
            <button class="control-btn" id="restart-btn" onclick="restartGame()" style="display:none;">
                🔁 العب مرة أخرى
            </button>
        </div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // استخدام المتغيرات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};

        // متغيرات اللعبة
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let currentNumber = "";
        let targetDigit = "";
        let targetIndex = 0;
        let correctValue = 0;
        let currentStreak = 0;
        let bestStreak = 0;

        // عناصر DOM
        const numberDisplay = document.getElementById("number-display");
        const questionText = document.getElementById("question-text");
        const optionsContainer = document.getElementById("options-container");
        const visualExplanation = document.getElementById("visual-explanation");
        const placeValueChart = document.getElementById("place-value-chart");
        const messageDiv = document.getElementById("message");
        const scoreDiv = document.getElementById("score");
        const questionCountDiv = document.getElementById("question-count");
        const progressFill = document.getElementById("progress-fill");
        const streakDiv = document.getElementById("streak");
        const explainBtn = document.getElementById("explain-btn");
        const restartBtn = document.getElementById("restart-btn");
        const celebrationDiv = document.getElementById("celebration");

        // توليد عدد عشوائي ضمن المدى المحدد
        function getRandomNumber() {
            return Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
        }

        // توليد سؤال جديد
        function generateQuestion() {
            // توليد عدد عشوائي
            currentNumber = getRandomNumber().toString();

            // اختيار رقم عشوائي من العدد لسؤاله عن قيمته المنزلية
            targetIndex = Math.floor(Math.random() * currentNumber.length);
            targetDigit = currentNumber[targetIndex];

            // حساب القيمة المنزلية الصحيحة
            const placeValue = Math.pow(10, currentNumber.length - 1 - targetIndex);
            correctValue = parseInt(targetDigit) * placeValue;

            // عرض العدد والرقم المستهدف
            displayNumberWithHighlight();

            // عرض السؤال
            questionText.innerHTML = `ما القيمة المنزلية للرقم <span class="target-digit">${targetDigit}</span> في العدد ${currentNumber}؟`;

            // توليد خيارات الإجابة
            generateOptions();

            // تحديث التقدم
            updateProgress();

            // إخفاء الشرح
            visualExplanation.style.display = "none";
            explainBtn.disabled = false;

            // رسالة توجيهية
            messageDiv.textContent = "اختر الإجابة الصحيحة";
            messageDiv.className = "message-info";
        }

        // عرض العدد مع تمييز الرقم المستهدف
        function displayNumberWithHighlight() {
            let displayHTML = "";
            for (let i = 0; i < currentNumber.length; i++) {
                if (i === targetIndex) {
                    displayHTML += `<span class="target-digit">${currentNumber[i]}</span>`;
                } else {
                    displayHTML += currentNumber[i];
                }
            }
            numberDisplay.innerHTML = displayHTML;
        }

        // توليد خيارات الإجابة
        function generateOptions() {
            optionsContainer.innerHTML = "";
            let options = [correctValue];

            // توليد خيارات خاطئة
            while (options.length < 4) {
                let wrongValue;
                const placeValue = Math.pow(10, currentNumber.length - 1 - targetIndex);

                // أنماط مختلفة للإجابات الخاطئة
                const pattern = Math.floor(Math.random() * 3);
                switch (pattern) {
                    case 0: // قيمة منزلية خاطئة لنفس الرقم
                        wrongValue = parseInt(targetDigit) * Math.pow(10, (targetIndex + 1) % 3);
                        break;
                    case 1: // قيمة منزلية صحيحة لرقم آخر
                        const otherDigit = (parseInt(targetDigit) + 1) % 10;
                        wrongValue = otherDigit * placeValue;
                        break;
                    case 2: // قيمة عشوائية قريبة
                        wrongValue = correctValue + (Math.floor(Math.random() * 5) + 1) * 10;
                        break;
                }

                // التأكد من أن القيمة ضمن نطاق معقول وليست مكررة
                if (wrongValue > 0 && !options.includes(wrongValue) && wrongValue !== correctValue) {
                    options.push(wrongValue);
                }
            }

            // خلط الخيارات
            options.sort(() => Math.random() - 0.5);

            // إنشاء أزرار الخيارات
            options.forEach(option => {
                const btn = document.createElement("button");
                btn.className = "option-btn";
                btn.textContent = formatNumber(option);
                btn.onclick = () => checkAnswer(option, btn);
                optionsContainer.appendChild(btn);
            });
        }

        // تنسيق الأعداد الكبيرة
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // التحقق من الإجابة
        function checkAnswer(selectedValue, btn) {
            // تعطيل جميع الأزرار
            document.querySelectorAll('.option-btn').forEach(button => {
                button.disabled = true;
                button.style.pointerEvents = 'none';
            });

            if (selectedValue === correctValue) {
                // الإجابة صحيحة
                btn.classList.add("correct");
                score += 10;
                currentStreak++;
                bestStreak = Math.max(bestStreak, currentStreak);

                messageDiv.textContent = getRandomSuccessMessage();
                messageDiv.className = "message-success";

                // مكافأة التسلسل
                if (currentStreak >= 3) {
                    score += 5; // مكافأة إضافية للتسلسل
                    messageDiv.textContent += ` 🎯 تسلسل ${currentStreak} إجابات صحيحة! +5 نقاط`;
                }
            } else {
                // الإجابة خاطئة
                btn.classList.add("wrong");
                currentStreak = 0;

                messageDiv.textContent = "إجابة خاطئة 😅";
                messageDiv.className = "message-error";

                // إظهار الإجابة الصحيحة
                setTimeout(() => {
                    document.querySelectorAll('.option-btn').forEach(button => {
                        if (parseInt(button.textContent.replace(/,/g, '')) === correctValue) {
                            button.classList.add("correct");
                        }
                    });
                }, 500);
            }

            // تحديث النقاط والتسلسل
            scoreDiv.textContent = score;
            streakDiv.textContent = currentStreak;

            questionCount++;

            if (questionCount < totalQuestions) {
                setTimeout(generateQuestion, 2000);
            } else {
                setTimeout(() => endGame(true), 2000);
            }

            // تمكين زر الشرح
            explainBtn.disabled = false;
        }

        // رسائل نجاح عشوائية
        function getRandomSuccessMessage() {
            const messages = [
                "أحسنت! 👏",
                "إجابة صحيحة! 🌟",
                "ممتاز! 🎯",
                "رائع! 💫",
                "برافو! ✅"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        // عرض الشرح البصري
        function showExplanation() {
            visualExplanation.style.display = "block";
            placeValueChart.innerHTML = "";

            // إنشاء مخطط القيمة المنزلية
            for (let i = 0; i < currentNumber.length; i++) {
                const digit = currentNumber[i];
                const placeValue = Math.pow(10, currentNumber.length - 1 - i);
                const value = parseInt(digit) * placeValue;

                const placeBox = document.createElement("div");
                placeBox.className = "place-box";

                const placeLabel = document.createElement("div");
                placeLabel.className = "place-label";
                placeLabel.textContent = getPlaceName(currentNumber.length, i);

                const placeDigit = document.createElement("div");
                placeDigit.className = i === targetIndex ? "place-digit target" : "place-digit";
                placeDigit.textContent = digit;

                const placeValueDiv = document.createElement("div");
                placeValueDiv.className = "place-value";
                placeValueDiv.textContent = formatNumber(value);

                placeBox.appendChild(placeLabel);
                placeBox.appendChild(placeDigit);
                placeBox.appendChild(placeValueDiv);
                placeValueChart.appendChild(placeBox);
            }

            explainBtn.disabled = true;
        }

        // الحصول على اسم المنزلة
        function getPlaceName(numberLength, index) {
            const places = ["مئات", "عشرات", "آحاد"];
            return places[numberLength - 1 - index];
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (questionCount / totalQuestions) * 100;
            progressFill.style.width = `${progress}%`;
            questionCountDiv.textContent = `${questionCount + 1}/${totalQuestions}`;
        }

        // إنهاء اللعبة
        function endGame(isComplete) {
            if (isComplete) {
                messageDiv.innerHTML = `🎉 تهانينا! أكملت جميع الأسئلة بنجاح! 🎉<br>مجموع نقاطك: ${score} | أفضل تسلسل: ${bestStreak}`;
                messageDiv.className = "message-success";
                createConfetti();
            }

            optionsContainer.innerHTML = "";
            numberDisplay.innerHTML = "🎊 انتهت اللعبة 🎊";
            questionText.innerHTML = "";
            explainBtn.style.display = "none";
            restartBtn.style.display = "inline-block";
        }

        // إعادة تشغيل اللعبة
        function restartGame() {
            score = 0;
            questionCount = 0;
            currentStreak = 0;
            bestStreak = 0;

            scoreDiv.textContent = score;
            streakDiv.textContent = currentStreak;
            updateProgress();

            explainBtn.style.display = "inline-block";
            explainBtn.disabled = false;
            restartBtn.style.display = "none";

            messageDiv.textContent = "اختر الإجابة الصحيحة للرقم المحدد";
            messageDiv.className = "message-info";

            celebrationDiv.style.display = "none";
            celebrationDiv.innerHTML = "";

            generateQuestion();
        }

        // تأثير احتفالي
        function createConfetti() {
            celebrationDiv.style.display = "block";
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#457b9d'];

            for (let i = 0; i < 150; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.opacity = Math.random();
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                celebrationDiv.appendChild(confetti);

                const animation = confetti.animate([
                    { transform: 'translateY(-100px) rotate(0deg)', opacity: 1 },
                    { transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 720}deg)`, opacity: 0 }
                ], {
                    duration: 2000 + Math.random() * 3000,
                    easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
                });

                animation.onfinish = () => {
                    confetti.remove();
                };
            }
        }

        // بدء اللعبة عند تحميل الصفحة
        window.onload = generateQuestion;
    </script>
</body>
</html>
