'use client';
import { useState } from 'react';
import Sidebar from '@/components/profile/Sidebar';
import Header from '@/components/profile/Header';
import CompleteAccountDetails from './CompleteAccountDetails';
import MyFiles from './MyFiles';
import Notifications from './Notifications';
import JobApplications from './JobApplications';
import Resume from './Resume';
import ManageAccount from './account/ManageAccount';

const UserProfilePage = () => {
	const [activeTab, setActiveTab] = useState('manage-acount');
	const profile = {
		image: '/userImage.jpg',
		name: 'ريم محمد محبوب',
		flagIcon: '/flag.svg',
		memberSince: 'عضو منذ سنة',
		statusIcon: '/success.svg',
		status: 'حساب نشط',
	};
  const tabData = [
		{
			label: 'إدارة الحساب',
			name: 'manage-acount',
			icon: '/manage-account-icon.svg',
		},
		{
			label: 'السيرة الذاتية',
			name: 'resume',
			icon: '/request.svg',
		},
		{
			label: 'إكمال الحساب',
			name: 'complete-account',
			icon: '/verify-icon.svg',
		},
		{
			label: 'طلبات التقديم على الفرص',
			name: 'job-applications',
			icon: '/request.svg',
		},
		{ label: 'ملفاتي', name: 'my-files', icon: '/files.svg' },
		{
			label: 'الإشعارات',
			name: 'notifications',
			icon: '/notification.svg',
		},
	];
	return (
		<div className="bg-gray-50 py-6">
			<div className="flex flex-col sm:flex-row min-h-screen mx-auto max-w-screen-xl gap-4 px-4 sm:px-6">
				{/* Sidebar is persistent for all pages */}
				<Sidebar activeTab={activeTab} setActiveTab={setActiveTab} profile={profile} tabData={tabData} />
				<div className="flex-grow">
					{activeTab === 'manage-acount' && (
						<>
							<Header title="إدارة الحساب" />
							<main className="mt-4">
								<div className="text-red-800">
									<ManageAccount />
								</div>
							</main>
						</>
					)}

					{activeTab === 'resume' && (
						<>
							<Header title="السيرة الذاتية" />
							<main className="mt-4">
								<Resume />
							</main>
						</>
					)}

					{activeTab === 'complete-account' && (
						<>
							<Header title="إكمال الحساب" />
							<main className="mt-4">
								<CompleteAccountDetails />
							</main>
						</>
					)}
					{activeTab === 'job-applications' && (
						<>
							<Header title="طلبات التقديم على الفرص" />

							<main className="mt-4">
								<JobApplications />
							</main>
						</>
					)}

					{activeTab === 'my-files' && (
						<>
							<Header title="ملفاتي" />
							<main className="mt-4">
								<MyFiles />
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

export default UserProfilePage;
