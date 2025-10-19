{{-- resources/views/student_grades.blade.php --}}
<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>عرض بيانات الطالب</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 12px; }
        h3 { font-weight: bold; }
    </style>
</head>
<body>
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center mb-4">الطالب: {{ $user->name }}</h3>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th>التقديرات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($marks as $mark)
                                        <tr>
                                            <td>{{ $request->mark }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>لا توجد تقديرات</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
