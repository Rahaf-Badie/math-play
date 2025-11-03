<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐧 {{ $lesson_game->lesson->name ?? 'مغامرة البطريق مع مكونات العدد 10' }}</title>
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
            text-align: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            max-width: 900px;
            width: 100%;
            color: #333;
            position: relative;
            overflow: hidden;
        }

        .game-info {
            background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
            padding: 12px 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: #2d3436;
            border: 2px solid #e17055;
        }

        .header {
            margin-bottom: 25px;
            position: relative;
        }

        h1 {
            color: #ff6b6b;
            margin-bottom: 15px;
            font-size: 2.8rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.2);
            background: linear-gradient(45deg, #ff6b6b, #ffa726);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .character {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="40" r="30" fill="black"/><circle cx="50" cy="40" r="25" fill="white"/><ellipse cx="40" cy="35" rx="5" ry="7" fill="black"/><ellipse cx="60" cy="35" rx="5" ry="7" fill="black"/><ellipse cx="50" cy="50" rx="15" ry="10" fill="orange"/><path d="M30 70 Q50 90 70 70" stroke="black" stroke-width="3" fill="none"/></svg>') no-repeat center;
            background-size: contain;
        }

        .instructions {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-size: 1.3rem;
            line-height: 1.7;
            color: #2d3436;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 3px dashed #fd79a8;
        }

        .game-area {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            margin: 25px 0;
        }

        .ice-block {
            width: 220px;
            min-height: 220px;
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            border-radius: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
            border: 5px solid #dfe6e9;
            transition: all 0.3s;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .ice-block::before {
            content: "";
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(135deg, #00cec9, #81ecec);
            border-radius: 25px;
            z-index: -1;
            opacity: 0.7;
        }

        .ice-block.active {
            transform: scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
            border-color: #ffeaa7;
        }

        .ice-sum {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            font-size: 1.4rem;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            background: rgba(0, 0, 0, 0.3);
            padding: 5px;
            border-radius: 10px;
        }

        .fish {
            width: 60px;
            height: 60px;
            border-radius: 50% 50% 50% 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.6rem;
            font-weight: bold;
            cursor: pointer;
            margin: 8px;
            transition: all 0.4s;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            position: relative;
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .fish::after {
            content: "";
            position: absolute;
            top: 15px;
            right: -10px;
            width: 0;
            height: 0;
            border-top: 15px solid transparent;
            border-bottom: 15px solid transparent;
            border-left: 20px solid rgba(255, 255, 255, 0.5);
        }

        .fish:hover {
            transform: scale(1.15) rotate(5deg);
        }

        .fish-1 { background: linear-gradient(135deg, #ff7675, #fd79a8); }
        .fish-2 { background: linear-gradient(135deg, #fdcb6e, #e17055); }
        .fish-3 { background: linear-gradient(135deg, #a29bfe, #6c5ce7); }
        .fish-4 { background: linear-gradient(135deg, #00b894, #00cec9); }
        .fish-5 { background: linear-gradient(135deg, #e84393, #fd79a8); }
        .fish-6 { background: linear-gradient(135deg, #f368e0, #ff9ff3); }
        .fish-7 { background: linear-gradient(135deg, #00d2d3, #54a0ff); }
        .fish-8 { background: linear-gradient(135deg, #5f27cd, #341f97); }
        .fish-9 { background: linear-gradient(135deg, #ee5a24, #ff9ff3); }

        .fish-pool {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            padding: 20px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
            border: 3px dashed #74b9ff;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        #check-btn {
            background: linear-gradient(135deg, #00b894, #55efc4);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #e17055, #fab1a0);
            color: white;
        }

        #hint-btn {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .feedback {
            margin-top: 25px;
            font-size: 1.6rem;
            font-weight: bold;
            min-height: 50px;
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s;
        }

        .correct {
            background: linear-gradient(135deg, #00b894, #55efc4);
            color: white;
            animation: pulse 1s infinite;
        }

        .incorrect {
            background: linear-gradient(135deg, #e17055, #fab1a0);
            color: white;
            animation: shake 0.5s;
        }

        .info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
        }

        .score-board {
            font-size: 1.5rem;
            margin-top: 20px;
            background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
            padding: 15px 30px;
            border-radius: 50px;
            display: inline-block;
            color: #2d3436;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .target-display {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 15px 0;
            color: #ff6b6b;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
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
            .game-area {
                flex-direction: column;
                align-items: center;
            }

            .ice-block {
                width: 280px;
            }

            h1 {
                font-size: 2rem;
            }

            button {
                padding: 12px 25px;
                font-size: 1.1rem;
            }

            .controls {
                flex-direction: column;
                align-items: center;
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
        <div class="game-info">
            <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
            <strong>الهدف:</strong> مكونات العدد {{ $max_range ?? 10 }}
        </div>

        <div class="header">
            <h1>🐧 {{ $lesson_game->lesson->name ?? 'مغامرة البطريق مع مكونات العدد 10' }}</h1>
            <div class="character"></div>
            <div class="instructions">
                <p>مرحباً صديقي! ساعد البطريق الصغير في جمع الأسماك في كتلي الجليد بحيث يكون مجموع الأسماك في الكتلتين معاً يساوي <span id="targetNumber">{{ $max_range ?? 10 }}</span></p>
            </div>
        </div>

        <div class="target-display">المجموع المطلوب: <span id="targetDisplay">{{ $max_range ?? 10 }}</span></div>

        <div class="game-area">
            <div class="ice-block" id="ice1">
                <div class="ice-sum">المجموع: <span id="sum1">0</span></div>
            </div>
            <div class="ice-block" id="ice2">
                <div class="ice-sum">المجموع: <span id="sum2">0</span></div>
            </div>
        </div>

        <div class="fish-pool" id="fishPool">
            <!-- سيتم ملء الأسماك ديناميكياً -->
        </div>

        <div class="controls">
            <button id="check-btn">
                <span>✅ تحقق من الإجابة</span>
            </button>
            <button id="hint-btn">
                <span>💡 تلميح</span>
            </button>
            <button id="reset-btn">
                <span>🔄 إعادة المحاولة</span>
            </button>
        </div>

        <div class="feedback" id="feedback">اختر كتلة جليد ثم انقر على الأسماك لوضعها فيها</div>

        <div class="score-board">النقاط: <span id="score">0</span></div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 10 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'مغامرة البطريق مع مكونات العدد 10' }}";

        // تحديث عنوان الصفحة والعناصر
        document.title = "🐧 " + gameTitle;
        document.getElementById('targetNumber').textContent = maxRange;
        document.getElementById('targetDisplay').textContent = maxRange;

        document.addEventListener('DOMContentLoaded', function() {
            const ice1 = document.getElementById('ice1');
            const ice2 = document.getElementById('ice2');
            const fishPool = document.getElementById('fishPool');
            const checkBtn = document.getElementById('check-btn');
            const resetBtn = document.getElementById('reset-btn');
            const hintBtn = document.getElementById('hint-btn');
            const feedback = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const sum1Element = document.getElementById('sum1');
            const sum2Element = document.getElementById('sum2');
            const celebration = document.getElementById('celebration');

            let score = 0;
            let selectedIceBlock = null;

            // Audio Context للتعليقات الصوتية
            let audioCtx;
            try {
                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            } catch (e) {
                console.log("Web Audio API غير مدعوم في هذا المتصفح");
            }

            /**
             * تشغيل نغمة صوتية للتعليق
             */
            function playTone(freq, time = 0.12) {
                if (!audioCtx) return;

                try {
                    const o = audioCtx.createOscillator();
                    const g = audioCtx.createGain();
                    o.type = 'sine';
                    o.frequency.value = freq;
                    g.gain.value = 0.0001;
                    o.connect(g);
                    g.connect(audioCtx.destination);
                    o.start();
                    g.gain.exponentialRampToValueAtTime(0.12, audioCtx.currentTime + 0.02);
                    g.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + time);
                    setTimeout(() => o.stop(), (time + 0.03) * 1000);
                } catch (e) {
                    console.log("خطأ في تشغيل الصوت");
                }
            }

            // إنشاء الأسماك ديناميكياً بناءً على النطاق
            function createFishes() {
                fishPool.innerHTML = '';
                for (let i = minRange; i < maxRange; i++) {
                    const fish = document.createElement('div');
                    fish.className = `fish fish-${i}`;
                    fish.setAttribute('data-value', i);
                    fish.textContent = i;
                    fishPool.appendChild(fish);
                }
            }

            // جعل كتل الجليد قابلة للتحديد
            const iceBlocks = [ice1, ice2];
            iceBlocks.forEach(block => {
                block.addEventListener('click', function() {
                    // إزالة التحديد من جميع الكتل
                    iceBlocks.forEach(b => b.classList.remove('active'));
                    // تحديد الكتلة المختارة
                    this.classList.add('active');
                    selectedIceBlock = this;
                    feedback.textContent = `تم اختيار كتلة جليد! الآن اختر السمكة التي تريد إضافتها.`;
                    feedback.className = 'feedback info';
                });
            });

            // جعل الأسماك قابلة للإضافة إلى كتل الجليد
            function setupFishEvents() {
                const fishes = document.querySelectorAll('#fishPool .fish');
                fishes.forEach(fish => {
                    fish.addEventListener('click', function() {
                        if (!selectedIceBlock) {
                            feedback.textContent = 'يرجى اختيار كتلة جليد أولاً!';
                            feedback.className = 'feedback incorrect';
                            return;
                        }

                        // نقل السمكة إلى الكتلة المحددة
                        const fishValue = parseInt(this.getAttribute('data-value'));
                        const newFish = this.cloneNode(true);
                        selectedIceBlock.appendChild(newFish);

                        // إزالة السمكة من المجموعة
                        this.remove();

                        // إضافة حدث النقر على السمكة الجديدة لإعادتها
                        newFish.addEventListener('click', function() {
                            fishPool.appendChild(this.cloneNode(true));
                            this.remove();
                            updateGameState();
                        });

                        updateGameState();
                        playTone(440, 0.1);
                    });
                });
            }

            // تحديث حالة اللعبة
            function updateGameState() {
                const ice1Sum = calculateIceSum(ice1);
                const ice2Sum = calculateIceSum(ice2);

                sum1Element.textContent = ice1Sum;
                sum2Element.textContent = ice2Sum;

                if (ice1Sum + ice2Sum === maxRange) {
                    feedback.textContent = `ممتاز! الآن اضغط على زر "تحقق من الإجابة" - ${ice1Sum} + ${ice2Sum} = ${maxRange}`;
                    feedback.className = 'feedback info';
                } else {
                    feedback.textContent = `اجمع الأسماك بحيث يكون المجموع ${maxRange}. الكتلة الأولى: ${ice1Sum}، الكتلة الثانية: ${ice2Sum}`;
                    feedback.className = 'feedback';
                }
            }

            // حساب مجموع الأسماك في كتلة الجليد
            function calculateIceSum(iceBlock) {
                let sum = 0;
                const fishesInIce = iceBlock.querySelectorAll('.fish');
                fishesInIce.forEach(fish => {
                    sum += parseInt(fish.getAttribute('data-value'));
                });
                return sum;
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
                const ice1Sum = calculateIceSum(ice1);
                const ice2Sum = calculateIceSum(ice2);

                if (ice1Sum + ice2Sum === maxRange) {
                    feedback.textContent = `أحسنت! لقد نجحت في جمع العدد ${maxRange} بشكل صحيح! ${ice1Sum} + ${ice2Sum} = ${maxRange}`;
                    feedback.className = 'feedback correct';
                    score += 10;
                    scoreElement.textContent = score;
                    playTone(880, 0.5);

                    createCelebration();

                    setTimeout(resetGame, 3000);
                } else {
                    feedback.textContent = `ليس صحيحاً بعد. ${ice1Sum} + ${ice2Sum} = ${ice1Sum + ice2Sum} وليس ${maxRange}. حاول مرة أخرى!`;
                    feedback.className = 'feedback incorrect';
                    playTone(220, 0.3);
                }
            });

            // زر التلميح
            hintBtn.addEventListener('click', function() {
                const ice1Sum = calculateIceSum(ice1);
                const ice2Sum = calculateIceSum(ice2);
                const needed = maxRange - (ice1Sum + ice2Sum);

                if (needed > 0) {
                    feedback.textContent = `💡 تلميح: تحتاج إلى إضافة ${needed} نقطة أخرى للوصول إلى ${maxRange}`;
                } else if (needed < 0) {
                    feedback.textContent = `💡 تلميح: لديك ${-needed} نقطة زيادة عن ${maxRange}`;
                } else {
                    feedback.textContent = `💡 تلميح: أنت على الطريق الصحيح! اضغط على زر التحقق`;
                }
                feedback.className = 'feedback info';

                // خصم نقطة لاستخدام التلميح
                score = Math.max(0, score - 1);
                scoreElement.textContent = score;
            });

            // زر إعادة المحاولة
            resetBtn.addEventListener('click', resetGame);

            // إعادة تعيين اللعبة
            function resetGame() {
                // إزالة جميع الأسماك من كتل الجليد
                iceBlocks.forEach(block => {
                    while (block.querySelector('.fish')) {
                        const fish = block.querySelector('.fish');
                        fishPool.appendChild(fish.cloneNode(true));
                        fish.remove();
                    }
                });

                // إعادة تعيين الكتلة المحددة
                iceBlocks.forEach(b => b.classList.remove('active'));
                selectedIceBlock = null;

                // إعادة تعيين الرسالة التوجيهية
                feedback.textContent = 'اختر كتلة جليد ثم انقر على الأسماك لوضعها فيها';
                feedback.className = 'feedback';

                // إعادة تعيين المجاميع
                sum1Element.textContent = '0';
                sum2Element.textContent = '0';

                // إعادة إعداد أحداث الأسماك
                setupFishEvents();
            }

            // تهيئة اللعبة
            createFishes();
            setupFishEvents();
            updateGameState();
        });
    </script>
</body>
</html>
