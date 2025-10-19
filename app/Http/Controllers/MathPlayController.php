<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as RoutingController;

class MathPlayController extends RoutingController
{
    public function index()
    {
        // منطق الدالة هنا
        return view('index');
    }
    //هاي عشان نبعت المعلومات عالفورم
    function edit(){
         $user = Auth::user();
        return view('edit_student', compact('user'));
    }
    //هاي عشان نعدل المعلومات هاي من الفورم باتجاه قاعدة البيانات
    public function update(Request $request)
    {
        // 1. ✅ التحقق من صحة البيانات الجديدة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'required|string|min:8|confirmed', // 'confirmed' يتطلب حقل تأكيد كلمة المرور
            'grade_id' => 'required|integer|exists:grades,id', // 'exists' يتأكد من وجود الـ ID في جدول grades
        ]);

        // 2. ✅ الأمان: الحصول على المستخدم المسجل دخوله مباشرة
        $user = Auth::user();

        // 3. ✅ تجزئة كلمة المرور الجديدة قبل التحديث
        $validatedData['password'] = Hash::make($validatedData['password']);

        // 4. ✅ تحديث بيانات المستخدم الحالي باستخدام البيانات المصدّقة
        $user->update($validatedData);

        // 5. إعادة التوجيه إلى الصفحة الرئيسية مع رسالة نجاح
        return redirect()->route('mathplay.index')->with('success', 'تم تحديث بياناتك بنجاح!');
    }

    function reports($id){
        // 1. الحصول على الـ ID للمستخدم المسجل دخوله
        $userId = Auth::id();
        $user = User::with('examResult.unit')->findOrFail($user_id);
        return view('reports.blade.php', [
            'examResults' => $user->examResults
        ]);
    }

    //public function signin()
    //{
        // منطق تسجيل الدخول
    //    return view('signin');
    //}

    //public function signup()
    //{
        // منطق التسجيل
    //    return view('signup');
    //}
}
