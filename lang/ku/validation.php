<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute پێویستە پەسەند بکرێت.',
    'accepted_if' => ':attribute پێویستە پەسەند بکرێت کاتێک :other بریتیە لە :value.',
    'active_url' => ':attribute پێویستە بە بەستەرێکی دروست بێت.',
    'after' => ':attribute پێویستە بەروارێکی دوای :date بێت.',
    'after_or_equal' => ':attribute پێویستە بەروارێکی دوای یان یەکسان بە :date بێت.',
    'alpha' => ':attribute تەنها پێویستە تەنها پیت بخایەنەوە.',
    'alpha_dash' => ':attribute پێویستە تەنها پیت، ژمارە، خطەکان و دانیشتنەکان بگرێت.',
    'alpha_num' => ':attribute پێویستە تەنها پیت و ژمارە بخایەنەوە.',
    'array' => ':attribute پێویستە تابلێک بێت.',
    'ascii' => ':attribute پێویستە تەنها کارەکتەرەکانی ASCIIی بە تەنها بگرێت.',
    'before' => ':attribute پێویستە بەروارێکی پێش :date بێت.',
    'before_or_equal' => ':attribute پێویستە بەروارێکی پێش یان یەکسان بە :date بێت.',
    'between' => [
        'array' => ':attribute پێویستە نێوان :min و :max دانە بگرێت.',
        'file' => ':attribute پێویستە نێوان :min و :max کیلۆبایت بێت.',
        'numeric' => ':attribute پێویستە نێوان :min و :max بێت.',
        'string' => ':attribute پێویستە نێوان :min و :max پیت بێت.',
    ],
    'boolean' => ':attribute پێویستە ڕاست یان هەڵە بێت.',
    'can' => ':attribute ژمارەیەکی بێ رەخنەیە.',
    'confirmed' => 'دووپاتکردنەوەی :attribute لەگەڵ یەک ناگرێت.',
    'contains' => ':attribute ئەو ڕوونکردنە نەدایە.',
    'current_password' => 'وشەی نهێنی هەڵەیە.',
    'date' => ':attribute پێویستە بەروارێکی دروست بێت.',
    'date_equals' => ':attribute پێویستە بەروارێکی یەکسان بە :date بێت.',
    'date_format' => ':attribute پێویستە یەکسان بێت بە فۆرماتی :format.',
    'decimal' => ':attribute پێویستە بە ژمارەیەکی دەبەستە.',
    'declined' => ':attribute پێویستە بەرکەوتن بکرێت.',
    'declined_if' => ':attribute پێویستە بەرکەوتن بکرێت کاتێک :other بریتیە لە :value.',
    'different' => ':attribute و :other پێویستە جیاواز بن.',
    'digits' => ':attribute پێویستە بریتی بێت لە ژمارەی :digits.',
    'digits_between' => ':attribute پێویستە نێوان :min و :max ژمارە بێت.',
    'dimensions' => ':attribute بریتییە لە مێژوی وێنەیەکی نادروست.',
    'distinct' => ':attribute بایەخێکی دووپات کراوەیە.',
    'doesnt_end_with' => ':attribute نابێت بە یەک لە ئەمانە کۆتایی پێبکەوێت: :values.',
    'doesnt_start_with' => ':attribute نابێت بە یەک لە ئەمانە دەست پێبکات: :values.',
    'email' => ':attribute پێویستە بە ناونیشانی ئەلیکترۆنی دروست بێت.',
    'ends_with' => ':attribute پێویستە بە یەک لە ئەمانە کۆتایی پێبکەوێت: :values.',
    'enum' => ':attributeی هەڵبژێردراو نادروستە.',
    'exists' => ':attributeی هەڵبژێردراو نادروستە.',
    'extensions' => ':attribute پێویستە یەکێک لە ئەمانە بێت: :values.',
    'file' => ':attribute پێویستە فایلێک بێت.',
    'filled' => ':attribute پێویستە نرخی تێدا بکرێت.',
    'gt' => [
        'array' => ':attribute پێویستە زیاتر لە :value تێبکات.',
        'file' => ':attribute پێویستە زیاتر لە :value کیلۆبایت بێت.',
        'numeric' => ':attribute پێویستە زیاتر بێت لە :value.',
        'string' => ':attribute پێویستە زیاتر بێت لە :value پیت.',
    ],
    'gte' => [
        'array' => 'پەڕەی :attribute پێویستە :value تەنیشت یاخود زیاتر بێت.',
        'file' => 'پەڕەی :attribute پێویستە بەرزتر یان برابربن بە :value کێلو بایت.',
        'numeric' => 'پەڕەی :attribute پێویستە بەرزتر یان برابربن بە :value.',
        'string' => 'پەڕەی :attribute پێویستە بەرزتر یان برابربن بە :value پەیامە.',
    ],
    'hex_color' => 'پەڕەی :attribute پێویستە ڕوونی هێنەی پەیامەی هێکساد.',
    'image' => 'پەڕەی :attribute پێویستە وێنەیەک بێت.',
    'in' => 'هەڵبژاردنی :attribute نەنابەرەوە.',
    'in_array' => 'پەڕەی :attribute پێویستە لە :other بوونی بێت.',
    'integer' => 'پەڕەی :attribute پێویستە ژمارەیەکی گەورە بێت.',
    'ip' => 'پەڕەی :attribute پێویستە نیشانی IP ڕاست بێت.',
    'ipv4' => 'پەڕەی :attribute پێویستە نیشانی IPv4 ڕاست بێت.',
    'ipv6' => 'پەڕەی :attribute پێویستە نیشانی IPv6 ڕاست بێت.',
    'json' => 'پەڕەی :attribute پێویستە پەیامەی JSON ڕاست بێت.',
    'list' => 'پەڕەی :attribute پێویستە لیستی بێت.',
    'lowercase' => 'پەڕەی :attribute پێویستە لە نووسینە کەمتەر بێت.',
    'lt' => [
        'array' => 'پەڕەی :attribute پێویستە کەمتر لە :value تەنیشت بێت.',
        'file' => 'پەڕەی :attribute پێویستە کەمتر لە :value کێلو بایت.',
        'numeric' => 'پەڕەی :attribute پێویستە کەمتر لە :value.',
        'string' => 'پەڕەی :attribute پێویستە کەمتر لە :value پەیامە.',
    ],
    'lte' => [
        'array' => 'پەڕەی :attribute پێویستە زۆرتر لە :value تەنیشت نگەی.',
        'file' => 'پەڕەی :attribute پێویستە کەمتر یان برابربن بە :value کێلو بایت.',
        'numeric' => 'پەڕەی :attribute پێویستە کەمتر یان برابربن بە :value.',
        'string' => 'پەڕەی :attribute پێویستە کەمتر یان برابربن بە :value پەیامە.',
    ],
    'mac_address' => 'پەڕەی :attribute پێویستە نیشانی MAC ڕاست بێت.',
    'max' => [
        'array' => 'پەڕەی :attribute پێویستە زۆرتر لە :max تەنیشت نەبێت.',
        'file' => 'پەڕەی :attribute پێویستە زۆرتر لە :max کێلو بایت.',
        'numeric' => 'پەڕەی :attribute پێویستە زۆرتر لە :max.',
        'string' => 'پەڕەی :attribute پێویستە زۆرتر لە :max پەیامە.',
    ],
    'max_digits' => 'پەڕەی :attribute پێویستە زۆرتر لە :max ژمارە نەبێت.',
    'mimes' => 'پەڕەی :attribute پێویستە پەڕگەی لە جۆری: :values.',
    'mimetypes' => 'پەڕەی :attribute پێویستە پەڕگەی لە جۆری: :values.',
    'min' => [
        'array' => 'پەڕەی :attribute پێویستە لە کەمترین :min تەنیشت بێت.',
        'file' => 'پەڕەی :attribute پێویستە لە کەمترین :min کێلو بایت.',
        'numeric' => 'پەڕەی :attribute پێویستە لە کەمترین :min.',
        'string' => 'پەڕەی :attribute پێویستە لە کەمترین :min پەیامە.',
    ],
    'min_digits' => 'پەڕەی :attribute پێویستە لە کەمترین :min ژمارە بێت.',
    'missing' => 'پەڕەی :attribute پێویستە نەبوو.',
    'missing_if' => 'پەڕەی :attribute پێویستە نەبوو کاتێک :other :value بێت.',
    'missing_unless' => 'پەڕەی :attribute پێویستە نەبوو بەرەو :other ناتوانێت :value.',
    'missing_with' => 'پەڕەی :attribute پێویستە نەبوو کاتێک :values بێت.',
    'missing_with_all' => 'پەڕەی :attribute پێویستە نەبوو کاتێک :values بێت.',
    'multiple_of' => 'پەڕەی :attribute پێویستە زۆرەیەکی :value بێت.',
    'not_in' => 'هەڵبژاردنی :attribute نەنابەرەوە.',
    'not_regex' => 'فۆرمەتی پەڕەی :attribute نەنابەرەوە.',
    'numeric' => 'پەڕەی :attribute پێویستە ژمارە بێت.',
    'password' => [
        'letters' => 'پەڕەی :attribute پێویستە لە کەمترین یەک پەیامێکی پەیوەندیدار بێت.',
        'mixed' => 'پەڕەی :attribute پێویستە لە کەمترین یەک پەیامێکی پەیوەندیدار بەرز و یەک پەیامێکی پەیوەندیدار کەمتەر بێت.',
        'numbers' => 'پەڕەی :attribute پێویستە لە کەمترین یەک ژمارە بێت.',
        'symbols' => 'پەڕەی :attribute پێویستە لە کەمترین یەک نیشانی بێت.',
        'uncompromised' => 'پەڕەی :attribute کەوتوویە لە سەر بەرەوەندە. تکایە پەڕەیەکی جیاواز هەڵبژێرە.',
    ],
    'present' => 'پەڕەی :attribute پێویستە بوونی بێت.',
    'present_if' => 'پەڕەی :attribute پێویستە بوونی بێت کاتێک :other :value بێت.',
    'present_unless' => 'پەڕەی :attribute پێویستە بوونی بێت بەرەو :other ناتوانێت :value.',
    'present_with' => 'پەڕەی :attribute پێویستە بوونی بێت کاتێک :values بێت.',
    'present_with_all' => 'پەڕەی :attribute پێویستە بوونی بێت کاتێک :values بێت.',
    'prohibited' => 'پەڕەی :attribute ناتوانی.',
    'prohibited_if' => 'پەڕەی :attribute ناتوانی کاتێک :other :value بێت.',
    'prohibited_unless' => 'پەڕەی :attribute ناتوانی بەرەو :other بێت لە :values.',
    'prohibits' => 'پەڕەی :attribute ناتوانی :other بێت.',
    'regex' => 'فۆرمەتی پەڕەی :attribute نەنابەرەوە.',
    'required' => 'پەڕەی :attribute پێویستە.',
    'required_array_keys' => 'پەڕەی :attribute پێویستە کە بێت بۆ: :values.',
    'required_if' => 'پەڕەی :attribute پێویستە کاتێک :other :value بێت.',
    'required_if_accepted' => 'پەڕەی :attribute پێویستە کاتێک :other پەسندکراوی بێت.',
    'required_unless' => 'پەڕەی :attribute پێویستە بەرەو :other ناتوانێت :value.',
    'required_with' => 'پەڕەی :attribute پێویستە کاتێک :values بێت.',
    'required_with_all' => 'پەڕەی :attribute پێویستە کاتێک :values بێت.',
    'required_without' => 'پەڕەی :attribute پێویستە کاتێک :values نابی.',
    'required_without_all' => 'پەڕەی :attribute پێویستە کاتێک هیچ کەس بەرز نەبێت.',
    'same' => 'پەڕەی :attribute و :other پێویستە یەکسان بێت.',
    'size' => [
        'array' => 'پەڕەی :attribute پێویستە :size تەنیشت بێت.',
        'file' => 'پەڕەی :attribute پێویستە :size کێلو بایت بێت.',
        'numeric' => 'پەڕەی :attribute پێویستە :size بێت.',
        'string' => 'پەڕەی :attribute پێویستە :size پەیامە.',
    ],
    'supported' => 'پەڕەی :attribute ناتوانی نیشانی بێت.',
    'url' => 'فۆرمەتی پەڕەی :attribute نەنابەرەوە.',
    'uuid' => 'پەڕەی :attribute پێویستە نیشانی UUID ڕاست بێت.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name.ar' => 'ناوی عەرەبی',
        'name.ku' => 'ناوی کوردی',
        'chapters.*.name.ku' => 'ناوی عەرەبی',
        'chapters.*.name.ar' => 'ناوی کوردی',
        'chapter.*.name.ar' => 'ناوی عەرەبی',
        'chapter.*.name.ku' => 'ناوی کوردی',
        'file' => 'file',
        'course_id' => 'کورس',
        'chapter_id' => 'بابەتی',
        'quiz.name.ar' => 'ناوی پەیمانە عەرەبی',
        'quiz.name.ku' => 'ناوی پەیمانە کوردی',
        'quiz.question_and_answers.*.question.ar' => 'پرسیاری عەرەبی',
        'quiz.question_and_answers.*.question.ku' => 'پرسیاری کوردی',
        'quiz.question_and_answers.*.answers.*.answer.ar' => 'وەڵامی عەرەبی',
        'quiz.question_and_answers.*.answers.*.answer.ku' => 'وەڵامی کوردی',
        'quiz.question_and_answers.*.answers.*.is_true' => 'وەڵامی ڕاست',

    ],

];
