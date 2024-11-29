// src/hooks/auth/useLogin.js
import { useState } from 'react';
import axios from '@/lib/axios';
import { useAuth } from '@/hooks/auth/useAuth';
import { useRouter, useSearchParams } from 'next/navigation';
import Cookies from 'js-cookie';
import { APP_ROUTES } from '@/utils/constants';

const useLogin = () => {
	const { setUser, setToken } = useAuth();
	const router = useRouter();
	const searchParams = useSearchParams();
	const [error, setError] = useState('');
	const [formErrors, setFormErrors] = useState({});
	const [isLoading, setIsLoading] = useState(false);

	const login = async (email, password) => {
		setIsLoading(true);
		setError('');
		setFormErrors({});

		try {
			const response = await axios.post('/auth/login', {
				email,
				password,
			});

			const { user, token, role } = response.data;

			// Save to context
			setUser(user);
			setToken(token);

			// Save token to cookies
			Cookies.set('token', token, {
				expires: 7,
				secure: process.env.NODE_ENV === 'production',
				sameSite: 'strict',
			});

			// Set axios default header
			axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

			// Get redirect path from URL or use role-based default
			const from = searchParams.get('from');
			const roleRedirect = {
				admin: APP_ROUTES.DASHBOARD.ADMIN,
				company: APP_ROUTES.DASHBOARD.COMPANY,
				student: APP_ROUTES.DASHBOARD.STUDENT,
			};

			// Redirect to intended destination or role-based dashboard
			router.push(from || roleRedirect[role] || '/');
		} catch (err) {
			// Handle error messages from Laravel API
			if (err.response?.status === 422) {
				// Validation errors
				setFormErrors(err.response.data.errors || {});
				setError(err.response.data.message || 'Validation failed.');
			} else if (err.response?.status === 401) {
				// Invalid credentials
				setError(err.response.data.message || 'Invalid credentials.');
			} else {
				// Generic error
				setError(
					err.response?.data?.message ||
						'An unexpected error occurred.',
				);
			}
		} finally {
			setIsLoading(false);
		}
	};

	return { login, error, formErrors, isLoading };
};

export default useLogin;
