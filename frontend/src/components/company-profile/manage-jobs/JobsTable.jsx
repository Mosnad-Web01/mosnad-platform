import StatusBadge from '@/components/common/StatusBadge'
import React from 'react'

const JobsTable = ({data}) => {
  return (
    <article className="bg-white shadow rounded-2xl p-4 mt-4 max-h-screen w-full overflow-auto">
    <h2 className="text-xs sm:text-sm text-[#21255C] font-bold mb-8">
      جميع عمليات التوظيف
    </h2>
    <div className="overflow-x-auto">
      <table className="w-full border-collapse text-right text-[10px] sm:text-xs">
        <thead className="bg-blue-800 text-white">
          <tr>
            <th className="py-5 px-2 sm:px-5 first:rounded-tr-xl first:rounded-br-xl">
              ID
            </th>
            <th className="py-5 px-2">المجال المطلوب</th>
            <th className="py-5 px-2">عدد الموظفين المطلوب</th>
            <th className="py-5 px-2">تاريخ الطلب</th>
            <th className="py-5 px-2">نوع الدوام</th>
            <th className="py-5 px-2">حالة الطلب</th>
            <th className="py-5 px-2 last:rounded-tl-xl last:rounded-bl-xl">
              تفاصيل المتقدم
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
              <td className="py-4 px-2">{item.field}</td>
              <td className="py-4 px-2">{item.employeesRequired}</td>
              <td className="py-4 px-2">{item.date}</td>
              <td className="py-4 px-2">{item.employmentType}</td>
              <td className="py-4 px-2">
                <StatusBadge
                  text={item.applicationStatus.text}
                  status={item.applicationStatus.status}
                />
              </td>
              <td className="py-4 px-2">
                {item.applicantDetailsAvailable ? (
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
  )
}

export default JobsTable