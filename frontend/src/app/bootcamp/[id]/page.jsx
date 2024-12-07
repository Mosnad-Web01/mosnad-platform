"use client";

import { useEffect, useState } from "react";
import RightBackgroundImg from "@/components/auth/RightBackgroundImg";
import { useParams } from "next/navigation";
import { get } from "../../../lib/axios";
import Image from "next/image";

const ArticleSetion = ({ title, description }) => (
  <div className="mb-8">
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
        className="w-full h-full object-cover"
      />
    </figure>
    <div>
      <span className="text-blue-950 text-sm font-bold">{title}</span>
    </div>
  </div>
);

const TrainingDetails = () => {
  const { id } = useParams(); // Accessing the dynamic 'id' param using useParams
  const [bootcamp, setBootcamp] = useState(null);

  useEffect(() => {
    const fetchBootcampDetails = async () => {
      try {
        const data = await get(`/bootcamps/${id}`);
        setBootcamp(data);
      } catch (error) {
        console.error("Failed to fetch bootcamp details:", error);
      }
    };

    if (id) fetchBootcampDetails();
  }, [id]);

  if (!bootcamp) return <div>Loading...</div>;

  const {
    name,
    city,
    description,
    features,
    fees,
    instructor,
    training_duration,
    main_image,
    additional_images,
  } = bootcamp;

  // Check if features is a string, and if so, split it into an array by line breaks
  const featuresArray = typeof features === "string" ? features.split("\r\n") : features;

  return (
    <div className="relative bg-pink-100 lg:bg-white overflow-hidden shadow-xl rounded-2xl py-4 -z-10">
      {/* SVG Background */}
      <RightBackgroundImg imgSrc="/form-bg.svg" />
      {/* Main Content */}
      <div className="relative max-w-screen-xl mx-auto px-4 py-6 lg:px-8 lg:py-2">
        <div className="flex flex-col-reverse lg:flex-row justify-between items-center gap-12 lg:gap-20 py-10 mt-4">
          {/* Right Side - Articles */}
          <div className="w-full lg:w-1/2 md:w-full order-2 lg:order-1">
            <div className="flex flex-col justify-between items-center lg:items-start">
              <ArticleSetion title={name} description={description} />
               
              <div className="w-full md:w-auto flex justify-center">
                <ArticleSetion
                  title="المدينة"
                  description={`المدينة: ${city}`}
                />
              </div>
              
              {/* Additional Images */}
              {additional_images && additional_images.length > 0 && (
                <div className=" mb-6">
                  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    {additional_images.map((img, index) => (
                      <div key={index} className="w-full">
                        <Image
                          src={img}
                          alt={`Additional Image ${index + 1}`}
                          width={300}
                          height={300}
                          className="w-full h-full object-cover"
                        />
                      </div>
                    ))}
                  </div>
                </div>
              )}
            </div>

            <div>
              <ArticleSetion
                title="المدرّب"
                description={`المدرّب: ${instructor}`}
              />
              <ArticleSetion
                title="الرسوم"
                description={`الرسوم: ${fees} (بعد التوظيف)`}
              />
              <ArticleSetion
                title="مدة التدريب"
                description={`مدة التدريب: ${training_duration} أسابيع`}
              />
              <div className="flex mt-4">
                <button className="w-full py-2 md:py-3 rounded-lg bg-gradient text-white text-base md:text-lg font-medium hover:shadow-lg transition-all duration-300 hover:scale-105">
                  انضم للمعسكر التدريبي
                </button>
              </div>
            </div>
          </div>
          
          {/* Left Side - Content */}
          <div className="w-full lg:w-2/5 order-1 lg:order-2 text-center lg:text-right rounded-2xl p-6 lg:p-8">
            <div className="flex flex-col justify-between items-center">
              {/* Main Bootcamp Image */}
              <div className="w-full flex justify-center mb-6 lg:mb-0">
                <Image
                  src={main_image}
                  alt="Training Image"
                  width={527}
                  height={488}
                  className="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

// Exporting default component for Next.js page
export default TrainingDetails;
