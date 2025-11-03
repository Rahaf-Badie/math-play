<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏗️ لعبة بناء الأعداد - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tahoma", sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: #2d3436;
            text-align: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 100%;
            max-width: 800px;
        }

        .lesson-info {
            background: linear-gradient(to right, #667eea, #764ba2);
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            margin-bottom: 25px;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .game-title {
            color: #2d3436;
            font-size: 2.3rem;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .instructions {
            background: #f8f9fa;
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #667eea;
            text-align: right;
            line-height: 1.6;
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.1rem;
        }

        .level-selector {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .level-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex: 1;
            min-width: 120px;
        }

        .level-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .level-btn.active {
            background: linear-gradient(135deg, #00b894, #00a085);
            transform: scale(1.05);
        }

        .game-area {
            padding: 25px;
            background: #f1f2f6;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #dfe6e9;
        }

        .target-display {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 20px 0;
            color: #667eea;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .building-area {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 30px 0;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            min-height: 120px;
            flex-wrap: wrap;
        }

        .digit-slot {
            width: 80px;
            height: 80px;
            border: 3px dashed #b2bec3;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            color: #636e72;
            background: #f8f9fa;
            transition: all 0.3s ease;
            position: relative;
        }

        .digit-slot.filled {
            border: 3px solid #00b894;
            background: rgba(0, 184, 148, 0.1);
            color: #2d3436;
        }

        .place-label {
            position: absolute;
            top: -25px;
            font-size: 0.9rem;
            color: #667eea;
            font-weight: bold;
        }

        .digits-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .digit-btn {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #fd79a8, #e84393);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .digit-btn:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .digit-btn:active {
            transform: translateY(2px);
        }

        .digit-btn.used {
            opacity: 0.5;
            transform: scale(0.8);
            cursor: not-allowed;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .control-btn {
            background: linear-gradient(to right, #f4a261, #e76f51);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .control-btn:active {
            transform: translateY(1px);
        }

        .control-btn.check {
            background: linear-gradient(to right, #00b894, #00a085);
        }

        .control-btn.clear {
            background: linear-gradient(to right, #e63946, #c1121f);
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
            background: rgba(0, 184, 148, 0.2);
            color: #00b894;
            border: 2px solid #00b894;
        }

        .message-error {
            background: rgba(230, 57, 70, 0.2);
            color: #e63946;
            border: 2px solid #e63946;
        }

        .message-info {
            background: rgba(102, 126, 234, 0.2);
            color: #667eea;
            border: 2px solid #667eea;
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
            font-size: 1.8rem;
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
            background: linear-gradient(to right, #00b894, #00a085);
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .number-representation {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
        }

        .representation-text {
            font-size: 1.2rem;
            line-height: 1.8;
            text-align: right;
            color: #2d3436;
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

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .game-title {
                font-size: 2rem;
            }

            .target-display {
                font-size: 2rem;
            }

            .digit-slot {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .digit-btn {
                width: 55px;
                height: 55px;
                font-size: 1.5rem;
            }

            .level-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
                min-width: 100px;
            }

            .control-btn {
                padding: 12px 20px;
                font-size: 1rem;
            }

            .progress-value {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .building-area {
                gap: 10px;
                padding: 15px;
            }

            .digit-slot {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }

            .digit-btn {
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
            }

            .place-label {
                font-size: 0.8rem;
                top: -20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }} | المدى: {{ $min_range }} إلى {{ $max_range }}
        </div>

        <h1 class="game-title">🏗️ لعبة بناء الأعداد</h1>

        <div class="instructions">
            <p>🎯 الهدف: ابن العدد المستهدف باستخدام الأرقام المتاحة</p>
            <p>💡 الطريقة: اسحب الأرقام إلى المنازل الصحيحة لبناء العدد</p>
            <p>📚 اختر المستوى المناسب للبدء</p>
        </div>

        <div class="level-selector">
            <button class="level-btn active" onclick="setLevel(3)">
                🟢 الأعداد ضمن 999
            </button>
            <button class="level-btn" onclick="setLevel(4)">
                🔵 الأعداد ضمن 9999
            </button>
            <button class="level-btn" onclick="setLevel(5)">
                🟣 الأعداد ضمن 99999
            </button>
        </div>

        <div class="game-area">
            <div class="target-display" id="target-display">
                <!-- العدد المستهدف سيظهر هنا -->
            </div>

            <div class="building-area" id="building-area">
                <!-- أماكن بناء العدد ستظهر هنا -->
            </div>

            <div class="digits-container" id="digits-container">
                <!-- الأرقام المتاحة ستظهر هنا -->
            </div>

            <div class="number-representation" id="number-representation">
                <h3>💡 تمثيل العدد:</h3>
                <div class="representation-text" id="representation-text">
                    <!-- تمثيل العدد سيظهر هنا -->
                </div>
            </div>
        </div>

        <div class="progress-container">
            <div class="progress-item">
                <div class="progress-label">النقاط</div>
                <div class="progress-value" id="score">0</div>
            </div>
            <div class="progress-item">
                <div class="progress-label">المستوى</div>
                <div class="progress-value" id="level-display">1</div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill" style="width: 0%"></div>
                </div>
            </div>
            <div class="progress-item">
                <div class="progress-label">التسلسل</div>
                <div class="progress-value" id="streak">0</div>
            </div>
        </div>

        <div id="message" class="message-info">
            اختر المستوى ثم ابدأ ببناء الأعداد!
        </div>

        <div class="controls">
            <button class="control-btn check" id="check-btn" onclick="checkNumber()">
                ✓ تحقق من العدد
            </button>
            <button class="control-btn clear" onclick="clearAll()">
                🗑️ مسح الكل
            </button>
            <button class="control-btn" id="help-btn" onclick="showHelp()">
                💡 مساعدة
            </button>
            <button class="control-btn" id="start-btn" onclick="startGame()">
                🚀 ابدأ اللعبة
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
        let currentLevel = 1;
        let maxLevel = 10;
        let currentDigits = 3; // 3, 4, أو 5 أرقام
        let targetNumber = 0;
        let userNumber = [];
        let availableDigits = [];
        let gameActive = false;
        let currentStreak = 0;
        let bestStreak = 0;
        let draggedDigit = null;

        // عناصر DOM
        const targetDisplay = document.getElementById("target-display");
        const buildingArea = document.getElementById("building-area");
        const digitsContainer = document.getElementById("digits-container");
        const messageDisplay = document.getElementById("message");
        const scoreDisplay = document.getElementById("score");
        const levelDisplay = document.getElementById("level-display");
        const progressFill = document.getElementById("progress-fill");
        const streakDiv = document.getElementById("streak");
        const checkBtn = document.getElementById("check-btn");
        const helpBtn = document.getElementById("help-btn");
        const startBtn = document.getElementById("start-btn");
        const restartBtn = document.getElementById("restart-btn");
        const numberRepresentation = document.getElementById("number-representation");
        const representationText = document.getElementById("representation-text");
        const celebrationDiv = document.getElementById("celebration");

        // تعيين مستوى اللعبة
        function setLevel(digits) {
            if (gameActive) return;

            currentDigits = digits;
            document.querySelectorAll('.level-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            let levelName = '';
            switch(digits) {
                case 3: levelName = 'الأعداد ضمن 999'; break;
                case 4: levelName = 'الأعداد ضمن 9999'; break;
                case 5: levelName = 'الأعداد ضمن 99999'; break;
            }

            messageDisplay.textContent = `المستوى: ${levelName} - اضغط ابدأ للعب`;
            messageDisplay.className = 'message-info';
        }

        // بدء اللعبة
        function startGame() {
            if (gameActive) return;

            gameActive = true;
            score = 0;
            currentLevel = 1;
            currentStreak = 0;

            scoreDisplay.textContent = score;
            levelDisplay.textContent = currentLevel;
            streakDiv.textContent = currentStreak;
            updateProgress();

            startBtn.style.display = 'none';
            restartBtn.style.display = 'none';
            checkBtn.style.display = 'inline-block';
            helpBtn.style.display = 'inline-block';

            generateLevel();
        }

        // توليد مستوى جديد
        function generateLevel() {
            // توليد عدد مستهدف
            const maxTarget = Math.pow(10, currentDigits) - 1;
            targetNumber = Math.floor(Math.random() * (maxTarget - minRange + 1)) + minRange;

            // تحويل العدد إلى أرقام
            const targetDigits = targetNumber.toString().split('').map(Number);

            // توليد أرقام إضافية عشوائية
            availableDigits = [...targetDigits];
            while (availableDigits.length < currentDigits + 2) {
                const randomDigit = Math.floor(Math.random() * 10);
                availableDigits.push(randomDigit);
            }

            // خلط الأرقام
            shuffleArray(availableDigits);

            // إعادة تعيين العدد الذي بناه المستخدم
            userNumber = Array(currentDigits).fill(null);

            displayGame();

            messageDisplay.textContent = `ابن العدد ${targetNumber} باستخدام الأرقام المتاحة`;
            messageDisplay.className = 'message-info';

            numberRepresentation.style.display = 'none';
        }

        // عرض عناصر اللعبة
        function displayGame() {
            // عرض العدد المستهدف
            targetDisplay.textContent = `العدد المستهدف: ${formatNumber(targetNumber)}`;

            // إنشاء أماكن بناء العدد
            buildingArea.innerHTML = '';
            const placeNames = ['مئات الآلاف', 'عشرات الآلاف', 'آلاف', 'مئات', 'عشرات', 'آحاد'];

            for (let i = 0; i < currentDigits; i++) {
                const slot = document.createElement("div");
                slot.className = "digit-slot";
                slot.dataset.index = i;

                const label = document.createElement("div");
                label.className = "place-label";
                label.textContent = placeNames[placeNames.length - currentDigits + i];

                if (userNumber[i] !== null) {
                    slot.textContent = userNumber[i];
                    slot.classList.add("filled");
                }

                slot.appendChild(label);

                // إضافة إمكانية السحب والإفلات
                slot.addEventListener("dragover", handleDragOver);
                slot.addEventListener("drop", handleDrop);
                slot.addEventListener("dragenter", handleDragEnter);
                slot.addEventListener("dragleave", handleDragLeave);

                buildingArea.appendChild(slot);
            }

            // عرض الأرقام المتاحة
            digitsContainer.innerHTML = '';
            availableDigits.forEach((digit, index) => {
                const btn = document.createElement("button");
                btn.className = "digit-btn";
                btn.textContent = digit;
                btn.dataset.index = index;
                btn.draggable = true;

                btn.addEventListener("dragstart", handleDragStart);
                btn.addEventListener("dragend", handleDragEnd);

                digitsContainer.appendChild(btn);
            });
        }

        // معالجة بدء السحب
        function handleDragStart(e) {
            if (!gameActive) return;

            draggedDigit = e.target;
            e.target.style.opacity = "0.4";
            e.dataTransfer.setData("text/plain", e.target.textContent);
            e.dataTransfer.effectAllowed = "move";
        }

        // معالجة نهاية السحب
        function handleDragEnd(e) {
            e.target.style.opacity = "1";
        }

        // السماح بالإفلات
        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = "move";
        }

        // معالجة دخول منطقة الإفلات
        function handleDragEnter(e) {
            e.preventDefault();
            if (e.target.classList.contains("digit-slot")) {
                e.target.style.background = "rgba(116, 185, 255, 0.2)";
                e.target.style.borderColor = "#74b9ff";
            }
        }

        // معالجة خروج منطقة الإفلات
        function handleDragLeave(e) {
            if (e.target.classList.contains("digit-slot")) {
                e.target.style.background = "";
                e.target.style.borderColor = "";
            }
        }

        // معالجة الإفلات
        function handleDrop(e) {
            e.preventDefault();

            if (e.target.classList.contains("digit-slot")) {
                const digitValue = parseInt(e.dataTransfer.getData("text/plain"));
                const slotIndex = parseInt(e.target.dataset.index);

                // وضع الرقم في المكان المحدد
                userNumber[slotIndex] = digitValue;

                // تحديث العرض
                displayGame();

                // إخفاء الرقم المستخدم مؤقتاً
                if (draggedDigit) {
                    draggedDigit.style.display = "none";
                }

                e.target.style.background = "";
                e.target.style.borderColor = "";
            }
        }

        // التحقق من العدد
        function checkNumber() {
            if (!gameActive) return;

            // بناء العدد من الأرقام
            const builtNumber = parseInt(userNumber.join(''));

            if (builtNumber === targetNumber) {
                // الإجابة صحيحة
                score += currentLevel * 10;
                currentStreak++;
                bestStreak = Math.max(bestStreak, currentStreak);

                messageDisplay.textContent = `أحسنت! ✅ بنيت العدد بشكل صحيح`;
                messageDisplay.className = "message-success";

                // مكافأة التسلسل
                if (currentStreak >= 3) {
                    const streakBonus = currentStreak * 5;
                    score += streakBonus;
                    messageDisplay.textContent += ` 🎯 تسلسل ${currentStreak}! +${streakBonus} نقاط`;
                }

                // الانتقال للمستوى التالي
                currentLevel++;
                levelDisplay.textContent = currentLevel;

                if (currentLevel <= maxLevel) {
                    setTimeout(generateLevel, 2000);
                } else {
                    setTimeout(() => endGame(true), 2000);
                }
            } else {
                // الإجابة خاطئة
                currentStreak = 0;
                messageDisplay.textContent = `خطأ! العدد الذي بنيته هو ${builtNumber} وليس ${targetNumber} 😅`;
                messageDisplay.className = "message-error";
            }

            // تحديث النقاط والتسلسل
            scoreDisplay.textContent = score;
            streakDiv.textContent = currentStreak;
            updateProgress();
        }

        // مسح جميع الأرقام
        function clearAll() {
            if (!gameActive) return;

            userNumber = Array(currentDigits).fill(null);
            displayGame();

            // إعادة إظهار جميع الأرقام
            document.querySelectorAll('.digit-btn').forEach(btn => {
                btn.style.display = "flex";
            });

            messageDisplay.textContent = "تم مسح جميع الأرقام، جرب مرة أخرى!";
            messageDisplay.className = "message-info";
        }

        // عرض المساعدة
        function showHelp() {
            if (!gameActive) return;

            // تحليل العدد إلى منازله
            const numberStr = targetNumber.toString();
            let representation = "";
            const placeNames = ['مئات الآلاف', 'عشرات الآلاف', 'آلاف', 'مئات', 'عشرات', 'آحاد'];

            for (let i = 0; i < numberStr.length; i++) {
                const digit = parseInt(numberStr[i]);
                const placeIndex = placeNames.length - numberStr.length + i;
                representation += `${digit} × ${getPlaceValue(numberStr.length - i - 1)} = ${digit * Math.pow(10, numberStr.length - i - 1)} (${placeNames[placeIndex]})<br>`;
            }

            representation += `<br><strong>المجموع: ${targetNumber}</strong>`;

            representationText.innerHTML = representation;
            numberRepresentation.style.display = "block";
        }

        // الحصول على قيمة المنزلة
        function getPlaceValue(place) {
            const values = ['واحد', 'عشرة', 'مئة', 'ألف', 'عشرة آلاف', 'مئة ألف'];
            return values[place] || Math.pow(10, place);
        }

        // تحديث شريط التقدم
        function updateProgress() {
            const progress = (currentLevel / maxLevel) * 100;
            progressFill.style.width = `${progress}%`;
        }

        // إنهاء اللعبة
        function endGame(isComplete) {
            gameActive = false;

            if (isComplete) {
                messageDisplay.innerHTML = `🎉 تهانينا! أكملت جميع المستويات بنجاح!<br>مجموع نقاطك: ${score} | أفضل تسلسل: ${bestStreak} 🌟`;
                messageDisplay.className = "message-success";
                createConfetti();
            }

            checkBtn.style.display = 'none';
            helpBtn.style.display = 'none';
            restartBtn.style.display = 'inline-block';
        }

        // إعادة تشغيل اللعبة
        function restartGame() {
            buildingArea.innerHTML = '';
            digitsContainer.innerHTML = '';
            numberRepresentation.style.display = 'none';
            celebrationDiv.style.display = 'none';
            celebrationDiv.innerHTML = '';
            startGame();
        }

        // تأثير احتفالي
        function createConfetti() {
            celebrationDiv.style.display = 'block';
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#667eea'];

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

        // دالة مساعدة: خلط المصفوفة
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // دالة مساعدة: تنسيق الأعداد
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // تهيئة الوضع الافتراضي
        setLevel(3);
    </script>
</body>
</html>
