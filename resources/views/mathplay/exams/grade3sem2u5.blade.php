<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار القياس والهندسة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Cairo", sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .exam-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }

        .header h1 {
            color: #2d3436;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 1.1rem;
        }

        .question {
            background: #f8fafc;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 20px;
            border-right: 5px solid #667eea;
            transition: all 0.3s ease;
        }

        .question:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .question-number {
            display: inline-block;
            background: #667eea;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            text-align: center;
            line-height: 35px;
            margin-left: 10px;
            font-weight: bold;
        }

        .question-text {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 15px;
        }

        .options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 15px;
        }

        .option-label {
            background: white;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            font-weight: 600;
        }

        .option-label:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked+.option-label {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        .reset-btn {
            background: linear-gradient(135deg, #ff7675, #e84393);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .progress-container {
            background: #e2e8f0;
            border-radius: 10px;
            height: 10px;
            margin: 20px 0;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            width: 0%;
            transition: width 0.5s ease;
        }

        .result-box {
            margin-top: 20px;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            font-weight: bold;
            display: none;
        }

        .success {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
        }

        .warning {
            background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
            color: #2d3436;
        }

        .math-operation {
            font-family: 'Courier New', monospace;
            font-size: 1.3rem;
            background: #f1f3f4;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 10px 0;
            direction: ltr;
            text-align: center;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.6);
            background: linear-gradient(135deg, #2980b9, #3498db);
        }

        .back-btn:active {
            transform: translateY(0);
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.4);
        }

        .back-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .back-btn:hover::before {
            left: 100%;
        }

        .back-btn span {
            margin-right: 10px;
            font-size: 22px;
            transition: transform 0.3s ease;
        }

        .back-btn:hover span {
            transform: translateX(-5px);
        }

        .shape-box {
            background: #e8f4fd;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
        }

        .measurement-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 15px 0;
            text-align: center;
        }

        .measurement-cell {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: white;
            font-weight: bold;
        }

        .shape-visual {
            text-align: center;
            margin: 15px 0;
            font-size: 2rem;
        }

        .dimension-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 10px;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار القياس والهندسة 📏⚖️</h1>
            <p>اختبر مهاراتك في المجسمات والقياسات والمحيط والمساحة</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- المجسمات -->
            <div class="question">
                <span class="question-number">1</span>
                <div class="question-text">أي من المجسمات التالية له ٦ أوجه متطابقة؟</div>
                <div class="shape-visual">🧊 📦</div>
                <div class="options">
                    <input type="radio" id="q1_a" name="q1" value="cube">
                    <label for="q1_a" class="option-label">المكعب</label>

                    <input type="radio" id="q1_b" name="q1" value="sphere">
                    <label for="q1_b" class="option-label">الكرة</label>

                    <input type="radio" id="q1_c" name="q1" value="cylinder">
                    <label for="q1_c" class="option-label">الأسطوانة</label>

                    <input type="radio" id="q1_d" name="q1" value="cone">
                    <label for="q1_d" class="option-label">المخروط</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">2</span>
                <div class="question-text">أي مجسم ليس له أحرف أو رؤوس؟</div>
                <div class="shape-visual">⚽ 🏀</div>
                <div class="options">
                    <input type="radio" id="q2_a" name="q2" value="cube">
                    <label for="q2_a" class="option-label">المكعب</label>

                    <input type="radio" id="q2_b" name="q2" value="sphere">
                    <label for="q2_b" class="option-label">الكرة</label>

                    <input type="radio" id="q2_c" name="q2" value="pyramid">
                    <label for="q2_c" class="option-label">الهرم</label>

                    <input type="radio" id="q2_d" name="q2" value="cuboid">
                    <label for="q2_d" class="option-label">متوازي المستطيلات</label>
                </div>
            </div>

            <!-- وحدات قياس الكتلة -->
            <div class="question">
                <span class="question-number">3</span>
                <div class="question-text">ما الوحدة المناسبة لقياس كتلة كتاب؟</div>
                <div class="shape-box">الكتلة: مقدار المادة في الجسم</div>
                <div class="options">
                    <input type="radio" id="q3_a" name="q3" value="kg">
                    <label for="q3_a" class="option-label">كيلوجرام</label>

                    <input type="radio" id="q3_b" name="q3" value="g">
                    <label for="q3_b" class="option-label">جرام</label>

                    <input type="radio" id="q3_c" name="q3" value="ton">
                    <label for="q3_c" class="option-label">طن</label>

                    <input type="radio" id="q3_d" name="q3" value="mg">
                    <label for="q3_d" class="option-label">مليجرام</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">4</span>
                <div class="question-text">كم جراماً في ٢ كيلوجرام؟</div>
                <div class="math-operation">1 كيلوجرام = 1000 جرام</div>
                <div class="options">
                    <input type="radio" id="q4_a" name="q4" value="200">
                    <label for="q4_a" class="option-label">٢٠٠</label>

                    <input type="radio" id="q4_b" name="q4" value="2000">
                    <label for="q4_b" class="option-label">٢٠٠٠</label>

                    <input type="radio" id="q4_c" name="q4" value="20">
                    <label for="q4_c" class="option-label">٢٠</label>

                    <input type="radio" id="q4_d" name="q4" value="20000">
                    <label for="q4_d" class="option-label">٢٠٠٠٠</label>
                </div>
            </div>

            <!-- وحدات قياس الطول -->
            <div class="question">
                <span class="question-number">5</span>
                <div class="question-text">ما الوحدة المناسبة لقياس طول الفصل؟</div>
                <div class="shape-box">الطول: المسافة بين نقطتين</div>
                <div class="options">
                    <input type="radio" id="q5_a" name="q5" value="cm">
                    <label for="q5_a" class="option-label">سنتيمتر</label>

                    <input type="radio" id="q5_b" name="q5" value="m">
                    <label for="q5_b" class="option-label">متر</label>

                    <input type="radio" id="q5_c" name="q5" value="km">
                    <label for="q5_c" class="option-label">كيلومتر</label>

                    <input type="radio" id="q5_d" name="q5" value="mm">
                    <label for="q5_d" class="option-label">مليمتر</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">6</span>
                <div class="question-text">كم سنتيمتراً في ٣ أمتار؟</div>
                <div class="math-operation">1 متر = 100 سنتيمتر</div>
                <div class="options">
                    <input type="radio" id="q6_a" name="q6" value="30">
                    <label for="q6_a" class="option-label">٣٠</label>

                    <input type="radio" id="q6_b" name="q6" value="300">
                    <label for="q6_b" class="option-label">٣٠٠</label>

                    <input type="radio" id="q6_c" name="q6" value="3000">
                    <label for="q6_c" class="option-label">٣٠٠٠</label>

                    <input type="radio" id="q6_d" name="q6" value="3">
                    <label for="q6_d" class="option-label">٣</label>
                </div>
            </div>

            <!-- وحدات قياس الزمن -->
            <div class="question">
                <span class="question-number">7</span>
                <div class="question-text">كم دقيقة في ساعتين؟</div>
                <div class="math-operation">1 ساعة = 60 دقيقة</div>
                <div class="options">
                    <input type="radio" id="q7_a" name="q7" value="120">
                    <label for="q7_a" class="option-label">١٢٠</label>

                    <input type="radio" id="q7_b" name="q7" value="60">
                    <label for="q7_b" class="option-label">٦٠</label>

                    <input type="radio" id="q7_c" name="q7" value="180">
                    <label for="q7_c" class="option-label">١٨٠</label>

                    <input type="radio" id="q7_d" name="q7" value="240">
                    <label for="q7_d" class="option-label">٢٤٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">8</span>
                <div class="question-text">ما الوحدة المناسبة لقياس مدة الحصة الدراسية؟</div>
                <div class="options">
                    <input type="radio" id="q8_a" name="q8" value="seconds">
                    <label for="q8_a" class="option-label">ثواني</label>

                    <input type="radio" id="q8_b" name="q8" value="minutes">
                    <label for="q8_b" class="option-label">دقائق</label>

                    <input type="radio" id="q8_c" name="q8" value="hours">
                    <label for="q8_c" class="option-label">ساعات</label>

                    <input type="radio" id="q8_d" name="q8" value="days">
                    <label for="q8_d" class="option-label">أيام</label>
                </div>
            </div>

            <!-- المحيط -->
            <div class="question">
                <span class="question-number">9</span>
                <div class="question-text">ما محيط مربع طول ضلعه ٥ سم؟</div>
                <div class="shape-box">محيط المربع = ٤ × طول الضلع</div>
                <div class="options">
                    <input type="radio" id="q9_a" name="q9" value="20">
                    <label for="q9_a" class="option-label">٢٠ سم</label>

                    <input type="radio" id="q9_b" name="q9" value="25">
                    <label for="q9_b" class="option-label">٢٥ سم</label>

                    <input type="radio" id="q9_c" name="q9" value="10">
                    <label for="q9_c" class="option-label">١٠ سم</label>

                    <input type="radio" id="q9_d" name="q9" value="15">
                    <label for="q9_d" class="option-label">١٥ سم</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">10</span>
                <div class="question-text">ما محيط مستطيل طوله ٨ سم وعرضه ٤ سم؟</div>
                <div class="shape-box">محيط المستطيل = ٢ × (الطول + العرض)</div>
                <div class="options">
                    <input type="radio" id="q10_a" name="q10" value="24">
                    <label for="q10_a" class="option-label">٢٤ سم</label>

                    <input type="radio" id="q10_b" name="q10" value="32">
                    <label for="q10_b" class="option-label">٣٢ سم</label>

                    <input type="radio" id="q10_c" name="q10" value="12">
                    <label for="q10_c" class="option-label">١٢ سم</label>

                    <input type="radio" id="q10_d" name="q10" value="16">
                    <label for="q10_d" class="option-label">١٦ سم</label>
                </div>
            </div>

            <!-- المساحة -->
            <div class="question">
                <span class="question-number">11</span>
                <div class="question-text">ما مساحة مربع طول ضلعه ٦ سم؟</div>
                <div class="shape-box">مساحة المربع = طول الضلع × طول الضلع</div>
                <div class="options">
                    <input type="radio" id="q11_a" name="q11" value="12">
                    <label for="q11_a" class="option-label">١٢ سم²</label>

                    <input type="radio" id="q11_b" name="q11" value="24">
                    <label for="q11_b" class="option-label">٢٤ سم²</label>

                    <input type="radio" id="q11_c" name="q11" value="36">
                    <label for="q11_c" class="option-label">٣٦ سم²</label>

                    <input type="radio" id="q11_d" name="q11" value="30">
                    <label for="q11_d" class="option-label">٣٠ سم²</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">12</span>
                <div class="question-text">ما مساحة مستطيل طوله ٧ سم وعرضه ٣ سم؟</div>
                <div class="shape-box">مساحة المستطيل = الطول × العرض</div>
                <div class="options">
                    <input type="radio" id="q12_a" name="q12" value="10">
                    <label for="q12_a" class="option-label">١٠ سم²</label>

                    <input type="radio" id="q12_b" name="q12" value="21">
                    <label for="q12_b" class="option-label">٢١ سم²</label>

                    <input type="radio" id="q12_c" name="q12" value="20">
                    <label for="q12_c" class="option-label">٢٠ سم²</label>

                    <input type="radio" id="q12_d" name="q12" value="24">
                    <label for="q12_d" class="option-label">٢٤ سم²</label>
                </div>
            </div>

            <!-- تحويل الوحدات -->
            <div class="question">
                <span class="question-number">13</span>
                <div class="question-text">كم متراً في ٢ كيلومتر؟</div>
                <div class="math-operation">1 كيلومتر = 1000 متر</div>
                <div class="options">
                    <input type="radio" id="q13_a" name="q13" value="200">
                    <label for="q13_a" class="option-label">٢٠٠</label>

                    <input type="radio" id="q13_b" name="q13" value="2000">
                    <label for="q13_b" class="option-label">٢٠٠٠</label>

                    <input type="radio" id="q13_c" name="q13" value="20">
                    <label for="q13_c" class="option-label">٢٠</label>

                    <input type="radio" id="q13_d" name="q13" value="20000">
                    <label for="q13_d" class="option-label">٢٠٠٠٠</label>
                </div>
            </div>

            <!-- مسائل عملية -->
            <div class="question">
                <span class="question-number">14</span>
                <div class="question-text">إذا كان محيط ملعب مربع الشكل ٤٠ متراً، فما طول ضلعه؟</div>
                <div class="math-operation">محيط المربع = ٤ × طول الضلع</div>
                <div class="options">
                    <input type="radio" id="q14_a" name="q14" value="8">
                    <label for="q14_a" class="option-label">٨ أمتار</label>

                    <input type="radio" id="q14_b" name="q14" value="10">
                    <label for="q14_b" class="option-label">١٠ أمتار</label>

                    <input type="radio" id="q14_c" name="q14" value="12">
                    <label for="q14_c" class="option-label">١٢ أمتار</label>

                    <input type="radio" id="q14_d" name="q14" value="15">
                    <label for="q14_d" class="option-label">١٥ أمتار</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">15</span>
                <div class="question-text">إذا كانت مساحة غرفة مستطيلة ٢٤ م²، وطولها ٦ م، فما عرضها؟</div>
                <div class="math-operation">مساحة المستطيل = الطول × العرض</div>
                <div class="options">
                    <input type="radio" id="q15_a" name="q15" value="3">
                    <label for="q15_a" class="option-label">٣ أمتار</label>

                    <input type="radio" id="q15_b" name="q15" value="4">
                    <label for="q15_b" class="option-label">٤ أمتار</label>

                    <input type="radio" id="q15_c" name="q15" value="5">
                    <label for="q15_c" class="option-label">٥ أمتار</label>

                    <input type="radio" id="q15_d" name="q15" value="6">
                    <label for="q15_d" class="option-label">٦ أمتار</label>
                </div>
            </div>

            <div class="controls">
                <button type="button" class="btn submit-btn" onclick="calculateScore()">📤 إرسال الإجابات</button>
                <button type="button" class="btn reset-btn" onclick="resetExam()">🔄 إعادة تعيين</button>
            </div>
        </form>

        <div class="result-box" id="resultBox"></div>
    </div>

    <script>
        // الإجابات الصحيحة
        const correctAnswers = {
            q1: "cube",     // المكعب له 6 أوجه متطابقة
            q2: "sphere",   // الكرة ليس لها أحرف أو رؤوس
            q3: "g",        // جرام لقياس كتاب
            q4: "2000",     // 2 كجم = 2000 جرام
            q5: "m",        // متر لقياس طول الفصل
            q6: "300",      // 3 م = 300 سم
            q7: "120",      // ساعتين = 120 دقيقة
            q8: "minutes",  // دقائق لقياس الحصة
            q9: "20",       // محيط المربع = 4 × 5 = 20
            q10: "24",      // محيط المستطيل = 2 × (8 + 4) = 24
            q11: "36",      // مساحة المربع = 6 × 6 = 36
            q12: "21",      // مساحة المستطيل = 7 × 3 = 21
            q13: "2000",    // 2 كم = 2000 م
            q14: "10",      // طول الضلع = 40 ÷ 4 = 10
            q15: "4"        // العرض = 24 ÷ 6 = 4
        };

        // تحديث شريط التقدم
        function updateProgress() {
            const totalQuestions = Object.keys(correctAnswers).length;
            const answeredQuestions = document.querySelectorAll('input[type="radio"]:checked').length;
            const progressPercentage = (answeredQuestions / totalQuestions) * 100;

            document.getElementById('progressBar').style.width = `${progressPercentage}%`;
        }

        // إضافة مستمعي الأحداث للخيارات
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', updateProgress);
        });

        // حساب النتيجة
        function calculateScore() {
            let score = 0;
            const totalQuestions = Object.keys(correctAnswers).length;
            let answeredQuestions = 0;

            // حساب النقاط
            for (const [question, correctAnswer] of Object.entries(correctAnswers)) {
                const selectedOption = document.querySelector(`input[name="${question}"]:checked`);

                if (selectedOption) {
                    answeredQuestions++;
                    if (selectedOption.value === correctAnswer) {
                        score++;
                    }
                }
            }

            // التحقق من الإجابة على جميع الأسئلة
            if (answeredQuestions < totalQuestions) {
                showResult(`⚠️ لم تجب على جميع الأسئلة!<br>أجب على ${answeredQuestions} من ${totalQuestions} سؤال`,
                    'warning');
                return;
            }

            // إرسال النتيجة
            submitExam(score);
        }

        // إرسال النتيجة إلى الخادم
        async function submitExam(score) {
            try {
                const form = document.getElementById('examForm');
                const formData = new FormData(form);
                formData.append('score', score);

                showResult('⏳ جاري إرسال النتيجة...', 'warning');

                const response = await fetch('{{ route('mathplay.exam.submit') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData,
                    credentials: 'same-origin'
                });

                const data = await response.json();

                if (data.success) {
                    showResult(
                        `🎉 <strong>أحسنت!</strong><br>
                         نتيجتك: <strong>${data.score}</strong> من ${Object.keys(correctAnswers).length}<br>
                         <small>${data.message || 'تم حفظ النتيجة بنجاح'}</small>`,
                        'success'
                    );
                } else {
                    throw new Error(data.error || 'حدث خطأ غير معروف');
                }

            } catch (error) {
                showResult(`❌ حدث خطأ: ${error.message}`, 'warning');
            }
        }

        // عرض النتيجة
        function showResult(message, type) {
            const resultBox = document.getElementById('resultBox');
            resultBox.style.display = 'block';
            resultBox.innerHTML = message;
            resultBox.className = 'result-box ' + type;
        }

        // إعادة تعيين الاختبار
        function resetExam() {
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.checked = false;
            });

            document.getElementById('resultBox').style.display = 'none';
            updateProgress();

            showResult('🔄 تم إعادة تعيين الاختبار', 'warning');
            setTimeout(() => {
                document.getElementById('resultBox').style.display = 'none';
            }, 2000);
        }

        // تهيئة الصفحة
        document.addEventListener('DOMContentLoaded', updateProgress);
    </script>
</body>

</html>
