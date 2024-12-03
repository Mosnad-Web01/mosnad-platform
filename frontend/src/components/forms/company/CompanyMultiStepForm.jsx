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

  const [errors, setErrors] = useState({}); // Store error messages

  // Update specific field in the form data
  const updateFormData = (key, value) => {
    setFormData((prev) => ({ ...prev, [key]: value }));
  };

  // Simple validation function for each step
  const validateStep = (step) => {
    let tempErrors = {};
  
    if (step === 1) {
      // Validate company name
      if (!formData.name) tempErrors.name = "اسم الشركة مطلوب";
  
      // Validate email format
      if (!formData.email) {
        tempErrors.email = "البريد الإلكتروني مطلوب";
      } else if (!/\S+@\S+\.\S+/.test(formData.email)) {
        tempErrors.email = "البريد الإلكتروني غير صالح. يرجى إدخال بريد إلكتروني صحيح";
      }
  
      // Validate industry selection
      if (!formData.industry) tempErrors.industry = "الرجاء اختيار الصناعة";
  
      // Validate number of employees
      if (!formData.employees) {
        tempErrors.employees = "عدد الموظفين مطلوب";
      }
  
      // Validate stage (must be selected)
      if (!formData.stage) tempErrors.stage = "المرحلة يجب أن تكون محددة";
  
      // Validate skills selection (at least one skill should be selected)
      if (formData.skills.length === 0) tempErrors.skills = "الرجاء تحديد المهارات";
  
      // Validate home workers (must be a positive number)
      if (!formData.home_workers) {
        tempErrors.home_workers = "الرجاء تحديد عدد العمال عن بُعد";
      } 
    } else if (step === 2) {
      // Validate training (check if a radio button is selected)
      if (!formData.training) {
        tempErrors.training = "يرجى تحديد ما إذا كنت تقدم تدريبًا على البرمجة";
      }
  
      // Validate hiring (check if a radio button is selected)
      if (!formData.hiring) {
        tempErrors.hiring = "يرجى تحديد ما إذا كنت مهتمًا بتوظيف الأفراد";
      }
  
      // Validate remote hiring preferences (at least one checkbox should be selected)
      if ((formData.remote_hiring_preferences || []).length === 0) {
        tempErrors.remote_hiring_preferences =
          "يرجى اختيار ميزة واحدة على الأقل لدعم رغبتك في التعيينات عن بعد";
      }
    } else if (step === 3) {
      // Validate additional notes
      if (!formData.additional_notes) {
        tempErrors.additional_notes = "الرجاء إضافة ملاحظات إضافية حول شركتك";
      }
    }
  
    setErrors(tempErrors);
    return Object.keys(tempErrors).length === 0; // Return true if no errors
  };
  

  // Handle form submission
  const handleSubmit = async () => {
    // Validate the last step before submitting
    if (!validateStep(3)) {
      return; // Don't submit if validation fails
    }

    const url = "http://127.0.0.1:8000/api/company-forms"; // Your API endpoint
    try {
      console.log(
        "FormData to be submitted:",
        JSON.stringify(formData, null, 2)
      );
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
      setCurrentStep(3); // Navigate to Success page
    } catch (error) {
      console.error("Form submission failed:", error.message);
    }
  };

  // Go to next step
  const goToNextStep = () => {
    if (currentStep < 2 && validateStep(currentStep + 1)) {
      setCurrentStep((prev) => prev + 1);
    }
  };

  // Go to previous step
  const goToPreviousStep = () => {
    if (currentStep > 0) {
      setCurrentStep((prev) => prev - 1);
    }
  };

  const steps = [
    "معلومات عن الشركة",
    "احتياجات التدريب والتوظيف",
    "معلومات اضافية",
  ];

  const stepComponents = [
    <Step1
      key="step1"
      formData={formData}
      updateFormData={updateFormData}
      errors={errors}
    />,
    <Step2
      key="step2"
      formData={formData}
      updateFormData={updateFormData}
      errors={errors}
    />,
    <Step3
      key="step3"
      formData={formData}
      updateFormData={updateFormData}
      errors={errors}
    />,
  ];

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
