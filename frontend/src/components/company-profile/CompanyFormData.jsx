import Image from "next/image";
import React from "react";

const CompanyFormData = ({ userData }) => {
  const accountInfo = [
    { label: "اسم المستخدم", value: userData.user_profile.username },
    { label: "اسم الشركة", value: userData.company_name },
    { label: "البريد الإلكتروني الخاص بالشركة", value: userData.user_profile.email },
    { label: "رقم الهاتف", value: userData.user_profile.phone_number },
    { label: "المدينة", value: userData.user_profile.city },
    { label: "الدولة", value: userData.user_profile.country },
    { label: "الشارع/الحي", value: userData.user_profile.address },
    { label: "تاريخ افتتاح الشركة", value: new Date(userData.user_profile.birth_date).toLocaleDateString('en') },
    { label: "مجال الشركة", value: userData.industry },
    { label: "عدد الموظفين", value: userData.employees },
    { label: "المرحلة", value: userData.stage },
    { label: "المهارات", value: JSON.parse(userData.skills).join(", ") },
    { label: "موظفين المنزل", value: userData.home_workers },
    { label: "التدريب", value: userData.training },
    { label: "التوظيف", value: userData.hiring },
    { label: "تفضيلات التوظيف عبر الانترنت", value: JSON.parse(userData.remote_hiring_preferences).join(", ") },
    { label: "ملاحظات اضافية", value: userData.additional_notes },
  ];

  return (
    <section>
      <div className="bg-white rounded-lg shadow">
        {/* Header */}
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/manage-account-icon.svg" alt="User" width={16} height={16} />
            <h2 className="text-base font-semibold text-[#21255C]">معلومات الحساب</h2>
          </div>
         
        </div>

        {/* Table */}
        <table className="w-full text-right">
          <tbody>
            {accountInfo.map((item, index) => (
              <tr key={index} className="border-b border-gray-100">
                <td className="p-4 text-sm text-[#203B7D] font-medium">{item.label}</td>
                <td className="p-4 text-xs whitespace-pre-line overflow-hidden overflow-ellipsis text-justify">
                  {item.value}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </section>
  );
};

export default CompanyFormData;