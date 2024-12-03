// src/hooks/auth/useRegister.js
import { useState } from 'react';
import axios from '@/lib/axios';
import { useAuth } from '@/hooks/auth/useAuth';
import { useRouter, useSearchParams } from 'next/navigation';
import Cookies from 'js-cookie';
import { APP_ROUTES } from '@/utils/constants';

const useRegister = () => {
	const { setUser, setToken } = useAuth();
	const router = useRouter();
	const searchParams = useSearchParams();
	const [error, setError] = useState('');
	const [formErrors, setFormErrors] = useState({});
	const [isLoading, setIsLoading] = useState(false);

	const register = async (formData) => {
		setIsLoading(true);
		setError('');
		setFormErrors({});

		try {
			const response = await axios.post('/auth/register', formData);

			const { user, token, role } = response.data;

			// save to context
			setUser(user);
			setToken(token);

			// save token to cookies
			Cookies.set('token', token, {
				expires: 7,
				secure: process.env.NODE_ENV === 'production',
				sameSite: 'strict',
			});

			Cookies.set('role', role, {
				expires: 7,
				secure: process.env.NODE_ENV === 'production',
				sameSite: 'strict',
			});

			// set axios default header
			axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

			// get (redirect path) from URL or use role-based default
			const from = searchParams.get('from');
			const roleRedirect = {
				company: APP_ROUTES.DASHBOARD.COMPANY,
				student: APP_ROUTES.DASHBOARD.STUDENT,
			};

			// redirect to intended destination or role-based dashboard
			router.push(from || roleRedirect[role] || '/');
		} catch (err) {
			// Handle error messages from Laravel API
			if (err.response?.status === 422) {
				// validation error
				setFormErrors(err.response.data.errors || {});
				setError(err.response.data.message || 'Validation failed.');
			} else if (err.response?.status === 401) {
				// authentication error
				setError(err.response.data.message || 'Invalid credentials.');
			} else {
				// generic error
				setError(
					err.response?.data?.message ||
						'An unexpected error occurred.',
				);
			}
		} finally {
			setIsLoading(false);
		}
	};

	return { register, error, formErrors, isLoading };
};

export default useRegister;