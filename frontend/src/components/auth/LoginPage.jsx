import Image from 'next/image';

import RightBackgroundImg from './RightBackgroundImg';
import LoginForm from '@/components/auth/form/LoginForm';

import { FaFacebook, FaInstagram, FaTwitter, FaYoutube } from 'react-icons/fa';

const LoginPage = () => {
	return (
		<div className="relative  md:max-h-[1300px] bg-pink-100 lg:bg-white overflow-hidden shadow-xl rounded-2xl py-4">
			{/* SVG Background */}
			<RightBackgroundImg imgSrc="/form-bg.svg" />

			{/* Main Content */}
			<div className="relative max-w-screen-xl mx-auto px-4 py-6 lg:px-8 lg:py-2">
				<div className="flex flex-col-reverse lg:flex-row justify-between items-center lg:items-start gap-12 lg:gap-20">
					{/* Right Side - Form */}

					<LoginForm />

					{/* Left Side - Content */}
					<div className="w-full lg:w-1/2 order-1 lg:order-2 text-center lg:text-right rounded-2xl p-6 lg:p-8">
						<div className="flex flex-col justify-between items-center">
							<Image
								src="/register-left-img.svg"
								alt="Form Image"
								width={400}
								height={400}
								className="w-full h-auto"
							/>
							<h1 className="text-xl lg:text-xl font-bold text-gray-800 mb-6">
								البحث عن الشخص المناسب بالمكان المناسب وأنت فيه!
							</h1>
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

export default LoginPage;
