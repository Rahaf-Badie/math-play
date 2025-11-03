{{-- resources/views/mathplay/games/empty_parking.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚗 الموقف الفارغ - {{ $lesson_game->lesson->name ?? 'الدرس' }}</title>
    <style>
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
            margin: 0;
            padding: 20px;
            text-align: center;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #00838f;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .lesson-info {
            color: #666;
            margin-bottom: 20px;
            font-size: 18px;
            background: #e0f7fa;
            padding: 10px 15px;
            border-radius: 10px;
            border-right: 4px solid #00838f;
        }

        .game-area {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 3px solid #4db6ac;
        }

        #instruction {
            font-weight: bold;
            font-size: 22px;
            margin-bottom: 25px;
            color: #006064;
            padding: 15px;
            background: #e0f2f1;
            border-radius: 15px;
            border-right: 4px solid #00838f;
        }

        .parking {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            justify-content: center;
            margin: 30px auto;
            max-width: 500px;
        }

        .spot {
            width: 120px;
            height: 140px;
            background: linear-gradient(135deg, #b2ebf2 0%, #80deea 100%);
            border-radius: 15px;
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid transparent;
            padding: 10px;
        }

        .spot:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
            border-color: #00838f;
        }

        .spot:active {
            transform: translateY(-4px);
        }

        .car {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ff7043 0%, #f4511e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 8px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .car::after {
            content: "🚗";
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 16px;
        }

        .spot-number {
            position: absolute;
            top: 5px;
            left: 5px;
            background: #00838f;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
        }

        .empty-sign {
            font-size: 40px;
            color: #00838f;
            animation: pulse 2s infinite;
        }

        .correct {
            border: 4px solid #2e7d32;
            background: linear-gradient(135deg, #a5d6a7 0%, #4caf50 100%);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.4);
        }

        .wrong {
            border: 4px solid #d32f2f;
            background: linear-gradient(135deg, #ef9a9a 0%, #f44336 100%);
            animation: shake 0.5s ease-in-out;
        }

        #msg {
            font-size: 22px;
            font-weight: bold;
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            min-height: 30px;
        }

        .msg-correct {
            color: #2e7d32;
            background: #e8f5e9;
            border: 2px solid #4caf50;
            animation: celebrate 0.6s ease-in-out;
        }

        .msg-wrong {
            color: #d32f2f;
            background: #ffebee;
            border: 2px solid #f44336;
        }

        button {
            margin-top: 20px;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #00838f 0%, #006064 100%);
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 131, 143, 0.3);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 131, 143, 0.4);
        }

        .score {
            font-size: 18px;
            margin: 15px 0;
            color: #2c3e50;
            font-weight: bold;
            background: #e0f7fa;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .zero-concept {
            margin: 15px 0;
            padding: 10px;
            background: #fff9c4;
            border-radius: 10px;
            color: #f57f17;
            font-weight: bold;
            border-right: 3px solid #ffd54f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚗 الموقف الفارغ</h1>

        @if($lesson_game->lesson)
            <div class="lesson-info">
                🎯 الدرس: {{ $lesson_game->lesson->name }}
            </div>
        @endif

        <div class="score" id="score">النقاط: 0 | المحاولات: 0</div>

        <div class="zero-concept">
            💡 تذكر: الصفر يعني لا شيء - لا توجد سيارات!
        </div>

        <div class="game-area">
            <p id="instruction">اختر الموقف الذي يحتوي على صفر سيارات</p>

            <div class="parking" id="parking"></div>

            <div id="msg"></div>

            <button id="newGameBtn">🔄 جولة جديدة</button>
        </div>
    </div>

    <script>
        // قراءة المتغيرات من Blade (يمكن استخدامها لتحديد عدد المواقف أو الصعوبة)
        const minRange = {{ $settings->min_range ?? 0 }};
        const maxRange = {{ $settings->max_range ?? 5 }};

        const parkingEl = document.getElementById('parking');
        const msg = document.getElementById('msg');
        const newGameBtn = document.getElementById('newGameBtn');
        const scoreElement = document.getElementById('score');

        let emptySpot = 0;
        const totalSpots = 6;
        let points = 0;
        let attempts = 0;
        let gameActive = true;

        function newGame() {
            if (!gameActive) return;

            parkingEl.innerHTML = '';
            msg.textContent = '';
            msg.className = '';

            // اختيار موقف عشوائي ليكون فارغاً
            emptySpot = Math.floor(Math.random() * totalSpots);

            for (let i = 0; i < totalSpots; i++) {
                const spot = document.createElement('div');
                spot.className = 'spot';
                spot.dataset.index = i;

                // إضافة رقم الموقف
                const spotNumber = document.createElement('div');
                spotNumber.className = 'spot-number';
                spotNumber.textContent = i + 1;
                spot.appendChild(spotNumber);

                if (i !== emptySpot) {
                    // مواقف تحتوي على سيارات
                    const carCount = Math.floor(Math.random() * 3) + 1; // 1-3 سيارات

                    for (let j = 0; j < carCount; j++) {
                        const car = document.createElement('div');
                        car.className = 'car';
                        car.textContent = j + 1;
                        spot.appendChild(car);
                    }

                    // إضافة عدد السيارات
                    const countText = document.createElement('div');
                    countText.style.fontSize = '14px';
                    countText.style.color = '#006064';
                    countText.style.fontWeight = 'bold';
                    countText.textContent = `${carCount} سيارة`;
                    spot.appendChild(countText);
                } else {
                    // الموقف الفارغ
                    const emptySign = document.createElement('div');
                    emptySign.className = 'empty-sign';
                    emptySign.textContent = '🅿️';
                    spot.appendChild(emptySign);

                    const emptyText = document.createElement('div');
                    emptyText.style.fontSize = '14px';
                    emptyText.style.color = '#00838f';
                    emptyText.style.fontWeight = 'bold';
                    emptyText.textContent = 'فارغ';
                    spot.appendChild(emptyText);
                }

                spot.addEventListener('click', () => {
                    if (gameActive) {
                        checkAnswer(i, spot);
                    }
                });

                parkingEl.appendChild(spot);
            }
        }

        function checkAnswer(selectedIndex, selectedSpot) {
            if (!gameActive) return;

            attempts++;
            gameActive = false;

            // إزالة جميع الأنماط أولاً
            document.querySelectorAll('.spot').forEach(spot => {
                spot.classList.remove('correct', 'wrong');
            });

            if (selectedIndex === emptySpot) {
                // الإجابة الصحيحة
                points++;
                selectedSpot.classList.add('correct');
                msg.textContent = getSuccessMessage();
                msg.className = 'msg-correct';

                // تحديث النقاط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // الانتقال التلقائي بعد ثانية
                setTimeout(() => {
                    gameActive = true;
                    newGame();
                }, 1500);
            } else {
                // الإجابة الخاطئة
                selectedSpot.classList.add('wrong');
                msg.textContent = getErrorMessage();
                msg.className = 'msg-wrong';

                // إظهار الإجابة الصحيحة
                const correctSpot = document.querySelector(`.spot[data-index="${emptySpot}"]`);
                correctSpot.classList.add('correct');

                // تحديث المحاولات فقط
                scoreElement.textContent = `النقاط: ${points} | المحاولات: ${attempts}`;

                // إعادة تفعيل اللعبة بعد ثانيتين
                setTimeout(() => {
                    gameActive = true;
                    newGame();
                }, 2000);
            }
        }

        function getSuccessMessage() {
            const messages = [
                "🎉 أحسنت! هذا الموقف فارغ تماماً",
                "👏 رائع! لقد فهمت معنى الصفر",
                "💫 إبداع! الصفر يعني لا شيء",
                "🌟 برافو! وجدت الموقف الفارغ"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        function getErrorMessage() {
            const messages = [
                "😅 ليس صحيحًا! هذا الموقف به سيارات",
                "❌ خطأ! ابحث عن الموقف الفارغ",
                "💡 تذكر: الصفر يعني لا توجد سيارات",
                "🔄 ركز أكثر في البحث عن الصفر"
            ];
            return messages[Math.floor(Math.random() * messages.length)];
        }

        newGameBtn.addEventListener('click', () => {
            if (gameActive) {
                newGame();
            }
        });

        // بدء اللعبة
        newGame();
    </script>
</body>
</html>
