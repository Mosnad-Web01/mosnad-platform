'use client';
import { useState } from 'react';
import Sidebar from '../profile/Sidebar';
import Header from '../profile/Header';
import ManageAccount from './account/ManageAccount';
import Notifications from './Notifications';
import JobOffers from './JobOffers';
import JobsApplicants from './JobsApplicants';
import { icons } from 'lucide-react';
import CompanyFormData from './CompanyFormData';
import EditAccountData from './EditAccountData';

const CompanyProfilePage = ({userData}) => {
	const profile = {
		image: '/userImage.svg',
		name: userData.company_name,
		flagIcon: '/flag.svg',
		memberSince: userData.user_profile.created_at,
		statusIcon: '/success.svg',
		status: userData.user_profile.status,
	};

	const tabData = [
		{
			label: 'إدارة الحساب',
			name: 'manage-acount',
			icon: '/manage-account-icon.svg',
		},

		{
			label: 'جميع بيانات الاستبيان',
			name: 'form-data',
			icon: '/manage-account-icon.svg',
		},

		{
			label: 'تعديل البيانات',
			name: 'edit-data',
			icon: '/verify-icon.svg',
		},

		{
			label: 'طلبات التقديم',
			name: 'job-applications',
			icon: '/request.svg',
		},
		{
			label: ' ادارة الوظائف',
			name: 'job-offers',
			icon: '/request.svg',
		},
		{
			label: 'الإشعارات',
			name: 'notifications',
			icon: '/notification.svg',
		},
	];

	const [activeTab, setActiveTab] = useState('manage-acount');
	return (
		<div className="bg-gray-50 py-6">
			<div className="flex flex-col sm:flex-row min-h-screen mx-auto max-w-screen-xl gap-4 px-4 sm:px-6">
				{/* Sidebar is persistent for all pages */}
				<Sidebar
					activeTab={activeTab}
					setActiveTab={setActiveTab}
					profile={profile}
					tabData={tabData}
				/>
				<div className="flex-grow">
					{activeTab === 'manage-acount' && (
						<>
							<Header title="إدارة الحساب" />
							<main className="mt-4">
								<div className="text-red-800">
									<ManageAccount userData={userData} />
								</div>
							</main>
						</>
					)}

					{activeTab === 'form-data' && (
						<>
							<Header title="جميع بيانات الاستبيان" />
							<main className="mt-4">
								<div className="text-red-800">
									<CompanyFormData userData={userData} />
								</div>
							</main>
						</>
					)}

					{activeTab === 'edit-data' && (
						<>
							<Header title="تعديل البيانات" />
							<main className="mt-4">
								<div className="text-red-800">
									<EditAccountData userData={userData} />
								</div>
							</main>
						</>
					)}

					{activeTab === 'job-offers' && (
						<>
							<Header title="طلبات التقديم على الفرص" />

							<main className="mt-4">
								<JobOffers />
							</main>
						</>
					)}

					{activeTab === 'job-applications' && (
						<>
							<Header title="طلبات التقديم على الفرص" />

							<main className="mt-4">
								<JobsApplicants />
							</main>
						</>
					)}

					{activeTab === 'notifications' && (
						<>
							<Header title="الإشعارات" />
							<main className="mt-4">
								<Notifications />
							</main>
						</>
					)}
				</div>
			</div>
		</div>
	);
};

export default CompanyProfilePage;
