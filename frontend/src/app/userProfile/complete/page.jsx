import React from 'react';
import Input from '@/components/common/Input';

const CompleteAccountDetails = () => {
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
            value="ريم محمد"
            additionalClasses="mb-4"
          />
          <Input
            label="الجنس"
            placeholder="أدخل الجنس"
            value="أنثى"
            additionalClasses="mb-4"
          />
          <Input
            label="تاريخ الميلاد"
            placeholder="أدخل تاريخ الميلاد"
            value="1990-04-26"
            additionalClasses="mb-4"
          />
          <Input
            label="الجنسية"
            placeholder="أدخل الجنسية"
            value="يمنية"
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
            value="737622691"
            additionalClasses="mb-4"
          />
          <Input
            label="رقم الواتساب"
            placeholder="أدخل رقم الواتساب"
            value="737622691"
            additionalClasses="mb-4"
          />
          <Input
            label="البريد الإلكتروني"
            placeholder="أدخل البريد الإلكتروني"
            value="reemmohammed@gmail.com"
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
            value="اليمن"
            additionalClasses="mb-4"
          />
          <Input
            label="المحافظة"
            placeholder="أدخل المحافظة"
            value="المحافظة"
            additionalClasses="mb-4"
          />
          <Input
            label="العنوان"
            placeholder="أدخل العنوان"
            value="عصر - مدينة الآنسي"
            additionalClasses="mb-4"
          />
        </div>
      </div>
    </section>
  );
};

export default CompleteAccountDetails;
