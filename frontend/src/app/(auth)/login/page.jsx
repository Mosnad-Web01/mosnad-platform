// src/app/(auth)/login/page.jsx

import LoginPage from '@/components/auth/LoginPage';

export const metadata = {
	title: 'Mosnad | Login',
	description: 'Login to your account',
};

const page = () => {
	return <LoginPage />;
};

export default page;
