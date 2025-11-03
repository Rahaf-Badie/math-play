<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الطالب | Math&Play</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Lalezar&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style1.css') }}" rel="stylesheet">

    <style>
        /* Student page additions */
        .student-topbar {
            background: #ffffff;
            border-radius: 16px;
            padding: 14px 18px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 18px 0;
        }

        .student-id {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #ffd166, #ffb703);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0b3a66;
            font-weight: 800;
            box-shadow: 0 6px 14px rgba(0, 0, 0, .08);
        }

        .section-title-sm {
            font-family: 'Lalezar', cursive;
            color: #0d3a66;
            margin: 8px 0 14px;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 14px;
        }

        .term-card,
        .unit-card,
        .lesson-card {
            border-radius: 16px;
            padding: 16px;
            background: #fff;
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .term-card:hover,
        .unit-card:hover,
        .lesson-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 34px rgba(0, 0, 0, .12);
        }

        .term-card--1 {
            background: linear-gradient(135deg, #fff8eb, #ffe7b3);
        }

        .term-card--2 {
            background: linear-gradient(135deg, #fff0f7, #ffd4ec);
        }

        .unit-icon {
            font-size: 28px;
        }

        .muted {
            color: #64748b;
            font-size: .95rem;
        }

        .hidden {
            display: none !important;
        }

        .breadcrumb-lite {
            display: flex;
            gap: 8px;
            align-items: center;
            color: #475569;
            font-size: .95rem;
            margin: 8px 0 16px;
        }

        .breadcrumb-lite a {
            color: var(--accent);
            text-decoration: none;
        }

        .lesson-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 12px;
        }

        .lesson-card img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, .08);
        }

        .lesson-cta {
            margin-top: 14px;
            display: flex;
            gap: 10px;
        }

        /* تنسيق بطاقات الصف العلوي */
        .top-cards-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 14px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .top-cards-row {
                grid-template-columns: 1fr;
            }
        }

        .pdf-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }

        .btn-solid {
            background: #007bff;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-solid:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="student-page">

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand brand-wrap" href="#" onclick="return false">
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
                    <li class="nav-item"><a class="nav-link" href="index.html#about">عن المنصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.html#services">خدماتنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.html#why">ماذا يميزنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.html#contact">تواصل</a></li>
                </ul>
                <div class="d-flex nav-actions gap-2">
                    <a href="{{ route('mathplay.edit_student') }}" class="btn btn-login">تعديل معلومات الطالب</a>
                    <a href="{{ route('mathplay.marks') }}" class="btn btn-login">عرض العلامات</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-login">تسجيل خروج</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-3">
        <div class="container">
            <div class="student-topbar">
                <div class="student-id">
                    <div class="student-avatar" aria-hidden="true">
                        @if ($user->gender === 'female')
                            👧
                        @else
                            👦
                        @endif
                    </div>
                    <div>
                        <div style="font-weight:800; color:#0b3a66">
                            مرحباً، <span id="studentName">{{ $user->name }}</span>
                        </div>
                        <div class="muted">
                            @if ($user->gender === 'female')
                                طالبة
                            @else
                                طالب
                            @endif
                            {{ $user->grade->name ?? 'غير محدد' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🔥 التصحيح: استبدال الـ row القديم بـ grid -->
            <div class="top-cards-row">
                <!-- بطاقة البحث -->
                <div class="pdf-card" style="display:flex; align-items:center; gap:10px;">
                    <span>🔎</span>
                    <input id="searchInput" type="search" placeholder="ابحث عن درس أو وحدة..."
                        class="form-control" />
                </div>

                <!-- بطاقة سلسلة الأيام -->
                <div class="pdf-card"
                    style="display:flex; align-items:center; gap:10px; justify-content:space-between;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:20px">🔥</span>
                        <div>
                            <div style="font-weight:800">سلسلة الأيام</div>
                            <div class="muted">
                                <span id="streakDays">{{ Auth::user()->streak_days ?? 0 }}</span> يوم متتالي
                            </div>
                        </div>
                    </div>
                </div>

                <!-- بطاقة أكمل التعلم -->
                <div id="continueCard" class="pdf-card"
                    style="display:flex; align-items:center; gap:10px; justify-content:space-between;">
                    <div>
                        <div style="font-weight:800">أكمل التعلم</div>
                        <div class="muted" id="continueLabel">
                            @if (isset($lastLesson) && $lastLesson)
                                {{ $lastLesson->name }}
                            @else
                                لا توجد سابقة تعلم
                            @endif
                        </div>
                    </div>
                    @if (isset($lastLesson) && $lastLesson)
                        <a id="continueLink" class="btn btn-solid"
                            href="{{ route('mathplay.lesson', ['id' => $lastLesson->id]) }}">
                            تابع
                        </a>
                    @else
                        <a id="continueLink" class="btn btn-solid" href="#" style="display:none;">تابع</a>
                    @endif
                </div>
            </div>

            <!-- نتائج البحث -->
            <div id="searchResults" style="margin-top:10px;"></div>

            <div class="breadcrumb-lite">
                <a href="#" id="crumbHome">الصفحة الرئيسية</a>
                <span>›</span>
                <span id="crumbLevel">الفصول</span>
                <span id="crumbUnitWrap" class="hidden">› <span id="crumbUnit">الوحدة</span></span>
            </div>

            <!-- باقي المحتوى -->
            <section id="termsView">
                <h3 class="section-title-sm wavy-underline">اختر الفصل الدراسي</h3>
                <div class="cards-grid">
                    <div class="term-card term-card--1" data-term="1">
                        <h5 class="mb-1">الفصل الأول 🌸</h5>
                        <div class="muted">مواد ووحدات بداية العام</div>
                    </div>
                    <div class="term-card term-card--2" data-term="2">
                        <h5 class="mb-1">الفصل الثاني 🌞</h5>
                        <div class="muted">استكمال وتوسّع بالمفاهيم</div>
                    </div>
                </div>
            </section>

            <section id="unitsView" class="hidden">
                <div class="cards-grid" id="unitsContainer">
                    @foreach ($units as $semesterId => $semesterUnits)
                        @foreach ($semesterUnits as $index => $unit)
                            <div class="unit-card hidden" data-unit="{{ $unit->id }}"
                                data-semester="{{ $semesterId }}">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <strong>الوحدة {{ $index + 1 }}: {{ $unit->name }}</strong>
                                        <div class="muted">{{ $unit->description ?? 'وحدة دراسية' }}</div>
                                    </div>
                                    <img alt="{{ $unit->name }}"
                                        src="{{ $unit->image_url ?? 'https://cdn-icons-png.flaticon.com/512/1995/1995403.png' }}"
                                        width="44" height="44" style="border-radius:12px;" />
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </section>

            <section id="lessonsView" class="hidden">
                <div class="lesson-list" id="lessonList"></div>
                <div class="lesson-cta" style="text-align:center; margin-top:20px;">
                    <button id="backToUnits" class="btn btn-ghost">رجوع للوحدات</button>
                </div>
            </section>
        </div>
    </main>

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
                        <a href="#" aria-label="WhatsApp" title="واتساب">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram" title="إنستغرام">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Facebook" title="فيسبوك">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="#1877F2">
                                <path
                                    d="M22 12a10 10 0 1 0-11.6 9.9v-7h-2.3V12h2.3V9.7c0-2.3 1.4-3.6 3.5-3.6 1 0 2 .2 2 .2v2.2H14c-1.1 0-1.4.7-1.4 1.4V12h2.4l-.4 2.9H12.6v7A10 10 0 0 0 22 12" />
                            </svg>
                        </a>
                        <a href="#" aria-label="LinkedIn" title="لينكد إن">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="#0A66C2">
                                <path
                                    d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM0 8h5v16H0zM8 8h4.8v2.2h.1c.7-1.2 2.5-2.5 5.2-2.5 5.6 0 6.7 3.7 6.7 8.5V24h-5V17.2c0-1.6 0-3.8-2.3-3.8s-2.7 1.8-2.7 3.7V24H8z" />
                            </svg>
                        </a>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- سكريبتك الخاص (IIFE) -->
    <!-- سكريبت شامل: البحث + عرض الفصول والوحدات والدروس -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // عناصر الصفحة
            const termsView = document.getElementById('termsView');
            const unitsView = document.getElementById('unitsView');
            const lessonsView = document.getElementById('lessonsView');
            const crumbLevel = document.getElementById('crumbLevel');
            const crumbUnitWrap = document.getElementById('crumbUnitWrap');
            const crumbUnit = document.getElementById('crumbUnit');
            const lessonList = document.getElementById('lessonList');
            const backToUnits = document.getElementById('backToUnits');

            function show(view) {
                [termsView, unitsView, lessonsView].forEach(v => v.classList.add('hidden'));
                view.classList.remove('hidden');
            }

            // عند الضغط على فصل -> إظهار الوحدات التابعة له
            document.querySelectorAll('[data-term]').forEach(card => {
                card.addEventListener('click', () => {
                    const termId = card.getAttribute('data-term');
                    document.querySelectorAll('#unitsView .unit-card').forEach(u => {
                        u.style.display = (u.getAttribute('data-semester') === termId) ?
                            'flex' : 'none';
                        u.classList.remove('hidden');
                    });
                    show(unitsView);
                    crumbLevel.textContent = 'الوحدات';
                    crumbUnitWrap.classList.add('hidden');
                });
            });

            // عند الضغط على وحدة -> جلب الدروس وعرضها
            document.querySelectorAll('#unitsView .unit-card').forEach(card => {
                card.addEventListener('click', () => {
                    const unitId = card.getAttribute('data-unit'); // رقم الوحدة
                    const unitName = card.querySelector('strong').textContent.trim();

                    // واجهة
                    crumbLevel.textContent = 'الدروس';
                    crumbUnit.textContent = unitName;
                    crumbUnitWrap.classList.remove('hidden');
                    show(lessonsView);

                    // تنظيف أي دروس قديمة
                    lessonList.innerHTML = '';

                    // AJAX لجلب الدروس
                    const url = `/mathplay/get-lessons-by-unit/${unitId}`;
                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(resp => resp.json())
                        .then(data => {
                            if (data.lessons && data.lessons.length > 0) {
                                data.lessons.forEach((lesson, idx) => {
                                    const link = document.createElement('a');
                                    link.href = `/mathplay/lesson/${lesson.id}`;
                                    link.style.textDecoration = 'none';
                                    link.style.color = 'inherit';
                                    link.innerHTML = `
                            <div class="lesson-card"
                                 style="cursor:pointer; border-radius:16px; box-shadow:0 8px 20px rgba(0,0,0,.12); padding:16px; text-align:center;">
                                <img src="${lesson.image_url || 'https://cdn-icons-png.flaticon.com/512/4727/4727269.png'}"
                                     alt="${escapeHtml(lesson.name || '')}"
                                     style="width:70px; height:70px; border-radius:12px; margin-bottom:10px;">
                                <h5 style="margin:0; font-weight:600;">${escapeHtml(lesson.name || '—')}</h5>
                            </div>
                        `;
                                    lessonList.appendChild(link);
                                });
                            } else {
                                lessonList.innerHTML =
                                    '<div class="muted" style="text-align:center;">لا توجد دروس متاحة لهذه الوحدة.</div>';
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            lessonList.innerHTML =
                                '<div style="color:red;text-align:center;">حدث خطأ أثناء تحميل الدروس.</div>';
                        });
                });
            });

            // زر العودة للوحدات
            if (backToUnits) backToUnits.addEventListener('click', () => {
                show(unitsView);
                crumbLevel.textContent = 'الوحدات';
                crumbUnitWrap.classList.add('hidden');
            });

            // زر الصفحة الرئيسية في breadcrumb
            const crumbHome = document.getElementById('crumbHome');
            if (crumbHome) {
                crumbHome.addEventListener('click', e => {
                    e.preventDefault();
                    window.location.href = "{{ route('mathplay.home') }}";
                });
            }

            // دالة حماية HTML
            function escapeHtml(str) {
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
            }
        });
    </script>
    <script>
        /* -------------------------------
            🔹 ثانياً: ميزة البحث الفوري
            -------------------------------- */
        $(document).ready(function() {
            const $searchInput = $('#searchInput');
            const $results = $('#searchResults');

            $searchInput.on('input', function() {
                const query = $(this).val().trim();

                if (query.length === 0) {
                    $results.empty();
                    return;
                }

                $.ajax({
                    url: "{{ route('search') }}",
                    type: 'GET',
                    data: {
                        query
                    },
                    success: function(data) {
                        let html = '';
                        if (data.lessons && data.lessons.length > 0) {
                            html += '<ul style="padding-left:10px;">';
                            data.lessons.forEach(item => {
                                html +=
                                    `<li style="margin-bottom:5px;">${item.lesson_name} → ${item.unit_name} → ${item.semester_name}</li>`;
                            });
                            html += '</ul>';
                        } else {
                            html = '<p>لا توجد نتائج.</p>';
                        }
                        $results.html(html);
                    },
                    error: function() {
                        $results.html('<p>حدث خطأ أثناء البحث.</p>');
                    }
                });
            });
        });
    </script>

    </script>
    <!-- سلسلة الأيام المتتالية -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const streakEl = document.getElementById('streakDays');
            const today = new Date();
            const todayStr = today.toISOString().split('T')[0]; // YYYY-MM-DD
            const userId = {{ auth()->id() }};

            // استخدمي مفاتيح خاصة بكل مستخدم
            const lastLoginKey = `last_time_logged_in_${userId}`;
            const streakKey = `streak_${userId}`;

            let lastLogin = localStorage.getItem(lastLoginKey);
            let streak = parseInt(localStorage.getItem(streakKey) || '0', 10);

            if (lastLogin) {
                const lastDate = new Date(lastLogin);
                const diff = Math.floor((today - lastDate) / (1000 * 60 * 60 * 24));

                if (diff === 1) {
                    streak += 1; // اليوم التالي
                } else if (diff > 1) {
                    streak = 1; // انقطعت السلسلة
                }
                // diff === 0 => نفس اليوم
            } else {
                streak = 1; // أول تسجيل دخول
            }

            // تحديث localStorage للمستخدم الحالي فقط
            localStorage.setItem(streakKey, streak);
            localStorage.setItem(lastLoginKey, todayStr);

            // تحديث واجهة المستخدم
            if (streakEl) streakEl.textContent = streak;
        });
    </script>


</body>

</html>
