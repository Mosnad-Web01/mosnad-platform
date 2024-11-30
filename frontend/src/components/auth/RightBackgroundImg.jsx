import Image from 'next/image';

const RightBackgroundImg = ({ imgSrc }) => {
	return (
		<div className="absolute top-0 right-0 w-full h-full pointer-events-none">
			<div className="hidden lg:block absolute right-0 top-0 h-full w-[40%]">
				<div className="relative w-full h-full">
					<Image
						src={imgSrc}
						alt="Background"
						fill
						style={{ objectFit: 'cover' }}
						priority
						className="transform scale-[1.7] origin-right"
					/>
				</div>
			</div>
		</div>
	);
};

export default RightBackgroundImg;
