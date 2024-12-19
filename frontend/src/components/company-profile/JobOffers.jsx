import React, { useState } from "react";
import JobsTable from "./manage-jobs/JobsTable";
import JobForm from "./manage-jobs/JobForm";

const JobOffers = () => {
   const [activeTab, setActiveTab] = useState('show-jobs');
    const tabData = [
      {
        label: 'عرض الوظائف',
        name: 'show-jobs',
      },
      {
        label: 'انشاء الوظائف',
        name: 'create-job',
      },
    ];

  const data = [
    {
      id: 1,
      field: "مصممي واجهه وتجربة المستخدم",
      employeesRequired: 4,
      date: "أغسطس 2023",
      employmentType: "دوام كامل",
      applicationStatus: { text: "تحت المراجعة", status: "review" },
      applicantDetailsAvailable: false,
    },
    {
      id: 2,
      field: "مصممي واجهه وتجربة المستخدم",
      employeesRequired: 4,
      date: "أغسطس 2023",
      employmentType: "دوام كامل",
      applicationStatus: { text: "تم التقديم", status: "accepted" },
      applicantDetailsAvailable: true,
    },
  ];

  const getButtonStyle = (name) =>
		`text-sm px-4 py-2 rounded-lg no-underline transition duration-300 ${
			name === activeTab
				? 'bg-[#21255C] text-white'
				: 'text-gray-400 hover:text-purple-900 hover:scale-105 '
		}`;

  return (
		<>
			<nav className="bg-white shadow p-4 rounded-2xl my-4 flex justify-between items-center">
				<div className="flex gap-4">
					{tabData.map((tab) => {
						return (
							<button
								key={tab.name}
								className={getButtonStyle(tab.name)}
								onClick={() => setActiveTab(tab.name)}>
								{tab.label}
							</button>
						);
					})}
				</div>
			</nav>

			<main>
                {activeTab === 'show-jobs' &&   <JobsTable data={data} /> }
                {activeTab === 'create-job' && <JobForm />}
         
            
            </main>
		</>
  
  );
};

export default JobOffers;
