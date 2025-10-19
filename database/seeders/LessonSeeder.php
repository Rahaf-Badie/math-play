<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        Lesson::create(['name' => 'الأعداد من 1-9','unit_id' => 1]);
        Lesson::create(['name' => 'مقارنة الأعداد من 1-9','unit_id' => 2]);
        Lesson::create(['name' => 'الترتيب التصاعدي والتنازلي ضمن 9','unit_id' => 2]);
        Lesson::create(['name' => 'العدد السابق والتالي ضمن 9','unit_id' => 2]);
        Lesson::create(['name' => 'العدد الترتيبي','unit_id' => 2]);
        Lesson::create(['name' => 'العدد صفر','unit_id' => 3]);
        Lesson::create(['name' => 'مكونات الأعداد ضمن 9','unit_id' => 3]);
        Lesson::create(['name' => 'الجمع ضمن العدد 9','unit_id' => 3]);
        Lesson::create(['name' => 'الطرح ضمن العدد 9','unit_id' => 3]);
        Lesson::create(['name' => 'العلاقة بين الجمع والطرح ضمن 9','unit_id' => 4]);
        Lesson::create(['name' => 'مكونات العدد 10','unit_id' => 5]);
        Lesson::create(['name' => 'الأعداد من 11 إلى 19','unit_id' => 5]);
        Lesson::create(['name' => 'مكونات العدد 20','unit_id' => 5]);

        Lesson::create(['name' => 'العدد السابق','unit_id' => 6]);
        Lesson::create(['name' => 'المقارنة بين عددين','unit_id' => 6]);
        Lesson::create(['name' => 'الترتيب التصاعدي','unit_id' => 6]);
        Lesson::create(['name' => 'الترتيب التنازلي','unit_id' => 6]);
        Lesson::create(['name' => 'الفيمة المنزلية','unit_id' => 6]);
        Lesson::create(['name' => 'الصورة الموسعة','unit_id' => 6]);
        Lesson::create(['name' => 'الجمع ضمن 10','unit_id' => 7]);
        Lesson::create(['name' => 'الجمع ضمن 18','unit_id' => 7]);
        Lesson::create(['name' => 'الطرح ضمن 10','unit_id' => 8]);
        Lesson::create(['name' => 'الطرح ضمن 18','unit_id' => 8]);
        Lesson::create(['name' => 'العلاقة بين الجمع والطرح','unit_id' => 8]);
        Lesson::create(['name' => 'الأعداد من 21-29','unit_id' => 8]);
        Lesson::create(['name' => 'الأعداد من 30-90','unit_id' => 8]);
        Lesson::create(['name' => 'مضاعفات العدد 10','unit_id' => 8]);

        Lesson::create(['name' => 'المقارنة بين عددين','unit_id' => 9]);
        Lesson::create(['name' => 'ترتيب الأعداد ضمن 99','unit_id' => 9]);
        Lesson::create(['name' => 'القيمة المنزلية','unit_id' => 9]);
        Lesson::create(['name' => 'العدد الزوجي والعدد الفردي','unit_id' => 9]);
        Lesson::create(['name' => 'الجمع دون حمل ضمن 99','unit_id' => 10]);
        Lesson::create(['name' => 'طرح عددين ضمن 99 دون استلاف','unit_id' => 10]);
        Lesson::create(['name' => 'الأعداد ضمن 199','unit_id' => 11]);
        Lesson::create(['name' => 'الأعداد ضمن 999','unit_id' => 11]);
        Lesson::create(['name' => 'القيمة المنزلية للأعداد ضمن 999','unit_id' => 11]);
        Lesson::create(['name' => 'مقارنة الأعداد ضمن 999','unit_id' => 11]);
        Lesson::create(['name' => 'ترتيب الأعداد ضمن 999','unit_id' => 11]);
        Lesson::create(['name' => 'القطعة المستقيمة والخط المنحني','unit_id' => 12]);
        Lesson::create(['name' => 'المربع','unit_id' => 12]);

        Lesson::create(['name' => 'جمع عددين ضمن 999 دون حمل','unit_id' => 13]);
        Lesson::create(['name' => 'جمع عددين ضمن 999 مع الحمل','unit_id' => 13]);
        Lesson::create(['name' => 'طرح عددين ضمن 999 دون استلاف','unit_id' => 13]);
        Lesson::create(['name' => 'العلاقة بين الجمع والطرح','unit_id' => 13]);
        Lesson::create(['name' => 'طرح عددين ضمن 999 مع الاستلاف','unit_id' => 13]);
        Lesson::create(['name' => 'خواص عملية الجمع','unit_id' => 13]);
        Lesson::create(['name' => 'العد القفزي','unit_id' => 14]);
        Lesson::create(['name' => 'مفهوم الضرب','unit_id' => 14]);
        Lesson::create(['name' => 'حقائق الضرب لعدد 2','unit_id' => 14]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 3','unit_id' => 14]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 4','unit_id' => 14]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 5','unit_id' => 14]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 10','unit_id' => 14]);

        Lesson::create(['name' => 'الأعداد ضمن 9999','unit_id' => 15]);
        Lesson::create(['name' => 'القيمة المنزلية','unit_id' => 15]);
        Lesson::create(['name' => 'المقارنة بين الأعداد ضمن 9999','unit_id' => 15]);
        Lesson::create(['name' => 'التقريب','unit_id' => 15]);
        Lesson::create(['name' => 'جمع عددين ضمن 9999 دون الحمل','unit_id' => 16]);
        Lesson::create(['name' => 'جمع عددين ضمن 9999 مع الحمل','unit_id' => 16]);
        Lesson::create(['name' => 'طرح عددين ضمن 9999 دون استلاف','unit_id' => 16]);
        Lesson::create(['name' => 'طرح عددين ضمن 9999 مع الاستلاف','unit_id' => 16]);
        Lesson::create(['name' => 'الأعداد ضمن 99999','unit_id' => 17]);
        Lesson::create(['name' => 'القيمة المنزلية والصورة الموسعة','unit_id' => 17]);
        Lesson::create(['name' => 'مقارنة الأعداد','unit_id' => 17]);

        Lesson::create(['name' => 'التقريب','unit_id' => 18]);
        Lesson::create(['name' => 'جمع عددين ضمن 99999 مع الحمل','unit_id' => 18]);
        Lesson::create(['name' => 'التحقق من عملية الجمع بالتبديل والتقريب','unit_id' => 18]);
        Lesson::create(['name' => 'طرح عددين ضمن 99999 دون استلاف','unit_id' => 18]);
        Lesson::create(['name' => 'طرح عددين ضمن 99999 مع الاستلاف','unit_id' => 18]);
        Lesson::create(['name' => 'التحقق من عملية الطرح بالجمع والتقدير','unit_id' => 18]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 2','unit_id' => 19]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 3','unit_id' => 19]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 4','unit_id' => 19]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 5','unit_id' => 19]);
        Lesson::create(['name' => 'خصائص عملية الضرب','unit_id' => 19]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 6','unit_id' => 19]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 7','unit_id' => 19]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 8','unit_id' => 19]);
        Lesson::create(['name' => 'حقائق الضرب للعدد 9','unit_id' => 19]);
        Lesson::create(['name' => 'الضرب في العشرات أو المئات','unit_id' => 19]);
        Lesson::create(['name' => 'القسمة 1','unit_id' => 20]);
        Lesson::create(['name' => 'القسمة 2','unit_id' => 20]);
        Lesson::create(['name' => 'الكسور','unit_id' => 21]);
        Lesson::create(['name' => 'الكسور المتكافئة','unit_id' => 21]);
        Lesson::create(['name' => 'مقارنة الكسور','unit_id' => 21]);
        Lesson::create(['name' => 'المجسمات','unit_id' => 22]);
        Lesson::create(['name' => 'وحدات قياس الكتلة','unit_id' => 22]);
        Lesson::create(['name' => 'وحدات قياس الزمن','unit_id' => 22]);
        Lesson::create(['name' => 'وحدات قياس الطول','unit_id' => 22]);
        Lesson::create(['name' => 'المحيط','unit_id' => 22]);
        Lesson::create(['name' => 'المساحة','unit_id' => 22]);

        Lesson::create(['name' => 'الأعداد ضمن 999999','unit_id' => 23]);
        Lesson::create(['name' => 'الأعداد الكبيرة','unit_id' => 23]);
        Lesson::create(['name' => 'القيمة المنزلية للرقم في الأعداد الكبيرة','unit_id' => 23]);
        Lesson::create(['name' => 'مقارنة الأعداد الكبيرة','unit_id' => 23]);
        Lesson::create(['name' => 'ضرب عدد من منزلتين في عدد من منزلة','unit_id' => 24]);
        Lesson::create(['name' => 'ضرب عدد من ثلاث منازل في عدد من منزلة','unit_id' => 24]);
        Lesson::create(['name' => 'قسمة عدد من منزلتين على عدد من منزلة','unit_id' => 24]);
        Lesson::create(['name' => 'تقدير ناتج الضرب والقسمة','unit_id' => 24]);
        Lesson::create(['name' => 'الكسور المتكافئة','unit_id' => 25]);
        Lesson::create(['name' => 'مقارنة الكسور','unit_id' => 25]);
        Lesson::create(['name' => 'جمع الكسور','unit_id' => 25]);
        Lesson::create(['name' => 'طرح الكسور','unit_id' => 25]);
        Lesson::create(['name' => 'العدد الكسري','unit_id' => 25]);
        Lesson::create(['name' => 'جمع وطرح الأعداد الكسرية','unit_id' => 25]);
        Lesson::create(['name' => 'المستقيمات المتوازية والمتعامدة','unit_id' => 26]);
        Lesson::create(['name' => 'الزوايا','unit_id' => 26]);
        Lesson::create(['name' => 'زوايا المثلث','unit_id' => 26]);

        Lesson::create(['name' => 'مضاعفات العدد','unit_id' => 27]);
        Lesson::create(['name' => 'ثابلية القسمة على 2','unit_id' => 27]);
        Lesson::create(['name' => 'قابلية القسمة على 3','unit_id' => 27]);
        Lesson::create(['name' => 'قابلية القسمة على 4','unit_id' => 27]);
        Lesson::create(['name' => 'قابلية القسمة على 5','unit_id' => 27]);
        Lesson::create(['name' => 'ضرب عدد من منزلتين في عدد من منزلتين','unit_id' => 28]);
        Lesson::create(['name' => 'ضرب عدد من 3 منزل في عدد من منزلتين','unit_id' => 28]);
        Lesson::create(['name' => 'قسمة عدد من منزلتين على عدد من منزلتين','unit_id' => 28]);
        Lesson::create(['name' => 'قسمة عدد من 3 منازل على عدد من منزلتين','unit_id' => 28]);
        Lesson::create(['name' => 'الكسور العشرية','unit_id' => 29]);
        Lesson::create(['name' => 'الأعداد العشرية','unit_id' => 29]);
        Lesson::create(['name' => 'جمع الكسور العشرية','unit_id' => 29]);
        Lesson::create(['name' => 'طرح الكسور العشرية','unit_id' => 29]);
        Lesson::create(['name' => 'جمع الأعداد العشرية','unit_id' => 29]);
        Lesson::create(['name' => 'المربع وخصائصه','unit_id' => 30]);
        Lesson::create(['name' => 'محيط المربع','unit_id' => 30]);
        Lesson::create(['name' => 'المستطيل وخصائصه','unit_id' => 30]);
        Lesson::create(['name' => 'محيط المستطيل','unit_id' => 30]);
        Lesson::create(['name' => 'التحويل بين وحدات القياس','unit_id' => 30]);
        Lesson::create(['name' => 'حجم متوازي المستطيلات','unit_id' => 30]);
        Lesson::create(['name' => 'التجربة العشوائية','unit_id' => 31]);
        Lesson::create(['name' => 'الفرصة','unit_id' => 31]);

    }
}
