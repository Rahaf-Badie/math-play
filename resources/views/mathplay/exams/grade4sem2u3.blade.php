<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الرياضيات - الهندسة والقياس</title>
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

        .lesson-section:nth-child(1) .lesson-title::before { content: "🟦"; }
        .lesson-section:nth-child(2) .lesson-title::before { content: "📏"; }
        .lesson-section:nth-child(3) .lesson-title::before { content: "🟥"; }
        .lesson-section:nth-child(4) .lesson-title::before { content: "📐"; }
        .lesson-section:nth-child(5) .lesson-title::before { content: "⚖️"; }
        .lesson-section:nth-child(6) .lesson-title::before { content: "📦"; }

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

        /* أنماط خاصة بالهندسة */
        .geometry-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .shape {
            position: relative;
            margin: 0 20px;
        }

        .square {
            width: 100px;
            height: 100px;
            background: #3498db;
            border: 3px solid #2c3e50;
        }

        .rectangle {
            width: 140px;
            height: 80px;
            background: #e74c3c;
            border: 3px solid #2c3e50;
        }

        .cuboid {
            width: 120px;
            height: 80px;
            background: #2ecc71;
            border: 3px solid #2c3e50;
            position: relative;
            transform: perspective(500px) rotateX(20deg) rotateY(20deg);
        }

        .cuboid::before {
            content: '';
            position: absolute;
            width: 30px;
            height: 80px;
            background: #27ae60;
            top: 30px;
            left: 120px;
            transform: skewY(40deg);
        }

        .cuboid::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 30px;
            background: #229954;
            top: 80px;
            left: 0;
            transform: skewX(50deg);
        }

        .side-label {
            position: absolute;
            background: rgba(255,255,255,0.9);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .property-list {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
        }

        .property-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 8px 0;
            padding: 5px;
        }

        .property-icon {
            font-size: 1.2rem;
        }

        .measurement-box {
            background: #e8f6f3;
            border: 2px solid #1abc9c;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
        }

        .conversion-table {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin: 15px 0;
            text-align: center;
        }

        .conversion-unit {
            background: white;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #3498db;
        }

        .unit-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .unit-label {
            font-size: 0.9rem;
            color: #666;
        }

        .formula-box {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-family: 'Courier New', monospace;
            font-size: 1.1rem;
        }

        .dimension {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 15px 0;
        }

        .dimension-item {
            text-align: center;
        }

        .dimension-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: #e74c3c;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الرياضيات - الهندسة والقياس 📐</h1>
            <p>اختبر مهاراتك في الأشكال الهندسية، المحيط، الحجم، والتحويل بين الوحدات</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم المربع وخصائصه -->
            <div class="lesson-section">
                <div class="lesson-title">المربع وخصائصه</div>

                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما عدد أضلاع المربع؟</div>
                    <div class="geometry-visual">
                        <div class="shape">
                            <div class="square"></div>
                            <div class="side-label" style="top: -25px; left: 50%; transform: translateX(-50%);">ضلع</div>
                            <div class="side-label" style="right: -25px; top: 50%; transform: translateY(-50%) rotate(90deg);">ضلع</div>
                            <div class="side-label" style="bottom: -25px; left: 50%; transform: translateX(-50%);">ضلع</div>
                            <div class="side-label" style="left: -25px; top: 50%; transform: translateY(-50%) rotate(90deg);">ضلع</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="3">
                        <label for="q1_a" class="option-label">٣</label>

                        <input type="radio" id="q1_b" name="q1" value="4">
                        <label for="q1_b" class="option-label">٤</label>

                        <input type="radio" id="q1_c" name="q1" value="5">
                        <label for="q1_c" class="option-label">٥</label>

                        <input type="radio" id="q1_d" name="q1" value="6">
                        <label for="q1_d" class="option-label">٦</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">ما الخاصية التي تميز المربع عن المستطيل؟</div>
                    <div class="property-list">
                        <div class="property-item">
                            <span class="property-icon">📏</span>
                            <span>المربع: جميع الأضلاع متساوية</span>
                        </div>
                        <div class="property-item">
                            <span class="property-icon">📐</span>
                            <span>جميع الزوايا قائمة (٩٠ درجة)</span>
                        </div>
                        <div class="property-item">
                            <span class="property-icon">⚡</span>
                            <span>الأقطار متساوية ومتعامدة</span>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="equal_sides">
                        <label for="q2_a" class="option-label">تساوي جميع الأضلاع</label>

                        <input type="radio" id="q2_b" name="q2" value="right_angles">
                        <label for="q2_b" class="option-label">الزوايا القائمة</label>

                        <input type="radio" id="q2_c" name="q2" value="four_sides">
                        <label for="q2_c" class="option-label">امتلاك ٤ أضلاع</label>

                        <input type="radio" id="q2_d" name="q2" value="parallel_sides">
                        <label for="q2_d" class="option-label">الأضلاع المتوازية</label>
                    </div>
                </div>
            </div>

            <!-- قسم محيط المربع -->
            <div class="lesson-section">
                <div class="lesson-title">محيط المربع</div>

                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">ما محيط مربع طول ضلعه ٥ سم؟</div>
                    <div class="formula-box">
                        محيط المربع = ٤ × طول الضلع<br>
                        = ٤ × ٥ = ٢٠ سم
                    </div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="15">
                        <label for="q3_a" class="option-label">١٥ سم</label>

                        <input type="radio" id="q3_b" name="q3" value="20">
                        <label for="q3_b" class="option-label">٢٠ سم</label>

                        <input type="radio" id="q3_c" name="q3" value="25">
                        <label for="q3_c" class="option-label">٢٥ سم</label>

                        <input type="radio" id="q3_d" name="q3" value="10">
                        <label for="q3_d" class="option-label">١٠ سم</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">إذا كان محيط مربع ٣٦ متراً، فما طول ضلعه؟</div>
                    <div class="formula-box">
                        طول ضلع المربع = المحيط ÷ ٤<br>
                        = ٣٦ ÷ ٤ = ٩ أمتار
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="8">
                        <label for="q4_a" class="option-label">٨ أمتار</label>

                        <input type="radio" id="q4_b" name="q4" value="9">
                        <label for="q4_b" class="option-label">٩ أمتار</label>

                        <input type="radio" id="q4_c" name="q4" value="10">
                        <label for="q4_c" class="option-label">١٠ أمتار</label>

                        <input type="radio" id="q4_d" name="q4" value="12">
                        <label for="q4_d" class="option-label">١٢ أمتار</label>
                    </div>
                </div>
            </div>

            <!-- قسم المستطيل وخصائصه -->
            <div class="lesson-section">
                <div class="lesson-title">المستطيل وخصائصه</div>

                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">ما الفرق الرئيسي بين المربع والمستطيل؟</div>
                    <div class="geometry-visual">
                        <div class="shape">
                            <div class="square" style="background: #3498db;"></div>
                            <div style="text-align: center; margin-top: 10px; font-weight: bold;">مربع</div>
                        </div>
                        <div class="shape">
                            <div class="rectangle"></div>
                            <div style="text-align: center; margin-top: 10px; font-weight: bold;">مستطيل</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="sides_length">
                        <label for="q5_a" class="option-label">طول الأضلاع</label>

                        <input type="radio" id="q5_b" name="q5" value="angles">
                        <label for="q5_b" class="option-label">الزوايا</label>

                        <input type="radio" id="q5_c" name="q5" value="number_sides">
                        <label for="q5_c" class="option-label">عدد الأضلاع</label>

                        <input type="radio" id="q5_d" name="q5" value="diagonals">
                        <label for="q5_d" class="option-label">الأقطار</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">كم زاوية قائمة في المستطيل؟</div>
                    <div class="property-list">
                        <div class="property-item">
                            <span class="property-icon">📐</span>
                            <span>جميع زوايا المستطيل قائمة (٩٠ درجة)</span>
                        </div>
                        <div class="property-item">
                            <span class="property-icon">⚡</span>
                            <span>الأضلاع المتقابلة متساوية ومتوازية</span>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="2">
                        <label for="q6_a" class="option-label">٢</label>

                        <input type="radio" id="q6_b" name="q6" value="3">
                        <label for="q6_b" class="option-label">٣</label>

                        <input type="radio" id="q6_c" name="q6" value="4">
                        <label for="q6_c" class="option-label">٤</label>

                        <input type="radio" id="q6_d" name="q6" value="1">
                        <label for="q6_d" class="option-label">١</label>
                    </div>
                </div>
            </div>

            <!-- قسم محيط المستطيل -->
            <div class="lesson-section">
                <div class="lesson-title">محيط المستطيل</div>

                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">ما محيط مستطيل طوله ٨ سم وعرضه ٥ سم؟</div>
                    <div class="formula-box">
                        محيط المستطيل = ٢ × (الطول + العرض)<br>
                        = ٢ × (٨ + ٥) = ٢ × ١٣ = ٢٦ سم
                    </div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="26">
                        <label for="q7_a" class="option-label">٢٦ سم</label>

                        <input type="radio" id="q7_b" name="q7" value="13">
                        <label for="q7_b" class="option-label">١٣ سم</label>

                        <input type="radio" id="q7_c" name="q7" value="40">
                        <label for="q7_c" class="option-label">٤٠ سم</label>

                        <input type="radio" id="q7_d" name="q7" value="20">
                        <label for="q7_d" class="option-label">٢٠ سم</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">إذا كان محيط مستطيل ٣٠ متراً وطوله ٨ أمتار، فما عرضه؟</div>
                    <div class="formula-box">
                        محيط المستطيل = ٢ × (الطول + العرض)<br>
                        ٣٠ = ٢ × (٨ + العرض)<br>
                        ١٥ = ٨ + العرض ← العرض = ٧ أمتار
                    </div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="6">
                        <label for="q8_a" class="option-label">٦ أمتار</label>

                        <input type="radio" id="q8_b" name="q8" value="7">
                        <label for="q8_b" class="option-label">٧ أمتار</label>

                        <input type="radio" id="q8_c" name="q8" value="8">
                        <label for="q8_c" class="option-label">٨ أمتار</label>

                        <input type="radio" id="q8_d" name="q8" value="9">
                        <label for="q8_d" class="option-label">٩ أمتار</label>
                    </div>
                </div>
            </div>

            <!-- قسم التحويل بين وحدات القياس -->
            <div class="lesson-section">
                <div class="lesson-title">التحويل بين وحدات القياس</div>

                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">كم سنتيمتراً في ٣٫٥ أمتار؟</div>
                    <div class="measurement-box">
                        <div class="strategy-title">💡 التحويل من أمتار إلى سنتيمترات</div>
                        <div>١ متر = ١٠٠ سنتيمتر</div>
                        <div>٣٫٥ متر = ٣٫٥ × ١٠٠ = ٣٥٠ سنتيمتر</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="350">
                        <label for="q9_a" class="option-label">٣٥٠ سم</label>

                        <input type="radio" id="q9_b" name="q9" value="35">
                        <label for="q9_b" class="option-label">٣٥ سم</label>

                        <input type="radio" id="q9_c" name="q9" value="305">
                        <label for="q9_c" class="option-label">٣٠٥ سم</label>

                        <input type="radio" id="q9_d" name="q9" value="3500">
                        <label for="q9_d" class="option-label">٣٥٠٠ سم</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">كم كيلوجراماً في ٢٥٠٠ جرام؟</div>
                    <div class="conversion-table">
                        <div class="conversion-unit">
                            <div class="unit-value">١٠٠٠</div>
                            <div class="unit-label">جرام</div>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 1.5rem;">=</span>
                        </div>
                        <div class="conversion-unit">
                            <div class="unit-value">١</div>
                            <div class="unit-label">كيلوجرام</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="2.5">
                        <label for="q10_a" class="option-label">٢٫٥ كجم</label>

                        <input type="radio" id="q10_b" name="q10" value="25">
                        <label for="q10_b" class="option-label">٢٥ كجم</label>

                        <input type="radio" id="q10_c" name="q10" value="0.25">
                        <label for="q10_c" class="option-label">٠٫٢٥ كجم</label>

                        <input type="radio" id="q10_d" name="q10" value="250">
                        <label for="q10_d" class="option-label">٢٥٠ كجم</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">11</span>
                    <div class="question-text">كم دقيقة في ٣ ساعات؟</div>
                    <div class="measurement-box">
                        <div class="strategy-title">⏰ التحويل من ساعات إلى دقائق</div>
                        <div>١ ساعة = ٦٠ دقيقة</div>
                        <div>٣ ساعات = ٣ × ٦٠ = ١٨٠ دقيقة</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q11_a" name="q11" value="180">
                        <label for="q11_a" class="option-label">١٨٠ دقيقة</label>

                        <input type="radio" id="q11_b" name="q11" value="90">
                        <label for="q11_b" class="option-label">٩٠ دقيقة</label>

                        <input type="radio" id="q11_c" name="q11" value="360">
                        <label for="q11_c" class="option-label">٣٦٠ دقيقة</label>

                        <input type="radio" id="q11_d" name="q11" value="120">
                        <label for="q11_d" class="option-label">١٢٠ دقيقة</label>
                    </div>
                </div>
            </div>

            <!-- قسم حجم متوازي المستطيلات -->
            <div class="lesson-section">
                <div class="lesson-title">حجم متوازي المستطيلات</div>

                <div class="question">
                    <span class="question-number">12</span>
                    <div class="question-text">ما حجم متوازي مستطيلات أبعاده: ٥ سم، ٤ سم، ٣ سم؟</div>
                    <div class="geometry-visual">
                        <div class="shape">
                            <div class="cuboid"></div>
                        </div>
                    </div>
                    <div class="formula-box">
                        الحجم = الطول × العرض × الارتفاع<br>
                        = ٥ × ٤ × ٣ = ٦٠ سم³
                    </div>
                    <div class="options">
                        <input type="radio" id="q12_a" name="q12" value="60">
                        <label for="q12_a" class="option-label">٦٠ سم³</label>

                        <input type="radio" id="q12_b" name="q12" value="12">
                        <label for="q12_b" class="option-label">١٢ سم³</label>

                        <input type="radio" id="q12_c" name="q12" value="20">
                        <label for="q12_c" class="option-label">٢٠ سم³</label>

                        <input type="radio" id="q12_d" name="q12" value="15">
                        <label for="q12_d" class="option-label">١٥ سم³</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">13</span>
                    <div class="question-text">إذا كان حجم صندوق ٢٤٠ سم³ وطوله ٨ سم وعرضه ٥ سم، فما ارتفاعه؟</div>
                    <div class="formula-box">
                        الحجم = الطول × العرض × الارتفاع<br>
                        ٢٤٠ = ٨ × ٥ × الارتفاع<br>
                        ٢٤٠ = ٤٠ × الارتفاع ← الارتفاع = ٦ سم
                    </div>
                    <div class="options">
                        <input type="radio" id="q13_a" name="q13" value="4">
                        <label for="q13_a" class="option-label">٤ سم</label>

                        <input type="radio" id="q13_b" name="q13" value="5">
                        <label for="q13_b" class="option-label">٥ سم</label>

                        <input type="radio" id="q13_c" name="q13" value="6">
                        <label for="q13_c" class="option-label">٦ سم</label>

                        <input type="radio" id="q13_d" name="q13" value="7">
                        <label for="q13_d" class="option-label">٧ سم</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">14</span>
                    <div class="question-text">ما حجم خزان مياه أبعاده: ٢ م، ١٫٥ م، ١ م؟</div>
                    <div class="dimension">
                        <div class="dimension-item">
                            <div class="dimension-value">٢ م</div>
                            <div>الطول</div>
                        </div>
                        <div class="dimension-item">
                            <div class="dimension-value">١٫٥ م</div>
                            <div>العرض</div>
                        </div>
                        <div class="dimension-item">
                            <div class="dimension-value">١ م</div>
                            <div>الارتفاع</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q14_a" name="q14" value="3">
                        <label for="q14_a" class="option-label">٣ م³</label>

                        <input type="radio" id="q14_b" name="q14" value="4.5">
                        <label for="q14_b" class="option-label">٤٫٥ م³</label>

                        <input type="radio" id="q14_c" name="q14" value="2.5">
                        <label for="q14_c" class="option-label">٢٫٥ م³</label>

                        <input type="radio" id="q14_d" name="q14" value="3.5">
                        <label for="q14_d" class="option-label">٣٫٥ م³</label>
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
            q1: "4",            // عدد أضلاع المربع
            q2: "equal_sides",  // خاصية المربع
            q3: "20",           // محيط مربع ضلعه 5 سم
            q4: "9",            // طول ضلع مربع محيطه 36 م
            q5: "sides_length", // الفرق بين المربع والمستطيل
            q6: "4",            // عدد الزوايا القائمة في المستطيل
            q7: "26",           // محيط مستطيل 8×5 سم
            q8: "7",            // عرض مستطيل محيطه 30 م وطوله 8 م
            q9: "350",          // 3.5 متر إلى سنتيمتر
            q10: "2.5",         // 2500 جرام إلى كيلوجرام
            q11: "180",         // 3 ساعات إلى دقائق
            q12: "60",          // حجم متوازي مستطيلات 5×4×3 سم
            q13: "6",           // ارتفاع متوازي مستطيلات حجمه 240 سم³
            q14: "3"            // حجم خزان 2×1.5×1 م
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
                'المربع وخصائصه': { total: 2, correct: 0 },
                'محيط المربع': { total: 2, correct: 0 },
                'المستطيل وخصائصه': { total: 2, correct: 0 },
                'محيط المستطيل': { total: 2, correct: 0 },
                'التحويل بين وحدات القياس': { total: 3, correct: 0 },
                'حجم متوازي المستطيلات': { total: 3, correct: 0 }
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
                            lessonScores['المربع وخصائصه'].correct++;
                        } else if (['q3', 'q4'].includes(question)) {
                            lessonScores['محيط المربع'].correct++;
                        } else if (['q5', 'q6'].includes(question)) {
                            lessonScores['المستطيل وخصائصه'].correct++;
                        } else if (['q7', 'q8'].includes(question)) {
                            lessonScores['محيط المستطيل'].correct++;
                        } else if (['q9', 'q10', 'q11'].includes(question)) {
                            lessonScores['التحويل بين وحدات القياس'].correct++;
                        } else if (['q12', 'q13', 'q14'].includes(question)) {
                            lessonScores['حجم متوازي المستطيلات'].correct++;
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
