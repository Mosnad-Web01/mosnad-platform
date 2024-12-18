const JobCardSkeleton = () => {
	return (
		<div className="flex items-start gap-6 p-6 bg-white rounded-xl shadow-md border border-gray-200 animate-pulse">
			{/* Skeleton Icon */}
			<div className="flex-shrink-0 w-16 h-16 bg-gray-300 rounded-full"></div>

			{/* Skeleton Content */}
			<div className="flex-1 space-y-4">
				{/* Title Skeleton */}
				<div className="w-2/3 h-4 bg-gray-300 rounded"></div>

				{/* Description Skeleton */}
				<div className="space-y-2">
					<div className="w-full h-4 bg-gray-300 rounded"></div>
					<div className="w-5/6 h-4 bg-gray-300 rounded"></div>
				</div>

				{/* Details Skeleton */}
				<div className="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div className="w-1/2 h-4 bg-gray-300 rounded"></div>
					<div className="w-1/3 h-4 bg-gray-300 rounded"></div>
				</div>
			</div>

			{/* Skeleton Button */}
			<div className="w-24 h-8 bg-gray-300 rounded"></div>
		</div>
	);
};

export default JobCardSkeleton;
