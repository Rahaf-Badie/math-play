<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الكسور والأعداد العشرية</title>
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

        .decimal-box {
            background: #e8f4fd;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
        }

        .fraction-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
            font-size: 1.4rem;
        }

        .number-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .number-point {
            text-align: center;
            font-weight: bold;
        }

        .vertical-operation {
            font-family: 'Courier New', monospace;
            font-size: 1.2rem;
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            direction: ltr;
            text-align: right;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الكسور والأعداد العشرية 🔢</h1>
            <p>اختبر مهاراتك في الكسور العشرية والأعداد العشرية وعملياتها</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- الكسور العشرية -->
            <div class="question">
                <span class="question-number">1</span>
                <div class="question-text">ما الكسر العشري الذي يمثل ٣ من ١٠؟</div>
                <div class="fraction-visual">
                    <span>٣</span>
                    <span style="border-bottom: 2px solid #000; padding: 0 10px;">─</span>
                    <span>١٠</span>
                </div>
                <div class="options">
                    <input type="radio" id="q1_a" name="q1" value="3/10">
                    <label for="q1_a" class="option-label">٣/١٠</label>

                    <input type="radio" id="q1_b" name="q1" value="10/3">
                    <label for="q1_b" class="option-label">١٠/٣</label>

                    <input type="radio" id="q1_c" name="q1" value="0.3">
                    <label for="q1_c" class="option-label">٠٫٣</label>

                    <input type="radio" id="q1_d" name="q1" value="0.03">
                    <label for="q1_d" class="option-label">٠٫٠٣</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">2</span>
                <div class="question-text">ما الكسر العشري الذي يمثل ٧ من ١٠؟</div>
                <div class="fraction-visual">
                    <span>٧</span>
                    <span style="border-bottom: 2px solid #000; padding: 0 10px;">─</span>
                    <span>١٠</span>
                </div>
                <div class="options">
                    <input type="radio" id="q2_a" name="q2" value="0.7">
                    <label for="q2_a" class="option-label">٠٫٧</label>

                    <input type="radio" id="q2_b" name="q2" value="0.07">
                    <label for="q2_b" class="option-label">٠٫٠٧</label>

                    <input type="radio" id="q2_c" name="q2" value="7/10">
                    <label for="q2_c" class="option-label">٧/١٠</label>

                    <input type="radio" id="q2_d" name="q2" value="10/7">
                    <label for="q2_d" class="option-label">١٠/٧</label>
                </div>
            </div>

            <!-- الأعداد العشرية -->
            <div class="question">
                <span class="question-number">3</span>
                <div class="question-text">ما العدد العشري ٠٫٦ في صورة كسر عشري؟</div>
                <div class="decimal-box">٠٫٦ = ? / ١٠</div>
                <div class="options">
                    <input type="radio" id="q3_a" name="q3" value="6/10">
                    <label for="q3_a" class="option-label">٦/١٠</label>

                    <input type="radio" id="q3_b" name="q3" value="6/100">
                    <label for="q3_b" class="option-label">٦/١٠٠</label>

                    <input type="radio" id="q3_c" name="q3" value="60/10">
                    <label for="q3_c" class="option-label">٦٠/١٠</label>

                    <input type="radio" id="q3_d" name="q3" value="10/6">
                    <label for="q3_d" class="option-label">١٠/٦</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">4</span>
                <div class="question-text">ما العدد العشري ٠٫٩ في صورة كسر عشري؟</div>
                <div class="math-operation">٠٫٩ = ?</div>
                <div class="options">
                    <input type="radio" id="q4_a" name="q4" value="9/10">
                    <label for="q4_a" class="option-label">٩/١٠</label>

                    <input type="radio" id="q4_b" name="q4" value="9/100">
                    <label for="q4_b" class="option-label">٩/١٠٠</label>

                    <input type="radio" id="q4_c" name="q4" value="90/10">
                    <label for="q4_c" class="option-label">٩٠/١٠</label>

                    <input type="radio" id="q4_d" name="q4" value="10/9">
                    <label for="q4_d" class="option-label">١٠/٩</label>
                </div>
            </div>

            <!-- جمع الكسور العشرية -->
            <div class="question">
                <span class="question-number">5</span>
                <div class="question-text">ما ناتج جمع: ٢/١٠ + ٤/١٠؟</div>
                <div class="math-operation">²/₁₀ + ⁴/₁₀ = ?</div>
                <div class="options">
                    <input type="radio" id="q5_a" name="q5" value="6/10">
                    <label for="q5_a" class="option-label">٦/١٠</label>

                    <input type="radio" id="q5_b" name="q5" value="2/10">
                    <label for="q5_b" class="option-label">٢/١٠</label>

                    <input type="radio" id="q5_c" name="q5" value="8/10">
                    <label for="q5_c" class="option-label">٨/١٠</label>

                    <input type="radio" id="q5_d" name="q5" value="4/10">
                    <label for="q5_d" class="option-label">٤/١٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">6</span>
                <div class="question-text">ما ناتج جمع: ٣/١٠ + ٥/١٠؟</div>
                <div class="fraction-visual">
                    <span>٣ + ٥</span>
                    <span style="border-bottom: 2px solid #000; padding: 0 10px;">────────</span>
                    <span>١٠</span>
                </div>
                <div class="options">
                    <input type="radio" id="q6_a" name="q6" value="8/10">
                    <label for="q6_a" class="option-label">٨/١٠</label>

                    <input type="radio" id="q6_b" name="q6" value="2/10">
                    <label for="q6_b" class="option-label">٢/١٠</label>

                    <input type="radio" id="q6_c" name="q6" value="15/10">
                    <label for="q6_c" class="option-label">١٥/١٠</label>

                    <input type="radio" id="q6_d" name="q6" value="35/10">
                    <label for="q6_d" class="option-label">٣٥/١٠</label>
                </div>
            </div>

            <!-- طرح الكسور العشرية -->
            <div class="question">
                <span class="question-number">7</span>
                <div class="question-text">ما ناتج طرح: ٧/١٠ - ٢/١٠؟</div>
                <div class="math-operation">⁷/₁₀ - ²/₁₀ = ?</div>
                <div class="options">
                    <input type="radio" id="q7_a" name="q7" value="5/10">
                    <label for="q7_a" class="option-label">٥/١٠</label>

                    <input type="radio" id="q7_b" name="q7" value="9/10">
                    <label for="q7_b" class="option-label">٩/١٠</label>

                    <input type="radio" id="q7_c" name="q7" value="14/10">
                    <label for="q7_c" class="option-label">١٤/١٠</label>

                    <input type="radio" id="q7_d" name="q7" value="2/10">
                    <label for="q7_d" class="option-label">٢/١٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">8</span>
                <div class="question-text">ما ناتج طرح: ٩/١٠ - ٤/١٠؟</div>
                <div class="fraction-visual">
                    <span>٩ - ٤</span>
                    <span style="border-bottom: 2px solid #000; padding: 0 10px;">────────</span>
                    <span>١٠</span>
                </div>
                <div class="options">
                    <input type="radio" id="q8_a" name="q8" value="5/10">
                    <label for="q8_a" class="option-label">٥/١٠</label>

                    <input type="radio" id="q8_b" name="q8" value="13/10">
                    <label for="q8_b" class="option-label">١٣/١٠</label>

                    <input type="radio" id="q8_c" name="q8" value="4/10">
                    <label for="q8_c" class="option-label">٤/١٠</label>

                    <input type="radio" id="q8_d" name="q8" value="36/10">
                    <label for="q8_d" class="option-label">٣٦/١٠</label>
                </div>
            </div>

            <!-- جمع الأعداد العشرية -->
            <div class="question">
                <span class="question-number">9</span>
                <div class="question-text">ما ناتج جمع: ٠٫٣ + ٠٫٤؟</div>
                <div class="vertical-operation">
                    <div>  ٠٫٣</div>
                    <div>+ ٠٫٤</div>
                    <div style="border-top: 2px solid #000; margin-top: 5px;">______</div>
                </div>
                <div class="options">
                    <input type="radio" id="q9_a" name="q9" value="0.7">
                    <label for="q9_a" class="option-label">٠٫٧</label>

                    <input type="radio" id="q9_b" name="q9" value="0.1">
                    <label for="q9_b" class="option-label">٠٫١</label>

                    <input type="radio" id="q9_c" name="q9" value="0.12">
                    <label for="q9_c" class="option-label">٠٫١٢</label>

                    <input type="radio" id="q9_d" name="q9" value="7.0">
                    <label for="q9_d" class="option-label">٧٫٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">10</span>
                <div class="question-text">ما ناتج جمع: ٠٫٦ + ٠٫٢؟</div>
                <div class="math-operation">0.6 + 0.2 = ?</div>
                <div class="options">
                    <input type="radio" id="q10_a" name="q10" value="0.8">
                    <label for="q10_a" class="option-label">٠٫٨</label>

                    <input type="radio" id="q10_b" name="q10" value="0.4">
                    <label for="q10_b" class="option-label">٠٫٤</label>

                    <input type="radio" id="q10_c" name="q10" value="0.62">
                    <label for="q10_c" class="option-label">٠٫٦٢</label>

                    <input type="radio" id="q10_d" name="q10" value="8.0">
                    <label for="q10_d" class="option-label">٨٫٠</label>
                </div>
            </div>

            <!-- طرح الأعداد العشرية -->
            <div class="question">
                <span class="question-number">11</span>
                <div class="question-text">ما ناتج طرح: ٠٫٨ - ٠٫٣؟</div>
                <div class="vertical-operation">
                    <div>  ٠٫٨</div>
                    <div>- ٠٫٣</div>
                    <div style="border-top: 2px solid #000; margin-top: 5px;">______</div>
                </div>
                <div class="options">
                    <input type="radio" id="q11_a" name="q11" value="0.5">
                    <label for="q11_a" class="option-label">٠٫٥</label>

                    <input type="radio" id="q11_b" name="q11" value="0.11">
                    <label for="q11_b" class="option-label">٠٫١١</label>

                    <input type="radio" id="q11_c" name="q11" value="1.1">
                    <label for="q11_c" class="option-label">١٫١</label>

                    <input type="radio" id="q11_d" name="q11" value="0.83">
                    <label for="q11_d" class="option-label">٠٫٨٣</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">12</span>
                <div class="question-text">ما ناتج طرح: ٠٫٩ - ٠٫٤؟</div>
                <div class="math-operation">0.9 - 0.4 = ?</div>
                <div class="options">
                    <input type="radio" id="q12_a" name="q12" value="0.5">
                    <label for="q12_a" class="option-label">٠٫٥</label>

                    <input type="radio" id="q12_b" name="q12" value="0.13">
                    <label for="q12_b" class="option-label">٠٫١٣</label>

                    <input type="radio" id="q12_c" name="q12" value="1.3">
                    <label for="q12_c" class="option-label">١٫٣</label>

                    <input type="radio" id="q12_d" name="q12" value="0.94">
                    <label for="q12_d" class="option-label">٠٫٩٤</label>
                </div>
            </div>

            <!-- تحويل بين الصورتين -->
            <div class="question">
                <span class="question-number">13</span>
                <div class="question-text">ما العدد العشري الممثل للكسر ٤/١٠؟</div>
                <div class="fraction-visual">
                    <span>٤</span>
                    <span style="border-bottom: 2px solid #000; padding: 0 10px;">─</span>
                    <span>١٠</span>
                </div>
                <div class="options">
                    <input type="radio" id="q13_a" name="q13" value="0.4">
                    <label for="q13_a" class="option-label">٠٫٤</label>

                    <input type="radio" id="q13_b" name="q13" value="0.04">
                    <label for="q13_b" class="option-label">٠٫٠٤</label>

                    <input type="radio" id="q13_c" name="q13" value="4.0">
                    <label for="q13_c" class="option-label">٤٫٠</label>

                    <input type="radio" id="q13_d" name="q13" value="0.14">
                    <label for="q13_d" class="option-label">٠٫١٤</label>
                </div>
            </div>

            <!-- مسائل كلامية -->
            <div class="question">
                <span class="question-number">14</span>
                <div class="question-text">إذا كان طول قلم ٠٫٣ متر، وطول قلم آخر ٠٫٥ متر، فما الطول الإجمالي؟</div>
                <div class="math-operation">0.3 + 0.5 = ?</div>
                <div class="options">
                    <input type="radio" id="q14_a" name="q14" value="0.8">
                    <label for="q14_a" class="option-label">٠٫٨ متر</label>

                    <input type="radio" id="q14_b" name="q14" value="0.2">
                    <label for="q14_b" class="option-label">٠٫٢ متر</label>

                    <input type="radio" id="q14_c" name="q14" value="0.35">
                    <label for="q14_c" class="option-label">٠٫٣٥ متر</label>

                    <input type="radio" id="q14_d" name="q14" value="8.0">
                    <label for="q14_d" class="option-label">٨٫٠ متر</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">15</span>
                <div class="question-text">إذا كان مع سارة ٠٫٩ ريال، وأنفقت ٠٫٤ ريال، فكم بقي معها؟</div>
                <div class="math-operation">0.9 - 0.4 = ?</div>
                <div class="options">
                    <input type="radio" id="q15_a" name="q15" value="0.5">
                    <label for="q15_a" class="option-label">٠٫٥ ريال</label>

                    <input type="radio" id="q15_b" name="q15" value="0.13">
                    <label for="q15_b" class="option-label">٠٫١٣ ريال</label>

                    <input type="radio" id="q15_c" name="q15" value="1.3">
                    <label for="q15_c" class="option-label">١٫٣ ريال</label>

                    <input type="radio" id="q15_d" name="q15" value="0.94">
                    <label for="q15_d" class="option-label">٠٫٩٤ ريال</label>
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
            q1: "3/10",     // 3 من 10
            q2: "0.7",      // 7 من 10
            q3: "6/10",     // 0.6 = 6/10
            q4: "9/10",     // 0.9 = 9/10
            q5: "6/10",     // 2/10 + 4/10 = 6/10
            q6: "8/10",     // 3/10 + 5/10 = 8/10
            q7: "5/10",     // 7/10 - 2/10 = 5/10
            q8: "5/10",     // 9/10 - 4/10 = 5/10
            q9: "0.7",      // 0.3 + 0.4 = 0.7
            q10: "0.8",     // 0.6 + 0.2 = 0.8
            q11: "0.5",     // 0.8 - 0.3 = 0.5
            q12: "0.5",     // 0.9 - 0.4 = 0.5
            q13: "0.4",     // 4/10 = 0.4
            q14: "0.8",     // 0.3 + 0.5 = 0.8
            q15: "0.5"      // 0.9 - 0.4 = 0.5
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
