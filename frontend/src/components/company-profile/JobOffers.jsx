import React, { useState, useEffect } from "react";
import JobsTable from "./manage-jobs/JobsTable";
import JobForm from "./manage-jobs/JobForm";
import { get } from "@/lib/axios"; // Adjust path as needed

const JobOffers = () => {
    const [activeTab, setActiveTab] = useState("show-jobs");
    const [jobs, setJobs] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    const tabData = [
        {
            label: "عرض الوظائف",
            name: "show-jobs",
        },
        {
            label: "انشاء الوظائف",
            name: "create-job",
        },
    ];

    const handleTabChange = (tabName) => {
        setActiveTab(tabName);
    };

    const fetchUserJobs = async () => {
        setLoading(true);
        setError(null);
        try {
            const response = await get("/opportunities");
            if (response.success) {
                const transformedJobs = response.opportunities.map((job) => ({
                    id: job.id,
                    field: job.title,
                    employeesRequired: job.position_level,
                    date: new Date(job.created_at).toLocaleDateString("ar-EG", {
                        year: "numeric",
                        month: "long",
                    }),
                    employmentType: "دوام كامل",
                    applicationStatus: {
                        text: job.is_approved ? "تمت الموافقة" : "تحت المراجعة",
                        status: job.is_approved ? "accepted" : "review",
                    },
                    applicantDetailsAvailable: true,
                }));
                setJobs(transformedJobs);
            } else {
                setJobs([]);
                setError("حدث خطأ أثناء تحميل البيانات.");
            }
        } catch (err) {
            console.error("Error fetching jobs:", err);
            setError("حدث خطأ أثناء الاتصال بالخادم.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        if (activeTab === "show-jobs") {
            fetchUserJobs();
        }
    }, [activeTab]);

    const getButtonStyle = (name) =>
        `text-sm px-4 py-2 rounded-lg no-underline transition duration-300 ${
            name === activeTab
                ? "bg-[#21255C] text-white"
                : "text-gray-400 hover:text-purple-900 hover:scale-105"
        }`;

    return (
        <>
            <nav className="bg-white shadow p-4 rounded-2xl my-4 flex justify-between items-center">
                <div className="flex gap-4">
                    {tabData.map((tab) => (
                        <button
                            key={tab.name}
                            className={getButtonStyle(tab.name)}
                            onClick={() => handleTabChange(tab.name)}
                        >
                            {tab.label}
                        </button>
                    ))}
                </div>
            </nav>

            <main>
                {activeTab === "show-jobs" && (
                    <>
                        {loading && <div className="text-center p-4">جاري التحميل...</div>}
                        {!loading && error && (
                            <div className="text-center p-4 text-red-600">{error}</div>
                        )}
                        {!loading && !error && jobs.length === 0 && (
                            <div className="text-center p-4">لا توجد وظائف لعرضها حاليا.</div>
                        )}
                        {!loading && !error && jobs.length > 0 && <JobsTable data={jobs} />}
                    </>
                )}
                {activeTab === "create-job" && <JobForm />}
            </main>
        </>
    );
};

export default JobOffers;
