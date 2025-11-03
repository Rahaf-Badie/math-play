<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الرياضيات - العمليات الحسابية ضمن 99999</title>
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
            font-size: 1.6rem;
        }

        .lesson-section:nth-child(1) .lesson-title::before { content: "🎯"; }
        .lesson-section:nth-child(2) .lesson-title::before { content: "➕"; }
        .lesson-section:nth-child(3) .lesson-title::before { content: "➖"; }
        .lesson-section:nth-child(4) .lesson-title::before { content: "🔄"; }
        .lesson-section:nth-child(5) .lesson-title::before { content: "✅"; }

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
            direction: ltr;
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

        /* أنماط خاصة بالعمليات الحسابية */
        .calculation-box {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 1.1rem;
        }

        .carry-over {
            color: #e74c3c;
            font-weight: bold;
        }

        .borrow-step {
            color: #3498db;
            font-weight: bold;
        }

        .verification-box {
            background: #e8f6f3;
            border: 2px solid #1abc9c;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
        }

        .verification-title {
            font-weight: bold;
            color: #16a085;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .operation-steps {
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            border-right: 3px solid #3498db;
        }

        .step {
            margin: 5px 0;
            padding: 5px;
            border-bottom: 1px dashed #ddd;
        }

        .relationship-box {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 15px 0;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .relationship-arrow {
            font-size: 1.5rem;
            color: #e74c3c;
        }

        .number-input {
            width: 100px;
            padding: 8px;
            border: 2px solid #3498db;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            direction: ltr;
        }

        .rounding-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .estimation-result {
            background: #2ecc71;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الرياضيات - العمليات الحسابية ضمن 99999 🧮</h1>
            <p>اختبر مهاراتك في التقريب، الجمع، الطرح، والتحقق من العمليات</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم التقريب -->
            <div class="lesson-section">
                <div class="lesson-title">التقريب</div>

                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">قرب العدد ٤٧٬٣٨٢ إلى أقرب ألف</div>
                    <div class="rounding-visual">
                        <span>٤٧٬٠٠٠ ← </span>
                        <span style="color: #e74c3c; font-weight: bold;">٤٧٬٣٨٢</span>
                        <span> → ٤٨٬٠٠٠</span>
                    </div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="47000">
                        <label for="q1_a" class="option-label">٤٧٬٠٠٠</label>

                        <input type="radio" id="q1_b" name="q1" value="47300">
                        <label for="q1_b" class="option-label">٤٧٬٣٠٠</label>

                        <input type="radio" id="q1_c" name="q1" value="48000">
                        <label for="q1_c" class="option-label">٤٨٬٠٠٠</label>

                        <input type="radio" id="q1_d" name="q1" value="47382">
                        <label for="q1_d" class="option-label">٤٧٬٣٨٢</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">ما هو العدد ٢٨٬٥٦٧ بعد تقريبه إلى أقرب مئة؟</div>
                    <div class="calculation-box">
                        ننظر إلى رقم العشرات (٦)<br>
                        إذا كان ≥ ٥ نرفع، إذا كان &lt; ٥ نثبت<br>
                        ∴ ٢٨٬٥٦٧ → ٢٨٬٦٠٠
                    </div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="28500">
                        <label for="q2_a" class="option-label">٢٨٬٥٠٠</label>

                        <input type="radio" id="q2_b" name="q2" value="28560">
                        <label for="q2_b" class="option-label">٢٨٬٥٦٠</label>

                        <input type="radio" id="q2_c" name="q2" value="28600">
                        <label for="q2_c" class="option-label">٢٨٬٦٠٠</label>

                        <input type="radio" id="q2_d" name="q2" value="29000">
                        <label for="q2_d" class="option-label">٢٩٬٠٠٠</label>
                    </div>
                </div>
            </div>

            <!-- قسم جمع عددين ضمن 99999 -->
            <div class="lesson-section">
                <div class="lesson-title">جمع عددين ضمن 99999</div>

                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">احسب: ٣٤٬٢١٧ + ١٥٬٣٨٤</div>
                    <div class="calculation-box">
                        ٣٤٬٢١٧<br>
                        + ١٥٬٣٨٤<br>
                        ---------<br>
                        ٤٩٬٦٠١
                    </div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="49501">
                        <label for="q3_a" class="option-label">٤٩٬٥٠١</label>

                        <input type="radio" id="q3_b" name="q3" value="49601">
                        <label for="q3_b" class="option-label">٤٩٬٦٠١</label>

                        <input type="radio" id="q3_c" name="q3" value="49701">
                        <label for="q3_c" class="option-label">٤٩٬٧٠١</label>

                        <input type="radio" id="q3_d" name="q3" value="49801">
                        <label for="q3_d" class="option-label">٤٩٬٨٠١</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">ما ناتج جمع: ٢٧٬٥٦٣ + ١٨٬٧٩٤ (مع الحمل)</div>
                    <div class="operation-steps">
                        <div class="step">الآحاد: ٣ + ٤ = ٧</div>
                        <div class="step">العشرات: ٦ + ٩ = ١٥ → اكتب ٥، احمل ١</div>
                        <div class="step">المئات: ٥ + ٧ + ١ = ١٣ → اكتب ٣، احمل ١</div>
                        <div class="step">الآلاف: ٧ + ٨ + ١ = ١٦ → اكتب ٦، احمل ١</div>
                        <div class="step">عشرات الآلاف: ٢ + ١ + ١ = ٤</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="46357">
                        <label for="q4_a" class="option-label">٤٦٬٣٥٧</label>

                        <input type="radio" id="q4_b" name="q4" value="46367">
                        <label for="q4_b" class="option-label">٤٦٬٣٦٧</label>

                        <input type="radio" id="q4_c" name="q4" value="46357">
                        <label for="q4_c" class="option-label">٤٦٬٣٥٧</label>

                        <input type="radio" id="q4_d" name="q4" value="46357">
                        <label for="q4_d" class="option-label">٤٦٬٣٥٧</label>
                    </div>
                </div>
            </div>

            <!-- قسم طرح عددين ضمن 99999 -->
            <div class="lesson-section">
                <div class="lesson-title">طرح عددين ضمن 99999</div>

                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">احسب: ٥٢٬١٨٦ - ٢٧٬٣٤٩</div>
                    <div class="calculation-box">
                        ٥٢٬١٨٦<br>
                        - ٢٧٬٣٤٩<br>
                        ---------<br>
                        ٢٤٬٨٣٧
                    </div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="24837">
                        <label for="q5_a" class="option-label">٢٤٬٨٣٧</label>

                        <input type="radio" id="q5_b" name="q5" value="24847">
                        <label for="q5_b" class="option-label">٢٤٬٨٤٧</label>

                        <input type="radio" id="q5_c" name="q5" value="24937">
                        <label for="q5_c" class="option-label">٢٤٬٩٣٧</label>

                        <input type="radio" id="q5_d" name="q5" value="24737">
                        <label for="q5_d" class="option-label">٢٤٬٧٣٧</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">ما ناتج طرح: ٤٣٬٠٢١ - ١٨٬٧٦٥ (مع الاستلاف)</div>
                    <div class="operation-steps">
                        <div class="step">الآحاد: ١ - ٥ ← استلف من العشرات</div>
                        <div class="step">العشرات: ٢ - ٦ ← استلف من المئات</div>
                        <div class="step">المئات: ٠ - ٧ ← استلف من الآلاف</div>
                        <div class="step">الآلاف: ٣ - ٨ ← استلف من عشرات الآلاف</div>
                        <div class="step">عشرات الآلاف: ٤ - ١ - ١ = ٢</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="24256">
                        <label for="q6_a" class="option-label">٢٤٬٢٥٦</label>

                        <input type="radio" id="q6_b" name="q6" value="24356">
                        <label for="q6_b" class="option-label">٢٤٬٣٥٦</label>

                        <input type="radio" id="q6_c" name="q6" value="24456">
                        <label for="q6_c" class="option-label">٢٤٬٤٥٦</label>

                        <input type="radio" id="q6_d" name="q6" value="24556">
                        <label for="q6_d" class="option-label">٢٤٬٥٥٦</label>
                    </div>
                </div>
            </div>

            <!-- قسم العلاقة بين الجمع والطرح -->
            <div class="lesson-section">
                <div class="lesson-title">العلاقة بين الجمع والطرح</div>

                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">إذا كان ١٨٬٣٤٥ + ١٢٬٦٧٨ = ٣١٬٠٢٣، فما قيمة ٣١٬٠٢٣ - ١٢٬٦٧٨؟</div>
                    <div class="relationship-box">
                        <span>١٨٬٣٤٥ + ١٢٬٦٧٨ = ٣١٬٠٢٣</span>
                        <span class="relationship-arrow">⇄</span>
                        <span>٣١٬٠٢٣ - ١٢٬٦٧٨ = ١٨٬٣٤٥</span>
                    </div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="18345">
                        <label for="q7_a" class="option-label">١٨٬٣٤٥</label>

                        <input type="radio" id="q7_b" name="q7" value="12678">
                        <label for="q7_b" class="option-label">١٢٬٦٧٨</label>

                        <input type="radio" id="q7_c" name="q7" value="31023">
                        <label for="q7_c" class="option-label">٣١٬٠٢٣</label>

                        <input type="radio" id="q7_d" name="q7" value="29767">
                        <label for="q7_d" class="option-label">٢٩٬٧٦٧</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">أكمل: إذا كان ٤٢٬١٥٦ - ١٨٬٧٣٢ = ٢٣٬٤٢٤، فإن ٢٣٬٤٢٤ + ١٨٬٧٣٢ = ؟</div>
                    <div class="math-operation">المطروح + الفرق = المطروح منه</div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="42156">
                        <label for="q8_a" class="option-label">٤٢٬١٥٦</label>

                        <input type="radio" id="q8_b" name="q8" value="18732">
                        <label for="q8_b" class="option-label">١٨٬٧٣٢</label>

                        <input type="radio" id="q8_c" name="q8" value="23424">
                        <label for="q8_c" class="option-label">٢٣٬٤٢٤</label>

                        <input type="radio" id="q8_d" name="q8" value="41568">
                        <label for="q8_d" class="option-label">٤١٬٥٦٨</label>
                    </div>
                </div>
            </div>

            <!-- قسم التحقق من العمليات -->
            <div class="lesson-section">
                <div class="lesson-title">التحقق من العمليات</div>

                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">كيف يمكن التحقق من صحة عملية الجمع ٢٤٬٣٦٧ + ١٥٬٨٤٢ = ٤٠٬٢٠٩؟</div>
                    <div class="verification-box">
                        <div class="verification-title">🔍 طرق التحقق من الجمع:</div>
                        <div>• التبديل: ١٥٬٨٤٢ + ٢٤٬٣٦٧ = ٤٠٬٢٠٩</div>
                        <div>• التقريب: ٢٤٬٠٠٠ + ١٦٬٠٠٠ ≈ ٤٠٬٠٠٠</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="commutative">
                        <label for="q9_a" class="option-label">التبديل فقط</label>

                        <input type="radio" id="q9_b" name="q9" value="rounding">
                        <label for="q9_b" class="option-label">التقريب فقط</label>

                        <input type="radio" id="q9_c" name="q9" value="both">
                        <label for="q9_c" class="option-label">التبديل والتقريب</label>

                        <input type="radio" id="q9_d" name="q9" value="subtraction">
                        <label for="q9_d" class="option-label">الطرح</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">كيف يمكن التحقق من صحة عملية الطرح ٥٣٬٢١٤ - ٢٨٬٧٦٩ = ٢٤٬٤٤٥؟</div>
                    <div class="verification-box">
                        <div class="verification-title">🔍 طرق التحقق من الطرح:</div>
                        <div>• الجمع: ٢٤٬٤٤٥ + ٢٨٬٧٦٩ = ٥٣٬٢١٤</div>
                        <div>• التقدير: ٥٣٬٠٠٠ - ٢٩٬٠٠٠ ≈ ٢٤٬٠٠٠</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="addition">
                        <label for="q10_a" class="option-label">الجمع فقط</label>

                        <input type="radio" id="q10_b" name="q10" value="estimation">
                        <label for="q10_b" class="option-label">التقدير فقط</label>

                        <input type="radio" id="q10_c" name="q10" value="both_methods">
                        <label for="q10_c" class="option-label">الجمع والتقدير</label>

                        <input type="radio" id="q10_d" name="q10" value="multiplication">
                        <label for="q10_d" class="option-label">الضرب</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">11</span>
                    <div class="question-text">ما القيمة التقريبية لمجموع ٣٨٬٤٢٧ + ٢١٬٥٦٣ باستخدام التقريب؟</div>
                    <div class="rounding-visual">
                        <span>٣٨٬٤٢٧ ≈ ٣٨٬٠٠٠</span>
                        <span>+</span>
                        <span>٢١٬٥٦٣ ≈ ٢٢٬٠٠٠</span>
                        <span>=</span>
                        <span class="estimation-result">٦٠٬٠٠٠</span>
                    </div>
                    <div class="options">
                        <input type="radio" id="q11_a" name="q11" value="59000">
                        <label for="q11_a" class="option-label">٥٩٬٠٠٠</label>

                        <input type="radio" id="q11_b" name="q11" value="60000">
                        <label for="q11_b" class="option-label">٦٠٬٠٠٠</label>

                        <input type="radio" id="q11_c" name="q11" value="61000">
                        <label for="q11_c" class="option-label">٦١٬٠٠٠</label>

                        <input type="radio" id="q11_d" name="q11" value="62000">
                        <label for="q11_d" class="option-label">٦٢٬٠٠٠</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">12</span>
                    <div class="question-text">إذا كان ٤٧٬٨٣٦ - ١٩٬٤٥٢ = ٢٨٬٣٨٤، فكيف تتحقق باستخدام الجمع؟</div>
                    <div class="math-operation">٢٨٬٣٨٤ + ١٩٬٤٥٢ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q12_a" name="q12" value="47836">
                        <label for="q12_a" class="option-label">٤٧٬٨٣٦</label>

                        <input type="radio" id="q12_b" name="q12" value="47846">
                        <label for="q12_b" class="option-label">٤٧٬٨٤٦</label>

                        <input type="radio" id="q12_c" name="q12" value="47826">
                        <label for="q12_c" class="option-label">٤٧٬٨٢٦</label>

                        <input type="radio" id="q12_d" name="q12" value="47836">
                        <label for="q12_d" class="option-label">٤٧٬٨٣٦</label>
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
            q1: "47000",        // تقريب 47382 إلى أقرب ألف
            q2: "28600",        // تقريب 28567 إلى أقرب مئة
            q3: "49601",        // جمع 34217 + 15384
            q4: "46357",        // جمع 27563 + 18794 مع الحمل
            q5: "24837",        // طرح 52186 - 27349
            q6: "24256",        // طرح 43021 - 18765 مع الاستلاف
            q7: "18345",        // العلاقة بين الجمع والطرح
            q8: "42156",        // إكمال العلاقة
            q9: "both",         // التحقق من الجمع
            q10: "both_methods", // التحقق من الطرح
            q11: "60000",       // التقريب للتقدير
            q12: "47836"        // التحقق بالجمع
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
                'التقريب': { total: 2, correct: 0 },
                'جمع عددين ضمن 99999': { total: 2, correct: 0 },
                'طرح عددين ضمن 99999': { total: 2, correct: 0 },
                'العلاقة بين الجمع والطرح': { total: 2, correct: 0 },
                'التحقق من العمليات': { total: 4, correct: 0 }
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
                            lessonScores['التقريب'].correct++;
                        } else if (['q3', 'q4'].includes(question)) {
                            lessonScores['جمع عددين ضمن 99999'].correct++;
                        } else if (['q5', 'q6'].includes(question)) {
                            lessonScores['طرح عددين ضمن 99999'].correct++;
                        } else if (['q7', 'q8'].includes(question)) {
                            lessonScores['العلاقة بين الجمع والطرح'].correct++;
                        } else if (['q9', 'q10', 'q11', 'q12'].includes(question)) {
                            lessonScores['التحقق من العمليات'].correct++;
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
