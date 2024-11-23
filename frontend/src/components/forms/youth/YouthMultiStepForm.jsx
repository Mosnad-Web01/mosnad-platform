"use client";

import React, { useState } from "react";
import Step1 from "./Step1";
import Step2 from "./Step2";
import Step3 from "./Step3";
import Step4 from "./Step4";
import Step5 from "./Step5";
import SuccessPage from "./SuccessPage";
import ProgressBar from "./ProgressBar";

const YouthMultiStepForm = () => {
  const [currentStep, setCurrentStep] = useState(1);
  const [formData, setFormData] = useState({
    name: "",
    address: "",
    isITGraduate: false,
    careerPath: "",
    motivation: "",
    aspirations: "",
    projectIdeas: "",
    hasWorkshops: false,
    hasProgrammingExperience: false,
    hasOtherLanguages: false,
  });

  // Function to update form data
  const updateFormData = (key, value) => {
    setFormData((prev) => ({ ...prev, [key]: value }));
  };

  // Define step labels for the progress bar
  const steps = [
    "البيانات الشخصية",
    "الدوافع والإهتمام",
    "خبرة سابقة",
    " الوعي الفني ",
    " معلومات أضافية",
  ];

  // Define step components
  const stepComponents = [
    <Step1
      key={1}
      formData={formData}
      updateFormData={updateFormData}
      onNext={() => setCurrentStep(2)}
    />,
    <Step2
      key={2}
      formData={formData}
      updateFormData={updateFormData}
      onNext={() => setCurrentStep(3)}
      onPrevious={() => setCurrentStep(1)}
    />,
    <Step3
      key={3}
      formData={formData}
      updateFormData={updateFormData}
      onNext={() => setCurrentStep(4)}
      onPrevious={() => setCurrentStep(2)}
    />,
    <Step4
      key={4}
      formData={formData}
      updateFormData={updateFormData}
      onNext={() => setCurrentStep(5)}
      onPrevious={() => setCurrentStep(3)}
    />,
    <Step5
      key={5}
      formData={formData}
      updateFormData={updateFormData}
      onPrevious={() => setCurrentStep(4)}
      onSubmit={() => setCurrentStep(6)}
    />,
  ];

  return (
    <div className="w-full max-w-7xl mx-auto overflow-hidden bg-gray-50 rounded-2xl shadow-md">
      {/* Form Title */}
      <h1 className="text-xl font-bold p-4 bg-white text-[#21255C] text-center mb-6">
        استمارة التقديم <span className="text-[#F03F74]">- للشباب</span>
      </h1>

      {/* Progress Bar */}
      <div className="mb-6 w-full max-w-4xl mx-auto">
        <ProgressBar steps={steps} currentStep={currentStep - 1} />
      </div>

      {/* Current Step Title */}
      <p className="text-2xl font-semibold text-[#21255C] text-center mb-4">
        {steps[currentStep - 1]}
      </p>

      {/* Current Step Component */}
      <div className="w-full max-w-3xl mx-auto bg-white p-4 mb-12 rounded-2xl">
        {currentStep <= stepComponents.length ? (
          stepComponents[currentStep - 1]
        ) : (
          <SuccessPage />
        )}

        {/* Navigation Buttons */}
        <div className="flex justify-between mt-6 p-4">
          {currentStep > 1 && currentStep <= stepComponents.length && (
            <button
              className="px-4 py-2 bg-gray-100 rounded-md text-gray-700 hover:bg-gray-300"
              onClick={() => setCurrentStep((prev) => prev - 1)}
            >
              السابق
            </button>
          )}

          {/* Show the submit button only when on Step 5 */}
          {currentStep === 5 && (
            <button
              type="button"
              onClick={() => setCurrentStep(6)} // Assuming onSubmit takes you to Step 6, where you show success
              className="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600"
            >
              إرسال
            </button>
          )}

          {/* Next Button (Not shown on Step 5) */}
          {currentStep < stepComponents.length && currentStep !== 5 && (
            <button
              className="px-4 py-2 bg-gradient text-white rounded-md hover:bg-pink-600"
              onClick={() => setCurrentStep((prev) => prev + 1)}
            >
              التالي
            </button>
          )}
        </div>
      </div>
    </div>
  );
};

export default YouthMultiStepForm;
