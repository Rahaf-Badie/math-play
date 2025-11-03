<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أنجزت الاختبار بالفعل | Math&Play</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Lalezar&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            font-family: "Cairo", sans-serif;
        }

        .completion-section {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px 20px;
        }

        .completion-card {
            background: white;
            border-radius: 25px;
            padding: 50px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 3px solid transparent;
            background-clip: padding-box;
            position: relative;
            overflow: hidden;
            max-width: 600px;
            width: 100%;
        }

        .completion-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #ffb703, #2196f3, #00b894, #ff7675);
        }

        .completion-icon {
            font-size: 80px;
            margin-bottom: 25px;
            animation: bounce 2s infinite;
        }

        .completion-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #ffb703, #2196f3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .completion-message {
            font-size: 1.3rem;
            color: #4a5568;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .completion-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .completion-btn {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary-custom {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
        }

        .completion-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .confetti {
            position: fixed;
            width: 15px;
            height: 15px;
            opacity: 0;
            z-index: 1000;
            pointer-events: none;
        }

        .floating-stars {
            position: absolute;
            font-size: 24px;
            opacity: 0;
            animation: float 3s ease-in-out infinite;
        }

        .star-1 { top: 10%; left: 10%; animation-delay: 0s; }
        .star-2 { top: 20%; right: 15%; animation-delay: 0.5s; }
        .star-3 { bottom: 30%; left: 20%; animation-delay: 1s; }
        .star-4 { bottom: 15%; right: 25%; animation-delay: 1.5s; }
        .star-5 { top: 40%; left: 30%; animation-delay: 2s; }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 183, 3, 0.7);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(255, 183, 3, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 183, 3, 0);
            }
        }

        .pulse-effect {
            animation: pulse 2s infinite;
        }

        .achievement-badge {
            background: linear-gradient(135deg, #ffe08a, #ffb703);
            color: #0b3a66;
            border-radius: 50px;
            padding: 15px 25px;
            font-weight: 800;
            margin: 20px auto;
            display: inline-block;
            box-shadow: 0 8px 20px rgba(255, 183, 3, 0.3);
        }

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

    <!-- Completion Section -->
    <section class="completion-section">
        <div class="container">
            <div class="completion-card pulse-effect">
                <!-- Floating Stars -->
                <div class="floating-stars star-1">⭐</div>
                <div class="floating-stars star-2">🌟</div>
                <div class="floating-stars star-3">✨</div>
                <div class="floating-stars star-4">🎉</div>
                <div class="floating-stars star-5">🏆</div>

                <div class="completion-icon">🎓</div>

                <h1 class="completion-title">مبروك! لقد أنجزت الاختبار</h1>

                <div class="achievement-badge">
                    🏅 إنجاز رائع!
                </div>

                <p class="completion-message">
                    لقد أتممت الاختبار بنجاح! هذا إنجاز رائع يستحق التقدير.<br>
                    استمر في التعلم والتحدي، فأنت على الطريق الصحيح نحو التميز.
                </p>

                <div class="completion-actions">
                    <a href="{{ route('mathplay.home') }}" class="completion-btn btn-primary-custom">
                        🏠 العودة للصفحة الرئيسية
                    </a>
                    <a href="{{ route('mathplay.lesson') }}" class="completion-btn btn-secondary-custom">
                        📚 متابعة الدروس
                    </a>
                </div>
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

    <script>
        // تأثير الكونفيتي الاحتفالي
        function createConfetti() {
            const colors = ['#ffb703', '#2196f3', '#00b894', '#ff7675', '#667eea', '#fbc531'];

            for (let i = 0; i < 150; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = '-20px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = Math.random() * 15 + 5 + 'px';
                confetti.style.height = Math.random() * 15 + 5 + 'px';
                confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                confetti.style.opacity = '1';

                document.body.appendChild(confetti);

                const animation = confetti.animate([
                    {
                        transform: 'translateY(0) rotate(0deg)',
                        opacity: 1
                    },
                    {
                        transform: `translateY(${window.innerHeight + 100}px) rotate(${Math.random() * 720}deg)`,
                        opacity: 0
                    }
                ], {
                    duration: Math.random() * 3000 + 2000,
                    easing: 'cubic-bezier(0.1, 0.8, 0.3, 1)'
                });

                animation.onfinish = () => confetti.remove();
            }
        }

        // تأثيرات إضافية عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            // إطلاق الكونفيتي بعد تحميل الصفحة
            setTimeout(createConfetti, 500);

            // إطلاق كونفيتي إضافي كل 3 ثواني
            setInterval(createConfetti, 3000);

            // تعيين السنة الحالية في التذييل
            document.getElementById('year').textContent = new Date().getFullYear();

            // تأثير اهتزاز خفيف للبطاقة
            const card = document.querySelector('.completion-card');
            setInterval(() => {
                card.style.transform = 'translateY(-5px)';
                setTimeout(() => {
                    card.style.transform = 'translateY(0)';
                }, 200);
            }, 4000);
        });
    </script>
</body>
</html>
