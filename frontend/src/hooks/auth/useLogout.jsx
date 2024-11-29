// src/hooks/auth/useLogout.js
import { useRouter } from 'next/navigation';
import axios from '@/lib/axios';
import { useAuth } from '@/hooks/auth/useAuth';
import Cookies from 'js-cookie';

const useLogout = () => {
  const router = useRouter();
  const { setUser, setToken } = useAuth();

  const logout = async () => {
    try {
      // Get the token from cookies
      const token = Cookies.get('token');
      if (!token) {
        throw new Error('No token found in cookies');
      }

      // Set the Authorization header for the logout request
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

      // Call the API to log out
      await axios.post('/logout');

      // Clear cookies and reset auth context
      Cookies.remove('token');
      delete axios.defaults.headers.common['Authorization'];
      setUser(null);
      setToken(null);

      // Redirect to the login page
      router.push('/login');
    } catch (error) {
      console.error('Logout error:', error);
      console.error(
        'Detailed error info:',
        error?.response?.data || 'No response data',
        error?.message || 'No error message',
      );
    }
  };

  return logout;
};

export default useLogout;
