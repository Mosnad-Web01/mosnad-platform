<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOpportunity>
 */
class JobOpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                'مطور برمجيات',
                'مدير مشروع',
                'مهندس شبكات',
                'مصمم واجهات المستخدم',
                'مدير تسويق رقمي'
            ]),
            'description' => $this->faker->randomElement([
                'فرصة عمل مثالية للراغبين في تطوير مهاراتهم في البرمجة.',
                'الوظيفة تتطلب خبرة لا تقل عن سنتين في إدارة المشاريع.',
                'نبحث عن محترف لديه خبرة في تصميم واجهات المستخدم.',
                'فرصة مميزة للعمل مع فريق متنوع في مجال الشبكات.',
                'نبحث عن شخص مبدع في التسويق الرقمي.'
            ]),
            'required_skills' => $this->faker->randomElement([
                'إتقان PHP و MySQL',
                'مهارات القيادة والعمل الجماعي',
                'معرفة أدوات التصميم الحديثة مثل Figma',
                'إدارة الشبكات والعمل مع Cisco',
                'إنشاء حملات تسويقية ناجحة عبر الإنترنت'
            ]),
            'experience' => $this->faker->randomElement([
                'سنة - سنتين',
                '3-5 سنوات',
                '5+ سنوات'
            ]),
            'position_level' => $this->faker->randomElement([
                'مستوى مبتدئ',
                'مستوى متوسط',
                'مستوى خبير'
            ]),
            'other_criteria' => $this->faker->randomElement([
                'يجب أن يكون لديه القدرة على العمل تحت الضغط.',
                'مرونة في العمل مع فرق عمل متعددة الجنسيات.',
                'إجادة اللغة الإنجليزية كتابة وتحدثًا.',
                'التفكير الإبداعي وحل المشكلات.',
                'الالتزام بالمواعيد النهائية.'
            ]),
            'imgurl' => $this->faker->imageUrl(640, 480, 'jobs', true),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        ];
    }
}
