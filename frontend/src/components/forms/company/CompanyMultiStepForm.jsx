"use client";

import React, { useState } from "react";
import Step1 from "./Step1";
import Step2 from "./Step2";
import Step3 from "./Step3";
import SuccessPage from "../SuccessPage";
import ProgressBar from "../ProgressBar";

const CompanyMultiStepForm = () => {
  const [currentStep, setCurrentStep] = useState(0); // Start with index-based steps
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    industry: "",
    employees: "",
    stage: "",
    skills: [],
    home_workers: "",
    training: "",
    hiring: "",
    remote_hiring_preferences: [],
    additional_notes: "",
  });

  // Update specific field in the form data
  const updateFormData = (key, value) => {
    setFormData((prev) => ({ ...prev, [key]: value }));
  };

  // Step titles for ProgressBar
  const steps = [
    "معلومات عن الشركة",
    "احتياجات التدريب والتوظيف",
    "معلومات اضافية",
  ];

  // Step components
  const stepComponents = [
    <Step1
      key="step1"
      formData={formData}
      updateFormData={updateFormData}
    />,
    <Step2
      key="step2"
      formData={formData}
      updateFormData={updateFormData}
    />,
    <Step3
      key="step3"
      formData={formData}
      updateFormData={updateFormData}
    />,
  ];

  // Handle form submission
  const handleSubmit = async () => {
    const url = "http://127.0.0.1:8000/api/company-forms"; // Your API endpoint
    try {
      console.log("FormData to be submitted:", JSON.stringify(formData, null, 2));
      const response = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });

      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.message || "Something went wrong!");
      }

      const data = await response.json();
      console.log("Form submitted successfully:", data);
      setCurrentStep(stepComponents.length); // Navigate to Success page
    } catch (error) {
      console.error("Form submission failed:", error.message);
    }
  };

  // Go to next step
  const goToNextStep = () => {
    if (currentStep < stepComponents.length) {
      setCurrentStep((prev) => prev + 1);
    }
  };

  // Go to previous step
  const goToPreviousStep = () => {
    if (currentStep > 0) {
      setCurrentStep((prev) => prev - 1);
    }
  };

  return (
    <div className="w-full max-w-7xl mx-auto overflow-hidden bg-gray-50 rounded-2xl shadow-md">
      <h1 className="text-xl font-bold p-4 bg-white text-[#21255C] text-center mb-6">
        استمارة التقديم <span className="text-[#F03F74]">- للشركات</span>
      </h1>

      <div className="mb-6 w-full max-w-4xl mx-auto">
        <ProgressBar steps={steps} currentStep={currentStep} />
      </div>

      <p className="text-2xl font-semibold text-[#21255C] text-center mb-4">
        {steps[currentStep]}
      </p>

      <div className="w-full max-w-3xl mx-auto bg-white p-4 mb-12 rounded-2xl">
        {/* Render the current step or SuccessPage */}
        {currentStep < stepComponents.length ? (
          stepComponents[currentStep]
        ) : (
          <SuccessPage />
        )}

        <div className="flex justify-between mt-6 p-4">
          {/* Show "Previous" button */}
          {currentStep > 0 && currentStep < stepComponents.length && (
            <button
              className="px-4 py-2 bg-gray-100 rounded-md text-gray-700 hover:bg-gray-300"
              onClick={goToPreviousStep}
            >
              السابق
            </button>
          )}

          {/* Show "Submit" button on the last step */}
          {currentStep === stepComponents.length - 1 && (
            <button
              type="button"
              onClick={handleSubmit}
              className="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600"
            >
              إرسال
            </button>
          )}

          {/* Show "Next" button */}
          {currentStep < stepComponents.length - 1 && (
            <button
              className="px-4 py-2 bg-gradient text-white rounded-md hover:bg-pink-600"
              onClick={goToNextStep}
            >
              التالي
            </button>
          )}
        </div>
      </div>
    </div>
  );
};

export default CompanyMultiStepForm;
