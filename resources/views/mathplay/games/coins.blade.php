{{-- resources/views/mathplay/games/coins.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏠 القسمة المنزلية - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Noto Kufi Arabic', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            max-width: 1000px;
            width: 100%;
            color: #333;
            text-align: center;
        }

        h1 {
            color: #ff6b6b;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .lesson-info {
            color: #666;
            margin-bottom: 15px;
            font-size: 1.2rem;
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #ff6b6b;
        }

        .instructions {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-size: 1.3rem;
            line-height: 1.6;
            color: #2d3436;
            border: 3px solid #74b9ff;
        }

        .number-display {
            font-size: 4rem;
            font-weight: bold;
            margin: 20px 0;
            color: #073b4c;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 20px 40px;
            border-radius: 20px;
            display: inline-block;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 5px solid #ffd166;
        }

        .houses-container {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .house {
            width: 220px;
            height: 280px;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            position: relative;
            border: 5px solid #ff9e6d;
            transition: all 0.3s;
            cursor: pointer;
        }

        .house:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .house.active {
            border-color: #073b4c;
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(7, 59, 76, 0.4);
        }

        .house-roof {
            width: 120%;
            height: 40px;
            background: linear-gradient(135deg, #ef476f, #ff9e6d);
            border-radius: 10px 10px 0 0;
            position: absolute;
            top: -20px;
        }

        .house-label {
            margin-top: 30px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #073b4c;
            z-index: 2;
        }

        .house-value {
            font-size: 3rem;
            font-weight: bold;
            margin: 20px 0;
            color: #073b4c;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            border: 3px dashed #74b9ff;
            z-index: 2;
        }

        .house-description {
            font-size: 1rem;
            color: #666;
            margin-top: 10px;
            background: rgba(255, 255, 255, 0.7);
            padding: 5px 10px;
            border-radius: 10px;
            z-index: 2;
        }

        .coins-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 25px 0;
            padding: 30px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            border: 3px dashed #74b9ff;
            min-height: 180px;
        }

        .coin {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            position: relative;
            user-select: none;
            animation: bounce 2s ease-in-out infinite;
        }

        .coin:hover {
            transform: scale(1.2) rotate(10deg);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .coin-10 {
            background: linear-gradient(135deg, #118ab2, #06d6a0);
            border: 4px solid #073b4c;
        }

        .coin-1 {
            background: linear-gradient(135deg, #ff9e6d, #ffd166);
            border: 4px solid #ef476f;
        }

        .coin-value {
            position: absolute;
            bottom: -25px;
            font-size: 1rem;
            font-weight: bold;
            color: #073b4c;
            background: white;
            padding: 2px 8px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 35px;
            font-size: 1.3rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            font-family: inherit;
        }

        #check-btn {
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            color: #073b4c;
        }

        #new-number-btn {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            color: #073b4c;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .feedback {
            margin-top: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            min-height: 70px;
            padding: 20px;
            border-radius: 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .correct {
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            color: white;
            animation: pulse 1s infinite;
        }

        .incorrect {
            background: linear-gradient(135deg, #ef476f, #ff9e6d);
            color: white;
            animation: shake 0.5s;
        }

        .info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        .score-panel {
            font-size: 1.5rem;
            margin-top: 20px;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 15px 30px;
            border-radius: 50px;
            display: inline-block;
            color: #073b4c;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-weight: bold;
        }

        .examples {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 15px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.2rem;
            color: #073b4c;
            border: 2px solid #74b9ff;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
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
            width: 15px;
            height: 15px;
            background-color: #f00;
            opacity: 0.8;
            animation: fall linear forwards;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .houses-container {
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }

            h1 {
                font-size: 2rem;
            }

            .number-display {
                font-size: 3rem;
                padding: 15px 30px;
            }

            .house {
                width: 200px;
                height: 260px;
            }

            .coin {
                width: 70px;
                height: 70px;
                font-size: 1.6rem;
            }

            .controls {
                flex-direction: column;
                align-items: center;
            }

            button {
                width: 250px;
            }
        }

        .total-display {
            font-size: 1.3rem;
            margin: 15px 0;
            color: #073b4c;
            font-weight: bold;
            background: #dfe6e9;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏠 القسمة المنزلية</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score-panel">
            النقاط: <span id="score">0</span> | المحاولات الناجحة: <span id="success-count">0</span>
        </div>

        <div class="instructions">
            <p>مرحباً! ساعدني في وضع القطع النقدية في المنازل الصحيحة. المنزل الأزرق للعشرات والمنزل البرتقالي للآحاد.</p>
        </div>

        <div class="examples">
            <p><strong>أمثلة:</strong>
                @if($settings->max_range == 20)
                15 = 1 عشرات + 5 آحاد | 20 = 2 عشرات + 0 آحاد
                @else
                أمثلة على القسمة المنزلية ضمن {{ $settings->max_range ?? 20 }}
                @endif
            </p>
        </div>

        <div class="number-display" id="target-number">0</div>

        <div class="total-display">
            المجموع الحالي: <span id="current-total">0</span>
        </div>

        <div class="houses-container">
            <div class="house" id="tens-house">
                <div class="house-roof"></div>
                <div class="house-label">🏠 منزل العشرات</div>
                <div class="house-value" id="tens-value">0</div>
                <div class="house-description">(كل قطعة = 10)</div>
            </div>

            <div class="house" id="ones-house">
                <div class="house-roof"></div>
                <div class="house-label">🏠 منزل الآحاد</div>
                <div class="house-value" id="ones-value">0</div>
                <div class="house-description">(كل قطعة = 1)</div>
            </div>
        </div>

        <div class="coins-container" id="coins-container">
            <!-- سيتم إنشاء القطع النقدية ديناميكياً -->
        </div>

        <div class="controls">
            <button id="check-btn">✅ تحقق من الإجابة</button>
            <button id="reset-btn">🔄 إعادة المحاولة</button>
            <button id="new-number-btn">🎮 عدد جديد</button>
        </div>

        <div class="feedback" id="feedback">اختر منزلاً ثم انقر على القطعة النقدية لوضعها فيه</div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // قراءة المتغيرات من Blade
        const minRange = {{ $settings->min_range ?? 1 }};
        const maxRange = {{ $settings->max_range ?? 20 }};

        document.addEventListener('DOMContentLoaded', function() {
            const tensHouse = document.getElementById('tens-house');
            const onesHouse = document.getElementById('ones-house');
            const tensValue = document.getElementById('tens-value');
            const onesValue = document.getElementById('ones-value');
            const targetNumber = document.getElementById('target-number');
            const currentTotal = document.getElementById('current-total');
            const coinsContainer = document.getElementById('coins-container');
            const checkBtn = document.getElementById('check-btn');
            const resetBtn = document.getElementById('reset-btn');
            const newNumberBtn = document.getElementById('new-number-btn');
            const feedback = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const successCountElement = document.getElementById('success-count');
            const celebration = document.getElementById('celebration');

            let score = 0;
            let successCount = 0;
            let currentNumber = 0;
            let selectedHouse = null;
            let gameActive = true;

            // تهيئة اللعبة
            function initGame() {
                generateNewNumber();
                setupHouses();
                createCoins();
                updateFeedback();
            }

            // إنشاء عدد عشوائي جديد
            function generateNewNumber() {
                currentNumber = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                targetNumber.textContent = currentNumber;
                gameActive = true;
            }

            // إعداد المنازل
            function setupHouses() {
                const houses = [tensHouse, onesHouse];

                houses.forEach(house => {
                    house.addEventListener('click', function() {
                        if (!gameActive) return;

                        // إزالة التحديد من جميع المنازل
                        houses.forEach(h => h.classList.remove('active'));
                        // تحديد المنزل المختار
                        this.classList.add('active');
                        selectedHouse = this;
                        feedback.textContent = `تم اختيار ${this.querySelector('.house-label').textContent}! الآن اختر القطعة النقدية.`;
                        feedback.className = 'feedback info';
                    });
                });

                // إعادة تعيين القيم
                tensValue.textContent = '0';
                onesValue.textContent = '0';
                currentTotal.textContent = '0';

                // إزالة التحديد
                houses.forEach(h => h.classList.remove('active'));
                selectedHouse = null;
            }

            // إنشاء القطع النقدية
            function createCoins() {
                coinsContainer.innerHTML = '';

                // إضافة قطع العشرات (10)
                const tensCoinsCount = Math.floor(maxRange / 10);
                for (let i = 0; i < tensCoinsCount; i++) {
                    createCoin(10, 'coin-10');
                }

                // إضافة قطع الآحاد (1) - عدد كافٍ لتغطية المدى
                const onesCoinsCount = maxRange;
                for (let i = 0; i < onesCoinsCount; i++) {
                    createCoin(1, 'coin-1');
                }
            }

            // إنشاء قطعة نقدية
            function createCoin(value, className) {
                const coin = document.createElement('div');
                coin.className = `coin ${className}`;
                coin.textContent = value;
                coin.setAttribute('data-value', value);

                const valueLabel = document.createElement('div');
                valueLabel.className = 'coin-value';
                valueLabel.textContent = `${value}`;
                coin.appendChild(valueLabel);

                coin.addEventListener('click', function() {
                    if (!gameActive || !selectedHouse) {
                        feedback.textContent = 'يرجى اختيار منزل أولاً!';
                        feedback.className = 'feedback incorrect';
                        return;
                    }

                    const coinValue = parseInt(this.getAttribute('data-value'));
                    const houseType = selectedHouse.id === 'tens-house' ? 'tens' : 'ones';

                    // تحديث قيمة المنزل
                    if (houseType === 'tens') {
                        const currentTens = parseInt(tensValue.textContent);
                        const newTensValue = currentTens + coinValue;
                        const totalValue = (newTensValue * 10) + parseInt(onesValue.textContent);

                        // التحقق من عدم تجاوز العدد المستهدف
                        if (totalValue <= currentNumber) {
                            tensValue.textContent = newTensValue;
                            this.remove();
                            updateCurrentTotal();
                            feedback.textContent = `تم إضافة ${coinValue} إلى منزل العشرات`;
                            feedback.className = 'feedback info';
                        } else {
                            feedback.textContent = 'لا يمكن تجاوز العدد المستهدف!';
                            feedback.className = 'feedback incorrect';
                        }
                    } else {
                        const currentOnes = parseInt(onesValue.textContent);
                        const newOnesValue = currentOnes + coinValue;
                        const totalValue = (parseInt(tensValue.textContent) * 10) + newOnesValue;

                        // التحقق من عدم تجاوز العدد المستهدف
                        if (totalValue <= currentNumber) {
                            onesValue.textContent = newOnesValue;
                            this.remove();
                            updateCurrentTotal();
                            feedback.textContent = `تم إضافة ${coinValue} إلى منزل الآحاد`;
                            feedback.className = 'feedback info';
                        } else {
                            feedback.textContent = 'لا يمكن تجاوز العدد المستهدف!';
                            feedback.className = 'feedback incorrect';
                        }
                    }
                });

                coinsContainer.appendChild(coin);
            }

            // تحديث المجموع الحالي
            function updateCurrentTotal() {
                const tens = parseInt(tensValue.textContent);
                const ones = parseInt(onesValue.textContent);
                const total = (tens * 10) + ones;
                currentTotal.textContent = total;
            }

            // تحديث الرسالة التوجيهية
            function updateFeedback() {
                const tens = parseInt(tensValue.textContent);
                const ones = parseInt(onesValue.textContent);
                const total = (tens * 10) + ones;

                feedback.textContent = `منزل العشرات: ${tens} (${tens * 10})، منزل الآحاد: ${ones}، المجموع: ${total}`;
                feedback.className = 'feedback info';
            }

            // إنشاء تأثير الاحتفال
            function createCelebration() {
                celebration.style.display = 'block';
                const colors = ['#ff6b6b', '#ffa726', '#ffeb3b', '#4caf50', '#2196f3', '#9c27b0'];

                for (let i = 0; i < 150; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    confetti.style.width = (Math.random() * 10 + 5) + 'px';
                    confetti.style.height = (Math.random() * 10 + 5) + 'px';
                    celebration.appendChild(confetti);

                    setTimeout(() => {
                        confetti.remove();
                    }, 5000);
                }

                setTimeout(() => {
                    celebration.style.display = 'none';
                    celebration.innerHTML = '';
                }, 5000);
            }

            // زر التحقق من الإجابة
            checkBtn.addEventListener('click', function() {
                if (!gameActive) return;

                const tens = parseInt(tensValue.textContent);
                const ones = parseInt(onesValue.textContent);
                const total = (tens * 10) + ones;

                if (total === currentNumber) {
                    // الإجابة الصحيحة
                    score += 10;
                    successCount++;
                    scoreElement.textContent = score;
                    successCountElement.textContent = successCount;
                    feedback.textContent = `🎉 أحسنت! ${tens} عشرات + ${ones} آحاد = ${currentNumber}`;
                    feedback.className = 'feedback correct';

                    // تأثير الاحتفال
                    createCelebration();

                    gameActive = false;
                    setTimeout(() => {
                        initGame();
                    }, 3000);
                } else {
                    // الإجابة الخاطئة
                    feedback.textContent = `❌ ليس صحيحاً بعد! العدد المطلوب هو ${currentNumber} والمجموع الحالي هو ${total}`;
                    feedback.className = 'feedback incorrect';
                }
            });

            // زر إعادة المحاولة
            resetBtn.addEventListener('click', function() {
                if (!gameActive) return;
                setupHouses();
                createCoins();
                updateFeedback();
                feedback.textContent = 'يمكنك إعادة المحاولة';
                feedback.className = 'feedback info';
            });

            // زر عدد جديد
            newNumberBtn.addEventListener('click', initGame);

            // بدء اللعبة
            initGame();
        });
    </script>
</body>
</html>
