<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الرياضيات - الضرب والقسمة المتقدمة</title>
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

        .lesson-section:nth-child(1) .lesson-title::before { content: "✖️"; }
        .lesson-section:nth-child(2) .lesson-title::before { content: "🔢"; }
        .lesson-section:nth-child(3) .lesson-title::before { content: "➗"; }
        .lesson-section:nth-child(4) .lesson-title::before { content: "📊"; }

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
            direction: ltr;
        }

        .multiplication-steps {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border: 2px solid #e9ecef;
        }

        .step {
            margin: 8px 0;
            padding: 5px;
            border-bottom: 1px dashed #ddd;
        }

        .carry-over {
            color: #e74c3c;
            font-weight: bold;
        }

        .division-steps {
            background: #e8f6f3;
            border: 2px solid #1abc9c;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
        }

        .division-step {
            margin: 5px 0;
            padding: 8px;
            background: white;
            border-radius: 5px;
            border-right: 3px solid #3498db;
        }

        .remainder {
            color: #e74c3c;
            font-weight: bold;
        }

        .strategy-box {
            background: #e8f4fc;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
        }

        .strategy-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .visual-representation {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 15px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .number-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .number-box {
            width: 60px;
            height: 60px;
            background: #3498db;
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: bold;
        }

        .operation-symbol {
            font-size: 2rem;
            font-weight: bold;
            color: #e74c3c;
        }

        .place-value {
            font-size: 0.8rem;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الرياضيات - الضرب والقسمة المتقدمة 🧮</h1>
            <p>اختبر مهاراتك في ضرب وقسمة الأعداد الكبيرة</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم ضرب عدد من منزلتين في عدد من منزلتين -->
            <div class="lesson-section">
                <div class="lesson-title">ضرب عدد من منزلتين في عدد من منزلتين</div>

                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما ناتج ضرب: ٤٧ × ٢٣؟</div>
                    <div class="multiplication-steps">
                        <div class="step">٤٧ × ٣ = ١٤١</div>
                        <div class="step">٤٧ × ٢٠ = ٩٤٠</div>
                        <div class="step">١٤١ + ٩٤٠ = ١٠٨١</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="1081">
                        <label for="q1_a" class="option-label">١٠٨١</label>

                        <input type="radio" id="q1_b" name="q1" value="981">
                        <label for="q1_b" class="option-label">٩٨١</label>

                        <input type="radio" id="q1_c" name="q1" value="1181">
                        <label for="q1_c" class="option-label">١١٨١</label>

                        <input type="radio" id="q1_d" name="q1" value="1061">
                        <label for="q1_d" class="option-label">١٠٦١</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">احسب: ٥٦ × ٣٤</div>
                    <div class="visual-representation">
                        <div class="number-group">
                            <div class="number-box">٥٦</div>
                            <div class="place-value">عدد من منزلتين</div>
                        </div>
                        <div class="operation-symbol">×</div>
                        <div class="number-group">
                            <div class="number-box">٣٤</div>
                            <div class="place-value">عدد من منزلتين</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="1904">
                        <label for="q2_a" class="option-label">١٩٠٤</label>

                        <input type="radio" id="q2_b" name="q2" value="1804">
                        <label for="q2_b" class="option-label">١٨٠٤</label>

                        <input type="radio" id="q2_c" name="q2" value="1704">
                        <label for="q2_c" class="option-label">١٧٠٤</label>

                        <input type="radio" id="q2_d" name="q2" value="2004">
                        <label for="q2_d" class="option-label">٢٠٠٤</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">إذا كان سعر الكتاب ٣٨ ريالاً، فكم تكلفة ٢٥ كتاباً؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 مسألة حياتية</div>
                        <div>التكلفة = السعر × العدد</div>
                        <div>٣٨ × ٢٥ = ؟</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="850">
                        <label for="q3_a" class="option-label">٨٥٠ ريال</label>

                        <input type="radio" id="q3_b" name="q3" value="950">
                        <label for="q3_b" class="option-label">٩٥٠ ريال</label>

                        <input type="radio" id="q3_c" name="q3" value="750">
                        <label for="q3_c" class="option-label">٧٥٠ ريال</label>

                        <input type="radio" id="q3_d" name="q3" value="1050">
                        <label for="q3_d" class="option-label">١٠٥٠ ريال</label>
                    </div>
                </div>
            </div>

            <!-- قسم ضرب عدد من 3 منازل في عدد من منزلتين -->
            <div class="lesson-section">
                <div class="lesson-title">ضرب عدد من 3 منازل في عدد من منزلتين</div>

                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">ما ناتج ضرب: ٣٤٧ × ٢٦؟</div>
                    <div class="multiplication-steps">
                        <div class="step">٣٤٧ × ٦ = ٢٠٨٢</div>
                        <div class="step">٣٤٧ × ٢٠ = ٦٩٤٠</div>
                        <div class="step">٢٠٨٢ + ٦٩٤٠ = ٩٠٢٢</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="9022">
                        <label for="q4_a" class="option-label">٩٠٢٢</label>

                        <input type="radio" id="q4_b" name="q4" value="8922">
                        <label for="q4_b" class="option-label">٨٩٢٢</label>

                        <input type="radio" id="q4_c" name="q4" value="9122">
                        <label for="q4_c" class="option-label">٩١٢٢</label>

                        <input type="radio" id="q4_d" name="q4" value="8822">
                        <label for="q4_d" class="option-label">٨٨٢٢</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">احسب: ٥٢٨ × ٤٥</div>
                    <div class="calculation-box">
                        ٥٢٨ × ٤٥<br>
                        --------<br>
                        ٥٢٨ × ٥ = ٢٦٤٠<br>
                        ٥٢٨ × ٤٠ = ٢١١٢٠<br>
                        المجموع = ٢٣٧٦٠
                    </div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="23760">
                        <label for="q5_a" class="option-label">٢٣٧٦٠</label>

                        <input type="radio" id="q5_b" name="q5" value="22760">
                        <label for="q5_b" class="option-label">٢٢٧٦٠</label>

                        <input type="radio" id="q5_c" name="q5" value="24760">
                        <label for="q5_c" class="option-label">٢٤٧٦٠</label>

                        <input type="radio" id="q5_d" name="q5" value="21760">
                        <label for="q5_d" class="option-label">٢١٧٦٠</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">مصنع ينتج ١٨٥ علبة في اليوم، كم علبة ينتج في ٣٦ يوماً؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 مسألة تطبيقية</div>
                        <div>الإنتاج الكلي = الإنتاج اليومي × عدد الأيام</div>
                        <div>١٨٥ × ٣٦ = ؟</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="6660">
                        <label for="q6_a" class="option-label">٦٦٦٠ علبة</label>

                        <input type="radio" id="q6_b" name="q6" value="6560">
                        <label for="q6_b" class="option-label">٦٥٦٠ علبة</label>

                        <input type="radio" id="q6_c" name="q6" value="6760">
                        <label for="q6_c" class="option-label">٦٧٦٠ علبة</label>

                        <input type="radio" id="q6_d" name="q6" value="6460">
                        <label for="q6_d" class="option-label">٦٤٦٠ علبة</label>
                    </div>
                </div>
            </div>

            <!-- قسم قسمة عدد من 3 منازل على عدد من منزلتين -->
            <div class="lesson-section">
                <div class="lesson-title">قسمة عدد من 3 منازل على عدد من منزلتين</div>

                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">ما ناتج قسمة: ٤٨٦ ÷ ١٨؟</div>
                    <div class="division-steps">
                        <div class="division-step">١٨ × ٢٠ = ٣٦٠ ← ٤٨٦ - ٣٦٠ = ١٢٦</div>
                        <div class="division-step">١٨ × ٧ = ١٢٦ ← ١٢٦ - ١٢٦ = ٠</div>
                        <div class="division-step">الناتج = ٢٠ + ٧ = ٢٧</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="27">
                        <label for="q7_a" class="option-label">٢٧</label>

                        <input type="radio" id="q7_b" name="q7" value="26">
                        <label for="q7_b" class="option-label">٢٦</label>

                        <input type="radio" id="q7_c" name="q7" value="28">
                        <label for="q7_c" class="option-label">٢٨</label>

                        <input type="radio" id="q7_d" name="q7" value="25">
                        <label for="q7_d" class="option-label">٢٥</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">احسب: ٦٣٥ ÷ ٢٥</div>
                    <div class="calculation-box">
                        ٢٥ × ٢٠ = ٥٠٠<br>
                        ٦٣٥ - ٥٠٠ = ١٣٥<br>
                        ٢٥ × ٥ = ١٢٥<br>
                        ١٣٥ - ١٢٥ = ١٠<br>
                        الناتج = ٢٥ والباقي ١٠
                    </div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="25_10">
                        <label for="q8_a" class="option-label">٢٥ والباقي ١٠</label>

                        <input type="radio" id="q8_b" name="q8" value="24_15">
                        <label for="q8_b" class="option-label">٢٤ والباقي ١٥</label>

                        <input type="radio" id="q8_c" name="q8" value="26_5">
                        <label for="q8_c" class="option-label">٢٦ والباقي ٥</label>

                        <input type="radio" id="q8_d" name="q8" value="25_15">
                        <label for="q8_d" class="option-label">٢٥ والباقي ١٥</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">إذا كان ٧٢٠ ريالاً ستوزع على ٢٤ طالباً بالتساوي، فكم يحصل كل طالب؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 مسألة توزيع</div>
                        <div>حصة كل طالب = المبلغ الكلي ÷ عدد الطلاب</div>
                        <div>٧٢٠ ÷ ٢٤ = ؟</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="30">
                        <label for="q9_a" class="option-label">٣٠ ريال</label>

                        <input type="radio" id="q9_b" name="q9" value="25">
                        <label for="q9_b" class="option-label">٢٥ ريال</label>

                        <input type="radio" id="q9_c" name="q9" value="35">
                        <label for="q9_c" class="option-label">٣٥ ريال</label>

                        <input type="radio" id="q9_d" name="q9" value="40">
                        <label for="q9_d" class="option-label">٤٠ ريال</label>
                    </div>
                </div>
            </div>

            <!-- قسم قسمة عدد من منزلتين على عدد من منزلتين -->
            <div class="lesson-section">
                <div class="lesson-title">قسمة عدد من منزلتين على عدد من منزلتين</div>

                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">ما ناتج قسمة: ٨٤ ÷ ١٢؟</div>
                    <div class="division-steps">
                        <div class="division-step">١٢ × ٧ = ٨٤</div>
                        <div class="division-step">٨٤ - ٨٤ = ٠</div>
                        <div class="division-step">الناتج = ٧</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="7">
                        <label for="q10_a" class="option-label">٧</label>

                        <input type="radio" id="q10_b" name="q10" value="8">
                        <label for="q10_b" class="option-label">٨</label>

                        <input type="radio" id="q10_c" name="q10" value="6">
                        <label for="q10_c" class="option-label">٦</label>

                        <input type="radio" id="q10_d" name="q10" value="9">
                        <label for="q10_d" class="option-label">٩</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">11</span>
                    <div class="question-text">احسب: ٩٦ ÷ ١٦</div>
                    <div class="visual-representation">
                        <div class="number-group">
                            <div class="number-box">٩٦</div>
                            <div class="place-value">المقسوم</div>
                        </div>
                        <div class="operation-symbol">÷</div>
                        <div class="number-group">
                            <div class="number-box">١٦</div>
                            <div class="place-value">المقسوم عليه</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q11_a" name="q11" value="6">
                        <label for="q11_a" class="option-label">٦</label>

                        <input type="radio" id="q11_b" name="q11" value="7">
                        <label for="q11_b" class="option-label">٧</label>

                        <input type="radio" id="q11_c" name="q11" value="5">
                        <label for="q11_c" class="option-label">٥</label>

                        <input type="radio" id="q11_d" name="q11" value="8">
                        <label for="q11_d" class="option-label">٨</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">12</span>
                    <div class="question-text">إذا كان ٧٨ كيلوجراماً من الأرز ستوضع في أكياس سعة ١٣ كيلوجرام، فكم كيساً نحتاج؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 مسألة تعبئة</div>
                        <div>عدد الأكياس = الوزن الكلي ÷ سعة الكيس</div>
                        <div>٧٨ ÷ ١٣ = ؟</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q12_a" name="q12" value="6">
                        <label for="q12_a" class="option-label">٦ أكياس</label>

                        <input type="radio" id="q12_b" name="q12" value="7">
                        <label for="q12_b" class="option-label">٧ أكياس</label>

                        <input type="radio" id="q12_c" name="q12" value="5">
                        <label for="q12_c" class="option-label">٥ أكياس</label>

                        <input type="radio" id="q12_d" name="q12" value="8">
                        <label for="q12_d" class="option-label">٨ أكياس</label>
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
            q1: "1081",         // 47 × 23
            q2: "1904",         // 56 × 34
            q3: "950",          // 38 × 25
            q4: "9022",         // 347 × 26
            q5: "23760",        // 528 × 45
            q6: "6660",         // 185 × 36
            q7: "27",           // 486 ÷ 18
            q8: "25_10",        // 635 ÷ 25
            q9: "30",           // 720 ÷ 24
            q10: "7",           // 84 ÷ 12
            q11: "6",           // 96 ÷ 16
            q12: "6"            // 78 ÷ 13
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
                'ضرب عدد من منزلتين في عدد من منزلتين': { total: 3, correct: 0 },
                'ضرب عدد من 3 منازل في عدد من منزلتين': { total: 3, correct: 0 },
                'قسمة عدد من 3 منازل على عدد من منزلتين': { total: 3, correct: 0 },
                'قسمة عدد من منزلتين على عدد من منزلتين': { total: 3, correct: 0 }
            };

            // حساب النقاط
            for (const [question, correctAnswer] of Object.entries(correctAnswers)) {
                const selectedOption = document.querySelector(`input[name="${question}"]:checked`);

                if (selectedOption) {
                    answeredQuestions++;
                    if (selectedOption.value === correctAnswer) {
                        score++;

                        // تحديث نتائج الأقسام
                        if (['q1', 'q2', 'q3'].includes(question)) {
                            lessonScores['ضرب عدد من منزلتين في عدد من منزلتين'].correct++;
                        } else if (['q4', 'q5', 'q6'].includes(question)) {
                            lessonScores['ضرب عدد من 3 منازل في عدد من منزلتين'].correct++;
                        } else if (['q7', 'q8', 'q9'].includes(question)) {
                            lessonScores['قسمة عدد من 3 منازل على عدد من منزلتين'].correct++;
                        } else if (['q10', 'q11', 'q12'].includes(question)) {
                            lessonScores['قسمة عدد من منزلتين على عدد من منزلتين'].correct++;
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
