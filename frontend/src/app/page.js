import AboutSection from "@/components/home/AboutSection";
import CareerPathSection from "@/components/home/CareerPathSection";
import ClientOpinionsSection from "@/components/home/ClientOpinionsSection";
import HeroSection from "@/components/home/HeroSection";
import JobListings from "@/components/home/JobListings";
import ServedCompaniesSection from "@/components/home/ServedCompaniesSection";
import SuccessStoriesSection from "@/components/home/SuccessStoriesSection";
import TeamMembersSection from "@/components/home/TeamMembersSection";

export default function Home() {
  return (
    <>
      <HeroSection />
      <AboutSection />
      <ServedCompaniesSection />
      <JobListings/>
      {/* <CareerPathSection /> */}
      <SuccessStoriesSection />
      <TeamMembersSection />
      <ClientOpinionsSection />
    </>
  );
}
