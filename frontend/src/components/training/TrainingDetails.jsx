import RightBackgroundImg from '../auth/RightBackgroundImg';
import Image from 'next/image';
import Link from 'next/link';

import { FaArrowRight } from 'react-icons/fa';

const BackButton = () => (
	<Link href="#" className="absolute top-2  right-1 cursor-pointer">
		<div className="flex gap-2 items-center align-middle text-sm text-pink-500 hover:text-pink-400 transition-all duration-300 hover:scale-105 font-semibold">
			<FaArrowRight className=" " />
			<div className=""> عودة </div>
		</div>
	</Link>
);

const ArticleSetion = ({ title, description }) => (
	<div className=" mb-8">
		<h2 className="text-xl font-bold text-purple-800 mb-2">{title}</h2>
		<div className="max-w-full md:max-w-[500px]">
			<p className="text-gray-700 leading-relaxed">{description}</p>
		</div>
	</div>
);

const FeatureItem = ({ imageSrc, title }) => (
	<div className="flex flex-col items-center justify-center gap-4">
		<figure className="w-[138px] h-[94px] overflow-hidden">
			<Image
				src={imageSrc}
				alt={title}
				width={100}
				height={100}
				className="w-full h-full object-fit"
			/>
		</figure>
		<div>
			<span className="text-blue-950 text-sm font-bold">{title}</span>
		</div>
	</div>
);

const TrainingDetails = () => {
	const features = [
		{
			imageSrc: '/training/benifit-1.svg',

			title: 'تفاصيل عن ميزة 1',
		},
		{
			imageSrc: '/training/benifit-2.svg',

			title: 'تفاصيل عن ميزة 2',
		},
		{
			imageSrc: '/training/benifit-1.svg',

			title: 'تفاصيل عن ميزة 3',
		},
	];

	const articles = [
		{
			title: 'UI /UX',
			description:
				'تصميم الواجهات لتجربة المستخدم من أكثر المجالات طلبًا في الأسواق العالمية عشان تحترف المجال، هذا المساق لك',
			imageSrc: '/training/article-1.svg',
		},
		{
			title: 'مميزات التدريب',
			description:
				'مخيم تدريبي مكثف ينتهي بالتوظيف عن بعد للسوق الإقليمي مصمم بحسب اتجاهات السوق الاقليمية أدوات ومفاهيم حديثة (Figma , Customer Centric Design, تركيز على ال Customer Experience ) يتضمن العمل على تحديات واقعية وبناء مشاريع لضمها في سجل أعمال المتدرب مجموعة من التدريبات الخاصة بجودة العمل وكفاءته وتدريبات أخرى تخص الاستعداد لسوق العمل',
		},
		{
			title: 'الرسوم',
			description:
				'يتم تحصيلها على شكل نسبة من الراتب بعد توظيف المتدربين بقية المعلومات سيتم إرسالها للمقبولين في حينه ملاحظة: يوجد مبلغ ضمان حضور يتم إعادته في نهاية التدريب',
		},
		{
			title: 'المدرّب',
			description: 'أ. عمرو عمر ومجموعة من المدربين المتخصصين',
		},
		{
			title: 'مدة التدريب',
			description: '6 أسابيع مكثفة',
		},
	];

	return (
		<div className="relative bg-pink-100 lg:bg-white overflow-hidden shadow-xl rounded-2xl py-4 -z-10">
			{/* SVG Background */}
			<RightBackgroundImg imgSrc="/form-bg.svg" />
			{/* Main Content */}
			<div className="relative max-w-screen-xl mx-auto px-4 py-6 lg:px-8 lg:py-2">
				{/* Back Button -------------- */}
				<BackButton />

				<div className=" flex flex-col-reverse lg:flex-row justify-between items-center gap-12 lg:gap-20  py-10 mt-4">
					{/* Right Side - Articles ------------  */}
					<div className="w-full lg:w-1/2 md:w-full order-2 lg:order-1 ">
						<div className="flex flex-col justify-between items-center lg:items-start ">
							<ArticleSetion
								title={articles[0].title}
								description={articles[0].description}
							/>
							<div className="flex flex-wrap md:flex-row justify-center items-center gap-8 ">
								{features.map((feature, index) => (
									<div
										key={index}
										className="w-full  md:w-auto flex justify-center">
										<FeatureItem
											title={feature.title}
											imageSrc={feature.imageSrc}
										/>
									</div>
								))}
							</div>
							<div className="mt-4">
								{articles.slice(1).map((article, index) => (
									<div key={index} className="my-4">
										<ArticleSetion
											key={index}
											title={article.title}
											description={article.description}
										/>
									</div>
								))}
								<div className="flex mt-4">
									<button className="w-full py-2 md:py-3 rounded-lg bg-gradient text-white text-base md:text-lg font-medium hover:shadow-lg transition-all duration-300 hover:scale-105">
										انضم للمعسكر التدريبي
									</button>
								</div>
							</div>
						</div>
					</div>
					{/* Left Side - Content */}
					<div className="w-full lg:w-1/2 order-1 lg:order-2 text-center lg:text-right rounded-2xl p-6 lg:p-8">
						<div className="flex flex-col justify-between items-center">
							<Image
								src="/training/training-left-bg.svg"
								alt="training image"
								width={527}
								height={488}
								className="w-full h-full object-cover -z-30"
							/>
						</div>
					</div>
				</div>
			</div>
		</div>
	);
};

export { TrainingDetails };
