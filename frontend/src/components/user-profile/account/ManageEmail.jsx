'use client';

import Input from '@/components/common/Input';
import Image from 'next/image';
import { useState } from 'react';
import { put } from '@/lib/axios';

const ManageEmail = ({userData}) => {
  const [email, setEmail] = useState(userData);
  const [isEditing, setIsEditing] = useState(false);
  const [errors, setErrors] = useState('');
  const [successMessage, setSuccessMessage] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleEmailChange = (event) => {
    setEmail(event.target.value);
  };

  const handleEditClick = () => {
    setIsEditing(true);
    setErrors('');
    setSuccessMessage('');
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    setErrors('');
    setSuccessMessage('');
    setIsSubmitting(true);

    // Basic validation
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      setErrors('يرجى إدخال بريد إلكتروني صالح');
      setIsSubmitting(false);
      return;
    }

    try {
      const response = await put('/update-email', { email });

      if (response?.status === 'success') {
        setSuccessMessage('تم تحديث البريد الإلكتروني بنجاح');
        setIsEditing(false);
      }
    } catch (error) {
      setErrors(error?.data?.message || 'حدث خطأ. يرجى المحاولة مرة أخرى');
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <section>
      <div className="bg-white rounded-2xl py-3 shadow">
        <div className="flex gap-3 items-center border-b p-4 border-gray-100">
          <Image src="/email-icon.svg" alt="Email Icon" width={16} height={16} />
          <h2 className="text-base font-semibold text-[#21255C]">البريد الإلكتروني</h2>
        </div>
        <form className="p-5" onSubmit={handleSubmit}>
          {successMessage && (
            <div className="text-green-500 mb-3 text-right">{successMessage}</div>
          )}
          {errors && (
            <div className="text-red-500 mb-3 text-right">{errors}</div>
          )}

          <Input
            label="البريد الإلكتروني"
            type="email"
            value={email}
            onChange={handleEmailChange}
            disabled={!isEditing}
          />

          <div className="mt-4 flex justify-end gap-2">
            {isEditing ? (
              <>
                <button
                  type="button"
                  onClick={() => {
                    setIsEditing(false);
                    setErrors('');
                    setSuccessMessage('');
                  }}
                  className="py-2 px-4 bg-gray-200 text-gray-700 rounded-md"
                >
                  إلغاء
                </button>
                <button
                  type="submit"
                  disabled={isSubmitting}
                  className={`py-2 px-4 bg-gradient text-white rounded-md ${
                    isSubmitting ? 'opacity-50 cursor-not-allowed' : ''
                  }`}
                >
                  {isSubmitting ? 'جاري الحفظ...' : 'حفظ'}
                </button>
              </>
            ) : (
              <button
                type="button"
                onClick={handleEditClick}
                className="py-2 px-4 bg-gradient text-white rounded-md"
              >
                تعديل البريد الإلكتروني
              </button>
            )}
          </div>
        </form>
      </div>
    </section>
  );
};

export default ManageEmail;
