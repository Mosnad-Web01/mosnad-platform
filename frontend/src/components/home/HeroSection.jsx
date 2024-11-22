'use client';
import React from 'react';
import { useState } from 'react';
import { FaBuilding, FaUserTie } from 'react-icons/fa';
import ToggleButtonGroup from '../common/ToggleButtonGroup';

const HeroSection = () => {
	const [activeOption, setActiveOption] = useState('companies');

	const options = [
		{ value: 'companies', label: 'شركات', icon: <FaBuilding /> },
		{ value: 'employees', label: 'كفاءت', icon: <FaUserTie /> },
	];

	const handleOptionChange = (value) => {
		setActiveOption(value);
	};

	return (
<section className="relative w-full overflow-hidden bg-pink-200/50">
  <div className="max-w-screen-xl mx-auto relative h-[600px] md:h-[800px]">
    {/* Background Image with Mask */}
    <div
      className="absolute inset-0 bg-[url('/bg2.png')] bg-cover bg-center bg-no-repeat"
      style={{
        WebkitMaskImage: "linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0))",
        maskImage: "linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0))",
        WebkitMaskSize: "100% 100%",
        maskSize: "100% 100%",
        WebkitMaskRepeat: "no-repeat",
        maskRepeat: "no-repeat",
        opacity: 0.9,

      }}
    ></div>

    {/* Content Container */}
    <div className="absolute right-4 md:right-10 top-1 md:top-4 px-2 md:px-4 pt-10 md:pt-20">
      {/* Hero Content */}
      <div className="max-w-xl mx-auto text-center flex flex-col gap-4">
        {/* Toggle Buttons */}
        <div className="w-fit mx-auto my-8 shadow-md">
          <ToggleButtonGroup
            options={options}
            activeOption={activeOption}
            onOptionChange={handleOptionChange}
            containerStyle="bg-white p-1.5 md:p-2 shadow-sm w-fit rounded-xl"
            buttonStyle="text-base md:text-lg font-bold text-blue-900 transition-all duration-300 hover:shadow-sm flex justify-center gap-2 rounded-full px-3 md:px-4 py-2 md:py-4 w-[120px] sm:w-[150px] md:w-[300px] text-center"
          />
        </div>

        <h1 className="text-xl sm:text-2xl md:text-3xl font-bold text-blue-900 mb-3 md:mb-6 px-2" 
        style={{lineHeight: '1.8'}}>
          أهلاً بك في منصة مسند للتدريب والتوظيف
          <br />
          <span>نُسند، ونُستند</span>
        </h1>

        <p className="text-base md:text-lg text-gray-700 mb-6 md:mb-8 "style={{letterSpacing: '1px', lineHeight: '2.5'}}>
          البحث عن الشخص المناسب بالزمن المناسب، وأنت فيه.
          حرصنا على احتياجاتك ونلبيه لك بقاعدة بيانات مؤهلة
          وجاهزة للعمل تحت إشرافنا التام
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

	);
};

export default HeroSection;
