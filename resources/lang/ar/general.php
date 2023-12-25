<?php

return [
    'SiteName' => 'كلير فورس',
    'home' => 'الرئيسية',
    'description' => App\Models\Setting::where('id', 1)->first()->productDescription ,

    'about' => 'عن كلير فورس',
    'Features' => 'الميزات',
    'Blog' => 'المدونة',
    'Dashboard' => 'لوحة التحكم',
    'Login' => 'تسجيل دخول',
    'createـaccount' => 'انشاء حساب',
    'Contact_Us' => 'تواصل معنا',
    'Start_Now' =>'ابدا الان',
    'Service' =>'الخدمات',
    'UseـCase' => 'روابط مفيدة',

    'company' => 'الرشكة',
    'industry' => 'المجال او الصناعة',

    // 'site_description' => 'شريكك الموثوق لحلول التخليص الجمركي وتيسير عبور البضائع عبر الحدود',
    'site_description' => App\Models\Setting::where('id', 1)->first()->productDescription_ar,
    'footerQuote' => App\Models\Setting::where('id', 1)->first()->footerQuote_ar,
    'site_sub_description' => 'خدمات تخليص جمركي موثوقة وفعالة من حيث التكلفة وتلبية احتياجات العمل',
    'contact_title' => 'دعنا نتعرف علي بعض !',
    'Features_Benefits' => 'الميزات والفوائد',
    'Stay_updated' => 'ابق على اطلاع دائم بحالة التخليص الجمركي والاستيراد من خلال ميزات التتبع في الوقت الفعلي',
    'Features_a' => 'توفر منصتنا مركزية آمنة لإدارة المستندات والعمليات المتعلقة بالتخليص الجمركي',
    'Features_b' => 'تتميز منصتنا بواجهة بديهية وسهلة الاستخدام، مما يسهل على المستخدمين التنقل وتنفيذ المهام',
    'Features_c' => 'الامتثال الجمركي: تم تصميم منصتنا لضمان الامتثال لجميع اللوائح والمتطلبات الجمركية',
    'streamlining' => 'من خلال تبسيط عملية التخليص الجمركي، تساعد منصتنا على تقليل التكاليف المرتبطة بالتأخير والعقوبات والأعمال الورقية اليدوية',
    'Our_Partners' => 'شركاؤنا',
    'How_it_works' => 'كيف نعمل',
    'Instruct_to_our_Work_Flow' => 'إرشاد إلى سير العمل',

    'ClearForce_Overview' => 'نظرة عامة على منصة كلير فورس',
    'We_provide' => 'نحن نقدم خدمات تخليص جمركي بارزة حقًا',
    'work_a_title' => '1. تقديم المستندات',
    'work_a_desc' => 'يجب تقديم المستندات الكاملة عبر منصة  كلير فورس أو الاتصال بنا لتلقي المساعدة',
    'work_b_title' => '2. تتبع المدفوعات والتنفيذ',
    'work_b_desc' => 'متابعة حالة التنفيذ ودفع الفواتير اللازمة لضمان سلاسة عملية التخليص',
    'work_c_title' => '3. قم بإعداد شحنتك للنقل',
    'work_c_desc' => 'احصل على إشعار باكتمال عملية التخليص الجمركي وجاهزية شحنتك للنقل إلى المستودع أو المتجر الخاص بك',

    'get_in_touch' => 'تواصل معنا',
    'blog' => 'المدونة',
    'blog_title' => 'الأخبار والنصائح',
    'QA_title' => 'أسئلة وأجوبة',
    'QA_description' => 'تم تصميم منصتنا لتبسيط الإجراءات التي ينطوي عليها سير عمل التخليص الجمركي',
    'CTA_Join_Client' => 'انضم الينا الان',
    'CTA_desc' => 'استمتع بخدمات التخليص الجمركي',
    'CTA_sub_desc' => 'وفر وقتك لأننا نعلم أن وقتك يستحق المال.',

    'Users' => 'المستخدمين',
    'Clients' => 'العملاء',
    'Agents' => 'المخلصين',
    'Verification_Center' => 'مركز التحقق',
    'Transaction_History' => 'سجل المعاملات',
    'Projects' => 'المشاريع',
    'All_Projects' => 'كل المشاريع',
    'Products_Type' => 'انواع البضائع',
    'Countries' => 'الدول',
    'Shipping_Mode' => 'طريقة الشحن',
    'Ports' => 'الموانئ',
    'HS_Codes' => 'رموز النظام المنسق',
    'Milestones' => 'مراحل تنفيذية',
    'Withdraw' => 'سحب',
    'History' => 'سجل',
    'Requests' => 'الطلبات',
    'Support' => 'الدعم',
    'Contacts' => 'التواصل',
    'Settings' => 'الاعدادات',
    'Logout' => 'تسجيل الخروج',
    'All Projects' => 'المشاريع',
    'Total_Projects' => 'إجمالي المشاريع',
    'Completed' => 'المكتملة',
    'Completed_Projects' => 'المشاريع المكتملة',
    'Ongoing' => 'جارية',
    'Ongoing_Projects' => 'مشاريع جارية',
    'Financials' => 'المالية',
    'Income' => 'دخل',
    'Total_Income' => 'إجمالي الدخل',
    'Withdrawals' => 'عمليات السحب',
    'Withdrawn_Invoices' => 'الفواتير المسحوبة',
    'Invoices' => 'الفواتير',
    'amount' => 'القيمة',
    'status' => 'الحالة',
    'project' => 'المشروع',
    'date' => 'التاريخ',
    'Available' => 'متاح',
    'Details' => 'التفاصيل',

    'Available_Cash' => 'النقد المتاح',
    'Total_Users' => 'إجمالي المستخدمين',
    'Total_Agents' => 'إجمالي المخلصين',

    'Paying_Users' => 'إجمالي المستخدمين الذين يدفعون',
    'CRR' => 'CRR [معدل الاحتفاظ بالعملاء]',
    'Client_Satisfaction' => 'رضا العملاء',
    'Verified_Agents' => 'المخلصين المعتمدين',
    'Total_Verified_Agents' => 'إجمالي المخلصين المعتمدين',
    'Verifications_Pending' => 'عمليات تحقق معلقة',
    'Banned_Agents' => 'المخلصون المحظورون',
    'Terms_of_Service' => 'شروط الخدمة',
    'Privacy_Policy' => 'سياسة الخصوصية',
    'Create_Project' => 'إنشاء مشروع',
    'Clearance_Type' => 'نوع التخليص',
    'Description' => 'وصف',
    'More_About_Goods' => 'تفاصيل البضائع',
    'Shipment_Details' => 'تفاصيل الشحنة',
    'Shipping_Mode_Departure_Destination_Port' => 'وسيلة الشحن / ميناء المغادرة وميناء الوجهة',
    'Upload_Files' => 'تحميل الملفات',
    'Commercial_Files' => 'الملفات التجارية',
    'Import' => 'استيراد',
    'Export' => 'تصدير',
    'Next' => 'التالي',
    'Previous' => 'السابق',
    'Goods_Type' => 'توع البضائع',
    'Do_you_need_to_ship_after_clearance' => 'هل تحتاج إلى خدمات نقل نقل الاستيراد - من الميناء إلى الباب , نقل التصدير - من الباب إلى الميناء',
    'Delivery_Address' => 'عنوان التسليم',
    'Land' => 'الشحن البري',
    'Air' => 'الشحن الجوي',
    'Ocean' => 'الشحن البحري',
    'Rail' => 'الشحن بالسكك الحديدية',
    'Shipping' => 'شحن',
    'Departure_Country' => 'بلد المغادرة',
    'Arrival_Country' => 'بلد الوصول',
    'Arrival_Date' => 'تاريخ المغادرة / تاريخ الوصول',
    'Choose_Country' => 'اختر البلد',
    'Departure_Port_Arrival_Port' => 'ميناء المغادرة / ميناء الوصول',
    'Select_Port' => 'اختر المنفذ',
    'Bill_of_Lading' => 'بوليصة الشحن',
    'Choose_Files' => 'اختر الملفات',
    'No_File_Chosen' => 'لم تقم باختيار ملف',
    'Submit' => 'ارسال',
    'Bank_Transfer' => 'تحويل بنكي',
    'Withdraw_Request' => 'طلب سحب',
    'Send' => 'ارسال',
    'Save' => 'حفظ',
    'Setup_Bank_Account' => 'إعداد الحساب البنكي',
    'My_Proposals' => 'عروضي',
    'My_Projects' => 'مشاريعي',

    'Wallet' => 'المحفظة',
    'Explore_Projects' => 'استكشاف المشاريع',
    'Total' => 'المجموع',
    'Note' => 'ملاحظة',
    'Search' => 'بحث',
    'Budget' => 'الميزانية',
    'Status' => 'الحالة',
    'Action' => '...',
    'Accepted' => 'مقبول',
    'Pending' => 'معلق',
    'Show' => 'عرض',
    'Statistics' => 'إحصائيات',
    'Total_Amount_Received_on_All_Projects' => 'إجمالي المبلغ المستلم لجميع المشاريع',
    'Total_Amount_Available_in_Wallet' => 'إجمالي المبلغ المتاح في المحفظة',
    'Amount' => 'المبلغ',
    'Purpose' => 'الغاية',
    'Invites' => 'الدعوات',
    'Congratulations' => 'مبروك',
    'Profile_Details' => 'تفاصيل الملف الشخصي',
    'Name' => 'الاسم ',
    'E_mail' => 'البريد الإلكتروني',
    'Phone_Number' => 'رقم الهاتف',
    'Address' => 'العنوان',
    'Zip_Code' => 'الرمز البريدي',
    'Country' => 'البلد',
    'Save_Changes' => 'حفظ التغييرات',
    'Need_To_Send_Budget' => 'بحاجة إلى إرسال الميزانية',

    'About_Us' => 'معلومات عنا',
    'future_customs_clearance' => 'مستقبل التخليص الجمركي',
    'contact_form_title' => 'لا تتردد في الاتصال بنا',
    'Demo_title' => 'احصل على العرض التجريبي ',
    'Demo_desc' => 'هل تجد صعوبة في التنقل بين الخدمات؟ اتصل بخبراء منتجاتنا للحصول على عرض توضيحي مخصص',
    'Demo_btn' => 'حدد موعدًا لإجراء مكالمة',

    // login
    'Welcome_to_ClearForce' => 'مرحبا بكم في كلير فورس',
    'Please_sign-in_account' => 'يرجى تسجيل الدخول إلى الحساب الخاص بك',
    'Password' => 'كلمة المرور',
    'Forgot_Your_Password?' => 'نسيت كلمة السر؟',
    'Remember_Me' => 'تذكرنى',
    'Sign_in' => 'تسجيل الدخول',
    'New_on_our_platform?'  => 'جديد على منصتنا؟?',
    'Create_an_account' => 'إنشاء حساب',

    'Register' => 'تسجيل',
    'Importer / exporter' => 'مستورد / مصدر',
    'Im a customs broker' => 'أنا وسيط جمركي',
    'Username' => 'اسم المستخدم',
    'country' => 'الدول',
    'Confirm Password' => 'تأكيد كلمة المرور',
    'I agree privacy & terms' => 'أوافق على سياسة الخصوصية والشروط',
    'Already have an account?' => 'هل لديك حساب؟',
    'Verified Pending' => 'في انتظار التحقق',
    'Banned' => 'محظورة',

    // dash
    'View Activity' => 'عرض',
    'import/export' => 'استيراد/تصدير',
    'shiping mode / Shipment From-to / Arrival / Bill' => 'وضع الشحن / الشحن من إلى / الوصول / الفاتورة',
    'Importing products from other countries to your country' => 'استيراد المنتجات من دول أخرى إلى بلدك',
    'Exporting products from your country abroad' => 'تصدير المنتجات من بلدك إلى الخارج',
    'transportation' => 'طريقة النقل',
    'notFound' => 'لا يوجد',
    'Shipment From' => 'الشحن من',
    'Shipment to' => 'الشحن إلى',
    'Arrival Date' => 'تاريخ الوصول',
    'Port' => 'المنفذ',
    'Select country' => 'حدد الدولة',

    // support
    'Hello, how can we help?' => 'مرحبا، كيف يمكننا المساعدة؟',
    'choose a category to' => 'اختر فئة للعثور بسرعة على المساعدة التي تحتاجها',
    'My Support Tickets' => 'تذاكر الدعم الخاصة بي',
    'tickets' => 'تذاكر',
    'Support Tickets' => 'تذاكر الدعم الفني',
    'category' => 'الفئة',
    'supject' => 'موضوع',

    // 
    'payment' => 'الدفع',
    'My_Invoices' => 'فواتيرى',
    'discount' => 'تخفيض',
    'comment' => 'التعليق',
    'View all notifications' => 'عرض كل الاشعارات',
    'notifications' => 'الاشعارات',
    'needShiping' => 'يشمل نقل',
    'from' => 'من',
    'to' => 'الي',
    'Agent' => 'مخلص',
    'project details' => 'بيانات المشروع',
    'Request to end the project from the agent' => 'طلب إنهاء المشروع من الوكيل',
    'license number' => 'رقم الترخيص',


    'files' => 'الملفات',
    'Payment Required' => 'طلب دفع',
    'The summary was evaluated at' => 'تم تقييم التخليص بـ ',
    'Pay now' => 'ادفع الان',
    'show invoices' => 'عرض الفواتير',
    'code' => 'كود',
    'Add an invoice or payment instrument' => 'أضف فاتورة',
    'Confirm clearance completion' => 'تأكيد إتمام التخليص',
    'The latest copy of the customs declaration' => 'أحدث نسخة من البيان الجمركي',
    'Transportation ends and shipment arrives' => 'انتهاء النقل ووصول الشحنة',
    'Reject' => 'Reject',
    'create support ticket' => 'انشاء تذكرة دعم',
    'Payment problems' => 'مشاكل في الدفع',
    'Problems in the clearance process' => 'مشاكل في عملية التخليص',
    'Another question' => 'سؤال آخر',

    'Account Settings' => 'اعدادات الحساب',
    'Account' => 'الحساب',
    'Profile Details' => 'تفاصيل الملف الشخصي',

    'Help us make marketplace safe' => 'ساعدنا في جعل منصتنا مكانًا آمنًا عن طريق التحقق من حسابك',
    'Verification status' => 'حالة التحقق',
    'Verified at' => ' ',
    'not yet' => 'not yet',
    'The account has not been verified' => 'لم يتم التحقق من الحساب',
    'Verification documents' => 'وثائق التحقق',
    'Account verified' => 'تم التحقق من الحساب',
    'approved' => 'تمت الموافقة عليه',

    'total_proposals' => 'كل عروضي',
    'type' => 'النوع',
    'min' => 'الحد الادني',

    'Add a price quote for the project' => 'أضف عرض سعر للمشروع',
    'Send Proposal' => 'أرسل العرض',
    'Add Budget' => 'إضافة الميزانية',
    'Add Note' => 'اضف ملاحظة',
    'custom millstone' => 'إضافة خطوة مخصصة',
    'Add a custom millstone for the project' => 'أضف خطوة مخصصة للمشروع',
    'millstone name' => 'الاسم',
    'edit' => 'تعديل',
    'Send Invoice' => 'أرسل فاتورة',
    'Send invoice to customer' => 'إرسال فاتورة إلى العميل لإتمام عملية التخليص',
    'Code or Link' => 'الكود أو الرابط',
    'Total Amount' => 'المبلغ الإجمالي',
    'Invoice details' => 'تفاصيل الفاتورة',
    'Send request to terminate the clearance' => 'إرسال طلب إنهاء التخليص',
    'The latest copy of the customs declaration' => 'أحدث نسخة من البيان الجمركي',
    'Are there any restrictions on the shipment?' => 'هل هناك أي قيود على الشحنة؟',
    'I declare that I have completed the work in accordance with the' => 'أقر بأنني أكملت العمل وفقًا للسياسة',
    'Edit request' => 'تعديل الطلب',
    'Payout History' => 'سجل السحب',
    'Updated' => 'محدث',
    'purpose' => 'الغرض',
    'Search Filter' => 'البحث',
    'reset' => 'إعادة',
    'PAY' => 'دفع',
    'CVC Code' => 'CVC Code',
    'year' => 'السنة',
    'month' => 'الشهر',
    'Card Number' => 'رقم البطاقة',

    'complete now' => 'أكمل الآن',
    'request sent' => 'تم ارسال الطلب',
    'proposal sent' => 'تم إرسال العرض',
    'proposal approved' => 'تمت الموافقة على العرض',
    'project Completed' => 'اكتمل المشروع',
    'Add millstone' => 'اضف خطوة في مسار التخليص',
    'Add invoice' => 'ارسل فاتورة',

    'Terms of Service' => 'شروط الخدمة',
    'Privacy Policy' => 'سياسة الخصوصية',
    'Last Updated' => 'آخر تحديث',

    'Freight Forwarding' => 'شحن البضائع',
    'Freight Forwarding description' => 'نقوم بتنظيم وإدارة عمليات الشحن الدولي للبضائع وتوفير النقل والتخليص الجمركي',
    'Traiff Classification' => 'الامتثال لقوانين وأنظمة الجمارك',
    'Traiff Classification description' => 'نقوم بتصنيف بضائعك حسب التعرفة الجمركية المناسبة، مما يضمن الامتثال لقوانين وأنظمة الجمارك المحلية والدولية.',
    'Duty and Tax Calculation' => 'حساب الرسوم والضرائب',
    'Duty and Tax Calculation description' => 'نقوم بحساب الرسوم الجمركية والضرائب المتعلقة بالاستيراد والتصدير، مما يضمن إجراء حسابات دقيقة والامتثال للتشريعات الجمركية.',
    'Customs Valuation Assistance' => 'المساعدة في التقييم الجمركي',
    'Customs Valuation Assistance description' => 'نحن نساعد في تحديد القيمة الجمركية للبضائع المستوردة، وضمان الامتثال لأساليب التقييم الجمركي المعترف بها دوليا.',

    'Welcome to ClearForce' => 'مرحبًا بك في ClearForce.',
    'Welcome alert description' => 'نأمل أن تستمتع بخدمتنا. إذا وجدت أي مشكلة، يرجى الاتصال بنا',
    'company' => 'الشركة',
    'storage' => 'تخزين',


];
