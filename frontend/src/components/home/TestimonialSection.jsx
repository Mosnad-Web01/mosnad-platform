'use client';
import { useState } from 'react';
import { FiChevronLeft, FiChevronRight } from 'react-icons/fi';

const testimonials = [
	{
		content:
			'يعطيكم العافية يا رب على إتاحة المهمة لي حيثها وأنجزتها الحمد لله بعد اليوم الأول وكسبت ثقة ومهارات الحمد لله أتمنى تكرارها ولكم جزيل الشكر والتقدير.',
		name: 'جبيران خليل علي',
		role: 'متدرب',
	},
	{
		content:
			'كانت تجربة رائعة حقاً! أود أن أشكر الفريق على دعمهم المستمر والثقة التي منحوني إياها لإنجاز المهمة بنجاح.',
		name: 'محمد أحمد',
		role: 'طالب',
	},
	{
		content:
			'شكراً لكم جميعاً على إتاحة الفرصة لي للعمل على هذا المشروع، اكتسبت خبرة رائعة وأتمنى العمل معكم مجدداً.',
		name: 'سارة علي',
		role: 'متدربة',
	},
];

const TestimonialSection = () => {
	const [currentIndex, setCurrentIndex] = useState(0);

	const handleNext = () => {
		setCurrentIndex((prevIndex) => (prevIndex + 1) % testimonials.length);
	};

	const handlePrev = () => {
		setCurrentIndex(
			(prevIndex) =>
				(prevIndex - 1 + testimonials.length) % testimonials.length,
		);
	};

	return (
		<div
			className="w-full max-w-2xl mx-auto px-10 md:px-36 py-8 bg-white rounded-[45px] shadow-lg text-center relative "
			style={{
				borderWidth: '8px 0px',
				borderStyle: 'solid',
				borderColor: '#7351A1',
				height: '320px',
			}}>
			{/* Header */}
			<h2 className="text-xl font-bold text-[#353272] ">آراء عملائنا</h2>

			{/* Testimonial Content */}
			<div className="overflow-hidden flex items-center justify-center h-[180px]">
				<p className="text-gray-700 leading-relaxed">
					{testimonials[currentIndex].content}
				</p>
			</div>

			{/* Name and Role */}
			<div className="mt-2">
				<p className="font-semibold text-gray-800">
					{testimonials[currentIndex].name}
				</p>
				<p className="text-gray-500">
					{testimonials[currentIndex].role}
				</p>
			</div>

			{/* Navigation Buttons */}
			<button
				onClick={handlePrev}
				className="absolute top-1/2 -left-6 transform -translate-y-1/2 bg-[#7351A1] rounded-full p-2 text-purple-50 hover:bg-purple-800"
				aria-label="Previous">
				<FiChevronLeft size={26} />
			</button>
			<button
				onClick={handleNext}
				className="absolute top-1/2 -right-6 transform -translate-y-1/2 bg-[#7351A1] rounded-full p-2 text-purple-50 hover:bg-purple-800"
				aria-label="Next">
				<FiChevronRight size={26} />
			</button>
		</div>
	);
};

export default TestimonialSection;
