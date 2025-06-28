<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted'             => 'يجب قبول :attribute.',
    'active_url'           => ':attribute ليس رابطًا صالحًا.',
    'after'                => 'يجب أن يكون تاريخ :attribute بعد :date.',
    'after_or_equal'       => 'يجب أن يكون تاريخ :attribute مساويًا أو بعد :date.',
    'alpha'                => 'يجب أن يحتوي :attribute على حروف فقط.',
    'alpha_dash'           => 'يجب أن يحتوي :attribute على حروف وأرقام وشرطات فقط.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروف وأرقام فقط.',
    'array'                => 'يجب أن يكون :attribute مصفوفة.',
    'before'               => 'يجب أن يكون تاريخ :attribute قبل :date.',
    'before_or_equal'      => 'يجب أن يكون تاريخ :attribute مساويًا أو قبل :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف :attribute بين :min و :max.',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean'              => 'يجب أن تكون قيمة :attribute صحيحة أو خاطئة.',
    'confirmed'            => 'تأكيد :attribute غير متطابق.',
    'date'                 => ':attribute ليس تاريخًا صالحًا.',
    'date_equals'          => 'يجب أن يكون تاريخ :attribute مساويًا لـ :date.',
    'date_format'          => 'لا يتطابق :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits'               => 'يجب أن يكون :attribute مكونًا من :digits رقمًا.',
    'digits_between'       => 'يجب أن يكون :attribute بين :min و :max رقمًا.',
    'dimensions'           => 'أبعاد الصورة في :attribute غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مكررة.',
    'email'                => 'يجب أن يكون :attribute بريدًا إلكترونيًا صالحًا.',
    'ends_with'            => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values',
    'exists'               => ':attribute غير موجود.',
    'file'                 => 'يجب أن يكون :attribute ملفًا.',
    'filled'               => 'حقل :attribute مطلوب.',
    'gt'                   => [
        'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف :attribute أكبر من :value.',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن يكون :attribute أكبر من أو يساوي :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف :attribute أكبر من أو يساوي :value.',
        'array'   => 'يجب أن يحتوي :attribute على :value عنصر على الأقل.',
    ],
    'image'                => 'يجب أن يكون :attribute صورة.',
    'in'                   => ':attribute غير صالح.',
    'in_array'             => 'حقل :attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صالحًا.',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صالحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صالحًا.',
    'json'                 => 'يجب أن يكون :attribute نص JSON صالحًا.',
    'lt'                   => [
        'numeric' => 'يجب أن يكون :attribute أقل من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أقل من :value كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف :attribute أقل من :value.',
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عنصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن يكون :attribute أقل من أو يساوي :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أقل من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف :attribute أقل من أو يساوي :value.',
        'array'   => 'يجب ألا يحتوي :attribute على أكثر من :value عنصر.',
    ],
    'max'                  => [
        'numeric' => 'يجب ألا تكون قيمة :attribute أكبر من :max.',
        'file'    => 'يجب ألا يكون حجم الملف :attribute أكبر من :max كيلوبايت.',
        'string'  => 'يجب ألا يكون عدد حروف :attribute أكبر من :max.',
        'array'   => 'يجب ألا يحتوي :attribute على أكثر من :max عنصر.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع: :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع: :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف :attribute على الأقل :min.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عنصر.',
    ],
    'not_in'               => ':attribute غير صالح.',
    'not_regex'            => 'صيغة :attribute غير صحيحة.',
    'numeric'              => 'يجب أن يكون :attribute رقمًا.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'يجب تقديم حقل :attribute.',
    'regex'                => 'صيغة :attribute غير صحيحة.',
    'required'             => 'حقل :attribute مطلوب.',
    'required_if'          => 'حقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_unless'      => 'حقل :attribute مطلوب إلا إذا كان :other من :values.',
    'required_with'        => 'حقل :attribute مطلوب عندما يتوفر :values.',
    'required_with_all'    => 'حقل :attribute مطلوب عندما يتوفر :values.',
    'required_without'     => 'حقل :attribute مطلوب عندما لا يتوفر :values.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا يتوفر أي من :values.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute :size.',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف :attribute :size.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصر.',
    ],
    'starts_with'          => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string'               => 'يجب أن يكون :attribute نصًا.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صالحًا.',
    'unique'               => ':attribute مستخدم من قبل.',
    'uploaded'             => 'فشل في تحميل :attribute.',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة.',
    'invalid_data' => 'البيانات المدخلة غير صحيحة.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | يمكن وضع رسائل تحقق مخصصة هنا بحسب الحقول أو القواعد
    |
    */

    'custom' => [
        'old_password' => [
            'required' => 'كلمة المرور القديمة مطلوبة.',
            'old_password' => 'كلمة المرور القديمة غير صحيحة.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | يمكن تخصيص أسماء الحقول المعروضة في رسائل التحقق هنا
    |
    */

    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'phone' => 'رقم الهاتف',
        'message' => 'الرسالة',
        'subject' => 'الموضوع',
    ],

];
