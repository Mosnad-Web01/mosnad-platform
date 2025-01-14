"use client";

import React, { useState } from "react";
import Cookies from "js-cookie";
import Step1 from "./Step1";
import Step2 from "./Step2";
import Step3 from "./Step3";
import Step4 from "./Step4";
import Step5 from "./Step5";
import SuccessPage from "../SuccessPage";
import ProgressBar from "../ProgressBar";
import { post } from "@/lib/axios";
import { useAuth } from "@/hooks/auth/useAuth";

const YouthMultiStepForm = () => {
  const { user } = useAuth();
  const user_id = user?.id;
  // console.log("user_id", user_id);
  const [currentStep, setCurrentStep] = useState(1);
  const [loading, setLoading] = useState(false); // Default state to false before submission
  const [formData, setFormData] = useState({
    name: "",
    city: "",
    address: "",
    birth_date: "",
    phone_number: "",
    is_it_graduate: null,
    languages: [],
  });

  const [errors, setErrors] = useState({}); // Store error messages

  const updateFormData = (key, value) => {
    setFormData((prev) => ({ ...prev, [key]: value }));
  };

  const handleFileChange = (e) => {
    const file = e.target.files[0];
    setFormData((prev) => ({ ...prev, document: file }));
  };

  // Simple validation function
  const validateStep = (step) => {
    let tempErrors = {};

    if (step === 1) {
      if (!formData.name) tempErrors.name = "اسم المستخدم مطلوب";

      if (!formData.gender) tempErrors.gender = "الرجاء تحديد النوع";

      if (!formData.country) {
        tempErrors.country = "الرجاء تحديد البلد";
      }

      if (!formData.city && !formData.city_input) {
        tempErrors.city = "أختر المدينة مطلوب";
      }

      if (!formData.address) tempErrors.address = "العنوان مطلوب";
      if (!formData.birth_date) tempErrors.birth_date = "تاريخ الميلاد مطلوب";
      if (!formData.phone_number) tempErrors.phone_number = "رقم الجوال مطلوب";
      if (formData.is_it_graduate === null)
        tempErrors.is_it_graduate =
          "الرجاء تحديد إذا كنت خريج تكنولوجيا المعلومات";
    } else if (step === 2) {
      // Step 2 validations
      if (!formData.job_interest)
        tempErrors.job_interest = "الرجاء اختيار المسار الوظيفي";
      if (!formData.motivation)
        tempErrors.motivation = "الرجاء كتابة سبب اهتمامك بهذا المسار";
      if (!formData.career_goals)
        tempErrors.career_goals = "الرجاء كتابة أهدافك المهنية";
      if (!formData.project_ideas)
        tempErrors.project_ideas = "الرجاء كتابة أفكار مشاريعك";
    } else if (step === 3) {
      // Step 3 validations (Radio button responses)
      if (formData.has_workshops === undefined) {
        tempErrors.has_workshops = "الرجاء الإجابة على السؤال";
      } else if (formData.has_workshops === 1 && !formData.workshop_clarify) {
        tempErrors.workshop_clarify =
          "الرجاء توضيح التفاصيل إذا كنت قد حصلت على ورش عمل";
      }

      if (formData.has_coding_experience === undefined) {
        tempErrors.has_coding_experience = "الرجاء الإجابة على السؤال";
      } else if (
        formData.has_coding_experience === 1 &&
        !formData.coding_clarify
      ) {
        tempErrors.coding_clarify =
          "الرجاء توضيح التفاصيل إذا كانت لديك خبرة برمجية";
      }

      if (formData.knows_other_languages === undefined) {
        tempErrors.knows_other_languages = "الرجاء الإجابة على السؤال";
      } else if (
        formData.knows_other_languages === 1 &&
        (!formData.languages || formData.languages.length === 0)
      ) {
        tempErrors.languages =
          "يرجى اختيار لغة واحدة على الأقل إذا كنت تعرف لغات برمجية أخرى";
      }
    } else if (step === 4) {
      // Step 4 validations (Text area responses)
      if (!formData.creative_problem_solving) {
        tempErrors.creative_problem_solving =
          "الرجاء وصف موقف حل المشكلة الإبداعية";
      }
      if (!formData.website_vs_webapp) {
        tempErrors.website_vs_webapp =
          "الرجاء شرح الاختلافات بين website و web application";
      }
      if (!formData.usability_steps) {
        tempErrors.usability_steps =
          "الرجاء شرح خطوات تأكدك من سهولة الاستخدام";
      }
    } else if (step === 5) {
      // Step 5 validations (Text area and File upload)
      if (!formData.additional_info) {
        tempErrors.additional_info =
          "الرجاء كتابة معلومات إضافية عن نفسك أو سبب كونك مناسبًا.";
      }

      if (!formData.document) {
        tempErrors.document =
          "الرجاء إرفاق سيرتك الذاتية أو أي شهادات تعليمية ذات صلة.";
      } else {
        // Validate file type and size
        const validTypes = [
          "application/pdf",
          "application/msword",
          "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        ];
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes

        if (!validTypes.includes(formData.document.type)) {
          tempErrors.document = "الرجاء إرفاق ملف بصيغة PDF أو DOC أو DOCX.";
        }

        if (formData.document.size > maxSize) {
          tempErrors.document = "حجم الملف يجب أن لا يتجاوز 2 ميجابايت.";
        }
      }
    }
    setErrors(tempErrors);
    return Object.keys(tempErrors).length === 0;
  };

  const handleNext = () => {
    if (validateStep(currentStep)) {
      setErrors({});
      setCurrentStep((prev) => prev + 1);
    }
  };

  const handleSubmit = async () => {
    // Validate step 5 before submitting
    if (!validateStep(5)) {
      return; // Don't submit if validation fails
    }

    const url = "/youth-forms"; // Endpoint relative to baseURL
    const formDataToSubmit = new FormData();

    // Append all form data fields
    Object.keys(formData).forEach((key) => {
      if (formData[key] !== null && formData[key] !== undefined) {
        formDataToSubmit.append(key, formData[key]);
      }
    });

    // Append the user_id to the form data
    if (user_id) {
      formDataToSubmit.append("user_id", user_id);
    }

    try {
      console.log("Submitting form data...");
      setLoading(true); // Set loading state to true when submission starts
      const response = await post(url, formDataToSubmit, {
        "Content-Type": "multipart/form-data", // Override headers for FormData
      });
      console.log("Form submitted successfully:", response);
      Cookies.set("status", "active", {
        expires: 7,
        secure: process.env.NODE_ENV === "production",
        sameSite: "strict",
      });
      setCurrentStep(6); // Navigate to Success page
      setLoading(false); // Set loading state back to false when done
    } catch (error) {
      console.error("Form submission failed:", error.message);
      setLoading(false); // Set loading state back to false on error
    }
  };

  const steps = [
    "البيانات الشخصية",
    "الدوافع والإهتمام",
    "خبرة سابقة",
    "الوعي الفني",
    "معلومات أضافية",
  ];
  const stepComponents = [
    <Step1
      key={1}
      formData={formData}
      updateFormData={updateFormData}
      errors={errors}
      onNext={handleNext}
    />,
    <Step2
      key={2}
      formData={formData}
      updateFormData={updateFormData}
      errors={errors}
      onNext={handleNext}
      onPrevious={() => setCurrentStep(1)}
    />,
    <Step3
      key={3}
      formData={formData}
      updateFormData={updateFormData}
      onNext={() => setCurrentStep(4)}
      errors={errors}
      onPrevious={() => setCurrentStep(2)}
    />,
    <Step4
      key={4}
      formData={formData}
      errors={errors}
      updateFormData={updateFormData}
      onNext={() => setCurrentStep(5)}
      onPrevious={() => setCurrentStep(3)}
    />,
    <Step5
      key={5}
      formData={formData}
      errors={errors}
      updateFormData={updateFormData}
      onPrevious={() => setCurrentStep(4)}
      onSubmit={handleSubmit} // Trigger handleSubmit on final step
      handleFileChange={handleFileChange} // File change handler
    />,
  ];

  return (
    <div className="w-full max-w-7xl mx-auto overflow-hidden bg-gray-50 rounded-2xl shadow-md">
      <h1 className="text-xl font-bold p-4 bg-white text-[#21255C] text-center mb-6">
        استمارة التقديم <span className="text-[#F03F74]">- للشباب</span>
      </h1>

      <div className="mb-6 w-full max-w-4xl mx-auto">
        <ProgressBar steps={steps} currentStep={currentStep - 1} />
      </div>

      <p className="text-2xl font-semibold text-[#21255C] text-center mb-4">
        {steps[currentStep - 1]}
      </p>

      <div className="w-full max-w-3xl mx-auto bg-white p-4 mb-12 rounded-2xl">
        {currentStep <= stepComponents.length ? (
          stepComponents[currentStep - 1]
        ) : (
          <SuccessPage type="student" />
        )}

        <div className="flex justify-between mt-6 p-4">
          {currentStep > 1 && currentStep <= stepComponents.length && (
            <button
              className="px-4 py-2 bg-gray-100 rounded-md text-gray-700 hover:bg-gray-300"
              onClick={() => setCurrentStep((prev) => prev - 1)}
            >
              السابق
            </button>
          )}

          {currentStep === 5 && (
            <button
              type="button"
              onClick={handleSubmit}
              className="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600"
              disabled={loading} // Disable button while submitting
            >
              {loading ? "جاري الإرسال..." : "إرسال"}{" "}
              {/* Change button text based on loading state */}
            </button>
          )}

          {currentStep < stepComponents.length && (
            <button
              className="px-4 py-2 bg-gradient text-white rounded-md hover:bg-pink-600"
              onClick={handleNext}
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
