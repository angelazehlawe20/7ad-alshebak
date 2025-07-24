<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Offer;
use App\Models\Category;
use App\Models\Setting;
use App\Models\About;
use App\Models\Hero_Page;
use Faker\Factory as Faker;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        $fakerAr = Faker::create('ar_SA');
        $fakerEn = Faker::create('en_US');

        // Create 5 categories
        $categories = [];
        $categoryNamesAr = ['المقبلات', 'الأطباق الرئيسية', 'المشروبات', 'الحلويات', 'السلطات'];
        $categoryNamesEn = ['Appetizers', 'Main Dishes', 'Beverages', 'Desserts', 'Salads'];

        for ($i = 0; $i < count($categoryNamesAr); $i++) {
            $categories[] = Category::create([
                'name_ar' => $categoryNamesAr[$i],
                'name_en' => $categoryNamesEn[$i],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Menu items data
        $menuItems = [
            'Appetizers' => [
                ['حمص بالطحينة', 'Hummus', 'حمص مع زيت الزيتون والصنوبر', 'Creamy chickpea dip with tahini, olive oil and pine nuts', 25],
                ['متبل باذنجان', 'Moutabal', 'باذنجان مشوي مع طحينة وزيت زيتون', 'Grilled eggplant dip with tahini and olive oil', 23],
                ['تبولة لبنانية', 'Tabbouleh', 'سلطة البقدونس مع البرغل والطماطم', 'Parsley salad with bulgur and tomatoes', 20],
                ['فتوش', 'Fattoush', 'سلطة الخضار مع الخبز المحمص', 'Mixed vegetable salad with toasted bread', 22],
            ],
            'Main Dishes' => [
                ['مشاوي مشكلة', 'Mixed Grill', 'تشكيلة من اللحوم المشوية مع الأرز والخضار', 'Assorted grilled meats with rice and vegetables', 120],
                ['كبسة لحم', 'Meat Kabsa', 'أرز مع لحم الضأن المطبوخ والبهارات', 'Rice with cooked lamb and spices', 85],
                ['مندي دجاج', 'Chicken Mandi', 'دجاج مطهو على الفحم مع الأرز البسمتي', 'Coal-cooked chicken with basmati rice', 75],
                ['برياني لحم', 'Meat Biryani', 'أرز بسمتي مع اللحم والتوابل الهندية', 'Basmati rice with meat and Indian spices', 90],
            ],
            'Beverages' => [
                ['عصير برتقال طازج', 'Fresh Orange Juice', 'عصير برتقال طبيعي 100%', '100% natural orange juice', 15],
                ['ليموناضة نعناع', 'Mint Lemonade', 'ليمون طازج مع النعناع', 'Fresh lemon juice with mint', 14],
                ['شاي مغربي', 'Moroccan Tea', 'شاي أخضر مع النعناع', 'Green tea with fresh mint', 12],
                ['قهوة عربية', 'Arabic Coffee', 'قهوة عربية تقليدية مع الهيل', 'Traditional Arabic coffee with cardamom', 18],
            ],
            'Desserts' => [
                ['كنافة نابلسية', 'Kunafa', 'كنافة محشوة بالجبنة مع القطر', 'Shredded pastry filled with cheese and syrup', 35],
                ['أم علي', 'Umm Ali', 'حلوى مخبوزة بالكريمة والمكسرات', 'Baked dessert with cream and nuts', 30],
                ['بقلاوة', 'Baklava', 'عجينة الفيلو مع المكسرات والقطر', 'Phyllo pastry with nuts and syrup', 25],
                ['مهلبية', 'Muhalabia', 'حلوى الحليب التقليدية مع الفستق', 'Traditional milk pudding with pistachios', 20],
            ],
            'Salads' => [
                ['سلطة يونانية', 'Greek Salad', 'خضار طازجة مع جبنة الفيتا والزيتون', 'Fresh vegetables with feta cheese and olives', 30],
                ['سلطة سيزر', 'Caesar Salad', 'خس روماني مع صوص السيزر والدجاج', 'Romaine lettuce with caesar dressing and chicken', 35],
                ['سلطة الشمندر', 'Beetroot Salad', 'شمندر مع الجرجير والجبنة', 'Beetroot with rocket and cheese', 28],
                ['سلطة الكينوا', 'Quinoa Salad', 'كينوا مع الخضار المشكلة', 'Quinoa with mixed vegetables', 32],
            ],
        ];

        // Create menu items
        foreach ($categories as $category) {
            $items = $menuItems[$category->name_en];
            foreach ($items as $item) {
                MenuItem::create([
                    'name_ar' => $item[0],
                    'name_en' => $item[1],
                    'description_ar' => $item[2],
                    'description_en' => $item[3],
                    'price' => $item[4],
                    'category_id' => $category->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        // Create offers
        $offers = [
            ['وجبة عائلية مميزة', 'Special Family Meal', 'مشاوي مشكلة مع الأرز والسلطات والحلويات، يكفي 4 أشخاص', 'Mixed grills with rice, salads and desserts, serves 4', 250],
            ['عرض الغداء', 'Lunch Offer', 'طبق رئيسي مع سلطة ومشروب', 'Main dish with salad and drink', 75],
            ['وجبة الإفطار الشرقية', 'Oriental Breakfast', 'فطور شرقي كامل مع الشاي والقهوة', 'Complete oriental breakfast with tea and coffee', 65],
            ['عرض المقبلات', 'Appetizer Platter', 'تشكيلة من المقبلات الباردة والساخنة', 'Selection of cold and hot appetizers', 90],
            ['صينية الحلويات المشكلة', 'Dessert Platter', 'تشكيلة من الحلويات الشرقية', 'Assorted oriental desserts', 85],
        ];

        foreach ($offers as $offer) {
            Offer::create([
                'title_ar' => $offer[0],
                'title_en' => $offer[1],
                'description_ar' => $offer[2],
                'description_en' => $offer[3],
                'price' => $offer[4],
                'category_id' => $fakerEn->randomElement($categories)->id,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Create settings
        Setting::create([
            'address_ar' => 'دمشق, الحمراء, فندق بلو تاور,الطابق 11',
            'address_en' => 'Damascus, Al-Hamra, Blue Tower Hotel, 11th Floor',
            'email' => 'opperation@7ad-alshebak.com',
            'phone' => '0512345678',
            'opening_hours' => '24 / 7',
            'facebook_url' => 'https://facebook.com/7ad-alshebak',
            'instagram_url' => 'https://instagram.com/7ad-alshebak',
            'whatsapp' => '966512345678',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create about page
        About::create([
            'main_text_ar' => 'مطعم حد الشباك هو وجهتك المثالية لتذوق أشهى المأكولات الشرقية والعالمية. نقدم لكم تجربة طعام فريدة في أجواء عصرية وراقية. يتميز مطعمنا باستخدام أجود أنواع المكونات الطازجة والتحضير اليومي لجميع أطباقنا. يقع مطعمنا في قلب المدينة ويوفر إطلالة رائعة مع خدمة متميزة وقائمة طعام متنوعة تناسب جميع الأذواق.',
            'main_text_en' => 'Had Alshebak Restaurant is your perfect destination for the most delicious Oriental and International cuisine. We offer a unique dining experience in a modern and elegant atmosphere. Our restaurant is distinguished by using the finest fresh ingredients and daily preparation of all our dishes. Located in the heart of the city, our restaurant offers a wonderful view with excellent service and a diverse menu that suits all tastes.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create hero page
        Hero_Page::create([
            'title_ar' => 'حد الشباك',
            'title_en' => 'Had Alshebak',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
