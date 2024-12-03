import StoryCard from './StoryCard';

const SuccessStoriesSection = () => {
	const stories = [
		{
			name: 'قصة عبد الله ناصر خالد',
			position: 'مدير موارد بشرية',
			imageUrl: '/abdullah-story.svg',
			isReversed: true,
		},
		{
			name: 'قصة سارة محمد هزاع',
			position: 'الرئيس التنفيذي للشركة',
			imageUrl: '/sara-story.svg',
			isReversed: false,
		},
	];

	return (
		<section className="max-w-screen-xl mx-auto px-6 py-10 bg-white rounded-lg shadow-2xl overflow-hidden mt-20">
			{/* Section Title */}
			<h2 className="text-center text-3xl md:text-5xl font-bold text-blue-900 mb-10">
				قصص نجاح
			</h2>

			{/* Stories */}
			<div className="space-y-12">
				{stories.map((story, index) => (
					<StoryCard
						key={index}
						name={story.name}
						position={story.position}
						imageUrl={story.imageUrl}
						isReversed={story.isReversed}
					/>
				))}
			</div>

			{/* View More Button */}
			<div className=" flex justify-end text-center mt-12">
				<button className="bg-gradient  text-white font-medium px-8 py-3 rounded-xl text-sm hover:opacity-90 transition">
					مشاهدة المزيد
				</button>
			</div>
		</section>
	);
};

export default SuccessStoriesSection;
