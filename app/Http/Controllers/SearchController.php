<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query', '');
        $grade = Auth::user()->grade;

        // البحث في الدروس + الوحدة + الفصل
        $lessons = Lesson::whereHas('unit', function($q) use ($grade){
                    $q->where('grade_id', $grade->id);
                 })
                 ->where(function($q) use ($query) {
                     $q->where('name', 'like', "%{$query}%")
                       ->orWhereHas('unit', fn($q2) => $q2->where('name', 'like', "%{$query}%"))
                       ->orWhereHas('unit.semester', fn($q3) => $q3->where('name', 'like', "%{$query}%"));
                 })
                 ->with(['unit.semester'])
                 ->get()
                 ->map(fn($lesson) => [
                     'lesson_name' => $lesson->name,
                     'unit_name' => $lesson->unit->name ?? '',
                     'semester_name' => $lesson->unit->semester->name ?? '',
                 ]);

        return response()->json([
            'lessons' => $lessons,
        ]);
    }
}
