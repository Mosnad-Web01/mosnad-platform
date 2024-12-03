'use client';
import Image from 'next/image';
import TestimonialSection from './TestimonialSection';

const ClientOpinionsSection = () => {
	return (
		<section className="relative max-w-screen-xl mx-auto px-8 py-20 bg-[#F6E8F0] rounded-lg shadow-2xl overflow-hidden mt-20 flex flex-col justify-between h-full gap-20">
			{/* Header */}
			<header>
				<h2 className="text-center text-3xl md:text-5xl font-bold text-blue-900 ">
					آراء عملائنا
				</h2>
			</header>

			{/* Testimonial Section */}
			<div className="flex-grow">
				<TestimonialSection />
			</div>

			{/* Clients Image */}
			<figure className="flex justify-end w-full ">
				<Image
					src="/clients.png"
					alt="Client Opinions"
					width={1300}
					height={288}
					className="w-full h-auto object-contain"
				/>
			</figure>
		</section>
	);
};

export default ClientOpinionsSection;
