<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الجمع والطرح ضمن 9999</title>
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

        .carry-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 0 5px;
            font-weight: bold;
        }

        .borrow-box {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 0 5px;
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
            <h1>اختبار الجمع والطرح ضمن 9999 🧮</h1>
            <p>اختبر مهاراتك في الجمع والطرح مع الحمل والاستلاف</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- جمع عددين ضمن 9999 دون الحمل -->
            <div class="question">
                <span class="question-number">1</span>
                <div class="question-text">ما ناتج جمع العددين التاليين دون حمل؟</div>
                <div class="vertical-operation">
                    <div>  ٢٣٤١</div>
                    <div>+ ١٣٥٦</div>
                    <div style="border-top: 2px solid #000; margin-top: 5px;">______</div>
                </div>
                <div class="options">
                    <input type="radio" id="q1_a" name="q1" value="3697">
                    <label for="q1_a" class="option-label">٣٦٩٧</label>

                    <input type="radio" id="q1_b" name="q1" value="3597">
                    <label for="q1_b" class="option-label">٣٥٩٧</label>

                    <input type="radio" id="q1_c" name="q1" value="3696">
                    <label for="q1_c" class="option-label">٣٦٩٦</label>

                    <input type="radio" id="q1_d" name="q1" value="3797">
                    <label for="q1_d" class="option-label">٣٧٩٧</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">2</span>
                <div class="question-text">ما ناتج جمع: ٣٢١٤ + ٢٥٤٣؟</div>
                <div class="math-operation">3214 + 2543 = ?</div>
                <div class="options">
                    <input type="radio" id="q2_a" name="q2" value="5757">
                    <label for="q2_a" class="option-label">٥٧٥٧</label>

                    <input type="radio" id="q2_b" name="q2" value="5657">
                    <label for="q2_b" class="option-label">٥٦٥٧</label>

                    <input type="radio" id="q2_c" name="q2" value="5756">
                    <label for="q2_c" class="option-label">٥٧٥٦</label>

                    <input type="radio" id="q2_d" name="q2" value="5857">
                    <label for="q2_d" class="option-label">٥٨٥٧</label>
                </div>
            </div>

            <!-- جمع عددين ضمن 9999 مع الحمل -->
            <div class="question">
                <span class="question-number">3</span>
                <div class="question-text">ما ناتج جمع العددين التاليين مع الحمل؟</div>
                <div class="vertical-operation">
                    <div>  ١٨٦٧</div>
                    <div>+ ٢٤٩٨</div>
                    <div style="border-top: 2px solid #000; margin-top: 5px;">______</div>
                </div>
                <div class="options">
                    <input type="radio" id="q3_a" name="q3" value="4365">
                    <label for="q3_a" class="option-label">٤٣٦٥</label>

                    <input type="radio" id="q3_b" name="q3" value="4265">
                    <label for="q3_b" class="option-label">٤٢٦٥</label>

                    <input type="radio" id="q3_c" name="q3" value="4366">
                    <label for="q3_c" class="option-label">٤٣٦٦</label>

                    <input type="radio" id="q3_d" name="q3" value="4465">
                    <label for="q3_d" class="option-label">٤٤٦٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">4</span>
                <div class="question-text">ما ناتج جمع: ٢٧٨٩ + ١٦٥٧؟</div>
                <div class="operation-box">هذه العملية تتطلب حمل في منزلة العشرات والمئات</div>
                <div class="options">
                    <input type="radio" id="q4_a" name="q4" value="4446">
                    <label for="q4_a" class="option-label">٤٤٤٦</label>

                    <input type="radio" id="q4_b" name="q4" value="4346">
                    <label for="q4_b" class="option-label">٤٣٤٦</label>

                    <input type="radio" id="q4_c" name="q4" value="4445">
                    <label for="q4_c" class="option-label">٤٤٤٥</label>

                    <input type="radio" id="q4_d" name="q4" value="4546">
                    <label for="q4_d" class="option-label">٤٥٤٦</label>
                </div>
            </div>

            <!-- طرح عددين ضمن 9999 دون استلاف -->
            <div class="question">
                <span class="question-number">5</span>
                <div class="question-text">ما ناتج طرح العددين التاليين دون استلاف؟</div>
                <div class="vertical-operation">
                    <div>  ٥٦٧٨</div>
                    <div>- ٢٣٤٥</div>
                    <div style="border-top: 2px solid #000; margin-top: 5px;">______</div>
                </div>
                <div class="options">
                    <input type="radio" id="q5_a" name="q5" value="3333">
                    <label for="q5_a" class="option-label">٣٣٣٣</label>

                    <input type="radio" id="q5_b" name="q5" value="3233">
                    <label for="q5_b" class="option-label">٣٢٣٣</label>

                    <input type="radio" id="q5_c" name="q5" value="3433">
                    <label for="q5_c" class="option-label">٣٤٣٣</label>

                    <input type="radio" id="q5_d" name="q5" value="3323">
                    <label for="q5_d" class="option-label">٣٣٢٣</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">6</span>
                <div class="question-text">ما ناتج طرح: ٨٩٧٦ - ٣٤٥٢؟</div>
                <div class="math-operation">8976 - 3452 = ?</div>
                <div class="options">
                    <input type="radio" id="q6_a" name="q6" value="5524">
                    <label for="q6_a" class="option-label">٥٥٢٤</label>

                    <input type="radio" id="q6_b" name="q6" value="5424">
                    <label for="q6_b" class="option-label">٥٤٢٤</label>

                    <input type="radio" id="q6_c" name="q6" value="5624">
                    <label for="q6_c" class="option-label">٥٦٢٤</label>

                    <input type="radio" id="q6_d" name="q6" value="5523">
                    <label for="q6_d" class="option-label">٥٥٢٣</label>
                </div>
            </div>

            <!-- طرح عددين ضمن 9999 مع الاستلاف -->
            <div class="question">
                <span class="question-number">7</span>
                <div class="question-text">ما ناتج طرح العددين التاليين مع الاستلاف؟</div>
                <div class="vertical-operation">
                    <div>  ٤٢٣١</div>
                    <div>- ١٨٥٦</div>
                    <div style="border-top: 2px solid #000; margin-top: 5px;">______</div>
                </div>
                <div class="options">
                    <input type="radio" id="q7_a" name="q7" value="2375">
                    <label for="q7_a" class="option-label">٢٣٧٥</label>

                    <input type="radio" id="q7_b" name="q7" value="2475">
                    <label for="q7_b" class="option-label">٢٤٧٥</label>

                    <input type="radio" id="q7_c" name="q7" value="2374">
                    <label for="q7_c" class="option-label">٢٣٧٤</label>

                    <input type="radio" id="q7_d" name="q7" value="2385">
                    <label for="q7_d" class="option-label">٢٣٨٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">8</span>
                <div class="question-text">ما ناتج طرح: ٦٠٠٠ - ٢٣٤٥؟</div>
                <div class="operation-box">هذه العملية تتطلب استلاف من منزلة الآلاف</div>
                <div class="options">
                    <input type="radio" id="q8_a" name="q8" value="3655">
                    <label for="q8_a" class="option-label">٣٦٥٥</label>

                    <input type="radio" id="q8_b" name="q8" value="3755">
                    <label for="q8_b" class="option-label">٣٧٥٥</label>

                    <input type="radio" id="q8_c" name="q8" value="3555">
                    <label for="q8_c" class="option-label">٣٥٥٥</label>

                    <input type="radio" id="q8_d" name="q8" value="3665">
                    <label for="q8_d" class="option-label">٣٦٦٥</label>
                </div>
            </div>

            <!-- مسائل كلامية -->
            <div class="question">
                <span class="question-number">9</span>
                <div class="question-text">في مكتبة، هناك ٣٤٥٦ كتاباً باللغة العربية و ٢٣٧٨ كتاباً باللغة الإنجليزية. كم عدد الكتب الإجمالي؟</div>
                <div class="math-operation">٣٤٥٦ + ٢٣٧٨ = ?</div>
                <div class="options">
                    <input type="radio" id="q9_a" name="q9" value="5834">
                    <label for="q9_a" class="option-label">٥٨٣٤</label>

                    <input type="radio" id="q9_b" name="q9" value="5734">
                    <label for="q9_b" class="option-label">٥٧٣٤</label>

                    <input type="radio" id="q9_c" name="q9" value="5833">
                    <label for="q9_c" class="option-label">٥٨٣٣</label>

                    <input type="radio" id="q9_d" name="q9" value="5934">
                    <label for="q9_d" class="option-label">٥٩٣٤</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">10</span>
                <div class="question-text">كان مع أحمد ٥٠٠٠ ريال، أنفق ١٨٩٥ ريالاً. كم بقي معه؟</div>
                <div class="math-operation">٥٠٠٠ - ١٨٩٥ = ?</div>
                <div class="options">
                    <input type="radio" id="q10_a" name="q10" value="3105">
                    <label for="q10_a" class="option-label">٣١٠٥</label>

                    <input type="radio" id="q10_b" name="q10" value="3205">
                    <label for="q10_b" class="option-label">٣٢٠٥</label>

                    <input type="radio" id="q10_c" name="q10" value="3115">
                    <label for="q10_c" class="option-label">٣١١٥</label>

                    <input type="radio" id="q10_d" name="q10" value="3005">
                    <label for="q10_d" class="option-label">٣٠٠٥</label>
                </div>
            </div>

            <!-- تمييز العمليات -->
            <div class="question">
                <span class="question-number">11</span>
                <div class="question-text">أي من العمليات التالية تتطلب حمل في منزلة المئات؟</div>
                <div class="options">
                    <input type="radio" id="q11_a" name="q11" value="1234+4321">
                    <label for="q11_a" class="option-label">١٢٣٤ + ٤٣٢١</label>

                    <input type="radio" id="q11_b" name="q11" value="2789+1657">
                    <label for="q11_b" class="option-label">٢٧٨٩ + ١٦٥٧</label>

                    <input type="radio" id="q11_c" name="q11" value="3210+1234">
                    <label for="q11_c" class="option-label">٣٢١٠ + ١٢٣٤</label>

                    <input type="radio" id="q11_d" name="q11" value="4000+2999">
                    <label for="q11_d" class="option-label">٤٠٠٠ + ٢٩٩٩</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">12</span>
                <div class="question-text">أي من العمليات التالية تتطلب استلاف من منزلة الآلاف؟</div>
                <div class="options">
                    <input type="radio" id="q12_a" name="q12" value="5000-1234">
                    <label for="q12_a" class="option-label">٥٠٠٠ - ١٢٣٤</label>

                    <input type="radio" id="q12_b" name="q12" value="6000-2345">
                    <label for="q12_b" class="option-label">٦٠٠٠ - ٢٣٤٥</label>

                    <input type="radio" id="q12_c" name="q12" value="4000-1895">
                    <label for="q12_c" class="option-label">٤٠٠٠ - ١٨٩٥</label>

                    <input type="radio" id="q12_d" name="q12" value="3000-1567">
                    <label for="q12_d" class="option-label">٣٠٠٠ - ١٥٦٧</label>
                </div>
            </div>

            <!-- عمليات مختلطة -->
            <div class="question">
                <span class="question-number">13</span>
                <div class="question-text">ما ناتج العملية: (٢٣٤٥ + ١٦٧٨) - ١٢٣٤؟</div>
                <div class="math-operation">(2345 + 1678) - 1234 = ?</div>
                <div class="options">
                    <input type="radio" id="q13_a" name="q13" value="2789">
                    <label for="q13_a" class="option-label">٢٧٨٩</label>

                    <input type="radio" id="q13_b" name="q13" value="2790">
                    <label for="q13_b" class="option-label">٢٧٩٠</label>

                    <input type="radio" id="q13_c" name="q13" value="2788">
                    <label for="q13_c" class="option-label">٢٧٨٨</label>

                    <input type="radio" id="q13_d" name="q13" value="2791">
                    <label for="q13_d" class="option-label">٢٧٩١</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">14</span>
                <div class="question-text">ما ناتج العملية: ٤٥٦٧ - (٢٣٤٥ + ١٢٣٤)؟</div>
                <div class="math-operation">4567 - (2345 + 1234) = ?</div>
                <div class="options">
                    <input type="radio" id="q14_a" name="q14" value="988">
                    <label for="q14_a" class="option-label">٩٨٨</label>

                    <input type="radio" id="q14_b" name="q14" value="998">
                    <label for="q14_b" class="option-label">٩٩٨</label>

                    <input type="radio" id="q14_c" name="q14" value="978">
                    <label for="q14_c" class="option-label">٩٧٨</label>

                    <input type="radio" id="q14_d" name="q14" value="1008">
                    <label for="q14_d" class="option-label">١٠٠٨</label>
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
            q1: "3697",     // 2341 + 1356
            q2: "5757",     // 3214 + 2543
            q3: "4365",     // 1867 + 2498
            q4: "4446",     // 2789 + 1657
            q5: "3333",     // 5678 - 2345
            q6: "5524",     // 8976 - 3452
            q7: "2375",     // 4231 - 1856
            q8: "3655",     // 6000 - 2345
            q9: "5834",     // 3456 + 2378
            q10: "3105",    // 5000 - 1895
            q11: "2789+1657", // تتطلب حمل في المئات
            q12: "6000-2345", // تتطلب استلاف من الآلاف
            q13: "2789",    // (2345 + 1678) - 1234
            q14: "988"      // 4567 - (2345 + 1234)
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
