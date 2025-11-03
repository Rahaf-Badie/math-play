<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الضرب والعد القفزي</title>
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

        .multiplication-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 5px;
            margin: 15px 0;
            text-align: center;
        }

        .multiplication-cell {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
            font-weight: bold;
        }

        .skip-counting-box {
            background: #e8f4fd;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
        }

        .visual-representation {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
            flex-wrap: wrap;
        }

        .group-item {
            width: 30px;
            height: 30px;
            background: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
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
            <h1>اختبار الضرب والعد القفزي 🧮</h1>
            <p>اختبر مهاراتك في العد القفزي وحقائق الضرب</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- العد القفزي -->
            <div class="question">
                <span class="question-number">1</span>
                <div class="question-text">ما الأعداد الناقصة في العد القفزي بالخمسات: ٥، ١٠، ١٥، __، __، ٣٠؟</div>
                <div class="skip-counting-box">٥ ← ١٠ ← ١٥ ← ? ← ? ← ٣٠</div>
                <div class="options">
                    <input type="radio" id="q1_a" name="q1" value="16,17">
                    <label for="q1_a" class="option-label">١٦، ١٧</label>

                    <input type="radio" id="q1_b" name="q1" value="20,25">
                    <label for="q1_b" class="option-label">٢٠، ٢٥</label>

                    <input type="radio" id="q1_c" name="q1" value="18,20">
                    <label for="q1_c" class="option-label">١٨، ٢٠</label>

                    <input type="radio" id="q1_d" name="q1" value="25,30">
                    <label for="q1_d" class="option-label">٢٥، ٣٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">2</span>
                <div class="question-text">ما العدد التالي في العد القفزي بالثلاثات: ٣، ٦، ٩، ١٢، __؟</div>
                <div class="skip-counting-box">٣ ← ٦ ← ٩ ← ١٢ ← ?</div>
                <div class="options">
                    <input type="radio" id="q2_a" name="q2" value="13">
                    <label for="q2_a" class="option-label">١٣</label>

                    <input type="radio" id="q2_b" name="q2" value="14">
                    <label for="q2_b" class="option-label">١٤</label>

                    <input type="radio" id="q2_c" name="q2" value="15">
                    <label for="q2_c" class="option-label">١٥</label>

                    <input type="radio" id="q2_d" name="q2" value="16">
                    <label for="q2_d" class="option-label">١٦</label>
                </div>
            </div>

            <!-- مفهوم الضرب -->
            <div class="question">
                <span class="question-number">3</span>
                <div class="question-text">إذا كان لدينا ٤ مجموعات، في كل مجموعة ٣ تفاحات. فكم عدد التفاحات الإجمالي؟</div>
                <div class="visual-representation">
                    <div class="group-item">٣</div>
                    <div class="group-item">٣</div>
                    <div class="group-item">٣</div>
                    <div class="group-item">٣</div>
                </div>
                <div class="options">
                    <input type="radio" id="q3_a" name="q3" value="7">
                    <label for="q3_a" class="option-label">٧</label>

                    <input type="radio" id="q3_b" name="q3" value="12">
                    <label for="q3_b" class="option-label">١٢</label>

                    <input type="radio" id="q3_c" name="q3" value="10">
                    <label for="q3_c" class="option-label">١٠</label>

                    <input type="radio" id="q3_d" name="q3" value="14">
                    <label for="q3_d" class="option-label">١٤</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">4</span>
                <div class="question-text">ما العملية التي تمثل: ٥ + ٥ + ٥ + ٥؟</div>
                <div class="math-operation">5 + 5 + 5 + 5 = ? × ?</div>
                <div class="options">
                    <input type="radio" id="q4_a" name="q4" value="4x5">
                    <label for="q4_a" class="option-label">٤ × ٥</label>

                    <input type="radio" id="q4_b" name="q4" value="5x4">
                    <label for="q4_b" class="option-label">٥ × ٤</label>

                    <input type="radio" id="q4_c" name="q4" value="5x5">
                    <label for="q4_c" class="option-label">٥ × ٥</label>

                    <input type="radio" id="q4_d" name="q4" value="4x4">
                    <label for="q4_d" class="option-label">٤ × ٤</label>
                </div>
            </div>

            <!-- حقائق الضرب للعدد 2 -->
            <div class="question">
                <span class="question-number">5</span>
                <div class="question-text">ما ناتج ٢ × ٧؟</div>
                <div class="math-operation">2 × 7 = ?</div>
                <div class="options">
                    <input type="radio" id="q5_a" name="q5" value="14">
                    <label for="q5_a" class="option-label">١٤</label>

                    <input type="radio" id="q5_b" name="q5" value="9">
                    <label for="q5_b" class="option-label">٩</label>

                    <input type="radio" id="q5_c" name="q5" value="12">
                    <label for="q5_c" class="option-label">١٢</label>

                    <input type="radio" id="q5_d" name="q5" value="16">
                    <label for="q5_d" class="option-label">١٦</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">6</span>
                <div class="question-text">ما ناتج ٨ × ٢؟</div>
                <div class="math-operation">8 × 2 = ?</div>
                <div class="options">
                    <input type="radio" id="q6_a" name="q6" value="10">
                    <label for="q6_a" class="option-label">١٠</label>

                    <input type="radio" id="q6_b" name="q6" value="16">
                    <label for="q6_b" class="option-label">١٦</label>

                    <input type="radio" id="q6_c" name="q6" value="14">
                    <label for="q6_c" class="option-label">١٤</label>

                    <input type="radio" id="q6_d" name="q6" value="18">
                    <label for="q6_d" class="option-label">١٨</label>
                </div>
            </div>

            <!-- حقائق الضرب للعدد 3 -->
            <div class="question">
                <span class="question-number">7</span>
                <div class="question-text">ما ناتج ٣ × ٦؟</div>
                <div class="math-operation">3 × 6 = ?</div>
                <div class="options">
                    <input type="radio" id="q7_a" name="q7" value="18">
                    <label for="q7_a" class="option-label">١٨</label>

                    <input type="radio" id="q7_b" name="q7" value="15">
                    <label for="q7_b" class="option-label">١٥</label>

                    <input type="radio" id="q7_c" name="q7" value="9">
                    <label for="q7_c" class="option-label">٩</label>

                    <input type="radio" id="q7_d" name="q7" value="21">
                    <label for="q7_d" class="option-label">٢١</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">8</span>
                <div class="question-text">ما ناتج ٤ × ٣؟</div>
                <div class="math-operation">4 × 3 = ?</div>
                <div class="options">
                    <input type="radio" id="q8_a" name="q8" value="7">
                    <label for="q8_a" class="option-label">٧</label>

                    <input type="radio" id="q8_b" name="q8" value="12">
                    <label for="q8_b" class="option-label">١٢</label>

                    <input type="radio" id="q8_c" name="q8" value="10">
                    <label for="q8_c" class="option-label">١٠</label>

                    <input type="radio" id="q8_d" name="q8" value="14">
                    <label for="q8_d" class="option-label">١٤</label>
                </div>
            </div>

            <!-- حقائق الضرب للعدد 4 -->
            <div class="question">
                <span class="question-number">9</span>
                <div class="question-text">ما ناتج ٤ × ٧؟</div>
                <div class="math-operation">4 × 7 = ?</div>
                <div class="options">
                    <input type="radio" id="q9_a" name="q9" value="24">
                    <label for="q9_a" class="option-label">٢٤</label>

                    <input type="radio" id="q9_b" name="q9" value="28">
                    <label for="q9_b" class="option-label">٢٨</label>

                    <input type="radio" id="q9_c" name="q9" value="32">
                    <label for="q9_c" class="option-label">٣٢</label>

                    <input type="radio" id="q9_d" name="q9" value="26">
                    <label for="q9_d" class="option-label">٢٦</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">10</span>
                <div class="question-text">ما ناتج ٩ × ٤؟</div>
                <div class="math-operation">9 × 4 = ?</div>
                <div class="options">
                    <input type="radio" id="q10_a" name="q10" value="32">
                    <label for="q10_a" class="option-label">٣٢</label>

                    <input type="radio" id="q10_b" name="q10" value="36">
                    <label for="q10_b" class="option-label">٣٦</label>

                    <input type="radio" id="q10_c" name="q10" value="40">
                    <label for="q10_c" class="option-label">٤٠</label>

                    <input type="radio" id="q10_d" name="q10" value="34">
                    <label for="q10_d" class="option-label">٣٤</label>
                </div>
            </div>

            <!-- حقائق الضرب للعدد 5 -->
            <div class="question">
                <span class="question-number">11</span>
                <div class="question-text">ما ناتج ٥ × ٨؟</div>
                <div class="math-operation">5 × 8 = ?</div>
                <div class="options">
                    <input type="radio" id="q11_a" name="q11" value="35">
                    <label for="q11_a" class="option-label">٣٥</label>

                    <input type="radio" id="q11_b" name="q11" value="40">
                    <label for="q11_b" class="option-label">٤٠</label>

                    <input type="radio" id="q11_c" name="q11" value="45">
                    <label for="q11_c" class="option-label">٤٥</label>

                    <input type="radio" id="q11_d" name="q11" value="50">
                    <label for="q11_d" class="option-label">٥٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">12</span>
                <div class="question-text">ما ناتج ٦ × ٥؟</div>
                <div class="math-operation">6 × 5 = ?</div>
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

            <!-- حقائق الضرب للعدد 10 -->
            <div class="question">
                <span class="question-number">13</span>
                <div class="question-text">ما ناتج ١٠ × ٧؟</div>
                <div class="math-operation">10 × 7 = ?</div>
                <div class="options">
                    <input type="radio" id="q13_a" name="q13" value="17">
                    <label for="q13_a" class="option-label">١٧</label>

                    <input type="radio" id="q13_b" name="q13" value="70">
                    <label for="q13_b" class="option-label">٧٠</label>

                    <input type="radio" id="q13_c" name="q13" value="77">
                    <label for="q13_c" class="option-label">٧٧</label>

                    <input type="radio" id="q13_d" name="q13" value="107">
                    <label for="q13_d" class="option-label">١٠٧</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">14</span>
                <div class="question-text">ما ناتج ٩ × ١٠؟</div>
                <div class="math-operation">9 × 10 = ?</div>
                <div class="options">
                    <input type="radio" id="q14_a" name="q14" value="19">
                    <label for="q14_a" class="option-label">١٩</label>

                    <input type="radio" id="q14_b" name="q14" value="90">
                    <label for="q14_b" class="option-label">٩٠</label>

                    <input type="radio" id="q14_c" name="q14" value="99">
                    <label for="q14_c" class="option-label">٩٩</label>

                    <input type="radio" id="q14_d" name="q14" value="109">
                    <label for="q14_d" class="option-label">١٠٩</label>
                </div>
            </div>

            <!-- أسئلة شاملة -->
            <div class="question">
                <span class="question-number">15</span>
                <div class="question-text">إذا كان هناك ٨ صناديق، في كل صندوق ٥ أقلام. فكم قلمًا إجمالاً؟</div>
                <div class="math-operation">? = ٨ × ٥</div>
                <div class="options">
                    <input type="radio" id="q15_a" name="q15" value="35">
                    <label for="q15_a" class="option-label">٣٥</label>

                    <input type="radio" id="q15_b" name="q15" value="40">
                    <label for="q15_b" class="option-label">٤٠</label>

                    <input type="radio" id="q15_c" name="q15" value="45">
                    <label for="q15_c" class="option-label">٤٥</label>

                    <input type="radio" id="q15_d" name="q15" value="50">
                    <label for="q15_d" class="option-label">٥٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">16</span>
                <div class="question-text">ما العبارة التي تمثل ٦ مجموعات من ٤؟</div>
                <div class="options">
                    <input type="radio" id="q16_a" name="q16" value="6+4">
                    <label for="q16_a" class="option-label">٦ + ٤</label>

                    <input type="radio" id="q16_b" name="q16" value="6x4">
                    <label for="q16_b" class="option-label">٦ × ٤</label>

                    <input type="radio" id="q16_c" name="q16" value="4x6">
                    <label for="q16_c" class="option-label">٤ × ٦</label>

                    <input type="radio" id="q16_d" name="q16" value="6-4">
                    <label for="q16_d" class="option-label">٦ - ٤</label>
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
            q1: "20,25",    // العد القفزي بالخمسات
            q2: "15",       // العد القفزي بالثلاثات
            q3: "12",       // 4 مجموعات × 3 تفاحات
            q4: "4x5",      // 5 + 5 + 5 + 5 = 4 × 5
            q5: "14",       // 2 × 7
            q6: "16",       // 8 × 2
            q7: "18",       // 3 × 6
            q8: "12",       // 4 × 3
            q9: "28",       // 4 × 7
            q10: "36",      // 9 × 4
            q11: "40",      // 5 × 8
            q12: "30",      // 6 × 5
            q13: "70",      // 10 × 7
            q14: "90",      // 9 × 10
            q15: "40",      // 8 × 5
            q16: "6x4"      // 6 مجموعات من 4
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
