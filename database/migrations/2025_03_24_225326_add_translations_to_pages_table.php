<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add the new fields to the existing pages
        $this->updateFooterPage();
        $this->updateAboutPage();
        $this->updateCoursesPage();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't need to do anything here as we're modifying existing JSON data
    }

    /**
     * Update the footer page to include translations
     */
    private function updateFooterPage()
    {
        $page = \DB::table('pages')->where('slug', 'footer')->first();
        if ($page) {
            $data = json_decode($page->data, true) ?: [];

            // Add footer text fields for both languages if they don't exist
            if (!isset($data['footer_text_ar'])) {
                $data['footer_text_ar'] = [
                    'type' => 'text',
                    'value' => 'نص تذييل الصفحة باللغة العربية'
                ];
            }

            if (!isset($data['footer_text_ku'])) {
                $data['footer_text_ku'] = [
                    'type' => 'text',
                    'value' => 'دەقی پێی لاپەڕە بە کوردی'
                ];
            }

            \DB::table('pages')->where('slug', 'footer')->update([
                'data' => json_encode($data)
            ]);
        }
    }

    /**
     * Update the about page to include translations
     */
    private function updateAboutPage()
    {
        $page = \DB::table('pages')->where('slug', 'about')->first();
        if ($page) {
            $data = json_decode($page->data, true) ?: [];

            // Update existing description and goal fields or add new ones
            $data['description'] = [
                'type' => 'text',
                'value' => 'يلا كورس هو أكثر من مجرد منصة تعليمية؛ إنه جسر يربط بين المعلمين الطموحين والطلاب الباحثين عن المعرفة. تم تصميمه ليكون الوجهة الأمثل للمعلمين الذين يرغبون في تطوير علاماتهم الشخصية وبناء محتوى تعليمي مبتكر يصل لكل طالب في أي مكان.'
            ];

            $data['description_ku'] = [
                'type' => 'text',
                'value' => 'یەڵا کۆرس زیاترە لە پلاتفۆڕمێکی فێرکاری؛ ئەو پردێکە کە مامۆستایانی پڕ ئارەزوو و قوتابیانی بەدوای زانیندا دەگەڕێن پێکەوە دەبەستێتەوە. دیزاین کراوە بۆ ئەوەی ببێتە باشترین مەبەست بۆ ئەو مامۆستایانەی کە دەیانەوێت براندی کەسیی خۆیان پەرەپێبدەن و ناوەڕۆکی فێرکاری داهێنەرانە بنیات بنێن.'
            ];

            $data['goal'] = [
                'type' => 'text',
                'value' => 'هدفنا في يلا كورس هو أن نكون الحافز الذي يحوّل أحلام المعلمين إلى واقع ملموس، وأن نساعدهم في نشر رسالتهم التعليمية للعالم. نؤمن بأن كل معلم يستحق منصة تتيح له أن يبدع ويصل إلى طلابه بأفضل الطرق الممكنة.'
            ];

            $data['goal_ku'] = [
                'type' => 'text',
                'value' => 'ئامانجی ئێمە لە یەڵا کۆرس ئەوەیە کە ببینە ئەو هاندەرەی کە خەونەکانی مامۆستایان دەکاتە ڕاستی بەرجەستە، و یارمەتیان بدەین لە بڵاوکردنەوەی پەیامی فێرکارییان بۆ جیهان. ئێمە بڕوامان وایە کە هەموو مامۆستایەک شایانی پلاتفۆرمێکە کە ڕێگەی پێ بدات داهێنان بکات و بە باشترین ڕێگای مومکین بگاتە قوتابیەکانی.'
            ];

            \DB::table('pages')->where('slug', 'about')->update([
                'data' => json_encode($data)
            ]);
        }
    }

    /**
     * Update the courses page to include translations
     */
    private function updateCoursesPage()
    {
        $page = \DB::table('pages')->where('slug', 'courses')->first();
        if ($page) {
            $data = json_decode($page->data, true) ?: [];

            // Add courses description fields for both languages
            if (!isset($data['courses_description'])) {
                $data['courses_description'] = [
                    'type' => 'text',
                    'value' => 'كورساتي في العلوم تم تصميمها بعناية لتلبية جميع احتياجات الطلاب، بدءًا من المفاهيم الأساسية وحتى التطبيقات المتقدمة. سواء كنت تسعى لتعزيز فهمك للفيزياء، الكيمياء، أو الأحياء، ستجد في هذه الدورات كل ما تحتاجه لتحقيق التفوق الأكاديمي.'
                ];
            }

            if (!isset($data['courses_description_ku'])) {
                $data['courses_description_ku'] = [
                    'type' => 'text',
                    'value' => 'کۆرسەکانم لە زانستدا بە وردی دیزاین کراون بۆ پڕکردنەوەی هەموو پێداویستیەکانی قوتابیان، لە چەمکە بنەڕەتیەکانەوە بگرە تا جێبەجێکردنە پێشکەوتووەکان. ئەگەر هەوڵ دەدەیت بۆ بەهێزکردنی تێگەیشتنت لە فیزیا، کیمیا، یان زیندەوەرزانی، لەم کۆرسانەدا هەموو ئەوەی پێویستتە بۆ بەدەستهێنانی سەرکەوتنی ئەکادیمی دەدۆزیتەوە.'
                ];
            }

            \DB::table('pages')->where('slug', 'courses')->update([
                'data' => json_encode($data)
            ]);
        }
    }
};
