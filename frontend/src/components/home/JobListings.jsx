'use client';

import React, { useState, useEffect } from 'react';
import JobCard from './JobCard';
import ToggleButtonGroup from '../common/ToggleButtonGroup';
import BootcampCard from '@/components/card/BootcampCard';
import { get } from '../../lib/axios';

// Fetch job data directly in the component
const fetchJobData = async () => {
  try {
    const data = await get('/job-opportunities');
    return data.opportunities;
  } catch (error) {
    console.error('Error fetching job data:', error.message);
    return [];
  }
};

const fetchBootcamps = async () => {
  try {
    const response = await get('/bootcamps');
    return response.bootcamps;
  } catch (error) {
    console.error('Error fetching bootcamps:', error);
    return []; // Return empty array if there's an error
  }
};

const JobListings = () => {
  const [activeOption, setActiveOption] = useState('experienced'); // Track selected option (experienced or new)
  const [jobData, setJobData] = useState([]); // Job data state
  const [bootcamps, setBootcamps] = useState([]); // Bootcamps state
  const [loading, setLoading] = useState(false); // Loading state

  // Fetch job data when the component mounts
  useEffect(() => {
    const getJobData = async () => {
      setLoading(true); // Set loading true before fetching data
      const data = await fetchJobData();
      setJobData(data);
      setLoading(false); // Set loading false after data is fetched
    };

    // Always fetch job data when the component mounts
    getJobData();
  }, []);

  // Fetch bootcamps when 'new' option is selected
  useEffect(() => {
    const getBootcampsData = async () => {
      setLoading(true); // Show loading spinner while fetching bootcamps
      const data = await fetchBootcamps();
      setBootcamps(data); // Set bootcamps data
      setLoading(false); // Hide loading spinner once bootcamps are fetched
    };

    if (activeOption === 'new') {
      getBootcampsData(); // Fetch bootcamps if 'new' is selected
    }
  }, [activeOption]);

  return (
    <section
      className="w-full"
      style={{
        backgroundColor: 'white',
      }}
    >
      <div className="container mx-auto px-4 py-8">
        {/* Header Section */}
        <div className="flex flex-col gap-16 text-center mt-20">
          {/* Toggle Buttons */}
          <div className="w-fit mx-auto shadow-md rounded-full">
            <ToggleButtonGroup
              options={[
                { label: 'ذو خبرة', value: 'experienced' },
                { label: 'جديد في المجال', value: 'new' },
              ]}
              activeOption={activeOption}
              onOptionChange={setActiveOption}
              containerStyle="bg-white p-1.5 md:px-2 shadow-sm w-fit rounded-xl"
              buttonStyle="flex justify-center gap-2 px-3 py-3 md:px-6 md:py-3 w-[150px] sm:w-[120px] md:w-[200px] rounded-full text-center text-base md:text-lg font-semibold text-blue-900 transition-all duration-300 hover:shadow-sm"
            />
          </div>

          {/* Title */}
          <div className="max-w-xl mx-auto">
            <h2
              className="text-4xl font-bold text-blue-950"
              style={{
                lineHeight: '1.7',
              }}
            >
              يسعدنا انضمامك لنا في {activeOption === 'new' ? 'الدورات التدريبية' : 'الوظائف'}
            </h2>
          </div>
        </div>

        {/* Content Section */}
        <div className="flex items-center w-full justify-center mt-20">
          <div className="max-w-screen-xl mx-auto">
            {/* Conditional Rendering */}
            {activeOption === 'experienced' ? (
              // Display Job Listings if 'experienced' is selected
              <div className="grid grid-cols-1 md:grid-cols-2  gap-4">
                {jobData && jobData.length > 0 ? (
                  jobData.map((job, index) => (
                    <JobCard
                      key={index}
                      title={job.title}
                      experience={job.experience}
                      image_url={job.imgurl}
                      required_skills={job.required_skills}
                      position_level={job.position_level}
                      description={job.description}
                      other_criteria={job.other_criteria}
                      end_date={job.end_date}
                    />
                  ))
                ) : (
                  <div className="text-center py-12">
                    <h3 className="text-xl text-gray-600">No jobs available</h3>
                  </div>
                )}
              </div>
            ) : loading ? (
              // Show Loading Spinner while fetching bootcamps
              <div className="flex justify-center items-center min-h-96">
                <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-pink-500"></div>
              </div>
            ) : bootcamps.length > 0 ? (
              // Display Bootcamps if 'new' is selected
              <div className="grid grid-cols-1 gap-2">
                {bootcamps.map((bootcamp) => (
                  <BootcampCard key={bootcamp.id} bootcamp={bootcamp} />
                ))}
              </div>
            ) : (
              <div className="text-center py-12">
                <h3 className="text-xl text-gray-600">No bootcamps found</h3>
              </div>
            )}
          </div>
        </div>
      </div>
    </section>
  );
};

export default JobListings;
