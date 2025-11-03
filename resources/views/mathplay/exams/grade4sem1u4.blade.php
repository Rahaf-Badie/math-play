<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الهندسة - المستقيمات والزوايا</title>
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

        .geometry-visual {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            text-align: center;
            position: relative;
        }

        .angle-symbol {
            font-size: 1.8rem;
            color: #667eea;
            margin: 0 5px;
        }

        .parallel-lines {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            margin: 15px 0;
        }

        .line {
            height: 3px;
            background: #667eea;
            width: 200px;
        }

        .perpendicular-lines {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 20px auto;
        }

        .horizontal-line {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 3px;
            background: #667eea;
            transform: translateY(-50%);
        }

        .vertical-line {
            position: absolute;
            left: 50%;
            top: 0;
            height: 100%;
            width: 3px;
            background: #667eea;
            transform: translateX(-50%);
        }

        .triangle {
            width: 0;
            height: 0;
            border-left: 60px solid transparent;
            border-right: 60px solid transparent;
            border-bottom: 100px solid #667eea;
            margin: 20px auto;
            position: relative;
        }

        .angle-label {
            position: absolute;
            font-size: 1.2rem;
            font-weight: bold;
            color: #e84393;
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

        .angle-measure {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الهندسة - المستقيمات والزوايا 📐</h1>
            <p>اختبر مهاراتك في المستقيمات المتوازية والمتعامدة والزوايا</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم المستقيمات المتوازية والمتعامدة -->
            <div class="topic-section">
                <div class="topic-title">المستقيمات المتوازية والمتعامدة</div>

                <!-- سؤال 1: المستقيمات المتوازية -->
                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">أي من الأشكال التالية يمثل مستقيمين متوازيين؟</div>
                    <div class="geometry-visual">
                        <div class="parallel-lines">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="hint">💡 المستقيمات المتوازية لا تلتقي أبداً</div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="parallel">
                        <label for="q1_a" class="option-label">مستقيمين لا يلتقيان أبداً</label>

                        <input type="radio" id="q1_b" name="q1" value="intersecting">
                        <label for="q1_b" class="option-label">مستقيمين يلتقيان في نقطة</label>

                        <input type="radio" id="q1_c" name="q1" value="perpendicular">
                        <label for="q1_c" class="option-label">مستقيمين متعامدين</label>

                        <input type="radio" id="q1_d" name="q1" value="curved">
                        <label for="q1_d" class="option-label">مستقيمين منحنيين</label>
                    </div>
                </div>

                <!-- سؤال 2: المستقيمات المتعامدة -->
                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">ما هي الزاوية بين مستقيمين متعامدين؟</div>
                    <div class="geometry-visual">
                        <div class="perpendicular-lines">
                            <div class="horizontal-line"></div>
                            <div class="vertical-line"></div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="45">
                        <label for="q2_a" class="option-label">٤٥°</label>

                        <input type="radio" id="q2_b" name="q2" value="90">
                        <label for="q2_b" class="option-label">٩٠°</label>

                        <input type="radio" id="q2_c" name="q2" value="180">
                        <label for="q2_c" class="option-label">١٨٠°</label>

                        <input type="radio" id="q2_d" name="q2" value="360">
                        <label for="q2_d" class="option-label">٣٦٠°</label>
                    </div>
                </div>

                <!-- سؤال 3: التعرف على المستقيمات -->
                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">إذا تقاطع مستقيمان وشكلا زاوية قائمة (٩٠°)، فإنهما يسميان:</div>
                    <div class="math-operation">مستقيمان + زاوية ٩٠° = ؟</div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="parallel">
                        <label for="q3_a" class="option-label">مستقيمان متوازيان</label>

                        <input type="radio" id="q3_b" name="q3" value="perpendicular">
                        <label for="q3_b" class="option-label">مستقيمان متعامدان</label>

                        <input type="radio" id="q3_c" name="q3" value="intersecting">
                        <label for="q3_c" class="option-label">مستقيمان متقاطعان</label>

                        <input type="radio" id="q3_d" name="q3" value="curved">
                        <label for="q3_d" class="option-label">مستقيمان منحنيان</label>
                    </div>
                </div>
            </div>

            <!-- قسم الزوايا -->
            <div class="topic-section">
                <div class="topic-title">الزوايا</div>

                <!-- سؤال 4: أنواع الزوايا -->
                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">ما نوع الزاوية التي قياسها ١٢٠°؟</div>
                    <div class="angle-measure">١٢٠°</div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="acute">
                        <label for="q4_a" class="option-label">زاوية حادة (أقل من ٩٠°)</label>

                        <input type="radio" id="q4_b" name="q4" value="right">
                        <label for="q4_b" class="option-label">زاوية قائمة (٩٠°)</label>

                        <input type="radio" id="q4_c" name="q4" value="obtuse">
                        <label for="q4_c" class="option-label">زاوية منفرجة (أكبر من ٩٠° وأقل من ١٨٠°)</label>

                        <input type="radio" id="q4_d" name="q4" value="straight">
                        <label for="q4_d" class="option-label">زاوية مستقيمة (١٨٠°)</label>
                    </div>
                </div>

                <!-- سؤال 5: الزوايا المتكاملة -->
                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">إذا كانت الزاوية أ = ٦٠°، فما قياس الزاوية المتكاملة لها؟</div>
                    <div class="math-operation">الزاوية المتكاملة = ١٨٠° - أ</div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="120">
                        <label for="q5_a" class="option-label">١٢٠°</label>

                        <input type="radio" id="q5_b" name="q5" value="100">
                        <label for="q5_b" class="option-label">١٠٠°</label>

                        <input type="radio" id="q5_c" name="q5" value="90">
                        <label for="q5_c" class="option-label">٩٠°</label>

                        <input type="radio" id="q5_d" name="q5" value="80">
                        <label for="q5_d" class="option-label">٨٠°</label>
                    </div>
                </div>

                <!-- سؤال 6: الزوايا المتناظرة -->
                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">ما نوع الزوايا التي تتشكل عندما يقطع مستقيم مستقيمين متوازيين؟</div>
                    <div class="geometry-visual">
                        <div style="text-align: center; font-weight: bold; color: #667eea;">
                            مستقيم قاطع + مستقيمين متوازيين
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="corresponding">
                        <label for="q6_a" class="option-label">زوايا متناظرة ومتساوية</label>

                        <input type="radio" id="q6_b" name="q6" value="complementary">
                        <label for="q6_b" class="option-label">زوايا متكاملة</label>

                        <input type="radio" id="q6_c" name="q6" value="supplementary">
                        <label for="q6_c" class="option-label">زوايا متتامة</label>

                        <input type="radio" id="q6_d" name="q6" value="vertical">
                        <label for="q6_d" class="option-label">زوايا رأسية</label>
                    </div>
                </div>
            </div>

            <!-- قسم زوايا المثلث -->
            <div class="topic-section">
                <div class="topic-title">زوايا المثلث</div>

                <!-- سؤال 7: مجموع زوايا المثلث -->
                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">ما مجموع زوايا أي مثلث؟</div>
                    <div class="geometry-visual">
                        <div class="triangle"></div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="90">
                        <label for="q7_a" class="option-label">٩٠°</label>

                        <input type="radio" id="q7_b" name="q7" value="180">
                        <label for="q7_b" class="option-label">١٨٠°</label>

                        <input type="radio" id="q7_c" name="q7" value="270">
                        <label for="q7_c" class="option-label">٢٧٠°</label>

                        <input type="radio" id="q7_d" name="q7" value="360">
                        <label for="q7_d" class="option-label">٣٦٠°</label>
                    </div>
                </div>

                <!-- سؤال 8: حساب زاوية مجهولة -->
                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">في مثلث، إذا كانت زاويتان ٥٠° و ٦٠°، فما قياس الزاوية الثالثة؟</div>
                    <div class="math-operation">١٨٠° - (٥٠° + ٦٠°) = ؟</div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="70">
                        <label for="q8_a" class="option-label">٧٠°</label>

                        <input type="radio" id="q8_b" name="q8" value="80">
                        <label for="q8_b" class="option-label">٨٠°</label>

                        <input type="radio" id="q8_c" name="q8" value="90">
                        <label for="q8_c" class="option-label">٩٠°</label>

                        <input type="radio" id="q8_d" name="q8" value="100">
                        <label for="q8_d" class="option-label">١٠٠°</label>
                    </div>
                </div>

                <!-- سؤال 9: أنواع المثلثات حسب الزوايا -->
                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">ما نوع المثلث الذي يحتوي على زاوية قائمة (٩٠°)</div>
                    <div class="geometry-visual">
                        <div style="text-align: center; font-weight: bold; color: #667eea;">
                            مثلث قائم الزاوية
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="acute">
                        <label for="q9_a" class="option-label">مثلث حاد الزوايا</label>

                        <input type="radio" id="q9_b" name="q9" value="right">
                        <label for="q9_b" class="option-label">مثلث قائم الزاوية</label>

                        <input type="radio" id="q9_c" name="q9" value="obtuse">
                        <label for="q9_c" class="option-label">مثلث منفرج الزاوية</label>

                        <input type="radio" id="q9_d" name="q9" value="equilateral">
                        <label for="q9_d" class="option-label">مثلث متساوي الأضلاع</label>
                    </div>
                </div>

                <!-- سؤال 10: الزاوية الخارجة للمثلث -->
                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">الزاوية الخارجة للمثلث تساوي مجموع:</div>
                    <div class="math-operation">الزاوية الخارجة = ؟</div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="two_interior">
                        <label for="q10_a" class="option-label">الزاويتين الداخليتين غير المجاورتين لها</label>

                        <input type="radio" id="q10_b" name="q10" value="all_interior">
                        <label for="q10_b" class="option-label">الزوايا الداخلية الثلاث</label>

                        <input type="radio" id="q10_c" name="q10" value="one_interior">
                        <label for="q10_c" class="option-label">الزاوية الداخلية المجاورة فقط</label>

                        <input type="radio" id="q10_d" name="q10" value="exterior_only">
                        <label for="q10_d" class="option-label">الزوايا الخارجة الأخرى</label>
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
            q1: "parallel",
            q2: "90",
            q3: "perpendicular",
            q4: "obtuse",
            q5: "120",
            q6: "corresponding",
            q7: "180",
            q8: "70",
            q9: "right",
            q10: "two_interior"
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
