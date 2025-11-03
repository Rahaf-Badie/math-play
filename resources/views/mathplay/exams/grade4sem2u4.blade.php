<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الإحصاء - الفرصة والتجربة العشوائية</title>
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
            font-family: 'Cairo', sans-serif;
            font-size: 1.5rem;
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

        .topic-section {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            border-right: 4px solid #3498db;
        }

        .topic-title {
            color: #2c3e50;
            font-size: 1.3rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .probability-visual {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            text-align: center;
        }

        .dice {
            display: inline-block;
            width: 60px;
            height: 60px;
            background: white;
            border: 2px solid #667eea;
            border-radius: 10px;
            margin: 0 10px;
            position: relative;
            font-weight: bold;
            line-height: 60px;
            font-size: 1.2rem;
        }

        .coin {
            display: inline-block;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            border: 3px solid #b8860b;
            margin: 0 15px;
            position: relative;
            font-weight: bold;
            line-height: 80px;
            font-size: 1.1rem;
        }

        .spinner {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: conic-gradient(
                #ff6b6b 0% 25%,
                #4ecdc4 25% 50%,
                #45b7d1 50% 75%,
                #96ceb4 75% 100%
            );
            margin: 15px auto;
            border: 3px solid #2c3e50;
            position: relative;
        }

        .spinner-label {
            position: absolute;
            font-size: 0.9rem;
            font-weight: bold;
            color: white;
        }

        .bag-items {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
            flex-wrap: wrap;
        }

        .item {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .red { background: #e74c3c; }
        .blue { background: #3498db; }
        .green { background: #2ecc71; }
        .yellow { background: #f1c40f; }
        .purple { background: #9b59b6; }

        .probability-scale {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .scale-point {
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
        }

        .hint {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 8px 12px;
            margin: 10px 0;
            font-size: 0.9rem;
            color: #856404;
        }

        .probability-value {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الإحصاء - الفرصة والتجربة العشوائية 🎲</h1>
            <p>اختبر مهاراتك في مفهوم الفرصة والتجارب العشوائية</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم التجربة العشوائية -->
            <div class="topic-section">
                <div class="topic-title">التجربة العشوائية</div>

                <!-- سؤال 1: تعريف التجربة العشوائية -->
                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما هي التجربة العشوائية؟</div>
                    <div class="probability-visual">
                        <div class="dice">🎲</div>
                        <div class="coin">🪙</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="random">
                        <label for="q1_a" class="option-label">تجربة لا يمكن التنبؤ بنتيجتها بدقة قبل إجرائها</label>

                        <input type="radio" id="q1_b" name="q1" value="deterministic">
                        <label for="q1_b" class="option-label">تجربة يمكن معرفة نتيجتها مسبقاً</label>

                        <input type="radio" id="q1_c" name="q1" value="scientific">
                        <label for="q1_c" class="option-label">تجربة علمية في المختبر</label>

                        <input type="radio" id="q1_d" name="q1" value="mathematical">
                        <label for="q1_d" class="option-label">تجربة رياضية بحتة</label>
                    </div>
                </div>

                <!-- سؤال 2: أمثلة على التجارب العشوائية -->
                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">أي من التالي يعد تجربة عشوائية؟</div>
                    <div class="probability-visual">
                        <div style="display: flex; justify-content: center; gap: 20px; margin: 15px 0;">
                            <div style="text-align: center;">
                                <div style="font-size: 2rem;">🎯</div>
                                <div>رمي السهم</div>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 2rem;">🌅</div>
                                <div>شروق الشمس</div>
                            </div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="sunrise">
                        <label for="q2_a" class="option-label">شروق الشمس غداً</label>

                        <input type="radio" id="q2_b" name="q2" value="dart">
                        <label for="q2_b" class="option-label">رمي سهم على لوحة الهدف</label>

                        <input type="radio" id="q2_c" name="q2" value="gravity">
                        <label for="q2_c" class="option-label">سقوط الجسم نحو الأرض</label>

                        <input type="radio" id="q2_d" name="q2" value="water_boil">
                        <label for="q2_d" class="option-label">غليان الماء عند 100°م</label>
                    </div>
                </div>

                <!-- سؤال 3: فضاء العينة -->
                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">ما هو فضاء العينة لرمي حجر النرد؟</div>
                    <div class="probability-visual">
                        <div style="display: flex; justify-content: center; gap: 10px; margin: 15px 0;">
                            <div class="dice">1</div>
                            <div class="dice">2</div>
                            <div class="dice">3</div>
                            <div class="dice">4</div>
                            <div class="dice">5</div>
                            <div class="dice">6</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="1to3">
                        <label for="q3_a" class="option-label">{1, 2, 3}</label>

                        <input type="radio" id="q3_b" name="q3" value="1to6">
                        <label for="q3_b" class="option-label">{1, 2, 3, 4, 5, 6}</label>

                        <input type="radio" id="q3_c" name="q3" value="even">
                        <label for="q3_c" class="option-label">{2, 4, 6}</label>

                        <input type="radio" id="q3_d" name="q3" value="odd">
                        <label for="q3_d" class="option-label">{1, 3, 5}</label>
                    </div>
                </div>
            </div>

            <!-- قسم مفهوم الفرصة -->
            <div class="topic-section">
                <div class="topic-title">مفهوم الفرصة</div>

                <!-- سؤال 4: تعريف الفرصة -->
                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">ما معنى أن حدثاً ما له فرصة كبيرة للحدوث؟</div>
                    <div class="probability-scale">
                        <div class="scale-point">مستحيل</div>
                        <div class="scale-point">قليل</div>
                        <div class="scale-point">متساوي</div>
                        <div class="scale-point">كبير</div>
                        <div class="scale-point">مؤكد</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="high_prob">
                        <label for="q4_a" class="option-label">احتمال حدوثه مرتفع</label>

                        <input type="radio" id="q4_b" name="q4" value="low_prob">
                        <label for="q4_b" class="option-label">احتمال حدوثه منخفض</label>

                        <input type="radio" id="q4_c" name="q4" value="impossible">
                        <label for="q4_c" class="option-label">لا يمكن أن يحدث</label>

                        <input type="radio" id="q4_d" name="q4" value="certain">
                        <label for="q4_d" class="option-label">سيحدث بالتأكيد</label>
                    </div>
                </div>

                <!-- سؤال 5: مقارنة الفرص -->
                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">أي حدث له فرصة أكبر للحدوث عند رمي حجر النرد؟</div>
                    <div class="probability-visual">
                        <div class="dice">?</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="even">
                        <label for="q5_a" class="option-label">ظهور عدد زوجي</label>

                        <input type="radio" id="q5_b" name="q5" value="six">
                        <label for="q5_b" class="option-label">ظهور العدد 6</label>

                        <input type="radio" id="q5_c" name="q5" value="seven">
                        <label for="q5_c" class="option-label">ظهور العدد 7</label>

                        <input type="radio" id="q5_d" name="q5" value="one">
                        <label for="q5_d" class="option-label">ظهور العدد 1</label>
                    </div>
                </div>

                <!-- سؤال 6: سحب الكرات -->
                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">في كيس يحتوي على 3 كرات حمراء وكرتين زرقاء، ما لون الكرة الأكثر فرصة في السحب؟</div>
                    <div class="probability-visual">
                        <div class="bag-items">
                            <div class="item red">🔴</div>
                            <div class="item red">🔴</div>
                            <div class="item red">🔴</div>
                            <div class="item blue">🔵</div>
                            <div class="item blue">🔵</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="red">
                        <label for="q6_a" class="option-label">أحمر</label>

                        <input type="radio" id="q6_b" name="q6" value="blue">
                        <label for="q6_b" class="option-label">أزرق</label>

                        <input type="radio" id="q6_c" name="q6" value="equal">
                        <label for="q6_c" class="option-label">متساوية</label>

                        <input type="radio" id="q6_d" name="q6" value="green">
                        <label for="q6_d" class="option-label">أخضر</label>
                    </div>
                </div>
            </div>

            <!-- قسم الحوادث والاحتمالات -->
            <div class="topic-section">
                <div class="topic-title">الحوادث والاحتمالات</div>

                <!-- سؤال 7: الحادث المستحيل -->
                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">أي من الحوادث التالية يعتبر مستحيلاً عند رمي حجر النرد؟</div>
                    <div class="probability-visual">
                        <div class="dice">🎲</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="less_than_7">
                        <label for="q7_a" class="option-label">ظهور عدد أقل من 7</label>

                        <input type="radio" id="q7_b" name="q7" value="greater_than_6">
                        <label for="q7_b" class="option-label">ظهور عدد أكبر من 6</label>

                        <input type="radio" id="q7_c" name="q7" value="even_number">
                        <label for="q7_c" class="option-label">ظهور عدد زوجي</label>

                        <input type="radio" id="q7_d" name="q7" value="odd_number">
                        <label for="q7_d" class="option-label">ظهور عدد فردي</label>
                    </div>
                </div>

                <!-- سؤال 8: الحادث المؤكد -->
                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">أي من الحوادث التالية يعتبر مؤكداً عند رمي قطعة نقود؟</div>
                    <div class="probability-visual">
                        <div class="coin">?</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="head_or_tail">
                        <label for="q8_a" class="option-label">ظهور صورة أو كتابة</label>

                        <input type="radio" id="q8_b" name="q8" value="head_only">
                        <label for="q8_b" class="option-label">ظهور صورة فقط</label>

                        <input type="radio" id="q8_c" name="q8" value="tail_only">
                        <label for="q8_c" class="option-label">ظهور كتابة فقط</label>

                        <input type="radio" id="q8_d" name="q8" value="number">
                        <label for="q8_d" class="option-label">ظهور عدد</label>
                    </div>
                </div>

                <!-- سؤال 9: حساب الاحتمال -->
                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">ما احتمال ظهور العدد 3 عند رمي حجر النرد؟</div>
                    <div class="probability-value">P(3) = ?</div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="1/2">
                        <label for="q9_a" class="option-label">١/٢</label>

                        <input type="radio" id="q9_b" name="q9" value="1/3">
                        <label for="q9_b" class="option-label">١/٣</label>

                        <input type="radio" id="q9_c" name="q9" value="1/6">
                        <label for="q9_c" class="option-label">١/٦</label>

                        <input type="radio" id="q9_d" name="q9" value="1/4">
                        <label for="q9_d" class="option-label">١/٤</label>
                    </div>
                </div>

                <!-- سؤال 10: الدوار -->
                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">في دولاب مقسم إلى 4 أقسام متساوية (أحمر، أزرق، أخضر، أصفر)، ما احتمال توقف المؤشر على اللون الأحمر؟</div>
                    <div class="probability-visual">
                        <div class="spinner">
                            <div class="spinner-label" style="top: 10px; left: 50%; transform: translateX(-50%);">أحمر</div>
                            <div class="spinner-label" style="top: 50%; right: 10px; transform: translateY(-50%);">أزرق</div>
                            <div class="spinner-label" style="bottom: 10px; left: 50%; transform: translateX(-50%);">أخضر</div>
                            <div class="spinner-label" style="top: 50%; left: 10px; transform: translateY(-50%);">أصفر</div>
                        </div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="1/2">
                        <label for="q10_a" class="option-label">١/٢</label>

                        <input type="radio" id="q10_b" name="q10" value="1/3">
                        <label for="q10_b" class="option-label">١/٣</label>

                        <input type="radio" id="q10_c" name="q10" value="1/4">
                        <label for="q10_c" class="option-label">١/٤</label>

                        <input type="radio" id="q10_d" name="q10" value="1/5">
                        <label for="q10_d" class="option-label">١/٥</label>
                    </div>
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
            q1: "random",
            q2: "dart",
            q3: "1to6",
            q4: "high_prob",
            q5: "even",
            q6: "red",
            q7: "greater_than_6",
            q8: "head_or_tail",
            q9: "1/6",
            q10: "1/4"
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
