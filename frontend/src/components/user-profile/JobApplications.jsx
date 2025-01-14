import StatusBadge from "../common/StatusBadge";

const JobApplications = () => {
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
      <h2 className="text-xs sm:text-sm text-[#21255C] font-bold mb-8">
        جميع طلبات التقديم على تدريب
      </h2>
      <div className="overflow-x-auto">
        <table className="w-full border-collapse text-right text-[10px] sm:text-xs">
          {/* Table Head */}
          <thead className="bg-blue-800 text-white">
            <tr>
              <th className="py-5 px-2 sm:px-5 first:rounded-tr-xl first:rounded-br-xl">
                ID
              </th>
              <th className="py-5 px-2">اسم المخيم / الفرصة</th>
              <th className="py-5 px-2">استمارة التقديم</th>
              <th className="py-5 px-2">تاريخ التقديم</th>
              <th className="py-5 px-2">حالة التقديم</th>
              <th className="py-5 px-2 last:rounded-tl-xl last:rounded-bl-xl">
                شهادة اكمال التدريب
              </th>
            </tr>
          </thead>

          {/* Table Body */}
          <tbody className="text-[#21255C]">
            {data.map((item, index) => (
              <tr
                key={index}
                className="border-b hover:bg-gray-100 transition duration-150"
              >
                <td className="py-4 px-2 sm:px-6">{item.id}</td>
                <td className="py-4 px-2">{item.opportunityName}</td>
                <td className="py-4 px-2">
                  {item.formAvailable && (
                    <button className="text-[#21255C] text-sm hover:underline">
                      👁
                    </button>
                  )}
                </td>
                <td className="py-4 px-2">{item.date}</td>
                <td className="py-4 px-2">
                  <StatusBadge
                    text={item.applicationStatus.text}
                    status={item.applicationStatus.status}
                  />
                </td>
                <td className="py-4 px-2">
                  {item.trainingAvailable ? (
                    <button className="text-[#21255C] text-sm hover:underline">
                      👁
                    </button>
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

export default JobApplications;
