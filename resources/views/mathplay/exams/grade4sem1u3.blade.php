<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الرياضيات - الكسور والعمليات عليها</title>
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

        .lesson-section:nth-child(1) .lesson-title::before { content: "🔄"; }
        .lesson-section:nth-child(2) .lesson-title::before { content: "⚖️"; }
        .lesson-section:nth-child(3) .lesson-title::before { content: "➕"; }
        .lesson-section:nth-child(4) .lesson-title::before { content: "➖"; }
        .lesson-section:nth-child(5) .lesson-title::before { content: "🔢"; }
        .lesson-section:nth-child(6) .lesson-title::before { content: "🧮"; }

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

        /* أنماط خاصة بالكسور */
        .fraction-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
        }

        .fraction-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .fraction {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .fraction-line {
            width: 100%;
            height: 3px;
            background: #2c3e50;
            margin: 5px 0;
        }

        .mixed-number {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .equivalent-fractions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .equivalent-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .comparison-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin: 20px 0;
        }

        .comparison-fraction {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
        }

        .comparison-operator {
            font-size: 2rem;
            font-weight: bold;
            color: #e74c3c;
        }

        .fraction-bar {
            width: 120px;
            height: 20px;
            background: #e9ecef;
            border-radius: 10px;
            margin: 10px 0;
            overflow: hidden;
            position: relative;
        }

        .fraction-fill {
            height: 100%;
            background: #3498db;
            border-radius: 10px;
        }

        .calculation-box {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 1.1rem;
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

        .circle-visual {
            width: 100px;
            height: 100px;
            position: relative;
            background: #f39c12;
            border-radius: 50%;
            overflow: hidden;
        }

        .circle-slice {
            position: absolute;
            width: 100%;
            height: 100%;
            clip-path: polygon(50% 50%, 50% 0%, 100% 0%);
            background: #e74c3c;
            transform-origin: 50% 50%;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الرياضيات - الكسور والعمليات عليها 🧮</h1>
            <p>اختبر مهاراتك في الكسور المتكافئة، المقارنة، الجمع، الطرح، والأعداد الكسرية</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم الكسور المتكافئة -->
            <div class="lesson-section">
                <div class="lesson-title">الكسر المتكافئة</div>

                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما الكسر المكافئ للكسر ٢⁄٣ والذي مقامه ١٢؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 إيجاد الكسور المتكافئة</div>
                        <div>٢⁄٣ = ?⁄١٢</div>
                        <div>٣ × ٤ = ١٢ ← ٢ × ٤ = ٨</div>
                        <div>∴ ٢⁄٣ = ٨⁄١٢</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="8/12">
                        <label for="q1_a" class="option-label">٨⁄١٢</label>

                        <input type="radio" id="q1_b" name="q1" value="6/12">
                        <label for="q1_b" class="option-label">٦⁄١٢</label>

                        <input type="radio" id="q1_c" name="q1" value="4/12">
                        <label for="q1_c" class="option-label">٤⁄١٢</label>

                        <input type="radio" id="q1_d" name="q1" value="10/12">
                        <label for="q1_d" class="option-label">١٠⁄١٢</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">أوجد الكسر في أبسط صورة: ١٨⁄٢٤</div>
                    <div class="calculation-box">
                        نقسم البسط والمقام على القاسم المشترك الأكبر<br>
                        ١٨ ÷ ٦ = ٣<br>
                        ٢٤ ÷ ٦ = ٤<br>
                        ∴ ١٨⁄٢٤ = ٣⁄٤
                    </div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="3/4">
                        <label for="q2_a" class="option-label">٣⁄٤</label>

                        <input type="radio" id="q2_b" name="q2" value="6/8">
                        <label for="q2_b" class="option-label">٦⁄٨</label>

                        <input type="radio" id="q2_c" name="q2" value="9/12">
                        <label for="q2_c" class="option-label">٩⁄١٢</label>

                        <input type="radio" id="q2_d" name="q2" value="2/3">
                        <label for="q2_d" class="option-label">٢⁄٣</label>
                    </div>
                </div>
            </div>

            <!-- قسم مقارنة الكسور -->
            <div class="lesson-section">
                <div class="lesson-title">مقارنة الكسور</div>

                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">أي من الكسرين أكبر: ٥⁄٨ أم ٧⁄١٢؟</div>
                    <div class="comparison-visual">
                        <div class="comparison-fraction">
                            <div class="fraction">٥⁄٨</div>
                            <div class="fraction-bar">
                                <div class="fraction-fill" style="width: 62.5%;"></div>
                            </div>
                        </div>
                        <div class="comparison-operator">?</div>
                        <div class="comparison-fraction">
                            <div class="fraction">٧⁄١٢</div>
                            <div class="fraction-bar">
                                <div class="fraction-fill" style="width: 58.3%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="5/8">
                        <label for="q3_a" class="option-label">٥⁄٨</label>

                        <input type="radio" id="q3_b" name="q3" value="7/12">
                        <label for="q3_b" class="option-label">٧⁄١٢</label>

                        <input type="radio" id="q3_c" name="q3" value="equal">
                        <label for="q3_c" class="option-label">متساويان</label>

                        <input type="radio" id="q3_d" name="q3" value="cannot_compare">
                        <label for="q3_d" class="option-label">لا يمكن المقارنة</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">رتب الكسور التالية تصاعدياً: ٣⁄٥، ٢⁄٣، ٧⁄١٠</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 توحيد المقامات</div>
                        <div>٣⁄٥ = ١٨⁄٣٠</div>
                        <div>٢⁄٣ = ٢٠⁄٣٠</div>
                        <div>٧⁄١٠ = ٢١⁄٣٠</div>
                        <div>∴ ١٨⁄٣٠ < ٢٠⁄٣٠ < ٢١⁄٣٠</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="3/5,2/3,7/10">
                        <label for="q4_a" class="option-label">٣⁄٥ ، ٢⁄٣ ، ٧⁄١٠</label>

                        <input type="radio" id="q4_b" name="q4" value="2/3,3/5,7/10">
                        <label for="q4_b" class="option-label">٢⁄٣ ، ٣⁄٥ ، ٧⁄١٠</label>

                        <input type="radio" id="q4_c" name="q4" value="7/10,2/3,3/5">
                        <label for="q4_c" class="option-label">٧⁄١٠ ، ٢⁄٣ ، ٣⁄٥</label>

                        <input type="radio" id="q4_d" name="q4" value="3/5,7/10,2/3">
                        <label for="q4_d" class="option-label">٣⁄٥ ، ٧⁄١٠ ، ٢⁄٣</label>
                    </div>
                </div>
            </div>

            <!-- قسم جمع الكسور -->
            <div class="lesson-section">
                <div class="lesson-title">جمع الكسور</div>

                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">احسب: ٢⁄٥ + ٣⁄١٠</div>
                    <div class="operation-steps">
                        <div class="step">١. نوحد المقامات: ٢⁄٥ = ٤⁄١٠</div>
                        <div class="step">٢. نجمع البسط: ٤ + ٣ = ٧</div>
                        <div class="step">٣. الناتج: ٧⁄١٠</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="5/15">
                        <label for="q5_a" class="option-label">٥⁄١٥</label>

                        <input type="radio" id="q5_b" name="q5" value="7/10">
                        <label for="q5_b" class="option-label">٧⁄١٠</label>

                        <input type="radio" id="q5_c" name="q5" value="5/10">
                        <label for="q5_c" class="option-label">٥⁄١٠</label>

                        <input type="radio" id="q5_d" name="q5" value="6/10">
                        <label for="q5_d" class="option-label">٦⁄١٠</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">ما ناتج: ٣⁄٨ + ١⁄٤</div>
                    <div class="fraction-visual">
                        <div class="circle-visual">
                            <div class="circle-slice" style="transform: rotate(0deg);"></div>
                            <div class="circle-slice" style="transform: rotate(45deg);"></div>
                            <div class="circle-slice" style="transform: rotate(90deg);"></div>
                            <div class="circle-slice" style="transform: rotate(135deg); background: #3498db;"></div>
                            <div class="circle-slice" style="transform: rotate(180deg); background: #3498db;"></div>
                        </div>
                        <span>+</span>
                        <div class="circle-visual">
                            <div class="circle-slice" style="transform: rotate(0deg); background: #2ecc71;"></div>
                            <div class="circle-slice" style="transform: rotate(90deg); background: #2ecc71;"></div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="4/12">
                        <label for="q6_a" class="option-label">٤⁄١٢</label>

                        <input type="radio" id="q6_b" name="q6" value="5/8">
                        <label for="q6_b" class="option-label">٥⁄٨</label>

                        <input type="radio" id="q6_c" name="q6" value="4/8">
                        <label for="q6_c" class="option-label">٤⁄٨</label>

                        <input type="radio" id="q6_d" name="q6" value="1/2">
                        <label for="q6_d" class="option-label">١⁄٢</label>
                    </div>
                </div>
            </div>

            <!-- قسم طرح الكسور -->
            <div class="lesson-section">
                <div class="lesson-title">طرح الكسور</div>

                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">احسب: ٧⁄٨ - ٣⁄٤</div>
                    <div class="operation-steps">
                        <div class="step">١. نوحد المقامات: ٣⁄٤ = ٦⁄٨</div>
                        <div class="step">٢. نطرح البسط: ٧ - ٦ = ١</div>
                        <div class="step">٣. الناتج: ١⁄٨</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="4/4">
                        <label for="q7_a" class="option-label">٤⁄٤</label>

                        <input type="radio" id="q7_b" name="q7" value="1/8">
                        <label for="q7_b" class="option-label">١⁄٨</label>

                        <input type="radio" id="q7_c" name="q7" value="4/8">
                        <label for="q7_c" class="option-label">٤⁄٨</label>

                        <input type="radio" id="q7_d" name="q7" value="1/4">
                        <label for="q7_d" class="option-label">١⁄٤</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">ما ناتج: ٥⁄٦ - ١⁄٣</div>
                    <div class="fraction-visual">
                        <div class="fraction-box">
                            <div class="fraction">٥⁄٦</div>
                            <div class="fraction-bar">
                                <div class="fraction-fill" style="width: 83.3%;"></div>
                            </div>
                        </div>
                        <span>-</span>
                        <div class="fraction-box">
                            <div class="fraction">١⁄٣</div>
                            <div class="fraction-bar">
                                <div class="fraction-fill" style="width: 33.3%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="4/3">
                        <label for="q8_a" class="option-label">٤⁄٣</label>

                        <input type="radio" id="q8_b" name="q8" value="3/6">
                        <label for="q8_b" class="option-label">٣⁄٦</label>

                        <input type="radio" id="q8_c" name="q8" value="1/2">
                        <label for="q8_c" class="option-label">١⁄٢</label>

                        <input type="radio" id="q8_d" name="q8" value="2/3">
                        <label for="q8_d" class="option-label">٢⁄٣</label>
                    </div>
                </div>
            </div>

            <!-- قسم العدد الكسري وتحويله -->
            <div class="lesson-section">
                <div class="lesson-title">العدد الكسري وتحويله إلى كسر عادي</div>

                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">حول العدد الكسري ٢ ٣⁄٤ إلى كسر عادي</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 تحويل العدد الكسري</div>
                        <div>٢ ٣⁄٤ = (٢ × ٤ + ٣) ÷ ٤</div>
                        <div>= (٨ + ٣) ÷ ٤ = ١١ ÷ ٤</div>
                        <div>∴ ٢ ٣⁄٤ = ١١⁄٤</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="11/4">
                        <label for="q9_a" class="option-label">١١⁄٤</label>

                        <input type="radio" id="q9_b" name="q9" value="5/4">
                        <label for="q9_b" class="option-label">٥⁄٤</label>

                        <input type="radio" id="q9_c" name="q9" value="6/4">
                        <label for="q9_c" class="option-label">٦⁄٤</label>

                        <input type="radio" id="q9_d" name="q9" value="8/4">
                        <label for="q9_d" class="option-label">٨⁄٤</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">حول الكسر ١٧⁄٥ إلى عدد كسري</div>
                    <div class="calculation-box">
                        ١٧ ÷ ٥ = ٣ والباقي ٢<br>
                        ∴ ١٧⁄٥ = ٣ ٢⁄٥
                    </div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="3 2/5">
                        <label for="q10_a" class="option-label">٣ ٢⁄٥</label>

                        <input type="radio" id="q10_b" name="q10" value="2 7/5">
                        <label for="q10_b" class="option-label">٢ ٧⁄٥</label>

                        <input type="radio" id="q10_c" name="q10" value="3 1/5">
                        <label for="q10_c" class="option-label">٣ ١⁄٥</label>

                        <input type="radio" id="q10_d" name="q10" value="2 3/5">
                        <label for="q10_d" class="option-label">٢ ٣⁄٥</label>
                    </div>
                </div>
            </div>

            <!-- قسم جمع وطرح الأعداد الكسرية -->
            <div class="lesson-section">
                <div class="lesson-title">جمع وطرح الأعداد الكسرية</div>

                <div class="question">
                    <span class="question-number">11</span>
                    <div class="question-text">احسب: ٢ ١⁄٣ + ١ ١⁄٢</div>
                    <div class="operation-steps">
                        <div class="step">١. نجمع الأعداد الصحيحة: ٢ + ١ = ٣</div>
                        <div class="step">٢. نجمع الكسور: ١⁄٣ + ١⁄٢ = ٢⁄٦ + ٣⁄٦ = ٥⁄٦</div>
                        <div class="step">٣. الناتج: ٣ ٥⁄٦</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q11_a" name="q11" value="3 5/6">
                        <label for="q11_a" class="option-label">٣ ٥⁄٦</label>

                        <input type="radio" id="q11_b" name="q11" value="3 2/5">
                        <label for="q11_b" class="option-label">٣ ٢⁄٥</label>

                        <input type="radio" id="q11_c" name="q11" value="2 5/6">
                        <label for="q11_c" class="option-label">٢ ٥⁄٦</label>

                        <input type="radio" id="q11_d" name="q11" value="4 1/6">
                        <label for="q11_d" class="option-label">٤ ١⁄٦</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">12</span>
                    <div class="question-text">احسب: ٤ ٢⁄٥ - ٢ ٣⁄١٠</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 طرح الأعداد الكسرية</div>
                        <div>٤ ٢⁄٥ = ٤ ٤⁄١٠</div>
                        <div>٢ ٣⁄١٠ = ٢ ٣⁄١٠</div>
                        <div>نطرح الأعداد الصحيحة: ٤ - ٢ = ٢</div>
                        <div>نطرح الكسور: ٤⁄١٠ - ٣⁄١٠ = ١⁄١٠</div>
                        <div>الناتج: ٢ ١⁄١٠</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q12_a" name="q12" value="2 1/10">
                        <label for="q12_a" class="option-label">٢ ١⁄١٠</label>

                        <input type="radio" id="q12_b" name="q12" value="2 1/5">
                        <label for="q12_b" class="option-label">٢ ١⁄٥</label>

                        <input type="radio" id="q12_c" name="q12" value="1 9/10">
                        <label for="q12_c" class="option-label">١ ٩⁄١٠</label>

                        <input type="radio" id="q12_d" name="q12" value="2 3/10">
                        <label for="q12_d" class="option-label">٢ ٣⁄١٠</label>
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
            q1: "8/12",         // كسر مكافئ لـ 2/3 مقامه 12
            q2: "3/4",          // كسر 18/24 في أبسط صورة
            q3: "5/8",          // مقارنة 5/8 و 7/12
            q4: "3/5,2/3,7/10", // ترتيب كسور تصاعدياً
            q5: "7/10",         // جمع 2/5 + 3/10
            q6: "5/8",          // جمع 3/8 + 1/4
            q7: "1/8",          // طرح 7/8 - 3/4
            q8: "1/2",          // طرح 5/6 - 1/3
            q9: "11/4",         // تحويل 2 3/4 إلى كسر عادي
            q10: "3 2/5",       // تحويل 17/5 إلى عدد كسري
            q11: "3 5/6",       // جمع 2 1/3 + 1 1/2
            q12: "2 1/10"       // طرح 4 2/5 - 2 3/10
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
                'الكسر المتكافئة': { total: 2, correct: 0 },
                'مقارنة الكسور': { total: 2, correct: 0 },
                'جمع الكسور': { total: 2, correct: 0 },
                'طرح الكسور': { total: 2, correct: 0 },
                'العدد الكسري وتحويله': { total: 2, correct: 0 },
                'جمع وطرح الأعداد الكسرية': { total: 2, correct: 0 }
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
                            lessonScores['الكسر المتكافئة'].correct++;
                        } else if (['q3', 'q4'].includes(question)) {
                            lessonScores['مقارنة الكسور'].correct++;
                        } else if (['q5', 'q6'].includes(question)) {
                            lessonScores['جمع الكسور'].correct++;
                        } else if (['q7', 'q8'].includes(question)) {
                            lessonScores['طرح الكسور'].correct++;
                        } else if (['q9', 'q10'].includes(question)) {
                            lessonScores['العدد الكسري وتحويله'].correct++;
                        } else if (['q11', 'q12'].includes(question)) {
                            lessonScores['جمع وطرح الأعداد الكسرية'].correct++;
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
