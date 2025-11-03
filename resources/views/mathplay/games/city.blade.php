<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدينة الأعداد العشرية - {{ $lesson_game->lesson->name }}</title>
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
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            max-width: 1200px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .lesson-title {
            color: #2d3436;
            font-size: 2.3rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .city-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .learning-district {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 25px;
            border: 3px solid #e9ecef;
        }

        .practice-plaza {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
            font-weight: bold;
            font-size: 1.4rem;
        }

        .practice-plaza .section-title {
            color: white;
        }

        .decimal-intro {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .decimal-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 25px 0;
        }

        .whole-part, .decimal-part {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .place-value {
            background: white;
            border: 3px solid;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            min-width: 80px;
        }

        .ones { border-color: #00b894; }
        .tenths { border-color: #fd79a8; }
        .hundredths { border-color: #fdcb6e; }

        .place-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .place-value .digit {
            font-size: 2rem;
            font-weight: bold;
            color: #2d3436;
        }

        .decimal-point {
            font-size: 3rem;
            font-weight: bold;
            color: #e84393;
            margin: 0 10px;
        }

        .number-line {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            position: relative;
            height: 100px;
        }

        .line {
            position: absolute;
            top: 50%;
            left: 5%;
            right: 5%;
            height: 3px;
            background: #2d3436;
        }

        .marker {
            position: absolute;
            top: 45%;
            width: 2px;
            height: 20px;
            background: #636e72;
        }

        .marker-label {
            position: absolute;
            top: 70%;
            transform: translateX(-50%);
            font-size: 0.9rem;
            color: #636e72;
        }

        .decimal-slider {
            width: 100%;
            margin: 20px 0;
        }

        .slider-value {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #e84393;
            margin: 10px 0;
        }

        .comparison-game {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .numbers-to-compare {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 25px 0;
        }

        .compare-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2d3436;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            min-width: 120px;
            text-align: center;
        }

        .comparison-options {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .compare-btn {
            padding: 15px 25px;
            border: 3px solid #a29bfe;
            border-radius: 10px;
            background: white;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .compare-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .city-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .city-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #generate-btn {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        #check-comparison-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .back-btn {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .city-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .feedback-area {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.2rem;
            font-weight: bold;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .feedback-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
        }

        .feedback-error {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
        }

        .feedback-info {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
        }

        .city-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e84393;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #636e72;
            margin-top: 5px;
        }

        .real-world-examples {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .example-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            border: 2px solid #dfe6e9;
            transition: all 0.3s ease;
        }

        .example-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .example-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .city-layout {
                grid-template-columns: 1fr;
            }
            
            .city-stats, .real-world-examples {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .numbers-to-compare {
                flex-direction: column;
                gap: 15px;
            }
            
            .comparison-options {
                flex-direction: column;
            }
            
            .city-controls {
                flex-direction: column;
            }
        }

        /* تأثيرات الرسوم المتحركة */
        @keyframes celebrate {
            0% { transform: translateY(0px); }
            25% { transform: translateY(-10px); }
            50% { transform: translateY(0px); }
            75% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        .celebrate {
            animation: celebrate 0.5s ease-in-out;
        }

        .back-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="lesson-title">🏙️ مدينة الأعداد العشرية</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="city-layout">
            <div class="learning-district">
                <div class="section-title">📚 منطقة التعلم</div>
                
                <div class="decimal-intro">
                    <h3>ما هي الأعداد العشرية؟</h3>
                    <p>العدد العشري يتكون من جزء صحيح وججز عشري مفصول بفاصلة عشرية</p>
                </div>
                
                <div class="decimal-visual">
                    <div class="whole-part">
                        <div class="place-value ones">
                            <div class="digit" id="ones-digit">3</div>
                            <div class="place-label">آحاد</div>
                        </div>
                    </div>
                    
                    <div class="decimal-point">.</div>
                    
                    <div class="decimal-part">
                        <div class="place-value tenths">
                            <div class="digit" id="tenths-digit">2</div>
                            <div class="place-label">أجزاء من عشرة</div>
                        </div>
                        <div class="place-value hundredths">
                            <div class="digit" id="hundredths-digit">5</div>
                            <div class="place-label">أجزاء من مئة</div>
                        </div>
                    </div>
                </div>
                
                <div class="number-line" id="number-line">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>
                
                <div class="real-world-examples">
                    <div class="example-card">
                        <div class="example-icon">📏</div>
                        <h5>الطول</h5>
                        <p>١٫٧٥ متر</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">⚖️</div>
                        <h5>الوزن</h5>
                        <p>٢٫٥ كيلوجرام</p>
                    </div>
                    <div class="example-card">
                        <div class="example-icon">💰</div>
                        <h5>النقود</h5>
                        <p>١٥٫٩٩ ريال</p>
                    </div>
                </div>

                <div class="back-container">
                    <a href="{{ route('mathplay.lesson', ['id' => $lesson_game->lesson_id]) }}" class="city-btn back-btn">⬅️ العودة للدرس</a>
                </div>
            </div>
            
            <div class="practice-plaza">
                <div class="section-title">🎯 ساحة التطبيق</div>
                
                <div class="comparison-game">
                    <h4 style="text-align: center; color: #2d3436; margin-bottom: 20px;">🎮 لعبة المقارنة</h4>
                    
                    <div class="numbers-to-compare">
                        <div class="compare-number" id="number-a">٠٫٠</div>
                        <div class="compare-number" id="number-b">٠٫٠</div>
                    </div>
                    
                    <div class="comparison-options">
                        <button class="compare-btn" data-operator="<">&lt;</button>
                        <button class="compare-btn" data-operator="=">=</button>
                        <button class="compare-btn" data-operator=">">&gt;</button>
                    </div>
                </div>
                
                <div class="decimal-slider">
                    <input type="range" id="decimal-slider" min="0" max="100" value="50" class="slider">
                    <div class="slider-value" id="slider-value">٠٫٥٠</div>
                </div>
                
                <div class="city-controls">
                    <button class="city-btn" id="generate-btn">
                        🎲 توليد أعداد
                    </button>
                    <button class="city-btn" id="check-comparison-btn">
                        ✅ تحقق
                    </button>
                    <button class="city-btn" id="reset-btn">
                        🔄 إعادة
                    </button>
                </div>
                
                <div class="feedback-area" id="feedback-area">
                    انقر على "توليد أعداد" للبدء!
                </div>
                
                <div class="city-stats">
                    <div class="stat-card">
                        <div class="stat-value" id="total-score">٠</div>
                        <div class="stat-label">النقاط</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="correct-answers">٠</div>
                        <div class="stat-label">إجابات صحيحة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="current-streak">٠</div>
                        <div class="stat-label">التوالي الحالي</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="accuracy">١٠٠٪</div>
                        <div class="stat-label">الدقة</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let totalScore = 0;
        let correctAnswers = 0;
        let currentStreak = 0;
        let totalAttempts = 0;
        let currentComparison = null;
        let selectedOperator = null;
        
        // عناصر DOM
        const onesDigit = document.getElementById('ones-digit');
        const tenthsDigit = document.getElementById('tenths-digit');
        const hundredthsDigit = document.getElementById('hundredths-digit');
        const numberLine = document.getElementById('number-line');
        const numberA = document.getElementById('number-a');
        const numberB = document.getElementById('number-b');
        const decimalSlider = document.getElementById('decimal-slider');
        const sliderValue = document.getElementById('slider-value');
        const generateBtn = document.getElementById('generate-btn');
        const checkComparisonBtn = document.getElementById('check-comparison-btn');
        const resetBtn = document.getElementById('reset-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const compareButtons = document.querySelectorAll('.compare-btn');
        const totalScoreElement = document.getElementById('total-score');
        const correctAnswersElement = document.getElementById('correct-answers');
        const currentStreakElement = document.getElementById('current-streak');
        const accuracyElement = document.getElementById('accuracy');
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeNumberLine();
            setupEventListeners();
            updateDecimalVisual(3.25);
            updateStats();
        });
        
        function setupEventListeners() {
            generateBtn.addEventListener('click', generateComparison);
            checkComparisonBtn.addEventListener('click', checkComparison);
            resetBtn.addEventListener('click', resetGame);
            
            // أحداث أزرار المقارنة
            compareButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    compareButtons.forEach(b => b.style.background = 'white');
                    this.style.background = '#a29bfe';
                    this.style.color = 'white';
                    selectedOperator = this.dataset.operator;
                });
            });
            
            // حدث السلايدر
            decimalSlider.addEventListener('input', function() {
                const value = this.value / 100;
                sliderValue.textContent = value.toFixed(2);
                updateDecimalVisual(value);
            });
        }
        
        function initializeNumberLine() {
            numberLine.innerHTML = '';
            
            const line = document.createElement('div');
            line.className = 'line';
            numberLine.appendChild(line);
            
            // إضافة علامات من 0 إلى 1
            for (let i = 0; i <= 10; i++) {
                const marker = document.createElement('div');
                marker.className = 'marker';
                marker.style.left = `${5 + (i * 9)}%`;
                
                const label = document.createElement('div');
                label.className = 'marker-label';
                label.textContent = (i / 10).toFixed(1);
                label.style.left = `${5 + (i * 9)}%`;
                
                numberLine.appendChild(marker);
                numberLine.appendChild(label);
            }
        }
        
        function updateDecimalVisual(number) {
            const [whole, decimal] = number.toFixed(2).split('.');
            
            onesDigit.textContent = whole;
            tenthsDigit.textContent = decimal[0];
            hundredthsDigit.textContent = decimal[1];
        }
        
        function generateComparison() {
            // توليد عددين عشريين عشوائيين
            const num1 = (Math.random() * (maxRange - minRange) + minRange).toFixed(2);
            const num2 = (Math.random() * (maxRange - minRange) + minRange).toFixed(2);
            
            currentComparison = {
                number1: parseFloat(num1),
                number2: parseFloat(num2)
            };
            
            // تحديث العرض
            numberA.textContent = num1;
            numberB.textContent = num2;
            
            // إعادة تعيين التحديد
            compareButtons.forEach(btn => {
                btn.style.background = 'white';
                btn.style.color = '#2d3436';
            });
            selectedOperator = null;
            
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'اختر علامة المقارنة الصحيحة!';
        }
        
        function checkComparison() {
            if (!currentComparison || !selectedOperator) {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = '❌ يرجى اختيار علامة المقارنة أولاً!';
                return;
            }
            
            totalAttempts++;
            
            const { number1, number2 } = currentComparison;
            let isCorrect = false;
            
            switch(selectedOperator) {
                case '<':
                    isCorrect = number1 < number2;
                    break;
                case '=':
                    isCorrect = number1 === number2;
                    break;
                case '>':
                    isCorrect = number1 > number2;
                    break;
            }
            
            if (isCorrect) {
                correctAnswers++;
                currentStreak++;
                totalScore += 10 + (currentStreak * 2);
                
                feedbackArea.className = 'feedback-area feedback-success celebrate';
                feedbackArea.textContent = `🎉 إجابة صحيحة! ${currentStreak > 1 ? `توالي ${currentStreak}!` : ''}`;
                
                // توليد مقارنة جديدة بعد ثانيتين
                setTimeout(generateComparison, 2000);
            } else {
                currentStreak = 0;
                totalScore = Math.max(0, totalScore - 5);
                
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = `❌ إجابة خاطئة! ${number1} ${getCorrectOperator(number1, number2)} ${number2}`;
            }
            
            updateStats();
        }
        
        function getCorrectOperator(num1, num2) {
            if (num1 < num2) return '<';
            if (num1 > num2) return '>';
            return '=';
        }
        
        function resetGame() {
            totalScore = 0;
            correctAnswers = 0;
            currentStreak = 0;
            totalAttempts = 0;
            currentComparison = null;
            selectedOperator = null;
            
            numberA.textContent = '٠٫٠';
            numberB.textContent = '٠٫٠';
            
            compareButtons.forEach(btn => {
                btn.style.background = 'white';
                btn.style.color = '#2d3436';
            });
            
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'انقر على "توليد أعداد" للبدء!';
            
            updateStats();
        }
        
        function updateStats() {
            totalScoreElement.textContent = totalScore;
            correctAnswersElement.textContent = correctAnswers;
            currentStreakElement.textContent = currentStreak;
            
            const accuracy = totalAttempts > 0 ? 
                Math.round((correctAnswers / totalAttempts) * 100) : 100;
            accuracyElement.textContent = `${accuracy}%`;
        }
    </script>
</body>
</html>