
import Pricing from "../app/prices/page";
import AboutSection from "@/components/home/AboutSection";
import HeroSection from "@/components/home/HeroSection";
import ServedCompaniesSection from "@/components/home/ServedCompaniesSection";

export default function Home() {
  return (
    <>
      <HeroSection />
      <Pricing />
      <AboutSection />
      <ServedCompaniesSection />
    </>
  );
}
