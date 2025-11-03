<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الأعداد ضمن 99999</title>
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
            font-family: 'Cairo', sans-serif;
            font-size: 1.5rem;
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
            width: 40px;
            height: 40px;
            background: #667eea;
            color: white;
            border-radius: 50%;
            margin: 0 5px;
            font-weight: bold;
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

        .topic-section {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            border-right: 4px solid #3498db;
        }

        .topic-title {
            color: #2c3e50;
            font-size: 1.3rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .calculation-box {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-size: 1.4rem;
            font-weight: bold;
            font-family: 'Cairo', sans-serif;
        }

        .hint {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 8px 12px;
            margin: 10px 0;
            font-size: 0.9rem;
            color: #856404;
        }

        .place-value {
            background: #e8f5e8;
            border: 1px solid #c8e6c9;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            text-align: center;
            font-family: 'Cairo', sans-serif;
        }

        .number-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 5px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
        }

        .place-header {
            background: #667eea;
            color: white;
            padding: 8px;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .place-value-cell {
            background: #f8f9fa;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الأعداد ضمن 99999 🧮</h1>
            <p>اختبر مهاراتك في الأعداد الكبيرة والقيمة المنزلية والمقارنة</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم الأعداد ضمن 99999 -->
            <div class="topic-section">
                <div class="topic-title">الأعداد ضمن 99999</div>

                <!-- سؤال 1: قراءة الأعداد -->
                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما قيمة العدد "خمسة وثلاثون ألفاً وسبعمائة واثنان وأربعون"؟</div>
                    <div class="math-operation">خمسة وثلاثون ألفاً وسبعمائة واثنان وأربعون</div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="35742">
                        <label for="q1_a" class="option-label">٣٥٧٤٢</label>

                        <input type="radio" id="q1_b" name="q1" value="35724">
                        <label for="q1_b" class="option-label">٣٥٧٢٤</label>

                        <input type="radio" id="q1_c" name="q1" value="35752">
                        <label for="q1_c" class="option-label">٣٥٧٥٢</label>

                        <input type="radio" id="q1_d" name="q1" value="35762">
                        <label for="q1_d" class="option-label">٣٥٧٦٢</label>
                    </div>
                </div>

                <!-- سؤال 2: كتابة الأعداد -->
                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">كيف تكتب العدد ٤٨٦٢٧ بالكلمات؟</div>
                    <div class="calculation-box">٤٨٦٢٧</div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="ثمانية وأربعون ألفاً وستمائة وسبعة وعشرون">
                        <label for="q2_a" class="option-label">ثمانية وأربعون ألفاً وستمائة وسبعة وعشرون</label>

                        <input type="radio" id="q2_b" name="q2" value="ثمانية وأربعون ألفاً وستمائة وسبعة وعشرين">
                        <label for="q2_b" class="option-label">ثمانية وأربعون ألفاً وستمائة وسبعة وعشرين</label>

                        <input type="radio" id="q2_c" name="q2" value="ثمانية وأربعون ألفاً وستمائة وسبعون">
                        <label for="q2_c" class="option-label">ثمانية وأربعون ألفاً وستمائة وسبعون</label>

                        <input type="radio" id="q2_d" name="q2" value="ثمانية وأربعون ألفاً وستمائة وسبعة">
                        <label for="q2_d" class="option-label">ثمانية وأربعون ألفاً وستمائة وسبعة</label>
                    </div>
                </div>

                <!-- سؤال 3: العدد الذي يلي -->
                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">ما العدد الذي يلي العدد ٧٨٩٩٩؟</div>
                    <div class="math-operation">٧٨٩٩٩ → ؟</div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="79000">
                        <label for="q3_a" class="option-label">٧٩٠٠٠</label>

                        <input type="radio" id="q3_b" name="q3" value="78998">
                        <label for="q3_b" class="option-label">٧٨٩٩٨</label>

                        <input type="radio" id="q3_c" name="q3" value="79001">
                        <label for="q3_c" class="option-label">٧٩٠٠١</label>

                        <input type="radio" id="q3_d" name="q3" value="79010">
                        <label for="q3_d" class="option-label">٧٩٠١٠</label>
                    </div>
                </div>
            </div>

            <!-- قسم القيمة المنزلية والصورة الموسعة -->
            <div class="topic-section">
                <div class="topic-title">القيمة المنزلية والصورة الموسعة ضمن 99999</div>

                <!-- سؤال 4: القيمة المنزلية -->
                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">ما قيمة الرقم ٧ في العدد ٥٧٣٨٤؟</div>
                    <div class="place-value">
                        <div class="number-grid">
                            <div class="place-header">عشرات الآلاف</div>
                            <div class="place-header">آلاف</div>
                            <div class="place-header">مئات</div>
                            <div class="place-header">عشرات</div>
                            <div class="place-header">آحاد</div>
                            <div class="place-value-cell">٥</div>
                            <div class="place-value-cell">٧</div>
                            <div class="place-value-cell">٣</div>
                            <div class="place-value-cell">٨</div>
                            <div class="place-value-cell">٤</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="7000">
                        <label for="q4_a" class="option-label">٧٠٠٠</label>

                        <input type="radio" id="q4_b" name="q4" value="700">
                        <label for="q4_b" class="option-label">٧٠٠</label>

                        <input type="radio" id="q4_c" name="q4" value="70">
                        <label for="q4_c" class="option-label">٧٠</label>

                        <input type="radio" id="q4_d" name="q4" value="7">
                        <label for="q4_d" class="option-label">٧</label>
                    </div>
                </div>

                <!-- سؤال 5: الصورة الموسعة -->
                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">ما الصورة الموسعة للعدد ٤٢٦٩٥؟</div>
                    <div class="calculation-box">٤٢٦٩٥</div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="40000+2000+600+90+5">
                        <label for="q5_a" class="option-label">٤٠٠٠٠ + ٢٠٠٠ + ٦٠٠ + ٩٠ + ٥</label>

                        <input type="radio" id="q5_b" name="q5" value="40000+2000+600+95">
                        <label for="q5_b" class="option-label">٤٠٠٠٠ + ٢٠٠٠ + ٦٠٠ + ٩٥</label>

                        <input type="radio" id="q5_c" name="q5" value="40000+2600+90+5">
                        <label for="q5_c" class="option-label">٤٠٠٠٠ + ٢٦٠٠ + ٩٠ + ٥</label>

                        <input type="radio" id="q5_d" name="q5" value="40000+2000+695">
                        <label for="q5_d" class="option-label">٤٠٠٠٠ + ٢٠٠٠ + ٦٩٥</label>
                    </div>
                </div>

                <!-- سؤال 6: تكوين العدد -->
                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">ما العدد المكون من: ٣٠٠٠٠ + ٨٠٠٠ + ٤٠٠ + ٥٠ + ٦؟</div>
                    <div class="math-operation">٣٠٠٠٠ + ٨٠٠٠ + ٤٠٠ + ٥٠ + ٦ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="38456">
                        <label for="q6_a" class="option-label">٣٨٤٥٦</label>

                        <input type="radio" id="q6_b" name="q6" value="38465">
                        <label for="q6_b" class="option-label">٣٨٤٦٥</label>

                        <input type="radio" id="q6_c" name="q6" value="38546">
                        <label for="q6_c" class="option-label">٣٨٥٤٦</label>

                        <input type="radio" id="q6_d" name="q6" value="38645">
                        <label for="q6_d" class="option-label">٣٨٦٤٥</label>
                    </div>
                </div>
            </div>

            <!-- قسم مقارنة الأعداد ضمن 99999 -->
            <div class="topic-section">
                <div class="topic-title">مقارنة الأعداد ضمن 99999</div>

                <!-- سؤال 7: المقارنة باستخدام الرموز -->
                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">أي رمز يجب وضعه بين العددين؟</div>
                    <div class="calculation-box">٤٥٦٧٨ ؟ ٤٥٦٨٧</div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="<">
                        <label for="q7_a" class="option-label">&lt; (أصغر من)</label>

                        <input type="radio" id="q7_b" name="q7" value=">">
                        <label for="q7_b" class="option-label">&gt; (أكبر من)</label>

                        <input type="radio" id="q7_c" name="q7" value="=">
                        <label for="q7_c" class="option-label">= (يساوي)</label>

                        <input type="radio" id="q7_d" name="q7" value=">=">
                        <label for="q7_d" class="option-label">≥ (أكبر من أو يساوي)</label>
                    </div>
                </div>

                <!-- سؤال 8: ترتيب الأعداد -->
                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">رتب الأعداد التالية من الأصغر إلى الأكبر:</div>
                    <div class="math-operation">٣٤٥٦٧ ، ٣٤٥٧٦ ، ٣٤٥٦٠</div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="34560,34567,34576">
                        <label for="q8_a" class="option-label">٣٤٥٦٠ ، ٣٤٥٦٧ ، ٣٤٥٧٦</label>

                        <input type="radio" id="q8_b" name="q8" value="34567,34576,34560">
                        <label for="q8_b" class="option-label">٣٤٥٦٧ ، ٣٤٥٧٦ ، ٣٤٥٦٠</label>

                        <input type="radio" id="q8_c" name="q8" value="34576,34567,34560">
                        <label for="q8_c" class="option-label">٣٤٥٧٦ ، ٣٤٥٦٧ ، ٣٤٥٦٠</label>

                        <input type="radio" id="q8_d" name="q8" value="34560,34576,34567">
                        <label for="q8_d" class="option-label">٣٤٥٦٠ ، ٣٤٥٧٦ ، ٣٤٥٦٧</label>
                    </div>
                </div>

                <!-- سؤال 9: العدد الأكبر -->
                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">أي من هذه الأعداد هو الأكبر؟</div>
                    <div class="math-operation">٦٧٨٩٠ ، ٦٧٩٠٨ ، ٦٧٨٠٩</div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="67890">
                        <label for="q9_a" class="option-label">٦٧٨٩٠</label>

                        <input type="radio" id="q9_b" name="q9" value="67908">
                        <label for="q9_b" class="option-label">٦٧٩٠٨</label>

                        <input type="radio" id="q9_c" name="q9" value="67809">
                        <label for="q9_c" class="option-label">٦٧٨٠٩</label>

                        <input type="radio" id="q9_d" name="q9" value="67899">
                        <label for="q9_d" class="option-label">٦٧٨٩٩</label>
                    </div>
                </div>

                <!-- سؤال 10: المقارنة مع القيمة المنزلية -->
                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">أي عددين متساويان في قيمة خانة الآلاف؟</div>
                    <div class="math-operation">أ) ٢٣٤٥٦    ب) ٣٢٤٥٦    ج) ٢٣٥٤٦    د) ٢٤٣٥٦</div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="a,c">
                        <label for="q10_a" class="option-label">أ و ج</label>

                        <input type="radio" id="q10_b" name="q10" value="a,b">
                        <label for="q10_b" class="option-label">أ و ب</label>

                        <input type="radio" id="q10_c" name="q10" value="b,d">
                        <label for="q10_c" class="option-label">ب و د</label>

                        <input type="radio" id="q10_d" name="q10" value="c,d">
                        <label for="q10_d" class="option-label">ج و د</label>
                    </div>
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
            q1: "35742",
            q2: "ثمانية وأربعون ألفاً وستمائة وسبعة وعشرون",
            q3: "79000",
            q4: "7000",
            q5: "40000+2000+600+90+5",
            q6: "38456",
            q7: "<",
            q8: "34560,34567,34576",
            q9: "67908",
            q10: "a,c"
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
