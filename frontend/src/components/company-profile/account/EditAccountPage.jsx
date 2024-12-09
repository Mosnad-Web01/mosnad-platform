'use client';

import React, { useState } from 'react';
import Input from '@/components/common/Input';
import SelectInput from '@/components/common/SelectInput'; // Ensure this import is correct
import { useRouter } from 'next/navigation';
import { FaArrowLeft } from 'react-icons/fa';

const EditAccountPage = ({ accountInfo, activetab, setActiveTab }) => {
	const countries = [
		{ value: 'صنعاء', label: 'صنعاء' },
		{ value: 'عدن', label: 'عدن' },
		{ value: 'حضرموت', label: 'حضرموت' },
	];

	const fieldsOfWork = [
		{ value: 'برمجة مواقع', label: 'برمجة مواقع' },
		{ value: 'برمجة تطبيقات', label: 'برمجة تطبيقات' },
		{ value: 'UI/UX', label: 'UI/UX' },
		{
			value: 'الحاسوب وتقنية المعلومات',
			label: 'الحاسوب وتقنية المعلومات',
		},
	];

	// Initialize state
	const [accountData, setAccountData] = useState({
		'اسم الشركة': 'مسند التدريب والتوظيف',
		'نبذة عن الشركة':
			'وراء كل مشروع برمجي، مسند تجمع، توفّر، وتوظف المهارات البرمجية المبنية (للأفراد - للشركات)',
		'البريد الإلكتروني الخاص بالشركة': 'Mosnad@gmail.com',
		'رقم الهاتف': '777777777',
		'نوع بيئة العمل': 'مختلط',
		'الموقع رسمي خاص بالجهة': 'Mosnad.com',
		'منصة رسمية بأحد مواقع التواصل الاجتماعي':
			'https://www.facebook.com/Mosnad',
		'الشارع/الحي': 'شارع بغداد',
		المحافظة: 'صنعاء',
		'مجال عمل الشركة': [],
	});

	const handleSave = (event) => {
		event.preventDefault();
		console.log('Saved data:', accountData);
		router.push('/companyProfile/account');
	};

	const handleInputChange = (e, label) => {
		if (Array.isArray(e)) {
			// Handle multiple select
			setAccountData((prevData) => ({
				...prevData,
				[label]: e,
			}));
		} else {
			// Handle regular inputs and single select
			const { value } = e.target;
			setAccountData((prevData) => ({
				...prevData,
				[label]: value,
			}));
		}
	};

	return (
		<section>
			<div className="bg-white rounded-lg shadow px-6">
            <div className="flex justify-between py-6 border-b">
						<div>
							<h2 className="text-base font-semibold text-[#21255C]">
								تعديل معلومات الحساب
							</h2>
						</div>

						<button className='block' onClick={() => setActiveTab('AccountInfo')}>
							<FaArrowLeft className='text-blue-800'/>
						</button>
					</div>
				
				<form className="space-y-4 py-6" onSubmit={handleSave}>
					{accountInfo.map((item, index) => (
						<div key={index}>
							{item.label === 'مجال عمل الشركة' ? (
								<SelectInput
									label={item.label}
									value={accountData['مجال عمل الشركة']}
									options={fieldsOfWork}
									onChange={(selectedOptions) =>
										handleInputChange(
											selectedOptions,
											'مجال عمل الشركة',
										)
									}
									multiple={true}
								/>
							) : item.label === 'المحافظة' ? (
								<SelectInput
									label={item.label}
									value={accountData['المحافظة']}
									options={countries}
									onChange={(e) =>
										handleInputChange(e, 'المحافظة')
									}
									multiple={false}
								/>
							) : (
								<Input
									label={item.label}
									value={accountData[item.label]}
									onChange={(e) =>
										handleInputChange(e, item.label)
									}
									placeholder={item.value}
									type="text"
									dir="rtl"
								/>
							)}
						</div>
					))}

					<button
						type="submit"
						className="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
						حفظ التعديلات
					</button>
				</form>
			</div>
            
		</section>
	);
};

export default EditAccountPage;
