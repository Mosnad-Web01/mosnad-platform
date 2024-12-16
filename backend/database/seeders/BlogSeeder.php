<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arabicBlogs = [
            [
                'title' => 'فوائد ممارسة التأمل يومياً',
                'content' => 'التأمل يساعد على تقليل التوتر، تعزيز التركيز، وتحسين الصحة النفسية. جرب ممارسة التأمل يومياً للحصول على حياة أكثر هدوءاً.',
                'meta_title' => 'أهمية التأمل',
                'meta_description' => 'كيف يمكن للتأمل أن يحسن من صحتك العقلية والجسدية؟',
                'meta_keywords' => json_encode(['تأمل', 'صحة نفسية', 'هدوء']),
                'tags' => json_encode(['صحة', 'روتين']),
                'categories' => json_encode(['صحة', 'نمط حياة']),
                'images' => json_encode([
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                ]),
            ],
            [
                'title' => 'كيف تبدأ يومك بنشاط وحيوية',
                'content' => 'ابدأ يومك بمزيج من العادات الصحية مثل ممارسة الرياضة وتناول وجبة فطور مغذية. هذه النصائح ستساعدك على تحسين مزاجك وزيادة إنتاجيتك طوال اليوم.',
                'meta_title' => 'نصائح لبداية يوم نشيط',
                'meta_description' => 'تعرف على كيفية بدء يومك بنشاط من خلال عادات صحية سهلة.',
                'meta_keywords' => json_encode(['نشاط', 'حيوية', 'روتين صباحي']),
                'tags' => json_encode(['صحة', 'روتين']),
                'categories' => json_encode(['صحة', 'نمط حياة']),
                'images' => json_encode([
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                ]),
            ],
            [
                'title' => 'أفضل الأماكن للاستمتاع بالطبيعة في الشرق الأوسط',
                'content' => 'استمتع بجمال الطبيعة الخلابة في الشرق الأوسط، من الجبال الشاهقة في لبنان إلى الصحاري الذهبية في الإمارات. اكتشف الأماكن التي تلهمك وتعيد إليك الطاقة.',
                'meta_title' => 'أماكن طبيعية في الشرق الأوسط',
                'meta_description' => 'دليل لأجمل الأماكن الطبيعية في الشرق الأوسط التي تستحق الزيارة.',
                'meta_keywords' => json_encode(['طبيعة', 'سياحة', 'الشرق الأوسط']),
                'tags' => json_encode(['سياحة', 'طبيعة']),
                'categories' => json_encode(['سفر', 'ترفيه']),
                'images' => json_encode([
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                ]),
            ],

            [
                'title' => 'أهمية شرب الماء لصحتك',
                'content' => 'شرب الماء الكافي يومياً يساعد على تحسين وظائف الجسم، تعزيز الطاقة، وتنظيف الجسم من السموم. تعرف على أهمية الحفاظ على ترطيب جسمك.',
                'meta_title' => 'فوائد شرب الماء',
                'meta_description' => 'لماذا يعد شرب الماء ضرورياً للحفاظ على الصحة العامة؟ تعرف على التفاصيل.',
                'meta_keywords' => json_encode(['ماء', 'صحة', 'ترطيب']),
                'tags' => json_encode(['صحة', 'عناية بالجسم']),
                'categories' => json_encode(['صحة', 'نمط حياة']),
                'images' => json_encode([
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                ]),
            ],
            [
                'title' => 'كيف تخطط لعطلتك القادمة؟',
                'content' => 'التخطيط الجيد للعطلة يضمن لك تجربة لا تنسى. حدد الوجهة، حجز الإقامة، وتنظيم الأنشطة مسبقاً لتجنب أي مفاجآت.',
                'meta_title' => 'خطوات تخطيط العطلة',
                'meta_description' => 'نصائح عملية لتخطيط عطلتك القادمة بأفضل طريقة ممكنة.',
                'meta_keywords' => json_encode(['سفر', 'تخطيط', 'إجازة']),
                'tags' => json_encode(['سياحة', 'ترفيه']),
                'categories' => json_encode(['سفر', 'ترفيه']),
                'images' => json_encode([
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                ]),
            ],
            [
                'title' => 'أفضل النصائح لتحسين جودة النوم',
                'content' => 'تحسين جودة النوم يتطلب الالتزام بروتين نوم منتظم، تجنب الكافيين قبل النوم، وتهيئة بيئة مريحة للنوم.',
                'meta_title' => 'طرق تحسين النوم',
                'meta_description' => 'دليل لتحسين نومك اليومي والحصول على راحة أفضل.',
                'meta_keywords' => json_encode(['نوم', 'راحة', 'صحة']),
                'tags' => json_encode(['صحة', 'نمط حياة']),
                'categories' => json_encode(['صحة', 'عناية بالجسم']),
                'images' => json_encode([
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                ]),
            ],
            [
                'title' => 'كيف تبدأ مشروعك الخاص؟',
                'content' => 'للبدء في مشروعك الخاص، حدد فكرة المشروع، قم بإجراء دراسة جدوى، واحصل على التمويل اللازم. الخطوة الأولى تبدأ بالحلم والعمل الجاد.',
                'meta_title' => 'دليل بدء المشاريع',
                'meta_description' => 'كل ما تحتاج معرفته لبدء مشروعك الخاص وتحقيق النجاح.',
                'meta_keywords' => json_encode(['مشروع', 'ريادة الأعمال', 'نجاح']),
                'tags' => json_encode(['ريادة أعمال', 'عمل']),
                'categories' => json_encode(['أعمال', 'إلهام']),
                'images' => json_encode([
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                ]),
            ],
            [
                'title' => 'كيف تبدأ يومك بنشاط وحيوية',
                'content' => 'ابدأ يومك بمزيج من العادات الصحية مثل ممارسة الرياضة وتناول وجبة فطور مغذية. هذه النصائح ستساعدك على تحسين مزاجك وزيادة إنتاجيتك طوال اليوم.',
                'meta_title' => 'نصائح لبداية يوم نشيط',
                'meta_description' => 'تعرف على كيفية بدء يومك بنشاط من خلال عادات صحية سهلة.',
                'meta_keywords' => json_encode(['نشاط', 'حيوية', 'روتين صباحي']),
                'tags' => json_encode(['صحة', 'روتين']),
                'categories' => json_encode(['صحة', 'نمط حياة']),
                'images' => json_encode([
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                ]),
            ],
            [
                'title' => 'فوائد ممارسة التأمل يومياً',
                'content' => 'التأمل يساعد على تقليل التوتر، تعزيز التركيز، وتحسين الصحة النفسية. جرب ممارسة التأمل يومياً للحصول على حياة أكثر هدوءاً.',
                'meta_title' => 'أهمية التأمل',
                'meta_description' => 'كيف يمكن للتأمل أن يحسن من صحتك العقلية والجسدية؟',
                'meta_keywords' => json_encode(['تأمل', 'صحة نفسية', 'هدوء']),
                'tags' => json_encode(['صحة', 'روتين']),
                'categories' => json_encode(['صحة', 'نمط حياة']),
                'images' => json_encode([
                    $this->randomImageUrl(),
                    $this->randomImageUrl(),
                ]),
            ],
        ];


        foreach ($arabicBlogs as $blog) {
            Blog::create(array_merge($blog, [
                'user_id' => \App\Models\User::where('id', 1)->inRandomOrder()->first()->id ?? \App\Models\User::factory(),
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
        foreach ($arabicBlogs as $blog) {
            Blog::create(array_merge($blog, [
                'user_id' => \App\Models\User::where('role_id', 1)->inRandomOrder()->first()->id ?? \App\Models\User::factory(),
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    /**
     * Generate a random image URL from Picsum.
     *
     * @return string
     */
    private function randomImageUrl(): string
    {

        $randomSeed = rand(0, 100000);
        return "http://picsum.photos/seed/{$randomSeed}/300/200";
    }
}
