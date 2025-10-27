<?php
$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تعديل بيانات الطالب</title>
<style>
    body { font-family: Arial; background:#f5f5f5; padding:20px; }
    .container { max-width:600px; margin:auto; background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
    h2 { text-align:center; margin-bottom:20px; }
    label { display:block; margin-top:15px; font-weight:bold; }
    input[type="text"], input[type="email"], input[type="password"], select {
        width:100%; padding:8px; margin-top:5px; border-radius:5px; border:1px solid #ccc; box-sizing:border-box;
    }
    .btn-group { display:flex; gap:10px; margin-top:20px; }
    button { flex:1; padding:10px; border:none; border-radius:5px; font-size:16px; cursor:pointer; }
    .btn-save { background:#4CAF50; color:white; }
    .btn-save:hover { background:#45a049; }
    .btn-back { background:#ccc; color:#333; }
    .btn-back:hover { background:#bbb; }
    .error-msg { color:red; margin-top:5px; display:none; font-size:14px; }
</style>
</head>
<body>

<div class="container">
<h2>تعديل بيانات الطالب</h2>

@if($user)
<form method="POST" action="{{ route('mathplay.update_student') }}" id="editForm">
    @csrf
    <label>الاسم:</label>
    <input type="text" name="name" value="{{ $user->name }}" required>

    <label>البريد الإلكتروني:</label>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <label>الصف:</label>
    <select name="grade_id" required>
        @foreach(\App\Models\Grade::all() as $grade)
            <option value="{{ $grade->id }}" {{ $grade->id == $user->grade_id ? 'selected' : '' }}>
                {{ $grade->name }}
            </option>
        @endforeach
    </select>

    <label>الجنس:</label>
    <select name="gender" required>
        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>ذكر</option>
        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>أنثى</option>
    </select>

    <label>كلمة المرور (لتغييرها فقط):</label>
    <div id="password-error" class="error-msg"></div>
    <input type="password" name="password" id="password" placeholder="كلمة المرور الجديدة">
    
    <div id="password-confirm-error" class="error-msg"></div>
    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="تأكيد كلمة المرور">

    <div class="btn-group">
        <button type="submit" class="btn-save">حفظ التغييرات</button>
        <button type="button" class="btn-back" onclick="window.location='{{ route('mathplay.home') }}'">الرجوع للصفحة الرئيسية</button>
    </div>
</form>
@else
<p>خطأ: بيانات الطالب غير متوفرة. يرجى تسجيل الدخول.</p>
@endif
</div>

<script>
const form = document.getElementById('editForm');
const password = document.getElementById('password');
const passwordConfirm = document.getElementById('password_confirmation');
const passError = document.getElementById('password-error');
const confirmError = document.getElementById('password-confirm-error');

function validatePasswords() {
    let valid = true;

    // تحقق إذا كان الحقل فارغ
    if(password.value === "" && passwordConfirm.value !== "") {
        passError.style.display = 'block';
        passError.textContent = "كلمة المرور فارغة!";
        valid = false;
    } else {
        passError.style.display = 'none';
    }

    if(passwordConfirm.value === "" && password.value !== "") {
        confirmError.style.display = 'block';
        confirmError.textContent = "تأكيد كلمة المرور فارغ!";
        valid = false;
    } else {
        confirmError.style.display = 'none';
    }

    // تحقق من التطابق
    if(password.value && passwordConfirm.value && password.value !== passwordConfirm.value) {
        confirmError.style.display = 'block';
        confirmError.textContent = "كلمة المرور وتأكيدها غير متطابقين!";
        valid = false;
    }

    return valid;
}

// تحقق فوري أثناء الكتابة
password.addEventListener('input', validatePasswords);
passwordConfirm.addEventListener('input', validatePasswords);

// عند الإرسال
form.addEventListener('submit', function(e) {
    if(!validatePasswords()) {
        e.preventDefault();
    }
});
</script>

</body>
</html>
