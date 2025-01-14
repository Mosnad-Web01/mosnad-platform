'use client';
import React, { useState } from 'react';
import { FaBuilding, FaUserTie } from 'react-icons/fa';
import ToggleButtonGroup from '../common/ToggleButtonGroup';
import CurvedCard from './CurvedCard';
import Link from 'next/link';

const HeroSection = () => {
	const [activeOption, setActiveOption] = useState('companies');

	const options = [
		{ value: 'companies', label: 'شركات', icon: <FaBuilding /> },
		{ value: 'employees', label: 'كفاءات', icon: <FaUserTie /> },
	];

	const handleOptionChange = (value) => {
		setActiveOption(value);
	};

	const data = [
		{
			id: 1,
			image: '/company-card-icon.svg',
			title: '+50',
			subtitle: 'شركة مسجلة',
		},
		{
			id: 2,
			image: '/talented-card-icon.svg',
			title: '+130',
			subtitle: 'موهبة تقنية',
		},
		{
			id: 3,
			image: '/interns-card-icon.svg',
			title: '+50',
			subtitle: 'متدرب',
		},
	];

	// Define the button link based on the active option
	const buttonLink = activeOption === 'companies' ? '/company' : '/YouthForm';
	const buttonText = activeOption === 'companies' ? 'اطلب الخدمة' : 'ابدأ الآن';

	return (
		<>
			<section className="w-full overflow-hidden bg-pink-200/50">
				<div  className="flex flex-col items-center lg:items-start w-full max-w-screen-2xl mx-auto relative">
					{/* Background Image */}
					<div
						className="w-full h-[600px] md:h-[700px] bg-[url('/hero-bg.png')] bg-cover bg-center bg-no-repeat"
						style={{
							WebkitMaskImage:
								'linear-gradient(to right, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 96%, rgba(0,0,0,0) 100%)',
							maskImage:
								'linear-gradient(to right, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 96%, rgba(0,0,0,0) 100%)',
							WebkitMaskSize: '100% 100%',
							maskSize: '100% 100%',
							WebkitMaskRepeat: 'no-repeat',
							maskRepeat: 'no-repeat',
						}}></div>

					{/* Content Container */}
					<div  data-aos="fade-left" className="absolute right-4 md:right-10 top-4 md:top-2 px-2 md:px-4 pt-10 md:pt-20">
						<div className="max-w-[650px] mx-auto text-center flex flex-col gap-4">
							{/* Toggle Buttons */}
							<div className="w-fit mx-auto my-4 ">
								<ToggleButtonGroup
									options={options}
									activeOption={activeOption}
									onOptionChange={handleOptionChange}
									containerStyle="bg-white p-1.5 md:p-2 w-fit rounded-xl"
									buttonStyle="text-base md:text-lg font-bold text-blue-900 transition-all duration-300 hover:shadow-sm flex justify-center gap-2 rounded-full px-3 md:px-4 py-2 md:py-4 w-[120px] sm:w-[150px] md:w-[300px] text-center"
								/>
							</div>

							{/* Dynamic Heading and Paragraph based on the selected option */}
							{activeOption === 'companies' ? (
								<>
									<h1 className="text-xl sm:text-2xl md:text-3xl font-bold text-blue-900 mb-3 md:mb-6 px-2 leading-normal md:leading-snug lg:leading-relaxed">
										أهلاً بك في منصة مسند للتدريب والتوظيف
										<br />
										<span>نُسند، ونُستند</span>
									</h1>

									<p className="text-base md:text-lg text-gray-700 mb-6 md:mb-8 leading-relaxed md:leading-loose lg:leading-loose">
										البحث عن الشخص المناسب بالزمن المناسب، وأنت فيه.
										حرصنا على احتياجاتك ونلبيه لك بقاعدة بيانات مؤهلة وجاهزة للعمل تحت إشرافنا التام.
									</p>
								</>
							) : (
								<>
									<h1 className="text-xl sm:text-2xl md:text-3xl font-bold text-blue-900 mb-3 md:mb-6 px-2 leading-normal md:leading-snug lg:leading-relaxed">
										طور مهاراتك مع منصتنا
										<br />
										<span>نحن نساعدك على النمو والتطور</span>
									</h1>

									<p className="text-base md:text-lg text-gray-700 mb-6 md:mb-8 leading-relaxed md:leading-loose lg:leading-loose">
										استفد من خدماتنا لتطوير مهاراتك التقنية والحصول على فرص تدريبية
										متميزة. نحن هنا لدعمك طوال رحلتك المهنية.
									</p>
								</>
							)}

							{/* CTA Button - Now using Link to navigate */}
							<div className="flex px-4 md:px-0">
								<Link href={buttonLink} className='w-full'>
									<button className="w-full py-2 md:py-3 rounded-full bg-gradient text-white text-base md:text-lg font-medium hover:shadow-lg transition-all duration-300 hover:scale-105">
										{buttonText} {/* Button text changes dynamically */}
									</button>
								</Link>
							</div>
						</div>
					</div>
				</div>
			</section>

			{/* Curved Cards Section */}
			<section   className="bg-gradient-to-b from-pink-200 to-indigo-100 p-6">
				<div data-aos="zoom-in" className="container mx-auto flex flex-col justify-evenly items-center gap-6 md:flex-row">
					{data.map((item) => (
						<CurvedCard
							key={item.id}
							id={item.id}
							image={item.image}
							title={item.title}
							subtitle={item.subtitle}
						/>
					))}
				</div>
			</section>
		</>
	);
};

export default HeroSection;
