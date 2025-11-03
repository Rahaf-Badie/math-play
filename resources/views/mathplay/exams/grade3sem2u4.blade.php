<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الرياضيات - الكسور والكسور المتكافئة ومقارنة الكسور</title>
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

        .lesson-section:nth-child(1) .lesson-title::before { content: "🍕"; }
        .lesson-section:nth-child(2) .lesson-title::before { content: "🔄"; }
        .lesson-section:nth-child(3) .lesson-title::before { content: "⚖️"; }

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
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .fraction-line {
            width: 100%;
            height: 3px;
            background: #2c3e50;
            margin: 5px 0;
        }

        .circle-visual {
            width: 120px;
            height: 120px;
            position: relative;
        }

        .circle-slice {
            position: absolute;
            width: 100%;
            height: 100%;
            clip-path: polygon(50% 50%, 50% 0%, 100% 0%, 100% 100%, 50% 100%);
            background: #3498db;
            border-radius: 50%;
            transform-origin: 50% 50%;
        }

        .slice-1 { transform: rotate(0deg); background: #3498db; }
        .slice-2 { transform: rotate(90deg); background: #e74c3c; }
        .slice-3 { transform: rotate(180deg); background: #2ecc71; }
        .slice-4 { transform: rotate(270deg); background: #f39c12; }

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
            width: 150px;
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

        .strategy-box {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
        }

        .strategy-title {
            font-weight: bold;
            color: #856404;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .number-line {
            width: 300px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 20px;
            position: relative;
            margin: 20px auto;
            border: 2px solid #e9ecef;
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

        .pizza-visual {
            width: 100px;
            height: 100px;
            background: #f39c12;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
        }

        .pizza-slice {
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
            <h1>اختبار الرياضيات - الكسور والكسور المتكافئة ومقارنة الكسور 🍕</h1>
            <p>اختبر مهاراتك في الكسور، الكسور المتكافئة، ومقارنة الكسور</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم الكسور -->
            <div class="lesson-section">
                <div class="lesson-title">الكسور</div>

                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما الكسر الذي يمثل الجزء المظلل في الدائرة؟</div>
                    <div class="fraction-visual">
                        <div class="circle-visual">
                            <div class="circle-slice slice-1"></div>
                            <div class="circle-slice slice-2"></div>
                            <div class="circle-slice slice-3" style="background: #bdc3c7;"></div>
                            <div class="circle-slice slice-4" style="background: #bdc3c7;"></div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="1/2">
                        <label for="q1_a" class="option-label">١⁄٢</label>

                        <input type="radio" id="q1_b" name="q1" value="1/4">
                        <label for="q1_b" class="option-label">١⁄٤</label>

                        <input type="radio" id="q1_c" name="q1" value="2/4">
                        <label for="q1_c" class="option-label">٢⁄٤</label>

                        <input type="radio" id="q1_d" name="q1" value="3/4">
                        <label for="q1_d" class="option-label">٣⁄٤</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">إذا قسمت بيتزا إلى 8 قطع متساوية وأكلت 3 قطع، فما الكسر الذي يمثل ما أكلته؟</div>
                    <div class="fraction-visual">
                        <div class="pizza-visual">
                            <div class="pizza-slice" style="transform: rotate(0deg); background: #e74c3c;"></div>
                            <div class="pizza-slice" style="transform: rotate(45deg); background: #e74c3c;"></div>
                            <div class="pizza-slice" style="transform: rotate(90deg); background: #e74c3c;"></div>
                            <div class="pizza-slice" style="transform: rotate(135deg); background: #f39c12;"></div>
                            <div class="pizza-slice" style="transform: rotate(180deg); background: #f39c12;"></div>
                            <div class="pizza-slice" style="transform: rotate(225deg); background: #f39c12;"></div>
                            <div class="pizza-slice" style="transform: rotate(270deg); background: #f39c12;"></div>
                            <div class="pizza-slice" style="transform: rotate(315deg); background: #f39c12;"></div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="3/8">
                        <label for="q2_a" class="option-label">٣⁄٨</label>

                        <input type="radio" id="q2_b" name="q2" value="5/8">
                        <label for="q2_b" class="option-label">٥⁄٨</label>

                        <input type="radio" id="q2_c" name="q2" value="2/8">
                        <label for="q2_c" class="option-label">٢⁄٨</label>

                        <input type="radio" id="q2_d" name="q2" value="1/8">
                        <label for="q2_d" class="option-label">١⁄٨</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">ما معنى الكسر ٣⁄٥؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 تعريف الكسر</div>
                        <div>الكسر = البسط / المقام</div>
                        <div>البسط: عدد الأجزاء المأخوذة</div>
                        <div>المقام: عدد الأجزاء الكلية</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="3_parts_of_5">
                        <label for="q3_a" class="option-label">٣ أجزاء من ٥ أجزاء متساوية</label>

                        <input type="radio" id="q3_b" name="q3" value="5_parts_of_3">
                        <label for="q3_b" class="option-label">٥ أجزاء من ٣ أجزاء متساوية</label>

                        <input type="radio" id="q3_c" name="q3" value="3_plus_5">
                        <label for="q3_c" class="option-label">٣ + ٥</label>

                        <input type="radio" id="q3_d" name="q3" value="3_times_5">
                        <label for="q3_d" class="option-label">٣ × ٥</label>
                    </div>
                </div>
            </div>

            <!-- قسم الكسور المتكافئة -->
            <div class="lesson-section">
                <div class="lesson-title">الكسور المتكافئة</div>

                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">أي من هذه الكسور يعادل الكسر ١⁄٢؟</div>
                    <div class="equivalent-fractions">
                        <div class="equivalent-group">
                            <div class="fraction-box">
                                <div class="fraction">١⁄٢</div>
                                <div class="fraction-line"></div>
                            </div>
                            <div class="fraction-bar">
                                <div class="fraction-fill" style="width: 50%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="2/4">
                        <label for="q4_a" class="option-label">٢⁄٤</label>

                        <input type="radio" id="q4_b" name="q4" value="3/4">
                        <label for="q4_b" class="option-label">٣⁄٤</label>

                        <input type="radio" id="q4_c" name="q4" value="1/4">
                        <label for="q4_c" class="option-label">١⁄٤</label>

                        <input type="radio" id="q4_d" name="q4" value="3/6">
                        <label for="q4_d" class="option-label">٣⁄٦</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">ما الكسر المكافئ للكسر ٢⁄٣ والذي مقامه ١٢؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 إيجاد الكسور المتكافئة</div>
                        <div>٢⁄٣ = ?⁄١٢</div>
                        <div>٣ × ٤ = ١٢ ← ٢ × ٤ = ٨</div>
                        <div>∴ ٢⁄٣ = ٨⁄١٢</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="8/12">
                        <label for="q5_a" class="option-label">٨⁄١٢</label>

                        <input type="radio" id="q5_b" name="q5" value="6/12">
                        <label for="q5_b" class="option-label">٦⁄١٢</label>

                        <input type="radio" id="q5_c" name="q5" value="4/12">
                        <label for="q5_c" class="option-label">٤⁄١٢</label>

                        <input type="radio" id="q5_d" name="q5" value="10/12">
                        <label for="q5_d" class="option-label">١٠⁄١٢</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">أي من هذه الكسور متكافئة مع ٣⁄٤؟</div>
                    <div class="equivalent-fractions">
                        <div class="equivalent-group">
                            <div class="fraction-box">
                                <div class="fraction">٣⁄٤</div>
                                <div class="fraction-line"></div>
                            </div>
                            <div class="fraction-bar">
                                <div class="fraction-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="6/8">
                        <label for="q6_a" class="option-label">٦⁄٨</label>

                        <input type="radio" id="q6_b" name="q6" value="9/12">
                        <label for="q6_b" class="option-label">٩⁄١٢</label>

                        <input type="radio" id="q6_c" name="q6" value="12/16">
                        <label for="q6_c" class="option-label">١٢⁄١٦</label>

                        <input type="radio" id="q6_d" name="q6" value="all">
                        <label for="q6_d" class="option-label">جميع ما سبق</label>
                    </div>
                </div>
            </div>

            <!-- قسم مقارنة الكسور -->
            <div class="lesson-section">
                <div class="lesson-title">مقارنة الكسور</div>

                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">أي من الكسرين أكبر: ٢⁄٣ أم ٣⁄٤؟</div>
                    <div class="comparison-visual">
                        <div class="comparison-fraction">
                            <div class="fraction">٢⁄٣</div>
                            <div class="fraction-bar">
                                <div class="fraction-fill" style="width: 66.66%;"></div>
                            </div>
                        </div>
                        <div class="comparison-operator">?</div>
                        <div class="comparison-fraction">
                            <div class="fraction">٣⁄٤</div>
                            <div class="fraction-bar">
                                <div class="fraction-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="2/3">
                        <label for="q7_a" class="option-label">٢⁄٣</label>

                        <input type="radio" id="q7_b" name="q7" value="3/4">
                        <label for="q7_b" class="option-label">٣⁄٤</label>

                        <input type="radio" id="q7_c" name="q7" value="equal">
                        <label for="q7_c" class="option-label">متساويان</label>

                        <input type="radio" id="q7_d" name="q7" value="cannot_compare">
                        <label for="q7_d" class="option-label">لا يمكن المقارنة</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">رتب الكسور التالية من الأصغر إلى الأكبر:</div>
                    <div class="math-operation">١⁄٢ ، ٢⁄٥ ، ٣⁄٤</div>
                    <div class="number-line">
                        <div class="number-point" style="left: 0%;"></div>
                        <div class="number-label" style="left: 0%;">٠</div>

                        <div class="number-point" style="left: 25%; background: #e74c3c;"></div>
                        <div class="number-label" style="left: 25%;">٢⁄٥</div>

                        <div class="number-point" style="left: 50%; background: #3498db;"></div>
                        <div class="number-label" style="left: 50%;">١⁄٢</div>

                        <div class="number-point" style="left: 75%; background: #2ecc71;"></div>
                        <div class="number-label" style="left: 75%;">٣⁄٤</div>

                        <div class="number-point" style="left: 100%;"></div>
                        <div class="number-label" style="left: 100%;">١</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="2/5,1/2,3/4">
                        <label for="q8_a" class="option-label">٢⁄٥ ، ١⁄٢ ، ٣⁄٤</label>

                        <input type="radio" id="q8_b" name="q8" value="1/2,2/5,3/4">
                        <label for="q8_b" class="option-label">١⁄٢ ، ٢⁄٥ ، ٣⁄٤</label>

                        <input type="radio" id="q8_c" name="q8" value="3/4,1/2,2/5">
                        <label for="q8_c" class="option-label">٣⁄٤ ، ١⁄٢ ، ٢⁄٥</label>

                        <input type="radio" id="q8_d" name="q8" value="2/5,3/4,1/2">
                        <label for="q8_d" class="option-label">٢⁄٥ ، ٣⁄٤ ، ١⁄٢</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">أي من العبارات التالية صحيحة؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 استراتيجيات مقارنة الكسور</div>
                        <div>• إذا تساوى المقام: الكسر الأكبر بسطه أكبر</div>
                        <div>• إذا تساوى البسط: الكسر الأكبر مقامه أصغر</div>
                        <div>• إذا اختلفا: نوحد المقامات ثم نقارن</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="3/5_less">
                        <label for="q9_a" class="option-label">٣⁄٥ < ٣⁄٤</label>

                        <input type="radio" id="q9_b" name="q9" value="2/7_greater">
                        <label for="q9_b" class="option-label">٢⁄٧ > ٤⁄٧</label>

                        <input type="radio" id="q9_c" name="q9" value="1/3_equal">
                        <label for="q9_c" class="option-label">١⁄٣ = ٢⁄٦</label>

                        <input type="radio" id="q9_d" name="q9" value="all">
                        <label for="q9_d" class="option-label">جميع ما سبق</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">ما الكسر الأكبر: ٥⁄٨ أم ٧⁄١٢؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 توحيد المقامات</div>
                        <div>٥⁄٨ = ١٥⁄٢٤</div>
                        <div>٧⁄١٢ = ١٤⁄٢٤</div>
                        <div>١٥⁄٢٤ > ١٤⁄٢٤ ← ٥⁄٨ > ٧⁄١٢</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="5/8">
                        <label for="q10_a" class="option-label">٥⁄٨</label>

                        <input type="radio" id="q10_b" name="q10" value="7/12">
                        <label for="q10_b" class="option-label">٧⁄١٢</label>

                        <input type="radio" id="q10_c" name="q10" value="equal">
                        <label for="q10_c" class="option-label">متساويان</label>

                        <input type="radio" id="q10_d" name="q10" value="cannot_tell">
                        <label for="q10_d" class="option-label">لا يمكن المقارنة</label>
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
            q1: "1/2",              // دائرة مظللة نصفها
            q2: "3/8",              // بيتزا 3 قطع من 8
            q3: "3_parts_of_5",     // معنى الكسر 3/5
            q4: "2/4",              // كسر مكافئ لـ 1/2
            q5: "8/12",             // كسر مكافئ لـ 2/3 مقامه 12
            q6: "all",              // كسور مكافئة لـ 3/4
            q7: "3/4",              // مقارنة 2/3 و 3/4
            q8: "2/5,1/2,3/4",      // ترتيب كسور
            q9: "3/5_less",         // عبارات صحيحة عن المقارنة
            q10: "5/8"              // مقارنة 5/8 و 7/12
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
                'الكسر': { total: 3, correct: 0 },
                'الكسر المتكافئة': { total: 3, correct: 0 },
                'مقارنة الكسور': { total: 4, correct: 0 }
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
                            lessonScores['الكسر'].correct++;
                        } else if (['q4', 'q5', 'q6'].includes(question)) {
                            lessonScores['الكسر المتكافئة'].correct++;
                        } else if (['q7', 'q8', 'q9', 'q10'].includes(question)) {
                            lessonScores['مقارنة الكسور'].correct++;
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
