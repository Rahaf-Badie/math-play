<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الأعداد من 1 إلى 9</title>
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
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الأعداد من 1 إلى 9 🧮</h1>
            <p>اختبر مهاراتك في درس الأعداد من 1 إلى 9</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- مقارنة الأعداد -->
            <div class="question">
                <span class="question-number">1</span>
                <div class="question-text">أي من الأعداد التالية أكبر من ٥؟</div>
                <div class="options">
                    <input type="radio" id="q1_a" name="q1" value="3">
                    <label for="q1_a" class="option-label">٣</label>

                    <input type="radio" id="q1_b" name="q1" value="4">
                    <label for="q1_b" class="option-label">٤</label>

                    <input type="radio" id="q1_c" name="q1" value="7">
                    <label for="q1_c" class="option-label">٧</label>

                    <input type="radio" id="q1_d" name="q1" value="2">
                    <label for="q1_d" class="option-label">٢</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">2</span>
                <div class="question-text">أي من الأعداد التالية أصغر من ٤؟</div>
                <div class="options">
                    <input type="radio" id="q2_a" name="q2" value="5">
                    <label for="q2_a" class="option-label">٥</label>

                    <input type="radio" id="q2_b" name="q2" value="6">
                    <label for="q2_b" class="option-label">٦</label>

                    <input type="radio" id="q2_c" name="q2" value="3">
                    <label for="q2_c" class="option-label">٣</label>

                    <input type="radio" id="q2_d" name="q2" value="7">
                    <label for="q2_d" class="option-label">٧</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">3</span>
                <div class="question-text">ما العدد الذي يساوي ٦؟</div>
                <div class="options">
                    <input type="radio" id="q3_a" name="q3" value="5">
                    <label for="q3_a" class="option-label">٥</label>

                    <input type="radio" id="q3_b" name="q3" value="6">
                    <label for="q3_b" class="option-label">٦</label>

                    <input type="radio" id="q3_c" name="q3" value="7">
                    <label for="q3_c" class="option-label">٧</label>

                    <input type="radio" id="q3_d" name="q3" value="8">
                    <label for="q3_d" class="option-label">٨</label>
                </div>
            </div>

            <!-- الترتيب التصاعدي والتنازلي -->
            <div class="question">
                <span class="question-number">4</span>
                <div class="question-text">ما الترتيب التصاعدي الصحيح للأعداد: ٣، ١، ٧؟</div>
                <div class="options">
                    <input type="radio" id="q4_a" name="q4" value="7,3,1">
                    <label for="q4_a" class="option-label">٧، ٣، ١</label>

                    <input type="radio" id="q4_b" name="q4" value="1,3,7">
                    <label for="q4_b" class="option-label">١، ٣، ٧</label>

                    <input type="radio" id="q4_c" name="q4" value="3,1,7">
                    <label for="q4_c" class="option-label">٣، ١، ٧</label>

                    <input type="radio" id="q4_d" name="q4" value="7,1,3">
                    <label for="q4_d" class="option-label">٧، ١، ٣</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">5</span>
                <div class="question-text">ما الترتيب التنازلي الصحيح للأعداد: ٢، ٨، ٥؟</div>
                <div class="options">
                    <input type="radio" id="q5_a" name="q5" value="2,5,8">
                    <label for="q5_a" class="option-label">٢، ٥، ٨</label>

                    <input type="radio" id="q5_b" name="q5" value="8,5,2">
                    <label for="q5_b" class="option-label">٨، ٥، ٢</label>

                    <input type="radio" id="q5_c" name="q5" value="5,8,2">
                    <label for="q5_c" class="option-label">٥، ٨، ٢</label>

                    <input type="radio" id="q5_d" name="q5" value="8,2,5">
                    <label for="q5_d" class="option-label">٨، ٢، ٥</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">6</span>
                <div class="question-text">رتب الأعداد التالية تصاعدياً: ٩، ٤، ٦</div>
                <div class="options">
                    <input type="radio" id="q6_a" name="q6" value="4,6,9">
                    <label for="q6_a" class="option-label">٤، ٦، ٩</label>

                    <input type="radio" id="q6_b" name="q6" value="9,6,4">
                    <label for="q6_b" class="option-label">٩، ٦، ٤</label>

                    <input type="radio" id="q6_c" name="q6" value="6,4,9">
                    <label for="q6_c" class="option-label">٦، ٤، ٩</label>

                    <input type="radio" id="q6_d" name="q6" value="4,9,6">
                    <label for="q6_d" class="option-label">٤، ٩، ٦</label>
                </div>
            </div>

            <!-- العدد السابق والتالي -->
            <div class="question">
                <span class="question-number">7</span>
                <div class="question-text">ما العدد التالي للعدد ٤؟</div>
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
                <div class="question-text">ما العدد السابق للعدد ٨؟</div>
                <div class="options">
                    <input type="radio" id="q8_a" name="q8" value="7">
                    <label for="q8_a" class="option-label">٧</label>

                    <input type="radio" id="q8_b" name="q8" value="8">
                    <label for="q8_b" class="option-label">٨</label>

                    <input type="radio" id="q8_c" name="q8" value="9">
                    <label for="q8_c" class="option-label">٩</label>

                    <input type="radio" id="q8_d" name="q8" value="6">
                    <label for="q8_d" class="option-label">٦</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">9</span>
                <div class="question-text">ما العدد الذي يقع بين ٥ و ٧؟</div>
                <div class="options">
                    <input type="radio" id="q9_a" name="q9" value="4">
                    <label for="q9_a" class="option-label">٤</label>

                    <input type="radio" id="q9_b" name="q9" value="5">
                    <label for="q9_b" class="option-label">٥</label>

                    <input type="radio" id="q9_c" name="q9" value="6">
                    <label for="q9_c" class="option-label">٦</label>

                    <input type="radio" id="q9_d" name="q9" value="7">
                    <label for="q9_d" class="option-label">٧</label>
                </div>
            </div>

            <!-- العدد الترتيبي -->
            <div class="question">
                <span class="question-number">10</span>
                <div class="question-text">ما العدد الترتيبي الذي يشير إلى المركز الثالث؟</div>
                <div class="options">
                    <input type="radio" id="q10_a" name="q10" value="1st">
                    <label for="q10_a" class="option-label">الأول</label>

                    <input type="radio" id="q10_b" name="q10" value="2nd">
                    <label for="q10_b" class="option-label">الثاني</label>

                    <input type="radio" id="q10_c" name="q10" value="3rd">
                    <label for="q10_c" class="option-label">الثالث</label>

                    <input type="radio" id="q10_d" name="q10" value="4th">
                    <label for="q10_d" class="option-label">الرابع</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">11</span>
                <div class="question-text">في سباق، إذا كان أحمد في المركز الثاني وسعيد في المركز الرابع، فكم متسابق بينهما؟</div>
                <div class="options">
                    <input type="radio" id="q11_a" name="q11" value="0">
                    <label for="q11_a" class="option-label">٠</label>

                    <input type="radio" id="q11_b" name="q11" value="1">
                    <label for="q11_b" class="option-label">١</label>

                    <input type="radio" id="q11_c" name="q11" value="2">
                    <label for="q11_c" class="option-label">٢</label>

                    <input type="radio" id="q11_d" name="q11" value="3">
                    <label for="q11_d" class="option-label">٣</label>
                </div>
            </div>

            <div class="question">
                <span class="question-number">12</span>
                <div class="question-text">ما العدد الترتيبي الذي يأتي بعد الخامس؟</div>
                <div class="options">
                    <input type="radio" id="q12_a" name="q12" value="4th">
                    <label for="q12_a" class="option-label">الرابع</label>

                    <input type="radio" id="q12_b" name="q12" value="5th">
                    <label for="q12_b" class="option-label">الخامس</label>

                    <input type="radio" id="q12_c" name="q12" value="6th">
                    <label for="q12_c" class="option-label">السادس</label>

                    <input type="radio" id="q12_d" name="q12" value="7th">
                    <label for="q12_d" class="option-label">السابع</label>
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
            q1: "7",        // أكبر من ٥
            q2: "3",        // أصغر من ٤
            q3: "6",        // يساوي ٦
            q4: "1,3,7",    // ترتيب تصاعدي
            q5: "8,5,2",    // ترتيب تنازلي
            q6: "4,6,9",    // ترتيب تصاعدي
            q7: "5",        // التالي للعدد ٤
            q8: "7",        // السابق للعدد ٨
            q9: "6",        // بين ٥ و ٧
            q10: "3rd",     // المركز الثالث
            q11: "1",       // متسابق بين الثاني والرابع
            q12: "6th"      // بعد الخامس
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
