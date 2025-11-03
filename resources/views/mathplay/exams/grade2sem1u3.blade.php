<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الأعداد ضمن 999</title>
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

        .place-value-box {
            background: #e8f4fd;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
        }

        .number-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
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

        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .comparison-table th,
        .comparison-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .comparison-table th {
            background: #667eea;
            color: white;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الأعداد ضمن 999 🧮</h1>
            <p>اختبر مهاراتك في فهم الأعداد من 1 إلى 999</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- الأعداد ضمن 199 -->
            <div class="question">
                <span class="question-number">1</span>
                <div class="question-text">ما العدد الذي يقع بين ١٥٠ و ١٥٢؟</div>
                <div class="options">
                    <input type="radio" id="q1_a" name="q1" value="149">
                    <label for="q1_a" class="option-label">١٤٩</label>

                    <input type="radio" id="q1_b" name="q1" value="150">
                    <label for="q1_b" class="option-label">١٥٠</label>

                    <input type="radio" id="q1_c" name="q1" value="151">
                    <label for="q1_c" class="option-label">١٥١</label>

                    <input type="radio" id="q1_d" name="q1" value="152">
                    <label for="q1_d" class="option-label">١٥٢</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">2</span>
                <div class="question-text">ما العدد التالي للعدد ١٨٩؟</div>
                <div class="options">
                    <input type="radio" id="q2_a" name="q2" value="188">
                    <label for="q2_a" class="option-label">١٨٨</label>

                    <input type="radio" id="q2_b" name="q2" value="189">
                    <label for="q2_b" class="option-label">١٨٩</label>

                    <input type="radio" id="q2_c" name="q2" value="190">
                    <label for="q2_c" class="option-label">١٩٠</label>

                    <input type="radio" id="q2_d" name="q2" value="191">
                    <label for="q2_d" class="option-label">١٩١</label>
                </div>
            </div>

            <!-- الأعداد ضمن 999 -->
            <div class="question">
                <span class="question-number">3</span>
                <div class="question-text">ما أكبر عدد مكون من ثلاثة أرقام؟</div>
                <div class="options">
                    <input type="radio" id="q3_a" name="q3" value="999">
                    <label for="q3_a" class="option-label">٩٩٩</label>

                    <input type="radio" id="q3_b" name="q3" value="1000">
                    <label for="q3_b" class="option-label">١٠٠٠</label>

                    <input type="radio" id="q3_c" name="q3" value="998">
                    <label for="q3_c" class="option-label">٩٩٨</label>

                    <input type="radio" id="q3_d" name="q3" value="990">
                    <label for="q3_d" class="option-label">٩٩٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">4</span>
                <div class="question-text">ما أصغر عدد مكون من ثلاثة أرقام؟</div>
                <div class="options">
                    <input type="radio" id="q4_a" name="q4" value="99">
                    <label for="q4_a" class="option-label">٩٩</label>

                    <input type="radio" id="q4_b" name="q4" value="100">
                    <label for="q4_b" class="option-label">١٠٠</label>

                    <input type="radio" id="q4_c" name="q4" value="101">
                    <label for="q4_c" class="option-label">١٠١</label>

                    <input type="radio" id="q4_d" name="q4" value="111">
                    <label for="q4_d" class="option-label">١١١</label>
                </div>
            </div>

            <!-- القيمة المنزلية للاعداد ضمن 999 -->
            <div class="question">
                <span class="question-number">5</span>
                <div class="question-text">في العدد ٤٧٨، ما قيمة الرقم ٤؟</div>
                <div class="place-value-box">العدد: ٤٧٨ → ٤ مئات + ٧ عشرات + ٨ آحاد</div>
                <div class="options">
                    <input type="radio" id="q5_a" name="q5" value="4">
                    <label for="q5_a" class="option-label">٤</label>

                    <input type="radio" id="q5_b" name="q5" value="40">
                    <label for="q5_b" class="option-label">٤٠</label>

                    <input type="radio" id="q5_c" name="q5" value="400">
                    <label for="q5_c" class="option-label">٤٠٠</label>

                    <input type="radio" id="q5_d" name="q5" value="478">
                    <label for="q5_d" class="option-label">٤٧٨</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">6</span>
                <div class="question-text">في العدد ٦٢٥، ما قيمة الرقم ٢؟</div>
                <div class="place-value-box">العدد: ٦٢٥ → ٦ مئات + ٢ عشرات + ٥ آحاد</div>
                <div class="options">
                    <input type="radio" id="q6_a" name="q6" value="2">
                    <label for="q6_a" class="option-label">٢</label>

                    <input type="radio" id="q6_b" name="q6" value="20">
                    <label for="q6_b" class="option-label">٢٠</label>

                    <input type="radio" id="q6_c" name="q6" value="200">
                    <label for="q6_c" class="option-label">٢٠٠</label>

                    <input type="radio" id="q6_d" name="q6" value="25">
                    <label for="q6_d" class="option-label">٢٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">7</span>
                <div class="question-text">ما العدد الذي يحتوي على ٥ مئات و ٣ عشرات و ٩ آحاد؟</div>
                <div class="place-value-box">٥ مئات + ٣ عشرات + ٩ آحاد = ?</div>
                <div class="options">
                    <input type="radio" id="q7_a" name="q7" value="539">
                    <label for="q7_a" class="option-label">٥٣٩</label>

                    <input type="radio" id="q7_b" name="q7" value="593">
                    <label for="q7_b" class="option-label">٥٩٣</label>

                    <input type="radio" id="q7_c" name="q7" value="359">
                    <label for="q7_c" class="option-label">٣٥٩</label>

                    <input type="radio" id="q7_d" name="q7" value="395">
                    <label for="q7_d" class="option-label">٣٩٥</label>
                </div>
            </div>

            <!-- مقارنة الاعداد ضمن 999 -->
            <div class="question">
                <span class="question-number">8</span>
                <div class="question-text">أي من الأعداد التالية أكبر من ٤٥٠؟</div>
                <div class="options">
                    <input type="radio" id="q8_a" name="q8" value="449">
                    <label for="q8_a" class="option-label">٤٤٩</label>

                    <input type="radio" id="q8_b" name="q8" value="450">
                    <label for="q8_b" class="option-label">٤٥٠</label>

                    <input type="radio" id="q8_c" name="q8" value="451">
                    <label for="q8_c" class="option-label">٤٥١</label>

                    <input type="radio" id="q8_d" name="q8" value="445">
                    <label for="q8_d" class="option-label">٤٤٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">9</span>
                <div class="question-text">أي من الأعداد التالية أصغر من ٦٧٥؟</div>
                <div class="options">
                    <input type="radio" id="q9_a" name="q9" value="680">
                    <label for="q9_a" class="option-label">٦٨٠</label>

                    <input type="radio" id="q9_b" name="q9" value="700">
                    <label for="q9_b" class="option-label">٧٠٠</label>

                    <input type="radio" id="q9_c" name="q9" value="674">
                    <label for="q9_c" class="option-label">٦٧٤</label>

                    <input type="radio" id="q9_d" name="q9" value="676">
                    <label for="q9_d" class="option-label">٦٧٦</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">10</span>
                <div class="question-text">أي من العبارات التالية صحيحة؟</div>
                <table class="comparison-table">
                    <tr>
                        <th>الخيار</th>
                        <th>المقارنة</th>
                    </tr>
                    <tr>
                        <td>أ</td>
                        <td>٣٢٤ > ٣٤٢</td>
                    </tr>
                    <tr>
                        <td>ب</td>
                        <td>٥٦٧ < ٥٦٦</td>
                    </tr>
                    <tr>
                        <td>ج</td>
                        <td>٧٨٩ = ٧٨٩</td>
                    </tr>
                    <tr>
                        <td>د</td>
                        <td>٨٩١ > ٩٠٠</td>
                    </tr>
                </table>
                <div class="options">
                    <input type="radio" id="q10_a" name="q10" value="324>342">
                    <label for="q10_a" class="option-label">أ</label>

                    <input type="radio" id="q10_b" name="q10" value="567<566">
                    <label for="q10_b" class="option-label">ب</label>

                    <input type="radio" id="q10_c" name="q10" value="789=789">
                    <label for="q10_c" class="option-label">ج</label>

                    <input type="radio" id="q10_d" name="q10" value="891>900">
                    <label for="q10_d" class="option-label">د</label>
                </div>
            </div>

            <!-- ترتيب الاعداد ضمن 999 -->
            <div class="question">
                <span class="question-number">11</span>
                <div class="question-text">ما الترتيب التصاعدي الصحيح للأعداد: ٣٤٥، ٢٣٤، ٤٥٦؟</div>
                <div class="number-grid">
                    <div class="number-cell">٣٤٥</div>
                    <div class="number-cell">٢٣٤</div>
                    <div class="number-cell">٤٥٦</div>
                </div>
                <div class="options">
                    <input type="radio" id="q11_a" name="q11" value="234,345,456">
                    <label for="q11_a" class="option-label">٢٣٤، ٣٤٥، ٤٥٦</label>

                    <input type="radio" id="q11_b" name="q11" value="456,345,234">
                    <label for="q11_b" class="option-label">٤٥٦، ٣٤٥، ٢٣٤</label>

                    <input type="radio" id="q11_c" name="q11" value="345,234,456">
                    <label for="q11_c" class="option-label">٣٤٥، ٢٣٤، ٤٥٦</label>

                    <input type="radio" id="q11_d" name="q11" value="234,456,345">
                    <label for="q11_d" class="option-label">٢٣٤، ٤٥٦، ٣٤٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">12</span>
                <div class="question-text">ما الترتيب التنازلي الصحيح للأعداد: ٦٧٨، ٧٨٩، ٥٦٧؟</div>
                <div class="number-grid">
                    <div class="number-cell">٦٧٨</div>
                    <div class="number-cell">٧٨٩</div>
                    <div class="number-cell">٥٦٧</div>
                </div>
                <div class="options">
                    <input type="radio" id="q12_a" name="q12" value="567,678,789">
                    <label for="q12_a" class="option-label">٥٦٧، ٦٧٨، ٧٨٩</label>

                    <input type="radio" id="q12_b" name="q12" value="789,678,567">
                    <label for="q12_b" class="option-label">٧٨٩، ٦٧٨، ٥٦٧</label>

                    <input type="radio" id="q12_c" name="q12" value="678,789,567">
                    <label for="q12_c" class="option-label">٦٧٨، ٧٨٩، ٥٦٧</label>

                    <input type="radio" id="q12_d" name="q12" value="789,567,678">
                    <label for="q12_d" class="option-label">٧٨٩، ٥٦٧، ٦٧٨</label>
                </div>
            </div>

            <!-- أسئلة شاملة -->
            <div class="question">
                <span class="question-number">13</span>
                <div class="question-text">ما الصورة الموسعة للعدد ٨٣٦؟</div>
                <div class="options">
                    <input type="radio" id="q13_a" name="q13" value="800+30+6">
                    <label for="q13_a" class="option-label">٨٠٠ + ٣٠ + ٦</label>

                    <input type="radio" id="q13_b" name="q13" value="80+30+6">
                    <label for="q13_b" class="option-label">٨٠ + ٣٠ + ٦</label>

                    <input type="radio" id="q13_c" name="q13" value="800+3+6">
                    <label for="q13_c" class="option-label">٨٠٠ + ٣ + ٦</label>

                    <input type="radio" id="q13_d" name="q13" value="8+3+6">
                    <label for="q13_d" class="option-label">٨ + ٣ + ٦</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">14</span>
                <div class="question-text">أي من هذه الأعداد هو الأكبر؟</div>
                <div class="number-grid">
                    <div class="number-cell">٤٥٦</div>
                    <div class="number-cell">٤٦٥</div>
                    <div class="number-cell">٤٥٤</div>
                </div>
                <div class="options">
                    <input type="radio" id="q14_a" name="q14" value="456">
                    <label for="q14_a" class="option-label">٤٥٦</label>

                    <input type="radio" id="q14_b" name="q14" value="465">
                    <label for="q14_b" class="option-label">٤٦٥</label>

                    <input type="radio" id="q14_c" name="q14" value="454">
                    <label for="q14_c" class="option-label">٤٥٤</label>

                    <input type="radio" id="q14_d" name="q14" value="455">
                    <label for="q14_d" class="option-label">٤٥٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">15</span>
                <div class="question-text">ما العدد الذي يمثل: ٦٠٠ + ٥٠ + ٧؟</div>
                <div class="math-operation">600 + 50 + 7 = ?</div>
                <div class="options">
                    <input type="radio" id="q15_a" name="q15" value="657">
                    <label for="q15_a" class="option-label">٦٥٧</label>

                    <input type="radio" id="q15_b" name="q15" value="675">
                    <label for="q15_b" class="option-label">٦٧٥</label>

                    <input type="radio" id="q15_c" name="q15" value="6507">
                    <label for="q15_c" class="option-label">٦٥٠٧</label>

                    <input type="radio" id="q15_d" name="q15" value="607">
                    <label for="q15_d" class="option-label">٦٠٧</label>
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
            q1: "151",      // بين 150 و 152
            q2: "190",      // التالي لـ 189
            q3: "999",      // أكبر عدد مكون من 3 أرقام
            q4: "100",      // أصغر عدد مكون من 3 أرقام
            q5: "400",      // قيمة الرقم 4 في 478
            q6: "20",       // قيمة الرقم 2 في 625
            q7: "539",      // 5 مئات + 3 عشرات + 9 آحاد
            q8: "451",      // أكبر من 450
            q9: "674",      // أصغر من 675
            q10: "789=789", // المساواة صحيحة
            q11: "234,345,456", // ترتيب تصاعدي
            q12: "789,678,567", // ترتيب تنازلي
            q13: "800+30+6", // الصورة الموسعة لـ 836
            q14: "465",     // أكبر عدد
            q15: "657"      // 600 + 50 + 7
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
