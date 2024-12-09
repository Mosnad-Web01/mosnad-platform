import React from "react";
import StatusBadge from "@/components/common/StatusBadge";

const JobsApplicants = () => {
  const data = [
    {
      id: 1,
      name: "سلمان محمد علي الحاج",
      specialization: "UI/UX",
      hiringDate: "أغسطس 2023",
      salary: "1600$",
      employmentStatus: { text: "منتظم", status: "accepted" },
      detailsAvailable: true,
    },
    {
      id: 2,
      name: "سلمان محمد علي الحاج",
      specialization: "UI/UX",
      hiringDate: "أغسطس 2023",
      salary: "2000$",
      employmentStatus: { text: "انتهى العقد", status: "review" },
      detailsAvailable: true,
    },
  ];

  return (
    <article className="bg-white shadow rounded-2xl p-4 mt-4 max-h-screen w-full overflow-auto">
      <h2 className="text-xs sm:text-sm text-[#21255C] font-bold mb-8">
        جميع الموظفين
      </h2>
      <div className="overflow-x-auto">
        <table className="w-full border-collapse text-right text-[10px] sm:text-xs">
          <thead className="bg-blue-800 text-white">
            <tr>
              <th className="py-5 px-2 sm:px-5 first:rounded-tr-xl first:rounded-br-xl">
                ID
              </th>
              <th className="py-5 px-2">اسم الموظف</th>
              <th className="py-5 px-2">التخصص</th>
              <th className="py-5 px-2">تاريخ التوظيف</th>
              <th className="py-5 px-2">الراتب</th>
              <th className="py-5 px-2">حالة الموظف</th>
              <th className="py-5 px-2 last:rounded-tl-xl last:rounded-bl-xl">
                تفاصيل الموظف
              </th>
            </tr>
          </thead>
          <tbody className="text-[#21255C]">
            {data.map((item, index) => (
              <tr
                key={index}
                className="border-b hover:bg-gray-100 transition duration-150"
              >
                <td className="py-4 px-2 sm:px-6">{item.id}</td>
                <td className="py-4 px-2">{item.name}</td>
                <td className="py-4 px-2">{item.specialization}</td>
                <td className="py-4 px-2">{item.hiringDate}</td>
                <td className="py-4 px-2">{item.salary}</td>
                <td className="py-4 px-2">
                  <StatusBadge
                    text={item.employmentStatus.text}
                    status={item.employmentStatus.status}
                  />
                </td>
                <td className="py-4 px-2">
                  {item.detailsAvailable && (
                    <button className="text-[#21255C] text-sm hover:underline">
                      👁
                    </button>
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

export default JobsApplicants;
