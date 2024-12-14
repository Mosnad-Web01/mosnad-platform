import { useState } from 'react';
import AccountInfo from './AccountInfo';
import ManagePassword from './ManagePassword';
import ManageEmail from './ManageEmail';

const ManageAccount = ({userData}) => {
    const [activeTab, setActiveTab] = useState('AccountInfo');
	const tabData = [
		{
			label: 'معلومات الحساب',
			name: 'AccountInfo',
		},
		{
			label: 'كلمة السر',
			name: 'Password',
		},
		{
			label: 'البريد الالكتروني',
			name: 'Email',
		},
	];


	const getButtonStyle = (name) =>
		`text-sm px-4 py-2 rounded-lg no-underline transition duration-300 ${
			name === activeTab
				? 'bg-[#21255C] text-white'
				: 'text-gray-400 hover:text-purple-900 hover:scale-105 '
		}`;

	return (
		<>
			<nav className="bg-white shadow p-4 rounded-2xl my-4 flex justify-between items-center">
				<div className="flex gap-4">
					{tabData.map((tab) => {
						return (
							<button
								key={tab.name}
								className={getButtonStyle(tab.name)}
								onClick={() => setActiveTab(tab.name)}>
								{tab.label}
							</button>
						);
					})}
				</div>
			</nav>

			<main>
                {activeTab === 'AccountInfo' && <AccountInfo userData={userData} />}
                {activeTab === 'Password' && <ManagePassword />}
                {activeTab === 'Email' && <ManageEmail userData={userData.user_profile.email} />}
            
            </main>
		</>
	);
};

export default ManageAccount;
