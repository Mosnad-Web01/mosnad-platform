import Image from "next/image";
import Link from "next/link";
import React from "react";

const page = () => {
  const accountInfo = [
    { label: "اسم الشركة", value: "مسند التدريب والتوظيف" },
    { label: "نبذة عن الشركة", value: "وراء كل مشروع برمجي، مسند تجمع، توفّر، وتوظف المهارات البرمجية المبنية (للأفراد - للشركات)" },
    { label: "البريد الإلكتروني الخاص بالشركة", value: "Mosnad@gmail.com" },
    { label: "رقم الهاتف", value: "777777777" },
    { label: "مجال عمل الشركة", value: "- برمجة مواقع\n- برمجة تطبيقات\n- UI/UX\n- الحاسوب وتقنية المعلومات" },
    { label: "نوع بيئة العمل", value: "مختلط" },
    { label: "الموقع رسمي خاص بالجهة", value: "Mosnad.com" },
    { label: "منصة رسمية بأحد مواقع التواصل الاجتماعي", value: "https://www.facebook.com/Mosnad" },
    { label: "المحافظة", value: "صنعاء" },
    { label: "المدينة", value: "مديرية صنعاء" },
    { label: "الشارع/الحي", value: "شارع بغداد" },
  ];

  return (
    <section>
      <div className="bg-white rounded-lg shadow">
        {/* Header */}
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image
              src="/manage-account-icon.svg"
              alt="User"
              width={16}
              height={16}
            />
            <h2 className="text-base font-semibold text-[#21255C]">
              معلومات الحساب
            </h2>
          </div>
          {/* Link to the dynamic edit page */}
          <Link href="/companyProfile/account/edit" className="px-4 py-2">
            <Image src="/edit.svg" alt="Edit" width={20} height={20} />
          </Link>
        </div>

        {/* Table */}
        <table className="w-full text-right">
          <tbody>
            {accountInfo.map((item, index) => (
              <tr key={index} className="border-b border-gray-100">
                <td className="p-4 text-sm text-[#203B7D]">{item.label}</td>
                <td className="p-4 text-xs whitespace-pre-line">{item.value}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </section>
  );
};

export default page;
