<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiAIService {

    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
    protected $model = 'gemini-2.5-flash';

    public function generateContent(string $prompt, string $model = 'gemini-2.5-flash')
    {
        $apiKey = config('services.gemini.key');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
            ->post("{$this->baseUrl}/models/{$model}:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $prompt],
                        ],
                    ],
                ],
                // يمكنك إضافة إعدادات النظام (System Instruction) هنا
                'config' => [
                    'systemInstruction' => 'أنت معلم رياضيات ودود للأطفال من الصف الأول للرابع. مهمتك هي المساعدة في المسائل الرياضية بشرح مبسط ومشجع.',
                ],
            ]);

        if ($response->successful()) {
            return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'لم يتم الحصول على إجابة.';
        }

        // معالجة الأخطاء هنا
        return 'حدث خطأ في الاتصال بخدمة الذكاء الاصطناعي: '.$response->status();
    }

    // تخيل أنك تحفظ سجل المحادثة في الجلسة: session(['chat_history' => $history]);

    public function continueChat(array $history, string $newPrompt)
    {
        // ... هنا يتم بناء الـ JSON لإرسال كل سجل المحادثة السابق بالإضافة إلى السؤال الجديد

        $contents = array_merge($history, [
            [
                'role' => 'user',
                'parts' => [['text' => $newPrompt]],
            ],
        ]);

        // ... ثم يتم إرسال هذا الـ contents إلى Gemini API
    }
    public function getChatResponse(array $history, string $newPrompt): string
    {
        // 1. تنظيف النص لاستخراج العملية الحسابية (جمع، طرح، ضرب، قسمة)
        // يتم البحث عن نمط: (رقم) (عملية) (رقم)
        if (preg_match('/(\d+)\s*([\+\-\*\/])\s*(\d+)/', $newPrompt, $matches)) {
            $num1 = (float)$matches[1];
            $operator = trim($matches[2]);
            $num2 = (float)$matches[3];
            $result = null;

            // 2. تنفيذ العملية الحسابية
            switch ($operator) {
                case '+':
                    $result = $num1 + $num2;
                    break;
                case '-':
                    $result = $num1 - $num2;
                    break;
                case '*':
                    $result = $num1 * $num2;
                    break;
                case '/':
                    // تجنب القسمة على صفر
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                    } else {
                        return "لا يمكنني القسمة على صفر يا صديقي الصغير! 🚫";
                    }
                    break;
            }

            if ($result !== null) {
                // رسالة معلم ودودة
                return "يا له من سؤال رائع! ناتج عملية {$num1} {$operator} {$num2} يساوي **" . round($result, 2) . "** 🎉. هل لديك سؤال آخر؟";
            }
        }

        // إذا لم يكن السؤال عملية حسابية بسيطة
        return "أنا آسف، لا أستطيع الإجابة على هذا السؤال الآن، لكن يمكنك سؤالي عن عمليات الجمع والطرح والضرب البسيطة. ➕➖";
    }
}
