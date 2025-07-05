<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all();

        if ($tags->isEmpty()) {
            // If no tags exist, create some default ones
            $this->call(TagSeeder::class);
            $tags = Tag::all();
        }

        $posts = [
            [
                'title_ar' => 'التقنيات الحديثة في عام 2025',
                'title_en' => 'Modern Technologies in 2025',
                'article_ar' => 'مع تطور التقنية بوتيرة سريعة، نشهد في عام 2025 ثورة حقيقية في مجال الذكاء الاصطناعي والتعلم الآلي. هذه التقنيات الجديدة تغير طريقة عملنا وحياتنا اليومية. من السيارات ذاتية القيادة إلى المساعدات الذكية، نرى كيف أن التقنية أصبحت جزءاً لا يتجزأ من حياتنا.',
                'article_en' => 'With technology evolving at a rapid pace, we are witnessing a real revolution in the field of artificial intelligence and machine learning in 2025. These new technologies are changing the way we work and our daily lives. From self-driving cars to smart assistants, we see how technology has become an integral part of our lives.',
                'image' => 'https://picsum.photos/800/600?random=1',
                'status' => 'active',
                'tag_id' => $tags->where('tag_en', 'Technology')->first()?->id ?? $tags->first()->id,
            ],
            [
                'title_ar' => 'نصائح لنجاح الأعمال في العصر الرقمي',
                'title_en' => 'Tips for Business Success in the Digital Age',
                'article_ar' => 'في عالم الأعمال المعاصر، أصبح التحول الرقمي ضرورة وليس مجرد خيار. الشركات التي تتبنى التقنيات الحديثة وتستثمر في البنية التحتية الرقمية هي التي تحقق النجاح والنمو المستدام. من المهم أن نفهم كيفية استخدام وسائل التواصل الاجتماعي والتسويق الرقمي لبناء علامة تجارية قوية.',
                'article_en' => 'In the contemporary business world, digital transformation has become a necessity, not just an option. Companies that adopt modern technologies and invest in digital infrastructure are the ones that achieve success and sustainable growth. It is important to understand how to use social media and digital marketing to build a strong brand.',
                'image' => 'https://picsum.photos/800/600?random=2',
                'status' => 'active',
                'tag_id' => $tags->where('tag_en', 'Business')->first()?->id ?? $tags->first()->id,
            ],
            [
                'title_ar' => 'أهمية الرياضة للصحة النفسية والجسدية',
                'title_en' => 'The Importance of Sports for Mental and Physical Health',
                'article_ar' => 'تلعب الرياضة دوراً محورياً في تحسين الصحة العامة للإنسان. لا تقتصر فوائد الرياضة على الجانب الجسدي فحسب، بل تمتد لتشمل الصحة النفسية والعقلية. ممارسة الرياضة بانتظام تساعد في تقليل التوتر والقلق، وتحسن من الحالة المزاجية، وتزيد من الثقة بالنفس.',
                'article_en' => 'Sports play a pivotal role in improving human health in general. The benefits of sports are not limited to the physical aspect only, but extend to include mental and psychological health. Regular exercise helps reduce stress and anxiety, improves mood, and increases self-confidence.',
                'image' => 'https://picsum.photos/800/600?random=3',
                'status' => 'active',
                'tag_id' => $tags->where('tag_en', 'Sports')->first()?->id ?? $tags->first()->id,
            ],
            [
                'title_ar' => 'النظام الغذائي الصحي في الحياة العصرية',
                'title_en' => 'Healthy Diet in Modern Life',
                'article_ar' => 'مع نمط الحياة السريع والضغوط اليومية، أصبح من المهم أكثر من أي وقت مضى الاهتمام بالنظام الغذائي الصحي. تناول الأطعمة المتوازنة والغنية بالفيتامينات والمعادن يساعد في تقوية جهاز المناعة ويحافظ على الطاقة والحيوية.',
                'article_en' => 'With the fast-paced lifestyle and daily pressures, it has become more important than ever to pay attention to a healthy diet. Eating balanced foods rich in vitamins and minerals helps strengthen the immune system and maintain energy and vitality.',
                'image' => 'https://picsum.photos/800/600?random=4',
                'status' => 'active',
                'tag_id' => $tags->where('tag_en', 'Health')->first()?->id ?? $tags->first()->id,
            ],
            [
                'title_ar' => 'وجهات السفر المميزة لعام 2025',
                'title_en' => 'Outstanding Travel Destinations for 2025',
                'article_ar' => 'يشهد عام 2025 عودة قوية لصناعة السياحة والسفر. هناك العديد من الوجهات الجديدة والمثيرة التي تستحق الزيارة. من الشواطئ الاستوائية الخلابة إلى المدن التاريخية العريقة، يمكن للمسافرين اختيار الوجهة التي تناسب اهتماماتهم وميزانيتهم.',
                'article_en' => '2025 is witnessing a strong return of the tourism and travel industry. There are many new and exciting destinations worth visiting. From stunning tropical beaches to ancient historic cities, travelers can choose the destination that suits their interests and budget.',
                'image' => 'https://picsum.photos/800/600?random=5',
                'status' => 'active',
                'tag_id' => $tags->where('tag_en', 'Travel')->first()?->id ?? $tags->first()->id,
            ],
            [
                'title_ar' => 'التعليم الإلكتروني ومستقبل التعلم',
                'title_en' => 'E-Learning and the Future of Education',
                'article_ar' => 'لقد غيرت جائحة كوفيد-19 مشهد التعليم إلى الأبد، وأصبح التعليم الإلكتروني جزءاً أساسياً من منظومة التعليم الحديثة. المنصات التعليمية الرقمية تتيح للطلاب التعلم في أي وقت ومن أي مكان، مما يوفر مرونة أكبر وفرصاً تعليمية متنوعة.',
                'article_en' => 'The COVID-19 pandemic has forever changed the education landscape, and e-learning has become an essential part of the modern education system. Digital educational platforms allow students to learn anytime and anywhere, providing greater flexibility and diverse educational opportunities.',
                'image' => 'https://picsum.photos/800/600?random=6',
                'status' => 'active',
                'tag_id' => $tags->where('tag_en', 'Education')->first()?->id ?? $tags->first()->id,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
