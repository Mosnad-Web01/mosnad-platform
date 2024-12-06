"use client";

import React, { useState } from "react";
import Input from "../common/Input";
import TextArea from "../common/TextArea";
import SectionTitle from "../common/SectionTitle";
import FAQ from "./FAQ";
import { post } from "../../lib/axios"; // Assuming this is your HTTP POST helper.

const ContactUs = () => {
  const [formData, setFormData] = useState({
    name: "",
    phone: "",
    email: "",
    message: "",
  });

  const [errors, setErrors] = useState({});
  const [isLoading, setIsLoading] = useState(false); // For showing loading state
  const [successMessage, setSuccessMessage] = useState(""); // For showing success message

  const faqs = {
    trainer: [
      {
        question: "ما هي منصة مُسند؟",
        answer:
          "منصة مُسند صُممت لمساعدة الأفراد والشركات في إيجاد نقاط التقاء بين المواهب اليمنية وأصحاب العمل، وتوفير الدعم للموهوبين لتطوير مسارهم المهني والبرمجي."
      },
      {
        question: "كيف يمكنني التسجيل في منصة مُسند؟",
        answer:
          "يمكنك التسجيل عبر الرابط الموجود في الصفحة الرئيسية، حيث ستقوم بإدخال بياناتك الشخصية وتحديد نوع المستخدم (مُوهوب أو شركة)."
      },
      {
        question: "هل يمكنني التقديم على الوظائف من خلال منصة مُسند؟",
        answer:
          "نعم، يمكنك التقديم على الوظائف المعلنة من قبل الشركات باستخدام حسابك في منصة مُسند."
      },
      {
        question:"ما هي الخدمات التي تقدمها منصة مُسند؟",
        answer:
          "تقدم منصة مُسند خدمات ربط الشركات بالمواهب اليمنية، بالإضافة إلى توفير الإرشاد المهني والتوظيف والدورات التدريبية للمواهب."
      },
    ],
    company: [
      {
        question: "ما هي أنواع الخدمات التي نقدمها؟",
        answer: "نوفر خدمات استقطاب المواهب وتدريب الشركات."
      },
      {
        question: "كيف يمكنني الإعلان عن وظيفة في منصة مُسند؟",
        answer: "يمكنك إضافة الوظائف عبر حسابك على منصة مُسند بتحديد المتطلبات والمزايا."
      },
      {
        question: "هل يمكنني التعاقد مع مدربين لتدريب الموظفين؟",
        answer: "نعم، منصة مُسند توفر لك مدربين متخصصين لتدريب موظفيك في المجالات المطلوبة."
      },
      {
        question: "هل تقدم منصة مُسند خدمات توظيف متخصصة؟",
        answer: "نعم، منصة مُسند تقدم خدمات التوظيف التي تضمن لك العثور على أفضل المواهب."
      },
      {
        question: "هل يمكنني متابعة تقدم عمليات التوظيف على المنصة؟ ",
        answer: "نعم، يمكنك متابعة حالة طلبات التوظيف والتقييمات عبر حسابك على المنصة."
      }
    ]
  };

  const updateFormData = (key, value) => {
    setFormData((prev) => ({ ...prev, [key]: value }));
  };

  // Simple validation function
  const validateForm = () => {
    let tempErrors = {};

    // Validation for the required fields
    if (!formData.name) tempErrors.name = "الاسم مطلوب";
    if (!formData.phone) tempErrors.phone = "رقم الهاتف مطلوب";
    if (!formData.email) tempErrors.email = "البريد الإلكتروني مطلوب";
    if (!formData.message) tempErrors.message = "الرسالة مطلوبة";

    // Email format validation
    if (formData.email && !/\S+@\S+\.\S+/.test(formData.email)) {
      tempErrors.email = "البريد الإلكتروني غير صالح";
    }

    // Phone number validation (assuming a simple number check)
    if (formData.phone && !/^\d+$/.test(formData.phone)) {
      tempErrors.phone = "رقم الهاتف يجب أن يكون رقماً";
    }

    setErrors(tempErrors);
    return Object.keys(tempErrors).length === 0;
  };

  const handleSubmit = async (event) => {
    event.preventDefault();

    // Validate the form before submitting
    if (!validateForm()) return;

    const url = "/contact-us"; // Endpoint for submitting contact form

    setIsLoading(true); // Start loading

    try {
      // Use the post method from your axios setup
      const response = await post(url, formData);

      console.log("Form submitted successfully:", response);
      setSuccessMessage("تم إرسال رسالتك بنجاح!"); // Success message
      setFormData({ name: "", phone: "", email: "", message: "" }); // Clear form after success
    } catch (error) {
      console.error("Form submission failed:", error.message);
      // Optionally, show an error message to the user
    } finally {
      setIsLoading(false); // Stop loading
    }
  };

  return (
    <div className="mx-auto py-6 px-4 relative">
      <div className="absolute bottom-0 w-full left-0 right-0 h-1/2 bg-blue-950 rounded-t-2xl rounded-tl-2xl rounded-tr-2xl z-10"></div>
      <div className="absolute bottom-0 left-0 right-0 h-1/2 bg-white clip-path-sharp z-0"></div>

      <div className="container mx-auto relative z-20">
        <SectionTitle title="تواصل معنا" />
        <div className="relative max-w-[95%] lg:max-w-[85%] rounded-2xl mx-auto bg-[#FDFAFF] mb-11 pb-20">
          <div className="absolute top-[-8px] left-0 right-0 h-6 bg-[#F03F74] -z-10 rounded-t-2xl"></div>
          <div className="absolute bottom-[-8px] left-0 right-0 h-6 bg-[#F03F74] -z-10 rounded-b-2xl"></div>

          <div className="relative flex flex-col lg:flex-row gap-10 items-start p-6">
            {/* FAQ Section */}
            <div className="w-full lg:w-1/2">
              <h2 className="text-xl text-[#404D64] font-semibold mb-4 text-center mt-6">
                الأسئلة الشائعة
              </h2>
              <FAQ faqs={faqs} />
            </div>

            {/* Contact Form */}
            <div className="w-full lg:w-1/2 shadow-md bg-white lg:mx-5 my-10 rounded-xl lg:p-6 p-3">
              <Input
                placeholder="الاسم"
                value={formData.name}
                onChange={(e) => updateFormData("name", e.target.value)}
                errorMessage={errors.name}
                additionalClasses="mb-4"
              />
              <Input
                placeholder="رقم الهاتف"
                value={formData.phone}
                onChange={(e) => updateFormData("phone", e.target.value)}
                errorMessage={errors.phone}
                additionalClasses="mb-4"
              />
              <Input
                placeholder="البريد الإلكتروني"
                value={formData.email}
                onChange={(e) => updateFormData("email", e.target.value)}
                errorMessage={errors.email}
                additionalClasses="mb-4"
              />
              <TextArea
                placeholder="رسالتك"
                rows={3}
                value={formData.message}
                onChange={(value) => updateFormData("message", value)} // Updated to match TextArea prop
                errorMessage={errors.message}
              />
              <button
                type="submit"
                onClick={handleSubmit}
                className="w-full bg-gradient mt-10 text-white py-3 rounded-lg"
              >
                {isLoading ? "إرسال..." : "اضغط هنا"}
              </button>

              {/* Success Message */}
              {successMessage && (
                <div className="mt-4 text-green-500 text-center">{successMessage}</div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ContactUs;
