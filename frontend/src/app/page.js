import AboutSection from '@/components/home/AboutSection';
import HeroSection from '@/components/home/HeroSection';
import JobListings from '@/components/home/JobListings';
import ServedCompaniesSection from '@/components/home/ServedCompaniesSection';

export default function Home() {
	return (
		<>
			<HeroSection />
			<AboutSection />
			<ServedCompaniesSection />
			<JobListings />
		</>
	);
}
