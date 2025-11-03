<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🦋 {{ $lesson_game->lesson->name ?? 'الفراشات والزهور - مكونات العدد 20' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            max-width: 900px;
            width: 100%;
            color: #333;
            text-align: center;
        }

        .game-info {
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 12px 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: #073b4c;
            border: 2px solid #ef476f;
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

        .target-number {
            font-size: 4rem;
            font-weight: bold;
            margin: 20px 0;
            color: #073b4c;
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            padding: 20px 40px;
            border-radius: 20px;
            display: inline-block;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 5px solid #ef476f;
        }

        .game-area {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 30px 0;
            align-items: center;
        }

        .flower-bed {
            width: 220px;
            height: 280px;
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border: 5px solid #073b4c;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .flower-bed:hover {
            transform: scale(1.05);
        }

        .flower-bed.selected {
            border-color: #ff6b6b;
            box-shadow: 0 0 25px rgba(255, 107, 107, 0.5);
        }

        .bed-label {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 15px;
        }

        .bed-count {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            margin: 10px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .butterflies-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            padding: 25px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
            border: 3px dashed #74b9ff;
            min-height: 150px;
        }

        .butterfly {
            width: 70px;
            height: 70px;
            border-radius: 50% 50% 50% 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
            position: relative;
            animation: float 3s infinite ease-in-out;
        }

        .butterfly::before, .butterfly::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 30px;
            background: inherit;
            border-radius: 50%;
            top: -10px;
            opacity: 0.8;
        }

        .butterfly::before {
            left: -15px;
            transform: rotate(-30deg);
        }

        .butterfly::after {
            right: -15px;
            transform: rotate(30deg);
        }

        .butterfly:hover {
            transform: scale(1.15) rotate(5deg);
        }

        .butterfly-1 {
            background: linear-gradient(135deg, #ff6b6b, #ff9e6d);
            animation-delay: 0s;
        }

        .butterfly-2 {
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            animation-delay: 0.5s;
        }

        .butterfly-3 {
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            animation-delay: 1s;
        }

        .butterfly-4 {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            animation-delay: 1.5s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        button {
            padding: 15px 25px;
            font-size: 1.2rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        #check-btn {
            background: linear-gradient(135deg, #06d6a0, #118ab2);
            color: white;
        }

        #reset-btn {
            background: linear-gradient(135deg, #ffd166, #ff9e6d);
            color: #073b4c;
        }

        #hint-btn {
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

        .info {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
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

        .examples {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 15px;
            border-radius: 15px;
            margin: 20px 0;
            font-size: 1.2rem;
            color: #073b4c;
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
            .game-area {
                flex-direction: column;
                gap: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .target-number {
                font-size: 3rem;
                padding: 15px 30px;
            }

            .controls {
                flex-direction: column;
                align-items: center;
            }

            button {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="game-info">
            <strong>الدرس:</strong> {{ $lesson_game->lesson->name ?? 'غير محدد' }} |
            <strong>الهدف:</strong> مكونات العدد {{ $max_range ?? 20 }}
        </div>

        <h1>🦋 {{ $lesson_game->lesson->name ?? 'الفراشات والزهور' }}</h1>

        <div class="instructions">
            <p>مرحباً! ساعد الفراشات في العثور على الزهور المناسبة. يجب أن يكون مجموع الفراشات في كلا الحوضين <span id="targetNumber">{{ $max_range ?? 20 }}</span></p>
        </div>

        <div class="examples">
            <p><strong>أمثلة:</strong> {{ $max_range ?? 20 }} = 12 + 8 | {{ $max_range ?? 20 }} = 15 + 5 | {{ $max_range ?? 20 }} = 10 + 10</p>
        </div>

        <div class="target-number"><span id="targetDisplay">{{ $max_range ?? 20 }}</span></div>

        <div class="game-area">
            <div class="flower-bed" id="bed1">
                <div class="bed-label">الحوض الأول</div>
                <div class="bed-count" id="count1">0</div>
            </div>

            <div class="flower-bed" id="bed2">
                <div class="bed-label">الحوض الثاني</div>
                <div class="bed-count" id="count2">0</div>
            </div>
        </div>

        <div class="butterflies-container" id="butterflies-pool">
            <!-- سيتم ملء الفراشات ديناميكياً -->
        </div>

        <div class="controls">
            <button id="check-btn">✅ تحقق من الإجابة</button>
            <button id="hint-btn">💡 تلميح</button>
            <button id="reset-btn">🔄 إعادة المحاولة</button>
        </div>

        <div class="feedback" id="feedback">اختر حوضاً ثم انقر على الفراشات لوضعها فيه</div>

        <div class="score">النقاط: <span id="score">0</span></div>
    </div>

    <div class="celebration" id="celebration"></div>

    <script>
        // البيانات الديناميكية من Laravel
        const minRange = {{ $min_range ?? 1 }};
        const maxRange = {{ $max_range ?? 20 }};
        const gameTitle = "{{ $lesson_game->lesson->name ?? 'الفراشات والزهور - مكونات العدد 20' }}";

        // تحديث عنوان الصفحة والعناصر
        document.title = "🦋 " + gameTitle;
        document.getElementById('targetNumber').textContent = maxRange;
        document.getElementById('targetDisplay').textContent = maxRange;

        document.addEventListener('DOMContentLoaded', function() {
            const bed1 = document.getElementById('bed1');
            const bed2 = document.getElementById('bed2');
            const count1 = document.getElementById('count1');
            const count2 = document.getElementById('count2');
            const butterfliesPool = document.getElementById('butterflies-pool');
            const checkBtn = document.getElementById('check-btn');
            const resetBtn = document.getElementById('reset-btn');
            const hintBtn = document.getElementById('hint-btn');
            const feedback = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');
            const celebration = document.getElementById('celebration');

            let score = 0;
            let currentBed1Count = 0;
            let currentBed2Count = 0;
            let selectedBed = null;

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

            // إنشاء الفراشات ديناميكياً بناءً على النطاق
            function createButterflies() {
                butterfliesPool.innerHTML = '';
                for (let i = minRange; i < maxRange; i++) {
                    const butterfly = document.createElement('div');
                    butterfly.className = `butterfly butterfly-${(i % 4) + 1}`;
                    butterfly.setAttribute('data-value', i.toString());
                    butterfly.textContent = i;
                    butterfliesPool.appendChild(butterfly);
                }
            }

            // جعل الأحواض قابلة للتحديد
            const beds = [bed1, bed2];
            beds.forEach(bed => {
                bed.addEventListener('click', function() {
                    // إزالة التحديد من جميع الأحواض
                    beds.forEach(b => b.classList.remove('selected'));
                    // تحديد الحوض المختار
                    this.classList.add('selected');
                    selectedBed = this;
                    feedback.textContent = `تم اختيار ${this.querySelector('.bed-label').textContent}! الآن اختر الفراشة.`;
                    feedback.className = 'feedback info';
                    playTone(440, 0.1);
                });
            });

            // إعداد أحداث الفراشات
            function setupButterflyEvents() {
                const butterflies = document.querySelectorAll('.butterfly');
                butterflies.forEach(butterfly => {
                    butterfly.addEventListener('click', function() {
                        if (!selectedBed) {
                            feedback.textContent = 'يرجى اختيار حوض أولاً!';
                            feedback.className = 'feedback incorrect';
                            playTone(220, 0.2);
                            return;
                        }

                        const butterflyValue = parseInt(this.getAttribute('data-value'));
                        const bedId = selectedBed.id;

                        // تحديث عدد الفراشات في الحوض المحدد
                        if (bedId === 'bed1') {
                            if (currentBed1Count + butterflyValue <= maxRange) {
                                currentBed1Count += butterflyValue;
                                count1.textContent = currentBed1Count;
                                this.remove();
                                playTone(550, 0.1);
                            } else {
                                feedback.textContent = `لا يمكن أن يتجاوز العدد ${maxRange} في الحوض الأول!`;
                                feedback.className = 'feedback incorrect';
                                playTone(220, 0.2);
                                return;
                            }
                        } else {
                            if (currentBed2Count + butterflyValue <= maxRange) {
                                currentBed2Count += butterflyValue;
                                count2.textContent = currentBed2Count;
                                this.remove();
                                playTone(550, 0.1);
                            } else {
                                feedback.textContent = `لا يمكن أن يتجاوز العدد ${maxRange} في الحوض الثاني!`;
                                feedback.className = 'feedback incorrect';
                                playTone(220, 0.2);
                                return;
                            }
                        }

                        updateFeedback();
                    });
                });
            }

            // تحديث الرسالة التوجيهية
            function updateFeedback() {
                const total = currentBed1Count + currentBed2Count;

                feedback.textContent = `الحوض الأول: ${currentBed1Count}، الحوض الثاني: ${currentBed2Count}، المجموع: ${total}`;
                feedback.className = 'feedback';

                if (total === maxRange) {
                    feedback.textContent += ` - ممتاز! الآن اضغط على زر "تحقق من الإجابة"`;
                    feedback.className = 'feedback info';
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

            // زر التحقق من الإجابة
            checkBtn.addEventListener('click', function() {
                const total = currentBed1Count + currentBed2Count;

                if (total === maxRange) {
                    feedback.textContent = `أحسنت! ${currentBed1Count} + ${currentBed2Count} = ${maxRange}`;
                    feedback.className = 'feedback correct';
                    score += 10;
                    scoreElement.textContent = score;
                    playTone(880, 0.5);

                    createCelebration();

                    // إنشاء تركيبة جديدة بعد ثانيتين
                    setTimeout(resetGame, 3000);
                } else {
                    feedback.textContent = `ليس صحيحاً بعد. ${currentBed1Count} + ${currentBed2Count} = ${total} وليس ${maxRange}`;
                    feedback.className = 'feedback incorrect';
                    playTone(220, 0.3);
                }
            });

            // زر التلميح
            hintBtn.addEventListener('click', function() {
                const total = currentBed1Count + currentBed2Count;
                const needed = maxRange - total;

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
                currentBed1Count = 0;
                currentBed2Count = 0;
                count1.textContent = '0';
                count2.textContent = '0';

                // إعادة الفراشات إلى المجموعة
                createButterflies();
                setupButterflyEvents();

                // إعادة تعيين التحديد
                beds.forEach(b => b.classList.remove('selected'));
                selectedBed = null;

                // إعادة تعيين الرسالة التوجيهية
                feedback.textContent = 'اختر حوضاً ثم انقر على الفراشات لوضعها فيه';
                feedback.className = 'feedback';
            }

            // تهيئة اللعبة
            createButterflies();
            setupButterflyEvents();
            updateFeedback();
        });
    </script>
</body>
</html>
