<?php

namespace Database\Factories;

use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ar' => "من نحن؟",
            'title_en' => "Who we are?",
            'first_text_ar' => 'تأسست شركة مخازن المملكة عام 2009 وسرعان ما رسخت مكانتها كواحدة من الشركات الرائدة في قطاع التجزئة في المملكة العربية السعودية
تُشغّل مخازن نوعين من المتاجر؛ هايبر مخازن (متاجر كبرى) ومخازن سوبرماركت ومع أكثر من ٢٠ مليون عميل يزورون متاجرنا كل عام، نُشغّل 2 مراكز
توزيع رئيسية في المملكة مع أسطول مكوّن من أكثر من 50 شاحنة لتوصيل 40 ألف صنف من المنتجات الغذائية وغير الغذائية إلى متاجرنا',
            'first_text_en' => $this->faker->sentence(40),
            'second_text_ar' => 'تأسست شركة مخازن المملكة عام 2009 وسرعان ما رسخت مكانتها كواحدة من الشركات الرائدة في قطاع التجزئة في المملكة العربية السعودية
تُشغّل مخازن نوعين من المتاجر؛ هايبر مخازن (متاجر كبرى) ومخازن سوبرماركت ومع أكثر من ٢٠ مليون عميل يزورون متاجرنا كل عام، نُشغّل 2 مراكز
توزيع رئيسية في المملكة مع أسطول مكوّن من أكثر من 50 شاحنة لتوصيل 40 ألف صنف من المنتجات الغذائية وغير الغذائية إلى متاجرنا',
            'second_text_en' => $this->faker->sentence(40),
            'image' => 'https://picsum.photos/200/300',
        ];
    }
}
