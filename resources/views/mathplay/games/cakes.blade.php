<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مطابقة كعكات الكسور - {{ $lesson_game->lesson->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            direction: rtl;
            text-align: center;
        }

        .container {
            background-color: #fff;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 800px;
            border: 3px solid #e67e22;
        }

        .lesson-info {
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 1em;
        }

        h1 {
            color: #e67e22;
            margin-bottom: 10px;
            font-size: 1.8em;
        }

        .instructions {
            background: linear-gradient(135deg, #fef5e7 0%, #fcebcf 100%);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 3px solid #e67e22;
            font-size: 1em;
        }

        .game-area {
            padding: 20px;
            background: linear-gradient(135deg, #fffaf0 0%, #fff5e6 100%);
            border-radius: 15px;
            margin-bottom: 20px;
            border: 2px solid #e67e22;
        }

        .cake-display {
            font-size: 3em;
            margin: 15px 0;
            animation: wobble 3s ease-in-out infinite;
        }

        @keyframes wobble {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(5deg); }
            75% { transform: rotate(-5deg); }
        }

        .matching-game {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .cake-card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            border: 3px solid #8e44ad;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .cake-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .cake-card.selected {
            border-color: #27ae60;
            background: #e8f5e9;
            transform: scale(1.05);
        }

        .cake-card.matched {
            border-color: #27ae60;
            background: #d4edda;
            animation: celebrate 0.6s ease;
        }

        .cake-visual {
            width: 100px;
            height: 100px;
            margin: 0 auto 10px;
            position: relative;
            background: #f39c12;
            border-radius: 50%;
            overflow: hidden;
        }

        .cake-slice {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #e74c3c;
            clip-path: polygon(50% 50%, 50% 0%, 100% 0%, 100% 100%, 50% 100%);
            transform-origin: center;
        }

        .fraction-text {
            font-size: 1.3em;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 5px;
        }

        .game-status {
            margin: 20px 0;
            font-size: 1.2em;
            font-weight: bold;
            color: #2c3e50;
        }

        .feedback {
            margin-top: 15px;
            font-size: 1.1em;
            font-weight: bold;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
        }

        #score {
            font-size: 2em;
            color: #e67e22;
            font-weight: bold;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background-color: #ddd;
            border-radius: 5px;
            margin: 15px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 20px;
            font-size: 1em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        #next-btn {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @media (max-width: 768px) {
            .matching-game {
                grid-template-columns: 1fr;
            }
            
            .cake-visual {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>🎂 مطابقة كعكات الكسور</h1>
        
        <div class="instructions">
            <p>🎯 ابحث عن الكسور المتساوية</p>
            <p>💡 انقر على كعكتين لهما نفس القيمة</p>
        </div>

        <div class="game-area">
            <div class="cake-display">🎂</div>

            <div class="game-status" id="game-status">
                ابحث عن زوج من الكسور المتساوية
            </div>

            <div class="matching-game" id="matching-game">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <div class="feedback" id="feedback">
                اختر كعكتين لهما نفس قيمة الكسر!
            </div>

            <div class="controls">
                <button id="next-btn">🔄 جولة جديدة</button>
                <button id="hint-btn">💡 مساعدة</button>
            </div>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>المطابقات الصحيحة: <span id="correct-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript لمطابقة كعكات الكسور ===
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 8 }};
        
        let score = 0;
        let correctMatches = 0;
        let selectedCards = [];
        let matchedPairs = 0;
        let totalPairs = 0;
        let cakeFractions = [];

        function generateCakeFractions() {
            cakeFractions = [];
            selectedCards = [];
            matchedPairs = 0;
            
            // توليد 3 أزواج من الكسور المتساوية
            const pairs = [];
            for (let i = 0; i < 3; i++) {
                const denominator = [2, 3, 4, 5, 6, 8][Math.floor(Math.random() * 6)];
                const numerator = Math.floor(Math.random() * (denominator - 1)) + 1;
                
                // إنشاء كسر مكافئ
                const equivalentNumerator = numerator * 2;
                const equivalentDenominator = denominator * 2;
                
                pairs.push([
                    { numerator, denominator },
                    { numerator: equivalentNumerator, denominator: equivalentDenominator }
                ]);
            }
            
            // خلط الكسور
            const allFractions = pairs.flat();
            allFractions.sort(() => Math.random() - 0.5);
            cakeFractions = allFractions;
            totalPairs = pairs.length;

            createCakeCards();
            
            document.getElementById('feedback').textContent = 'ابحث عن الكسور المتساوية!';
            document.getElementById('feedback').style.background = '#f8f9fa';
            document.getElementById('game-status').textContent = `ابحث عن ${totalPairs} أزواج من الكسور المتساوية`;
        }

        function createCakeCards() {
            const matchingGame = document.getElementById('matching-game');
            matchingGame.innerHTML = '';
            
            cakeFractions.forEach((fraction, index) => {
                const card = document.createElement('div');
                card.className = 'cake-card';
                card.dataset.index = index;
                card.dataset.value = fraction.numerator / fraction.denominator;
                
                card.innerHTML = `
                    <div class="cake-visual" id="cake-${index}">
                        <!-- سيتم إضافة شرائح الكعك ديناميكياً -->
                    </div>
                    <div class="fraction-text">${fraction.numerator}/${fraction.denominator}</div>
                `;
                
                card.addEventListener('click', () => selectCard(card, index));
                matchingGame.appendChild(card);
                
                // إنشاء التمثيل البصري للكسر
                createCakeVisual(index, fraction.numerator, fraction.denominator);
            });
        }

        function createCakeVisual(index, numerator, denominator) {
            const cake = document.getElementById(`cake-${index}`);
            cake.innerHTML = '';
            
            // إضافة شرائح الكعك
            for (let i = 0; i < denominator; i++) {
                const slice = document.createElement('div');
                slice.className = 'cake-slice';
                slice.style.transform = `rotate(${i * (360 / denominator)}deg)`;
                
                // تلوين الشرائح حسب قيمة الكسر
                if (i < numerator) {
                    slice.style.background = '#e74c3c'; // لون الشرائح المملوءة
                } else {
                    slice.style.background = '#f39c12'; // لون الشرائح الفارغة
                }
                
                cake.appendChild(slice);
            }
        }

        function selectCard(card, index) {
            // إذا كانت البطاقة already matched أو selected
            if (card.classList.contains('matched') || card.classList.contains('selected')) {
                return;
            }
            
            // إضافة البطاقة للمحددات
            card.classList.add('selected');
            selectedCards.push({ card, index, value: parseFloat(card.dataset.value) });
            
            if (selectedCards.length === 2) {
                checkMatch();
            }
        }

        function checkMatch() {
            const [card1, card2] = selectedCards;
            const isMatch = Math.abs(card1.value - card2.value) < 0.001; // مقارنة مع هامش خطأ صغير
            
            if (isMatch) {
                // تطابق صحيح
                card1.card.classList.add('matched');
                card2.card.classList.add('matched');
                
                document.getElementById('feedback').innerHTML = 
                    `🎉 أحسنت! ${getFractionText(card1.index)} = ${getFractionText(card2.index)}`;
                document.getElementById('feedback').style.background = '#d4edda';
                
                score += 15;
                correctMatches++;
                matchedPairs++;
                
                // تحديث حالة اللعبة
                document.getElementById('game-status').textContent = 
                    `بقى ${totalPairs - matchedPairs} أزواج للعثور عليها`;
                
                if (matchedPairs === totalPairs) {
                    document.getElementById('feedback').innerHTML = 
                        `🎊 مبروك! أكملت جميع المطابقات!`;
                    document.getElementById('feedback').style.background = '#d4edda';
                }
            } else {
                // عدم تطابق
                document.getElementById('feedback').innerHTML = 
                    `❌ ليسا متساويين! حاول مرة أخرى`;
                document.getElementById('feedback').style.background = '#f8d7da';
                score = Math.max(0, score - 5);
                
                // إزالة التحديد بعد فترة
                setTimeout(() => {
                    card1.card.classList.remove('selected');
                    card2.card.classList.remove('selected');
                }, 1000);
            }
            
            // مسح المحددات
            setTimeout(() => {
                selectedCards = [];
            }, 1000);
            
            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctMatches;
            updateProgress();
        }

        function getFractionText(index) {
            const fraction = cakeFractions[index];
            return `${fraction.numerator}/${fraction.denominator}`;
        }

        function showHint() {
            // إظهار تلميح عن زوج غير مكتشف
            const unmatchedCards = Array.from(document.querySelectorAll('.cake-card:not(.matched)'));
            if (unmatchedCards.length >= 2) {
                // إيجاد زوج متطابق
                const values = {};
                unmatchedCards.forEach(card => {
                    const value = card.dataset.value;
                    if (!values[value]) {
                        values[value] = [];
                    }
                    values[value].push(card);
                });
                
                // إيجاد زوج له بطاقتين أو أكثر
                for (const value in values) {
                    if (values[value].length >= 2) {
                        values[value][0].style.border = '3px dashed #3498db';
                        values[value][1].style.border = '3px dashed #3498db';
                        
                        setTimeout(() => {
                            values[value][0].style.border = '';
                            values[value][1].style.border = '';
                        }, 2000);
                        
                        document.getElementById('feedback').textContent = 'انظر إلى البطاقات المحددة!';
                        document.getElementById('feedback').style.background = '#d1ecf1';
                        break;
                    }
                }
            }
        }

        function updateProgress() {
            const progress = totalPairs > 0 ? (matchedPairs / totalPairs) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        // إعداد event listeners
        document.getElementById('next-btn').addEventListener('click', generateCakeFractions);
        document.getElementById('hint-btn').addEventListener('click', showHint);

        // بدء اللعبة
        generateCakeFractions();
    </script>
</body>
</html>