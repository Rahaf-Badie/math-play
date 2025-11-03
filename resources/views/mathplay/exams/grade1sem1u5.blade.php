<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الأعداد من 1 إلى 20</title>
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

        .number-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: #667eea;
            color: white;
            border-radius: 50%;
            margin: 0 5px;
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

        .number-image {
            width: 80px;
            height: 80px;
            margin: 10px auto;
            display: block;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الأعداد من 1 إلى 20 🧮</h1>
            <p>اختبر مهاراتك في دروس الأعداد المختلفة</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم مكونات العدد 10 -->
            <div class="topic-section">
                <div class="topic-title">مكونات العدد 10</div>

                <!-- سؤال 1: مكونات العدد 10 -->
                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما العدد الناقص في مكونات العدد 10؟</div>
                    <div class="math-operation">٧ + ؟ = ١٠</div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="3">
                        <label for="q1_a" class="option-label">٣</label>

                        <input type="radio" id="q1_b" name="q1" value="4">
                        <label for="q1_b" class="option-label">٤</label>

                        <input type="radio" id="q1_c" name="q1" value="2">
                        <label for="q1_c" class="option-label">٢</label>

                        <input type="radio" id="q1_d" name="q1" value="5">
                        <label for="q1_d" class="option-label">٥</label>
                    </div>
                </div>

                <!-- سؤال 2: مكونات العدد 10 -->
                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">ما العدد الناقص في مكونات العدد 10؟</div>
                    <div class="math-operation">؟ + ٤ = ١٠</div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="5">
                        <label for="q2_a" class="option-label">٥</label>

                        <input type="radio" id="q2_b" name="q2" value="6">
                        <label for="q2_b" class="option-label">٦</label>

                        <input type="radio" id="q2_c" name="q2" value="7">
                        <label for="q2_c" class="option-label">٧</label>

                        <input type="radio" id="q2_d" name="q2" value="8">
                        <label for="q2_d" class="option-label">٨</label>
                    </div>
                </div>

                <!-- سؤال 3: مكونات العدد 10 -->
                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">أي من هذه الأعداد لا يمثل مكونًا للعدد 10؟</div>
                    <div class="math-operation">؟ + ؟ = ١٠</div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="5,5">
                        <label for="q3_a" class="option-label">٥ + ٥</label>

                        <input type="radio" id="q3_b" name="q3" value="8,3">
                        <label for="q3_b" class="option-label">٨ + ٣</label>

                        <input type="radio" id="q3_c" name="q3" value="6,4">
                        <label for="q3_c" class="option-label">٦ + ٤</label>

                        <input type="radio" id="q3_d" name="q3" value="7,3">
                        <label for="q3_d" class="option-label">٧ + ٣</label>
                    </div>
                </div>
            </div>

            <!-- قسم الأعداد من 11 إلى 19 -->
            <div class="topic-section">
                <div class="topic-title">الأعداد من 11 إلى 19</div>

                <!-- سؤال 4: الأعداد من 11 إلى 19 -->
                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">ما العدد الذي يلي العدد ١٥؟</div>
                    <div class="math-operation">١٥ → ؟</div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="14">
                        <label for="q4_a" class="option-label">١٤</label>

                        <input type="radio" id="q4_b" name="q4" value="16">
                        <label for="q4_b" class="option-label">١٦</label>

                        <input type="radio" id="q4_c" name="q4" value="17">
                        <label for="q4_c" class="option-label">١٧</label>

                        <input type="radio" id="q4_d" name="q4" value="18">
                        <label for="q4_d" class="option-label">١٨</label>
                    </div>
                </div>

                <!-- سؤال 5: الأعداد من 11 إلى 19 -->
                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">ما العدد الذي يسبق العدد ١٨؟</div>
                    <div class="math-operation">؟ ← ١٨</div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="16">
                        <label for="q5_a" class="option-label">١٦</label>

                        <input type="radio" id="q5_b" name="q5" value="17">
                        <label for="q5_b" class="option-label">١٧</label>

                        <input type="radio" id="q5_c" name="q5" value="19">
                        <label for="q5_c" class="option-label">١٩</label>

                        <input type="radio" id="q5_d" name="q5" value="15">
                        <label for="q5_d" class="option-label">١٥</label>
                    </div>
                </div>

                <!-- سؤال 6: الأعداد من 11 إلى 19 -->
                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">أي من هذه الأعداد يقع بين ١٣ و ١٦؟</div>
                    <div class="math-operation">١٣ ← ؟ → ١٦</div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="12">
                        <label for="q6_a" class="option-label">١٢</label>

                        <input type="radio" id="q6_b" name="q6" value="14">
                        <label for="q6_b" class="option-label">١٤</label>

                        <input type="radio" id="q6_c" name="q6" value="15">
                        <label for="q6_c" class="option-label">١٥</label>

                        <input type="radio" id="q6_d" name="q6" value="17">
                        <label for="q6_d" class="option-label">١٧</label>
                    </div>
                </div>

                <!-- سؤال 7: الأعداد من 11 إلى 19 -->
                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">رتب الأعداد التالية من الأصغر إلى الأكبر:</div>
                    <div class="math-operation">١٧ ، ١٢ ، ١٥</div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="17,15,12">
                        <label for="q7_a" class="option-label">١٧ ، ١٥ ، ١٢</label>

                        <input type="radio" id="q7_b" name="q7" value="12,15,17">
                        <label for="q7_b" class="option-label">١٢ ، ١٥ ، ١٧</label>

                        <input type="radio" id="q7_c" name="q7" value="15,17,12">
                        <label for="q7_c" class="option-label">١٥ ، ١٧ ، ١٢</label>

                        <input type="radio" id="q7_d" name="q7" value="12,17,15">
                        <label for="q7_d" class="option-label">١٢ ، ١٧ ، ١٥</label>
                    </div>
                </div>
            </div>

            <!-- قسم مكونات العدد 20 -->
            <div class="topic-section">
                <div class="topic-title">مكونات العدد 20</div>

                <!-- سؤال 8: مكونات العدد 20 -->
                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">ما العدد الناقص في مكونات العدد 20؟</div>
                    <div class="math-operation">١٢ + ؟ = ٢٠</div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="7">
                        <label for="q8_a" class="option-label">٧</label>

                        <input type="radio" id="q8_b" name="q8" value="8">
                        <label for="q8_b" class="option-label">٨</label>

                        <input type="radio" id="q8_c" name="q8" value="9">
                        <label for="q8_c" class="option-label">٩</label>

                        <input type="radio" id="q8_d" name="q8" value="10">
                        <label for="q8_d" class="option-label">١٠</label>
                    </div>
                </div>

                <!-- سؤال 9: مكونات العدد 20 -->
                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">ما العدد الناقص في مكونات العدد 20؟</div>
                    <div class="math-operation">؟ + ١٥ = ٢٠</div>
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

                <!-- سؤال 10: مكونات العدد 20 -->
                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">أي من هذه الأعداد لا يمثل مكونًا للعدد 20؟</div>
                    <div class="math-operation">؟ + ؟ = ٢٠</div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="10,10">
                        <label for="q10_a" class="option-label">١٠ + ١٠</label>

                        <input type="radio" id="q10_b" name="q10" value="13,8">
                        <label for="q10_b" class="option-label">١٣ + ٨</label>

                        <input type="radio" id="q10_c" name="q10" value="11,9">
                        <label for="q10_c" class="option-label">١١ + ٩</label>

                        <input type="radio" id="q10_d" name="q10" value="14,5">
                        <label for="q10_d" class="option-label">١٤ + ٥</label>
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
            q1: "3",
            q2: "6",
            q3: "8,3",
            q4: "16",
            q5: "17",
            q6: "15",
            q7: "12,15,17",
            q8: "8",
            q9: "5",
            q10: "14,5"
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
