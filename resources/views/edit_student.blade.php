<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نموذج تسجيل الطالب</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body { background-color: #f8f9fa; }
      .card { border-radius: 12px; }
      .form-label { font-weight: 600; }
    </style>
  </head>
  <body>
    <main class="d-flex align-items-center justify-content-center vh-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
              <div class="card-body p-4">
                <h3 class="card-title mb-3 text-center">نمـوذج تسجيل الطالـب</h3>
                <p class="text-center text-muted small">يرجى تعبئة الحقول أدناه ثم الضغط على زر التسجيل</p>

                <form id="studentForm" class="needs-validation" novalidate>
                  <!-- اسم الطالب -->
                  <div class="mb-3">
                    <label for="name" class="form-label">اسم الطالب</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسم الطالب" required>
                    <div class="invalid-feedback">الرجاء إدخال اسم الطالب.</div>
                  </div>

                  <!-- البريد الالكتروني -->
                  <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" required>
                    <div class="invalid-feedback">الرجاء إدخال بريد إلكتروني صالح.</div>
                  </div>

                  <!-- كلمة المرور -->
                  <div class="mb-3">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password" placeholder="أدخل كلمة المرور" minlength="6" required>
                      <button type="button" class="btn btn-outline-secondary" id="togglePassword" aria-label="إظهار كلمة المرور">إظهار</button>
                      <div class="invalid-feedback">الرجاء إدخال كلمة مرور (6 أحرف على الأقل).</div>
                    </div>
                  </div>

                  <!-- الصف -->
                  <div class="mb-4">
                    <label for="grade" class="form-label">الصف</label>
                    <select class="form-select" id="grade" name="grade" required>
                      <option value="" selected disabled>اختر الصف</option>
                      <option value="1">الصف الأول</option>
                      <option value="2">الصف الثاني</option>
                      <option value="3">الصف الثالث</option>
                      <option value="4">الصف الرابع</option>
                    </select>
                    <div class="invalid-feedback">الرجاء اختيار صف.</div>
                  </div>

                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary">تسجيل</button>
                  </div>
                </form>

                <hr>
                <p class="small text-muted mb-0">هذه الصفحة تعمل بدون خادم — اضغط على "تسجيل" لاختبار التحقق من المدخلات. يمكنك توصيلها بأي backend لاحقاً.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // تفعيل عرض/إخفاء كلمة المرور
      const toggleBtn = document.getElementById('togglePassword');
      const pwdInput = document.getElementById('password');
      toggleBtn.addEventListener('click', () => {
        const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
        pwdInput.setAttribute('type', type);
        toggleBtn.textContent = type === 'password' ? 'إظهار' : 'إخفاء';
      });

      // التحقق من الفورم (Bootstrap validation)
      (function () {
        'use strict'
        const form = document.getElementById('studentForm');
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          } else {
            event.preventDefault(); // منع الإرسال الافتراضي في المثال
            // هنا يمكنك وضع طلب fetch لإرسال البيانات للـ backend
            const data = {
              name: form.name.value.trim(),
              email: form.email.value.trim(),
              password: form.password.value,
              grade: form.grade.value
            };
            // مؤقت: عرض بيانات الإدخال في نافذة منبثقة صغيرة
            alert('تم التحقق من البيانات:\n' + JSON.stringify(data, null, 2));
          }
          form.classList.add('was-validated');
        }, false);
      })();
    </script>
  </body>
</html>
