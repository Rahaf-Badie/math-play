<?php

namespace App\Http\Controllers;

use App\Models\ExamResults;
use App\Models\Lesson;
use App\Models\LessonGames;
use App\Models\Unit;
use App\Services\GeminiAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MathPlayController extends Controller
{
    public function index()
    {
        return view('mathplay.index');
    }

    public function home()
    {
        $user = Auth::user();
        $unitsQuery = \App\Models\Unit::with('semester')
            ->where('grade_id', $user->grade_id)
            ->orderBy('semester_id')
            ->orderBy('id');
        $units = $unitsQuery->get()->groupBy('semester_id');

        $lastLesson = null;
        $unitProgress = [];
        if (Auth::check()) {
            if ($user->last_lesson_id) {
                $lastLesson = Lesson::find($user->last_lesson_id);
            }
            foreach ($units->flatten() as $unit) {
                $unitProgress[$unit->id] = $this->calculateUnitProgress($unit->id);
            }
        }

        return view('mathplay.home', compact('user', 'units', 'lastLesson', 'unitProgress'));
    }

    public function getLessonsByUnit($unit)
    {
        try {
            $lessons = \App\Models\Lesson::where('unit_id', $unit)->get();

            return response()->json(['lessons' => $lessons]);
        } catch (\Exception $e) {
            return response()->json(['lessons' => [], 'error' => $e->getMessage()], 500);
        }
    }

    public function editStudent()
    {
        $user = Auth::user();

        return view('mathplay.edit_student', compact('user'));
    }

    public function updateStudent(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'grade_id' => 'required|exists:grades,id',
            'gender' => 'required|in:male,female',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->grade_id = $request->grade_id;
        $user->gender = $request->gender;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('mathplay.home')->with('success', 'تم تحديث البيانات بنجاح!');
    }

    public function marks()
    {
        $user = Auth::user();
        $results = ExamResults::with('unit')->where('user_id', $user->id)->get();

        return view('mathplay.marks', compact('user', 'results'));
    }

    public function showLesson($id)
    {
        $lesson = Lesson::findOrFail($id);

        if (Auth::check()) {
            Auth::user()->update([
                'last_lesson_id' => $lesson->id,
                'last_time_logged_in' => now(),
            ]);
        }

        $progressData = $this->calculateUnitProgress($lesson->unit_id);

        return view('mathplay.lesson', compact('lesson'))->with($progressData);
    }

    const MAX_QUESTIONS_PER_MINUTE = 5;

    const TRACKING_DURATION_MINUTES = 1;

    public function askQuestion(Request $request, GeminiAIService $aiService)
    {
        $newPrompt = $request->input('user_question');
        $key = 'gemini_limit_'.(Auth::check() ? Auth::id() : $request->ip());
        $currentCount = Cache::get($key, 0);

        if ($currentCount >= self::MAX_QUESTIONS_PER_MINUTE) {
            return response()->json([
                'error' => 'لقد تجاوزت الحد الأقصى للأسئلة المسموح بها (5 أسئلة في الدقيقة). حاول مجدداً لاحقاً.',
            ], 429);
        }

        $chatHistory = Session::get('gemini_chat_history', []);
        $newCount = $currentCount + 1;
        Cache::put($key, $newCount, now()->addMinutes(self::TRACKING_DURATION_MINUTES));

        try {
            $aiResponse = $aiService->getChatResponse($chatHistory, $newPrompt);

            $chatHistory[] = [
                'role' => 'user',
                'parts' => [['text' => $newPrompt]],
            ];

            $chatHistory[] = [
                'role' => 'model',
                'parts' => [['text' => $aiResponse]],
            ];

            Session::put('gemini_chat_history', $chatHistory);

            return response()->json([
                'response' => $aiResponse,
                'remaining_count' => self::MAX_QUESTIONS_PER_MINUTE - $newCount,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'حدث خطأ في معالجة طلبك.'], 500);
        }
    }

    public function play(LessonGames $lesson_game)
    {
        $settings = $lesson_game->gameSettings;

        return view('mathplay.games.'.$lesson_game->game->template_url, compact('lesson_game', 'settings'));
    }

    public function getLastLesson()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->last_lesson_id) {
                $lesson = Lesson::find($user->last_lesson_id);
                if ($lesson) {
                    return response()->json([
                        'lesson_id' => $lesson->id,
                        'lesson_name' => $lesson->name,
                        'course_name' => $lesson->unit->name ?? 'غير محدد',
                    ]);
                }
            }
        }

        return response()->json(null);
    }

    private function calculateUnitProgress($unitId)
    {
        try {
            $totalLessons = Lesson::where('unit_id', $unitId)->count();
            $completedLessons = 0;

            if (Auth::check() && Auth::user()->last_lesson_id) {
                $lastLesson = Lesson::find(Auth::user()->last_lesson_id);
                if ($lastLesson && $lastLesson->unit_id == $unitId) {
                    $completedLessons = Lesson::where('unit_id', $unitId)
                        ->where('id', '<=', $lastLesson->id)
                        ->count();
                }
            }

            $progressPercentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

            return [
                'totalLessons' => $totalLessons,
                'completedLessons' => $completedLessons,
                'progressPercentage' => $progressPercentage,
            ];
        } catch (\Exception $e) {
            return [
                'totalLessons' => 0,
                'completedLessons' => 0,
                'progressPercentage' => 0,
            ];
        }
    }

    public function startExam(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('mathplay.signin')->with('error', 'يجب تسجيل الدخول أولاً.');
        }

        // أولاً حاولي تأخذي الوحدة مباشرة
        $unitId = $request->unit_id;

        // أو استخرجيها من الدرس لو مش موجودة
        if (! $unitId && $request->lesson_id) {
            $lesson = Lesson::find($request->lesson_id);
            $unitId = $lesson ? $lesson->unit_id : null;
        }

        if (! $unitId) {
            return back()->with('error', 'لم يتم تحديد الوحدة.');
        }

        $unit = Unit::find($unitId);

        if (! $unit) {
            return back()->with('error', 'الوحدة غير موجودة.');
        }

        if (! $unit->exam_url) {
            return back()->with('error', 'لا يوجد اختبار لهذه الوحدة بعد 🚫');
        }

        // تحقق لو الطالب سبق حل الاختبار
        $existingResult = ExamResults::where('user_id', Auth::id())
            ->where('unit_id', $unit->id)
            ->first();

        if ($existingResult) {
            return view('mathplay.exams.already_done', [
                'score' => $existingResult->score,
                'unit' => $unit,
            ]);
        }

        $viewPath = 'mathplay.exams.'.$unit->exam_url;

        if (! view()->exists($viewPath)) {
            // إذا الملف غير موجود، عرض رسالة خطأ مفصلة
            return back()->with('error', "صفحة الاختبار غير موجودة: {$viewPath}. تأكد من اسم الملف.");
        }

        return view($viewPath, compact('unit'));
    }

    public function submitExam(Request $request)
    {
        try {
            $userId = Auth::id();
            if (! $userId) {
                return response()->json([
                    'success' => false,
                    'error' => 'المستخدم غير مسجل الدخول!',
                ], 401);
            }

            $request->validate([
                'unit_id' => 'required|exists:units,id',
                'score' => 'required|integer|min:0|max:20',
            ]);

            $unitId = $request->input('unit_id');
            $score = $request->input('score');

            $examResult = ExamResults::updateOrCreate(
                [
                    'user_id' => $userId,
                    'unit_id' => $unitId,
                ],
                [
                    'score' => $score,
                    'submitted_at' => now(),
                    'date' => now()->toDateString(), // ✅ يحفظ تاريخ اليوم
                ]
            );

            return response()->json([
                'success' => true,
                'score' => $examResult->score,
                'message' => 'تم حفظ النتيجة بنجاح!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'حدث خطأ في الخادم: '.$e->getMessage(),
            ], 500);
        }
    }

    public function examAlreadyDone()
    {
        return view('mathplay.exam_already_done');
    }
}
