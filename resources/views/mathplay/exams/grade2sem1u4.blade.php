<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الرياضيات - القطعة المستقيمة والخط المنحني والمربع</title>
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

        .lesson-section:nth-child(1) .lesson-title::before { content: "📏"; }
        .lesson-section:nth-child(2) .lesson-title::before { content: "🟦"; }

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

        .line-example {
            width: 200px;
            height: 100px;
            position: relative;
        }

        .straight-line {
            width: 180px;
            height: 4px;
            background: #3498db;
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
        }

        .curved-line {
            width: 180px;
            height: 80px;
            border: 4px solid #e74c3c;
            border-top: none;
            border-radius: 0 0 90px 90px;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .shape-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .shape-example {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #2c3e50;
            position: relative;
        }

        .square {
            background: #3498db;
            color: white;
        }

        .rectangle {
            width: 140px;
            height: 100px;
            background: #e74c3c;
            color: white;
        }

        .circle {
            border-radius: 50%;
            background: #2ecc71;
            color: white;
        }

        .triangle {
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-bottom: 100px solid #f39c12;
            background: transparent !important;
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

        .vertex-point {
            width: 8px;
            height: 8px;
            background: #e74c3c;
            border-radius: 50%;
            position: absolute;
        }

        .vertex-1 { top: -4px; left: -4px; }
        .vertex-2 { top: -4px; right: -4px; }
        .vertex-3 { bottom: -4px; right: -4px; }
        .vertex-4 { bottom: -4px; left: -4px; }

        .side-length {
            position: absolute;
            background: rgba(255,255,255,0.8);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .top-side { top: -25px; left: 50%; transform: translateX(-50%); }
        .right-side { right: -25px; top: 50%; transform: translateY(-50%) rotate(90deg); }
        .bottom-side { bottom: -25px; left: 50%; transform: translateX(-50%); }
        .left-side { left: -25px; top: 50%; transform: translateY(-50%) rotate(90deg); }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الرياضيات - القطعة المستقيمة والخط المنحني والمربع 📐</h1>
            <p>اختبر مهاراتك في الأشكال الهندسية والخطوط</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم القطعة المستقيمة والخط المنحني -->
            <div class="lesson-section">
                <div class="lesson-title">القطعة المستقيمة والخط المنحني</div>

                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">أي من هذه يمثل قطعة مستقيمة؟</div>
                    <div class="geometry-visual">
                        <div class="line-example">
                            <div class="straight-line"></div>
                            <div style="position: absolute; top: 60px; left: 0; width: 100%; text-align: center; font-weight: bold;">أ</div>
                        </div>
                        <div class="line-example">
                            <div class="curved-line"></div>
                            <div style="position: absolute; top: 60px; left: 0; width: 100%; text-align: center; font-weight: bold;">ب</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="straight">
                        <label for="q1_a" class="option-label">الخط المستقيم (أ)</label>

                        <input type="radio" id="q1_b" name="q1" value="curved">
                        <label for="q1_b" class="option-label">الخط المنحني (ب)</label>

                        <input type="radio" id="q1_c" name="q1" value="both">
                        <label for="q1_c" class="option-label">كلاهما</label>

                        <input type="radio" id="q1_d" name="q1" value="none">
                        <label for="q1_d" class="option-label">لا شيء</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">ما الفرق الرئيسي بين القطعة المستقيمة والخط المنحني؟</div>
                    <div class="property-list">
                        <div class="property-item">
                            <span class="property-icon">📏</span>
                            <span>القطعة المستقيمة: لها بداية ونهاية، مستقيمة</span>
                        </div>
                        <div class="property-item">
                            <span class="property-icon">🔄</span>
                            <span>الخط المنحني: متعرج أو دائري، لا يتبع خطاً مستقيماً</span>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="direction">
                        <label for="q2_a" class="option-label">الاتجاه</label>

                        <input type="radio" id="q2_b" name="q2" value="straightness">
                        <label for="q2_b" class="option-label">الاستقامة</label>

                        <input type="radio" id="q2_c" name="q2" value="length">
                        <label for="q2_c" class="option-label">الطول</label>

                        <input type="radio" id="q2_d" name="q2" value="color">
                        <label for="q2_d" class="option-label">اللون</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">أي من هذه الأمثلة تمثل خطاً منحنياً في الحياة الواقعية؟</div>
                    <div class="math-operation">اختر المثال المناسب</div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="ruler">
                        <label for="q3_a" class="option-label">المسطرة</label>

                        <input type="radio" id="q3_b" name="q3" value="rainbow">
                        <label for="q3_b" class="option-label">قوس قزح</label>

                        <input type="radio" id="q3_c" name="q3" value="book">
                        <label for="q3_c" class="option-label">حافة الكتاب</label>

                        <input type="radio" id="q3_d" name="q3" value="window">
                        <label for="q3_d" class="option-label">نافذة مستطيلة</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">كم نقطة نهاية تمتلكها القطعة المستقيمة؟</div>
                    <div class="geometry-visual">
                        <div class="line-example">
                            <div class="straight-line"></div>
                            <div style="position: absolute; top: -10px; left: 10px; width: 8px; height: 8px; background: #e74c3c; border-radius: 50%;"></div>
                            <div style="position: absolute; top: -10px; right: 10px; width: 8px; height: 8px; background: #e74c3c; border-radius: 50%;"></div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="0">
                        <label for="q4_a" class="option-label">٠</label>

                        <input type="radio" id="q4_b" name="q4" value="1">
                        <label for="q4_b" class="option-label">١</label>

                        <input type="radio" id="q4_c" name="q4" value="2">
                        <label for="q4_c" class="option-label">٢</label>

                        <input type="radio" id="q4_d" name="q4" value="infinite">
                        <label for="q4_d" class="option-label">لا نهائي</label>
                    </div>
                </div>
            </div>

            <!-- قسم المربع -->
            <div class="lesson-section">
                <div class="lesson-title">المربع</div>

                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">أي من هذه الأشكال يمثل مربعاً؟</div>
                    <div class="shape-container">
                        <div class="shape-example square">
                            <span>أ</span>
                            <div class="vertex-point vertex-1"></div>
                            <div class="vertex-point vertex-2"></div>
                            <div class="vertex-point vertex-3"></div>
                            <div class="vertex-point vertex-4"></div>
                        </div>
                        <div class="shape-example rectangle">
                            <span>ب</span>
                        </div>
                        <div class="shape-example circle">
                            <span>ج</span>
                        </div>
                        <div class="shape-example triangle">
                            <span style="position: absolute; top: 40px; left: 50%; transform: translateX(-50%);">د</span>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="A">
                        <label for="q5_a" class="option-label">الشكل أ</label>

                        <input type="radio" id="q5_b" name="q5" value="B">
                        <label for="q5_b" class="option-label">الشكل ب</label>

                        <input type="radio" id="q5_c" name="q5" value="C">
                        <label for="q5_c" class="option-label">الشكل ج</label>

                        <input type="radio" id="q5_d" name="q5" value="D">
                        <label for="q5_d" class="option-label">الشكل د</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">كم ضلعاً يمتلك المربع؟</div>
                    <div class="geometry-visual">
                        <div class="shape-example square">
                            <div class="side-length top-side">ضلع</div>
                            <div class="side-length right-side">ضلع</div>
                            <div class="side-length bottom-side">ضلع</div>
                            <div class="side-length left-side">ضلع</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="2">
                        <label for="q6_a" class="option-label">٢</label>

                        <input type="radio" id="q6_b" name="q6" value="3">
                        <label for="q6_b" class="option-label">٣</label>

                        <input type="radio" id="q6_c" name="q6" value="4">
                        <label for="q6_c" class="option-label">٤</label>

                        <input type="radio" id="q6_d" name="q6" value="5">
                        <label for="q6_d" class="option-label">٥</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">ما الخاصية التي تميز المربع عن المستطيل؟</div>
                    <div class="property-list">
                        <div class="property-item">
                            <span class="property-icon">📐</span>
                            <span>المربع: جميع الأضلاع متساوية الطول</span>
                        </div>
                        <div class="property-item">
                            <span class="property-icon">📏</span>
                            <span>المستطيل: الأضلاع المتقابلة فقط متساوية</span>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="sides">
                        <label for="q7_a" class="option-label">تساوي جميع الأضلاع</label>

                        <input type="radio" id="q7_b" name="q7" value="angles">
                        <label for="q7_b" class="option-label">الزوايا القائمة</label>

                        <input type="radio" id="q7_c" name="q7" value="color">
                        <label for="q7_c" class="option-label">اللون</label>

                        <input type="radio" id="q7_d" name="q7" value="vertices">
                        <label for="q7_d" class="option-label">عدد الرؤوس</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">كم رأساً يمتلك المربع؟</div>
                    <div class="geometry-visual">
                        <div class="shape-example square">
                            <div class="vertex-point vertex-1"></div>
                            <div class="vertex-point vertex-2"></div>
                            <div class="vertex-point vertex-3"></div>
                            <div class="vertex-point vertex-4"></div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="2">
                        <label for="q8_a" class="option-label">٢</label>

                        <input type="radio" id="q8_b" name="q8" value="3">
                        <label for="q8_b" class="option-label">٣</label>

                        <input type="radio" id="q8_c" name="q8" value="4">
                        <label for="q8_c" class="option-label">٤</label>

                        <input type="radio" id="q8_d" name="q8" value="5">
                        <label for="q8_d" class="option-label">٥</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">أي من هذه الأشياء في حياتنا اليومية تأخذ شكل المربع؟</div>
                    <div class="math-operation">اختر جميع الإجابات الصحيحة</div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="window">
                        <label for="q9_a" class="option-label">ورقة الملاحظات اللاصقة</label>

                        <input type="radio" id="q9_b" name="q9" value="plate">
                        <label for="q9_b" class="option-label">طبق الطعام</label>

                        <input type="radio" id="q9_c" name="q9" value="book">
                        <label for="q9_c" class="option-label">غلاف الكتاب</label>

                        <input type="radio" id="q9_d" name="q9" value="clock">
                        <label for="q9_d" class="option-label">ساعة الحائط</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">ما قياس كل زاوية في المربع؟</div>
                    <div class="geometry-visual">
                        <div class="shape-example square" style="position: relative;">
                            <div style="position: absolute; top: 5px; left: 5px; font-size: 0.8rem; background: white; padding: 2px; border-radius: 3px;">٩٠°</div>
                            <div style="position: absolute; top: 5px; right: 5px; font-size: 0.8rem; background: white; padding: 2px; border-radius: 3px;">٩٠°</div>
                            <div style="position: absolute; bottom: 5px; right: 5px; font-size: 0.8rem; background: white; padding: 2px; border-radius: 3px;">٩٠°</div>
                            <div style="position: absolute; bottom: 5px; left: 5px; font-size: 0.8rem; background: white; padding: 2px; border-radius: 3px;">٩٠°</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="45">
                        <label for="q10_a" class="option-label">٤٥ درجة</label>

                        <input type="radio" id="q10_b" name="q10" value="60">
                        <label for="q10_b" class="option-label">٦٠ درجة</label>

                        <input type="radio" id="q10_c" name="q10" value="90">
                        <label for="q10_c" class="option-label">٩٠ درجة</label>

                        <input type="radio" id="q10_d" name="q10" value="120">
                        <label for="q10_d" class="option-label">١٢٠ درجة</label>
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
            q1: "straight",     // القطعة المستقيمة
            q2: "straightness", // الفرق الرئيسي
            q3: "rainbow",      // مثال الخط المنحني
            q4: "2",            // نقاط نهاية القطعة المستقيمة
            q5: "A",            // شكل المربع
            q6: "4",            // عدد أضلاع المربع
            q7: "sides",        // خاصية المربع
            q8: "4",            // عدد رؤوس المربع
            q9: "window",       // أمثلة واقعية للمربع
            q10: "90"           // قياس زوايا المربع
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
                'القطعة المستقيمة والخط المنحني': { total: 4, correct: 0 },
                'المربع': { total: 6, correct: 0 }
            };

            // حساب النقاط
            for (const [question, correctAnswer] of Object.entries(correctAnswers)) {
                const selectedOption = document.querySelector(`input[name="${question}"]:checked`);

                if (selectedOption) {
                    answeredQuestions++;
                    if (selectedOption.value === correctAnswer) {
                        score++;

                        // تحديث نتائج الأقسام
                        if (['q1', 'q2', 'q3', 'q4'].includes(question)) {
                            lessonScores['القطعة المستقيمة والخط المنحني'].correct++;
                        } else if (['q5', 'q6', 'q7', 'q8', 'q9', 'q10'].includes(question)) {
                            lessonScores['المربع'].correct++;
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
