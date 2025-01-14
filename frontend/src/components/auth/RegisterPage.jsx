'use client';
import Image from 'next/image';
import { useState } from 'react';
import RegisterForm from '@/components/auth/form/RegisterForm';
import RightBackgroundImg from '@/components/auth/RightBackgroundImg';
import { FaFacebook, FaInstagram, FaTwitter, FaYoutube } from 'react-icons/fa';

const RegisterPage = () => {
	const [activeOption, setActiveOption] = useState('company');

	return (
		<div className="relative bg-pink-100 lg:bg-white overflow-hidden shadow-xl rounded-2xl py-4">
			{/* SVG Background */}
			<RightBackgroundImg imgSrc="/form-bg.svg" />

			{/* Main Content */}
			<div className="relative max-w-screen-xl mx-auto px-4 py-6 lg:px-8 lg:py-2">
				<div className="flex flex-col-reverse lg:flex-row justify-between items-center gap-12 lg:gap-20">
					{/* Right Side - Form */}
					<RegisterForm
						activeOption={activeOption}
						setActiveOption={setActiveOption}
					/>

					{/* Left Side - Content */}
					<div className="w-full lg:w-1/2 order-1 lg:order-2 text-center lg:text-right rounded-2xl p-6 lg:p-8">
						<div className="flex flex-col justify-between items-center">
							<Image
								src={
									activeOption === 'company'
										? '/register-left-img.svg'
										: '/register2-left-img.svg'
								}
								alt="Form Image"
								width={400}
								height={400}
								className="w-full h-auto"
							/>

							{activeOption === 'company' ? (
								<h1 className="text-xl lg:text-xl font-bold text-gray-800 mb-6">
									البحث عن الشخص المناسب بالمكان المناسب وأنت
									فيه!
								</h1>
							) : (
								<h1 className="text-xl lg:text-xl font-bold text-gray-800 mb-6 text-center">
									وراء كل مشروع برمجي، مُسند أكبر منصة تجمع،
									تؤهل، وتوظّف المهارات البرمجية اليمنية
								</h1>
							)}

							<div className="mb-4 flex justify-center gap-4">
								<div>
									<p className="text-gray-600">
										<a
											href="tel:+967718660990"
											className="font-medium">
											الهاتف: +967781806090
										</a>
									</p>
								</div>
								<div>
									<p className="text-gray-600">
										<a
											href="mailto:info@mosnad.com"
											className="font-medium">
											البريد الالكتروني: info@mosnad.com
										</a>
									</p>
								</div>
							</div>
							<div className="mb-4">
								<h2 className="text-xl font-mediam text-blue-900">
									تابعنا عبر السوشيال ميديا
								</h2>
							</div>

							{/* Social Icons */}
							<div className="flex gap-4 justify-center">
								{[
									FaFacebook,
									FaInstagram,
									FaTwitter,
									FaYoutube,
								].map((Icon, index) => (
									<a
										key={index}
										href="#"
										className="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-pink-500 hover:text-white transition-colors">
										<Icon className="w-5 h-5" />
									</a>
								))}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	);
};

export default RegisterPage;
