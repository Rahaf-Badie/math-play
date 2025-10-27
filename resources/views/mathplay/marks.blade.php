<?php
$user = Auth::user(); // الطالب الحالي
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>علامات الطالب</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { font-family: Arial, sans-serif; background:#f5f5f5; padding:20px; }
    .container { max-width:800px; margin:auto; background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
    h2 { text-align:center; margin-bottom:20px; }
    .grade { font-weight:bold; color:#4CAF50; }
</style>
</head>
<body>

<div class="container">
    <h2>علامات الطالب</h2>

    @if($user)
    <div class="mb-4 p-3 bg-light rounded">
        <p><strong>الاسم:</strong> {{ $user->name }}</p>
        <p><strong>البريد الإلكتروني:</strong> {{ $user->email }}</p>
        <p><strong>الصف:</strong> {{ $user->grade->name ?? '-' }}</p>
        <p><strong>الجنس:</strong> {{ $user->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
    </div>

    <h4>العلامات حسب الوحدات:</h4>
    <ul class="list-group">
        @php
            $units = $user->grade ? $user->grade->units : [];
            $examResults = \App\Models\ExamResults::where('user_id', $user->id)->get();
        @endphp

        @forelse($units as $unit)
            @php
                $semester = \App\Models\Semester::find($unit->semester_id);
                $mark = $examResults->firstWhere('unit_id', $unit->id);
            @endphp
            <li class="list-group-item">
                {{ $semester ? $semester->name : 'بدون فصل' }} &rarr; {{ $unit->name }} &rarr; 
                <span class="grade">{{ $mark ? $mark->value : 'لم يتم الإدخال' }}</span>
            </li>
        @empty
            <li class="list-group-item">لا توجد وحدات لهذا الصف بعد.</li>
        @endforelse
    </ul>

    @else
        <p class="text-danger">خطأ: بيانات الطالب غير متوفرة. يرجى تسجيل الدخول.</p>
    @endif

</div>

</body>
</html>
