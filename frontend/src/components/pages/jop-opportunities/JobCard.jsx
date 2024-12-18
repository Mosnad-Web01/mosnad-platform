const JobCard = ({ title, location, type, category, experience, deadline }) => {
	return (
		<div className="relative group">
			<style jsx>{`
				@keyframes shimmer {
					0% {
						transform: translateX(100%);
					}
					100% {
						transform: translateX(-100%);
					}
				}

				.shine-effect::after {
					content: '';
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background: linear-gradient(
						90deg,
						transparent,
						rgba(255, 255, 255, 0.2),
						transparent
					);
					transform: translateX(-100%);
					opacity: 0;
					transition: opacity 0.3s;
				}

				.group:hover .shine-effect::after {
					animation: shimmer 1.5s infinite;
					opacity: 1;
				}
			`}</style>

			<div className="bg-white rounded-xl overflow-hidden shadow-lg transition-all duration-300 group-hover:shadow-2xl shine-effect">
				{/* Category Badge */}
				<div className="relative h-2 bg-gradient-to-r from-blue-500 to-purple-500">
					<div className="absolute -bottom-3 right-4 bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
						{category}
					</div>
				</div>

				<div className="p-6">
					{/* Header Section */}
					<div className="mb-4">
						<h3 className="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors duration-300">
							{title}
						</h3>

						{/* Location and Type */}
						<div className="flex items-center gap-4 text-sm text-gray-600">
							<div className="flex items-center gap-1">
								<svg
									className="w-4 h-4 text-gray-400"
									fill="none"
									stroke="currentColor"
									viewBox="0 0 24 24">
									<path
										strokeLinecap="round"
										strokeLinejoin="round"
										strokeWidth="2"
										d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
									/>
									<path
										strokeLinecap="round"
										strokeLinejoin="round"
										strokeWidth="2"
										d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
									/>
								</svg>
								{location}
							</div>
							<div className="flex items-center gap-1">
								<svg
									className="w-4 h-4 text-gray-400"
									fill="none"
									stroke="currentColor"
									viewBox="0 0 24 24">
									<path
										strokeLinecap="round"
										strokeLinejoin="round"
										strokeWidth="2"
										d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
									/>
								</svg>
								{type}
							</div>
						</div>
					</div>

					{/* Details Section */}
					<div className="space-y-3">
						<div className="flex items-center justify-between text-sm">
							<span className="text-gray-600">
								الخبرة المطلوبة
							</span>
							<span className="font-medium text-gray-800">
								{experience}{' '}
								{experience === 1 ? 'سنة' : 'سنوات'}
							</span>
						</div>

						<div className="flex items-center justify-between text-sm">
							<span className="text-gray-600">
								آخر موعد للتقديم
							</span>
							<span className="font-medium text-gray-800">
								{deadline}
							</span>
						</div>
					</div>

					{/* Apply Button */}
					<div className="mt-6">
						<button className="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-300 transform group-hover:scale-105 group-hover:shadow-lg">
							<div className="flex items-center justify-center gap-2">
								تقدم الآن
								<svg
									className="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
									fill="none"
									stroke="currentColor"
									viewBox="0 0 24 24">
									<path
										strokeLinecap="round"
										strokeLinejoin="round"
										strokeWidth="2"
										d="M13 7l5 5m0 0l-5 5m5-5H6"
									/>
								</svg>
							</div>
						</button>
					</div>
				</div>
			</div>

			{/* Decorative Elements */}
			<div className="absolute -z-10 inset-0 bg-gradient-to-r from-blue-100 to-purple-100 opacity-0 group-hover:opacity-50 blur-xl transition-opacity duration-300 rounded-xl" />
		</div>
	);
};

export default JobCard;
