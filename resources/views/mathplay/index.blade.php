<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>منصة تعليمية للأطفال | Math&Play</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Lalezar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* تحسين اللوغو لجعله بارز أكثر */
        .logo-svg {
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .brand-name {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f7fa 100%) !important;
            border: 1px solid #b3e5fc;
            color: #01579b;
        }

        .testimonial-avatar-1 {
            background: linear-gradient(135deg, #81d4fa 0%, #4fc3f7 100%);
        }

        .testimonial-avatar-2 {
            background: linear-gradient(135deg, #fff9c4 0%, #fff59d 100%);
            color: #5d4037 !important;
        }

        .testimonial-avatar-3 {
            background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
            color: #1b5e20 !important;
        }

        .why-item {
            background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%) !important;
            border: 1px solid #ce93d8;
            color: #4a148c;
        }

        .why-bullet {
            background: linear-gradient(135deg, #ba68c8 0%, #8e24aa 100%);
            color: white;
        }

        .service-card {
            background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%) !important;
            border: 1px solid #a5d6a7;
            color: #1b5e20;
        }

        .btn-solid {
            background: linear-gradient(135deg, #42a5f5 0%, #1976d2 100%);
            border: none;
            color: white;
        }

        .btn-ghost {
            background: transparent;
            border: 2px solid #42a5f5;
            color: #42a5f5;
        }

        .section-title {
            color: #1565c0;
        }

        /* تحسين النص في البطاقات */
        .testimonial-card p,
        .why-item p,
        .service-card p {
            color: #37474f;
        }

        .testimonial-card h6,
        .why-item h6,
        .service-card h5 {
            color: #0d47a1;
        }

        /* تأثيرات خفيفة للبطاقات */
        .testimonial-card:hover,
        .why-item:hover,
        .service-card:hover {
            transform: translateY(-2px);
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body>

    <!-- الكود الأصلي يبقى كما هو -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand brand-wrap" href="#">
                <div class="logo-container">
                    <div class="logo-icon">
                        <svg viewBox="0 0 100 100" width="50" height="50" class="logo-svg">
                            <defs>
                                <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#ffb703;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#2196f3;stop-opacity:1" />
                                </linearGradient>
                                <filter id="glow">
                                    <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                                    <feMerge>
                                        <feMergeNode in="coloredBlur"/>
                                        <feMergeNode in="SourceGraphic"/>
                                    </feMerge>
                                </filter>
                            </defs>
                            <circle cx="50" cy="50" r="45" fill="url(#logoGradient)" opacity="0.1"/>
                            <circle cx="50" cy="50" r="40" fill="none" stroke="url(#logoGradient)" stroke-width="2" opacity="0.3"/>
                            <text x="30" y="35" font-size="16" fill="url(#logoGradient)" font-weight="bold">+</text>
                            <text x="65" y="35" font-size="16" fill="url(#logoGradient)" font-weight="bold">-</text>
                            <text x="30" y="65" font-size="16" fill="url(#logoGradient)" font-weight="bold">×</text>
                            <text x="65" y="65" font-size="16" fill="url(#logoGradient)" font-weight="bold">÷</text>
                            <text x="50" y="55" font-size="24" fill="url(#logoGradient)" font-weight="bold" text-anchor="middle" filter="url(#glow)">M</text>
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

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="قائمة التنقل">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#about">عن المنصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">خدماتنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="#why">ماذا يميزنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="#register">التسجيل</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">تواصل</a></li>
                </ul>
                <div class="d-flex nav-actions gap-2">
                    <a class="btn btn-login" href="{{ route('mathplay.signin') }} ">تسجيل الدخول</a>
                    <a class="btn btn-cta" href="{{ route('mathplay.signup') }}">إنشاء حساب</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="tilt">
                        <div class="tilt-item">
                            <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1200&auto=format&fit=crop" alt="أطفال في المدرسة يدرسون ويكتبون">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h1 class="title wavy-underline">مرحبًا بكم في منصتنا التعليمية</h1>
                    <h2 class="hero-brand">Math&Play</h2>
                    <p class="subtitle">تعلّم الرياضيات بأسلوب ممتع ومرح للأطفال من **الصف الأول حتى الصف الرابع** — فيديوهات، اختبارات قصيرة، وألعاب تفاعلية تجعل التعلم مغامرة رائعة!</p>
                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <a href="#services" class="btn btn-solid">اكتشف خدماتنا</a>
                        <a href="{{ route('mathplay.signup') }}" class="btn btn-ghost">ابدأ الآن</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-5 about-section">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 reveal">
                    <img class="img-fluid rounded-4 shadow" src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1200&auto=format&fit=crop" alt="أطفال في المدرسة يتعلمون الرياضيات">
                </div>
                <div class="col-md-6 reveal">
                    <h2 class="section-title wavy-underline">عن المنصة</h2>
                    <p>منصة <strong>Math&Play</strong> صُمّمت لتجعل الرياضيات رحلة ممتعة مليئة بالتشويق والاكتشاف، بعيدًا عن الطرق التقليدية المملة.</p>
                    <p>نوفر مسارات مناسبة للأعمار من الصف الأول حتى الرابع، مع تجارب تفاعلية تقيس تقدم طفلك وتحمّسه للتعلم.</p>
                    <a href="{{ route('mathplay.signup') }}" class="btn btn-solid mt-2">سجل لطفلك الآن</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="services">
        <div class="container">
            <h2 class="section-title text-center wavy-underline">خدماتنا</h2>
            <p class="text-center lead" style="font-family: 'Cairo', sans-serif; color: #374151; line-height: 1.7; margin: 1rem 0;">
                🎓 محتوى متنوع يناسب مراحل
                <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800; padding: 2px 4px;">
                    الصف الأول والثاني والثالث والرابع
                </span>
            </p>
            <div class="row g-4 justify-content-center">
                <div class="col-sm-8 col-md-6 col-lg-4 reveal">
                    <div class="service-card">
                        <div class="icon-wrap"><img src="https://cdn-icons-png.flaticon.com/512/3062/3062634.png" alt=""></div>
                        <h5>فيديوهات تعليمية</h5>
                        <p>شاهد فيديوهات تعليمية ممتعة ومبسطة لكل درس.</p>
                    </div>
                </div>

                <div class="col-sm-8 col-md-6 col-lg-4 reveal">
                    <div class="service-card">
                        <div class="icon-wrap"><img src="https://cdn-icons-png.flaticon.com/512/3179/3179065.png" alt=""></div>
                        <h5>اختبارات قصيرة</h5>
                        <p>اختبارات سريعة لقياس فهم الطفل بطريقة ممتعة.</p>
                    </div>
                </div>

                <div class="col-sm-8 col-md-6 col-lg-4 reveal">
                    <div class="service-card">
                        <div class="icon-wrap"><img src="https://cdn-icons-png.flaticon.com/512/685/685352.png" alt=""></div>
                        <h5>ألعاب تعليمية</h5>
                        <p>ألعاب تفاعلية تساعد الأطفال على التعلم بالمرح.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="why" class="why-us">
        <div class="container">
            <h2 class="section-title text-center wavy-underline">ماذا يميزنا</h2>
            <div class="row g-4">
                <div class="col-md-6 reveal"><div class="why-item"><div class="why-bullet">1</div><div><h6 class="mb-1">محتوى تفاعلي ممتع</h6><p class="mb-0">ألعاب وتمارين مصممة لتحويل مفاهيم الرياضيات إلى تجربة لعب واكتشاف.</p></div></div></div>
                <div class="col-md-6 reveal"><div class="why-item"><div class="why-bullet">2</div><div><h6 class="mb-1">مسارات تناسب كل مرحلة</h6><p class="mb-0">خطط تعلم من الصف الأول إلى الرابع مع متابعة للتقدم.</p></div></div></div>
                <div class="col-md-6 reveal"><div class="why-item"><div class="why-bullet">3</div><div><h6 class="mb-1">تقارير فورية لولي الأمر</h6><p class="mb-0">اعرف نقاط القوة ومجالات التحسين لطفلك في لحظتها.</p></div></div></div>
                <div class="col-md-6 reveal"><div class="why-item"><div class="why-bullet">4</div><div><h6 class="mb-1">واجهة عربية بسيطة</h6><p class="mb-0">تصميم طفولي لطيف بألوان مبهجة وتجربة استخدام سهلة.</p></div></div></div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="py-5 testimonials-section">
        <div class="container">
            <h2 class="section-title text-center wavy-underline">ماذا يقول أولياء الأمور عنا؟</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-sm-8 col-md-6 col-lg-4 reveal">
                    <div class="testimonial-card p-4 rounded-4 shadow">
                        <div class="d-flex align-items-center mb-3">
                            <div class="testimonial-avatar ms-3 testimonial-avatar-1">س</div>
                            <div>
                                <h6 class="mb-0">سارة أحمد</h6>
                                <small class="text-muted">والدة طالبة صف ثالث</small>
                            </div>
                        </div>
                        <p class="mb-0">منصة رائعة! ابنتي أصبحت تحب الرياضيات أكثر بفضل الدروس القصيرة والألعاب التفاعلية.</p>
                    </div>
                </div>
                <div class="col-sm-8 col-md-6 col-lg-4 reveal">
                    <div class="testimonial-card p-4 rounded-4 shadow">
                        <div class="d-flex align-items-center mb-3">
                            <div class="testimonial-avatar ms-3 testimonial-avatar-2">م</div>
                            <div>
                                <h6 class="mb-0">محمد علي</h6>
                                <small class="text-muted">والد طالب صف رابع</small>
                            </div>
                        </div>
                        <p class="mb-0">الاختبارات القصيرة سريعة وواضحة، لاحظت تحسن ملحوظ في مستوى ابني خلال شهر.</p>
                    </div>
                </div>
                <div class="col-sm-8 col-md-6 col-lg-4 reveal">
                    <div class="testimonial-card p-4 rounded-4 shadow">
                        <div class="d-flex align-items-center mb-3">
                            <div class="testimonial-avatar ms-3 testimonial-avatar-3">ل</div>
                            <div>
                                <h6 class="mb-0">لينا يوسف</h6>
                                <small class="text-muted">والدة طالبة صف أول</small>
                            </div>
                        </div>
                        <p class="mb-0">واجهة سهلة الاستخدام ومحتوى ممتع للأطفال. شكراً لكم على هذا العمل الرائع!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="register" class="register">
        <div class="container">
            <h2 class="section-title text-center wavy-underline">سجّل بالموقع</h2>
            <p class="lead">إذا أعجبك موقعنا تفضل بالتسجيل معنا لابنك/أبنائك في منصتنا <strong>Math&Play</strong>.</p>
            <div class="btn-group-cta">
                <a href="{{ route('mathplay.signin') }}" class="btn btn-ghost px-4 py-2">تسجيل الدخول</a>
                <a href="{{ route('mathplay.signup') }}" class="btn btn-solid px-4 py-2">أنشئ حساب</a>
            </div>
        </div>
    </section>

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
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                        </a>

                        <a href="#" aria-label="Instagram" title="إنستغرام">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>

                        <a href="#" aria-label="Facebook" title="فيسبوك">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="#1877F2">
                                <path d="M22 12a10 10 0 1 0-11.6 9.9v-7h-2.3V12h2.3V9.7c0-2.3 1.4-3.6 3.5-3.6 1 0 2 .2 2 .2v2.2H14c-1.1 0-1.4.7-1.4 1.4V12h2.4l-.4 2.9H12.6v7A10 10 0 0 0 22 12"/>
                            </svg>
                        </a>

                        <a href="#" aria-label="LinkedIn" title="لينكد إن">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="#0A66C2">
                                <path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM0 8h5v16H0zM8 8h4.8v2.2h.1c.7-1.2 2.5-2.5 5.2-2.5 5.6 0 6.7 3.7 6.7 8.5V24h-5V17.2c0-1.6 0-3.8-2.3-3.8s-2.7 1.8-2.7 3.7V24H8z"/>
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

    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- باقي السكريبتات تبقى كما هي -->
    <script>
        // Safety: only run if element exists
        try {
            const yearEl = document.getElementById('year');
            if (yearEl) yearEl.textContent = new Date().getFullYear();
        } catch(e){ console.warn('year set error', e); }

        // Tilt effect (guarded)
        try {
            const tiltItem = document.querySelector('.tilt .tilt-item');
            if (tiltItem) {
                const maxTilt = 10;
                tiltItem.addEventListener('mousemove', (e) => {
                    const rect = tiltItem.getBoundingClientRect();
                    const x = e.clientX - rect.left, y = e.clientY - rect.top;
                    const cx = x / rect.width - .5, cy = y / rect.height - .5;
                    tiltItem.style.transform = `rotateY(${cx * maxTilt}deg) rotateX(${ -cy * maxTilt }deg)`;
                    tiltItem.style.boxShadow = `0 18px 40px rgba(0,0,0,.15)`;
                });
                tiltItem.addEventListener('mouseleave', () => {
                    tiltItem.style.transform = '';
                    tiltItem.style.boxShadow = '';
                });
            }
        } catch(e) { console.warn('tilt error', e); }

        // Reveal on scroll (guarded)
        try {
            const revealEls = document.querySelectorAll('.reveal');
            if (revealEls && revealEls.length) {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach(en => {
                        if (en.isIntersecting) { en.target.classList.add('show'); io.unobserve(en.target); }
                    });
                }, { threshold: .18 });
                revealEls.forEach(el => io.observe(el));
            }
        } catch(e) { console.warn('reveal error', e); }

        // Enhanced Footer Icons Animation
        try {
            const footerIcons = document.querySelectorAll('.footer-icons a');
            footerIcons.forEach(icon => {
                icon.style.transition = 'transform 0.3s ease';
                icon.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-6px) scale(1.1) rotate(5deg)';
                });

                icon.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1) rotate(0deg)';
                });

                icon.addEventListener('click', function(e) {
                    e.preventDefault();
                    this.style.transform = 'translateY(-6px) scale(1.2) rotate(10deg)';
                    setTimeout(() => {
                        this.style.transform = 'translateY(-6px) scale(1.1) rotate(5deg)';
                    }, 150);
                });
            });
        } catch(e) { console.warn('footer icons error', e); }
    </script>
</body>
</html>