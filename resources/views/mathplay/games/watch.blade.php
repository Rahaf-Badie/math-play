<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ساعة التقدير الذكية - {{ $lesson_game->lesson->name }}</title>
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
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 800px;
            border: 3px solid #3498db;
        }

        .lesson-info {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        h1 {
            color: #3498db;
            margin-bottom: 15px;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
            font-size: 2em;
        }

        .instructions {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-right: 4px solid #3498db;
            font-size: 1.1em;
        }

        .game-area {
            padding: 30px;
            background: linear-gradient(135deg, #f0f8ff 0%, #e1f0f5 100%);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid #3498db;
        }

        .estimation-clock {
            font-size: 4em;
            margin: 20px 0;
            animation: tick 2s ease-in-out infinite;
        }

        @keyframes tick {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .problem-display {
            font-size: 2.5em;
            font-weight: bold;
            color: #2c3e50;
            margin: 30px 0;
            padding: 25px;
            background: white;
            border-radius: 15px;
            border: 4px solid #e74c3c;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            font-family: 'Courier New', monospace;
        }

        .operation-symbol {
            color: #e74c3c;
            margin: 0 15px;
        }

        .estimation-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .estimation-option {
            padding: 25px;
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: white;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.4em;
            font-weight: bold;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .estimation-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .estimation-option.correct {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            animation: celebrate 0.6s ease;
        }

        .estimation-option.incorrect {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.4em;
            font-weight: bold;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-align: center;
            line-height: 1.6;
        }

        .score-board {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 20px;
            border-radius: 15px;
            margin-top: 25px;
        }

        #score {
            font-size: 2.5em;
            color: #3498db;
            font-weight: bold;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background-color: #ddd;
            border-radius: 6px;
            margin: 20px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        .estimation-tips {
            background: #e8f4f8;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            font-size: 1.1em;
            text-align: right;
        }

        .tip {
            margin: 10px 0;
            padding: 8px;
            background: white;
            border-radius: 8px;
            border-right: 4px solid #3498db;
        }

        .controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 30px;
            font-size: 1.2em;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        #next-btn {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @media (max-width: 768px) {
            .estimation-options {
                grid-template-columns: 1fr;
            }
            
            .problem-display {
                font-size: 2em;
                padding: 20px;
            }
            
            .estimation-clock {
                font-size: 3em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-info">
            🎯 الدرس: {{ $lesson_game->lesson->name }}
        </div>

        <h1>⏰ ساعة التقدير الذكية</h1>
        
        <div class="instructions">
            <p>🔢 تقدير ناتج الضرب والقسمة</p>
            <p>🎯 اختر التقدير الأقرب للناتج الحقيقي</p>
        </div>

        <div class="game-area">
            <div class="estimation-clock">⏰</div>

            <div class="problem-display" id="problem-display">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <!-- شريط التقدم -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <div class="estimation-options" id="estimation-options">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="feedback" id="feedback">
                قدّر الناتج واختر الإجابة الأقرب!
            </div>

            <div class="estimation-tips" id="estimation-tips" style="display: none;">
                <!-- سيتم تعبئته ديناميكياً -->
            </div>

            <div class="controls">
                <button id="next-btn">➡️ مسألة تالية</button>
                <button id="hint-btn">💡 نصائح تقدير</button>
            </div>
        </div>

        <div class="score-board">
            <h2>🏆 النتيجة</h2>
            <p>النقاط: <span id="score">0</span></p>
            <p>التقديرات الصحيحة: <span id="correct-count">0</span>/<span id="total-count">0</span></p>
        </div>
    </div>

    <script>
        // === JavaScript لساعة التقدير الذكية ===
        const minRange = {{ $min_range ?? 10 }};
        const maxRange = {{ $max_range ?? 99 }};
        
        let score = 0;
        let correctAnswers = 0;
        let totalQuestions = 0;
        let currentOperation = ''; // 'multiplication' or 'division'
        let num1 = 0;
        let num2 = 0;
        let exactResult = 0;
        let correctEstimation = 0;
        let estimationOptions = [];

        function generateEstimationProblem() {
            // تحديد العملية (ضرب أو قسمة)
            currentOperation = Math.random() < 0.5 ? 'multiplication' : 'division';
            
            if (currentOperation === 'multiplication') {
                // توليد أعداد للضرب
                num1 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                num2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                exactResult = num1 * num2;
            } else {
                // توليد أعداد للقسمة (تجنب القسمة على الصفر)
                num2 = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange;
                if (num2 === 0) num2 = 1;
                num1 = num2 * Math.floor(Math.random() * 10 + 1); // للتأكد من قسمة صحيحة
                exactResult = num1 / num2;
            }

            // توليد خيارات تقدير
            generateEstimationOptions();

            // تحديث العرض
            updateProblemDisplay();
            
            document.getElementById('feedback').textContent = 'قدّر الناتج واختر الإجابة الأقرب!';
            document.getElementById('feedback').style.background = '#f8f9fa';
            document.getElementById('estimation-tips').style.display = 'none';

            totalQuestions++;
            document.getElementById('total-count').textContent = totalQuestions;
        }

        function generateEstimationOptions() {
            estimationOptions = [];
            
            // التقدير الصحيح (تقريب للناتج الحقيقي)
            correctEstimation = Math.round(exactResult / 10) * 10; // تقريب لأقرب عشرة
            
            // إضافة التقدير الصحيح
            estimationOptions.push(correctEstimation);
            
            // توليد تقديرات خاطئة
            while (estimationOptions.length < 4) {
                let wrongEstimation;
                const variation = Math.floor(Math.random() * 3) + 1; // 1, 2, أو 3
                const direction = Math.random() < 0.5 ? -1 : 1;
                
                if (currentOperation === 'multiplication') {
                    wrongEstimation = correctEstimation + (direction * variation * 10);
                } else {
                    wrongEstimation = correctEstimation + (direction * variation * 5);
                }
                
                // التأكد من أن التقدير الخاطئ مختلف وإيجابي
                if (!estimationOptions.includes(wrongEstimation) && wrongEstimation > 0) {
                    estimationOptions.push(wrongEstimation);
                }
            }
            
            // خلط الخيارات
            estimationOptions.sort(() => Math.random() - 0.5);
        }

        function updateProblemDisplay() {
            const problemDisplay = document.getElementById('problem-display');
            const symbol = currentOperation === 'multiplication' ? '×' : '÷';
            
            problemDisplay.innerHTML = `
                ${num1} <span class="operation-symbol">${symbol}</span> ${num2} ≈ ?
            `;

            // تحديث خيارات التقدير
            const optionsContainer = document.getElementById('estimation-options');
            optionsContainer.innerHTML = '';
            
            estimationOptions.forEach((option, index) => {
                const optionElement = document.createElement('div');
                optionElement.className = 'estimation-option';
                optionElement.textContent = `≈ ${option.toLocaleString('ar-EG')}`;
                optionElement.onclick = () => checkEstimation(option, optionElement);
                optionsContainer.appendChild(optionElement);
            });
        }

        function checkEstimation(selectedEstimation, element) {
            const isCorrect = selectedEstimation === correctEstimation;
            const feedbackElement = document.getElementById('feedback');
            const tipsElement = document.getElementById('estimation-tips');

            // تعطيل جميع الخيارات
            document.querySelectorAll('.estimation-option').forEach(option => {
                option.style.cursor = 'not-allowed';
                if (parseInt(option.textContent.replace(/[^0-9]/g, '')) === correctEstimation) {
                    option.classList.add('correct');
                }
            });

            if (isCorrect) {
                element.classList.add('correct');
                feedbackElement.innerHTML = 
                    `🎉 تقدير ممتاز!<br>
                     <small>${num1} ${currentOperation === 'multiplication' ? '×' : '÷'} ${num2} ≈ ${correctEstimation}</small><br>
                     <small>الناتج الدقيق: ${exactResult.toLocaleString('ar-EG')}</small>`;
                feedbackElement.style.background = '#d4edda';
                score += 10;
                correctAnswers++;
            } else {
                element.classList.add('incorrect');
                feedbackElement.innerHTML = 
                    `❌ ليس الأقرب! التقدير الأفضل: ${correctEstimation.toLocaleString('ar-EG')}<br>
                     <small>الناتج الدقيق: ${exactResult.toLocaleString('ar-EG')}</small>`;
                feedbackElement.style.background = '#f8d7da';
                score = Math.max(0, score - 3);
                
                // عرض نصائح التقدير
                showEstimationTips();
            }

            document.getElementById('score').textContent = score;
            document.getElementById('correct-count').textContent = correctAnswers;
            updateProgress();
        }

        function showEstimationTips() {
            const tipsElement = document.getElementById('estimation-tips');
            let tips = '<h3>💡 نصائح للتقدير:</h3>';
            
            if (currentOperation === 'multiplication') {
                tips += `
                    <div class="tip">• قرب ${num1} إلى ${Math.round(num1/10)*10}</div>
                    <div class="tip">• قرب ${num2} إلى ${Math.round(num2/10)*10}</div>
                    <div class="tip">• ${Math.round(num1/10)*10} × ${Math.round(num2/10)*10} = ${Math.round(num1/10)*10 * Math.round(num2/10)*10}</div>
                `;
            } else {
                tips += `
                    <div class="tip">• ${num1} ÷ ${num2} ≈ ${Math.round(num1/10)*10} ÷ ${Math.round(num2/10)*10}</div>
                    <div class="tip">• ${Math.round(num1/10)*10} ÷ ${Math.round(num2/10)*10} = ${Math.round((Math.round(num1/10)*10) / (Math.round(num2/10)*10))}</div>
                `;
            }
            
            tipsElement.innerHTML = tips;
            tipsElement.style.display = 'block';
        }

        function showGeneralTips() {
            const tipsElement = document.getElementById('estimation-tips');
            const tips = `
                <h3>🎯 استراتيجيات التقدير:</h3>
                <div class="tip">• في الضرب: قرب الأعداد لأقرب عشرة ثم اضرب</div>
                <div class="tip">• في القسمة: قرب المقسوم والمقسوم عليه لأقرب عشرة</div>
                <div class="tip">• استخدم الأعداد المتناغمة (مثل 25, 50, 75, 100)</div>
                <div class="tip">• تحقق من معقولية الناتج (هل يبدو منطقياً؟)</div>
            `;
            
            tipsElement.innerHTML = tips;
            tipsElement.style.display = 'block';
        }

        function updateProgress() {
            const progress = totalQuestions > 0 ? (correctAnswers / totalQuestions) * 100 : 0;
            document.getElementById('progress').style.width = `${progress}%`;
        }

        // إعداد event listeners
        document.getElementById('next-btn').addEventListener('click', generateEstimationProblem);
        document.getElementById('hint-btn').addEventListener('click', showGeneralTips);

        // بدء اللعبة
        generateEstimationProblem();
    </script>
</body>
</html>