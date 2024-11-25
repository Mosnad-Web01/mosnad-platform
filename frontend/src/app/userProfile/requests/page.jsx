import React from "react";
import StatusBadge from "@/components/common/StatusBadge";

const Page = () => {
  // Sample data object
  const data = [
    {
      id: 1,
      opportunityName: "UI/UX",
      formAvailable: true,
      date: "أغسطس 2023",
      applicationStatus: { text: "تحت المراجعة", status: "review" },
      trainingAvailable: false,
    },
    {
      id: 2,
      opportunityName: "Web Full Stack",
      formAvailable: true,
      date: "أغسطس 2023",
      applicationStatus: { text: "مرحلة الاختبار", status: "rejected" },
      trainingAvailable: false,
    },
    {
      id: 3,
      opportunityName: "UI/UX",
      formAvailable: true,
      date: "أغسطس 2023",
      applicationStatus: { text: "تم القبول", status: "accepted" },
      trainingAvailable: true,
    },
    {
      id: 4,
      opportunityName: "Web Full Stack",
      formAvailable: true,
      date: "أغسطس 2023",
      applicationStatus: { text: "مرحلة الاختبار", status: "rejected" },
      trainingAvailable: false,
    },
    {
      id: 5,
      opportunityName: "UI/UX",
      formAvailable: true,
      date: "أغسطس 2023",
      applicationStatus: { text: "تحت المراجعة", status: "review" },
      trainingAvailable: false,
    },
  ];

  return (
    <article className="bg-white shadow rounded-2xl p-4 mt-4 max-h-screen w-full overflow-auto">
      <h2 className="text-base text-[#21255C] font-bold mb-8">
        جميع طلبات التقديم على تدريب
      </h2>
      <div className="overflow-x-auto">
        <table className="w-full border-collapse text-right">
          <thead className="bg-blue-800 text-white text-sm rounded-xl">
            <tr>
              <th className="py-7 px-5 first:rounded-tr-xl first:rounded-br-xl">
                ID
              </th>
              <th className="py-7 px-2">اسم المخيم / الفرصة</th>
              <th className="py-7 px-2">استمارة التقديم</th>
              <th className="py-7 px-2">تاريخ التقديم</th>
              <th className="py-7 px-2">حالة التقديم</th>
              <th className="py-7 px-2 last:rounded-tl-xl last:rounded-bl-xl">
                شهادة اكمال التدريب
              </th>
            </tr>
          </thead>
          <tbody className="text-sm text-[#21255C]">
            {data.map((item, index) => (
              <tr key={index} className="border-b">
                <td className="py-5 px-6">{item.id}</td>
                <td className="py-5 px-3">{item.opportunityName}</td>
                <td className="py-5 px-3">
                  {item.formAvailable && (
                    <button className="text-[#21255C] text-2xl  hover:underline">👁</button>
                  )}
                </td>
                <td className="py-5 px-3">{item.date}</td>
                <td className="py-5 px-3">
                  <StatusBadge
                    text={item.applicationStatus.text}
                    status={item.applicationStatus.status}
                  />
                </td>
                <td className="py-2 px-3">
                  {item.trainingAvailable ? (
                    <button className="text-[#21255C] text-2xl  hover:underline">👁</button>
                  ) : (
                    <StatusBadge text="غير متاح حاليا" status="rejected" />
                  )}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </article>
  );
};

export default Page;
