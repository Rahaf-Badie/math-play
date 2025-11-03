{{-- resources/views/mathplay/games/apples.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍎 مكونات العدد {{ $settings->max_range ?? 10 }} - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Noto Kufi Arabic', 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            max-width: 900px;
            width: 100%;
            color: #333;
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
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-size: 1.3rem;
            line-height: 1.6;
            color: #2d3436;
            border: 3px solid #fdcb6e;
            font-weight: bold;
        }

        .game-area {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin: 25px 0;
        }

        .basket {
            width: 220px;
            height: 220px;
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
            border: 5px dashed #0984e3;
            transition: all 0.3s;
            position: relative;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .basket::before {
            content: "السلة";
            position: absolute;
            top: -15px;
            background: #0984e3;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1rem;
        }

        .basket.active {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            border-color: #6c5ce7;
            transform: scale(1.05);
        }

        .basket-sum {
            position: absolute;
            bottom: -15px;
            background: #00b894;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .fruit-pool {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            border: 3px dashed #ddd;
        }

        .fruit {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            margin: 5px;
            transition: all 0.3s;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            user-select: none;
        }

        .fruit:hover {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .fruit-value {
            position: absolute;
            top: -8px;
            left: -8px;
            background: #ffd32a;
            color: #333;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .apple {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
        }

        .banana {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            color: #333;
        }

        .orange {
            background: linear-gradient(135deg, #fd9644 0%, #fa8231 100%);
            color: white;
        }

        .grape {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .strawberry {
            background: linear-gradient(135deg, #ff7675 0%, #fd79a8 100%);
            color: white;
        }

        .watermelon {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .pineapple {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .cherry {
            background: linear-gradient(135deg, #e84393 0%, #fd79a8 100%);
            color: white;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 30px;
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
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #e17055 0%, #d63031 100%);
            color: white;
        }

        #new-game-btn {
            background: linear-gradient(135deg, #0984e3 0%, #6c5ce7 100%);
            color: white;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.5rem;
            font-weight: bold;
            min-height: 60px;
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s;
        }

        .correct {
            background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);
            color: white;
            animation: celebrate 0.6s ease-in-out;
        }

        .incorrect {
            background: linear-gradient(135deg, #fab1a0 0%, #e17055 100%);
            color: white;
        }

        .info {
            background: linear-gradient(135deg, #81ecec 0%, #00cec9 100%);
            color: white;
        }

        .score-panel {
            font-size: 1.4rem;
            margin-top: 20px;
            background: linear-gradient(135deg, #dfe6e9 0%, #b2bec3 100%);
            padding: 15px 30px;
            border-radius: 50px;
            display: inline-block;
            color: #2d3436;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .bouncing {
            animation: bounce 2s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .game-area {
                flex-direction: column;
                align-items: center;
            }

            .basket {
                width: 180px;
                height: 180px;
            }

            h1 {
                font-size: 2rem;
            }

            .fruit {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        .target-number {
            font-size: 2rem;
            font-weight: bold;
            color: #ff6b6b;
            margin: 10px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🍎 مكونات العدد <span class="target-number">{{ $settings->max_range ?? 10 }}</span></h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="instructions">
            <p>مرحباً! ساعدني في جمع الفواكه في السلال بحيث يكون مجموع الفواكه في كل سلة يساوي {{ $settings->max_range ?? 10 }}</p>
        </div>

        <div class="game-area">
            <div class="basket" id="basket1">
                <div class="basket-sum" id="basket1-sum">0</div>
            </div>
            <div class="basket" id="basket2">
                <div class="basket-sum" id="basket2-sum">0</div>
            </div>
        </div>

        <div class="fruit-pool" id="fruit-pool">
            <!-- سيتم توليد الفواكه ديناميكياً -->
        </div>

        <div class="controls">
            <button id="check-btn">✅ تحقق من الإجابة</button>
            <button id="reset-btn">🔄 إعادة المحاولة</button>
            <button id="new-game-btn">🎮 جولة جديدة</button>
        </div>

        <div class="feedback" id="feedback">اختر سلة ثم انقر على الفواكه لوضعها فيها</div>

        <div class="score-panel">
            النقاط: <span id="score">0</span> | المحاولات الناجحة: <span id="success-count">0</span>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade
        const targetNumber = {{ $settings->max_range ?? 10 }};
        const minRange = {{ $settings->min_range ?? 1 }};

        document.addEventListener('DOMContentLoaded', function() {
            const basket1 = document.getElementById('basket1');
            const basket2 = document.getElementById('basket2');
            const basket1Sum = document.getElementById('basket1-sum');
            const basket2Sum = document.getElementById('basket2-sum');
            const fruitPool = document.getElementById('fruit-pool');
            const checkBtn = document.getElementById('check-btn');
            const resetBtn = document.getElementById('reset-btn');
            const newGameBtn = document.getElementById('new-game-btn');
            const feedback = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const successCountElement = document.getElementById('success-count');

            let score = 0;
            let successCount = 0;
            let selectedBasket = null;
            let currentFruits = [];

            // أنواع الفواكه وألوانها
            const fruitTypes = [
                { class: 'apple', emoji: '🍎' },
                { class: 'banana', emoji: '🍌' },
                { class: 'orange', emoji: '🍊' },
                { class: 'grape', emoji: '🍇' },
                { class: 'strawberry', emoji: '🍓' },
                { class: 'watermelon', emoji: '🍉' },
                { class: 'pineapple', emoji: '🍍' },
                { class: 'cherry', emoji: '🍒' }
            ];

            // تهيئة اللعبة
            function initGame() {
                generateFruits();
                setupBaskets();
                updateFeedback();
            }

            // توليد الفواكه بأرقام عشوائية
            function generateFruits() {
                fruitPool.innerHTML = '';
                currentFruits = [];

                // توليد أرقام عشوائية مجموعها يساوي العدد المستهدف
                let remaining = targetNumber;
                const numbers = [];

                while (remaining > 0) {
                    const num = Math.floor(Math.random() * Math.min(6, remaining)) + 1;
                    numbers.push(num);
                    remaining -= num;
                }

                // إضافة أرقام إضافية للتنوع
                const extraNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9].filter(n => !numbers.includes(n));
                const shuffledExtras = extraNumbers.sort(() => Math.random() - 0.5).slice(0, 4);

                const allNumbers = [...numbers, ...shuffledExtras].sort(() => Math.random() - 0.5);

                allNumbers.forEach((number, index) => {
                    const fruitType = fruitTypes[index % fruitTypes.length];
                    const fruit = document.createElement('div');
                    fruit.className = `fruit ${fruitType.class} bouncing`;
                    fruit.innerHTML = `${fruitType.emoji}<div class="fruit-value">${number}</div>`;
                    fruit.setAttribute('data-value', number);

                    fruit.addEventListener('click', function() {
                        if (!selectedBasket) {
                            showFeedback('يرجى اختيار سلة أولاً!', 'incorrect');
                            return;
                        }

                        moveFruitToBasket(this);
                    });

                    fruitPool.appendChild(fruit);
                    currentFruits.push({ element: fruit, value: number });
                });
            }

            // إعداد السلال
            function setupBaskets() {
                const baskets = [basket1, basket2];

                baskets.forEach(basket => {
                    basket.innerHTML = '<div class="basket-sum">0</div>';
                    basket.addEventListener('click', function() {
                        baskets.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        selectedBasket = this;
                        showFeedback(`السلة ${this.id === 'basket1' ? 'الأولى' : 'الثانية'} محددة`, 'info');
                    });
                });

                // إزالة التحديد الأولي
                baskets.forEach(b => b.classList.remove('active'));
                selectedBasket = null;
            }

            // نقل الفاكهة إلى السلة
            function moveFruitToBasket(fruit) {
                const fruitValue = parseInt(fruit.getAttribute('data-value'));
                const basketSumElement = selectedBasket.querySelector('.basket-sum');
                const currentSum = parseInt(basketSumElement.textContent);
                const newSum = currentSum + fruitValue;

                if (newSum > targetNumber) {
                    showFeedback(`لا يمكن إضافة ${fruitValue} - سيتجاوز المجموع ${targetNumber}!`, 'incorrect');
                    return;
                }

                const newFruit = fruit.cloneNode(true);
                newFruit.classList.remove('bouncing');
                newFruit.addEventListener('click', function() {
                    returnFruitToPool(this);
                });

                selectedBasket.appendChild(newFruit);
                fruit.remove();

                basketSumElement.textContent = newSum;
                updateFeedback();
            }

            // إعادة الفاكهة إلى المجموعة
            function returnFruitToPool(fruit) {
                const fruitValue = parseInt(fruit.getAttribute('data-value'));
                const basketSumElement = fruit.parentElement.querySelector('.basket-sum');
                const currentSum = parseInt(basketSumElement.textContent);

                basketSumElement.textContent = currentSum - fruitValue;

                const newFruit = fruit.cloneNode(true);
                newFruit.classList.add('bouncing');
                newFruit.addEventListener('click', function() {
                    if (!selectedBasket) {
                        showFeedback('يرجى اختيار سلة أولاً!', 'incorrect');
                        return;
                    }
                    moveFruitToBasket(this);
                });

                fruitPool.appendChild(newFruit);
                fruit.remove();
                updateFeedback();
            }

            // تحديث الرسالة التوجيهية
            function updateFeedback() {
                const basket1Sum = parseInt(basket1Sum.textContent);
                const basket2Sum = parseInt(basket2Sum.textContent);
                const totalSum = basket1Sum + basket2Sum;

                if (totalSum === targetNumber) {
                    showFeedback('ممتاز! الآن اضغط على زر "تحقق من الإجابة"', 'info');
                } else {
                    showFeedback(`اجمع الفواكه بحيث يكون المجموع ${targetNumber}. السلة الأولى: ${basket1Sum}، السلة الثانية: ${basket2Sum}`, 'info');
                }
            }

            // عرض الرسائل
            function showFeedback(message, type) {
                feedback.textContent = message;
                feedback.className = 'feedback ' + type;
            }

            // زر التحقق من الإجابة
            checkBtn.addEventListener('click', function() {
                const basket1Sum = parseInt(basket1Sum.textContent);
                const basket2Sum = parseInt(basket2Sum.textContent);
                const totalSum = basket1Sum + basket2Sum;

                if (totalSum === targetNumber) {
                    score += 10;
                    successCount++;
                    scoreElement.textContent = score;
                    successCountElement.textContent = successCount;
                    showFeedback(`🎉 أحسنت! لقد نجحت في جمع العدد ${targetNumber} بشكل صحيح!`, 'correct');

                    setTimeout(() => {
                        resetGame();
                        initGame();
                    }, 2000);
                } else {
                    showFeedback(`ليس صحيحاً بعد. المجموع الحالي: ${totalSum}، المطلوب: ${targetNumber}`, 'incorrect');
                }
            });

            // زر إعادة المحاولة
            resetBtn.addEventListener('click', resetGame);

            // زر جولة جديدة
            newGameBtn.addEventListener('click', function() {
                resetGame();
                initGame();
            });

            // إعادة تعيين اللعبة
            function resetGame() {
                // إزالة جميع الفواكه من السلال
                [basket1, basket2].forEach(basket => {
                    const fruitsInBasket = basket.querySelectorAll('.fruit');
                    fruitsInBasket.forEach(fruit => fruit.remove());
                    basket.querySelector('.basket-sum').textContent = '0';
                });

                // إعادة تعيين السلة المحددة
                [basket1, basket2].forEach(b => b.classList.remove('active'));
                selectedBasket = null;

                showFeedback('اختر سلة ثم انقر على الفواكه لوضعها فيها', 'info');
            }

            // بدء اللعبة
            initGame();
        });
    </script>
</body>
</html>
