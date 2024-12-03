import React from "react";
import TextArea from "@/components/common/TextArea";

const Step4 = ({ formData, updateFormData, errors }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div className="rtl container mx-auto px-4">
      <form>
        <TextArea
          label="صف موقفًا اضطررت فيه إلى حل مشكلة بطريقة إبداعية أو التفكير خارج الصندوق. ما هي المشكلة وكيف تعاملت معها؟"
          placeholder="ادخل النص هنا"
          rows={2}
          additionalClasses="mb-6"
          value={formData.creative_problem_solving || ""} // Updated to match your state
          errorMessage={errors.creative_problem_solving}
          onChange={(value) => handleInputChange("creative_problem_solving", value)}
        />
        <TextArea
          label="اشرح الاختلافات بين website و web application؟"
          placeholder="ادخل النص هنا"
          rows={2}
          additionalClasses="mb-6"
          value={formData.website_vs_webapp || ""} // Updated to match your state
          errorMessage={errors.website_vs_webapp}
          onChange={(value) => handleInputChange("website_vs_webapp", value)}
        />
        <TextArea
          label="تخيل أنك تقوم بإنشاء صفحة ويب لشركة محلية. ما الخطوات التي ستتخذها للتأكد من أن الصفحة سهلة الاستخدام وجذابة بصريًا؟"
          placeholder="ادخل النص هنا"
          rows={2}
          additionalClasses="mb-6"
          value={formData.usability_steps || ""} // Updated to match your state
          errorMessage={errors.usability_steps}
          onChange={(value) => handleInputChange("usability_steps", value)}
        />
      </form>
    </div>
  );
};

export default Step4;
