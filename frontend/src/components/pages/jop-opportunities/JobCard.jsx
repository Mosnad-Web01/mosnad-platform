import { formatEnglishDate } from '@/utils/formatter';
import Image from 'next/image';
import Link from 'next/link';

const JobCard = ({
	id,
	title,
	required_skills,
	experience,
	end_date,
	image_url,
}) => {
	return (
		<div className="flex items-start gap-6 p-6 bg-white rounded-xl shadow-md border border-gray-200">
			
			{/* Job Image */}
			<div className="flex-shrink-0 w-16 h-16">
				{image_url ? (
					<Image
						src={image_url} 
						alt={title} 
						width={100} 
						height={100} 
						className="rounded-full object-contain" 
					/>
				) : (
					<div className="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 text-white rounded-full flex items-center justify-center text-2xl font-bold">
						<i className="fas fa-briefcase"></i>
					</div>
				)}
			</div>

			{/* Job Details */}
			<div className="flex-1">
				<h3 className="text-xl font-bold text-gray-800 mb-2">
					{title}
				</h3>
				<p className="text-gray-600 mb-4">
					<strong>المهارات المطلوبة:</strong> {required_skills}
				</p>
				<div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
					<div>
						<span className="text-gray-500">الخبرة المطلوبة:</span>{' '}
						<span className="font-medium text-gray-700">
							{experience} {experience === 1 ? 'سنة' : 'سنوات'}
						</span>
					</div>
					<div>
						<span className="text-gray-500">آخر موعد للتقديم:</span>{' '}
						<span className="font-medium text-gray-700">
							{formatEnglishDate(end_date)}
						</span>
					</div>
				</div>
			</div>

			{/* Apply Button */}
			<Link
			href={`/job-opportunities/${id}`}
			>
				<div className="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
					تقدم الآن
				</div>
			</Link>
		</div>
	);
};

export default JobCard;
