<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>نسيت كلمة المرور | Math&Play</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Lalezar&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

  <!-- NAV -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand brand-wrap" href="{{ route('mathplay.index') }}">
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
          <li class="nav-item"><a class="nav-link" href="{{ route('mathplay.index') }}#about">عن المنصة</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('mathplay.index') }}#services">خدماتنا</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('mathplay.index') }}#why">ماذا يميزنا</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('mathplay.index') }}#register">التسجيل</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('mathplay.index') }}#contact">تواصل</a></li>
        </ul>
        <div class="d-flex nav-actions gap-2">
          <a class="btn btn-login active" href="{{ route('mathplay.signin') }}">تسجيل الدخول</a>
          <a class="btn btn-cta" href="{{ route('mathplay.signup') }}">إنشاء حساب</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Forgot Password Section -->
  <section class="login-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-9">
          <div class="login-container">
            <div class="login-header">
              <h2 class="login-title wavy-underline">نسيت كلمة المرور؟</h2>
              <p class="login-subtitle">أدخل بريدك الإلكتروني وسنرسل لك رابط إعادة تعيين كلمة المرور</p>
    </div>

    <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني
                </div>
            @endif

            <!-- Breeze Form -->
            <form method="POST" action="{{ route('password.email') }}" class="login-form">
        @csrf

              <div class="form-group">
                <label class="form-label" for="email">البريد الإلكتروني</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="أدخل بريدك الإلكتروني">
                @error('email')
                  <div class="error">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-login-submit">
                <span>إرسال رابط تغيير كلمة المرور</span>
                <div class="btn-loading" style="display:none;">
                  <div class="spinner"></div>
                </div>
              </button>

              <div class="login-footer text-center">
                <p class="signup-link">تذكرت كلمة المرور؟ <a href="{{ route('mathplay.signin') }}">تسجيل الدخول</a></p>
              </div>
            </form>
            <!-- End Breeze Form -->

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
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

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    try {
      const yearEl = document.getElementById('year');
      if(yearEl) yearEl.textContent = new Date().getFullYear();
    } catch(e){ console.warn(e); }

    try {
      const footerIcons = document.querySelectorAll('.footer-icons a');
      footerIcons.forEach(icon => {
        icon.addEventListener('mouseenter', () => icon.style.transform = 'translateY(-6px) scale(1.1) rotate(5deg)');
        icon.addEventListener('mouseleave', () => icon.style.transform = 'translateY(0) scale(1) rotate(0deg)');
        icon.addEventListener('click', e => {
          e.preventDefault();
          icon.style.transform = 'translateY(-6px) scale(1.2) rotate(10deg)';
          setTimeout(() => icon.style.transform = 'translateY(-6px) scale(1.1) rotate(5deg)', 150);
        });
      });
    } catch(e){ console.warn(e); }

    try {
      const loginForm = document.querySelector('.login-form');
      const submitBtn = document.querySelector('.btn-login-submit');
      const loadingSpinner = document.querySelector('.btn-loading');

      if(loginForm && submitBtn){
        loginForm.addEventListener('submit', () => {
          if(loadingSpinner) loadingSpinner.style.display = 'block';
          submitBtn.querySelector('span').style.opacity = '0';
        });
      }
    } catch(e){ console.warn(e); }

    try {
      const formInputs = document.querySelectorAll('.form-control');
      formInputs.forEach(input => {
        input.addEventListener('focus', () => input.parentElement.classList.add('focused'));
        input.addEventListener('blur', () => { if(!input.value) input.parentElement.classList.remove('focused'); });
      });
    } catch(e){ console.warn(e); }
  </script>

</body>
</html>
