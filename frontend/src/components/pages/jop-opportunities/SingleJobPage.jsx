import Image from 'next/image';

export const SingleJobPage = ({ job }) => {
	return (
		<div className="max-w-4xl mx-auto p-6 bg-gray-50 dark:bg-gray-900 rounded-lg shadow-lg">
			{/* Header Section */}
			<div className="text-center mb-6">
				<h1 className="text-3xl font-bold text-gray-800 dark:text-white">{job.title}</h1>
				<p className="text-sm text-gray-500 dark:text-gray-400">
					Application closes on{' '}
					<span className="font-semibold">{new Date(job.end_date).toLocaleDateString()}</span>
				</p>
			</div>

			{/* Job Image */}
			<div className="flex justify-center mb-6">
				<Image
					src={job.imgurl}
					alt={job.title}
					width={600}
					height={400}
					className="rounded-md shadow-md"
				/>
			</div>

			{/* Job Details Section */}
			<div className="space-y-4">
				{/* Job Description */}
				<div>
					<h2 className="text-xl font-semibold text-gray-800 dark:text-white">Description</h2>
					<p className="text-gray-700 dark:text-gray-300">{job.description}</p>
				</div>

				{/* Required Skills */}
				<div>
					<h2 className="text-xl font-semibold text-gray-800 dark:text-white">Required Skills</h2>
					<p className="text-gray-700 dark:text-gray-300">{job.required_skills}</p>
				</div>

				{/* Experience */}
				<div>
					<h2 className="text-xl font-semibold text-gray-800 dark:text-white">Experience</h2>
					<p className="text-gray-700 dark:text-gray-300">{job.experience}</p>
				</div>

				{/* Position Level */}
				<div>
					<h2 className="text-xl font-semibold text-gray-800 dark:text-white">Position Level</h2>
					<p className="text-gray-700 dark:text-gray-300">{job.position_level}</p>
				</div>

				{/* Other Criteria */}
				{job.other_criteria && (
					<div>
						<h2 className="text-xl font-semibold text-gray-800 dark:text-white">Other Criteria</h2>
						<p className="text-gray-700 dark:text-gray-300">{job.other_criteria}</p>
					</div>
				)}
			</div>

			{/* Apply Button */}
			<div className="mt-8 flex justify-center">
				<a
					href="#apply-now"
					className="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
				>
					Apply Now
				</a>
			</div>
		</div>
	);
};
