<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lesson->name }} | Math&Play</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Lalezar&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .lesson-hero {
            background: linear-gradient(135deg, #fff7fb, #f0f8ff);
            border-radius: 20px;
            padding: 20px;
            box-shadow: var(--shadow);
            margin: 20px 0;
        }

        .lesson-hero img {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .12);
        }

        .tab-btn {
            border: none;
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 800;
            background: #fff;
            box-shadow: var(--shadow);
            cursor: pointer;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        .pdf-card,
        .game-card {
            background: #fff;
            border-radius: 16px;
            padding: 16px;
            box-shadow: var(--shadow);
        }

        .quiz-card {
            background: #fff;
            border-radius: 16px;
            padding: 16px;
            box-shadow: var(--shadow);
        }

        .result-badge {
            display: none;
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            font-weight: 800;
        }

        .result-success {
            background: #dcfce7;
            color: #166534;
        }

        .result-fail {
            background: #fee2e2;
            color: #991b1b;
        }

        .achievements {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .badge-ach {
            background: linear-gradient(135deg, #ffe08a, #ffb703);
            color: #0b3a66;
            border-radius: 12px;
            padding: 8px 12px;
            font-weight: 800;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        }

        .progress-wrap {
            background: #fff;
            border-radius: 16px;
            padding: 16px;
            box-shadow: var(--shadow);
        }

        .mascot {
            background: #fff;
            border-radius: 16px;
            padding: 12px 14px;
            box-shadow: var(--shadow);
            display: flex;
            gap: 10px;
            align-items: center;
        }
    </style>
</head>

<body>

    <!-- NAV (reuse) -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand brand-wrap" href="index.html">
                <div class="logo-container">
                    <div class="logo-icon">
                        <svg viewBox="0 0 100 100" width="50" height="50" class="logo-svg">
                            <defs>
                                <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%"
                                    y2="100%">
                                    <stop offset="0%" style="stop-color:#ffb703;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#2196f3;stop-opacity:1" />
                                </linearGradient>
                                <filter id="glow">
                                    <feGaussianBlur stdDeviation="3" result="coloredBlur" />
                                    <feMerge>
                                        <feMergeNode in="coloredBlur" />
                                        <feMergeNode in="SourceGraphic" />
                                    </feMerge>
                                </filter>
                            </defs>
                            <circle cx="50" cy="50" r="45" fill="url(#logoGradient)" opacity="0.1" />
                            <circle cx="50" cy="50" r="40" fill="none" stroke="url(#logoGradient)"
                                stroke-width="2" opacity="0.3" />
                            <text x="30" y="35" font-size="16" fill="url(#logoGradient)" font-weight="bold">+</text>
                            <text x="65" y="35" font-size="16" fill="url(#logoGradient)" font-weight="bold">-</text>
                            <text x="30" y="65" font-size="16" fill="url(#logoGradient)" font-weight="bold">×</text>
                            <text x="65" y="65" font-size="16" fill="url(#logoGradient)" font-weight="bold">÷</text>
                            <text x="50" y="55" font-size="24" fill="url(#logoGradient)" font-weight="bold"
                                text-anchor="middle" filter="url(#glow)">M</text>
                        </svg>
                    </div>
                </div>
                <span class="brand-name">
                    <span class="brand-text">
                        <span class="brand-math">Math</span>
                        <span class="brand-amp">&</span>
                        <span class="brand-play">Play</span>
                    </span>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
                aria-controls="nav" aria-expanded="false" aria-label="قائمة التنقل">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('mathplay.home') }}">رجوع للطالب</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('mathplay.index') }}#contact">تواصل</a></li>
                </ul>
                <div class="d-flex nav-actions gap-2">
                    <!-- زر تعديل معلومات الطالب -->
                    <a href="{{ route('mathplay.edit_student') }}" class="btn btn-login">
                        تعديل معلومات الطالب
                    </a>

                    <!-- زر عرض العلامات -->
                    <a href="{{ route('mathplay.marks') }}" class="btn btn-login">
                        عرض العلامات
                    </a>

                    <!-- زر تسجيل الخروج -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-login">
                            تسجيل خروج
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-3">
        <div class="container">
            <!-- Lesson header -->
            <div class="lesson-hero d-flex align-items-center justify-content-between">
                <div>
                    <h2 id="lessonTitle" class="m-0">{{ $lesson->name }}</h2>
                    <div id="lessonSubtitle" class="text-muted">{{ $lesson->description }}</div>
                </div>
                <img id="lessonImg" src="https://cdn-icons-png.flaticon.com/512/4151/4151047.png" alt="تفاح" />
            </div>

            <!-- Tabs -->
            <div class="d-flex gap-2 flex-wrap mb-3">
                <button class="tab-btn active" data-tab="content">📖 المحتوى التعليمي</button>
                <button class="tab-btn" data-tab="pdf">📄 تنزيل PDF</button>
                <button class="tab-btn" data-tab="games">🎮 الألعاب التفاعلية</button>
                <button class="tab-btn" data-tab="quiz">🧮 اسأل الحاسبة</button>
            </div>

            <!-- Panels -->
            <section id="panel-content" class="tab-panel active">
                <div class="pdf-card">
                    <p>في هذا الدرس ستتعلم : {{ $lesson->description }}</p>
                    <div class="ratio ratio-16x9">
                        @if (!empty($lesson->video_url))
                            <iframe src="{{ $lesson->video_url }}" title="فيديو الدرس: {{ $lesson->name }}"
                                allowfullscreen>
                            </iframe>
                        @else
                            <p class="text-center text-muted">لا يوجد فيديو لهذا الدرس حالياً.</p>
                        @endif
                    </div>
                </div>
            </section>

            <section id="panel-pdf" class="tab-panel">

                <div class="pdf-card d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-1">تحميل ورقة الدرس</h5>
                        <p class="mb-0 text-muted">احفظ أو اطبع الشرح مع أمثلة وتمارين</p>
                    </div>

                    <!-- زر التحميل فقط -->
                    <a class="btn btn-solid" href="{{ asset('storage/' . $lesson->pdf_path) }}" download>
                        تنزيل PDF
                    </a>
                </div>

                <!-- خانة عرض PDF -->
                <div style="margin-top:20px; height:400px; border:1px solid #ccc; border-radius:8px;">
                    <iframe src="{{ route('lessons.pdf', $lesson->id) }}" width="100%" height="100%"
                        style="border:none;"></iframe>
                </div>

            </section>

            <section id="panel-games" class="tab-panel">
                <div class="row g-3">
                    @foreach ($lesson->lessonGames as $lessonGame)
                        <div class="col-md-6">
                            <div class="game-card">
                                {{-- اسم اللعبة --}}
                                <h6>{{ $lessonGame->game->name }}</h6>

                                {{-- وصف اللعبة: يمكن تخزينه في جدول Game أو GameSettings --}}
                                <p class="text-muted">
                                    {{ $lessonGame->game->description ?? 'ابدأ اللعبة واستمتع بالتحدي!' }}
                                </p>

                                {{-- زر يبدأ اللعبة: يمكن توجيه الرابط للعبة باستخدام template_url --}}
                                <a href="{{ route('games.play', ['lesson_game' => $lessonGame->id]) }}"
                                    class="btn btn-ghost">
                                    ابدأ اللعبة
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>


            <div class="card mt-3 shadow-sm" id="gemini-chat-box" style="display: none;">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">العبقري الصغير في الرياضيات 🤓</h5>
                    <button class="btn btn-sm btn-outline-light" id="reset-chat-btn" title="ابدأ محادثة جديدة">
                        🔄
                    </button>
                </div>

                <div class="card-body" id="chat-messages"
                    style="max-height: 300px; overflow-y: auto; padding-top: 15px;">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="alert alert-light text-center border p-2" role="alert" style="max-width: 90%;">
                            مرحباً بك! يمكنك سؤالي أي سؤال حسابي ✨
                            <br> (تذكّر أن لديك 5 أسئلة مسموح بها في الدقيقة)
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="input-group">
                        <input type="text" id="user-question" class="form-control"
                            placeholder="اكتب سؤالك هنا..." aria-label="سؤال الطالب">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button" id="send-question-btn">
                                إرسال
                            </button>
                        </div>
                    </div>

                    <div class="mt-2 text-end">
                        <small id="rate-limit-info" class="text-muted">الأسئلة المتبقية: <span
                                id="remaining-questions">5</span></small>
                    </div>
                </div>
            </div>


            <!-- Extras -->
            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="progress-wrap">
                        <h6 class="mb-2">نظام التقدم</h6>
                        <div class="mb-1 text-muted">
                            أتممت
                            <strong id="doneCount">{{ $completedLessons ?? 0 }}</strong>/<strong
                                id="totalCount">{{ $totalLessons ?? 0 }}</strong>
                            دروس من هذه الوحدة
                        </div>
                        <div class="progress" role="progressbar" aria-label="progress">
                            <div id="progressBar" class="progress-bar"
                                style="width: {{ $progressPercentage ?? 0 }}%">
                                {{ $progressPercentage ?? 0 }}%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="pdf-card">
                        <h6 class="mb-2">قسم المراجعة</h6>
                        <p class="mb-2 text-muted">بعد اجتياز عدة دروس، تفتح لك اختبارات تجميعية على الوحدة كاملة.</p>
                        <form action="{{ route('mathplay.exam.start') }}" method="GET">
                            <input type="hidden" name="unit_id" value="{{ $lesson->unit_id }}">
                            <button type="submit" class="btn btn-ghost">اختبار تجميعي 🧩</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mascot">
                        <div style="font-size:28px">🦊</div>
                        <div>
                            <strong id="mascotTitle">برافو 👏!</strong>
                            <div class="text-muted" id="mascotTip">واصل التمرّن وستصبح بطل الرياضيات 🏅</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- Footer (reuse) -->
    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5>Math&Play</h5>
                    <p>منصة تعليمية تفاعلية</p>
                    <p>لتعليم الرياضيات للأطفال</p>
                    <p>من الصف الأول حتى الرابع</p>
                </div>
                <div class="footer-contact">
                    <h6>تواصل معنا</h6>
                    <div class="footer-icons">
                        <a href="#" aria-label="WhatsApp" title="واتساب"><svg viewBox="0 0 24 24"
                                width="24" height="24" fill="currentColor">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                            </svg></a>
                        <a href="#" aria-label="Instagram" title="إنستغرام"><svg viewBox="0 0 24 24"
                                width="24" height="24" fill="currentColor">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg></a>
                        <a href="#" aria-label="Facebook" title="فيسبوك"><svg viewBox="0 0 24 24"
                                width="24" height="24" fill="#1877F2">
                                <path
                                    d="M22 12a10 10 0 1 0-11.6 9.9v-7h-2.3V12h2.3V9.7c0-2.3 1.4-3.6 3.5-3.6 1 0 2 .2 2 .2v2.2H14c-1.1 0-1.4.7-1.4 1.4V12h2.4l-.4 2.9H12.6v7A10 10 0 0 0 22 12" />
                            </svg></a>
                        <a href="#" aria-label="LinkedIn" title="لينكد إن"><svg viewBox="0 0 24 24"
                                width="24" height="24" fill="#0A66C2">
                                <path
                                    d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM0 8h5v16H0zM8 8h4.8v2.2h.1c.7-1.2 2.5-2.5 5.2-2.5 5.6 0 6.7 3.7 6.7 8.5V24h-5V17.2c0-1.6 0-3.8-2.3-3.8s-2.7 1.8-2.7 3.7V24H8z" />
                            </svg></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h5>فريق التطوير</h5>
                    <div class="footer-creators">
                        <p>تم تصميمه وتطويره بواسطة:</p>
                        <p><strong>رهف • وئام • سارة • إيمان</strong></p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <span id="year"></span> Math&Play - جميع الحقوق محفوظة</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- 1. الإعدادات الأولية والمتحكمات ---

            // تحديث السنة تلقائياً
            const y = document.getElementById('year');
            if (y) y.textContent = new Date().getFullYear();

            // عناصر التحكم في التبويبات
            const btns = document.querySelectorAll('.tab-btn');
            const panels = {
                content: document.getElementById('panel-content'),
                pdf: document.getElementById('panel-pdf'),
                games: document.getElementById('panel-games'),
            };
            const geminiChatBox = document.getElementById('gemini-chat-box');

            // عناصر الدردشة
            const sendQuestionBtn = document.getElementById('send-question-btn');
            const questionInput = document.getElementById('user-question');
            const chatMessages = document.getElementById('chat-messages');
            const remainingQuestionsSpan = document.getElementById('remaining-questions');

            // مسار AJAX والـ CSRF Token
            // تأكد أن لديك <meta name="csrf-token" content="{{ csrf_token() }}"> في الهيدر
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.content : '';
            const aiApiRoute = '{{ url('mathplay/api/mathplay-ask') }}';

            // --- 2. منطق التحكم بالـ Tabs ---

            btns.forEach(b => b.addEventListener('click', () => {
                btns.forEach(x => x.classList.remove('active'));
                Object.values(panels).forEach(p => p.classList.remove('active'));
                geminiChatBox.style.display = 'none';

                b.classList.add('active');
                const tab = b.dataset.tab;

                if (tab === 'quiz') {
                    geminiChatBox.style.display = 'block';
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                } else if (panels[tab]) {
                    panels[tab].classList.add('active');
                }
            }));

            // --- 3. منطق Gemini Chat AJAX الفعلي ---

            sendQuestionBtn.addEventListener('click', sendQuestion);
            questionInput.addEventListener('keypress', e => {
                if (e.key === 'Enter') sendQuestion();
            });

            function sendQuestion() {
                const question = questionInput.value.trim();
                if (!question) return;

                // أ. عرض سؤال الطالب
                chatMessages.innerHTML += `
            <div class="d-flex justify-content-end mb-2">
                <div class="p-2 bg-info text-white rounded shadow-sm" style="max-width:80%;">
                    ${question}
                </div>
            </div>
        `;
                questionInput.value = '';

                // ب. إظهار رسالة "جاري الإجابة" وتعطيل الزر
                const thinkingMessageId = 'thinking-' + Date.now();
                chatMessages.innerHTML += `
            <div class="d-flex justify-content-start mb-2" id="${thinkingMessageId}">
                <div class="p-2 alert alert-light rounded shadow-sm" style="font-style: italic; color: #6c757d;">
                    العبقري الصغير: جاري التفكير... 🤔
                </div>
            </div>
        `;
                chatMessages.scrollTop = chatMessages.scrollHeight;
                sendQuestionBtn.disabled = true;

                // ج. إرسال طلب AJAX الفعلي
                fetch(aiApiRoute, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            user_question: question
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            // معالجة أخطاء HTTP (مثل 419, 429, 500) قبل محاولة تحليل JSON
                            throw new Error('HTTP status ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        document.getElementById(thinkingMessageId).remove();

                        let messageHtml;
                        if (data.error || !data.response) {
                            // إذا كان هناك خطأ (مثل Rate Limit أو خطأ من Controller)
                            messageHtml =
                                `<div class="p-2 alert alert-danger rounded shadow-sm">🤖: ${data.error || 'عذراً، حدث خطأ فني أثناء الرد.'}</div>`;
                        } else {
                            // عرض الرد الناجح من Gemini
                            messageHtml = `
                    <div class="p-2 alert alert-primary rounded shadow-sm" style="max-width: 80%; background-color: #e0f7fa; border-color: #b2ebf2; color: #004d40;">
                        ${data.response}
                    </div>
                `;
                        }

                        chatMessages.innerHTML +=
                            `<div class="d-flex justify-content-start mb-2">${messageHtml}</div>`;

                        // تحديث عداد الأسئلة المتبقية
                        if (data.remaining_count !== undefined && remainingQuestionsSpan) {
                            remainingQuestionsSpan.textContent = data.remaining_count;
                        }

                        sendQuestionBtn.disabled = false;
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    })
                    .catch(error => {
                        // د. معالجة أخطاء الشبكة أو أخطاء الـ JSON
                        console.error('AJAX/Network Error:', error);
                        const thinking = document.getElementById(thinkingMessageId);
                        if (thinking) thinking.remove();

                        chatMessages.innerHTML += `
                <div class="d-flex justify-content-start mb-2">
                    <div class="p-2 alert alert-danger rounded shadow-sm" style="max-width: 80%;">
                        خطأ في الاتصال بالشبكة. حاول مجدداً.
                    </div>
                </div>
            `;
                        sendQuestionBtn.disabled = false;
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    });
            }
        });
    </script>

</body>

</html>
