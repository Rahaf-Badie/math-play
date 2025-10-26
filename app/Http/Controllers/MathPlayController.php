<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MathPlayController extends Controller
{
    // الصفحة الرئيسية العامة
    public function index() {
        return view('mathplay.index');
    }

    // الصفحة الرئيسية للطالب بعد تسجيل الدخول
    public function home() {
        $user = Auth::user(); // المستخدم الحالي
        return view('mathplay.home', compact('user'));
    }

    // تعديل معلومات الطالب - صفحة عرض
    public function editStudent() {
        $user = Auth::user();
        return view('mathplay.edit_student', compact('user'));
    }

    // تعديل معلومات الطالب - حفظ البيانات
    public function updateStudent(Request $request) {
        $user = Auth::user();
        $user->update($request->only(['name', 'email'])); // أضف أي حقول أخرى حسب الحاجة
        return redirect()->route('mathplay.home')->with('success', 'تم تعديل البيانات بنجاح');
    }

    // عرض علامات الطالب
    public function marks() {
        $user = Auth::user();
        // $marks = ... اجلب علامات الطالب من جدول الدرجات
        return view('mathplay.marks', compact('user')); // أضف $marks إذا كانت موجودة
    }

    // صفحات الألعاب
    //public function games() {
    //    return view('mathplay.games');
    //}

    // صفحات الاختبارات
    //public function tests() {
    //    return view('mathplay.tests');
    //}
}
