<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الرياضيات - المستوى الأول</title>
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
            max-width: 900px;
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

        .lesson-section {
            background: #e8f4fc;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #3498db;
        }

        .lesson-title {
            color: #2c3e50;
            font-size: 1.4rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .lesson-title::before {
            content: "📚";
            font-size: 1.6rem;
        }

        .question {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            border-right: 4px solid #667eea;
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
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            margin-left: 10px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .question-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 12px;
        }

        .options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 12px;
        }

        .option-label {
            background: white;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
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
            font-family: 'Cairo', sans-serif;
            font-size: 1.3rem;
            background: #f1f3f4;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
        }

        .number-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background: #667eea;
            color: white;
            border-radius: 50%;
            margin: 0 3px;
            font-weight: bold;
        }

        .visual-representation {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .visual-item {
            width: 35px;
            height: 35px;
            background: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
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
            margin-right: 8px;
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .back-btn:hover span {
            transform: translateX(-5px);
        }

        .score-breakdown {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            display: none;
        }

        .lesson-score {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .lesson-score:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الرياضيات - المستوى الأول 🧮</h1>
            <p>اختبر مهاراتك في الدروس: العدد صفر، مكونات الأعداد، الجمع والطرح ضمن 9</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم العدد صفر -->
            <div class="lesson-section">
                <div class="lesson-title">العدد صفر</div>

                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما هو العدد الذي يمثل "لا شيء"؟</div>
                    <div class="visual-representation">
                        <div class="visual-item" style="background: transparent; border: 2px dashed #ccc;">🚫</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="1">
                        <label for="q1_a" class="option-label">١</label>

                        <input type="radio" id="q1_b" name="q1" value="0">
                        <label for="q1_b" class="option-label">٠</label>

                        <input type="radio" id="q1_c" name="q1" value="2">
                        <label for="q1_c" class="option-label">٢</label>

                        <input type="radio" id="q1_d" name="q1" value="3">
                        <label for="q1_d" class="option-label">٣</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">إذا كان لدينا 3 تفاحات وأكلناها جميعاً، كم يبقى معنا؟</div>
                    <div class="math-operation">🍎🍎🍎 → أكلناها جميعاً → ؟</div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="3">
                        <label for="q2_a" class="option-label">٣</label>

                        <input type="radio" id="q2_b" name="q2" value="0">
                        <label for="q2_b" class="option-label">٠</label>

                        <input type="radio" id="q2_c" name="q2" value="1">
                        <label for="q2_c" class="option-label">١</label>

                        <input type="radio" id="q2_d" name="q2" value="2">
                        <label for="q2_d" class="option-label">٢</label>
                    </div>
                </div>
            </div>

            <!-- قسم مكونات الأعداد ضمن 9 -->
            <div class="lesson-section">
                <div class="lesson-title">مكونات الأعداد ضمن 9</div>

                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">ما العددان اللذان مجموعهما يساوي 5؟</div>
                    <div class="math-operation">؟ + ؟ = ٥</div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="2,3">
                        <label for="q3_a" class="option-label">٢ و ٣</label>

                        <input type="radio" id="q3_b" name="q3" value="1,1">
                        <label for="q3_b" class="option-label">١ و ١</label>

                        <input type="radio" id="q3_c" name="q3" value="4,2">
                        <label for="q3_c" class="option-label">٤ و ٢</label>

                        <input type="radio" id="q3_d" name="q3" value="3,3">
                        <label for="q3_d" class="option-label">٣ و ٣</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">ما مكونات العدد 7؟</div>
                    <div class="visual-representation">
                        <div class="visual-item">⭐</div>
                        <div class="visual-item">⭐</div>
                        <div class="visual-item">⭐</div>
                        <div class="visual-item">⭐</div>
                        <div class="visual-item">⭐</div>
                        <div class="visual-item">⭐</div>
                        <div class="visual-item">⭐</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="4,3">
                        <label for="q4_a" class="option-label">٤ و ٣</label>

                        <input type="radio" id="q4_b" name="q4" value="2,2">
                        <label for="q4_b" class="option-label">٢ و ٢</label>

                        <input type="radio" id="q4_c" name="q4" value="5,1">
                        <label for="q4_c" class="option-label">٥ و ١</label>

                        <input type="radio" id="q4_d" name="q4" value="3,3">
                        <label for="q4_d" class="option-label">٣ و ٣</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">أي من هذه الأزواج لا يكون مجموعهما 8؟</div>
                    <div class="math-operation">❌ ؟ + ؟ ≠ ٨</div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="5,3">
                        <label for="q5_a" class="option-label">٥ و ٣</label>

                        <input type="radio" id="q5_b" name="q5" value="4,4">
                        <label for="q5_b" class="option-label">٤ و ٤</label>

                        <input type="radio" id="q5_c" name="q5" value="2,7">
                        <label for="q5_c" class="option-label">٢ و ٧</label>

                        <input type="radio" id="q5_d" name="q5" value="3,4">
                        <label for="q5_d" class="option-label">٣ و ٤</label>
                    </div>
                </div>
            </div>

            <!-- قسم الجمع ضمن 9 -->
            <div class="lesson-section">
                <div class="lesson-title">الجمع ضمن 9</div>

                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">ما ناتج جمع: ٤ + ٣؟</div>
                    <div class="math-operation">٤ + ٣ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="6">
                        <label for="q6_a" class="option-label">٦</label>

                        <input type="radio" id="q6_b" name="q6" value="7">
                        <label for="q6_b" class="option-label">٧</label>

                        <input type="radio" id="q6_c" name="q6" value="8">
                        <label for="q6_c" class="option-label">٨</label>

                        <input type="radio" id="q6_d" name="q6" value="9">
                        <label for="q6_d" class="option-label">٩</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">لدى أحمد 2 أقلام وأعطته أمه 5 أقلام أخرى. كم قلم أصبح معه؟</div>
                    <div class="math-operation">✏️✏️ + ✏️✏️✏️✏️✏️ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="6">
                        <label for="q7_a" class="option-label">٦</label>

                        <input type="radio" id="q7_b" name="q7" value="7">
                        <label for="q7_b" class="option-label">٧</label>

                        <input type="radio" id="q7_c" name="q7" value="8">
                        <label for="q7_c" class="option-label">٨</label>

                        <input type="radio" id="q7_d" name="q7" value="9">
                        <label for="q7_d" class="option-label">٩</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">ما ناتج جمع: ٦ + ٠؟</div>
                    <div class="math-operation">٦ + ٠ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="0">
                        <label for="q8_a" class="option-label">٠</label>

                        <input type="radio" id="q8_b" name="q8" value="6">
                        <label for="q8_b" class="option-label">٦</label>

                        <input type="radio" id="q8_c" name="q8" value="7">
                        <label for="q8_c" class="option-label">٧</label>

                        <input type="radio" id="q8_d" name="q8" value="8">
                        <label for="q8_d" class="option-label">٨</label>
                    </div>
                </div>
            </div>

            <!-- قسم الطرح ضمن 9 -->
            <div class="lesson-section">
                <div class="lesson-title">الطرح ضمن 9</div>

                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">ما ناتج طرح: ٨ - ٣؟</div>
                    <div class="math-operation">٨ - ٣ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="4">
                        <label for="q9_a" class="option-label">٤</label>

                        <input type="radio" id="q9_b" name="q9" value="5">
                        <label for="q9_b" class="option-label">٥</label>

                        <input type="radio" id="q9_c" name="q9" value="6">
                        <label for="q9_c" class="option-label">٦</label>

                        <input type="radio" id="q9_d" name="q9" value="7">
                        <label for="q9_d" class="option-label">٧</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">كان مع سارة 9 قطع حلوى، فأكلت 4 قطع. كم قطعة بقيت معها؟</div>
                    <div class="math-operation">🍬🍬🍬🍬🍬🍬🍬🍬🍬 - 🍬🍬🍬🍬 = ؟</div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="4">
                        <label for="q10_a" class="option-label">٤</label>

                        <input type="radio" id="q10_b" name="q10" value="5">
                        <label for="q10_b" class="option-label">٥</label>

                        <input type="radio" id="q10_c" name="q10" value="6">
                        <label for="q10_c" class="option-label">٦</label>

                        <input type="radio" id="q10_d" name="q10" value="7">
                        <label for="q10_d" class="option-label">٧</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">11</span>
                    <div class="question-text">ما ناتج طرح: ٧ - ٠؟</div>
                    <div class="math-operation">٧ - ٠ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q11_a" name="q11" value="0">
                        <label for="q11_a" class="option-label">٠</label>

                        <input type="radio" id="q11_b" name="q11" value="7">
                        <label for="q11_b" class="option-label">٧</label>

                        <input type="radio" id="q11_c" name="q11" value="6">
                        <label for="q11_c" class="option-label">٦</label>

                        <input type="radio" id="q11_d" name="q11" value="8">
                        <label for="q11_d" class="option-label">٨</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">12</span>
                    <div class="question-text">ما ناتج طرح: ٥ - ٥؟</div>
                    <div class="math-operation">٥ - ٥ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q12_a" name="q12" value="0">
                        <label for="q12_a" class="option-label">٠</label>

                        <input type="radio" id="q12_b" name="q12" value="5">
                        <label for="q12_b" class="option-label">٥</label>

                        <input type="radio" id="q12_c" name="q12" value="10">
                        <label for="q12_c" class="option-label">١٠</label>

                        <input type="radio" id="q12_d" name="q12" value="1">
                        <label for="q12_d" class="option-label">١</label>
                    </div>
                </div>
            </div>

            <div class="controls">
                <button type="button" class="btn submit-btn" onclick="calculateScore()">📤 إرسال الإجابات</button>
                <button type="button" class="btn reset-btn" onclick="resetExam()">🔄 إعادة تعيين</button>
            </div>
        </form>

        <div class="result-box" id="resultBox"></div>
        <div class="score-breakdown" id="scoreBreakdown"></div>
    </div>

    <script>
        // الإجابات الصحيحة
        const correctAnswers = {
            q1: "0",      // العدد صفر
            q2: "0",      // العدد صفر
            q3: "2,3",    // مكونات الأعداد
            q4: "4,3",    // مكونات الأعداد
            q5: "3,4",    // مكونات الأعداد
            q6: "7",      // الجمع
            q7: "7",      // الجمع
            q8: "6",      // الجمع
            q9: "5",      // الطرح
            q10: "5",     // الطرح
            q11: "7",     // الطرح
            q12: "0"      // الطرح
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

            // حساب النقاط لكل قسم
            const lessonScores = {
                'العدد صفر': { total: 2, correct: 0 },
                'مكونات الأعداد ضمن 9': { total: 3, correct: 0 },
                'الجمع ضمن 9': { total: 3, correct: 0 },
                'الطرح ضمن 9': { total: 4, correct: 0 }
            };

            // حساب النقاط
            for (const [question, correctAnswer] of Object.entries(correctAnswers)) {
                const selectedOption = document.querySelector(`input[name="${question}"]:checked`);

                if (selectedOption) {
                    answeredQuestions++;
                    if (selectedOption.value === correctAnswer) {
                        score++;

                        // تحديث نتائج الأقسام
                        if (['q1', 'q2'].includes(question)) {
                            lessonScores['العدد صفر'].correct++;
                        } else if (['q3', 'q4', 'q5'].includes(question)) {
                            lessonScores['مكونات الأعداد ضمن 9'].correct++;
                        } else if (['q6', 'q7', 'q8'].includes(question)) {
                            lessonScores['الجمع ضمن 9'].correct++;
                        } else if (['q9', 'q10', 'q11', 'q12'].includes(question)) {
                            lessonScores['الطرح ضمن 9'].correct++;
                        }
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
            submitExam(score, lessonScores);
        }

        // إرسال النتيجة إلى الخادم
        async function submitExam(score, lessonScores) {
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
                    showDetailedResult(score, Object.keys(correctAnswers).length, lessonScores, data.message);
                } else {
                    throw new Error(data.error || 'حدث خطأ غير معروف');
                }

            } catch (error) {
                showResult(`❌ حدث خطأ: ${error.message}`, 'warning');
            }
        }

        // عرض النتيجة التفصيلية
        function showDetailedResult(score, totalQuestions, lessonScores, message) {
            const resultBox = document.getElementById('resultBox');
            const breakdown = document.getElementById('scoreBreakdown');

            resultBox.style.display = 'block';
            resultBox.className = 'result-box success';
            resultBox.innerHTML = `
                🎉 <strong>أحسنت!</strong><br>
                نتيجتك: <strong>${score}</strong> من ${totalQuestions}<br>
                <small>${message || 'تم حفظ النتيجة بنجاح'}</small>
            `;

            // عرض تفصيلي للنتائج
            breakdown.style.display = 'block';
            breakdown.innerHTML = '<h4>تفصيل النتائج حسب الدروس:</h4>';

            for (const [lesson, results] of Object.entries(lessonScores)) {
                const percentage = Math.round((results.correct / results.total) * 100);
                const lessonDiv = document.createElement('div');
                lessonDiv.className = 'lesson-score';
                lessonDiv.innerHTML = `
                    <span>${lesson}</span>
                    <span>${results.correct}/${results.total} (${percentage}%)</span>
                `;
                breakdown.appendChild(lessonDiv);
            }
        }

        // عرض النتيجة
        function showResult(message, type) {
            const resultBox = document.getElementById('resultBox');
            resultBox.style.display = 'block';
            resultBox.innerHTML = message;
            resultBox.className = 'result-box ' + type;

            // إخفاء التفصيل إذا كان ظاهراً
            document.getElementById('scoreBreakdown').style.display = 'none';
        }

        // إعادة تعيين الاختبار
        function resetExam() {
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.checked = false;
            });

            document.getElementById('resultBox').style.display = 'none';
            document.getElementById('scoreBreakdown').style.display = 'none';
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
