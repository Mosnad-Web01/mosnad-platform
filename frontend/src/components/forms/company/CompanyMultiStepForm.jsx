'use client';

import React, { useState, useEffect } from 'react';
import Cookies from 'js-cookie'; 
import Step1 from './Step1';
import Step2 from './Step2';
import Step3 from './Step3';
import SuccessPage from '../SuccessPage';
import ProgressBar from '../ProgressBar';

import { useAuth } from '@/hooks/auth/useAuth';
import { get, put } from '@/lib/axios';

const CompanyMultiStepForm = () => {
	const { user } = useAuth();
	const user_id = user?.id;

	// State for form data
	const [formData, setFormData] = useState({
		name: '',
		email: '',
		industry: '',
		employees: '',
		stage: '',
		skills: [],
		home_workers: '',
		training: '',
		hiring: '',
		remote_hiring_preferences: [],
		additional_notes: '',
	});

	const [currentStep, setCurrentStep] = useState(0); // Current step in the form
	const [errors, setErrors] = useState({}); // Validation errors
	const [companyId, setCompanyId] = useState(null); // Company ID
	const [loading, setLoading] = useState(true); // Loading state

	// Fetch company name by user ID
	const getCompany = async (userId) => {
		try {
			const response = await get(`/company-name/${userId}`);
			return { name: response.company_name, id: response.company_id };
		} catch (error) {
			console.error('Error fetching company data:', error);
			return null; // Handle error gracefully
		}
	};

	useEffect(() => {
		if (user_id) {
			const fetchCompanyData = async () => {
				setLoading(true); // Set loading to true while fetching data
				const companyData = await getCompany(user_id);
				if (companyData) {
					setFormData((prev) => ({
						...prev,
						name: companyData.name, // Update formData with the company name
					}));
					setCompanyId(companyData.id); // Store company_id separately
				}
				setLoading(false); // Set loading to false after fetching data
			};
			fetchCompanyData();
		}
	}, [user_id]);

	// Update specific field in the form data
	const updateFormData = (key, value) => {
		setFormData((prev) => ({ ...prev, [key]: value }));
	};

	// Validate the current step
	const validateStep = (step) => {
		let tempErrors = {};

		if (step === 1) {
			if (!formData.name) tempErrors.name = 'اسم الشركة مطلوب';
			if (!formData.email) {
				tempErrors.email = 'البريد الإلكتروني مطلوب';
			} else if (!/\S+@\S+\.\S+/.test(formData.email)) {
				tempErrors.email =
					'البريد الإلكتروني غير صالح. يرجى إدخال بريد إلكتروني صحيح';
			}
			if (!formData.industry)
				tempErrors.industry = 'الرجاء اختيار الصناعة';
			if (!formData.employees)
				tempErrors.employees = 'عدد الموظفين مطلوب';
			if (!formData.stage) tempErrors.stage = 'المرحلة يجب أن تكون محددة';
			if (formData.skills.length === 0)
				tempErrors.skills = 'الرجاء تحديد المهارات';
			if (!formData.home_workers)
				tempErrors.home_workers = 'الرجاء تحديد عدد العمال عن بُعد';
		} else if (step === 2) {
			if (!formData.training)
				tempErrors.training =
					'يرجى تحديد ما إذا كنت تقدم تدريبًا على البرمجة';
			if (!formData.hiring)
				tempErrors.hiring =
					'يرجى تحديد ما إذا كنت مهتمًا بتوظيف الأفراد';
			if ((formData.remote_hiring_preferences || []).length === 0) {
				tempErrors.remote_hiring_preferences =
					'يرجى اختيار ميزة واحدة على الأقل لدعم رغبتك في التعيينات عن بعد';
			}
		} else if (step === 3) {
			if (!formData.additional_notes) {
				tempErrors.additional_notes =
					'الرجاء إضافة ملاحظات إضافية حول شركتك';
			}
		}

		setErrors(tempErrors);
		return Object.keys(tempErrors).length === 0; // Return true if no errors
	};

	// Handle form submission
	const handleSubmit = async () => {
		if (!validateStep(currentStep + 1)) return;

		if (!companyId) {
			console.error('Company ID is missing');
			return;
		}

		const url = `/company-forms/${companyId}`;
		try {
			const response = await put(url, formData, {
				headers: {
					'Content-Type': 'application/json',
				},
			});
			console.log('Form submitted successfully:', response.data);
			  // Update the "status" cookie to "active"
			  Cookies.set('status', 'active', {
				expires: 7,
				secure: process.env.NODE_ENV === 'production',
				sameSite: 'strict',
			});

			setCurrentStep(stepComponents.length); // Navigate to success page
		} catch (error) {
			console.error(
				'Form submission failed:',
				error.response?.data || error.message,
			);
		}
	};

	// Navigate to the next step
	const goToNextStep = () => {
		if (currentStep < 2 && validateStep(currentStep + 1)) {
			setCurrentStep((prev) => prev + 1);
		}
	};

	// Navigate to the previous step
	const goToPreviousStep = () => {
		if (currentStep > 0) {
			setCurrentStep((prev) => prev - 1);
		}
	};

	const steps = [
		'معلومات عن الشركة',
		'احتياجات التدريب والتوظيف',
		'معلومات اضافية',
	];
	const stepComponents = [
		<Step1
			key="step1"
			formData={formData}
			updateFormData={updateFormData}
			errors={errors}
		/>,
		<Step2
			key="step2"
			formData={formData}
			updateFormData={updateFormData}
			errors={errors}
		/>,
		<Step3
			key="step3"
			formData={formData}
			updateFormData={updateFormData}
			errors={errors}
		/>,
	];

	return (
		<div className="w-full max-w-7xl mx-auto overflow-hidden bg-gray-50 rounded-2xl shadow-md">
			<h1 className="text-xl font-bold p-4 bg-white text-[#21255C] text-center mb-6">
				استمارة التقديم{' '}
				<span className="text-[#F03F74]">- للشركات</span>
			</h1>

			{loading ? (
				<div className="text-center py-16">
					<p className="text-xl font-semibold text-gray-500">
						جاري تحميل البيانات...
					</p>
				</div>
			) : (
				<>
					<div className="mb-6 w-full max-w-4xl mx-auto">
						<ProgressBar steps={steps} currentStep={currentStep} />
					</div>

					<p className="text-2xl font-semibold text-[#21255C] text-center mb-4">
						{steps[currentStep]}
					</p>

					<div className="w-full max-w-3xl mx-auto bg-white p-4 mb-12 rounded-2xl">
						{currentStep < stepComponents.length ? (
							stepComponents[currentStep]
						) : (
							<SuccessPage />
						)}

						<div className="flex justify-between mt-6 p-4">
							{currentStep > 0 &&
								currentStep < stepComponents.length && (
									<button
										className="px-4 py-2 bg-gray-100 rounded-md text-gray-700 hover:bg-gray-300"
										onClick={goToPreviousStep}>
										السابق
									</button>
								)}
							{currentStep === stepComponents.length - 1 && (
								<button
									type="button"
									onClick={handleSubmit}
									className="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
									إرسال
								</button>
							)}
							{currentStep < stepComponents.length - 1 && (
								<button
									className="px-4 py-2 bg-gradient text-white rounded-md hover:bg-pink-600"
									onClick={goToNextStep}>
									التالي
								</button>
							)}
						</div>
					</div>
				</>
			)}
		</div>
	);
};

export default CompanyMultiStepForm;
