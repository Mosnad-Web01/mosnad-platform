"use client";
import React, { useState } from "react";
import { FaBuilding, FaUserTie } from "react-icons/fa";
import ToggleButtonGroup from "../common/ToggleButtonGroup";
import CurvedCard from "./CurvedCard";

const HeroSection = () => {
  const [activeOption, setActiveOption] = useState("companies");

  const options = [
    { value: "companies", label: "شركات", icon: <FaBuilding /> },
    { value: "employees", label: "كفاءت", icon: <FaUserTie /> },
  ];

  const handleOptionChange = (value) => {
    setActiveOption(value);
  };

  const data = [
    {
      id: 1,
      image: "/company-card-icon.svg",
      title: "+50",
      subtitle: "شركة مسجلة",
    },
    {
      id: 2,
      image: "/talented-card-icon.svg",
      title: "+130",
      subtitle: "موهبة تقنية",
    },
    {
      id: 3,
      image: "/interns-card-icon.svg",
      title: "+50",
      subtitle: "متدرب",
    },
  ];

  return (
	<>
    <section className="w-full h-screen overflow-hidden  bg-pink-200/50">
      <div className="flex flex-col items-center lg:items-start w-full max-w-screen-2xl mx-auto">
        {/* Background Image */}
        <div
          className="w-full h-[600px] md:h-[800px] bg-[url('/hero-bg.png')] bg-cover bg-center bg-no-repeat"
          style={{
            WebkitMaskImage:
              "linear-gradient(to right, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 96%, rgba(0,0,0,0) 100%)",
            maskImage:
              "linear-gradient(to right, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 96%, rgba(0,0,0,0) 100%)",
            WebkitMaskSize: "100% 100%",
            maskSize: "100% 100%",
            WebkitMaskRepeat: "no-repeat",
            maskRepeat: "no-repeat",
          }}
        ></div>

        {/* Content Container */}
        <div className="relative px-4 md:px-10 pt-10 md:pt-20 -mt-[650px] md:-mt-[750px]">
          <div className="max-w-xl mx-auto text-center flex flex-col gap-2">
            {/* Toggle Buttons */}
            <div className="w-fit mx-auto my-3 ">
              <ToggleButtonGroup
                options={options}
                activeOption={activeOption}
                onOptionChange={handleOptionChange}
                containerStyle="bg-white p-1.5 md:p-2 shadow-sm w-[90%] rounded-xl"
                buttonStyle="text-base md:text-lg font-bold text-blue-900 transition-all duration-300 hover:shadow-sm flex justify-center gap-2 rounded-full px-3 md:px-4 py-2 md:py-4 w-[120px] sm:w-[150px] md:w-[300px] text-center"
              />
            </div>

            <h1
              className="text-xl sm:text-2xl md:text-3xl font-bold text-blue-900 mb-3 md:mb-6 px-2 leading-normal md:leading-snug lg:leading-relaxed">
              أهلاً بك في منصة مسند للتدريب والتوظيف
              <br />
              <span>نُسند، ونُستند</span>
            </h1>

            <p
              className="text-base md:text-lg text-gray-700 mb-6 md:mb-8  leading-relaxed md:leading-loose lg:leading-loose "
            >
              البحث عن الشخص المناسب بالزمن المناسب، وأنت فيه. حرصنا على
              احتياجاتك ونلبيه لك بقاعدة بيانات مؤهلة وجاهزة للعمل تحت إشرافنا
              التام
            </p>

            {/* CTA Button */}
            <div className="flex px-4 md:px-0">
              <button className="w-full py-2 md:py-3 rounded-full bg-gradient text-white text-base md:text-lg font-medium hover:shadow-lg transition-all duration-300 hover:scale-105">
                طلب الخدمة
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
	 {/* Curved Cards Section */}
	 <section className=" bg-gradient-to-b from-pink-200 to-indigo-100 p-6 ">
        <div className="container mx-auto flex flex-col justify-evenly items-center gap-6 md:flex-row ">
          {data.map((item) => (
            <CurvedCard
              key={item.id}
              id={item.id}
              image={item.image}
              title={item.title}
              subtitle={item.subtitle}
            />
          ))}
        </div>
      </section>
	
	</>
  );
};

export default HeroSection;