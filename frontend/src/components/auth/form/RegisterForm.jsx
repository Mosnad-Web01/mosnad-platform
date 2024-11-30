'use client';

import { useState } from 'react';
import Input from '@/components/common/Input';
import ToggleButtonGroup from '@/components/common/ToggleButtonGroup';
import { FiMail, FiLock, FiUser } from 'react-icons/fi';
import { FaRegBuilding } from 'react-icons/fa';
import Link from 'next/link';
import Image from 'next/image';
import useRegister from '@/hooks/auth/useRegister';
import { useForm } from '@/hooks/useForm';
import LoadingSpinner from '@/components/common/LoadingSpinner';

const RegisterForm = () => {
	const toggleOptions = [
		{
			label: 'شركات',
			value: 'company',
			icon: <FaRegBuilding />,
			roleId: 2,
		},
		{ label: 'كفاءات', value: 'individual', icon: <FiUser />, roleId: 3 },
	];

	const [activeOption, setActiveOption] = useState(toggleOptions[1]);
	const {
		values,
		errors: formErrors,
		handleChange,
	} = useForm({
		first_name: '',
		last_name: '',
		email: '',
		password: '',
		company_name: '',
	});

	const {
		register,
		error: registerError,
		formErrors: serverErrors,
		isLoading,
	} = useRegister();

	const handleSubmit = async (e) => {
		e.preventDefault();

		const data = {
			first_name: values.first_name,
			last_name: values.last_name,
			email: values.email,
			password: values.password,
			role_id: activeOption.roleId, // Map role_id based on selected option
		};

		if (activeOption.roleId === 2) {
			data.company_name = values.company_name; // Include company name for companies
		}

		await register(data);
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
			<h2 className="text-xl font-bold text-center mb-4">إنشاء حساب</h2>
			{/* Toggle Buttons */}
			<div className="bg-gray-50 p-1.5 rounded-xl mb-4">
				<ToggleButtonGroup
					options={toggleOptions}
					activeOption={activeOption.value}
					onOptionChange={(value) =>
						setActiveOption(
							toggleOptions.find(
								(option) => option.value === value,
							),
						)
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
				<form onSubmit={handleSubmit}>
					{/* Show generic registration errors */}
					{registerError && (
						<div
							className="text-red-500 text-sm p-2 bg-red-50 rounded text-center"
							dir="ltr">
							{registerError}
						</div>
					)}

					<div className="grid grid-cols-2 gap-4">
						<Input
							name="first_name"
							type="text"
							placeholder="الاسم الأول"
							icon={FiUser}
							value={values.first_name}
							onChange={handleChange}
							errorMessage={
								serverErrors.first_name || formErrors.first_name
							}
							disabled={isLoading}
						/>

						<Input
							name="last_name"
							type="text"
							placeholder="الاسم الاخير"
							icon={FiUser}
							value={values.last_name}
							onChange={handleChange}
							errorMessage={
								serverErrors.last_name || formErrors.last_name
							}
							disabled={isLoading}
						/>
					</div>
					{activeOption.roleId === 2 && (
						<Input
							name="company_name"
							type="text"
							placeholder="اسم الشركة"
							icon={FaRegBuilding}
							value={values.company_name}
							onChange={handleChange}
							errorMessage={
								serverErrors.company_name ||
								formErrors.company_name
							}
							disabled={isLoading}
						/>
					)}

					<Input
						name="email"
						type="email"
						placeholder="Mosnad@Mosnad.com"
						value={values.email}
						icon={FiMail}
						onChange={handleChange}
						errorMessage={serverErrors.email || formErrors.email}
						disabled={isLoading}
					/>
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
					/>

					{isLoading ? (
						<LoadingSpinner />
					) : (
						<button
							type="submit"
							className="w-full bg-gradient-to-r from-pink-500 to-red-500 text-white py-3 rounded-lg font-medium hover:opacity-90 transition-opacity">
							انشاء حساب
						</button>
					)}
				</form>

				<p className="text-center text-gray-600 mt-6">
					لديك حساب؟{' '}
					<Link href="/login" className="text-pink-500 font-bold">
						تسجيل الدخول
					</Link>
				</p>
			</div>
		</div>
	);
};

export default RegisterForm;
