<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لعبة البازل الموسع - الإصدار المصحح</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            margin-bottom: 20px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .instructions {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-size: 1.2rem;
            line-height: 1.6;
            color: #2d3436;
        }
        
        .puzzle-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            margin: 30px 0;
        }
        
        .puzzle-target {
            font-size: 3.5rem;
            font-weight: bold;
            color: #073b4c;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 20px 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 5px solid #ef476f;
        }
        
        .puzzle-slots {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .puzzle-slot {
            width: 160px;
            height: 160px;
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 3px dashed white;
            transition: all 0.3s;
        }
        
        .puzzle-slot.active {
            border: 3px solid #073b4c;
            background: linear-gradient(135deg, #118ab2, #06d6a0);
            transform: scale(1.05);
        }
        
        .slot-label {
            font-size: 1.3rem;
            font-weight: bold;
            color: white;
            margin-bottom: 10px;
        }
        
        .slot-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .puzzle-pieces {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            padding: 25px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
            border: 3px dashed #74b9ff;
        }
        
        .puzzle-piece {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: grab;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
            text-align: center;
            padding: 10px;
        }
        
        .puzzle-piece:hover {
            transform: scale(1.1);
        }
        
        .piece-tens { 
            background: linear-gradient(135deg, #118ab2, #06d6a0);
            border: 3px solid #073b4c;
        }
        
        .piece-ones { 
            background: linear-gradient(135deg, #ff9e6d, #ffd166);
            border: 3px solid #ef476f;
        }
        
        .piece-expression {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            color: #073b4c;
            border: 3px solid #74b9ff;
            font-size: 1.2rem;
        }
        
        .piece-value {
            font-size: 1.8rem;
            margin-top: 5px;
        }
        
        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
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
        }
        
        #check-btn {
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            color: white;
        }
        
        #reset-btn {
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            color: #073b4c;
        }
        
        #new-puzzle-btn {
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
            min-height: 60px;
            padding: 15px;
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
        
        .score {
            font-size: 1.5rem;
            margin-top: 20px;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 15px 30px;
            border-radius: 50px;
            display: inline-block;
            color: #073b4c;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            .puzzle-slots {
                flex-direction: column;
                align-items: center;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .puzzle-target {
                font-size: 2.5rem;
                padding: 15px 30px;
            }
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
    </style>
</head>
<body>
    <div class="container">
        <h1>لعبة البازل الموسع - الإصدار المصحح</h1>
        
        <div class="instructions">
            <p>مرحباً! اسحب القطع المناسبة إلى أماكنها الصحيحة لتكوين الصورة الموسعة للعدد.</p>
            <p><strong>تلميح:</strong> كل عدد بين 11 و19 يتكون من 10 + عدد الآحاد</p>
        </div>
        
        <div class="puzzle-area">
            <div class="puzzle-target" id="target-number">16</div>
            
            <div class="puzzle-slots">
                <div class="puzzle-slot" id="tens-slot">
                    <div class="slot-label">العشرات</div>
                    <div class="slot-value" id="tens-value">?</div>
                </div>
                
                <div class="puzzle-slot" id="ones-slot">
                    <div class="slot-label">الآحاد</div>
                    <div class="slot-value" id="ones-value">?</div>
                </div>
                
                <div class="puzzle-slot" id="expression-slot">
                    <div class="slot-label">الصورة الموسعة</div>
                    <div class="slot-value" id="expression-value">?</div>
                </div>
            </div>
        </div>
        
        <div class="puzzle-pieces">
            <!-- قطع العشرات -->
            <div class="puzzle-piece piece-tens" data-value="10" data-type="tens">
                <div>عشرات</div>
                <div class="piece-value">10</div>
            </div>
            
            <!-- قطع الآحاد -->
            <div class="puzzle-piece piece-ones" data-value="1" data-type="ones">
                <div>آحاد</div>
                <div class="piece-value">1</div>
            </div>
            
            <div class="puzzle-piece piece-ones" data-value="2" data-type="ones">
                <div>آحاد</div>
                <div class="piece-value">2</div>
            </div>
            
            <div class="puzzle-piece piece-ones" data-value="3" data-type="ones">
                <div>آحاد</div>
                <div class="piece-value">3</div>
            </div>
            
            <div class="puzzle-piece piece-ones" data-value="4" data-type="ones">
                <div>آحاد</div>
                <div class="piece-value">4</div>
            </div>
            
            <div class="puzzle-piece piece-ones" data-value="5" data-type="ones">
                <div>آحاد</div>
                <div class="piece-value">5</div>
            </div>
            
            <div class="puzzle-piece piece-ones" data-value="6" data-type="ones">
                <div>آحاد</div>
                <div class="piece-value">6</div>
            </div>
            
            <div class="puzzle-piece piece-ones" data-value="7" data-type="ones">
                <div>آحاد</div>
                <div class="piece-value">7</div>
            </div>
            
            <div class="puzzle-piece piece-ones" data-value="8" data-type="ones">
                <div>آحاد</div>
                <div class="piece-value">8</div>
            </div>
            
            <div class="puzzle-piece piece-ones" data-value="9" data-type="ones">
                <div>آحاد</div>
                <div class="piece-value">9</div>
            </div>
            
            <!-- قطع التعبيرات -->
            <div class="puzzle-piece piece-expression" data-value="10 + 1" data-type="expression">
                <div>10 + 1</div>
            </div>
            
            <div class="puzzle-piece piece-expression" data-value="10 + 2" data-type="expression">
                <div>10 + 2</div>
            </div>
            
            <div class="puzzle-piece piece-expression" data-value="10 + 3" data-type="expression">
                <div>10 + 3</div>
            </div>
            
            <div class="puzzle-piece piece-expression" data-value="10 + 4" data-type="expression">
                <div>10 + 4</div>
            </div>
            
            <div class="puzzle-piece piece-expression" data-value="10 + 5" data-type="expression">
                <div>10 + 5</div>
            </div>
            
            <div class="puzzle-piece piece-expression" data-value="10 + 6" data-type="expression">
                <div>10 + 6</div>
            </div>
            
            <div class="puzzle-piece piece-expression" data-value="10 + 7" data-type="expression">
                <div>10 + 7</div>
            </div>
            
            <div class="puzzle-piece piece-expression" data-value="10 + 8" data-type="expression">
                <div>10 + 8</div>
            </div>
            
            <div class="puzzle-piece piece-expression" data-value="10 + 9" data-type="expression">
                <div>10 + 9</div>
            </div>
        </div>
        
        <div class="controls">
            <button id="check-btn">تحقق من الإجابة</button>
            <button id="reset-btn">إعادة المحاولة</button>
            <button id="new-puzzle-btn">لغز جديد</button>
        </div>
        
        <div class="feedback" id="feedback">اسحب القطع إلى أماكنها الصحيحة</div>
        
        <div class="score">النقاط: <span id="score">0</span></div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tensSlot = document.getElementById('tens-slot');
            const onesSlot = document.getElementById('ones-slot');
            const expressionSlot = document.getElementById('expression-slot');
            const tensValue = document.getElementById('tens-value');
            const onesValue = document.getElementById('ones-value');
            const expressionValue = document.getElementById('expression-value');
            const targetNumber = document.getElementById('target-number');
            const puzzlePieces = document.querySelector('.puzzle-pieces');
            const checkBtn = document.getElementById('check-btn');
            const resetBtn = document.getElementById('reset-btn');
            const newPuzzleBtn = document.getElementById('new-puzzle-btn');
            const feedback = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const celebration = document.getElementById('celebration');
            
            let score = 0;
            let currentNumber = 16;
            let currentTens = null;
            let currentOnes = null;
            let currentExpression = null;
            
            // جعل القطع قابلة للسحب
            const pieces = document.querySelectorAll('.puzzle-piece');
            pieces.forEach(piece => {
                piece.setAttribute('draggable', 'true');
                
                piece.addEventListener('dragstart', function(e) {
                    e.dataTransfer.setData('text/plain', this.getAttribute('data-value'));
                    e.dataTransfer.setData('type', this.getAttribute('data-type'));
                });
            });
            
            // جعل الفتحات قابلة للإفلات
            const slots = document.querySelectorAll('.puzzle-slot');
            slots.forEach(slot => {
                slot.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('active');
                });
                
                slot.addEventListener('dragleave', function() {
                    this.classList.remove('active');
                });
                
                slot.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('active');
                    
                    const pieceValue = e.dataTransfer.getData('text/plain');
                    const pieceType = e.dataTransfer.getData('type');
                    const slotType = this.id.split('-')[0]; // tens, ones, expression
                    
                    // السماح بوضع القطعة فقط إذا كانت من النوع المناسب
                    if (pieceType === slotType) {
                        this.querySelector('.slot-value').textContent = pieceValue;
                        
                        if (slotType === 'tens') {
                            currentTens = parseInt(pieceValue);
                        } else if (slotType === 'ones') {
                            currentOnes = parseInt(pieceValue);
                        } else {
                            currentExpression = pieceValue;
                        }
                        
                        feedback.textContent = `تم وضع ${pieceValue} في مكانه الصحيح`;
                        feedback.className = 'feedback';
                        checkCompletion();
                    } else {
                        feedback.textContent = 'هذا المكان غير مناسب لهذه القطعة!';
                        feedback.className = 'feedback incorrect';
                    }
                });
            });
            
            // التحقق من اكتمال البازل
            function checkCompletion() {
                if (currentTens !== null && currentOnes !== null && currentExpression !== null) {
                    feedback.textContent = 'تم وضع جميع القطع! اضغط على زر التحقق';
                    feedback.className = 'feedback';
                }
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
            
            // إنشاء لغز جديد
            function generateNewPuzzle() {
                currentNumber = Math.floor(Math.random() * 9) + 11; // أعداد من 11 إلى 19
                targetNumber.textContent = currentNumber;
                resetPuzzle();
            }
            
            // إعادة تعيين البازل
            function resetPuzzle() {
                currentTens = null;
                currentOnes = null;
                currentExpression = null;
                
                tensValue.textContent = '?';
                onesValue.textContent = '?';
                expressionValue.textContent = '?';
                
                slots.forEach(slot => {
                    slot.classList.remove('active');
                });
                
                feedback.textContent = 'اسحب القطع إلى أماكنها الصحيحة';
                feedback.className = 'feedback';
            }
            
            // زر التحقق من الإجابة
            checkBtn.addEventListener('click', function() {
                if (currentTens === null || currentOnes === null || currentExpression === null) {
                    feedback.textContent = 'لم تكتمل الصورة بعد!';
                    feedback.className = 'feedback incorrect';
                    return;
                }
                
                const total = currentTens + currentOnes;
                const expectedExpression = `10 + ${currentNumber - 10}`;
                
                if (total === currentNumber && currentExpression === expectedExpression) {
                    feedback.textContent = `أحسنت! ${currentNumber} = ${currentExpression}`;
                    feedback.className = 'feedback correct';
                    score += 10;
                    scoreElement.textContent = score;
                    
                    // إنشاء تأثير الاحتفال
                    createCelebration();
                    
                    // إنشاء لغز جديد بعد ثانيتين
                    setTimeout(generateNewPuzzle, 2000);
                } else {
                    feedback.textContent = `ليس صحيحاً بعد. ${currentNumber} = 10 + ${currentNumber - 10}`;
                    feedback.className = 'feedback incorrect';
                }
            });
            
            // زر إعادة المحاولة
            resetBtn.addEventListener('click', resetPuzzle);
            
            // زر لغز جديد
            newPuzzleBtn.addEventListener('click', generateNewPuzzle);
            
            // تهيئة اللعبة
            generateNewPuzzle();
        });
    </script>
</body>
</html>