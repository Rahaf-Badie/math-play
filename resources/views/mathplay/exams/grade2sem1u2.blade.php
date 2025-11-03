<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الجمع والطرح ضمن 99</title>
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

        .calculation-box {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            font-size: 1.4rem;
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
            <h1>اختبار الجمع والطرح ضمن 99 🧮</h1>
            <p>اختبر مهاراتك في عمليات الجمع والطرح دون حمل أو استلاف</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم الجمع دون حمل ضمن 99 -->
            <div class="topic-section">
                <div class="topic-title">الجمع دون حمل ضمن 99</div>

                <!-- سؤال 1: جمع عشرات -->
                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما ناتج جمع العددين التاليين؟</div>
                    <div class="calculation-box">٢٣ + ٤٥ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="68">
                        <label for="q1_a" class="option-label">٦٨</label>

                        <input type="radio" id="q1_b" name="q1" value="67">
                        <label for="q1_b" class="option-label">٦٧</label>

                        <input type="radio" id="q1_c" name="q1" value="78">
                        <label for="q1_c" class="option-label">٧٨</label>

                        <input type="radio" id="q1_d" name="q1" value="58">
                        <label for="q1_d" class="option-label">٥٨</label>
                    </div>
                </div>

                <!-- سؤال 2: جمع مع آحاد وعشرات -->
                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">احسب ناتج الجمع التالي:</div>
                    <div class="calculation-box">٣٦ + ٥٢ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="88">
                        <label for="q2_a" class="option-label">٨٨</label>

                        <input type="radio" id="q2_b" name="q2" value="87">
                        <label for="q2_b" class="option-label">٨٧</label>

                        <input type="radio" id="q2_c" name="q2" value="98">
                        <label for="q2_c" class="option-label">٩٨</label>

                        <input type="radio" id="q2_d" name="q2" value="78">
                        <label for="q2_d" class="option-label">٧٨</label>
                    </div>
                </div>

                <!-- سؤال 3: جمع أعداد متقاربة -->
                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">ما هو ناتج العملية الحسابية؟</div>
                    <div class="calculation-box">٤١ + ٣٧ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="78">
                        <label for="q3_a" class="option-label">٧٨</label>

                        <input type="radio" id="q3_b" name="q3" value="77">
                        <label for="q3_b" class="option-label">٧٧</label>

                        <input type="radio" id="q3_c" name="q3" value="88">
                        <label for="q3_c" class="option-label">٨٨</label>

                        <input type="radio" id="q3_d" name="q3" value="68">
                        <label for="q3_d" class="option-label">٦٨</label>
                    </div>
                </div>

                <!-- سؤال 4: جمع مع أعداد كبيرة -->
                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">أوجد ناتج جمع العددين:</div>
                    <div class="calculation-box">٦٤ + ٢٥ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="89">
                        <label for="q4_a" class="option-label">٨٩</label>

                        <input type="radio" id="q4_b" name="q4" value="79">
                        <label for="q4_b" class="option-label">٧٩</label>

                        <input type="radio" id="q4_c" name="q4" value="99">
                        <label for="q4_c" class="option-label">٩٩</label>

                        <input type="radio" id="q4_d" name="q4" value="88">
                        <label for="q4_d" class="option-label">٨٨</label>
                    </div>
                </div>

                <!-- سؤال 5: جمع مع أعداد صغيرة -->
                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">احسب ناتج العملية التالية:</div>
                    <div class="calculation-box">١٥ + ٢٣ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="38">
                        <label for="q5_a" class="option-label">٣٨</label>

                        <input type="radio" id="q5_b" name="q5" value="37">
                        <label for="q5_b" class="option-label">٣٧</label>

                        <input type="radio" id="q5_c" name="q5" value="48">
                        <label for="q5_c" class="option-label">٤٨</label>

                        <input type="radio" id="q5_d" name="q5" value="28">
                        <label for="q5_d" class="option-label">٢٨</label>
                    </div>
                </div>
            </div>

            <!-- قسم طرح عددين ضمن 99 دون استلاف -->
            <div class="topic-section">
                <div class="topic-title">طرح عددين ضمن 99 دون استلاف</div>

                <!-- سؤال 6: طرح عشرات -->
                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">ما ناتج طرح العددين التاليين؟</div>
                    <div class="calculation-box">٧٨ - ٣٥ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="43">
                        <label for="q6_a" class="option-label">٤٣</label>

                        <input type="radio" id="q6_b" name="q6" value="42">
                        <label for="q6_b" class="option-label">٤٢</label>

                        <input type="radio" id="q6_c" name="q6" value="53">
                        <label for="q6_c" class="option-label">٥٣</label>

                        <input type="radio" id="q6_d" name="q6" value="33">
                        <label for="q6_d" class="option-label">٣٣</label>
                    </div>
                </div>

                <!-- سؤال 7: طرح مع آحاد وعشرات -->
                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">احسب ناتج الطرح التالي:</div>
                    <div class="calculation-box">٩٦ - ٥٤ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="42">
                        <label for="q7_a" class="option-label">٤٢</label>

                        <input type="radio" id="q7_b" name="q7" value="41">
                        <label for="q7_b" class="option-label">٤١</label>

                        <input type="radio" id="q7_c" name="q7" value="52">
                        <label for="q7_c" class="option-label">٥٢</label>

                        <input type="radio" id="q7_d" name="q7" value="32">
                        <label for="q7_d" class="option-label">٣٢</label>
                    </div>
                </div>

                <!-- سؤال 8: طرح أعداد متقاربة -->
                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">ما هو ناتج العملية الحسابية؟</div>
                    <div class="calculation-box">٨٧ - ٤٥ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="42">
                        <label for="q8_a" class="option-label">٤٢</label>

                        <input type="radio" id="q8_b" name="q8" value="41">
                        <label for="q8_b" class="option-label">٤١</label>

                        <input type="radio" id="q8_c" name="q8" value="52">
                        <label for="q8_c" class="option-label">٥٢</label>

                        <input type="radio" id="q8_d" name="q8" value="32">
                        <label for="q8_d" class="option-label">٣٢</label>
                    </div>
                </div>

                <!-- سؤال 9: طرح مع أعداد كبيرة -->
                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">أوجد ناتج طرح العددين:</div>
                    <div class="calculation-box">٩٩ - ٦٣ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="36">
                        <label for="q9_a" class="option-label">٣٦</label>

                        <input type="radio" id="q9_b" name="q9" value="35">
                        <label for="q9_b" class="option-label">٣٥</label>

                        <input type="radio" id="q9_c" name="q9" value="46">
                        <label for="q9_c" class="option-label">٤٦</label>

                        <input type="radio" id="q9_d" name="q9" value="26">
                        <label for="q9_d" class="option-label">٢٦</label>
                    </div>
                </div>

                <!-- سؤال 10: طرح مع أعداد صغيرة -->
                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">احسب ناتج العملية التالية:</div>
                    <div class="calculation-box">٥٨ - ٢٧ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="31">
                        <label for="q10_a" class="option-label">٣١</label>

                        <input type="radio" id="q10_b" name="q10" value="30">
                        <label for="q10_b" class="option-label">٣٠</label>

                        <input type="radio" id="q10_c" name="q10" value="41">
                        <label for="q10_c" class="option-label">٤١</label>

                        <input type="radio" id="q10_d" name="q10" value="21">
                        <label for="q10_d" class="option-label">٢١</label>
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
            q1: "68",
            q2: "88",
            q3: "78",
            q4: "89",
            q5: "38",
            q6: "43",
            q7: "42",
            q8: "42",
            q9: "36",
            q10: "31"
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
