'use client';

import Image from 'next/image';
import { useEffect, useState } from 'react';

const AccountInfo = ({ userData }) => {
  return (
    <section>
      {/* Personal Info Section */}
      <div className="bg-white rounded-lg shadow">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image
              src="/manage-account-icon.svg"
              alt="User"
              width={16}
              height={16}
            />
            <h2 className="text-base font-semibold text-[#21255C]">
              المعلومات الشخصية
            </h2>
          </div>
        </div>
        <table className="w-full" dir="rtl">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الاسم</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.username}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الجنس</td>
              <td className="p-4 font-medium text-right">{userData.gender}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">تاريخ الميلاد</td>
              <td className="p-4 font-medium text-right">
                {new Date(userData.user_profile.birth_date).toLocaleDateString('en-US', {
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric',
                })}
              </td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الجنسية</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.country}</td>
            </tr>
          </tbody>
        </table>
      </div>

      {/* Contact Info Section */}
      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/manage-account-icon.svg" alt="User" width={16} height={16} />
            <h2 className="text-base font-semibold text-[#21255C]">
              معلومات التواصل
            </h2>
          </div>
        </div>
        <table className="w-full" dir="rtl">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">رقم الهاتف</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.phone_number}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">البريد الإلكتروني</td>
              <td className="p-4 font-medium break-words text-sm sm:text-base text-right">
                {userData.user_profile.email}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      {/* Location Info Section */}
      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/location-icon.svg" alt="User" width={16} height={16} />
            <h2 className="text-base font-semibold text-[#21255C]">
              معلومات الموقع
            </h2>
          </div>
        </div>
        <table className="w-full" dir="rtl">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الدولة</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.country}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">المحافظة</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.city}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">العنوان</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.address}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  );
};

// Fetch data from API before rendering the page
export async function getServerSideProps(context) {
  // Example: Fetch user data based on `id` or `context` param
  const res = await fetch(`https://api.yoursite.com/user/${context.params.id}`);
  const data = await res.json();

  return {
    props: {
      userData: data,
    },
  };
}

export default AccountInfo;