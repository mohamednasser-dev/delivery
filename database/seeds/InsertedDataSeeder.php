<?php

use App\Models\Page;
use App\Models\Screen;
use App\Models\Setting;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;
use App\Models\OwnerType;
use App\Models\RestaurantType;
use \App\Models\Nationality;
class InsertedDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name_ar' => 'مالك',
                'name_en' => 'owner',
            ],
            [
                'id' => 2,
                'name_ar' => 'شريك',
                'name_en' => 'partner',
            ],
            [
                'id' => 3,
                'name_ar' => 'مدير',
                'name_en' => 'manager',
            ],
        ];
        foreach ($data as $row){
            OwnerType::updateOrCreate($row);
        }

        $data = [
            [
                'id' => 1,
                'name_ar' => 'مطعم',
                'name_en' => 'restaurant',
            ],
            [
                'id' => 2,
                'name_ar' => 'قهوه',
                'name_en' => 'cafe',
            ],
            [
                'id' => 3,
                'name_ar' => 'فندق',
                'name_en' => 'hotel',
            ],
        ];
        foreach ($data as $row){
            RestaurantType::updateOrCreate($row);
        }

        if(Nationality::get()->count() == 0){
            $path = public_path('sql/nationalities.sql');
            $sql = file_get_contents($path);
            DB::unprepared($sql);
        }

        //mobile screens
        $data = [
            [
                'title_ar' => 'فيديوهات تعليمية',
                'title_en' => 'learning videos',
                'body_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً',
                'body_en' => 'It is a long established fact that the readable content is on the page he is reading. To give results that give a normal distribution',
                'image' => '1.png',
            ],
            [
                'title_ar' => 'اشتراك سنوي',
                'title_en' => 'yearly subscription',
                'body_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً',
                'body_en' => 'It is a long established fact that the readable content is on the page he is reading. To give results that give a normal distribution',
                'image' => '2.png',
            ],
            [
                'title_ar' => 'تعلم سريع',
                'title_en' => 'fast learning',
                'body_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً',
                'body_en' => 'It is a long established fact that the readable content is on the page he is reading. To give results that give a normal distribution',
                'image' => '3.png',
            ],
        ];
        foreach ($data as $get) {
            Screen::updateOrCreate($get);
        }

        $data = [
            [
                'title_ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه … بروشور او فلاير على سبيل المثال او نماذج مواقع انترنتلوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                'title_en' => 'Lorem Ipsum is a virtual model that is placed in the designs to be presented to the client to visualize the way to put texts in the designs, whether they are printed designs ... a brochure or flyer, for example, or models for websites',
                'type' => 'about',
                'image' => 'about.png',
            ],
            [
                'title_ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه … بروشور او فلاير على سبيل المثال او نماذج مواقع انترنتلوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                'title_en' => 'Lorem Ipsum is a virtual model that is placed in the designs to be presented to the client to visualize the way to put texts in the designs, whether they are printed designs ... a brochure or flyer, for example, or models for websites',
                'type' => 'terms',
                'image' => 'terms.png',
            ],
            [
                'title_ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه … بروشور او فلاير على سبيل المثال او نماذج مواقع انترنتلوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                'title_en' => 'Lorem Ipsum is a virtual model that is placed in the designs to be presented to the client to visualize the way to put texts in the designs, whether they are printed designs ... a brochure or flyer, for example, or models for websites',
                'type' => 'privacy',
                'image' => 'privacy.png',
            ],
            [
                'title_ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه … بروشور او فلاير على سبيل المثال او نماذج مواقع انترنتلوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                'title_en' => 'Lorem Ipsum is a virtual model that is placed in the designs to be presented to the client to visualize the way to put texts in the designs, whether they are printed designs ... a brochure or flyer, for example, or models for websites',
                'type' => 'idea',
                'image' => 'idea.png',
            ],
            [
                'title_ar' => 'اتصل بنا ',
                'title_en' => 'call us',
                'type' => 'call_us',
                'image' => 'call_us.png',
            ],
        ];
        foreach ($data as $get) {
            Page::updateOrCreate($get);
        }

        $data = [
            [
                'link' => 'https://ar-ar.facebook.com/',
                'image' => 'facebook.png',
            ],
            [
                'link' => 'https://api.whatsapp.com/01201636129',
                'image' => 'whats_app.png',
            ],
            [
                'link' => 'https://www.youtube.com/',
                'image' => 'youtube.png',
            ],

        ];
        foreach ($data as $get) {
            SocialLink::updateOrCreate($get);
        }

        $data = [
            'site_name_ar' => 'ليما',
            'site_name_en' => 'lima',
            'phone' => '8484858845855',
            'email' => 'info@lima.com',
            'logo' => 'uploads/setting/web_logo.png',
            'login_pg' => 'uploads/setting/login_pg.png',
            'logo_login' => 'uploads/setting/login_page_logo.png',
            'location' => null,
            'address_ar' => 'المنوفية',
            'address_en' => 'al mnofia',
            'app_gif' => null,
            'android_version' => 1,
            'ios_version' => 1,
        ];
        Setting::setMany($data);
    }
}
