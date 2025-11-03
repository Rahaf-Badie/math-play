<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لعبة الذاكرة للكسور المتكافئة - {{ $lesson_game->lesson->name }}</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #333;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 900px;
            padding: 30px;
            text-align: center;
        }

        .lesson-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .instructions {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-right: 5px solid #74b9ff;
        }

        .instructions h3 {
            color: #0984e3;
            margin-bottom: 10px;
        }

        .instructions p {
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .game-area {
            padding: 25px;
            background: linear-gradient(135deg, #fff9e6 0%, #fff3cd 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 3px solid #f39c12;
        }

        .game-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .game-stats {
            display: flex;
            gap: 20px;
        }

        .stat-item {
            background: white;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #f39c12;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            perspective: 1000px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 480px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .card {
            height: 120px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.6s;
            cursor: pointer;
        }

        .card-face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .card-front {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            transform: rotateY(180deg);
            font-size: 1.8rem;
            font-weight: bold;
        }

        .card-back {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            font-size: 2rem;
        }

        .card.flipped {
            transform: rotateY(180deg);
        }

        .card.matched .card-front {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            animation: pulse 1s infinite;
        }

        .fraction-display {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .numerator {
            font-size: 2rem;
            border-bottom: 3px solid white;
            padding: 0 15px;
            margin-bottom: 5px;
        }

        .denominator {
            font-size: 2rem;
            padding: 0 15px;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        #start-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            color: white;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: translateY(0);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .feedback {
            min-height: 60px;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s;
        }

        .feedback.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback.incorrect {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .feedback.info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
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

        .timer {
            background: white;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            font-size: 1.2rem;
            font-weight: bold;
            color: #f39c12;
        }

        .difficulty-selector {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .difficulty-btn {
            padding: 8px 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
        }

        .difficulty-btn.active {
            background: #3498db;
            color: white;
            border-color: #2980b9;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes confetti-fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .bounce {
            animation: bounce 0.5s ease infinite;
        }

        .completion-message {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00b894;
            margin: 20px 0;
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- معلومات الدرس -->
        <div class="lesson-info">الدرس: {{ $lesson_game->lesson->name }}</div>

        <!-- التعليمات -->
        <div class="instructions">
            <h3>لعبة الذاكرة للكسور المتكافئة 🧠</h3>
            <p>🎯 ابحث عن أزواج الكسور التي تمثل نفس القيمة</p>
            <p>💡 تذكر: الكسور المتكافئة تمثل نفس الكمية بأرقام مختلفة</p>
            <p>✨ مثال: 1/2 = 2/4 = 3/6</p>
        </div>

        <!-- منطقة اللعبة -->
        <div class="game-area">
            <!-- رأس اللعبة -->
            <div class="game-header">
                <div class="game-stats">
                    <div class="stat-item">
                        <div class="stat-value" id="matches">0</div>
                        <div class="stat-label">أزواج متطابقة</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="moves">0</div>
                        <div class="stat-label">عدد المحاولات</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="score">0</div>
                        <div class="stat-label">النقاط</div>
                    </div>
                </div>
                <div class="timer" id="timer">00:00</div>
            </div>

            <!-- اختيار مستوى الصعوبة -->
            <div class="difficulty-selector">
                <button class="difficulty-btn active" data-difficulty="easy">سهل (٨ بطاقات)</button>
                <button class="difficulty-btn" data-difficulty="medium">متوسط (١٢ بطاقة)</button>
                <button class="difficulty-btn" data-difficulty="hard">صعب (١٦ بطاقة)</button>
            </div>

            <!-- شبكة البطاقات -->
            <div id="game-grid" class="grid">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- رسالة الإكمال -->
            <div id="completion-message" class="completion-message" style="display: none;">
                <!-- سيتم تعبئتها ديناميكياً -->
            </div>

            <!-- عناصر التحكم -->
            <div class="controls">
                <button id="start-btn">بدء اللعبة</button>
                <button id="hint-btn">مساعدة</button>
                <button id="reset-btn">لعبة جديدة</button>
            </div>

            <!-- التغذية الراجعة -->
            <div class="feedback" id="feedback">اضغط "بدء اللعبة" للبدء!</div>
        </div>
    </div>

    <!-- تأثيرات الاحتفال -->
    <div class="celebration" id="celebration"></div>

    <script>
        // بيانات الكسور المتكافئة
        const fractionPairs = {
            easy: [
                { num: 1, den: 2, matchNum: 2, matchDen: 4, id: 1 },
                { num: 1, den: 3, matchNum: 2, matchDen: 6, id: 2 },
                { num: 2, den: 3, matchNum: 4, matchDen: 6, id: 3 },
                { num: 1, den: 4, matchNum: 2, matchDen: 8, id: 4 }
            ],
            medium: [
                { num: 1, den: 2, matchNum: 3, matchDen: 6, id: 1 },
                { num: 1, den: 3, matchNum: 3, matchDen: 9, id: 2 },
                { num: 2, den: 3, matchNum: 6, matchDen: 9, id: 3 },
                { num: 1, den: 4, matchNum: 3, matchDen: 12, id: 4 },
                { num: 3, den: 4, matchNum: 6, matchDen: 8, id: 5 },
                { num: 2, den: 5, matchNum: 4, matchDen: 10, id: 6 }
            ],
            hard: [
                { num: 1, den: 2, matchNum: 4, matchDen: 8, id: 1 },
                { num: 1, den: 3, matchNum: 4, matchDen: 12, id: 2 },
                { num: 2, den: 3, matchNum: 8, matchDen: 12, id: 3 },
                { num: 1, den: 4, matchNum: 4, matchDen: 16, id: 4 },
                { num: 3, den: 4, matchNum: 9, matchDen: 12, id: 5 },
                { num: 2, den: 5, matchNum: 6, matchDen: 15, id: 6 },
                { num: 3, den: 5, matchNum: 6, matchDen: 10, id: 7 },
                { num: 4, den: 5, matchNum: 8, matchDen: 10, id: 8 }
            ]
        };

        // المتغيرات الأساسية
        let currentDifficulty = 'easy';
        let cards = [];
        let flippedCards = [];
        let matchedPairs = 0;
        let totalMoves = 0;
        let score = 0;
        let gameStarted = false;
        let gameTimer = null;
        let seconds = 0;
        let hintsUsed = 0;

        // عناصر DOM
        const gameGridElement = document.getElementById('game-grid');
        const matchesElement = document.getElementById('matches');
        const movesElement = document.getElementById('moves');
        const scoreElement = document.getElementById('score');
        const timerElement = document.getElementById('timer');
        const feedbackElement = document.getElementById('feedback');
        const startButton = document.getElementById('start-btn');
        const hintButton = document.getElementById('hint-btn');
        const resetButton = document.getElementById('reset-btn');
        const completionMessageElement = document.getElementById('completion-message');
        const celebrationElement = document.getElementById('celebration');
        const difficultyButtons = document.querySelectorAll('.difficulty-btn');

        // تهيئة اللعبة
        function initGame() {
            setupEventListeners();
            resetGame();
        }

        // إعداد مستمعي الأحداث
        function setupEventListeners() {
            startButton.addEventListener('click', startGame);
            hintButton.addEventListener('click', showHint);
            resetButton.addEventListener('click', resetGame);

            difficultyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    difficultyButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    currentDifficulty = this.getAttribute('data-difficulty');
                    resetGame();
                });
            });
        }

        // بدء اللعبة
        function startGame() {
            if (gameStarted) return;

            gameStarted = true;
            startButton.disabled = true;
            startTimer();
            createBoard();
            feedbackElement.textContent = 'ابحث عن أزواج الكسور المتكافئة!';
            feedbackElement.className = 'feedback info';
        }

        // إنشاء لوح اللعب
        function createBoard() {
            gameGridElement.innerHTML = '';
            cards = [];
            flippedCards = [];
            matchedPairs = 0;
            totalMoves = 0;
            score = 0;

            updateStats();

            const pairs = fractionPairs[currentDifficulty];
            let cardArray = [];

            // إنشاء البطاقات
            pairs.forEach((pair, index) => {
                // البطاقة الأساسية
                cardArray.push({
                    value: createFractionHTML(pair.num, pair.den),
                    fractionId: pair.id,
                    numericValue: pair.num / pair.den
                });
                // البطاقة المكافئة
                cardArray.push({
                    value: createFractionHTML(pair.matchNum, pair.matchDen),
                    fractionId: pair.id,
                    numericValue: pair.matchNum / pair.matchDen
                });
            });

            // خلط البطاقات
            shuffleArray(cardArray);

            // إنشاء البطاقات في الواجهة
            cardArray.forEach((card, index) => {
                const cardElement = document.createElement('div');
                cardElement.className = 'card';
                cardElement.dataset.index = index;
                cardElement.dataset.fractionId = card.fractionId;
                cardElement.dataset.numericValue = card.numericValue;

                // الوجه الخلفي
                const backFace = document.createElement('div');
                backFace.className = 'card-face card-back';
                backFace.innerHTML = '?';
                cardElement.appendChild(backFace);

                // الوجه الأمامي
                const frontFace = document.createElement('div');
                frontFace.className = 'card-face card-front';
                frontFace.innerHTML = card.value;
                cardElement.appendChild(frontFace);

                cardElement.addEventListener('click', flipCard);
                gameGridElement.appendChild(cardElement);

                cards.push(cardElement);
            });
        }

        // قلب البطاقة
        function flipCard() {
            if (!gameStarted || this.classList.contains('flipped') || this.classList.contains('matched')) {
                return;
            }

            if (flippedCards.length < 2) {
                this.classList.add('flipped');
                flippedCards.push(this);

                if (flippedCards.length === 2) {
                    totalMoves++;
                    updateStats();
                    checkForMatch();
                }
            }
        }

        // التحقق من التطابق
        function checkForMatch() {
            const [card1, card2] = flippedCards;
            const isMatch = card1.dataset.fractionId === card2.dataset.fractionId;

            setTimeout(() => {
                if (isMatch) {
                    handleMatch();
                } else {
                    handleMismatch();
                }
            }, 1000);
        }

        // معالجة التطابق
        function handleMatch() {
            flippedCards.forEach(card => {
                card.classList.add('matched');
            });

            matchedPairs++;
            score += 100;
            updateStats();

            feedbackElement.textContent = '🎉 أحسنت! زوج متطابق!';
            feedbackElement.className = 'feedback correct';

            flippedCards = [];

            // التحقق من اكتمال اللعبة
            if (matchedPairs === fractionPairs[currentDifficulty].length) {
                endGame();
            }
        }

        // معالجة عدم التطابق
        function handleMismatch() {
            feedbackElement.textContent = '❌ غير متطابق، حاول مرة أخرى!';
            feedbackElement.className = 'feedback incorrect';

            flippedCards.forEach(card => {
                card.classList.remove('flipped');
            });

            flippedCards = [];
        }

        // إنشاء HTML للكسر
        function createFractionHTML(numerator, denominator) {
            return `
                <div class="fraction-display">
                    <div class="numerator">${numerator}</div>
                    <div class="denominator">${denominator}</div>
                </div>
            `;
        }

        // عرض مساعدة
        function showHint() {
            if (!gameStarted || hintsUsed >= 3) return;

            hintsUsed++;
            score = Math.max(0, score - 50);
            updateStats();

            // إيجاد زوج غير متطابق وعرضه مؤقتاً
            const unmatchedCards = cards.filter(card => !card.classList.contains('matched'));
            if (unmatchedCards.length >= 2) {
                const randomCard1 = unmatchedCards[Math.floor(Math.random() * unmatchedCards.length)];
                const fractionId = randomCard1.dataset.fractionId;
                const matchingCard = unmatchedCards.find(card =>
                    card.dataset.fractionId === fractionId && card !== randomCard1
                );

                if (matchingCard) {
                    randomCard1.classList.add('flipped');
                    matchingCard.classList.add('flipped');

                    setTimeout(() => {
                        if (!randomCard1.classList.contains('matched')) {
                            randomCard1.classList.remove('flipped');
                        }
                        if (!matchingCard.classList.contains('matched')) {
                            matchingCard.classList.remove('flipped');
                        }
                    }, 1500);

                    feedbackElement.textContent = `💡 هذه مساعدة! تذكر أن ${getFractionValue(randomCard1)} = ${getFractionValue(matchingCard)}`;
                    feedbackElement.className = 'feedback info';
                }
            }
        }

        // الحصول على قيمة الكسر كنص
        function getFractionValue(card) {
            const fractionDisplay = card.querySelector('.fraction-display');
            const numerator = fractionDisplay.querySelector('.numerator').textContent;
            const denominator = fractionDisplay.querySelector('.denominator').textContent;
            return `${numerator}/${denominator}`;
        }

        // نهاية اللعبة
        function endGame() {
            gameStarted = false;
            clearInterval(gameTimer);

            const timeBonus = Math.max(0, 500 - seconds * 2);
            const movesBonus = Math.max(0, 300 - totalMoves * 10);
            const finalScore = score + timeBonus + movesBonus;

            completionMessageElement.style.display = 'block';
            completionMessageElement.innerHTML = `
                🎊 تهانينا! أكملت اللعبة بنجاح!<br>
                ⏱️ الوقت: ${formatTime(seconds)}<br>
                🔄 المحاولات: ${totalMoves}<br>
                💯 النقاط النهائية: ${finalScore}<br>
                🏆 أداء ${getPerformanceRating(finalScore)}
            `;

            celebrate();
        }

        // تقييم الأداء
        function getPerformanceRating(score) {
            if (score >= 800) return 'ممتاز!';
            if (score >= 600) return 'جيد جداً!';
            if (score >= 400) return 'جيد!';
            return 'حاول مرة أخرى!';
        }

        // إعادة تعيين اللعبة
        function resetGame() {
            gameStarted = false;
            clearInterval(gameTimer);
            seconds = 0;
            hintsUsed = 0;
            timerElement.textContent = '00:00';
            startButton.disabled = false;
            completionMessageElement.style.display = 'none';
            feedbackElement.textContent = 'اضغط "بدء اللعبة" للبدء!';
            feedbackElement.className = 'feedback info';
            createBoard();
        }

        // بدء المؤقت
        function startTimer() {
            clearInterval(gameTimer);
            seconds = 0;
            gameTimer = setInterval(() => {
                seconds++;
                timerElement.textContent = formatTime(seconds);
            }, 1000);
        }

        // تنسيق الوقت
        function formatTime(seconds) {
            const mins = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        // تحديث الإحصائيات
        function updateStats() {
            matchesElement.textContent = matchedPairs;
            movesElement.textContent = totalMoves;
            scoreElement.textContent = score;
        }

        // خلط المصفوفة
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        // تأثير الاحتفال
        function celebrate() {
            celebrationElement.style.display = 'block';
            celebrationElement.innerHTML = '';

            for (let i = 0; i < 80; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.width = '15px';
                confetti.style.height = '15px';
                confetti.style.background = getRandomColor();
                confetti.style.borderRadius = '50%';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s linear forwards`;
                celebrationElement.appendChild(confetti);
            }

            setTimeout(() => {
                celebrationElement.style.display = 'none';
            }, 4000);
        }

        // الحصول على لون عشوائي
        function getRandomColor() {
            const colors = [
                '#ff7675', '#74b9ff', '#55efc4', '#ffeaa7',
                '#a29bfe', '#fd79a8', '#fdcb6e', '#00b894'
            ];
            return colors[Math.floor(Math.random() * colors.length)];
        }

        // بدء اللعبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', initGame);
    </script>
</body>
</html>
