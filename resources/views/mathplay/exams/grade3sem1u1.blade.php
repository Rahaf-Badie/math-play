<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الرياضيات - الأعداد ضمن 9999</title>
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

        .lesson-section:nth-child(1) .lesson-title::before { content: "🔢"; }
        .lesson-section:nth-child(2) .lesson-title::before { content: "🏷️"; }
        .lesson-section:nth-child(3) .lesson-title::before { content: "🎯"; }
        .lesson-section:nth-child(4) .lesson-title::before { content: "⚖️"; }

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

        /* أنماط خاصة بالأعداد الكبيرة */
        .place-value-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .place-value-box {
            width: 70px;
            text-align: center;
        }

        .digit-display {
            width: 60px;
            height: 60px;
            background: #3498db;
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 5px;
        }

        .place-label {
            font-size: 0.9rem;
            color: #666;
            font-weight: 600;
        }

        .number-comparison {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px 0;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .comparison-number {
            padding: 15px 25px;
            background: #f8f9fa;
            border: 3px solid #e9ecef;
            border-radius: 10px;
            min-width: 120px;
            text-align: center;
        }

        .comparison-operator {
            font-size: 2rem;
            color: #e74c3c;
        }

        .rounding-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
            padding: 20px;
            background: #fff3cd;
            border-radius: 10px;
            border: 2px solid #ffeaa7;
        }

        .number-line {
            width: 300px;
            height: 40px;
            background: linear-gradient(90deg, #e74c3c, #f39c12, #2ecc71);
            border-radius: 20px;
            position: relative;
            margin: 20px auto;
        }

        .number-point {
            position: absolute;
            width: 12px;
            height: 12px;
            background: white;
            border: 2px solid #2c3e50;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .number-label {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            font-size: 0.9rem;
        }

        .strategy-box {
            background: #e8f6f3;
            border: 2px solid #1abc9c;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
        }

        .strategy-title {
            font-weight: bold;
            color: #16a085;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .large-number {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin: 10px 0;
            direction: ltr;
        }

        .place-value-example {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-right: 4px solid #3498db;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الرياضيات - الأعداد ضمن 9999 🔢</h1>
            <p>اختبر مهاراتك في الأعداد الكبيرة، القيمة المنزلية، التقريب، والمقارنة</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم الأعداد ضمن 9999 -->
            <div class="lesson-section">
                <div class="lesson-title">الأعداد ضمن 9999</div>

                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">كيف نقرأ العدد ٤٧٣٨؟</div>
                    <div class="large-number">4,738</div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="four_thousands">
                        <label for="q1_a" class="option-label">أربعة آلاف وسبعمائة وثمانية وثلاثون</label>

                        <input type="radio" id="q1_b" name="q1" value="four_hundreds">
                        <label for="q1_b" class="option-label">أربعمائة وثلاثة وسبعون وثمانية</label>

                        <input type="radio" id="q1_c" name="q1" value="seven_thousands">
                        <label for="q1_c" class="option-label">سبعة آلاف وأربعمائة وثمانية وثلاثون</label>

                        <input type="radio" id="q1_d" name="q1" value="eight_thousands">
                        <label for="q1_d" class="option-label">ثمانية آلاف وسبعمائة وأربعة وثلاثون</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">ما هو العدد الذي يلي ٢٩٩٩ مباشرة؟</div>
                    <div class="math-operation">٢٩٩٩ → ؟</div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="3000">
                        <label for="q2_a" class="option-label">٣٠٠٠</label>

                        <input type="radio" id="q2_b" name="q2" value="2998">
                        <label for="q2_b" class="option-label">٢٩٩٨</label>

                        <input type="radio" id="q2_c" name="q2" value="3001">
                        <label for="q2_c" class="option-label">٣٠٠١</label>

                        <input type="radio" id="q2_d" name="q2" value="4000">
                        <label for="q2_d" class="option-label">٤٠٠٠</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">أي من هذه الأعداد هو الأكبر؟</div>
                    <div class="number-comparison">
                        <div class="comparison-number">٦٤٥٣</div>
                        <div class="comparison-number">٦٥٤٣</div>
                        <div class="comparison-number">٦٣٥٤</div>
                        <div class="comparison-number">٦٥٣٤</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="6453">
                        <label for="q3_a" class="option-label">٦٤٥٣</label>

                        <input type="radio" id="q3_b" name="q3" value="6543">
                        <label for="q3_b" class="option-label">٦٥٤٣</label>

                        <input type="radio" id="q3_c" name="q3" value="6354">
                        <label for="q3_c" class="option-label">٦٣٥٤</label>

                        <input type="radio" id="q3_d" name="q3" value="6534">
                        <label for="q3_d" class="option-label">٦٥٣٤</label>
                    </div>
                </div>
            </div>

            <!-- قسم القيمة المنزلية ضمن 9999 -->
            <div class="lesson-section">
                <div class="lesson-title">القيمة المنزلية ضمن 9999</div>

                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">ما قيمة الرقم ٧ في العدد ٧٤٢٩؟</div>
                    <div class="place-value-container">
                        <div class="place-value-box">
                            <div class="digit-display">٧</div>
                            <div class="place-label">آلاف</div>
                        </div>
                        <div class="place-value-box">
                            <div class="digit-display">٤</div>
                            <div class="place-label">مئات</div>
                        </div>
                        <div class="place-value-box">
                            <div class="digit-display">٢</div>
                            <div class="place-label">عشرات</div>
                        </div>
                        <div class="place-value-box">
                            <div class="digit-display">٩</div>
                            <div class="place-label">آحاد</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="7">
                        <label for="q4_a" class="option-label">٧</label>

                        <input type="radio" id="q4_b" name="q4" value="70">
                        <label for="q4_b" class="option-label">٧٠</label>

                        <input type="radio" id="q4_c" name="q4" value="700">
                        <label for="q4_c" class="option-label">٧٠٠</label>

                        <input type="radio" id="q4_d" name="q4" value="7000">
                        <label for="q4_d" class="option-label">٧٠٠٠</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">ما العدد المكون من ٨ آلاف، ٣ مئات، ٥ عشرات، و ٢ آحاد؟</div>
                    <div class="place-value-example">
                        <div>٨ آلاف = ٨٠٠٠</div>
                        <div>٣ مئات = ٣٠٠</div>
                        <div>٥ عشرات = ٥٠</div>
                        <div>٢ آحاد = ٢</div>
                        <div class="math-operation">٨٠٠٠ + ٣٠٠ + ٥٠ + ٢ = ؟</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="8352">
                        <label for="q5_a" class="option-label">٨٣٥٢</label>

                        <input type="radio" id="q5_b" name="q5" value="8532">
                        <label for="q5_b" class="option-label">٨٥٣٢</label>

                        <input type="radio" id="q5_c" name="q5" value="8253">
                        <label for="q5_c" class="option-label">٨٢٥٣</label>

                        <input type="radio" id="q5_d" name="q5" value="8325">
                        <label for="q5_d" class="option-label">٨٣٢٥</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">في العدد ٥٩٢٦، أي رقم في منزلة المئات؟</div>
                    <div class="place-value-container">
                        <div class="place-value-box">
                            <div class="digit-display">٥</div>
                            <div class="place-label">آلاف</div>
                        </div>
                        <div class="place-value-box">
                            <div class="digit-display" style="background: #e74c3c;">٩</div>
                            <div class="place-label">مئات</div>
                        </div>
                        <div class="place-value-box">
                            <div class="digit-display">٢</div>
                            <div class="place-label">عشرات</div>
                        </div>
                        <div class="place-value-box">
                            <div class="digit-display">٦</div>
                            <div class="place-label">آحاد</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="5">
                        <label for="q6_a" class="option-label">٥</label>

                        <input type="radio" id="q6_b" name="q6" value="9">
                        <label for="q6_b" class="option-label">٩</label>

                        <input type="radio" id="q6_c" name="q6" value="2">
                        <label for="q6_c" class="option-label">٢</label>

                        <input type="radio" id="q6_d" name="q6" value="6">
                        <label for="q6_d" class="option-label">٦</label>
                    </div>
                </div>
            </div>

            <!-- قسم التقريب ضمن 9999 -->
            <div class="lesson-section">
                <div class="lesson-title">التقريب ضمن 9999</div>

                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">قرب العدد ٣٤٦٧ إلى أقرب ألف</div>
                    <div class="rounding-visual">
                        <div class="number-line">
                            <div class="number-point" style="left: 0%;"></div>
                            <div class="number-label" style="left: 0%;">٣٠٠٠</div>

                            <div class="number-point" style="left: 50%;"></div>
                            <div class="number-label" style="left: 50%;">٣٥٠٠</div>

                            <div class="number-point" style="left: 100%;"></div>
                            <div class="number-label" style="left: 100%;">٤٠٠٠</div>

                            <div class="number-point" style="left: 46.7%; background: #e74c3c; border-color: #e74c3c;"></div>
                            <div class="number-label" style="left: 46.7%; top: 25px; color: #e74c3c;">٣٤٦٧</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="3000">
                        <label for="q7_a" class="option-label">٣٠٠٠</label>

                        <input type="radio" id="q7_b" name="q7" value="3400">
                        <label for="q7_b" class="option-label">٣٤٠٠</label>

                        <input type="radio" id="q7_c" name="q7" value="3500">
                        <label for="q7_c" class="option-label">٣٥٠٠</label>

                        <input type="radio" id="q7_d" name="q7" value="4000">
                        <label for="q7_d" class="option-label">٤٠٠٠</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">قرب العدد ٨٢٥٣ إلى أقرب مئة</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 استراتيجية التقريب</div>
                        <div>ننظر إلى رقم العشرات (٥) - إذا كان ٥ أو أكبر نرفع، إذا كان أقل من ٥ نثبت</div>
                        <div class="math-operation">٨٢٥٣ → ٨٣٠٠</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="8200">
                        <label for="q8_a" class="option-label">٨٢٠٠</label>

                        <input type="radio" id="q8_b" name="q8" value="8250">
                        <label for="q8_b" class="option-label">٨٢٥٠</label>

                        <input type="radio" id="q8_c" name="q8" value="8300">
                        <label for="q8_c" class="option-label">٨٣٠٠</label>

                        <input type="radio" id="q8_d" name="q8" value="8000">
                        <label for="q8_d" class="option-label">٨٠٠٠</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">ما هو العدد ٤٧١٨ بعد تقريبه إلى أقرب عشرة؟</div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="4710">
                        <label for="q9_a" class="option-label">٤٧١٠</label>

                        <input type="radio" id="q9_b" name="q9" value="4720">
                        <label for="q9_b" class="option-label">٤٧٢٠</label>

                        <input type="radio" id="q9_c" name="q9" value="4700">
                        <label for="q9_c" class="option-label">٤٧٠٠</label>

                        <input type="radio" id="q9_d" name="q9" value="4800">
                        <label for="q9_d" class="option-label">٤٨٠٠</label>
                    </div>
                </div>
            </div>

            <!-- قسم المقارنة بين الأعداد ضمن 9999 -->
            <div class="lesson-section">
                <div class="lesson-title">المقارنة بين الأعداد ضمن 9999</div>

                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">أي من الرموز يناسب المقارنة: ٦٢٤٩ ⬜ ٦٢٤٧</div>
                    <div class="number-comparison">
                        <div class="comparison-number">٦٢٤٩</div>
                        <div class="comparison-operator">?</div>
                        <div class="comparison-number">٦٢٤٧</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value=">">
                        <label for="q10_a" class="option-label">></label>

                        <input type="radio" id="q10_b" name="q10" value="<">
                        <label for="q10_b" class="option-label"><</label>

                        <input type="radio" id="q10_c" name="q10" value="=">
                        <label for="q10_c" class="option-label">=</label>

                        <input type="radio" id="q10_d" name="q10" value=">=">
                        <label for="q10_d" class="option-label">≥</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">11</span>
                    <div class="question-text">رتب الأعداد التالية تصاعدياً (من الأصغر إلى الأكبر):</div>
                    <div class="math-operation">٣٨٩٢ ، ٣٩٢٨ ، ٣٨٢٩ ، ٣٩٨٢</div>
                    <div class="options">
                        <input type="radio" id="q11_a" name="q11" value="3829,3892,3928,3982">
                        <label for="q11_a" class="option-label">٣٨٢٩ ، ٣٨٩٢ ، ٣٩٢٨ ، ٣٩٨٢</label>

                        <input type="radio" id="q11_b" name="q11" value="3892,3829,3928,3982">
                        <label for="q11_b" class="option-label">٣٨٩٢ ، ٣٨٢٩ ، ٣٩٢٨ ، ٣٩٨٢</label>

                        <input type="radio" id="q11_c" name="q11" value="3982,3928,3892,3829">
                        <label for="q11_c" class="option-label">٣٩٨٢ ، ٣٩٢٨ ، ٣٨٩٢ ، ٣٨٢٩</label>

                        <input type="radio" id="q11_d" name="q11" value="3928,3829,3982,3892">
                        <label for="q11_d" class="option-label">٣٩٢٨ ، ٣٨٢٩ ، ٣٩٨٢ ، ٣٨٩٢</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">12</span>
                    <div class="question-text">أي من هذه العبارات صحيحة؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">📊 استراتيجية المقارنة</div>
                        <div>نبدأ بمقارنة منزلة الآلاف، ثم المئات، ثم العشرات، ثم الآحاد</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q12_a" name="q12" value="5734_less">
                        <label for="q12_a" class="option-label">٥٧٣٤ < ٥٦٧٤</label>

                        <input type="radio" id="q12_b" name="q12" value="6281_greater">
                        <label for="q12_b" class="option-label">٦٢٨١ > ٦٢١٨</label>

                        <input type="radio" id="q12_c" name="q12" value="4950_equal">
                        <label for="q12_c" class="option-label">٤٩٥٠ = ٤٩٠٥</label>

                        <input type="radio" id="q12_d" name="q12" value="all">
                        <label for="q12_d" class="option-label">جميع ما سبق</label>
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
            q1: "four_thousands",           // قراءة العدد 4738
            q2: "3000",                     // العدد الذي يلي 2999
            q3: "6543",                     // أكبر عدد
            q4: "7000",                     // قيمة الرقم 7 في 7429
            q5: "8352",                     // تكوين العدد من المنازل
            q6: "9",                        // رقم المئات في 5926
            q7: "3000",                     // تقريب 3467 إلى أقرب ألف
            q8: "8300",                     // تقريب 8253 إلى أقرب مئة
            q9: "4720",                     // تقريب 4718 إلى أقرب عشرة
            q10: ">",                       // مقارنة 6249 و 6247
            q11: "3829,3892,3928,3982",     // ترتيب تصاعدي
            q12: "6281_greater"             // عبارات المقارنة الصحيحة
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
                'الأعداد ضمن 9999': { total: 3, correct: 0 },
                'القيمة المنزلية ضمن 9999': { total: 3, correct: 0 },
                'التقريب ضمن 9999': { total: 3, correct: 0 },
                'المقارنة بين الأعداد ضمن 9999': { total: 3, correct: 0 }
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
                            lessonScores['الأعداد ضمن 9999'].correct++;
                        } else if (['q4', 'q5', 'q6'].includes(question)) {
                            lessonScores['القيمة المنزلية ضمن 9999'].correct++;
                        } else if (['q7', 'q8', 'q9'].includes(question)) {
                            lessonScores['التقريب ضمن 9999'].correct++;
                        } else if (['q10', 'q11', 'q12'].includes(question)) {
                            lessonScores['المقارنة بين الأعداد ضمن 9999'].correct++;
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
