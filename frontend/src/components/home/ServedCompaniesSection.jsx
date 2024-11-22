import Image from 'next/image';

const ServedCompaniesSection = () => {
	return (
		<section className="w-full bg-pink-100">
			<div className="max-w-screen-xl mx-auto px-8 py-8 md:py-2">
				{/*Mosnad Logo */}
				<figure className="max-w-[159px] max-h-[50px] mb-12 md:mb-6 mx-auto md:mx-0 ">
					<Image
						src="/nav-logo.png"
						alt="Mosnad"
						width={159}
						height={50}
					/>
				</figure>

				{/* Servied Companies Logos */}
				<div className="flex flex-col justify-between items-center md:flex-row gap-14 ">
					<div>
						<h2 className="text-4xl font-bold text-gray-500">
							نفتخر بخدمتهم
						</h2>
					</div>
					<figure className=" max-w-[150px] max-h-[60px]  md:max-w-[200px] md:max-h-[100px]">
						<Image
							src="/jisr-logo.svg"
							alt="Jisr-logo.svg"
							width={217}
							height={113}
						/>
					</figure>

					<figure className=" max-w-[150px] max-h-[60px]  md:max-w-[200px] md:max-h-[100px]">
						<Image
							src="/squadi-logo.svg"
							alt="Mosnad"
							width={217}
							height={113}
						/>
					</figure>
				</div>
			</div>
		</section>
	);
};

export default ServedCompaniesSection;
