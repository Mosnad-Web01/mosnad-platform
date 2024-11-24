'use client';
import React, { useState } from 'react';

import JobCard from './JobCard';
import ToggleButtonGroup from '../common/ToggleButtonGroup';

const JobListings = () => {
	const [activeOption, setActiveOption] = useState('experienced');

	const jobData = [
		{
			title: 'مطور Flutter',
			experienceLevel: 'متوسط الخبرة من 4-6 سنوات',
			skills: 'إتقان Flutter، مهارة بناء وقيادة الفرق',
			description:
				'خبرة في بناء خدمات خلفية قابلة للتوسع والصيانة، بالإضافة إلى فهم قوي للخدمات السحابية',
		},
		{
			title: 'مطور Flutter',
			experienceLevel: 'متوسط الخبرة من 4-6 سنوات',
			skills: 'إتقان Flutter، مهارة بناء وقيادة الفرق',
			description:
				'خبرة في بناء خدمات خلفية قابلة للتوسع والصيانة، بالإضافة إلى فهم قوي للخدمات السحابية',
		},
	];

	const toggleOptions = [
		{ label: 'ذو خبرة', value: 'experienced' },
		{ label: 'جديد في المجال', value: 'new' },
	];

	return (
		<section
			className="w-full"
			style={{
				background:
					'radial-gradient(circle at calc(100% - 100px) 100px, rgba(238, 174, 202, 0.1) 0%, rgba(238, 174, 202, 0) 50%)',
				backgroundColor: 'white',
			}}>
			<div className="container mx-auto px-4 py-8 ">
				{/* Header Section */}
				<div className="flex flex-col gap-16 text-center mt-20">
					{/* Toggle Buttons */}
					<div className="w-fit mx-auto  shadow-md rounded-full">
						<ToggleButtonGroup
							options={toggleOptions}
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
							}}>
							يسعدنا انضمامك لنا في الوظائف المتاحة
						</h2>
					</div>
				</div>

				{/* Job Listings Section */}
				<div className="flex items-center justify-center mt-20">
					<div className="grid grid-cols-1 md:grid-cols-2 gap-4">
						{jobData.map((job, index) => (
							<JobCard
								key={index}
								title={job.title}
								experienceLevel={job.experienceLevel}
								skills={job.skills}
								description={job.description}
							/>
						))}
					</div>
				</div>
			</div>
		</section>
	);
};

export default JobListings;