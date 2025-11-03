<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار العلاقة بين الجمع والطرح</title>
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

        .relationship-box {
            background: #e8f4fd;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار العلاقة بين الجمع والطرح 🧮</h1>
            <p>اختبر فهمك للعلاقة العكسية بين عمليتي الجمع والطرح ضمن العدد 9</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- العلاقة الأساسية بين الجمع والطرح -->
            <div class="question">
                <span class="question-number">1</span>
                <div class="question-text">إذا كان: ٥ + ٣ = ٨، فما ناتج: ٨ - ٣؟</div>
                <div class="math-operation">5 + 3 = 8 → 8 - 3 = ?</div>
                <div class="options">
                    <input type="radio" id="q1_a" name="q1" value="5">
                    <label for="q1_a" class="option-label">٥</label>

                    <input type="radio" id="q1_b" name="q1" value="3">
                    <label for="q1_b" class="option-label">٣</label>

                    <input type="radio" id="q1_c" name="q1" value="8">
                    <label for="q1_c" class="option-label">٨</label>

                    <input type="radio" id="q1_d" name="q1" value="2">
                    <label for="q1_d" class="option-label">٢</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">2</span>
                <div class="question-text">إذا كان: ٧ - ٢ = ٥، فما ناتج: ٥ + ٢؟</div>
                <div class="math-operation">7 - 2 = 5 → 5 + 2 = ?</div>
                <div class="options">
                    <input type="radio" id="q2_a" name="q2" value="5">
                    <label for="q2_a" class="option-label">٥</label>

                    <input type="radio" id="q2_b" name="q2" value="2">
                    <label for="q2_b" class="option-label">٢</label>

                    <input type="radio" id="q2_c" name="q2" value="7">
                    <label for="q2_c" class="option-label">٧</label>

                    <input type="radio" id="q2_d" name="q2" value="9">
                    <label for="q2_d" class="option-label">٩</label>
                </div>
            </div>

            <!-- إيجاد العدد الناقص -->
            <div class="question">
                <span class="question-number">3</span>
                <div class="question-text">ما العدد الناقص في: ٦ + ? = ٩</div>
                <div class="math-operation">6 + ? = 9</div>
                <div class="options">
                    <input type="radio" id="q3_a" name="q3" value="2">
                    <label for="q3_a" class="option-label">٢</label>

                    <input type="radio" id="q3_b" name="q3" value="3">
                    <label for="q3_b" class="option-label">٣</label>

                    <input type="radio" id="q3_c" name="q3" value="4">
                    <label for="q3_c" class="option-label">٤</label>

                    <input type="radio" id="q3_d" name="q3" value="5">
                    <label for="q3_d" class="option-label">٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">4</span>
                <div class="question-text">ما العدد الناقص في: ? - ٤ = ٣</div>
                <div class="math-operation">? - 4 = 3</div>
                <div class="options">
                    <input type="radio" id="q4_a" name="q4" value="6">
                    <label for="q4_a" class="option-label">٦</label>

                    <input type="radio" id="q4_b" name="q4" value="7">
                    <label for="q4_b" class="option-label">٧</label>

                    <input type="radio" id="q4_c" name="q4" value="8">
                    <label for="q4_c" class="option-label">٨</label>

                    <input type="radio" id="q4_d" name="q4" value="9">
                    <label for="q4_d" class="option-label">٩</label>
                </div>
            </div>

            <!-- عائلة الأعداد -->
            <div class="question">
                <span class="question-number">5</span>
                <div class="question-text">ما العددان اللذان ينتميان إلى عائلة العدد ٩ مع العدد ٤؟</div>
                <div class="relationship-box">عائلة العدد ٩: ٤ + ? = ٩ و ٩ - ? = ٤</div>
                <div class="options">
                    <input type="radio" id="q5_a" name="q5" value="3,6">
                    <label for="q5_a" class="option-label">٣ و ٦</label>

                    <input type="radio" id="q5_b" name="q5" value="4,5">
                    <label for="q5_b" class="option-label">٤ و ٥</label>

                    <input type="radio" id="q5_c" name="q5" value="2,7">
                    <label for="q5_c" class="option-label">٢ و ٧</label>

                    <input type="radio" id="q5_d" name="q5" value="5,5">
                    <label for="q5_d" class="option-label">٥ و ٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">6</span>
                <div class="question-text">ما العددان المكملان للعدد ٨ في الجمع والطرح؟</div>
                <div class="relationship-box">٨ = ? + ? و ? - ? = ?</div>
                <div class="options">
                    <input type="radio" id="q6_a" name="q6" value="3,5">
                    <label for="q6_a" class="option-label">٣ و ٥</label>

                    <input type="radio" id="q6_b" name="q6" value="4,4">
                    <label for="q6_b" class="option-label">٤ و ٤</label>

                    <input type="radio" id="q6_c" name="q6" value="2,6">
                    <label for="q6_c" class="option-label">٢ و ٦</label>

                    <input type="radio" id="q6_d" name="q6" value="1,7">
                    <label for="q6_d" class="option-label">١ و ٧</label>
                </div>
            </div>

            <!-- مسائل كلامية -->
            <div class="question">
                <span class="question-number">7</span>
                <div class="question-text">عند أحمد ٧ تفاحات، أعطى أخيه بعضها فبقي عنده ٣ تفاحات. كم تفاحة أعطى أخيه؟</div>
                <div class="math-operation">٧ - ? = ٣</div>
                <div class="options">
                    <input type="radio" id="q7_a" name="q7" value="3">
                    <label for="q7_a" class="option-label">٣</label>

                    <input type="radio" id="q7_b" name="q7" value="4">
                    <label for="q7_b" class="option-label">٤</label>

                    <input type="radio" id="q7_c" name="q7" value="5">
                    <label for="q7_c" class="option-label">٥</label>

                    <input type="radio" id="q7_d" name="q7" value="6">
                    <label for="q7_d" class="option-label">٦</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">8</span>
                <div class="question-text">لدى سارة ٤ أقلام، اشترت بعض الأقلام فأصبح لديها ٩ أقلام. كم قلماً اشترت؟</div>
                <div class="math-operation">٤ + ? = ٩</div>
                <div class="options">
                    <input type="radio" id="q8_a" name="q8" value="4">
                    <label for="q8_a" class="option-label">٤</label>

                    <input type="radio" id="q8_b" name="q8" value="5">
                    <label for="q8_b" class="option-label">٥</label>

                    <input type="radio" id="q8_c" name="q8" value="6">
                    <label for="q8_c" class="option-label">٦</label>

                    <input type="radio" id="q8_d" name="q8" value="7">
                    <label for="q8_d" class="option-label">٧</label>
                </div>
            </div>

            <!-- علاقات متعددة -->
            <div class="question">
                <span class="question-number">9</span>
                <div class="question-text">إذا كان: ٢ + ٧ = ٩ و ٩ - ٧ = ٢، فما ناتج: ٩ - ٢؟</div>
                <div class="math-operation">2 + 7 = 9 → 9 - 2 = ?</div>
                <div class="options">
                    <input type="radio" id="q9_a" name="q9" value="2">
                    <label for="q9_a" class="option-label">٢</label>

                    <input type="radio" id="q9_b" name="q9" value="7">
                    <label for="q9_b" class="option-label">٧</label>

                    <input type="radio" id="q9_c" name="q9" value="9">
                    <label for="q9_c" class="option-label">٩</label>

                    <input type="radio" id="q9_d" name="q9" value="5">
                    <label for="q9_d" class="option-label">٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">10</span>
                <div class="question-text">ما مجموعة العمليات الصحيحة التي توضح العلاقة بين ٦، ٣، ٩؟</div>
                <div class="relationship-box">اختر المجموعة الصحيحة</div>
                <div class="options">
                    <input type="radio" id="q10_a" name="q10" value="6+3=9,9-6=3">
                    <label for="q10_a" class="option-label">٦+٣=٩، ٩-٦=٣</label>

                    <input type="radio" id="q10_b" name="q10" value="6+2=8,8-6=2">
                    <label for="q10_b" class="option-label">٦+٢=٨، ٨-٦=٢</label>

                    <input type="radio" id="q10_c" name="q10" value="3+3=6,6-3=3">
                    <label for="q10_c" class="option-label">٣+٣=٦، ٦-٣=٣</label>

                    <input type="radio" id="q10_d" name="q10" value="9+3=12,12-9=3">
                    <label for="q10_d" class="option-label">٩+٣=١٢، ١٢-٩=٣</label>
                </div>
            </div>

            <!-- تحقق من الفهم -->
            <div class="question">
                <span class="question-number">11</span>
                <div class="question-text">إذا علمت أن ٤ + ٥ = ٩، فكيف يمكنك إيجاد ناتج ٩ - ٤ دون حساب؟</div>
                <div class="options">
                    <input type="radio" id="q11_a" name="q11" value="look_at_addition">
                    <label for="q11_a" class="option-label">بالنظر إلى عملية الجمع ٤+٥=٩</label>

                    <input type="radio" id="q11_b" name="q11" value="count_backwards">
                    <label for="q11_b" class="option-label">بالعد التنازلي من ٩</label>

                    <input type="radio" id="q11_c" name="q11" value="use_fingers">
                    <label for="q11_c" class="option-label">باستخدام الأصابع</label>

                    <input type="radio" id="q11_d" name="q11" value="guess">
                    <label for="q11_d" class="option-label">بالتخمين</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">12</span>
                <div class="question-text">ما العبارة الصحيحة التي توضح العلاقة بين الجمع والطرح؟</div>
                <div class="options">
                    <input type="radio" id="q12_a" name="q12" value="inverse_operations">
                    <label for="q12_a" class="option-label">الطرح هو العملية العكسية للجمع</label>

                    <input type="radio" id="q12_b" name="q12" value="same_operation">
                    <label for="q12_b" class="option-label">الجمع والطرح عمليتان متشابهتان</label>

                    <input type="radio" id="q12_c" name="q12" value="no_relation">
                    <label for="q12_c" class="option-label">لا توجد علاقة بين الجمع والطرح</label>

                    <input type="radio" id="q12_d" name="q12" value="opposite_operations">
                    <label for="q12_d" class="option-label">الجمع والطرح عمليتان متعاكستان</label>
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
            q1: "5",        // 8 - 3 = 5
            q2: "7",        // 5 + 2 = 7
            q3: "3",        // 6 + 3 = 9
            q4: "7",        // 7 - 4 = 3
            q5: "4,5",      // 4 + 5 = 9, 9 - 5 = 4
            q6: "4,4",      // 4 + 4 = 8, 8 - 4 = 4
            q7: "4",        // 7 - 4 = 3
            q8: "5",        // 4 + 5 = 9
            q9: "7",        // 9 - 2 = 7
            q10: "6+3=9,9-6=3", // العلاقة الصحيحة
            q11: "look_at_addition", // استخدام العلاقة العكسية
            q12: "inverse_operations" // العلاقة العكسية
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
