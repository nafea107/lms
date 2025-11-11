<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Page;

return new class extends Migration {
    public function up(): void
    {
        // Create footer page
        Page::updateOrCreate(
            ['slug' => 'footer'],
            [
                'name' => 'footer',
                'data' => [
                    'youtube_url' => [
                        'type' => 'text',
                        'value' => 'https://www.youtube.com/embed/R0GdXyU18LI',
                    ],
                    'footer_text_ar' => [
                        'type' => 'text',
                        'value' => 'يلا كورس هي منصة تعليمية متكاملة تم إنشاؤها في 15 أغسطس 2024، بهدف تمكين المعلمين من بناء علاماتهم الشخصية وتقديم دورات تعليمية عالية الجودة. نسعى من خلال خدماتنا المتنوعة إلى دعم المعلمين والمدربين في تقديم تجارب تعليمية مميزة للطلاب في مختلف المراحل. بإدارة شاهين راشد، نطمح إلى أن نصبح الوجهة الأولى للمعلمين في مجتمعنا، لتطوير أدواتهم التعليمية وبناء مستقبل مشرق للتعليم',
                    ],
                    'footer_text_en' => [
                        'type' => 'text',
                        'value' => 'Yalla Course is a comprehensive educational platform created on August 15, 2024, with the goal of empowering teachers to build their personal brands and deliver high-quality educational courses. Through our diverse services, we strive to support teachers and trainers in providing exceptional educational experiences for students at various stages. Under the management of Shaheen Rashid, we aspire to become the first destination for teachers in our community, to develop their educational tools and build a bright future for education.',
                    ],
                    'footer_text_ku' => [
                        'type' => 'text',
                        'value' => 'یەڵا کۆرس پلاتفۆرمێکی تەواوی فێرکارییە کە لە ١٥ی ئابی ٢٠٢٤ دروستکراوە، بە ئامانجی بەهێزکردنی مامۆستایان لە دروستکردنی برەندی تایبەتی خۆیان و پێشکەشکردنی کۆرسی فێرکاری بەرز. ئێمە هەوڵ دەدەین لە رێگەی خزمەتگوزارییە جۆراوجۆرەکانمانەوە، پشتگیری مامۆستایان و راهێنەران بکەین لە پێشکەشکردنی ئەزموونی فێرکاری تایبەت بە قوتابیان لە قۆناغە جیاوازەکاندا. بە بەڕێوەبردنی شاهین راشد، ئامانجمان ئەوەیە ببینە وێستگەی یەکەمی مامۆستایان لە کۆمەڵگای خۆماندا، بۆ پەرەپێدانی کەرەستەکانی فێرکردن و بنیاتنانی داهاتوویەکی گەش بۆ پەروەردە',
                    ],
                ],
            ]
        );

        // Create or update about page
        Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'name' => 'about',
                'data' => [
                    'description_ar' => [
                        'type' => 'text',
                        'value' => 'يلا كورس هو أكثر من مجرد منصة تعليمية؛ إنه جسر يربط بين المعلمين الطموحين والطلاب الباحثين عن المعرفة. تم تصميمه ليكون الوجهة الأمثل للمعلمين الذين يرغبون في تطوير علاماتهم الشخصية وبناء محتوى تعليمي مبتكر يصل لكل طالب في أي مكان. من خلال يلا كورس، نفتح أبوابًا جديدة للتعلم، ونمكّن المعلمين من مشاركة رسالتهم التعليمية عبر أدوات تكنولوجية متقدمة تضمن لهم التميز والتأثير. هنا، يجتمع الشغف بالتعليم مع الاحترافية، ليصنعوا مستقبلًا مليئًا بالفرص والإبداع.',
                    ],
                    'description_en' => [
                        'type' => 'text',
                        'value' => 'Yalla Course is more than just an educational platform; it is a bridge connecting ambitious teachers with students seeking knowledge. It is designed to be the optimal destination for teachers who want to develop their personal brands and build innovative educational content that reaches every student anywhere. Through Yalla Course, we open new doors to learning and empower teachers to share their educational message through advanced technological tools that ensure excellence and impact. Here, passion for education meets professionalism to create a future full of opportunities and creativity.',
                    ],
                    'description_ku' => [
                        'type' => 'text',
                        'value' => 'یەڵا کۆرس زیاترە لە پلاتفۆڕمێکی فێرکاری؛ ئەو پردێکە کە مامۆستایانی پڕ ئارەزوو و قوتابیانی بەدوای زانیندا دەگەڕێن پێکەوە دەبەستێتەوە. دیزاین کراوە بۆ ئەوەی ببێتە باشترین مەبەست بۆ ئەو مامۆستایانەی کە دەیانەوێت براندی کەسیی خۆیان پەرەپێبدەن و ناوەڕۆکی فێرکاری داهێنەرانە بنیات بنێن. لە ڕێگەی یەڵا کۆرسەوە، دەرگای نوێی فێربوون دەکەینەوە و مامۆستایان بەهێز دەکەین بۆ هاوبەشکردنی پەیامی فێرکارییان لە ڕێگەی ئامرازە تەکنۆلۆژییە پێشکەوتووەکانەوە کە جیاوازی و کاریگەرییان بۆ دەستەبەر دەکات. لێرەدا، شەیدایی فێرکردن لەگەڵ پیشەگەرییدا کۆدەبێتەوە، بۆ دروستکردنی داهاتوویەکی پڕ لە هەل و داهێنان.',
                    ],
                    'goal_ar' => [
                        'type' => 'text',
                        'value' => 'هدفنا في يلا كورس هو أن نكون الحافز الذي يحوّل أحلام المعلمين إلى واقع ملموس، وأن نساعدهم في نشر رسالتهم التعليمية للعالم. نؤمن بأن كل معلم يستحق منصة تتيح له أن يبدع ويصل إلى طلابه بأفضل الطرق الممكنة. نطمح إلى بناء مجتمع تعليمي يزدهر فيه الإبداع والتواصل، حيث يصبح كل معلم قائدًا وكل طالب مؤثرًا، معًا نصنع غدًا أكثر إشراقًا وأثرًا في عالم التعليم.',
                    ],
                    'goal_en' => [
                        'type' => 'text',
                        'value' => 'Our goal at Yalla Course is to be the catalyst that transforms teachers\' dreams into tangible reality and helps them spread their educational message to the world. We believe that every teacher deserves a platform that allows them to be creative and reach their students in the best possible ways. We aspire to build an educational community where creativity and communication flourish, where every teacher becomes a leader and every student becomes influential. Together, we create a brighter and more impactful tomorrow in the world of education.',
                    ],
                    'goal_ku' => [
                        'type' => 'text',
                        'value' => 'ئامانجی ئێمە لە یەڵا کۆرس ئەوەیە کە ببینە ئەو هاندەرەی کە خەونەکانی مامۆستایان دەکاتە ڕاستی بەرجەستە، و یارمەتیان بدەین لە بڵاوکردنەوەی پەیامی فێرکارییان بۆ جیهان. ئێمە بڕوامان وایە کە هەموو مامۆستایەک شایانی پلاتفۆرمێکە کە ڕێگەی پێ بدات داهێنان بکات و بە باشترین ڕێگای مومکین بگاتە قوتابیەکانی. ئێمە ئارەزوو دەکەین کۆمەڵگایەکی فێرکاری بنیات بنێین کە داهێنان و پەیوەندی تێیدا گەشە بکات، کە تێیدا هەموو مامۆستایەک دەبێتە ڕابەر و هەموو قوتابییەک کاریگەر، پێکەوە سبەینێیەکی ڕووناکتر و کاریگەرتر لە جیهانی پەروەردەدا دروست دەکەین.',
                    ],
                ],
            ]
        );
    }

    public function down(): void
    {
        Page::whereIn('slug', ['footer', 'about'])->delete();
    }
};
