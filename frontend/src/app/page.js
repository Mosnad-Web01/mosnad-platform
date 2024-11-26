import Pricing from '../app/prices/page';
import AboutSection from '@/components/home/AboutSection';
import CareerPathSection from '@/components/home/CareerPathSection';
import HeroSection from '@/components/home/HeroSection';
import ServedCompaniesSection from '@/components/home/ServedCompaniesSection';
import SuccessStoriesSection from '@/components/home/SuccessStoriesSection';

export default function Home() {
	return (
		<>
			<HeroSection />
			<AboutSection />
			<ServedCompaniesSection />
			<CareerPathSection />
			<SuccessStoriesSection />
		</>
	);
}
