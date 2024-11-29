'use client';
import Input from '@/components/common/Input';
import ToggleButtonGroup from '@/components/common/ToggleButtonGroup';
import { FiMail, FiLock, FiUser } from 'react-icons/fi';
import { FaRegBuilding, FaUserTie } from 'react-icons/fa';
import { FaFacebook, FaInstagram, FaTwitter, FaYoutube } from 'react-icons/fa';
import Image from 'next/image';
import { useState } from 'react';
import Link from 'next/link';

const RegisterForm = () => {
	const [activeOption, setActiveOption] = useState('company');

	const toggleOptions = [
		{ label: 'شركات', value: 'company', icon: <FaRegBuilding /> },
		{ label: 'كفاءات', value: 'individual', icon: <FaUserTie /> },
	];
	return (
		<div className="relative bg-pink-100 md:bg-white overflow-hidden ">
			{/* SVG Background */}
			<div className="absolute top-0 right-0 w-full h-full pointer-events-none">
				<div className="hidden lg:block absolute right-0 top-0 h-full w-[40%]">
					<div className="relative w-full h-full">
						<Image
							src="/form-bg.svg"
							alt="Background"
							fill
							style={{ objectFit: 'cover' }}
							priority
							className="transform scale-150 origin-right"
						/>
					</div>
				</div>
			</div>

			{/* Main Content */}
			<div className="relative container mx-auto px-4 py-6 lg:px-8 lg:py-8">
				<div className="flex flex-col-reverse lg:flex-row justify-between items-center gap-12 lg:gap-20">
					{/* Right Side - Form */}
					<div className="w-full max-w-[450px] order-2 lg:order-1">
						{/* Logo */}
						<div className="flex justify-center lg:justify-start mb-6">
							<Image
								src="/nav-logo.png"
								alt="Mosnad Logo"
								width={120}
								height={50}
								className="h-12 w-auto"
							/>
						</div>
						<h2 className="text-xl font-bold text-center mb-4">
							إنشاء حساب
						</h2>
						{/* Toggle Buttons */}
						<div className="bg-gray-50 p-1.5 rounded-xl mb-4">
							<ToggleButtonGroup
								options={toggleOptions}
								activeOption={activeOption}
								onOptionChange={(value) =>
									setActiveOption(value)
								}
								containerStyle="grid grid-cols-2 gap-2"
								buttonStyle="flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg font-medium transition-all"
								activeStyle="bg-white shadow-sm"
							/>
						</div>
						{/* Form Container */}
						<div className="bg-white rounded-2xl shadow-xl p-6 lg:p-8">
							<h3 className="text-lg font-bold text-center text-gray-800 mb-2">
								أهلاً في منصة مسند للتدريب والتوظيف
							</h3>

							{/* Form Fields */}
							<form className="space-y-2 ">
								<div className="grid grid-cols-2 gap-4">
									<Input
										name="first_name"
										placeholder="الاسم الأول"
										icon={FiUser}
									/>
									<Input
										name="last_name"
										placeholder="الاسم الأخير"
										icon={FiUser}
									/>
								</div>
								{activeOption === 'company' && (
									<Input
										name="company"
										placeholder="اسم الشركة"
										icon={FaRegBuilding}
									/>
								)}
								<Input
									name="email"
									placeholder="Mosnad@Mosnad.com"
									icon={FiMail}
								/>
								<Input
									name="password"
									type="password"
									placeholder="ادخل كلمة السر"
									icon={FiLock}
								/>

								<button className="w-full bg-gradient-to-r from-pink-500 to-red-500 text-white py-3 rounded-lg font-medium hover:opacity-90 transition-opacity">
									انشاء حساب
								</button>
							</form>

							<p className="text-center text-gray-600 mt-6">
								لديك حساب؟{' '}
								<Link
									href="/login"
									className="text-pink-500 font-bold">
									تسجيل الدخول
								</Link>
							</p>
						</div>
					</div>

					{/* Left Side - Content */}
					<div className="w-full lg:w-1/2 order-1 lg:order-2 text-center lg:text-right rounded-2xl p-6 lg:p-8 ">
						<div className="flex flex-col justify-between items-center ">
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

							{activeOption === 'company' && (
								<h1 className="text-xl lg:text-xl font-bold text-gray-800 mb-6">
									البحث عن الشخص المناسب بالمكان المناسب وأنت
									فيه!
								</h1>
							)}
							{activeOption !== 'company' && (
								<h1 className="text-xl lg:text-xl font-bold text-gray-800 mb-6 text-center">
									وراء كل مشروع برمجي، مُسند أكبر منصة تجمع،
									تؤهل، وتوظّف المهارات البرمجية اليمنية{' '}
								</h1>
							)}

							<div className=" mb-4 flex justify-center gap-4">
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
								<h2 className="text-xl font-mediam text-blue-900 text">
									تابعنا عبر السوشيال ميديا
								</h2>
							</div>

							{/* Social Icons */}
							<div className="flex gap-4 justify-center ">
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

export default RegisterForm;