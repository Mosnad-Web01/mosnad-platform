import Image from 'next/image';
import React from 'react';
import { FaArrowLeft } from 'react-icons/fa';
import CareerPathCard from './CareerPathCard';

const CareerPathSection = () => {
	const careerPoints = [
		{ label: 'وظائف تناسبك', imageSrc: '/suitable-job-card-img.png' },
		{ label: 'حقق احلامك', imageSrc: '/achieve-your-dream.png' },
		{ label: 'نسعدك خلال التجربة', imageSrc: '/support-card-img.png' },
	];
	return (
		<section className="max-w-screen-xl mx-auto bg-purple-50 py-10 rounded-xl shadow-lg overflow-hidden mt-10 ">
			{/* Title */}
			<header className=" text-center mb-4 md:mb-10">
				<h1 className="text-xl md:text-[32px] font-bold text-[#F03F74]">
					مسند تحقق لك طموحك
				</h1>
			</header>

			<div className="flex flex-col md:flex-row ">
				{/* Right Section: Content */}
				<div className="lg:w-2/3 px-10 py-4 md:py-10 flex flex-col">
					{/* Subtitle */}
					<article className="text-right space-y-4 my-4">
						<div>
							<h2 className="text-xl md:text-[28px] font-bold text-black text-right ">
								مسار التوظيف السريع
							</h2>
						</div>
						<div className="md:max-w-[70%] lg:max-w-[90%]">
							{/* Description */}
							<p className="text-lg font-light text-right leading-7">
								مسار مخصص للمتميزين بخبرة سنة أو أكثر في
								التخصصات التقنية وتطوير الأعمال. نوفر لك فرص
								وظيفية تناسب تطلعاتك وخبراتك من مختلف الشركات.
							</p>
						</div>
					</article>

					<div className="flex justify-end gap-3 items-center my-4 md:my-2 cursor-pointer ">
						<div>
							<span className="text-blue-700 text-sm md:text-base">
								معرفة المزيد
							</span>
						</div>
						<div>
							{/* Arrow Icon */}
							<FaArrowLeft className="w-4 h-4 text-blue-700" />
						</div>
					</div>

					{/* Card Paths Container */}
					<div className="flex flex-wrap md:flex-row justify-start items-center gap-8 ">
						{careerPoints.map((point, index) => (
							<div
								key={index}
								className="w-full sm:w-1/2 md:w-auto flex justify-center">
								<CareerPathCard
									label={point.label}
									imageSrc={point.imageSrc}
								/>
							</div>
						))}
					</div>

					{/* Button Container */}
					<div className="flex flex-col space-y-6 mt-12">
						<h3 className="font-medium text-purple-700 text-right text-sm ">
							سجل في الاستمارة وخلي اعمالك تروح إلى بعيد
						</h3>
						{/* Button */}
						<div className="flex justify-start">
							<button className="bg-gradient text-white px-6 py-3 rounded-lg shadow hover:bg-pink-700 transition">
								التقديم لمسار التوظيف السريع
							</button>
						</div>
					</div>
				</div>

				{/* Left Section: Image */}
				<div className="hidden lg:w-1/3 py-8 lg:flex justify-end ">
					<div className="relative w-[403px] h-[458px] aspect-square overflow-hidden rounded-br-full rounded-tr-full border-r-4 border-pink-500 ">
						{/* Image Placeholder */}
						<Image
							src="/career-track-img.png"
							alt="Career Fast Track"
							fill
							className="w-full h-full object-cover"
						/>
					</div>
				</div>
			</div>
		</section>
	);
};

export default CareerPathSection;
