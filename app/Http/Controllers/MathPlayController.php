<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ExamResults;
use App\Models\Unit;
use App\Models\User;


/**
 * MathPlayController
 *
 * هذا المتحكم مسؤول عن إدارة صفحات تطبيق MathPlay
 * يتضمن وظائف للصفحة الرئيسية، تسجيل الدخول، تعديل معلومات الطالب، وعرض العلامات.
 */
class MathPlayController extends Controller
{
    // الصفحة الرئيسية العامة
    public function index()
    {
        return view('mathplay.index');
    }

    // الصفحة الرئيسية للطالب بعد تسجيل الدخول
    public function home()
    {
        $user = Auth::user();

        // جلب كل الوحدات الخاصة بالصف الخاص بالمستخدم
        $unitsQuery = \App\Models\Unit::with('semester')
            ->where('grade_id', $user->grade_id)
            ->orderBy('semester_id')
            ->orderBy('id');

        $units = $unitsQuery->get()->groupBy('semester_id'); // نجمع الوحدات حسب الفصل

        return view('mathplay.home', compact('user', 'units'));
    }
public function getLessonsByUnit($unit)
{
    try {
        $lessons = \App\Models\Lesson::where('unit_id', $unit)->get();

        return response()->json([
            'lessons' => $lessons
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'lessons' => [],
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function editStudent()
    {
        $user = Auth::user(); // المستخدم الحالي
        return view('mathplay.edit_student', compact('user'));
    }

    public function updateStudent(Request $request)
    {
        $user = Auth::user();

        // تحقق من الحقول الأساسية
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'grade_id' => 'required|exists:grades,id',
            'gender' => 'required|in:male,female',
            'password' => 'nullable|string|min:6|confirmed', // <-- هذا يتأكد من كلمة المرور
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->grade_id = $request->grade_id;
        $user->gender = $request->gender;

        // إذا تم إدخال كلمة مرور جديدة
        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('mathplay.home')->with('success', 'تم تحديث البيانات بنجاح!');
    }

    // عرض علامات الطالب
    public function marks()
{
    $user = Auth::user();

    // جلب جميع النتائج للطالب مع معلومات الوحدة
    $results = ExamResults::with('unit')
                ->where('user_id', $user->id)
                ->get();

    return view('mathplay.marks', compact('user', 'results'));
}
    // صفحات الألعاب
    // public function games() {
    //    return view('mathplay.games');
    // }

    // صفحات الاختبارات
    // public function tests() {
    //    return view('mathplay.tests');
    // }
}
