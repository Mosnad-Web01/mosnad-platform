import React from "react";
import Input from "../common/Input";
import FAQ from "./FAQ";
import SectionTitle from "../common/SectionTitle";
import TextArea from "../common/TextArea";

const ContactUs = () => {
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

  return (
    <div className="mx-auto py-6 px-4 relative">
      {/* Sharp cut section with blue-950 at the bottom */}
      <div className="absolute bottom-0 w-full left-0 right-0 h-1/2 bg-blue-950 rounded-t-2xl rounded-tl-2xl rounded-tr-2xl z-10"></div>
      
      {/* Red section with sharp cut */}
      <div className="absolute bottom-0 left-0 right-0 h-1/2 bg-white clip-path-sharp z-0"></div>

      <div className=" container mx-auto relative z-20">
        <SectionTitle title="تواصل معنا" />
        <div className="relative max-w-[95%] lg:max-w-[85%] rounded-2xl mx-auto bg-[#FDFAFF] mb-11 pb-20">
          {/* Top Shape */}
          <div className="absolute top-[-8px] left-0 right-0 h-6 bg-[#F03F74] -z-10 rounded-t-2xl"></div>

          <div className="absolute bottom-[-8px] left-0 right-0 h-6 bg-[#F03F74] -z-10 rounded-b-2xl"></div>

          {/* Content */}
          <div className="relative flex flex-col lg:flex-row gap-10 items-start p-6">
            {/* FAQ Section */}
            <div className="w-full lg:w-1/2">
              <h2 className="text-xl text-[#404D64] font-semibold mb-4 text-center mt-6">
                الاسئلة الشائعة
              </h2>
              <FAQ faqs={faqs} />
            </div>
            {/* Contact Form */}
            <div className="w-full lg:w-1/2 shadow-md bg-white lg:mx-5  my-10 rounded-xl lg:p-6 p-3">
              <Input placeholder="ألإسم" additionalClasses="mb-4" />
              <Input placeholder="الهاتف" additionalClasses="mb-4" />
              <Input placeholder="البريد الالكتروني" additionalClasses="mb-4" />
              <TextArea placeholder="رسالتك" rows={3} />
              <button className="w-full bg-gradient mt-10 text-white py-3 rounded-lg">
                اضغط هنا
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ContactUs;
