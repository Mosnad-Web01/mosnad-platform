'use client';

import { FiMail, FiLock } from 'react-icons/fi';
import { useForm } from '@/hooks/useForm';
import useLogin from '@/hooks/auth/useLogin';
import Input from '@/components/common/Input';
import Link from 'next/link';
import Image from 'next/image';
import LoadingSpinner from '@/components/common/LoadingSpinner';

const LoginForm = () => {
	const {
		values,
		errors: formErrors,
		handleChange,
	} = useForm({ email: '', password: '' });

	const {
		login,
		error: loginError,
		formErrors: serverErrors,
		isLoading,
	} = useLogin();

	const handleSubmit = async (e) => {
		e.preventDefault();
		await login(values.email, values.password);
	};

	return (
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
			<h2 className="text-xl font-bold text-center mb-6">تسجيل الدخول</h2>
			<div className="bg-white rounded-2xl shadow-xl p-6 lg:p-8">
				<h3 className="text-lg font-bold text-center text-gray-800 mb-2">
					أهلاً في منصة مسند للتدريب والتوظيف
				</h3>
				{/* Form */}
				<form className="space-y-4" onSubmit={handleSubmit}>
					{/* Show generic login errors */}

					{loginError && (
						<div
							className="text-red-500 text-sm p-2 bg-red-50 rounded text-center"
							dir="ltr">
							{loginError}
						</div>
					)}

					{/* Email input */}
					<Input
						name="email"
						type="email"
						placeholder="Mosnad@Mosnad.com"
						icon={FiMail}
						value={values.email}
						onChange={handleChange}
						errorMessage={serverErrors.email || formErrors.email}
						disabled={isLoading}
						dir="ltr"
					/>

					{/* Password input */}
					<Input
						name="password"
						type="password"
						placeholder="password"
						icon={FiLock}
						value={values.password}
						onChange={handleChange}
						errorMessage={
							serverErrors.password || formErrors.password
						}
						disabled={isLoading}
						dir="ltr"
					/>

					{/* Submit button */}

					{isLoading ? (
						<LoadingSpinner />
					) : (
						<button
							type="submit"
							className="w-full bg-gradient-to-r from-pink-500 to-red-500 text-white py-3 rounded-lg font-medium hover:opacity-90 transition-opacity">
							تسجيل الدخول
						</button>
					)}
				</form>

				{/* Register link */}
				<p className="text-center text-gray-600 mt-6">
					ليس لديك حساب ؟{' '}
					<Link href="/register" className="text-pink-500 font-bold">
						إنشاء حساب
					</Link>
				</p>
			</div>
		</div>
	);
};

export default LoginForm;
