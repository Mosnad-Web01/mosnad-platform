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
		<div className="bg-white shadow-md rounded-lg p-6 max-w-sm">
			<div className="flex items-center mb-4">
				<Image
					src={image_url}
					alt="company-card-icon"
					width={50}
					height={50}
					className="w-12 h-12 rounded-full"
				/>
			</div>
			<h3 className="text-xl font-bold mb-2">{title}</h3>
			<p className="text-gray-600 mb-2">
				<span className="font-bold">مستوى الخبرة:</span>{' '}
				{experienceLevel}
			</p>
			<p className="text-gray-600 mb-2">
				<span className="font-bold">المهارات المطلوبة:</span> {skills}
			</p>
			<p className="text-gray-600 mb-4">{description}</p>
			<button className="bg-gradient-to-r from-purple-600 to-pink-500 text-white font-bold py-2 px-4 rounded-lg hover:from-purple-700 hover:to-pink-600">
				سجل الآن
			</button>
		</div>
	);
};

export default JobCard;
