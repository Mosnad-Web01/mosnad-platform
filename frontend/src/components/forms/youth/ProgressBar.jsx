import React from "react";
import { FaCheck } from "react-icons/fa";



const ProgressBar = ({ steps, currentStep }) => {
  return (
    <div className="w-full my-8 px-4">
      {/* Desktop View */}
      <div className="hidden md:flex relative items-center justify-between">
        {steps.map((step, index) => (
          <React.Fragment key={index}>
            <div className="relative flex flex-col items-center group">
              {/* Step Circle */}
              <div
                className={`flex items-center justify-center w-12 h-12 rounded-full font-semibold z-10 shadow-lg transition-all duration-300 transform hover:scale-110
                  ${
                    index < currentStep
                      ? "bg-gradient text-white "
                      : index === currentStep
                      ? "border-2 border-[#F03F74] bg-white text-gradient"
                      : "border-2 border-white bg-white text-gray-400"
                  }`}
              >
                {index < currentStep ? (
                  <FaCheck />
                  ) : (
                  <span
                    className={`text-lg ${
                      index === currentStep ? "text-[#F03F74]" : ""
                    }`}
                  >
                    {index + 1}
                  </span>
                )}
              </div>

              {/* Label */}
              <span
                className={`mt-2 text-sm font-medium text-center transition-colors duration-300
                  ${
                    index <= currentStep
                      ? "text-[#F03F74]"
                      : "text-gray-900 group-hover:text-[#F03F74]"
                  }`}
              >
                {step}
              </span>
            </div>

            {/* Connecting Line */}
            {index < steps.length - 1 && (
              <div className="flex-1 mx-4 relative">
                <div className="relative h-8">
                  <svg
                    className="absolute top-[-50%] left-0 w-full h-full"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 100 32"
                  >
                    <path
                      d="M0 16 L 100 16"
                      className={`transition-all duration-500 ${
                        index < currentStep
                          ? "stroke-[2] stroke-[#F03F74]" // Thinner stroke
                          : "stroke-[2] stroke-gray-800" // Thinner stroke
                      }`}
                      strokeLinecap="round"
                    />
                  </svg>
                </div>
              </div>
            )}
          </React.Fragment>
        ))}
      </div>

      {/* Mobile View */}
      <div className="md:hidden">
        <div className="flex flex-col gap-6">
          {steps.map((step, index) => (
            <div key={index} className="relative">
              <div className="flex items-center gap-4">
                {/* Left Line */}
                {index > 0 && (
                  <div
                    className={`absolute left-6 -top-8 w-0.5 h-8
                    ${index <= currentStep ? "bg-gradient" : "bg-gray-300"}`}
                  />
                )}

                {/* Step Circle with Gradient Border */}
                <div className="relative">
                  <div
                    className={`w-10 h-10 rounded-full flex items-center justify-center
                    ${
                      index < currentStep
                        ? "bg-gradient text-white"
                        : index === currentStep
                        ? "bg-white border-2 border-[#F03F74] text-[#F03F74]"
                        : "bg-white border-2 border-gray-300 text-gray-400"
                    }`}
                  >
                    {index < currentStep ? (
                      <FaCheck />
                    ) : (
                      <span
                        className={`text-lg ${
                          index === currentStep ? "text-[#F03F74]" : ""
                        }`}
                      >
                        {index + 1}
                      </span>
                    )}
                  </div>
                </div>

                {/* Step Label */}
                <div className="flex-1">
                  <span
                    className={`block text-sm font-semibold
                    ${
                      index === currentStep
                        ? "text-[#F03F74]"
                        : index < currentStep
                        ? "text-[#F03F74]"
                        : "text-gray-500"
                    }`}
                  >
                    {step}
                  </span>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default ProgressBar;
