<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار الرياضيات - الجمع ضمن 10 والجمع ضمن 18</title>
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
            max-width: 900px;
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

        .lesson-section {
            background: #e8f4fc;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-right: 5px solid #3498db;
        }

        .lesson-title {
            color: #2c3e50;
            font-size: 1.4rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .lesson-title::before {
            font-size: 1.6rem;
        }

        .lesson-section:nth-child(1) .lesson-title::before { content: "🔢"; }
        .lesson-section:nth-child(2) .lesson-title::before { content: "➕"; }

        .question {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            border-right: 4px solid #667eea;
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
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            margin-left: 10px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .question-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 12px;
        }

        .options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 12px;
        }

        .option-label {
            background: white;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
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
            font-size: 1.3rem;
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
            width: 35px;
            height: 35px;
            background: #667eea;
            color: white;
            border-radius: 50%;
            margin: 0 3px;
            font-weight: bold;
        }

        .visual-representation {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .visual-item {
            width: 35px;
            height: 35px;
            background: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
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
            margin-right: 8px;
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .back-btn:hover span {
            transform: translateX(-5px);
        }

        .score-breakdown {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            display: none;
        }

        .lesson-score {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .lesson-score:last-child {
            border-bottom: none;
        }

        .addition-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .number-group {
            display: flex;
            gap: 5px;
        }

        .equals-sign {
            margin: 0 15px;
            color: #e74c3c;
            font-size: 1.6rem;
        }

        .ten-frame {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 5px;
            margin: 15px auto;
            max-width: 200px;
        }

        .frame-cell {
            width: 30px;
            height: 30px;
            border: 2px solid #3498db;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .frame-cell.filled {
            background: #3498db;
            color: white;
        }

        .strategy-box {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
        }

        .strategy-title {
            font-weight: bold;
            color: #856404;
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <div class="exam-container">
        <div class="header">
            <a href="{{ route('mathplay.home') }}" class="back-btn">
                <span>📚</span> العودة للصفحة الرئيسية
            </a>
            <h1>اختبار الرياضيات - الجمع ضمن 10 والجمع ضمن 18 ➕</h1>
            <p>اختبر مهاراتك في عمليات الجمع الأساسية واستراتيجيات الحل</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="examForm">
            @csrf
            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

            <!-- قسم الجمع ضمن 10 -->
            <div class="lesson-section">
                <div class="lesson-title">الجمع ضمن 10</div>

                <div class="question">
                    <span class="question-number">1</span>
                    <div class="question-text">ما ناتج جمع: ٣ + ٤؟</div>
                    <div class="addition-visual">
                        <div class="number-group">
                            <span class="visual-item">٣</span>
                        </div>
                        <span>+</span>
                        <div class="number-group">
                            <span class="visual-item">٤</span>
                        </div>
                        <span class="equals-sign">=</span>
                        <span>؟</span>
                    </div>
                    <div class="options">
                        <input type="radio" id="q1_a" name="q1" value="6">
                        <label for="q1_a" class="option-label">٦</label>

                        <input type="radio" id="q1_b" name="q1" value="7">
                        <label for="q1_b" class="option-label">٧</label>

                        <input type="radio" id="q1_c" name="q1" value="8">
                        <label for="q1_c" class="option-label">٨</label>

                        <input type="radio" id="q1_d" name="q1" value="9">
                        <label for="q1_d" class="option-label">٩</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">2</span>
                    <div class="question-text">لدى سارة ٥ تفاحات، وأعطاها أخوها ٢ تفاحتين إضافيتين. كم تفاحة أصبح لديها؟</div>
                    <div class="math-operation">🍎🍎🍎🍎🍎 + 🍎🍎 = ؟</div>
                    <div class="options">
                        <input type="radio" id="q2_a" name="q2" value="6">
                        <label for="q2_a" class="option-label">٦</label>

                        <input type="radio" id="q2_b" name="q2" value="7">
                        <label for="q2_b" class="option-label">٧</label>

                        <input type="radio" id="q2_c" name="q2" value="8">
                        <label for="q2_c" class="option-label">٨</label>

                        <input type="radio" id="q2_d" name="q2" value="9">
                        <label for="q2_d" class="option-label">٩</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">3</span>
                    <div class="question-text">استخدم إطار العشرة لحل: ٦ + ٣</div>
                    <div class="ten-frame">
                        <div class="frame-cell filled">١</div>
                        <div class="frame-cell filled">٢</div>
                        <div class="frame-cell filled">٣</div>
                        <div class="frame-cell filled">٤</div>
                        <div class="frame-cell filled">٥</div>
                        <div class="frame-cell filled">٦</div>
                        <div class="frame-cell">٧</div>
                        <div class="frame-cell">٨</div>
                        <div class="frame-cell">٩</div>
                        <div class="frame-cell">١٠</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q3_a" name="q3" value="8">
                        <label for="q3_a" class="option-label">٨</label>

                        <input type="radio" id="q3_b" name="q3" value="9">
                        <label for="q3_b" class="option-label">٩</label>

                        <input type="radio" id="q3_c" name="q3" value="10">
                        <label for="q3_c" class="option-label">١٠</label>

                        <input type="radio" id="q3_d" name="q3" value="7">
                        <label for="q3_d" class="option-label">٧</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">4</span>
                    <div class="question-text">ما العدد الناقص في الجملة العددية: ٨ = ٥ + ؟</div>
                    <div class="math-operation">٥ + ؟ = ٨</div>
                    <div class="options">
                        <input type="radio" id="q4_a" name="q4" value="2">
                        <label for="q4_a" class="option-label">٢</label>

                        <input type="radio" id="q4_b" name="q4" value="3">
                        <label for="q4_b" class="option-label">٣</label>

                        <input type="radio" id="q4_c" name="q4" value="4">
                        <label for="q4_c" class="option-label">٤</label>

                        <input type="radio" id="q4_d" name="q4" value="5">
                        <label for="q4_d" class="option-label">٥</label>
                    </div>
                </div>
            </div>

            <!-- قسم الجمع ضمن 18 -->
            <div class="lesson-section">
                <div class="lesson-title">الجمع ضمن 18</div>

                <div class="question">
                    <span class="question-number">5</span>
                    <div class="question-text">ما ناتج جمع: ٩ + ٧؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 استراتيجية: اجعل العشرة أولاً</div>
                        <div>٩ + ٧ = (٩ + ١) + ٦ = ١٠ + ٦ = ١٦</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q5_a" name="q5" value="15">
                        <label for="q5_a" class="option-label">١٥</label>

                        <input type="radio" id="q5_b" name="q5" value="16">
                        <label for="q5_b" class="option-label">١٦</label>

                        <input type="radio" id="q5_c" name="q5" value="17">
                        <label for="q5_c" class="option-label">١٧</label>

                        <input type="radio" id="q5_d" name="q5" value="18">
                        <label for="q5_d" class="option-label">١٨</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">6</span>
                    <div class="question-text">احسب باستخدام التجميع: ٨ + ٦</div>
                    <div class="math-operation">٨ + ٦ = (٨ + ٢) + ٤ = ؟</div>
                    <div class="options">
                        <input type="radio" id="q6_a" name="q6" value="12">
                        <label for="q6_a" class="option-label">١٢</label>

                        <input type="radio" id="q6_b" name="q6" value="13">
                        <label for="q6_b" class="option-label">١٣</label>

                        <input type="radio" id="q6_c" name="q6" value="14">
                        <label for="q6_c" class="option-label">١٤</label>

                        <input type="radio" id="q6_d" name="q6" value="15">
                        <label for="q6_d" class="option-label">١٥</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">7</span>
                    <div class="question-text">في حفلة، كان هناك ٧ أولاد و ٨ بنات. كم طفلاً كان في الحفلة؟</div>
                    <div class="math-operation">👦👦👦👦👦👦👦 + 👧👧👧👧👧👧👧👧 = ؟</div>
                    <div class="options">
                        <input type="radio" id="q7_a" name="q7" value="14">
                        <label for="q7_a" class="option-label">١٤</label>

                        <input type="radio" id="q7_b" name="q7" value="15">
                        <label for="q7_b" class="option-label">١٥</label>

                        <input type="radio" id="q7_c" name="q7" value="16">
                        <label for="q7_c" class="option-label">١٦</label>

                        <input type="radio" id="q7_d" name="q7" value="17">
                        <label for="q7_d" class="option-label">١٧</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">8</span>
                    <div class="question-text">ما ناتج جمع: ٥ + ٩؟ (استخدم خاصية الإبدال)</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 خاصية الإبدال: ٥ + ٩ = ٩ + ٥</div>
                        <div>من الأسهل حساب ٩ + ٥ لأن ٩ + ١ = ١٠ ثم ١٠ + ٤ = ١٤</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q8_a" name="q8" value="13">
                        <label for="q8_a" class="option-label">١٣</label>

                        <input type="radio" id="q8_b" name="q8" value="14">
                        <label for="q8_b" class="option-label">١٤</label>

                        <input type="radio" id="q8_c" name="q8" value="15">
                        <label for="q8_c" class="option-label">١٥</label>

                        <input type="radio" id="q8_d" name="q8" value="16">
                        <label for="q8_d" class="option-label">١٦</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">9</span>
                    <div class="question-text">إذا جمعنا ٨ + ٤، فأي من هذه الطرق صحيحة؟</div>
                    <div class="options">
                        <input type="radio" id="q9_a" name="q9" value="8+2+2">
                        <label for="q9_a" class="option-label">٨ + ٢ + ٢ = ١٢</label>

                        <input type="radio" id="q9_b" name="q9" value="10+2">
                        <label for="q9_b" class="option-label">١٠ + ٢ = ١٢</label>

                        <input type="radio" id="q9_c" name="q9" value="7+5">
                        <label for="q9_c" class="option-label">٧ + ٥ = ١٢</label>

                        <input type="radio" id="q9_d" name="q9" value="all">
                        <label for="q9_d" class="option-label">جميع ما سبق</label>
                    </div>
                </div>

                <div class="question">
                    <span class="question-number">10</span>
                    <div class="question-text">ما ناتج جمع: ٦ + ٧ + ٢؟</div>
                    <div class="strategy-box">
                        <div class="strategy-title">💡 استراتيجية: ابحث عن الأعداد التي تصنع عشرة</div>
                        <div>٦ + ٧ + ٢ = (٦ + ٤) + ٣ + ٢ = ١٠ + ٥ = ١٥</div>
                    </div>
                    <div class="options">
                        <input type="radio" id="q10_a" name="q10" value="14">
                        <label for="q10_a" class="option-label">١٤</label>

                        <input type="radio" id="q10_b" name="q10" value="15">
                        <label for="q10_b" class="option-label">١٥</label>

                        <input type="radio" id="q10_c" name="q10" value="16">
                        <label for="q10_c" class="option-label">١٦</label>

                        <input type="radio" id="q10_d" name="q10" value="17">
                        <label for="q10_d" class="option-label">١٧</label>
                    </div>
                </div>
            </div>

            <div class="controls">
                <button type="button" class="btn submit-btn" onclick="calculateScore()">📤 إرسال الإجابات</button>
                <button type="button" class="btn reset-btn" onclick="resetExam()">🔄 إعادة تعيين</button>
            </div>
        </form>

        <div class="result-box" id="resultBox"></div>
        <div class="score-breakdown" id="scoreBreakdown"></div>
    </div>

    <script>
        // الإجابات الصحيحة
        const correctAnswers = {
            q1: "7",        // 3 + 4
            q2: "7",        // 5 + 2
            q3: "9",        // 6 + 3
            q4: "3",        // 5 + ? = 8
            q5: "16",       // 9 + 7
            q6: "14",       // 8 + 6
            q7: "15",       // 7 + 8
            q8: "14",       // 5 + 9
            q9: "all",      // طرق مختلفة للجمع
            q10: "15"       // 6 + 7 + 2
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

            // حساب النقاط لكل قسم
            const lessonScores = {
                'الجمع ضمن 10': { total: 4, correct: 0 },
                'الجمع ضمن 18': { total: 6, correct: 0 }
            };

            // حساب النقاط
            for (const [question, correctAnswer] of Object.entries(correctAnswers)) {
                const selectedOption = document.querySelector(`input[name="${question}"]:checked`);

                if (selectedOption) {
                    answeredQuestions++;
                    if (selectedOption.value === correctAnswer) {
                        score++;

                        // تحديث نتائج الأقسام
                        if (['q1', 'q2', 'q3', 'q4'].includes(question)) {
                            lessonScores['الجمع ضمن 10'].correct++;
                        } else if (['q5', 'q6', 'q7', 'q8', 'q9', 'q10'].includes(question)) {
                            lessonScores['الجمع ضمن 18'].correct++;
                        }
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
            submitExam(score, lessonScores);
        }

        // إرسال النتيجة إلى الخادم
        async function submitExam(score, lessonScores) {
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
                    showDetailedResult(score, Object.keys(correctAnswers).length, lessonScores, data.message);
                } else {
                    throw new Error(data.error || 'حدث خطأ غير معروف');
                }

            } catch (error) {
                showResult(`❌ حدث خطأ: ${error.message}`, 'warning');
            }
        }

        // عرض النتيجة التفصيلية
        function showDetailedResult(score, totalQuestions, lessonScores, message) {
            const resultBox = document.getElementById('resultBox');
            const breakdown = document.getElementById('scoreBreakdown');

            resultBox.style.display = 'block';
            resultBox.className = 'result-box success';
            resultBox.innerHTML = `
                🎉 <strong>أحسنت!</strong><br>
                نتيجتك: <strong>${score}</strong> من ${totalQuestions}<br>
                <small>${message || 'تم حفظ النتيجة بنجاح'}</small>
            `;

            // عرض تفصيلي للنتائج
            breakdown.style.display = 'block';
            breakdown.innerHTML = '<h4>تفصيل النتائج حسب الدروس:</h4>';

            for (const [lesson, results] of Object.entries(lessonScores)) {
                const percentage = Math.round((results.correct / results.total) * 100);
                const lessonDiv = document.createElement('div');
                lessonDiv.className = 'lesson-score';
                lessonDiv.innerHTML = `
                    <span>${lesson}</span>
                    <span>${results.correct}/${results.total} (${percentage}%)</span>
                `;
                breakdown.appendChild(lessonDiv);
            }
        }

        // عرض النتيجة
        function showResult(message, type) {
            const resultBox = document.getElementById('resultBox');
            resultBox.style.display = 'block';
            resultBox.innerHTML = message;
            resultBox.className = 'result-box ' + type;

            // إخفاء التفصيل إذا كان ظاهراً
            document.getElementById('scoreBreakdown').style.display = 'none';
        }

        // إعادة تعيين الاختبار
        function resetExam() {
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.checked = false;
            });

            document.getElementById('resultBox').style.display = 'none';
            document.getElementById('scoreBreakdown').style.display = 'none';
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
