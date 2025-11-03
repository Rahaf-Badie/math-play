{{-- resources/views/mathplay/games/colored_balls.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 الكرات الملونة - {{ $lesson_game->lesson->name ?? 'مكونات العدد' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Noto Kufi Arabic', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
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

        .game-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            margin: 30px 0;
        }

        .target {
            font-size: 3.5rem;
            font-weight: bold;
            color: #073b4c;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 20px 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 5px solid #ef476f;
        }

        .baskets-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .basket {
            width: 220px;
            height: 280px;
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border: 5px solid #073b4c;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .basket:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .basket.selected {
            border-color: #ff6b6b;
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.4);
        }

        .basket::before {
            content: "";
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            height: 40px;
            background: linear-gradient(135deg, #ff9e6d, #ffd166);
            border-radius: 50%;
            z-index: 1;
        }

        .basket-label {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 15px;
            z-index: 2;
        }

        .basket-count {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            margin: 15px 0;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .basket-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            max-width: 100%;
            min-height: 80px;
            z-index: 2;
        }

        .balls-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            padding: 30px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            border: 3px dashed #74b9ff;
            min-height: 200px;
        }

        .ball {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
            color: white;
            animation: bounce 2s infinite;
            position: relative;
            user-select: none;
        }

        .ball:hover {
            transform: scale(1.2) rotate(5deg);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .ball-1 {
            background: linear-gradient(135deg, #ff6b6b, #ff9e6d);
            animation-delay: 0s;
        }

        .ball-2 {
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            animation-delay: 0.2s;
            color: #073b4c;
        }

        .ball-3 {
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            animation-delay: 0.4s;
        }

        .ball-4 {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            animation-delay: 0.6s;
            color: #073b4c;
        }

        .ball-5 {
            background: linear-gradient(135deg, #fd79a8, #e84393);
            animation-delay: 0.8s;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
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

        #new-game-btn {
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

        @media (max-width: 768px) {
            .baskets-container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .target {
                font-size: 2.5rem;
                padding: 15px 30px;
            }

            .ball {
                width: 60px;
                height: 60px;
                font-size: 1.3rem;
            }
        }

        .total-display {
            font-size: 1.3rem;
            margin: 10px 0;
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
        <h1>🎯 الكرات الملونة</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score-panel">
            النقاط: <span id="score">0</span> | المحاولات الناجحة: <span id="success-count">0</span>
        </div>

        <div class="instructions">
            <p>مرحباً! ضع الكرات في السلال بحيث يكون مجموع الكرات في السلتين معاً يساوي {{ $settings->max_range ?? 20 }}</p>
        </div>

        <div class="examples">
            <p><strong>أمثلة:</strong>
                {{ $settings->max_range ?? 20 }} = 13 + 7 |
                {{ $settings->max_range ?? 20 }} = 8 + 12 |
                {{ $settings->max_range ?? 20 }} = 19 + 1
            </p>
        </div>

        <div class="game-area">
            <div class="target">{{ $settings->max_range ?? 20 }}</div>

            <div class="baskets-container">
                <div class="basket" id="basket1">
                    <div class="basket-label">السلة الأولى</div>
                    <div class="basket-count" id="count1">0</div>
                    <div class="basket-content" id="basket1-content"></div>
                </div>

                <div class="basket" id="basket2">
                    <div class="basket-label">السلة الثانية</div>
                    <div class="basket-count" id="count2">0</div>
                    <div class="basket-content" id="basket2-content"></div>
                </div>
            </div>

            <div class="total-display">
                المجموع الكلي: <span id="total-count">0</span> / {{ $settings->max_range ?? 20 }}
            </div>
        </div>

        <div class="balls-container" id="balls-pool">
            <!-- سيتم إنشاء الكرات ديناميكياً -->
        </div>

        <div class="controls">
            <button id="check-btn">✅ تحقق من الإجابة</button>
            <button id="reset-btn">🔄 إعادة المحاولة</button>
            <button id="new-game-btn">🎮 لعبة جديدة</button>
        </div>

        <div class="feedback" id="feedback">اختر سلة ثم انقر على الكرات لوضعها فيها</div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const targetNumber = {{ $settings->max_range ?? 20 }};
        const minRange = {{ $settings->min_range ?? 1 }};

        document.addEventListener('DOMContentLoaded', function() {
            const basket1 = document.getElementById('basket1');
            const basket2 = document.getElementById('basket2');
            const count1 = document.getElementById('count1');
            const count2 = document.getElementById('count2');
            const basket1Content = document.getElementById('basket1-content');
            const basket2Content = document.getElementById('basket2-content');
            const ballsPool = document.getElementById('balls-pool');
            const checkBtn = document.getElementById('check-btn');
            const resetBtn = document.getElementById('reset-btn');
            const newGameBtn = document.getElementById('new-game-btn');
            const feedback = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const successCountElement = document.getElementById('success-count');
            const totalCountElement = document.getElementById('total-count');

            let score = 0;
            let successCount = 0;
            let currentBasket1Count = 0;
            let currentBasket2Count = 0;
            let selectedBasket = null;
            let balls = [];

            // تهيئة اللعبة
            function initGame() {
                createBalls();
                setupBaskets();
                updateFeedback();
            }

            // إنشاء الكرات
            function createBalls() {
                ballsPool.innerHTML = '';
                balls = [];

                // إنشاء كرات بأرقام من 1 إلى targetNumber-1
                for (let i = 1; i < targetNumber; i++) {
                    const ball = document.createElement('div');
                    ball.className = `ball ball-${(i % 5) + 1}`;
                    ball.setAttribute('data-value', i.toString());
                    ball.textContent = i;
                    ball.addEventListener('click', handleBallClick);
                    ballsPool.appendChild(ball);
                    balls.push(ball);
                }
            }

            // إعداد السلال
            function setupBaskets() {
                const baskets = [basket1, basket2];

                baskets.forEach(basket => {
                    basket.addEventListener('click', function() {
                        // إزالة التحديد من جميع السلال
                        baskets.forEach(b => b.classList.remove('selected'));
                        // تحديد السلة المختارة
                        this.classList.add('selected');
                        selectedBasket = this;
                        feedback.textContent = `تم اختيار ${this.querySelector('.basket-label').textContent}! الآن اختر الكرة.`;
                        feedback.className = 'feedback info';
                    });
                });

                // إعادة تعيين المحتويات
                basket1Content.innerHTML = '';
                basket2Content.innerHTML = '';
                count1.textContent = '0';
                count2.textContent = '0';
                currentBasket1Count = 0;
                currentBasket2Count = 0;
                selectedBasket = null;
            }

            // التعامل مع النقر على الكرة
            function handleBallClick() {
                if (!selectedBasket) {
                    feedback.textContent = 'يرجى اختيار سلة أولاً!';
                    feedback.className = 'feedback incorrect';
                    return;
                }

                const ballValue = parseInt(this.getAttribute('data-value'));
                const basketId = selectedBasket.id;
                const basketContent = selectedBasket.querySelector('.basket-content');
                const basketCount = selectedBasket.querySelector('.basket-count');

                let currentCount = basketId === 'basket1' ? currentBasket1Count : currentBasket2Count;

                // التحقق من عدم تجاوز الحد الأقصى للسلة
                if (currentCount + ballValue > targetNumber) {
                    feedback.textContent = `لا يمكن أن يتجاوز العدد ${targetNumber} في السلة!`;
                    feedback.className = 'feedback incorrect';
                    return;
                }

                // إضافة الكرة إلى السلة
                const ballClone = this.cloneNode(true);
                ballClone.style.animation = 'none';
                ballClone.style.transform = 'scale(0.8)';
                ballClone.addEventListener('click', function() {
                    returnBallToPool(this, basketId);
                });

                basketContent.appendChild(ballClone);

                // تحديث العدد
                if (basketId === 'basket1') {
                    currentBasket1Count += ballValue;
                    count1.textContent = currentBasket1Count;
                } else {
                    currentBasket2Count += ballValue;
                    count2.textContent = currentBasket2Count;
                }

                // إزالة الكرة من المجموعة
                this.remove();

                updateFeedback();
            }

            // إعادة الكرة إلى المجموعة
            function returnBallToPool(ball, basketId) {
                const ballValue = parseInt(ball.getAttribute('data-value'));

                // تحديث العدد
                if (basketId === 'basket1') {
                    currentBasket1Count -= ballValue;
                    count1.textContent = currentBasket1Count;
                } else {
                    currentBasket2Count -= ballValue;
                    count2.textContent = currentBasket2Count;
                }

                // إعادة الكرة إلى المجموعة
                const newBall = ball.cloneNode(true);
                newBall.style.animation = '';
                newBall.style.transform = '';
                newBall.addEventListener('click', handleBallClick);
                ballsPool.appendChild(newBall);

                // إزالة الكرة من السلة
                ball.remove();
                updateFeedback();
            }

            // تحديث الرسالة التوجيهية
            function updateFeedback() {
                const total = currentBasket1Count + currentBasket2Count;
                totalCountElement.textContent = total;

                if (total === targetNumber) {
                    feedback.textContent = `ممتاز! الآن اضغط على زر "تحقق من الإجابة"`;
                    feedback.className = 'feedback info';
                } else {
                    feedback.textContent = `السلة الأولى: ${currentBasket1Count}، السلة الثانية: ${currentBasket2Count}، المجموع: ${total}`;
                    feedback.className = 'feedback';
                }
            }

            // زر التحقق من الإجابة
            checkBtn.addEventListener('click', function() {
                const total = currentBasket1Count + currentBasket2Count;

                if (total === targetNumber) {
                    score += 10;
                    successCount++;
                    scoreElement.textContent = score;
                    successCountElement.textContent = successCount;
                    feedback.textContent = `🎉 أحسنت! ${currentBasket1Count} + ${currentBasket2Count} = ${targetNumber}`;
                    feedback.className = 'feedback correct';

                    setTimeout(() => {
                        initGame();
                    }, 2000);
                } else {
                    feedback.textContent = `❌ ليس صحيحاً بعد. ${currentBasket1Count} + ${currentBasket2Count} = ${total} وليس ${targetNumber}`;
                    feedback.className = 'feedback incorrect';
                }
            });

            // زر إعادة المحاولة
            resetBtn.addEventListener('click', initGame);

            // زر لعبة جديدة
            newGameBtn.addEventListener('click', initGame);

            // بدء اللعبة
            initGame();
        });
    </script>
</body>
</html>
