'use client';
import Image from 'next/image';
import { formatEnglishDate } from '@/utils/formatter'; // 
import Link from 'next/link';
const JobCard = ({
	title,
	experience,
	required_skills,
	position_level,
	end_date,
	other_criteria,
	description,
	image_url = '/hiring-compony-logo.png',
}) => {
	
	// Format the end date
	  const formattedEndDate = formatEnglishDate(end_date);
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
					<p className="text-gray-900 text-base">{experience}</p>
				</article>

				{/* position Level */}
				<article className="mb-4">
					<h3 className="text-lg font-semibold"> مستوى الوظيفة</h3>
					<p className="text-gray-900 text-base">{position_level}</p>
				</article>

				{/* Required Skills */}
				<article className="mb-4">
					<h3 className="text-lg font-semibold mb-2">
						المهارات المطلوبة:
					</h3>
					<p className="text-gray-900 text-base">{required_skills}</p>
				</article>

				{/* Description */}
				<article className="mb-4">
					<h3 className="text-lg font-semibold mb-2">الوصف</h3>
					<p className="text-gray-900 text-base">{description}</p>
				</article>

				{/* End Date */}
				<article className="mb-4">
					<h3 className="text-lg font-semibold mb-2">
						تاريخ الانتهاء
					</h3>
					<p className="text-gray-900 text-base">{formattedEndDate}</p>
				</article>
			</div>

			{/* Register Button */}
			<div className="flex justify-center md:justify-end mt-10">
				<Link 
					className="w-full max-w-[200px] text-center py-3 rounded-lg bg-gradient text-sm font-medium text-white shadow transition hover:scale-105"
					href="/YouthForm">
					 قدم الأن
				</Link>
			</div>
		</div>
	);
};

export default JobCard;
