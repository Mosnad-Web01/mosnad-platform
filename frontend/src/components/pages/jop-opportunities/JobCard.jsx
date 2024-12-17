'use client';
import Image from 'next/image';
import React from 'react';

const JobCard = ({
	title,
	experienceLevel,
	skills,
	description,
	image_url = '/hiring-compony-logo.png',
}) => {
	return (
		<div className="bg-pink-50 shadow-custom-all-sides rounded-[36px] p-4 w-full max-w-[504px] lg:w-[500px]">
			{/* Company Logo */}
			<div className="mb-4 flex justify-center md:justify-start">
				<Image
					src={image_url}
					alt="company-card-icon"
					width={100}
					height={100}
					className="w-[100px] rounded-full"
				/>
			</div>

			{/* Job Information */}
			<div className="w-full max-w-[370px] mx-auto md:mx-0">
				<h2 className="text-2xl font-semibold mb-4 ">{title}</h2>

				{/* Experience Level */}
				<article className="mb-4">
					<h3 className="text-lg font-semibold">مستوى الخبرة :</h3>
					<p className="text-gray-900 text-base">{experienceLevel}</p>
				</article>

				{/* Required Skills */}
				<article className="mb-4">
					<h3 className="text-lg font-semibold mb-2">
						المهارات المطلوبة:
					</h3>
					<p className="text-gray-900 text-base">{skills}</p>
				</article>

				{/* Other Criteria */}
				<article className="mb-4">
					<h3 className="text-lg font-semibold mb-2">
						معايير أخرى :
					</h3>
					<p className="text-gray-900 text-base">{description}</p>
				</article>
			</div>

			{/* Register Button */}
			<div className="flex justify-center md:justify-end mt-10">
				<a
					className="w-full max-w-[200px] text-center py-3 rounded-lg bg-gradient text-sm font-medium text-white shadow transition hover:scale-105"
					href="#">
					سجل الان
				</a>
			</div>
		</div>
	);
};

export default JobCard;