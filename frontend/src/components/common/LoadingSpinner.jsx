import React from 'react';

const LoadingSpinner = () => {
	return (
		<div className="relative w-full h-12 bg-gradient-to-r from-pink-500 to-red-500 rounded-lg overflow-hidden">
			<div className="absolute inset-0 flex items-center justify-center">
				<div className="flex gap-1">
					<div
						className="w-2 h-2 bg-white rounded-full animate-bounce"
						style={{ animationDelay: '0s' }}></div>
					<div
						className="w-2 h-2 bg-white rounded-full animate-bounce"
						style={{ animationDelay: '0.2s' }}></div>
					<div
						className="w-2 h-2 bg-white rounded-full animate-bounce"
						style={{ animationDelay: '0.4s' }}></div>
				</div>
			</div>
			<div className="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-shimmer"></div>
		</div>
	);
};

export default LoadingSpinner;
