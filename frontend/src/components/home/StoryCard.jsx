import Image from 'next/image';

const StoryCard = ({ name, position, imageUrl, isReversed = false }) => {
	return (
		<div
			className={`relative flex flex-col md:flex-row ${
				isReversed ? 'md:flex-row-reverse' : ''
			} items-center `}>
			{/* Purple Background */}
			<div
				className={`absolute top-1/2 left-0 transform -translate-y-1/2 
       bg-purple-200 h-[40%] md:h-[60%] w-full z-0`}></div>

			{/* Image */}
			<div className=" relative w-full md:w-1/3 h-[300px] md:h-[368px] z-10 flex justify-center items-center">
				<div className="relative z-10 w-[200px] h-[200px] md:w-[372px] md:h-[368px]">
					<Image
						src={imageUrl}
						alt={name}
						width={372}
						height={368}
						className="w-full h-full object-cover rounded-lg"
					/>
				</div>
			</div>

			{/* Text */}
			<div className="relative w-full md:w-2/3 text-center px-6 py-8 z-10 flex flex-col items-center justify-center">
				<h3 className="text-lg md:text-3xl font-medium text-blue-900 mb-3">
					{name}
				</h3>
				<p className="text-sm md:text-[24px] text-blue-900">
					{position}
				</p>
			</div>
		</div>
	);
};

export default StoryCard;
