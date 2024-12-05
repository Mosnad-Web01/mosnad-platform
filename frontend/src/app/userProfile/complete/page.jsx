"use client";

import React, { useState } from 'react';
import Input from '@/components/common/Input';

const CompleteAccountDetails = () => {
  const [formData, setFormData] = useState({
    name: "ريم محمد",
    gender: "أنثى",
    birth_date: "1990-04-26",
    nationality: "يمنية",
    phone: "737622691",
    whatsapp: "737622691",
    email: "reemmohammed@gmail.com",
    country: "اليمن",
    city: "المحافظة",
    address: "عصر - مدينة الآنسي",
  });

  const handleInputChange = (field) => (event) => {
    setFormData({
      ...formData,
      [field]: event.target.value,
    });
  };

  return (
    <section className="py-6 px-4">
      {/* Personal Info Section */}
      <div className="bg-white rounded-lg shadow">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <h2 className="text-base font-semibold text-[#21255C]">المعلومات الشخصية</h2>
          </div>
        </div>
        <div className="p-4">
          <Input
            label="الاسم"
            placeholder="أدخل الاسم"
            value={formData.name}
            onChange={handleInputChange("name")}
            additionalClasses="mb-4"
          />
          <Input
            label="الجنس"
            placeholder="أدخل الجنس"
            value={formData.gender}
            onChange={handleInputChange("gender")}
            additionalClasses="mb-4"
          />
          <Input
            label="تاريخ الميلاد"
            placeholder="أدخل تاريخ الميلاد"
            value={formData.birth_date}
            onChange={handleInputChange("birth_date")}
            additionalClasses="mb-4"
          />
          <Input
            label="الجنسية"
            placeholder="أدخل الجنسية"
            value={formData.nationality}
            onChange={handleInputChange("nationality")}
            additionalClasses="mb-4"
          />
        </div>
      </div>

      {/* Contact Info Section */}
      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <h2 className="text-base font-semibold text-[#21255C]">معلومات التواصل</h2>
          </div>
        </div>
        <div className="p-4">
          <Input
            label="رقم الهاتف"
            placeholder="أدخل رقم الهاتف"
            value={formData.phone}
            onChange={handleInputChange("phone")}
            additionalClasses="mb-4"
          />
          <Input
            label="رقم الواتساب"
            placeholder="أدخل رقم الواتساب"
            value={formData.whatsapp}
            onChange={handleInputChange("whatsapp")}
            additionalClasses="mb-4"
          />
          <Input
            label="البريد الإلكتروني"
            placeholder="أدخل البريد الإلكتروني"
            value={formData.email}
            onChange={handleInputChange("email")}
            additionalClasses="mb-4"
          />
        </div>
      </div>

      {/* Location Info Section */}
      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <h2 className="text-base font-semibold text-[#21255C]">معلومات الموقع</h2>
          </div>
        </div>
        <div className="p-4">
          <Input
            label="الدولة"
            placeholder="أدخل الدولة"
            value={formData.country}
            onChange={handleInputChange("country")}
            additionalClasses="mb-4"
          />
          <Input
            label="المحافظة"
            placeholder="أدخل المحافظة"
            value={formData.city}
            onChange={handleInputChange("city")}
            additionalClasses="mb-4"
          />
          <Input
            label="العنوان"
            placeholder="أدخل العنوان"
            value={formData.address}
            onChange={handleInputChange("address")}
            additionalClasses="mb-4"
          />
        </div>
      </div>
    </section>
  );
};

export default CompleteAccountDetails;
