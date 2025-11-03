<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار المضاعفات وقابلية القسمة</title>
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
            font-family: 'Courier New', monospace;
            font-size: 1.3rem;
            background: #f1f3f4;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 10px 0;
            direction: ltr;
            text-align: center;
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

        .rule-box {
            background: #e8f4fd;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
        }

        .multiples-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
            margin: 15px 0;
            text-align: center;
        }

        .number-cell {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: white;
            font-weight: bold;
        }

        .divisible-cell {
            background: #d4edda;
            border-color: #c3e6cb;
        }

        .not-divisible-cell {
            background: #f8d7da;
            border-color: #f5c6cb;
        }

        .example-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 10px;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار المضاعفات وقابلية القسمة 🔢</h1>
            <p>اختبر مهاراتك في مضاعفات الأعداد وقواعد القسمة</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- مضاعفات العدد -->
            <div class="question">
                <span class="question-number">1</span>
                <div class="question-text">ما المضاعفات الخمسة الأولى للعدد ٤؟</div>
                <div class="rule-box">مضاعفات العدد: ناتج ضربه في ١، ٢، ٣، ...</div>
                <div class="options">
                    <input type="radio" id="q1_a" name="q1" value="4,8,12,16,20">
                    <label for="q1_a" class="option-label">٤، ٨، ١٢، ١٦، ٢٠</label>

                    <input type="radio" id="q1_b" name="q1" value="4,6,8,10,12">
                    <label for="q1_b" class="option-label">٤، ٦، ٨، ١٠، ١٢</label>

                    <input type="radio" id="q1_c" name="q1" value="4,7,10,13,16">
                    <label for="q1_c" class="option-label">٤، ٧، ١٠، ١٣، ١٦</label>

                    <input type="radio" id="q1_d" name="q1" value="4,9,14,19,24">
                    <label for="q1_d" class="option-label">٤، ٩، ١٤، ١٩، ٢٤</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">2</span>
                <div class="question-text">أي من الأعداد التالية هو من مضاعفات العدد ٦؟</div>
                <div class="multiples-grid">
                    <div class="number-cell">١٨</div>
                    <div class="number-cell">٢٢</div>
                    <div class="number-cell">٢٥</div>
                    <div class="number-cell">٢٩</div>
                </div>
                <div class="options">
                    <input type="radio" id="q2_a" name="q2" value="18">
                    <label for="q2_a" class="option-label">١٨</label>

                    <input type="radio" id="q2_b" name="q2" value="22">
                    <label for="q2_b" class="option-label">٢٢</label>

                    <input type="radio" id="q2_c" name="q2" value="25">
                    <label for="q2_c" class="option-label">٢٥</label>

                    <input type="radio" id="q2_d" name="q2" value="29">
                    <label for="q2_d" class="option-label">٢٩</label>
                </div>
            </div>

            <!-- قابلية القسمة على 2 -->
            <div class="question">
                <span class="question-number">3</span>
                <div class="question-text">أي من الأعداد التالية يقبل القسمة على ٢؟</div>
                <div class="rule-box">يقبل العدد القسمة على ٢ إذا كان آحاده ٠، ٢، ٤، ٦، ٨</div>
                <div class="multiples-grid">
                    <div class="number-cell divisible-cell">٣٤</div>
                    <div class="number-cell">٢٣</div>
                    <div class="number-cell">١٥</div>
                    <div class="number-cell">٣٧</div>
                </div>
                <div class="options">
                    <input type="radio" id="q3_a" name="q3" value="34">
                    <label for="q3_a" class="option-label">٣٤</label>

                    <input type="radio" id="q3_b" name="q3" value="23">
                    <label for="q3_b" class="option-label">٢٣</label>

                    <input type="radio" id="q3_c" name="q3" value="15">
                    <label for="q3_c" class="option-label">١٥</label>

                    <input type="radio" id="q3_d" name="q3" value="37">
                    <label for="q3_d" class="option-label">٣٧</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">4</span>
                <div class="question-text">ما أصغر عدد مكون من ٣ أرقام يقبل القسمة على ٢؟</div>
                <div class="options">
                    <input type="radio" id="q4_a" name="q4" value="100">
                    <label for="q4_a" class="option-label">١٠٠</label>

                    <input type="radio" id="q4_b" name="q4" value="101">
                    <label for="q4_b" class="option-label">١٠١</label>

                    <input type="radio" id="q4_c" name="q4" value="102">
                    <label for="q4_c" class="option-label">١٠٢</label>

                    <input type="radio" id="q4_d" name="q4" value="110">
                    <label for="q4_d" class="option-label">١١٠</label>
                </div>
            </div>

            <!-- قابلية القسمة على 3 -->
            <div class="question">
                <span class="question-number">5</span>
                <div class="question-text">أي من الأعداد التالية يقبل القسمة على ٣؟</div>
                <div class="rule-box">يقبل العدد القسمة على ٣ إذا كان مجموع أرقامه يقبل القسمة على ٣</div>
                <div class="example-box">مثال: ١٢٣ → ١+٢+٣ = ٦ ← ٦ ÷ ٣ = ٢ ← يقبل القسمة</div>
                <div class="multiples-grid">
                    <div class="number-cell">١٤</div>
                    <div class="number-cell divisible-cell">١٥</div>
                    <div class="number-cell">١٧</div>
                    <div class="number-cell">١٩</div>
                </div>
                <div class="options">
                    <input type="radio" id="q5_a" name="q5" value="14">
                    <label for="q5_a" class="option-label">١٤</label>

                    <input type="radio" id="q5_b" name="q5" value="15">
                    <label for="q5_b" class="option-label">١٥</label>

                    <input type="radio" id="q5_c" name="q5" value="17">
                    <label for="q5_c" class="option-label">١٧</label>

                    <input type="radio" id="q5_d" name="q5" value="19">
                    <label for="q5_d" class="option-label">١٩</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">6</span>
                <div class="question-text">هل العدد ٢٤٦ يقبل القسمة على ٣؟</div>
                <div class="math-operation">٢ + ٤ + ٦ = ١٢ ← ١٢ ÷ ٣ = ٤</div>
                <div class="options">
                    <input type="radio" id="q6_a" name="q6" value="yes">
                    <label for="q6_a" class="option-label">نعم</label>

                    <input type="radio" id="q6_b" name="q6" value="no">
                    <label for="q6_b" class="option-label">لا</label>
                </div>
            </div>

            <!-- قابلية القسمة على 4 -->
            <div class="question">
                <span class="question-number">7</span>
                <div class="question-text">أي من الأعداد التالية يقبل القسمة على ٤؟</div>
                <div class="rule-box">يقبل العدد القسمة على ٤ إذا كان العدد المكون من آحاده وعشراته يقبل القسمة على ٤</div>
                <div class="example-box">مثال: ٣٢٤ → ٢٤ ÷ ٤ = ٦ ← يقبل القسمة</div>
                <div class="multiples-grid">
                    <div class="number-cell">٢١٨</div>
                    <div class="number-cell divisible-cell">٢٣٢</div>
                    <div class="number-cell">٢٤٦</div>
                    <div class="number-cell">٢٥٨</div>
                </div>
                <div class="options">
                    <input type="radio" id="q7_a" name="q7" value="218">
                    <label for="q7_a" class="option-label">٢١٨</label>

                    <input type="radio" id="q7_b" name="q7" value="232">
                    <label for="q7_b" class="option-label">٢٣٢</label>

                    <input type="radio" id="q7_c" name="q7" value="246">
                    <label for="q7_c" class="option-label">٢٤٦</label>

                    <input type="radio" id="q7_d" name="q7" value="258">
                    <label for="q7_d" class="option-label">٢٥٨</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">8</span>
                <div class="question-text">ما أصغر عدد مكون من ٣ أرقام يقبل القسمة على ٤؟</div>
                <div class="options">
                    <input type="radio" id="q8_a" name="q8" value="100">
                    <label for="q8_a" class="option-label">١٠٠</label>

                    <input type="radio" id="q8_b" name="q8" value="104">
                    <label for="q8_b" class="option-label">١٠٤</label>

                    <input type="radio" id="q8_c" name="q8" value="108">
                    <label for="q8_c" class="option-label">١٠٨</label>

                    <input type="radio" id="q8_d" name="q8" value="112">
                    <label for="q8_d" class="option-label">١١٢</label>
                </div>
            </div>

            <!-- قابلية القسمة على 5 -->
            <div class="question">
                <span class="question-number">9</span>
                <div class="question-text">أي من الأعداد التالية يقبل القسمة على ٥؟</div>
                <div class="rule-box">يقبل العدد القسمة على ٥ إذا كان آحاده ٠ أو ٥</div>
                <div class="multiples-grid">
                    <div class="number-cell">٢٣</div>
                    <div class="number-cell">٣٤</div>
                    <div class="number-cell divisible-cell">٤٥</div>
                    <div class="number-cell">٥٦</div>
                </div>
                <div class="options">
                    <input type="radio" id="q9_a" name="q9" value="23">
                    <label for="q9_a" class="option-label">٢٣</label>

                    <input type="radio" id="q9_b" name="q9" value="34">
                    <label for="q9_b" class="option-label">٣٤</label>

                    <input type="radio" id="q9_c" name="q9" value="45">
                    <label for="q9_c" class="option-label">٤٥</label>

                    <input type="radio" id="q9_d" name="q9" value="56">
                    <label for="q9_d" class="option-label">٥٦</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">10</span>
                <div class="question-text">ما أكبر عدد مكون من ٣ أرقام يقبل القسمة على ٥؟</div>
                <div class="options">
                    <input type="radio" id="q10_a" name="q10" value="995">
                    <label for="q10_a" class="option-label">٩٩٥</label>

                    <input type="radio" id="q10_b" name="q10" value="990">
                    <label for="q10_b" class="option-label">٩٩٠</label>

                    <input type="radio" id="q10_c" name="q10" value="985">
                    <label for="q10_c" class="option-label">٩٨٥</label>

                    <input type="radio" id="q10_d" name="q10" value="980">
                    <label for="q10_d" class="option-label">٩٨٠</label>
                </div>
            </div>

            <!-- تمييز القابلية للقسمة -->
            <div class="question">
                <span class="question-number">11</span>
                <div class="question-text">أي من الأعداد التالية يقبل القسمة على ٢ و ٣ معاً؟</div>
                <div class="rule-box">يقبل القسمة على ٢ و ٣ إذا كان زوجياً ومجموع أرقامه يقبل القسمة على ٣</div>
                <div class="multiples-grid">
                    <div class="number-cell">١٤</div>
                    <div class="number-cell">١٨</div>
                    <div class="number-cell">٢٠</div>
                    <div class="number-cell">٢٢</div>
                </div>
                <div class="options">
                    <input type="radio" id="q11_a" name="q11" value="14">
                    <label for="q11_a" class="option-label">١٤</label>

                    <input type="radio" id="q11_b" name="q11" value="18">
                    <label for="q11_b" class="option-label">١٨</label>

                    <input type="radio" id="q11_c" name="q11" value="20">
                    <label for="q11_c" class="option-label">٢٠</label>

                    <input type="radio" id="q11_d" name="q11" value="22">
                    <label for="q11_d" class="option-label">٢٢</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">12</span>
                <div class="question-text">أي من الأعداد التالية يقبل القسمة على ٥ و ١٠ معاً؟</div>
                <div class="options">
                    <input type="radio" id="q12_a" name="q12" value="25">
                    <label for="q12_a" class="option-label">٢٥</label>

                    <input type="radio" id="q12_b" name="q12" value="30">
                    <label for="q12_b" class="option-label">٣٠</label>

                    <input type="radio" id="q12_c" name="q12" value="35">
                    <label for="q12_c" class="option-label">٣٥</label>

                    <input type="radio" id="q12_d" name="q12" value="40">
                    <label for="q12_d" class="option-label">٤٠</label>
                </div>
            </div>

            <!-- تطبيقات عملية -->
            <div class="question">
                <span class="question-number">13</span>
                <div class="question-text">إذا كان عدد الطلاب في الفصل ٣٦ طالباً، هل يمكن توزيعهم على ٣ مجموعات بالتساوي؟</div>
                <div class="math-operation">٣٦ ÷ ٣ = ١٢</div>
                <div class="options">
                    <input type="radio" id="q13_a" name="q13" value="yes">
                    <label for="q13_a" class="option-label">نعم</label>

                    <input type="radio" id="q13_b" name="q13" value="no">
                    <label for="q13_b" class="option-label">لا</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">14</span>
                <div class="question-text">هل يمكن تقسيم ٤٥ قطعة حلوى على ٥ أطفال بالتساوي؟</div>
                <div class="math-operation">٤٥ ÷ ٥ = ٩</div>
                <div class="options">
                    <input type="radio" id="q14_a" name="q14" value="yes">
                    <label for="q14_a" class="option-label">نعم</label>

                    <input type="radio" id="q14_b" name="q14" value="no">
                    <label for="q14_b" class="option-label">لا</label>
                </div>
            </div>

            <!-- اكتشاف النمط -->
            <div class="question">
                <span class="question-number">15</span>
                <div class="question-text">ما العدد التالي في النمط: ٤، ٨، ١٢، ١٦، __؟</div>
                <div class="rule-box">النمط: مضاعفات العدد ٤</div>
                <div class="options">
                    <input type="radio" id="q15_a" name="q15" value="18">
                    <label for="q15_a" class="option-label">١٨</label>

                    <input type="radio" id="q15_b" name="q15" value="20">
                    <label for="q15_b" class="option-label">٢٠</label>

                    <input type="radio" id="q15_c" name="q15" value="22">
                    <label for="q15_c" class="option-label">٢٢</label>

                    <input type="radio" id="q15_d" name="q15" value="24">
                    <label for="q15_d" class="option-label">٢٤</label>
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
            q1: "4,8,12,16,20", // مضاعفات 4
            q2: "18",           // مضاعفات 6
            q3: "34",           // قابل القسمة على 2
            q4: "100",          // أصغر عدد 3 أرقام يقبل القسمة على 2
            q5: "15",           // قابل القسمة على 3
            q6: "yes",          // 246 ÷ 3 = 82
            q7: "232",          // قابل القسمة على 4
            q8: "100",          // أصغر عدد 3 أرقام يقبل القسمة على 4
            q9: "45",           // قابل القسمة على 5
            q10: "995",         // أكبر عدد 3 أرقام يقبل القسمة على 5
            q11: "18",          // يقبل القسمة على 2 و 3
            q12: "30",          // يقبل القسمة على 5 و 10
            q13: "yes",         // 36 ÷ 3 = 12
            q14: "yes",         // 45 ÷ 5 = 9
            q15: "20"           // مضاعفات 4
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
