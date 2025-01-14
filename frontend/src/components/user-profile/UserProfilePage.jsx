'use client';
import { useState } from 'react';
import Sidebar from '@/components/profile/Sidebar';
import Header from '@/components/profile/Header';
import MyFiles from './MyFiles';
import Notifications from './Notifications';
import JobApplications from './JobApplications';
import FormData from './FormData';
import ManageAccount from './account/ManageAccount';
import EditAccountDetails from './EditAccountDetails';

const UserProfilePage = ({ userData }) => {
	const [activeTab, setActiveTab] = useState('manage-acount');
	const profile = {
		image: '/userImage.jpg',
		name: userData.user_profile.username,
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
			label: 'بيانات الاستبيان ',
			name: 'form-data',
			icon: '/request.svg',
		},
		{
			label: 'تعديل البيانات',
			name: 'edit-account-details',
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
									<ManageAccount userData={userData} />
								</div>
							</main>
						</>
					)}

					{activeTab === 'form-data' && (
						<>
							<Header title="بيانات الاستبيان " />
							<main className="mt-4">
								<FormData userData={userData} />
							</main>
						</>
					)}

					{activeTab === 'edit-account-details' && (
						<>
							<Header title="تعديل البيانات" />
							<main className="mt-4">
								<EditAccountDetails userData={userData} />
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
