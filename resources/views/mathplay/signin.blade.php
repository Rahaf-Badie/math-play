<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول | Math&Play</title>

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

  <!-- Login Section -->
  <section class="login-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-9">
          <div class="login-container">
            <div class="login-header">
              <h2 class="login-title wavy-underline">تسجيل الدخول</h2>
              <p class="login-subtitle">مرحباً بك في منصة Math&Play التعليمية</p>
            </div>

            <!-- Breeze Form -->
            <form method="POST" action="{{ route('login') }}" class="login-form">
              @csrf

              <div class="form-group">
                <label class="form-label" for="email">البريد الإلكتروني</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                  <div class="error">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" id="password" class="form-control" name="password" required autocomplete="current-password">
                @error('password')
                  <div class="error">{{ $message }}</div>
                @enderror
              </div>

              <div class="block mt-4 remember">
                <label for="remember_me" class="inline-flex items-center">
                  <input id="remember_me" type="checkbox" class="rounded" name="remember">
                  <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">تذكرني</span>
                </label>
                @if (Route::has('password.request'))
                  <a class="forgot-password-link" href="{{ route('password.request') }}">
                    نسيت كلمة المرور؟
                  </a>
                @endif
              </div>

              <button type="submit" class="btn btn-login-submit">
                <span>تسجيل الدخول</span>
                <div class="btn-loading" style="display:none;">
                  <div class="spinner"></div>
                </div>
              </button>

              <div class="login-footer text-center">
                <p class="signup-link">ليس لديك حساب؟ <a href="{{ route('mathplay.signup') }}">إنشاء حساب جديد</a></p>
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
            <!-- جميع أيقونات SVG الأصلية محفوظة -->
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
          loadingSpinner.style.display = 'block';
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
