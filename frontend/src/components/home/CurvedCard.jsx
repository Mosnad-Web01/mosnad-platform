import Image from 'next/image';
import React from 'react';

const CurvedCard = ({ id, image, title, subtitle }) => {
	return (
		<div
			key={id}
			className="flex items-center justify-evenly text-center py-6 bg-white shadow-md rounded-b-3xl w-64  hover:shadow-lg transition-shadow duration-300">
			<div>
				<h3 className="text-lg font-bold">{title}</h3>
				<h3 className="text-lg font-bold text-purple-950">
					{subtitle}
				</h3>
			</div>
			<figure className="max-w-[90px]">
				<Image src={image} alt={title} width={90} height={90} />
			</figure>
		</div>
	);
};

export default CurvedCard;
