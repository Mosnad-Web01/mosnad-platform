import Image from "next/image";
import React from "react";

const SettingAccountPage = () => {
  return (
    <section>
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
          <button className="px-4 py-2">
            <Image src="/edit.svg" alt="Edit" width={20} height={20} />
          </button>
        </div>
        <table className="w-full text-right ">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500">الاسم</td>
              <td className="p-4 font-medium">ريم محمد</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500">الجنس</td>
              <td className="p-4 font-medium">أنثى</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500">تاريخ الميلاد</td>
              <td className="p-4 font-medium">1990-04-26</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500">الجنسية</td>
              <td className="p-4 font-medium">يمنية</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image
              src="/manage-account-icon.svg"
              alt="User"
              width={16}
              height={16}
            />
            <h2 className="text-base font-semibold text-[#21255C]">
              معلومات التواصل
            </h2>
          </div>
          <button className="px-4 py-2">
            <Image src="/edit.svg" alt="Edit" width={20} height={20} />
          </button>
        </div>
        <table className="w-full text-right ">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500">رقم الهاتف</td>
              <td className="p-4 font-medium">737622691</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500">رقم الواتساب</td>
              <td className="p-4 font-medium">737622691</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500">البريد الإلكتروني</td>
              <td className="p-4 font-medium break-words text-sm sm:text-base">
                mohammed@gmail.com
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/location-icon.svg" alt="User" width={16} height={16} />
            <h2 className="text-base font-semibold text-[#21255C]">
              معلومات التواصل
            </h2>
          </div>
          <button className="px-4 py-2">
            <Image src="/edit.svg" alt="Edit" width={20} height={20} />
          </button>
        </div>
        <table className="w-full text-right ">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500">الدولة</td>
              <td className="p-4 font-medium">اليمن</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500">المحافظة</td>
              <td className="p-4 font-medium">المحافظة</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500"> العنوان</td>
              <td className="p-4 font-medium">عصر - مدينة الآنسي</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  );
};

export default SettingAccountPage;
