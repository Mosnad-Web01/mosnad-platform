// src/lib/axios.js
import axios from 'axios';
import Cookies from 'js-cookie';

const instance = axios.create({
	baseURL: 'http://localhost:8000/api',
	headers: {
		'Content-Type': 'application/json',
	
	},
});

// Add request interceptor
instance.interceptors.request.use(
	(config) => {
		const token = Cookies.get('token');
		if (token) {
			config.headers['Authorization'] = `Bearer ${token}`;
		}
		return config;
	},
	(error) => {
		return Promise.reject(error);
	},
);

// Add response interceptor
instance.interceptors.response.use(
	(response) => response,
	async (error) => {
		if (error.response?.status === 401) {
			// Handle unauthorized access
			Cookies.remove('token');
			window.location.href = '/login';
		}
		return Promise.reject(error);
	},
);

export default instance;
