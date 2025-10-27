<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('mathplay.signin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();
        $today = now()->startOfDay(); // بداية اليوم
        $lastLogin = \Carbon\Carbon::parse($user->last_login_at)->startOfDay();

        // تحديث streak
        if ($lastLogin) {
            $diff = $today->diffInDays($lastLogin);
            if ($diff === 1) {
                // اليوم التالي → زيادة السلسلة
                $user->streak_days += 1;
            } elseif ($diff > 1) {
                // انقطع streak
                $user->streak_days = 1;
            }
            // diff === 0 → نفس اليوم → لا تغير
        } else {
            // أول مرة تسجيل دخول
            $user->streak_days = 1;
        }

        // تحديث آخر وقت دخول
        $user->last_time_logged_in = now();
        $user->save();

        $request->session()->regenerate();

        return redirect()->route('mathplay.home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        // تسجيل الخروج
        Auth::logout();

        // إبطال الجلسة الحالية وتوليد توكن جديد للحماية
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // إعادة التوجيه للصفحة الرئيسية العامة بعد تسجيل الخروج
        return redirect()->route('mathplay.home');
    }
}
