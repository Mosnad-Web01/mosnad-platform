'use client';

import CompanyProfilePage from '@/components/company-profile/CompanyProfilePage';
import { get } from '@/lib/axios';
import { useAuth } from '@/hooks/auth/useAuth';
import { useEffect, useState } from 'react';
import Spinner from '@/components/common/Spinner';

const UserProfile = () => {
  const { user } = useAuth();
  const [userData, setUserData] = useState(null);
  const [error, setError] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchUserData = async () => {
      if (!user) return;

      try {
        // Fetch youth form using the authenticated user's ID
        const response = await get(`/company-forms/${user.id}`);
        setUserData(response.data);
      } catch (err) {
        console.error('Error fetching user data:', err);
        setError(err.message || 'Failed to fetch user data. Please try again.');
      } finally {
        setLoading(false);
      }
    };

    fetchUserData();
  }, [user]);

  if (loading) return <Spinner />;
  if (error) return <div className="text-center text-red-500 p-4">{error}</div>;
  if (!userData) return <div className="text-center p-4">No user data available.</div>;

  return <CompanyProfilePage userData={userData} />;
};

export default UserProfile;