<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الضرب والقسمة المتقدمة</title>
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

        .operation-box {
            background: #e8f4fd;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
        }

        .estimation-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
            color: #856404;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الضرب والقسمة المتقدمة 🧮</h1>
            <p>اختبر مهاراتك في الضرب والقسمة للأعداد الكبيرة والتقدير</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- ضرب عدد من منزلتين في عدد من منزلتين -->
            <div class="question">
                <span class="question-number">1</span>
                <div class="question-text">ما ناتج ضرب: ٣٤ × ٢٧؟</div>
                <div class="vertical-operation">
                    <div>  ٣٤</div>
                    <div>× ٢٧</div>
                    <div style="border-top: 2px solid #000; margin-top: 5px;">______</div>
                </div>
                <div class="options">
                    <input type="radio" id="q1_a" name="q1" value="918">
                    <label for="q1_a" class="option-label">٩١٨</label>

                    <input type="radio" id="q1_b" name="q1" value="908">
                    <label for="q1_b" class="option-label">٩٠٨</label>

                    <input type="radio" id="q1_c" name="q1" value="928">
                    <label for="q1_c" class="option-label">٩٢٨</label>

                    <input type="radio" id="q1_d" name="q1" value="898">
                    <label for="q1_d" class="option-label">٨٩٨</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">2</span>
                <div class="question-text">ما ناتج ضرب: ٥٦ × ٤٣؟</div>
                <div class="math-operation">56 × 43 = ?</div>
                <div class="options">
                    <input type="radio" id="q2_a" name="q2" value="2408">
                    <label for="q2_a" class="option-label">٢٤٠٨</label>

                    <input type="radio" id="q2_b" name="q2" value="2308">
                    <label for="q2_b" class="option-label">٢٣٠٨</label>

                    <input type="radio" id="q2_c" name="q2" value="2508">
                    <label for="q2_c" class="option-label">٢٥٠٨</label>

                    <input type="radio" id="q2_d" name="q2" value="2208">
                    <label for="q2_d" class="option-label">٢٢٠٨</label>
                </div>
            </div>

            <!-- ضرب عدد من منزلتين في عدد من 3 منازل -->
            <div class="question">
                <span class="question-number">3</span>
                <div class="question-text">ما ناتج ضرب: ٢٥ × ١٣٤؟</div>
                <div class="vertical-operation">
                    <div>  ٢٥</div>
                    <div>× ١٣٤</div>
                    <div style="border-top: 2px solid #000; margin-top: 5px;">______</div>
                </div>
                <div class="options">
                    <input type="radio" id="q3_a" name="q3" value="3350">
                    <label for="q3_a" class="option-label">٣٣٥٠</label>

                    <input type="radio" id="q3_b" name="q3" value="3250">
                    <label for="q3_b" class="option-label">٣٢٥٠</label>

                    <input type="radio" id="q3_c" name="q3" value="3450">
                    <label for="q3_c" class="option-label">٣٤٥٠</label>

                    <input type="radio" id="q3_d" name="q3" value="3550">
                    <label for="q3_d" class="option-label">٣٥٥٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">4</span>
                <div class="question-text">ما ناتج ضرب: ٧٨ × ٢٥٦؟</div>
                <div class="math-operation">78 × 256 = ?</div>
                <div class="options">
                    <input type="radio" id="q4_a" name="q4" value="19968">
                    <label for="q4_a" class="option-label">١٩٩٦٨</label>

                    <input type="radio" id="q4_b" name="q4" value="18968">
                    <label for="q4_b" class="option-label">١٨٩٦٨</label>

                    <input type="radio" id="q4_c" name="q4" value="20968">
                    <label for="q4_c" class="option-label">٢٠٩٦٨</label>

                    <input type="radio" id="q4_d" name="q4" value="17968">
                    <label for="q4_d" class="option-label">١٧٩٦٨</label>
                </div>
            </div>

            <!-- قسمة عدد من منزلتين على عدد من منزلتين -->
            <div class="question">
                <span class="question-number">5</span>
                <div class="question-text">ما ناتج قسمة: ٨٤ ÷ ١٢؟</div>
                <div class="vertical-operation">
                    <div style="border-bottom: 2px solid #000; padding-bottom: 5px;">١٢ ⟌ ٨٤</div>
                </div>
                <div class="options">
                    <input type="radio" id="q5_a" name="q5" value="7">
                    <label for="q5_a" class="option-label">٧</label>

                    <input type="radio" id="q5_b" name="q5" value="8">
                    <label for="q5_b" class="option-label">٨</label>

                    <input type="radio" id="q5_c" name="q5" value="6">
                    <label for="q5_c" class="option-label">٦</label>

                    <input type="radio" id="q5_d" name="q5" value="9">
                    <label for="q5_d" class="option-label">٩</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">6</span>
                <div class="question-text">ما ناتج قسمة: ٩٦ ÷ ١٦؟</div>
                <div class="math-operation">96 ÷ 16 = ?</div>
                <div class="options">
                    <input type="radio" id="q6_a" name="q6" value="6">
                    <label for="q6_a" class="option-label">٦</label>

                    <input type="radio" id="q6_b" name="q6" value="7">
                    <label for="q6_b" class="option-label">٧</label>

                    <input type="radio" id="q6_c" name="q6" value="5">
                    <label for="q6_c" class="option-label">٥</label>

                    <input type="radio" id="q6_d" name="q6" value="8">
                    <label for="q6_d" class="option-label">٨</label>
                </div>
            </div>

            <!-- قسمة عدد من 3 منازل على عدد من منزلتين -->
            <div class="question">
                <span class="question-number">7</span>
                <div class="question-text">ما ناتج قسمة: ٣٦٤ ÷ ١٤؟</div>
                <div class="vertical-operation">
                    <div style="border-bottom: 2px solid #000; padding-bottom: 5px;">١٤ ⟌ ٣٦٤</div>
                </div>
                <div class="options">
                    <input type="radio" id="q7_a" name="q7" value="26">
                    <label for="q7_a" class="option-label">٢٦</label>

                    <input type="radio" id="q7_b" name="q7" value="24">
                    <label for="q7_b" class="option-label">٢٤</label>

                    <input type="radio" id="q7_c" name="q7" value="28">
                    <label for="q7_c" class="option-label">٢٨</label>

                    <input type="radio" id="q7_d" name="q7" value="22">
                    <label for="q7_d" class="option-label">٢٢</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">8</span>
                <div class="question-text">ما ناتج قسمة: ٥٨٨ ÷ ٢١؟</div>
                <div class="math-operation">588 ÷ 21 = ?</div>
                <div class="options">
                    <input type="radio" id="q8_a" name="q8" value="28">
                    <label for="q8_a" class="option-label">٢٨</label>

                    <input type="radio" id="q8_b" name="q8" value="26">
                    <label for="q8_b" class="option-label">٢٦</label>

                    <input type="radio" id="q8_c" name="q8" value="24">
                    <label for="q8_c" class="option-label">٢٤</label>

                    <input type="radio" id="q8_d" name="q8" value="30">
                    <label for="q8_d" class="option-label">٣٠</label>
                </div>
            </div>

            <!-- تقدير ناتج الضرب -->
            <div class="question">
                <span class="question-number">9</span>
                <div class="question-text">ما التقدير المناسب لضرب: ٣٨ × ٤٣؟</div>
                <div class="estimation-box">التقدير: تقريب الأعداد لأقرب عشرة ثم الضرب</div>
                <div class="options">
                    <input type="radio" id="q9_a" name="q9" value="1200">
                    <label for="q9_a" class="option-label">٤٠ × ٤٠ = ١٦٠٠</label>

                    <input type="radio" id="q9_b" name="q9" value="1600">
                    <label for="q9_b" class="option-label">٤٠ × ٤٠ = ١٦٠٠</label>

                    <input type="radio" id="q9_c" name="q9" value="2000">
                    <label for="q9_c" class="option-label">٤٠ × ٥٠ = ٢٠٠٠</label>

                    <input type="radio" id="q9_d" name="q9" value="1800">
                    <label for="q9_d" class="option-label">٤٠ × ٤٥ = ١٨٠٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">10</span>
                <div class="question-text">ما التقدير المناسب لضرب: ٦٧ × ٥٢؟</div>
                <div class="math-operation">67 ≈ 70, 52 ≈ 50</div>
                <div class="options">
                    <input type="radio" id="q10_a" name="q10" value="3500">
                    <label for="q10_a" class="option-label">٧٠ × ٥٠ = ٣٥٠٠</label>

                    <input type="radio" id="q10_b" name="q10" value="3000">
                    <label for="q10_b" class="option-label">٦٠ × ٥٠ = ٣٠٠٠</label>

                    <input type="radio" id="q10_c" name="q10" value="4000">
                    <label for="q10_c" class="option-label">٧٠ × ٦٠ = ٤٢٠٠</label>

                    <input type="radio" id="q10_d" name="q10" value="4500">
                    <label for="q10_d" class="option-label">٧٠ × ٦٠ = ٤٢٠٠</label>
                </div>
            </div>

            <!-- تقدير ناتج القسمة -->
            <div class="question">
                <span class="question-number">11</span>
                <div class="question-text">ما التقدير المناسب لقسمة: ١٧٥ ÷ ٢٣؟</div>
                <div class="estimation-box">التقدير: تقريب الأعداد ثم القسمة</div>
                <div class="options">
                    <input type="radio" id="q11_a" name="q11" value="8">
                    <label for="q11_a" class="option-label">١٨٠ ÷ ٢٠ = ٩</label>

                    <input type="radio" id="q11_b" name="q11" value="9">
                    <label for="q11_b" class="option-label">١٨٠ ÷ ٢٠ = ٩</label>

                    <input type="radio" id="q11_c" name="q11" value="7">
                    <label for="q11_c" class="option-label">١٤٠ ÷ ٢٠ = ٧</label>

                    <input type="radio" id="q11_d" name="q11" value="10">
                    <label for="q11_d" class="option-label">٢٠٠ ÷ ٢٠ = ١٠</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">12</span>
                <div class="question-text">ما التقدير المناسب لقسمة: ٣٨٥ ÷ ٤٧؟</div>
                <div class="math-operation">385 ≈ 400, 47 ≈ 50</div>
                <div class="options">
                    <input type="radio" id="q12_a" name="q12" value="8">
                    <label for="q12_a" class="option-label">٤٠٠ ÷ ٥٠ = ٨</label>

                    <input type="radio" id="q12_b" name="q12" value="9">
                    <label for="q12_b" class="option-label">٤٥٠ ÷ ٥٠ = ٩</label>

                    <input type="radio" id="q12_c" name="q12" value="7">
                    <label for="q12_c" class="option-label">٣٥٠ ÷ ٥٠ = ٧</label>

                    <input type="radio" id="q12_d" name="q12" value="10">
                    <label for="q12_d" class="option-label">٥٠٠ ÷ ٥٠ = ١٠</label>
                </div>
            </div>

            <!-- مسائل كلامية -->
            <div class="question">
                <span class="question-number">13</span>
                <div class="question-text">إذا كان سعر الكتاب ٣٥ ريالاً، فكم تكلفة ٢٤ كتاباً؟</div>
                <div class="math-operation">35 × 24 = ?</div>
                <div class="options">
                    <input type="radio" id="q13_a" name="q13" value="840">
                    <label for="q13_a" class="option-label">٨٤٠ ريال</label>

                    <input type="radio" id="q13_b" name="q13" value="740">
                    <label for="q13_b" class="option-label">٧٤٠ ريال</label>

                    <input type="radio" id="q13_c" name="q13" value="940">
                    <label for="q13_c" class="option-label">٩٤٠ ريال</label>

                    <input type="radio" id="q13_d" name="q13" value="640">
                    <label for="q13_d" class="option-label">٦٤٠ ريال</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">14</span>
                <div class="question-text">إذا كان عدد الطلاب ٣٣٦ طالباً، وتم توزيعهم على ١٢ فريقاً بالتساوي، فكم طالباً في كل فريق؟</div>
                <div class="math-operation">336 ÷ 12 = ?</div>
                <div class="options">
                    <input type="radio" id="q14_a" name="q14" value="28">
                    <label for="q14_a" class="option-label">٢٨ طالب</label>

                    <input type="radio" id="q14_b" name="q14" value="26">
                    <label for="q14_b" class="option-label">٢٦ طالب</label>

                    <input type="radio" id="q14_c" name="q14" value="24">
                    <label for="q14_c" class="option-label">٢٤ طالب</label>

                    <input type="radio" id="q14_d" name="q14" value="30">
                    <label for="q14_d" class="option-label">٣٠ طالب</label>
                </div>
            </div>

            <!-- تمييز العمليات -->
            <div class="question">
                <span class="question-number">15</span>
                <div class="question-text">أي من العمليات التالية سينتج عنها أكبر عدد؟</div>
                <div class="options">
                    <input type="radio" id="q15_a" name="q15" value="45x32">
                    <label for="q15_a" class="option-label">٤٥ × ٣٢</label>

                    <input type="radio" id="q15_b" name="q15" value="38x41">
                    <label for="q15_b" class="option-label">٣٨ × ٤١</label>

                    <input type="radio" id="q15_c" name="q15" value="52x29">
                    <label for="q15_c" class="option-label">٥٢ × ٢٩</label>

                    <input type="radio" id="q15_d" name="q15" value="47x35">
                    <label for="q15_d" class="option-label">٤٧ × ٣٥</label>
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
            q1: "918",      // 34 × 27
            q2: "2408",     // 56 × 43
            q3: "3350",     // 25 × 134
            q4: "19968",    // 78 × 256
            q5: "7",        // 84 ÷ 12
            q6: "6",        // 96 ÷ 16
            q7: "26",       // 364 ÷ 14
            q8: "28",       // 588 ÷ 21
            q9: "1600",     // 40 × 40 = 1600
            q10: "3500",    // 70 × 50 = 3500
            q11: "9",       // 180 ÷ 20 = 9
            q12: "8",       // 400 ÷ 50 = 8
            q13: "840",     // 35 × 24 = 840
            q14: "28",      // 336 ÷ 12 = 28
            q15: "47x35"    // 47 × 35 = 1645 (أكبر نتيجة)
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
