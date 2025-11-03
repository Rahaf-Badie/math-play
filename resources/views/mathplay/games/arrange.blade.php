<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔢 لعبة ترتيب الأعداد - {{ $lesson_game->lesson->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Cairo", "Tahoma", sans-serif;
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
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
            max-width: 600px;
            margin-top: 20px;
        }

        .lesson-info {
            background: linear-gradient(to right, #fd79a8, #e84393);
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
            font-size: 2.5rem;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .instructions {
            background: #f8f9fa;
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #fd79a8;
            text-align: right;
            line-height: 1.6;
        }

        .instructions p {
            margin: 8px 0;
            font-size: 1.1rem;
        }

        .game-area {
            min-height: 200px;
            padding: 20px;
            background: #f1f2f6;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px dashed #dfe6e9;
        }

        .numbers-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin: 20px 0;
            min-height: 100px;
        }

        .number-box {
            width: 70px;
            height: 70px;
            line-height: 70px;
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
            border-radius: 15px;
            cursor: grab;
            user-select: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .number-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            border-radius: 15px;
        }

        .number-box:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }

        .number-box:active {
            cursor: grabbing;
            transform: scale(0.95);
        }

        .number-box.dragging {
            opacity: 0.7;
            transform: rotate(5deg);
        }

        .drop-zone {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin: 25px 0;
            padding: 20px;
            background: rgba(116, 185, 255, 0.1);
            border-radius: 15px;
            border: 2px dashed #74b9ff;
            min-height: 120px;
        }

        .drop-zone.highlight {
            background: rgba(116, 185, 255, 0.2);
            border-color: #0984e3;
        }

        .drop-slot {
            width: 70px;
            height: 70px;
            border: 2px dashed #b2bec3;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #636e72;
            transition: all 0.3s ease;
        }

        .drop-slot.filled {
            border: 2px solid #00b894;
            background: rgba(0, 184, 148, 0.1);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 25px 0;
        }

        .control-btn {
            background: linear-gradient(to right, #fd79a8, #e84393);
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

        .control-btn.check {
            background: linear-gradient(to right, #00b894, #00a085);
        }

        .control-btn.hint {
            background: linear-gradient(to right, #fdcb6e, #e17055);
        }

        #message {
            font-size: 1.4rem;
            margin: 20px 0;
            min-height: 50px;
            font-weight: bold;
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .message-success {
            background: rgba(0, 184, 148, 0.2);
            color: #00b894;
            border: 2px solid #00b894;
        }

        .message-error {
            background: rgba(255, 118, 117, 0.2);
            color: #e63946;
            border: 2px solid #e63946;
        }

        .message-info {
            background: rgba(116, 185, 255, 0.2);
            color: #1d3557;
            border: 2px solid #74b9ff;
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
            background: linear-gradient(to right, #00b894, #00a085);
            border-radius: 10px;
            transition: width 0.5s ease;
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

            .number-box, .drop-slot {
                width: 60px;
                height: 60px;
                line-height: 60px;
                font-size: 1.5rem;
            }

            .control-btn {
                padding: 12px 20px;
                font-size: 1rem;
            }

            .progress-value {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            الدرس: {{ $lesson_game->lesson->name }} | المدى: {{ $min_range }} إلى {{ $max_range }}
        </div>

        <h1 class="game-title">🔢 رتّب الأعداد</h1>

        <div class="instructions">
            <p>🎯 الهدف: اسحب الأعداد وارتبها من الأصغر إلى الأكبر</p>
            <p>💡 الطريقة: اسحب كل عدد إلى مكانه الصحيح في المنطقة أدناه</p>
        </div>

        <div class="game-area">
            <div class="numbers-container" id="numbers-container">
                <!-- الأعداد ستظهر هنا -->
            </div>

            <div class="drop-zone" id="drop-zone">
                <!-- أماكن وضع الأعداد ستظهر هنا -->
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
                <div class="progress-label">التلميحات</div>
                <div class="progress-value" id="hints">3</div>
            </div>
        </div>

        <div id="message" class="message-info">
            ابدأ بسحب الأعداد إلى أماكنها الصحيحة
        </div>

        <div class="controls">
            <button class="control-btn check" id="check-btn" onclick="checkOrder()">
                ✓ تحقق من الإجابة
            </button>
            <button class="control-btn hint" id="hint-btn" onclick="giveHint()">
                💡 تلميح
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
        let numbers = [];
        let correctOrder = [];
        let userOrder = [];
        let score = 0;
        let questionCount = 0;
        const totalQuestions = 10;
        let hintsLeft = 3;
        let draggedElement = null;

        // عناصر DOM
        const numbersContainer = document.getElementById("numbers-container");
        const dropZone = document.getElementById("drop-zone");
        const messageDiv = document.getElementById("message");
        const scoreDiv = document.getElementById("score");
        const questionCountDiv = document.getElementById("question-count");
        const progressFill = document.getElementById("progress-fill");
        const hintsDiv = document.getElementById("hints");
        const checkBtn = document.getElementById("check-btn");
        const hintBtn = document.getElementById("hint-btn");
        const restartBtn = document.getElementById("restart-btn");
        const celebrationDiv = document.getElementById("celebration");

        // تهيئة اللعبة
        function initGame() {
            generateNumbers();
            setupEventListeners();
            updateProgress();
        }

        // توليد أعداد عشوائية
        function generateNumbers() {
            // عدد الأعداد (3-5) بناءً على تقدم اللاعب
            const count = Math.min(3 + Math.floor(questionCount / 3), 5);
            numbers = [];

            // توليد أعداد فريدة ضمن المدى المحدد
            while (numbers.length < count) {
                const num = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                if (!numbers.includes(num)) {
                    numbers.push(num);
                }
            }

            correctOrder = [...numbers].sort((a, b) => a - b);
            userOrder = Array(count).fill(null);

            displayNumbers();
            createDropSlots();
        }

        // عرض الأعداد
        function displayNumbers() {
            numbersContainer.innerHTML = "";

            // خلط الأعداد لعرضها
            const shuffledNumbers = [...numbers].sort(() => Math.random() - 0.5);

            shuffledNumbers.forEach(num => {
                const numberBox = document.createElement("div");
                numberBox.className = "number-box";
                numberBox.textContent = num;
                numberBox.draggable = true;
                numberBox.dataset.value = num;

                numberBox.addEventListener("dragstart", handleDragStart);
                numberBox.addEventListener("dragend", handleDragEnd);

                numbersContainer.appendChild(numberBox);
            });
        }

        // إنشاء أماكن وضع الأعداد
        function createDropSlots() {
            dropZone.innerHTML = "";
            dropZone.classList.remove("highlight");

            for (let i = 0; i < correctOrder.length; i++) {
                const dropSlot = document.createElement("div");
                dropSlot.className = "drop-slot";
                dropSlot.dataset.index = i;

                dropSlot.addEventListener("dragover", handleDragOver);
                dropSlot.addEventListener("drop", handleDrop);
                dropSlot.addEventListener("dragenter", handleDragEnter);
                dropSlot.addEventListener("dragleave", handleDragLeave);

                dropZone.appendChild(dropSlot);
            }
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            dropZone.addEventListener("dragover", handleDragOver);
            dropZone.addEventListener("drop", handleDropToZone);
        }

        // معالجة بدء السحب
        function handleDragStart(e) {
            draggedElement = e.target;
            e.target.classList.add("dragging");
            e.dataTransfer.setData("text/plain", e.target.dataset.value);
            e.dataTransfer.effectAllowed = "move";

            // إضافة تأثير للسحب
            setTimeout(() => {
                e.target.style.opacity = "0.4";
            }, 0);
        }

        // معالجة نهاية السحب
        function handleDragEnd(e) {
            e.target.classList.remove("dragging");
            e.target.style.opacity = "1";
            dropZone.classList.remove("highlight");

            // إزالة التظليل من جميع أماكن الوضع
            document.querySelectorAll(".drop-slot").forEach(slot => {
                slot.classList.remove("highlight");
            });
        }

        // السماح بالإفلات
        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = "move";
        }

        // معالجة دخول العنصر إلى منطقة الإفلات
        function handleDragEnter(e) {
            e.preventDefault();
            if (e.target.classList.contains("drop-slot")) {
                e.target.classList.add("highlight");
            }
        }

        // معالجة خروج العنصر من منطقة الإفلات
        function handleDragLeave(e) {
            if (e.target.classList.contains("drop-slot")) {
                e.target.classList.remove("highlight");
            }
        }

        // معالجة الإفلات في مكان محدد
        function handleDrop(e) {
            e.preventDefault();

            if (e.target.classList.contains("drop-slot")) {
                const index = parseInt(e.target.dataset.index);
                const value = parseInt(e.dataTransfer.getData("text/plain"));

                // التحقق مما إذا كان المكان شاغراً
                if (userOrder[index] === null) {
                    // وضع العدد في المكان المحدد
                    userOrder[index] = value;
                    e.target.textContent = value;
                    e.target.classList.add("filled");

                    // إخفاء العدد المسحوب
                    draggedElement.style.visibility = "hidden";

                    // التحقق مما إذا تم ملء جميع الأماكن
                    checkIfAllFilled();
                }

                e.target.classList.remove("highlight");
            }
        }

        // معالجة الإفلات في المنطقة العامة
        function handleDropToZone(e) {
            e.preventDefault();

            // إذا تم الإفلات مباشرة في المنطقة (وليس في مكان محدد)
            if (!e.target.classList.contains("drop-slot") && draggedElement) {
                // إعادة العنصر إلى مكانه الأصلي
                draggedElement.style.visibility = "visible";
            }
        }

        // التحقق مما إذا تم ملء جميع الأماكن
        function checkIfAllFilled() {
            const allFilled = userOrder.every(val => val !== null);
            checkBtn.disabled = !allFilled;

            if (allFilled) {
                messageDiv.textContent = "ممتاز! الآن تحقق من إجابتك";
                messageDiv.className = "message-info";
            }
        }

        // التحقق من الترتيب
        function checkOrder() {
            const isCorrect = JSON.stringify(userOrder) === JSON.stringify(correctOrder);

            if (isCorrect) {
                // الإجابة صحيحة
                score += 20;
                scoreDiv.textContent = score;

                messageDiv.textContent = "أحسنت! إجابة صحيحة 🎉";
                messageDiv.className = "message-success";

                // تأثير النجاح
                document.querySelectorAll(".drop-slot").forEach(slot => {
                    slot.style.background = "rgba(0, 184, 148, 0.3)";
                    slot.style.borderColor = "#00b894";
                });

                questionCount++;
                updateProgress();

                if (questionCount < totalQuestions) {
                    setTimeout(() => {
                        generateNumbers();
                        checkBtn.disabled = true;
                    }, 1500);
                } else {
                    endGame(true);
                }
            } else {
                // الإجابة خاطئة
                messageDiv.textContent = "ترتيب غير صحيح، حاول مرة أخرى 💪";
                messageDiv.className = "message-error";

                // إظهار الأخطاء
                highlightErrors();

                // خصم نقاط
                score = Math.max(0, score - 5);
                scoreDiv.textContent = score;
            }
        }

        // تظليل الأخطاء
        function highlightErrors() {
            document.querySelectorAll(".drop-slot").forEach((slot, index) => {
                const userValue = userOrder[index];
                const correctValue = correctOrder[index];

                if (userValue !== correctValue) {
                    slot.style.background = "rgba(255, 118, 117, 0.3)";
                    slot.style.borderColor = "#e63946";
                }
            });

            // إعادة التظليل بعد ثانية
            setTimeout(() => {
                document.querySelectorAll(".drop-slot").forEach(slot => {
                    slot.style.background = "";
                    slot.style.borderColor = "";
                });
            }, 1000);
        }

        // إعطاء تلميح
        function giveHint() {
            if (hintsLeft > 0) {
                // البحث عن أول مكان خطأ
                let hintIndex = -1;
                for (let i = 0; i < userOrder.length; i++) {
                    if (userOrder[i] !== correctOrder[i]) {
                        hintIndex = i;
                        break;
                    }
                }

                if (hintIndex !== -1) {
                    // إظهار التلميح
                    const correctValue = correctOrder[hintIndex];
                    const dropSlots = document.querySelectorAll(".drop-slot");

                    dropSlots[hintIndex].style.background = "rgba(253, 203, 110, 0.3)";
                    dropSlots[hintIndex].style.borderColor = "#fdcb6e";

                    // البحث عن العنصر الصحيح وتسليط الضوء عليه
                    const numberBoxes = document.querySelectorAll(".number-box");
                    numberBoxes.forEach(box => {
                        if (parseInt(box.dataset.value) === correctValue) {
                            box.style.background = "linear-gradient(135deg, #fdcb6e, #e17055)";
                            box.style.transform = "scale(1.1)";

                            setTimeout(() => {
                                box.style.background = "";
                                box.style.transform = "";
                            }, 2000);
                        }
                    });

                    hintsLeft--;
                    hintsDiv.textContent = hintsLeft;

                    messageDiv.textContent = `هذا هو المكان الصحيح للعدد ${correctValue}`;
                    messageDiv.className = "message-info";

                    if (hintsLeft === 0) {
                        hintBtn.disabled = true;
                    }
                }
            }
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
                messageDiv.textContent = `🎉 تهانينا! أكملت جميع الأسئلة بنجاح! 🎉\nمجموع نقاطك: ${score}`;
                messageDiv.className = "message-success";
                createConfetti();
            }

            numbersContainer.innerHTML = "";
            dropZone.innerHTML = "<p>انتهت اللعبة!</p>";
            checkBtn.style.display = "none";
            hintBtn.style.display = "none";
            restartBtn.style.display = "inline-block";
        }

        // إعادة تشغيل اللعبة
        function restartGame() {
            score = 0;
            questionCount = 0;
            hintsLeft = 3;

            scoreDiv.textContent = score;
            hintsDiv.textContent = hintsLeft;
            updateProgress();

            checkBtn.style.display = "inline-block";
            hintBtn.style.display = "inline-block";
            hintBtn.disabled = false;
            restartBtn.style.display = "none";

            messageDiv.textContent = "ابدأ بسحب الأعداد إلى أماكنها الصحيحة";
            messageDiv.className = "message-info";

            celebrationDiv.style.display = "none";
            celebrationDiv.innerHTML = "";

            initGame();
        }

        // تأثير احتفالي
        function createConfetti() {
            celebrationDiv.style.display = "block";
            const colors = ['#f1c40f', '#e74c3c', '#9b59b6', '#3498db', '#2ecc71', '#fd79a8'];

            for (let i = 0; i < 150; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.opacity = Math.random();
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                celebrationDiv.appendChild(confetti);

                // تأثير سقوط الكونفيتي
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
        window.onload = initGame;
    </script>
</body>
</html>
