<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * عرض صفحة التسجيل.
     */
    public function create(): View
    {
        return view('mathplay.signup'); // واجهة تسجيل الطالب
    }

    /**
     * معالجة التسجيل الجديد.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    // الاسم يجب أن يكون رباعي (أربع كلمات على الأقل)
                    if (substr_count(trim($value), ' ') < 3) {
                        $fail('الاسم يجب أن يكون رباعي (أربع كلمات على الأقل).');
                    }
                },
            ],
            'grade_id' => ['required', 'integer'], // الصف الدراسي
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // إنشاء الطالب
        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'grade_id' => $request->grade_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // حدث التسجيل (لـ Laravel)
        event(new Registered($user));

        // تسجيل الدخول مباشرة بعد التسجيل
        Auth::login($user);

        // توجيه الطالب للصفحة الرئيسية الخاصة به
        return redirect()->route('mathplay.home');
    }
}
