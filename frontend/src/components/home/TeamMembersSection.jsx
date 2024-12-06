import Image from 'next/image';

const TeamMembersSection = () => {
	return (
		<section className="max-w-screen-xl mx-auto px-6 py-10 bg-white rounded-lg  overflow-hidden mt-20">
			{/* Section Title */}
			<h2 className="text-center text-3xl md:text-5xl font-bold text-blue-900 mb-20">
				اعضاء الفريق
			</h2>

			{/* Team Members */}
			<div className="grid grid-cols-1 md:grid-cols-2 gap-10 items-center justify-center">
				{/* Member 1 */}
				<div className="flex flex-col items-center">
					<figure className="relative overflow-hidden  md:w-[372px] md:h-[368px]">
						<Image
							src="/team-member.svg"
							width={353}
							height={353}
							alt="Team Member 1"
							className="w-full h-full object-cover "
						/>
					</figure>
				</div>

				<div className="flex flex-col items-center">
					<figure className="relative overflow-hidden shadow-lg md:w-[372px] md:h-[368px]">
						<Image
							src="/eman-profile.svg" // Replace with the correct path to your image
							width={353}
							height={353}
							alt="Team Member 1"
							className="w-full h-full object-cover "
						/>
					</figure>
				</div>
			</div>
		</section>
	);
};

export default TeamMembersSection;
