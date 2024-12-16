import Image from 'next/image';

const FormData = ({ userData }) => {
  return (
    <section>
      {/* User Profile Section */}
      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/manage-account-icon.svg" alt="User" width={16} height={16} />
            <h2 className="text-base font-semibold text-[#21255C]">معلومات المستخدم</h2>
          </div>
        </div>
        <table className="w-full" dir="rtl">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الاسم</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.username}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">رقم الهاتف</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.phone_number}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">البريد الإلكتروني</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.email}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">تاريخ الميلاد</td>
              <td className="p-4 font-medium text-right">
                {new Date(userData.user_profile.birth_date).toLocaleDateString('en-US', {
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric',
                })}
              </td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الجنسية</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.country}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">المحافظة</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.city}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">العنوان</td>
              <td className="p-4 font-medium text-right">{userData.user_profile.address}</td>
            </tr>
          </tbody>
        </table>
      </div>

      {/* Survey Data Section */}
      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/manage-account-icon.svg" alt="Survey" width={16} height={16} />
            <h2 className="text-base font-semibold text-[#21255C]">بيانات الاستبيان</h2>
          </div>
        </div>
        <table className="w-full" dir="rtl">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الجنس</td>
              <td className="p-4 font-medium text-right">{userData.gender}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">هل أنت خريج؟</td>
              <td className="p-4 font-medium text-right">{userData.is_it_graduate ? 'نعم' : 'لا'}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الوظيفة المرغوب فيها</td>
              <td className="p-4 font-medium text-right">{userData.job_interest}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الدافع</td>
              <td className="p-4 font-medium text-right">{userData.motivation}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الأهداف المهنية</td>
              <td className="p-4 font-medium text-right">{userData.career_goals}</td>
            </tr>
          </tbody>
        </table>
      </div>

      {/* Skills & Experience Section */}
      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/manage-account-icon.svg" alt="Experience" width={16} height={16} />
            <h2 className="text-base font-semibold text-[#21255C]">الخبرات والمهارات</h2>
          </div>
        </div>
        <table className="w-full" dir="rtl">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">أفكار مشاريع</td>
              <td className="p-4 font-medium text-right">{userData.project_ideas}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">هل لديك ورش عمل؟</td>
              <td className="p-4 font-medium text-right">{userData.has_workshops ? 'نعم' : 'لا'}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">تفاصيل الورش</td>
              <td className="p-4 font-medium text-right">{userData.workshop_clarify}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">هل لديك خبرة برمجية؟</td>
              <td className="p-4 font-medium text-right">{userData.has_coding_experience ? 'نعم' : 'لا'}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">تفاصيل الخبرة البرمجية</td>
              <td className="p-4 font-medium text-right">{userData.coding_clarify}</td>
            </tr>
          </tbody>
        </table>
      </div>

      {/* Language Skills Section */}
      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/manage-account-icon.svg" alt="Languages" width={16} height={16} />
            <h2 className="text-base font-semibold text-[#21255C]">اللغات</h2>
          </div>
        </div>
        <table className="w-full" dir="rtl">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">هل تعرف لغات أخرى؟</td>
              <td className="p-4 font-medium text-right">{userData.knows_other_languages ? 'نعم' : 'لا'}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">اللغات</td>
              <td className="p-4 font-medium text-right">{userData.languages}</td>
            </tr>
          </tbody>
        </table>
      </div>

      {/* Problem Solving & Usability Section */}
      <div className="bg-white rounded-lg shadow mt-4">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/manage-account-icon.svg" alt="Problem Solving" width={16} height={16} />
            <h2 className="text-base font-semibold text-[#21255C]">حل المشكلات والاستخدام</h2>
          </div>
        </div>
        <table className="w-full" dir="rtl">
          <tbody>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">حل المشكلات الإبداعي</td>
              <td className="p-4 font-medium text-right">{userData.creative_problem_solving}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">الفرق بين الموقع والتطبيق</td>
              <td className="p-4 font-medium text-right">{userData.website_vs_webapp}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">خطوات سهولة استخدام</td>
              <td className="p-4 font-medium text-right">{userData.usability_steps}</td>
            </tr>
            <tr className="border-b border-gray-100">
              <td className="p-4 text-gray-500 w-1/3 text-right">معلومات اضافية</td>
              <td className="p-4 font-medium text-right">{userData.additional_info}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>  
  );
};

export default FormData;