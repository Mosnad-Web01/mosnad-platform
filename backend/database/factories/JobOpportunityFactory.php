<?php

namespace Database\Factories;

use App\Models\JobOpportunity;
use App\Models\User;
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
                'مدير تسويق رقمي',
            ]),
            'description' => $this->faker->randomElement([
                'فرصة عمل مثالية للراغبين في تطوير مهاراتهم في البرمجة.',
                'الوظيفة تتطلب خبرة لا تقل عن سنتين في إدارة المشاريع.',
                'نبحث عن محترف لديه خبرة في تصميم واجهات المستخدم.',
                'فرصة مميزة للعمل مع فريق متنوع في مجال الشبكات.',
                'نبحث عن شخص مبدع في التسويق الرقمي.',
            ]),
            'required_skills' => $this->faker->randomElement([
                'إتقان PHP و MySQL',
                'مهارات القيادة والعمل الجماعي',
                'معرفة أدوات التصميم الحديثة مثل Figma',
                'إدارة الشبكات والعمل مع Cisco',
                'إنشاء حملات تسويقية ناجحة عبر الإنترنت',
            ]),
            'experience' => $this->faker->randomElement([
                'سنة - سنتين',
                '3-5 سنوات',
                '5+ سنوات',
            ]),
            'position_level' => $this->faker->randomElement([
                'مستوى مبتدئ',
                'مستوى متوسط',
                'مستوى خبير',
            ]),
            'other_criteria' => $this->faker->randomElement([
                'يجب أن يكون لديه القدرة على العمل تحت الضغط.',
                'مرونة في العمل مع فرق عمل متعددة الجنسيات.',
                'إجادة اللغة الإنجليزية كتابة وتحدثًا.',
                'التفكير الإبداعي وحل المشكلات.',
                'الالتزام بالمواعيد النهائية.',
            ]),
            'imgurl' => $this->faker->imageUrl(640, 480, 'jobs', true),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        ];
    }

    /**
     * Configure the factory.
     *
     * @return static
     */
    public function configure()
    {
        // Create 10 students (role_id = 3)
        $students = User::factory(10)->create(['role_id' => 3]);
        return $this->afterCreating(function (JobOpportunity $jobOpportunity) {
            // Get random students (users with role_id = 3)
            $students = User::where('role_id', 3)->inRandomOrder()->take(rand(1, 5))->pluck('id');

            // Attach students to this job opportunity
            $jobOpportunity->applicants()->attach($students);
        });
    }
}
