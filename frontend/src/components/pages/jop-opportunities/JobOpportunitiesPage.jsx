'use client';
import React, { useState, useEffect } from 'react';
import ToggleButtonGroup from '@/components/common/ToggleButtonGroup';
import JobCard from './JobCard';

const JobOpportunitiesPage = ({ jobData }) => {
  const [activeOption, setActiveOption] = useState('experienced');
  const [searchTerm, setSearchTerm] = useState('');
  const [filteredJobs, setFilteredJobs] = useState(jobData);
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [isLoading, setIsLoading] = useState(true);

  const toggleOptions = [
    { label: 'ذو خبرة', value: 'experienced' },
    { label: 'جديد في المجال', value: 'new' },
  ];

  const categories = ['all', 'تقنية', 'إدارة', 'تسويق', 'مبيعات'];

  useEffect(() => {
    const timer = setTimeout(() => setIsLoading(false), 1000);
    return () => clearTimeout(timer);
  }, []);

  useEffect(() => {
    setIsLoading(true);
    const filtered = jobData.filter(job => {
      const matchesSearch = job.title.toLowerCase().includes(searchTerm.toLowerCase());
      const matchesCategory = selectedCategory === 'all'; // Since category isn't in your data structure
      
      // Parse experience string to determine if it's experienced or new
      const isExperienced = job.experience.includes('3-5') || 
                           parseInt(job.experience) >= 2;
      const matchesExperience = activeOption === 'experienced' ? isExperienced : !isExperienced;
      
      return matchesSearch && matchesCategory && matchesExperience;
    });
    
    setTimeout(() => {
      setFilteredJobs(filtered);
      setIsLoading(false);
    }, 300);
  }, [searchTerm, selectedCategory, activeOption, jobData]);

  return (
    <div className="min-h-screen bg-gradient-to-b from-white to-blue-50 overflow-hidden">
      <style jsx>{`
        @keyframes fadeIn {
          from { opacity: 0; transform: translateY(20px); }
          to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes scaleIn {
          from { transform: scale(0.9); opacity: 0; }
          to { transform: scale(1); opacity: 1; }
        }
        
        @keyframes floatAnimation {
          0% { transform: translateY(0px); }
          50% { transform: translateY(-10px); }
          100% { transform: translateY(0px); }
        }

        .fade-in {
          animation: fadeIn 0.6s ease-out forwards;
        }

        .scale-in {
          animation: scaleIn 0.5s ease-out forwards;
        }

        .float {
          animation: floatAnimation 3s ease-in-out infinite;
        }
      `}</style>

      {/* Animated background elements */}
      <div className="fixed inset-0 -z-10">
        <div className="absolute top-0 right-0 w-96 h-96 bg-blue-100 rounded-full filter blur-3xl opacity-30 float" />
        <div className="absolute bottom-0 left-0 w-96 h-96 bg-pink-100 rounded-full filter blur-3xl opacity-30 float" 
             style={{ animationDelay: '1s' }} />
        <div className="absolute top-1/2 left-1/2 w-96 h-96 bg-purple-100 rounded-full filter blur-3xl opacity-20 float"
             style={{ animationDelay: '2s' }} />
      </div>

      <section className="relative container mx-auto px-4 py-16">
        {/* Header Section */}
        <div className="fade-in">
          <div className="flex flex-col gap-8 text-center mb-16">
            <h1 className="text-5xl font-bold text-blue-950 mb-4 hover:scale-105 transition-transform duration-300">
              <span className="relative inline-block after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-full after:h-1 after:bg-blue-500 after:transform after:scale-x-0 after:transition-transform after:duration-500 hover:after:scale-x-100">
                انضم إلى فريقنا المتميز
              </span>
            </h1>
            <p className="text-gray-600 text-lg max-w-2xl mx-auto transform transition-all duration-500 hover:text-blue-800">
              نبحث عن المواهب المتميزة للانضمام إلى فريقنا. اكتشف الفرص المتاحة وكن جزءاً من نجاحنا
            </p>
          </div>
        </div>

        {/* Search and Filter Section */}
        <div className="bg-white rounded-2xl shadow-lg p-6 mb-12 scale-in hover:shadow-2xl transition-shadow duration-300">
          <div className="flex flex-col md:flex-row gap-6 items-center justify-between">
            <div className="w-full md:w-auto transform transition-all duration-300 hover:scale-105">
              <ToggleButtonGroup
                options={toggleOptions}
                activeOption={activeOption}
                onOptionChange={setActiveOption}
                containerStyle="bg-gray-50 p-1.5 shadow-sm w-fit rounded-xl backdrop-blur-sm"
                buttonStyle="flex justify-center gap-2 px-6 py-3 rounded-lg text-base font-semibold text-blue-900 transition-all duration-300 hover:shadow-lg hover:bg-blue-50"
              />
            </div>

            <div className="relative w-full md:w-96 group">
              <input
                type="text"
                placeholder="ابحث عن وظيفة..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:shadow-lg"
              />
              <svg
                className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 transition-all duration-300 group-hover:text-blue-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
          </div>

          <div className="flex gap-3 mt-6 overflow-x-auto pb-2 scrollbar-hide">
            {categories.map((category) => (
              <button
                key={category}
                onClick={() => setSelectedCategory(category)}
                className={`px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-md whitespace-nowrap
                  ${selectedCategory === category
                    ? 'bg-blue-500 text-white shadow-md hover:bg-blue-600'
                    : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                  }`}
              >
                {category === 'all' ? 'جميع الوظائف' : category}
              </button>
            ))}
          </div>
        </div>

        {/* Job Listings */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {isLoading ? (
            Array(6).fill(0).map((_, index) => (
              <div key={index} 
                   className="bg-white rounded-xl p-6 shadow-lg animate-pulse"
                   style={{ animationDelay: `${index * 100}ms` }}>
                <div className="h-6 bg-gray-200 rounded-full w-3/4 mb-4"></div>
                <div className="h-4 bg-gray-200 rounded-full w-1/2 mb-2"></div>
                <div className="h-4 bg-gray-200 rounded-full w-2/3"></div>
              </div>
            ))
          ) : (
            filteredJobs.map((job, index) => (
              <div
                key={index}
                className="scale-in"
                style={{ 
                  animationDelay: `${index * 100}ms`,
                  opacity: 0
                }}
              >
                <div className="transform transition-all duration-300 hover:scale-105">
                  <JobCard {...job} />
                </div>
              </div>
            ))
          )}
        </div>

        {/* Empty State */}
        {!isLoading && filteredJobs.length === 0 && (
          <div className="fade-in text-center py-16">
            <div className="text-gray-400 text-6xl mb-4 float">🔍</div>
            <h3 className="text-xl font-semibold text-gray-700 mb-2">
              لم نجد وظائف مطابقة
            </h3>
            <p className="text-gray-500">
              جرب تغيير معايير البحث أو تصفح جميع الوظائف المتاحة
            </p>
          </div>
        )}
      </section>
    </div>
  );
};

export default JobOpportunitiesPage;