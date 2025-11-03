<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصنع المضاعفات - {{ $lesson_game->lesson->name }}</title>
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
            max-width: 1000px;
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

        .factory-dashboard {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .control-panel {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 25px;
            border: 3px solid #e9ecef;
        }

        .production-line {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
        }

        .panel-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
            font-weight: bold;
            font-size: 1.4rem;
        }

        .production-line .panel-title {
            color: white;
        }

        .number-selector {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .number-btn {
            background: white;
            border: 3px solid #a29bfe;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #2d3436;
        }

        .number-btn:hover {
            transform: translateY(-5px);
            border-color: #6c5ce7;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .number-btn.active {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white;
            border-color: #6c5ce7;
        }

        .multiplication-display {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }

        .multiplication-formula {
            font-size: 2.5rem;
            font-weight: bold;
            color: #e84393;
            margin: 15px 0;
        }

        .multiplication-explanation {
            font-size: 1.2rem;
            color: #636e72;
            line-height: 1.6;
        }

        .multiples-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin: 25px 0;
        }

        .multiple-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .multiple-card.correct {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            border-color: #00b894;
        }

        .multiple-card.wrong {
            background: linear-gradient(135deg, #ff7675 0%, #e84393 100%);
            color: white;
            border-color: #ff7675;
        }

        .multiple-card.neutral {
            background: white;
            color: #2d3436;
            border-color: #dfe6e9;
        }

        .factory-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 25px 0;
        }

        .factory-btn {
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

        #check-btn {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            color: white;
        }

        .factory-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .factory-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
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

        .factory-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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

        .visual-multiples {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
        }

        .visual-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 10px;
        }

        .group-items {
            display: flex;
            gap: 5px;
            margin: 5px 0;
        }

        .visual-item {
            width: 25px;
            height: 25px;
            background: #ffeaa7;
            border-radius: 50%;
            border: 2px solid #fdcb6e;
        }

        .group-label {
            font-size: 0.9rem;
            color: #ffeaa7;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .factory-dashboard {
                grid-template-columns: 1fr;
            }
            
            .number-selector, .multiples-grid, .factory-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .factory-controls {
                flex-direction: column;
            }
        }

        /* تأثيرات الرسوم المتحركة */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

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

        .pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="lesson-title">🏭 مصنع المضاعفات</h1>
            <p style="color: #636e72;">{{ $lesson_game->lesson->name }}</p>
        </div>
        
        <div class="factory-dashboard">
            <div class="control-panel">
                <div class="panel-title">🎛 لوحة التحكم</div>
                
                <div class="multiplication-display">
                    <h3>ما هي المضاعفات؟</h3>
                    <p class="multiplication-explanation">
                        مضاعفات العدد هي ناتج ضربه في الأعداد 1، 2، 3، ...
                    </p>
                    <div class="multiplication-formula" id="current-formula">
                        اختر عدداً لبدء المصنع
                    </div>
                </div>
                
                <div class="number-selector" id="number-selector">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>
                
                <div class="factory-controls">
                    <button class="factory-btn" id="generate-btn">
                        🏭 توليد المضاعفات
                    </button>
                    <button class="factory-btn" id="check-btn" disabled>
                        ✅ تحقق
                    </button>
                    <button class="factory-btn" id="reset-btn">
                        🔄 إعادة تعيين
                    </button>
                </div>
                
                <div class="feedback-area" id="feedback-area">
                    اختر عدداً من الأعلى لبدء التعلم!
                </div>
                
                <div class="factory-stats">
                    <div class="stat-card">
                        <div class="stat-value" id="factory-score">0</div>
                        <div class="stat-label">النقاط</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="multiples-found">0</div>
                        <div class="stat-label">مضاعفات وجدت</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="factory-level">1</div>
                        <div class="stat-label">مستوى المصنع</div>
                    </div>
                </div>
            </div>
            
            <div class="production-line">
                <div class="panel-title">📦 خط الإنتاج</div>
                
                <div class="visual-multiples" id="visual-multiples">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>
                
                <div class="multiples-grid" id="multiples-grid">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>
                
                <div class="multiplication-display" style="background: rgba(255, 255, 255, 0.1); color: white;">
                    <h4>🎯 المهمة: اختر المضاعفات الصحيحة</h4>
                    <p>انقر على الأعداد التي تمثل مضاعفات العدد المختار</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // البيانات من Laravel
        const minRange = {{ $min_range }};
        const maxRange = {{ $max_range }};
        
        // متغيرات اللعبة
        let factoryScore = 0;
        let multiplesFound = 0;
        let factoryLevel = 1;
        let selectedNumber = null;
        let currentMultiples = [];
        let correctSelections = [];
        let userSelections = [];
        
        // عناصر DOM
        const numberSelector = document.getElementById('number-selector');
        const generateBtn = document.getElementById('generate-btn');
        const checkBtn = document.getElementById('check-btn');
        const resetBtn = document.getElementById('reset-btn');
        const feedbackArea = document.getElementById('feedback-area');
        const currentFormula = document.getElementById('current-formula');
        const multiplesGrid = document.getElementById('multiples-grid');
        const visualMultiples = document.getElementById('visual-multiples');
        const factoryScoreElement = document.getElementById('factory-score');
        const multiplesFoundElement = document.getElementById('multiples-found');
        const factoryLevelElement = document.getElementById('factory-level');
        
        // تهيئة اللعبة
        document.addEventListener('DOMContentLoaded', function() {
            initializeNumberSelector();
            setupEventListeners();
        });
        
        function setupEventListeners() {
            generateBtn.addEventListener('click', generateMultiples);
            checkBtn.addEventListener('click', checkSelections);
            resetBtn.addEventListener('click', resetFactory);
        }
        
        function initializeNumberSelector() {
            numberSelector.innerHTML = '';
            
            // توليد أعداد من 2 إلى 12
            for (let i = 2; i <= 10; i++) {
                const numberBtn = document.createElement('div');
                numberBtn.className = 'number-btn';
                numberBtn.textContent = i;
                numberBtn.dataset.number = i;
                
                numberBtn.addEventListener('click', function() {
                    selectNumber(parseInt(this.dataset.number));
                });
                
                numberSelector.appendChild(numberBtn);
            }
        }
        
        function selectNumber(number) {
            selectedNumber = number;
            
            // تحديث المظهر
            document.querySelectorAll('.number-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // تحديث العرض
            currentFormula.textContent = `مضاعفات العدد ${number}`;
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = `تم اختيار العدد ${number}! انقر على "توليد المضاعفات"`;
            
            // تفعيل الزر
            generateBtn.disabled = false;
        }
        
        function generateMultiples() {
            if (!selectedNumber) {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = '❌ يرجى اختيار عدد أولاً!';
                return;
            }
            
            // توليد المضاعفات الصحيحة (من 1 إلى 10)
            correctSelections = [];
            for (let i = 1; i <= 10; i++) {
                correctSelections.push(selectedNumber * i);
            }
            
            // توليد أعداد عشوائية للاختيار منها
            const allNumbers = new Set(correctSelections);
            
            // إضافة أعداد خاطئة
            while (allNumbers.size < 16) {
                const randomNum = Math.floor(Math.random() * 100) + 1;
                if (!correctSelections.includes(randomNum)) {
                    allNumbers.add(randomNum);
                }
            }
            
            currentMultiples = Array.from(allNumbers);
            shuffleArray(currentMultiples);
            
            // عرض الشبكة
            displayMultiplesGrid();
            
            // عرض التمثيل البصري
            displayVisualMultiples();
            
            // تفعيل زر التحقق
            checkBtn.disabled = false;
            
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = `انقر على مضاعفات العدد ${selectedNumber}`;
        }
        
        function displayMultiplesGrid() {
            multiplesGrid.innerHTML = '';
            userSelections = [];
            
            currentMultiples.forEach(number => {
                const card = document.createElement('div');
                card.className = 'multiple-card neutral';
                card.textContent = number;
                card.dataset.number = number;
                
                card.addEventListener('click', function() {
                    toggleSelection(parseInt(this.dataset.number), this);
                });
                
                multiplesGrid.appendChild(card);
            });
        }
        
        function displayVisualMultiples() {
            visualMultiples.innerHTML = '';
            
            // عرض أول 5 مضاعفات بصرياً
            for (let i = 1; i <= 5; i++) {
                const multiple = selectedNumber * i;
                const group = document.createElement('div');
                group.className = 'visual-group';
                
                const label = document.createElement('div');
                label.className = 'group-label';
                label.textContent = `${selectedNumber} × ${i} = ${multiple}`;
                
                const items = document.createElement('div');
                items.className = 'group-items';
                
                for (let j = 0; j < selectedNumber; j++) {
                    const item = document.createElement('div');
                    item.className = 'visual-item';
                    items.appendChild(item);
                }
                
                group.appendChild(items);
                group.appendChild(label);
                visualMultiples.appendChild(group);
            }
        }
        
        function toggleSelection(number, element) {
            const index = userSelections.indexOf(number);
            
            if (index === -1) {
                // إضافة التحديد
                userSelections.push(number);
                element.classList.remove('neutral');
                element.classList.add('correct');
            } else {
                // إزالة التحديد
                userSelections.splice(index, 1);
                element.classList.remove('correct');
                element.classList.add('neutral');
            }
        }
        
        function checkSelections() {
            if (userSelections.length === 0) {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = '❌ يرجى اختيار مضاعفات أولاً!';
                return;
            }
            
            // التحقق من الإجابات
            let correctCount = 0;
            let wrongCount = 0;
            
            userSelections.forEach(selection => {
                if (correctSelections.includes(selection)) {
                    correctCount++;
                } else {
                    wrongCount++;
                }
            });
            
            // تحديث النقاط والمستوى
            const pointsEarned = correctCount * 5 - wrongCount * 2;
            factoryScore += Math.max(0, pointsEarned);
            multiplesFound += correctCount;
            
            if (multiplesFound >= factoryLevel * 10) {
                factoryLevel++;
            }
            
            // عرض النتيجة
            if (wrongCount === 0 && correctCount > 0) {
                feedbackArea.className = 'feedback-area feedback-success celebrate';
                feedbackArea.textContent = `🎉 ممتاز! جميع إجاباتك صحيحة! +${pointsEarned} نقطة`;
            } else if (correctCount > wrongCount) {
                feedbackArea.className = 'feedback-area feedback-success';
                feedbackArea.textContent = `👍 جيد! ${correctCount} صحيحة و ${wrongCount} خاطئة! +${pointsEarned} نقطة`;
            } else {
                feedbackArea.className = 'feedback-area feedback-error';
                feedbackArea.textContent = `❌ تحتاج تحسين! ${correctCount} صحيحة و ${wrongCount} خاطئة`;
            }
            
            // تحديث الإحصائيات
            updateFactoryStats();
            
            // تعطيل الزر حتى الجولة التالية
            checkBtn.disabled = true;
        }
        
        function resetFactory() {
            selectedNumber = null;
            userSelections = [];
            correctSelections = [];
            
            // إعادة تعيين الواجهة
            document.querySelectorAll('.number-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            document.querySelectorAll('.multiple-card').forEach(card => {
                card.classList.remove('correct', 'wrong');
                card.classList.add('neutral');
            });
            
            currentFormula.textContent = 'اختر عدداً لبدء المصنع';
            multiplesGrid.innerHTML = '';
            visualMultiples.innerHTML = '';
            
            generateBtn.disabled = true;
            checkBtn.disabled = true;
            
            feedbackArea.className = 'feedback-area feedback-info';
            feedbackArea.textContent = 'اختر عدداً من الأعلى لبدء التعلم!';
        }
        
        function updateFactoryStats() {
            factoryScoreElement.textContent = factoryScore;
            multiplesFoundElement.textContent = multiplesFound;
            factoryLevelElement.textContent = factoryLevel;
        }
        
        // دوال مساعدة
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
    </script>
</body>
</html>